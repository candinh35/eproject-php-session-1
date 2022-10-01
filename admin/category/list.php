<?php
$dir = str_replace("admin\category", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/users
require_once $dir . 'dals/categoryDAL.php';
require_once $dir . 'dals/productDAL.php';

$categoryDAL = new categoryDAL();
$productDAL = new productDAL();

$resultNum = $categoryDAL->getList();
// trả về số sản phẩm có trong giỏ hàng
$number = mysqli_num_rows($resultNum);
//  hàm ceil là làm trò lên 
$sotrang = ceil($number / 10);
if (isset($_POST['name']) && $_POST['name'] != null) {
    $name = $_POST['name'];
    // hàm tìm sản phẩm trong column name
    $result = $categoryDAL->getSearch($name);
} else {
    if (isset($_GET['idPage']) && $_GET['idPage'] !== null) {
        $id = $_GET['idPage'];
        // truyên id sang để lấy vè số bản ghi tương ứng
        $result = $categoryDAL->paging($id);
    } else {
        $id = 1;
        $result = $categoryDAL->paging($id);
    }
}
if (isset($_GET['action'])) {
    if (is_numeric($_GET['id']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        // tìm xem trong bảng product có id nào của category không
        $checked = $productDAL->checkCate($id);
        if (mysqli_num_rows($checked) <= 0) {
            $categoryDAL->deleteOne($id);
            header('location:list.php');
        } else {
            $_SESSION['add-status'] = [
                'message' => 'Đang có sản phẩm không thể xóa',
            ];
        }
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
                            <i class="fas fa-chart-pie mr-1"></i> Category
                        </h3>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content p-0">
                            <?php if (isset($_SESSION['add-status'])) {
                                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['add-status']['message'] . '</div>';
                            }  ?>
                            <!-- content -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Table Category</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover w-full mb-3">
                                        <thead>
                                            <tr>
                                                <th> id</th>
                                                <th>name</th>
                                                <th>position</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($result as $row) :
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['position']; ?>
                                                    </td>

                                                    <td>
                                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">sửa</a>
                                                        <a class="btn btn-danger" href="?action=delete&id=<?php echo $row['id']; ?>">xóa</a>
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
                                    <?php
                                    $i = 1;
                                    while ($i <= $sotrang) { ?>
                                        <div style="width: 100px; list-style:none; display:inline-block">
                                            <li class="page-item <?php if (!$id) {
                                                                        $id = 1;
                                                                    }
                                                                    echo ($id == $i) ? 'active' : ''; ?>"><a style="text-align: center;" class="page-link" href="<?php $dir . 'admin/product/list.php' ?>?idPage=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        </div>

                                    <?php
                                        $i++;
                                    }
                                    ?>
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