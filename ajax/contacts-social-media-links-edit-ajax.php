<?php

include_once('../sys/core/init.inc.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $id = 1;
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];

    $response = array();

    $query = $common -> Update("
      UPDATE tbl_contacts_social SET
        facebook='".$facebook."',
        twitter='".$twitter."',
        instagram='".$instagram."',
        phoneNumber='".$phoneNumber."',
        email='".$email."'
      WHERE 
        id='".$id."'
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not update description'; 
    }else if($query){
      $response['status'] = 'success';
      $response['message'] = 'Contacts | Social Media Links successfuly updated. Reloading...';
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