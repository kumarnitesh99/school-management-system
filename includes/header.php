<?php
    $cpage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>student Management System</title>
</head>
<body>
<div class="container-fluid top-header">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 top-header-left">
                            <div class="top-header-email">
                                <a href="#"><i class="fa fa-envelope"></i>smshiit@gmail.com</a>
                            </div>
                        </div>
                        <div class="col-md-4 top-header-midile">
                            <div class="top-header-phone">
                                <p class="m-0"><i class="fa fa-phone"></i>+91 - 9065063302</p>
                            </div>
                        </div>
                        <div class="col-md-3 top-header-right">
                            <div class="social-media">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"> <i class="fa fa-google"></i></a>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bottom-header">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h2>S.M.S.</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item <?php if($cpage == "login.php"){ echo "active";}else{ echo "";}?> <?php if($cpage == "index.php" || $cpage == "management.php" || $cpage == "pending-management.php" || $cpage == "rejected-management.php" || $cpage == "action-management.php" || $cpage == "teacher.php" || $cpage == "pending-teacher.php" || $cpage == "rejected-teacher.php" || $cpage == "student.php" || $cpage == "pending-student.php" || $cpage == "rejected-student.php" || $cpage == "profile.php" || $cpage == "update-profile.php" || $cpage == "change-password.php"){ echo "hide";}else{ echo "";}?>">
                        <a class="nav-link menu" href="login.php"><i class="fa fa-lock"></i>&nbsp;Login</a>
                    </li>
                    
                    <li class="nav-item <?php if($cpage == "index.php"){ echo "active";}else{ echo "";}?> <?php if($cpage == "login.php" || $cpage == "signup.php" || $cpage == "forget.php" || $cpage == "forget-password-save.php"){ echo "hide";}else{ echo "";}?>">
                        <a class="nav-link menu" href="index.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a>
                    </li>

                    <li class="nav-item <?php if($cpage == "management.php" || $cpage == "pending-management.php" || $cpage == "rejected-management.php"){ echo "active";}else{ echo "";}?> <?php if($cpage == "login.php" || $cpage == "signup.php" || $cpage == "forget.php" || $cpage == "forget-password-save.php" || $_SESSION['typeuser'] == 1 || $_SESSION['typeuser'] == 2 || $_SESSION['typeuser'] == 3){ echo "hide";}else{ echo "";}?>">
                        <a class="nav-link menu" href="management.php"><i class="fa fa-user"></i>&nbsp;Management</a>
                    </li>

                    <li class="nav-item <?php if($cpage == "teacher.php" || $cpage == "pending-teacher.php" || $cpage == "rejected-teacher.php"){ echo "active";}else{ echo "";}?> <?php if($cpage == "login.php" || $cpage == "signup.php" || $cpage == "forget.php" || $cpage == "forget-password-save.php" || $_SESSION['typeuser'] == 1 || $_SESSION['typeuser'] == 2){ echo "hide";}else{ echo "";}?>">
                        <a class="nav-link menu" href="teacher.php"><i class="fa fa-user"></i>&nbsp;Teacher</a>
                    </li>

                    <li class="nav-item <?php if($cpage == "student.php" || $cpage == "pending-student.php" || $cpage == "rejected-student.php"){ echo "active";}else{ echo "";}?> <?php if($cpage == "login.php" || $cpage == "signup.php" || $cpage == "forget.php" || $cpage == "forget-password-save.php" || $_SESSION['typeuser'] == 1){ echo "hide";}else{ echo "";}?>">
                        <a class="nav-link menu" href="student.php"><i class="fa fa-user"></i>&nbsp;Student</a>
                    </li>

                    <li class="nav-link profile <?php if($cpage == "login.php" || $cpage == "signup.php" || $cpage == "forget.php" || $cpage == "forget-password-save.php"){ echo "hide";}else{ echo "";}?>">
                        <div class="dropdown ul2">
                            <?php 
                                require_once 'config/database.php'; 
                                $obj = new database();
                                $obj->active_user($_SESSION['username']);
                                $result = $obj->getResult();
                            ?>
                            <img src="images/<?php if($result[1] == ""){ echo "unknown.jpg";}else{ echo $result[1]; } ?>" alt=""> 
                            <span><?php echo $result[0]; ?><span>
                            <span class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></span>
                            <ul class="dropdown-menu mt-4 ms-2 p-0" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                                <li><hr class="dropdown-divider m-0"></li>
                                <li><a class="dropdown-item" href="update-profile.php">Update Profile</a></li>
                                <li><hr class="dropdown-divider m-0"></li>
                                <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                                <li><hr class="dropdown-divider m-0"></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item <?php if($cpage == "signup.php"){ echo "active";}else{ echo "";}?> <?php if($cpage == "index.php" || $cpage == "management.php" || $cpage == "pending-management.php" || $cpage == "rejected-management.php" || $cpage == "action-management.php" || $cpage == "teacher.php" || $cpage == "pending-teacher.php" || $cpage == "rejected-teacher.php" || $cpage == "student.php" || $cpage == "pending-student.php" || $cpage == "rejected-student.php" || $cpage == "profile.php" || $cpage == "update-profile.php" || $cpage == "change-password.php"){ echo "hide";}else{ echo "";}?>">
                        <a class="nav-link menu" href="signup.php"><i class="fa fa-sign-in"></i>&nbsp;SignUp</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<script>
    $(document).ready(function(){
        $('.navbar-toggler').css({'box-shadow':'none','border':'none'});
        
        $('.navbar-toggler span').on('click',function(){
            $(this).toggleClass('fa-bars fa-times');
        });
    });
</script>