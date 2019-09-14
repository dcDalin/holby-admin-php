<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
  header("Location: index"); /* Redirect browser */
  exit();
}

/* Start ajax login process */

  try {
    $id = intval($_SESSION['consultancyId']);
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_consultancy WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Consultancy type successfuly deleted. Redirecting...'; 
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the consultancy type'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>