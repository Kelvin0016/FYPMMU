<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Fiesta Cor.</title>
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
    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel" style="overflow:hidden;">

			<?php
				$sql = "SELECT * from events WHERE event_isDelete!=1";
				$result = mysqli_query($connect, $sql);
				while($row = mysqli_fetch_assoc($result))
				{	
			?>		
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third order-md-last img-fluid" src="<?php echo $row['Event_Picture'];?>" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">#Event</span>
		          		<div class="horizontal">
				            <h1 class="mb-4 mt-3"><?php echo $row['Event_Name'];?></h1>
				            <p class="mb-4"><?php echo $row['Event_Details'];?></p>
				            
				            <p><a href="package.php?id=<?php echo $row['Event_ID'];?>" class="btn-custom">Book Now</a></p>
				        </div>
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
			<?php
					
				}		
			
			?>
	  </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
            		<span class="flaticon-bag"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Customizable Event Package</h3>
                <p>All of the event package can customized by your own.</p>
              </div>
            </div>      
          </div>
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Cancellation</h3>
                <p><b>Can cancel event if in pending status<br>(Full Refund)</b><br>Cancel after approved only refund 70%</p>
              </div>
            </div>    
          </div>
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
            		<span class="flaticon-payment-security"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Secure Payments</h3>
                <p>Only can pay with credit and debit card. More secure & more private.</p>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

    <section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Event Item</h2>
            <h2 class="mb-4">Customize Your Own Package!!!</h2>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
			<?php
				$sql = "SELECT * from item WHERE item_isDelete!=1 Order by Rand() limit 8";
				$result = mysqli_query($connect, $sql);
				while($row = mysqli_fetch_assoc($result))
				{	
				?>	
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<div class="img-prod" id="item-img<?php echo $row['Item_ID'];?>"><img class="img-fluid" src="<?php echo $row['Item_Picture'];?>" alt="Colorlib Template" id="img<?php echo $row['Item_ID'];?>" style="object-fit: cover;">
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
	    						<p class="price"><span>RM <?php echo $row['Item_Price'];?>.00</span></p>
							</div>
							<form name="item-form" method="post">
	    					<p class="bottom-area d-flex px-3">
								<input type="hidden" value="<?php echo $row['Item_ID'];?>" name="item_ID">
								<input type="submit" onclick="book_check(); return check();" name="itemsbmt"  class="add-to-cart text-center py-2 mr-1" value="Add Item">
								<input type="number" class="buy-now text-center py-2" style="width:50px; height:50px;" min="1" name="item_Qty" required>
							</p>
							</form>
    					</div>
    				</div>
				</div>
				<?php
					
				}		
			
			?>
    		</div>	
    	</div>
    </section>
	
    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row">
        	<div class="col-lg-5">
        		<div class="services-flow">
				<?php
		$sql = "SELECT * from voucher WHERE Vouc_isDelete!=1 and Vouc_Status !=1 Order by Rand() limit 3";
		$result = mysqli_query($connect, $sql);
		while($row = mysqli_fetch_assoc($result))
		{
	?>	
        			<div class="services-2 p-4 d-flex ftco-animate">
        				<div class="icon">
							<span class="flaticon-heart-box"></span>
        				</div>
        				<div class="text" style="text-align:left;margin:auto;">
	        				<h3>Code: <?php echo $row['Vouc_Code']?></h3>
	        				<p class="mb-0"><?php echo $row['Vouc_Name']?></p>
        				</div>
					</div>
					<?php
		}
					?>
        		</div>
        	</div>
          <div class="col-lg-7">
          	<div class="heading-section ftco-animate mb-5">
	            <h2 class="mb-4">Our Customer Says</h2>
	          </div>
            <div class="carousel-testimony owl-carousel">
				<?php
				$sql = "SELECT * from rate_comment, customer WHERE R_C_Cust_ID = Cust_ID and Rating >3 ORDER BY Rand() Limit 5";
				$result = mysqli_query($connect,$sql);
				$count=1;
				while($row = mysqli_fetch_assoc($result))
				{
				?>
              <div class="item">
                <div class="testimony-wrap">
				  <div class="user-img mb-4" style="background-image: url(images/customer/<?php echo $count;?>.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
				  </div>

                  <div class="text">
                    <p class="mb-4 pl-4 line"><?php echo $row['Comment'];?></p>
                    <p class="name"><?php echo $row['Cust_Name'];?></p>
                    <span class="position">				  
				  <div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="" class="mr-2"><?php echo $row['Rating'];?>.0</a>
								<a href=""><span class="ion-ios-star" id="star1_<?php echo $count;?>"></span></a>
								<a href=""><span class="ion-ios-star" id="star2_<?php echo $count;?>"></span></a>
								<a href=""><span class="ion-ios-star" id="star3_<?php echo $count;?>"></span></a>
								<a href=""><span class="ion-ios-star-outline" id="star4_<?php echo $count;?>"></span></a>
								<a href=""><span class="ion-ios-star-outline" id="star5_<?php echo $count;?>"></span></a>
							</p>
							</div>
					</span>
					<script>
						var star = <?php echo $row['Rating'];?>;
						var count = <?php echo $count;?>;
						if(star==4)
						{
							document.getElementById("star4_"+count).classList.remove("ion-ios-star-outline");
							document.getElementById("star4_"+count).classList.add("ion-ios-star");
						}
						else if(star==5)
						{
							document.getElementById("star4_"+count).classList.remove("ion-ios-star-outline");
							document.getElementById("star4_"+count).classList.add("ion-ios-star");
							document.getElementById("star5_"+count).classList.remove("ion-ios-star-outline");
							document.getElementById("star5_"+count).classList.add("ion-ios-star");
						}
					</script>
                  </div>
                </div>
			  </div>
			  <?php
			  $count++;
				}
			?>

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
  <script>
			$(".num").keypress(function(e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
				}
			});
	</script>
  </body>
</html>
<?php include "login_check.php" ?>
<?php 
if(isset($_POST["itemsbmt"]))
{
	$item_id=$_POST['item_ID'];
	$pack_id = 0;
	$item_qty=$_POST['item_Qty'];
	$cust_id = $_SESSION["cust_id"];
	$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
    $row =mysqli_fetch_assoc($result);
    $count_row =mysqli_num_rows($result);
    $sql = "SELECT * from book_package WHERE Book_Pack_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
    $row =mysqli_fetch_assoc($result);
    $count_in_row =mysqli_num_rows($result)+1;
    if($count_row==0)
    {

            $book_pack_name = "Customize_".$cust_id."_".$count_in_row;
            $book_pack_price = 0;
            $sql = "INSERT INTO book_package(Book_Pack_Name, Book_Pack_Price, Pack_ID, Book_Pack_Cust_ID) VALUES ('$book_pack_name', '$book_pack_price', '$pack_id', '$cust_id');";
            mysqli_query($connect, $sql);
            $sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
            $result = mysqli_query($connect, $sql);
            $row =mysqli_fetch_assoc($result);
			$book_pack_id = $row['Book_Pack_ID'];
			$sql = "INSERT INTO equip_book_package(Equip_B_Pack_ID, Equip_B_Item_ID, Equip_B_Qty) VALUES ('$book_pack_id', '$item_id', '$item_qty');";
			$result = mysqli_query($connect, $sql);
			?>
			<script>
			window.location.replace("book.php?id=<?php echo $book_pack_id; ?>");
			</script>
			<?php
	}
	else
	{
		$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
        $result = mysqli_query($connect, $sql);
		$row =mysqli_fetch_assoc($result);
		$book_pack_id =$row['Book_Pack_ID'];
		$sql = "SELECT * from equip_book_package where Equip_B_Pack_ID = '$book_pack_id' and Equip_B_isDelete =0";
		$result = mysqli_query($connect, $sql);
		$count_row =mysqli_num_rows($result);
		if($count_row == 0)
			{
				$sql = "INSERT INTO equip_book_package(Equip_B_Pack_ID, Equip_B_Item_ID, Equip_B_Qty) VALUES ('$book_pack_id', '$item_id', '$item_qty');";
				$result = mysqli_query($connect, $sql);
				?>
				<script>
				window.location.replace("book.php?id=<?php echo $book_pack_id; ?>");
				</script>
				<?php
			}
			else
			{
				$sql = "SELECT * from equip_book_package where Equip_B_Pack_ID = '$book_pack_id' and Equip_B_isDelete =0 and Equip_B_Item_ID = '$item_id'";
				$result = mysqli_query($connect, $sql);
				$count_row =mysqli_num_rows($result);
				if($count_row == 0)
				{
					$sql = "INSERT INTO equip_book_package(Equip_B_Pack_ID, Equip_B_Item_ID, Equip_B_Qty) VALUES ('$book_pack_id', '$item_id', '$item_qty');";
					$result = mysqli_query($connect, $sql);
				}
				else
				{
					$row =mysqli_fetch_assoc($result);
					$ori_qty = $row['Equip_B_Qty'];
					$new_qty = $ori_qty + $item_qty;
					$sql = "UPDATE equip_book_package SET Equip_B_Qty= '$new_qty' WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$item_id' and Equip_B_isDelete =0";
					mysqli_query($connect, $sql);
				}
				?>
				<script>
				swal({
							title: "Item Added",
							text: "Your Item Have Added",
							icon: "info",
							button: "Continue",
						  });
				</script>
				<?php
			}
		}
	
}

?>