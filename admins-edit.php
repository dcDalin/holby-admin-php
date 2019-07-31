<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 

if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
  header("Location: index"); /* Redirect browser */
  exit();
}

if(isset($_GET['id']) && !empty($_GET['id']))
{
  $id = $_GET['id'];
  $result = $common -> GetRows("
    SELECT * FROM tbl_admin WHERE id='".$id."'
  ");

  foreach($result as $row){
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $gender = $row['gender'];
    $phoneNumber = $row['phoneNumber'];
    $idNumber = $row['idNumber'];
  }
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
    <?php echo $SystemName; ?> | Edit Admin
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
          Admin
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
            <h3 class="box-title">Edit Admin</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form method="post" id="edit-admin-form">
              <div id="errorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" value="<?php echo $firstName; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" value="<?php echo $lastName; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $email; ?>">
                    <span class=" help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                      <option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                      <option value="">_________</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phoneNumber" id="phoneNumber" value="<?php echo $phoneNumber; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>ID Number</label>
                    <input type="text" class="form-control" placeholder="ID Number" name="idNumber" id="idNumber" value="<?php echo $idNumber; ?>">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                  <div class="form-group" id="userRoleDescription">
                    <input type="hidden" name="adminEditId" id="adminEditId" value="<?php echo $id; ?>" />
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-edit-admin" id="btn-edit-admin">
                      Edit Admin
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

  <script type="text/javascript" src="ajax-js/admins-edit.js"></script>


</body>

</html>