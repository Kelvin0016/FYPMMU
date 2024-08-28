<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/Logo.png" />
	<link rel="stylesheet" type="text/css" href="css/cs_style.css">
	<link rel="stylesheet" type="text/css" href="css/cs_util.css">
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<script type="text/javascript" src="js/login_cust.js"></script>
	<style>
		.swal-title {
			font-size: 30px;
			margin-bottom: 28px;
		}
		.swal-text {
			display: block;
			text-align: center;
			font-size:20px;
			margin-top:20px;
		}
	</style>
</head>
<body>
<?php include "url_check.php" ?>
	<div class="limiter">
	
		<div class="container-login100"  style="background-image: url('images/loginbg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50" >
				<form class="login100-form validate-form" method="post" action="" autocomplete="off" name="login">
					<span class="login100-form-title p-b-33">
						Account Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="log_email" placeholder="Email">
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="log_pass" placeholder="Password" id="pass">
						<a onclick="chk_Pass()"><i class="zmdi zmdi-eye" id="eye_pass"></i></a>
					</div>

					<div class="container-login100-form-btn m-t-20">
					<input type="submit" name="lgnBtn" value="Sign In" class="login100-form-btn">
					<input type="button" onclick="window.location.href='index.php';" value="Home" class="login100-form-btn" style="Margin-top:15px;">
					</div>
					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Forgot
						</span>

						<a href="forgot_pass.php" class="txt2 hov1">
							Username / Password?
						</a>
					</div>

					<div class="text-center">
						<span class="txt1">
							Create an account?
						</span>

						<a href="register_cust.php" class="txt2 hov1">
							Register
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php
include "dataconnection.php";
if(isset($_POST["lgnBtn"]))
{
    $log_email= $_POST["log_email"];
    $log_pass= $_POST["log_pass"];

    $check = "SELECT * from customer WHERE Cust_Email = '$log_email' and Cust_Password = PASSWORD('$log_pass') and Cust_isDelete = 0";
	$result = mysqli_query($connect, $check);
	$count = mysqli_num_rows($result);
    if($count>0)
    {
		$check = "SELECT * from customer WHERE Cust_Email = '$log_email' and Cust_Password = PASSWORD('$log_pass') and Cust_isDelete = 0 and Cust_isVerify = 1";
		$result = mysqli_query($connect, $check);
		$count = mysqli_num_rows($result);
		if($count>0)
		{
			$row = mysqli_fetch_array($result);
			$_SESSION["cust_id"] = $row['Cust_ID'];
			?>
			<script>
			swal({
				title: "Success",
				text: "Login Successfully!!!",
				icon: "success",
				button: "Continue",
			}).then(function() {
				location.replace("index.php");
			});
			</script>
			<?php
			exit;
		}
		else
		{
			?>
			<script>
			swal({
				title: "Verify Your Email",
				text: "Login Failed!\nPlease Verify Your Email!!!",
				icon: "warning",
				button: "Continue",
			}).then(function() {
				location.replace("index.php");
			});
			</script>
			<?php
			exit;
		}
	}
    else
    {
        ?>
        <script>
        swal({
			title: "Failed",
			text: "Login Failed!\nPlease Make Sure You Type Your\nEmail & Password Correctly.",
			icon: "error",
			button: "Please Retype",
		});
        </script>
        <?php
    }
}
?>