<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel='shortcut icon' href='../images/Logo.png' />
	<link rel="stylesheet" href="css/site.css">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
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
	<script>
	function chk_Pass() {
    var x = document.getElementById("pass");
    var y = document.getElementById("eye_pass");
    if (x.type === "password") {
        x.type = "text";
    } 
    else {
        x.type = "password";
    }
    if(y.className==="zmdi zmdi-eye"){
        y.className="zmdi zmdi-eye-off"
    }
    else{
        y.className="zmdi zmdi-eye"
    }
}
	</script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" method="post" action="" autocomplete="off" name="login">
					<span class="login100-form-title p-b-33">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password" id="pass">
						<a onclick="chk_Pass()"><i class="zmdi zmdi-eye" id="eye_pass"></i></a>
					</div>

					<div class="container-login100-form-btn m-t-20">
					<input type="submit" name="lgnBtn" value="Sign In" class="login100-form-btn">
					</div>

					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Forgot
						</span>

						<a href="forgot-pass.php" class="txt2 hov1">
							Username / Password?
						</a>
					</div>

					<!-- <div class="text-center">
						<span class="txt1">
							Create an account?
						</span>

						<a href="#" class="txt2 hov1">
							Sign up
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="vendor/animsition/js/animsition.min.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/bootstrap/js/popper.js"></script> -->
	<!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/select2/select2.min.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/daterangepicker/moment.min.js"></script> -->
	<!-- <script src="vendor/daterangepicker/daterangepicker.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/countdowntime/countdowntime.js"></script> -->
<!--===============================================================================================-->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>
</body>
</html>

<?php
include "dataconnection.php";
if(isset($_POST["lgnBtn"]))
{
    $email= $_POST["email"];
    $pass= $_POST["pass"];

	//search superuser and admin table to see what login acc is used
	$check = "SELECT * from admin WHERE Adm_Email = '$email' and Adm_Password = PASSWORD('$pass') and Adm_isDelete = 0";
	$check2 = "SELECT * from superuser WHERE Super_Email = '$email' and Super_Password = PASSWORD('$pass')";
	$result = mysqli_query($connect, $check);
	$result2 = mysqli_query($connect,$check2);
	$row = mysqli_fetch_array($result);
	$row2 = mysqli_fetch_array($result2);
	$count = mysqli_num_rows($result);
	$count2 = mysqli_num_rows($result2);
    if($count>0 || $count2>0)
    {
		if($count!=0){
			$_SESSION["admin_id"] = $row['Adm_ID'];
			
		}else if($count2!=0){
			$_SESSION["super_id"] = $row2['Super_ID'];
		}

		?>
			<script>
			swal({
				title: "Success",
				text: "Login Successfully!!!",
				icon: "success",
				button: "Continue",
			}).then(function() {
				location.replace("dashboard.php");
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