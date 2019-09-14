<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php
  if (($authIsBlogger != 'true') && (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL))) {
    header("Location: index"); /* Redirect browser */
    exit();
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Consultancy
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
          Consultancy
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Consultancy Type</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form method="post" id="form">
              <div id="errorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Title of the consultancy type"
                      name="consultancyTitle" id="consultancyTitle">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-12" id="blogBodyWrapper">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="required form-control" name="description" id="description" rows="10"
                      cols="80"></textarea>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-submit" id="btn-submit">
                      Add Consultancy Type
                    </button>
                  </div>
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

  <script type="text/javascript" src="ajax-js/consultancy-new.js"></script>

</body>

</html>