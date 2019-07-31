<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-create-blog')){
  try {
    $id = intval($_POST['blogId']);
    $blogTitle = trim($_POST['blogTitle']);
    $blogBody = $_POST[ 'blogBody' ];

    $response = array();

    if(strlen($blogBody) <= 200){
      $response['status'] = 'error'; 
      $response['message'] = 'Blog should be at least 200 characters'; 
    }else {
      $sql = $common -> Update("
        UPDATE tbl_blog
        SET
          blog_title='".$blogTitle."',
          blog_body='".$blogBody."',
          isActive='N'
        WHERE
          id='".$id."'
      ");

      if($sql){
        $response['status'] = 'success'; 
        $response['message'] = 'Blog successfuly updated. Reloading...'; 
      }else if(!$sql){
        $response['status'] = 'error'; 
        $response['message'] = 'Could not update the blog'; 
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