<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vouchers</title>
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/site.css">
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
            <h1>Vouchers</h1>
        </div>
        <div class="filter-area">
          <div class="row filter">
            <div>
              <input type="button" value="ALL" class="btn btn-primary allBtn">
              <input type="button" value="ACTIVE" class="activeVoucBtn btn btn-primary" style="margin-right:5px;">
              <input type="button" value="INACTIVE" class="expiredVoucBtn btn btn-primary" style="margin-right:15px;">
              <input type="button" value="ADD" onclick="window.location.href='voucher-add.php?id=0'" class="btn add" style="margin-right:10px; background-color:red; color:white;">
              <input type="button" value="PDF" onclick="window.open('pdf.php?tab=voucher')" class="btn" style="margin-right:10px;">
            </div>
              <div class="" style="margin-right: 5px;">
                  <select name="filter" id="" class="filter-type" >
                    <option value="0">Filter by</option>
                    <option value="2">Voucher Name</option>
                    <option value="3">Voucher Code</option>
                    <option value="4">Voucher ID</option>
                    <option value="5">Discount Rate</option>
                    <option value="6">Start Date</option>
                    <option value="7">End Date</option>
                  </select>
              </div>
              <div class="col-lg-2">
                  <input type="text" name="filterDetail" class="form-control filterText">
              </div>
          </div>
        </div>

        <div class="table-area">
            <table class="view-table">
                <thead>
                    <tr>
                        <th>No.</th><th>Voucher Name</th><th>Voucher Code</th><th>Voucher ID</th><th>Discount Rate (%)</th><th>Start Date</th><th>End Date</th><th>Status</th><th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                  $result=mysqli_query($connect,"SELECT * from voucher WHERE Vouc_isDelete = '0' AND Vouc_Status = 0;");
                ?>
                <tbody class="activeVouc">
                <?php
                  $count = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row["Vouc_Name"] ?></td>
                        <td><?php echo $row["Vouc_Code"]?></td>
                        <td><?php echo $row["Vouc_ID"]?></td>
                        <td><?php echo $row["Vouc_Discount"]?></td>
                        <td><?php echo $row["Vouc_Start_Date"]?></td>
                        <td><?php echo $row["Vouc_Exp_Date"]?></td>
                        <td>
                        <?php 
                          $stat = $row["Vouc_Status"];
                          if($stat == 0){
                            ?><span class="badge badge-success" style="font-size:20px;">Active</span><?php
                          }else if($stat == 1){
                            ?><span class="badge badge-danger" style="font-size:20px;">Inactive</span><?php
                          }
                        ?>
                        </td>
                        <td class="more"><a href="voucher-add.php?id=<?php echo $row["Vouc_ID"]?>">More</a></td>
                        <td class="del"><a id="voucher-view.php?id=<?php echo $row["Vouc_ID"]?>" onclick="delConfirmation(this.id)">Delete</a></td>
                    </tr>
                    <?php
                  }
                    ?>
                </tbody>
                <?php
                  $result2=mysqli_query($connect,"SELECT * from voucher WHERE Vouc_isDelete = '0' AND Vouc_Status = 1;");
                ?>
                <tbody class="expiredVouc">
                <?php
                  $count = 0;
                  while($row2 = mysqli_fetch_assoc($result2)){
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row2["Vouc_Name"] ?></td>
                        <td><?php echo $row2["Vouc_Code"]?></td>
                        <td><?php echo $row2["Vouc_ID"]?></td>
                        <td><?php echo $row2["Vouc_Discount"]?></td>
                        <td><?php echo $row2["Vouc_Start_Date"]?></td>
                        <td><?php echo $row2["Vouc_Exp_Date"]?></td>
                        <td>
                        <?php 
                          $stat = $row2["Vouc_Status"];
                          if($stat == 0){
                            ?><span class="badge badge-success" style="font-size:20px;">Active</span><?php
                          }else if($stat == 1){
                            ?><span class="badge badge-danger" style="font-size:20px;">Inactive</span><?php
                          }
                        ?>
                        </td>
                        <td class="more"><a href="voucher-add.php?id=<?php echo $row2["Vouc_ID"]?>">More</a></td>
                        <td class="del"><a id="voucher-view.php?id=<?php echo $row2["Vouc_ID"]?>" onclick="delConfirmation(this.id)">Delete</a></td>
                    </tr>
                    <?php
                  }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
      <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/site.js"></script>

        <script>
          $(document).ready(function(){
            if($ad_super == 0)
              {
                $(".del").css("display","none");
                $(".more").css("border","none");
                $(".add").css("display","none");
              }
              else{
                $(".del").css("display","");
                $(".more").css("border","");
              }
            $(".sixth").addClass("rotate");
            $(".voucher-show").addClass("show5");
            $(".voucher-view-link").addClass("active");
          });

          $(".activeVoucBtn").click(function () {
            $(".expiredVouc").css("display","none");
            $(".activeVouc").css("display","");
          });

          $(".expiredVoucBtn").click(function () {
            $(".expiredVouc").css("display","");
            $(".activeVouc").css("display","none");
          });
          $(".allBtn").click(function(){
            $(".expiredVouc").css("display","");
            $(".activeVouc").css("display","");
          });

        </script>

        <?php
          if (isset($_GET["id"])) 
          {
            $VID = $_GET["id"];
            if(mysqli_query($connect,"UPDATE voucher SET Vouc_isDelete = '1' WHERE Vouc_ID = '$VID'")){
              ?>
                <script>
                  			swal({
                        title: "Deleted",
                        text: "Deleted Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("voucher-view.php");
                  });
                </script>
              <?php
            }
          }
        ?>
    </body>
</html>