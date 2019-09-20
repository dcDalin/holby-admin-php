<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $categoryName = ucfirst(strtolower(trim($_POST['categoryName'])));

    $response = array();

    $query = $common -> Insert("
      INSERT INTO tbl_category (categoryName)
      VALUES ('".$categoryName."')
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not create new category'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'New category type successfuly created. Reloading...';
    } 
    echo json_encode($response);
    exit;
  }catch(Exception $e){
    $response['status'] = 'error'; 
    $response['message'] = $e; 
    echo json_encode($response);
  } 
}
?>