<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  } 
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_testimonials
  ");
  $total_rows = $common -> CCGetDBValue("SELECT COUNT(*) FROM tbl_testimonials ");

  // if user got no blogs 
  if($total_rows < 1){
    $course_arr[] = array(
      "thumbnail" => '<strong>No slider items present...</strong>', 
      "title" => '',
      "slogan" => '',
      "actions" => ''
    );
  }

  foreach ($results as $row){
    $id = $row['id'];
    $title = $row['name'];
    $slogan = $row['testimonial'];
    $thumbnail = $row['image'];

    $course_arr[] = array(
      "thumbnail" => '
        <img src="uploads/testimonial_images/'.$thumbnail.'" height="200px" width="200px"/>
      ', 
      "title" => $title,
      "slogan" => $slogan,
      "actions" => '
        &nbsp;
        <a href="testimonial-edit?id='.$id.'" title="Edit or Delete Testimonial">
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