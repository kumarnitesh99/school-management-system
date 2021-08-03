<?php
    session_start();
    require_once "database.php";
    $obj = new database();
    if(empty($_FILES["new-image"]["name"])){

        $new_name = $_POST["old-image"];
    }else{
        
        $error = [];

        $file_name = $_FILES["new-image"]["name"];
        $file_size = $_FILES["new-image"]["size"];
        $file_temp = $_FILES["new-image"]["tmp_name"];
        $file_type = $_FILES["new-image"]["type"];

        // $extension = strtolower(end(explode(".", $file_name)));  // for extension
        $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));  // for extension

        $rand_number = rand(0, 100000);
        $date = date("Ymd");
        $rename = "upload" . $date . $rand_number;
        $new_name = $rename.".".$extension;
        $allow_extension = ["jpg", "jpeg", "png"];

        if(in_array($extension, $allow_extension) === false){
            $error[] = "This extension file not allowed, Please choose a JPG or PNG file";
        }

        if($file_size > 2097152){
            $error[] = "File size must be 2mb or lower";
        }

        if(empty($error) == true){
            move_uploaded_file($file_temp, "../images/" . $new_name);
        }else{
            foreach($error as $error){
                echo $error;
                die();
            }
        }
    }
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $image = $new_name;

    date_default_timezone_set('Asia/Kolkata');
    $update_time = date('Y-m-d h:m:s');

    $row = "first_name = '$first_name', last_name = '$last_name', phone = $phone, image = '$image', updated_at = '$update_time'";
    $where = "id = $id";
    $obj->update('users', $row, $where);
    $result = $obj->getResult();
    foreach ($result as $result){
        echo $result;
    }

    $email = $_SESSION['username'];
    $type = $_SESSION['typeuser'];
    $activity_message = "updated profile";
    if($result == 1){
        $obj->activitys('activity_log', ['user_id' => $email, 'action' => $activity_message, 'type_user' => $type]);
    }
?>