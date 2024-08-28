<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Package Details</title>
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
			  <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Package</span></p>
			  <?php
					$id = $_GET['id'];
					$sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_ID = '$id'";
					$result = mysqli_query($connect, $sql);
					$row =mysqli_fetch_assoc($result);
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
			<h1 class="mb-0 bread"><?php echo $row['Pack_Name'];?></h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="<?php echo $row['Pack_Picture'];?>" class="image-popup prod-img-bg" style="height:auto;"><img src="<?php echo $row['Pack_Picture'];?>" class="img-fluid" alt="<?php echo $row['Pack_Name'];?>"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate" style="font-size:20px;">
    				<h3><?php echo $row['Pack_Name'];?></h3>
					<p class="price"><span><b>Original Price:</b> <del style="color:red;">RM <?php echo sprintf('%.2f',$ori_price);?></del></span></p>
    				<p class="price"><span><b>Package Price:</b> <span style="color:darkblue;">RM <?php echo sprintf('%.2f',$row['Pack_Price']);?></span></span></p>
					<p><?php echo $row['Pack_Details'];?></p>
					<?php
					$sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$id'";
					$result = mysqli_query($connect, $sql);
					$row =mysqli_fetch_assoc($result);
					$count = mysqli_num_rows($result);
					?>
					<p>Number of item : <?php echo $count;?></p>
					<p onclick="book_check()"><a href="book_package.php?id=<?php echo $id;?>" class="btn btn-black py-3 px-5 mr-2"style="font-size:20px;" onclick="return check()"><span>Choose This<i class="ion-ios-add ml-1"></i></span></a></p>
          	</div>
          	
    		</div>
			</div>
			
			<section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Package Item</h2>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
			<?php
					$sql = "SELECT * FROM equip_package ,item WHERE Equip_P_Item_ID=Item_ID AND Equip_P_Pack_ID = '$id' AND Equip_P_isDelete!=1";
					$result = mysqli_query($connect, $sql);
					while($row =mysqli_fetch_assoc($result))
					{	
				?>	
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<div class="img-prod" id="item-img<?php echo $row['Item_ID'];?>"><img class="img-fluid" src="<?php echo $row['Item_Picture'];?>" alt="<?php echo $row['Item_Name'];?>" id="img<?php echo $row['Item_ID'];?>">
    						<div class="overlay"></div>
    					</div>
    					<div class="text py-3 pb-4 px-3">
							<h3><?php echo $row['Item_Name'];?></h3>
							<div class="d-flex">
    							<div class="cat">
		    						<span><?php echo $row['Item_Desc'];?></span>
		    					</div>
	    					</div>
    						<div class="pricing">
	    						<p class="price"><span>Quantity :<?php echo $row['Equip_P_Qty'];?></span></p>
	    					</div>
    					</div>
    				</div>
				</div>
				<?php
					
				}		
			
			?>
    		</div>	
    	</div>
    </section>
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
