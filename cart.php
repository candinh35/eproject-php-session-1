<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/logoDAL.php';
require_once 'Utils.php';
$productDAL = new productDAL();

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
                if (isset($_SESSION['cart'])) {
                    $cart =  array_keys($_SESSION['cart']);
                    $flag = true;
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
    }
}

// kiểm tra sự tồn tại của session cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $cart = $_SESSION['cart'];
    $order = array();
    $order = implode(",", array_keys($cart));
    // lấy ra các product có id lưu trong cart
    $result = $productDAL->getOrder($order);
}
// lấy logo
$logoDAL = new logoDAL();
$logo = mysqli_fetch_assoc($logoDAL->getList());

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?id=<?php echo time() ?>"></script>
    <link rel="stylesheet" href="./css/style_layout.css?id=<?php echo time() ?>">
    <link rel="stylesheet" href="./css/adminCss.css?id=<?php echo time() ?>">
    <link rel="stylesheet" href="./css/fontawesome-free-6.2.0-web/css/all.css?id=<?php echo time() ?>">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;500&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <title>compare</title>
</head>

<body>
    <header class="header ">
        <nav class="flex justify-between border-b-2 pb-4 pt-6 items-center bg-zinc-100 h-24">
            <label for="nav_mobile" class="lg:hidden block text-2xl ml-7 mr-16 menu">
                <i class="fa-solid fa-bars"></i>
            </label>
            <div class="lg:hidden block">
                <input type="checkbox" class="nav_mobile_check hidden" id="nav_mobile">
                <label for="nav_mobile" class="over fixed bg-opacity-20 bg-slate-600 top-0 right-0 bottom-0  left-0 z-10">
                    <label for="nav_mobile">
                        <i class="fa-solid fa-xmark top-4 right-7 text-4xl absolute"></i>
                    </label>
                </label>
                <div class="nav_mobile1 fixed top-0 left-0 bottom-0 w-80 max-w-full bg-white z-20 -translate-x-80">
                    <div class="relative left-6 mb-5">
                        <input class="rounded-2xl focus:outline-none w-56 h-8 mt-11 p-4 pb-5 f bg-zinc-200" type="text" placeholder="Tìm kiếm...">
                        <i class="absolute right-28 top-14 fa-solid fa-magnifying-glass"></i>
                    </div>
                    <ul class="ml-6">
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="introduce.html"> GIỚI THIỆU</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="table.html">BÀN GHẾ</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="sofa.html">BÀN GHẾ SOFA</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="tivi.html">KỆ TIVI</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="news.html">TIN TỨC</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="contact.html">LIÊN HỆ</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center"><a href="compare.html">SO SÁNH</a></li>
                        <li class="pt-4 pb-4 border-t flex items-center">ĐĂNG NHẬP</li>
                        <li class="pt-4 pb-4 border-t flex items-center">GIỎ HÀNG</li>
                        <li class="pt-4 pb-4 border-t flex items-center"></li>
                        <?php ?>
                    </ul>
                </div>
            </div>
            <div class="relative left-14 hidden lg:block">
                <input class="rounded-2xl focus:outline-none w-80 h-8  p-4 pb-5 f bg-zinc-200" type="text" placeholder="Tìm kiếm...">
                <i class="absolute right-3 top-2.5 fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="w-52 h-14 lg:mr-0 mr-16">
                <a href="index.php"><img src="<?php echo $logo['logo']; ?>" alt="logo-mona-furniture-14" class="w-full h-full"></a>
            </div>
            <div class="flex lg:mr-14 mr-6 ">
                <div class="relative before:content-[''] before:h-5 before:border-l-2 before:absolute before:right-0 before:border-gray-400 before:translate-y-1 mr-1 lg:block hidden">
                    <?php
                    if (isset($_SESSION['login'])) { ?>
                        <div class="login">
                            <i class="hover:text-amber-600 text-xl mr-3 fa-solid fa-user"></i>
                            <ul class="login-list">
                                <li class="mb-3">
                                    <a class="hover:text-amber-600" href="">quản lý tài khoản</a>
                                </li>
                                <li>
                                    <a class="hover:text-amber-600" href="?logout=1">Thoat</a>
                                </li>
                            </ul>
                        </div>


                    <?php } else {
                    ?>
                        <a class="hover:text-amber-600 text-lg mr-2 text-zinc-500 login-js" href="login.php">ĐĂNG NHẬP</a>
                    <?php } ?>
                </div>
                <div class="hover:text-amber-600 flex gap-1 product">
                    <a class="hover:text-amber-600 text-lg lg:mr-1 text-zinc-500 lg:block hidden" href="">GIỎ HÀNG</a>
                    <i class="fa-solid fa-cart-plus lg:text-2xl text-2xl"></i>
                </div>
            </div>
        </nav>
        <div class=" gap-10 justify-center p-5 lg:flex hidden">
            <div class="hover:text-amber-600 ">
                <a href="introduce.html">GIỚI THIỆU</a>
            </div>
            <div class="hover:text-amber-600 ">
                <a href="table.html">BÀN GHẾ</a>
            </div>
            <div class="hover:text-amber-600 ">
                <a href="sofa.html">BÀN GHẾ SOFA</a>
            </div>
            <div class="hover:text-amber-600 ">
                <a href="tivi.html">KỆ TIVI</a>
            </div>
            <div class="hover:text-amber-600 ">
                <a href="news.html">TIN TỨC</a>
            </div>
            <div class="hover:text-amber-600 ">
                <a href="contact.html">LIÊN HỆ</a>
            </div>
            <div class="hover:text-amber-600 ">
                <a href="compare.html">SO SÁNH</a>
            </div>
        </div>
    </header>
    <!-- content -->
    <div class="container lg:w-11/12 w-full  lg:mx-auto mx-0 mt-14">
        <?php if (isset($cart)) { ?>

            <div class="flex gap-5 justify-between">
                <form action="cart.php?action=submit" method="post">
                    <div class="product_order border-r-2 pr-10">

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
                                            <img src="<?php echo $row['image'] ?>" alt="" width="130">
                                            <?php echo $row['name'] ?>
                                        </td>
                                        <td class="font-bold"><?php echo Utils::formatMoney($row['price'])  ?></td>
                                        <td>
                                            <div class="product-count">
                                                <div class="flex flex-row">
                                                    <input class="qtyminus" value="-" type="button">
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
                        <div class="flex gap-4">
                            <a href="index.php" class="hover:bg-gray-800 text-black border-2 px-10 py-2 hover:text-white uppercase ">Tiếp tục xem sản phẩm</a>
                            <input class="bg-gray-800 px-10 py-2 text-white uppercase cursor-pointer" type="submit" name="update_click" value="Cập Nhật">
                        </div>

                    </div>
                </form>
                <div class="order w-4/12">

                    <h3 class="text-xl uppercase font-medium">tổng số lượng</h3>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Tổng cộng</p>
                        <p class="font-bold"><?php echo Utils::formatMoney($totally) ?></p>
                    </div>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Giao hàng 1</p>
                        <p>Giao hàng miễn phí</p>
                    </div>
                    <div class="flex justify-between border-b-2 pb-4 pt-6">
                        <p>Tổng cộng</p>
                        <p class="font-bold"><?php echo Utils::formatMoney($totally) ?></p>
                    </div>
                    <div class="mt-6">
                        <a href="" class="bg-gray-800 text-black border-2 px-10 py-2 text-white uppercase ">Tiến hành thanh toán</a>
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
        <div class="container lg:w-11/12 w-full lg:mx-auto mx-0 mt-14 ">
            <div class="lg:flex justify-between ">
                <div class="footer_list ">
                    <h2 class="text-2xl font-semibold leading-9 ml-4 ">ĐIỀU HƯỚNG</h2>

                    <ul class="mt-5 ">
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Trang chủ</a></li>
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Về chúng tôi</a></li>
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Sản phẩm</a></li>
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Điểm tin hữu ích</a></li>
                        <li class="text-xl mt-3 footer_list-link "><a href="contact.html">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="text-center info_footer lg:mt-0 mt-8">
                    <div class="w-52 h-14 lg:mr-0 lg:mr-16 lg:ml-44 ml-12 ">
                        <img src="<?php echo $logo['logo']; ?> " alt="logo-mona-furniture-14 " class="w-full h-full ">
                    </div>
                    <p class="text-base mt-6 ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                        nibh euismod tincidunt ut laoreet ....</p>
                    <div class="mt-6 ">
                        <input class="input_info " type="email " placeholder="Email ... ">
                        <div class="button_footer flex justify-center items-center ">
                            <button>ĐĂNG KÝ</button>
                        </div>
                    </div>


                </div>
                <div class="footer_list-info ">
                    <h2 class="text-2xl font-semibold leading-9 ml-4 ">THÔNG TIN LIÊN HỆ</h2>
                    <div class="flex mt-5">
                        <span class="text-yellow-400 mr-1">A</span>
                        <h3>:319 c16 Lý Thường Kiệt, Phường 15, Quận 11, Tp.HCM</h3>
                    </div>
                    <div class="flex mt-5">
                        <span class="text-yellow-400 mr-1">T</span>
                        <h3>: 0126 922 0162</h3>
                    </div>
                    <div class="flex mt-5">
                        <span class="text-yellow-400 mr-1">E</span>
                        <div>
                            <h3>: candinh355@gmail.com</h3>
                            <h3> tamanhtran473@gmail.com</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </footer>

</body>
<script src="./js/main.js?id=<?php echo time() ?>"></script>
<script src="./js/logout.js?id=<?php echo time() ?>"></script>

</html>