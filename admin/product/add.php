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
    $content = $_POST['content'];
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
    $productDAL->add($name, $price, $upImage, $content, $category_id);
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
                        <table border="1" cellpadding= "20" cellspacing = 0>
                            <tr>
                                <td>
                                    <label for="">name</label>
                        <input type="name" placeholder="name" name="name">
                                </td>
                                <td>
                                    <label for="">price</label>
                        <input type="price" placeholder="price" name="price">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <input type="file" name="image">
                        
                                </td>
                                <td>
                                    <label for="">category</label>
                        <select name="category_id">
                            <?php foreach ($result as $row) : ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <label for="">mô tả</label>
                                    </div>
                                    
                                <textarea name="content" id="" cols="90" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn-dark">add</button>
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