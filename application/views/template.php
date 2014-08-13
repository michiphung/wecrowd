<!DOCTYPE html>
<html>
<head>
    <title>WeCrowd</title>
    <?php echo HTML::style("content/css/bootstrap.css"); ?>
    <?php echo HTML::style("content/css/bootstrap-responsive.css"); ?>
</head>
   <?php echo $header ?>
<div class="container">
    <? echo $content ?>
    <?  if (!empty($table)){
            echo "<div id ='step2'><h3>Funding Campaigns</h3>
            <table class='table table-striped table-bordered'>
                <tr>
                <th>Name</th>    
                <th>Campaign</th>
                <th>Description</th>
                <th>Donation</th>
            </tr>";
            foreach ($table as $campaign){
                echo '<tr>';
                echo '<td><a href='.'user/account/'.$campaign->id.'>'.$campaign->first_name.'</td>';
                echo '<td><a href='.'user/account/'.$campaign->id.'>'.$campaign->campaign_name.'</td>';
                echo '<td>'.$campaign->description.'</td>';
                echo '<td>$'.number_format($campaign->price,2).'</td>';
            }

            echo '</table>' . '</div>';
        }
    ?>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
</html>