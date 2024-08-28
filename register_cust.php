<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Customer Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="images/Logo.png" />
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/cr_style.css">
		<script type="text/javascript" src="js/reg_cust.js"></script>
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
		<div class="wrapper" style="background-image: url('images/bgEvents4.jpg');">
			<div class="inner">
				<form method="post" action="" name="register" id="register" autocomplete="off">
					<h3>Registration Form</h3>
					<div class="form-wrapper">
						<input type="text" placeholder="Name" name="cust_name" class="form-control" id="nm" onfocus="name_focus()" onblur="name_blur()" onkeyup="name_keyup()" maxlength="255">
						<i class="zmdi zmdi-account"></i>
                    </div>
                    <div id="namebox" class="box">
                        <span id="error_N" class="error" style="color:red;"></span>
                    </div>
					<div class="form-wrapper">
						<input type="text" placeholder="Email Address" name="cust_email" class="form-control" id="email" onfocus="email_focus()" onblur="email_blur()" onkeyup="email_keyup()" maxlength="255">
                        <i class="zmdi zmdi-email"></i>
					</div>
					<div id="emailbox" class="box">
                        <span id="error_Email" class="error" style="color:red;"></span>
                    </div>
					<div class="form-wrapper">
						<input type="text" placeholder="Phone Number" name="cust_phone" class="form-control" id="phone" onfocus="phone_focus()" onblur="phone_blur()" onkeyup="phone_keyup()" maxlength="12">
						<i class="zmdi zmdi-phone"></i>
					</div>
					<div id="phonebox" class="box">
                        <span id="error_Phone" class="error" style="color:red;"></span>
                    </div>
					<div class="form-wrapper">
						<select name="cust_membership" id="membership" class="form-control" onchange="membership_change()">
							<option value="" disabled selected>Membership</option>
							<option value="1">Personal</option>
							<option value="2">Company</option>
							<option value="0">Other</option>
						</select>
						<i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
					</div>
					<div id="membershipbox" class="box">
                        <span id="error_Membership" class="error" style="color:red;"></span>
                    </div>
					<div class="form-wrapper">
						<input type="password" placeholder="Password" name="cust_pass" id="pass" class="form-control" onfocus="pass_focus()" onblur="pass_blur()" onkeyup="pass_keyup()">
						<a onclick="chk_Pass()"><i class="zmdi zmdi-eye" id="eye_pass"></i></a>
					</div>
					<div id="passbox" class="box">
						<span id="error_Pass" class="error" style="color:red;"></span>
						<span id="uppercase" class="invalid"></span>
						<span id="lowercase" class="invalid"></span>
						<span id="number" class="invalid"></span>
						<span id="symbol" class="invalid"></span>
						<span id="length" class="invalid"></span>
                    </div>
					<div class="form-wrapper">
						<input type="password" placeholder="Confirm Password" name="cust_con_pass" id="con_pass" class="form-control" onfocus="con_pass_focus()" onblur="con_pass_blur()" onkeyup="con_pass_keyup()">
						<a onclick="chkCon_Pass()"><i class="zmdi zmdi-eye" id="eye_con_pass"></i></a>
					</div>
					<div id="conpassbox" class="box">
                        <span id="error_ConPass" class="error" style="color:red;"></span>
                    </div>
                    <input type="button" onclick="check()" value="Register" class="reg_button">
					<input type="button" onclick="window.location.href='index.php';" value="Home" class="home" id="home">
					<input type="submit" id="submit" name="sbmBtn" style="display: none;">
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

if(isset($_POST["sbmBtn"]))
{
    $cust_name= $_POST["cust_name"];
    $cust_email= $_POST["cust_email"];
    $cust_phone= $_POST["cust_phone"];
    $cust_membership= $_POST["cust_membership"];
    $cust_pass= $_POST["cust_pass"];

    $check = "SELECT * from customer WHERE Cust_Email = '$cust_email' and Cust_isDelete = 0";
    $result = mysqli_query($connect, $check);
    
    if(mysqli_num_rows($result)>0)
    {
		$check = "SELECT * from customer WHERE Cust_Email = '$cust_email' and Cust_isDelete = 0 and Cust_isVerify = 1";
		$result = mysqli_query($connect, $check);
		if(mysqli_num_rows($result)>0)
		{
        ?>
		<script>
        swal({
			title: "Email Exists",
			text: "Email already exists, please try again",
			icon: "error",
			button: "Please Retry",
		});
        </script>
        <?php
		}
		else
		{
			?>
			<script>
			swal({
				title: "Verify Your Email",
				text: "Email already registered, please verify it!!!",
				icon: "info",
				button: "Continur",
			}).then(function() {
				location.replace("index.php");
			});
			</script>
			<?php
		}
    }
    else
    {
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
		$CurPageURL = $protocol . $_SERVER['HTTP_HOST'];
		$to_email = $cust_email;
		$subject = "Fiesta Corp: Verify Your Email";
		$from_email= "contact.us.fiesta@gmail.com";
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html;" . "\r\n";
		$headers .= "From: ".$from_email."\r\n".
		  "Reply-To: ".$from_email."\r\n" .
		  "X-Mailer: PHP/" . phpversion();
	  
		  $body = "<html><body>";
		  $body .= "<h3>Dear <span style='text-transform: uppercase';>".$cust_name."</span></h3>".
				  "<p>You have registered your email on our website.<br>".
				  "Please proceed to ".$CurPageURL."/fiesta/verify_email.php?email=".$cust_email." to verify your email.</p>".
				  "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
		  $body .= "</body></html>";
		if (mail($to_email, $subject, $body,$headers)) {
			$sql= "INSERT INTO customer(Cust_Name, Cust_Email, Cust_PhoneNo, Cust_Membership, Cust_Password) VALUES ('$cust_name', '$cust_email', '$cust_phone', '$cust_membership',PASSWORD('$cust_pass'))";
			mysqli_query($connect,$sql);
			?>
			<script>
			swal({
				title: "Success",
				text: "Register Successfully!!!\nPlease Go Verified Your Email.",
				icon: "success",
				button: "Continue",
			}).then(function() {
				location.replace("index.php");
			});
			</script>
			<?php
			exit;
		}
		else {
			?>
			<script>
			  swal({
			title: "Warning",
			text: "Verify Email Sending Failed...\nPlease Register Again.",
			icon: "warning",
			button: "Continue",
			}).then(function() {
				location.replace("register_cust.php");
			});
			</script>
			<?php 
		}
    }
}
?>