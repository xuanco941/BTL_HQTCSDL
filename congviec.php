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
        <table>
            <tr>
                <th>Person 1</th>
                <th>Person 2</th>
                <th>Person 3</th>
            </tr>
            <tr>
                <td>Emil</td>
                <td>Tobias</td>
                <td>Linus</td>
            </tr>
            <tr>
                <td>16</td>
                <td>14</td>
                <td>10</td>
            </tr>
        </table>
    </div>

    <?php
    include './partials/footer.php';
    ?>
</body>

</html>