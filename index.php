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
      #dataDisplay{
        display:flex;
        justify-content:center;
        align-items:center;
        font-size : 30px;
        margin: 2%;
      }
    </style>
</head>

<body>
    <header></header>
    <nav></nav>

    <article>
        <div id = "dataDisplay">
            <table border="1">
                <thead>
                    <tr>
                        <th>房號</th>
                        <th>姓名</th>
                        <th>身分證字號</th>
                        <th>電話</th>
                        <th>入住時間</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  session_start();
                  if(isset($_SESSION['is_Login'])&& $_SESSION['is_Login'] == "true"){
                    require_once('connect.php');

                    $sql = "SELECT * FROM member"; //SQL語法
                    $result = mysqli_query($conn, $sql) or die('MySQL query error'); //對目標資料庫進行查詢

                    while($row = mysqli_fetch_array($result)){
                      echo "<tr>";
                      echo "<td>".$row['roomNum']."</td>";
                      echo "<td>".$row['name']."</td>";
                      echo "<td>".$row['id']."</td>";
                      echo "<td>".$row['phone']."</td>";
                      echo "<td>".$row['date']."</td>";
                      echo "</tr><br>";

                    }
                  }
                  else{
                    echo '對不起，無權訪問3s後自動跳轉到登錄頁面';
		                echo '<meta http-equiv="refresh" content="3;url=./login.html">';
                  }
                ?>
                </tbody>
            </table>
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