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
   include './process/checkNV.php';
   ?>
      <div class="container">
        <table class="table">
            <tr>
                <th>ID hóa đơn</th>
                <th>Tên món ăn</th>
                <th>Số lượng</th>
                <th>Số tiền khách phải trả</th>
                <th>Ngày</th>
            </tr>
            <?php
                $conn = connectDB();
                $sql = "select * from HoaDon";
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $result = sqlsrv_query( $conn, $sql , $params , $options );
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                    $date = $row['Ngay']->format('d-m-Y');
                    echo '<tr>
                    <td>'.$row['IDHoaDon'].'</td>
                    <td>'.$row['TenMonAn'].'</td>
                    <td>'.$row['SoLuong'].'</td>
                    <td>'.$row['SoTienPhaiTra'].'</td>
                    <td>'.$date.'</td>
                </tr>';
                }
                sqlsrv_close($conn);
            ?>
        </table>
    </div>
     <div class="control">
         
             <button class="btn-click btn-update">Xuất hóa đơn</button>
         
     </div>           


    <?php
    include './partials/footer.php';
    ?>
        <script src="./index.js"></script>

</body>

</html>