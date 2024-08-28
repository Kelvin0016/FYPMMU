<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Package</title>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
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
        }
        else if(isset($_SESSION['super_id']) && !empty($_SESSION['super_id']))
        {
            $user_id = $_SESSION['super_id'];
            include 'sidebar-super.php';
        }
        ?>
        <div class="pg-content">
            <div class="title-area">
                <h1><span class="new">New </span> Package<span class="details"> Details</span> </h1>
            </div>

            <div class="form-area">
                <form method="post" class="form-css" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 detail-area">
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    For Event :
                                </div>
                                <div class="col-lg-9">
                                    <select name="eventSelect" id="" class="filter-type" required>
                                        <option value="">Please Select</option>
                                      <?php
                                        $result = mysqli_query($connect,"Select * from events where Event_isDelete = '0';");
                                        while($row = mysqli_fetch_assoc($result)){
                                          ?>
                                            <option value="<?php echo $row["Event_ID"] ?>"><?php echo $row["Event_Name"]; ?></option>
                                          <?php
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Package Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="packName" class="form-control input" value="" required placeholder="Package Name" maxlength="100">
                                </div>
                            </div>
                            <div class="row package-upload">
                              <div class="col-lg-3 label-area">
                                  Package picture :
                              </div>
                              <div class="col-lg-9">
                                  <input type="file" name="packPic" class="" accept="image/*" required>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Description : 
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="packDescription" id="" cols="81" rows="5" class="event-description input" required placeholder="Package Description"></textarea>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-3 label-area">
                                  Package Price : RM
                              </div>
                              <div class="col-lg-9">
                                  <input type="number" name="packPrice" class="num price-input input" value="" step="0.01"  min="1" required placeholder="Package Price (Minimum RM 1)">
                              </div>
                          </div>

                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6" >
                                      <a href="package-view.php" class="btn btn-danger cancel">Cancel</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="submit" class="btn btn-success submit" value="Submit" name="submitBtn">
                                    </div>
                                </div>
                              </div>
                            </div>                            

                          </div>
                        </div>
                    </div>
                    
                </form>
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
            $(".pack-show").addClass("show2");
            $(".pack-add-link").addClass("active");
            $(".fourth").addClass("rotate");
        });
        $(".num").keypress(function(e) {
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
              }
         });
        </script>
        <?php
          if(isset($_POST["submitBtn"])){
            $packName = $_POST["packName"];
            if (!empty($_FILES["packPic"]["name"]))
            {
              $path = $_FILES['packPic']['name'];
              $ext = pathinfo($path, PATHINFO_EXTENSION);
              $packPic = "images/package/"."(".date('dmYHis').")".$packName.".".$ext;
            }
            else
            {
              $packPic =  "";
            }
            $newFileDir = '../'.$packPic;
            $packPrice = $_POST["packPrice"];
            $packDesc = $_POST["packDescription"];
            $eventSelect = $_POST["eventSelect"];
            $packIsDel = 0;
            $adminID = $user_id;
            //get packages in each type of event
            $check = "SELECT * from package WHERE Pack_Name = '$packName' and Pack_isDelete = 0 and Pack_Event_ID = '$eventSelect'";
            $res = mysqli_query($connect, $check);
            //check whether have packages that are same name as input
            if(mysqli_num_rows($res)>0)
            {
              ?>
                <script>
                      swal({
                      title: "Error",
                      text: "Package Name Exists!",
                      icon: "error",
                      button: "Continue",
                    });
              </script>
              <?php
            }
            else{
                if(mysqli_query($connect,"INSERT into package(Pack_Name, Pack_Details, Pack_Price, Pack_Picture, Pack_isDelete, Pack_Event_ID, Pack_Adm_ID) values('$packName','$packDesc','$packPrice','$packPic','$packIsDel','$eventSelect','$adminID')")){
                    $sql = "SELECT * FROM package where Pack_Name = '$packName'";
                    $result = mysqli_query($connect,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['Pack_ID'];
                    ?>
                    <script>
                        swal({
                          title: "Saved",
                          text: "Package Added Successfully!!!",
                          icon: "success",
                          button: "Continue",
                        }).then(function() {
                          location.replace("package-add-item.php?id=<?php echo $id?>");
                    });
                  </script>
                  <?php
                  if(move_uploaded_file($_FILES['packPic']['tmp_name'],$newFileDir)){
                    ?>
                    <script>
                      console.log("Details and picture saved")
                    </script>
                  <?php
                    }
                }
                else{
                  ?>
                  <script>
                        swal({
                          title: "Failed",
                          text: "Failed To Save Package!",
                          icon: "error",
                          button: "Continue",
                        }).then(function() {
                          location.replace("package-add.php");
                    });
                  </script>
                 <?php
                 }
          }
        }
        ?>
    </body>
</html>