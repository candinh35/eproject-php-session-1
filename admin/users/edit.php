<?php
session_start();
$dir = str_replace("admin\users", "", __DIR__);
require_once $dir . 'dals/userDAL.php';
$userDAL = new userDAL();
if ($_GET['id'] && !is_numeric($_GET['id'])) {
    header('Location:list.php');
} // kiểm tra xem có id gửi sang hay không
$id = $_GET['id'];
// nếu có dữ liệu gửi lên thì bắt đầu gọi hàm sửa
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $userDAL->edit($id, $email, $password);
}
$row = $userDAL->getOne($id);
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
                            <form action="" method="post">
                        <label for="">Email</label>
                        <input type="email" value="<?php echo $row['email'] ?>" name="email">
                        <label for="">Password</label>
                        <input type="password" value="<?php echo $row['password'] ?>" name="password">
                        <button class="btn btn-dark">edit</button>
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