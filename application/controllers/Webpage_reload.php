<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'admin/Base_Controller.php';

class Webpage_reload extends Base_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * For automatic lock the system
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function check_time() {
        $flag = 'not_timeout';

        if ($this->session->userdata('__ci_last_regenerate')) {
            $lastActivity = $this->session->userdata('__ci_last_regenerate');
            $current_time = time();
            if ($current_time - $lastActivity >= 1800) {
                $flag = "timeout";
            }
        }
        echo $flag;
        exit();
    }

}

?>