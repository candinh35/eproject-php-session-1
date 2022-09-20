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
    $content = $_POST['content'];
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
        $productDAL->edit($id, $name, $price, $content, $image, $category_id);
    }
    $productDAL->edit1($id, $name, $price, $content, $category_id);

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
                            <form action="" method="post" enctype="multipart/form-data">
                                <table border="1" cellpadding = 10>

                               
                                <tr>
                                    <td>
                                        <label for="">name</label>
                                        <input type="name" value="<?php echo $row['name'] ?>" name="name">
                                    </td>
                                    <td>
                                        <label for="">price</label>
                                        <input type="price" value="<?php echo $row['price'] ?>" name="price">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="file" name="image" value="<?php echo $row['image'] ?>">

                                    </td>
                                    <td>
                                        <label for="">category</label>
                                        <select name="category_id" value="<?php echo $row['category_id'] ?>">
                                            <?php foreach ($result as $row1) : ?>
                                                <option value="<?php echo $row1['id'] ?>" <?php if ($row['category_id'] == $row1['id']) {echo 'selected ="selected"'; } ?>><?php echo $row1['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea name="content" id="" cols="80" rows="10"><?php echo $row['content'] ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"><button class="btn btn-dark">add</button>

                                    </td>
                                </tr>
                         </table>

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