<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  } 
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_event
  ");

  foreach ($results as $row){
    $id = $row['id'];
    $title = $row['title'];
    $description = $row['description'];
    $venue = $row['venue'];
    $date = $row['date'];
    $startTime = $row['startTime'];
    $endTime = $row['endTime'];
    $price = $row['price'];
    $thumbnail = $row['thumbnail'];

    $course_arr[] = array(
      "thumbnail" => '
        <img src="uploads/event_thumbnails/'.$thumbnail.'" height="100px" width="80px"/>
      ', 
      "title" => $title,
      "description" => $thumbnail,
      "venue" => $venue,
      "date" => $date,
      "startTime" => $startTime,
      "endTime" => $endTime,
      "price" => $price,
      "actions" => '
        &nbsp;
        <a href="event-edit?id='.$id.'">
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