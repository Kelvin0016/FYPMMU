<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customers</title>
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/site.css">
        <link rel='shortcut icon' href='../images/Logo.png' />
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
            <h1>Customers</h1>
        </div>
        <div class="filter-area">
          <div class="row filter">
            <div>
                 <input type="button" value="PDF" onclick="window.open('pdf.php?tab=customer')" class="btn" style="margin-right:10px;">
            </div>
              <div class="" style="margin-right: 5px;">
                  <select name="filter" id="" class="filter-type" >
                    <option value="0">Filter by</option>
                    <option value="2">Name</option>
                    <option value="3">Email</option>
                    <option value="4">Phone Number</option>
                    <option value="5">Type of membership</option>
                    <option value="6">Customer ID</option>
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
                        <th>No.</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Type of membership</th><th>Customer ID</th><th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                  $results_per_page = 10;
                  $result=mysqli_query($connect,"SELECT * from customer WHERE Cust_isDelete = '0' and Cust_isVerify = 1 ");
                  //pagination
                  $num_of_results = mysqli_num_rows($result);
                  $num_of_pages = ceil($num_of_results/$results_per_page);
                  if (!isset($_GET['page'])) {
                    $page = 1;
                    } else {
                    $page = $_GET['page'];
                    }

                  $this_page_first_result = ($page-1)*$results_per_page;
                  $sql='SELECT * FROM customer WHERE Cust_isDelete = "0" and Cust_isVerify = 1 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                  $result = mysqli_query($connect, $sql);
                ?>
                <tbody>
                <?php
                  $count = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    $membership =$row['Cust_Membership'];
                    if($membership == 1)
                    {
                      $member = "Personal";
                    }
                    else if($membership == 2)
                    {
                      $member = "Company";
                    }
                    else if($membership == 0)
                    {
                      $member = "Other";
                    }
                    ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $row["Cust_Name"]; ?></td>
                        <td><?php echo $row["Cust_Email"]; ?></td>
                        <td><?php echo $row["Cust_PhoneNo"]?></td>
                        <td><?php echo $member;?></td>
                        <td><?php echo $row["Cust_ID"]?></td>
                        <td class="more"><a href="cust-details.php?id=<?php echo $row["Cust_ID"]?>">More</a></td>
                        <td class="del"><a id="cust-view.php?id=<?php echo $row["Cust_ID"]?>" onclick="return delConfirmation(this.id)">Delete</a></td>
                    </tr>
                    <?php
                  }
                  ?>
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
							  echo "<li id='".$page."' class=''><a href='cust-view.php?page=".$page."'>".$page."</a></li>";
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
              }
              else{
                $(".del").css("display","");
                $(".more").css("border","");
              }
            $(".cust-view-link").addClass("active");
          });

        </script>

        <?php
          if (isset($_GET["id"])) 
          {
            $custID = $_GET["id"];
            $sql = "SELECT * FROM book where Book_Cust_ID = '$custID' and Book_Status = 0";
            $result = mysqli_query($connect,$sql);
            $num_rows = mysqli_num_rows($result);
            if($num_rows >0)
            {
              ?>
              <script>
                swal({
                  title: "Cannot Delete",
                  text: "This customer still have booking is On Pending\nSo cannot delete account.",
                  icon: "error",
                  button: "Close",
                });
              </script>
              <?php
            }
            else
            {
              $today = date("Y-m-d");
              $sql = "SELECT * FROM book where Book_Cust_ID = '$custID' and Book_Status = 1 and Book_Event_Date > '$today'";
              $result = mysqli_query($connect,$sql);
              $num_rows = mysqli_num_rows($result);
              if($num_rows >0)
              {
                ?>
                <script>
                  swal({
                    title: "Cannot Delete",
                    text: "This customer have booking is ACCEPTED\n(Haven't Pass Event Date)\nSo cannot delete account.",
                    icon: "error",
                    button: "Close",
                  });
                </script>
                <?php
              }
              else
              {
                if(mysqli_query($connect,"UPDATE customer SET Cust_isDelete = '1' WHERE Cust_ID = '$custID'")){
                  $cu_sql = "SELECT * FROM customer where Cust_ID='$custID'";
                  $cu_result = mysqli_query($connect,$cu_sql);
                  $cu_row = mysqli_fetch_assoc($cu_result);
                  $to_email = $cu_row['Cust_Email'];
                  $subject = "Fiesta Corp: Account Deleted";
                  $from_email= "contact.us.fiesta@gmail.com";
                  $headers  = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type: text/html;" . "\r\n";
                  $headers .= "From: ".$from_email."\r\n".
                  "Reply-To: ".$from_email."\r\n" .
                  "X-Mailer: PHP/" . phpversion();
                      
                  $body = "<html><body>";
                  $body .= "<h3>Dear <span style='text-transform: uppercase';>".$cu_row['Cust_Name']."</span></h3>".
                                "<h4>Admin have Deleted Your Account!!!</h4>".
                                "<p><b>Customer ID:</b> ".$custID."<br>".
                                "<b>Customer Name:</b> ".$cu_row['Cust_Name']."<br>".
                                "<b>Customer Email:</b> ".$cu_row['Cust_Email']."<br>".
                                "<b>Customer Phone No.:</b> ".$cu_row['Cust_PhoneNo']."<br>".
                                "<b>Customer Membership:</b> ".$cu_row['Cust_Membership']."</p>".
                                "<p>If you want find back your account please contact with us.</p>".
                                "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
                        $body .= "</body></html>";
                        mail($to_email, $subject, $body,$headers);
                  ?>
                    <script>
                            swal({
                            title: "Deleted",
                            text: "Deleted Successfully!!!",
                            icon: "success",
                            button: "Continue",
                          }).then(function() {
                            location.replace("cust-view.php");
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