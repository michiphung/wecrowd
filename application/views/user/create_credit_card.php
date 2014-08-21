<h1> Please enter your credit card information </h1>
<script type="text/javascript" src="https://static.wepay.com/min/js/tokenization.v2.js">
</script>

<script type="text/javascript">
    WePay.set_endpoint("stage"); // change to "production" when live

function chargeCard(){
        var response = WePay.credit_card.create( {
            "client_id":<?=Kohana::$config->load('wepay.client_id');?>,
            "user_name":document.getElementById('name').value,
            "email":document.getElementById('email').value,
            "cc_number":document.getElementById('cc-number').value,
            "cvv":document.getElementById('cc-cvv').value,
            "expiration_month":document.getElementById('cc-month').value,
            "expiration_year":document.getElementById('cc-year').value,
            "address":
                {
                    "zip":document.getElementById('zip').value
                }
        }, function(data) {
            if (data.error) {
                console.log(data);
                // handle error response
            } else {
            	var account_id = document.getElementById("account_id").value,
                    credit_card_id = data.credit_card_id;
            	$.post("/user/charge_cc/", {account_id : account_id , credit_card_id : credit_card_id}, function() {
                    //alert('Success');
                    window.location.href = '/user/payment_success' + '?account_id=' + account_id;
                    }
                    );

                // call your own app's API to save the token inside the data;
                // show a success page

            }

        } );
    }
</script>
<table id="step11">
	<input type="hidden" id="account_id" value="<?=Request::current()->param('id')?>" />
    <tr><td>Name: </td><td><input id="name" type="text" value="Bob Smith" readonly></input></td></tr>
    <tr><td>Email: </td><td><input id="email" type="text" value="example@example.com" readonly></input></td></tr>
    <tr><td>Credit Card Number: </td><td><input id="cc-number" type="text" value="4003830171874018" readonly></input></td></tr>
    <tr><td>Expiration Month: </td><td><input id="cc-month" type="text" value="7" readonly></input></td></tr>
    <tr><td>Expiration Year: </td><td><input id="cc-year" type="text" value="2020" readonly></input></td></tr>
    <tr><td>CVV: </td><td><input id="cc-cvv" type="text" value="123" readonly></input></td></tr>
    <tr><td>Zipcode: </td><td><input id="zip" type="text" value="94306" readonly></input></td></tr>
    <tr><td></td><td><input id="step12" type="submit" name="Submit" value="Submit" onclick="chargeCard()"/></td></tr>
</table>

<script type="text/javascript"> 
  if (RegExp('demo=true', 'gi').test(window.location.search)) {
    var intro = introJs();
    intro.setOptions({
      steps: [
        {
          element: "#step11",
          intro: "We already have everything prefilled for you!"
        }
        {
          element: "#step12",
          intro: "After submitting your credit card information, '/credit_card/create' is called. This gives you a credit_card_id which can be used to pass in your '/checkout/create'. This is similiar to how preapproval ids work."
        }
      ],
      showStepNumbers: false
    })
    intro.start();
  }
</script>

