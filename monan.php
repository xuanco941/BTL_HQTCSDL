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
    <link rel="stylesheet" href="./css/monan.css">
    <link rel="stylesheet" href="./css/modal.css">
    <title>Mon An</title>
</head>

<body>
    <?php
    include './partials/header.php';
    include './process/checkNV.php';
    ?>
    <div class="container">
        <table class="table">
            <tr>
                <th>ID Món Ăn</th>
                <th>Tên Món Ăn</th>
                <th>Số dư</th>
                <th>Chi phí sản xuất</th>
                <th>Giá bán</th>
                <th>Giảm giá</th>
            </tr>
            <?php
            $conn = connectDB();
            $sql = "select * from MonAn";
            $params = array();
            $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
            $result = sqlsrv_query($conn, $sql, $params, $options);
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<tr>
                    <td>' . $row['IDMonAn'] . '</td>
                    <td>' . $row['TenMonAn'] . '</td>
                    <td>' . $row['SoDu'] . '</td>
                    <td>' . $row['ChiPhiSanXuat'] . '</td>
                    <td>' . $row['GiaBan'] . '</td>
                    <td>' . $row['GiamGia'] . '%</td>

                </tr>';
            }
            sqlsrv_close($conn);
            ?>
        </table>
    </div>
    <div class="control">
        <button class="btn-click btn-insert" id="insert">Thêm món ăn</button>

        <button class="btn-click btn-update" id="update">Sửa món ăn</button>

        <button class="btn-click btn-delete" id="delete">Xóa món ăn</button>
    </div>
    <form class="formOrder" action="./process/orderMon.php" method="POST">
        ID Món
        <input type="text" name="idmon" require="true">
        Số lượng
        <input type="number" name="soluong" value="0" require="true">
        <button type="submit" class="btn-click btn-insert">Xác nhận</button>
    </form>

    <div class="modal" id="modal">
        <form class="form-post" id="form" action="./process/themMonAn.php" method="post">
            <input type="text" placeholder="Ten mon an" name="tenmonan">
            <input type="number" placeholder="So du" name="sodu">
            <input type="number" placeholder="Chi phi san xuat" name="chiphi">
            <input type="number" placeholder="Gia ban" name="giaban">
            <input type="number" placeholder="Giam gia %" name="giamgia">

            <button type="submit" class="btn-click btn-insert">Them mon an</button>
        </form>
    </div>
    <div class="modal" id="modal2">
        <form class="form-post" id="form2" action="./process/updateMonAn.php" method="post">
            <input type="number" placeholder="Id mon an" name="idmonan">
            <input type="text" placeholder="Ten mon an" name="tenmonan">
            <input type="number" placeholder="So du" name="sodu">
            <input type="number" placeholder="Chi phi san xuat" name="chiphi">
            <input type="number" placeholder="Gia ban" name="giaban">
            <input type="number" placeholder="Giam gia %" name="giamgia">

            <button type="submit" class="btn-click btn-update">Sua mon an</button>
        </form>
    </div>
    <div class="modal" id="modal3">
        <form class="form-post" id="form3" action="./process/deleteMonAn.php" method="post">

            <input type="number" placeholder="Id mon an muon xoa" name="idmonan">

            <button type="submit" class="btn-click btn-delete">Xoa mon an</button>
        </form>
    </div>

    <?php
    include './partials/footer.php';
    ?>
    <script src="./index.js"></script>
</body>

</html>