<?php session_start(); ?>

<?php

include 'config.php';

$error_message = "";

if (isset($_POST['login'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$strSQL = mysqli_query($mysqli, "select * from users where user_name = '$user' and  user_pass ='$pass'");

	if ($strSQL == TRUE) {
		$Results = mysqli_fetch_array($strSQL);

		if ($Results != null && count($Results) >= 1) {
			$_SESSION['user'] = $Results["user_name"];
			$_SESSION["user_id"] = $Results["user_id"];
			if ($Results["user_type"] == "employee")
				echo '<script type="text/javascript"> window.open("employee/sell.php","_self");</script>';
			else
				echo '<script type="text/javascript"> window.open("admin/dashboard.php","_self");</script>';
		} else {
			$error_message = "Tên đăng nhập hoặc mật khẩu không đúng!";
		}
	}
}


?>

<html>

<head>
	<title>TVC Store : Login </title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/sb-admin.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="css/plugins/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- My CSS -->
	<link href="style.css" rel="stylesheet">
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="login">
				` <div class="logo">
					<img src="images/logo.png">
				</div>
				<div class="form-login">

					<h4>Welcome Back</h4>
					<?php if ($error_message != ""): ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $error_message; ?>
						</div>
					<?php endif; ?>
					<form action="" method="post">
						<input type="text" name="user" id="userName" class="form-control input-sm chat-input" placeholder="User ID" />
						</br>
						<input type="password" name="pass" id="userPassword" class="form-control input-sm chat-input" placeholder="Password" />
						</br>
						<div class="wrapper">
							<span class="group-btn">
								<input class="btn btn-default" type="submit" name="login" value="LOGIN" /><i class="fa fa-sign-in"></i>
							</span>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>

</body>

</html>