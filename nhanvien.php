<?php
session_start(); //Dịch vụ bảo vệ
if (!isset($_SESSION['login'])) {
    header("Location:./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/modal.css">

    <title>Nhân viên</title>
</head>

<body>
    <?php
    include './partials/header.php';
    ?>
    <div class="container">
        <table class="table">
            <tr>
                <th>ID nhân viên</th>
                <th>Tên Nhân viên</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Lương</th>
                <th>ID Công việc</th>
            </tr>
            <?php
            include './process/ConnectDB.php';
            $conn = connectDB();
            $sql = "select * from NhanVien";
            $params = array();
            $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
            $result = sqlsrv_query($conn, $sql, $params, $options);
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<tr>
                    <td>' . $row['IDNV'] . '</td>
                    <td>' . $row['TenNV'] . '</td>
                    <td>' . $row['SDT'] . '</td>
                    <td>' . $row['DiaChi'] . '</td>
                    <td>' . $row['Luong'] . '</td>
                    <td>' . $row['IDCongViec'] . '</td>
                </tr>';
            }
            sqlsrv_close($conn);
            ?>
        </table>
    </div>
    <div class="control">
        <button class="btn-click btn-insert" id="insert">Thêm nhân viên</button>

        <!-- <button class="btn-click btn-delete" id="delete">Xóa nhân viên</button> -->
    </div>

    <div class="modal" id="modal">
        <form class="form-post" id="form" action="./process/themNhanVien.php" method="post">
            <input type="text" placeholder="Ten nhan vien" name="tennhanvien">
            <input type="number" placeholder="id cong viec" name="idcongviec">
            <input type="number" placeholder="So dien thoai" name="sdt">
            <input type="text" placeholder="Dia chi" name="diachi">

            <button type="submit" class="btn-click btn-insert">Them nhan vien</button>
        </form>
    </div>



    <div class="modal" id="modal3">
        <form class="form-post" id="form3" action="./process/xoaNhanVien.php" method="post">

            <input type="number" placeholder="Id nhan vien muon xoa" name="idnv">

            <button type="submit" class="btn-click btn-delete">Xoa mon an</button>
        </form>
    </div>

    <?php
    include './partials/footer.php';
    ?>
    <script src="./index.js"></script>

</body>

</html>