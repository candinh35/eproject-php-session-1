<?php
session_start();
$dir = str_replace("admin\category", "", __DIR__);
require_once $dir . 'dals/categoryDAL.php';
$userDAL = new categoryDAL();
if ($_GET['id'] && !is_numeric($_GET['id'])) {
    header('Location:list.php');
} // kiểm tra xem có id gửi sang hay không
$id = $_GET['id'];
// nếu có dữ liệu gửi lên thì bắt đầu gọi hàm sửa
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $checked = $userDAL->edit($id, $name, $position);
    if ($checked) {
        //flash session
        $_SESSION['add-status'] = [
            'success' => 1,
            'message' => 'Edit successfully'
        ];
    } else {
        $_SESSION['add-status'] = [
            'success' => 0,
            'message' => 'Edit failed'
        ];
    }
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
                            <?php
                            if (isset($_SESSION['add-status'])) {
                                if ($_SESSION['add-status']['success'] == 1) {
                                    echo '<div class="alert alert-success" role="alert">
                    ' . $_SESSION['add-status']['message'] . '
                  </div>';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">
                    ' . $_SESSION['add-status']['message'] . '
                  </div>';
                                }
                                unset($_SESSION['add-status']);
                            }
                            ?>
                            <form action="" method="post">
                                <label for="">name</label>
                                <div class="col-sm-10 mb-3">
                                    <input type="text" class="form-control" id="inputEmail3" value="<?php echo $row['name'] ?>" name="name">
                                </div>
                                <label for="">position</label>
                                <div class="col-sm-10 mb-3">
                                    <input type="text" class="form-control" id="inputEmail3" value="<?php echo $row['position'] ?>" name="position">
                                </div>
                                <button class="btn btn-info">edit</button>

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