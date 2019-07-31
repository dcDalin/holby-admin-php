<?php

/* Start Original Scripts */
include_once('sys/core/init.inc.php');

$common = new common();

// Check if user is logged in, else redirect
if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
}


$id = $_SESSION['UID'];
$results = $common -> GetRows("
  SELECT 
    tbl_admin.id AS administratorId,
    tbl_admin_level.id AS adminLevelId, tbl_admin_level.adminLevelName,
    tbl_admin_and_role_link.id as roleLinkId, tbl_admin_and_role_link.admin_id, tbl_admin_and_role_link.admin_level_id

  FROM
    tbl_admin, tbl_admin_level, tbl_admin_and_role_link

  WHERE
    tbl_admin.id=tbl_admin_and_role_link.admin_id

  AND 
    tbl_admin_and_role_link.admin_level_id=tbl_admin_level.id

  AND 
    tbl_admin.id='".$id."'
");

foreach ($results as $row){
  $userId = $row['administratorId'];
  $adminLevelName = $row['adminLevelName'];
  $adminLevelId = $row['adminLevelId'];

  // echo $adminLevelId;
  $auth_users_arr[] = array(
      "userId" => $userId, 
      "adminLevelName" => $adminLevelName, 
      "adminLevelId" => $adminLevelId
  );
}

function authSearchAdminRole($id, $auth_users_arr) {
  foreach ($auth_users_arr as $key => $val) {
      if ($val['adminLevelId'] === $id) {
          return 'true';
      }
  }
  return 'false';
}
$authIsAdmin = authSearchAdminRole('1', $auth_users_arr);
$authIsPartner = authSearchAdminRole('2', $auth_users_arr);
$authIsTrainer = authSearchAdminRole('3', $auth_users_arr);
$authIsConsultant = authSearchAdminRole('4', $auth_users_arr);
$authIsBlogger = authSearchAdminRole('5', $auth_users_arr);
?>