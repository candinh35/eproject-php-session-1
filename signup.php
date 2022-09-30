<?php
session_start();
require_once  'dals/userDAL.php';
require_once  'dals/logoDAL.php';
require_once 'Utils.php';
require_once 'dals/productDAL.php';

$userDAL = new userDAL();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = md5($_POST['password']);
    $password1 = md5($_POST['password1']);
    if ($email != null || $phone != null || $address != null) {
        if ($password != $password1) {
            $failed = "mật khẩu không trùng nhau vui lòng nhập lại";
        } else {
            $result = $userDAL->signup($email);
            if (mysqli_num_rows($result) <= 0) {
                $userDAL->add($email, $password, $phone, $address);
                $success = "đăng ký tài khoản thành công vui lòng quay lại đăng nhập";
            } else {
                $failed = "Email đã được đăng ký";
            }
        }
    }else{
        $failed = "Vui lòng nhập các mục quan trọng";
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
        <!-- đăng ký -->
        <div class="modal-signup">
            <div class="modal_container-signup js-modal_container-signup">
                <div class="modal_content-signup  lg:w-full w-64">
                    <div class="notification">
                        <?php if (isset($failed)) {
                            echo $failed;
                        } else if (isset($success)) {
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
        <?php require_once "path/footer.php" ?>

    </footer>

</body>
<script src="./js/main.js "></script>

</html>