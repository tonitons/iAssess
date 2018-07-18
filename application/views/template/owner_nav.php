
  
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
          <li><a href="<?php echo base_url('owner/home') ?>">Home</a></li>
          <li><a href="<?php echo base_url('owner/my_properties') ?>">My Properties</a></li>
          <li><a href="<?php echo base_url('owner/my_payments') ?>">My Payments</a></li>
          
          <li><a href="<?php echo base_url('owner/c_f') ?>">Feedback</a></li>
          <li><a href="<?php echo base_url('owner/inbox') ?>">
                  Inbox&nbsp;
                  <?php if ($inbox_cnt->count > 0): ?>
                    <span class="badge" id="badge"><?php echo $inbox_cnt->count ?></span>
                  <?php endif ?>
              </a>
          </li>

          <li class="menu-has-children"><a href="#"><label for="">Account</label></a>
            <ul>
              <li><a onclick="changepassword()" href="<?php echo base_url('owner/my_properties#change_password') ?>">Change Password</a></li>
              <li><a onclick="changeemail()" href="<?php echo base_url('owner/my_properties#change_email') ?>">Change E-mail</a></li>
              <li><a onclick="changecontact()" href="<?php echo base_url('owner/my_properties#change_contact') ?>">Change Contact No.</a></li>
              <li><a href="<?php echo base_url('owner/security_question') ?>">My Security Question</a></li>
            </ul>
          </li>
          <?php if($this->session->logged_in == TRUE): ?>
          <li  class="menu-has-children"><a href="#"><label for=""><?php echo $this->session->user_name; ?></label></a>
            <ul>
        		  <li><a href="<?php echo base_url('user/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
        		</ul>
          </li>
          <?php endif; ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

