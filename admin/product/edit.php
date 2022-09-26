<?php
session_start();
$dir = str_replace("admin\product", "", __DIR__); // đường dẫn tuyệt đối
if ($_GET['id'] && !is_numeric($_GET['id'])) {
    header('Location:list.php');
}

$id = $_GET['id'];
require_once $dir . 'dals/categoryDAL.php';
require_once $dir . 'dals/productDAL.php';

// kết nối tới class category
$categoryDAL = new categoryDAL();
$result = $categoryDAL->getList();

// kết nối tới class product
$productDAL = new productDAL();
$row =  $productDAL->getOne($id);
// kiểm tra xem id có được gửi xang hay không nếu không thì trả về trang trước

// nếu có dữ liệu gửi lên thì bắt đầu gọi hàm sửa
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    if (isset($_FILES['image']) && $_FILES['image']['name'] != null) {
        $relativeDir = 'uploads/' . date('m') . '-' . date('y');
        $newDir = $dir . $relativeDir;
        if (!file_exists($newDir) && !is_file($newDir)) {
            mkdir($newDir);
        }
        $nameImg = time() . $_FILES['image']['name'];
        $nameTMP = $_FILES['image']['tmp_name'];
        $uploadImg =  $newDir . '/' . $nameImg;
        $checked = move_uploaded_file($nameTMP, $uploadImg);
        if ($checked) {
            unlink($dir . $row['image']);
        }
        $image = $relativeDir . '/' . $nameImg;
        $productDAL->edit($id, $name, $price, $description, $image, $category_id);
    }
    $productDAL->edit1($id, $name, $price, $description, $category_id);

    echo $price;
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
                            <i class="fas fa-chart-pie mr-1"></i> User
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
                                        <div class="input-group mb-3">

                                            <input type="name" value="<?php echo $row['name'] ?>" name="name" class="form-control">
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" value="<?php echo $row['price'] ?>" name="price">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="input-group">
                                            <label for="" class="">category</label>

                                            <select class="form-control" name="category_id" value="<?php echo $row['category_id'] ?>">
                                                <?php foreach ($result as $row1) : ?>
                                                    <option value="<?php echo $row1['id'] ?>" <?php if ($row['category_id'] == $row1['id']) {
                                                                                                    echo 'selected ="selected"';
                                                                                                } ?>><?php echo $row1['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- /input-group -->

                                        <label>description</label>
                                        <div class="input-group input-group-sm">
                                            <textarea class="form-control" name="" id="" cols="30" rows="15"><?php echo $row['description'] ?></textarea>

                                        </div> <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat">Go!</button>
                                        </span>
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