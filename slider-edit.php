<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $result = $common -> GetRows("
      SELECT * FROM tbl_home_slider WHERE id='".$id."'
    ");

    foreach($result as $row){
      $title = $row['title'];
      $slogan = $row['slogan'];
      $thumbnail = $row['image'];
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
    <?php echo $SystemName; ?> | Edit | Delete Slider Item
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
          Edit | Delete Slider Item
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Slider Item</h3>
            <div class="box-tools pull-right">
              <?php 
                $_SESSION['sliderId'] = $id;
                $_SESSION['sliderThumbnail'] = $thumbnail;
              ?>
              <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-slider" id="btn-delete-slider">
                Delete Slider Item
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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Slogan</label>
                      <input type="text" class="form-control" name="slogan" id="slogan" value="<?php echo $slogan; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>New Slider Image</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <input type="hidden" name="sliderId" value="<?php echo $id; ?>" />
                  <input type="hidden" name="sliderThumbnail" value="<?php echo $thumbnail; ?>" />

                  <div class="col-md-12">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Current Slider Image</label>
                        <img src="uploads/slider_images/<?php echo $thumbnail; ?>" height="200px" width="400px" />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-edit-slider" id="btn-edit-slider" value="btn-edit-slider">
                        Edit Slider Item
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
  <script type="text/javascript" src="ajax-js/slider-edit.js"></script>
  <script type="text/javascript" src="ajax-js/slider-delete.js"></script>

</body>

</html>