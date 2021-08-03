<?php
    $email = $_POST['email'];
    $type_user = $_POST['type_user'];
    require_once 'config/database.php';

    $obj = new database();
    $data = $obj->approve($email,$type_user);
    echo $data;
?>