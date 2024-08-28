<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Package</title>
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
                <h1><span class="new">New </span> Package<span class="details"> Details</span> </h1>
            </div>

            <?php
              $ID = $_GET["id"];
              $result1 = mysqli_query($connect,"SELECT * from package where Pack_ID = '$ID';");
              $row1 = mysqli_fetch_assoc($result1);	
              $result = mysqli_query($connect, "SELECT * from item where Item_isDelete = 0;");
              $result2 = mysqli_query($connect,"SELECT * from equip_package where Equip_P_Pack_ID = '$ID' AND Equip_P_isDelete = 0;");
            ?>

            <div class="form-area">
                <form method="post" class="form-css" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="profile-area">
                            <img src="../<?php echo $row1["Pack_Picture"]; ?>" alt="Package Picture" class="event-pic">
                          </div>
                        </div>
    
                        <div class="col-lg-12 detail-area">
                            <div class="row" hidden>
                              <div class="col-lg-3 label-area">
                                Package ID :
                              </div>
                              <div class="col-lg-9">
                                  <input type="number" name="packageID" class="form-control ID" value="<?php echo $ID ?>">
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    Package Name :
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="packName" class="form-control input" value="<?php echo $row1["Pack_Name"]?>" required maxlength="100">
                                </div>
                            </div>
                            <div class="row package-upload">
                              <div class="col-lg-3 label-area">
                                  Package picture :
                              </div>
                              <div class="col-lg-9">
                                  <input type="file" name="packPic" class="" accept="image/*">
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                   Description : 
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="packDescription" id="" cols="81" rows="5" class="event-description input" required><?php echo $row1["Pack_Details"]?></textarea>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-3 label-area">
                                  Package Price : RM
                              </div>
                              <div class="col-lg-9">
                                  <input type="number" name="packPrice" class="price-input input" value="<?php echo $row1["Pack_Price"]?>" step="0.01" min="1" required>
                              </div>
                          </div>

                            <div class="row"> 
                              <div class="col-lg-9 in-this-pack">
                                <h4 style="float:left;">In this Package</h4> 
                                <div class="pull-right" style="margin-top:10px;">
                                  <a class="add-item-link" href="package-add-item.php?id=<?php echo $ID ?>">Add more items</a>
                                </div>
                                <div class="overflow-scroll">
                                  <table class="pack-item-tab in-pack-item-tab">
                                    <thead>
                                      <tr>
                                        <th>Item Name</th><th>Quantity</th><th class="action-col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($row2 = mysqli_fetch_assoc($result2)){
                                          $E_P_itemID = $row2["Equip_P_Item_ID"];
                                          $result3 = mysqli_query($connect, "SELECT * from item where Item_isDelete = 0 AND Item_ID = '$E_P_itemID';");
                                          $row3 = mysqli_fetch_assoc($result3);
                                          ?>
                                            <tr>
                                              <td>
                                                <input type="checkbox" value="<?php echo $row2["Equip_P_Item_ID"]; ?>" name="pItems[]" checked hidden>
                                                <?php echo $row3["Item_Name"]; ?>
                                              </td>
                                              <td><input type="number" value="<?php echo $row2["Equip_P_Qty"] ?>" min="1" step="0" class="item-qty input" name="pItemQty[]"></td>
                                              <td class="action-col"><input type="checkbox" name="delete[]" value="<?php echo $row2["Equip_P_Item_ID"]; ?>" onclick="swDel(this);" class="del" id="del<?php echo $row2["Equip_P_Item_ID"]; ?>"><label for="del<?php echo $row2["Equip_P_Item_ID"]; ?>">Remove</label></td>
                                            </tr>
                                          <?php
                                        }
                                      ?>
                                      <tr id="dela">
                                        <td class="action-col">&nbsp;</td>
                                        <td class="action-col">&nbsp;</td>
                                        <td class="action-col"><input type="checkbox" onclick="swDelA(this);" id="delall"><label for="delall">Delete All</label></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                                <div class="row"> 
                              <div class="col-lg-9 del-items">
                                <h4>Deleted Items</h4> 
                                <div class="overflow-scroll">
                                  <table class="pack-item-tab del-items-tab">
                                    <thead>
                                      <tr>
                                        <th>Item Name</th><th>Quantity</th><th class="action-col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      $result4=mysqli_query($connect,"SELECT * from equip_package WHERE Equip_P_isDelete = 1 AND Equip_P_Pack_ID = '$ID';");
                                      
                                      while($row4 = mysqli_fetch_assoc($result4)){
                                        $DelE_P_itemID = $row4["Equip_P_Item_ID"];
                                        $result5 = mysqli_query($connect, "SELECT * from item where Item_isDelete = 0 AND Item_ID = '$DelE_P_itemID';");                                        
                                        $row5 = mysqli_fetch_assoc($result5);
                                        if($row5["Item_Name"]!=null){
                                          ?>
                                            <tr>
                                              <td>
                                                <?php echo $row5["Item_Name"]; ?>
                                              </td>
                                              <td>
                                                <?php echo $row4["Equip_P_Qty"]?>
                                              </td>
                                              <td class="action-col"><input type="checkbox" name="restore[]" value="<?php echo $DelE_P_itemID?>" onclick="swRes(this);" class="res" id="res<?php echo $row4["Equip_P_Item_ID"]; ?>"><label for="res<?php echo $row4["Equip_P_Item_ID"]; ?>">Restore</label></td>
                                            </tr>
                                        <?php
                                        }
                                        
                                      }
                                    ?>
                                      <tr>
                                        <td class="action-col">&nbsp;</td>
                                        <td class="action-col">&nbsp;</td>
                                        <td class="action-col"><input type="checkbox" onclick="swResA(this);" id="resall"><label for="resall">Restore All</label></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                    <div class="col-lg-6" >
                                      <a href="package-view.php" class="btn btn-warning back">Back</a>
                                    </div>
                                    <div class="col-lg-6">
                                      <input type="button" class="btn btn-primary edit" value="Edit">
                                    </div>
                                    <div class="col-lg-6" >
                                      <a href="package-detail.php?id=<?php echo $ID?>" class="btn btn-danger cancel">Cancel</a>
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
                  $(".package-upload").css("display","none");
                  $(".action-col").css("display","none");
                  $(".add-item-link").parent().css("display","none");
              }
              else{
                $(".input").attr("disabled","disabled");
                $(".submit").parent().css("display","none");
                $(".cancel").parent().css("display","none");
                $(".new").css("display","none");
                $(".details").css("display","");
                $(".item-qty").parent().css("display","");
                // $(".in-pack-item-tab").css("display","");
                // $(".in-pack-item-tab-edit").css("display","none");
                $(".package-upload").css("display","none");
                $(".edit").parent().css("display","");
                $(".action-col").css("display","none");
                $(".add-item-link").parent().css("display","none");
                $(".del-items").parent().css("display","none");
                $("#dela").css("display","none");
              }
            });

            $(".edit").click(function(){
                $('.input').removeAttr("disabled");
                $(".back").parent().css("display","none");
                $(".edit").parent().css("display","none");
                $(".cancel").parent().css("display","block");
                $(".submit").parent().css("display","block");
                // $(".in-pack-item-tab-edit").css("display","");
                // $(".in-pack-item-tab").css("display","none");
                $(".package-upload").css("display","");
                $(".action-col").css("display","");
                $(".add-item-link").parent().css("display","");
                $("#dela").css("display","");

                if($(".del-items-tab tbody").find("tr").length == 0){
                  $(".del-items").parent().css("display","none");
                }else{
                  $(".del-items").parent().css("display","");
                }
            });
            $(".item-qty").keypress(function(e) {
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
              $packPic =  $row1["Pack_Picture"];
            }
            $newFileDir = '../'.$packPic;
            $packPrice = $_POST["packPrice"];
            $packDesc = $_POST["packDescription"];
            $pItems = $_POST["pItems"];
            $pItemQty = $_POST["pItemQty"];
            $packIsDel = 0;
            $equipPackIsDel = 0;
            $adminID = 0;
            $check = "SELECT * from package WHERE Pack_Name = '$packName' and Pack_isDelete = 0 and Pack_ID != '$ID'";
            $res = mysqli_query($connect, $check);
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
            if(!empty($pItems) || !empty($_POST['restore'])){

              if(mysqli_query($connect,"UPDATE package SET Pack_Name = '$packName', Pack_Details = '$packDesc', Pack_Price = '$packPrice',Pack_Picture = '$packPic' WHERE Pack_ID = '$ID'")){
                if(move_uploaded_file($_FILES['packPic']['tmp_name'],$newFileDir)){
                ?>
                  <script>
                    console.log("Details and picture saved")
                  </script>
                <?php
                }
              }

              foreach($pItems as $index2 => $pItem){
                mysqli_query($connect,"UPDATE equip_package SET Equip_P_Qty = '$pItemQty[$index2]' WHERE Equip_P_Item_ID = '$pItem' AND Equip_P_Pack_ID = '$ID';");
              }

              ?>
                <script>
                        swal({
                          title: "Saved",
                          text: "Package Saved Successfully!!!",
                          icon: "success",
                          button: "Continue",
                        }).then(function() {
                          location.replace("package-detail.php?id=<?php echo $ID?>");
                    });
                </script>
              <?php


            }else{
              ?>
                <script>
                        swal({
                          title: "Warning",
                          text: "Please Select At Least 1 Item!",
                          icon: "warning",
                          button: "Continue",
                        }).then(function() {
                          location.replace("package-detail.php?id=<?php echo $ID?>");
                    });
                </script>
              <?php
            }
            if(!empty($_POST['restore']))
            {
              $restore_all=$_POST['restore'];  
              foreach($restore_all as $restore)
              {
                $restoreID = $restore;
                if(mysqli_query($connect,"UPDATE equip_package SET Equip_P_isDelete = '0' WHERE Equip_P_Item_ID = '$restoreID' AND Equip_P_Pack_ID = '$ID'")){
                }
              }
            }
            if(!empty($_POST['delete']))
            {
            $delete_all=$_POST['delete'];  
            foreach($delete_all as $delete)
            {
              $removeID = $delete;
              $dsql="SELECT * FROM equip_package where Equip_P_Pack_ID = '$ID' and Equip_P_isDelete = 0";
              $dresult = mysqli_query($connect,$dsql);
              $dnum_row = mysqli_num_rows($dresult);
              if($dnum_row==1)
              {
                ?>
                <script>
                        swal({
                          title: "Warning",
                          text: "Please Select At Least 1 Item!",
                          icon: "warning",
                          button: "Continue",
                        }).then(function() {
                          location.replace("package-detail.php?id=<?php echo $ID?>");
                    });
                </script>
                <?php
              }
              else{
              if(mysqli_query($connect,"UPDATE equip_package SET Equip_P_isDelete = '1' WHERE Equip_P_Item_ID = '$removeID' AND Equip_P_Pack_ID = '$ID'")){
            }
            }
            } 

          }
        }
        }
        ?>
    </body>
</html>