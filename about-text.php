<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  $id = 1;
  $result = $common -> GetRows("
    SELECT * FROM tbl_about_text WHERE id='".$id."'
  ");

  foreach($result as $row){
    $text = $row['text'];
  }

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | About Text
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
          About Text
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form method="post" id="new-blog-form">
              <div id="errorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="row">
                <div class="col-md-12" id="blogBodyWrapper">
                  <div class="form-group">
                    <label>About Text</label>
                    <textarea class="required form-control" name="blogBody" id="blogBody" rows="10" cols="80">
                    <?php echo $text; ?>
                    </textarea>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-blog"
                      id="btn-create-blog">
                      Update
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
  <script type="text/javascript" src="ajax-js/about-text.js"></script>

</body>

</html>