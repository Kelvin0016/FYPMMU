<?php session_start();?>
<?php include "dataconnection.php";?>
<?php include "url_check.php";?>
<?php
    $cust_id = $_SESSION["cust_id"];
    $pack_id = $_GET['id'];
	$sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
    $row =mysqli_fetch_assoc($result);
    $count_row =mysqli_num_rows($result);
    $sql = "SELECT * from book_package WHERE Book_Pack_Cust_ID = '$cust_id'";
	$result = mysqli_query($connect, $sql);
    $row =mysqli_fetch_assoc($result);
    $count_in_row =mysqli_num_rows($result)+1;
    if($count_row==0)
    {
            $sql = "SELECT * from package WHERE Pack_isDelete!=1 and Pack_ID = '$pack_id'";
            $result = mysqli_query($connect, $sql);
            $row =mysqli_fetch_assoc($result);
            $book_pack_name = $row['Pack_Name']."_".$cust_id."_".$count_in_row;
            $book_pack_price = $row['Pack_Price'];
            $sql = "INSERT INTO book_package(Book_Pack_Name, Book_Pack_Price, Pack_ID, Book_Pack_Cust_ID) VALUES ('$book_pack_name', '$book_pack_price', '$pack_id', '$cust_id');";
            mysqli_query($connect, $sql);
            $sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
            $result = mysqli_query($connect, $sql);
            $row =mysqli_fetch_assoc($result);
            $book_pack_id = $row['Book_Pack_ID'];
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
    }
    else
    {
        $sql = "SELECT * from book_package WHERE Book_Pack_isDelete!=1 and Book_Pack_isCheck!=1 and Book_Pack_Cust_ID = '$cust_id'";
        $result = mysqli_query($connect, $sql);
        $row =mysqli_fetch_assoc($result);
        if($row['Pack_ID']==$pack_id)
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
                title: 'Same Package Added',
                text: 'You Have Added Same Package',
                icon: 'warning',
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
                title: 'Change Package',
                text: 'Do You Want To Change The Package?',
                icon: 'info',
                buttons: {
                    cancel: 'No',
                    Yes: true,
                },
            }).then((value) => {
                switch (value) {
                case 'Yes':
                location.replace('change_package.php?id=".$_GET['id']."');
                break;
                default:
                location.replace('index.php');
                
            }
            });
            </script>
            </body>
            
            ";
        }

    }
?>	