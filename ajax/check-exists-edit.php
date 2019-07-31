<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
    header("Location: index"); /* Redirect browser */
    exit();
  }

  if ( (isset($_REQUEST['email']) && !empty($_REQUEST['email']) && (isset($_REQUEST['adminEditId']) && !empty($_REQUEST['adminEditId']))) ) {

    $email = trim($_REQUEST['email']);
    $adminEditId = trim($_REQUEST['adminEditId']);
    $id = $common -> GetRows("SELECT email FROM tbl_admin WHERE id='".$adminEditId."'");

    foreach($id as $row){
      $dbemail = $row['email'];
    }

    if($dbemail == $email){
      echo 'true';
    }else {
      $query = $common -> GetRows("SELECT * FROM tbl_admin WHERE email='".$email."'");
      if($query){
        echo 'false';
      }else{
        echo 'true';
      }
    }
  }

	if ( (isset($_REQUEST['phoneNumber']) && !empty($_REQUEST['phoneNumber']) && (isset($_REQUEST['adminEditId']) && !empty($_REQUEST['adminEditId']))) ) {

    $phoneNumber = trim($_REQUEST['phoneNumber']);
    $adminEditId = trim($_REQUEST['adminEditId']);
    $id = $common -> GetRows("SELECT phoneNumber FROM tbl_admin WHERE id='".$adminEditId."'");

    foreach($id as $row){
      $dbphoneNumber = $row['phoneNumber'];
    }

    if($dbphoneNumber == $phoneNumber){
      echo 'true';
    }else {
      $query = $common -> GetRows("SELECT * FROM tbl_admin WHERE phoneNumber='".$phoneNumber."'");
      if($query){
        echo 'false';
      }else{
        echo 'true';
      }
    }
  }
  
  if ( (isset($_REQUEST['idNumber']) && !empty($_REQUEST['idNumber']) && (isset($_REQUEST['adminEditId']) && !empty($_REQUEST['adminEditId']))) ) {

    $idNumber = trim($_REQUEST['idNumber']);
    $adminEditId = trim($_REQUEST['adminEditId']);
    $id = $common -> GetRows("SELECT idNumber FROM tbl_admin WHERE id='".$adminEditId."'");

    foreach($id as $row){
      $dbIdNumber = $row['idNumber'];
    }

    if($dbIdNumber == $idNumber){
      echo 'true';
    }else {
      $query = $common -> GetRows("SELECT * FROM tbl_admin WHERE idNumber='".$idNumber."'");
      if($query){
        echo 'false';
      }else{
        echo 'true';
      }
    }
	}
?>