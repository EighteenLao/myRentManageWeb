<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
                <br>房號:<select name="memberRoomNum">
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
                session_start();
                if(isset($_SESSION['is_Login'])&& $_SESSION['is_Login'] == "true"){
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
                                $sql = "SELECT `roomNum` FROM member WHERE roomNum = \"".$roomNum."\";";
                                $result = mysqli_query($conn, $sql) or die('MySQL query error');
                                $row = mysqli_fetch_array($result);
                                
                                if ($row){
                                    echo "<script>alert('已有房客資料')</script>";
                                }
                                else{
                                    //新增成員
                                    $sql = "INSERT INTO `member` (`roomNum`, `id`, `name`, `phone`, `date`) VALUES (\"".$roomNum."\",\"".$id."\",\"".$name."\",\"".$phone."\",\"".$date."\");";
                                    $result = mysqli_query($conn, $sql) or die('MySQL query error');
                                    
                                    //房號排序
                                    $sql = "SELECT * FROM `member` ORDER BY `roomNum`";
                                    $result = mysqli_query($conn, $sql) or die('MySQL query error');

                                    echo '新增成功';
                                }
                                
                            }
                            
                        }
                    }
                    
                    if(array_key_exists('exit', $_POST)) {
                        header("Location: index.php");
                    }
                }
                else{
                    header("Location:login.html");
                }
            ?>
        </div>
    </article> 
</body>
</html>