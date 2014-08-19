 <div style="margin-top: -1rem; margin-left: -13rem;"> 
 	<a style="color:#ffffff;"href="<? echo url::base(). 'user/login'?>">int</a>
 </div>
 
<?php
	echo HTML::style('content/css/introjs-nassim.css');
	echo HTML::script('content/js/intro.js') 
	?>

  <h1>Welcome to WeCrowd</h1>
    <p>You can browse different fundraising campaign. If you want to start your own campaign, please register.</p>


     <a href="javascript:void(0);" onclick="startIntro();" class="btn btn-demo btn-large">Demo as Merchant</a>

     <script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
              { 
                intro: "Hello! Let's take a look at the onboarding process as a merchant!"
              },
            {
              	element: '#step2',
              	intro:"Here is a list of all of the merchants",
              	position:"top"
              },
              {
              	element:'#step3',
              	intro:"Let's begin by registering as a merchant!"

          }
            ],
            showStepNumbers: false
          });

          intro.start().oncomplete(function() {
          	window.location.href = '/user/register?demo=true'
          });

      }
    </script>