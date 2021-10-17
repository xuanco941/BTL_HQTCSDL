<?php

function ConnectMSSQL($username , $password){
    $serverName = "DESKTOP-MFQ2E3N\SQLEXPRESS"; 
    $connectionInfo = ["Database"=>"QuanLyNhaHang","UID"=>"$username","PWD"=>"$password"];
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if($conn)
    header('Location: Restaurent.php');
    else
    die('Connect Database failure !!');
};

ConnectMSSQL('xuan','123');

?>