<?php
session_start();
include '../ConnectDB.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
}
else header('Location: ../index.php');
?>