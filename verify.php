<?php
  // 連線到資料庫
  require_once('connect.php');

  if(isset($_POST['login'])){
    $user=$_POST["login"];
    $password=$_POST["password"];
    $flag = 0;

    $sql = "SELECT password FROM  loginadmin WHERE user = \"".$user."\";";
    $result = mysqli_query($conn, $sql) or die('MySQL query error');

    while ($row = $result->fetch_assoc()) {
      if ($row['password'] == $password){
        $flag = 1;
        header(("Location: index.php"));
      }
    }
    
    if ($flag == 0){
      header(("Location: login.html")); 
    }
  
  }

?>




