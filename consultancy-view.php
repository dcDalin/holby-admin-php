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
    <?php echo $SystemName; ?> | All Consultancy Types
  </title>
  <?php 
		include 'inc/inc.meta.php'; 
  ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
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
          Consultancy Types
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">All Consultancy Types</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tbl-blogs" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
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

  <!-- Show Data Table -->
  <script type="text/javascript">
  $(document).ready(function() {
    $('#tbl-blogs').DataTable({
      "ajax": "ajax/consultancy-view-all-datatable-ajax.php",
      "columns": [{
          "data": "title"
        },
        {
          "data": "description"
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