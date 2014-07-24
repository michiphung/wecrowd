<h1>User Login</h1>
<div class="row-fluid">
	<div class="span8">	
		<?php echo Form::open('user/complete_login') ?>
			<div class="field">
    			<label for="campaign_email">Email</label>
			    <?php echo Form::input('email','',array('id' => 'email')) ?>
			</div>
			<div class="field">
				<label for="campaign_password">Password</label>
				<?php echo Form::password('password','',array('id' => 'password')) ?>
			</div>
			<div class="actions">
   	 			<?php echo Form::submit('submit','Login') ?>
  			</div>
	</div>
</div>
