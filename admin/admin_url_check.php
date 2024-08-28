<?php
 //set protocol
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
//get server name
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'];
//get typed in link
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$login = $CurPageURL."/fiesta/admin/login.php";
$base = $CurPageURL."/fiesta/admin/";
$reset_p = $CurPageURL."/fiesta/admin/reset-pass.php";
$forget_p = $CurPageURL."/fiesta/admin/forgot-pass.php";
//strpos is to find the first occurence of a string inside a string
if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
{
    if($actual_link==$login||$actual_link==$base|| $actual_link==$forget_p || strpos($actual_link,$reset_p)!==FALSE)
    {
        ?>
        <script>
            location.replace("admin_block.php?id=1");
        </script>
        <?php
    }
}
else if(isset($_SESSION['super_id']) && !empty($_SESSION['super_id']))
{
    if($actual_link==$login||$actual_link==$base|| $actual_link==$forget_p || strpos($actual_link,$reset_p)!==FALSE)
    {
        ?>
        <script>
            location.replace("admin_block.php?id=1");
        </script>
        <?php
    }
}
else
{
    if($actual_link!=$login&&$actual_link!=$base&& $actual_link!=$forget_p && strpos($actual_link,$reset_p)!==0)
    {
        ?>
        <script>
            location.replace("admin_block.php?id=0");
        </script>
        <?php
    }
}
?>