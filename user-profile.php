<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Profile</title>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
	<link rel="shortcut icon" href="images/Logo.png" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
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
		<link type="text/css" rel="stylesheet" href="css/user-profile.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>

	<body class="user-page goto-here"  style="
        background-image: url('images/user_profile_bg.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed; 
        background-size: cover;
      ">
	<?php include "header.php" ?>
	<?php include "login_check.php" ?>
	<?php include "url_check.php" ?>
		<section class="user-profile">
			<div class="container" style="background:rgba(255,255,255,0.7);">
				<div class="row" >
					<div class="col-md-12">
						<div class="profile-body">
							<div class="tab-content" id="myTabContent">
								<!-- Profile Information -->
								<?php
									$cust_id = $_SESSION["cust_id"];
									$sql = "SELECT * from customer WHERE Cust_isDelete!=1 and Cust_ID = '$cust_id'";
									$result = mysqli_query($connect, $sql);
									$row =mysqli_fetch_assoc($result);
									$membership =$row['Cust_Membership'];
									if($membership == 1)
									{
										$member = "Personal";
									}
									else if($membership == 2)
									{
										$member = "Company";
									}
									else if($membership == 0)
									{
										$member = "Other";
									}
								?>
								<div class="tab-pane fade show active" id="view-profile" role="tabpanel" aria-labelledby="view-profile-tab">
									<div class="generalTitle title-line"><h2>Profile</h2></div>
									<div class="user-info">
										<div class="form-group" style="color:black;"><p class="label" >Name</p><p><?php echo $row['Cust_Name']?></p></div>
										<div class="form-group" style="color:black;"><p class="label">Email</p><p><?php echo $row['Cust_Email']?></p></div>
										<div class="form-group" style="color:black;"><p class="label">Phone</p><p><?php echo $row['Cust_PhoneNo']?></p></div>
										<div class="form-group" style="color:black;"><p class="label">Membership</p><p><?php echo $member?></p></div>
									</div>
									
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link btn-switch" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile">Edit</a>
										</li>
										<li class="nav-item" role="presentation">
										<a class="nav-link btn-cancel" onclick="checkDel()" style="cursor: pointer;">Delete Account</a>
										</li>
									</ul>

								</div>
								<!-- Edit Profile Information -->
								<div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
									<div class="generalTitle title-line"><h2>Edit Profile</h2></div>
									<div class="edit-user-info">
										<form class="form-submit" id="edit-profile" method="post" name="edit_profile" >
											<div class="form-group" id="user-name">
												<input type="text" name="user-name" class="" placeholder="Name" value="<?php echo $row['Cust_Name']?>" id="nm" onfocus="name_focus()" onblur="name_blur()" onkeyup="name_keyup()" maxlength="255">
											<div id="namebox" class="box">
                        						<span id="error_N" class="error" style="color:red; position:relative;"></span>
                    						</div>
											</div>
											
											<div class="form-group" id="user-email">
												<input type="email" name="user-email" class="" placeholder="Email" value="<?php echo $row['Cust_Email']?>" id="email" onfocus="email_focus()" onblur="email_blur()" onkeyup="email_keyup()" maxlength="255">
												<div id="emailbox" class="box">
													<span id="error_Email" class="error" style="color:red; position:relative;"></span>
												</div>
											</div>
											<div class="form-group" id="user-phone">
												<input type="text" name="user-phone" class="" placeholder="Phone Number" value="<?php echo $row['Cust_PhoneNo']?>" id="phone" onfocus="phone_focus()" onblur="phone_blur()" onkeyup="phone_keyup()" maxlength="12">
												<div id="phonebox" class="box">
													<span id="error_Phone" class="error" style="color:red; position:relative;"></span>
												</div>
											</div>
											<div class="form-group" id="user-membership">
												<select name="cust_membership" id="membership" class="membership-input" onchange="membership_change()">
													<option id="mem" value="" disabled selected>Membership</option>
													<option id="1" value="1">Personal</option>
													<option id="2" value="2">Company</option>
													<option id="0" value="0">Other</option>
												</select>
												<div id="membershipbox" class="box">
													<span id="error_Membership" class="error" style="color:red; position:relative"></span>
												</div>
											</div>
											<input type="hidden" name="formID" value="1" />
											<?php
												if($membership == 1)
												{
													?>
													<script>
														document.getElementById("1").selected = "true";
													</script>
													<?php
												}
												else if($membership == 2)
												{
													?>
													<script>
														document.getElementById("2").selected = "true";
													</script>
													<?php
												}
												else if($membership == 0)
												{
													?>
													<script>
														document.getElementById("0").selected = "true";
													</script>
													<?php
												}
											?>
									
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link btn-save" onclick="check()">Save</a>
										</li>
										<li class="nav-item" role="presentation">
											<a class="nav-link btn-cancel" id="view-profile-tab" data-toggle="tab" href="#view-profile" role="tab" aria-controls="view-profile">Cancel</a>
										</li>
										<li class="nav-item" role="presentation">
											<a class="nav-link btn-switch" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-controls="change-password">Change Password</a>
										</li>
									</ul>
									</form>
									</div>
								</div>
								<!-- Change Password -->
								<div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
									<div class="generalTitle title-line"><h2>Change Password</h2></div>
									
									<div class="edit-user-info">
										<form class="form-submit" id="change-password" method="post" name="edit_pass">
											<div class="form-group" id="current-password">
												<input type="password" name="current-password" id="cur_pass" class="" placeholder="Current Password" onfocus="cur_pass_focus()" onblur="cur_pass_blur()" onkeyup="cur_pass_keyup()">
												<a onclick="chkCur_Pass()"><i class="zmdi zmdi-eye" id="eye_cur_pass"></i></a>
											</div>
											<div id="curpassbox" class="box">
												<span id="error_CurPass" class="error" style="color:red; position:relative;"></span>
											</div>
											<div class="form-group" id="new-password">
												<input type="password" name="new-password" id="pass" class="" placeholder="New Password" onfocus="pass_focus()" onblur="pass_blur()" onkeyup="pass_keyup()">
												<a onclick="chk_Pass()"><i class="zmdi zmdi-eye" id="eye_pass"></i></a>
											</div>
											<div id="passbox" class="box">
													<span id="error_Pass" class="error" style="color:red; position:relative;"></span>
													<span id="uppercase" class="invalid"></span>
													<span id="lowercase" class="invalid"></span>
													<span id="number" class="invalid"></span>
													<span id="symbol" class="invalid"></span>
													<span id="length" class="invalid"></span>
											</div>
											<div class="form-group" id="confirm-password">
												<input type="password" name="confirm-password" id="con_pass" class="" placeholder="Confirm Password" onfocus="con_pass_focus()" onblur="con_pass_blur()" onkeyup="con_pass_keyup()">
												<a onclick="chkCon_Pass()"><i class="zmdi zmdi-eye" id="eye_con_pass"></i></a>
											</div>
											<div id="conpassbox" class="box">
												<span id="error_ConPass" class="error" style="color:red; position:relative;"></span>
											</div>
											<input type="hidden" name="formID" value="2" />
											<ul class="nav nav-tabs" id="" role="tablist">
												<li class="nav-item" role="presentation">
													<a class="nav-link btn-save" onclick="PassSub()">Update</a>
												</li>
												<li class="nav-item" role="presentation">
													<a class="nav-link btn-cancel" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile">Cancel</a>
												</li>
											</ul>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</body>
	<?php include "footer.php" ?>
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
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		
		<script type="text/javascript" src="js/user-profile.js"></script>
		<script>
			function checkDel()
			{
				<?php
					$sql = "SELECT * FROM book where Book_Cust_ID = '$cust_id' and Book_Status = 0";
					$result = mysqli_query($connect,$sql);
					$num_rows = mysqli_num_rows($result);
				?>
				var staPend = <?php echo $num_rows;?>;
				if(staPend > 0)
				{
					swal({
						title: "Cannot Delete",
						text: "You still have booking is On Pending\nSo cannot delete account.",
						icon: "error",
						button: "Close",
					});
				}
				else
				{
					<?php
					$today = date("Y-m-d");
					$sql = "SELECT * FROM book where Book_Cust_ID = '$cust_id' and Book_Status = 1 and Book_Event_Date > '$today'";
					$result = mysqli_query($connect,$sql);
					$num_rows = mysqli_num_rows($result);
					?>
					var staAccept = <?php echo $num_rows;?>;
					if(staAccept > 0)
					{
						swal({
							title: "Cannot Delete",
							text: "You have booking is ACCEPTED\n(Haven't Pass Event Date)\nSo cannot delete account.",
							icon: "error",
							button: "Close",
						});
					}
					else
					{
						location.replace("delete_acc.php");
					}
				}
			}
		</script>
</html>

<?php
	if(isset($_POST["formID"]) && $_POST["formID"] == 1)
	{
		$new_cust_name = $_POST["user-name"];
		$new_cust_email = $_POST["user-email"];
		$new_cust_phone = $_POST["user-phone"];
		$new_cust_membership = $_POST["cust_membership"];

		$check = "SELECT * from customer WHERE Cust_ID != '$cust_id' and Cust_Email = '$new_cust_email' and Cust_isDelete = 0";
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
			$check = "SELECT * from customer WHERE Cust_ID = '$cust_id' and Cust_Email != '$new_cust_email' and Cust_isDelete = 0";
			$result = mysqli_query($connect, $check);
			if(mysqli_num_rows($result)>0)
			{
				$csql = "SELECT * from customer WHERE Cust_ID = '$cust_id' and Cust_isDelete = 0";
				$cresult = mysqli_query($connect, $csql);
				$crow = mysqli_fetch_assoc($cresult);
				$old_cust_email = $crow['Cust_Email'];
				$to_email = $old_cust_email;
				$subject = "Fiesta Corp: Change Email";
				$from_email= "contact.us.fiesta@gmail.com";
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html;" . "\r\n";
				$headers .= "From: ".$from_email."\r\n".
				  "Reply-To: ".$from_email."\r\n" .
				  "X-Mailer: PHP/" . phpversion();
			  
				  $body = "<html><body>";
				  $body .= "<h3>Dear <span style='text-transform: uppercase';>".$crow['Cust_Name']."</span></h3>".
						  "<p>You have change your email on our website.<br>".
						  "<p>Please go verify yput new email.<br>".
						  "<p>If you didn't do this action please contact with us.</p>".
						  "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
				  $body .= "</body></html>";
				mail($to_email, $subject, $body,$headers);
				$sql= "UPDATE customer SET Cust_Name = '$new_cust_name', Cust_Email = '$new_cust_email', Cust_PhoneNo = '$new_cust_phone', Cust_Membership = '$new_cust_membership', Cust_isVerify = 0 WHERE Cust_ID='$cust_id'";
				mysqli_query($connect,$sql);
				$csql = "SELECT * from customer WHERE Cust_ID = '$cust_id' and Cust_isDelete = 0";
				$cresult = mysqli_query($connect, $csql);
				$crow = mysqli_fetch_assoc($cresult);
				$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
				$CurPageURL = $protocol . $_SERVER['HTTP_HOST'];
				$to_email = $new_cust_email;
				$subject = "Fiesta Corp: Verify Your New Email";
				$from_email= "contact.us.fiesta@gmail.com";
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html;" . "\r\n";
				$headers .= "From: ".$from_email."\r\n".
				  "Reply-To: ".$from_email."\r\n" .
				  "X-Mailer: PHP/" . phpversion();
			  
				  $body = "<html><body>";
				  $body .= "<h3>Dear <span style='text-transform: uppercase';>".$crow['Cust_Name']."</span></h3>".
						  "<p>You have change your email on our website.<br>".
						  "Please proceed to ".$CurPageURL."/fiesta/verify_email.php?email=".$new_cust_email." to verify your new email.</p>".
						  "<p>If you didn't do this action please contact with us.</p>".
						  "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
				  $body .= "</body></html>";
				if (mail($to_email, $subject, $body,$headers)) {
					?>
					<script>
					swal({
						title: "Success",
						text: "Updated Successfully!!!\nPlease Go Verify Your New Email.",
						icon: "success",
						button: "Continue",
					}).then(function() {
						location.replace("logout.php");
					});
					</script>
					<?php
				}

			}
			else
			{
				$sql= "UPDATE customer SET Cust_Name = '$new_cust_name', Cust_Email = '$new_cust_email', Cust_PhoneNo = '$new_cust_phone', Cust_Membership = '$new_cust_membership' WHERE Cust_ID='$cust_id'";
				mysqli_query($connect,$sql);
				?>
				<script>
				swal({
					title: "Success",
					text: "Updated Successfully!!!",
					icon: "success",
					button: "Continue",
				}).then(function() {
					location.replace("user-profile.php");
				});
				</script>
				<?php
				exit;
			}
		}
	}
	if(isset($_POST["formID"]) && $_POST["formID"] == 2)
	{
		$cur_pass= $_POST["current-password"];
		$new_pass = $_POST["new-password"];
		$result = mysqli_query($connect, "SELECT * FROM customer WHERE Cust_ID='$cust_id' and Cust_Password = PASSWORD('$cur_pass') and Cust_isDelete = 0");
		$count = mysqli_num_rows($result);
		if($count==0)
		{
			?>
			<script>
				swal({
					title: "Wrong Password Enter",
					text: "Your Have Enter Wrong Password!!!",
					icon: "error",
					button: "Continue",
				}).then(function() {
					location.replace("user-profile.php");
				});
			</script>
			<?php
			exit;
		}
		else
		{
			$result = mysqli_query($connect, "SELECT * FROM customer WHERE Cust_ID='$cust_id' and Cust_Password = PASSWORD('$new_pass') and Cust_isDelete = 0");
			$count = mysqli_num_rows($result);
			if($count>0)
			{
				?>
				<script>
					swal({
						title: "Password Same",
						text: "Your New Password Is Same As Before!!!",
						icon: "warning",
						button: "Continue",
					}).then(function() {
						location.replace("user-profile.php");
					});
				</script>
				<?php
				exit;
			}
			else
			{
				$sql = "UPDATE customer SET Cust_Password = PASSWORD('$new_pass') WHERE Cust_ID='$cust_id' and Cust_isDelete = 0";
				mysqli_query($connect,$sql);
				?>
				<script>
					swal({
						title: "Success",
						text: "Your Password Have Been Change Successfully!!!",
						icon: "success",
						button: "Continue",
					}).then(function() {
						location.replace("user-profile.php");
					});
				</script>
				<?php
				exit;
			}
		}
	}
?>                                                    