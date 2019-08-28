<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $result = $common -> GetRows("
      SELECT * FROM tbl_team WHERE id='".$id."'
    ");

    foreach($result as $row){
      $name = $row['name'];
      $bio = $row['bio'];
      $isPartner = $row['isPartner'];
      $isTrainer = $row['isTrainer'];
      $isConsultant = $row['isConsultant'];
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
    <?php echo $SystemName; ?> | Edit | Delete Team Member
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
          Edit | Delete Team Member
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Team Member</h3>
            <div class="box-tools pull-right">
              <?php 
                $_SESSION['teamMemberId'] = $id;
                $_SESSION['teamMemberThumbnail'] = $thumbnail;
              ?>
              <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-slider"
                id="btn-delete-slider">
                Delete Team Member
              </button>
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
                        id="name" value="<?php echo $name; ?>">
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
                        <option value="<?php echo $isPartner; ?>"><?php echo $isPartner; ?></option>
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
                        <option value="<?php echo $isTrainer; ?>"><?php echo $isTrainer; ?></option>
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
                        <option value="<?php echo $name; ?>"><?php echo $isConsultant; ?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Bio</label>
                      <textarea class="form-control" name="bio" id="bio">
                        <?php echo $bio; ?>
                      </textarea>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Current Team Member Image</label>
                        <img src="uploads/team_images/<?php echo $thumbnail; ?>" height="200px" width="200px" />
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="teamMemberId" value="<?php echo $id; ?>" />
                  <input type="hidden" name="teamMemberThumbnail" value="<?php echo $thumbnail; ?>" />

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>&nbsp;</label>
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-team-member"
                        id="btn-create-team-member" value="btn-create-team-member">
                        Edit Team Member
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
  <script type="text/javascript" src="ajax-js/team-member-edit.js"></script>
  <script type="text/javascript" src="ajax-js/team-member-delete.js"></script>

</body>

</html>