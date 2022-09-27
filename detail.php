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
    $result = $productDAL->getOrder($order);
}
// lấy ra 1 sản phẩm để in ra detail
if (!isset($_GET['id']) && !is_numeric($_GET['id'])) {
    header('location:index.php');
}
$id = $_GET['id'];
$productItem = $productDAL->getOne($id);

// lấy logo
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
    <header class="header ">
     <?php require_once "path/header.php" ?>
    </header>
    <!-- content -->
    <div class="container lg:w-11/12 w-full  lg:mx-auto mx-0 mt-14">
        <section>
            <div class="product flex flex-row">
                <div class="lg:flex hidden mt-8 gap-2 w-6/12  pr-5">
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
                                        <li class="flex gap-4 items-center mb-3 border-b-2 border-slate-200 p-3">
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
                            <img class="max-w-lg" src="<?php echo BASE_URL . $productItem['image']; ?>" alt="" width="300">
                        </div>
                        <div class=" w-10/12 lg:ml-0 ml-8">
                            <div class="lg:flex hidden gap-4">
                                <div class=" mb-5 mt-5 text-xs home uppercase opacity-75"><a href="index.php">trang chủ</a>
                                </div>
                                <div class="mb-5 mt-5 text-xs opacity-75">/</div>
                                <div class=" mb-5 mt-5 text-xs uppercase opacity-75">
                                    <?php $cate = $categoryDAL->getOne($productItem['category_id']);
                                    echo $cate['name'];
                                    ?>
                                </div>
                            </div>
                            <div>
                                <h1 class="product-title entry-title text-2xl font-semibold uppercase"><?php echo $productItem['name']; ?></h1>
                            </div>
                            <div class="price">
                                <h3 class="font-semibold mt-7 border-t-2 py-2 text-2xl"><?php echo Utils::formatMoney($productItem['price']); ?></h3>
                            </div>
                            <div class="product-short-description">
                                <ul class="list-disc">
                                    <li><?php echo $productItem['description'] ?></li>

                                </ul>
                            </div>
                            <div class="product-count">
                                <label for="size" class="mb-4">Số lượng</label>

                                <!-- gủi thông tin quantity  -->
                                <form action="cart.php?action=add" class="mt-4" method="post">
                                    <div class="flex flex-row">
                                        <input class="qtyminus" value="-" type="button">
                                        <input type="text" name="quantity[<?php echo $productItem['id']; ?>]" value="1" class="qty">
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

                <?php $relate = $relateList->getListByIdCategory($productItem['category_id']);
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
    <?php require_once "path/footer.php" ?>

    </footer>

</body>
<script src="./js/main.js?id=<?php echo time() ?>"></script>
<script src="./js/logout.js?id=<?php echo time() ?>"></script>

</html>