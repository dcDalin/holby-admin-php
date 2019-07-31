<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
  header("Location: index"); /* Redirect browser */
  exit();
}

/* Start ajax login process */

  try {
    $id = intval($_SESSION['blogId']);
    $response = array();

    $sql = $common -> Delete("
      UPDATE tbl_blog SET isActive='Y' WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Blog successfuly activated. Redirecting...'; 
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not activate the blog'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>