<?php session_start();
if (!isset($_SESSION['user_id'])) {
  header('location:../logout.php');
}
?>

<?php include '../config.php';

if (isset($_POST['submit'])) {

  $user_name = $_POST['user_name'];
  $user_id = $_POST['user_id'];
  $user_pass = $_POST['user_pass'];
  $user_address = $_POST['user_address'];
  $user_type = $_POST['user_type'];

  $sql = "INSERT INTO users (user_name , user_id , user_pass , user_address , user_type)
                  VALUES ('$user_name', '$user_id', '$user_pass', '$user_address', '$user_type');";

  if ($mysqli->query($sql) === TRUE) {
    echo "<script>alert(\"Thêm nhân viên thành công!!!\");</script>";
  } else {
    echo "<script>alert(\"Xảy ra lỗi khi thêm nhân viên!\");</script>";
  }
}

if (isset($_POST['submit2'])) {

  $product_name = $_POST['product_name'];
  $product_code = $_POST['product_code'];
  $product_price = $_POST['product_price'];
  $products_available = $_POST['products_available'];
  $products_supplier = $_POST['products_supplier'];

  $sql = "INSERT INTO products (product_name, product_code , price,products_available,products_supplier)
                  VALUES ('$product_name', '$product_code', '$product_price', '$products_available', '$products_supplier');";

  if ($mysqli->query($sql) === TRUE) {
    echo "<script>alert(\"Thêm sản phẩm thành công!!!\");</script>";
  } else {
    echo "<script>alert(\"Xảy ra lỗi khi thêm sản phẩm!\");</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Panel : TVC Store</title>

  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="../css/plugins/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- My CSS -->
  <link href="../style.css" rel="stylesheet">

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="dashboard.php">TVC STORE</a>
      </div>
      <!-- Top Menu Items -->
      <ul class="nav navbar-right top-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["user"] ?><b class="caret"></b></a>
          <ul class="dropdown-menu">

            <li>
              <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Đăng xuất</a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
          <li>
            <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Tổng quan</a>
          </li>
          <li class="active">
            <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Thêm thông tin</a>
          </li>
          <li>
            <a href="updateusers.php"><i class="fa fa-fw fa-edit"></i> Cập nhật nhân viên</a>
          </li>
          <li>
            <a href="updateproducts.php"><i class="fa fa-fw fa-edit"></i> Cập nhật sản phẩm</a>
          </li>

        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Thêm thông tin
            </h1>
            <ol class="breadcrumb">
              <li class="active">
                <i class="fa fa-edit"></i> Thêm mới
              </li>
            </ol>
          </div>
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-lg-6">
            <h2>Thêm nhân viên</h2>
            <br>
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Tên</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" placeholder="Nhâp tên" name="user_name">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Id</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pwd" placeholder="Nhập ID" name="user_id">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Mật khẩu</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="email" placeholder="Nhập mật khẩu" name="user_pass">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Địa chỉ</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" placeholder="Nhập địa chỉ" name="user_address">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Loại</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" value="employee" name="user_type" readonly>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="submit" value="Thêm" class="btn btn-default" />
                </div>
              </div>
            </form>

          </div>
          <!-- /.container-fluid -->

        </div>

        <div class="row">

          <div class="col-lg-6">
            <h2>Thêm sản phẩm</h2>
            <br>
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Tên</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" placeholder="Nhập tên" name="product_name">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pwd" placeholder="Nhập Code" name="product_code">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Giá</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="email" placeholder="Nhập giá" name="product_price">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Số lượng</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" placeholder="Nhập số lượng" name="products_available">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Nhà cung cấp</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" placeholder="Nhập nhà cung cấp" name="products_supplier">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="submit2" value="Thêm" class="btn btn-default" />
                </div>
              </div>
            </form>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

      </div>

    </div>
    <!-- /#wrapper -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>