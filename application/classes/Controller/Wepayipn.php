<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Wepayipn extends Controller_Base {

	public function action_index() {
        if (!empty($_POST['account_id'])) {
				$account_id= $_POST['account_id'];
		}
        $config = Kohana::$config->load('wepay');
        $campaign = ORM::factory('campaign')->where('wepay_account_id', '=', $account_id)->find();
        $wepay = new WePay($campaign->getAccessToken());
        	try {
           		 $response = $wepay->request('account', array(
                	    'account_id'          => $account_id
                    	));
        	} catch (Exception $e) {
            	echo $e->getMessage();
        	}

            $balance = $response->balances;
            $campaign->balance = $balance[0]->balance;
            $campaign->state = $response->state;
            $campaign->save();
    	}
	}


