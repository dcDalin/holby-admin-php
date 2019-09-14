<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];

  if (in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
    $result = $common -> GetRows("
      SELECT * FROM tbl_consultancy WHERE id='".$id."'
    ");

    foreach($result as $row){
      $title = $row['title'];
      $description = $row['description'];
    }
  }else {
    header("Location: consultancy-view");
  }
}
else
{ 
  header("Location: consultancy-view");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Edit | Delete Consultancy Type
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
          Edit | Delete Consultancy Type
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Consultancy Type</h3>
            <div class="box-tools pull-right">
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-blog"
                    id="btn-delete-blog">
                    Delete
                  </button>
                </div>
              </div>
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
                    <input type="text" class="form-control" name="consultancyTitle" id="consultancyTitle"
                      value="<?php echo $title; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-12" id="descriptionWrapper">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="required form-control" name="description" id="description" rows="10" cols="80">
                      <?php echo $description; ?>
                    </textarea>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div>
                  <input type="hidden" name="consultancyId" id="consultancyId" value="<?php echo $id; ?>" />
                  <?php $_SESSION['consultancyId'] = $id; ?>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-submit" id="btn-submit">
                      Edit Consultancy Type
                    </button>
                  </div>
                </div>
              </div>

              <div class="col-md-12" id="descriptionWrapper">
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

  <script src="ckeditor/adapters/jquery.js"></script>

  <script type="text/javascript" src="ajax-js/consultancy-edit.js"></script>
  <script type="text/javascript" src="ajax-js/consultancy-delete.js"></script>

</body>

</html>