<?php
include './ConnectDB.php';
if (isset($_POST['tenmonan']) && isset($_POST['chiphi']) && isset($_POST['sodu']) && isset($_POST['giaban']) && isset($_POST['giamgia'])){

    $tenmonan = $_POST['tenmonan'];
    $sodu = (int)$_POST['sodu'];
    $chiphi = (double)$_POST['chiphi'];
    $giaban =  (double)$_POST['giaban'];
    $giamgia =  (double)$_POST['giamgia'];
$conn = connectDB();
$sql = "exec dbo.themMonAn '$tenmonan' , $sodu , $chiphi , $giaban , $giamgia";
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