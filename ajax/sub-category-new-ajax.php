<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $categoryId = trim($_POST['categoryName']);
    $subCategoryName = ucfirst(strtolower(trim($_POST['subCategoryName'])));

    $response = array();

    $query = $common -> Insert("
      INSERT INTO tbl_sub_category (categoryId, subCategoryName)
      VALUES ('".$categoryId."', '".$subCategoryName."')
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not create new sub category'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'New sub category created. Reloading...';
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