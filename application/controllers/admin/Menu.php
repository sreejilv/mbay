<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Base_Controller.php';

class Menu extends Base_Controller {

    /**
     * For Load menu management View
     * @author Techffofils Technologies LLP
     * @date 201-12-02
     * 
     */
    function menu_management($setup_flag=0) {
        $main_menus = $this->menu_model->getAllMainMenus($setup_flag);
        if ($this->dbvars->GOOGLE_TRANSLATOR_STATUS > 0) {
            $this->load->model('configuration_model');
            $untranslated_fields = $this->configuration_model->getUntranslatedFields();
        } else {
            $untranslated_fields = 0;
        }
        $this->setData('affiliate_status', $this->dbvars->AFFILIATES_STATUS);
        $this->setData('employee_status', $this->dbvars->EMPLOYEE_STATUS);
        $this->setData('untranslated_fields', $untranslated_fields);
        $this->setData('main_menus', $main_menus);
        $this->setData('title', lang('menu_name_92'));
        $this->loadView();
    }

    /**
     * For Change menu permission
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_menu_permission() {
         $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        
        $menu_id = $get['id'];
        $status =$get['status'];
        $type = $get['type'];
        if ($menu_id && ($status == 1 || $status == 0) && ($type == 'employee' || $type == 'user' || $type == 'admin' || $type == 'affiliate')) {
            $res = $this->menu_model->changeMenuPermission($menu_id, $status, $type);
            if ($res) {

                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'change_menu_permission', $get);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For Change menu status like enable or disable based on logged user
     * @author Techffodils Technologies LLP
     * @date 2017-12-02  
     */
    function change_menu_status() {
         $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        
        $menu_id = $get['id'];
        $status =$get['status'] ;
        if ($menu_id && ($status == 1 || $status == 0)) {
            $res = $this->menu_model->changeMenuStatus($menu_id, $status);
            if ($res) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'change_menu_status', $get);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For Update the menu name ,administrator who can change the menu names already existing
     * @author Techffodils Technologies LLP
     * @date 2017-12-03
     */
    function change_menu_name() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $response['success'] = false;
        $response['msg'] = lang('menu_name_is_required');
        $this->load->helper('file');

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $preset_demo = $this->dbvars->PRESET_DEMO_STATUS;
        if ($preset_demo) {
            $response['success'] = false;
            $response['msg'] = lang('operation_blocked_for_preset_demo');
        } elseif ($post['value']) {
            $field = 'menu_name_' . $post['name'];
            $file_path = FCPATH . 'application/language/english/common_lang.php';
            if (file_exists($file_path)) {
                $result = str_replace("'", '`', $post['value']);
                $text = "$" . "lang['" . $field . "']='" . $result . "';\n";
                if (write_file($file_path, $text, 'a+')) {
                    $response['success'] = true;
                    $this->helper_model->addNewLanguageField($user_id, $field, $result);
                    $this->helper_model->insertActivity($user_id, 'change_menu_name', $post);
                }
            }
        }
        echo json_encode($response);
        exit();
    }

    /**
     * For changing the menu icons for existing menu
     * @author Techffodils Technlogies LLP
     * @date 2017-12-03
     */
    function change_menu_icon() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $response['success'] = false;
        $response['msg'] = lang('menu_icon_is_required');

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $preset_demo = $this->dbvars->PRESET_DEMO_STATUS;
        if ($preset_demo) {
            $response['success'] = false;
            $response['msg'] = lang('operation_blocked_for_preset_demo');
        } elseif ($post['value']) {
            $res = $this->menu_model->updateMenuIcon($post['name'], $post['value']);
            if ($res) {
                $response['success'] = true;
                $this->helper_model->insertActivity($user_id, 'change_menu_icon', $post);
            }
        }
        echo json_encode($response);
        exit();
    }

    /**
     * For re-arrange the menu order 
     * @author Techffodils Technologies LLP
     * @date 2017-12-03
     */
    function change_menu_order() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $response['success'] = false;
        $response['msg'] = lang('menu_order_is_required');

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $preset_demo = $this->dbvars->PRESET_DEMO_STATUS;
        if ($preset_demo) {
            $response['success'] = false;
            $response['msg'] = lang('operation_blocked_for_preset_demo');
        } elseif ($post['value']) {
            $res = $this->menu_model->updateMenuOrder($post['name'], $post['value']);
            if ($res) {
                $response['success'] = true;
                $this->helper_model->insertActivity($user_id, 'change_menu_order', $post);
            }
        }
        echo json_encode($response);
        exit();
    }

}
