<?php 
  // Java script includes found at the inc.loggedin.footer.meta.php
  $requiredJS = '';
  $requiredJS2 = '';
  $requiredJS3 = '';

  // Set the navigation class to active, show the active page, check out inc.main-sidebar.php
  $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="dashboard" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>HTS</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Holby Training Solutions</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="img/profile_pictures/default.png" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">
              <?php echo $_SESSION['userFirstName']; ?> <?php echo $_SESSION['userLastName']; ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="img/profile_pictures/default.png" class="img-circle" alt="User Image">

              <p>
                <?php echo $_SESSION['userFirstName']; ?> <?php echo $_SESSION['userLastName']; ?>
                <small>
                  <?php
                      if (in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
                        echo 'Super User';
                      }
                    ?>
                </small>
              </p>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <button class="btn btn-default btn-flat" name="btn-logout" id="btn-logout">
                  Log out
                </button>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>