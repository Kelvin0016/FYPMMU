<?php
session_start();
include 'admin_url_check.php';
$user_id = $_SESSION['super_id'];
?>
<!DOCTYPE html>
<?php include 'dataconnection.php';?>
<html>
    <head>
        <title>Superuser</title>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel='shortcut icon' href='../images/Logo.png' />
    </head>
    <body>
        
        <?php include 'sidebar-super.php'?>

        <div class="pg-content">
            <div class="title-area">
                <h1><span class="new">New </span> Superuser<span class="details"> Details</span> </h1>
            </div>

            <?php $ID=$_GET['sid']; ?>
            <?php
              $result = mysqli_query($connect, "Select * from superuser where Super_ID = '$ID';");
              $row = mysqli_fetch_assoc($result);	
            ?>
            <div class="form-area">
                <form action="" class="form-css" method="post" name="adminForm">
                    <div class="row">
    
                        <div class="col-lg-12 detail-area">
                          <div class="row" style="display:none;" >
                            <div class="col-lg-3 label-area">
                                ID :
                            </div>
                            <div class="col-lg-9">
                                <input type="number" name="superID" class="form-control ID" value="<?php echo $ID;?>">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="superName" class="form-control input" value="<?php echo $row['Super_Name'] ?>" id="adminName" pattern="([a-zA-Z]+\s){2,}([a-zA-Z]+)" required placeholder="Name same as IC" maxlength="255">
                                    <span id="adminNameVali"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Contact Information : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="contactInfo" class="form-control input" value="<?php echo $row['Super_PhoneNo'] ?>" id="adminPhoneNo" pattern="[0][1][0-9]-[0-9]{7,8}" placeholder="01x-xxxxxxx (10-11 Number)" required maxlength="12">
                                    <span id="adminPhoneVali"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Email :
                                </div>
                                <div class="col-lg-9">
                                    <input type="email" name="emailAdd" class="form-control input" value="<?php echo $row['Super_Email'] ?>" id="adminEmail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required placeholder="Superuser Email" maxlength="255">
                                    <span id="adminEmailVali"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Staff ID :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="staffID" class="form-control input" value="<?php echo $row['Super_Staff_ID'] ?>" id="adminStaffID" require placeholder="Superuser Staff ID">
                                    <span id="adminSIDVali"></span>
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
                                      <a href="super-reset-pass.php?sid=<?php echo $ID?>" class="btn btn-warning resetpass" style="padding:6px 0px;">Reset Password</a>
                                    </div>
                                    <div class="col-lg-4">
                                      <a href="super-detail.php?sid=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
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
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
              if($(".ID").val() == 0 ){
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
              }else{
                $(".input").attr("disabled","disabled");
                $(".new").css("display","none");
                $(".submit").parent().css("display","none");
                $(".cancel").parent().css("display","none");
                $(".resetpass").parent().css("display","none");
              }


            });

            $(".edit").click(function(){
              $(".edit").parent().css("display","none");
              $(".submit").parent().css("display","");
              $(".cancel").parent().css("display","");
              $(".back").parent().css("display","none");
              $(".input").removeAttr("disabled");
              $(".resetpass").parent().css("display","");
            });
        </script>

        <?php
        if(isset($_POST['submitBtn'])){
            $spName = $_POST["superName"];  
            $spCont = $_POST["contactInfo"];  
            $spEmail = $_POST["emailAdd"];
            $spSID = $_POST["staffID"];

            $check = "SELECT * from admin WHERE Adm_Email = '$spEmail' and Adm_isDelete = 0";
            $res = mysqli_query($connect, $check);
            $check2 = "SELECT * from superuser WHERE Super_Email = '$spEmail' and Super_ID !='$ID'";
            $res2 = mysqli_query($connect, $check2);
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
                $check = "SELECT * from admin WHERE Adm_Staff_ID = '$spSID' and Adm_isDelete = 0";
                $res = mysqli_query($connect, $check);
                $check2 = "SELECT * from superuser WHERE Super_Staff_ID = '$spSID' and Super_ID !='$ID'";
                $res2 = mysqli_query($connect, $check2);
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
                if(mysqli_query($connect, "UPDATE superuser SET Super_Name='$spName', Super_Email='$spEmail', Super_PhoneNo = '$spCont', Super_Staff_ID='$spSID' where Super_ID = '$ID'")){
                ?>
                <script>
                        swal({
                        title: "Updated",
                        text: "Admin Updated Successfully!!!",
                        icon: "success",
                        button: "Continue",
                        }).then(function() {
                        location.replace("super-detail.php?sid=<?php echo $ID?>");
                    });
                </script>
                <?php
                }else{
                    ?>
                    <script>
                            swal({
                            title: "Failed",
                            text: "Failed To Update Admin Data!",
                            icon: "error",
                            button: "Continue",
                            }).then(function() {
                            location.replace("super-detail.php?sid=<?php echo $ID?>");
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