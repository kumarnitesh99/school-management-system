<?php 
    require_once "config/database.php";
    $obj = new database();
?>
<?php
    include_once 'includes/header.php';
?>
    <section class="form my-4 mx-5">
    <div class="container">
        <div class="row row1 signupbody">
            <div class="col-lg-5">
                <img src="login.png" height="100%" width="100%" alt="" class="img">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h4>Registration Form</h4>
                <form id='registration_form' name="registration_form">
                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <span id='error' class="form-control alert-danger text-center py-2">kkl</span>
                            <span id='success' class="form-control alert-success text-center py-2">kkl</span>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <input id='fname' name='firstName' type="text" placeholder="First name" class="form-control p-2">
                            <span id= 'fname_error_message' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <input id='lname' name='lastName' type="text" placeholder="Last name" class="form-control p-2">
                            <span id= 'lname_error_message' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <input id='email' name='email' type="text" placeholder="Email" class="form-control p-2">
                            <span id= 'email_error_message' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <input id='phone' name='phone' type="text" placeholder="Phone" class="form-control p-2">
                            <span id= 'phone_error_message' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-lg-7 mb-2">
                        <select class="form-select" id='select' name="select">
                            <option value="" selected>Select user type</option>
                            <?php
                                $obj->select('user_type');
                                $result = $obj->getResult();
                                $name = $result[0]['type_name'];
                                $value = $result[0]['type_value'];
                                echo "<option value='$value'>$name</option>";
                                $name = $result[1][type_name];
                                $value = $result[1][type_value];
                                echo "<option value='$value'>$name</option>";
                            ?>
                        </select>
                        <span id= 'select_error_message' class="form-text text-danger"></span>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <input id='password' name='password' type="password" placeholder="Password" class="form-control p-2">
                            <span id= 'password_error_message' class="form-text text-danger"></span>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-lg-7">
                            <input type="file" name='image' id='image' class="form-control p-2">
                        </div>
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="col-lg-7">
                            <input type="submit" value='Register' class="btn1 form-control" id="register">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    include_once 'includes/footer.php';
?>
