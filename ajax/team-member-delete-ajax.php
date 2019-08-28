<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */

  try {
    
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM `tbl_team` WHERE id='".$_SESSION['teamMemberId']."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Team Member successfuly deleted. Redirecting...'; 

      $thumb = $_SESSION['teamMemberThumbnail'];

      unlink("../uploads/team_images/$thumb");
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the team member'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>