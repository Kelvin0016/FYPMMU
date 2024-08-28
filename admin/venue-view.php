<?php
  session_start();
  include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Venue</title>
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel='shortcut icon' href='../images/Logo.png' />
        <link rel="stylesheet" href="css/site.css">
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
    <body>
    <?php 
        include 'dataconnection.php';
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
        {
            $user_id = $_SESSION['admin_id'];
            include 'sidebar-admin.php';
            ?>
            <script>
              var $ad_super = 1;
            </script>
            <?php
        }
        else if(isset($_SESSION['super_id']) && !empty($_SESSION['super_id']))
        {
            $user_id = $_SESSION['super_id'];
            include 'sidebar-super.php';
            ?>
            <script>
              var $ad_super = 0;
            </script>
            <?php
        }
        ?>
      <div class="pg-content">
        <div class="title-area">
            <h1>Venue</h1>
        </div>
        <div class="filter-area">
          <div class="row filter">
            <div>
            <input type="button" value="ADD" onclick="window.location.href='venue-add.php?id=0'" class="btn add" style="margin-right:10px; background-color:red; color:white;">
                 <input type="button" value="PDF" onclick="window.open('pdf.php?tab=venue')" class="btn" style="margin-right:10px;">
            </div>
              <div class="" style="margin-right: 5px;">
                <select name="filter" id="" class="filter-type" >
                    <option value="0">Filter by</option>
                    <option value="2">Venue Name</option>
                    <option value="3">Price</option>
                    <option value="6">Venue ID</option>
                    <option value="4">State</option>
                    <option value="5">Venue Area</option>
                </select>
              </div>
              <div class="col-lg-2">
                  <input type="text" name="filterDetail" class="form-control filterText">
              </div>
          </div>
        </div>

        <div class="table-area">
            <table class="view-table">
                <thead>
                    <tr>
                        <th>No.</th><th>Venue Name</th><th>Price (RM)</th><th>State</th><th>Venue Area</th><th>Venue ID</th><th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                  $results_per_page = 10;
                  $result=mysqli_query($connect,"SELECT * from event_venue WHERE Event_Venue_isDelete = '0' AND Event_Venue_ID !=0;");
                  $num_of_results = mysqli_num_rows($result);
                  $num_of_pages = ceil($num_of_results/$results_per_page);
                  if (!isset($_GET['page'])) {
                    $page = 1;
                    } else {
                    $page = $_GET['page'];
                    }

                  $this_page_first_result = ($page-1)*$results_per_page;
                  $sql='SELECT * from event_venue WHERE Event_Venue_isDelete = 0 AND Event_Venue_ID !=0 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                  $result = mysqli_query($connect, $sql);
                ?>
                <tbody>
                <?php
                  $count = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $row["Event_Venue_Name"]; ?></td>
                        <td><?php echo $row["Event_Venue_Price"]; ?></td>
                        <td><?php echo $row["Event_Venue_State"]; ?></td>
                        <td><?php echo $row["Event_Venue_Area"]; ?></td>
                        <td><?php echo $row["Event_Venue_ID"]; ?></td>
                        <td class="more"><a href="venue-add.php?id=<?php echo $row["Event_Venue_ID"];?>">More</a></td>
                        <td class="del"><a id="venue-view.php?id=<?php echo $row["Event_Venue_ID"];?>" onclick="return delConfirmation(this.id)">Delete</a></td>
                    </tr>
                    <?php
                  }?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
						  <?php
						  for($page=1;$page<=$num_of_pages;$page++)
						  {
							  echo "<li id='".$page."' class=''><a href='venue-view.php?page=".$page."'>".$page."</a></li>";
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
        

        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>

        <script>
          $(document).ready(function(){
            if($ad_super == 0)
              {
                $(".del").css("display","none");
                $(".more").css("border","none");
                $(".add").css("display","none");
              }
              else{
                $(".del").css("display","");
                $(".more").css("border","");
              }
            $(".fifth").addClass("rotate");
            $(".venue-show").addClass("show4");
            $(".venue-view-link").addClass("active");
          });
        </script>

        <?php
          if (isset($_GET["id"])) 
          {
            $vID = $_GET["id"];
            $sql = "SELECT * FROM book where Book_Status = 0 and Book_Event_Venue_ID = '$vID'";
            $result = mysqli_query($connect,$sql);
            $total = mysqli_num_rows($result);
            if($total>0)
            {
              ?>
              <script>
                swal({
                  title: "Cannot Delete",
                  text: "Still have bookings on Pending where this venue is included.",
                  icon: "error",
                  button: "Close",
                }).then(function() {
                        location.replace("venue-view.php");
                  });
              </script>
              <?php
            }
            else{
              //find whether are there still accepted bookings that are still running where this item is included
              $today = date("Y-m-d");
              $sql = "SELECT * FROM book where Book_Status = 1 and Book_Event_Date > '$today' and Book_Event_Venue_ID = '$vID'";
              $result = mysqli_query($connect,$sql);
              $total = mysqli_num_rows($result);
              if($total>0)
              {
                ?>
                <script>
                  swal({
                    title: "Cannot Delete",
                    text: "Still have Accepted bookings that are still running where this item is included.",
                    icon: "error",
                    button: "Close",
                  }).then(function() {
                        location.replace("item-view.php");
                  });
                </script>
                <?php
              }
              else{
                if(mysqli_query($connect,"UPDATE event_venue SET Event_Venue_isDelete = '1' WHERE Event_Venue_ID = '$vID'")){
                  ?>
                    <script>
                            swal({
                            title: "Deleted",
                            text: "Deleted Successfully!!!",
                            icon: "success",
                            button: "Continue",
                          }).then(function() {
                            location.replace("venue-view.php");
                      });
                    </script>
                  <?php
                }
              }
            }
          }
        ?>
    </body>
</html>