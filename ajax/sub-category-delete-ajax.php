<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
  header("Location: index"); /* Redirect browser */
  exit();
}

/* Start ajax login process */

  try { 
    $id = intval($_SESSION['subCategoryId']);
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_sub_category WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Sub Category successfuly deleted. Redirecting...'; 
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete sub category'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>