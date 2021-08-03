<?php
    include_once "database.php";
    $obj = new database();

    $new_pass = $_POST['new_password'];
    $confirm_pass = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);
    $reset_code = $_POST['reset_code'];

    $row = "password = '$confirm_pass', reset_code = ''";
    $where = "reset_code = '$reset_code'";

    $obj->update('login', $row, $where);

    $result = $obj->getResult();

    foreach($result as $result){
        echo $result;
    }

?>