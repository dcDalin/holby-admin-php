<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */

  try { 
    $id = intval($_SESSION['productId']); 
    $response = array();

    $sql = $common -> Delete("
      DELETE FROM tbl_products WHERE id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Product successfuly deleted. Redirecting...'; 

      $thumb = $_SESSION['productThumbnail'];

      unlink("../uploads/product_images/$thumb");
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not delete the product'; 
    } 

    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }


/* End ajax login process */
?>