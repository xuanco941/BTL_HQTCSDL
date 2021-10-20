<?php
    session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['login'])){
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
    <title>Home</title>
</head>

<body>
   <?php
   include './partials/header.php';
   ?>
    <div class="container">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Chi phí bỏ ra</th>
                <th>Số tiền thu được</th>
                <th>Số tiền lãi</th>
                <th>ID hóa đơn thanh toán cuối cùng</th>
                <th>Ngày</th>
            </tr>
            <?php
            include './process/ConnectDB.php';
                $conn = connectDB();
                $sql = "select * from LichSuBan";
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $result = sqlsrv_query( $conn, $sql , $params , $options );
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                    $date = $row['Ngay']->format('d-m-Y');
                    echo '<tr>
                    <td>'.$row['IDLichSuBan'].'</td>
                    <td>'.$row['ChiPhiBoRa'].'</td>
                    <td>'.$row['SoTienThuDuoc'].'</td>
                    <td>'.$row['SoTienLai'].'</td>
                    <td>'.$row['IDHoaDonCuoi'].'</td>
                    <td>'.$date.'</td>
                </tr>';
                }
                sqlsrv_close($conn);
            ?>
        </table>
    </div>

    <?php
    include './partials/footer.php';
    ?>
</body>

</html>