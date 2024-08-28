<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel='shortcut icon' href='../images/Logo.png' />
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" type="text/css" href="css/animated.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    </head>

    <style>
        
    </style>
    <body>
      <?php 
        include 'dataconnection.php';
        include 'admin_url_check.php';
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
        {
            $user_id = $_SESSION['admin_id'];
            include 'sidebar-admin.php';
        }
        else if(isset($_SESSION['super_id']) && !empty($_SESSION['super_id']))
        {
            $user_id = $_SESSION['super_id'];
            include 'sidebar-super.php';
        }
        ?>
      <div class="pg-content">
      <div class="page-container">

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <?php
                                $sql="SELECT * FROM customer where Cust_isDelete =0 and Cust_isVerify = 1";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1" style="background:#0AB639;">
                                    <a href="cust-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows; ?></h2>
                                                <span>Registered Customer</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                                //change word to unix timestamps
                                $sunday = strtotime("last sunday");
                                //get sunday (last)
                                //if today is sunday, auto add 7 days else use last sunday
                                $sunday = date('w', $sunday)==date('w') ? $sunday+7*86400 : $sunday;
                                //get saturday from the sunday
                                $saturday = strtotime(date("Y-m-d",$sunday)." +6 days");
                                //set start day in date form
                                $this_week_sd = date("Y-m-d",$sunday)." 00:00:00";
                                //set end day in date form
                                $this_week_ed = date("Y-m-d",$saturday)." 23:59:59";
                                //get all record from DB in range of the time frame
                                $sql="SELECT * FROM book where Book_Date_Time >= '$this_week_sd' and Book_Date_Time <= '$this_week_ed' and Book_isCheck = 1";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2" style="background:#E3BF1C;">
                                <a href="booking-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows; ?></h2>
                                                <span>Booking This Week</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php
                                $sql="SELECT * FROM payment";
                                $result=mysqli_query($connect,$sql);
                                $total=0;
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $total+=$row['Pay_Amount'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3" style="background:#0E60F3;">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>RM <?php echo sprintf('%.2f',$total);?></h2>
                                                <span>Total Earnings</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $sql="SELECT * FROM voucher where Vouc_isDelete =0 and Vouc_Status = 0;";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4" style="background:#F22B03;">
                                <a href="voucher-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-label"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows;?></h2>
                                                <span>Voucher in Active</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php
                                $sql="SELECT * FROM events where Event_isDelete =0";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4" style="background:#b50a87;">
                                <a href="event-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-library"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows;?></h2>
                                                <span>Total Number of Events</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php
                                $sql="SELECT * FROM package where Pack_isDelete =0";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3" style="background:#980FE5;">
                                <a href="package-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-case"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows;?></h2>
                                                <span>Total Number of Packages</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php
                                $sql="SELECT * FROM item where Item_isDelete =0";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2" style="background:#f3a10e;">
                                <a href="item-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-layers"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows;?></h2>
                                                <span>Total Number of Items</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php
                                $sql="SELECT * FROM event_venue where Event_Venue_isDelete =0 and Event_Venue_ID >0";
                                $result=mysqli_query($connect,$sql);
                                $num_rows = mysqli_num_rows($result);
                            ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1" style="background:#11C4E0;">
                                <a href="venue-view.php">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-pin"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $num_rows;?></h2>
                                                <span>Total Number of Venues</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Booking History (This Week)</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Booking Date</th>
                                                <th>Event Name</th>
                                                <th>Event Date</th>
                                                <th>Event Time</th>
                                                <th>Event Theme</th>
                                                <th>Event Venue</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // $sunday = strtotime("last sunday");
                                            // $sunday = date('w', $sunday)==date('w') ? $sunday+7*86400 : $sunday;
                                            // $saturday = strtotime(date("Y-m-d",$sunday)." +6 days");
                                            // $this_week_sd = date("Y-m-d",$sunday)." 00:00:00";
                                            // $this_week_ed = date("Y-m-d",$saturday)." 23:59:59";
                                            $sql="SELECT * FROM book,event_venue where Book_Event_Venue_ID= Event_Venue_ID and Book_Date_Time >= '$this_week_sd' and Book_Date_Time <= '$this_week_ed' and Book_isCheck = 1 ORDER BY Rand() LIMIT 8";
                                            $result=mysqli_query($connect,$sql);
                                            $count = mysqli_num_rows($result);
                                            if($count>0)
                                            {
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                                $status = $row['Book_Status'];
                                                if($status == 0)
                                                {
                                                    $status_name ="Pending";
                                                }
                                                else if($status == 1)
                                                {
                                                    $status_name ="Accepted";
                                                }
                                                else if($status == 2)
                                                {
                                                    $status_name ="Rejected";
                                                }
                                                else if($status == 3)
                                                {
                                                    $status_name ="Cancelled";
                                                }
                                        ?>
                                            <tr>
                                                <td class="text-left" style="padding-top:10px;">&nbsp;&nbsp;&nbsp;<?php echo $row['Book_Date_Time'];?></td>
                                                <td><?php echo $row['Book_Event_Name'];?></td>
                                                <td><?php echo $row['Book_Event_Date'];?></td>
                                                <td><?php echo $row['Book_Event_Time'];?></td>
                                                <td><?php echo $row['Book_Event_Theme_Name'];?></td>
                                                <td><?php echo $row['Event_Venue_Name'];?></td>
                                                <td><?php echo $status_name;?></td>
                                            </tr>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td style="vertical-align:middle;">No Booking This Week</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style=" 
                                     background: -webkit-linear-gradient(to right, #00c6ff, #0072ff); /* Chrome 10-25, Safari 5.1-6 */
                                    background: linear-gradient(to right, #00c6ff, #0072ff);">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-account-calendar"></i>Rating and Comments</h3>
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task-list js-scrollbar3">
                                    <?php
                                        $sql = "SELECT * from rate_comment, customer WHERE R_C_Cust_ID = Cust_ID ORDER BY Rand() Limit 4";
                                        $result = mysqli_query($connect,$sql);
                                        $count=1;
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                    ?>
                                            <div class="au-task__item">
                                                <div class="au-task__item-inner">
                                                    <h4 class="task">
                                                        <?php echo $row['Cust_Name'];?>
                                                    </h4>
                                                    <p style="font-size:15px;">
                                                    <?php echo $row['Comment'];?>
                                                    </p>
                                                    <span class="time">
                                                    <p class="text-left mr-4">
                                                        <a href="" class="mr-2"><?php echo $row['Rating'];?>.0</a>
                                                        <a href=""><span class="zmdi zmdi-star-outline" id="star1_<?php echo $count;?>"></span></a>
                                                        <a href=""><span class="zmdi zmdi-star-outline" id="star2_<?php echo $count;?>"></span></a>
                                                        <a href=""><span class="zmdi zmdi-star-outline" id="star3_<?php echo $count;?>"></span></a>
                                                        <a href=""><span class="zmdi zmdi-star-outline" id="star4_<?php echo $count;?>"></span></a>
                                                        <a href=""><span class="zmdi zmdi-star-outline" id="star5_<?php echo $count;?>"></span></a>
                                                    </p>
                                                </span>
                                                <script>
                                                    //replace the stars based on rating 1 by 1
                                                    var star = <?php echo $row['Rating'];?>;
                                                    var count = <?php echo $count;?>;
                                                    if(star==1)
                                                    {
                                                        document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star1_"+count).classList.add("zmdi-star");
                                                    }
                                                    else if(star==2)
                                                    {
                                                        document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star1_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star2_"+count).classList.add("zmdi-star");
                                                    }
                                                    else if(star==3)
                                                    {
                                                        document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star1_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star2_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star3_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star3_"+count).classList.add("zmdi-star");
                                                    }
                                                    else if(star==4)
                                                    {
                                                        document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star1_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star2_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star3_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star3_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star4_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star4_"+count).classList.add("zmdi-star");
                                                    }
                                                    else if(star==5)
                                                    {
                                                        document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star1_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star2_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star3_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star3_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star4_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star4_"+count).classList.add("zmdi-star");
                                                        document.getElementById("star5_"+count).classList.remove("zmdi-star-outline");
                                                        document.getElementById("star5_"+count).classList.add("zmdi-star");
                                                    }
                                                </script>
                                                </div>
                                            </div>
                                        <?php
                                            $count++;
                                            }
                                        ?>
                                           
                                        </div>
                                        <div class="au-task__footer">
                                            <a href="rate-comment.php" class="au-btn au-btn-load">Load More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
 
    </div>
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>
        <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/dash.js"></script>
    <script>
        $(document).ready(function(){
            $(".dashboard-link").addClass("active");
        });
    </script>
    </body>
</html>