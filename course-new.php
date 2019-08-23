<?php include_once('inc/inc.logged.in.top.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Courses
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
          Courses
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Course</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->
              <?php
                  if(isset($successMSG)){
                    echo $successMSG;
                  }else if(isset($errMSG)){
                    echo $errMSG;
                  }
                ?>
            </div>
            <form method="post" enctype="multipart/form-data" id="new-course-form">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" placeholder="Title of the Course" name="title" id="title">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Level</label>
                      <select class="form-control select2" name="level" id="level" style="width: 100%;">
                        <option selected="selected" value="">--</option>
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                        <option value="Bronze">Bronze</option>
                      </select>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label>Course Duration</label>
                    <div class="form-group">
                      <div class="form-group col-md-3">
                        <label>Months</label>
                        <input type="number" class="form-control" name="months" id="months" value="0">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Days</label>
                        <input type="number" class="form-control" name="days" id="days" value="0">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Hours</label>
                        <input type="number" class="form-control" name="hours" id="hours" value="0">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Minutes</label>
                        <input type="number" class="form-control" name="minutes" id="minutes" value="0">
                        <span class="help-block" id="error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Thumbnail</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-create-course"
                        id="btn-create-course" value="btn-create-course">
                        Add Course
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
  <script type="text/javascript" src="ajax-js/course-new.js"></script>

</body>

</html>