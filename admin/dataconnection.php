<?php


$connect = mysqli_connect("localhost","root","","fiesta_db");

if($connect)
{
  ?>
  <script>
    console.log("DB connected");
  </script>
  <?php
}

?>