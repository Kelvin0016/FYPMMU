<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Package</title>
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
  <?php include "url_check.php" ?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Package</span></p>
            <h1 class="mb-0 bread">Package</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8 col-lg-10 order-md-last">
    				<div class="row">
					<?php
					if (!isset($_GET['id'])) {
						$id = 1;
					} else {
						$id = $_GET['id'];
					}
					//pagination
					$results_per_page = 3;
					$sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_Event_ID = '$id'";
					$result = mysqli_query($connect, $sql);
					$num_of_results = mysqli_num_rows($result);
					$num_of_pages = ceil($num_of_results/$results_per_page);
					if (!isset($_GET['page'])) {
						$page = 1;
					  } else {
						$page = $_GET['page'];
					}

					$this_page_first_result = ($page-1)*$results_per_page;
					$sql="SELECT * FROM package WHERE Pack_isDelete!=1 and Pack_Event_ID = '$id' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($connect, $sql);
					while($row =mysqli_fetch_assoc($result))
					{	
						$pid =  $row['Pack_ID'];
						$isql = "SELECT * FROM equip_package ,item WHERE Equip_P_Item_ID=Item_ID AND Equip_P_Pack_ID = '$pid' AND Equip_P_isDelete!=1";
						$iresult = mysqli_query($connect, $isql);
						$ori_price = 0;
						while($irow =mysqli_fetch_assoc($iresult))
						{
							$item_price = $irow['Item_Price'] * $irow['Equip_P_Qty'];
							$ori_price += $item_price;	
						}
				?>	
    			<div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<div class="img-prod" id="pack-img<?php echo $row['Pack_ID'];?>"><img class="img-fluid" src="<?php echo $row['Pack_Picture'];?>" alt="<?php echo $row['Pack_Name'];?>" id="img<?php echo $row['Pack_ID'];?>">
    						<div class="overlay"></div>
    					</div>
    					<div class="text py-3 pb-4 px-3">
							<h3><?php echo $row['Pack_Name'];?></h3>
    						<div class="pricing">
	    						<p class="price"><span><b>Original Price:</b> <del style="color:red;">RM <?php echo sprintf('%.2f',$ori_price);?></del></span></p>
	    					</div>
							<div class="pricing">
	    						<p class="price"><span><b>Package Price:</b> <span style="color:darkblue;">RM <?php echo sprintf('%.2f',$row['Pack_Price']);?></span></span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
								<a href="book_package.php?id=<?php echo $row['Pack_ID'];?>" class="add-to-cart text-center py-2 mr-1" id="add_check"  onclick="book_check(); return check();"><span>Choose This<i class="ion-ios-add ml-1"></i></span></a>
								<a href="package_detail.php?id=<?php echo $row['Pack_ID'];?>" class="buy-now text-center py-2">Detail<span><i class="ion-ios-cube ml-1"></i></span></a>
    						</p>
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
						  	if (!isset($_GET['id'])) {
								$id = 1;
							} else {
								$id = $_GET['id'];
							}
						  for($page=1;$page<=$num_of_pages;$page++)
						  {
							  echo "<li id='".$page."' class=''><a href='package.php?id=".$id."&page=".$page."'>".$page."</a></li>";
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

		    	<div class="col-md-4 col-lg-2">
		    		<div class="sidebar">
							<div class="sidebar-box-2">
								<h2 class="heading">Event</h2>
								<div class="fancy-collapse-panel">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				  <?php
				$sql = "SELECT * from events WHERE event_isDelete!=1";
				$result = mysqli_query($connect, $sql);
				while($row = mysqli_fetch_assoc($result))
				{	
			?>	
                     <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="headingOne">
                             <h4 class="panel-title">
                                 <a href="package.php?id=<?php echo $row['Event_ID'];?>" style="color:black; font-size=25px;"><?php echo $row['Event_Name'];?></a>
                             </h4>
                         </div>
					 </div>
					 <?php
					
				}		
			
			?>
                  </div>
               </div>
							</div>

						</div>
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
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
<?php include "login_check.php" ?>