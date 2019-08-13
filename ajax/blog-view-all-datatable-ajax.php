<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
    header("Location: index"); /* Redirect browser */
    exit();
  }
  
  $results = $common -> GetRows("
    SELECT
      tbl_admin.id, tbl_admin.firstName, tbl_admin.lastName,
      tbl_blog.id AS blog_id, tbl_blog.thumbnail, tbl_blog.blogger_id, tbl_blog.blog_title, tbl_blog.blog_body, tbl_blog.isActive

    FROM 
      tbl_admin, tbl_blog

    WHERE
      tbl_admin.id = tbl_blog.blogger_id
  ");
  $total_rows = $common -> CCGetDBValue("SELECT COUNT(*) FROM tbl_blog ");
  foreach ($results as $row){
    $id = $row['blog_id'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
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
        <br>
        By: <strong>'.$firstName.' '.$lastName.'</strong>
      ', 
      "status" => $status,
      "actions" => '
        <a href="blog-edit?id='.$id.'" title="Edit or Delete Blog">
          <span class="label label-warning">
            Edit | Delete | Activate
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