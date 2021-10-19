<?php
include './ConnectDB.php';
if (isset($_POST['idmon']) && isset($_POST['soluong']) && $_POST['soluong'] > 0){
    $idMon = $_POST['idmon'];
    $soLuong = $_POST['soluong'];
$conn = connectDB();
$sql = "exec dbo.orderMon $idMon , $soLuong";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../hoadon.php');
}
else{
    echo '<h2>Loi khong order duoc mon</h2>';
}
}
else{
    echo '<h2>chua nhap id mon an hoac so luong</h2>';
}
?>