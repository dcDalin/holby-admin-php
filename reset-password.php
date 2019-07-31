<?php  
  //session_start();
  header('Cache-control: private'); // IE 6 FIX
  // always modified 
  header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
  // HTTP/1.1 
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', false);
  // HTTP/1.0 
  header('Pragma: no-cache');

  /* Start Original Scripts */
  include_once('sys/core/init.inc.php');

  $common = new common();

  // check if user is logged in
  // If session is not empty -> user is logged in, redirect to profile page
  if(!$_SESSION['UID'] == ''){
    header("Location: profile"); /* Redirect browser */
    exit();
  }
    
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $SystemName; ?> | Reset Password
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php 
    include 'inc/inc.meta.php';
  ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b><?php echo $SystemName; ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Reset Password</p>
      <form class="form-signin" method="post" id="reset-password-form">
        <div id="errorDiv">
          <!-- error will be shown here ! -->
        </div>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <span class="help-block" id="error"></span>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-xs-6" style="float:right" id="btn-reset-pass-div">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-reset-pass" id="btn-reset-pass">
              Reset Password
            </button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div id="back-to-login">
        <a href="index">Login instead</a><br>
      </div>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
<?php  
  include 'inc/inc.footer.php';
?>

<script src="ajax-js/reset-password.js"></script>

<?php  
  include 'inc/inc.final.footer.php';
?>