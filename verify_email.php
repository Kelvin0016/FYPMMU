<?php session_start();?>
<?php include "url_check.php" ?>
<?php
include "dataconnection.php";
if (!isset($_GET['email'])) {
    $cust_email = "1";
} else {
    $cust_email = $_GET["email"];
}
$sql = "SELECT * from customer WHERE Cust_Email='$cust_email' and Cust_isDelete = 0";
$result=mysqli_query($connect,$sql);
$row=mysqli_num_rows($result);
if($row>0)
{
    $sql = "SELECT * from customer WHERE Cust_Email='$cust_email' and Cust_isDelete = 0 and Cust_isVerify = 0";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_num_rows($result);
    if($row>0)
    {
            $sql = "UPDATE customer SET Cust_isVerify = 1 WHERE Cust_Email='$cust_email' and Cust_isDelete = 0";
            mysqli_query($connect,$sql);
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
                title: 'Verify Successfully',
                text: 'You Have Verify Your Email Successfully!!!',
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
                title: 'Verify Before',
                text: 'You Have Verify Your Email Before.',
                icon: 'info',
                button: 'Home',
            }).then(function() {
                location.replace('index.php');
            });
            </script>
            </body>
            
            ";
        }
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
                title: 'Verify Unsuccessfull',
                text: 'Verifying Process Unsuccessfully!!!',
                icon: 'warning',
                button: 'Home',
            }).then(function() {
                location.replace('index.php');
            });
            </script>
            </body>
            
            ";
        }

        ?>