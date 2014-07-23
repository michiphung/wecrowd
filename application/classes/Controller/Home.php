<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base {

    public function action_index() {
        $this->template->content = View::factory('welcome/index');
        $total = count(ORM::factory('chef')->find_all());
        $count = 0;
        $table = array();
        $id = 1;

        while ($count < $total) {
            $chef = ORM::factory('chef')->where('id', '=', $id)->find();
            if (isset($chef->name)) {
                array_push($table, $chef);
                $count++;
            }
            $id++;
        }
        $this->template->table = $table;
    }
}