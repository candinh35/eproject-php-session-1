<?php 
$dir = __DIR__;
require_once $dir .'/dals/userDAL.php';
$userDAL = new userDAL();

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = md5($_POST['password']);
        $password1 = md5($_POST['password1']);
        if($password != $password1){
            $failed = "mật khẩu không trùng nhau vui lòng nhập lại";
        }else{
            $result = $userDAL->signup($email);
            if(mysqli_num_rows($result) <= 0){
                $userDAL->add($email,$password,$phone,$address);
                $success = "đăng ký tài khoản thành công vui lòng quay lại đăng nhập";
            }else{
                $failed = "Email đã được đăng ký";
            }

        }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/style_layout.css?id=<?php echo time()?>">
    <link rel="stylesheet" href="./../css/compare.css">
    <link rel="stylesheet" href="./../css/fontawesome-free-6.2.0-web/css/all.css">
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
                        <input class="rounded-2xl focus:outline-none w-56 h-8 mt-11 p-4 pb-5 f bg-zinc-200" type="text" name="" placeholder="Tìm kiếm...">
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
                    </ul>
                </div>
            </div>
            <div class="relative left-14 hidden lg:block">
                <input class="rounded-2xl focus:outline-none w-80 h-8  p-4 pb-5 f bg-zinc-200" type="text" name="" placeholder="Tìm kiếm...">
                <i class="absolute right-3 top-2.5 fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="w-52 h-14 lg:mr-0 mr-16">
                <a href="index.html"><img src="./../img/logo/logo-mona-furniture-14.png" alt="logo-mona-furniture-14" class="w-full h-full"></a>
            </div>
            <div class="flex lg:mr-14 mr-6 ">
                <div class="hover:text-amber-600 relative before:content-[''] before:h-5 before:border-l-2 before:absolute before:right-0 before:border-gray-400 before:translate-y-1 mr-1 lg:block hidden">
                    <a class="hover:text-amber-600 text-lg mr-2 text-zinc-500 login-js" href="login.php">ĐĂNG NHẬP</a>

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
    <!-- content -->
    <div>
    <!-- đăng ký -->
    <div class="modal-signup">
        <div class="modal_container-signup js-modal_container-signup">
            <div class="modal_content-signup">
                <div class="notification">
                    <?php if(isset($failed)){
                        echo $failed;
                    }else if(isset($success)){
                        echo $success;
                    } ?>
                </div>
                <header class="modal_header-signup">
                    ĐĂNG KÝ
                </header>
                <form action="" method="post">
                    <div class="modal_body-signup">

                        <label for="" class="modal_label-signup">Tên tài khoản hoặc địa chỉ email *</label>
                        <input required class="modal_input-signup" type="email" name="email" placeholder="Email ...">
                        <label for="" class="modal_label-signup">Mật khẩu *</label>
                        <input required class="modal_input-signup" type="password" name="password" placeholder="Mật Khẩu">
                        <label for="" class="modal_label-signup">Nhập lại mật khẩu *</label>
                        <input required class="modal_input-signup" type="password" name="password1" placeholder="Mật Khẩu">
                        <label for="" class="modal_label-signup">Địa Chỉ *</label>
                        <input required class="modal_input-signup" type="text" name="address" placeholder="Địa Chỉ">
                        <label for="" class="modal_label-signup">Phone *</label>
                        <input required class="modal_input-signup" type="text" name="phone" placeholder="Phone">
                        <button id="signup">ĐĂNG KÝ</button>

                    </div>
                </form>

            </div>
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
                        <img src="./../img/logo/logo-mona-furniture-14.png " alt="logo-mona-furniture-14 " class="w-full h-full ">
                    </div>
                    <p class="text-base mt-6 ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet ....</p>
                    <div class="mt-6 ">
                        <input class="input_info " type="email " name="" placeholder="Email ... ">
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
<script src="./js/main.js "></script>

</html>