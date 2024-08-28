<?php
  session_start();
  include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Booking</title>
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

    <style>
        
    </style>
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
            <h1>Bookings</h1>
        </div>
        <div class="filter-area">
          <div class="row filter">
              <div style="margin-right:20px;">
                <input type="button" value="ALL" class="btn btn-primary allBtn">
                <input type="button" value="PENDING" class="btn btn-primary pBtn">
                <input type="button" value="ACCEPTED" class="btn btn-primary aBtn">
                <input type="button" value="REJECTED" class="btn btn-primary rBtn">
                <input type="button" value="CANCELLED" class="btn btn-primary cBtn">
              </div>
            <div>
                 <input type="button" value="PDF" class="btn pdf1" style="margin-right:10px;" onclick="window.open('pdf.php?tab=booking');">
                 <input type="button" value="PDF2" onclick="window.open('pdf.php?tab=booking2');" class="btn pdf2" style="margin-right:10px;">
            </div>
              <div style="display:flex; margin-right:20px;">
                <div class="" style="margin-right: 5px;">
                  <select name="filter" id="" class="filter-type" >
                      <option value="0">Filter by</option>
                      <option value="2">Booking Name</option>
                      <option value="3">Customer Name</option>
                      <option value="4">Booking ID</option>
                      <option value="5">Booking Date & Time</option>
                      <option value="6">Event Date & Time</option>
                  </select>
                </div>
                <div class="">
                    <input type="text" name="filterDetail" class="form-control filterText">
                </div>
              </div>
          </div>
        </div>

        <div class="table-area">
            <table class="view-table">
                <thead>
                    <tr>
                        <th>No.</th><th>Booking Name</th><th>Customer Name</th><th>Booking ID</th><th>Booking Date & Time</th><th>Event Date & Time</th><th>Status</th><th>Action</th>
                    </tr>
                </thead>
                <tbody class="pending">
                    <?php
                        $result=mysqli_query($connect,"SELECT * from book where Book_isCheck = 1 AND Book_Status = 0");
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                        $custID = $row["Book_Cust_ID"];
                        $result2 = mysqli_query($connect,"SELECT * from customer where Cust_isDelete = 0 AND Cust_ID = '$custID';");
                        $row2=mysqli_fetch_assoc($result2);
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row["Book_Event_Name"]?></td>
                        <td><?php echo $row2["Cust_Name"]?></td>
                        <td><?php echo $row["Book_ID"]?></td>
                        <td><?php echo $row["Book_Date_Time"]?></td>
                        <td><?php echo $row["Book_Event_Date"]; echo "&nbsp;"; echo $row["Book_Event_Time"]?></td>
                        <td>
                            <?php
                                $stat = $row["Book_Status"];
                                if($stat == 0){
                                    ?><span class="badge badge-warning" style="font-size:20px;">Pending</span><?php
                                }else if($stat==1){
                                    ?><span class="badge badge-success" style="font-size:20px;">Accepted</span><?php
                                }else if($stat== 2){
                                    ?><span class="badge badge-danger" style="font-size:20px;">Rejected</span><?php
                                }else if($stat == 3){
                                    ?><span class="badge badge-secondary" style="font-size:20px;">Cancelled</span><?php
                                }
                            ?>
                        </td>
                        <td class="more"><a href="booking-details.php?id=<?php echo $row["Book_ID"] ?>">More</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tbody class="accept">
                    <?php
                        //get booking details
                        $result=mysqli_query($connect,"SELECT * from book where Book_isCheck = 1 AND Book_Status = 1");
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                        $custID = $row["Book_Cust_ID"];
                        //get the particular customer details for the booking
                        $result2 = mysqli_query($connect,"SELECT * from customer where Cust_isDelete = 0 AND Cust_ID = '$custID' ");//AND Cust_isVerified = 0;
                        $row2=mysqli_fetch_assoc($result2);
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row["Book_Event_Name"]?></td>
                        <td><?php echo $row2["Cust_Name"]?></td>
                        <td><?php echo $row["Book_ID"]?></td>
                        <td><?php echo $row["Book_Date_Time"]?></td>
                        <td><?php echo $row["Book_Event_Date"]; echo "&nbsp;"; echo $row["Book_Event_Time"]?></td>
                        <td>
                            <?php
                                $stat = $row["Book_Status"];
                                if($stat == 0){
                                    ?><span class="badge badge-warning" style="font-size:20px;">Pending</span><?php
                                }else if($stat==1){
                                    ?><span class="badge badge-success" style="font-size:20px;">Accepted</span><?php
                                }else if($stat== 2){
                                    ?><span class="badge badge-danger" style="font-size:20px;">Rejected</span><?php
                                }else if($stat == 3){
                                    ?><span class="badge badge-secondary" style="font-size:20px;">Cancelled</span><?php
                                }
                            ?>
                        </td>
                        <td class="more"><a href="booking-details.php?id=<?php echo $row["Book_ID"] ?>">More</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tbody class="reject">
                    <?php
                        $result=mysqli_query($connect,"SELECT * from book where Book_isCheck = 1 AND Book_Status = 2");
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                        $custID = $row["Book_Cust_ID"];
                        $result2 = mysqli_query($connect,"SELECT * from customer where Cust_isDelete = 0 AND Cust_ID = '$custID'");// AND Cust_isVerified = 0;
                        $row2=mysqli_fetch_assoc($result2);
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row["Book_Event_Name"]?></td>
                        <td><?php echo $row2["Cust_Name"]?></td>
                        <td><?php echo $row["Book_ID"]?></td>
                        <td><?php echo $row["Book_Date_Time"]?></td>
                        <td><?php echo $row["Book_Event_Date"]; echo "&nbsp;"; echo $row["Book_Event_Time"]?></td>
                        <td>
                            <?php
                                $stat = $row["Book_Status"];
                                if($stat == 0){
                                    ?><span class="badge badge-warning" style="font-size:20px;">Pending</span><?php
                                }else if($stat==1){
                                    ?><span class="badge badge-success" style="font-size:20px;">Accepted</span><?php
                                }else if($stat== 2){
                                    ?><span class="badge badge-danger" style="font-size:20px;">Rejected</span><?php
                                }else if($stat == 3){
                                    ?><span class="badge badge-secondary" style="font-size:20px;">Cancelled</span><?php
                                }
                            ?>
                        </td>
                        <td class="more"><a href="booking-details.php?id=<?php echo $row["Book_ID"] ?>">More</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tbody class="cancel">
                    <?php
                        $result=mysqli_query($connect,"SELECT * from book where Book_isCheck = 1 AND Book_Status = 3");
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                        $custID = $row["Book_Cust_ID"];
                        $result2 = mysqli_query($connect,"SELECT * from customer where Cust_isDelete = 0 AND Cust_ID = '$custID'");// AND Cust_isVerified = 0;
                        $row2=mysqli_fetch_assoc($result2);
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row["Book_Event_Name"]?></td>
                        <td><?php echo $row2["Cust_Name"]?></td>
                        <td><?php echo $row["Book_ID"]?></td>
                        <td><?php echo $row["Book_Date_Time"]?></td>
                        <td><?php echo $row["Book_Event_Date"]; echo "&nbsp;"; echo $row["Book_Event_Time"]?></td>
                        <td>
                            <?php
                                $stat = $row["Book_Status"];
                                if($stat == 0){
                                    ?><span class="badge badge-warning" style="font-size:20px;">Pending</span><?php
                                }else if($stat==1){
                                    ?><span class="badge badge-success" style="font-size:20px;">Accepted</span><?php
                                }else if($stat== 2){
                                    ?><span class="badge badge-danger" style="font-size:20px;">Rejected</span><?php
                                }else if($stat == 3){
                                    ?><span class="badge" style="font-size:20px; background-color:orange;">Cancelled</span><?php
                                }
                            ?>
                        </td>
                        <td class="more"><a href="booking-details.php?id=<?php echo $row["Book_ID"] ?>">More</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>

            </table>
        </div>
      </div>
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
                $(".more").css("border","none");
              }
              else{
                $(".more").css("border","");
              }
            $(".booking-view-link").addClass("active");
            $(".accept").css("display","");
            $(".reject").css("display","");
            $(".cancel").css("display","");

          });

          $(".pBtn").click(function(){
            $(".pending").css("display","");
            $(".accept").css("display","none");
            $(".reject").css("display","none");
            $(".cancel").css("display","none");
          });

          $(".aBtn").click(function(){
            $(".accept").css("display","");
            $(".cancel").css("display","none");
            $(".reject").css("display","none");
            $(".pending").css("display","none");
          });

          $(".rBtn").click(function(){
            $(".reject").css("display","");
            $(".accept").css("display","none");
            $(".cancel").css("display","none");
            $(".pending").css("display","none");
          });

          $(".cBtn").click(function(){
            $(".cancel").css("display","");
            $(".accept").css("display","none");
            $(".reject").css("display","none");
            $(".pending").css("display","none");
          });

          $(".allBtn").click(function(){
            $(".cancel").css("display","");
            $(".accept").css("display","");
            $(".reject").css("display","");
            $(".pending").css("display","");
          });

        </script>
    </body>
</html>