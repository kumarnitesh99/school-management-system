<?php
    include_once "database.php";
    $obj = new database();
    
    $email = $_POST['email'];
    $password = $_POST['old_password'];
    // $password = password_hash($pass, PASSWORD_DEFAULT);

    $where = "email = '$email'";

    $obj->validPassword('login', $password, $where);
    $result = $obj->getResult();

    foreach($result as $result){
        echo $result;
    }

?>