<?php

/*
 * Model that represents a farmer in WeFarm
 *
 */
class Model_campaign extends ORM {

    public function createAccount($access_token) {
        $wepay = new WePay($access_token);

        try {
            $response = $wepay->request('account/create/', array(
                    'name'          => $this->first_name,
                    'description'   => $this->first_name."'s WeCrowd account",
                    'country'       => "US",
                    'currencies'    => array("USD"),
                    'type'          => $this->account_type 
                    ));
        }
        catch (Exception $e) {
            // Something went wrong - normally you would log
            // this and give your user a more informative message
            echo $e->getMessage();
            return false;
        }
        $this->saveAccountId($response->account_id);
        $this->saveAccessToken($access_token); 
        return true;

    }

    // public function userRegister($name, $email) {
        
    //     // set API Version. Change this to the API Version you want to use.
    //     // $API_VERSION = "2014-01-08";
    //     // WePay::useStaging($config->get('client_id'), $config->get('client_secret'), $API_VERSION);
    //     $base_url = URL::site(NULL, TRUE);

    //     $wepay = new WePay(NULL);
    //     try {
    //     $response = $wepay->request('user/register/', array(
    //             'client_id' => $config->get('client_id'),
    //             'client_secret' =>   $config->get('client_secret'),
    //             'email'       => $email,
    //             'scope'         => "manage_accounts,collect_payments,view_user,preapprove_payments,manage_subscriptions,send_money",
    //             'first_name'        => 'Chef',
    //             'last_name'         => $name,
    //             'original_ip'       => "74.125.224.84",
    //             'original_device'   => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.102 Safari/534.13",
    //             'redirect_uri' => $base_url.'user/manage'
    //         ));
    //     }
    //     catch (Exception $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    //     $this->saveAccessToken($response->access_token);
    //     return true;
    // }

    // public function userManage($access_token) {
    //     //$config = Kohana::$config->load('wepay');
    //     // $API_VERSION = "2014-01-08";
    //     // WePay::useStaging($config->get('client_id'), $config->get('client_secret'), $API_VERSION);
    //     $base_url = URL::site(NULL, TRUE);

    //     $user = Auth::instance()->get_user();
    //     $chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
    //     $wepay = new WePay($access_token);
    //     try {      
    //         $response = $wepay->request('account/get_update_uri/', array(
    //             'account_id' => $chef->wepay_account_id,
    //             'mode' => 'iframe',
    //             'redirect_uri' => $base_url.'user/register_success/'
    //             ));
    //         }
    //         catch (Exception $e) {
    //             echo $e->getMessage();
    //             return false;
    //         }
    //         return true;
    // }

    public function saveAccessToken($access_token){
        $this->wepay_access_token = $access_token;
        $this->save();
    }

    public function saveAccountId($account_id){
        $this->wepay_account_id = $account_id;
        $this->save();
    }

    public function getAccessToken(){
        if (isset($this->wepay_access_token)){
            return $this->wepay_access_token;
        }
    }

    public function getId(){
        if(isset($this->wepay_access_token)) {
            return $this->id;
        }
    }

    public function getAccountId(){
        if (isset($this->wepay_account_id)){
            return $this->wepay_account_id;
        }
    }

    public function hasAccessToken(){
        if (isset($this->wepay_access_token)){
            return true;
        }
        return false;
    }

    public function hasAccountId(){
        if (isset($this->wepay_account_id)){
            return true;
        }
        return false;
    }
}
