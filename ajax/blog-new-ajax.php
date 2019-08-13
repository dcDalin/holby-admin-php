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

    $imgFile = $_FILES['thumbnail']['name'];
    $tmp_dir = $_FILES['thumbnail']['tmp_name'];
    $imgSize = $_FILES['thumbnail']['size'];

    $response = array();

    $upload_dir = '../uploads/blog_thumbnails/'; // upload directory

    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

    // rename uploading image
    $userpic = rand(1000,1000000).".".$imgExt;
    
    if(strlen($blogBody) <= 200){
      $response['status'] = 'error'; 
      $response['message'] = 'Blog should be at least 200 characters'; 
    } else {
      if(in_array($imgExt, $valid_extensions)){
        if($imgSize < 10000000) { 
          move_uploaded_file($tmp_dir,$upload_dir.$userpic); 
        } else { 
          $response['status']='error' ; 
          $response['message']='Image file is too big' ; 
        } 
      } else{ 
        $response['status']='error' ; 
        $response['message']='Only JPG, JPEG, PNG & GIF files are allowed' ; 
      }

      $sql = $common -> Insert("
        INSERT INTO tbl_blog (blogger_id, thumbnail, blog_title, blog_body)
        VALUES('".$_SESSION['UID']."', '".$userpic."', '".$blogTitle."', '".$blogBody."')
      ");

      if($sql){
        $response['status'] = 'success'; 
        $response['message'] = 'Blog successfuly created'; 

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