<?php
include './ConnectDB.php';
if (isset($_POST['tenmonan']) && isset($_POST['chiphi']) && isset($_POST['sodu']) && isset($_POST['giaban']) && isset($_POST['giamgia'])){

    $tenmonan = $_POST['tenmonan'];
    $sodu = $_POST['sodu'];
    $chiphi = $_POST['chiphi'];
    $giaban = $_POST['giaban'];
    $giamgia = $_POST['giamgia'];
$conn = connectDB();
$sql = "exec dbo.themMonAn $tenmonan , $sodu , $chiphi , $giaban , $giamgia";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../monan.php');
}
else{
    echo '<h2>Loi khong them duoc mon an</h2>';
}
}
else{
    echo '<h2>chua dien day du thong tin</h2>';
}
?>