<?php
    session_start();

    $username = $_POST['username'];
    $typeuser = $_POST["typeuser"];
    $password = $_POST["password"];
    $action = $_POST['action'];
    $error = 0;


    if(empty($username) && empty($password) && empty($typeuser)){
        $error++;
    }else if(empty($username) || empty($password) || empty($typeuser)){
        $error++;
    }else{
        require_once 'config/database.php';
        $obj = new database();

        $obj->login($username, $password, $typeuser,$action);
        $result = $obj->getResult();

        if(empty($result)){
            $error++;
        }else{
            $error = 0;
            $_SESSION['username'] = $result[0];
            $_SESSION['typeuser'] = $result[1];
        }
    }

    if($error > 0){
        $output = array(
            'error' => true,
            'msg' => "Wrong username, password & type user",
        );
    }else{
        $output = array(
            'success' => true,
        ); 
    }
    
    echo json_encode($output);

?>