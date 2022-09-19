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
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $result = $userDAL->login($email, $password);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = [
            'email' => $email,
            'password' => $password
        ];
    } else {
        $failed = "tài khoản hoặc mật khâu không chính xác vui lòng nhập lại!";
    }
    echo $_SESSION['login']['id'];
}

//  kết nối tơi trang category

$categoryDAL = new categoryDAL();
$categoryList = $categoryDAL->getList();

//  kết nối tơi trang product

$productDAL = new productDAL();


// kết nối tới logo 

$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/style_layout.css">
    <link rel="stylesheet" href="./css/fontawesome-free-6.2.0-web/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;500&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">

    <title>compare</title>
</head>

<body>
    <header class="header ">
        <nav class="flex justify-between items-center bg-zinc-100 h-24">
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
                        <?php  ?>
                    </ul>
                </div>
            </div>
            <div class="relative left-14 hidden lg:block">
                <input class="rounded-2xl focus:outline-none w-80 h-8  p-4 pb-5 f bg-zinc-200" type="text" placeholder="Tìm kiếm...">
                <i class="absolute right-3 top-2.5 fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="w-52 h-14 lg:mr-0 mr-16">
                <a href="index.php"><img src="<?php echo $r['logo']; ?>" alt="logo-mona-furniture-14" class="w-full h-full"></a>
            </div>
            <div class="flex lg:mr-14 mr-6 ">
                <div class="hover:text-amber-600 relative before:content-[''] before:h-5 before:border-l-2 before:absolute before:right-0 before:border-gray-400 before:translate-y-1 mr-1 lg:block hidden">
                    <button class="hover:text-amber-600 text-lg mr-2 text-zinc-500 login-js" href="./login.php">ĐĂNG NHẬP</button>

                </div>
                <div class="hover:text-amber-600 flex gap-1 product">
                    <a class="hover:text-amber-600 text-lg lg:mr-1 text-zinc-500 lg:block hidden" href="">GIỎ HÀNG</a>
                    <i class="fa-solid fa-cart-plus lg:text-2xl text-2xl"></i>
                    <div class="product_box">chưa có sản phẩm trong giỏ hàng</div>
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
        $arrId = [];
        $arrName = [];
        foreach ($categoryList as $category) :
            array_push($arrId,$category['id']);
            array_push($arrName,$category['name']);
             endforeach;
            ?>
           <h3 class="text-2xl"><?php  echo $arrName[0]; ?></h3>
                <?php $productList = $productDAL->getListByIdCategory($arrId[0]);
                ?>
                <div class="grid lg:grid-cols-4 grid-cols-2">
                
                <?php foreach ($productList as $row) : ?>
                    <div>
                        <a href="">
                            <img class="" src="<?php echo BASE_URL . $row['image'] ?>" alt="">
                        </a>
                        
                        <div class="w-36 lg:mt-0 mt-2   mx-auto text-center">
                            <!-- category -->
                            <P class="text-xs opacity-60 uppercase"><?php echo $arrName[0] ?></P>

                            <!-- name -->
                            <a class="link_sofa" href="">
                                <h4><?php echo $row['name'] ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($row['price']) ?></strong>
                        </div>
                    </div>

            <?php endforeach;
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
           <h3 class="text-2xl"><?php  echo $arrName[1]; ?></h3>
                <?php $productList = $productDAL->getListByIdCategory($arrId[1]);
                ?>
                <div class="grid lg:grid-cols-4 grid-cols-2">
                
                <?php foreach ($productList as $row) : ?>
                    <div>
                        <a href="">
                            <img class="" src="<?php echo BASE_URL . $row['image'] ?>" alt="">
                        </a>
                        
                        <div class="w-36 lg:mt-0 mt-2   mx-auto text-center">
                            <!-- category -->
                            <P class="text-xs opacity-60 uppercase"><?php echo $arrName[1] ?></P>

                            <!-- name -->
                            <a class="link_sofa" href="">
                                <h4><?php echo $row['name'] ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($row['price']) ?></strong>
                        </div>
                    </div>
            <?php endforeach;
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
           <h3 class="text-2xl"><?php  echo $arrName[2]; ?></h3>
                <?php $productList = $productDAL->getListByIdCategory($arrId[2]);
                ?>
                <div class="grid lg:grid-cols-4 grid-cols-2">
                
                <?php foreach ($productList as $row):?>
                    <div>
                        <a href="">
                            <img class="" src="<?php echo BASE_URL . $row['image'] ?>" alt="" width="300">
                        </a>
                        
                        <div class="w-36 lg:mt-0 mt-2   mx-auto text-center">
                            <!-- category -->
                            <P class="text-xs opacity-60"><?php echo $arrName[2] ?></P>

                            <!-- name -->
                            <a class="link_sofa" href="">
                                <h4><?php echo $row['name'] ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($row['price']) ?></strong>
                        </div>
                    </div>

            <?php endforeach;
            ?>
        </div>
    </div>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="container lg:w-11/12 w-full lg:mx-auto mx-0 mt-14 ">
            <div class="lg:flex justify-between ">
                <div class="footer_list ">
                    <h2 class="text-2xl font-semibold leading-9 ml-4 ">ĐIỀU HƯỚNG</h2>

                    <ul class="mt-5 ">
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Trang chủ</a> </li>
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Về chúng tôi</a> </li>
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Sản phẩm</a> </li>
                        <li class="text-xl mt-3 footer_list-link "><a href=" ">Điểm tin hữu ích</a> </li>
                        <li class="text-xl mt-3 footer_list-link "><a href="contact.html">Liên hệ</a> </li>
                    </ul>
                </div>
                <div class="text-center info_footer lg:mt-0 mt-8">
                    <div class="w-52 h-14 lg:mr-0 lg:mr-16 lg:ml-44 ml-12 ">
                        <a href="index.php">
                            <img src="<?php echo $r['logo']; ?>" alt="logo-mona-furniture-14 " class="w-full h-full ">
                        </a>
                        
                    </div>
                    <p class="text-base mt-6 ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet ....</p>
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
<script src="./../js/main.js "></script>

</html>