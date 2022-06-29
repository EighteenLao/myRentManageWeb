<?php
    session_start();
    unset($_SESSION['is_Login']);
    header("Location:login.html");
?>