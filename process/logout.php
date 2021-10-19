<?php
session_start(); //Dịch vụ bảo vệ
if(isset($_SESSION['login'])){
    unset($_SESSION['login']);
    header("Location:../index.php");
}
?>