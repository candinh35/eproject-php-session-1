<?php
$dir = str_replace("admin\logo", "", __DIR__);

require_once $dir . 'dals\logoDAL.php';
require_once $dir . 'config.php';
$logoDAL = new logoDAL();
$result = $logoDAL->getList();
if(isset($_GET['action']) ){
$id = $_GET['id'];
$linkImg = $logoDAL->getOne($id);
$logoDAL->deleteOne($id);
if($linkImg){
    $checked = $dir . $linkImg['logo'];
    unlink($checked);
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
            <section class="col-lg-12 connectedSortable ">
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
                            <table border="1" cellpadding = 10>
                    <thead>
                        <th>id</th>
                        <th>logo</th>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row): ?>
                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><img src=" <?php echo BASE_URL . $row['logo']?>" alt="" width="150"></td>
                            <td>
                                <a class="btn btn-danger" href="?action=delete&id=<?php echo $row['id']?>">xoa</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>
                                <a href="addLogo.php">them</a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
        </div>

    </div>
    <!-- /.content-wrapper -->
    <?php require_once $dir . 'admin/commons/footer.php' ?>
</body>

</html>