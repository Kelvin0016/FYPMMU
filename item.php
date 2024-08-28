<?php session_start();?>
<?php include "dataconnection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Item</title>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Item</span></p>
            <h1 class="mb-0 bread">Item</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row" style="justify-content: center;">
    			<div class="col-md-8 col-lg-10 order-md-last">
    				<div class="row">
					<?php
					$results_per_page = 6;
					$sql = "SELECT * from item WHERE Item_isDelete!=1";
					$result = mysqli_query($connect, $sql);
					$num_of_results = mysqli_num_rows($result);
					$num_of_pages = ceil($num_of_results/$results_per_page);
					if (!isset($_GET['page'])) {
						$page = 1;
					  } else {
						$page = $_GET['page'];
					  }

					$this_page_first_result = ($page-1)*$results_per_page;
					$sql='SELECT * FROM item WHERE item_isDelete!=1 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
					$result = mysqli_query($connect, $sql);

					while($row =mysqli_fetch_assoc($result))
					{	
				?>	
    			<div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<div class="img-prod" id="item-img<?php echo $row['Item_ID'];?>"><img class="img-fluid" src="<?php echo $row['Item_Picture'];?>" alt="<?php echo $row['Item_Name'];?>" id="img<?php echo $row['Item_ID'];?>" style="object-fit:cover;">
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
	    						<p class="price"><span>RM <?php echo sprintf('%.2f',$row['Item_Price']);?></span></p>
							</div>
							<form name="item-form" method="post">
	    					<p class="bottom-area d-flex px-3">	
								<input type="hidden" value="<?php echo $row['Item_ID'];?>" name="item_ID">
								<input type="submit" onclick="book_check(); return check();" name="itemSbmt"  class="add-to-cart text-center py-2 mr-1" value="Add Item">
								<input type="number" class="num buy-now text-center py-2" style="width:50px; height:50px;" min="1" name="item_Qty" required>
							</p>
							</form>
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
							  echo "<li id='".$page."' class=''><a href='item.php?page=".$page."'>".$page."</a></li>";
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
if(isset($_POST["itemSbmt"]))
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