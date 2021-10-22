<?php
include './ConnectDB.php';
if (isset($_POST['tiencong']) && isset($_POST['tencongviec'])){

    $tencongviec = $_POST['tencongviec'];
    $tiencong = $_POST['tiencong'];
$conn = connectDB();
$sql = "exec dbo.themCongViec '$tencongviec' , $tiencong ";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../congviec.php');
}
else{
    echo '<h2>Loi khong them duoc cong viec</h2>';
}
}
else{
    echo '<h2>chua dien day du thong tin</h2>';
}
?>