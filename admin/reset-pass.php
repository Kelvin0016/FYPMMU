<?php
  session_start();
  include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
  <link type="text/css" href="css/reset.css" rel="stylesheet" id="bootstrap-css">
  <link rel="shortcut icon" href="../images/Logo.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="js/reset_pass_check.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="container-fluid" style="background-image: url('../images/reset_pass_bg.jpg');">
	<div class="row">
		<div class="wrap p-l-55 p-r-55 p-t-65 p-b-50">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-unlock fa-4x"></i></h3>
                  <h2 class="text-center">Reset Password</h2>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                        <label id="label_pass">New Password</label>
                        <div class="form-group pass_show">
                            <input type="password" placeholder="New Password" name="new_cust_pass" id="pass" class="form-control" onfocus="pass_focus()" onblur="pass_blur()" onkeyup="pass_keyup()">
                        </div>
                        <div id="passbox" class="box">
                          <span id="error_Pass" class="error" style="color:red;"></span>
                          <span id="uppercase" class="invalid"></span>
                          <span id="lowercase" class="invalid"></span>
                          <span id="number" class="invalid"></span>
                          <span id="symbol" class="invalid"></span>
                          <span id="length" class="invalid"></span>
                        </div>
                        <label id="label_con_pass">Confirm Password</label>
                        <div class="form-group pass_show"> 
                          <input type="password" placeholder="Confirm Password" name="new_cust_con_pass" id="con_pass" class="form-control" onfocus="con_pass_focus()" onblur="con_pass_blur()" onkeyup="con_pass_keyup()">
                        </div>
                        <div id="conpassbox" class="box">
                            <span id="error_ConPass" class="error" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="button" id="sbmbtn" onclick="check()">
                            <input type="submit" id="submit" name="sbmBtn" style="display: none;">
                        </div>
                      
                        <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
        </div>
	</div>
</div>
</body>
</html>

<?php
include "dataconnection.php";

if(isset($_POST["sbmBtn"]))
{
  $pass= $_POST["new_cust_pass"];
  $key = $_GET["ei"];
  //get data from different database based on the id gotten from then link
  if(isset($_GET["sid"])){
    $user_id = $_GET["sid"];
    $userid = DecryptThis($user_id,$key);
    $result = mysqli_query($connect, "SELECT * FROM superuser WHERE Super_ID='$userid' and Super_Password = PASSWORD('$pass');");
    $count = mysqli_num_rows($result);
  }else if(isset($_GET["id"])){
    $user_id = $_GET["id"];
    $userid = DecryptThis($user_id,$key);
    $result = mysqli_query($connect, "SELECT * FROM admin WHERE Adm_ID='$userid' and Adm_Password = PASSWORD('$pass') and Adm_isDelete = 0;");
    $count = mysqli_num_rows($result);
  }
  //check if the new password is same as old one or not
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
    		location.replace("login.php");
		});
    </script>
    <?php
    exit;
  }
  else
  {
    //save to different table based on the id
    if(isset($_GET["sid"])){
      $sql = "UPDATE superuser SET Super_Password = PASSWORD('$pass') WHERE Super_ID='$userid'";
    }else if(isset($_GET["id"])){
      $sql = "UPDATE admin SET Adm_Password = PASSWORD('$pass') WHERE Adm_ID='$userid' and Adm_isDelete = 0";
    }
    
    if(mysqli_query($connect,$sql)){
      ?>
    <script>
        swal({
        title: "Reset Success",
        text: "Your Password Have Been Reset Successfully!",
        icon: "success",
        button: "Continue",
      }).then(function() {
          location.replace("login.php");
      });
      </script>
      <?php
    }else{
      ?>
      <script>
          swal({
        title: "Reset Failed",
        text: "Failed to reset password!",
        icon: "error",
        button: "Continue",
      }).then(function() {
          location.replace("login.php");
      });
      </script>
      <?php
    }
    exit;
  }
  
}

function DecryptThis($CipherData,$decryption_key) {
  // Store the cipher method 
$ciphering = "AES-128-CTR"; 
  
// Use OpenSSl Encryption method 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
// Non-NULL Initialization Vector for decryption 
$decryption_iv = '1234567891011121'; 
  
// Store the decryption key 

  
// Use openssl_decrypt() function to decrypt the data 
$decryption=openssl_decrypt ($CipherData, $ciphering,$decryption_key, $options, $decryption_iv); 
return $decryption;
}
?>