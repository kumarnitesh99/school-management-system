<?php 
    session_start();
    include_once "includes/header.php";
    include_once "config/database.php";
    $obj = new database();

?>

<section class="form my-4 mx-5">
    <div class="container">
        <div class="row row1 signupbody no-gutters">
            <div class="col-lg-5">
                <img src="login.png" height="100%" width="100%" alt="" class="img">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3"></h1>
                <h4>Change password </h4>
                <form id='changepassword'>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <span id='error'></span>
                        </div>
                    </div>

                    <div class="form-row after-hide">
                        <div class="col-lg-7">
                        <?php
                        $email = $_SESSION['username'];
                        $emails = "email = '$email'";
                        $obj->selects('users', 'email', null, $emails);
                        $results = $obj->getResult();
                        foreach ($results as list('email' => $email)){
                            echo "<input type='hidden' id='email' value='$email' class='form-control my-3 p-2'>";
                        }
                        ?>
                            <input type="password" id='old-password' placeholder="Enter Current password" class="form-control my-3 p-2">
                            <div id='old-passworderror' class="form-text text-danger"></div>
                        </div>
                    </div>

                    <div class="form-row hide">
                        <div class="col-lg-7">
                            <input type="password" id='password' placeholder="Enter new password" class="form-control my-3 p-2">
                            <div id='passworderror' class="form-text text-danger"></div>
                        </div>
                    </div>

                    <div class="form-row hide">
                        <div class="col-lg-7">
                            <input type="password" id='confirmpassword' placeholder="Enter confirm password" class="form-control my-3 p-2">
                            <div id='confirmpassworderror' class="form-text text-danger"></div>
                        </div>
                    </div>
                    
                    <div class="form-row after-hide">
                        <div class="col-lg-7">
                            <button type="button" id='valid' class="btn1 mt-3 mb-5">Validate Password</button>
                        </div>
                    </div>

                    <div class="form-row hide">
                        <div class="col-lg-7">
                            <button type="button" id='final' class="btn1 mt-3 mb-5">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.hide').hide();

        //  for validate email
        $('#valid').on('click', function(){
            let old_password = $('#old-password').val();
            temp_old_password = emptyField('#old-password', old_password, 'old password');

            let email = $('#email').val();

            if(temp_old_password != false){
                $.ajax({
                    type: "post",
                    url: "config/change-password.php",
                    data: {email: email, old_password: old_password},
                    success: function (response) {
                        if(response == 1){
                            $('#error').removeClass('bg-danger').addClass("text-center form-control text-dark bg-success").html('Please Enter New Password').slideDown();
                            setTimeout(function(){
                                $('#error').slideUp();
                            },4000);
                            $('.after-hide').hide();
                            $('.hide').show();
                        }else{
                            $('#error').removeClass('bg-success').addClass("text-center form-control text-dark bg-danger").html('Please Enter Correct Password').slideDown();
                            setTimeout(function(){
                                $('#error').slideUp();
                            },4000);
                        }
                    }
                });
            }
        });

        //for forget password
        $('#final').on('click', function(){

            let new_password = $('#password').val();
            temp_password = emptyField('#password', new_password, 'new password');

            let confirm_password = $('#confirmpassword').val();
            temp_confirm_password = emptyField('#confirmpassword', confirm_password, 'confirm password');
            
            let confirm = validConfirmPassword('#confirmpassword',new_password, confirm_password);
            
            let email = $('#email').val();

            if(!(temp_password == false) && !(temp_confirm_password == false) && !(confirm == false)){
                $.ajax({
                    type: "post",
                    url: "config/change-pass-save.php",
                    data: {email: email, new_password: new_password, confirm_password: confirm_password},
                    success: function (response) {
                        if(response == 1){
                            $(location).attr('href', 'index.php');
                        }else{
                            $('#error').removeClass('bg-success').addClass('bg-danger').show().html(response);
                        }
                    }
                });
            }
        });
    });

    $('#old-password').on('blur', function () {
        let old_password = $('#old-password').val();
        emptyField('#old-password', old_password, 'old password');
    });

    $('#password').on('blur', function () {
        let password = $('#password').val();
        emptyField('#password', password, 'password');
    });

    $('#confirmpassword').on('blur', function () {
        let confirm_password = $('#confirmpassword').val();
        emptyField('#confirmpassword', confirm_password, 'confirm password');

        let password = $('#password').val();
        validConfirmPassword('#confirmpassword', password, confirm_password);
    });


    function emptyField(id, val, msg){
        if(val == ""){
            $(id + "error").html("Please enter "+msg).show();
            return false;
        }else{
            if(id == "#password"){
                let temp_pass = checkValidPassword(id, val, msg);
                return temp_pass;
            }else if(id == "#old-password"){
                let temp_old_pass = checkValidPassword(id, val, msg);
                return temp_old_pass;
            }else if(id == "#confirmpassword"){
                let temp_confirm_pass = checkValidPassword(id, val, msg);
                return temp_confirm_pass;
            }else{
                return true;
            }
        }
    }

    function checkValidPassword(id, val, message){
        if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,15}$/).test(val)){
            $(id + "error").html('Please enter Correct Password ').show();
            return false;
        }else{
            $(id + "error").hide();
            return true;
        }
    }

    function validConfirmPassword(id, password, confirm_password){
        if(password != confirm_password){
            $(id + "error").html('confirm password and new password are not same').show();
            return false;
        }else{
            $(id + "error").hide();
            return true;
        }
    }
</script>
<?php include_once "includes/footer.php"; ?>