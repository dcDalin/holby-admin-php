<?php include_once('inc/inc.logged.in.top.php'); ?>

<?php
  // If logged in user is superuser
  if (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
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
    <?php echo $SystemName; ?> | Admin
  </title>
  <?php 
		include 'inc/inc.meta.php';
		?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.10.16/css/dataTables.bootstrap.min.css" />
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
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Admin</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form method="post" id="new-admin-form">
              <div id="errorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                      <option selected="selected" value="">--</option>
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
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phoneNumber" id="phoneNumber">
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>ID Number</label>
                    <input type="text" class="form-control" placeholder="ID Number" name="idNumber" id="idNumber">
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
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-admin" id="btn-create-admin">
                      Create Admin
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </form>
          </div>
      </section>

      <!-- Table showing all users -->
      <section class="content" id="view-all-users">
        <!-- Box header -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">All Admins</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tbl-users" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Phone Number</th>
                  <th>ID Number</th>
                  <th>Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </section>
    </div>
    <?php 
			include 'inc/inc.main-footer.php';
			?>
    <!-- Wrapper end div -->
  </div>

  <?php include 'inc/inc.loggedin.footer.meta.php'; ?>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


  <!-- validate and submit the users form -->
  <script src="ajax-js/admins.js"></script>

  <!-- Show Data Table -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tbl-users').DataTable({
        "ajax": "ajax/get-users.php",
        "columns": [{
            "data": "fname"
          },
          {
            "data": "lname"
          },
          {
            "data": "email"
          },
          {
            "data": "gender"
          },
          {
            "data": "phoneNumber"
          },
          {
            "data": "idNumber"
          },
          {
            "data": "actions"
          }
        ]
      });
    });
  </script>

</body>

</html>