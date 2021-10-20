<?php
session_start();
include './ConnectDB.php';

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conn = connectDB();
        if(!$conn){
            die('khong the ket noi toi db');
        }
        $sql = "select * from TaiKhoan where tentaikhoan = $username and matkhau = $password";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $result = sqlsrv_query( $conn, $sql , $params , $options );
        
        if (sqlsrv_has_rows($result) === false ){
            die('Sai tai khoan hoac mat khau');
        }
        else{
            $_SESSION['login'] = $username;
            header('Location: ../monan.php');
        }
        sqlsrv_close($conn);
    }
    else header('Location: ../index.php');


?>

