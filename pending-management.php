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
                      if($cpage == "pending-management.php"){
                        echo "<span class='nav-link'><i class='fa fa-desktop'></i> <a href='index.php'> Dashboard</a>/  <i class='fa fa-user'></i> <a href='management.php'> Management</a> /<i class='fa fa-users'> Pending</i> </span>";
                      }
                    ?>
                  </li>
                </ul>
                
                </ul>
            </div>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-md-12">
          <div class="table-responsive ">
            <div class="card-header d-flex">
              <h4 class="me-auto">Pending Record </h4>
              <span class="me-auto alert-success text-center success-message" style="width:350px;"><b>kj<b></span>
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
              <tbody id="pending_record">
                
              </tbody>
            </table>
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
    function pending_record_view(){
      $.ajax({
        url:"pending-record-view.php",
        method: "POST",
        data: {'type_user': 3},
        success: function(data){
          $('#pending_record').html(data);
        }
      });              
    }
    pending_record_view();
    $(document).on('click','.approveRecord',function(){
        let email = $(this).data('id');
        $.ajax({
            url: "approve-record.php",
            method: "POST",
            data: {'email':email,'type_user':4},
            success: function(data){
                if(data == 1){
                    $('.success-message').text('Successfully approved').fadeIn().fadeOut(3000);
                    pending_record_view();
                }else{
                    $('.success-message').text('Can\'t be approved.').fadeIn().fadeOut(3000);
                }
            }
        });
    });
    $(document).on('click','.rejectRecord',function(){
        let email = $(this).data('id');
        $.ajax({
            url: "reject-record.php",
            method: "POST",
            data: {'email':email,'type_user': 4},
            success: function(data){
                if(data == 1){
                    $('.success-message').text('Successfully rejected.').fadeIn().fadeOut(3000);
                    pending_record_view();
                }else{
                    $('.success_approve').text('Can\'t be rejected.').fadeIn().fadeOut(3000);
                }
            }
        });
    });
  });
  
</script>