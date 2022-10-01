<?php
session_start();
$dir = str_replace("admin\order", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/orders 
require_once $dir . 'dals/orderDAL.php';

// kiểm tra đăng nhập

if (!isset($_SESSION['loginAdmin'])) {
    header('location:login.php');
}
$orderDAL = new orderDAL();

if ($_GET['id'] && !is_numeric($_GET['id'])) {
    header('Location:list.php');
}

$id = $_GET['id'];
$row = $orderDAL->getOne($id);
if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $checked = $orderDAL->edit($id , $status);
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
                            <i class="fas fa-chart-pie mr-1"></i> order
                        </h3>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content p-0">
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
                            <!-- content -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">DataTable List order</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                       
                                            <form action="" method="post">
                                                <div class="input-group mb-3">
                                                    <label for="" class="">status</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                <select name="status" id="" class="text-center">
                                                    <option value="1">chờ</option>
                                                    <option value="2">đang giao</option>
                                                    <option value="3">hủy</option>
                                                    <option value="4">hoàn thành</option>
                                                </select>
                                                    <!-- <input type="name" value="<?php // echo $row['status'] ?>" name="status" class="form-control"> -->
                                                </div>
                                                <button class="btn btn-info btn-flat">edit</button>
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




        </div>

    </div>
    <!-- /.content-wrapper -->
    <?php require_once $dir . 'admin/commons/footer.php' ?>
</body>

</html>