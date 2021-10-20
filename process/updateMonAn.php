<?php
include './ConnectDB.php';
if (isset($_POST['idmonan'])){
    $idmonan =$_POST['idmonan'];
    $tenmonan = $_POST['tenmonan'];
    $sodu = $_POST['sodu'];
    $chiphi = $_POST['chiphi'];
    $giaban = $_POST['giaban'];
    $giamgia = $_POST['giamgia'];
$conn = connectDB();
$sql = "update MonAn set TenMonAn = $tenmonan , SoDu = $sodu , ChiPhiSanXuat = $chiphi , GiaBan = $giaban , GiamGia = $giamgia where IDMonAn = $idmonan ";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../monan.php');
}
else{
    echo '<h2>Loi cap nhat duoc mon an</h2>';
}
}
else{
    echo '<h2>chua dien day du thong tin</h2>';
}

?>