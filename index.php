<?php
session_start();
$dir = __DIR__;
require_once $dir . '/dals/userDAL.php';
require_once $dir . '/dals/productDAL.php';
require_once $dir . '/dals/categoryDAL.php';
require_once $dir . '/dals/logoDAL.php';
require_once $dir . '/config.php';
require_once $dir . '/Utils.php';

// kiểm tra login
$userDAL = new userDAL();

//  kết nối tơi trang category

$categoryDAL = new categoryDAL();
$categoryList = $categoryDAL->getList();


//  kết nối tơi trang product
$productDAL = new productDAL();

// kiểm tra session  cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $cart = $_SESSION['cart'];
    $order = array();
    $order = implode(",", array_keys($cart));
    // lấy ra các product có id lưu trong cart
    $result = $productDAL->getOrder($order);
}

// kết nối tới logo 

$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);

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
    <header class="header js-header">
        <?php require_once   "path/header.php" ?>
    </header>
    <!-- banner -->
    <div id="slider" class="banner   lg:w-11/12 w-full lg:mx-auto ">
        <div class="absolute lg:bottom-28 lg:left-48 left-16 lg:top-auto top-7">
            <h1 class="lg:text-6xl text-xl text-white">SOFA SET WITH LOUNGER</h1>
            <h2 class="lg:text-4xl text-base text-white mt-4">Reveal Yourslef THROUGH YOUR CHOICE</h2>
            <div class="lg:w-36 lg:h-10 w-28 h-9 lg:text-2xl text-base buy_now">
                <a href="">MUA NGAY</a>
            </div>
        </div>
        <span onclick="next()" class="chevron-left"><i class="fa-solid fa-chevron-left"></i></span>
        <span onclick="prev()" class="chevron-right"><i class="fa-solid fa-chevron-right"></i></span>
    </div>
    <!-- content -->
    <!-- SOFA -->
    <div class="container lg:w-11/12 w-full lg:mx-auto mx-0 mt-14">
        <?php  
        foreach ($categoryList as $category) :?>
            <h3 class="text-2xl mb-4"><?php if ($category['position'] == 3) { echo $category['name'];?></h3>
            <?php $productList = $productDAL->getListByIdCategory($category['id']);?>
            <div class="grid lg:grid-cols-4 grid-cols-2 lg:gap-3 gap-2 ml-5">

                <?php foreach ($productList as $row) :
                   
                    ?>
                    <div class="product_item">
                        <a href="detail.php?id=<?php echo $row['id'] ?>">
                            <img src="<?php echo BASE_URL . $row['image']; ?>" width="300" class="product_sofa">
                        </a>
                        <a class="product_link" href="detail.php?id=<?php echo $row['id'] ?>">
                            <i class="absolute -bottom-4 left-8 fa-solid fa-cart-plus lg:text-2xl lg:block hidden"></i>
                        </a>
                        <div class="lg:mt-0 mt-2   mx-auto text-center">
                            <P class="text-xs opacity-60 uppercase"><?php echo $category['name']; ?></P>
                            <a class="link_sofa" href="detail.php?id=<?php echo $row['id'] ?>">
                                <h4><?php echo $row['name']; ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($row['price']); ?></strong>
                        </div>
                    </div>
        <?php
                                            endforeach;
                                        }
                                    endforeach;
        ?>
            </div>
    </div>
    <!-- ngăn cách -->
    <div class="section-content ">
        <div class="lg:w-11/12 w-full lg:mx-auto lg:flex justify-between section-content1">
            <div class="section_item ">
                <i class="fa-solid fa-truck-moving text-4xl section_icon"></i>
                <h2 class="mt-7 text-2xl text-white">FREE SHIP</h2>
                <p class="mt-2 text-white">Lorem ipsum dolor sit amet, consectetuer</p>
            </div>
            <div class="section_item ">
                <i class="fa-solid fa-gift text-4xl section_icon"></i>
                <h2 class="mt-7 text-2xl text-white">SPECIAL BOOST GIFT</h2>
                <p class="mt-2 text-white">Lorem ipsum dolor sit amet, consectetuer</p>
            </div>

            <div class="section_item ">
                <i class="fa-sharp fa-solid fa-piggy-bank text-4xl section_icon"></i>
                <h2 class="mt-7 text-2xl text-white">SAVE WHEN SHOPPING IN MONA</h2>
                <p class="mt-2 text-white">Lorem ipsum dolor sit amet, consectetuer</p>
            </div>
        </div>
    </div>
    <!-- KỆ TIVI -->
    <div class="container lg:w-11/12 w-full  lg:mx-auto mx-0 mt-14">
        <?php
        foreach ($categoryList

            as $category) :
        ?>
            <h3 class="text-2xl mb-4"><?php if ($category['position'] == 1) {echo $category['name'];?></h3>
            <?php $productList = $productDAL->getListByIdCategory($category['id']);
             
            ?>
            <div class="grid lg:grid-cols-4 grid-cols-2 lg:gap-3 gap-2 ml-5">

                <?php foreach ($productList as $row) : ?>
                    <div class="product_item">
                        <a href="detail.php?id=<?php echo $row['id'] ?>">
                            <img src="<?php echo BASE_URL . $row['image']; ?>" width="300" class="product_sofa">
                        </a>
                        <a class="product_link" href="detail.php?id=<?php echo $row['id'] ?>">
                            <i class="absolute -bottom-4 left-8 fa-solid fa-cart-plus lg:text-2xl lg:block hidden"></i>
                        </a>
                        <div class=" lg:mt-0 mt-2   mx-auto text-center">
                            <P class="text-xs opacity-60 uppercase"><?php echo $category['name']; ?></P>
                            <a class="link_sofa" href="detail.php?id=<?php echo $row['id'] ?>">
                                <h4><?php echo $row['name']; ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($row['price']); ?></strong>
                        </div>
                    </div>
        <?php
                                            endforeach;
                                        }
                                    endforeach;
        ?>
            </div>
    </div>
    <!-- ngăn cách -->
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4 h-96 mt-14 w-full">
        <div class="img-inner">
            <a href=""><img class="img-inner_item" src="./img/sale/sale1.jpg" alt=""></a>
        </div>
        <div class="img-inner2">
            <a href=""><img class="img-inner_item" src="./img/sale/sale2.jpg" alt=""></a>

        </div>
    </div>
    <!-- BÀN GHẾ -->
    <div class="container lg:w-11/12 w-full  lg:mx-auto mx-0 mt-14">
        <?php
        foreach ($categoryList

            as $category) :
        ?>
            <h3 class="text-2xl mb-4"><?php if ($category['position'] == 2) {
                                            echo $category['name'];
                                        ?></h3>
            <?php $productList = $productDAL->getListByIdCategory($category['id']);
            ?>
            <div class="grid lg:grid-cols-4 grid-cols-2 lg:gap-3 gap-2 ml-5">

                <?php foreach ($productList as $row) : ?>
                    <di v class="product_item">
                        <a href="detail.php?id=<?php echo $row['id'] ?>">
                            <img src="<?php echo BASE_URL . $row['image']; ?>" width="300" class="product_sofa">
                        </a>
                        <a class="product_link" href="detail.php?id=<?php echo $row['id'] ?>">
                            <i class="absolute bottom-3 left-8 fa-solid fa-cart-plus lg:text-2xl lg:block hidden"></i>
                        </a>
                        <div class=" lg:mt-0 mt-2   mx-auto text-center">
                            <P class="text-xs opacity-60 uppercase"><?php echo $category['name'];?></P>
                            <a class="link_sofa" href="detail.php?id=<?php echo $row['id'] ?>">
                                <h4><?php echo $row['name']; ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($row['price']); ?></strong>
                        </div>
                    </di>
        <?php
                                            endforeach;
                                        }
                                    endforeach;
        ?>
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