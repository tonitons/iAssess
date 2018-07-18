
  
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
          <li class="menu-has-children"><a href="#"><label for="">Real Property Mgt.</label></a>
			       <ul>
              <li><a href="<?php echo base_url('admin/real_property_mgt/land_property') ?>">Land Property</a></li>
      			  <li><a href="<?php echo base_url('admin/real_property_mgt/building_property') ?>">Building Property</a></li>
      			  <li><a href="<?php echo base_url('admin/real_property_mgt/machinery') ?>">Machinery</a></li>
             </ul>
          </li>
          <li><a href="<?php echo base_url('admin/feedback') ?>"><label for="">Feedback</label></a></li>            
          <li>
          		<?php if($this->session->logged_in == TRUE): ?>
          		<a href="<?php echo base_url('user/logout') ?>"><label for="">Logout</label></a>
          		<?php else: ?>
          		<a href="<?php echo base_url('user/login') ?>">Login</a>
          		<?php endif; ?>
          </li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
