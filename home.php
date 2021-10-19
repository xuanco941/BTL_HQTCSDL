<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['login'])){
        header("Location:./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/orderMon.css">
    <title>Order món Ăn</title>
</head>

<body>
   <?php
   include './partials/header.php';
   include './process/checkNV.php';
   ?>
    <form class="formOrder" action="./process/orderMon.php" method="POST">
        <input type="text" name="idmon" require="true">
        <input type="number" name="soluong" value="0" require="true">
        <button type="submit" class="btn-click btn-insert">Xác nhận</button>
    </form>
    

    <?php
    include './partials/footer.php';
    ?>
</body>

</html>