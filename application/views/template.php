<!DOCTYPE html>
<html>
<head>
    <title>FreshCook</title>
    <?php echo HTML::style("content/css/bootstrap.css"); ?>
    <?php echo HTML::style("content/css/bootstrap-responsive.css"); ?>
</head>
   <?php echo $header ?>
<div class="container">
    <? echo $content ?>
    <?  if (!empty($table)){
            echo "<h3>Our chefs</h3>
            <table class='table table-striped table-bordered'>
                <tr>
                <th>Chef</th>    
                <th>Kitchen</th>
                <th>Food</th>
                <th>Price</th>
            </tr>";
            foreach ($table as $chef){
                echo '<tr>';
                echo '<td><a href='.'user/account/'.$chef->id.'>'.$chef->name.'</td>';
                echo '<td><a href='.'user/account/'.$chef->id.'>'.$chef->kitchen.'</td>';
                echo '<td>'.$chef->food.'</td>';
                echo '<td>$'.number_format($chef->price,2).'</td>';
            }

            echo '</table>';
        }
    ?>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
</html>