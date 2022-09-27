<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/logoDAL.php';
require_once 'Utils.php';

$productDAL = new productDAL();

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
    <div class="text-center text-4xl mt-6">MONA MEDIA</div>
    <div class="container lg:w-11/12 w-full lg:mx-auto mx-0 mt-14">
        <div class="h-72 leading-tight bg-cover bg-no-repeat" style="background-image: url(./img/introduce.jpg);">

        </div>
        <div class="lg:flex block">
            <div class="text-center lg:w-2/6 w-full">
                <div class="text_content">
                    <div class="icon-inner">
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                    <h3 class="text-2xl">Mona Media</h3>
                    <p class="mt-3">319 c16 Lý Thường Kiệt, q11</p>
                    <p class="mt-3"> khu cư xá Thuận Việt, TP.HCM</p>
                    <p class="mt-3">Ngã tư Bắc Hải – Lý Thường Kiệt</p>
                </div>

                <button class="button">CLICK ME!</button>
            </div>
            <div class="text-center lg:w-2/6 w-full">
                <div class="text_content">
                    <div class="icon-inner">
                        <i class="fa-solid fa-mobile"></i>
                    </div>
                    <h3 class="text-2xl">ĐIỆN THOẠI</h3>
                    <p class="mt-10 mb-6">0126 922 0162 </p>
                    <p>skype: demonhunterp</p>
                </div>
                <button class="button">CLICK ME!</button>
            </div>
            <div class="text-center lg:w-2/6 w-full">
                <div class="text_content">
                    <div class="icon-inner">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h3 class="text-2xl">EMAIL</h3>
                    <p class="mt-7 mb-6">dinhcan355@gmail.com</p>
                    <p>tamanhtran473@gmail.com</p>
                </div>
                <button class="button">CLICK ME!</button>
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