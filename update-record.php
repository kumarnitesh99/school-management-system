<?php
    session_start();
    $fName = $_POST['firstName'];
    $temp1 = check_name($fName);
    $lName = $_POST['lastName'];
    $temp2 = check_name($lName);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $temp3 = check_phone($phone);

    $error = 0;

    function check_name($name){
        $pattern = '/^[a-zA-Z]*$/';
        if($name == ''){
            return false;
        }else{
            if(preg_match($pattern, $name)){
                return true;
            }else{
                return false;
            }
        }
    }
    function check_phone($phone){
        $pattern = '/^[0-9]{10}+$/';
        if($phone == ''){
            return false;
        }else{
            if(preg_match($pattern, $phone)){
                return true;
            }else{
                return false;
            }
        }
    }

    if(($temp1 != null) && ($temp2 != null) && ($temp3 != null)){
        require_once 'config/database.php';
        $obj = new database();
        if(isset($_FILES['uimage'])){
            $photo = $_FILES['uimage'];
            $imagename =  $obj->uploadPhoto($photo);
            $data = [
                "fname" => $fName,
                "lname" => $lName,
                "email" => $email,
                "phone" => $phone,
                "image" => $imagename,
                "type_user" => $_SESSION['typeuser'],
            ];
        }else{
            $data = [
                "fname" => $fName,
                "lname" => $lName,
                "email" => $email,
                "phone" => $phone,
                "image" => "",
                "type_user" => $_SESSION['typeuser'],
            ];
        }
        $result = $obj->updateRecord($data);
        
        if($result == 1){
            $error = 0;
        }else{
            $error = 1;
        }
    }else{
        $error++;
    }

    if($error > 0){
        $output = array(
            'error' => true,
            'msg' => "Please check fields error.",
        );
    }else{
        $output = array(
            'success' => true,
            'msg' => "Successfully updated.",
        ); 
    }
    
    echo json_encode($output);

?>