<?php
    include_once "includes/header.php";
?>
<section class="form my-4 mx-5">
    <div class="container">
        <div class="row row1 signupbody no-gutters">
            <div class="col-lg-5">
                <img src="login.png" height="100%" width="100%" alt="" class="img">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3"></h1>
                <h4>Forget password </h4>
                <form id='save-data'>
                    <div class="form-row">
                        <div class="col-md-7 alert alert-danger py-2 text-center message-forgot-password" style="display:none;">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" name='new-password' id='new-password' placeholder="Enter new password" class="form-control my-3 p-2">
                            <span id='new-passworderror' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" name='confirm-password' id='confirm-password' placeholder="Enter confirm password" class="form-control my-3 p-2">
                            <span id='confirm-passworderror' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" name='confirm-password' id='reset-code' placeholder="Enter otp" class="form-control my-3 p-2">
                            <span id='reset-codeerror' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="button" id='sava' class="btn1 mt-3 mb-5">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include_once "includes/footer.php"; ?>

<script>
    $(document).ready(function () {
        $('#sava').on('click', function(){
            let new_password = $('#new-password').val();
            let temp_new = emptyField('#new-password', new_password, 'new password');

            let confirm_password = $('#confirm-password').val();
            let temp_confirm = emptyField('#confirm-password', confirm_password, 'confirm password');

            let fnew_password = $('#new-password').val();
            let valid_confirm = validConfirmPassword('#confirm-password', fnew_password, confirm_password);

            let reset_code = $("#reset-code").val();
            if(!(temp_new === false) && !(temp_confirm === false) && !(valid_confirm === false)){
                if(reset_code == ""){
                    $('#reset-codeerror').html("Please enter valid otp").fadeIn().fadeOut(4000);
                }else{
                    $.ajax({
                        type: "post",
                        url: "config/save-forget-data.php",
                        data: {new_password: new_password, confirm_password: confirm_password,  reset_code:  reset_code},
                        success: function (response) {
                            if(response == 0){
                                $('.message-forgot-password').html("Can't be forgot").fadeIn().fadeOut(4000);
                            }
                            if(response == 1){
                                $(location).attr('href', 'login.php');
                                alert('Your password has been successfully changed');
                            }
                        }
                    });
                }
                
            }
        });

        $('#new-password').on('blur', function () {
            let new_password = $('#new-password').val();
            emptyField('#new-password', new_password, 'new password');
        });

        $('#confirm-password').on('blur', function () {
            let confirm_password = $('#confirm-password').val();
            emptyField('#confirm-password', confirm_password, 'confirm password');

            let new_password = $('#new-password').val();
            validConfirmPassword('#confirm-password', new_password, confirm_password);
        });     

        function emptyField(id, val, msg){
            if(val == ""){
                $(id + "error").html("Please enter "+msg).show();
                return false;
            }else{
                if(id == "#new-password"){
                    let temp_pass = checkValidPassword(id, val, msg);
                    return temp_pass;
                }else if(id == "#confirm-password"){
                    let temp_old_pass = checkValidPassword(id, val, msg);
                    return temp_old_pass;
                }else{
                    return true;
                }
            }
        }

        function checkValidPassword(id, val, message){
            if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/).test(val)){
                $(id + "error").html('Please enter min 4 & max 10 character (one upper, small, number and special symbols.)').show();
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
    });
</script>