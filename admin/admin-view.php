<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Superusers & Admins</title>
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
          $user_id = $_SESSION['super_id'];
          include 'sidebar-super.php';
    ?>
      
      <div class="pg-content">
        <div class="title-area">
            <h1>Superusers & Admins</h1>
        </div>
        <div class="filter-area">
          <div class="row filter">
            <div>
              <!-- pdf buttons -->
              <input type="button" value="ADD" onclick="window.location.href='admin-add.php?id=0'" class="btn" style="margin-right:10px; background-color:red; color:white;">
              <input type="button" value="PDF" onclick="window.open('pdf.php?tab=admin')" class="btn" style="margin-right:10px;">
            </div>
              <div class="col-lg-1" style="margin-right: 5px;">
                <!-- filtering function -->
                <select name="filter" id="" class="filter-type" >
                    <option value="0">Filter by</option>
                    <option value="2">Name</option>
                    <option value="3">Contact Number</option>
                    <option value="4">Email</option>
                    <option value="5">Staff ID</option>
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
                        <th>No.</th><th>Admin Name</th><th>Contact Number</th><th>Email</th><th>Staff ID</th><th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                  $result=mysqli_query($connect,"SELECT * from superuser where Super_ID!='$user_id'");
                ?>
                <thead>
                    <tr>
                        <th colspan="7" style="text-align:left; padding-left:20px;">Superuser</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  $count = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $row["Super_Name"];?></td>
                        <td><?php echo $row["Super_PhoneNo"];?></td>
                        <td><?php echo $row["Super_Email"];?></td>
                        <td><?php echo $row["Super_Staff_ID"];?></td>
                        <td colspan="2"><a href="super-detail.php?sid=<?php echo $row["Super_ID"]; ?>">More</a></td>
                    </tr>
                    <?php
                  }
                    ?>
                </tbody>
                <?php
                  $result=mysqli_query($connect,"SELECT * from admin WHERE Adm_isDelete = '0'");
                ?>
                <thead>
                    <tr>
                        <th colspan="7" style="text-align:left; padding-left:20px; border-top: 1px solid black;">Admin</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  $count = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $row["Adm_Name"];?></td>
                        <td><?php echo $row["Adm_PhoneNo"];?></td>
                        <td><?php echo $row["Adm_Email"];?></td>
                        <td><?php echo $row["Adm_Staff_ID"];?></td>
                        <td><a href="admin-add.php?id=<?php echo $row["Adm_ID"]; ?>">More</a></td>
                        <td><a href="admin-view.php?id=<?php echo $row["Adm_ID"]; ?>" onclick = "return delConfirmation()">Delete</a></td>
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
            $(".fourth").addClass("rotate");
            $(".admin-show").addClass("show3");
            $(".admin-view-link").addClass("active");
          });
        </script>

        <?php
          if (isset($_GET["id"])) 
          {
            //deleting admin
            $adminID = $_GET["id"];
            if(mysqli_query($connect,"UPDATE admin SET Adm_isDelete = '1' WHERE Adm_ID = '$adminID'")){
              ?>
                <script>
                  swal({
                        title: "Deleted",
                        text: "Deleted Successfully!!!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("admin-view.php");
                  });
                </script>
              <?php
            }
          }
        ?>
    </body>
</html>