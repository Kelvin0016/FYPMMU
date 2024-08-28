<?php
  session_start();
  include 'admin_url_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ratings & Comments</title>
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/site.css">
        <link rel='shortcut icon' href='../images/Logo.png' />
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
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

    <style>
        
    </style>
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
            <h1>Ratings and Comment</h1>
        </div>
        <div class="filter-area">
          <div class="row filter">
              <div class="col-lg-1" style="margin-right: 5px;">
                <select name="filter" id="" class="filter-type" >
                    <option value="0">Filter by</option>
                    <option value="2">Customer Name</option>
                    <option value="4">Rating</option>
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
                        <th>No.</th><th>Customer Name</th><th>Comment</th><th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $count=0;
                        $Rcount = 1;
                        $results_per_page = 10;
                        $result=mysqli_query($connect,"SELECT * FROM rate_comment;");
                        $num_of_results = mysqli_num_rows($result);
                        $num_of_pages = ceil($num_of_results/$results_per_page);
                        if (!isset($_GET['page'])) {
                          $page = 1;
                          } else {
                          $page = $_GET['page'];
                          }
      
                        $this_page_first_result = ($page-1)*$results_per_page;
                        $sql='SELECT * FROM rate_comment LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                        $result = mysqli_query($connect, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                            $custID = $row["R_C_Cust_ID"];
                            $result2=mysqli_query($connect,"SELECT * FROM customer where Cust_ID='$custID';");
                            $row2=mysqli_fetch_assoc($result2);
                    ?>
                        <tr>
                            <td><?php echo ++$count?></td>
                            <td><?php echo $row2["Cust_Name"]?></td>
                            <td><?php echo $row["Comment"]?></td>
                            <td>
                              <p class="mr-4">
                                <a href="#"><span class="zmdi zmdi-star-outline" id="star1_<?php echo $Rcount;?>"></span></a>
                                <a href="#"><span class="zmdi zmdi-star-outline" id="star2_<?php echo $Rcount;?>"></span></a>
                                <a href="#"><span class="zmdi zmdi-star-outline" id="star3_<?php echo $Rcount;?>"></span></a>
                                <a href="#"><span class="zmdi zmdi-star-outline" id="star4_<?php echo $Rcount;?>"></span></a>
                                <a href="#"><span class="zmdi zmdi-star-outline" id="star5_<?php echo $Rcount;?>"></span></a>
                              </p>
                              <script>
                                var star = <?php echo $row['Rating'];?>;
                                var count = <?php echo $Rcount;?>;
                                if(star==1)
                                {
                                document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star1_"+count).classList.add("zmdi-star");
                                }
                                else if(star==2)
                                {
                                document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star1_"+count).classList.add("zmdi-star");
                                document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star2_"+count).classList.add("zmdi-star");
                                }
                                else if(star==3)
                                {
                                document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star1_"+count).classList.add("zmdi-star");
                                document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star2_"+count).classList.add("zmdi-star");
                                document.getElementById("star3_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star3_"+count).classList.add("zmdi-star");
                                }
                                else if(star==4)
                                {
                                document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star1_"+count).classList.add("zmdi-star");
                                document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star2_"+count).classList.add("zmdi-star");
                                document.getElementById("star3_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star3_"+count).classList.add("zmdi-star");
                                document.getElementById("star4_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star4_"+count).classList.add("zmdi-star");
                                }
                                else if(star==5)
                                {
                                document.getElementById("star1_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star1_"+count).classList.add("zmdi-star");
                                document.getElementById("star2_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star2_"+count).classList.add("zmdi-star");
                                document.getElementById("star3_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star3_"+count).classList.add("zmdi-star");
                                document.getElementById("star4_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star4_"+count).classList.add("zmdi-star");
                                document.getElementById("star5_"+count).classList.remove("zmdi-star-outline");
                                document.getElementById("star5_"+count).classList.add("zmdi-star");
                                }

                                <?php
                                  $Rcount++;
                                ?>
                              </script>
                            </td>
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
							  echo "<li id='".$page."' class=''><a href='rate-comment.php?page=".$page."'>".$page."</a></li>";
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
                $(".rate-comm-view-link").addClass("active");
            });
        </script>
    </body>
</html>