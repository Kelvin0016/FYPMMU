<?php
        session_start();
        include 'dataconnection.php';
        include 'admin_url_check.php';
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            //admin reset
            $id = $_GET['id'];
            $length = 12; 
            //shuffle the characters for the pass based on the length
            $pass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%&*-+=_'),1,$length);
            $sql = "SELECT * from admin where Adm_ID = '$id' and Adm_isDelete = 0";
            $result = mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)>0)
            {
                //admin details found
                $row = mysqli_fetch_assoc($result);
                if(mysqli_query($connect,"UPDATE admin SET Adm_Password=PASSWORD('$pass') Where Adm_ID='$id'"))
                {
                  $to_email = $row['Adm_Email'];
                  $subject = "No-Reply; Superuser Reset Your Password";
                  $from_email= "contact.us.fiesta@gmail.com";
                  $headers  = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type: text/html;" . "\r\n";
                  $headers .= "From: ".$from_email."\r\n".
                    "Reply-To: ".$from_email."\r\n" .
                    "X-Mailer: PHP/" . phpversion();
                
                    $body = "<html><body>";
                    $body .= "<h3>Dear <span style='text-transform: uppercase';>".$row['Adm_Name']."</span></h3>".
                            "<h4>Superuser have reset your password.<h4>".
                            "<p>Your Email: </p>".$row['Adm_Email'].
                            "<p>Your New Password: </p>".$pass.
                            "<p>Regards,<br>Fiesta Corp.</p>";
                    $body .= "</body></html>";
                  if (mail($to_email, $subject, $body,$headers)) {
                    echo"
                    <!DOCTYPE html>
                    <html lang='en'>
                      <head>
                        <title>Fiesta Cor.</title>
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
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
                        body {
                            background-image: url('../images/logoutbg.jpg');
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
                        title: 'Success',
                        text: 'You Success Reset He/She Password!!!',
                        icon: 'success',
                        button: 'Continue',
                    }).then(function() {
                        location.replace('admin-view.php');
                    });
                    </script>
                    </body>
                    ";
                  }
                }
            else
            {
                //not found
                echo"
                <!DOCTYPE html>
                <html lang='en'>
                  <head>
                    <title>Fiesta Cor.</title>
                    <meta charset='utf-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
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
                    body {
                        background-image: url('../images/logoutbg.jpg');
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
                    title: 'Failed',
                    text: 'Failed to reset password!!!',
                    icon: 'warning',
                    button: 'Continue',
                }).then(function() {
                    location.replace('admin-view.php');
                });
                </script>
                </body>
                ";
            }
        }
    }
        else if(isset($_GET['sid']) && !empty($_GET['sid']))
        {
            //superuser reset
            $sid = $_GET['sid'];
            $length = 12; 
            $pass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%&*-+=_'),1,$length);
            $sql = "SELECT * from superuser where Super_ID = '$sid'";
            $result = mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_assoc($result);
                if(mysqli_query($connect,"UPDATE superuser SET Super_Password=PASSWORD('$pass') Where Super_ID='$sid'"))
                {
                  $to_email = $row['Super_Email'];
                  $subject = "No-Reply; Superuser Reset Your Password";
                  $from_email= "contact.us.fiesta@gmail.com";
                  $headers  = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type: text/html;" . "\r\n";
                  $headers .= "From: ".$from_email."\r\n".
                    "Reply-To: ".$from_email."\r\n" .
                    "X-Mailer: PHP/" . phpversion();
                
                    $body = "<html><body>";
                    $body .= "<h3>Dear <span style='text-transform: uppercase';>".$row['Super_Name']."</span></h3>".
                            "<h4>Superuser have reset your password.<h4>".
                            "<p>Your Email: </p>".$row['Super_Email'].
                            "<p>Your New Password: </p>".$pass.
                            "<p>Regards,<br>Fiesta Corp.</p>";
                    $body .= "</body></html>";
                  if (mail($to_email, $subject, $body,$headers)) {
                    echo"
                    <!DOCTYPE html>
                    <html lang='en'>
                      <head>
                        <title>Fiesta Cor.</title>
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
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
                        body {
                            background-image: url('../images/logoutbg.jpg');
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
                        title: 'Success',
                        text: 'You Success Reset He/She Password!!!',
                        icon: 'success',
                        button: 'Continue',
                    }).then(function() {
                        location.replace('admin-view.php');
                    });
                    </script>
                    </body>
                    ";
                  }
                }
            else
            {
                echo"
                <!DOCTYPE html>
                <html lang='en'>
                  <head>
                    <title>Fiesta Cor.</title>
                    <meta charset='utf-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
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
                    body {
                        background-image: url('../images/logoutbg.jpg');
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
                    title: 'Failed',
                    text: 'You Request is Failed!!!',
                    icon: 'warning',
                    button: 'Continue',
                }).then(function() {
                    location.replace('admin-view.php');
                });
                </script>
                </body>
                ";
            }
        }
    }
?>