<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  }
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_consultancy
  ");
  $total_rows = $common -> CCGetDBValue("
    SELECT COUNT(*) FROM tbl_consultancy
  ");

  // if user got no blogs  
  if($total_rows < 1){ 
    $blog_arr[] = array(
      "title" => '<strong>No Consultancy Types</strong>', 
      "description" => '',
      "actions" => ''
    );
  }

  foreach ($results as $row){ 
    $id = $row['id'];
    $title = $row['title'];
    $description = $row['description'];

    $blog_arr[] = array(
      "title" => '
        <strong>'.$title.'</strong>
      ', 
      "description" => $description,
      "actions" => '
        <a href="consultancy-edit?id='.$id.'" title="Edit or Delete Consultancy Type">
          <span class="label label-warning">
            Edit or Delete
          </span>
        </a>
      '
    );
  }
  $show_arr = array(
    'data' => $blog_arr,
  );
  // encoding array to json format    
  echo json_encode($show_arr); 
?>