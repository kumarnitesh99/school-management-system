<?php
    $email = $_POST['email'];
    $type_user = $_POST['type_user'];

    require_once 'config/database.php';
    $obj = new database();
    $obj->fetchRecordUpadte($email,$type_user);
    $record = $obj->getResult();
    
    $data .="<div class='modal fade' id='updateRecord' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form name='updateForm' id='updateForm'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='staticBackdropLabel'>Update Record</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='form-row mb-2'>
                            <div class='col-lg-12 py-2 text-center hide' id='msg'>
                                
                            </div>
                        </div>
                        <div class='form-row mb-2'>
                            <div class='col-lg-12'>
                                <input id='ufname' name='firstName' type='text' placeholder='First name' class='form-control p-2' value='{$record[0][first_name]}'>
                            </div>
                        </div>

                        <div class='form-row mb-2'>
                            <div class='col-lg-12'>
                                <input id='ulname' name='lastName' type='text' placeholder='Last name' class='form-control p-2' value='{$record[0][last_name]}'>
                            </div>
                        </div>

                        <div class='form-row mb-2'>
                            <div class='col-lg-12'>
                                <input id='uemail' name='email' type='hidden' placeholder='Email' class='form-control p-2' value='{$record[0][email]}'>
                            </div>
                        </div>

                        <div class='form-row mb-2'>
                            <div class='col-lg-12'>
                                <input id='uphone' name='phone' type='text' placeholder='Phone' class='form-control p-2' value='{$record[0][phone]}'>
                            </div>
                        </div>

                        <div class='form-row mb-2'>
                            <div class='col-lg-12'>
                                <input type='file' name='uimage' id='image'}' class='form-control p-2'>
                            </div>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <input type='submit' value='Update' class='btn btn-primary' name='management-update' id='updatemanagementbtn'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            
          </div>";

    echo $data;
    
?>