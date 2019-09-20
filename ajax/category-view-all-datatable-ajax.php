<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  }
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_category
  ");
  $total_rows = $common -> CCGetDBValue("
    SELECT COUNT(*) FROM tbl_category
  ");

  if($total_rows < 1){ 
    $blog_arr[] = array(
      "categoryName" => '<strong>No Categories Present</strong>', 
      "actions" => ''
    );
  }

  foreach ($results as $row){ 
    $id = $row['id'];
    $categoryName = $row['categoryName'];

    $blog_arr[] = array(
      "categoryName" => '
        <strong>'.$categoryName.'</strong>
      ', 
      "actions" => '
        <a href="category-edit?id='.$id.'" categoryName="Edit or Delete Category Type">
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