<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'admin/Base_Controller.php';

class Replication extends Base_Controller {

    /**
     * For replicate site load 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $user_name
     */
    public function index($username = "") {



        if ($username != '') {
            $check_status = $this->helper_model->isUserExist($username);
            if ($check_status) {
                $user_id = $this->helper_model->userNameToID($username);
                $this->session->set_userdata('repli_user', $username);
            } else {
                $this->session->unset_userdata('repli_user');
                $admin_username = $this->replication_model->getAdminUserName('admin');
                $user_id = $this->helper_model->userNameToId($admin_username);
                $this->session->set_userdata('repli_user', $admin_username);
            }
        } else {
            $admin_username = $this->replication_model->getAdminUserName('admin');
            $user_id = $this->helper_model->userNameToId($admin_username);
            $this->session->set_userdata('repli_user', $admin_username);
        }
        $user_type = $this->replication_model->getUserTypes($user_id);

        if (!$user_id) {
            $this->loadPage(lang('no_such_user_exits'), 'replicate-site/' . $admin_username, 'danger');
        }

        $get_details = $this->replication_model->getReplicatinUserDetails($user_id);

        $encode_id = $this->helper_model->encode($user_id);
        $login_status = 'no';
        if ($this->aauth->is_loggedin()) {
            $login_status = 'yes';
        }
        $replicate_link = BASE_PATH . 'replicate-site/' . $username;

        $events = $this->replication_model->getEvents();
        $news = $this->replication_model->getNews();

        $this->setData('login_status', $login_status);
        $this->setData('details', $get_details);
        $this->setData('type', $user_type);
        $this->setData('title', lang('replica'));
        $this->setData('encode_id', $encode_id);
        $this->setData('replica_link', $replicate_link);

        $this->setData('events', $events);
        $this->setData('news', $news);
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function contact() {
        $this->setData('title', lang('contact_us'));
        $this->loadPage();
    }

}
