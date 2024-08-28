<?php
  session_start();
  include 'admin_url_check.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Booking Details</title>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="vendors/parsleyjs/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">
        <link rel='shortcut icon' href='../images/Logo.png' />
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

          $ID = $_GET["id"];
          //get details of particular booking
          $result = mysqli_query($connect,"SELECT * from book where Book_ID='$ID'");
          $row=mysqli_fetch_assoc($result);
          $custID = $row["Book_Cust_ID"];
          //get customer details of this booking
          $result2 = mysqli_query($connect,"SELECT * from customer where Cust_ID='$custID' and Cust_isVerify = 1 ");
          $row2 = mysqli_fetch_assoc($result2);
          $BPID = $row["Book_Pack_ID"];
          //get the package details of this booking
          $result3 = mysqli_query($connect,"SELECT * from book_package where Book_Pack_ID='$BPID'");
          $row3=mysqli_fetch_assoc($result3);
          //get equipments of this booking
          $result4 = mysqli_query($connect,"SELECT * from book_package, equip_book_package where Equip_B_Pack_ID=Book_Pack_ID and Book_Pack_ID='$BPID'");
          $row4 = mysqli_fetch_assoc($result4);
          $PID = $row3["Pack_ID"];
          //get package details
          $result7=mysqli_query($connect,"SELECT * from  package where Pack_ID = '$PID'");
          $row7 = mysqli_fetch_assoc($result7);
        ?>
        <div class="pg-content">
            <div class="title-area">
                <h1>Booking Details </h1>
            </div>

            <div class="form-area">
                <form method="post" class="form-css">
                    <div class="row">
    
                        <div class="col-lg-12 detail-area">
                          <div class="col-lg-4">
                            <div class="profile-area">
                              <!-- if own pack show customize picture else show the package pic -->
                              <img src="../<?php if($PID==0){echo "images/package/customize.jpg";}else{echo $row7["Pack_Picture"];} ?>" alt="Package Picture" class="event-pic">
                            </div>
                          </div>
                            <div class="col-lg-8">
                              <div class="row" hidden>
                                <div class="col-lg-3 label-area">
                                    ID :
                                </div>
                                <div class="col-lg-9">
                                    <input type="number" name="eventID" class="form-control" value="<?php echo $ID?>">
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Booking Name :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 30px;"><?php echo $row["Book_Event_Name"]?></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Customer Name :
                                  </div>
                                  <div class="col-lg-9">
                                    <span class="" style="font-size: 15px;"><?php echo $row2["Cust_Name"]?></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Booking Date & Time :
                                  </div>
                                  <div class="col-lg-9">
                                    <span class="" style="font-size: 15px;"><?php echo $row["Book_Date_Time"]?></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Event Date & Time:
                                  </div>
                                  <div class="col-lg-9">
                                      <span class="" style="font-size: 15px;"><?php echo $row["Book_Event_Date"];echo "&nbsp;"; echo $row["Book_Event_Time"];?></span>
                                    </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Address :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row["Book_Event_Venue_S_Address"]?></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Area :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row["Book_Event_Venue_Area"]?></span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      PostCode :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row["Book_Event_Venue_Pcode"]?></span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      State :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row["Book_Event_Venue_State"]?></span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Theme :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row["Book_Event_Theme_Name"]?></span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Package Name:
                                  </div>
                                  <div class="col-lg-9">
                                      <span class="" style="font-size: 15px;">
                                      <?php
                                        if($PID == 0){
                                          echo "Customize";
                                        }else{
                                          echo $row7["Pack_Name"];
                                        }
                                      ?>
                                      </span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Paid Amount :
                                  </div>
                                  <div class="col-lg-9" >
                                      <?php
                                        //get payment details for this booking
                                        $result5=mysqli_query($connect,"SELECT * from payment where Pay_Book_ID = '$ID' AND Pay_Cust_ID = '$custID';");
                                        $row5 = mysqli_fetch_assoc($result5);
                                      ?>
                                      <span class="" style="font-size: 15px;">RM <?php echo $row5["Pay_Amount"]?></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Payment Date :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row5["Pay_Date_Time"]?></span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Payment Voucher :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;"><?php echo $row5["Pay_Voucher"]; if($row5["Pay_Voucher"]==null){echo "None";}?></span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 label-area">
                                      Discount Amount :
                                  </div>
                                  <div class="col-lg-9" >
                                      <span class="" style="font-size: 15px;">RM <?php echo $row5["Pay_Discount_Amount"]?></span>
                                  </div>
                              </div>

    
                                <div class="row">
                                    <div class="col-lg-3 label-area">
                                        Booking Status :
                                    </div>
                                    <div class="col-lg-9" style="font-size:30px">
                                    <?php
                                        $stat = $row["Book_Status"];
                                        if($stat == 0){
                                            ?><span class="badge badge-warning" style="font-size:20px;">Pending</span><?php
                                        }else if($stat==1){
                                            ?><span class="badge badge-success" style="font-size:20px;">Accepted</span><?php
                                        }else if($stat== 2){
                                            ?><span class="badge badge-danger" style="font-size:20px;">Rejected</span><?php
                                        }else if($stat == 3){
                                            ?><span class="badge badge-secondary" style="font-size:20px;">Cancelled</span><?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-lg-8">
                                    <div class="col-lg-12 label-area">
                                        Package Items :
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="in-this-pack">
                                        <div class="overflow-scroll">
                                          <table class="pack-item-tab in-pack-item-tab">
                                            <thead>
                                              <tr>
                                                <th>Item Name</th><th>Quantity</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                              //show item details of this package
                                              while($row4 = mysqli_fetch_assoc($result4)){
                                                $EPItemID = $row4["Equip_B_Item_ID"];
                                                $result6 = mysqli_query($connect,"SELECT * from item where Item_ID = '$EPItemID'");
                                                $row6 = mysqli_fetch_assoc($result6);
                                                ?>
                                                <tr>
                                                  <td><?php echo $row6["Item_Name"]?></td><td><?php echo $row4["Equip_B_Qty"]?></td>
                                                </tr>
                                                <?php
                                              }
                                            ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                              </div>

                            <div class="row col-lg-12">
                              <div class="btn-area">
                                <div class="btn-group row">
                                  <div class="col-lg-4">
                                    <a href="booking-view.php" class="btn btn-warning"> Back</a>
                                  </div>
                                    <div class="col-lg-4">
                                        <input type="submit" class="btn btn-danger reject" value="Reject" name="rejectBtn">
                                      </div>
                                      <div class="col-lg-4">
                                        <input type="submit" class="btn btn-success approve" value="Approve" name="approveBtn">
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
        <script src="js/main.js"></script>
        <script src="js/site.js"></script>

        <script>

            $(document).ready(function () {
              if($ad_super == 0)
              {
                $(".reject").parent().css("display","none");
                $(".approve").parent().css("display","none");
              }
              else{
                $(".reject").parent().css("display","");
                $(".approve").parent().css("display","");
              }

              if(<?php echo $row["Book_Status"]?>!=0){
                $(".reject").parent().css("display","none");
                $(".approve").parent().css("display","none");
              }
            });

        </script>

        <?php
          if(isset($_POST["approveBtn"])){
            if(mysqli_query($connect,"UPDATE book SET Book_Status = 1 where Book_ID='$ID'")){
              ?>
                  <script>
                  			swal({
                        title: "Approved",
                        text: "This booking has been approved!",
                        icon: "success",
                        button: "Continue",
                      }).then(function() {
                        location.replace("booking-details.php?id=<?php echo $ID ?>");
                  });
                </script>
                <?php
                  //email to customer to notify them
                  $custEmail = $row2["Cust_Email"];
                  $to_email = $custEmail;
                  $subject = "Booked Successfully!";
                  $from_email= "contact.us.fiesta@gmail.com";
                  $headers  = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type: text/html;" . "\r\n";
                  $headers .= "From: ".$from_email."\r\n".
                    "Reply-To: ".$from_email."\r\n" .
                    "X-Mailer: PHP/" . phpversion();

                    $body = "<html><body>";
                    $body .= "<h3>Dear <span style='text-transform: uppercase';>".$row2["Cust_Name"]."</span></h3>".
                            "<h4>Greetings Sir/Madam,</h4>".
                            "<p>We are pleased to inform you that we have accepted your booking. Details are as follows:-</p>".
                            "<p><b>Event Name: </b>".$row["Book_Event_Name"]."</p>
                            <p><b>Event Date: </b>".$row["Book_Event_Date"]."</p>
                            <p><b>Event Time: </b>".$row["Book_Event_Time"]."</p>
                            <p>Regards,<br>Fiesta Corp.</p>";
                    $body .= "</body></html>";
                  if (mail($to_email, $subject, $body,$headers)) {
                    ?>
                    <script>
                          console.log("Email sent!");
                  </script>
                  <?php
                  }
            }
          }

          if(isset($_POST["rejectBtn"])){
            if(mysqli_query($connect,"UPDATE book SET Book_Status = 2 where Book_ID='$ID'")){
              ?>
                  <script>
                  //swal to get reject reason and pass to another page
                  swal({
                      title: "Reject Reason",
                      content: {
                        element: "input",
                        attributes: {
                          placeholder: "Type the reason",
                        },
                      },
                      icon: "info",
                      button: "Continue",
                    }).then((value)=>{
                  			swal({
                        title: "Rejected",
                        text: "You have rejected this booking!",
                        icon: "error",
                        button: "Continue",
                      }).then(function() {
                        location.replace("reject-email.php?id=<?php echo $ID ?>&reason="+value);
                  })
                    });
                </script>
                <?php
                  }
                }
                ?>
    </body>
</html>