<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../logout.php');
}
?>

<?php include '../config.php';

if (isset($_POST['update'])) {
    $id_update = $_SESSION["user_id"];
    $user_name = $_POST['user_name'];
    $user_address = $_POST['user_address'];

    $sql = "UPDATE users SET user_name = '$user_name', user_address = '$user_address' WHERE user_id = '$id_update'";

    $result = $mysqli->query($sql);

    if ($result) {
        $msg = "<script> alert(\"Cập nhật thành công!!\")</script>";
        echo $msg;
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

    <title>User Panel : TVC Store</title>

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
                <a class="navbar-brand" href="sell.php">TVC STORE</a>
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
                        <a href="sell.php"><i class="fa fa-fw fa-dashboard"></i> Bán</a>
                    </li>
                    <li>
                        <a href="myprofile.php"><i class="fa fa-fw fa-dashboard"></i> Hồ sơ</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Hồ sơ của tôi<small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Cập nhật hồ sơ
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row user_profile">
                    <div class="col-lg-6">
                        <br>
                        <?php

                        $id_update = $_SESSION["user_id"];
                        $getselect = $mysqli->query("SELECT * FROM users WHERE user_id = '$id_update'");

                        $product = mysqli_fetch_assoc($getselect);
                        ?>
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php echo $product['user_name']; ?>" class="form-control" id="email" placeholder="Enter Name" name="user_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $product['user_address']; ?>" type="text" class="form-control" id="email" placeholder="Enter Address" name="user_address">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" name="update" value="Cập nhật" class="btn btn-default" />
                                    <a href="myprofile.php" class="btn btn-info">Xem hồ sơ </a>
                                </div>
                            </div>
                        </form>

                        <?php
                        echo "</div>";
                        ?>

                    </div>


                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="../js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../js/bootstrap.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="../js/plugins/morris/raphael.min.js"></script>
            <script src="../js/plugins/morris/morris.min.js"></script>
            <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>