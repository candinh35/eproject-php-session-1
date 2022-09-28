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
        $checkImg = move_uploaded_file($nameTMP, $uploadImg);
        if ($checkImg) {
            unlink($dir . $row['image']);
        }
        $image = $relativeDir . '/' . $nameImg;
        $checked = $productDAL->edit($id, $name, $price, $description, $image, $category_id);
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
   $checked = $productDAL->edit1($id, $name, $price, $description, $category_id);
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
                            <i class="fas fa-chart-pie mr-1"></i> Product
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
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Input Addon</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="input-group mb-3">
                                            <label for="" class="">Name</label>
                                        </div>
                                        <div class="input-group mb-3">

                                            <input type="name" value="<?php echo $row['name'] ?>" name="name" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label for="" class="">Price</label>
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
                                            <label for="" class="">image</label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label for="" class="">Category</label>
                                        </div>

                                        <div class="input-group">


                                            <select class="form-control" name="category_id" value="<?php echo $row['category_id'] ?>">
                                                <?php foreach ($result as $row1) : ?>
                                                    <option value="<?php echo $row1['id'] ?>" <?php if ($row['category_id'] == $row1['id']) {
                                                                                                    echo 'selected ="selected"';
                                                                                                } ?>><?php echo $row1['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- /input-group -->

                                        <div class="input-group mb-3">
                                            <label for="" class="">Description</label>
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <textarea class="form-control" name="description" id="" cols="30" rows="15"><?php echo $row['description'] ?></textarea>

                                        </div> <span class="input-group-append">
                                            <button  class="btn btn-info btn-flat">Go!</button>
                                        </span>
                                    </form>
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