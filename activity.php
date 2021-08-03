<?php
    include_once 'backends/database.php';
    include_once 'header.php';
    $obj = new database();

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    $username = $_SESSION['username'];

    $output = '';

    // SELECT user_id, action, type_name FROM activity_log JOIN user_type ON activity_log.type_user = user_type.type_value;

    $obj->select('activity_log', 'user_id, action, type_name, created_at', 'user_type ON activity_log.type_user = user_type.type_value', "activity_log.user_id = '$username'", 'activity_log.id DESC', '5');
    $result = $obj->getResult();

    echo "<div class='container'>
        <div class='row'>
            <div class='col'>

                <table class='table table-hover table-bordered table-primary text-center caption-top'>
                            <caption class='text-center fs-4 text-dark fw-bold'> Your Five Activity </caption>
                            <thead>
                                <tr>
                                    <th>USERNAME</th>
                                    <th>ACION</th>
                                    <th>USER TYPE</th>
                                    <th>DATE & TIME</th>
                                </tr>
                            </thead>";
                foreach ($result as list('user_id' => $user_id, 'action' => $action, 'type_name' => $type, 'created_at' => $time)){
                    echo "<tbody><tr> <td>$user_id</td> <td>$action</td> <td>$type</td> <td>$time</td> </tr></tbody>";
                }
                echo "</table>
            </div>
        </div>
    </div>";



    include_once "footer.php";
?>