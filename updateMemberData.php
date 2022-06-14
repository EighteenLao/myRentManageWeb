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
    .updateMemberContainer, .displayInfo{
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
        <div class = "updateMemberContainer">
            <form name="form1" method="post">
                <br><h1>修改房客資訊</h1><br>
                <br>輸入房號 : <input name = "roomNum">

                <br>欲修改項目:
                <input type="radio" name="editItem" value="name" />
                <label for="html">姓名</label>
                <input type="radio" name="editItem" value="id" />
                <label for="html">身分證字號</label>
                <input type="radio" name="editItem" value="phone" />
                <label for="html">電話</label>
                <input type="radio" name="editItem" value="date" />
                <label for="html">入住日期</label>
                <br><br>輸入修改內容 : <input name = "updateText">
                <br><br><input type="submit" name="sendTextBtn" value="送出">
                <input type="submit" name="exit" value="返回">
            </form>
        </div>

        <div class="displayInfo">
            <?php
                // 連線到資料庫\
                require_once('connect.php');
                
                if(isset($_POST['roomNum'])){
                    $roomNum=$_POST["roomNum"];
                    
                    if(array_key_exists('sendTextBtn', $_POST)) {
                        if($roomNum == NULL){
                            echo '無輸入資料';
                        }
                        else{
                            $sql = "SELECT * FROM member WHERE roomNum = \"".$roomNum."\";";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');
                            while($row = mysqli_fetch_array($result)){
                                echo '修改對象' . " <br>";
                                echo $row['roomNum'] . " ";
                                echo $row['name'] . " ";
                                echo $row['id'] . " ";
                                echo $row['phone'] . " ";
                                echo $row['date'] . " <br>";
                            }

                            $editItem = $_POST['editItem'];
                            $editText=$_POST["updateText"];
                            
                            $sql1 = "UPDATE `member` SET $editItem =\"".$editText."\" WHERE roomNum = \"".$roomNum."\"";
                            $result1 = mysqli_query($conn, $sql1) or die('MySQL query error');

                            //確認建立成功
                            $sql = "SELECT * FROM member WHERE roomNum = \"".$roomNum."\";";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');
                            while($row = mysqli_fetch_array($result)){
                                echo "<br>修改成功<br>";

                                echo "<br<table border=\1\">";
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