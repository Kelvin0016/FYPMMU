<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Booking History</title>
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
    <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Booking History</span></p>
            <h1 class="mb-0 bread">Booking History</h1>
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
                	$cust_id = $_SESSION["cust_id"];
					$results_per_page = 2;
					$sql = "SELECT * from book,book_package WHERE book.Book_Pack_ID = book_package.Book_Pack_ID and  Book_Cust_ID = '$cust_id' and Book_isCheck =1";
					$result = mysqli_query($connect, $sql);
					$num_of_results = mysqli_num_rows($result);
					$num_of_pages = ceil($num_of_results/$results_per_page);
					if (!isset($_GET['page'])) {
						$page = 1;
					  } else {
						$page = $_GET['page'];
					  }

					$this_page_first_result = ($page-1)*$results_per_page;
					$sql="SELECT * from book,book_package WHERE book.Book_Pack_ID = book_package.Book_Pack_ID and  Book_Cust_ID = '$cust_id' and Book_isCheck =1 LIMIT " . $this_page_first_result . ',' .  $results_per_page;
					$result = mysqli_query($connect, $sql);

					while($row =mysqli_fetch_assoc($result))
					{	
                    $pack_id = $row['Pack_ID'];
                    $status = $row['Book_Status'];
                    if($pack_id==0)
                    {
                        $pack_pic = "images/package/customize.jpg";
                    }
                    else
                    {
                        $p_sql = "SELECT * from package where Pack_ID = '$pack_id'";
                        $p_result = mysqli_query($connect,$p_sql);
                        $p_row = mysqli_fetch_assoc($p_result);
                        $pack_pic = $p_row['Pack_Picture'];
                    }
                    if($status == 0)
                    {
                        $status_name ="Pending";
                        $badge = "badge-warning";
                    }
                    else if($status == 1)
                    {
                        $status_name ="Accepted";
                        $badge = "badge-success";
                    }
                    else if($status == 2)
                    {
                        $status_name ="Rejected";
                        $badge = "badge-danger";
                    }
                    else if($status == 3)
                    {
                        $status_name ="Cancelled";
                        $badge = "badge-secondary";
                    }
				?>	
					<div class="col-md-12 d-flex ftco-animate">
		            <div class="blog-entry align-self-stretch d-md-flex">
					<div class="product d-flex flex-column" style="max-width:450px;">
					<a href="<?php echo $pack_pic?>" class="image-popup prod-img-bg block-20" style="height:auto;"><img src="<?php echo $pack_pic?>" class="img-fluid" alt="<?php echo $row['Book_Pack_Name'];?>" style="height=auto;"></a>
					<div class="overlay"></div>
    					</div>  
					<div class="text d-block pl-md-4">
		                <h3><b>Event Name :</b> <?php echo $row['Book_Event_Name'];?></h3>
                    <?php
                      $vid = $row['Book_Event_Venue_ID'];
                      $vsql = "SELECT * FROM event_venue where Event_Venue_ID = '$vid'";
                      $vresult = mysqli_query($connect, $vsql);
                      $vrow =mysqli_fetch_assoc($vresult);
                    ?>
					              <h4 class="heading" style="font-size: 18px;"><b>Venue Name :</b> <?php echo $vrow['Event_Venue_Name'];?></h4>
                        <h4 class="heading" style="font-size: 18px;"><b>Event Date :</b> <?php echo $row['Book_Event_Date'];?></h4>
                        <h4 class="heading" style="font-size: 18px;"><b>Event Time :</b> <?php echo $row['Book_Event_Time'];?></h4>
                        <h4 class="heading" style="font-size: 18px;"><b>Theme Name :</b> <?php echo $row['Book_Event_Theme_Name'];?></h4>
                        <h4 class="heading badge <?php echo $badge?>" style="font-size: 30px;"><?php echo $status_name;?></h4>
                        <br><br>
                        <p><a href="book_detail.php?id=<?php echo $row['Book_ID'];?>" class="btn btn-primary py-3 px-4" style="width:200px; font-size:20px;">Detail</a></p>
		              </div>
		            </div>
				  </div>
				 				<?php
					
				}		
			
			?> 
			</div>
			<div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
						  <?php
						  for($page=1;$page<=$num_of_pages;$page++)
						  {
							  echo "<li id='".$page."' class=''><a href='booking_history.php?page=".$page."'>".$page."</a></li>";
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
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </body>
</html>