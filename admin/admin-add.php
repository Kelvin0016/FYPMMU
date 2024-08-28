<?php
session_start();
//check the stat of user (logged in or not)
include 'admin_url_check.php';
//get user id
$user_id = $_SESSION['super_id'];
?>
<!DOCTYPE html>
<?php include 'dataconnection.php';?>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel='shortcut icon' href='../images/Logo.png' />
    </head>
    <body>
        
        <?php include 'sidebar-super.php'?>

        <div class="pg-content">
            <div class="title-area">
                <h1><span class="new">New </span> Admin<span class="details"> Details</span> </h1>
            </div>

            <?php $ID=$_GET['id']; ?>
            <?php
            //if id = 0 means adding new admin
            //find a particular admin data
              $result = mysqli_query($connect, "Select * from admin where Adm_ID = '$ID';");
              $row = mysqli_fetch_assoc($result);	
            ?>
            <!-- show the results -->
            <div class="form-area">
                <form action="" class="form-css" method="post" name="adminForm"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="profile-area">
                            <img src="../<?php echo $row['Adm_Photo'];?>" alt="Profile Picture" class="admin-profile-pic">
                          </div>
                        </div>
                        
                        <div class="col-lg-8 detail-area">
                          <div class="row" style="display:none;" >
                            <div class="col-lg-3 label-area">
                                ID :
                            </div>
                            <div class="col-lg-9">
                                <input type="number" name="adminID" class="form-control ID" value="<?php echo $ID;?>">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="adminName" class="form-control input" value="<?php echo $row['Adm_Name'] ?>" id="adminName" pattern="[a-zA-Z ]*" required placeholder="Name same as IC" maxlength="255">
                                    <span id="adminNameVali"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Contact Information : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="contactInfo" class="form-control input" value="<?php echo $row['Adm_PhoneNo'] ?>" id="adminPhoneNo" pattern="[0][1][0-9]-[0-9]{7,8}" placeholder="01x-xxxxxxx (10-11 Number)" required maxlength="12">
                                    <span id="adminPhoneVali"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Email :
                                </div>
                                <div class="col-lg-9">
                                    <input type="email" name="emailAdd" class="form-control input" value="<?php echo $row['Adm_Email'] ?>" id="adminEmail" required placeholder="Admin Email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" maxlength="255">
                                    <span id="adminEmailVali"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Staff ID :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="staffID" class="form-control input" value="<?php echo $row['Adm_Staff_ID'] ?>" id="adminStaffID" required required placeholder="Admin Staff ID" maxlength="20">
                                    <span id="adminSIDVali"></span>
                                </div>
                            </div>
                            <div class="row item-upload">
                              <div class="col-lg-3 label-area">
                                  Staff picture :
                              </div>
                              <div class="col-lg-9">
                                  <input type="file" name="staffPic" class="" accept="image/*" id="pic">
                              </div>
                            </div>
                            
                        </div>
                        <div class="row">
                              <div class="btn-area col-lg-12">
                                <div class="btn-group row">
                                    <div class="col-lg-6">
                                      <a href="admin-view.php" class="btn btn-warning back">Back</a>
                                    </div>
                                    <div class="col-lg-4">
                                      <!-- reset password for this admin (randomized) -->
                                      <a href="super-reset-pass.php?id=<?php echo $ID?>" class="btn btn-warning resetpass" style="padding:6px 0px;">Reset Password</a>
                                    </div>
                                    <div class="col-lg-4">
                                      <a href="admin-add.php?id=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="button" class="btn btn-primary edit" value="Edit" name="">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                      <input type="submit" class="btn btn-success submit" value="Submit" name="submitBtn">
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
        <script src="js/main.js"></script>
        <script src="js/site.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
              document.getElementById("ftco-loader1").classList.remove("show");
              if($(".ID").val() == 0 ){
                //new admin state
                $(".cancel").parent().css("display","none");
                $(".edit").parent().css("display","none");
                $(".cancel").parent().css("display","none");
                $(".details").css("display","none");
                $(".input").removeAttr("disabled");
                $(".admin-show").addClass("show3");
                $(".admin-add-link").addClass("active");
                $(".fourth").addClass("rotate");
                $(".profile-area").parent().css("display","none");
                $(".resetpass").parent().css("display","none");
                $(".item-upload").css("display","none");
              }else{
                //edit details state
                $(".input").attr("disabled","disabled");
                $(".new").css("display","none");
                $(".submit").parent().css("display","none");
                $(".cancel").parent().css("display","none");
                $(".resetpass").parent().css("display","none");
                $(".item-upload").css("display","none");
              }


            });
            //edit btn click function
            $(".edit").click(function(){
              $(".edit").parent().css("display","none");
              $(".submit").parent().css("display","");
              $(".cancel").parent().css("display","");
              $(".back").parent().css("display","none");
              $(".input").removeAttr("disabled");
              $(".resetpass").parent().css("display","");
              $(".item-upload").css("display","");
            });
        </script>

        <?php
          if(isset($_POST['submitBtn'])){
            $adName = $_POST["adminName"];  
            $adCont = $_POST["contactInfo"];  
            $adEmail = $_POST["emailAdd"];
            $adSID = $_POST["staffID"];
            if (!empty($_FILES["staffPic"]["name"]))
            {
              $path = $_FILES['staffPic']['name'];
              $ext = pathinfo($path, PATHINFO_EXTENSION);
              $adPic = "images/admin/"."(".date('dmYHis').")".$adName.".".$ext;
            }
            else
            {
              $adPic=  $row["Adm_Photo"];
            }
            $newFileDir = '../'.$adPic;
            $superID = $user_id;
            //set password length
            $length = 15;
            //randomize the password
            $adPass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%&*-+=_'),1,$length);
            $adIsDel = 0;

            if($ID == 0){
              $adPic = "images/admin/admin.jpg";
              $check = "SELECT * from admin WHERE Adm_Email = '$adEmail' and Adm_isDelete = 0";
              $res = mysqli_query($connect, $check);
              $check2 = "SELECT * from superuser WHERE Super_Email = '$adEmail'";
              $res2 = mysqli_query($connect, $check2);
              //check if the email exist or not in DB
              if(mysqli_num_rows($res)>0 || mysqli_num_rows($res2)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Email Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
            }
            else{
              $check = "SELECT * from admin WHERE Adm_Staff_ID = '$adSID' and Adm_isDelete = 0";
              $res = mysqli_query($connect, $check);
              $check2 = "SELECT * from superuser WHERE Super_Staff_ID = '$adSID'";
              $res2 = mysqli_query($connect, $check2);
              //check if the staff ID exist or not in DB
              if(mysqli_num_rows($res)>0 || mysqli_num_rows($res2)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Staff ID Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
                //email to the user the login details
                if(mysqli_query($connect,"INSERT into admin(Adm_Email,Adm_Password,Adm_Name,Adm_PhoneNo,Adm_Staff_ID,Adm_Photo,Adm_isDelete,Adm_Super_ID) values('$adEmail',PASSWORD('$adPass'),'$adName','$adCont','$adSID','$adPic','$adIsDel','$superID')"))
                {
                    $to_email = $adEmail;
                    $subject = "No-Reply; Admin Login Details";
                    $from_email= "contact.us.fiesta@gmail.com";
                    $headers  = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html;" . "\r\n";
                    $headers .= "From: ".$from_email."\r\n".
                      "Reply-To: ".$from_email."\r\n" .
                      "X-Mailer: PHP/" . phpversion();
                  
                      $body = "<html><body>";
                      $body .= "<h3>Dear <span style='text-transform: uppercase';>".$adName."</span></h3>".
                              "<h4>Welcome to Fiesta Corporation!<h4>".
                              "<p>Your Login Credentials:</p>".
                              "<p>Login Email: </p>".$adEmail.
                              "<p>Login Password: </p>".$adPass.
                              "<p>Regards,<br>Fiesta Corp.</p>";
                      $body .= "</body></html>";
                    //after successful email swal and direct to the listing page.
                    if (mail($to_email, $subject, $body,$headers)) {
                      ?>
                      <script>
                            swal({
                            title: "Saved",
                            text: "Saved Successfully!",
                            icon: "success",
                            button: "Continue",
                          }).then(function() {
                            location.replace("admin-view.php");
                      });
                    </script>
                    <?php
                    }
              }
          }
        }
      }
      else
      {
        $check = "SELECT * from admin WHERE Adm_Email = '$adEmail' and Adm_isDelete = 0 and Adm_ID !='$ID'";
        $res = mysqli_query($connect, $check);
        $check2 = "SELECT * from superuser WHERE Super_Email = '$adEmail'";
        $res2 = mysqli_query($connect, $check2);
        //check if email exists in DB
        if(mysqli_num_rows($res)>0 || mysqli_num_rows($res2)>0)
        {
          ?>
            <script>
                  swal({
                  title: "Error",
                  text: "Email Exists!",
                  icon: "error",
                  button: "Continue",
                });
          </script>
          <?php
      }
      else{
        $check = "SELECT * from admin WHERE Adm_Staff_ID = '$adSID' and Adm_isDelete = 0 and Adm_ID !='$ID'";
        $res = mysqli_query($connect, $check);
        $check2 = "SELECT * from superuser WHERE Super_Staff_ID = '$adSID'";
        $res2 = mysqli_query($connect, $check2);
        //check if Staff ID exists in DB
        if(mysqli_num_rows($res)>0 || mysqli_num_rows($res2)>0)
        {
          ?>
            <script>
                  swal({
                  title: "Error",
                  text: "Staff ID Exists!",
                  icon: "error",
                  button: "Continue",
                });
          </script>
          <?php
        }
        else{
        //update admin details
        if(mysqli_query($connect, "UPDATE admin SET Adm_Name='$adName',	Adm_Email='$adEmail', Adm_PhoneNo = '$adCont',	Adm_Staff_ID='$adSID', Adm_Photo='$adPic' where Adm_ID = '$ID'")){
        ?>
          <script>
                  swal({
                  title: "Updated",
                  text: "Admin Updated Successfully!!!",
                  icon: "success",
                  button: "Continue",
                }).then(function() {
                  location.replace("admin-add.php?id=<?php echo $ID?>");
            });
          </script>
        <?php
         if(move_uploaded_file($_FILES['staffPic']['tmp_name'],$newFileDir)){
          ?>
          <script>
            console.log("Details and picture saved")
          </script>
        <?php
         }
        }else{
          //failure swal
          ?>
          <script>
                  swal({
                  title: "Failed",
                  text: "Failed To Update Admin Data!",
                  icon: "error",
                  button: "Continue",
                }).then(function() {
                  location.replace("admin-add.php?id=<?php echo $ID?>");
            });
          </script>
         <?php
         }
     }
    }
      }
           
    }
  ?>
    </body>
</html>