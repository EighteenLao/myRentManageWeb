<?php
  $server_name = 'localhost';
  $username = 'root';
  $password = '';
  $db_name = 'roommemberdatabase';

  // mysqli 的四個參數分別為：伺服器名稱、帳號、密碼、資料庫名稱
  // mysqli: 永遠連線函式，mysqli多次執行mysqli將使用同一連線程序，從而減少了伺服器的開銷。
  $conn = new mysqli($server_name, $username, $password, $db_name);

  if (!empty($conn->connect_error)) {
    die('資料庫連線錯誤:' . $conn->connect_error);    // die()：終止程序
  }
?>