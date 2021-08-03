<?php
    
    $fName = $_POST["firstName"];
    $lName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $typeuser = $_POST["select"];
    $error = 0;

    if(empty($fName) && empty($lName) && empty($email) && empty($phone) && empty($password) && empty($typeuser)){
        $error++;
        $msg = "All fields are required";
    }else if(empty($fName) || empty($lName) || empty($email) || empty($phone) || empty($password) || empty($typeuser)){
        $error++;
        $msg = "All fields are required";
    }else{
        require_once "config/database.php";
        $obj = new database();

        if(isset($_FILES['image'])){
            $photo = $_FILES['image'];
            $imagename =  $obj->uploadPhoto($photo);
            $data = [
                "fname" => $fName,
                "lname" => $lName,
                "email" => $email,
                "phone" => $phone,
                "password" => $password,
                "typeuser" => $typeuser,
                "image" => $imagename,
            ];
        }else{
            $data = [
                "fname" => $fName,
                "lname" => $lName,
                "email" => $email,
                "phone" => $phone,
                "password" => $password,
                "typeuser" => $typeuser,
                "image" => "",
            ];
        }
        $result = $obj->registeration('users',$data);
        if($result == 0){
            $error++;
            $msg = "Your email all ready registered.";
        }else{
            $error = 0;
            $msg = "Successfully registered.";
        }
        
    }

    if($error > 0){
        $output = array(
            'error' => true,
            'msg' => $msg,
        );
    }else{
        $output = array(
            'success' => true,
            'msg' => $msg,
        ); 
    }
    
    echo json_encode($output);


?>