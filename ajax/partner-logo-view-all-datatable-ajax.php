<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  } 
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_partners
  ");
  $total_rows = $common -> CCGetDBValue("SELECT COUNT(*) FROM tbl_partners ");

  // if user got no blogs 
  if($total_rows < 1){
    $course_arr[] = array(
      "thumbnail" => '<strong>No slider items present...</strong>', 
      "name" => '',
      "actions" => ''
    );
  }

  foreach ($results as $row){
    $id = $row['id'];
    $name = $row['name'];
    $thumbnail = $row['logo'];

    $course_arr[] = array(
      "thumbnail" => '
        <img src="uploads/partner_images/'.$thumbnail.'" height="200px" width="200px"/>
      ', 
      "name" => $name,
      "actions" => '
        &nbsp;
        <a href="partner-logo-edit?id='.$id.'" name="Edit or Delete Partner Image">
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