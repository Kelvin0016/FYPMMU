<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'];
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$base = $CurPageURL."/fiesta"."/";
$index = $CurPageURL."/fiesta/index.php";
$about = $CurPageURL."/fiesta/about.php";
$contact = $CurPageURL."/fiesta/contact.php";
$venue = $CurPageURL."/fiesta/venue.php";
$package = $CurPageURL."/fiesta/package.php";
$package_detail = $CurPageURL."/fiesta/package_detail.php";
$item = $CurPageURL."/fiesta/item.php";
$login = $CurPageURL."/fiesta/login_cust.php";
$register = $CurPageURL."/fiesta/register_cust.php";
$reset_p = $CurPageURL."/fiesta/reset_pass.php";
$forget_p = $CurPageURL."/fiesta/forgot_pass.php";
$verify = $CurPageURL."/fiesta/verify_email.php";
$checkout = $CurPageURL."/fiesta/checkout.php";
$logout = $CurPageURL."/fiesta/logout.php";
if(isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id']))
{
    if($actual_link==$register || $actual_link==$login || $actual_link==$forget_p || strpos($actual_link,$reset_p)!==FALSE)
    {
        ?>
        <script>
            location.replace("block.php?id=1");
        </script>
        <?php
    }
    if($actual_link!=$logout)
    {
        $cust_id=$_SESSION['cust_id'];
        $sql="SELECT * FROM book where Book_Cust_ID='$cust_id' and Book_isCheck = 0";
        $result = mysqli_query($connect,$sql);
        if(mysqli_num_rows($result)==0)
        {
            if(strpos($actual_link,$checkout)!==FALSE)
            {
            ?>
                <script>
                    location.replace("block.php?id=2");
                </script>
            <?php
            }
        }
    }
}
else
{
    if($actual_link!=$base && $actual_link!=$index && $actual_link!=$about && $actual_link!=$contact && strpos($actual_link,$venue)!==0 && strpos($actual_link,$package)!==0 && strpos($actual_link,$package_detail)!==0 && strpos($actual_link,$item)!==0 && $actual_link!=$login && $actual_link!=$register && $actual_link!=$forget_p && strpos($actual_link,$reset_p)!==0 && strpos($actual_link,$verify)!==0)
    {

        ?>
        <script>
            location.replace("block.php?id=0");
        </script>
        <?php
    }
}
?>