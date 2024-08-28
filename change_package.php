<?php session_start();?>
<?php include "dataconnection.php";?>
<?php include "url_check.php" ?>
<?php
    $cust_id = $_SESSION["cust_id"];
    $pack_id = $_GET['id'];
    $sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
    $result = mysqli_query($connect, $sql);
    $row =mysqli_fetch_assoc($result);
    $book_pack_id = $row['Book_Pack_ID'];
    $ori_book_pack_name = explode("_",$row['Book_Pack_Name']);
    $ori_pack_id = $row['Pack_ID'];
    $new_sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_ID = '$pack_id'";
    $new_result = mysqli_query($connect, $new_sql);
    $new_row =mysqli_fetch_assoc($new_result);
    $new_pack_price =$new_row['Pack_Price'];
    $new_book_pack_name =$new_row['Pack_Name']."_".$ori_book_pack_name[1]."_".$ori_book_pack_name[2];
    $sql = "UPDATE book_package SET Book_Pack_Price = '$new_pack_price', Pack_ID = '$pack_id', Book_Pack_Name = '$new_book_pack_name' WHERE Book_Pack_ID='$book_pack_id'";
    mysqli_query($connect, $sql);
    $item_sql = "SELECT * FROM equip_package ,item WHERE Equip_P_Item_ID=Item_ID AND Equip_P_Pack_ID = '$ori_pack_id' AND Equip_P_isDelete!=1";
    $item_result = mysqli_query($connect, $item_sql);
    while($row =mysqli_fetch_assoc($item_result))
    {	
        $item_id = $row['Item_ID'];
        $sql = "DELETE FROM equip_book_package WHERE Equip_B_Pack_ID='$book_pack_id' and Equip_B_Item_ID='$item_id'";
        $result = mysqli_query($connect, $sql);
    }
    $item_sql = "SELECT * FROM equip_package ,item WHERE Equip_P_Item_ID=Item_ID AND Equip_P_Pack_ID = '$pack_id' AND Equip_P_isDelete!=1";
    $item_result = mysqli_query($connect, $item_sql);
    while($row =mysqli_fetch_assoc($item_result))
    {	
        $item_id = $row['Item_ID'];
        $item_qty = $row['Equip_P_Qty'];
        $sql = "INSERT INTO equip_book_package(Equip_B_Pack_ID, Equip_B_Item_ID, Equip_B_Qty) VALUES ('$book_pack_id', '$item_id', '$item_qty');";
        $result = mysqli_query($connect, $sql);
    }
    header("Location: book.php?id=$book_pack_id");
?>