<?php
session_start();
$dir = str_replace("admin\order", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/orders 
require_once $dir . 'dals/orderDetailDAL.php';
require_once $dir . "config.php";
require_once $dir . "Utils.php";

$orderDetail = new orderDetailDAL();


// kiểm tra đăng nhập

if (!isset($_SESSION['loginAdmin'])) {
    header('location:login.php');
}

if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
    header('location:list.php');
}
$id = $_GET['id'];
$resultNum = $orderDetail->getByOrderId($id);


if (isset($_GET['action'])) {
    if (is_numeric($_GET['id']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        $orderDAL->deleteOne($id);
        $orderDAL->deleteOrderDetail($id);
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
                                            <table id="example2" class="table table-bordered table-hover w-full text-center">
                                                <thead>
                                                    <tr>
                                                        <th> id</th>
                                                        <th> image</th>
                                                        <th>product name</th>
                                                        <th> order_id</th>
                                                        <th> price</th>
                                                        <th> quantity</th>
                                                        <th> sub_total</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                foreach ($resultNum as $row) :
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <?php echo $row['order_detail_id']; ?>
                                                            </td>
                                                            <td>
                                                                <img src="<?php echo BASE_URL . $row['image']; ?>" alt="" width="100">
                                                                
                                                            </td>
                                                            <td>
                                                                <?php echo $row['product_name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['order_id']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo Utils::formatMoney($row['price']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['quantity']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo Utils::formatMoney($row['sub_total']) ; ?>
                                                            </td>
                                                           
                                                        </tr>
                                                    <?php endforeach; ?>
                                                   
                                                    </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
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