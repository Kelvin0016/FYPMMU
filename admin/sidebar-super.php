<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <script>
    function bar()
    {
      var y = document.getElementById("sb");
      var x = document.getElementsByTagName("BODY")[0];
      if(y.className=="sidebar")
      {
      x.style.overflow = "hidden";
      $('html').addClass('hide-scrollbar');
      }
      else
      {
        x.style.overflow = "scroll";
        $('html').removeClass('hide-scrollbar');
        x.style.overflowX = "hidden";
        x.style.overflowY = "auto";
      }
    }
  </script>
  </head>
  <?php 
    $result=mysqli_query($connect,"SELECT * from superuser WHERE Super_ID = '$user_id'");
    $row = mysqli_fetch_assoc($result);
  ?>
  
  <body>
  <div class="menu-btn" onclick="bar()">
            <span class="fas fa-bars"></span>
          </div>
          <nav class="sidebar" id="sb">
            <div class="profile-area">
              <div>
                <span class="username" id="username"><?php echo $row['Super_Name']?></span>
              </div>
            </div>
            <ul>
              <li class="dashboard-link"><a href="dashboard.php">Dashboard</a></li>
              <li>
                <a href="#" class="admin-btn">Admins
                  <span class="fas fa-caret-down fourth"></span>
                </a>
                <ul class="admin-show ">
                  <li class="admin-view-link"><a href="admin-view.php">View</a></li>
                  <li class="admin-add-link"><a href="admin-add.php?id=0">Add</a></li>
                </ul>
              </li>
              <li class="profile"><a href="profile-super.php">Profile</a></li>
              <li class="booking-view-link"><a href="booking-view.php">Booking</a></li>
              <li class="cust-view-link"><a href="cust-view.php">Customers</a></li>
              <li class="rate-comm-view-link"><a href="rate-comment.php">Ratings & Comments</a></li>
              <li class="event-view-link"><a href="event-view.php">Events</a></li>
              <li class="item-view-link"><a href="item-view.php">Items</a></li>
              <li class="pack-view-link"><a href="package-view.php">Packages</a></li>
              <li class="venue-view-link"><a href="venue-view.php">Venue</a></li>
              <li class="voucher-view-link"><a href="voucher-view.php">Voucher</a></li>
            </ul>
          </nav>
          <div class="logout-div">
          <a class="logout" href="logout.php"><input type="button" value="Logout" class="logout-btn"></a>
          </div>


    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </body>
  <!-- faklsdj -->
</html>
