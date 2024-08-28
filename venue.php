<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Venue</title>
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
  <body class="goto-here">
  <?php include "header.php" ?>
	<?php include "login_check.php" ?>
	<?php include "url_check.php" ?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Venue</span></p>
            <h1 class="mb-0 bread">Venue</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 order-lg-last ftco-animate" style="flex:unset; max-width: unset;">
				<div class="row">
				<?php
					//pagination
					$results_per_page = 5;
					$sql = "SELECT * from event_venue WHERE Event_Venue_isDelete!=1 and Event_Venue_ID!=0";
					$result = mysqli_query($connect, $sql);
					$num_of_results = mysqli_num_rows($result);
					$num_of_pages = ceil($num_of_results/$results_per_page);
					if (!isset($_GET['page'])) {
						$page = 1;
					  } else {
						$page = $_GET['page'];
					  }

					$this_page_first_result = ($page-1)*$results_per_page;
					$sql='SELECT * from event_venue WHERE Event_Venue_isDelete!=1 and Event_Venue_ID!=0 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
					$result = mysqli_query($connect, $sql);

					while($row =mysqli_fetch_assoc($result))
					{	
				?>	
					<div class="col-md-12 d-flex ftco-animate">
		            <div class="blog-entry align-self-stretch d-md-flex">
					<div class="product d-flex flex-column" style="max-width:450px;">
					<a href="<?php echo $row['Event_Venue_Picture'];?>" class="image-popup prod-img-bg block-20" style="height=auto;"><img src="<?php echo $row['Event_Venue_Picture'];?>" class="img-fluid" alt="<?php echo $row['Event_Venue_Name'];?>"></a>
					<div class="overlay"></div>
    					</div>  
					<div class="text d-block pl-md-4">
		                <h3><?php echo $row['Event_Venue_Name'];?></h3>
						<p class="heading" style="font-size: 18px;"><?php echo $row['Event_Venue_S_Address'];?>,<br><?php echo $row['Event_Venue_PCode'];?> <?php echo $row['Event_Venue_Area'];?>,<br><?php echo $row['Event_Venue_State'];?></p>
						<br>
		                <h4 class="heading" style="font-size: 18px;">RM <?php echo sprintf('%.2f',$row['Event_Venue_Price']);?></h4>
		              </div>
		            </div>
				  </div>
				 				<?php
					
				}		
			
			?> 
			</div>
			<!-- Page Number -->
			<div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
						  <?php
						  for($page=1;$page<=$num_of_pages;$page++)
						  {
							  echo "<li id='".$page."' class=''><a href='venue.php?page=".$page."'>".$page."</a></li>";
						  }	
						?>
		              </ul>
		            </div>
		          </div>
		        </div>
		    	</div>
				<?php
					if (!isset($_GET['page'])) {
						$active = 1;
					  } else {
						$active = $_GET['page'];
					  }
					?>
					<script>
						var active =document.getElementById("<?php echo $active?>");
						active.classList.add("active");
					</script>
					<?php
				?>
          </div> <!-- .col-md-8 -->

        </div>
      </div>
    </section> <!-- .section -->

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
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>