<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 

if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
  header("Location: index"); /* Redirect browser */
  exit();
}

if(isset($_GET['id']) && !empty($_GET['id']))
{
  $id = $_GET['id'];
  $firstName = $_GET['fname'];
  $lastName = $_GET['lname'];
  $email = $_GET['email'];
  $results = $common -> GetRows("
    SELECT 
      tbl_admin.id AS administratorId, tbl_admin.firstName, tbl_admin.lastName,
      tbl_admin_level.id AS adminLevelId, tbl_admin_level.adminLevelName,
      tbl_admin_and_role_link.id as roleLinkId, tbl_admin_and_role_link.admin_id, tbl_admin_and_role_link.admin_level_id

    FROM
      tbl_admin, tbl_admin_level, tbl_admin_and_role_link

    WHERE
      tbl_admin.id=tbl_admin_and_role_link.admin_id

    AND 
      tbl_admin_and_role_link.admin_level_id=tbl_admin_level.id
    
    AND 
      tbl_admin.id='".$id."'
  ");

  $allRoles = $common -> GetRows("SELECT * FROM tbl_admin_level");

}
else
{ 
    header("Location: admins");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Admin Roles
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
          Admin Roles
        </h1>
        <div>
          <a href="admins">Back</a>
        </div>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><strong><?php echo $firstName; ?> <?php echo $lastName; ?>'s</strong> Admin Roles</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form method="post" id="admin-level-form">
              <div id="errorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="form-group">
                      <?php
                      // Loop and display relevant user roles
                      foreach($allRoles as $row) {
                        $adminLevelName = $row['adminLevelName'];
                        $adminLevelId = $row['adminLevelId'];
                        foreach($results as $row) { 
                          $userRoles = $row['adminLevelName'];
                          if($userRoles == $adminLevelName) {
                        ?>
                      <span class="label label-primary"><?php echo $adminLevelName?></span>
                      <?php
                          }
                        }
                      }
                    ?>
                    </div>
                  </div>
                  <form method="post" role="form" id="admin-level-form">
                    <div class="col-md-12">
                      <!-- Admin Roles Wrapper -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Select Role</label>
                          <select class="form-control select2" name="adminLevel" id="adminLevel" style="width: 100%;">
                            <option selected="selected" value="">--</option>
                            <?php 
                            $results = $common -> GetRows("SELECT * FROM tbl_admin_level");
                            foreach ($results as $row){
                              ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['adminLevelName']; ?></option>
                            <?php
                            }
                        ?>
                          </select>
                          <span class="help-block" id="error"></span>
                        </div>
                      </div>
                      <!-- End Admin Roles Wrapper -->
                    </div>

                    <!-- Loader appeares here -->
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="hidden" name="adminId" value="<?php echo $id; ?>">
                          <input type="hidden" name="email" value="<?php echo $email; ?>">
                          <span id="loader-here">

                          </span>
                        </div>
                      </div>
                    </div>
                    <!-- End Loader appeares here -->

                    <div class="col-md-12" id="action-buttons">
                      <div class="col-md-2">
                        <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block btn-flat" name="btn-add-role" id="btn-add-role">
                            Add Role
                          </button>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning btn-block btn-flat" name="btn-remove-role" id="btn-remove-role">
                            Remove Role
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
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

  <script type="text/javascript" src="ajax-js/admins-roles.js"></script>


</body>

</html>