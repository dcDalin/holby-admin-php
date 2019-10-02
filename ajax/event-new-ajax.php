<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $venue = trim($_POST['venue']);
    $date = trim($_POST['date']);
    $startTime = trim($_POST['startTime']); 
    $endTime = trim($_POST['endTime']);
    $price = trim($_POST['price']);

    $imgFile = $_FILES['thumbnail']['name'];
    $tmp_dir = $_FILES['thumbnail']['tmp_name'];
    $imgSize = $_FILES['thumbnail']['size']; 

    $response = array();

    $upload_dir = '../uploads/event_thumbnails/'; // upload directory

    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    
    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
    // rename uploading image
    $userpic = rand(1000,1000000).".".$imgExt;
      
    // allow valid image file formats
    if(in_array($imgExt, $valid_extensions)){   
      // Check file size '5MB'
      if($imgSize < 10000000)    {
        move_uploaded_file($tmp_dir, $upload_dir.$userpic);
      }
      else{
        $response['status'] = 'error'; 
        $response['message'] = 'Image file is too big'; 
      }
    }
    else{
      $response['status'] = 'error'; 
      $response['message'] = 'Only JPG, JPEG, PNG & GIF files are allowed'; 
    }

    $sql = $common -> Insert("
      INSERT INTO `tbl_event` (`title`, `description`, `venue`, `date`, `startTime`, `endTime`, `thumbnail`, `price`) 
      VALUES ('".$title."', '".$description."', '".$venue."', '".$date."', '".$startTime."', '".$endTime."', '".$userpic."', '".$price."')
    ");

    if($sql){
      $response['status'] = 'success'; 
      $response['message'] = 'Event successfuly created'; 
    }else if(!$sql){
      $response['status'] = 'error'; 
      $response['message'] = 'Could not create the event'; 
    } 
    echo json_encode($response);
    exit;
  }catch(Exception $e){
      echo $e;
  }

}
/* End ajax login process */
?>