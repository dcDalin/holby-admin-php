<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $id = 1;
    $description = ucfirst(strtolower(trim($_POST['description'])));

    $response = array();

    $query = $common -> Update("
      UPDATE tbl_executive_coaching_description SET
        description='".$description."'
      WHERE 
        id='".$id."'
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not update description'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'Description successfuly updated. Reloading...';
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