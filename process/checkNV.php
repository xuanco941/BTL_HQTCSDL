<?php
include './process/ConnectDB.php';
        if(isset($_SESSION['login'])){
            $login = $_SESSION['login'];
            $conn = connectDB();
            if($conn){
                $sql = "select SDT from NHANVIEN where IDCongViec != 1";
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $result = sqlsrv_query( $conn, $sql , $params , $options );
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                    if($row['SDT']==$login)
                    {
                        echo "<script>const tagA = Array.from(document.querySelectorAll('.itemHead2'));
                        tagA.forEach((e) => {
                        e.classList.add('disabled');
                        e.style.display = 'none';
                        })</script>";
                    }
                }
            }
            else{
                die('loi ket noi');
            }
            sqlsrv_close($conn);
        }
        else {
            header('Location: ./index.php');
        }      
?>