<?php
session_start();
$dir = str_replace("admin\users", "", __DIR__);
require_once $dir . 'dals/userDAL.php';

// kiểm tra đăng nhập

if (!isset($_SESSION['loginAdmin'])) {
  header('location:login.php');
}

$userDAL = new userDAL();
if ($_GET['id'] && !is_numeric($_GET['id'])) {
  header('Location:list.php');
} // kiểm tra xem có id gửi sang hay không
$id = $_GET['id'];
// nếu có dữ liệu gửi lên thì bắt đầu gọi hàm sửa
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  if ($email == null || $password == null || $phone == null || $address ==  null) {
    $_SESSION['add-status'] = [
      'success' => 0,
      'message' => 'Bạn vui lòng nhập tất cả các mục',
    ];
  } else {
    $userDAL->edit($idLogin, $email, $password, $phone, $address);
  }
}

$row = $userDAL->getOne($id);
?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once $dir . 'admin/commons/head.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php require_once $dir . 'admin/commons/nav.php' ?>
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card content1">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i> User
            </h3>

          </div>
          <!-- /.card-header -->

          <div class="card-body">
            <div class="tab-content p-0">
              <!-- content -->
              <form class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" value="<?php echo $row['email'] ?>" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" value="<?php echo $row['password'] ?>" name="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" value="<?php echo $row['phone'] ?>" name="phone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" value="<?php echo $row['address'] ?>" name="address">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">

                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">add</button>

                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>
    </div>

  </div>
  <!-- /.content-wrapper -->
  <?php require_once $dir . 'admin/commons/footer.php' ?>
</body>

</html>