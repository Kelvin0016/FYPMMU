<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

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
  </head>
  <body class="goto-here bg-light">
    <?php include "header.php" ?>
  	<?php include "login_check.php" ?>
    <?php include "url_check.php" ?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact</span></p>
            <h1 class="mb-0 bread">Contact Us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	<div class="row d-flex mb-5 contact-info">
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span><br><b>666, Kondominium Siantan Puri, Kampung Lapan, 75200 Melaka, Melaka</b></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span><br><a href="tel://+6018-3864936">+6018-3864936</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span><br><a href="mailto:contact.us@fiesta.com.my">contact.us@fiesta.com.my</a></p>
	          </div>
		  </div>
		  <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
			  <p><span>Facebook:</span><br><b>Fiesta Corp.</b></p>
	          </div>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form method="post" action="" name="contact" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="cont_name" pattern="[a-zA-Z ]*" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email" name="cont_email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject" name="cont_sub" required>
              </div>
              <div class="form-group">
                <textarea name="cont_message" id="cont_message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5" name="sbmBtn">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"><iframe id="map" src="https://maps.google.com/maps?q=666%2C%20Kondominium%20Siantan%20Puri%2C%20Kampung%20Lapan%2C%2075200%20Melaka%2C%20Melaka&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
          </div>
        </div>
      </div>
    </section> 
	<?php include "footer.php" ?>
  

  <!-- loader -->
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
  <script src="js/main.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
<!-- Contact Email Function -->
<?php
if(isset($_POST["sbmBtn"]))
{
  $to_email = "contact.us.fiesta@gmail.com";
  $subject = "Contact Form - Fiesta Corporation; ".$_POST["cont_sub"];
  $from_email= $_POST["cont_email"];
  $headers  = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type: text/html;" . "\r\n";
  $headers .= "From: ".$to_email."\r\n".
    "Reply-To: ".$from_email."\r\n" .
    "X-Mailer: PHP/" . phpversion();

    $body = "<html><body>";
    $body .= "Customer Name :<b>".$_POST["cont_name"].
            "</b><br>Custommer Email :<b>".$from_email.
            "</b><br><br>Custommer Message :<br>".$_POST["cont_message"];
    $body .= "</body></html>";
  if (mail($to_email, $subject, $body,$headers)) {
      echo "<script>            
      swal({
        title: 'Email Sended',
        text: 'Email Send Successfully!',
        icon: 'success',
        button: 'Home',
    }).then(function() {
        location.replace('index.php');
    });</script>";
  } else {
      echo "<script>            
      swal({
        title: 'Email Send Failed,
        text: 'Email Send Failed!',
        icon: 'error',
        button: 'Home',
    }).then(function() {
        location.replace('index.php');
    });</script>";
  }
}
?>