<?php
  echo HTML::style('content/css/introjs-nassim.css');
  echo HTML::script('content/js/intro.js'); 
  ?>

<html>
<head>
	<br>
	<br>
	<h1 id="step5"><font size="6"><center>Welcome to WeCrowd. <br> Now let's get you set up. </center></font></h1>
	<br>
	<hr  align = "center" width="10%" color = #ee5e26 size =10>
	<style>
	</style>
</head>	
        <body>
        	<br>
        	<br>
        	<br>
        	<center>
        	<div id = "step6" id="kyc_div"><div>
				<script type="text/javascript" src="https://www.wepay.com/min/js/iframe.wepay.js">
				</script>

			    <iframe src="<?=$manage_uri?>" width="800" height="550" frameBorder = 0></iframe>
			</center>


		</body>
</html>


<script type="text/javascript"> 
  if (RegExp('demo=true', 'gi').test(window.location.search)) {
    var intro = introJs();
    intro.setOptions({
      steps: [
        {
          intro: "For the KYC page, it is still your own site with an embedded wepay iframe."
        },
        {
          element: "#step5",
          intro: "This is WeCrowd's website"
        },
        {
          element: '#step6',
          intro: "This is WePay's iframe"
        }
      ],
      showStepNumbers: false
    })
    intro.start();

  }
</script>