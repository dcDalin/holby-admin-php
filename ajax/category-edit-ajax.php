<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $id = $_POST['categoryId'];
    $categoryName = ucfirst(strtolower(trim($_POST['categoryName'])));

    $response = array();

    $query = $common -> Update("
      UPDATE tbl_category SET 
        categoryName='".$categoryName."'
      WHERE 
        id='".$id."'
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not update category'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'Category successfuly updated. Reloading...';
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