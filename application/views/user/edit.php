<h1>Editing Chef</h1>
<?php echo Form::open('user/update') ?>

 <p>
    <b>Name:</b>
    <? echo $name; ?>
  </p>

<p>
    <b>Email:</b>
    <? echo $email; ?>
</p>

  <div class="field">
    <label for="chef_kitchen">Kitchen</label>
    <?php echo form::input('kitchen',$kitchen,array('id' => 'kitchen')) ?>
  </div>
  <div class="field">
    <label for="chef_food">Food</label>
    <?php echo form::input('food',$food,array('id' => 'food')) ?>
  </div>
  <div class="field">
    <label for="chef_price">Price</label>
    <?php echo form::input('price',$price,array('id' => 'price')) ?>
  </div>
  <div class="actions">
    <?php echo form::submit('submit','Update Chef') ?>
  </div>
</form>

<a href="/freshcook/">Back</a>
