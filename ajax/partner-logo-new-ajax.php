<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-create-slider')){
  try {
    $name = trim($_POST['name']);

    $imgFile = $_FILES['thumbnail']['name'];
    $tmp_dir = $_FILES['thumbnail']['tmp_name'];
    $imgSize = $_FILES['thumbnail']['size'];

    $response = array();

    $upload_dir = '../uploads/partner_images/'; // upload directory
 
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    
    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
    // rename uploading image
    $userpic = rand(1000,1000000).".".$imgExt;
      
    // allow valid image file formats
    if(in_array($imgExt, $valid_extensions)){   
      // Check file size '5MB'
      if($imgSize < 10000000) {
        $sql = $common -> Insert("
          INSERT INTO tbl_partners (name, logo)
          VALUES ('".$name."', '".$userpic."')
        ");

        if($sql){
          $response['status'] = 'success'; 
          $response['message'] = 'Partner successfuly added'; 

          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }else if(!$sql){
          $response['status'] = 'error'; 
          $response['message'] = 'Could not create partner'; 
        } 
      }else{
        $response['status'] = 'error'; 
        $response['message'] = 'Image file is too big'; 
      }
    }
    else{
      $response['status'] = 'error'; 
      $response['message'] = 'Only JPG, JPEG, PNG & GIF files are allowed'; 
    }
    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }

}
/* End ajax login process */
?>