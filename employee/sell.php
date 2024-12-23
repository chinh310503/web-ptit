<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../logout.php');
}
?>

<?php include '../config.php';

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

if (isset($_POST["type"]) && $_POST["type"] == 'add') {

    if ($_POST["product_qty"] <= $_POST["available"]) {
        foreach ($_POST as $key => $value) { //add all post vars to new_product array
            $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        //remove unecessary vars
        unset($new_product['type']);
        unset($new_product['return_url']);

        //we need to get product name and price from database.
        $statement = $mysqli->prepare("SELECT product_name, price FROM products WHERE product_code=? LIMIT 1");
        $statement->bind_param('s', $new_product['product_code']);
        $statement->execute();
        $statement->bind_result($product_name, $price);

        while ($statement->fetch()) {

            //fetch product name, price from db and add to new_product array
            $new_product["product_name"] = $product_name;
            $new_product["product_price"] = $price;

            if (isset($_SESSION["cart_products"])) {  //if session var already exist
                if (isset($_SESSION["cart_products"][$new_product['product_code']])) //check item exist in products array
                {
                    unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
                }
            }
            $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
        }
    } else if ($_POST["product_qty"] > $_POST["available"]) {

        echo "Không còn đủ!  <b>" . $_POST["available"] . "</b> Available!";
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
                <a class="navbar-brand" href="sell.php">TVC STORE</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["user"] ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Đăng xuất </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="sell.php"><i class="fa fa-fw fa-dashboard"></i> Bán </a>
                    </li>
                    <li>
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
                            Bán hàng <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Trang bán hàng
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row products">

                    <?php
                    if (isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"]) > 0) {
                        echo '<div class="cart-view-table-front" id="view-cart">';
                        echo '<h3>Giỏ Hàng</h3>';
                        echo '<form method="post" action="cart_update.php">';
                        echo '<table width="100%"  cellpadding="6" cellspacing="0">';
                        echo '<tbody>';

                        $total = 0;
                        $b = 0;
                        foreach ($_SESSION["cart_products"] as $cart_itm) {
                            $product_name = $cart_itm["product_name"];
                            $product_qty = $cart_itm["product_qty"];
                            $product_price = $cart_itm["product_price"];
                            $product_code = $cart_itm["product_code"];

                            $bg_color = ($b++ % 2 == 1) ? 'odd' : 'even';
                            echo '<tr class="' . $bg_color . '">';
                            echo '<td> SL <input type="text" size="2" maxlength="2" name="product_qty[' . $product_code . ']" value="' . $product_qty . '" /></td>';
                            echo '<td>' . $product_name . '</td>';
                            echo '<td><input type="checkbox" name="remove_code[]" value="' . $product_code . '" /> Xóa</td>';
                            echo '</tr>';
                            $subtotal = ($product_price * $product_qty);
                            $total = ($total + $subtotal);
                        }
                        echo '<td colspan="4">';
                        echo '<a href="view_cart.php" class="button" style="display: inline-block; padding: 1.5px 6px; background-color: #F0F0F0; color: Black; text-align: center; text-decoration: none; border: 0.5px solid #787878;">Tổng tiền</a>';
                        echo '<button type="submit">Cập nhật</button>';
                        echo '</td>';
                        echo '</tbody>';
                        echo '</table>';

                        $current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                        echo '<input type="hidden" name="return_url" value="' . $current_url . '" />';
                        echo '</form>';
                        echo '</div>';
                    }
                    ?>
                    <!-- View Cart Box End -->

                    <div class="form-group" style="margin-top: 24px">
                        <div class="input-group">
                            <span class="input-group-addon">Tìm kiếm</span>
                            <input type="text" name="search_text" id="search_text" placeholder="Tìm kiếm theo tên" class="form-control" />
                        </div>
                    </div>

                </div>

                <!-- Products List End -->
                <div class="row">
                    <h3>Danh sách sản phẩm</h3>
                    <div id="result2"></div>
                </div>


            </div>

        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>
<script>
    $(document).ready(function() {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result2').html(data);
                }
            });
        }
        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script>