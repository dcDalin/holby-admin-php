<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  $result = $common -> GetRows("
    SELECT * FROM tbl_about_visibility WHERE id=1
  ");

  foreach($result as $row){
    $id = $row['id'];
    $meetTheTeam = $row['meetTheTeam'];
    $partner = $row['partner'];
    $trainer = $row['trainer'];
    $consultant = $row['consultant'];
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Team Member Visibility
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
          Team Member Visibility
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Team Member Visibility</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->
            </div>
            <form method="post" enctype="multipart/form-data" id="new-team-member-form">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Meet The Team</label>
                      <select type="text" name="meetTheTeam" id="meetTheTeam" class="form-control">
                        <option value="<?php echo $meetTheTeam; ?>"><?php echo $meetTheTeam; ?></option>
                        <option value="">-------</option>
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Partner</label>
                      <select type="text" name="partner" id="partner" class="form-control">
                        <option value="<?php echo $partner; ?>"><?php echo $partner; ?></option>
                        <option value="">-------</option>
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Trainer</label>
                      <select type="text" name="trainer" id="trainer" class=" form-control">
                        <option value="<?php echo $trainer; ?>"><?php echo $trainer; ?></option>
                        <option value="">-------</option>
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Consultant</label>
                      <select type="text" name="consultant" id="consultant" class="form-control">
                        <option value="<?php echo $consultant; ?>"><?php echo $consultant; ?></option>
                        <option value="">-------</option>
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label>&nbsp;</label>
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-team-member"
                        id="btn-create-team-member" value="btn-create-team-member">
                        Update Visibility
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
  <script type="text/javascript" src="ajax-js/teammember-visibility.js"></script>

</body>

</html>