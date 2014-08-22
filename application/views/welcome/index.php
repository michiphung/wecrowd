 <div style="margin-top: -1rem; margin-left: -13rem;"> 
 	<a style="color:#ffffff;"href="<? echo url::base(). 'user/login'?>">int</a>
 </div>
 
<?php
	echo HTML::style('content/css/introjs-nassim.css');
	echo HTML::script('content/js/intro.js') 
	?>

  <h1>Welcome to WeCrowd</h1>
    <p>You can browse different fundraising campaign. If you want to start your own campaign, please register.</p>

     <script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
              { 
                intro: "Hello! Let's take a look at the onboarding process as a merchant!"
              },
              {
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

      <script type="text/javascript">

      function startIntro2() {
        var intro = introJs();
        intro.setOptions({
          steps: [
          {
            intro: "Hello! Let's take a look at the buying process."
          },
          ],
          showStepNumbers: false
          });
        intro.start().oncomplete(function() {
          window.location.href = '/user/account/15?demo=true'
        });
      }
    </script>

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><center>Modal header</center></h3>
  </div>
  <div class="modal-body">
    <p><a href="javascript:void(0);" onclick="startIntro();" class="btn btn-demo btn-large" data-dismiss="modal">Demo as Merchant</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="startIntro2();" class="btn btn-demo-buyer btn-large" data-dismiss="modal">Demo as Buyer</a></p>
  </div>
</div>