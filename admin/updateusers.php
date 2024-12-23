<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../logout.php');
}
?>

<?php include '../config.php';

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
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Thêm thông tin</a>
                    </li>
                    <li class="active">
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
                            Cập nhật nhân viên
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-edit"></i> Cập nhật thông tin nhân viên
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">

                    <div class="col-lg-12">

                        <?php
                        $var = 0;
                        $getselect = $mysqli->query("SELECT * FROM users Where user_type = 'employee'");
                        echo "<table class=\"table table-condensed\" ><tr><th>ID</th><th>Tên</th><th>Loại</th><th>Mật khẩu</th><th>Địa chỉ</th><th>Cập nhật</th></tr>";
                        while ($product = mysqli_fetch_assoc($getselect)) {
                            $var++;
                        ?>
                            <tr>
                                <form method="get" action="single_profile_update.php">

                                    <td><?php echo $var . "  . " . $product['user_id']; ?></td>
                                    <td><?php echo $product['user_name']; ?></td>
                                    <td><?php echo $product['user_type']; ?></td>

                                    <td><?php echo $product['user_pass']; ?></td>
                                    <td><?php echo $product['user_address']; ?></td>

                                    <input type="hidden" name="id_update" value="<?php echo $product['user_id']; ?>" />
                                    <td><input type="submit" class="btn btn-primary" name="update" value="Cập nhật" /></td>
                                </form>
                            <tr>

                            <?php }
                        echo "</div>";
                            ?>


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