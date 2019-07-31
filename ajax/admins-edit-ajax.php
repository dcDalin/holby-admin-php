<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

// if not super user
if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-edit-admin')){
  try {
    $id=intval($_POST['adminEditId']);
    $firstName = ucfirst(strtolower(trim($_POST['firstName'])));
    $lastName = ucfirst(strtolower(trim($_POST['lastName'])));
    $email = strtolower(trim($_POST['email']));
    $gender = trim($_POST['gender']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $idNumber = trim($_POST['idNumber']);

    $query = $common -> Update("
      UPDATE tbl_admin 
      SET
        firstName='".$firstName."', 
        lastName='".$lastName."', 
        email='".$email."', 
        gender='".$gender."', 
        phoneNumber='".$phoneNumber."', 
        idNumber='".$idNumber."'
      WHERE
        id='".$id."'
    ");

    $response = array();

    if(!$query){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not edit admin '.$firstName.'.'; 
    }else if($query){
      $response['status'] = 'success'; 
      $response['message'] = 'Admin '.$firstName.' has been edited.'; 
    }
    echo json_encode($response);
    exit;
  }catch(Exception $e){
    $response['status'] = 'error'; 
    $response['message'] = $e;
  }
}
/* End ajax login process */
?>