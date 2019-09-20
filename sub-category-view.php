<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php
  if (($authIsBlogger != 'true') && (!in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL))) {
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
    <?php echo $SystemName; ?> | Sub Categories
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
      $activePage == 'category-new';
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
          Sub Categories
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Select Category</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Category Name</label>
                    <select type="text" class="form-control" name="categoryName" id="categoryName">
                      <option value="">--------</option>
                      <?php
                        $result = $common -> GetRows("
                          SELECT * FROM tbl_category
                        ");

                        foreach($result as $row){
                          $categoryId = $row['id'];
                          $categoryName = $row['categoryName'];
                          ?>
                      <option value="<?php echo $categoryId; ?>"><?php echo $categoryName; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="col-md-6  custyle">
                  <table class="table table-striped custab">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody id="show_up">
                    </tbody>
                  </table>
                </div>
              </div>
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

  <script>
  $(document).ready(function(e) {
    $("#categoryName").change(function() {
      $("#show_up").show();
      var text = $(this).val();
      $.ajax({
        type: 'GET',
        url: 'ajax/sub-category-search-ajax.php',
        data: 'txt=' + text,
        success: function(data) {
          $("#show_up").html(data);
        }
      });
    })
  });
  </script>

</body>

</html>