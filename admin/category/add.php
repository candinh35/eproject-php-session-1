<?php
$dir = str_replace("admin\category", "", __DIR__);
require_once $dir . 'dals/categoryDAL.php';
$userDAL = new categoryDAL();

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    if ($name == null) {
        $_SESSION['add-status'] = [
            'success' => 0,
            'message' => 'Bạn vui lòng nhập name',
        ];
    } else {
        $userDAL->add($name, $position);
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
            <section class="col-lg-12 connectedSortable">
                <div class="card content1">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i> Category
                        </h3>
                    </div>
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
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Add Category</h3>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once $dir . 'admin/commons/footer.php' ?>
</body>

</html>