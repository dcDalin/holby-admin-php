<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */

  try {
    $id = intval($_SESSION['courseId']);
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_course WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Course successfuly deleted. Redirecting...'; 

      $thumb = $_SESSION['courseThumbnail'];

      unlink("../uploads/course_thumbnails/$thumb");
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the course'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>