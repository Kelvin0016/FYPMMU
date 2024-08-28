<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Event</title>
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
        <?php 
          $ID = $_GET['id'];
          $result = mysqli_query($connect, "Select * from events where Event_ID = '$ID' and Event_isDelete = 0;");
          $row = mysqli_fetch_assoc($result);
        ?>

        <div class="pg-content">
            <div class="title-area">
                <h1><span class="new">New </span> Event<span class="details" > Details</span> </h1>
            </div>

            <div class="form-area">
                <form method="POST" class="form-css" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="profile-area">
                            <img src="../<?php echo $row['Event_Picture']?>" alt="Event Picture" class="event-pic">
                          </div>
                        </div>
    
                        <div class="col-lg-8 detail-area">
                            <div class="row" hidden>
                              <div class="col-lg-3 label-area">
                                  ID :
                              </div>
                              <div class="col-lg-9">
                                  <input type="number" name="eventID" class="form-control ID" value="<?php echo $ID ;?>">
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Event Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="eventName" class="form-control input" value="<?php echo $row['Event_Name']; ?>" required placeholder="Event Name" maxlength="100">
                                </div>
                            </div>
                            <div class="row event-upload">
                              <div class="col-lg-3 label-area">
                                  Event picture :
                              </div>
                              <div class="col-lg-9">
                                  <input type="file" name="eventPic" class="" accept="image/*" id="pic" required>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Description : 
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="eventDescription" id="" cols="81" rows="5" class="event-description input" required placeholder="Event Description"><?php echo $row['Event_Details']; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6">
                                      <a href="event-view.php" class="btn btn-warning back">Back</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="button" class="btn btn-primary edit" value="Edit">
                                    </div>
                                    <div class="col-lg-6" >
                                      <a href="event-add.php?id=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
                                    </div>
                                    <div class="col-lg-6" >
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
        <div id="ftco-loader1" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>

        <script>
            $(document).ready(function () {
              document.getElementById("ftco-loader1").classList.remove("show");
              if($ad_super == 0)
              {
                $(".input").attr("disabled","disabled");
                  $(".new").css("display","none");
                  $(".details").css("display","");
                  $(".edit").parent().css("display","none");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","none");
                  $(".event-upload").css("display","none");
              }
              else{
              if($(".ID").val()==0){
                  $(".input").removeAttr("disabled");
                  $(".edit").parent().css("display","none");
                  $(".details").css("display","none");
                  $(".new").css("display","");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","");
                  $(".profile-area").parent().css("display","none")
                  $(".event-show").addClass("show");
                  $(".event-add-link").addClass("active");
                  $(".first").addClass("rotate");
                }else{
                  $(".input").attr("disabled","disabled");
                  $(".new").css("display","none");
                  $(".details").css("display","");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","none");
                  $(".event-upload").css("display","none");
                }
              }
            });

            $(".edit").click(function(){
                $(".edit").parent().css("display","none");
                $(".back").parent().css("display","none");
                $('.input').removeAttr("disabled");
                $('#pic').removeAttr("required");
                $(".cancel").parent().css("display","");
                $(".submit").parent().css("display","");
                $(".event-upload").css("display","");
            })
        </script>

        <?php
          if(isset($_POST['submitBtn'])){
            $eventName = $_POST["eventName"];   
            $eventDesc = $_POST["eventDescription"];
            //checking whether empty or not inside the file input
            if (!empty($_FILES["eventPic"]["name"]))
            {
              //get the value inside file input
              $path = $_FILES['eventPic']['name'];
              //get extension
              $ext = pathinfo($path, PATHINFO_EXTENSION);
              //saving data format
              $eventPic = "images/item/"."(".date('dmYHis').")".$eventName.".".$ext;
            }
            else
            {
              $eventPic =  $row["Event_Picture"];
            }
            $newFileDir = '../'.$eventPic;
            $adminID =  $_SESSION["admin_id"];
            $eventIsDel = 0;

            if($ID == 0){
                //make sure no same name as other event
                $check = "SELECT * from events WHERE Event_Name = '$eventName' and Event_isDelete = 0";
                $res = mysqli_query($connect, $check);
                if(mysqli_num_rows($res)>0)
                {
                  ?>
                    <script>
                          swal({
                          title: "Error",
                          text: "Event Name Exists!",
                          icon: "error",
                          button: "Continue",
                        });
                  </script>
                  <?php
                }
              else{
                if(mysqli_query($connect,"INSERT into events(Event_Name,	Event_Details,	Event_Picture,	Event_isDelete,	Event_Adm_ID) values('$eventName','$eventDesc','$eventPic','$eventIsDel','$adminID');")){
                ?>
                    <script>
                          swal({
                          title: "Saved",
                          text: "Event Saved Successfully!!!",
                          icon: "success",
                          button: "Continue",
                        }).then(function() {
                          location.replace("event-view.php");
                    });
                  </script>
                  <?php
                  //save file into specified folder tmp_name==path name
                  if(move_uploaded_file($_FILES['eventPic']['tmp_name'],$newFileDir)){
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
                          text: "Failed To Save Event!",
                          icon: "error",
                          button: "Continue",
                        }).then(function() {
                          location.replace("event-add.php?id=0");
                    });
                  </script>
                <?php
               }
           }}else{
            $check = "SELECT * from events WHERE Event_Name = '$eventName' and Event_isDelete = 0 and Event_ID != '$ID'";
            $res = mysqli_query($connect, $check);
            if(mysqli_num_rows($res)>0)
            {
              ?>
                <script>
                      swal({
                      title: "Error",
                      text: "Event Name Exists!",
                      icon: "error",
                      button: "Continue",
                    });
              </script>
              <?php
            }
            else{
              if(mysqli_query($connect, "UPDATE events SET Event_Name='$eventName',	Event_Details='$eventDesc',	Event_Picture='$eventPic' where Event_ID = '$ID'")){
                ?>
                <script>
                  			swal({
                        title: "Updated",
                        text: "Event Updated Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("event-add.php?id=<?php echo $ID?>");
                  });
                </script>
              <?php
               if(move_uploaded_file($_FILES['eventPic']['tmp_name'],$newFileDir)){
                ?>
                <script>
                  console.log("Details and picture saved")
                </script>
              <?php
               }
              }else{
                ?>
                <script>
                  			swal({
                        title: "Failed",
                        text: "Failed To Update Event Data!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("event-add.php?id=<?php echo $ID?>");
                  });
                </script>
               <?php
               }
           }}
          }
        ?>
    </body>
</html>