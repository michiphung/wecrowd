	<div id="left_col">
	<h1 class="floatLeft"><? echo $first_name?>'s Campaign</h1>
		<p> <? echo $wepay; ?></p>
		<p>
		<b><font color="7acaea" family="OpenSans">Name:</font></b>
		<? echo $first_name . ' ' . $last_name; ?>
		</p>
		<p>
		<b><font color="7acaea">Email:</font></b>
		<? echo $email; ?>
		</p>

		<p>
		<b><font color="7acaea">Campaign:</font></b>
		<? echo $campaign_name; ?>
		</p>

		<p>
		<b><font color="7acaea">Description:</font></b>
		<? echo $description; ?>

		</p>

		<p>
		<b><font color="7acaea">Donation:</font></b>
		<? echo '$'.$price; ?>
		</p>
		<p><p>
	<? if ($edit) {
	    echo "<a id=\"delete\" href=" . URL::base() . 'user/delete>Delete</a>';
	    echo "<br>";
	    echo "<br>";
	    echo "<h1>Checkouts</h1>";
	 } ?>

	</div>

	<div id="right_col">
		<? if ($token && $edit) {
	    	echo "<h1>Account Details</h1>";
	    	if ($state == "action_required") {
	    		echo "<font color='7acaea'>Status:</font> Action Required</p>";
	    		echo "Your profile is not fully completed! Please <a href=" . URL::base(). "user/manage>manage</a> your account</p>";
	    		echo "<a href=$wepay_link?>Payment account</a></p>";
	    	} else if ($state == "active") {
	    		echo "<font color='7acaea'>Status:</font> Active</p>";
	    		echo "Your account is completed and ready to receive payments!</p>";
	    		echo "You can view your payment account <a href=$wepay_link?>here.</a></p>";
	    	} else {
	    		echo "<font color='7acaea'>Status:</font> Pending</p>";
	    		echo "You still have not confirmed your account.<br>Click <a href=" . URL::base(). "user/resend_email>here</a> to resend your confirmation email. </p>";
	    	}
	    	echo "<font color='7acaea'>Balance:</font> $" . $balance;
	    }
	    ?>
    </div>
<?  if (!empty($checkouts)){
            echo "
            	<table class='table table-striped table-bordered'>
                <tr>
                <th>ID</th>
                <th>Name</th>    
                <th>State</th>
                <th>Amount</th>
            </tr>";
            foreach ($checkouts as $checkout){
                echo '<tr>';
                echo '<td>' . $checkout->checkout_id . '</td>';
                echo '<td>' . $checkout->payer_name . '</td>';
                echo '<td>'. $checkout->state.'</td>';
                echo '<td>'. $checkout->amount . '</td>';
            }
            echo '</table>';
        } else {
        	echo "<div id='checkout_wrap'><p><h2><center>You have no transactions.<center></h2></p></div>";
        }
    ?>


<? if (!empty($notice)) { ?>
<div class="alert alert-info">
  <a class="close" data-dismiss="alert">×</a>
  <? echo $notice; ?>
</div>
<? } ?>


