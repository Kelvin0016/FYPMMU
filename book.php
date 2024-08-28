<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book</title>
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
	<script type="text/javascript" src="js/book.js"></script>
  </head>
  <body class="goto-here" onload="dateupdate(); onload_update(); addressLocked(); onloadTheme();">
  <?php include "header.php" ?>
	<?php include "login_check.php" ?>
	<?php include "url_check.php" ?>
	<?php $book_pack_id = $_GET['id'];?>
	<?php 
	$cust_id = $_SESSION["cust_id"];
	$bo_sql = "SELECT * FROM book where Book_isCheck!=1 and Book_Cust_ID ='$cust_id'";
	$bo_result = mysqli_query($connect,$bo_sql);
	$bo_num_row = mysqli_num_rows($bo_result);
	$bo_row = mysqli_fetch_assoc($bo_result);
	if($bo_num_row==0)
	{
		$theme_id=1;
		$vid=0;
		$event_name="";
		$theme_name="Default Theme";
	}
	else
	{
		$event_name=$bo_row['Book_Event_Name'];
		$theme_id= $bo_row['Book_Event_Theme'];
		$vid = $bo_row['Book_Event_Venue_ID'];
		if($vid==0)
		{
			$s_address = $bo_row['Book_Event_Venue_S_Address'];
			$area = $bo_row['Book_Event_Venue_Area'];
			$state = $bo_row['Book_Event_Venue_State'];
			$pcode = $bo_row['Book_Event_Venue_Pcode'];
		}
		if($theme_id==2)
		{
			$theme_name=$bo_row['Book_Event_Theme_Name'];
		}
		else
		{
			$theme_name="Default Theme";
		}
	}
	
	?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Booking</span></p>
            <h1 class="mb-0 bread">Booking Page</h1>
          </div>
        </div>
      </div>
    </div>

	<section class="ftco-section" style="padding: 2em 0;">
	<form name="book_pack" id="book_pack" method="post">
		<div class="container">
		  <div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
							  <h3 class="mb-4 billing-heading">Booking Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
					  <div class="form-group">
						  <label for="firstname">Event Name</label>
						<input type="text" class="form-control" placeholder="Event Name" id="event_name" name="event_name" value="<?php echo $event_name?>" required pattern="[a-zA-Z0-9 ]*" maxlength="100">
					  </div>
					</div>
					<div class="col-md-6">
						  <div class="form-group">
							  <label for="country">Theme</label>
							  <div class="select-wrap">
							<select name="event_theme_id" id="theme" class="form-control" onchange="themeChange(this.value);onload_update();" required>
							  <option value="1" id="1">Default Theme (RM 0.00)</option>
							  <option value="2" id="2">Customized Theme (RM 300.00)</option>
							</select>
						  </div>
						  </div>
					  </div>
					  <div class="w-100"></div>
					  <div class="col-md-12">
						  <div class="form-group">
						  <label for="streetaddress">Theme Name</label>
						<input type="text" class="form-control" placeholder="" value="<?php echo $theme_name;?>" id="theme_name" name="event_theme" required pattern="[a-zA-Z0-9_&/ ]*" maxlength="100">
					  </div>
					  </div>
					  <script>
							document.getElementById("theme").value = <?php echo $theme_id ?>;
					</script>
					<div class="col-md-6">
					  <div class="form-group">
						  <label for="lastname">Event Date</label>
						<input type="date" class="form-control" placeholder="" id="event_date" name="event_date" value="<?php echo $bo_row['Book_Event_Date'];?>" required>
					  </div>
				  </div>
				  <div class="col-md-6">
						  <div class="form-group">
							  <label for="country">Event Time</label>
							  <div class="select-wrap">
							<select name="event_time" id="time" class="form-control" required>
							  <option value="" id="" selected disabled hidden>Please Select A Time</option>
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
							<select name="event_venue_id" id="venue_p" class="form-control" onchange="addressSaved(this.value)" required>
							<?php
								$sql = "SELECT * from event_venue WHERE Event_Venue_isDelete!=1";
								$result = mysqli_query($connect, $sql);
								while($row =mysqli_fetch_assoc($result))
								{	
							?>	
							  <option value="<?php echo $row['Event_Venue_ID'];?>" id="V<?php echo $row['Event_Venue_ID'];?>"><?php echo $row['Event_Venue_Name'];?> (RM <?php echo sprintf('%.2f',$row['Event_Venue_Price']);?>)</option>
							<?php
								}
								if (!isset($_GET['vid'])) {
								  } else {
									$vid = $_GET['vid'];
								  }
								?>
									<script>
										document.getElementById("venue_p").value = <?php echo $vid ?>;
									</script>
								<?php
							?>
							</select>
						  </div>
						  </div>
					  </div>
						<script>
							function addressSaved(id)
							{
								var i =id;
								savedDetail(i);
							}
						</script>
						<?php
							$v_sql = "SELECT * from event_venue WHERE Event_Venue_isDelete!=1 and Event_Venue_ID= '$vid'";
							$v_result = mysqli_query($connect, $v_sql);
							$v_row =mysqli_fetch_assoc($v_result);
							if($vid!=0)
							{
								$s_address = $v_row['Event_Venue_S_Address'];
								$area = $v_row['Event_Venue_Area'];
								$pcode = $v_row['Event_Venue_PCode'];
							}
							else
							{
								if($bo_row['Book_Event_Venue_S_Address']=="")
								{
								$s_address = "";
								$area = "";
								$pcode = "";
								}
								else
								{
									$s_address = $bo_row['Book_Event_Venue_S_Address'];
									$area = $bo_row['Book_Event_Venue_Area'];
									$pcode = $bo_row['Book_Event_Venue_Pcode'];
								}
							}
						?>
					  <div class="w-100"></div>
					  <div class="col-md-6">
						  <div class="form-group">
						  <label for="streetaddress">Street Address</label>
						<input type="text" name="address" class="form-control" placeholder="House number and street name" id="S_Address" value="<?php echo $s_address;?>" required>
					  </div>
					  </div>
					  <div class="col-md-6">
						  <div class="form-group">
							<label for="streetaddress">State</label>
						<input type="text" name="state" id="state" class="form-control" placeholder="" value="Melaka" readonly required>
					  </div>
					  </div>
					  <div class="w-100"></div>
					  <div class="col-md-6">
						  <div class="form-group">
						  <label for="towncity">Area</label>
						<input type="text" name="area" class="form-control" placeholder="" id="Area" value="<?php echo $area;?>" required maxlength="100">
					  </div>
					  </div>
					  <div class="col-md-6">
						  <div class="form-group">
							  <label for="postcodezip">Postcode</label>
						<input type="text" name="code" class="form-control" placeholder="" id="P_Code" value="<?php echo $pcode;?>" required pattern="[0-9]{5}" maxlength="5">
					  </div>
					  </div>
				</div>
			</div> <!-- .col-md-8 -->
		  </div>
		</div>
	  </section> <!-- .section -->
	
    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Product</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>

							<?php
					$sql = "SELECT * FROM equip_book_package ,item WHERE Equip_B_Item_ID=Item_ID AND Equip_B_Pack_ID = '$book_pack_id' AND Equip_B_isDelete!=1";
					$result = mysqli_query($connect, $sql);
					if(mysqli_num_rows($result)==0)
					{
						?>
							<tr class="text-center">
							<td colspan="6">
								Please Add Item. Cart is Empty.
							</td>
							</tr>
						<?php
					}
					else{
					while($row =mysqli_fetch_assoc($result))
					{	
				?>	
						      <tr class="text-center">
						        <td class="product-remove"><a id="book.php?delete&vid=<?php echo $vid?>&id=<?php echo $book_pack_id?>&did=<?php echo $row['Equip_B_Item_ID'];?>" onclick="confirmDelete(this.id);" class="remove"><span class="ion-ios-close"></span></a></td>
						        
						        <td class="image-prod"><div class="img" style="background-image:url('<?php echo $row['Item_Picture'];?>');"></div></td>
						        
						        <td class="product-name">
						        	<h3><?php echo $row['Item_Name'];?></h3>
						        	<p><?php echo $row['Item_Desc'];?></p>
						        </td>
						        
						        <td class="price"><input type="text" style="background:unset; border:unset; text-align:center;" disabled id="price<?php echo $row['Item_ID'];?>" name="price" value="<?php echo sprintf('%.2f',$row['Item_Price']);?>">
									</td>
						        
						        <td class="quantity">
						        	<div class="input-group mb-3">
					             	<input type="number" name="quantity[]" class="quantity form-control input-number <?php echo $row['Item_ID'];?>" value="<?php echo $row['Equip_B_Qty'];?>" min="1" id="qty<?php echo $row['Item_ID'];?>" onchange="price_change(this.id, this.className);" onkeyup="price_change(this.id, this.className);">
					          	</div>
					          </td>
						        
						        <td>
								<input type="text" style="background:unset; border:unset; text-align:center;" disabled class="item_total" id="item_total<?php echo $row['Item_ID'];?>" name="total" value="<?php $price = $row['Item_Price'];$qty = $row['Equip_B_Qty'];$total = $price*$qty;echo sprintf('%.2f',$total);?>">
								</td>
								<td>
								<input type="hidden" name="id[]" value="<?php echo $row['Equip_B_Item_ID'];?>">
								</td>
							  </tr><!-- END TR-->
							  

						<?php
						}
					}
					?>
					<tr class="text-center">
					<td colspan="6">
						<a id="book.php?delete&vid=<?php echo $vid?>&id=<?php echo $book_pack_id?>&did=0" onclick="confirmDeleteAll(this.id);" class="btn btn-primary py-3 px-4 col-lg-5 remove">Delete All</a>
					</td>
					</tr>
						    </tbody>
						  </table>
						  
					  </div>
    			</div>
    		</div>

    		<div class="row justify-content-start">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
						<h3>Package Totals</h3>
						<?php
							$b_sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
							$b_result = mysqli_query($connect, $b_sql);
							$b_row =mysqli_fetch_assoc($b_result);
							$pack_id = $b_row['Pack_ID'];
							if($pack_id==0)
							{
								$pack_price=0;
							}
							else
							{
								$p_sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_ID = '$pack_id'";
								$p_result = mysqli_query($connect, $p_sql);
								$p_row =mysqli_fetch_assoc($p_result);
								$pack_price = $p_row['Pack_Price'];
							}
						?>
						<f>
						<p class="d-flex">
    						<span>Package</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="package" name="package" value="<?php echo sprintf('%.2f',$pack_price);?>"></span>
    					</p>
    					<p class="d-flex">
    						<span>Addon/Customize</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="subtotal" name="subtotal_p"></span>
    					</p>
    					<p class="d-flex">
    						<span>Venue</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="venue" name="venue_P" value="<?php echo sprintf('%.2f',$v_row['Event_Venue_Price']);?>"></span>
    					</p>
						<p class="d-flex">
    						<span>Theme</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="theme_price" name="theme_p" value="0.00"></span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span><input type="text" style="background:unset; border:unset;" readonly id="pay" name="pay"></span>
    					</p>
    				</div>

					<input type="submit" id="sbmt_book_item" name="sbmt_book_item" style="display:none;">
					<p class="text-center"><input type="submit" id="pay_item" name="pay_item" class="btn btn-primary py-3 px-4" value="Proceed to Checkout"></p>
					</form>
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

		$(".quantity :input").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    		}
		});
		function addressLocked()
		{
			var vid = document.getElementById("venue_p").value;
			if(vid !=0)
			{
				document.getElementById("S_Address").setAttribute("readonly", true);
				document.getElementById("Area").setAttribute("readonly", true);
				document.getElementById("P_Code").setAttribute("readonly", true);
			}
			else
			{
				document.getElementById("S_Address").removeAttribute("readonly");
				document.getElementById("Area").removeAttribute("readonly");
				document.getElementById("P_Code").removeAttribute("readonly");
			}
		}
		function onloadTheme()
		{
			theme = document.getElementById("theme").value;
			if(theme==1)
			{
				document.getElementById("theme_name").setAttribute("readonly", true);
				document.getElementById("theme_name").value="Default Theme";
				var price = 0;
				document.getElementById("theme_price").value=price.toFixed(2);
			}
			else
			{
				var price = 300;
				document.getElementById("theme_price").value=price.toFixed(2);
			}
		}
	  	function themeChange(theme)
		{
			if(theme==1)
			{
				document.getElementById("theme_name").setAttribute("readonly", true);
				document.getElementById("theme_name").value="Default Theme";
				var price = 0;
				document.getElementById("theme_price").value=price.toFixed(2);
			}
			else
			{
				document.getElementById("theme_name").removeAttribute("readonly");
				document.getElementById("theme_name").value="";
				var price = 300;
				document.getElementById("theme_price").value=price.toFixed(2);
			}
		}

		function onload_update()
		{
			var pack_id = <?php echo $pack_id; ?>;
			if(pack_id!=0)
			{
			var pack_price = <?php echo $pack_price; ?>;
			var all_price = document.getElementsByClassName("item_total");
			sub_total=0;
			less_check=0;
			var i;
			var count_id = [];
			var count_i = 0;
			count = 0;
			for (i = 0; i < all_price.length ; i++) 
			{
				<?php
					$i_sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$pack_id'";
					$i_result = mysqli_query($connect, $i_sql);
					$i_num_row = mysqli_num_rows($i_result);
					while($i_row =mysqli_fetch_assoc($i_result))
					{
				?>
				if(all_price[i].id == "item_total<?php echo $i_row['Equip_P_Item_ID'] ?>")
				{
					count_id[count_i]=all_price[i].id;
					qty = document.getElementById("qty<?php echo $i_row['Equip_P_Item_ID'];?>").value;
					if( qty == <?php echo $i_row['Equip_P_Qty'];?> )
					{
						count +=1;
					}
					else if(qty < <?php echo $i_row['Equip_P_Qty'];?>)
					{
						sub_total=0;
						pack_price = 0;
						document.getElementById("package").value = pack_price.toFixed(2);
						count-=1;
						less_check=1;
					}
					else if(qty > <?php echo $i_row['Equip_P_Qty'];?>)
					{
						if(less_check==0)
						{
							ori_qty = <?php echo $i_row['Equip_P_Qty'];?>;
							add_qty = qty - ori_qty;
							item_price = document.getElementById("price<?php echo $i_row['Equip_P_Item_ID'];?>").value;
							add_price = add_qty * item_price;
							sub_total += add_price;
							count +=1;
						}
					}
					count_i++;
				}
				<?php
					}
				?>
			}
			if(less_check==1)
			{
				for (j = 0; j < all_price.length ; j++)
				{
					sub_total += parseInt(all_price[j].value);
				} 
			}
			else
			{
				var miss_id = [];
				var miss_count =0;
				for (i = 0; i < all_price.length ; i++) 
				{
					if(count_id.includes(all_price[i].id))
					{

					}
					else
					{
						miss_id[miss_count]=all_price[i].id;
						miss_count++;
					}
				}
				for( i=0;i<miss_id.length;i++)
				{
					add = parseInt(document.getElementById(miss_id[i]).value);
					sub_total+=add;
				}
			}
			if(count == <?php echo $i_num_row?>)
			{
				pack_price = <?php echo $pack_price; ?>;
			}
			document.getElementById("package").value = pack_price.toFixed(2);
			document.getElementById("subtotal").value = sub_total.toFixed(2);
			venue = parseInt(<?php echo sprintf('%.2f',$v_row['Event_Venue_Price']);?>);
			onloadTheme();
			theme = parseInt(document.getElementById("theme_price").value);
			total = sub_total+pack_price;
			total += venue;
			total += theme;
			document.getElementById("pay").value = total.toFixed(2);
			}
			else
			{
				var all_price = document.getElementsByClassName("item_total");
				var sub_total=0;
				var i;
				var pack_price=0;
				count = 0;
				for (i = 0; i < all_price.length ; i++) 
				{
					sub_total += parseInt(all_price[i].value);
				}
				document.getElementById("subtotal").value = sub_total.toFixed(2);
				venue = parseInt(document.getElementById("venue").value);
				theme = parseInt(document.getElementById("theme_price").value);
				total = sub_total+pack_price;
				total += venue;
				total += theme;
				document.getElementById("pay").value = total.toFixed(2);
			}
		}
		
		function price_change(qtyid,classname)
		{
			var itemarray = classname.split("input-number");
			var item_id = itemarray[1];
			var id = qtyid.split("qty");
			var qty = document.getElementById(qtyid).value;
			var price = document.getElementById("price"+id[1]).value;
			var change = price*qty;
			document.getElementById("item_total"+id[1]).value = change.toFixed(2);
			onload_update();
		}
		function confirmDelete(durl)
		{
            swal({
                title: 'Delete Item',
                text: 'Do You Want To Delete The Item?',
                icon: 'info',
                buttons: {
                    cancel: 'No',
                    Yes: true,
                },
            }).then((value) => {
                switch (value) {
                case 'Yes':
				location.href = durl;
                break;

            }
			});
		}
		function confirmDeleteAll(durl)
		{
            swal({
                title: 'Delete All',
                text: 'Do You Want To Delete All The Item?',
                icon: 'info',
                buttons: {
                    cancel: 'No',
                    Yes: true,
                },
            }).then((value) => {
                switch (value) {
                case 'Yes':
				location.href = durl;
                break;

            }
			});
		}
		function savedDetail(id)
		{
			document.getElementById("event_name").removeAttribute("required");
			document.getElementById("theme_name").removeAttribute("required");
			document.getElementById("theme").removeAttribute("required");
			document.getElementById("event_date").removeAttribute("required");
			document.getElementById("time").removeAttribute("required");
			document.getElementById("venue_p").removeAttribute("required");
			document.getElementById("S_Address").removeAttribute("required");
			document.getElementById("Area").removeAttribute("required");
			document.getElementById("state").removeAttribute("required");
			document.getElementById("P_Code").removeAttribute("required");
			document.getElementById("P_Code").removeAttribute("pattern");
			if(id==0)
			{
				document.getElementById("S_Address").removeAttribute("readonly");
				document.getElementById("Area").removeAttribute("readonly");
				document.getElementById("P_Code").removeAttribute("readonly");
				document.getElementById("S_Address").value=" ";
				document.getElementById("Area").value=" ";
				document.getElementById("P_Code").value=" ";
				document.getElementById("venue").value="0.00";
			}
			onload_update();
			document.getElementById("sbmt_book_item").click();
		}
		function loadclick()
		{
			document.getElementById("sbmt_book_item").click();
		}
		$('a:not(.remove)').on('click', function(e){
			e.preventDefault();
			let url = this.href;
			swal({
                title: 'Leaving Page',
                text: 'Do You Want To Leave This Page Without Saving Your Change?',
                icon: 'info',
                buttons: {
                    cancel: 'No',
					save: {
					text: "Save My Change First",
					value: "save",
					},
                    Yes: true,

                },
            }).then((value) => {
                switch (value) {
                case 'Yes':
				window.location.href = url;
                break;
				case "save":
					document.getElementById("event_name").removeAttribute("required");
					document.getElementById("theme_name").removeAttribute("required");
					document.getElementById("theme").removeAttribute("required");
					document.getElementById("event_date").removeAttribute("required");
					document.getElementById("time").removeAttribute("required");
					document.getElementById("venue_p").removeAttribute("required");
					document.getElementById("S_Address").removeAttribute("required");
					document.getElementById("Area").removeAttribute("required");
					document.getElementById("state").removeAttribute("required");
					document.getElementById("P_Code").removeAttribute("required");
					document.getElementById("sbmt_book_item").click();
				break;
            }
			});
		});
	</script>
  </body>
</html>

<?php
if (isset($_GET["delete"])) 
{
	$d_id =$_GET["did"];
	if($d_id=="0")
	{
		$d_sql = "DELETE FROM equip_book_package WHERE Equip_B_Pack_ID='$book_pack_id'";
		mysqli_query($connect,$d_sql);
		$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
		$result = mysqli_query($connect, $sql);
		$row =mysqli_fetch_assoc($result);
		$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
		$new_book_pack_name ="Empty_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
		$sql = "UPDATE book_package SET Book_Pack_Price = '0', Pack_ID = '0', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
		mysqli_query($connect, $sql);
	}
	else
	{	
	$d_sql = "DELETE FROM equip_book_package WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$d_id'";
	mysqli_query($connect,$d_sql);
	if($pack_id!=0)
	{
		$i_sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$pack_id'";
		$i_result = mysqli_query($connect, $i_sql);
		$found =0;
		while($i_row =mysqli_fetch_assoc($i_result))
		{
			$i_id = $i_row['Equip_P_Item_ID'];
			$c_sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID = '$book_pack_id' AND Equip_B_isDelete!=1";
			$c_result = mysqli_query($connect, $c_sql);
			while($c_row =mysqli_fetch_assoc($c_result))
			{
				$c_id = $c_row['Equip_B_Item_ID'];
				if($i_id==$c_id)
				{
					$found =0;
					break;
				}
				else
				{
					$found=1;
				}
			}
			if($found==1)
			{
				break;
			}
		}
		if($found==1)
		{
			$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
			$result = mysqli_query($connect, $sql);
			$row =mysqli_fetch_assoc($result);
			$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
			$new_book_pack_name ="Customize_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
			$sql = "UPDATE book_package SET Book_Pack_Price = '0', Pack_ID = '0', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
			mysqli_query($connect, $sql);
		}
	}
	}
	?>
	<script>
	window.location.replace("book.php?vid=<?php echo $vid?>&id=<?php echo $book_pack_id ?>");
	</script>
	<?php
}
if(isset($_POST['sbmt_book_item'])) 
{
	$event_name = $_POST['event_name'];
	$event_theme_id = $_POST['event_theme_id'];
	$event_theme = $_POST['event_theme'];
	$event_date = $_POST['event_date'];
	$event_time = $_POST['event_time'];
	$event_venue_id = $_POST['event_venue_id'];
	if($event_venue_id==0)
	{
	$s_address = $_POST['address'];
	$s_area = $_POST['area'];
	$s_state = $_POST['state'];
	$s_pcode = $_POST['code'];
	}
	else
	{
		$s_address ="";
		$s_area = "";
		$s_state = "";
		$s_pcode = "";
	}
	$today = date("Y-m-d H:i:s"); 
	$sql = "SELECT * from book WHERE Book_isCheck!=1 and Book_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
	$count_row =mysqli_num_rows($result);
	if($count_row==0)
	{
		$sql = "INSERT INTO book(Book_Date_Time, Book_Event_Date, Book_Event_Time, Book_Event_Name, Book_Event_Venue_S_Address, Book_Event_Venue_Area, Book_Event_Venue_State,Book_Event_Venue_Pcode, Book_Event_Theme, Book_Event_Theme_Name, Book_Event_Venue_ID, Book_Cust_ID, Book_Pack_ID) VALUES ('$today', '$event_date', '$event_time', '$event_name', '$s_address', '$s_area', '$s_state', '$s_pcode', '$event_theme_id', '$event_theme', '$event_venue_id', '$cust_id', '$book_pack_id')";
		mysqli_query($connect,$sql);
	}
	else
	{
		$sql = "UPDATE book SET Book_Date_Time = '$today', Book_Event_Date = '$event_date', Book_Event_Time = '$event_time', Book_Event_Name = '$event_name', Book_Event_Venue_S_Address = '$s_address', Book_Event_Venue_Area = '$s_area', Book_Event_Venue_State = '$s_state', Book_Event_Venue_Pcode = '$s_pcode', Book_Event_Theme = '$event_theme_id', Book_Event_Theme_Name = '$event_theme', Book_Event_Venue_ID = '$event_venue_id' where Book_Cust_ID='$cust_id' and Book_isCheck =0 and Book_Pack_ID='$book_pack_id'";
		mysqli_query($connect,$sql);
	}
	$qty = $_POST['quantity']; 
	$ids = $_POST['id'];
	$count_qty = 0;
	if($ids=="")
	{
		?>
		<script>
		swal({
					title: "No Item",
					text: "Please insert item/package in your cart",
					icon: "info",
					button: "Continue",
				  }).then(function() {
					location.replace("package.php");
			  });
		</script>
		<?php
		exit;
	}
	else{
	foreach($qty as $item_qty)
    {
		$item_id=$ids[$count_qty];
		$sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$item_id' and Equip_B_isDelete !=1";
		$result = mysqli_query($connect, $sql);
		$count = mysqli_num_rows($result);
			if($count==1)
			{	
				$bp_sql ="UPDATE equip_book_package SET Equip_B_Qty= '$item_qty' WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$item_id' and Equip_B_isDelete !=1";
				mysqli_query($connect, $bp_sql);
			}
		$count_qty = $count_qty + 1;
	}
	if($pack_id!=0)
	{
		$i_sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$pack_id'";
		$i_result = mysqli_query($connect, $i_sql);
		$found =0;
		while($i_row =mysqli_fetch_assoc($i_result))
		{
			$i_id = $i_row['Equip_P_Item_ID'];
			$i_qty = $i_row['Equip_P_Qty'];
			$c_sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID = '$book_pack_id' AND Equip_B_isDelete!=1";
			$c_result = mysqli_query($connect, $c_sql);
			while($c_row =mysqli_fetch_assoc($c_result))
			{
				$c_id = $c_row['Equip_B_Item_ID'];
				$c_qty = $c_row['Equip_B_Qty'];
				if($i_id==$c_id)
				{
					if($c_qty>=$i_qty)
					{
						$found =0;
					}
					else
					{
						$found =1;
						break;
					}
				}
			}
			if($found==1)
			{
				break;
			}
		}
		if($found==1)
		{
			$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
			$result = mysqli_query($connect, $sql);
			$row =mysqli_fetch_assoc($result);
			$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
			$new_book_pack_name ="Customize_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
			$sql = "UPDATE book_package SET Book_Pack_Price = '0', Pack_ID = '0', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
			mysqli_query($connect, $sql);
		}
	}
	else
	{
		$ap_sql = "SELECT * from package WHERE Pack_isDelete!=1 ";
		$ap_result = mysqli_query($connect, $ap_sql);
		while($ap_row =mysqli_fetch_assoc($ap_result))
		{
			$ap_id = $ap_row['Pack_ID'];
			$ai_sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$ap_id'";
			$ai_result = mysqli_query($connect, $ai_sql);
			$ai_num_row =mysqli_num_rows($ai_result);
			$found=0;
			while($i_row =mysqli_fetch_assoc($ai_result))
			{
				$i_id = $i_row['Equip_P_Item_ID'];
				$i_qty = $i_row['Equip_P_Qty'];
				$c_sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID = '$book_pack_id' AND Equip_B_isDelete!=1";
				$c_result = mysqli_query($connect, $c_sql);
				while($c_row =mysqli_fetch_assoc($c_result))
				{
					$c_id = $c_row['Equip_B_Item_ID'];
					$c_qty = $c_row['Equip_B_Qty'];
					if($i_id==$c_id)
					{
						if($c_qty>=$i_qty)
						{
							$found++;
							break;
						}

					}

				}
			}
			if($found==$ai_num_row)
			{
				$found_pack=1;
				break;
			}
		}
		if($found_pack==1)
		{
			$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
			$result = mysqli_query($connect, $sql);
			$row =mysqli_fetch_assoc($result);
			$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
			$new_sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_ID = '$ap_id'";
			$new_result = mysqli_query($connect, $new_sql);
			$new_row =mysqli_fetch_assoc($new_result);
			$new_pack_price =$new_row['Pack_Price'];
			$new_book_pack_name =$new_row['Pack_Name']."_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
			$sql = "UPDATE book_package SET Book_Pack_Price = '$new_pack_price', Pack_ID = '$ap_id', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
			mysqli_query($connect, $sql);
			?>
			<script>
			swal({
                        title: "Package Found",
                        text: "Your Item and Quantity Is Suit To <?php echo $new_row['Pack_Name']; ?>",
                        icon: "info",
                        button: "Continue",
                      }).then(function() {
                        location.replace("book.php?vid=<?php echo $vid?>&id=<?php echo $book_pack_id ?>");
                  });
			</script>
			<?php
			exit;
		}
	}
	?>
	<script>
	window.location.replace("book.php?vid=<?php echo $event_venue_id?>&id=<?php echo $book_pack_id ?>");
	</script>
	<?php
}
}
if(isset($_POST['pay_item']))
{
	$event_name = $_POST['event_name'];
	$event_theme_id = $_POST['event_theme_id'];
	$event_theme = $_POST['event_theme'];
	$event_date = $_POST['event_date'];
	$event_time = $_POST['event_time'];
	$event_venue_id = $_POST['event_venue_id'];
	$s_address = $_POST['address'];
	$s_area = $_POST['area'];
	$s_state = $_POST['state'];
	$s_pcode = $_POST['code'];
	$today = date("Y-m-d H:i:s"); 
	$sql = "SELECT * from book WHERE Book_isCheck!=1 and Book_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
	$count_row =mysqli_num_rows($result);
	if($count_row==0)
	{

		$sql = "INSERT INTO book(Book_Date_Time, Book_Event_Date, Book_Event_Time, Book_Event_Name, Book_Event_Venue_S_Address, Book_Event_Venue_Area, Book_Event_Venue_State,Book_Event_Venue_Pcode, Book_Event_Theme, Book_Event_Theme_Name, Book_Event_Venue_ID, Book_Cust_ID, Book_Pack_ID) VALUES ('$today', '$event_date', '$event_time', '$event_name', '$s_address', '$s_area', '$s_state', '$s_pcode', '$event_theme_id', '$event_theme', '$event_venue_id', '$cust_id', '$book_pack_id')";
		mysqli_query($connect,$sql);
	}
	else
	{
		$sql = "UPDATE book SET Book_Date_Time = '$today', Book_Event_Date = '$event_date', Book_Event_Time = '$event_time', Book_Event_Name = '$event_name', Book_Event_Venue_S_Address = '$s_address', Book_Event_Venue_Area = '$s_area', Book_Event_Venue_State = '$s_state', Book_Event_Venue_Pcode = '$s_pcode', Book_Event_Theme = '$event_theme_id', Book_Event_Theme_Name = '$event_theme', Book_Event_Venue_ID = '$event_venue_id' where Book_Cust_ID='$cust_id' and Book_isCheck =0 and Book_Pack_ID='$book_pack_id'";
		mysqli_query($connect,$sql);
	}

	$qty = $_POST['quantity']; 
	$ids = $_POST['id'];
	$count_qty = 0;
	if($ids=="")
	{
		?>
		<script>
		swal({
					title: "No Item",
					text: "Please insert item/package in your cart",
					icon: "info",
					button: "Continue",
				  }).then(function() {
					location.replace("package.php");
			  });
		</script>
		<?php
		exit;
	}
	else{
	foreach($qty as $item_qty)
    {
		$item_id=$ids[$count_qty];
		$sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$item_id' and Equip_B_isDelete !=1";
		$result = mysqli_query($connect, $sql);
		$count = mysqli_num_rows($result);
			if($count==1)
			{	
				$bp_sql ="UPDATE equip_book_package SET Equip_B_Qty= '$item_qty' WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$item_id' and Equip_B_isDelete !=1";
				mysqli_query($connect, $bp_sql);
			}
		$count_qty = $count_qty + 1;
	}
	if($pack_id!=0)
	{
		$i_sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$pack_id'";
		$i_result = mysqli_query($connect, $i_sql);
		$found =0;
		while($i_row =mysqli_fetch_assoc($i_result))
		{
			$i_id = $i_row['Equip_P_Item_ID'];
			$i_qty = $i_row['Equip_P_Qty'];
			$c_sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID = '$book_pack_id' AND Equip_B_isDelete!=1";
			$c_result = mysqli_query($connect, $c_sql);
			while($c_row =mysqli_fetch_assoc($c_result))
			{
				$c_id = $c_row['Equip_B_Item_ID'];
				$c_qty = $c_row['Equip_B_Qty'];
				if($i_id==$c_id)
				{
					if($c_qty>=$i_qty)
					{
						$found =0;
					}
					else
					{
						$found =1;
						break;
					}
				}
			}
			if($found==1)
			{
				break;
			}
		}
		if($found==1)
		{
			$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
			$result = mysqli_query($connect, $sql);
			$row =mysqli_fetch_assoc($result);
			$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
			$new_book_pack_name ="Customize_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
			$sql = "UPDATE book_package SET Book_Pack_Price = '0', Pack_ID = '0', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
			mysqli_query($connect, $sql);
		}
	}
	else
	{
		$ap_sql = "SELECT * from package WHERE Pack_isDelete!=1 ";
		$ap_result = mysqli_query($connect, $ap_sql);
		while($ap_row =mysqli_fetch_assoc($ap_result))
		{
			$ap_id = $ap_row['Pack_ID'];
			$ai_sql = "SELECT * from equip_package WHERE Equip_P_isDelete!=1 and Equip_P_Pack_ID = '$ap_id'";
			$ai_result = mysqli_query($connect, $ai_sql);
			$ai_num_row =mysqli_num_rows($ai_result);
			$found=0;
			while($i_row =mysqli_fetch_assoc($ai_result))
			{
				$i_id = $i_row['Equip_P_Item_ID'];
				$i_qty = $i_row['Equip_P_Qty'];
				$c_sql = "SELECT * FROM equip_book_package WHERE Equip_B_Pack_ID = '$book_pack_id' AND Equip_B_isDelete!=1";
				$c_result = mysqli_query($connect, $c_sql);
				while($c_row =mysqli_fetch_assoc($c_result))
				{
					$c_id = $c_row['Equip_B_Item_ID'];
					$c_qty = $c_row['Equip_B_Qty'];
					if($i_id==$c_id)
					{
						if($c_qty>=$i_qty)
						{
							$found++;
							break;
						}

					}

				}
			}
			if($found==$ai_num_row)
			{
				$found_pack=1;
				break;
			}
		}
		if($found_pack==1)
		{
			$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
			$result = mysqli_query($connect, $sql);
			$row =mysqli_fetch_assoc($result);
			$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
			$new_sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_ID = '$ap_id'";
			$new_result = mysqli_query($connect, $new_sql);
			$new_row =mysqli_fetch_assoc($new_result);
			$new_pack_price =$new_row['Pack_Price'];
			$new_book_pack_name =$new_row['Pack_Name']."_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
			$sql = "UPDATE book_package SET Book_Pack_Price = '$new_pack_price', Pack_ID = '$ap_id', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
			mysqli_query($connect, $sql);
			?>
			<script>
			swal({
                        title: "Package Found",
                        text: "Your Item and Quantity Is Suit To <?php echo $new_row['Pack_Name']; ?>\nPlease Redo The Check Out",
                        icon: "info",
                        button: "Continue",
                      }).then(function() {
                        location.replace("book.php?vid=<?php echo $vid?>&id=<?php echo $book_pack_id ?>");
                  });
			</script>
			<?php
			exit;
		}
		else
		{
			$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
			$result = mysqli_query($connect, $sql);
			$row =mysqli_fetch_assoc($result);
			$ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
			$new_book_pack_name ="Customize_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
			$sql = "UPDATE book_package SET Book_Pack_Price = '0', Pack_ID = '0', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
			mysqli_query($connect, $sql);
		}
	}

	$package = $_POST['package'];
	$subtotal = $_POST['subtotal_p'];
	$theme = $_POST['theme_p'];
	$sql = "UPDATE book_package SET Book_Pack_Price = '$package', Book_Pack_Addon_Price = '$subtotal', Book_Pack_Theme_Price = '$theme' WHERE Book_Pack_ID='$book_pack_id'";
	mysqli_query($connect, $sql);
	$sql = "SELECT * FROM book where Book_isCheck =0 and Book_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);
	$book_id = $row['Book_ID'];
	?>
	<script>
	window.location.replace("checkout.php?id=<?php echo $book_id?>");
	</script>
	<?php
}
}
?>
