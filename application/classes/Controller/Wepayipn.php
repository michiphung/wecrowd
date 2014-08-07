<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Wepayipn extends Controller_Base {

	public static function get_state($merchant) {
		if (Auth::instance()->logged_in()) {
			$config = Kohana::$config->load('wepay');
			echo $_POST['account_id'];
			if (!empty($_POST['account_id'])) {
				$account_id= $_POST['account_id'];
				echo 'there is a post';
			}
			$wepay = new WePay($merchant->getAccessToken());
        	try {
           		 $response = $wepay->request('account/', array(
                	    'account_id'          => $account_id
                    	));
        	} catch (Exception $e) {
            	echo $e->getMessage();
        	}
        		print_r($response);
        		return $response->state;
    	} else {
    		$this->template->content = "Not logged in!";
    	}
	}
}


