<?php 
session_start();
$dir = str_replace("admin\users", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/users 
require_once $dir . 'dals/userDAL.php';

// kiểm tra đăng nhập

if(!isset($_SESSION['loginAdmin'])){
    header('location:login.php');
}
$userDAL = new userDAL();
$resultNum = $userDAL->getList();
// trả về số sản phẩm có trong giỏ hàng
$number = mysqli_num_rows($resultNum);
//  hàm ceil là làm trò lên 
$sotrang = ceil($number / 10);
if (isset($_POST['name']) && $_POST['name'] != null) {
$name = $_POST['name'];
// hàm tìm sản phẩm trong column name
$result = $userDAL->getSearch($name);
} else {
if (isset($_GET['id']) && $_GET['id'] !== null) {
    $id = $_GET['id'];
    // truyên id sang để lấy vè số bản ghi tương ứng
    $result = $userDAL->paging($id);
}else{
    $id = 1;
    $result = $userDAL->paging($id);
}
}
if (isset($_GET['action'])) {
    if (is_numeric($_GET['id']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        $userDAL->deleteOne($id);
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
                            <i class="fas fa-chart-pie mr-1"></i> User
                        </h3>

                    </div>
                    <!-- /.card-header -->
                    <form action="" method="post" class="search">
                        <label for="">nhập số điện thoại</label>
                        <input type="text" name="min" placeholder="nhap vao số điện thoại tim kiem" class="form-control mb-3">

                        <button class="btn btn-dark">tim kiem</button>

                    </form>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- content -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">DataTable List User</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example2" class="table table-bordered table-hover w-full">
                                                <thead>
                                                    <tr>
                                                        <th> id</th>
                                                        <th>email</th>
                                                        <th> password</th>
                                                        <th> phone</th>
                                                        <th> address</th>
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
                                                                <?php echo $row['email']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['password']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['phone']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['address']; ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">sửa</a>
                                                                <a class="btn btn-danger" href="?action=delete&id=<?php echo $row['id']; ?>">xóa</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td>
                                                            <a href="add.php">thêm</a>
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