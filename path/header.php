<?php
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $resultSearch = $productDAL->searchIndex($search);
}


?>
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
                <li class="pt-4 pb-4 border-t flex items-center"><a href="introduce.php"> GIỚI THIỆU</a></li>
                <li class="pt-4 pb-4 border-t flex items-center"><a href="category.php?position=<?php echo "2" ?>">BÀN GHẾ</a></li>
                <li class="pt-4 pb-4 border-t flex items-center"><a href="category.php?position=<?php echo "3" ?>">BÀN GHẾ SOFA</a></li>
                <li class="pt-4 pb-4 border-t flex items-center"><a href="category.php?position=<?php echo "1" ?>">KỆ TIVI</a></li>
                <li class="pt-4 pb-4 border-t flex items-center"><a href="contact.php">LIÊN HỆ</a></li>
                <li class="pt-4 pb-4 border-t flex items-center"><a href="login.php"> ĐĂNG NHẬP</a></li>
                <li class="pt-4 pb-4 border-t flex items-center"><a href="cart.php"> GIỞ HÀNG</a></li>
                <?php ?>
            </ul>
        </div>
    </div>
    <?php if (isset($resultSearch)) { ?>
        <form action="" method="post" id="form-search" class="product1">
        <?php } else { ?>
            <form action="" method="post" id="form-search">
            <?php } ?>
            <div class="relative left-14 hidden lg:block">
                <input class="rounded-2xl focus:outline-none w-80 h-8  p-4 pb-5 f bg-zinc-200" type="text" placeholder="Tìm kiếm..." name="search">
                <button>
                    <i class="absolute right-3 top-2.5 fa-solid fa-magnifying-glass"></i>
                </button>
                <?php
                if (isset($resultSearch)) {  ?>
                    <div class="product_search" style="overflow-y:scroll ;height:60vh">
                        <?php
                        if (mysqli_num_rows($resultSearch) > 0) {
                            foreach ($resultSearch as $result1) :
                               
                        ?>
                                <div class="flex gap-2 mb-3 border-b-2">
                                    <a href="detail.php?id=<?php echo $result1['id']; ?>">
                                        <img src="<?php echo $result1['image'] ?>" alt="" width="100">
                                    </a>

                                    <div style="max-width:200px;">
                                        <h4><a class="hover:text-amber-600 leading-10" href="detail.php?id=<?php echo $result1['id']; ?>"><?php echo $result1['name'] ?></a></h4>
                                        <div class="flex gap-2 font-extrabold">

                                            <p><?php echo Utils::formatMoney($result1['price'])  ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                        } else { ?>

                            <div class="leading-10 px-10 pb-10 opacity-50">không tìm thấy </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            </form>
            <div class="modal-click"></div>
            <div class="w-52 h-14  mr-16">
                <a href="index.php"><img src="<?php echo $r['logo']; ?>" alt="logo-mona-furniture-14" class="w-full h-full"></a>
            </div>
            <div class="flex lg:mr-14 mr-6 ">
                <div class=" relative before:content-[''] before:h-5 before:border-l-2 before:absolute before:right-0 before:border-gray-400 before:translate-y-1 mr-1 lg:block hidden">
                    <?php
                    if (isset($_SESSION['login'])) { ?>
                        <div class="login">
                            <i class="hover:text-amber-600 text-xl mr-3 fa-solid fa-user"></i>
                            <ul class="login-list">
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    <span class="dropdown-item dropdown-header" style="margin-left: 64px;">Lựa Chọn</span>
                                    <div class="dropdown-divider"></div>
                                    <a href="editUser.php" class="hover:text-amber-600" style="display:block;margin:10px 0">
                                        <i class="fa-solid fa-gear mr-3"></i>Chỉnh sửa thông tin
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="cart-detail.php" class="hover:text-amber-600" style="display:block;margin:10px 0">
                                    <i class="fa-solid fa-bag-shopping mr-3"></i>quản lí giỏ hàng
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="?logout=1" class="hover:text-amber-600">
                                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Đăng Xuất
                                    </a>

                                </div>
                            </ul>
                        </div>
                    <?php } else {
                    ?>
                        <a class="hover:text-amber-600 text-lg mr-2 text-zinc-500 login-js" href="login.php">ĐĂNG NHẬP</a>
                    <?php } ?>
                </div>
                <div class="hover:text-amber-600 flex gap-1 product">
                    <a class="hover:text-amber-600 text-lg lg:mr-1 text-zinc-500 lg:block hidden" href="cart.php">GIỎ HÀNG</a>
                    <i class="fa-solid fa-cart-plus lg:text-2xl text-2xl"></i>
                    <!-- giỏ hàng -->
                    <?php if (isset($cart)) { ?>
                        <div class="product_box1">
                            <div class="mb-3">
                                <?php foreach ($result as $productCart) : ?>

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
        <a href="introduce.php">GIỚI THIỆU</a>
    </div>
    <div class="hover:text-amber-600 ">
        <a href="category.php?position=<?php echo "2" ?>">BÀN GHẾ</a>
    </div>
    <div class="hover:text-amber-600 ">
        <a href="category.php?position=<?php echo "3" ?>">BÀN GHẾ SOFA</a>
    </div>
    <div class="hover:text-amber-600 ">
        <a href="category.php?position=<?php echo "1" ?>">KỆ TIVI</a>
    </div>

    <div class="hover:text-amber-600 ">
        <a href="contact.php">LIÊN HỆ</a>
    </div>

</div>