<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="img/profile_pictures/default.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['userFirstName']; ?> <?php echo $_SESSION['userLastName']; ?></p>
        <!-- Status -->
      </div>
    </div>


    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="<?= ($activePage == 'dashboard') ? 'active':''; ?>">
        <a href="dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
      </li>
      <!-- Super user view of admins -->
      <?php
        if (in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)) {
			?>
      <li
        class="<?= ($activePage == 'slider-new' || $activePage == 'slider-view' || $activePage == 'slider-edit') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-file"></i> <span>Content Control</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="contacts-social-media-links"><i class="fa fa-link"></i> <span>Contacts | Social Media
                Links</span></a>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-home"></i> <span>Home Page</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li class="treeview">
                <a href="#">
                  Slider
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                  <li>
                    <a href="slider-new">Add Slider Image</a>
                  </li>
                  <li>
                    <a href="slider-view">View Slider Image(s)</a>
                  </li>
                </ul>
              </li><!-- /.third level-->

              <li class="treeview">
                <a href="#">
                  Partner Logos
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                  <li>
                    <a href="partner-logo-new">Add Partner Logo</a>
                  </li>
                  <li>
                    <a href="partner-logo-view">View Partner Image(s)</a>
                  </li>
                </ul>
              </li><!-- /.third level-->

              <li class="treeview">
                <a href="#">
                  Testimonials
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                  <li>
                    <a href="testimonial-new">Add Testimonial</a>
                  </li>
                  <li>
                    <a href="testimonial-view">View Testimonial(s)</a>
                  </li>
                </ul>
              </li><!-- /.third level-->
            </ul>
          </li><!-- /.second level-->


          <li class="treeview">
            <a href="#"><i class="fa fa-info"></i> <span>About Page</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li class="treeview">
                <a href="about-text" id="about-text">
                  About Text
                </a>
              </li><!-- /.third level-->
              <li class="treeview">
                <a href="#">
                  Meet The Team
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                  <li>
                    <a href="teammember-visibility">Control Visibility</a>
                  </li>
                  <li>
                    <a href="teammember-new">Add Team Member</a>
                  </li>
                  <li>
                    <a href="teammember-view">View Team Member(s)</a>
                  </li>
                </ul>

              </li><!-- /.third level-->


              <li class="treeview">
                <a href="#">
                  Partner Logos
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                  <li>
                    <a href="partner-logo-new">Add Partner Logo</a>
                  </li>
                  <li>
                    <a href="partner-logo-view">View Partner Image(s)</a>
                  </li>
                </ul>
              </li><!-- /.third level-->

            </ul>


          </li><!-- /.second level-->
        </ul>
      </li>

      <li
        class="<?= ($activePage == 'admins' || $activePage == 'admins-roles' || $activePage == 'admins-edit') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-user"></i> <span>Admins</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="admins">New Admin</a></li>
          <li><a href="admins" id="view-users">View Admins</a></li>
        </ul>
      </li>
      <?php
				}
					?>

      <?php 
      // Check if logged in user is a blogger
      if($authIsBlogger == 'true' || in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)){
        ?>
      <li
        class="<?= ($activePage == 'blog-new' || $activePage == 'blog-view' || $activePage == 'blog-view-all' || $activePage == 'blog-edit') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-rss"></i> <span>Blogs</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="blog-new">New Blog</a></li>
          <li><a href="blog-view">My Blogs</a></li>
          <?php
            if(in_array($_SESSION['userEmail'], $SUPER_USER_EMAIL)){
              ?>
          <li><a href="blog-view-all">All Blogs</a></li>
          <?php
            }
          ?>
        </ul>
      </li>

      <?php
            }
          ?>

      <li class="<?= ($activePage == 'course-new' || $activePage == 'course-view') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-video-camera"></i> <span>Courses</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="course-new">New Course</a></li>
          <li><a href="course-view" id="view-users">View Courses</a></li>
        </ul>
      </li>


      <li class="<?= ($activePage == 'event-new' || $activePage == 'event-view') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-calendar"></i> <span>Events</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="event-new">New Event</a></li>
          <li><a href="event-view" id="view-users">View Events</a></li>
        </ul>
      </li>



      <li class="<?= ($activePage == 'consultancy-new' || $activePage == 'consultancy-view') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-wrench"></i> <span>Services</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          <li class="treeview">
            <a href="#"><i class="fa fa-tasks"></i> <span>Consultancy</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li><a href="consultancy-new" id="view-consultancy">New Consultancy Type</a></li>
              <li><a href="consultancy-view" id="view-consultancy">View Consultancy Type(s)</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Executive Coaching</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li><a href="executive-coaching-description" id="executive-coaching-description">Executive Coaching
                  Description</a></li>
              <li><a href="#" id="">View Requests</a></li>
            </ul>
          </li>
        </ul>
      </li>

      <li
        class="<?= ($activePage == 'category-new' || $activePage == 'category-view' || $activePage == 'sub-category-view' || $activePage == 'sub-category-new' || $activePage == 'product-new' || $activePage == 'product-view') ? 'active':'treeview'; ?>">
        <a href="#"><i class="fa fa-shopping-cart"></i> <span>Store</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          <li class="treeview">
            <a href="#"><i class="fa fa-list-alt"></i> <span>Category</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li><a href="category-new" id="category-new">New Category</a></li>
              <li><a href="category-view" id="category-view">View Categories</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-list-alt"></i> <span>Sub Category</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li><a href="sub-category-new" id="sub-category-new">New Sub Category</a></li>
              <li><a href="sub-category-view" id="sub-category-view">View Sub Categories</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-shopping-cart"></i> <span>Product</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li>
                <a href="product-new" id="product-new">
                  New Product
                </a>
              </li>
              <li><a href="product-view" id="product-view">View Products</a></li>
            </ul>
          </li>
        </ul>
      </li>

    </ul>



    <!-- /.sidebar-menu -->

    <!-- Sidebar Menu -->
    <!-- <ul class="sidebar-menu" data-widget="tree">
			<li class="header">HEADER</li>
			
			<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
			<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
			<li class="treeview">
			<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="#">Link in level 2</a></li>
				<li><a href="#">Link in level 2</a></li>
			</ul>
			</li>
		</ul> -->
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<script>
document.getElementById("about-text").onclick = function() {
  location.href = "about-text";
};
</script>