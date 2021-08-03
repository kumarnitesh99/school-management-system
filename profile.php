<?php
session_start();
include_once 'includes/header.php';
include_once 'config/database.php';
    $obj = new database();
?>
<div class="container profile-card my-3 ">
    <div class="row">
        <div class="col text-center">
            <h3 class="text-center mt-3"><b> My Profile </b></h3>
            <?php
                $email = $_SESSION['username'];
                $where = "email ='$email'";
                $row = " id,first_name,last_name,email,type_user,phone,image";
                $obj->select('users', $row, null,$where);
                $result = $obj->getResult();
                foreach($result as list('id'=> $id, 'first_name' => $first_name, 'last_name' => $last_name, 'email'=> $email, 'type_user'=> $usertype, 'phone' => $phone, 'image' => $image)){
            echo "<img src='images/$image' class='rounded-circle' width = '75px' height = '75px' alt='...'>
            
            <h5><b> $first_name  $last_name</b></h5>
        </div>
    </div>
    <div class='profile-table pb-3'>
        <div class='row'>
            <div class='table-responsive'>
                <table class='w-50 m-auto table table-light caption-top table-hover table-hover table-bordered align-middle'>";
                     echo "<tr>
                        <th>Id</th>
                        <td> $id</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td> $first_name </td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td> $last_name</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>$email</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>$phone</td>";
                    } ?>
                    </tr> 
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
