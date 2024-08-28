<?php session_start();?>
<?php include "dataconnection.php";?>
<?php include "url_check.php" ?>
<?php
    $cust_id = $_SESSION["cust_id"];
    $sql = "UPDATE customer SET Cust_isDelete = 1 where Cust_ID = '$cust_id'";
    $cu_sql = "SELECT * FROM customer where Cust_ID='$cust_id'";
    $cu_result = mysqli_query($connect,$cu_sql);
    $cu_row = mysqli_fetch_assoc($cu_result);
    if(mysqli_query($connect,$sql))
    {
        $to_email = $cu_row['Cust_Email'];
        $subject = "Fiesta Corp: Account Deleted";
        $from_email= "contact.us.fiesta@gmail.com";
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html;" . "\r\n";
        $headers .= "From: ".$from_email."\r\n".
        "Reply-To: ".$from_email."\r\n" .
        "X-Mailer: PHP/" . phpversion();
             
        $body = "<html><body>";
        $body .= "<h3>Dear <span style='text-transform: uppercase';>".$cu_row['Cust_Name']."</span></h3>".
                      "<h4>You have Deleted Your Account!!!</h4>".
                      "<p><b>Customer ID:</b> ".$cust_id."<br>".
                      "<b>Customer Name:</b> ".$cu_row['Cust_Name']."<br>".
                      "<b>Customer Email:</b> ".$cu_row['Cust_Email']."<br>".
                      "<b>Customer Phone No.:</b> ".$cu_row['Cust_PhoneNo']."<br>".
                      "<b>Customer Membership:</b> ".$cu_row['Cust_Membership']."</p>".
                      "<p>If you didn't do this action please contact with us.</p>".
                      "<p>Regards,<br>Fiesta Corp. Customer Service</p>";
              $body .= "</body></html>";
              mail($to_email, $subject, $body,$headers);

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
                title: 'Deleted Accouunt',
                text: 'You Have Deleted Your Account Successfully!!!',
                icon: 'success',
                button: 'Home',
            }).then(function() {
                location.replace('logout.php');
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