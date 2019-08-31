<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

/* Start ajax login process */
if(filter_has_var(INPUT_POST, 'btn-create-team-member')){
  try {
    $id = intval($_POST['teamMemberId']);
    $thumbnail = trim($_POST['partnerThumbnail']);
    $name = trim($_POST['name']);
    $bio = trim($_POST['bio']);
    $isPartner = trim($_POST['isPartner']);
    $isTrainer = trim($_POST['isTrainer']);
    $isConsultant = trim($_POST['isConsultant']);

    $imgFile = $_FILES['thumbnail']['name'];
    $tmp_dir = $_FILES['thumbnail']['tmp_name'];
    $imgSize = $_FILES['thumbnail']['size'];

    $response = array();

    if(empty($imgFile)){
      $sql = $common -> Update("
        UPDATE tbl_team
        SET
          name='".$name."',
          isPartner='".$isPartner."',
          isTrainer='".$isTrainer."',
          isConsultant='".$isConsultant."',
          bio='".$bio."'
        WHERE 
          id='".$id."'
      ");
      if($sql){
        $response['status'] = 'success'; 
        $response['message'] = 'Team member successfuly updated. Reloading...';
      }else if(!$sql){
        $response['status'] = 'error'; 
        $response['message'] = 'Could not update the Team Member'; 
      } 
    }else {
      
      $upload_dir = '../uploads/team_images/'; // upload directory
      
      $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
      
      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      
      // rename uploading image
      $userpic = rand(1000,1000000).".".$imgExt;
        
      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions)){   
        // Check file size '5MB'
        if($imgSize < 10000000) {
          unlink("../uploads/team_images/$thumbnail");
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
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
      
      $sql = $common -> Update("
        UPDATE tbl_team
        SET
          name='".$name."',
          isPartner='".$isPartner."',
          isTrainer='".$isTrainer."',
          isConsultant='".$isTrainer."',
          bio='".$bio."',
          image='".$userpic."'
        WHERE
          id='".$id."'
      ");
  
      if($sql){
        $response['status'] = 'success'; 
        $response['message'] = 'Team member successfuly updated. Reloading...'; 
      }else if(!$sql){
        $response['status'] = 'error'; 
        $response['message'] = 'Could not update the partner logo'; 
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