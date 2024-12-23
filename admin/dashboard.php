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
                    <li class="active">
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Tổng quan</a>
                    </li>
                    <li>
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tổng quan <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Thống kê mua hàng</h2>
                        <div class="table-responsive purchase">

                            <?php

                            $sql = "SELECT * FROM  total_purchase";
                            $result = $mysqli->query($sql);

                            echo  "<table class=\"table table-bordered table-hover\">";
                            echo  "<thead><tr><th>Id</th><th>Ngày mua</th><th>Tổng giá trị</th><th>Nhân viên bán hàng</th></tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["purchase_id"] . "</td>";
                                echo "<td>" . $row["purchase_date"] . "</td>";
                                echo "<td>" . $row["purchase_total"] . "</td>";

                            ?>
                                <form method="get" action="user_profile.php">

                                    <td> <input type="submit" name="id_update" value="<?php echo $row['user_id']; ?>" /></td>

                                </form>
                                </tr>

                            <?php
                            }
                            ?>

                            </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h2>Sản phẩm</h2>
                        <div class="table-responsive">
                            <?php

                            $sql = "SELECT * FROM  products";
                            $result = $mysqli->query($sql);

                            echo  "<table class=\"table table-bordered table-hover table-striped\">";
                            echo  "<thead><tr><th>Id</th><th>Code</th><th>Tên</th><th>Giá</th><th>Số lượng</th><th>Nhà cung cấp</th></tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["product_code"] . "</td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                if ($row["products_available"] == 0)
                                    echo "<td style=\"background-color:red;color:white\" >" . $row["products_available"] . "</td>";
                                else
                                    echo "<td>" . $row["products_available"] . "</td>";

                                if ($row["products_supplier"] == "")
                                    echo "<td>Not Available</td>";
                                else
                                    echo "<td>" . $row["products_supplier"] . "</td>";

                                echo "</tr>";
                            }


                            ?>

                            </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <h2>Nhân viên</h2>
                        <div class="table-responsive">
                            <?php

                            $var = 0;
                            $getselect = $mysqli->query("SELECT * FROM users where user_type = 'employee'");
                            echo "<table class=\"table table-bordered table-hover table-striped\" ><thead><tr><th>No</th><th>ID</th><th>Tên</th><th>Loại</th><th>Mật khẩu</th><th>Địa chỉ</th></tr></thead><tbody>";
                            while ($product = mysqli_fetch_assoc($getselect)) {
                                $var++;
                            ?>

                                <tr>
                                    <td><?php echo $var; ?></td>
                                    <form method="get" action="user_profile.php">

                                        <td> <input type="submit" name="id_update" value="<?php echo $product['user_id']; ?>" /></td>

                                    </form>
                                    <td><?php echo $product['user_name']; ?></td>
                                    <td><?php echo $product['user_type']; ?></td>
                                    <td><?php echo $product['user_pass']; ?></td>
                                    <td><?php echo $product['user_address']; ?></td>

                                </tr>
                            <?php

                            }

                            ?>

                            </tbody>
                            </table>

                        </div>
                    </div>
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

        <script src="../js/script.js"></script>
</body>

</html>