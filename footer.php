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
  <section class="ftco-gallery">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-8 heading-section text-center mb-4 ftco-animate">
            <h2 class="mb-4">Previous Experience</h2>
          </div>
    		</div>
    	</div>
    	<div class="container-fluid px-0">
    		<div class="row no-gutters">
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery/1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery/1.jpg);">
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery/2.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery/2.jpg);">
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery/3.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery/3.jpg);">
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery/4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery/4.jpg);">
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery/5.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery/5.jpg);">
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery/6.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery/6.jpg);">
						</a>
					</div>
        </div>
    	</div>
    </section>

    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Fiesta Corp.</h2>
              <p>The best event company in Melaka.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="contact.php"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="contact.php"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="contact.php"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="about.php" class="py-2 d-block">About</a></li>
                <li><a href="contact.php" class="py-2 d-block">Contact</a></li>
                <li><a href="rate_cust.php" class="py-2 d-block">Rate & Comment</a></li>
                <li><a href="venue.php" class="py-2 d-block">Venue</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Package &amp; Item</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                  <?php
				$sql = "SELECT * from events WHERE event_isDelete!=1";
				$result = mysqli_query($connect, $sql);
				while($row = mysqli_fetch_assoc($result))
				{	
			?>		
                    <li><a href="package.php?id=<?php echo $row['Event_ID'];?>" class="py-2 d-block"><?php echo $row['Event_Name'];?></a></li>
                    <?php
					
				}		
			
			?>
	                <li><a href="item.php" class="py-2 d-block">Item</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">666, Kondominium Siantan Puri, Kampung Lapan, 75200 Melaka, Melaka</span></li>
	                <li><a href="tel:+6018-3964936"><span class="icon icon-phone"></span><span class="text">+018-3964936</span></a></li>
	                <li><a href="mailto:contact.us.fiesta@gmail.com"><span class="icon icon-envelope"></span><span class="text">contact.us.fiesta@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    </body>
</html>