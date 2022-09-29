<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/logoDAL.php';
require_once 'dals/OrderDAL.php';
require_once 'dals/orderDetailDAL.php';
require_once 'Utils.php';
$productDAL = new productDAL();
$orderDAL = new OrderDAL();
$order_detail = new orderDetailDAL();
//lấy dữ liệu gửi lên từ submit

if (isset($_GET['action'])) {


    function updateCart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {
            // nếu người dùng cho số lượng <= 0 thì xóa sản phẩm
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$id]);
                header('location:cart.php');
            } else {
                // kiểm tra xem đã có id của product trong giỏ hàng chưa
                $flag = true;
                if (isset($_SESSION['cart'])) {
                    $cart =  array_keys($_SESSION['cart']);

                    foreach ($cart as $cartId) {
                        if ($cartId == $id) {
                            $flag = false;
                        }
                        //    nếu có rồi thì công thêm quantity vào 
                    }
                }
                if ($add && $flag == false) {
                    $_SESSION['cart'][$id] += $quantity;
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
    };
    // phân loại action được gửi lên
    switch ($_GET['action']) {
        case "add":
            if ($_POST['quantity'] != null) {
                updateCart(true);
            } else {
                updateCart();
            }

            break;
        case 'delete':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                unset($_SESSION['cart'][$_GET['id']]);
                header('location:cart.php');
            }
            break;
        case "submit":
            updateCart();
            break;
        case "pay":
            if (isset($_SESSION['login'])) {
                $user_id = $_SESSION['login'][0];
                $date = date("y-m-d");
                $status = 1;
                if(!isset($_SESSION['cart'])){
                    header('location:index.php');
                }
                $cart = $_SESSION['cart'];
                $order = implode(",", array_keys($cart));
                // lấy ra các product có id lưu trong cart
                $result = $productDAL->getOrder($order);
                $subTotal = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $subTotal += ($row['price'] * $cart[$row['id']]);
                };
                $tax = 10;
                $total = $subTotal + ($subTotal * ($tax / 100));
                $order_id = $orderDAL->makeOrder($date, $status, $subTotal, $tax, $total, $user_id);
                unset($_SESSION['cart']);
                //  add vào order_detail
                $insertOrder = "";
                $count =  mysqli_num_rows($result);
                $sub_total = 0;
                foreach ($result as $key => $orderItem) {
                    $sub_total = ($orderItem['price'] * $cart[$orderItem['id']]);
                    $insertOrder .= "(" . $orderItem['id'] . "," . $order_id . "," . $orderItem['price'] . "," . $cart[$orderItem['id']] . "," . $sub_total . ")";
                    if ($key != $count - 1) {
                        $insertOrder .= ",";
                    }
                };
                // var_dump($insertOrder);exit;

                // lưu vào table order_detail
                $order_detail->makeOrderDetail($insertOrder);

                // thông báo 
                if ($order_id) {
                    //flash session
                    $_SESSION['add-status'] = [
                        'success' => 1,
                        'message' => 'Bạn đã đặt hàng thành công',
                        'notify' => 'xem đơn hàng'
                    ];
                    
                } else {
                    $_SESSION['add-status'] = [
                        'success' => 0,
                        'message' => 'Dẫ có lỗi sảy ra vui lòng quý khách đợi một chút'
                    ];
                }
            } else {
                $failed = "Vui lòng đăng nhập để đặt hàng ";
            }
    }
}

// kiểm tra sự tồn tại của session cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $cart = $_SESSION['cart'];
    $order = implode(",", array_keys($cart));
    // lấy ra các product có id lưu trong cart
    $result = $productDAL->getOrder($order);
}
// lấy logo
$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);

// kiểm tra đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['login']);
}

// tạo biến để lấy tổng giá

$totally = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "path/head.php" ?>
</head>

<body>
    <header class="header ">
        <?php require_once "path/header.php" ?>
    </header>
    <h3 class="text-red-500 text-center text-2xl"><?php if (isset($failed)) {
                                                        echo $failed;
                                                    } ?></h3>
    
    <!-- content -->
    <div class="container lg:w-11/12 w-full  lg:mx-auto mx-0 mt-14">
        <?php if (isset($cart)) { ?>

            <div class="lg:flex gap-5 block justify-between">
                <form action="cart.php?action=submit" method="post" style="width:60%">
                    <div class="product_order border-r-2 pr-10">
                    <?php
    if (isset($_SESSION['add-status'])) {
        if ($_SESSION['add-status']['success'] == 1) {
            echo '<div class="text-2xl text-center text-green-500 mb-4" role="alert">
                    ' . $_SESSION['add-status']['message'] . '
                  </div>'?>

             <div class="text-center text-2xl px-10 leading-10 mx-auto w-60 pb-2 border-2  mb-40 hover:bg-gray-800 text-black hover:text-white  "><a href="cart-detail.php"><?php echo $_SESSION['add-status']['notify'] ?></a></div>
       <?php } else {
            echo '<div class="ext-2xl text-center text-red-500" role="alert">
                    ' . $_SESSION['add-status']['message'] . '
                  </div>';
        }
        unset($_SESSION['add-status']);
    }else{
    ?>
                        <table cellpadding=15 class="mb-7">
                            <thead>
                                <tr class="border-b-2 border-slate-400">
                                    <th>SẢN PHẨM</th>
                                    <th>GIÁ</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>TỔNG CỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row) : ?>
                                    <tr class="border-b-2 border-slate-100">
                                        <td class="flex justify-items-start items-center gap-3 w-96">
                                            <!-- xóa sản phẩm -->
                                            <a href="?action=delete&id=<?php echo $row['id'] ?>"><i class="fa-regular fa-circle-xmark"></i></a>
                                            <img src="<?php echo $row['image'] ?>" alt="" class="lg:w-32 w-16">
                                            <?php echo $row['name'] ?>
                                        </td>
                                        <td class="font-bold"><?php echo Utils::formatMoney($row['price'])  ?></td>
                                        <td>
                                            <div class="product-count">
                                                <div class="flex flex-row">
                                                    <input class="qtyminus" value="-" onclick="qtyminus()" type="button">
                                                    <input type="text" name="quantity[<?php echo $row['id']; ?>]" value="<?php echo $cart[$row['id']] ?>" class="qty">
                                                    <input class="qtyplus" value="+" type="button">
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php
                                            // tính tổng tiền tất cả sản phẩm trong giỏ hàng
                                            $totally += ($row['price'] * $cart[$row['id']]);
                                            echo Utils::formatMoney(($row['price'] * $cart[$row['id']])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php }?>
                        <div class="flex  gap-4">
                            <a href="index.php" class="hover:bg-gray-800 text-black border-2 lg:px-10 px-4 py-2 hover:text-white uppercase ">Tiếp tục xem sản phẩm</a>
                            <input class="bg-gray-800 lg:px-10 px-4 py-2 text-white uppercase cursor-pointer" type="submit" name="update_click" value="Cập Nhật">
                        </div>

                    </div>
                </form>
                <div class="lg:mt-0 mt-10 lg:w-4/12 w-full">

                    <h3 class="text-xl uppercase font-medium">tổng số lượng</h3>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Tổng giá</p>
                        <p class="font-bold"><?php echo Utils::formatMoney($totally) ?></p>
                    </div>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Giao hàng 1</p>
                        <p>Giao hàng miễn phí</p>
                    </div>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Thuế VAT</p>
                        <p>10%</p>
                    </div>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Tổng cộng</p>
                        <p class="font-bold"><?php echo Utils::formatMoney($totally + ($totally * (10/100))) ?></p>
                    </div>
                    <div class="mt-6">
                        <a href="?action=pay" class="bg-gray-800 border-2 px-10 py-2 text-white uppercase ">đặt hàng</a>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <div class="mb-40">
                <h3 class="uppercase text-center text-2xl">chưa có sản phẩm trong giỏ hàng</h3>
                <div class="flex justify-center mt-11">
                    <a class="bg-gray-800 px-16 py-3 text-white uppercase" href="index.php"><input type="submit" value="QUAY VỀ TRANG CHỦ"></a>
                </div>

            </div>
        <?php  } ?>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <?php require_once "path/footer.php" ?>

    </footer>

</body>
<script src="./js/main.js?id=<?php echo time() ?>"></script>
<script src="./js/logout.js?id=<?php echo time() ?>"></script>

</html>