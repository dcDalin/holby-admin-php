<?php
	error_reporting(0);
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
  // If session is empty -> user is not logged in, redirect to login page
  if($_SESSION['UID'] == ''){
      header("Location: index"); /* Redirect browser */
      exit();
  }
  include('authentication.php');
?>