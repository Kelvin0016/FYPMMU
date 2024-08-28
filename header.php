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
  </head>
  <body class="goto-here">
		<div class="py-1 bg-black">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+6018-3964936</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">contact.us.fiesta@gmail.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">Best Event Comapny in Melaka</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Fiesta Corp.</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
			  <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
			  <li class="nav-item"><a href="venue.php" class="nav-link">Venue</a></li>
			  <li class="nav-item dropdown">
			  
				<a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Package</a>
				<div class="dropdown-menu" aria-labelledby="dropdown04">
				
			<?php
				$sql = "SELECT * from events WHERE event_isDelete!=1";
				$result = mysqli_query($connect, $sql);
				while($row = mysqli_fetch_assoc($result))
				{	
			?>		
					<a class="dropdown-item" href="package.php?id=<?php echo $row['Event_ID'];?>"><?php echo $row['Event_Name'];?></a>
					<?php
					
				}		
			
			?>
				</div>
			  </li>
			  <li class="nav-item"><a href="item.php" class="nav-link">Item</a></li>
			  <li class="nav-item" id="sign_in"><a href="login_cust.php" class="nav-link">Sign In/Register</a></li>
			  <li class="nav-item dropdown" id="profile">
				<a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
				<div class="dropdown-menu" aria-labelledby="dropdown04">
					<a class="dropdown-item" href="user-profile.php">View Profile</a>
					<a class="dropdown-item" href="rate_cust.php">Rate Us</a>
					<a class="dropdown-item" href="booking_history.php">Booking History</a>
					<a class="dropdown-item" href="logout.php">Sign Out</a>
				</div>
			  </li>
			  <?php
				if(isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id']))
				{
					$cust_id = $_SESSION["cust_id"];
				}
				else
				{
					$cust_id=0;
				}
				$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
				$result = mysqli_query($connect, $sql);
				$row =mysqli_fetch_assoc($result);
				$count_row =mysqli_num_rows($result);
				if($count_row==0)
				{
					$book_pack_id=0;
				}
				else
				{
					$book_pack_id= $row['Book_Pack_ID'];
				}
			?>
	          <li class="nav-item cta cta-colored check" onclick="book_check()"><a href="book.php?id=<?php echo $book_pack_id ?>" class="nav-link" onclick="return check()"><span class="icon-shopping_cart"></span></a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
</body>
</html>
