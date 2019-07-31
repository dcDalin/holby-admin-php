<?php

include_once('../sys/core/init.inc.php');
include_once('send_mail.php');

$common = new common();

if(filter_has_var(INPUT_POST, 'btn-reset-pass')){
  try {
    $email = trim($_POST['email']);
    $response = array();

    // Check if email exists
    $getALevel = $common -> GetRows("
        SELECT * FROM tbl_admin WHERE email='".$email."' AND isActive=1 LIMIT 1
    ");
    if(!$getALevel){
      $response['status'] = 'error'; // Email not found
      $response['message'] = 'Sorry, email address doesn\'t exist'; 
    }else if($getALevel){ 
      foreach($getALevel as $A){
        $_SESSION['resetID'] = $A["id"];
        $_SESSION['resetFirstName'] = $A["firstName"];
      }
      
      $userFirstName = $_SESSION['resetFirstName'];
      $id = base64_encode($_SESSION['resetID']);
      $code = md5(uniqid(rand()));

      $updateTokenCode = $common -> GetRows("
        UPDATE tbl_admin SET tokenCode = '".$code."' WHERE email='".$email."'
      ");
      if(!$updateTokenCode){
        $response['status'] = 'success'; // Log in successful
        $response['message'] = 'Check your email for reset link'; 

        $message= "
          Hello $userFirstName
          <br /><br />
          Want to reset your password? You do so by clicking the link below
          <br /><br />
          Click Following Link To Reset Your Password 
          <br /><br />
          <a href='$WEBSITE_URL/resetpass?id=$id&code=$code'>click here to reset your password</a>
          <br /><br />
          thank you :)
        ";
        $subject = "Password Reset";

        send_mail2($email,$message,$subject,$EMAIL_USERNAME,$EMAIL_PASSWORD);
      }else{
        $response['status'] = 'unknown'; // Log in successful
        $response['message'] = 'Unknown error occured'; 
      }                
    } 
    echo json_encode($response);
    exit;
  }catch(Exception $e){
    echo $e;
  }
}
/* End ajax login process */
?>