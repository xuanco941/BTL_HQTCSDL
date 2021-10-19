<?php
include './ConnectDB.php';
function orderMon ($idMon , $soLuong){
$conn = connectDB();
$sql = "exec dbo.orderMon $idMon , $soLuong";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    return true;
}
else{
    return false;
}
}
?>