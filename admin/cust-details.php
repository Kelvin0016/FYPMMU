<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer Details</title>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">

    </head>
    <body>
    <?php 
        include 'dataconnection.php';
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
        <?php 
          $ID = $_GET['id'];
          $result = mysqli_query($connect, "SELECT * from customer where Cust_ID = '$ID' and Cust_isDelete = 0;");
          $row = mysqli_fetch_assoc($result);
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
        <div class="pg-content">
            <div class="title-area">
                <h1><span class="new">Customer Details</h1>
            </div>

            <div class="form-area">
                <div class="row form-css">
                        <div class="col-lg-12 detail-area">
                            <div class="row" hidden>
                                <div class="col-lg-3 label-area">
                                    ID :
                                </div>
                            <div class="col-lg-9">
                                <input type="number" name="custID" class="form-control" value="<?php echo $row["Cust_ID"]; ?>">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Customer Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="custName" class="form-control" value="<?php echo $row["Cust_Name"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Phone Number : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="contactInfo" class="form-control" value="<?php echo $row["Cust_PhoneNo"]; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Email :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="emailAdd" class="form-control" value="<?php echo $row["Cust_Email"]; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Type of membership :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="staffID" class="form-control" value="<?php echo $member; ?>">
                                </div>
                            </div>
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6">
                                      <a href="cust-view.php" class="btn btn-warning">Back</a>
                                    </div>

                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>        
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>