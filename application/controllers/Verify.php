<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'admin/Base_Controller.php';

class Verify extends Base_Controller {

    public function index() {
        $msg=$this->session->userdata('redirect_msg');
        $page=$this->session->userdata('redirect_path');
        $this->loadPage($msg, $page, '', true);
    }

}
