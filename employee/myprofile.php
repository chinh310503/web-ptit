<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../logout.php');
}
?>

<?php include '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Employee Panel : TVC Store</title>

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
                        <a href="sell.php"><i class="fa fa-fw fa-dashboard"></i> Bán </a>
                    </li>
                    <li class="active">
                        <a href="myprofile.php"><i class="fa fa-fw fa-dashboard"></i> Hồ sơ </a>
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
                            Hồ sơ của tôi <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Hồ sơ
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row user_profile">

                    <?php

                    $id = $_SESSION["user_id"];
                    $getselect = $mysqli->query("SELECT * FROM users WHERE user_id = '$id'");

                    $product = mysqli_fetch_assoc($getselect);

                    ?>

                    <div class="span2">
                        <img src="../images/employee.png" alt="" class="img-rounded">
                    </div>
                    <div class="span4">
                        <blockquote>
                            <p><?php echo $product['user_name']; ?></p>
                            <small><cite title="Source Title"><?php echo $product['user_type']; ?><i class="icon-map-marker"></i></cite></small>
                        </blockquote>
                        <table>

                            <tr>
                                <td>
                                    <p><b>ID </b> :</p>
                                </td>
                                <td>
                                    <p> <?php echo $product['user_id']; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Địa chỉ </b> :</p>
                                </td>
                                <td>
                                    <p> <?php echo $product['user_address']; ?></p>
                                </td>
                            </tr>

                        </table>

                        <?php

                        $getselect = $mysqli->query("SELECT count(purchase_id) as t FROM total_purchase WHERE user_id = '$id'");

                        $product = mysqli_fetch_assoc($getselect);

                        ?>
                        <button type="button" class="btn btn-success"><?php echo "Đơn hàng bán được : " . $product['t']; ?></button>
                    </div>
                </div>
                <div class="row button_update">
                    <form class="form-inline" action="updateprofile.php">
                        <button type="submit" class="btn btn-default">Cập nhật hồ sơ</button>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->

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