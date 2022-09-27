<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/categoryDAL.php';
require_once 'dals/logoDAL.php';
require_once 'Utils.php';

$productDAL = new productDAL();
$categoryDAL = new categoryDAL();





if (!isset($_GET['position']) && is_numeric($_GET['position'])) {
    header('location:index.php');
}
$position = $_GET['position'];
//gọi hàm của category
$category = $categoryDAL->getByPosition($position);

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
    <div class="container lg:w-11/12 w-full lg:mx-auto mx-0 mt-14">
        <!-- content header -->
        <div class="flex justify-between">
            <div class="lg:flex hidden gap-4">
                <div class="text-2xl home uppercase"><a href="">trang chủ</a></div>
                <div class="text-2xl">/</div>
                <div class="text-2xl uppercase">
                    <?php echo $category['name'] ?>
                </div>
            </div>
            <div>
                <label class="text-lg lg:inline hidden" for="">Xem tất cả 9 kết quả</label>
                <select class="select">
                    <option value="">thứ tự mặc định</option>
                    <option value="">thứ tự theo mức độ phổ biến</option>
                    <option value="">thứ tự theo điểm đánh giá</option>
                    <option value="">thứ tự theo sản phẩm mới </option>
                    <option value="">thứ tự theo giá : cao đến thấp</option>
                    <option value="">thứ tự theo giá : thấp đến cao</option>
                </select>
            </div>
        </div>

        <!-- content body -->
        <div class="flex mt-8 gap-2">
            <div class="category lg:block hidden" style="width:22%">
                <div class="flex">
                    <input class="input-category" type="text" placeholder="Tìm kiếm ...">
                    <span class="input-category_icon">
                        <i class=" fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
                <div>
                    <h3 class="mb-5 mt-5 text-2xl ">DANH MỤC SẢN PHẨM</h3>
                    <ul>
                        <li class="  border-b-2 border-solid p-2"><a class="category_link" href="category.php?position=<?php echo "2" ?>">BÀN GHẾ</a></li>
                        <li class="  border-b-2 border-solid p-2"><a class="category_link" href="category.php?position=<?php echo "3" ?>">BÀN GHẾ SOFA</a></li>
                        <li class="  border-b-2 border-solid p-2"><a class="category_link" href="category.php?position=<?php echo "1" ?>">KỆ TIVI</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-5 mt-5 text-2xl uppercase">SẢN PHẨM</h3>
                    <ul>
                        <?php
                        $i = 1;
                        foreach ($productList as $productCate) :
                           
                            
                            if ($productCate['category_id'] == $category['id']) {
                                // giới hạn số sản phẩm
                                if ($i > 4) {
                                break;
                            } 
                            $i++;
                        ?>
                                <li class="flex gap-4 items-center mb-3">
                                    <a href=""><img class="w-16 h-16" src="<?php echo $productCate['image'] ?>" alt=""></a>
                                    <div style="width: 70%">
                                        <h4 class="text-xl product-title"><a href=""><?php echo $productCate['product_name'] ?></a></h4>
                                        <strong><?php echo Utils::formatMoney($productCate['price'])  ?></strong>
                                    </div>
                                </li>
                        <?php }
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
            <div class="product-sofa-table-tivi">
                <div class="grid lg:grid-cols-3 grid-cols-2 gap-2 ml-3">
                    <?php foreach($productList as $product):
                        if ($product['category_id'] == $category['id']) {
                        ?>
                        
                    <div class="product_item">
                        <a href="detail.php?id=<?php echo $product['product_id'] ?>">
                            <div class="product_sofa mt-2">
                                <img src="<?php echo $product['image'] ?>" alt="" width="300">
                            </div>
                        </a>
                        <a class="product_link" href="">
                            <i class="absolute bottom-2 left-8 fa-solid fa-cart-plus lg:text-2xl lg:block hidden"></i>
                        </a>
                        <div class="  lg:mt-2 mt-6   mx-auto text-center">
                            <P class="text-xs opacity-60 uppercase"><?php echo $product['category_name'] ?></P>
                            <a class="link_sofa" href="detail.php?id=<?php echo $product['product_id'] ?>">
                                <h4><?php echo $product['product_name'] ?></h4>
                            </a>
                            <strong> <strong><?php echo Utils::formatMoney($product['price'])  ?></strong></strong>
                        </div>
                    </div>
                   <?php }
                endforeach;?>

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