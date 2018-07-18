
  
<!--==========================
  Header Section
============================-->
  <header id="header">
    <div class="container">
    
      <div id="logo" class="pull-left">
        <img src="<?php echo base_url('upload/'.$detail->logo)?>" id="municipality-logo" alt="<?php echo $detail->logo ?>" class="img img-circle">
        <a href="#hero"><img src="<?php echo base_url('/assets/img/Iasses.png')?>" alt="" title="" width="295"/></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>
        
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="<?php echo base_url('admin') ?>"><label for="">Home</label></a></li>
          <!-- <li><a href="#about">Search</a></li>
          <li><a href="#services">Calculator</a></li> -->
          <li class="menu-has-children"><a href="#"><label for="">Market Value</label></a>
            <ul>
              <li><a href="<?php echo base_url('admin/market_value/land') ?>">Land</a></li>
      			  <li><a href="<?php echo base_url('admin/market_value/agricultural') ?>">Agricultural Land</a></li>
      			  <li><a href="<?php echo base_url('admin/market_value/plantation') ?>">Plantation</a></li>
      			  <li><a href="<?php echo base_url('admin/market_value/building') ?>">Building</a></li>
            </ul>
          </li>
          <li class="menu-has-children"><a href="#"><label for="">Real Property Mgt.</label></a>
			       <ul>
              <li><a href="<?php echo base_url('admin/real_property_mgt/land_property') ?>">Land Property</a></li>
      			  <li><a href="<?php echo base_url('admin/real_property_mgt/building_property') ?>">Building Property</a></li>
      			  <li><a href="<?php echo base_url('admin/real_property_mgt/machinery') ?>">Machinery</a></li>
             </ul>
          </li>
          <li class="menu-has-children"><a href="#"><label for="">Site Mgt.</label></a>
             <ul>
                <li><a href="<?php echo base_url('admin/users') ?>">Users</a></li>
                <li><a href="<?php echo base_url('admin/logs') ?>">Activity Logs</a></li>
                <li><a href="<?php echo base_url('admin/feedback') ?>">Feedback</a></li>
                <li><a href="<?php echo base_url('site_details') ?>">Site Details</a></li>
                <li><a href="<?php echo base_url('site_details/security_mgt') ?>">Security Questions</a></li>
                <li><a href="<?php echo base_url('site_details/kinds_mgt') ?>">Kinds Management</a></li>
                <li><a href="<?php echo base_url('site_details/signatories') ?>">Reports Signatories</a></li>
                <li><a href="<?php echo base_url('site_details#discount') ?>" id="discount_link">Discount</a></li>
             </ul>
          </li>
          <li class="menu-has-children"><a href="#"><label for="">Reports</label></a>
             <ul>
                <li><a href="<?php echo base_url('admin/reports/assessment_roll') ?>">Assessment Roll</a></li>
                <li><a href="<?php echo base_url('admin/reports/quarterly?page=1') ?>">Quarterly Report</a></li>
             </ul>
          </li>
          
          <li>
          		<?php if($this->session->logged_in == TRUE): ?>
              <li  class="menu-has-children"><a href="#"><label for=""><?php echo $this->session->user_name; ?></label></a>
                <ul>
                  <li><a onclick="change_email()" href="<?php echo base_url('admin/index#change_email') ?>">Change email </a></li>
                  <li><a onclick="change_password()" href="<?php echo base_url('admin/index#change_password') ?>">Change Password </a></li>
                  <li><a href="<?php echo base_url('user/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                </ul>
              </li>
          		<?php else: ?>
          		<a href="<?php echo base_url('user/login') ?>">Login</a>
          		<?php endif; ?>
          </li>
          <!-- <li><a href="#testimonials">Testimonials</a></li> -->
          <!-- <li><a href="#team">Team</a></li> -->
          
          <!-- <li><a href="#contact">Contact Us</a></li> -->
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->



<!-- <div class="col-md-3"> -->
	<!-- <ul class="nav nav-pills nav-stacked"> -->
		<!--main menu-->
	  <!-- <li class="active"><a href="#">MARKET VALUES</a></li> -->
	  	<!--sub menu-->
		  <!-- <li><a href="<?php echo base_url('admin/market_value/land') ?>">Land</a></li>
		  <li><a href="<?php echo base_url('admin/market_value/agricultural') ?>">Agricultural Lands</a></li>
		  <li><a href="<?php echo base_url('admin/market_value/plantation') ?>">Plantation</a></li>
		  <li><a href="<?php echo base_url('admin/market_value/building') ?>">Building</a></li> -->
		 <!--submenu-->
		<!--end main menu-->
	<!-- </ul> -->
<!-- </div> -->
<!-- <br> -->
