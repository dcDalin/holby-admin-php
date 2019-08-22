<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $result = $common -> GetRows("
      SELECT * FROM tbl_partners WHERE id='".$id."'
    ");

    foreach($result as $row){
      $title = $row['name'];
      $thumbnail = $row['logo'];
    }
  }
  else { 
    header("Location: slider-view");
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Edit | Delete Partner Logo
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
          Edit | Delete Partner Logo
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Partner Logo</h3>
            <div class="box-tools pull-right">
              <?php 
                $_SESSION['partnerId'] = $id;
                $_SESSION['partnerThumbnail'] = $thumbnail;
              ?>
              <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-slider"
                id="btn-delete-slider">
                Delete Partner Logo
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->
            </div>
            <form method="post" enctype="multipart/form-data" id="edit-slider-form">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>New Partner Logo</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <input type="hidden" name="partnerId" value="<?php echo $id; ?>" />
                  <input type="hidden" name="partnerThumbnail" value="<?php echo $thumbnail; ?>" />

                  <div class="col-md-12">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Current Partner Logo</label>
                        <img src="uploads/partner_images/<?php echo $thumbnail; ?>" height="200px" width="400px" />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-edit-slider"
                        id="btn-edit-slider" value="btn-edit-slider">
                        Edit Partner Logo
                      </button>
                    </div>
                  </div>
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
  <script type="text/javascript" src="ajax-js/partner-logo-edit.js"></script>
  <script type="text/javascript" src="ajax-js/partner-logo-delete.js"></script>

</body>

</html>