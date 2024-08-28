<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgot Password</title>
  <link type="text/css" href="css/forgot_pass.css" rel="stylesheet" id="bootstrap-css">
  <link rel="shortcut icon" href="images/Logo.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
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
<?php include "url_check.php" ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="container-fluid" style="background-image: url('images/fg_pass_back.jpg');">
	<div class="row">
		<div class="wrap p-l-55 p-r-55 p-t-65 p-b-50">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="forget_email" placeholder="email address" class="form-control"  type="email" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
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
if(isset($_POST["recover-submit"]))
{
  $forget_email = $_POST["forget_email"];
  $check = "SELECT * from customer WHERE Cust_Email = '$forget_email' and Cust_isDelete = 0";
  $result = mysqli_query($connect, $check);

  if(mysqli_num_rows($result)>0)
  {
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
    $CurPageURL = $protocol . $_SERVER['HTTP_HOST'];
    $row = mysqli_fetch_assoc($result);
    $string = $row['Cust_ID'];
    $encryption_key = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,12);
    $cust_id = EncryptThis($string,$encryption_key);
    $to_email = $_POST["forget_email"];
    $subject = "No-Reply; Password Reset";
    $from_email= "contact.us.fiesta@gmail.com";
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html;" . "\r\n";
    $headers .= "From: ".$from_email."\r\n".
      "Reply-To: ".$to_email."\r\n" .
      "X-Mailer: PHP/" . phpversion();
  
      $body = "<html><body>";
      $body .= "<h3>Dear <span style='text-transform: uppercase';>".$row['Cust_Name']."</span></h3>".
              "<p>We have received your request to reset your password.<br>".
              "Please proceed to ".$CurPageURL."/fiesta/reset_pass.php?id=".$cust_id."&ei=".$encryption_key." to reset your password.</p>".
              "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
      $body .= "</body></html>";
    if (mail($to_email, $subject, $body,$headers)) {
        ?>
        <script>
          swal({
        title: "Success",
        text: "Reset Password Email Have Sended!",
        icon: "success",
        button: "Continue",
        }).then(function() {
            location.replace("index.php");
        });
        </script>
        <?php
        exit;
    } else {
        ?>
        <script>
          swal({
        title: "Warning",
        text: "Email Sending Failed...",
        icon: "warning",
        button: "Continue",
        }).then(function() {
            location.replace("index.php");
        });
        </script>
        <?php 
    }
  }
  else
  {
      ?>
      <script>
        swal({
			title: "Error",
			text: "Email Not Registered!!!",
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
function EncryptThis($ClearTextData,$encryption_key) {
  $ciphering = "AES-128-CTR"; 
  
  // Use OpenSSl Encryption method 
  $iv_length = openssl_cipher_iv_length($ciphering); 
  $options = 0; 
    
  // Non-NULL Initialization Vector for encryption 
  $encryption_iv = '1234567891011121'; 

  // Use openssl_encrypt() function to encrypt the data 
  $encryption = openssl_encrypt($ClearTextData, $ciphering, $encryption_key, $options, $encryption_iv); 
  return $encryption;
}
?>