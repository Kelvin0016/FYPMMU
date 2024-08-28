<?php session_start();?>
<?php include "dataconnection.php";?>
<?php include "url_check.php" ?>
<?php
    $cust_id = $_SESSION["cust_id"];
    $id = $_GET['id'];
    $sql = "UPDATE book SET Book_Status = 3 where Book_ID = '$id'";
    $status = $_GET['status'];
    $bo_sql = "SELECT * FROM book where Book_ID = '$id'";
	$bo_result = mysqli_query($connect,$bo_sql);
    $bo_row = mysqli_fetch_assoc($bo_result);
    $cu_sql = "SELECT * FROM customer where Cust_ID='$cust_id' and Cust_isDelete=0";
    $cu_result = mysqli_query($connect,$cu_sql);
    $cu_row = mysqli_fetch_assoc($cu_result);
    $pa_sql = "SELECT * FROM payment where Pay_Book_ID = '$id'";
	$pa_result = mysqli_query($connect,$pa_sql);
    $pa_row = mysqli_fetch_assoc($pa_result);
    $refund = $pa_row['Pay_Amount'];
    if(mysqli_query($connect,$sql))
    {
        if($status==0)
        {
            $to_email = $cu_row['Cust_Email'];
            $subject = "Fiesta Corp: Canceled Done";
            $from_email= "contact.us.fiesta@gmail.com";
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html;" . "\r\n";
            $headers .= "From: ".$from_email."\r\n".
              "Reply-To: ".$from_email."\r\n" .
              "X-Mailer: PHP/" . phpversion();
             
              $body = "<html><body>";
              $body .= "<h3>Dear <span style='text-transform: uppercase';>".$cu_row['Cust_Name']."</span></h3>".
                      "<h4>You have Cancelled Your Booking</h4>".
                      "<p>You can get full refund.<br>".
                      "Please reply back this email with your bank account number.</p>".
                      "<p><b>Your Booking Details:</b></p>".
                      "<p><b>Booking ID:</b> ".$id."<br>".
                      "<b>Book Event Name:</b> ".$bo_row['Book_Event_Name']."<br>".
                      "<b>Book Event Date:</b> ".$bo_row['Book_Event_Date']."<br>".
                      "<b>Book Event Time:</b> ".$bo_row['Book_Event_Time']."<br>".
                      "<b>Theme Name:</b>  ".$bo_row['Book_Event_Theme_Name']."<br>".
                      "<p><b>Refund Amount:</b> RM ".$refund."</p>".
                      "<p>If you didn't do this action please contact with us.</p>".
                      "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
              $body .= "</body></html>";
              mail($to_email, $subject, $body,$headers);
        }
        else
        {
            $refund = $refund * 0.7;
            $to_email = $cu_row['Cust_Email'];
            $subject = "Fiesta Corp: Canceled Done";
            $from_email= "contact.us.fiesta@gmail.com";
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html;" . "\r\n";
            $headers .= "From: ".$from_email."\r\n".
              "Reply-To: ".$from_email."\r\n" .
              "X-Mailer: PHP/" . phpversion();
             
              $body = "<html><body>";
              $body .= "<h3>Dear <span style='text-transform: uppercase';>".$cu_row['Cust_Name']."</span></h3>".
                      "<h4>You have Cancelled Your Booking</h4>".
                      "<p>You can get 70% refund.<br>".
                      "Please reply back this email with your bank account number.</p>".
                      "<p><b>Your Booking Details:</b></p>".
                      "<b>Book Event Name:</b> ".$bo_row['Book_Event_Name']."<br>".
                      "<b>Book Event Date:</b> ".$bo_row['Book_Event_Date']."<br>".
                      "<b>Book Event Time:</b> ".$bo_row['Book_Event_Time']."<br>".
                      "<b>Theme Name:</b>  ".$bo_row['Book_Event_Theme_Name']."<br>".
                      "<p><b>Refund Amount:</b> RM ".number_format((float)$refund, 2, '.', '')."</p>".
                      "<p>If you didn't do this action please contact with us.</p>".
                      "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
              $body .= "</body></html>";
              mail($to_email, $subject, $body,$headers);
        }
        echo "		
            <!DOCTYPE html>
            <html lang='en'>
              <head>
                <title>Fiesta Cor.</title>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <link rel='shortcut icon' href='images/Logo.png' />
                
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
                body {
                    background-image: url('images/logoutbg.jpg');
                    background-repeat: no-repeat;
                    background-attachment: fixed; 
                    background-size: cover;
                  }
            </style>
            <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            </head>
            <body>
            <script>
            swal({
                title: 'Canceled',
                text: 'You Have Canceled Successfully!!!',
                icon: 'success',
                button: 'Home',
            }).then(function() {
                location.replace('index.php');
            });
            </script>
            </body>
            
            ";
        }
        else
        {
            echo "		
            <!DOCTYPE html>
            <html lang='en'>
              <head>
                <title>Fiesta Cor.</title>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <link rel='shortcut icon' href='images/Logo.png' />
                
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
                body {
                    background-image: url('images/logoutbg.jpg');
                    background-repeat: no-repeat;
                    background-attachment: fixed; 
                    background-size: cover;
                  }
            </style>
            <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            </head>
            <body>
            <script>
            swal({
                title: 'Unsuccess',
                text: 'You Request is Unsuccess!',
                icon: 'error',
                button: 'Home',
            }).then(function() {
                location.replace('index.php');
            });
            </script>
            </body>
            
            ";
    }

?>