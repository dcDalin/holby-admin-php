<?php

include_once('../sys/core/init.inc.php');
include_once('send_mail.php');

$common = new common();
if(filter_has_var(INPUT_POST, 'btn-create-admin')){
  try {
    $firstName = ucfirst(strtolower(trim($_POST['firstName'])));
    $lastName = ucfirst(strtolower(trim($_POST['lastName'])));
    $email = strtolower(trim($_POST['email']));
    $gender = trim($_POST['gender']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $idNumber = trim($_POST['idNumber']);

    $user_password = substr(md5(microtime()),rand(0,26),6);
    $password = md5($user_password);

    $response = array();

    // Check if email and password are correct 
    $query = $common -> Insert("
      INSERT INTO tbl_admin (firstName, lastName, email, gender, phoneNumber, idNumber, pass)
      VALUES ('".$firstName."', '".$lastName."','".$email."','".$gender."','".$phoneNumber."','".$idNumber."','".$password."')
    ");
    if(!$query){
      $response['status'] = 'error'; // could not create user
      $response['message'] = 'Sorry, Could not create new Admin'; 
    }else if($query){
      $message= "
        Hello $firstName
        <br /><br />
        Your Holby Training Solutions Admin Account has been created
        <br /><br />
        Below is your password, be sure to change it
        <br /><br />
        $user_password
        <br /><br />
        Thank you 
      ";
      $subject = "Holby Training Solutions Admin Account Creation";
  
      $sendMail = send_mail2($email,$message,$subject,$EMAIL_USERNAME,$EMAIL_PASSWORD, $EMAIL_HOST, $EMAIL_PORT);
      if($sendMail == 1){
        $response['status'] = 'success';
        $response['message'] = 'New Admin successfuly created. Reloading...';
      }else {
        $response['status'] = 'error';
        $response['message'] = 'Could not send email';
      }
    } 
    echo json_encode($response);
    exit;
  }catch(Exception $e){
    $response['status'] = 'exception'; 
    $response['message'] = $e; 
    echo json_encode($response);
  } 
}
?>