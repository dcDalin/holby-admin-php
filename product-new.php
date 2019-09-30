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
    <?php echo $SystemName; ?> | New Product
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
          New Products
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">New Product</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->
            </div>
            <form method="post" enctype="multipart/form-data" id="new-product-form">
              <div class="row">
                <div id="errorDiv">
                  <!-- error will be shown here ! -->
                </div>
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category Name</label>
                      <select type="text" class="form-control" name="categoryName" id="categoryName">
                        <option selected="selected" value="">--------</option>
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sub Category</label>
                      <select class="form-control select2" name="subCategory" id="subCategory" style="width: 100%;">
                        <option selected="selected" value="">--------</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12  custyle">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="productName"
                              id="productName">
                            <span class="help-block" id="error"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" placeholder="Price" name="price" id="price">
                            <span class="help-block" id="error"></span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Short Description</label>
                            <textarea class="form-control" name="shortDescription" id="shortDescription"></textarea>
                            <span class="help-block" id="error"></span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Long Description</label>
                            <textarea class="form-control" name="longDescription" id="longDescription"></textarea>
                            <span class="help-block" id="error"></span>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                            <span class="help-block" id="error"></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-submit"
                              id="btn-submit">
                              Add New Product
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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

  <script>
  $(document).ready(function(e) {
    $("#categoryName").change(function() {
      $("#subCategory").show();
      var text = $(this).val();
      $.ajax({
        type: 'GET',
        url: 'ajax/product-new-sub-category-dropdown-ajax.php',
        data: 'txt=' + text,
        success: function(data) {
          $("#subCategory").html(data);
        }
      });
    })
  });
  </script>
  <script type="text/javascript" src="ajax-js/product-new.js"></script>
</body>

</html>