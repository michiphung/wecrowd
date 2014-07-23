<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Wepayapi extends Controller_Base {

    public function action_index() {

        if (Auth::instance()->logged_in()) {
            $config = Kohana::$config->load('wepay');

            $user = Auth::instance()->get_user();
            $chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
            $base_url = URL::site(NULL, TRUE);
     
            $wepay = new WePay(NULL);
            try {
                $response = $wepay->request('user/register/', array(
                    'client_id' => $config->get('client_id'),
                    'client_secret' =>   $config->get('client_secret'),
                    'email'       => $chef->email,
                    'scope'         => "manage_accounts,collect_payments,view_user,preapprove_payments,manage_subscriptions,send_money",
                    'first_name'        => 'Chef',
                    'last_name'         => $chef->name,
                    'original_ip'       => "74.125.224.84",
                    'original_device'   => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.102 Safari/534.13",
                    'redirect_uri' => $base_url.'user/manage'
                ));
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if ($chef->createAccount($response->access_token)) {
                $this->template->content = "Thank you! Please check your email to finish registering! <a href=\"" . URL::base() . "\">Back</a>";
                $resend_email = new WePay($chef->getAccessToken());    
                $resend_email->request('user/resend_confirmation/', array());
                } else {
                    $this->template->content = "FreshCook Account Failed! <a href=\"" . URL::base() . "\">Back</a>";
                }
            } else {
            $this->template->content = "Not Logged In";
        }
    }

    public static function create_manage($account_id) {
        $config = Kohana::$config->load('wepay');
        $user = Auth::instance()->get_user();
        $chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
        $base_url = URL::site(NULL, TRUE);
        $wepay = new WePay($chef->getAccessToken());  
        $response = $wepay->request('account/get_update_uri/', array(
            'account_id' => $chef->wepay_account_id,
            'mode' => 'iframe',
            'redirect_uri' => $base_url.'user/register_success/'
            ));
        return $response->uri;
    }


    public static function create_checkout($credit_card_id, $merchant) {
        $config = Kohana::$config->load('wepay');

        $wepay = new WePay($merchant->getAccessToken());
        $response = $wepay->request('checkout/create/', array(
                    'account_id'          => $merchant->getAccountId(),
                    'short_description'   => "Purchasing ".$merchant->food." from ".$merchant->name.".",
                    'type'                => 'goods',
                    'amount'              => $merchant->price,
                    'payment_method_id'   => $credit_card_id,
                    'payment_method_type' => 'credit_card'
                    ));
    }
}
