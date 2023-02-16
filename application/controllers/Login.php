<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

/**
 * @author Techffodils Technologies LLP
 * Class Login
 */
class Login extends Base_Controller {

    /**
     * loading index page.
     * @author Techffodils Technologies LLP
     */
    
    public function index() {
        $key = $this->dbvars->GOOGLE_CAPTCHA_KEY;
        if ($this->aauth->getId()) {
            $user_type = $this->aauth->getUserType();
            if($user_type =='user'){
                $active = 1;
                $this->loadPage('', 'account/'.$active);
              }
                $this->loadPage('', 'dashboard');

        }
        if ($this->input->post('login') && $this->site_login()) {
            $user_type = $this->aauth->getUserType();
            $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'user_login');
            if($user_type =='user'){
                $active = 1;
                $this->loadPage('', 'account/'.$active);
              }
            $this->loadPage('', 'dashboard');
        }

        $this->load->model('register_model');
        
        if ($this->input->post('add_user') && $this->validate_registration_new()){
            $this->load->helper('security');
            $user_details = $this->security->xss_clean($this->input->post());
            $user_details['date_of_joining'] = date('Y-m-d H:i:s');
            $user_details['register_type'] = 'single_step';
            $user_details['username'] = $this->register_model->generateRandomUsername(8);
            $payment_method ='free_registration';
            $user_details['payment_method'] = $payment_method;
            $user_details['country'] = '';
            $user_details['state'] = '';
            $user_res = $this->register_model->addUser('single_step', $user_details,$mlm_plan = 'BINARY', $package_id = 0);
            if($user_res){
                if ($this->aauth->login($user_details['email'], $user_details['password'], isset($user_details['remember']) ? TRUE : FALSE)) {
                    $user_id = $this->helper_model->userNameToID($user_details['email']);
                    // if ($this->dbvars->EMAIL_VERIFICATION_STATUS > 0 && !$this->aauth->is_banned($user_id)) {
                        echo "user login"; print_R($this->aauth->getId());die;
                    // }
            }
        }
        }
        if ($this->dbvars->CAPTCHA_STATUS > 0 || $this->aauth->get_login_attempts() > $this->dbvars->CAPTCHA_LOGIN)
            $this->setData('CAPTCHA_STATUS', 1);
        $this->setData('key', $key);

        $this->setData('EMPLOYEE_STATUS', $this->dbvars->EMPLOYEE_STATUS);
        $this->setData('AFFILIATES_STATUS', $this->dbvars->AFFILIATES_STATUS);
        $this->setData('sytem_title', $this->helper_model->getSystemPath());
        $this->setData('title', lang('login'));
        $this->loadView();
    }
    public function validate_registration_new() {
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|callback_valid_email');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|min_length[6]');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }
    function valid_email($email = '') {
     
        if ($email != '') {
            $flag = false;
            if (!$this->helper_model->getUserIdFromEmailId($email) && !$this->register_model->checkEmailInPending($email)) {
                $flag = TRUE;
            }
            return $flag;
        } elseif ($this->input->get('email')) {
            if (!$this->helper_model->getUserIdFromEmailId($this->input->get('email'))) {

                echo 'yes';
                exit();
            }

            echo 'no';
            exit();
        }
    }
    /**
     *  For validating login details.
     * @author Techffodils Technologies LLP
     * @return bool
     */
    function site_login() {

        $this->form_validation->set_rules('username', lang('user_name'), 'required|strip_tags|min_length[3]|max_length[30]|htmlentities');
        $this->form_validation->set_rules('password', lang('password'), 'required');
        $run = $this->form_validation->run();
        if ($run) {
          
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            if ($this->aauth->login($post_data['username'], $post_data['password'], isset($post_data['remember']) ? TRUE : FALSE)) {
                $user_id = $this->helper_model->userNameToID($post_data['username']);
                // if ($this->dbvars->EMAIL_VERIFICATION_STATUS > 0 && !$this->aauth->is_banned($user_id)) {
                //     //sarun check one time verification//
                //     $id_encrypt = $this->login_model->crypt($user_id, 'e');
                //     $this->loadPage('', 'login/verification/' . $id_encrypt);
                // }
                return TRUE;
            } else {
                $this->loadPage($this->aauth->error_return(), 'login-site', 'danger');
            }
        }
        return FALSE;
    }

    /**
     * For Fogot Password Function
     * @author Techffodils Technologies LLP
     * @Date 2017-10-09

     */
    function forgot_password() {
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        $this->load->helper('security');
        $post_arr = $this->security->xss_clean($this->input->post());
        if ($this->input->post('for_pass') && $this->validate_email()) {
            $email_or_username = $post_arr['email'];
            $user_id = $this->helper_model->userNameToID($email_or_username);
            if ($user_id) {
                $this->load->model('send_mail_model');
                $result = $this->send_mail_model->send($user_id, '', 'forgot_password');

                if ($result) {
                    $this->loadPage(lang('successfully_send_mail'), 'login-forgot');
                } else {
                    $this->loadPage(lang('failed_to_send_mail'), 'login-forgot', 'danger');
                }
            } else {
                $this->loadPage(lang('email_inv_js'), 'login-forgot', 'danger');
            }
        }
        $this->setData('title', lang('forgot_password_heading'));
        $this->loadView();
    }

    /**
     * For Validate Email
     * @author Techffodils Technologies LLP
     * @Date 201710-10-09

     */
    function validate_email() {
        $this->form_validation->set_rules('email', lang('login_identity_label'), 'trim|required|callback_validate_user');
        $validate_form = $this->form_validation->run();
        return $validate_form;
    }

    /**
     * For validate the logged user
     * @author Techffodils Technologies LLP
     * @param string $username
     * @return bool
     */
    function validate_user($username = '') {
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

    /**
     * for reset the password
     * @author Techffodils Technologies LLP
     * @date 2017-11-3
     * @param type $encrypt_key
     */
    function reset_password($reset_ref) {
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        $reset_link = $this->helper_model->decode($reset_ref);
        $userid = $this->login_model->userIdFromResetLink($reset_link);
        $link_validity = TRUE;
        if ($userid) {
            if ($this->input->post('submit') == 'Reset' && $this->validate_reset_password()) {
                $this->load->helper('security');
                $post = $this->security->xss_clean($this->input->post());
                $password = hash("sha256", $post['new_password']);
                $result = $this->login_model->resetPassword($password, $userid);
                $this->helper_model->insertActivity($userid, 'res_pass', $post);
                if ($result) {
                    $this->login_model->inactivateResetLink($reset_link);
                    $this->loadPage(lang('password_reset_successfully'), 'login-site');
                } else {
                    $this->loadPage(lang('password_reset_failed'), 'login-forgot', 'danger');
                }
            }
        } else {
            $link_validity = FALSE;
            $this->setData("link_expiry_reason", $this->login_model->getLinkExpiryReason($reset_link));
        }

        $this->setData("title", lang('reset_password'));
        $this->setData("link_validity", $link_validity);
        $this->setData('user_id', $userid);
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * For validating login request.
     * @return mixed
     */
    function validate_reset_password() {
        $this->form_validation->set_rules('new_password', lang('new_password'), 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'required|trim|min_length[6]|matches[new_password]');
        $validate_form = $this->form_validation->run();

        return $validate_form;
    }

    /**
     * for logout.
     * @author Techffodils Technologies LLP
     * @date 2017-11-3
     * Destroy all sessions and cookies.
     */
    function logout() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $employee_id = ($this->aauth->getUserType() == 'employee') ? $this->aauth->getId() : 0;
        if ($user_id && $this->aauth->logout()) {
            if ($user_type == 'affiliate') {
                $this->helper_model->insertAffiliateActivity($user_id, 'user_logout', array(), 'fa-lock', 'red');
            } else {
                $this->helper_model->insertActivity($user_id, 'user_logout', array(), $employee_id);
            }
        }

        $url = 'login-site';
        if ($user_type == 'employee') {
            $url = 'employee-login';
        } elseif ($user_type == 'affiliate') {
            $url = 'affiliate-login';
        }
        $this->loadPage(lang('logout_successfully'), $url);
    }

    /**
     * For setting auto time out.
     * @author Techffodils Technologies LLP
     * @date 2017-11-3
     */
    public function session_timeout() {
        $lastActivity = $this->session->userdata('mlm_last_activity');
        $configtimeout = $this->config->item("sess_expiration");
        $sessonExpireson = $lastActivity + $configtimeout;
        $current_time = time();
        if ($sessonExpireson <= $current_time) {
            $user_data = $this->session->all_userdata();
            foreach ($this->session->userdata as $key => $value) {
                if (strpos($key, 'mlm_') === 0) {
                    $this->session->unset_userdata($key);
                }
            }
            echo "Session Destroyed";
        }
        exit;
    }

    /**
     * For loading maintenance view.
     * @author Techffodils Technologies LLP
     * @date 2017-11-3
     */
    public function maintence() {
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2017-11-3
     * For one time verification.
     * @param string $id_encrypt
     */
    function verification($id_encrypt = '') {
        $user_id = $this->login_model->crypt($id_encrypt, 'd');
        $username = $this->helper_model->IdToUserName($user_id);

        if (!$username || $this->aauth->is_banned($user_id)) {
            $this->loadPage(lang('something_went_wrong'), 'login-site', 'danger');
        }
        $user_verification_code = $this->login_model->userVerficationCode($user_id);
        if ($this->input->post('submit')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $verification_code = $post['verification_code'];
            if ($verification_code == $user_verification_code) {
                $res = $this->aauth->verify_user($user_id, $verification_code);
                if ($res) {
                    $this->aauth->login_fast($user_id);
                    $this->helper_model->insertActivity($user_id, 'user_verification');
                    $this->loadPage('', 'dashboard', '', true);
                } else {
                    $this->loadPage(lang('something_went_wrong'), 'login/verification/' . $id_encrypt, 'danger');
                }
            } else {
                $msg = lang('inv_verification_code');
                $this->loadPage($msg, 'login/verification/' . $id_encrypt, 'danger');
            }
        }
        $this->setData('username', $username);
        $this->setData('title', lang('one_time_verification'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2017-11-3
     * For resending verification code.
     */
    function resend_verification_code() {
        $username = $this->input->get('username');
        $user_id = $this->helper_model->userNameToID($username);
        if ($user_id) {
            $this->load->model('send_mail_model');
            $data['ver_code'] = $this->helper_model->generateRandomString(8);
            $res = $this->send_mail_model->send($user_id, '', 'send_verification_code', $data);
            if ($res) {
                $this->helper_model->updateEmailVerfication($user_id, $data['ver_code']);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For automatic system lock.
     * @author Techffodils Technologies LLP
     * @date 2017-10-21
     * @day Saturday
     * 
     */
    function automatic_systemlock() {

        if ($this->aauth->is_loggedin()) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            foreach ($this->session->userdata as $key => $value) {
                if (strpos($key, 'mlm_') === 0) {
                    $this->session->unset_userdata($key);
                }
            }
            $this->session->set_userdata('locked_user', $user_id);
        } else {
            $user_id = $this->session->userdata('locked_user');
        }

        $user_name = $this->helper_model->IdToUserName($user_id);
        if ($user_name) {
            $this->helper_model->insertActivity($user_id, 'user_lock');
            $encode_name = $this->helper_model->encode($user_name);
            $this->loadPage('', 'login-lock/' . $encode_name);
        } else {
            $this->loadPage('', 'login-site', '', true);
        }
    }

    /*
     *  for lock screen loading
     * @param type $encode_user_name
     * @author Techffodils Technologies LLP.com
     * @day 2017-10-21 Saturday
     */

    function lock_screen($encode_user_name = NULL) {
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        if (!empty($this->session->userdata('locked_user'))) {
            $user_name = $this->helper_model->decode($encode_user_name);
            $user_id = $this->helper_model->UserNameToID($user_name);
            if (!$user_id) {
                $this->loadPage(lang('logout_successfully'), 'login-site', '', true);
            }
            if ($this->input->post('lock_submit') && $this->validate_lockscreen()) {
                $this->load->helper('security');
                $post_arr = $this->security->xss_clean($this->input->post());
                $hash_password = $this->aauth->hash_password($post_arr['password'], $user_id);
                $password = $this->login_model->getUserPassword($user_id);
                if ($this->aauth->verify_password($hash_password, $password)) {

                    $res = $this->aauth->login($post_arr['username'], $post_arr['password'], '', '', '', 'lock');
                    if ($res) {
                        $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'user_unlock');
                        $this->session->unset_userdata('locked_user');
                        $this->loadPage('', 'dashboard', '');
                    } else {
                        $this->loadPage(lang('incorrect_passowrd_you_have_entered'), 'login/lock_screen/' . $encode_user_name, 'danger');
                    }
                } else {
                    $this->loadPage(lang('incorrect_passowrd_you_have_entered'), 'login/lock_screen/' . $encode_user_name, 'danger');
                }
            }

            $captcha = 0;
            if ($this->dbvars->CAPTCHA_STATUS || $this->aauth->get_login_attempts() > $this->dbvars->CAPTCHA_LOGIN) {
                $captcha = 1;
            }
            $user_full_name = $this->helper_model->getUserFullName($user_id);
            $image = $this->helper_model->getUserDp($user_id);

            $this->setData('user_name', $user_name);
            $this->setData('image', $image);
            $this->setData('user_full_name', $user_full_name);
            $this->setData('CAPTCHA_STATUS', $captcha);
            $this->setData('title', lang('lock_screen'));
            $this->loadView();
        } else {
            $this->loadPage('', 'login-site');
        }
    }

    /**
     * For validating lock screen.
     * 
     * @author Techffodils Technologies LLP.com
     * @return mixed
     */
    function validate_lockscreen() {
        $this->form_validation->set_rules('password', lang('password'), 'required|trim');
        $result = $this->form_validation->run();
        return $result;
    }

    /**
     * For redirecting the page with encoded data.
     * 
     * @author Techffodils Technologies LLP.com
     * @param string $msg
     * @param $page
     */
    function redirect($msg = '', $page) {
        if ($msg) {
            $msg = base64_decode($msg);
        }
        $this->loadPage($msg, base64_decode($page), '', true);
    }

    /**
     * For background mailing process.
     */
    function parallel_mail() {
        $this->load->model('send_mail_model');
        $post_array = $this->input->post();
        $this->send_mail_model->mailSend($post_array['to_mail'], $post_array['subject'], $post_array['mail_body']);
    }

    /**
     * For over ride maintenance.
     * 
     * @author Techffodils Technologies LLP.com
     */
    function admin_over_ride() {
        $this->loadPage('', 'login-site');
    }

    /**
     * For Login Employee
     * For Date 2017-10-22
     * @author Techffodils Technologies
     * 
     */
    function login_employee() {
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        if ($this->dbvars->CAPTCHA_STATUS > 0 || $this->aauth->get_login_attempts('employee') > $this->dbvars->CAPTCHA_LOGIN)
            $this->setData('CAPTCHA_STATUS', 1);
        $key = $this->dbvars->GOOGLE_CAPTCHA_KEY;
        $this->setData('key', $key);

        if ($this->input->post('employee_login') && $this->validate_employee_login()) {

            $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'user_login');
            $this->loadPage('', 'dashboard');
        }
        $this->setData('login_error', $this->form_validation->error_array());
        $this->setData('title', lang('login_employee'));
        $this->loadView();
    }

    /**
     * For validate Employee Login
     * @author Techffodils Technologies LLP
     * @return boolean
     */
    function validate_employee_login() {

        $this->form_validation->set_rules('employee_username', lang('username'), 'required|trim|min_length[2]|max_length[30]|htmlentities|callback_validate_employee');
        $this->form_validation->set_rules('employee_password', lang('password'), 'required');
        $result = $this->form_validation->run();

        if ($result) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());

            if ($this->aauth->login($post_data['employee_username'], $post_data['employee_password'], isset($post_data['remember']) ? TRUE : FALSE, '', 'employee')) {
                return TRUE;
            } else {

                $this->loadPage($this->aauth->error_return(), 'employee-login', 'danger');
            }
        }
    }

    /**
     * For Login Employee
     * For Date 2017-10-22
     * @author Techffodils Technologies
     * 
     */
    function login_affiliate() {

        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }

        if ($this->dbvars->CAPTCHA_STATUS > 0 || $this->aauth->get_login_attempts('affiliate') > $this->dbvars->CAPTCHA_LOGIN)
            $this->setData('CAPTCHA_STATUS', 1);
        $key = $this->dbvars->GOOGLE_CAPTCHA_KEY;
        $this->setData('key', $key);

        if ($this->input->post('affiliate_login') && $this->validate_affiliate_login()) {

            $this->helper_model->insertAffiliateActivity($this->aauth->getId(), 'user_login', array(), 'fa-unlock', 'green');
            $this->loadPage('', 'dashboard');
        }
        $this->setData('login_error', $this->form_validation->error_array());
        $this->setData('title', lang('login_affiliate'));
        $this->loadView();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @date 2017-11-5
     * @return boolean
     */
    function validate_affiliate_login() {

        $this->form_validation->set_rules('affiliate_username', lang('username'), 'required|trim|min_length[2]|max_length[30]|htmlentities|callback_validate_affiliate');
        $this->form_validation->set_rules('affiliate_password', lang('password'), 'required');
        $result = $this->form_validation->run();

        if ($result) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());

            if ($this->aauth->login($post_data['affiliate_username'], $post_data['affiliate_password'], isset($post_data['remember']) ? TRUE : FALSE, '', 'affiliate')) {
                return TRUE;
            } else {

                $this->loadPage($this->aauth->error_return(), 'affiliate-login', 'danger');
            }
        }
    }

    /**
     * For Employee E-mail or Username checking
     * @author Techffodils Technologies LLP 
     * @date 2018-02-20
     * @param type $employee_username
     * @return boolean
     */
    function validate_employee($employee_username = '') {
        $flag = false;
        if ($employee_username != '') {
            if ($this->helper_model->userNameToEmpID($employee_username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('employee_username')) {
            if ($this->helper_model->userNameToEmpID($this->input->get('employee_username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
        return $flag;
    }

    /**
     * for validate Affiliate
     * @author Techffodils Technologies LLP
     * @param type $affiliate_username
     * @return boolean
     */
    function validate_affiliate($affiliate_username = '') {
        $flag = false;
        if ($affiliate_username != '') {
            if ($this->helper_model->userNameToAffID($affiliate_username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('affiliate_username')) {
            if ($this->helper_model->userNameToAffID($this->input->get('affiliate_username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
        return $flag;
    }

    /**
     * For Employee Forgot password Functionalities
     * @author Techffodils Technologies LLP
     * @date 2018-02-20
     * 
     */
    function employee_forgot_password() {
        $this->load->helper('security');
        $post_arr = $this->security->xss_clean($this->input->post());
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        if ($this->input->post('for_pass') && $this->validate_employee_email()) {
            $email_or_username = $post_arr['email'];
            $user_id = $this->helper_model->employeeUsernameOrEmailToId($email_or_username);

            if ($user_id) {
                $this->load->model('send_mail_model');
                $result = $this->send_mail_model->send($user_id, '', 'employee_forgot_password');
                if ($result) {
                    $this->loadPage(lang('successfully_send_mail'), 'employee-login');
                } else {
                    $this->loadPage(lang('failed_to_send_mail'), 'employee-forgot', 'danger');
                }
            } else {
                $this->loadPage(lang('email_inv_js'), 'employee-forgot', 'danger');
            }
        }
        $this->setData('title', lang('forgot_employee_password_heading'));
        $this->loadView();
    }

    /**
     * For Reset Password
     * @author Techffodils Technologies LLP
     * @param type $encrypt_key
     * 
     */
    function employee_reset_password($encrypt_key = "") {
        $userid = $this->helper_model->decode($encrypt_key);
        if ($this->input->post('submit') == 'Reset' && $this->validate_reset_password()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());
            $new_password = $post_arr['new_password'];
            $password = hash("sha256", $new_password);
            $userid = $post_arr['user_id'];
            $result = $this->login_model->resetEmployeePassword($password, $userid);
            $this->helper_model->insertActivity($userid, 'res_pass', $post_arr);
            if ($result) {
                $this->loadPage(lang('password_reset_successfully'), 'employee-login');
            } else {
                $this->loadPage(lang('password_reset_failed'), 'employee-forgot', 'danger');
            }
        }
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        $this->setData("title", lang('reset_password'));
        $this->setData('user_id', $userid);
        $this->loadView();
    }

    /**
     * For Validate Employee Email
     * @Author Techffodils Technologies LLP
     * @Date 201710-10-09

     */
    function validate_employee_email() {
        $this->form_validation->set_rules('email', lang('login_identity_label'), 'trim|required|callback_validate_employee_username_email');
        $validate_form = $this->form_validation->run();
        return $validate_form;
    }

    /**
     * @author Techffodils Technologies LLP
     * @param type $employee_username
     * @return boolean
     */
    function validate_employee_username_email($employee_username = '') {
        $flag = false;
        if ($employee_username != '') {
            if ($this->helper_model->employeeUsernameOrEmailToId($employee_username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->post('username')) {
            if ($this->helper_model->employeeUsernameOrEmailToId($this->input->post('username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
        return $flag;
    }

    /**
     * For Employee Forgot password Functionalities
     * @author Techffodils Technologies LLP
     * @date 2018-02-20
     * 
     */
    function affiliate_forgot_password() {
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        $this->load->helper('security');
        $post_arr = $this->security->xss_clean($this->input->post());

        if ($this->input->post('for_pass') && $this->validate_affiliate_email()) {
            $email_or_username = $post_arr['email'];
            $user_id = $this->helper_model->affiliateUserNameToID($email_or_username);

            if ($user_id) {
                $this->load->model('send_mail_model');
                $result = $this->send_mail_model->send($user_id, '', 'affiliate_forgot_password');
                if ($result) {
                    $this->loadPage(lang('successfully_send_mail'), 'affiliate-login');
                } else {
                    $this->loadPage(lang('failed_to_send_mail'), 'affiliate-forgot', 'danger');
                }
            } else {
                $this->loadPage(lang('email_inv_js'), 'affiliate-forgot', 'danger');
            }
        }
        $this->setData('title', lang('forgot_affiliate_password_heading'));
        $this->loadView();
    }

    /**
     * For Reset Password
     * @author Techffodils Technologies LLP
     * @param type $encrypt_key
     * 
     */
    function affiliate_reset_password($encrypt_key = "") {
        if ($this->aauth->getId()) {
            $this->loadPage('', 'dashboard');
        }
        $userid = $this->helper_model->decode($encrypt_key);
        if ($this->input->post('submit') == 'Reset' && $this->validate_reset_password()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());
            $new_password = $post_arr['new_password'];
            $password = hash("sha256", $new_password);
            $userid = $post_arr['user_id'];
            $result = $this->login_model->resetAffiliatePassword($password, $userid);
            $this->helper_model->insertActivity($userid, 'res_pass', $post_arr);
            if ($result) {
                $this->loadPage(lang('password_reset_successfully'), 'affiliate-login');
            } else {
                $this->loadPage(lang('password_reset_failed'), 'affiliate-forgot', 'danger');
            }
        }
        $this->setData("title", lang('reset_password'));
        $this->setData('user_id', $userid);
        $this->loadView();
    }

    /**
     * For Validate Employee Email
     * @author Techffodils Technologies LLP
     * @Date 201710-10-09

     */
    function validate_affiliate_email() {
        $this->form_validation->set_rules('email', lang('login_identity_label'), 'trim|required|callback_validate_affiliate_username_email');
        $validate_form = $this->form_validation->run();
        return $validate_form;
    }

    /**
     * For validate affiliate username email
     * @author Techffodils Technologies LLP
     * @param type $employee_username
     * @return boolean
     */
    function validate_affiliate_username_email($employee_username = '') {
        $flag = false;
        if ($employee_username != '') {
            if ($this->helper_model->affiliateUserNameToID($employee_username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->post('username')) {
            if ($this->helper_model->affiliateUserNameToID($this->input->post('username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
        return $flag;
    }


 
}
