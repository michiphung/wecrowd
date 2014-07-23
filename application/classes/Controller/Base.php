<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template {

    public $template = 'template';

    public function before() {
        parent::before();

        if (Auth::instance()->logged_in()) {
            $this->template->header = View::factory('templates/logged_in');
        } else {
            $this->template->header = View::factory('templates/header');
        }

        $this->template->content = '';
        $this->template->table = '';
    }
}