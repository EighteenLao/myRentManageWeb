<?php
    session_start();
    unset($_SESSION['is_Login']);
    session_destroy();
    header("Location:login.html");
?>