<?php
session_start();
require_once 'dals/productDAL.php';
require_once 'dals/logoDAL.php';
require_once 'dals/OrderDAL.php';
require_once 'dals/orderDetailDAL.php';
require_once 'dals/userDAL.php';
require_once 'Utils.php';
$productDAL = new productDAL();
$orderDAL = new OrderDAL();
$order_detail = new orderDetailDAL();
$userDAL = new userDAL();


//  lấy id của user
if (!isset($_SESSION['login'])) {
    header('location:login.php');
}
$idLogin =  $_SESSION['login'][0];
// lấy logo
$logoDAL = new logoDAL();
$logoList = $logoDAL->getList();
$r = mysqli_fetch_assoc($logoList);

$userDAL = new userDAL();

// nếu có dữ liệu gửi lên thì bắt đầu gọi hàm sửa
if (isset($_POST['password'])) {
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    if ($password == null || $phone == null || $address ==  null) {
        $_SESSION['add-status'] = [
          'success' => 0,
          'message' => 'Bạn vui lòng nhập tất cả các mục',
        ];
      } else {
        $userDAL->editUser($idLogin,$password, $phone, $address);
      }
}
$row = $userDAL->getOne($idLogin);
// kiểm tra đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['login']);
    header('location:index.php');
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
            <?php  if (isset($_SESSION['add-status']) && $_SESSION['add-status']['success'] == 0) {
                  echo '<div class="text-2xl text-red-500 text-center mb-6" role="alert">
                    ' . $_SESSION['add-status']['message'] . '
                  </div>';
                  unset($_SESSION['add-status']);
                }
                ?>
        <div class="w-7/12 border-2 mx-auto form-horizontal">
            <form class="form-horizontal1" method="post">
                <div class="card-body1">
                    <div class="form-group1 row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-101">
                            <?php echo $row['email'] ?>
                        </div>
                    </div>
                    <div class="form-group1 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-101">
                            <input type="password" class="form-control1" id="inputPassword3" value="<?php echo $row['password'] ?>" name="password">
                        </div>
                    </div>
                    <div class="form-group1 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">phone</label>
                        <div class="col-sm-101">
                            <input type="text" class="form-control1" id="" value="<?php echo $row['phone'] ?>" name="phone">
                        </div>
                    </div>
                    <div class="form-group1 row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">address</label>
                        <div class="col-sm-101">
                            <input type="text" class="form-control1" id="" value="<?php echo $row['address'] ?>" name="address">
                        </div>
                    </div>
                    <div class="form-group1 row">
                        <div class="offset-sm-2 col-sm-10">

                        </div>
                    </div>
                    <div class="card-footer1">
                        <button  class="btn btn-info">Chỉnh sửa</button>
    
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
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