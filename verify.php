<?php
  header("Access-Control-Allow-Origin:*");
  header("Content-type:application/json");

  session_start(); 
  // 連線到資料庫
  // require_once適合用在:PHP程式執行期間，會多次引入相同的檔案。
  // 確保不會因為重覆引入相同的檔案，而產生函數重覆定義以及重覆給值的錯誤。
  require_once('connect.php');

  $user=$_POST["login"];
  $password=$_POST["password"];
  $reUser = preg_replace('/[\'\@\.\;\-=" "]+/', '', $user); //過濾特殊字元
  $rePassword = preg_replace('/[\'\@\.\;\-=" "]+/', '', $password); //過濾特殊字元

  if($user && $password){
    $sql = "SELECT password FROM  loginadmin WHERE user = \"".$reUser."\" and password = \"".$rePassword."\";";
    $result = mysqli_query($conn, $sql) or die('MySQL query error');
    $row = $result->fetch_assoc();
    
    if($row){
      echo '[{"result":"登入成功", 
              "link":"http://127.0.0.1/myRentManageWeb/index.php"}]';
      $_SESSION['is_Login'] = 'true';
      //header(("Location: index.php"));
    }
    else{
      echo '[{"result":"登入失敗",
              "link":"http://127.0.0.1/myRentManageWeb/login.html"}]';
      //header(("Location: login.html"));
    }
  }
  else{
    echo '[{"result":"未填寫帳號或密碼",
            "link":"http://127.0.0.1/myRentManageWeb/login.html"}]';
    //header(("Location: login.html"));
  }

?>




