<?php
    session_start();
    $email = $_POST['demail'];
    $type_user = $_SESSION['typeuser'];
    $error = 0;

    if($email == ''){
        $error++;
    }else{
        require_once 'config/database.php';
        $obj = new database();
        $result = $obj->deleteRecord($email,$type_user);
        if($result == 1){
            $error = 0;
        }else{
            $error++;
        }
    }

    if($error > 0){
        $output = array(
            'error' => true,
            'msg' => "Can't be delete record.",
        );
    }else{
        $output = array(
            'success' => true,
            'msg' => "Successfully deleted record.",
        ); 
    }

    echo json_encode($output);
    
?>
