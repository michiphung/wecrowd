
<html>
<head>
	<h1><font size="6"><center>Welcome to WeCrowd. <br> Please manage your funds. </center></font></h1>
	<br>
	<br>
	<hr width="10%" size =10>
	<style>
	</style>
</head>	
        <body>
        	<center>
        	<a href="<?=$wepay_link?>">View your funds</a>
        	<hr>
        	<div id="kyc_div"><div>
				<script type="text/javascript" src="https://www.wepay.com/min/js/iframe.wepay.js">
				</script>

			    <iframe src="<?=$manage_uri?>" width="800" height="550"></iframe>
			</center>


		</body>
</html>