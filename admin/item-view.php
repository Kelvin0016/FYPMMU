<?php
session_start();
include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Items</title>
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
            <h1>Items</h1>
        </div>
        <div class="filter-area">
          
          <div class="row filter">
            <div>
            <input type="button" value="ADD" onclick="window.location.href='item-add.php?id=0'" class="btn add" style="margin-right:10px; background-color:red; color:white;">
              <input type="button" value="PDF" onclick="window.open('pdf.php?tab=item')" class="btn" style="margin-right:10px;">
            </div>
              <div class="" style="margin-right: 5px;">
                  <select name="filter" id="" class="filter-type" >
                    <option value="0">Filter by</option>
                    <option value="2">Item Name</option>
                    <option value="4">Item ID</option>
                  </select>
              </div>
              <div style="margin-right:20px;">
                  <input type="text" name="filterDetail" class="form-control filterText">
              </div>
          </div>
        </div>

        <div class="table-area">
            <table class="view-table">
                <thead>
                    <tr>
                        <th>No.</th><th>Item Name</th><th>Price (RM)</th><th>Item ID</th><th colspan="2" class="actionCol">Action</th>
                    </tr>
                </thead>
                <?php
                	$results_per_page = 10;
                  $result=mysqli_query($connect,"SELECT * from item WHERE Item_isDelete = '0'");
                  $num_of_results = mysqli_num_rows($result);
                  $num_of_pages = ceil($num_of_results/$results_per_page);
                  if (!isset($_GET['page'])) {
                    $page = 1;
                    } else {
                    $page = $_GET['page'];
                    }

                  $this_page_first_result = ($page-1)*$results_per_page;
                  $sql='SELECT * FROM item WHERE item_isDelete!=1 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                  $result = mysqli_query($connect, $sql);

                ?>
                <tbody>
                <?php
                  $count = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo ++$count?></td>
                        <td><?php echo $row["Item_Name"] ?></td>
                        <td><?php echo $row["Item_Price"]?></td>
                        <td><?php echo $row["Item_ID"]?></td>
                        <td class="more"><a href="item-add.php?id=<?php echo $row["Item_ID"]?>">More</a></td>
                        <td class="del"><a id="item-view.php?id=<?php echo $row["Item_ID"]?>" onclick="delConfirmation(this.id)">Delete</a></td>
                    </tr>
                    <?php
                  }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
						  <?php
						  for($page=1;$page<=$num_of_pages;$page++)
						  {
							  echo "<li id='".$page."' class=''><a href='item-view.php?page=".$page."'>".$page."</a></li>";
						  }	
						?>
		              </ul>
		            </div>
		          </div>
		        </div>
		    	</div>
          <?php
					if (!isset($_GET['page'])) {
						$active = 1;
					  } else {
						$active = $_GET['page'];
					  }
					?>
					<script>
						var active =document.getElementById("<?php echo $active?>");
						active.classList.add("active");
					</script>
        

        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/site.js"></script>
        <script src="js/main.js"></script>

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
            $(".second").addClass("rotate");
            $(".item-show").addClass("show1");
            $(".item-view-link").addClass("active");
          });
        </script>

        <?php
          if (isset($_GET["id"])) 
          {
            $itemID = $_GET["id"];
            $sql = "SELECT * FROM book where Book_Status = 0";
            $result = mysqli_query($connect,$sql);
            $total = 0;
            //find whether are there still pending bookings where this item is included
            while($row=mysqli_fetch_assoc($result))
            {
              $bp_id=$row['Book_Pack_ID'];
              $bpsql = "SELECT * From equip_book_package where Equip_B_Pack_ID = '$bp_id' and Equip_B_Item_ID = '$itemID'";
              $bpresult = mysqli_query($connect,$bpsql);
              $bpnum_rows = mysqli_num_rows($bpresult);
              $total += $bpnum_rows;
            }
            if($total>0)
            {
              ?>
              <script>
                swal({
                  title: "Cannot Delete",
                  text: "Still have bookings on Pending where this item is included.",
                  icon: "error",
                  button: "Close",
                }).then(function() {
                        location.replace("item-view.php");
                  });
              </script>
              <?php
            }
            else{
              //find whether are there still accepted bookings that are still running where this item is included
              $today = date("Y-m-d");
              $sql = "SELECT * FROM book where Book_Status = 1 and Book_Event_Date > '$today'";
              $result = mysqli_query($connect,$sql);
              $total = 0;
              while($row=mysqli_fetch_assoc($result))
              {
                $bp_id=$row['Book_Pack_ID'];
                $bpsql = "SELECT * From equip_book_package where Equip_B_Pack_ID = '$bp_id' and Equip_B_Item_ID = '$itemID'";
                $bpresult = mysqli_query($connect,$bpsql);
                $bpnum_rows = mysqli_num_rows($bpresult);
                $total += $bpnum_rows;
              }
              if($total>0)
              {
                ?>
                <script>
                  swal({
                    title: "Cannot Delete",
                    text: "Still have Accepted bookings that are still running where this item is included.",
                    icon: "error",
                    button: "Close",
                  }).then(function() {
                        location.replace("item-view.php");
                  });
                </script>
                <?php
              }
              else{
                //delete the item
                if(mysqli_query($connect,"UPDATE item SET Item_isDelete = '1' WHERE Item_ID = '$itemID'") && mysqli_query($connect,"UPDATE equip_package SET Equip_P_isDelete = '1' WHERE Equip_P_Item_ID = '$itemID'")){
                  ?>
                    <script>
                            swal({
                            title: "Deleted",
                            text: "Deleted Successfully!!!",
                            icon: "success",
                            button: "Continue",
                          }).then(function() {
                            location.replace("item-view.php");
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