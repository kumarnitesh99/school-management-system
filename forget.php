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
                <form id='changepassword'>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <span id='error'></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="email" id='email' placeholder="Enter your email" class="form-control my-3 p-2">
                            <div id='emailerror' class="form-text text-danger"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="button" id='emailvalidate' class="btn1 mt-3 mb-5">Validate</button>
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
        $('#emailvalidate').on('click', function(){
            let val = $('#email').val();
            let temp_val = emptyField('#email', val, "email");
            if(temp_val != false){
                $.ajax({
                    type: "post",
                    url: "config/valid-email.php",
                    data: {email: val},
                    success: function (response) {
                        
                        if(response == 0){
                            $("#error").fadeIn().addClass('form-control text-center bg-danger').html('Please enter valid email').fadeOut(3000);
                        }else{
                            $(location).attr('href', 'forget-password-save.php');
                        }
                    }
                });
            }
        });

        $('#email').on('blur', function(){
            let val = $('#email').val();
            emptyField('#email', val, "email");
        });
    
        function emptyField(id, val, msg){
            if(val == ""){
                $(id + "error").html("Please enter "+msg).show();
                return false;
            }else{
                if(id == "#email"){
                    let temp_email = checkValidEmail(id, val, msg);
                    return temp_email;
                }else{
                    return true;
                }
            }
        }

        function checkValidEmail(id, val,msg){
            if(!(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z]/).test(val)){
                $(id + "error").html('Please enter valid ' +msg).show();
                return false;
            }else{
                $(id + "error").hide();
                return true;
            }
        }
        
    });
</script>