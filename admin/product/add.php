<?php
$dir = str_replace("admin\product", "", __DIR__);
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
        $checked = $productDAL->add($name, $price, $upImage, $description, $category_id);
        if ($checked) {
            //flash session
            $_SESSION['add-status'] = [
                'success' => 1,
                'message' => 'add successfully'
            ];
        } else {
            $_SESSION['add-status'] = [
                'success' => 0,
                'message' => 'add failed'
            ];
        }
    } else {
        $_SESSION['add-status'] = [
            'success' => 0,
            'message' => 'vui lòng thêm ảnh cho sản phẩm'
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
                            <i class="fas fa-chart-pie mr-1"></i> Product
                        </h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-description p-0">
                            <!-- description -->
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

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <label for="" class="">Name *</label>
                                </div>
                                <div class="input-group mb-3">

                                    <input type="name" placeholder="name" name="name" class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="" class="">Price *</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="price" name="price">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="" class="">image *</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="" class="">category *</label>
                                </div>
                                <div class="input-group mb-3">


                                    <select class="form-control" name="category_id" value="<?php echo $row['category_id'] ?>">
                                        <?php foreach ($result as $row1) : ?>
                                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- /input-group -->

                                <div class="input-group mb-3">
                                    <label for="" class="">description *</label>
                                </div>
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control" name="description" id="" cols="30" rows="15"></textarea>

                                </div>
                                <span class="input-group-append mt-3">
                                    <button class="btn btn-info btn-flat">add</button>
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