<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 

  if (in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
    $id = 1;
    $result = $common -> GetRows("
      SELECT * FROM tbl_contacts_social WHERE id='".$id."'
    ");

    foreach($result as $row){
      $twitter = $row['twitter'];
      $facebook = $row['facebook'];
      $instagram = $row['instagram'];
      $email = $row['email'];
      $phoneNumber = $row['phoneNumber'];
    }
  }else {
    header("Location: consultancy-view");
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Contacts Social Media Links
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


      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Contacts | Social Media Links</h3>
            <div class="box-tools pull-right">
              <div class="row">

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
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook"
                      value="<?php echo $facebook; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $twitter; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" class="form-control" name="instagram" id="instagram"
                      value="<?php echo $instagram; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber"
                      value="<?php echo $phoneNumber; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                  <div class="form-group" id="userRoleDescription">

                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-submit" id="btn-submit">
                      Update
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

  <script src="ckeditor/adapters/jquery.js"></script>

  <script type="text/javascript" src="ajax-js/contacts-social-media-links-edit.js"></script>

</body>

</html>