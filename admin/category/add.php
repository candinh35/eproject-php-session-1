<?php
$dir = str_replace("admin\category", "", __DIR__);
require_once $dir . 'dals/categoryDAL.php';
$userDAL = new categoryDAL();
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $userDAL->add($name, $possition);
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
                            <i class="fas fa-chart-pie mr-1"></i> Category
                        </h3>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- content -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Input Addon</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <label for="">name</label>
                                        <div class="col-sm-10 mb-3">
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="name" name="name">
                                        </div>
                                        <label for="">position</label>
                                        <div class="col-sm-10 mb-3">
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="position" name="position">
                                        </div>
                                        <button class="btn btn-info">add</button>
                                    </form>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.card-body -->
                            </div>

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