<?php

function ConnectMSSQL($username , $password){
    $serverName = "DESKTOP-MFQ2E3N\SQLEXPRESS"; 
    $connectionInfo = ["Database"=>"QuanLyNhaHang","UID"=>"$username","PWD"=>"$password"];
    $AdminInfo = ["Database"=>"QuanLyNhaHang","UID"=>"admin","PWD"=>"xuan"];
    $connAdmin = sqlsrv_connect( $serverName,$AdminInfo);

    if($connAdmin){
        
    }



    else
    die('Location: ./index.php');
};

?>