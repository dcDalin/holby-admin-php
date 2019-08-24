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
    $blogBody = $_POST['blogBody'];

    $response = array();

    if(strlen($blogBody) <= 200){
      $response['status'] = 'error'; 
      $response['message'] = 'About text should be at least 200 characters'; 
    }else if(strlen($blogBody) > 200){
      $id = 1;
      $sql = $common -> Update("
        UPDATE tbl_about_text 
          SET text='".$blogBody."' 
        WHERE 
          id=1
      ");

      if($sql){
        $response['status'] = 'success';
        $response['message'] = 'About Text successfuly updated. Reloading...';
      }else if(!$sql){
        $response['status'] = 'error';
        $response['message'] = 'Could not update the text';
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