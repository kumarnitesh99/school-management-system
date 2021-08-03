<?php 
  session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['typeuser'])){
    header("Location:login.php");
  }else{
 
  include_once 'includes/header.php';
?>
    <div class="container my-2 py-3 dashboard-content">
      <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <ul class="navbar-nav ul1">
                  <li>
                    <?php
                      if($cpage == "index.php"){
                        echo "<span class='nav-link'><i class='fa fa-desktop'></i> Dashboard </span>";
                      }

                    ?>
                  </li>
                </ul>
                
                </ul>
            </div>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-md-4 <?php if($_SESSION['typeuser'] == 4){echo ''; }else{echo 'hide'; } ?>">
          <div class="card management-card">
            <a class="card-body" href="management.php">
              Management
            </a>
          </div>                   
        </div>
        <div class="col-md-4 <?php if($_SESSION['typeuser'] == 4 || $_SESSION['typeuser'] == 3){echo ''; }else{echo 'hide'; } ?>">
          <div class="card teacher-card">
            <a class="card-body" href="teacher.php">
              Teacher
            </a>
          </div>                   
        </div>
        <div class="col-md-4 <?php if($_SESSION['typeuser'] == 1){echo 'hide'; }else{echo ''; } ?>">
          <div class="card student-card">
            <a class="card-body" href="student.php">
              Student
            </a>
          </div>                   
        </div>
      </div>
      <div class="row my-2">
        <div class="col-md-12">
          <div class="table-responsive ">
            <h4 class="card-header">Last 5 activity log </h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Action</th>
                  <th>Date & Time</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  require_once 'config/database.php';
                  $obj = new database();
                  $obj->viewActivity($_SESSION['typeuser']);
                  $result = $obj->getResult();

                  foreach ($result as $value) {
                    echo "<tr>
                          <td>$value[0]</td>
                          <td>$value[action]</td>
                          <td>$value[created_at]</td>
                        </tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<?php
  include_once 'includes/footer.php';
  }
?>