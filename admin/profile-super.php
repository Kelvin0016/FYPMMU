<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
		<title>Profile</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' href='../images/Logo.png' />
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" type="text/css" href="css/animated.css">
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
		<link type="text/css" rel="stylesheet" href="css/profile.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <body>
      <?php 
        include 'dataconnection.php';
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
        {
            $user_id = $_SESSION['admin_id'];
            include 'sidebar-admin.php';
        }
        else if(isset($_SESSION['super_id']) && !empty($_SESSION['super_id']))
        {
            $user_id = $_SESSION['super_id'];
            include 'sidebar-super.php';
        }
        ?>
      <section class="user-profile">
			<div class="container pg-content" style="background:rgba(255,255,255,0.7);">
				<div class="row" >
					<div class="col-md-12">
						<div class="profile-body">
							<div class="tab-content" id="myTabContent">
								<!-- Profile Information -->
								<div class="tab-pane fade show active" id="view-profile" role="tabpanel" aria-labelledby="view-profile-tab">
									<div class="generalTitle title-line" style="padding-top:10px"><h2>Profile</h2></div>
									<div class="user-info">
										<div class="form-group" style="color:black;"><p class="label" >Name</p><p><?php echo $row['Super_Name']?></p></div>
										<div class="form-group" style="color:black;"><p class="label">Email</p><p><?php echo $row['Super_Email']?></p></div>
										<div class="form-group" style="color:black;"><p class="label">Phone</p><p><?php echo $row['Super_PhoneNo']?></p></div>
										<div class="form-group" style="color:black;"><p class="label">Staff ID</p><p><?php echo $row['Super_Staff_ID']?></p></div>
									</div>
									
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link btn-switch" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile">Edit</a>
										</li>
									</ul>
								</div>
								<!-- Edit Profile Information -->
								<div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
									<div class="generalTitle title-line"><h2>Edit Profile</h2></div>
									<div class="edit-user-info">
										<form class="form-submit" id="edit-profile" method="post" name="edit_profile" enctype="multipart/form-data">
											<div class="form-group" id="user-name">
												<input type="text" name="user-name" class="" placeholder="Name" value="<?php echo $row['Super_Name']?>" id="nm" onfocus="name_focus()" onblur="name_blur()" onkeyup="name_keyup()" maxlength="255">
											<div id="namebox" class="box">
                        						<span id="error_N" class="error" style="color:red; position:relative;"></span>
                    						</div>
											</div>
											
											<div class="form-group" id="user-email">
												<input type="email" name="user-email" class="" placeholder="Email" value="<?php echo $row['Super_Email']?>" id="email" onfocus="email_focus()" onblur="email_blur()" onkeyup="email_keyup()" maxlength="255">
												<div id="emailbox" class="box">
													<span id="error_Email" class="error" style="color:red; position:relative;"></span>
												</div>
											</div>
											<div class="form-group" id="user-phone">
												<input type="text" name="user-phone" class="" placeholder="Phone Number" value="<?php echo $row['Super_PhoneNo']?>" id="phone" onfocus="phone_focus()" onblur="phone_blur()" onkeyup="phone_keyup()" maxlength="12">
												<div id="phonebox" class="box">
													<span id="error_Phone" class="error" style="color:red; position:relative;"></span>
												</div>
                                            </div>
                                            <div class="form-group" id="user-staff-id">
												<input type="text" name="user-staff-id" class="" placeholder="Staff ID" value="<?php echo $row['Super_Staff_ID']?>" id="staffid">
											</div>
											<input type="hidden" name="formID" value="1" />
									
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
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/site.js"></script>
		<script type="text/javascript" src="js/profile.js"></script>
        <script>
          $(document).ready(function(){
            $(".profile").addClass("active");
          });
        </script>
    </body>
</html>

<?php
	if(isset($_POST["formID"]) && $_POST["formID"] == 1)
	{
		$new_name = $_POST["user-name"];
		$new_email = $_POST["user-email"];
		$new_phone = $_POST["user-phone"];
		$new_staff_id = $_POST["user-staff-id"];
		$check = "SELECT * from superuser WHERE Super_ID != '$user_id' and Super_Email = '$new_email'";
		$result = mysqli_query($connect, $check);
		$check2 = "SELECT * from superuser WHERE Super_ID != '$user_id' and Super_Staff_ID = '$new_staff_id'";
		$result2 = mysqli_query($connect, $check2);
		$sql= "UPDATE superuser SET Super_Name = '$new_name', Super_Email = '$new_email', Super_PhoneNo = '$new_phone' WHERE Super_ID='$user_id'";
    
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
			if(mysqli_num_rows($result2)>0)
			{
				?>
				<script>
				swal({
					title: "Staff ID Exists",
					text: "Staff ID already exists, please try again",
					icon: "error",
					button: "Please Retry",
				});
				</script>
				<?php
			}
			else
			{
				if(mysqli_query($connect,$sql))
				{
					?>
					<script>
					swal({
						title: "Success",
						text: "Updated Successfully!!!",
						icon: "success",
						button: "Continue",
					}).then(function() {
						location.replace("profile-super.php");
					});
					</script>
					<?php
				exit;
				}
			}
		}
	}
	if(isset($_POST["formID"]) && $_POST["formID"] == 2)
	{
		$cur_pass= $_POST["current-password"];
		$new_pass = $_POST["new-password"];
		$result = mysqli_query($connect, "SELECT * FROM superuser WHERE Super_ID='$user_id' and Super_Password = PASSWORD('$cur_pass')");
		$count = mysqli_num_rows($result);
		if($count==0)
		{
			?>
			<script>
				swal({
					title: "Wrong Password",
					text: "Your Have Enter Wrong Password!!!",
					icon: "error",
					button: "Continue",
				}).then(function() {
					location.replace("profile-super.php");
				});
			</script>
			<?php
			exit;
		}
		else
		{
			$result = mysqli_query($connect, "SELECT * FROM superuser WHERE Super_ID='$user_id' and Super_Password = PASSWORD('$new_pass')");
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
						location.replace("profile-super.php");
					});
				</script>
				<?php
				exit;
			}
			else
			{
				$sql = "UPDATE superuser SET Super_Password = PASSWORD('$new_pass') WHERE Super_ID='$user_id'";
				mysqli_query($connect,$sql);
				?>
				<script>
					swal({
						title: "Success",
						text: "Your Password Have Been Change Successfully!!!",
						icon: "success",
						button: "Continue",
					}).then(function() {
						location.replace("profile-super.php");
					});
				</script>
				<?php
				exit;
			}
		}
	}
?>    