<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $title = ucfirst(strtolower(trim($_POST['consultancyTitle'])));
    $description = ucfirst(strtolower(trim($_POST['description'])));

    $response = array();

    $query = $common -> Insert("
      INSERT INTO tbl_consultancy (title, description)
      VALUES ('".$title."', '".$description."')
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not create new consultancy type'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'New consultancy type successfuly created. Reloading...';
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