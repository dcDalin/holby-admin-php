<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $result = $common -> GetRows("
      SELECT * FROM tbl_course WHERE id='".$id."'
    ");

    foreach($result as $row){
      $title = $row['title'];
      $months = $row['months'];
      $weeks = $row['weeks'];
      $days = $row['days'];
      $hours = $row['hours'];
      $minutes = $row['minutes'];
      $level = $row['level'];
      $individual = $row['individual'];
      $organizational = $row['organizational'];
      $price = $row['price'];
      $thumbnail = $row['thumbnail'];
    }
  }
  else { 
    header("Location: course-view");
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Edit | Delete Course
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
          Edit | Delete Course
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Course</h3>
            <div class="box-tools pull-right">
              <?php 
                $_SESSION['courseId'] = $id;
                $_SESSION['courseThumbnail'] = $thumbnail;
              ?>
              <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-course"
                id="btn-delete-course">
                Delete Course
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->
            </div>
            <form method="post" enctype="multipart/form-data" id="edit-course-form">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" placeholder="Title of the Course" name="title" id="title"
                        value="<?php echo $title; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Level</label>
                      <select class="form-control select2" name="level" id="level" style="width: 100%;">
                        <option selected="selected" value="<?php echo $level; ?>"><?php echo $level; ?></option>
                        <option value="">________________</option>
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
                      <div class="form-group col-md-2">
                        <label>Months</label>
                        <input type="number" class="form-control" name="months" id="months"
                          value="<?php echo $months; ?>">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Weeks</label>
                        <input type="number" class="form-control" name="weeks" id="weeks" value="<?php echo $weeks; ?>">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Days</label>
                        <input type="number" class="form-control" name="days" id="days" value="<?php echo $days; ?>">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Hours</label>
                        <input type="number" class="form-control" name="hours" id="hours" value="<?php echo $hours; ?>">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Minutes</label>
                        <input type="number" class="form-control" name="minutes" id="minutes"
                          value="<?php echo $minutes; ?>">
                        <span class="help-block" id="error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label>Type of Course / Solution</label>
                    <div class="form-group">
                      <div class="form-group col-md-2">
                        <label>Individual</label>
                        <select class="form-control" name="individual" id="individual">
                          <option value="<?php echo $individual; ?>"><?php echo $individual; ?></option>
                          <option value="">------</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Organizational</label>
                        <select class="form-control" name="organizational" id="organizational">
                          <option value="<?php echo $organizational; ?>"><?php echo $organizational; ?></option>
                          <option value="">------</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <span class="help-block" id="error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label>Price</label>
                    <div class="form-group">
                      <div class="form-group col-md-2">
                        <label>Kshs.</label>
                        <input type="number" class="form-control" name="price" id="price" value="<?php echo $price; ?>">
                        <span class="help-block" id="error"></span>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>New Thumbnail</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <input type="hidden" name="courseId" value="<?php echo $id; ?>" />
                  <input type="hidden" name="courseThumbnail" value="<?php echo $thumbnail; ?>" />

                  <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Current Thumbnail</label>
                        <img src="uploads/course_thumbnails/<?php echo $thumbnail; ?>" height="200px" width="180px" />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-edit-course"
                        id="btn-edit-course" value="btn-edit-course">
                        Edit Course
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
  <script type="text/javascript" src="ajax-js/course-edit.js"></script>
  <script type="text/javascript" src="ajax-js/course-delete.js"></script>

</body>

</html>