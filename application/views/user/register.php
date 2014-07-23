<h1>New chef registration</h1>
<?php echo Form::open('user/complete_registration') ?>

  <div class="field">
    <label for="chef_name">Name</label>
    <?php echo Form::input('username','',array('id' => 'username')) ?>
  </div>
  <div class="field">
    <label for="chef_email">Email</label>
    <?php echo Form::input('email','',array('id' => 'email')) ?>
  </div>
  <div class="field">
    <label for="chef_password">Password</label>
    <?php echo Form::password('password','',array('id' => 'password')) ?>
  </div>
  <div class="field">
    <label for="chef_kitchen">Kitchen</label>
    <?php echo Form::input('kitchen','',array('id' => 'kitchen')) ?>
  </div>
  <div class="field">
    <label for="chef_food">Food</label>
    <?php echo Form::input('food','',array('id' => 'food')) ?>
  </div>
  <div class="field">
    <label for="chef_price"> Price</label>
    <?php echo Form::input('price','',array('id' => 'price')) ?>
  </div>
  <div>
  <div class="field">
      <label for = "chef_account_type"> Account Type </label>
      <?php echo Form::select('account_type',array( 'personal'  =>' Individual Chef', 'business' => 'Business Restaurant'), false, array('id' => 'account_type')) ?>
</div>
  <div class="actions">
    <?php echo Form::submit('submit','Create Chef') ?>
  </div>
</Form>

<a href="/">Back</a>
