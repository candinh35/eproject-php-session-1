<?php 
session_start();
require_once 'dals/userDAL.php';
require_once 'dals/productDAL.php';
require_once 'Utils.php';
require_once 'dals/logoDAL.php';


$userDAL = new userDAL();
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $result = $userDAL->login($email,$password);
        $data = $result -> fetch_row();
        if(mysqli_num_rows($result) > 0){
            $_SESSION['login'] = $data;
            header('location:index.php');
        }else{
            $failed = "tài khoản hoặc mật khâu không chính xác vui lòng nhập lại!";
        }
    }

    //kết nối tới bảng product
$productDAL = new productDAL();

// kiểm tra session  cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $cart = $_SESSION['cart'];
    $order = array();
    $order = implode(",", array_keys($cart));
    // lấy ra các product có id lưu trong cart
    $result = $productDAL->getOrder($order);
}

// lấy logo
$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);
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
   <div>
   <div class="modal">
        <div class="modal_container js-modal_container">
            <div class="modal_content lg:w-full w-64">
                <div class="notification">
                    <?php if(isset($success)){
                    echo $success;
                }else if(isset($failed)){
                    echo $failed;
                } ?>
                </div>
                
                <header class="modal_header">
                    ĐĂNG NHẬP
                </header>
                <form action="" method="post">
                    <div class="modal_body">

                        <label for="" class="modal_label">Tên tài khoản hoặc địa chỉ email *</label>
                        <input required class="modal_input" type="email" placeholder="Email ..." name="email">
                        <label for="" class="modal_label">Mật khẩu *</label>
                        <input required class="modal_input" type="password" placeholder="Mật Khẩu" name="password">
                        <button id="login">ĐĂNG NHẬP</button>
                        <div class="lg:inline hidden mt-3">
                            <input type="checkbox" class="modal_check">
                            <label for="">Ghi nhớ mật khẩu</label>
                        </div>
                        

                    </div>
                    <footer class="lg:flex block justify-between">
                        <a class="modal_footer" href="">Quên mật khẩu?</a>
                        <a href="signup.php" class="modal_signup">Bạn chưa có tài khoản ?</a>
                </form>

            </div>
        </div>

    </div>

   </div>
    <!-- FOOTER -->
    <footer class="footer">
    <?php require_once "path/footer.php" ?>
    </footer>
   
</body>
<script src="./js/main.js "></script>

</html>