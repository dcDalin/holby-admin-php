<?php

function send_mail2($email,$message,$subject,$EMAIL_USERNAME,$EMAIL_PASSWORD, $EMAIL_HOST, $EMAIL_PORT){						
  require_once('../sys/mailer/class.phpmailer.php');
  $mail = new PHPMailer();
  $mail->IsSMTP(); 
  $mail->SMTPDebug  = 0;                      
  $mail->SMTPAuth   = true;                  
  $mail->SMTPSecure = "";                 
  $mail->Host = $EMAIL_HOST;
  $mail->Port = $EMAIL_PORT;             
  $mail->AddAddress($email);
  $mail->Username=$EMAIL_USERNAME;  
  $mail->Password=$EMAIL_PASSWORD;            
  $mail->SetFrom($EMAIL_USERNAME,' Holby Training Solutions');
  $mail->AddReplyTo($EMAIL_USERNAME, "Holby Training Solutions");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  if($mail->Send()){
    return true;
  }else {
    return false;
  };
}


?>