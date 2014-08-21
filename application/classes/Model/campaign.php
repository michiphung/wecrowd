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
                    'type'          => $this->account_type,
                    'callback_uri'  => URL::site(NULL, TRUE) . 'wepayipn/' 
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

    public function getState() {
        if (isset($this->state)) {
            return $this->state;
        }
    }
}
