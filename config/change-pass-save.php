<?php
    session_start();
    include_once "database.php";
    $obj = new database();

    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $type = $_SESSION['typeuser'];
    $activity_message = "change password";
    $confirm_password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);

    date_default_timezone_set('Asia/Kolkata');
    $update_time = date('Y-m-d h:m:s');

    $where = "email = '$email'";

    $row = "password = '$confirm_password', updated_at = '$update_time'";

    $obj->update('login', $row, $where);

    $result = $obj->getResult();

    foreach($result as $result){
        echo $result;
    }
    if($result == 1){
        $obj->activitys('activity_log', ['user_id' => $email, 'action' => $activity_message, 'type_user' => $type]);
    }
?>