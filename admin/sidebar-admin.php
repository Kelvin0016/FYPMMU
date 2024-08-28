<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    
  </head>
  <?php 
    $result=mysqli_query($connect,"SELECT * from admin WHERE Adm_isDelete = '0' and Adm_ID = '$user_id'");
    $row = mysqli_fetch_assoc($result);
  ?>
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
  <body>
    <div class="menu-btn"  onclick="bar()">
            <span class="fas fa-bars"></span>
          </div>
          <nav class="sidebar" id="sb">
            <div class="profile-area">
              <div class="profile-pic-area">
                <img src="../<?php echo $row['Adm_Photo']?>" alt="" class="profile-pic">
              </div>
              <div>
                <span class="username" id="username"><?php echo $row['Adm_Name']?></span>
              </div>
            </div>
            <ul>
             <li class="dashboard-link"><a href="dashboard.php">Dashboard</a></li>
             <li class="profile"><a href="profile-admin.php">Profile</a></li>
              <li class="booking-view-link"><a href="booking-view.php">Booking</a></li>
              <li class="cust-view-link"><a href="cust-view.php">Customers</a></li>
              <li class="rate-comm-view-link"><a href="rate-comment.php">Ratings & Comments</a></li>
              <li>
                <a href="#" class="event-btn">Event
                  <span class="fas fa-caret-down first"></span>
                </a>
                <ul class="event-show">
                  <li class="event-view-link"><a href="event-view.php">View</a></li>
                  <li class="event-add-link"><a href="event-add.php?id=0">Add</a></li>
                </ul>
              </li>
              <li>
                <a href="#" class="item-btn">Items
                  <span class="fas fa-caret-down second"></span>
                </a>
                <ul class="item-show">
                  <li class="item-view-link"><a href="item-view.php">View</a></li>
                  <li class="item-add-link"><a href="item-add.php?id=0">Add</a></li>
                </ul>
              </li>
              <li>
                <a href="#" class="pack-btn">Packages
                  <span class="fas fa-caret-down third"></span>
                </a>
                <ul class="pack-show">
                  <li class="pack-view-link"><a href="package-view.php">View</a></li>
                  <li class="pack-add-link"><a href="package-add.php">Add</a></li>
                </ul>
              </li>
              <li>
                <a href="#" class="venue-btn">Venue
                  <span class="fas fa-caret-down fifth"></span>
                </a>
                <ul class="venue-show">
                  <li class="venue-view-link"><a href="venue-view.php">View</a></li>
                  <li class="venue-add-link"><a href="venue-add.php?id=0">Add</a></li>
                </ul>
              </li>
              <li>
                <a href="#" class="voucher-btn">Voucher
                  <span class="fas fa-caret-down sixth"></span>
                </a>
                <ul class="voucher-show">
                  <li class="voucher-view-link"><a href="voucher-view.php">View</a></li>
                  <li class="voucher-add-link"><a href="voucher-add.php?id=0">Add</a></li>
                </ul>
              </li>
            </ul>
          </nav>
          <div class="logout-div">
            <a class="logout" href="logout.php"><input type="button" value="Logout" class="logout-btn"></a>
          </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </body>
</html>
