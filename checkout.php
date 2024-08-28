<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Check Out</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<?php $book_id = $_GET['id'];?>
	<?php 
	$cust_id = $_SESSION["cust_id"];
	$bo_sql = "SELECT * FROM book where Book_ID = '$book_id'";
	$bo_result = mysqli_query($connect,$bo_sql);
	$bo_num_row = mysqli_num_rows($bo_result);
	$bo_row = mysqli_fetch_assoc($bo_result);
	$bo_pack_id = $bo_row['Book_Pack_ID'];
	?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Check Out</span></p>
            <h1 class="mb-0 bread">Check Out</h1>
          </div>
        </div>
      </div>
    </div>

	<section class="ftco-section" style="padding: 2em 0;">
		<div class="container">
		  <div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
					<h3 class="mb-4 billing-heading">Booking Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
					  <div class="form-group">
						  <label for="firstname">Event Name</label>
						<input type="text" class="form-control" placeholder="" name="event_name" value="<?php echo $bo_row['Book_Event_Name']?>" readonly>
					  </div>
					</div>
					<div class="col-md-6">
						  <div class="form-group">
							  <label for="country">Theme</label>
							  <div class="select-wrap">
							<select name="event_theme_id" id="theme" class="form-control" disabled>
							  <option value="1" id="1">Default Theme (Rm 0.00)</option>
							  <option value="2" id="2">Customized Theme (RM300.00)</option>
							</select>
						  </div>
						  </div>
					  </div>
					  <div class="w-100"></div>
					  <div class="col-md-12">
						  <div class="form-group">
						  <label for="streetaddress">Theme Name</label>
						<input type="text" class="form-control" placeholder="" value="<?php echo $bo_row['Book_Event_Theme_Name']?>" id="theme_name" name="event_theme" readonly>
					  </div>
					  </div>
					  <script>
							document.getElementById("theme").value = <?php echo $bo_row['Book_Event_Theme']?>;
					</script>
					<div class="col-md-6">
					  <div class="form-group">
						  <label for="lastname">Event Date</label>
						<input type="date" class="form-control" placeholder="" id="event_date" name="event_date" value="<?php echo $bo_row['Book_Event_Date'];?>">
					  </div>
				  </div>
				  <div class="col-md-6">
						  <div class="form-group">
							  <label for="country">Event Time</label>
							  <div class="select-wrap">
							<select name="event_time" id="time" class="form-control" disabled>
							  <option value="08:00AM" id="08:00AM">08:00 AM</option>
							  <option value="09:00AM" id="09:00AM">09:00 AM</option>
							  <option value="10:00AM" id="10:00AM">10:00 AM</option>
							  <option value="11:00AM" id="11:00AM">11:00 AM</option>
							  <option value="12:00PM" id="12:00PM">12:00 PM</option>
							  <option value="01:00PM" id="01:00PM">01:00 PM</option>
							  <option value="02:00PM" id="02:00PM">02:00 PM</option>
							  <option value="03:00PM" id="03:00PM">03:00 PM</option>
							  <option value="04:00PM" id="04:00PM">04:00 PM</option>
							  <option value="05:00PM" id="05:00PM">05:00 PM</option>
							  <option value="06:00PM" id="06:00PM">06:00 PM</option>
							  <option value="07:00PM" id="07:00PM">07:00 PM</option>
							  <option value="08:00PM" id="08:00PM">08:00 PM</option>
							  <option value="09:00PM" id="09:00PM">09:00 PM</option>
							  <option value="10:00PM" id="10:00PM">10:00 PM</option>
							</select>
						  </div>
						  </div>
					  </div>
					  <script>
							document.getElementById("time").value = "<?php echo $bo_row['Book_Event_Time'];?>";
					</script>
				  <div class="w-100"></div>
					  <div class="col-md-12">
						  <div class="form-group">
							  <label for="country">Event Venue</label>
							  <div class="select-wrap">
							<select name="event_venue_id" id="venue_p" class="form-control" disabled>
							<?php
								$sql = "SELECT * from event_venue WHERE Event_Venue_isDelete!=1";
								$result = mysqli_query($connect, $sql);
								while($row =mysqli_fetch_assoc($result))
								{	
							?>	
							  <option value="<?php echo $row['Event_Venue_ID'];?>" id="V<?php echo $row['Event_Venue_ID'];?>"><?php echo $row['Event_Venue_Name'];?> (RM <?php echo sprintf('%.2f',$row['Event_Venue_Price']);?>)</option>
							<?php
								}
								?>
									<script>
										document.getElementById("venue_p").value = <?php echo $bo_row['Book_Event_Venue_ID'];?>;
									</script>
								<?php
							?>
							</select>
						  </div>
						  </div>
					  </div>
					  <div class="w-100"></div>
					  <div class="col-md-6">
						  <div class="form-group">
						  <label for="streetaddress">Street Address</label>
						<input type="text" name="address" class="form-control" placeholder="House number and street name" id="S_Address" value="<?php echo $bo_row['Book_Event_Venue_S_Address'];?>">
					  </div>
					  </div>
					  <div class="col-md-6">
						  <div class="form-group">
							<label for="streetaddress">State</label>
						<input type="text" name="state" class="form-control" placeholder="" value="Melaka" readonly>
					  </div>
					  </div>
					  <div class="w-100"></div>
					  <div class="col-md-6">
						  <div class="form-group">
						  <label for="towncity">Area</label>
						<input type="text" name="area" class="form-control" placeholder="" id="Area" value="<?php echo $bo_row['Book_Event_Venue_Area'];?>">
					  </div>
					  </div>
					  <div class="col-md-6">
						  <div class="form-group">
							  <label for="postcodezip">Postcode</label>
						<input type="text" name="code" class="form-control" placeholder="" id="P_Code" value="<?php echo $bo_row['Book_Event_Venue_Pcode'];?>">
					  </div>
					  </div>

			</div> <!-- .col-md-8 -->
		  </div>
		</div>
		</div>
	  </section> <!-- .section -->
	  <form name="payment" method="post">
	  <section class="ftco-section" style="padding: 2em 0;">
		<div class="container">
		  <div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
			<div class="row align-items-end">
					<div class="w-100"></div>
				<div class="col-md-6">
						  <div class="form-group">
					<h3 class="mb-4 billing-heading">Payment</h3>
					</div>
					  </div>
					  <div class="col-md-6">
						  <div class="form-group">
					<h5>Accepted Cards</h5>
					<h4>
						<div class="icon-container">
						<input type="radio" name="card" id="visa" value="visa" onchange="cardnum(this)" required><label for="visa" class="col-md-3"><i class="fa fa-cc-visa" style="color:navy;"></i></label>
						<input type="radio" name="card" id="mas" value="mas" onchange="cardnum(this)" required><label for="mas" class="col-md-3"><i class="fa fa-cc-mastercard" style="color:red;"></i></label>
					</div>
					</h4>
					</div>
					  </div>
					<div class="col-md-6">
						  <div class="form-group">
							<label for="cname">Name On Card</label>
						<input type="text" id="cname" name="cardname" class="form-control" placeholder="Your Name on Card" pattern="[a-zA-Z ]*" maxlength="255">
					  </div>
					  </div>
					<div class="col-md-6">
							<div class="form-group">
							<label for="ccnum">Card Number</label>
							<input type="text" id="ccnum" name="cardnumber" class="form-control" placeholder="0000-0000-0000-0000" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" maxlength="19" onkeyup="addHyphen(this)" required>
					</div>
					</div>
					<div class="col-md-6">
							<div class="form-group">
							<label for="expmonthyear">Exp Month/Year</label>
							<input type="text" id="expmonthyear" name="expmonthyear" class="form-control" placeholder="11/24" pattern="(?:1[1-2]|0[1-9]|10)/[0-9]{2}" onkeyup="addSlash(this)" required maxlength="5">
					</div>
					</div>
					<div class="col-md-6">
							<div class="form-group">
							<label for="cvv">CVV</label>
							<input type="password" id="cvv" name="cvv" class="form-control" placeholder="345" pattern="[0-9]{3}" minlength="3" maxlength="3" required>
					</div>
					</div>
				</div>
			</div>
			</div>
			</div>
		</section>
		<?php
		if (!isset($_GET['void'])) {
			$vo_id = 0;
		} else {
			$vo_id = $_GET['void'];
		}
		if($vo_id==0)
		{
			$vouc_code="";
			$vouc_dis="0";
		}
		else
		{
			$sql = "SELECT * from voucher where Vouc_ID = '$vo_id' and Vouc_Status = 0";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_assoc($result);
			$vouc_code=$row['Vouc_Code'];
			$vouc_dis=$row['Vouc_Discount'];
		}
		?>
		<section class="ftco-section" style="padding: 2em 0;">
		<div class="container">
		  <div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
			<h3 class="mb-4 billing-heading">Do You Have Any Promo Code?</h3>
			<div class="row align-items-end">
					<div class="col-md-12">
						  <div class="form-group">
						<input type="text" id="promo" name="promo" class="form-control" placeholder="Voucher Code" value="<?php echo $vouc_code;?>">
					  </div>
					  </div>
					  </div>
					  </div>
					  </div>
					  </div>
					  <?php
						if($vouc_code!="")
						{
							?>
								<script>
									document.getElementById("promo").setAttribute("readonly", true);
								</script>
							<?php
						}
					  ?>
			</section>
			<p class="text-center"><input type="submit" id="check" name="check" class="btn btn-primary py-3 px-4" value="Check Voucher" onclick="voucDelReq()"></p>

	  <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate" style="margin:auto;">
    				<div class="cart-total mb-3">
						<h3>Package Totals</h3>
						<?php
							$v_id = $bo_row['Book_Event_Venue_ID'];
							$v_sql = "SELECT * from event_venue WHERE Event_Venue_ID = '$v_id'";
							$v_result = mysqli_query($connect, $v_sql);
							$v_row =mysqli_fetch_assoc($v_result);
							$book_pack_id = $bo_row['Book_Pack_ID'];
							$b_sql = "SELECT * from book_package WHERE Book_Pack_ID ='$book_pack_id'";
							$b_result = mysqli_query($connect, $b_sql);
							$b_row =mysqli_fetch_assoc($b_result);
						?>
						<p class="d-flex">
    						<span>Package</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="package" name="package" value="<?php echo sprintf('%.2f',$b_row['Book_Pack_Price']);?>"></span>
    					</p>
    					<p class="d-flex">
    						<span>Addon/Customize</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="subtotal" name="subtotal_p" value="<?php echo sprintf('%.2f',$b_row['Book_Pack_Addon_Price']);?>"></span>
    					</p>
    					<p class="d-flex">
    						<span>Venue</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="venue" name="venue_P" value="<?php echo sprintf('%.2f',$v_row['Event_Venue_Price']);?>"></span>
    					</p>
						<p class="d-flex">
    						<span>Theme</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="theme_price" name="theme_p" value="<?php echo sprintf('%.2f',$b_row['Book_Pack_Theme_Price']);?>"></span>
						</p>
						<p class="d-flex">
    						<span>Discount</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="discount_price" name="dis_p"></span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="pay" name="pay_p"></span>
    					</p>
    				</div>
					<p class="text-center"><input type="submit" id="pay" name="pay" class="btn btn-primary py-3 px-4" value="Place In Payment"></p>

    			</div>
    		</div>
			</div>
		<script>
		function cardnum(card)
		{
			var id = card.id;
			if(id=="visa")
			{
				document.getElementById("ccnum").setAttribute("pattern", "4[0-9]{3}-[0-9]{4}-[0-9]{4}-[0-9]{4}"); 
			}
			else
			{
				document.getElementById("ccnum").setAttribute("pattern", "(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)-[0-9]{4}-[0-9]{4}-[0-9]{4}"); 
			}
		}
		function addHyphen (element) {
			let ele = document.getElementById(element.id);
			ele = ele.value.split('-').join('');    // Remove dash (-) if mistakenly entered.

			let finalVal = ele.match(/.{1,4}/g).join('-');
			document.getElementById(element.id).value = finalVal;
    	}
		function addSlash (element) {
			let ele = document.getElementById(element.id);
			ele = ele.value.split('/').join('');    // Remove dash (-) if mistakenly entered.

			let finalVal = ele.match(/.{1,2}/g).join('/');
			document.getElementById(element.id).value = finalVal;
    	}
		function voucDelReq()
		{
			document.getElementById("ccnum").removeAttribute("required");
			document.getElementById("expmonthyear").removeAttribute("required");
			document.getElementById("cvv").removeAttribute("required");
		}
			var pack_p = parseInt(document.getElementById("package").value);
			var add_p = parseInt(document.getElementById("subtotal").value);
			var venue_p = parseInt(document.getElementById("venue").value);
			var theme_p = parseInt(document.getElementById("theme_price").value);
			var full = pack_p+add_p+venue_p+theme_p;
			var dis = parseInt(<?php echo $vouc_dis;?>);
			var dis_p = full * dis /100;
			document.getElementById("discount_price").value = dis_p.toFixed(2);
			var total = full-dis_p;
			document.getElementById("pay").value = total.toFixed(2);
		</script>
		</form>
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
  </body>
</html>
<?php
	if(isset($_POST['check']))
	{
		$v_code = $_POST['promo'];
		if($v_code!="")
		{
		$sql = "SELECT * from payment where Pay_Cust_ID = '$cust_id' and Pay_Voucher = '$v_code'";
		$result = mysqli_query($connect,$sql);
		$num_row = mysqli_num_rows($result);
		if($num_row!=0)
		{
			?>
			<script>
            swal({
                title: 'Voucher Used',
                text: 'You Have Used This Voucher Previously',
                icon: 'warning',
                button: 'Continue',
            }).then(function() {
                location.replace('checkout.php?id=<?php echo $book_id?>');
            });
			</script>
			<?php
		}
		else
		{
			$sql = "SELECT * from voucher where Vouc_Code = '$v_code'";
			$result = mysqli_query($connect,$sql);
			$num_row = mysqli_num_rows($result);
			if($num_row==0)
			{
				?>
				<script>
				swal({
					title: 'Voucher Not Founded',
					text: 'You Have Enter Wrong Voucher Code',
					icon: 'warning',
					button: 'Continue',
				}).then(function() {
					location.replace('checkout.php?id=<?php echo $book_id?>');
				});
				</script>
				<?php
			}
			else
			{
				$sql = "SELECT * from voucher where Vouc_Code = '$v_code' and Vouc_Status =0";
				$result = mysqli_query($connect,$sql);
				$num_row = mysqli_num_rows($result);
				if($num_row==0)
				{
					?>
					<script>
					swal({
						title: 'Voucher Inactive',
						text: 'You Have Enter Inactive Voucher Code',
						icon: 'warning',
						button: 'Continue',
					}).then(function() {
						location.replace('checkout.php?id=<?php echo $book_id?>');
					});
					</script>
					<?php
				}
				else
				{
					$row = mysqli_fetch_assoc($result);
					$discouunt = $row['Vouc_Discount'];
					$vo_id = $row['Vouc_ID'];
					?>
					<script>
					swal({
						title: 'Voucher Can Used',
						text: 'You Have Enter Valid Voucher Code',
						icon: 'success',
						button: 'Continue',
					}).then(function() {
						location.replace('checkout.php?id=<?php echo $book_id?>&void=<?php echo $vo_id?>');
					});
					</script>
					<?php
				}
			}
		}
	}
	}
	else if(isset($_POST['pay']))
	{
		$v_code = $_POST['promo'];
		if(!isset($_GET['void']))
		{
			if($v_code!="")
		{
			$sql = "SELECT * from payment where Pay_Cust_ID = '$cust_id' and Pay_Voucher = '$v_code'";
			$result = mysqli_query($connect,$sql);
			$num_row = mysqli_num_rows($result);
				if($num_row!=0)
				{
					?>
					<script>
					swal({
						title: 'Voucher Used',
						text: 'You Have Used This Voucher Previously',
						icon: 'warning',
						button: 'Continue',
					}).then(function() {
						location.replace('checkout.php?id=<?php echo $book_id?>');
					});
					</script>
					<?php
				}
				else
				{
					$sql = "SELECT * from voucher where Vouc_Code = '$v_code'";
					$result = mysqli_query($connect,$sql);
					$num_row = mysqli_num_rows($result);
					if($num_row==0)
					{
						?>
						<script>
						swal({
							title: 'Voucher Not Founded',
							text: 'You Have Enter Wrong Voucher Code',
							icon: 'warning',
							button: 'Continue',
						}).then(function() {
							location.replace('checkout.php?id=<?php echo $book_id?>');
						});
						</script>
						<?php
					}
					else
					{
						$sql = "SELECT * from voucher where Vouc_Code = '$v_code' and Vouc_Status =0";
						$result = mysqli_query($connect,$sql);
						$num_row = mysqli_num_rows($result);
						if($num_row==0)
						{
							?>
							<script>
							swal({
								title: 'Voucher Inactive',
								text: 'You Have Enter Inactive Voucher Code',
								icon: 'warning',
								button: 'Continue',
							}).then(function() {
								location.replace('checkout.php?id=<?php echo $book_id?>');
							});
							</script>
							<?php
						}
						else
						{
							$row = mysqli_fetch_assoc($result);
							$discouunt = $row['Vouc_Discount'];
							$vo_id = $row['Vouc_ID'];
							?>
							<script>
							swal({
								title: 'Voucher Can Used',
								text: 'You Have Enter Valid Voucher Code',
								icon: 'success',
								button: 'Continue',
							}).then(function() {
								location.replace('checkout.php?id=<?php echo $book_id?>&void=<?php echo $vo_id?>');
							});
							</script>
							<?php
						}
					}
				}
				exit;
			}
		}
		$pay_amount = $_POST['pay_p'];
		$dis_amount = $_POST['dis_p'];
		$today = date("Y-m-d H:i:s"); 
		$sql = "INSERT into payment(Pay_Date_Time, Pay_Amount, Pay_Voucher, Pay_Discount_Amount, Pay_Book_ID, Pay_Cust_ID) VALUES('$today', '$pay_amount', '$v_code', '$dis_amount', '$book_id', '$cust_id')";
		if(mysqli_query($connect,$sql))
		{
			$sql = "UPDATE book SET Book_Date_Time = '$today', Book_isCheck =1 where Book_ID = '$book_id'";
			mysqli_query($connect,$sql);
			$sql = "UPDATE book_package SET Book_Pack_isCheck =1 where Book_Pack_ID = '$bo_pack_id'";
			mysqli_query($connect,$sql);
			$sql = "SELECT * FROM customer where Cust_id='$cust_id' and Cust_isDelete=0";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_assoc($result);
			$to_email = $row['Cust_Email'];
			$subject = "Fiesta Corp: Booking Done";
			$from_email= "contact.us.fiesta@gmail.com";
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html;" . "\r\n";
			$headers .= "From: ".$from_email."\r\n".
			  "Reply-To: ".$from_email."\r\n" .
			  "X-Mailer: PHP/" . phpversion();
		  
			  $body = "<html><body>";
			  $body .= "<h3>Dear <span style='text-transform: uppercase';>".$row['Cust_Name']."</span></h3>".
					  "<h4>You have done your booking!!!</h4>".
					  "<p><b>Your Booking Details:</b></p>".
					  "<p><b>Booking ID:</b> ".$book_id."<br>".
					  "<b>Book Event Name:</b> ".$bo_row['Book_Event_Name']."<br>".
					  "<b>Book Event Date:</b> ".$bo_row['Book_Event_Date']."<br>".
					  "<b>Book Event Time:</b> ".$bo_row['Book_Event_Time']."<br>".
					  "<b>Theme Name:</b> ".$bo_row['Book_Event_Theme_Name']."<br>".
					  "<b>Booking Status:</b> Pending</p>".
					  "<p><b>Pay Amount:</b> RM ".$pay_amount."<br>".
					  "<p><b>Discount Amount:</b> RM  ".$dis_amount."</p>".
					  "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
			  $body .= "</body></html>";
			  if (mail($to_email, $subject, $body,$headers)) {
			?>
			<script>
			swal({
				title: 'Payment Done',
				text: 'You Have Done Payment!',
				icon: 'success',
				button: 'Continue',
			}).then(function() {
				location.replace('index.php');
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
				title: 'Payment Fail',
				text: 'You Payment Have Not Be Done!!!',
				icon: 'error',
				button: 'Continue',
			}).then(function() {
				location.replace('index.php');
			});
			</script>
			<?php
		}
	}

?>
