<?php
    session_start();
    include_once "includes/header.php"; 
    include_once "config/database.php";
    $type = $_SESSION['typeuser'];
    $obj = new database();
    $emails = $_SESSION['username'];
    $email = "email = '$emails'";
?>

<section class="form my-4 mx-5">
    <div class="container">
        <div class="row row1 signupbody no-gutters">
            <div class="col-lg-5">
                <img src="login.png" height="100%" width="100%" alt="" class="img">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h4>Update Profile Form</h4>

                <form id='regform'>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <span id='error'></span>
                        </div>
                    </div>
                    <?php
                    $obj->select('users', '*', null, $email);
                    $results = $obj->getResult();
                    
                    foreach ($results as list('id' => $i, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'phone' => $phone, 'image' => $image)){
                        echo "<div class='form-row'>
                            <div class='col-lg-7'>
                                <input value = '$i' name='id' type='hidden' class='form-control my-3 p-2'>
                                <input id='fname' value = '$first_name' name='first_name' type='text' placeholder='First name' class='form-control my-3 p-2' required>
                                <div id= 'fnameerror' class='form-text text-danger'></div>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='col-lg-7'>
                                <input id='lname' value = '$last_name' name='last_name' type='text' placeholder='Last name' class='form-control my-3 p-2' required>
                                <div id='lnameerror' class='form-text text-danger'></div>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='col-lg-7'>
                                <input id='phone' value = '$phone' name='phone' type='text' placeholder='Phone' class='form-control my-3 p-2' required>
                                <div id='phoneerror' class='form-text text-danger'></div>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='col-lg-7'>
                                <input type='file' name='new-image' id='image' class='form-control my-3 p-2'>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='col-lg-7'>
                            <img  class='show-image' src='images/$image'  height='150px'>
                            <input type='hidden' name='old-image' value='$image' class='form-control my-3 p-2'>
                            </div>
                        </div>";
                    }
                    ?>
                    <div class='form-row'>
                        <div class='col-lg-7'>
                            <button type="submit" id='submit' class="btn1 mt-3 mb-5">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#error').hide();

        $('#regform').on('submit', function(e){
            e.preventDefault();
            
            let fname = $('#fname').val();
            let temp_fname = emptyField('#fname', fname, 'first name');

            let lname = $('#lname').val();
            let temp_lname = emptyField('#lname', lname, 'last name');

            let phone = $('#phone').val();
            let temp_phone = emptyField('#phone', phone, 'mobile number');

            if(!(temp_fname == false) && !(temp_lname == false) && !(temp_phone == false)){
                $.ajax({
                    url: "config/save-updated-user.php",
                    type: "post",
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (response) {
                        if(response == 1){
                            $(location).attr('href', 'profile.php');
                        }else{
                            $('#error').addClass("text-center form-control text-dark bg-danger").html(response).slideDown();
                            setTimeout(function(){
                                $('#error').slideUp();
                            },4000);
                        }
                    }
                });
            }
        });

        $('#fname').on('blur', function () {
            let fname = $('#fname').val();
            emptyField('#fname', fname, 'first name');
        });

        $('#lname').on('blur', function () {
            let lname = $('#lname').val();
            emptyField('#lname', lname, 'last name');
        });

        $('#phone').on('blur', function () {
            let phone = $('#phone').val();
            emptyField('#phone', phone, 'mobile number');
        });

        $('#password').on('blur', function () {
            let password = $('#password').val();
            emptyField('#password', password, 'password');
        });


        function emptyField(id, val, msg){
            if(val == ""){
                $(id + "error").html("Please enter "+msg).show();
                return false;
            }else{
                if(id == "#fname"){
                    let temp_fname = checkValidName(id, val, msg);
                    return temp_fname;
                }else if(id == "#lname"){
                    let temp_lname = checkValidName(id, val, msg);
                    return temp_lname;
                }else if(id == "#password"){
                    let temp_pass = checkValidPassword(id, val, msg);
                    return temp_pass;
                }else if(id == "#phone"){
                    let temp_phone = checkValidPhone(id, val, msg);
                    return temp_phone;
                }else{
                    return true;
                }
            }
        }

        function checkValidName(id, val, msg){
            if(!(/^[a-zA-Z]*$/).test(val)){
                $(id + "error").html('Please enter valid ' +msg).show();
                return false;
            }else{
                $(id + "error").hide();
                return true;
            }
        }

        function checkValidPhone(id, val, msg){
            if(!(/^[0-9]/).test(val)){
                $(id + "error").html('Please enter only number ').show();
                return false;
            }else{
                if(val.length != 10){
                    $(id + "error").html('Please enter valid '+msg).show();
                    return false;
                }else{
                    $(id + "error").hide();
                    return true;
                }
            }  
        }
    });
</script>

<?php include_once "includes/footer.php"; ?>