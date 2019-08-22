<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */

  try {
    $id = intval($_SESSION['testimonialId']);
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_testimonials WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Testimonial successfuly deleted. Redirecting...'; 

      $thumb = $_SESSION['sliderThumbnail'];

      unlink("../uploads/testimonial_images/$thumb");
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the Testimonial'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>