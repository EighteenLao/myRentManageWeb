<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>房客管理系統</title>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/nav.css">

    <style>
      .addMemberContainer, .displayNewMember{
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
        <div class = "addMemberContainer">
            <form name="form1" method="post">
                <br><h1>新增房客資訊</h1><br>
                <br>房號 : <input name = "memberRoomNum">
                <br>姓名 : <input name = "memberName">
                <br>身分證 : <input name = "memberId">
                <br>電話 : <input name = "memberPhone">
                <br>入住日期(格式:XXXX-XX-XX) : <input name = "memberDate">
                <br><br><input type="submit" name="send" value="送出">
                <input type="submit" name="exit" value="返回">
            </form>
        </div>

        <div class="displayNewMember">
            <?php
                // 連線到資料庫
                require_once('connectMemberDate.php');

                if(array_key_exists('send', $_POST)){
                    if(isset($_POST['memberId'])){
                        $roomNum = $_POST["memberRoomNum"];
                        $name=$_POST["memberName"];
                        $id=$_POST["memberId"];
                        $phone=$_POST["memberPhone"];
                        $date=$_POST["memberDate"];

                        if ($roomNum == NULL && $name == NULL){
                            echo '建立失敗';
                        }
                        else{
                            //新增
                            $sql = "INSERT INTO `member` (`roomNum`, `id`, `name`, `phone`, `date`) VALUES (\"".$roomNum."\",\"".$id."\",\"".$name."\",\"".$phone."\",\"".$date."\");";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');

                            //確認建立成功
                            $sql = "SELECT * FROM member WHERE roomNum = \"".$roomNum."\";";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');
                            while($row = mysqli_fetch_array($result)){
                                echo "<br>創建成功<br>";

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

<script>
  $(document).ready(function(){
    $("header").load("header.html");
    $("nav").load("nav.html");
  });
</script>

</html>