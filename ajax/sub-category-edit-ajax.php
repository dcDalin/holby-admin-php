<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $subCategoryId = trim($_POST['subCategoryId']);
    $subCategoryName = ucfirst(strtolower(trim($_POST['subCategoryName'])));

    $response = array();

    $query = $common -> Update("
      UPDATE tbl_sub_category SET subCategoryName = '".$subCategoryName."' WHERE id = '".$subCategoryId."'
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not edit new sub category'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'Sub category edited. Reloading...';
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