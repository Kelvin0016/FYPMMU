<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
<?php include 'dataconnection.php'?>
    <head>
        <title>Item</title>
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
                <h1><span class="new">New </span> Item<span class="details" > Details</span> </h1>
            </div>
            <?php 
              $ID=$_GET['id'];
              $result = mysqli_query($connect, "Select * from item where Item_ID = '$ID' AND Item_isDelete = 0;");
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="form-area">
                <form action="" class="form-css" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="profile-area">
                            <img src="../<?php echo $row['Item_Picture']?>" alt="Item Picture" class="admin-profile-pic" style="width:400px;height:400px;">
                          </div>
                        </div>
    
                        <div class="col-lg-8 detail-area">
                          <div class="row" hidden>
                            <div class="col-lg-3 label-area">
                                ID :
                            </div>
                            <div class="col-lg-9">
                                <input type="number" name="itemID" class="form-control ID" value="<?php echo $ID; ?>">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Item Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="itemName" class="form-control input" value="<?php echo $row['Item_Name']?>" required placeholder="Item Name" maxlength="100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Price : RM
                                </div>
                                <div class="col-lg-9">
                                    <input type="number" name="itemPrice" class="form-control input num" step="0.01" min="1.00" required placeholder="Item Price (Minimum RM 1)"value="<?php echo $row['Item_Price']?>">
                                </div>
                            </div>
                            <div class="row item-upload">
                              <div class="col-lg-3 label-area">
                                  Item picture :
                              </div>
                              <div class="col-lg-9">
                                  <input type="file" name="itemPic" class="" accept="image/*" id="pic" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 label-area">
                                 Description : 
                              </div>
                              <div class="col-lg-9">
                                  <textarea name="itemDescription" id="" cols="81" rows="5" class="item-description input" required placeholder="Item Description"><?php echo $row['Item_Desc']?></textarea>
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6">
                                      <a href="item-view.php" class="btn btn-warning back">Back</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="button" class="btn btn-primary edit" value="Edit">
                                    </div>
                                    <div class="col-lg-6">
                                      <a href="item-add.php?id=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
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
                  $(".item-upload").css("display","none");
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
                  $(".item-show").addClass("show1");
                  $(".item-add-link").addClass("active");
                  $(".second").addClass("rotate");
                }else{
                  $(".input").attr("disabled","disabled");
                  $(".new").css("display","none");
                  $(".details").css("display","");
                  $(".cancel").parent().css("display","none");
                  $(".submit").parent().css("display","none");
                  $(".item-upload").css("display","none");
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
                $(".item-upload").css("display","");
            });
            $(".num").keypress(function(e) {
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
              }
            });
        </script>

        <?php
          if(isset($_POST['submitBtn'])){
            $itemName = $_POST["itemName"];  
            $itemPrice = $_POST["itemPrice"];  
            $itemDesc = $_POST["itemDescription"];
            if (!empty($_FILES["itemPic"]["name"]))
            {
            $path = $_FILES['itemPic']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $itemPic = "images/item/"."(".date('dmYHis').")".$itemName.".".$ext;
            }
            else
            {
              $itemPic =  $row["Item_Picture"];
            }
            $newFileDir = '../'.$itemPic;
            $adminID = $_SESSION["admin_id"];
            $itemIsDel = 0;
            if($ID == 0){
              $check = "SELECT * from item WHERE Item_Name = '$itemName' and Item_isDelete = 0";
              $res = mysqli_query($connect, $check);
              if(mysqli_num_rows($res)>0)
              {
                ?>
                  <script>
                  			swal({
                        title: "Error",
                        text: "Item Name Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
               if(mysqli_query($connect,"INSERT into item(Item_Name,Item_Desc,Item_Price,Item_Picture,Item_isDelete,Item_Adm_ID) values('$itemName','$itemDesc','$itemPrice','$itemPic','$itemIsDel','$adminID');")){
                  ?>
                  <script>
                  			swal({
                        title: "Saved",
                        text: "Item Saved Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("item-view.php");
                  });
                </script>
                <?php
                if(move_uploaded_file($_FILES['itemPic']['tmp_name'],$newFileDir)){
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
                        text: "Failed To Save Item!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("item-add.php?id=0");
                  });
                </script>
               <?php
               }}
            }else{
              $check = "SELECT * from item WHERE Item_Name = '$itemName' and Item_isDelete = 0 and Item_ID != '$ID'";
              $res = mysqli_query($connect, $check);
              if(mysqli_num_rows($res)>0)
              {
                ?>
                  <script>
                        swal({
                        title: "Error",
                        text: "Item Name Exists!",
                        icon: "error",
                        button: "Continue",
                      });
                </script>
                <?php
              }
              else{
              if(mysqli_query($connect, "UPDATE item SET Item_Name='$itemName',	Item_Desc='$itemDesc', Item_Price = '$itemPrice',	Item_Picture='$itemPic' where Item_ID = '$ID'")){
              ?>
                <script>
                  			swal({
                        title: "Updated",
                        text: "Item Updated Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("item-add.php?id=<?php echo $ID?>");
                  });
                </script>
              <?php
               if(move_uploaded_file($_FILES['itemPic']['tmp_name'],$newFileDir)){
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
                        text: "Failed To Update Item Data!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("item-add.php?id=<?php echo $ID?>");
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