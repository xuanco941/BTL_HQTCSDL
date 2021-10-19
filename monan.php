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
    <link rel="stylesheet" href="./css/monan.css">
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
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $result = sqlsrv_query( $conn, $sql , $params , $options );
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                    echo '<tr>
                    <td>'.$row['IDMonAn'].'</td>
                    <td>'.$row['TenMonAn'].'</td>
                    <td>'.$row['SoDu'].'</td>
                    <td>'.$row['ChiPhiSanXuat'].'</td>
                    <td>'.$row['GiaBan'].'</td>
                    <td>'.$row['GiamGia'].'%</td>

                </tr>';
                }
                sqlsrv_close($conn);
            ?>
        </table>
    </div>
     <div class="control">
             <button class="btn-click btn-insert">Thêm món ăn</button>
         
             <button class="btn-click btn-update">Sửa món ăn</button>
         
             <button class="btn-click btn-delete">Xóa món ăn</button>
     </div>           


    <?php
    include './partials/footer.php';
    ?>
</body>

</html>