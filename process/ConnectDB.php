<?php

function connectDB(){
  $serverName = "DESKTOP-MFQ2E3N\SQLEXPRESS"; 
  $connectionInfo = ["Database"=>"QuanLyNhaHang","UID"=>"admin","PWD"=>"xuan"];
  $conn = sqlsrv_connect( $serverName,$connectionInfo);
  return $conn;
}
?>