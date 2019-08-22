<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */

  try {
    $id = intval($_SESSION['partnerId']);
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_partners WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Partner successfuly deleted. Redirecting...'; 

      $thumb = $_SESSION['partnerThumbnail'];

      unlink("../uploads/partner_images/$thumb");
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the partner logo'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>