<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */

  try { 
    $id = intval($_SESSION['eventId']); 
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_event WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Event successfuly deleted. Redirecting...'; 

      $thumb = $_SESSION['eventThumbnail'];

      unlink("../uploads/event_thumbnails/$thumb");
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the event'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>