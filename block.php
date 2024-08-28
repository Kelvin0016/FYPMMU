<?php
$block_id = $_GET['id'];
if($block_id==0)
{
echo"
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
    title: 'Cannot Enter',
    text: 'You cannot enter this page before login!!!',
    icon: 'warning',
    button: 'Continue',
}).then(function() {
    location.replace('index.php');
});
</script>
</body>
";
}
else if($block_id==1)
{
    echo"
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
        title: 'You Already Login',
        text: 'You cannot enter this page after login!!!',
        icon: 'warning',
        button: 'Continue',
    }).then(function() {
        location.replace('index.php');
    });
    </script>
    </body>
    ";
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
        title: 'You Havent Done Booking',
        text: 'You cannot go to this page before booking an event!!!',
        icon: 'warning',
        button: 'Continue',
    }).then(function() {
        location.replace('index.php');
    });
    </script>
    </body>
    ";
}
?>