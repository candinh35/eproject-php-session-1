<?php
session_start();
$dir = str_replace("admin\users", "", __DIR__);  // hàm str_replace là hàm tha đổi giá trị đoạn chuỗi, mhư ở đây cắt phần admin/users
require_once $dir .'/dals/userDAL.php';
$userDAL = new userDAL();
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $result = $userDAL->login($email,$password);
        $data = $result -> fetch_row();
        if(mysqli_num_rows($result) > 0){
            $_SESSION['loginAdmin'] = $data;
            header('location:list.php');
        }else{
            $failed = "tài khoản hoặc mật khâu không chính xác vui lòng nhập lại!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once $dir . 'admin/commons/head.php' ?>
</head>

<body class="">
    <div class="wrapper">

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card content1 loginAdmin">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i> Admin
                        </h3>

                    </div>
                    <!-- /.card-header -->

                    <div class="card card-info login-form">
              <div class="card-header">
             
                <h3 class="card-title">Login Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal " method="post">
              <div class="notification text-center mt-3">
                    <?php if(isset($success)){
                    echo $success;
                }else if(isset($failed)){
                    echo $failed;
                } ?>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Sign in</button>
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
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