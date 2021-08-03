<?php
    session_start();
    if(!isset($_SESSION['username']) && isset($_SESSION['typeuser'])){
        header("Location: index.php");
    }
?>
<?php
    include_once 'includes/header.php';
?>
    <!-- Login_page starts here -->
    <section class="form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters loginbody">
                <div class="col-lg-5">
                    <img src="login.png" height="100%" width="100%" alt="" class="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h4 class="mt-5">Login into your account </h4>
                    <form name="login" id="login" autocomplete="off">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <span class="form-control alert-danger text-center" id="error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="text" placeholder="Enter username" class="form-control my-3 p-2" name="username">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" placeholder="Enter password" class="form-control my-3 p-2" name="password">
                            </div>

                            <div class="col-lg-7">

                                <select class="form-select" name="typeuser">
                                    <option value="" selected>select type of user</option>
                                    <option value="1">Student</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Management</option>
                                    <option value="4">Admin</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row my-2">
                            <div class="col-lg-7">
                                <input type="submit" value="Login" class="form-control btn1" id="loginbtn">
                                <input type="hidden" name="action" value="Login">
                            </div>

                        </div>
                        <div class="form-row mt-4">
                            <div class="col-lg-7 text-center">
                                <a href="forget.php" class="text-center">Forgot password</a>
                                <p>Don't have an account? <a href="signup.php">Register here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <!-- Login_page ends here -->
<?php
    include_once 'includes/footer.php';
?>
<script>
    $(document).ready(function(){
        $('#error').css('display','none');
        $('#login').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: "validate_login.php",
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#loginbtn').val('validate.....');
                    $('#loginbtn').attr('disabled','disabled');
                },
                success: function(data){
                    if(data.success) {
                        var url = "http://localhost/Final_Project/";
                        $(location).attr('href',url);
                    }
                    if(data.error){
                        $('#loginbtn').val('Login');
                        $('#loginbtn').attr('disabled',false);
                        $('#error').text(data.msg).fadeIn().fadeOut(3000);;
                    }
                }
            });   
        });
    });
</script>