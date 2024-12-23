<?php session_start();
if (!isset($_SESSION['user_id'])) {
	header('location:../logout.php');
}
?>

<?php include '../config.php';

if (isset($_POST['payment'])) {
	$grand_total = $_POST["grand_total"];

	echo '<script type="text/javascript">alert("Thanh toán thành công");</script>';
	$employee_id = $_SESSION["user_id"];
	$purchase_sql = "insert into total_purchase (purchase_total,user_id) values ('$grand_total' ,'$employee_id') ";
	if ($mysqli->query($purchase_sql) === TRUE) {
		$last_id = mysqli_insert_id($mysqli);

		foreach ($_SESSION["cart_products"] as $cart_itm) {
			$code = $cart_itm["product_code"];
			$q = $cart_itm["product_qty"];

			$findsql = "select products_available from products where product_code = '$code' ";
			$result = $mysqli->query($findsql);
			$row = $result->fetch_assoc();

			$available = $row["products_available"];
			echo  $available;

			$updatesql = "update products set products_available='$available' - '$q' where product_code = '$code' ";
			$mysqli->query($updatesql);
		}
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
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
							Giỏ hàng <small></small>
						</h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-dashboard"></i> Giỏ hàng
							</li>
						</ol>
					</div>
				</div>


				<?php
				if (isset($_SESSION["cart_products"])) //check session var
				{
				?>
					<div class="row checkout">
						<div class="cart-view-table-back">
							<form method="post" action="cart_update.php">
								<table width="100%" cellpadding="6" cellspacing="0">
									<thead>
										<tr>
											<th>Số lượng</th>
											<th>Tên</th>
											<th>Giá</th>
											<th>Tổng tiền</th>
											<!-- <th>Remove</th> -->
										</tr>
									</thead>
									<tbody>
										<?php

										$total = 0; //set initial total value
										$b = 0;

										foreach ($_SESSION["cart_products"] as $cart_itm) {
											//set variables to use in content below
											$product_name = $cart_itm["product_name"];
											$product_qty = $cart_itm["product_qty"];
											$product_price = $cart_itm["product_price"];
											$product_code = $cart_itm["product_code"];
											$subtotal = ($product_price * $product_qty);

											echo '<tr>';
											echo '<td><span>' . $product_qty . '</span></td>';
											echo '<td>' . $product_name . '</td>';
											echo '<td>' . $product_price . '</td>';
											echo '<td>' . $subtotal . '</td>';
											echo '</tr>';
											$total = ($total + $subtotal);
										}

										?>
										<tr>
											<td colspan="5"><span style="float:right;text-align: right;">Tổng tiền thanh toán : <?php if (isset($_SESSION["cart_products"])) echo sprintf("%01.2f", $total); ?></span></td>
										</tr>

									</tbody>
								</table>
								<input type="hidden" name="return_url" value="<?php
																				$current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
																				echo $current_url; ?>" />
							</form>
						</div>
					</div>

					<div class="row finalize_payment">

						<div class="col-lg-12">
							<div class="payment">
								<form method="post" class="payment_form form-inline">
									<div class="form-group">
										<input type="hidden" name="grand_total" value="<?php echo $total; ?>" />
										<input type="submit" class="btn btn-default" name="payment" value="Thanh toán">
									</div>
								</form>
							</div>
						</div>
					</div>
			</div>

		</div>

	</div>

<?php
				} else {
					echo "<div class=\"alert alert-info\">";
					echo "<center><strong>Ops! </strong> Giỏ hàng trống. Hãy đến <a href=\"sell.php\"> mua hàng</a></center>";
					echo "</div>";
				}
?>


<!-- /.container-fluid -->

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