<?php
include './ConnectDB.php';
if (isset($_POST['idnv'])){
    $idnv =$_POST['idnv'];
$conn = connectDB();
$sql = "delete from NhanVien where IDNV = $idnv ";
$result = sqlsrv_prepare($conn,$sql);
if(sqlsrv_execute($result)){
    header('Location: ../nhanvien.php');
}
else{
    echo '<h2>Khong xoa duoc nhan vien nay , day la khoa ngoai cua 1 bang khac</h2>';
}
}
else{
    echo '<h2>chua dien day du thong tin</h2>';
}
?>