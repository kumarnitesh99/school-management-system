<?php 
  session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['typeuser'])){
    header("Location:login.php");
  }else if($_SESSION['typeuser'] == 4){
 
  include_once 'includes/header.php';
?>
    <div class="container my-2 py-3 dashboard-content">
      <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <ul class="navbar-nav ul1">
                  <li>
                    <?php
                      if($cpage == "student.php"){
                        echo "<span class='nav-link'><i class='fa fa-desktop'></i> <a href='index.php'> Dashboard</a>/  <i class='fa fa-user'></i> Student </span>";
                      }
                    ?>
                  </li>
                </ul>
                
                </ul>
            </div>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-md-4">
          <!-- Button trigger modal -->
          <div class="card action-management-card">
            <a href=""class="card-body" data-bs-toggle="modal" data-bs-target="#studentAdd" id="close
            ">
                Add+
            </a>
            <!-- Modal -->
            <div class="modal fade" id="studentAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form name="addForm" id="addForm">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">New Student Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-row mb-2">
                          <div class="col-lg-12">
                              <span id='error' class="form-control alert-danger text-center py-2">kkl</span>
                              <span id='success' class="form-control alert-success text-center py-2">kkl</span>
                          </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <input id='fname' name='firstName' type="text" placeholder="First name" class="form-control p-2">
                                <span id= 'fname_error_message' class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <input id='lname' name='lastName' type="text" placeholder="Last name" class="form-control p-2">
                                <span id= 'lname_error_message' class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <input id='email' name='email' type="text" placeholder="Email" class="form-control p-2">
                                <span id= 'email_error_message' class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <input id='phone' name='phone' type="text" placeholder="Phone" class="form-control p-2">
                                <span id= 'phone_error_message' class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-2">
                            <select class="form-select" id='select' name="select">
                                <option value="" selected>Select user type</option>
                                <?php
                                    $obj->select('user_type');
                                    $result = $obj->getResult();
                                    $name = $result[0][type_name];
                                    $value = $result[0][type_value];
                                      echo "<option value='$value'>$name</option>";
                                ?>
                            </select>
                            <span id= 'select_error_message' class="form-text text-danger"></span>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <input id='password' name='password' type="password" placeholder="Password" class="form-control p-2">
                                <span id= 'password_error_message' class="form-text text-danger"></span>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <input type="file" name='image' id='image' class="form-control p-2">
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="submit" value="Add" class="btn btn-primary" id="addmanagementbtn">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            
          </div>                   
        </div>
        <div class="col-md-4">
          <div class="card pending-management-card">
            <a class="card-body" href="pending-student.php">
              Pending
            </a>
          </div>                   
        </div>
        <div class="col-md-4">
          <div class="card rejected-management-card">
            <a class="card-body" href="rejected-student.php">
              Rejected
            </a>
          </div>                   
        </div>
      </div>
      <div class="row my-2">
        <div class="col-md-12">
          <div class="table-responsive ">
            <div class="card-header d-flex">
              <h4 class="me-auto">Approved Record </h4>
              <span class="me-auto text-center success-message" style="width:350px;"><b>kj<b></span>
            </div>
            <table class="table table-bordered">
              <thead>
              <tr>
                  <th>S.No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="approved_record">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-md-12 updateColumn">
          <p href=""class="update-card" data-bs-toggle="modal" data-bs-target="#updateRecord"></p>
          
          <p href=""class="delete-card" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" id="close"></p>   
          
          <div class="modal fade" id="deleteRecordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Delete Record</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="deleteRecord" id="deleteRecord">
                  <div class="modal-body">
                    <div class="row">
                      <h6 class="text-center">Are you sure want to delete?</h6>
                      <input type="hidden" name="demail" value="" id="demail">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Ok" class="btn btn-danger">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>           
        </div>
      </div>
    </div>
<?php
  include_once 'includes/footer.php';
  }else if($_SESSION['typeuser'] == 3 || $_SESSION['typeuser'] == 2){
 
    include_once 'includes/header.php';
  ?>
      <div class="container my-2 py-3 dashboard-content">
        <div class="row">
          <div class="col-md-12">
              <div class="card-header">
                  <ul class="navbar-nav ul1">
                    <li>
                      <?php
                        if($cpage == "student.php"){
                          echo "<span class='nav-link'><i class='fa fa-desktop'></i> <a href='index.php'> Dashboard</a>/  <i class='fa fa-user'></i> Student </span>";
                        }
                      ?>
                    </li>
                  </ul>
                  
                  </ul>
              </div>
          </div>
        </div>
        <div class="row my-2">
          <div class="col-md-4">
            <!-- Button trigger modal -->
            <div class="card action-management-card">
              <a href=""class="card-body" data-bs-toggle="modal" data-bs-target="#studentAdd" id="close
              ">
                  Add+
              </a>
              <!-- Modal -->
              <div class="modal fade" id="studentAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form name="addForm" id="addForm">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">New Student Add</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-row mb-2">
                            <div class="col-lg-12">
                                <span id='error' class="form-control alert-danger text-center py-2">kkl</span>
                                <span id='success' class="form-control alert-success text-center py-2">kkl</span>
                            </div>
                          </div>
  
                          <div class="form-row mb-2">
                              <div class="col-lg-12">
                                  <input id='fname' name='firstName' type="text" placeholder="First name" class="form-control p-2">
                                  <span id= 'fname_error_message' class="form-text text-danger"></span>
                              </div>
                          </div>
  
                          <div class="form-row mb-2">
                              <div class="col-lg-12">
                                  <input id='lname' name='lastName' type="text" placeholder="Last name" class="form-control p-2">
                                  <span id= 'lname_error_message' class="form-text text-danger"></span>
                              </div>
                          </div>
  
                          <div class="form-row mb-2">
                              <div class="col-lg-12">
                                  <input id='email' name='email' type="text" placeholder="Email" class="form-control p-2">
                                  <span id= 'email_error_message' class="form-text text-danger"></span>
                              </div>
                          </div>
  
                          <div class="form-row mb-2">
                              <div class="col-lg-12">
                                  <input id='phone' name='phone' type="text" placeholder="Phone" class="form-control p-2">
                                  <span id= 'phone_error_message' class="form-text text-danger"></span>
                              </div>
                          </div>
  
                          <div class="col-lg-12 mb-2">
                              <select class="form-select" id='select' name="select">
                                  <option value="" selected>Select user type</option>
                                  <?php
                                      $obj->select('user_type');
                                      $result = $obj->getResult();
                                      $name = $result[0][type_name];
                                      $value = $result[0][type_value];
                                        echo "<option value='$value'>$name</option>";
                                  ?>
                              </select>
                              <span id= 'select_error_message' class="form-text text-danger"></span>
                          </div>
  
                          <div class="form-row mb-2">
                              <div class="col-lg-12">
                                  <input id='password' name='password' type="password" placeholder="Password" class="form-control p-2">
                                  <span id= 'password_error_message' class="form-text text-danger"></span>
                              </div>
                          </div>
  
                          <div class="form-row mb-2">
                              <div class="col-lg-12">
                                  <input type="file" name='image' id='image' class="form-control p-2">
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" value="Add" class="btn btn-primary" id="addmanagementbtn">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              
            </div>                   
          </div>
          <div class="col-md-4">
            <div class="card pending-management-card">
              <a class="card-body" href="pending-student.php">
                Pending
              </a>
            </div>                   
          </div>
          <div class="col-md-4">
            <div class="card rejected-management-card">
              <a class="card-body" href="rejected-student.php">
                Rejected
              </a>
            </div>                   
          </div>
        </div>
        <div class="row my-2">
          <div class="col-md-12">
            <div class="table-responsive ">
              <div class="card-header d-flex">
                <h4 class="me-auto">Approved Record </h4>
                <span class="me-auto text-center success-message" style="width:350px;"><b>kj<b></span>
              </div>
              <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="approved_record_std">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row"> 
          <div class="col-md-12 updateColumn">
            <p href=""class="update-card" data-bs-toggle="modal" data-bs-target="#updateRecord"></p>
            
            <p href=""class="delete-card" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" id="close"></p>   
            
            <div class="modal fade" id="deleteRecordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form name="deleteRecord" id="deleteRecord">
                    <div class="modal-body">
                      <div class="row">
                        <h6 class="text-center">Are you sure want to delete?</h6>
                        <input type="hidden" name="demail" value="" id="demail">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" value="Ok" class="btn btn-danger">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>           
          </div>
        </div>
      </div>
  <?php
    include_once 'includes/footer.php';
  }else{
    header("Location:index.php");
  }
?>

<script>
  $(document).ready(function(){
    function approved_record_view(){
      $.ajax({
        url:"approve-record-view.php",
        method: "POST",
        data: {'type_user': 1},
        success: function(data){
          $('#approved_record').html(data);
          $('#approved_record_std').html(data);
          $('#approved_record_std .deleteRecord').addClass('hide');
        }
      });              
    }
    approved_record_view();
    $(document).on('click','.rejectRecord',function(){
        let email = $(this).data('id');
        $.ajax({
            url: "reject-record.php",
            method: "POST",
            data: {'email':email,'type_user':4},
            success: function(data){
                if(data == 1){
                    $('.success-message').text('Successfully rejected.').addClass('alert-success').removeClass('alert-danger').fadeIn().fadeOut(3000);
                    approved_record_view();
                }else{
                    $('.success_approve').text('Can\'t be rejected.').addClass('alert-danger').removeClass('alert-success').fadeIn().fadeOut(3000);
                }
            }
        });
    });
    // Modal
    $(document).on('click','.updateRecord',function(){
        let email = $(this).data('id');
        $.ajax({
            url: "update-record-fetch.php",
            method: "POST",
            data: {'email':email, 'type_user': 1},
            success: function(data){
              $('.updateColumn').append(data);
              $('.update-card').trigger('click');
            }
        });
    });
    // Update Record
    $(document).on('submit','#updateForm',function(e){
        e.preventDefault();
        let fName = $('#ufname').val();
        let lName = $('#ulname').val();
        let phone = $('#uphone').val();

        if((fName != '') && (lName != '') && (phone != '')){
            $.ajax({
                url: "update-record.php",
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data){
                  if(data.success){
                    $('.btn-close').trigger('click');
                    $('.success-message').text(data.msg).addClass('alert-success').removeClass('alert-danger').fadeIn().fadeOut(3000);
                    approved_record_view();
                  }
                  if(data.error){
                    $('#msg').text(data.msg).addClass('alert-danger').removeClass('alert-success').fadeIn().fadeOut(3000);
                  } 
                }
            });
        }else{
          $('#msg').text('All field are required.').addClass('alert-danger').fadeIn().fadeOut(3000);
          $('input[type=text]').css('border','1px solid red');
        }
        
    });
    // Modal
    $(document).on('click','.deleteRecord',function(){
      var email = $(this).data('id');
      $('.delete-card').trigger('click');
      $('#deleteRecord #demail').attr('value',email);
    });
    // Delete Record
    $(document).on('submit','#deleteRecord',function(e){
      e.preventDefault();
      $.ajax({
          url: "delete-record.php",
          method: "POST",
          data: new FormData(this),
          dataType: "json",
          processData: false,
          contentType: false,
          success: function(data){
            
            if(data.success){
              $('.btn-close').trigger('click');
              $('.success-message').text(data.msg).addClass('alert-success').removeClass('alert-danger').fadeIn().fadeOut(3000);
              approved_record_view();
            }
            if(data.error){
              $('.btn-close').trigger('click');
              $('.success-message').addClass('alert-danger').removeClass('alert-success').text(data.msg).fadeIn().fadeOut(3000);
            } 
          }
        });
      
    });

    
  });
</script>