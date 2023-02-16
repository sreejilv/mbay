<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

class Client extends Base_Controller {

    public function enroll_affiliates() {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->aauth->getUserType() == 'user') {
            $sponsername = $this->aauth->getUserName();
        } else {
            $sponsername = $this->helper_model->getAdminUsername();
        }

        if ($this->input->post('enroll') && $this->validate_affiliates()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->client_model->enrollAffiliate($post);
            if ($res) {
                $this->helper_model->insertActivity($logged_user, 'affiliate_enrolled', $post);
                $this->loadPage(lang('affiliate_enrolled_success'), 'enroll-affiliates');
            } else {
                $this->loadPage(lang('affiliate_enroll_failed'), 'enroll-affiliates', 'danger');
            }
        }

        $countries = $this->helper_model->getAllCountries();
        $states = array();
        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();

        $this->setData('user_type', $user_type);
        $this->setData('sponsername', $sponsername);
        $this->setData('states', $states);
        $this->setData('countries', $countries);
        $this->setData('logged_user', $logged_user);
        $this->setData('register_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_120'));
        $this->loadView();
    }

    public function validate_affiliates() {
        $this->form_validation->set_rules('sponser_name', lang('sponser_name'), 'required|callback_validate_sponsor|trim');
        $this->form_validation->set_rules('affiliate_name', lang('affiliate_name'), 'required|callback_validate_affiliate|trim|min_length[4]|max_length[10]|alpha_numeric');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[6]');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('mobile_no', lang('mobile_no'), 'required|numeric');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function validate_sponsor($username = '') {
        if ($username != '') {
            $flag = false;
            if ($this->helper_model->userNameToID($username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('username')) {
            if ($this->helper_model->userNameToID($this->input->get('username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    function validate_affiliate($affiliate = '') {
        $flag = false;
        if ($affiliate != '') {
            if (!$this->client_model->validateAffiliate($affiliate)) {
                $flag = true;
            }
        } elseif ($this->input->get('affiliate')) {
            if (!$this->client_model->validateAffiliate($this->input->get('affiliate'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
        return $flag;
    }

    public function time_shedule($enc_id = '') {
        $shedule_id = $this->helper_model->decode($enc_id);
        $flag = 0;
        $admin_mail = '';
        if ($this->client_model->validateSheduleId($shedule_id)) {
            $flag = 1;
        } else {
            $admin_mail = $this->helper_model->getAdminMailId();
        }
        if ($this->input->post('shedule') && $this->validate_shedule()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->client_model->addSheduleTime($post);
            if ($res) {
                $affiliate_data = $this->client_model->getAffiliateId($post['shedule']);
                if ($affiliate_data) {
                    $details = $this->client_model->getAffiliateDetails($affiliate_data);
                    $this->load->model('send_mail_model');
                    $this->send_mail_model->send('', $details['email'], 'shedule_confirmation', $details);
                }
                $this->loadPage(lang('shedule_time_added'), 'shedule-time');
            } else {
                $this->loadPage(lang('failed_to_add_shedule_time'), 'shedule-time/' . $enc_id, 'danger');
            }
        }
        $this->setData('shedule_error', $this->form_validation->error_array());
        $this->setData('shedule_id', $shedule_id);
        $this->setData('flag', $flag);
        $this->setData('admin_mail', $admin_mail);
        $this->setData('title', lang('time_shedule'));

        $this->loadView();
    }

    public function validate_shedule() {
        $this->form_validation->set_rules('sdl_date', lang('sdl_date'), 'required|callback_validate_date');
        $this->form_validation->set_rules('sdl_time', lang('sdl_time'), 'required');
        $validation = $this->form_validation->run();
        return $validation;
    }

    public function validate_date($date = '') {
        $startDate = strtotime(date("Y-m-d H:i:s"));
        if ($date) {
            $endDate = strtotime($date);
            if ($endDate >= $startDate)
                return True;
            else {
                $this->form_validation->set_message('validate_date', lang('should_be_greate_than_today'));
                return False;
            }
        } elseif ($this->input->get('sdl_date')) {
            $endDate = strtotime($this->input->get('sdl_date'));
            if ($endDate >= $startDate) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

}
