<?php
include './ConnectDB.php';
if (isset($_POST['idcongviec']) && isset($_POST['tennhanvien']) && isset($_POST['sdt']) && isset($_POST['diachi'])){

    $idcongviec = $_POST['idcongviec'];
    $tennhanvien = $_POST['tennhanvien'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
$conn = connectDB();
$sql = "exec dbo.themNhanVien $idcongviec , $tennhanvien , $sdt , $diachi";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../nhanvien.php');
}
else{
    echo '<h2>Loi khong them duoc nhan vien</h2>';
}
}
else{
    echo '<h2>chua dien day du thong tin</h2>';
}
?>