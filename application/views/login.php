
<div id="login">
  <div class="login-card">
   <?php if(!empty($message)): ?>
  <?php echo '<div class="alert alert-danger">'.$message['message'].'</div>'; ?>
  <?php endif; ?>
  <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
  <div class="hero-container"><img src="<?php echo base_url('upload/'.$detail->logo) ?>" class="profile-img-card"><img src="<?php echo base_url('assets/img/Iasses.png') ?> " id="header1">
          <form class="form-signin" method="POST" action="">
              <input class="form-control" type="text" name="user_name" type="User Name" required="" placeholder="User Name" autofocus=""> 
              <input class="form-control" name="password" type="password" required="" placeholder="Password">

              <a href="<?php echo base_url('user/forget_password') ?>">Forgot Password?</a> <br>
          <br>
              <button class="btn btn-primary active btn-block btn-lg btn-signin" type="submit">Sign in</button>
          </form>
  </div>
</div>
</div>