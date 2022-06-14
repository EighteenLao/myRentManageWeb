<!DOCTYPE html>
<html lang="en">
<head>
    <title>房客管理系統</title>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="js/loadingHeaderAndNav.js"></script>

    <style>
    .deleteMemberContainer, .displayInfo{
        display:flex;
        justify-content:center;
        align-items:center;
        font-size : 20px;
    }

    </style>
</head>
<body>
    <header></header>

    <nav></nav>
    
    <article>
        <div class = "deleteMemberContainer">
            <form name="form1" method="post">
                <br><h1>移除房客資訊</h1><br>
                <br>欲刪除房客之房號: <input name="memberRoomNum">
                <br><br><input type="submit" name='send' value="送出">
                <input type="submit" name="exit" value="返回">
            </form>
        </div>

        <div class="displayInfo">
            <?php
                // 連線到資料庫
                require_once('connect.php');

                if(array_key_exists('send', $_POST)){
                    if(isset($_POST['memberRoomNum'])){
                        $roomNum = $_POST["memberRoomNum"];

                        if ($roomNum == NULL){
                            echo '無輸入資料';
                        }
                        else{
                            //確認刪除目標
                            $sql = "SELECT * FROM member WHERE roomNum = \"".$roomNum."\";";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');
                            while($row = mysqli_fetch_array($result)){
                                echo "<br>刪除對象<br>";

                                echo "<table border=\1\">";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>房號</th>";
                                echo "<th>姓名</th>";
                                echo "<th>身分證字號</th>";
                                echo "<th>電話</th>";
                                echo "<th>入住時間</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>".$row['roomNum']."</td>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>".$row['phone']."</td>";
                                echo "<td>".$row['date']."</td>";
                                echo "</tr>";
                                echo "</tbody>";
                                echo "</table><br>";
                            }

                            //刪除
                            $sql = "DELETE FROM member WHERE roomNum = \"".$roomNum."\";";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');

                            if ($conn -> affected_rows >= 1) { // 判斷影響 1 列以上資料
                                echo '刪除成功';
                            } else {
                                echo '查無資料';
                            }
                        }
                    }
                }
                
                if(array_key_exists('exit', $_POST)) {
                    header("Location: index.php");
                }
            ?>
        </div>
    </article>
</body>
</html>