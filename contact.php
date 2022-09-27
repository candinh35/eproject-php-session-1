<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/categoryDAL.php';
require_once 'dals/logoDAL.php';
require_once 'Utils.php';

$productDAL = new productDAL();
$categoryDAL = new categoryDAL();



//gọi hàm của category


//gọi hàm của product
$productList = $productDAL->getList();

// lấy logo
$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);

// kiểm tra session  cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $cart = $_SESSION['cart'];
    $order = array();
    $order = implode(",", array_keys($cart));
    // lấy ra các product có id lưu trong cart
    $result = $productDAL->getOrder($order);
}



// kiểm tra đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['login']);
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
    <div class="content">
        <div class="container lg:w-11/12 w-full lg:mx-auto mx-0 mt-14">
            <div class="lg:flex ">
                <div class="content_1">
                    <div class="content_1-text">
                        <h1 class="text-4xl"> GET IN TOUCH</h1>
                        <p class="font-semibold mt-4">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        <p class="mt-4">Um quist, a seque et audae. Namus aut voloriae. Ecesti volupta sinihil maxim hit quis dicid ut dolorer spiscip suntium eveniet hicatibus, omnit dignam ulparis aut odit, et expero tectiossi acitis aribus dis cus soluptur a dolo
                            incipis plam, e xpe enditatatur aut et volorpor aute repta non coreri dellaboratur acea praeritio blaut voluptio. Xerum quame re pe officae.</p>
                    </div>
                </div>
                <div class="content_2">
                    <div class="contact">
                        <input class="input-contact" type="text" placeholder="Họ và tên">
                        <input class="input-contact" type="email" placeholder="Email">
                        <input class="input-contact" type="text" placeholder="Số điện thoại">
                        <textarea class="input-content" value="Lời nhắn"></textarea>
                        <button class="button-contect">Gửi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER -->
    <footer class="footer">
        <?php require_once "path/footer.php" ?>
    </footer>

</body>
<script src="./js/main.js?id=<?php echo time() ?>"></script>
<script src="./js/logout.js?id=<?php echo time() ?>"></script>

</html>