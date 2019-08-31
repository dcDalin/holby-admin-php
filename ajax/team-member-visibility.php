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
    $meetTheTeam = trim($_POST['meetTheTeam']);
    $partner = trim($_POST['partner']);
    $trainer = trim($_POST['trainer']);
    $consultant = trim($_POST['consultant']);

    $sql = $common -> Update("
      UPDATE tbl_about_visibility
      SET
      meetTheTeam='".$meetTheTeam."',
      partner='".$partner."',
      trainer='".$trainer."',
      consultant='".$consultant."'
      WHERE
      id=1
    ");
    if($sql){
      $response['status'] = 'success';
      $response['message'] = 'Visibility successfuly updated. Reloading...';
    }else if(!$sql){
      $response['status'] = 'error';
      $response['message'] = 'Could not update visibility';
    }
    echo json_encode($response);
    exit;
  }catch(Exception $e){
  echo $e;
  }
}
  /* End ajax login process */
  ?>