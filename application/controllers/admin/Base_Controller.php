<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends Core_Base_Controller {

    function __construct() {
        parent::__construct();

        $this->CheckUrl();
    }

    /**
     * For check url
     * @return boolean
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function CheckUrl() {
        if (!in_array($this->main->get_controller(), NO_LOGIN_PAGES)) {
            if (!$this->aauth->is_loggedin())
                $this->loadPage('', 'login-site');
            if ($this->aauth->getUserType() != 'admin' && $this->aauth->getUserType() != 'employee')
                $this->loadPage('', 'dashboard', true);
        }

        return TRUE;
    }

}
