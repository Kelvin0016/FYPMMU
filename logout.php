<?php
session_start();
include "url_check.php" ;
session_unset();
session_destroy();
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
    title: 'Log Out',
    text: 'Log Out Successfully!!!',
    icon: 'success',
    button: 'Continue',
}).then(function() {
    location.replace('index.php');
});
</script>
</body>

";
?>
