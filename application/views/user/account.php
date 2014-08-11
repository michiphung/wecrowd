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
    if ($token) {
    	echo "<h2>Account Detail</h2></p>";
    	if ($state == "action_required") {
    		echo "Your profile is not fully completed! Please <a href=" . URL::base(). "user/manage>manage</a> your account</p>";
    		echo "<a href=$wepay_link?>Payment account</a></p>";
    	} else if ($state == "active") {
    		echo "Your account is completed and ready to receive payments!</p>";
    		echo "<a href=$wepay_link?>Payment account</a></p>";
    	} else {
    		echo "You still have not confirmed your account.<br>Click <a href=" . URL::base(). "user/resend_email>here</a> to resend your confirmation email. </p>";
    	}
    	echo "State: " . $state . "</p>";
    	// echo "Balance: $" . $balance;
    }
}?>
    


<? if (!empty($notice)) { ?>
<div class="alert alert-info">
  <a class="close" data-dismiss="alert">×</a>
  <? echo $notice; ?>
</div>
<? } ?>

