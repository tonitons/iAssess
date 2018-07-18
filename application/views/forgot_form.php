<style>
  a:hover{
    text-decoration: underline;
    color: #fff;
  }
</style>
<div id="login">
  <div class="login-card">

  <div class="hero-container"><img src="<?php echo base_url('upload/'.$detail->logo) ?>" class="profile-img-card"><img src="<?php echo base_url('assets/img/Iasses.png') ?> " id="header1">
    <?php if(!empty($message)): ?>
    <?php echo "<div class='alert alert-$message[status]'>".$message['message']."</div>"; ?>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
      <div id="form-body">
          <form class="form-signin" method="POST" action="">
          <p style="color:white" class="help"><span>To help you recover your account, please tell us someting about yourself.</span></p>
              <input class="form-control" type="text" id="user_name" name="user_name" type="User Name" required="" placeholder="User Name" autofocus=""> 
              <input class="form-control" name="email" type="email" placeholder="E-mail">

              <!-- <a href="</?php //echo base_url('user/forget_password') ?>">Forgot Password?</a> <br> -->
          
              <button class="btn btn-primary active btn-block btn-lg btn-signin" type="submit" name="use_email">Send e-mail</button>
          </form>
          <a id="securityQ" href="<?php echo base_url('user/security_question') ?>">Answer security question instead</a>
      </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function(){
    $('#securityQ').on('click', function(e){
      e.preventDefault();
      var user_name = $('#user_name').val();
      if(user_name == ''){
        $('.help').append('<p class="bg-danger text-danger">Please provide your user name on the field.</p>');
      }else{
        $.ajax({
            url: '/iassess/User/exist_user?user_name='+user_name,
            type: 'get',
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                if (data == 'User name not recognized!') {
                  $('.help').append('<p class="bg-danger text-danger">'+data+'</p>');
                  $('.bg-danger').delay(5000).hide(3000);
                }else{
                  $('#form-body').empty();
                  $('#form-body').append(data);
                }
            },
            error:function(e, xhr){
                alert('error '+ e.errorCode+xhr.errorCode)
            },
            statusCode: {
                404: function() {
                    alert("page not found");
                }
            }
        });
      }
    });
    
  });
</script>