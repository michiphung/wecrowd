<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base {

    public function action_index() {
        $this->template->content = View::factory('welcome/index');
        $total = count(ORM::factory('campaign')->find_all());
        $count = 0;
        $table = array();
        $id = 1;

        while ($count < $total) {
            $campaign = ORM::factory('campaign')->where('id', '=', $id)->find();
            if (isset($campaign->name)) {
                array_push($table, $campaign);
                $count++;
            }
            $id++;
        }
        $this->template->table = $table;
    }
}