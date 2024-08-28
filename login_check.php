<?php
if(isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id']))
{
    ?>
    <script>
    document.getElementById("profile").style.display="list-item";
    document.getElementById("sign_in").style.display="none";
    function book_check()
    {
        return true;
    }
    function check()
    {
        return true;
    }
    </script>
    <?php
}
else
{
    ?>
    <script>
    document.getElementById("profile").style.display="none";
    document.getElementById("sign_in").style.display="list-item";
    function book_check()
    {
        swal({
			title: "Warning",
			text: "Please Login First!!!",
			icon: "warning",
			button: "Continue to Login",
		}).then(function() {
    		location.href = "login_cust.php";
    });
    }
    function check()
    {
        return false;
    }
    </script>
    <?php
}
?>
