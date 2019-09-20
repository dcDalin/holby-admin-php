<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  } 
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_team
  ");
  $total_rows = $common -> CCGetDBValue("SELECT COUNT(*) FROM tbl_team ");

  // if user got no blogs 
  if($total_rows < 1){
    $course_arr[] = array(
      "thumbnail" => '<strong>No partners present...</strong>', 
      "name" => '',
      "bio" => '',
      "roles" => '',
      "actions" => ''
    );
  }

  foreach ($results as $row){
    $id = $row['id'];
    $name = $row['name'];
    $bio = $row['bio'];
    $isPartner = $row['isPartner'];
    $isTrainer = $row['isTrainer'];
    $isConsultant = $row['isConsultant'];
    $thumbnail = $row['image'];

    if($isPartner == 'Yes'){
      $partner = 'Partner';
    }else {
      $partner = '';
    }

    if($isTrainer == 'Yes'){
    $trainer = 'Trainer';
    } else {
      $trainer = '';
    }

    if($isConsultant == 'Yes'){
      $consultant = 'Consultant';
    } else {
      $consultant = '';
    }

    $course_arr[] = array(
      "thumbnail" => '
        <img src="uploads/team_images/'.$thumbnail.'" height="200px" width="200px"/>
      ', 
      "name" => $name,
      "bio" => $bio,
      "roles" => '
        '.$partner.' '.$trainer.' '.$consultant.'
      ',
      "actions" => '
        &nbsp;
        <a href="teammember-edit?id='.$id.'" name="Edit or Delete Partner Image">
          <span class="label label-warning">
            Edit or Delete
          </span>
        </a>
      '
      );
  }
  $show_arr = array(
    'data' => $course_arr,
  );
  // encoding array to json format    
  echo json_encode($show_arr); 
?>