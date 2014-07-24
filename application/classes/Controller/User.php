<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Base {

	public function action_index() {
		if (Auth::instance()->logged_in()){
			$user = Auth::instance()->get_user();
			$chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
			$this->template->content = View::factory('user/account');
			if (!($chef->hasAccessToken())) {
				$this->template->content->wepay = "<b>Please confirm your account to manage your money: <p><a class='wepay-widget-button wepay-blue' href=" . URL::base() . "wepayapi>Click here to receive confirmation email!</a>";
				$this->template->content->token = false;
			} else {
				$this->template->content->wepay = '';
				$this->template->content->token = true;
			}

			$this->template->content->name = $chef->name;
			$this->template->content->email = $chef->email;
			$this->template->content->kitchen = $chef->kitchen;
			$this->template->content->food = $chef->food;
			$this->template->content->price = number_format($chef->price,2);
			$this->template->content->edit = true;
		}
		else {
			$this->template->content = View::factory('welcome/index');
		}

		$this->template->content->base = URL::base($this->request);
	}

	public function action_account() {
		$id = Request::current()->param('id');
		if (!isset($id)) {
			HTTP::redirect('/');
		}
		$chef = ORM::factory('chef')->where('id', '=', $id)->find();
		$this->template->content = View::factory('user/account');
		if (Auth::instance()->logged_in()) {
			$user = Auth::instance()->get_user();
			if ($chef->email == $user->email) {
				$this->template->content->edit = true;
			}
			else {
				$this->template->content->edit = false;
			}

			if ($chef->hasAccessToken()) {
				$this->template->content->token = true;
			}

			if (!($chef->hasAccessToken())) {
				$this->template->content->wepay = "<b>Please confirm account to manage your money: <p><a class='wepay-widget-button wepay-blue' href=" . URL::base() . "wepayapi>Click here to create your WeCrowd account</a>";
				$this->template->content->token = false;
			}
			else if (!($this->template->content->edit) && $chef->hasAccountId()) {
				$this->template->content->wepay = "<a href=" . URL::base() . "user/create_credit_card/".$id." class='btn btn-danger btn-large' id='buy-now-button'>Buy ".$chef->food." Now!</a>";

			}
			else {
				$this->template->content->wepay = '';
			}
		}
		else {
			$this->template->content->wepay = '';
			if ($chef->hasAccountId()) {
				$this->template->content->wepay = "<a href=". URL::base() . "user/create_credit_card/".$id." class='btn btn-danger btn-large' id='buy-now-button'>Buy ".$chef->food." Now!</a>";
			}
			$this->template->content->token = true;
			$this->template->content->edit = false;
		}
		$this->template->content->name = $chef->name;
		$this->template->content->email = $chef->email;
		$this->template->content->kitchen = $chef->kitchen;
		$this->template->content->food = $chef->food;
		$this->template->content->price = number_format($chef->price,2);
		$this->template->content->base = URL::base($this->request);
	}

	public function action_create_credit_card(){
		$this->template->content = View::factory('user/create_credit_card');
	}

	public function action_charge_cc() {

		$credit_card_id = $_POST['credit_card_id'];
		$id = $_POST['account_id'];		
       	$chef = ORM::factory('chef')->where('id', '=', $id)->find();

		try {
            Controller_Wepayapi::create_checkout($credit_card_id, $chef);
        } catch (WePayPermissionException $e) {
            $this->template->content = "There was an error: " . $e->getMessage();
            return;
        }
    }

    public function action_payment_success() { 
    	$id = $_GET['account_id'];
    	$chef = ORM::factory('chef')->where('id', '=', $id)->find();

        $this->template->content = View::factory('user/charge_cc');
		$this->template->content->name = $chef->name;
		$this->template->content->email = $chef->email;
		$this->template->content->kitchen = $chef->kitchen;
		$this->template->content->food = $chef->food;
		$this->template->content->price = number_format($chef->price,2);
	}


	public function action_register(){
		$this->template->content = View::factory('user/register');
	}

	public function action_manage() {
		$user = Auth::instance()->get_user();
        $chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
        try  {
        	$manage_uri = Controller_Wepayapi::create_manage($chef->wepay_account_id);
        } catch (WePayPermissionException $e) {
        	$this->template->content = "There was an error" . $e->getMessage();
        	return;
        }
        $this->template->content = View::factory('user/manage');
        $this->template->content->manage_uri = $manage_uri;
        $this->template->content->wepay_link = 'https://stage.wepay.com/account/' . $chef->wepay_account_id;
     } 

	public function action_complete_registration() {

        $validation = Validation::factory($this->request->post())
            ->rule('username', 'not_empty')
            ->rule('password', 'not_empty')
            ->rule('password', 'min_length', array(':value', 6))
            ->rule('email', 'not_empty')
            ->rule('email', 'email')
            ->rule('price', 'numeric')
            ->rule('price', 'not_empty')
            ->rule('kitchen', 'not_empty')
            ->rule('food', 'not_empty');

        // Validation check
        if (!$validation->check()) {
            $errors = $validation->errors('user');
			$this->template->content = "Your registration was not valid!";
            return;
        }

        // Create User
        $user = ORM::factory('User');
		$user->username = $_POST['username'];
		$user->email = $_POST['email'];
		$user->password = $_POST['password'];

        try {
            $user->save();
        } catch (ORM_Validation_Exception $e) {
            $this->template->content = "There was a problem creating your user: " . var_dump($e->errors());
            return;
        }

        // Create Chef
		$chef = ORM::factory('chef');
		$chef->name = $_POST['username'];
		$chef->email = $_POST['email'];
		$chef->kitchen = $_POST['kitchen'];
		$chef->food = $_POST['food'];
		$chef->price = $_POST['price'];
		$chef->account_type = $_POST['account_type'];

        // Add login role
        $user->add('roles', ORM::factory('Role', array('name' => 'login')));

        try {
            $chef->save();
        } catch (ORM_Validation_Exception $e) {
            $this->template->content = "There was a problem creating your chef: " . var_dump($e->errors());
        }

		$success = Auth::instance()->login($_POST['email'], $_POST['password']);

		if ($success) {
			HTTP::redirect('user');
		} else{
			$this->template->content = "There was an error!";
		}
	}



	public function action_login(){
		$this->template->content = View::factory('user/login');
	}

	public function action_complete_login(){
		try{
			$post = Validation::factory($_POST)
				->rule('email', 'not_empty')
				->rule('email', 'email')
	            ->rule('password', 'not_empty')
	            ->rule('password', 'min_length', array('6'));
		} catch (Validation_Exception $e) {
			$this->template->content = "Your login was not valid: ".$e->errors();
		}

		$success = Auth::instance()->login($_POST['email'], $_POST['password']);

		if ($success){
			HTTP::redirect('user');
		} else{
			$this->template->content = "There was an error, try again";
		}
			
	}

	public function action_register_success(){

		$this->template->content = View::factory('user/register_success');
		$this->template->content->return_uri = URL::base() . '/user/account/';
	}

	public function action_logout(){
		#Sign out the user
		Auth::instance()->logout();
 
		#redirect to the user account and then the signin page if logout worked as expected
		HTTP::redirect('/');	

	}

	public function action_edit(){
		if (Auth::instance()->logged_in()){
			$user = Auth::instance()->get_user();
			$chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
			$this->template->content = View::factory('user/edit');
			$this->template->content->name = $chef->name;
			$this->template->content->email = $chef->email;
			$this->template->content->kitchen = $chef->kitchen;
			$this->template->content->food = $chef->food;
			$this->template->content->price = $chef->price;
		}
		else{
			$this->template->content = "Error, you're not logged in!";
		}
	}

    public function action_delete() {
		if (Auth::instance()->logged_in()){
			$this->template->content = "Delete? Really?";
			$user = Auth::instance()->get_user();
			$chef = ORM::factory('chef')->where('email', '=', $user->email)->find();

		    Auth::instance()->logout();
            $chef->delete();
            $user->delete();
		    HTTP::redirect('/');	
		}
		else{
			$this->template->content = "Error, you're not logged in!";
		}

    }

	public function action_update(){
		try{
			$post = Validation::factory($_POST)
            ->rule('name', 'not_empty')
            ->rule('email', 'not_empty')
            ->rule('email', 'email')
            ->rule('price', 'numeric')
            ->rule('price', 'not_empty')
            ->rule('kitchen', 'not_empty')
            ->rule('food', 'not_empty');
		} catch (Validation_Exception $e) {
			$this->template->content = "Your registration was not valid: ".$e->errors();
		}

		if (Auth::instance()->logged_in()){
			$user = Auth::instance()->get_user();
			$chef = ORM::factory('chef')->where('email', '=', $user->email)->find();
			$chef->food = $_POST['food'];
			$chef->kitchen = $_POST['kitchen'];
			$chef->price = $_POST['price'];
			$chef->save();

			HTTP::redirect('user');
		}
		else{
			$this->template->content = "You can't update information for this user!";
		}	
	}
} 
