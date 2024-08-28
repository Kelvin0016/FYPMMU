<?php
  session_start();
  include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Venue</title>
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
        <div class="pg-content">
            <div class="title-area">
                <h1><span class="new">New </span> Venue<span class="details" > Details</span> </h1>
            </div>
            <?php 
              $ID=$_GET['id'];
              if($ID!=0){
                $result = mysqli_query($connect, "Select * from event_venue where Event_Venue_ID = '$ID';");
                $row = mysqli_fetch_assoc($result);
              }else{
                $result = mysqli_query($connect, "Select * from event_venue where Event_Venue_ID = -1;");
                $row = mysqli_fetch_assoc($result);
              }
              
            ?>
            <div class="form-area">
                <form action="" class="form-css" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-lg-4">
                          <div class="profile-area">
                            <img src="../<?php echo $row['Event_Venue_Picture']?>" alt="Event Picture" class="event-pic">
                          </div>
                        </div>
    
                        <div class="col-lg-8 detail-area">
                          <div class="row" hidden>
                            <div class="col-lg-3 label-area">
                                ID :
                            </div>
                            <div class="col-lg-9">
                                <input type="number" name="venueID" class="form-control ID" value="<?php echo $ID; ?>">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Venue Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="venueName" class="form-control input" value="<?php echo $row['Event_Venue_Name']?>" required placeholder="Venue Name" maxlength="100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Price : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="number" name="venuePrice" class="form-control input num" step="0" min="1.00" required value="<?php echo $row['Event_Venue_Price']?>" required placeholder="Venue Price">
                                </div>
                            </div>
                            <div class="row venue-upload">
                              <div class="col-lg-3 label-area">
                                  Venue picture :
                              </div>
                              <div class="col-lg-9">
                                  <input type="file" name="venuePic" class="" accept="image/*" required id="pic">
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    State :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="venueState" class="form-control input" value="Melaka" required placeholder="Venue State" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Venue Area :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="venueArea" class="form-control input" value="<?php echo $row['Event_Venue_Area']?>" required placeholder="Venue Area" maxlength="255">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Postcode :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="venuePCode" class="form-control input" value="<?php echo $row['Event_Venue_PCode']?>" required placeholder="Postcode" pattern="[0-9]{5}" maxlength="5">
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 label-area">
                                    Street Address : 
                              </div>
                              <div class="col-lg-9">
                                  <textarea name="venueAddress" id="" cols="81" rows="5" class="item-description input" required placeholder="Venue Street Adress"><?php echo $row['Event_Venue_S_Address']?></textarea>
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6">
                                      <a href="venue-view.php" class="btn btn-warning back">Back</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="button" class="btn btn-primary edit" value="Edit">
                                    </div>
                                    <div class="col-lg-6">
                                      <a href="venue-add.php?id=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="submit" class="btn btn-success submit" value="Submit" name="submitBtn">
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
            $(document).ready(function(){
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
                  $(".venue-show").addClass("show4");
                  $(".venue-add-link").addClass("active");
                  $(".fifth").addClass("rotate");
                }else{
                  $(".input").attr("disabled","disabled");
                  $(".new").css("display","none");
                  $(".details").css("display","");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","none");
                  $(".venue-upload").css("display","none");
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
                $(".venue-upload").css("display","");
            });
            $(".num").keypress(function(e) {
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
              }
            });
        </script>
    </body>
</html>

<?php
          if(isset($_POST['submitBtn'])){
            $venueName = $_POST["venueName"];  
            $venuePrice = $_POST["venuePrice"];  
            $venueAdd = $_POST["venueAddress"];
            if (!empty($_FILES["venuePic"]["name"]))
            {
              $path = $_FILES['venuePic']['name'];
              $ext = pathinfo($path, PATHINFO_EXTENSION);
              $venuePic = "images/venue/"."(".date('dmYHis').")".$venueName.".".$ext;
            }
            else
            {
              $venuePic =  $row["Event_Venue_Picture"];
            }
            $newFileDir = '../'.$venuePic;
            $venueState = $_POST["venueState"];
            $venueArea = $_POST["venueArea"];
            $venuePCode = $_POST["venuePCode"];
            $adminID = $user_id;
            $venueIsDel = 0;

            if($ID == 0){
              $check = "SELECT * from event_venue WHERE Event_Venue_Name = '$venueName' and Event_Venue_isDelete = 0";
              $res = mysqli_query($connect, $check);
              if(mysqli_num_rows($res)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Event Venue Name Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
               if(mysqli_query($connect,"INSERT into event_venue(Event_Venue_Name,Event_Venue_Picture,Event_Venue_Price,Event_Venue_S_Address,Event_Venue_State,Event_Venue_Area,Event_Venue_PCode,Event_Venue_isDelete,Event_Venue_Adm_ID) values('$venueName','$venuePic','$venuePrice','$venueAdd','$venueState','$venueArea','$venuePCode','$venueIsDel','$adminID');")){
                ?>
                <script>
                      swal({
                      title: "Saved",
                      text: "Venue Saved Successfully!!!",
                      icon: "success",
                      button: "Continue",
                    }).then(function() {
                      location.replace("venue-view.php");
                });
              </script>
              <?php
              if(move_uploaded_file($_FILES['venuePic']['tmp_name'],$newFileDir)){
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
                        text: "Failed To Save Venue!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("venue-add.php?id=0");
                  });
                </script>
               <?php
               }}
            }else{
              $check = "SELECT * from event_venue WHERE Event_Venue_Name = '$venueName' and Event_Venue_isDelete = 0 and Event_Venue_ID!='$ID'";
              $res = mysqli_query($connect, $check);
              if(mysqli_num_rows($res)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Event Venue Name Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
              if(mysqli_query($connect, "UPDATE event_venue SET Event_Venue_Name='$venueName',	Event_Venue_Picture='$venuePic', Event_Venue_Price = '$venuePrice',	Event_Venue_S_Address='$venueAdd', Event_Venue_State='$venueState', Event_Venue_PCode='$venuePCode' where Event_Venue_ID = '$ID'")){
                ?>
                <script>
                  			swal({
                        title: "Updated",
                        text: "Venue Updated Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("venue-add.php?id=<?php echo $ID?>");
                  });
                </script>
              <?php
               if(move_uploaded_file($_FILES['venuePic']['tmp_name'],$newFileDir)){
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
                        text: "Failed To Update Venue Data!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("venue-add.php?id=<?php echo $ID?>");
                  });
                </script>
               <?php
               }
           }
          }
          }
        ?>