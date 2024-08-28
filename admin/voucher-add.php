<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
<?php include 'dataconnection.php'?>
    <head>
        <title>Voucher</title>
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
                <h1><span class="new">New </span> Voucher<span class="details" > Details</span> </h1>
            </div>
            <?php 
              $ID=$_GET['id'];
              $result = mysqli_query($connect, "Select * from voucher where Vouc_ID = '$ID';");
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="form-area">
                <form action="" class="form-css" method="post">
                    <div class="row">
    
                        <div class="col-lg-8 detail-area">
                          <div class="row" hidden>
                            <div class="col-lg-3 label-area">
                                ID :
                            </div>
                            <div class="col-lg-9">
                                <input type="number" name="voucID" class="form-control ID" value="<?php echo $ID; ?>">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Voucher Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="voucName" class="form-control input" value="<?php echo $row['Vouc_Name']?>" required placeholder="Voucher Name" maxlength="255">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Voucher Code : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="voucCode" class="form-control input" required value="<?php echo $row['Vouc_Code']?>" placeholder="Voucher Code" maxlength="100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Discount Rate (%) : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="number" name="voucPercent" class="form-control input num" step="0.01" min="1.00" max="80.00" required value="<?php echo $row['Vouc_Discount']?>" placeholder="Voucher Discount (%)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Start Date : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="date" name="voucStart" id="start" class="form-control input date" required value="<?php echo $row['Vouc_Start_Date']?>" onchange="updateend()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   End Date : 
                                </div>
                                <div class="col-lg-9">
                                    <input type="date" name="voucEnd" id="end" class="form-control input date" required value="<?php echo $row['Vouc_Exp_Date']?>">
                                </div>
                            </div>
                            <div class="row status">
                                <div class="col-lg-3 label-area">
                                  Status :
                                </div>
                                <div class="col-lg-9">
                                  <?php
                                    $stat = $row["Vouc_Status"];
                                    if($stat == 0){
                                      ?><span class="badge badge-success" style="font-size:30px;">Active</span><?php
                                    }else if($stat == 1){
                                      ?><span class="badge badge-danger" style="font-size:30px;">Expired</span><?php
                                    }
                                  ?>
                                </div>
                            </div>
                            
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6">
                                      <a href="voucher-view.php" class="btn btn-warning back">Back</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="button" class="btn btn-primary edit" value="Edit">
                                    </div>
                                    <div class="col-lg-6">
                                      <a href="voucher-add.php?id=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
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

        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>

        <script>
            $(document).ready(function(){
              if($ad_super == 0)
              {
                $(".input").attr("disabled","disabled");
                  $(".new").css("display","none");
                  $(".details").css("display","");
                  $(".edit").parent().css("display","none");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","none");
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
                  $(".voucher-show").addClass("show5");
                  $(".voucher-add-link").addClass("active");
                  $(".sixth").addClass("rotate");
                  $(".status").css("display","none");
                }else{
                  $(".input").attr("disabled","disabled");
                  $(".new").css("display","none");
                  $(".details").css("display","");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","none");
                }
              }

                //get today's date
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                $(".date").attr("min",today);
            });
            $(".edit").click(function(){
                $(".edit").parent().css("display","none");
                $(".back").parent().css("display","none");
                $('.input').removeAttr("disabled");
                $(".cancel").parent().css("display","");
                $(".submit").parent().css("display","");
                $(".date").attr("min","<?php echo $row['Vouc_Start_Date']?>");
                $(".status").css("display","none");
            });
            $(".num").keypress(function(e) {
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
              }
            });
            $(".num").keyup(function(e) {
              var val = $(".num").val()
              if(val>80)
              {
                $(".num").val('80');
              }
            });
            function updateend()
            {
              var start = document.getElementById("start").value;
              document.getElementById("end").min = start;
            }
        </script>

        <?php
          if(isset($_POST['submitBtn'])){
            $VName = $_POST["voucName"];  
            $VCode = $_POST["voucCode"];  
            $VRate = $_POST["voucPercent"];
            $VStart = $_POST["voucStart"];
            $VEnd = $_POST["voucEnd"];
            $adminID = $_SESSION["admin_id"];
            $VStat = 0;
            $VoucIsDel = 0;
            if($ID == 0){
              $check = "SELECT * from voucher WHERE Vouc_Code = '$VCode' and Vouc_isDelete = 0";
              $res = mysqli_query($connect, $check);
              if(mysqli_num_rows($res)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Voucher Code Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
               if(mysqli_query($connect,"INSERT into voucher(Vouc_Name,Vouc_Code,Vouc_Discount,Vouc_Start_Date,Vouc_Exp_Date,Vouc_Status,Vouc_isDelete,Vouc_Adm_ID) values('$VName','$VCode','$VRate','$VStart','$VEnd','$VStat','$VoucIsDel','$adminID');")){
                  ?>
                  <script>
                  			swal({
                        title: "Saved",
                        text: "Voucher Saved Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("voucher-view.php");
                  });
                </script>
                <?php
              }
              else{
                ?>
                <script>
                  			swal({
                        title: "Failed",
                        text: "Failed To Save Voucher!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("voucher-add.php?id=0");
                  });
                </script>
               <?php
               }
              }
            }else{
              $check = "SELECT * from voucher WHERE Vouc_Code = '$VCode' and Vouc_isDelete = 0 and Vouc_ID != '$ID'";
              $res = mysqli_query($connect, $check);
              if(mysqli_num_rows($res)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Voucher Code Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
              if(mysqli_query($connect, "UPDATE voucher SET Vouc_Name='$VName',Vouc_Code='$VCode',Vouc_Discount='$VRate',Vouc_Start_Date='$VStart',Vouc_Exp_Date='$VEnd' where Vouc_ID = '$ID'")){
              ?>
                <script>
                  			swal({
                        title: "Updated",
                        text: "Voucher Updated Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("voucher-add.php?id=<?php echo $ID?>");
                  });
                </script>
              <?php
              }else{
                ?>
                <script>
                  			swal({
                        title: "Failed",
                        text: "Failed To Update Voucher Data!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("voucher-add.php?id=<?php echo $ID?>");
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