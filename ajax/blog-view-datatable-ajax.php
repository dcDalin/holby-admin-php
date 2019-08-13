<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  }
  
  $results = $common -> GetRows("
    SELECT * FROM tbl_blog WHERE blogger_id='".$_SESSION['UID']."'
  ");
  $total_rows = $common -> CCGetDBValue("
    SELECT COUNT(*) FROM tbl_blog WHERE blogger_id='".$_SESSION['UID']."'
  ");

  // if user got no blogs  
  if($total_rows < 1){ 
    $blog_arr[] = array(
      "blog" => '<strong>You have no blogs...</strong>', 
      "status" => '',
      "actions" => ''
    );
  }

  foreach ($results as $row){ 
    $id = $row['id'];
    $bloggerId = $row['blogger_id'];
    $blogTitle = $row['blog_title'];
    $blogBody = $row['blog_body'];
    $isActive = $row['isActive'];
    $thumbnail = $row['thumbnail'];

    if ($isActive == 'Y'){
      $status = 'Active';
    }else if ($isActive == 'N'){
      $status = 'Not Active';
    }

    if (strlen($blogBody) > 25) {
      $trimBlogBody = substr($blogBody, 0, 100). '...';
    } else {
      $trimBlogBody = $blogBody;
    }
    
    $blog_arr[] = array(
      "thumbnail" => '
        <img src="uploads/blog_thumbnails/'.$thumbnail.'" height="100px" width="80px" />
      ',
      "blog" => '
        <strong>'.$blogTitle.'</strong>
        <p>'.$trimBlogBody.'</p>
      ', 
      "status" => $status,
      "actions" => '
        <a href="blog-edit?id='.$id.'" title="Edit or Delete Blog">
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