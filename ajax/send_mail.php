<?php

function send_mail2($email,$message,$subject,$EMAIL_USERNAME,$EMAIL_PASSWORD){						
  require_once('../sys/mailer/class.phpmailer.php');
  $mail = new PHPMailer();
  $mail->IsSMTP(); 
  $mail->SMTPDebug  = 0;                     
  $mail->SMTPAuth   = true;                  
  $mail->SMTPSecure = "ssl";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 465;             
  $mail->AddAddress($email);
  $mail->Username=$EMAIL_USERNAME;  
  $mail->Password=$EMAIL_PASSWORD;            
  $mail->SetFrom($EMAIL_USERNAME,' Holby Training Solutions');
  $mail->AddReplyTo($EMAIL_USERNAME, "Holby Training Solutions");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
}

?>