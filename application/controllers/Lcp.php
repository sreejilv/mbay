<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

/**
 * Controller Related For Leads
 * @author Techffodils Technologies LLP
 * @copyright (c) 2017, Techffodils Technologies
 */
class Lcp extends Base_Controller {

    /**
     * For load the Lead capture form
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $username
     */
    public function index($username = "") {
        if ($this->helper_model->userNameToID($username)) {
            $this->session->set_userdata('lcp_username', $username);
        } else {
            if ($this->session->userdata('lcp_username') != null)
                $username = $this->session->userdata('lcp_username');
        }
        $user_id = $this->helper_model->userNameToID($username);
        if (!$user_id) {
            $this->loadPage(lang('invalid_username'), 'user-lead/lead', 'warning');
        }

        if ($this->input->post('lead') && $this->validate_leads()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            if (!$user_id) {
                $user_id = $this->helper_model->getAdminId();
            }
            $res = $this->lcp_model->addLCP($post, $user_id);
            if ($res) {
                $this->loadPage(lang('lead_added'), 'user-lead/' . $username);
            }
        }
        $countries = $this->helper_model->getAllCountries();
        $this->setData('countries', $countries);
        $this->setData('username', $username);
        $this->loadView();
    }

    /**
     * For validate LCP Form
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function validate_leads() {
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
        $this->form_validation->set_rules('mobile', lang('mobile'), 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('comment', lang('comment'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        return $this->form_validation->run();
    }

}
