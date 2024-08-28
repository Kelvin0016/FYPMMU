<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Package Add Item</title>
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
                <h1><span class="new">Package Add Item</h1>
            </div>

            <?php
              $id = $_GET["id"];
              $result3 = mysqli_query($connect,"SELECT * from package where Pack_ID = '$id' AND Pack_isDelete = 0;");
              $row3 = mysqli_fetch_assoc($result3);
              $pID = $row3["Pack_ID"];
              //get records from item and equip package table
              $result = mysqli_query($connect, "Select * from item where Item_isDelete = 0;");
              $result2 = mysqli_query($connect, "Select * from equip_package where Equip_P_Pack_ID = '$pID';");
              $pItemArr = [];
              while($row2 = mysqli_fetch_assoc($result2)){
                $E_P_itemID=$row2["Equip_P_Item_ID"];
                //save the item IDs into an array (means it is in the package)
                //those items that are alr in the package won't be displayed here
                array_push($pItemArr,$E_P_itemID);
              }
            ?>

            <div class="form-area">
                <form method="post" class="form-css">
                    <div class="row">
    
                        <div class="col-lg-12 detail-area">
                            <div class="row">
                                <div class="col-lg-3 label-area">
                                    For Package :
                                </div>
                                <div class="col-lg-9">
                                      <?php
                                      // //if pID is 0 means we creating new, so just choose the latest (last) record
                                      //   if($pID==0){
                                      //     $result1 = mysqli_query($connect,"Select * from package where Pack_ID = (SELECT max(Pack_ID) from package) AND Pack_isDelete = '0';");
                                      //   }else{
                                        //this is for adding more items into a certain exist package
                                        $result1 = mysqli_query($connect,"Select * from package where Pack_ID = '$pID' AND Pack_isDelete = '0';");
                                        
                                        $row1 = mysqli_fetch_assoc($result1);
                                      ?>
                                      <!-- hidden input to hold the package id -->
                                      <input type="text" name="packSelect" value="<?php echo $row1["Pack_ID"] ?>" hidden>
                                      <span><?php echo $row1["Pack_Name"]; ?></span>
                                </div>
                            </div>

                            <div class="row"> 
                              <div class="col-lg-9 item-list" style="margin-top: 20px;">
                                <h4 style="float: left;">Item list</h4>
                                <div class="filter-area">
                                  <div class="row filter">
                                      <div class="" style="margin-right: 5px;">
                                          <select name="filter" id="" class="filter-type" >
                                            <option value="0">Filter by</option>
                                            <option value="1">Item Name</option>
                                            <option value="2">Item ID</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-2">
                                          <input type="text" name="filterDetail" class="form-control filterText">
                                      </div>
                                  </div>
                                </div>
                                <div class="overflow-scroll">
                                  <table class="pack-item-tab ">
                                    <thead>
                                      <tr>
                                        <th>Item Name</th><th>Item ID</th><th colspan="2" style="width:50%;">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      while($row = mysqli_fetch_assoc($result)){
                                        //show items that are not in the package currently
                                        if(!in_array($row["Item_ID"],$pItemArr)){
                                        ?>
                                          <tr>
                                            <td><?php echo $row["Item_Name"]?></td><td><?php echo $row["Item_ID"]?></td><td><input type="checkbox" class="checker" name="items[]" value="<?php echo $row["Item_ID"] ?>"></td><td></td>
                                          </tr>
                                        <?php
                                        }
                                      };
                                    ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="btn-area">
                                <div class="btn-group row">
                                      <?php
                                        if(!empty($pItemArr)){?>
                                          <div class="col-lg-6" >
                                            <a href="package-detail.php?id=<?php echo $pID?>" class="btn btn-danger cancel">Cancel</a>
                                          </div><?php
                                        }
                                      ?>
                                    
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

            $(".checker").click(function(){
                if($(this).prop("checked") == true){
                    $(this).parent().parent().find("td:last-child").append("Quantity: <input type='number' name='itemQty[]' class='item-qty' min='1' required>");
                    $(".item-qty").keypress(function(e) {
                      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                      return false;
                      }
                    })
                  }
                else if($(this).prop("checked") == false){
                  $(this).parent().parent().find("td:last-child").empty();
                }
            });

            $('a:not(.logout)').on('click', function(e){
              
              <?php
              $check = "SELECT * from equip_package where Equip_P_Pack_ID = '$pID' AND Equip_P_isDelete = 0";
              $checkRes = mysqli_query($connect,$check);
              $num = mysqli_num_rows($checkRes);
              ?>
              var num = <?php echo $num ;?>;
              if(num ==0)
              {
                e.preventDefault();
                swal({
                        title: "Warning",
                        text: "Please add at least 1 item!",
                        icon: "warning",
                        button: "Continue",
                      });
              }     
 
            });


        </script>
        <?php
          if(isset($_POST["submitBtn"])){
            $equipPackID = $_POST["packSelect"];
            //check if the vars are null or not
            if(!empty($_POST["items"]))
            {
              $items = $_POST["items"];
            }
            else
            {
              $items = "";
            }
            if(!empty($_POST["itemQty"]))
            {
              $itemQty = $_POST["itemQty"];
            }
            else
            {
              $itemQty = "";
            }
            $packIsDel = 0;
            $equipPackIsDel = 0;

            if(!empty($items)){
              foreach($items as $index => $item)
              {
                mysqli_query($connect,"INSERT into equip_package(Equip_P_Pack_ID,	Equip_P_Item_ID,	Equip_P_Qty,	Equip_P_isDelete) values('$equipPackID','$item','$itemQty[$index]','$equipPackIsDel');");
                ?>
                  <script>
                    console.log("<?php echo $equipPackID ?>");
                  </script>
                <?php
              }
              if($pID != 0){
                ?>
                  <script>
                  			swal({
                        title: "Saved",
                        text: "Item Added Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("package-detail.php?id=<?php echo $pID?>");
                  });
                  </script>
              <?php
              }
            }else{
              ?>
                <script>
                 swal({
                        title: "Warning",
                        text: "Please select at least 1 item!",
                        icon: "warning",
                        button: "Continue",
                      }).then(function() {
                        location.replace("package-add-item.php?id=<?php echo $pID?>");
                  });
                </script>
              <?php
            }


          }
        ?>
    </body>
</html>