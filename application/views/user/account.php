<h1 class="floatLeft"><? echo $first_name?>'s Campaign</h1>

<p> <? echo $wepay; ?></p>
<p>
<b>Name:</b>
<? echo $first_name. ' ' . $last_name; ?>
</p>
<p>
<b>Email:</b>
<? echo $email; ?>
</p>

<p>
<b>Campaign:</b>
<? echo $campaign_name; ?>
</p>

<p>
<b>Description:</b>
<? echo $description; ?>

</p>

<p>
<b>Donation:</b>
<? echo '$'.$price; ?>
</p>
<p><p>
<? if ($edit) {
    echo "<a id=\"edit\" href=" . URL::base() . 'user/edit>Edit</a><p>';
    echo "<a id=\"delete\" href=" . URL::base() . 'user/delete>Delete</a>';
    echo "<br>";
    echo "<br>";
    echo "<a href=$wepay_link?>Payment account</a>";
}?>
    


<? if (!empty($notice)) { ?>
<div class="alert alert-info">
  <a class="close" data-dismiss="alert">×</a>
  <? echo $notice; ?>
</div>
<? } ?>

