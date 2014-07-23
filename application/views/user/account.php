<h1 class="floatLeft"><? echo $name; ?>'s Kitchen</h1>

<p> <? echo $wepay; ?></p>
<p>
<b>Name:</b>
<? echo $name; ?>
</p>
<p>
<b>Email:</b>
<? echo $email; ?>
</p>

<p>
<b>Kitchen:</b>
<? echo $kitchen; ?>
</p>

<p>
<b>Food:</b>
<? echo $food; ?>

</p>

<p>
<b>Price:</b>
<? echo '$'.$price; ?>
</p>
<p><p>
<? if ($edit) {
    echo "<a id=\"edit\" href=" . URL::base() . 'user/edit>Edit</a><p>';
    echo "<a id=\"delete\" href=" . URL::base() . 'user/delete>Delete</a>';

}
?>


<? if (!empty($notice)) { ?>
<div class="alert alert-info">
  <a class="close" data-dismiss="alert">×</a>
  <? echo $notice; ?>
</div>
<? } ?>

