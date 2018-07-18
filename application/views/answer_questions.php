<div>
	<h3 style="color:#fff">Security Question</h3>
    <?php if (!empty($questions)): ?>
	<p class="text-warning help">Please answer the questions below correctly:</p>
	<form action="" class="form-signin" method="POST">
		<?php foreach ($questions as $q): ?>
			<div class="form-group">
				<input type="hidden" value="<?php echo $q->user_id ?>" name="user_id">
				<!-- <input type="hidden" name="q[]" value="</?php echo $q->q_id ?>"> -->
				<label style="color:#fff"><?php echo $q->question ?></label>
				<input type="text" name="<?php echo $q->q_id ?>" class="form-control" placeholder="Your answer">
			</div>
		<?php endforeach ?>
		<input type="submit" class="btn btn-success" value="Submit">
	</form>
    <?php else: ?>
        <p class="text-danger help">Sorry, you have no security questions set.</p>
    <?php endif; ?>

</div>

<script>
$(document).ready(function(){
	$('form').submit(function(e){
		e.preventDefault();
		$('input[type=submit]').val('Submitting pls wait...');
		// var pdata = </?php $_POST ?>
		$.ajax({
            url: '/iassess/User/check_answers',
            data: {pdata: $('form').serialize()},
            type: 'POST',
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                if(data == 'Sorry! you\'re answers are not correct.'){
                	$('.help').append('<p class="bg-danger text-danger">'+data+'</p>');
            	}else{
            		$('help').append('<p class="bg-success text-success">Success! Redirecting ..... </p>')
            		window.location.href = data;
            	}
                $('.bg-danger').delay(5000).hide(3000);
                $('input[type=submit]').val('Submit');
               
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
	});
});
</script>