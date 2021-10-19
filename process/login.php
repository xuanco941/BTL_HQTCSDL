<?php
session_start();
include '../ConnectDB.php';

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(ConnectMSSQL('admin','xuan',$username,$password) == true){
    header('Location: ../home.php');
    $_SESSION['login'] = $username;
    }
    else
    die('Sai tai khoan hoac mat khau');
}
else header('Location: ../index.php');
?>