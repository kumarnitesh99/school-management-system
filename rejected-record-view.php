<?php
    $type_user = $_POST['type_user'];
    require_once 'config/database.php';
    $obj =  new database();
    $obj->rejectedUser($type_user);
    $result = $obj->getResult();
    $sn = 0;
    $data = "";
    if($result == '0'){
      $data .= "<tr><td colspan='6'>No records found.</td></tr>";
    }else{
      foreach ($result as $value) {
        $sn++;
        $data .= "<tr>
          <td>$sn</td>
          <td>{$value['first_name']} {$value['last_name']}</td>
          <td>{$value['email']}</td>
          <td>{$value['phone']}</td>";
          if($value['image'] != ''){
            $data .= "<td><img src='images/{$value['image']}' height='40px', width='40px'></td>";
          }else{
            $data .="<td><img src='images/dummy.jpg' height='40px', width='40px'></td>";
          }
          $data.= "<td>
          <button type='button' class='btn btn-primary approveRecord' data-id='{$value['email']}'>Approve</button>
          </td>
        </tr>";
      }
    }

    echo $data;
?>                