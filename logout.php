<?php
    session_start();
    require_once 'config/database.php';
    $obj = new database();
    $obj->logoutActivity($_SESSION['username'], $_SESSION['typeuser']);
    session_destroy();
    header("Location:login.php");
?>