<?php
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
      $_SESSION['is_login'] = TRUE;
      header(("Location: index.php"));
    }
    else{
      $_SESSION['is_login'] = FALSE;
      $_SESSION['msg'] = '登入失敗，請確認帳號密碼!!';
      header(("Location: login.html"));
    }
  }
  else{
    $_SESSION['msg'] = '請輸入帳號密碼!!';
    header(("Location: login.html"));
  }

?>




