<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  } 
  
  $results = $common -> GetRows("
    SELECT
      tbl_admin.id, tbl_admin.firstName, tbl_admin.lastName,
      tbl_course.id AS course_id, tbl_course.created_by, tbl_course.title, tbl_course.months, tbl_course.days, tbl_course.hours, tbl_course.minutes, tbl_course.level, tbl_course.thumbnail

    FROM 
      tbl_admin, tbl_course

    WHERE
      tbl_admin.id = tbl_course.created_by
  ");
  $total_rows = $common -> CCGetDBValue("SELECT COUNT(*) FROM tbl_course ");
  foreach ($results as $row){
    $id = $row['course_id'];
    $title = $row['title'];
    $months = $row['months'];
    $days = $row['days'];
    $hours = $row['hours'];
    $minutes = $row['minutes'];
    $level = $row['level'];
    $thumbnail = $row['thumbnail'];

    $course_arr[] = array(
      "thumbnail" => '
        <img src="uploads/course_thumbnails/'.$thumbnail.'" height="100px" width="80px"/>
      ', 
      "title" => $title,
      "duration" => '
        '.$months.' Months, '.$days.' Days, '.$hours.' Hours, '.$minutes.' Minutes,
      ',
      "level" => $level,
      "actions" => '
        &nbsp;
        <a href="course-edit?id='.$id.'" title="Edit or Delete Course">
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