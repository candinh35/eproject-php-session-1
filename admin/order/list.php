<?php
session_start();
$dir = str_replace("admin\order", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/orders 
require_once $dir . 'dals/orderDAL.php';
require_once $dir . 'dals/orderDetailDAL.php';
require_once $dir . "Utils.php";



$orderDetail = new orderDetailDAL();
$orderDAL = new orderDAL();
$resultNum = $orderDAL->getList();

// kiểm tra đăng nhập

if (!isset($_SESSION['loginAdmin'])) {
    header('location:login.php');
}
// trả về số sản phẩm có table
$number = mysqli_num_rows($resultNum);

//  hàm ceil là làm trò lên 
$sotrang = ceil($number / 10);
if (isset($_POST['name']) && $_POST['name'] != null) {
    $name = $_POST['name'];
    // hàm tìm sản phẩm trong column name
    $result = $orderDAL->getSearch($name);
} else {
    if (isset($_GET['id']) && $_GET['id'] !== null) {
        $id = $_GET['id'];
        // truyên id sang để lấy vè số bản ghi tương ứng
        $result = $orderDAL->paging($id);
    } else {
        $id = 1;
        $result = $orderDAL->paging($id);
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
                            <i class="fas fa-chart-pie mr-1"></i> order
                        </h3>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- content -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">DataTable List order</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example2" class="table table-bordered table-hover w-full">
                                                <thead>
                                                    <tr>
                                                        <th> id</th>
                                                        <th>date_create</th>
                                                        <th> status</th>
                                                        <th> sub_total</th>
                                                        <th> tax</th>
                                                        <th> total</th>
                                                        <th> user_name</th>
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
                                                                <?php echo $row['order_id']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['date_created']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                switch ($row['status']) {
                                                                    case 1:
                                                                        echo "Chờ phản hồi";
                                                                        break;
                                                                    case 2:
                                                                        echo "Đang sử lý";
                                                                        break;
                                                                    case 3:
                                                                        echo "Hủy đơn";
                                                                        break;
                                                                    case 4:
                                                                        echo "Hoàn thành";
                                                                        break;
                                                                };
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo Utils::formatMoney($row['sub_total']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['tax']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo Utils::formatMoney($row['total']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['users_name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['phone']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['address']; ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit.php?id=<?php echo $row['order_id']; ?>" class="btn btn-primary">sửa</a>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-success" href="list-detail.php?id=<?php echo $row['order_id']; ?>">List</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

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
                                    <div class="table table-bordered table-hover w-full mt-3">
                                        <ul>
                                            <li style="font-size:20px ;">Status :</li>
                                            <li>1 là khách vừa đặt đươn hàng</li>
                                            <li>2 là đang vận chuyển</li>
                                            <li>3 là hủy đơn</li>
                                            <li>4 là hoàn thành</li>
                                        </ul>
                                    </div>
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