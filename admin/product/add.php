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
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
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
                                    <label for="">mô tả</label>
                                <textarea name="content" id="" cols="30" rows="10"></textarea>
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
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- Map card -->
                <div class="card bg-gradient-primary">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i> Visitors
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                <i class="far fa-calendar-alt"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%;"></div>
                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->

                <!-- solid sales graph -->
                <div class="card bg-gradient-info">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i> Sales Graph
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                                <div class="text-white">Mail-Orders</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                                <div class="text-white">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                                <div class="text-white">In-Store</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->



        </div>

    </div>
    <!-- /.content-wrapper -->
    <?php require_once $dir . 'admin/commons/footer.php' ?>
</body>

</html>