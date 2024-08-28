<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rate Us</title>
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
    <link rel="stylesheet" type="text/css" href="css/rate.css">
    <script src="js/feedback.js"></script>
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

	<body class="user-page goto-here bg-light">
	<?php include "header.php" ?>
    <?php include "login_check.php" ?>
    <?php include "url_check.php"?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Rating</span></p>
            <h1 class="mb-0 bread">Rate Us</h1>
          </div>
        </div>
      </div>
    </div>
    <?php
	$cust_id = $_SESSION["cust_id"];
	$sql = "SELECT * from customer WHERE Cust_isDelete!=1 and Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
	$row =mysqli_fetch_assoc($result);
	?>
    <form name="rating_form" method="post">
    <section class="ftco-section" style="padding: 2em 0;">
		<div class="container">
		  <div class="row justify-content-center" style=" background:rgba(255,255,255,0.7);">
			<div class="col-xl-10 ftco-animate">
			<div class="row align-items-end">

            <div class="col-12">
            <div class="form-group">
                <div class="rating">
                    <input type="radio" name="star" id="star1" value="1" required><label for="star1">
                    </label>
                    <input type="radio" name="star" id="star2" value="2" required><label for="star2">  
                    </label>
                    <input type="radio" name="star" id="star3" value="3" required><label for="star3">
                    </label>
                    <input type="radio" name="star" id="star4" value="4" required><label for="star4">       
                    </label>
                    <input type="radio" name="star" id="star5" value="5" required><label for="star5">    
                    </label>
                </div>
                </div>
                </div>
                <div class="w-100"></div>
					<div class="col-md-6">
						  <div class="form-group">
							<label for="cname">Your Name</label>
						<input type="text" id="name" name="name" class="form-control" value="<?php echo $row['Cust_Name']?>" readonly>
					  </div>
					  </div>
					<div class="col-md-6">
							<div class="form-group">
							<label for="ccnum">Your Email</label>
							<input type="email" id="email" name="email" class="form-control" value="<?php echo $row['Cust_Email']?>" readonly>
					</div>
					</div>
					<div class="col-md-12">
							<div class="form-group">
							<label for="expmonthyear">Comment</label>
							<textarea id="comm" name="comm" class="form-control" rows="10" cols="50" required></textarea>
					</div>
					</div>
			</div> <!-- .col-md-8 -->
		  </div>
		</div>
        </div>
        <p class="text-center"><input type="submit" id="rate" name="rate" class="btn btn-primary py-3 px-4" value="Submit" style="width:200px; font-size:20px;"></p>
      </section> <!-- .section -->

      </form>
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
</html>
<?php
if(isset($_POST["rate"]))
{
    $star = $_POST["star"];
    if($star==1)
    {
        $star=5;
    }
    else if($star==2)
    {
        $star=4;
    }
    else if($star==3)
    {
        $star=3;
    }
    else if($star==4)
    {
        $star=2;
    }
    else if($star==5)
    {
        $star=1;
    }
    $comment = $_POST["comm"];
    $today = date("Y-m-d H:i:s"); 
    $sql = "INSERT INTO rate_comment(Rating,Comment,R_C_Date_Time,R_C_Cust_ID) value('$star','$comment','$today','$cust_id')";
    if(mysqli_query($connect,$sql))
    {
        ?>
        <script>
        swal({
            title: 'Rating Done',
            text: 'You Have Done Rating!',
            icon: 'success',
            button: 'Continue',
        }).then(function() {
            location.replace('index.php');
        });
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
        swal({
            title: 'Rating Fail',
            text: 'You Rating Have Not Recorded',
            icon: 'error',
            button: 'Continue',
        }).then(function() {
            location.replace('rate_cust.php');
        });
        </script>
        <?php
    }
}
?>
                                            