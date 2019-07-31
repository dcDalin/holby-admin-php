<?php

error_reporting(1);
//session_start();
header('Cache-control: private'); // IE 6 FIX
// always modified 
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1 
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0 
header('Pragma: no-cache');

include_once('../sys/core/init.inc.php');
include_once('send_mail.php');

$common = new common();

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-add-role')){
  try {
      $adminLevel = intval($_POST['adminLevel']);
      $adminId = intval($_POST['adminId']);
      $email = trim($_POST['email']);

      $roles = $common -> GetRows("
        SELECT * FROM tbl_admin_level WHERE id='".$adminLevel."'
      ");

      foreach($roles as $row){
        $adminLevelName = $row['adminLevelName'];
      }
    
      $sql = $common -> GetRows("
          SELECT * FROM tbl_admin_and_role_link WHERE admin_id='".$adminId."' AND admin_level_id='".$adminLevel."' 
      ");
      // If record is not found i.e. admin doesn't have that role
      if(!$sql){
        $sql = $common -> Insert("
          INSERT INTO tbl_admin_and_role_link (admin_id, admin_level_id)
          VALUES('".$adminId."', '".$adminLevel."')
        ");

        if($sql){
          $response['status'] = 'success'; 
          $response['message'] = 'Success! Role added and email sent. Reloading...'; 

          $message= "
            Hello 
            <br /><br />
            You have been assigned a new role. The new role is <strong>$adminLevelName</strong>
            <br /><br />
            Thank you
          ";
          $subject = "Holby Training Solutions New Role Added";
      
          send_mail2($email,$message,$subject, $EMAIL_USERNAME,$EMAIL_PASSWORD);

        }else if(!$sql){
          $response['status'] = 'error'; 
          $response['message'] = 'There was an error adding the role'; 
        }
      }else if($sql){
          $response['status'] = 'error'; 
          $response['message'] = 'The selected role already exists'; 
      } 
      echo json_encode($response);
      exit;
  }catch(Exception $e){
    $response['status'] = 'error';
    $response['message'] = $e;
    echo json_encode($response);
  }
}
/* End ajax login process */

if(filter_has_var(INPUT_POST, 'btn-remove-role')){
  try {
    $adminLevel = intval($_POST['adminLevel']);
    $adminId = intval($_POST['adminId']);
    $email = trim($_POST['email']);

    $roles = $common -> GetRows("
      SELECT * FROM tbl_admin_level WHERE id='".$adminLevel."'
    ");

    foreach($roles as $row){
      $adminLevelName = $row['adminLevelName'];
    }
  
    $sql = $common -> GetRows("
        SELECT * FROM tbl_admin_and_role_link WHERE admin_id='".$adminId."' AND admin_level_id='".$adminLevel."' 
    ");

    foreach($sql as $row){
      $id = $row['id'];
    }
    // If record is found i.e. admin has the role
    if($sql){
      $sql2 = $common -> Delete("
        DELETE FROM tbl_admin_and_role_link WHERE id='".$id."'
      ");

      if($sql2){
        $response['status'] = 'success'; 
        $response['message'] = 'Role has been removed. Reloading...'; 

        $message= "
            Hello 
            <br /><br />
            You have been discharged of a role. The said role is <strong>$adminLevelName</strong>
            <br /><br />
            Thank you
          ";
          $subject = "Holby Training Solutions New Role Removed";
      
          send_mail2($email,$message,$subject, $EMAIL_USERNAME,$EMAIL_PASSWORD);

      }else if(!$sql2){
        $response['status'] = 'error'; 
        $response['message'] = 'There was an error removing the role'; 
      }
    }else if(!$sql){
        $response['status'] = 'error'; 
        $response['message'] = 'User does not have the selected role'; 
    } 
    echo json_encode($response);
    exit;
}catch(Exception $e){
  $response['status'] = 'error'; 
  $response['message'] = $e;
}
}

?>