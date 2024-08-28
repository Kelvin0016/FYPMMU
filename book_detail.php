<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Detail</title>
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
  <body class="goto-here" onload="onloadCheck()">
	<?php include "header.php" ?>
	<?php include "login_check.php" ?>
	<?php include "url_check.php" ?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
			  <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Book Detail</span></p>
			  <?php
					$id = $_GET['id'];
					$sql = "SELECT * from book,book_package WHERE book.Book_Pack_ID = book_package.Book_Pack_ID and Book_ID = '$id'";
					$result = mysqli_query($connect, $sql);
					$row =mysqli_fetch_assoc($result);
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
					$pa_sql = "SELECT * from payment where Pay_Book_ID = '$id'";
					$pa_result = mysqli_query($connect, $pa_sql);
					$pa_row =mysqli_fetch_assoc($pa_result);
					if($pa_row['Pay_Voucher']=="")
					{
						$voucher="None";
					}
					else
					{
						$voucher=$pa_row['Pay_Voucher'];
					}
				?>	
			<h1 class="mb-0 bread"><?php echo $row['Book_Event_Name'];?></h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="<?php echo $pack_pic;?>" class="image-popup prod-img-bg" style="height:auto;"><img src="<?php echo $pack_pic;?>" class="img-fluid" alt="<?php echo $row['Book_Pack_Name'];?>"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate" style="font-size:20px;">
					<h3><b>Event Name :</b> <?php echo $row['Book_Event_Name'];?></h3>
					<?php
						$vid = $row['Book_Event_Venue_ID'];
						$vsql = "SELECT * FROM event_venue where Event_Venue_ID = '$vid'";
						$vresult = mysqli_query($connect, $vsql);
						$vrow =mysqli_fetch_assoc($vresult);
					?>
					<h4 class="heading" style="font-size: 18px;"><b>Venue Name :</b> <?php echo $vrow['Event_Venue_Name'];?></h4>
					<h4 class="heading" style="font-size: 18px;"><b>Venue Address :</b><br><?php echo $row['Book_Event_Venue_S_Address'];?>,<br><?php echo $row['Book_Event_Venue_Pcode'];?> <?php echo $row['Book_Event_Venue_Area'];?>,<br><?php echo $row['Book_Event_Venue_State'];?></h4>
                    <h4 class="heading" style="font-size: 18px;"><b>Event Date :</b> <?php echo $row['Book_Event_Date'];?></h4>
                    <h4 class="heading" style="font-size: 18px;"><b>Event Time :</b> <?php echo $row['Book_Event_Time'];?></h4>
					<h4 class="heading" style="font-size: 18px;"><b>Theme Name :</b> <?php echo $row['Book_Event_Theme_Name'];?></h4>
					<h4 class="heading" style="font-size: 18px;"><b>Voucher Used :</b> <?php echo $voucher; ?></h4>
					<h4 class="heading" style="font-size: 18px;"><b>Discount Amount :</b> RM <?php echo sprintf('%.2f',$pa_row['Pay_Discount_Amount']);?></h4>
					<h4 class="heading" style="font-size: 18px;"><b>Pay Amount:</b> RM <?php echo sprintf('%.2f',$pa_row['Pay_Amount']);?></h4>
					
					<?php
					$bp_id= $row['Book_Pack_ID'];
					$sql = "SELECT * from equip_book_package WHERE Equip_B_isDelete!=1 and Equip_B_Pack_ID = '$bp_id'";
					$result = mysqli_query($connect, $sql);
					$row =mysqli_fetch_assoc($result);
					$count = mysqli_num_rows($result);
					?>
					<h4 class="heading" style="font-size: 18px;"><b>Number of item :</b> <?php echo $count;?></h4>
					<h4 class="heading badge <?php echo $badge?>" style="font-size: 30px;" id="<?php echo $status_name;?>"><?php echo $status_name;?></h4>
					<p>
						<a href="booking_history.php" class="btn btn-black py-3 px-5 mr-2" style="width:200px; font-size:15px;">Back</a>
						<span id="cancel"><a id="cancel_book.php?id=<?php echo $id;?>&status=<?php echo $status?>" class="btn btn-primary py-3 px-4" style="width:200px; font-size:15px;"onclick="return cancel_check(this.id)">Cancel</a></span>
					</p>
          	</div>
          	
    		</div>
			</div>
			
			<section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Book Package Item</h2>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
			<?php
					$sql = "SELECT * FROM equip_book_package ,item WHERE Equip_B_Item_ID=Item_ID AND Equip_B_Pack_ID = '$bp_id' AND Equip_B_isDelete!=1";
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
	    						<p class="price"><span>Quantity :<?php echo $row['Equip_B_Qty'];?></span></p>
	    					</div>
    					</div>
    				</div>
					<script type='text/javascript'>
						var pad_set = document.getElementById("item-img<?php echo $row['Item_ID'];?>");
						var pad_cal = document.getElementById("img<?php echo $row['Item_ID'];?>");
						pad_set.style.padding= "75px 21px";
					</script>
				</div>
				<?php
					
				}		
			
			?>
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
	<script>
		function cancel_check(curl)
		{
			if(<?php echo $status ?>==0)
			{
            swal({
                title: 'Cancel Booking',
                text: 'Do You Want To Cancel The Booking?\nFull Refund',
                icon: 'info',
                buttons: {
                    cancel: 'No',
                    Yes: true,
                },
            }).then((value) => {
                switch (value) {
                case 'Yes':
				location.href = curl;
                break;
            }
			});
		}
			else
			{
				swal({
					title: 'Cancel Booking',
					text: 'Do You Want To Cancel The Booking?\nRefund 70%',
					icon: 'info',
					buttons: {
						cancel: 'No',
						Yes: true,
					},
				}).then((value) => {
					switch (value) {
					case 'Yes':
					location.href = curl;
					break;
				}
				});
			}
		}
		function onloadCheck()
		{
			var status=<?php echo $status;?>;
			if(status==3||status==2)
			{
				document.getElementById("cancel").style.display = "none";
			}
		}
	</script>
  </body>
</html>
