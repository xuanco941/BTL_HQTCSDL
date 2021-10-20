<?php
include './ConnectDB.php';
if (isset($_POST['idmonan'])){
    $idmonan =$_POST['idmonan'];
$conn = connectDB();
$sql = "delete from MonAn where IDMonAn = $idmonan ";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../monan.php');
}
else{
    echo '<h2>Khong xoa duoc mon an nay , vi trong hoa don dang goi mon nay</h2>';
}
}
else{
    echo '<h2>chua dien day du thong tin</h2>';
}
?>