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
    <title>Home</title>
</head>

<body>
    <?php
   include './partials/header.php';
   ?>
 <div class="container">
        <table class="table">
            <tr>
                <th>ID Công việc</th>
                <th>Tên công việc</th>
                <th>Tiền công theo ngày</th>
            </tr>
            <?php
                include './process/ConnectDB.php';
                $conn = connectDB();
                $sql = "select * from CongViec";
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $result = sqlsrv_query( $conn, $sql , $params , $options );
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                    echo '<tr>
                    <td>'.$row['IDCongViec'].'</td>
                    <td>'.$row['TenCongViec'].'</td>
                    <td>'.$row['TienCongTheoNgay'].'</td>
                </tr>';
                }
                sqlsrv_close($conn);
            ?>
        </table>
    </div>
     <div class="control">
         
             <button class="btn-click btn-insert">Thêm công việc</button>
         
     </div>           

    <?php
    include './partials/footer.php';
    ?>
</body>

</html>