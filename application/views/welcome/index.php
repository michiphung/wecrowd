 <div style="margin-top: -1rem; margin-left: -13rem;"> 
 	<a style="color:#ffffff;"href="<? echo url::base(). 'user/login'?>">int</a>
 </div>
 
<?php
	echo HTML::style('content/css/introjs-nassim.css');
	echo HTML::script('content/js/intro.js') 
	?>

  <h1>Welcome to WeCrowd</h1>
    <p>You can browse different fundraising campaign. If you want to start your own campaign, please register.</p>


     <!-- <a href="javascript:void(0);" onclick="startIntro();" class="btn btn-demo btn-large">Demo as Merchant</a>
     <a href="javascript:void(0);" onclick="startIntro2();" class="btn btn-demo btn-large">Demo as Buyer</a> -->

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
              	intro:"Let's begin by registering as a merchant!"

          }
            ],
            showStepNumbers: false
          });

          intro.start().oncomplete(function() {
          	window.location.href = '/user/register?demo=true'
          });

      }

      // function startIntro2() {
      //   var intro = introJs();
      //   intro.setOptions({
      //     stepes: [
      //     {
      //       intro: "Hello! Let's take a look at the buying process."
      //     },
      //     {
      //       element: '#step10',
      //       intro: "Let's donate to Michelle's campaign"
      //     }
      //     ],
      //     showStepNumbers: false
      //     });
      //   intro.start().oncomplete(function()) {
      //     window.location.href = '/user/account/account/15?demo=true'
      //   }):
      // }
    </script>

    <script type="text/javascript">
    if (RegExp('demo=true', 'gi').test(window.location.search)) {
      

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><center>Modal header</center></h3>
  </div>
  <div class="modal-body">
    <p><a href="javascript:void(0);" onclick="startIntro();" class="btn btn-demo btn-large" data-dismiss="modal">Demo as Merchant</a></p>
  </div>
</div>

<p><div class="demo-result-confirm hs-doc-callout hs-doc-callout-info" style="display: none"></div></p>
<script>
$('.demo-confirm').click(function(){
    vex.dialog.confirm({
        message: 'Are you absolutely sure you want to destroy the alien planet?',
        callback: function(value) {
            $('.demo-result-confirm').show().html('<h4>Result</h4><p>' + (value ? 'Successfully destroyed the planet.' : 'Chicken.') + '</p>');
        }
    });
});
</script>