<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurent</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    </head>

    <body>
        <div class="head">
            <h1>Đăng nhập thành viên nhà hàng</h2>
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Tôi là thành viên</button>
        </div>

        <div id="id01" class="modal">

            <form class="modal-content animate" action="process/login.php" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                        title="Close Modal">&times;</span>
                    <img src="./img/img_avatar2.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <label for="uname"><b>Tài khoản</b></label>
                    <input type="text" placeholder="Tài khoản" name="username" required>

                    <label for="psw"><b>Mật khẩu</b></label>
                    <input type="password" placeholder="Mật khẩu" name="password" required>

                    <button type="submit">Đăng nhập</button>
                    <label>
                        <input type="checkbox" checked="checked" >Ghi nhớ
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'"
                        class="cancelbtn">Đóng</button>
                </div>
            </form>
        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>

    </body>

</html>