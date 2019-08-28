<?php include_once('inc/inc.logged.in.top.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | New Team Member
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
          Team Member
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Add New Team Member</h3>
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Name of the Team Member" name="name"
                        id="name">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Is Partner</label>
                      <select type="text" name="isPartner" id="isPartner" class="form-control">
                        <option value="">--------</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Is Trainer</label>
                      <select type="text" name="isTrainer" id="isTrainer" class=" form-control">
                        <option value="">--------</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Is Consultant</label>
                      <select type="text" name="isConsultant" id="isConsultant" class="form-control">
                        <option value="">--------</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Bio</label>
                      <textarea class="form-control" name="bio" id="bio"></textarea>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label>&nbsp;</label>
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-team-member"
                        id="btn-create-team-member" value="btn-create-team-member">
                        Add Team Member
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
  <script type="text/javascript" src="ajax-js/teammember-new.js"></script>

</body>

</html>