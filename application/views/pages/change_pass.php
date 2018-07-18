<div id="login">
  <div class="login-card">

  <div class="hero-container">
    <h2 style="color:#fff">Password Recovery</h2>
    <?php if(!empty($message)): ?>
    <?php echo "<div class='alert alert-$message[status]'>".$message['message']."</div>"; ?>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          <form class="form-signin" method="POST" action="">
          <p style="color:white">Change password for <span style="color:#03C4EB;font-weight:bold"><?php echo $user_name; ?></span></p>
              <input class="form-control" type="password" name="new_pass" placeholder="New Password" autofocus=""> 
              <input class="form-control" type="password" name="confirm_pass" type="email" placeholder="Confirm Password">

              <!-- <a href="</?php //echo base_url('user/forget_password') ?>">Forgot Password?</a> <br> -->
          <br>
              <button class="btn btn-primary active btn-block btn-lg btn-signin" type="submit">Change Password</button>
          </form>
  </div>
</div>
</div>