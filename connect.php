<?php
  $server_name = 'localhost';
  $username = 'root';
  $password = '';
  $db_name = 'roommemberdatabase';

  // mysqli: 永遠連接function，mysqli多次執行mysqli只使用同一連線程序，減少了伺服器的開銷。
  $conn = new mysqli($server_name, $username, $password, $db_name);

  if (!empty($conn->connect_error)) {
    die('資料庫連線錯誤:' . $conn->connect_error);    // die()：終止程序
  }
?>