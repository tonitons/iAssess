
  
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
          <li><a href="<?php echo base_url('treasurer') ?>">Payment</a></li>
          <li><a href="<?php echo base_url('treasurer/delinquent') ?>">Delinquent Payments</a></li>
          <li><a href="<?php echo base_url('treasurer/list') ?>">Payments List</a></li>
          <!-- <li><a href="</?php echo base_url('treasurer/tax_report') ?>">Payment Reports</a></li> -->
          <?php if($this->session->logged_in == TRUE): ?>
          <li  class="menu-has-children"><a href="#"><label for=""><?php echo $this->session->user_name; ?></label></a>
          	<ul>
          		<li><a onclick="change_email()" href="<?php echo base_url('treasurer/security#change_email') ?>"> Change email</a></li>
              <li><a onclick="change_password()" href="<?php echo base_url('treasurer/security#change_password') ?>"> Change Password</a></li>
              <li><a href="<?php echo base_url('treasurer/security') ?>"> My security question</a></li>
              <li><a href="<?php echo base_url('user/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>     
          </li>
        <?php endif; ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->


