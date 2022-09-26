<?php
session_start();
require_once 'dals/logoDAL.php';
require_once 'dals/categoryDAL.php';
require_once 'dals/productDAL.php';
require_once 'Utils.php';
require_once 'config.php';
require_once 'dals/DB.php';


// kết nối tơi bảng category
$categoryDAL = new categoryDAL();
$categoryList = $categoryDAL->getList();

//kết nối tới bảng product
$productDAL = new productDAL();
$relateList = new productDAL();

// kiểm tra session  cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $cart = $_SESSION['cart'];
    $order = array();
    $order = implode(",", array_keys($cart));
    // lấy ra các product có id lưu trong cart
    $cartProduct = $productDAL->getOrder($order);
}
// lấy ra 1 sản phẩm để in ra detail
if (!isset($_GET['id']) && !is_numeric($_GET['id'])) {
    header('location:index.php');
}
$id = $_GET['id'];
$result = $productDAL->getOne($id);

// lấy logo
$logoDAL = new logoDAL();
$logo = mysqli_fetch_assoc($logoDAL->getList());

// kiểm tra đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['login']);
}
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
                                    <a class="hover:text-amber-600" href="?logout=1&id=<?php echo $id ?>">Thoat</a>
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
                    <?php if (isset($cart)) { ?>
                        <div class="product_box1">
                            <div class="mb-3">
                                <?php foreach ($cartProduct as $productCart) : ?>

                                    <div class="flex gap-2 mb-3 border-b-2">
                                        <img src="<?php echo $productCart['image'] ?>" alt="" width="100">
                                        <div>
                                            <h4><?php echo $productCart['name'] ?></h4>
                                            <div class="flex gap-2 font-extrabold">
                                                <p><?php echo $cart[$productCart['id']] ?></p>
                                                <p>*</p>
                                                <p><?php echo Utils::formatMoney($productCart['price'])  ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <a href="cart.php" class="mt-3 uppercase w-full rounded-md  bg-amber-400  block text-center text-teal-50 py-2">xem giỏ hàng</a>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class="product_box">chưa có sản phẩm trong giỏ hàng</div>
                    <?php } ?>
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
        <section>
            <div class="product flex flex-row">
                <div class="lg:flex hidden mt-8 gap-2 w-6/12">
                    <div class="cartegory lg:block hidden w-full">
                        <aside>
                            <div>
                                <h3 class="mb-5 mt-5 text-2xl ">SẢN PHẨM</h3>
                                <ul>
                                    <?php
                                    $i = 0;
                                    $productList = $productDAL->getList();
                                    foreach ($productList as $product) :
                                        $i++;
                                        if ($i > 4) {
                                            break;
                                        }
                                    ?>
                                        <li class="flex gap-4 items-center mb-3 fa-border p-3">
                                            <a href="detail.php?id=<?php echo $product['product_id'] ?>"><img class="w-20" src="<?php echo $product['image'] ?>" alt=""></a>
                                            <div>
                                                <h4 class="text-xl product-title hover:text-amber-600 ">
                                                    <a href="detail.php?id=<?php echo $product['product_id'] ?>"><?php echo $product['product_name'] ?></a>
                                                </h4>
                                                <strong><?php echo Utils::formatMoney($product['price']) ?></strong>
                                            </div>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="product-description">
                    <div class="lg:flex block flex-row ">
                        <div class="product-image  ">
                            <img class="max-w-lg" src="<?php echo BASE_URL . $result['image']; ?>" alt="" width="300">
                        </div>
                        <div class="lg:w-7/12 w-11/12 lg:ml-0 ml-8">
                            <div class="lg:flex hidden gap-4">
                                <div class=" mb-5 mt-5 text-xs home uppercase opacity-75"><a href="index.php">trang chủ</a>
                                </div>
                                <div class="mb-5 mt-5 text-xs opacity-75">/</div>
                                <div class=" mb-5 mt-5 text-xs uppercase opacity-75">
                                    <?php $cate = $categoryDAL->getOne($result['category_id']);
                                    echo $cate['name'];
                                    ?>
                                </div>
                            </div>
                            <div>
                                <h1 class="product-title entry-title text-2xl font-semibold uppercase"><?php echo $result['name']; ?></h1>
                            </div>
                            <div class="price">
                                <h3 class="font-semibold mt-7 border-t-2 py-2 text-2xl"><?php echo Utils::formatMoney($result['price']); ?></h3>
                            </div>
                            <div class="product-short-description">
                                <ul class="list-disc">
                                    <li><?php echo $result['description'] ?></li>

                                </ul>
                            </div>
                            <div class="product-count">
                                <label for="size" class="mb-4">Số lượng</label>
                                <form action="cart.php?action=add" class="mt-4" method="post">
                                    <div class="flex flex-row">
                                        <input class="qtyminus" value="-" type="button">
                                        <input type="text" name="quantity[<?php echo $result['id']; ?>]" value="1" class="qty">
                                        <input class="qtyplus" value="+" type="button">
                                    </div>
                                    <button class="round-black-btn">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="">
                <h3 class="ml-2 mb-5 mt-5 text-2xl">SẢN PHẨM TƯƠNG TỰ</h3>
            </div>
            <div class="grid lg:grid-cols-4 grid-cols-2 lg:gap-3 gap-2 ml-5 relative">

                <?php $relate = $relateList->getListByIdCategory($result['category_id']);
                $i  = 1;
                foreach ($relate as $product1) {
                    if ($i > 4) {
                        break;
                    }
                    $i++;
                ?>
                    <div class="product_item">
                        <a href="detail.php?id=<?php echo $product1['id'] ?>">
                            <img src="<?php echo BASE_URL . $product1['image']; ?>" width="300" class=" product_sofa">
                        </a>
                        <a class="product_link" href="">
                            <i class="absolute -bottom-3 left-8 fa-solid fa-cart-plus lg:text-2xl lg:block hidden"></i>
                        </a>
                        <div class="w-36 lg:mt-0 mt-2   mx-auto text-center">
                            <P class="text-xs opacity-60"><?php echo $product1['name']; ?></P>
                            <a class="link_sofa" href="">
                                <h4><?php echo $product1['name']; ?></h4>
                            </a>
                            <strong><?php echo Utils::formatMoney($product1['price']); ?></strong>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
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