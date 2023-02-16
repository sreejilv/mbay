<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base_Controller.php';

class Modules extends Base_Controller {

    /**
     * 
     * For load the modules to the system
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    function index() {
        $modules = $this->modules_model->getAllModules();
        foreach ($modules as $mod) {
            $db_vars = $mod['name'] . '_status';
            $key = strtoupper($db_vars);
            if (!$this->dbvars->__isset($key)) {
                $this->dbvars->$key = '1';
            }
        }
        $this->setData('modules', $modules);
        $this->setData('title', lang('menu_name_9'));
        $this->loadView();
    }

    /**
     * For change the module status
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    function change_module_status() {
         $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        $module = $get['module'];
        $status = $get['status'];
        if ($module && ($status == 1 || $status == 0)) {
            $db_vars = $module . '_status';
            $key = strtoupper($db_vars);
            $this->dbvars->$key = $status;
            if ($status == $this->dbvars->$key) {
                $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                if ($key == 'MAINTANANCE_STATUS') {
                    $this->load->model('send_mail_model');
                    $this->send_mail_model->send($log_user_id, '', 'maintanance_mail', array());
                }
                $this->modules_model->changeMenus($module, $status);
                $this->helper_model->insertActivity($log_user_id, 'change_module_status', $get);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For module settings
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     * @param type $module
     */
    function settings($module = '') {
        $data = $this->modules_model->getConfigUrl($module);
        if ($data['tab'] && $data['tab_session']) {
            $this->session->set_userdata($data['tab_session'], $data['tab']);
        }

        if ($data['link']) {
            $link = $this->modules_model->getMenuUrl($data['link']);
            $this->loadPage('', $link);
        } else {
            $this->loadPage(lang('url_not_set'), 'modules', 'warning');
        }
    }

}
