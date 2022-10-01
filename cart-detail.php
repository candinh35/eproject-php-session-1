<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/logoDAL.php';
require_once 'dals/OrderDAL.php';
require_once 'dals/orderDetailDAL.php';
require_once 'dals/userDAL.php';
require_once 'Utils.php';
$productDAL = new productDAL();
$orderDAL = new OrderDAL();
$order_detail = new orderDetailDAL();
$userDAL = new userDAL();

if (isset($_SESSION['login'])) {
    $idLogin =  $_SESSION['login'][0];
    $address = $userDAL->getOne($idLogin);
    $Order = $orderDAL->getByIdUser($idLogin);
}
// lấy logo
$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);

if (isset($_POST['id']) && is_numeric($_POST['id'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];
    if ($status == 1) {
        $checked = $orderDAL->edit($id,'3');
        $_SESSION['add-status'] = [
            'message' => 'Bạn đã hủy đơn hàng'
        ];
    }
}
// kiểm tra đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['login']);
    header('location:index.php');
}
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
    <!-- content -->
    <div class="container lg:w-11/12 w-full  lg:mx-auto mx-0 mt-14">
        <?php
         if (isset($_SESSION['add-status'])) {
                echo '<div class="text-2xl text-red-500" role="alert">'. $_SESSION['add-status']['message'] . '</div>';
                unset($_SESSION['add-status']);
            }
        ?>
        <?php if (isset($Order) && mysqli_num_rows($Order) > 0) { ?>
            <table cellpadding=29 class="table table-bordered container m-auto">
                <?php $count = 1;
                foreach ($Order as $IdOrder) :
                    $detail = $order_detail->getByOrderId($IdOrder['id']); ?>
                    <thead>
                        <tr>
                            <td colspan="6">
                                <h3 class="text-2xl ">đơn hàng: <?php echo $count;
                                                                $count++; ?> </h3>
                            </td>
                        </tr>
                        <tr class="border-2 bg-amber-400">
                            <th>ảnh</th>
                            <th>tên sản phẩm </th>
                            <th>giá</th>
                            <th>số lượng</th>
                            <th>tổng giá</th>
                            <th>trạng thái </th>
                        </tr>

                    </thead>
                    <?php foreach ($detail as $row) : ?>

                        <tbody >
                            <tr class="text-center border-x-2 -px-3">
                                <td><img src="<?php echo $row['image'] ?>" alt="" width="100"> </td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td><?php echo Utils::formatMoney($row['price']) ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                                <td><strong><?php echo Utils::formatMoney($row['sub_total']) ?></strong></td>
                                <td><?php
                                    switch ($IdOrder['status']) {
                                        case 1:
                                            echo "Chờ phản hồi";
                                            break;
                                        case 2:
                                            echo "Đang sử lý";
                                            break;
                                        case 3:
                                            echo "Hủy đơn";
                                            break;
                                        case 4:
                                            echo "Hoàn thành";
                                            break;
                                    };
                                    ?></td>
                            </tr>
                        <?php
                    endforeach; ?>
                        <tr class="border-2 bg-zinc-200 ">
                            <td colspan="2" class="text-xl ">tổng đơn hàng </td>
                            <td colspan="2">
                                <strong>
                                    <?php echo Utils::formatMoney($IdOrder['total']) ?>
                                </strong>
                            </td>
                            <td></td>
                            <td colspan="3">
                                <?php if($IdOrder['status'] ==1){ ?>
                                <form action="" method="post">
                                    <input class="hidden" type="text" name="id" value="<?php echo $IdOrder['id'] ?>">
                                    <input class="hidden" type="text" name="status" value="<?php echo $IdOrder['status'] ?>">
                                    <button class="bg-gray-800 lg:px-10 px-4 py-2 text-white uppercase cursor-pointer block">Hủy Đơn</button>
                                </form>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-0">
                                <div class="w-full h-10  mt-28"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr class="border-t-2">
                        <td class="text-2xl font-medium" colspan="2">địa chỉ </td>
                        <td colspan="2">
                            <?php echo $address['address'] ?>
                        </td>
                    </tr>
                    <tr class="border-b-2">
                        <td class="text-2xl font-medium" colspan="2">số điện thoại </td>
                        <td colspan="2">
                            <?php echo $address['phone'] ?>
                        </td>
                    </tr>
                        </tbody>
            </table>
            <div class=" mt-7">
                <a href="index.php" class="hover:bg-gray-800 text-black border-2 lg:px-10 px-4 py-2 hover:text-white uppercase ">Tiếp tục xem sản phẩm</a>
            </div>
        <?php } else { ?>
            <div class="mb-40">
                <h3 class="uppercase text-center text-2xl">bạn chưa mua sản phẩm nào vui lòng quay lại tiếp tục mua sắm</h3>
                <div class="flex justify-center mt-11">
                    <a class="bg-gray-800 px-16 py-3 text-white uppercase" href="index.php"><input type="submit" value="QUAY VỀ TRANG CHỦ"></a>
                </div>

            </div>
        <?php } ?>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <?php require_once "path/footer.php" ?>

    </footer>

</body>
<script src="./js/main.js?id=<?php echo time() ?>"></script>
<script src="./js/logout.js?id=<?php echo time() ?>"></script>

</html>