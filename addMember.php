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
    <script src="js/loadingHeaderAndNav.js"></script>

    <style>
      .addMemberContainer, .displayNewMember{
        display:flex;
        justify-content:center;
        align-items:center;
        font-size : 20px;
        margin:2%;
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
                <br>房號 : <select name="memberRoomNum">
                                <option value="">--請選擇--</option>
                                <option value="3B">3B</option>
                                <option value="3C">3C</option>
                                <option value="4A">4A</option>
                                <option value="4B">4B</option>
                                <option value="4C">4C</option>
                                <option value="4D">4D</option>
                                <option value="5A">5A</option>
                                <option value="5B">5B</option>
                          </select>
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
                require_once('connect.php');

                if(array_key_exists('send', $_POST)){
                    if(isset($_POST['memberId'])){
                        $roomNum = $_POST["memberRoomNum"];
                        $name=$_POST["memberName"];
                        $id=$_POST["memberId"];
                        $phone=$_POST["memberPhone"];
                        $date=$_POST["memberDate"];

                       
                        if ($roomNum == NULL){
                            echo "<script>alert('無輸入房號')</script>";
                        }
                        else{
                            //確認是否已有資料
                            $sql = "SELECT `name` FROM member WHERE roomNum = \"".$roomNum."\";";
                            $result = mysqli_query($conn, $sql) or die('MySQL query error');
                            $row = mysqli_fetch_array($result);
                            
                            if ($row['name'] != NULL){
                                echo "<script>alert('已有房客資料')</script>";
                            }
                            else{
                                //新增
                                //$sql = "INSERT INTO `member` (`roomNum`, `id`, `name`, `phone`, `date`) VALUES (\"".$roomNum."\",\"".$id."\",\"".$name."\",\"".$phone."\",\"".$date."\");";
                                $sql = "UPDATE `member` SET `id` =\"".$id."\", `name` =\"".$name."\", `phone` =\"".$phone."\", `date` =\"".$date."\" WHERE roomNum = \"".$roomNum."\"";
                                $result = mysqli_query($conn, $sql) or die('MySQL query error');

                                //確認建立成功
                                $sql = "SELECT * FROM member WHERE roomNum = \"".$roomNum."\";";
                                $result = mysqli_query($conn, $sql) or die('MySQL query error');
                                $row = $result->fetch_assoc();  //從結果集中取得一行作為key數組。
                                echo "<script>alert('建立成功')</script>";

                                echo "<table border=\1\"> <thead> <tr>";
                                echo "<th>房號</th>";
                                echo "<th>姓名</th>";
                                echo "<th>身分證字號</th>";
                                echo "<th>電話</th>";
                                echo "<th>入住時間</th>";
                                echo "</tr> </thead>";

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