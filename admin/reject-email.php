<?php
    session_start();
    include 'admin_url_check.php';
    include 'dataconnection.php';
    $reason = $_GET['reason'];
    $id= $_GET['id'];
    $result = mysqli_query($connect,"SELECT * from book where Book_ID='$id'");
    $row=mysqli_fetch_assoc($result);
    $custID = $row["Book_Cust_ID"];
    $result2 = mysqli_query($connect,"SELECT * from customer where Cust_ID='$custID' and Cust_isVerify = 1 ");
    $row2 = mysqli_fetch_assoc($result2);
                  $custEmail = $row2["Cust_Email"];
                  $to_email = $custEmail;
                  $subject = "Booking Rejected!";
                  $from_email= "contact.us.fiesta@gmail.com";
                  $headers  = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type: text/html;" . "\r\n";
                  $headers .= "From: ".$from_email."\r\n".
                    "Reply-To: ".$from_email."\r\n" .
                    "X-Mailer: PHP/" . phpversion();
                
                    $body = "<html><body>";
                    $body .= "<h3>Dear <span style='text-transform: uppercase';>".$row2["Cust_Name"]."</span></h3>".
                            "<h4>Greeting Sir/Madam,</h4>".
                            "<p>We are sorry to inform you that we are not able to accept your booking. Details are as follows:-</p>".
                            "<p><b>Event Name: </b>".$row["Book_Event_Name"]."</p>
                            <p><b>Event Date: </b>".$row["Book_Event_Date"]."</p>
                            <p><b>Event Time: </b>".$row["Book_Event_Time"]."</p>
                            <p><b>Reason: </b>".$reason."</p>
                            <p>Please reply back this email with your bank account number.</p>
                            <p>Regards,<br>Fiesta Corp.</p>";
                    $body .= "</body></html>";
                  if (mail($to_email, $subject, $body,$headers)) {
                    ?>
                    <script>
                          location.replace("booking-details.php?id=<?php echo $id ?>");
                  </script>
                  <?php
                  }
        ?>