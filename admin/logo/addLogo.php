<?php
$dir = str_replace("admin\logo", "", __DIR__);
require_once $dir . 'dals/productDAL.php';
require_once $dir . 'dals/categoryDAL.php';
$categoryDAL = new categoryDAL();
$result = $categoryDAL->getList();
$productDAL = new productDAL();
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    if (isset($_FILES['image']) && $_FILES['image']['name'] != null) {
        $relativeDir = 'uploads/' . date('m') . '-' . date('y');
        $dirImg = $dir . $relativeDir;
        if (!file_exists($dirImg) && !is_file($dirImg)) {
            mkdir($dirImg);
        }
        $imgName = time() . $_FILES['image']['name'];
        $imgTmp = $_FILES['image']['tmp_name'];
        $image = $dirImg . '/' . $imgName;
        move_uploaded_file($imgTmp, $image);
        $upImage = $relativeDir . '/' . $imgName;
    }
    $productDAL->add($name, $price, $upImage, $description, $category_id);
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
                            <i class="fas fa-chart-pie mr-1"></i> Logo
                        </h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-description p-0">
                            <!-- description -->
                            <form action="" method="post">
                                   
                                    <div class="input-group mb-3">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat">add!</button>
                                    </span>
                                </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
  
        </div>

    </div>
    <!-- /.description-wrapper -->
    <?php require_once $dir . 'admin/commons/footer.php' ?>
</body>

</html>