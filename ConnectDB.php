<?php

function ConnectMSSQL($username , $password , $taikhoan , $matkhau){
    $serverName = "DESKTOP-MFQ2E3N\SQLEXPRESS"; 
    $connectionInfo = ["Database"=>"QuanLyNhaHang","UID"=>"$username","PWD"=>"$password"];
    $conn = sqlsrv_connect( $serverName,$connectionInfo);

    if($conn){
        $sql = "select * from TaiKhoan where tentaikhoan = $taikhoan and matkhau = $matkhau";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $result = sqlsrv_query( $conn, $sql , $params, $options );

        $row_count = sqlsrv_num_rows( $result );
   
        if ($row_count < 1)
          return false;
        else
          return true;
        sqlsrv_close($conn);
      }
    else die('Loi ket noi toi may chu');
};

function connectDB(){
  $serverName = "DESKTOP-MFQ2E3N\SQLEXPRESS"; 
  $connectionInfo = ["Database"=>"QuanLyNhaHang","UID"=>"admin","PWD"=>"xuan"];
  $conn = sqlsrv_connect( $serverName,$connectionInfo);

  return $conn;
}
?>