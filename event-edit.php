<?php include_once('inc/inc.logged.in.top.php'); ?>
<?php 
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $result = $common -> GetRows("
      SELECT * FROM tbl_event WHERE id='".$id."'
    ");

    foreach($result as $row){
      $title = $row['title'];
      $description = $row['description'];
      $venue = $row['venue'];
      $date = $row['date'];
      $startTime = $row['startTime'];
      $endTime = $row['endTime'];
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
    <?php echo $SystemName; ?> | Edit | Delete Event
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
          Edit | Delete Event
        </h1>
      </section>
      <!-- Main content -->
      <section class="content" id="create-new-user">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Edit | Delete Event</h3>
            <div class="box-tools pull-right">
              <?php 
                $_SESSION['eventId'] = $id;
                $_SESSION['eventThumbnail'] = $thumbnail;
              ?>
              <button type="submit" class="btn btn-danger btn-block btn-flat" name="btn-delete-event"
                id="btn-delete-event">
                Delete Event
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="errorDiv">
              <!-- error will be shown here ! -->

            </div>
            <form method="post" enctype="multipart/form-data" id="new-course-form">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" placeholder="Title of the Event" name="title" id="title"
                        value="<?php echo $title; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" id="description" name="description">
                        <?php echo $description; ?>
                      </textarea>
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Venue</label>
                      <input type="text" class="form-control" placeholder="Venue of the Event" name="venue" id="venue"
                        value="<?php echo $venue; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" class="form-control" name="date" id="date" value="<?php echo $date; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" class="form-control" placeholder="Price" name="price" id="price"
                        value="<?php echo $price; ?>">
                      <span class="help-block" id="error"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label>Time</label>
                    <div class="form-group">
                      <div class="form-group col-md-2">
                        <label>From</label>
                        <input type="time" class="form-control" name="startTime" id="startTime"
                          value="<?php echo $startTime; ?>">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group col-md-2">
                        <label>To</label>
                        <input type="time" class="form-control" name="endTime" id="endTime"
                          value="<?php echo $endTime; ?>">
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
                  <input type="hidden" name="eventId" value="<?php echo $id; ?>" />
                  <input type="hidden" name="eventThumbnail" value="<?php echo $thumbnail; ?>" />

                  <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Current Thumbnail</label>
                        <img src="uploads/event_thumbnails/<?php echo $thumbnail; ?>" height="200px" width="180px" />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-submit" id="btn-submit"
                        value="btn-submit">
                        Edit Event
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
  <script type="text/javascript" src="ajax-js/event-edit.js"></script>
  <script type="text/javascript" src="ajax-js/event-delete.js"></script>

</body>

</html>