<?php

include_once('../sys/core/init.inc.php');
include_once('send_mail.php');

$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-create-blog')){
  try {
    $blogTitle = trim($_POST['blogTitle']);
    $blogBody = $_POST[ 'blogBody' ];

    $response = array();
    
    if(strlen($blogBody) <= 200){
      $response['status'] = 'error'; 
      $response['message'] = 'Blog should be at least 200 characters'; 
    }else {
      $sql = $common -> Insert("
        INSERT INTO tbl_blog (blogger_id, blog_title, blog_body)
        VALUES('".$_SESSION['UID']."', '".$blogTitle."', '".$blogBody."')
      ");

      if($sql){
        $response['status'] = 'success'; 
        $response['message'] = 'Blog successfuly created'; 

        // $message= "
        //   Hello
        //   <br /><br />
        //   A new blog has been created and is inactive. Kindly have a look and activate it so that it shows on the main website.
        //   <br /><br />
        //   <br /><br />
        //   Thank you
        // ";
        // $subject = "Holby Training Solutions | New Blog";
    
        // send_mail2($ADMIN_NOTIFICATIONS_EMAIL,$message,$subject, $EMAIL_USERNAME,$EMAIL_PASSWORD);
      }else if(!$sql){
        $response['status'] = 'error'; 
        $response['message'] = 'Could not create the blog'; 
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