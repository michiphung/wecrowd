<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Wepayipn extends Controller_Base {

	public function action_index() {
		if (Auth::instance()->logged_in()) {
			$config = Kohana::$config->load('wepay');
            $user = Auth::instance()->get_user();
            $campaign = ORM::factory('campaign')->where('email', '=', $user->email)->find();
            $this->template->content = View::factory('user/account_summary');
			if (!empty($_POST['account_id'])) {
				$account_id= $_POST['account_id'];
				echo 'there is a post';
			}
			$wepay = new WePay($campaign->getAccessToken());
        	try {
           		 $response = $wepay->request('account', array(
                	    'account_id'          => $account_id
                    	));
        	} catch (Exception $e) {
            	echo $e->getMessage();
        	}


            $balance = $response->balances;
            $this->template->content->balance = $balance[0]->balance;
            $this->template->content->state = $response->state;

            $campaign->balance = $balance[0]->balance;
            $campaign->state = $response->state;
 
    	} else {
    		$this->template->content = "Not logged in!";
    	}
	}
}


