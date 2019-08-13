<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];

  // Check if active session is same as blogger id
  $checker = $common -> CCGetDBValue("
    SELECT COUNT(*) FROM tbl_blog WHERE blogger_id='".$_SESSION['UID']."'
  ");

  if ($checker || in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
    $result = $common -> GetRows("
      SELECT * FROM tbl_blog WHERE id='".$id."'
    ");

    foreach($result as $row){
      $blogTitle = $row['blog_title'];
      $blogBody = $row['blog_body'];
      $isActive = $row['isActive'];
      $thumbnail = $row['thumbnail'];
    }
  }else {
    header("Location: blog-view");
  }
}
else
{ 
  header("Location: blog-view");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Edit | Delete Blog
  </title>
  <?php 
		include 'inc/inc.meta.php';
		?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div id="wrapper-logout" style="display:none; padding:30px;">
  </div>

  <div class="wrapper" id="wrapper">
    <?php 
			include 'inc/inc.main-header.php';
			?>
    <?php 
			include 'inc/inc.main-sidebar.php';
			?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Edit | Delete Blog
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Blog</h3>
            <div class="box-tools pull-right">
              <div class="row">
                <?php
                if(in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)){
              ?>
                <div class="col-md-12">
                  <?php 
                    $_SESSION['blogId'] = $id;
                    $_SESSION['blogThumbnail'] = $thumbnail;
                  ?>
                  <?php 
                    if($isActive == 'Y') {
                      ?>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-warning btn-block btn-flat" name="btn-deactivate-blog"
                      id="btn-deactivate-blog">
                      Deactivate
                    </button>
                  </div>
                  <?php
                    } else if($isActive == 'N') {
                      ?>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-block btn-flat" name="btn-activate-blog"
                      id="btn-activate-blog">
                      Activate
                    </button>
                  </div>
                  <?php
                    }
                  ?>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-blog"
                      id="btn-delete-blog">
                      Delete
                    </button>
                  </div>
                </div>

                <?php
                } else {
                  ?>
                <div class="col-md-12">
                  <?php 
                    if($isActive == 'Y') {
                      ?>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-warning btn-block btn-flat disabled">
                      Deactivate
                    </button>
                  </div>
                  <?php
                    } else if($isActive == 'N') {
                      ?>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-block btn-flat disabled">
                      Activate
                    </button>
                  </div>
                  <?php
                    }
                  ?>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-danger btn-block btn-flat disabled">
                      Delete
                    </button>
                  </div>
                </div>
                <?php
                }
              ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" enctype="multipart/form-data" id="edit-blog-form">
                <div id="errorDiv">
                  <!-- error will be shown here ! -->
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" placeholder="Title of the blog" name="blogTitle"
                        id="blogTitle" value="<?php echo $blogTitle; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12" id="blogBodyWrapper">
                    <div class="form-group">
                      <label>Blog Body</label>
                      <textarea class="required form-control" name="blogBody" id="blogBody" rows="10" cols="80">
                      <?php echo $blogBody; ?>
                    </textarea>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div>
                    <input type="hidden" name="blogId" id="blogId" value="<?php echo $id; ?>" />
                    <input type="hidden" name="blogThumbnail" value="<?php echo $thumbnail; ?>" />
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Current Thumbnail</label>
                        <img src="uploads/blog_thumbnails/<?php echo $thumbnail; ?>" height="100px" width="180px" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>New Thumbnail?</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-blog"
                        id="btn-create-blog">
                        Edit Blog
                      </button>
                    </div>
                  </div>
                </div>

                <div class="col-md-12" id="blogBodyWrapper">
                  <div class="form-group">
                  </div>
                </div>
                <!-- /.row -->
              </form>
            </div>
      </section>


    </div>
    <?php 
			include 'inc/inc.main-footer.php';
			?>
    <!-- Wrapper end div -->
  </div>

  <?php include 'inc/inc.loggedin.footer.meta.php'; ?>
  <script src="ckeditor/ckeditor.js"></script>
  <script src="ckeditor/adapters/jquery.js"></script>
  <script>
  $('#blogBody').ckeditor();
  </script>
  <script type="text/javascript" src="ajax-js/blog-edit.js"></script>
  <script type="text/javascript" src="ajax-js/blog-delete.js"></script>
  <script type="text/javascript" src="ajax-js/blog-activate.js"></script>
  <script type="text/javascript" src="ajax-js/blog-deactivate.js"></script>

</body>

</html>