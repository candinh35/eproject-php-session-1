<?php
$dir = str_replace("admin\product", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/products
require_once $dir . 'dals/productDAL.php';
require_once $dir . 'config.php';
require_once $dir . "Utils.php";
$productDAL = new productDAL();
   $resultNum = $productDAL->getList();
    // trả về số sản phẩm có trong giỏ hàng
$number = mysqli_num_rows($resultNum);
//  hàm ceil là làm tròn lên 
$sotrang = ceil($number / 10);
if (isset($_POST['min']) && $_POST['min'] != null) {
    $min = $_POST['min'];
    $max = $_POST['max'];
    // hàm tìm sản phẩm trong column price
    $result = $productDAL->getSearch($min, $max);
} else {
    if (isset($_GET['id']) && $_GET['id'] !== null) {
        $id = $_GET['id'];
        // truyên id sang để lấy vè số bản ghi tương ứng
        $result = $productDAL->paging($id);
    }else{
        $id = 1;
        $result = $productDAL->paging($id);
    }
}


if (isset($_GET['action'])) {
    // hàm xóa
    if (is_numeric($_GET['id']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        $img = $_GET['img'];
        $productDAL->deleteOne($id);
        // lấy đường link của ảnh 
        $checked = $dir . $img;
        // hàm xóa đường link 
        if ($checked) {
            unlink($checked);
        }

        header('location:list.php');
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
                    <form action="" method="post" class="search mt-3">
                                <label for="">min</label>
                                <input type="text" name="min" placeholder="nhap vao gia tim kiem" class="input-search">
                                <label for="">max</label>
                                <input type="text" name="max" placeholder="nhap vao gia tim kiem" class="input-search">

                                <button class="btn btn-dark">tim kiem</button>

                            </form>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- content -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">DataTable List Product</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example2" class="table table-bordered table-hover w-full">
                                            <thead>
                                    <tr>
                                        <th> id</th>
                                        <th>name</th>
                                        <th> price</th>
                                        <th>image</th>
                                        <th>description</th>
                                        <th>category_id</th>
                                        <th colspan="2">lựa chọn</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($result as $row) :
                                ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $row['product_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['product_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo Utils::formatMoney($row['price']); ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo BASE_URL . $row['image']; ?>" alt="" width="100">

                                            </td>
                                            <td>
                                                <?php echo $row['description']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['category_name']; ?>
                                            </td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $row['product_id']; ?>" class="btn btn-primary">sửa</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="?action=delete&id=<?php echo $row['product_id'] ?>&img=<?php echo $row['image']; ?>">xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td>
                                            <a class="btn btn-dark" href="add.php">thêm</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <?php
                                        $i = 1;
                                        while ($i <= $sotrang) { ?>
                                        <div style="width: 100px; list-style:none; display:inline-block">
                                             <li class="page-item <?php if (!$id) {
                                                            $id = 1;
                                                        }
                                                        echo ($id == $i) ? 'active' : ''; ?>"><a style="text-align: center;" class="page-link" href="<?php $dir . 'admin/product/list.php' ?>?id=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        </div>
                               
                            <?php
                                            $i++;
                                        }
                            ?>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
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