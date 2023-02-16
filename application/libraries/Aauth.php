<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Aauth is a User Authorization Library for CodeIgniter 2.x, which aims to make
 * easy some essential jobs such as login, permissions and access operations.
 * Despite ease of use, it has also very advanced features like private messages,
 * groupping, access management, public access etc..
 *
 * @author		Emre Akay <emreakayfb@hotmail.com>
 * @contributor Jacob Tomlinson
 * @contributor Tim Swagger (Renowne, LLC) <tim@renowne.com>
 * @contributor Raphael Jackstadt <info@rejack.de>
 *
 * @copyright 2014-2016 Emre Akay
 *
 * @version 2.5.12
 *
 * @license LGPL
 * @license http://opensource.org/licenses/LGPL-3.0 Lesser GNU Public License
 *
 * The latest version of Aauth can be obtained from:
 * https://github.com/emreakay/CodeIgniter-Aauth
 *
 * @todo separate (on some level) the unvalidated users from the "banned" users
 */
class Aauth {

    /**
     * The CodeIgniter object variable
     * @access public
     * @var object
     */
    public $CI;

    /**
     * Variable for loading the config array into
     * @access public
     * @var array
     */
    public $config_vars;

    /**
     * Array to store error messages
     * @access public
     * @var array
     */
    public $errors;

    /**
     * The CodeIgniter object variable
     * @access public
     * @var object
     */
    public $aauth_db;

    ########################
    # Base Functions
    ########################

    /**
     * Constructor
     */
    public function __construct() {

        // get main CI object
        $this->CI = & get_instance();

        // Dependancies
        if (CI_VERSION >= 2.2) {
            $this->CI->load->library('driver');
        }
        $this->CI->load->library('session');
        $this->CI->load->library('main');
        $this->CI->load->library('dbvars');
        $this->CI->lang->load('aauth');

        // config/aauth.php
        $this->CI->config->load('aauth');
        $this->config_vars = $this->CI->config->item('aauth');

        $this->aauth_db = $this->CI->load->database($this->config_vars['db_profile'], TRUE);

        // load error and info messages from flashdata (but don't store back in flashdata)
        $this->errors = '';
    }

    ########################
    # Login Functions
    ########################
    //tested
    /**
     * Login user
     * Check provided details against the database. Add items to error array on fail, create session if success
     * @param string $email
     * @param string $pass
     * @param bool $remember
     * @return bool Indicates successful login.
     */
    public function login($identifier, $pass, $remember = FALSE, $totp_code = NULL ,$type = 'user',$page='login') {

       // Remove cookies first
        $cookie = array(
            'name' => 'user',
            'value' => '',
            'expire' => -3600,
            'path' => '/',
        );

        $this->CI->input->set_cookie($cookie);
        if ($this->config_vars['ddos_protection'] && !$this->update_login_attempts($type)) {

            $this->error($this->CI->lang->line('aauth_error_login_attempts_exceeded'));
            return FALSE;
        }
        if (($this->config_vars['ddos_protection'] && $this->CI->dbvars->CAPTCHA_STATUS > 0 && $page=='login') || $this->get_login_attempts($type) > $this->CI->dbvars->CAPTCHA_LOGIN) {

            $this->CI->load->helper('recaptchalib');
            $reCaptcha = new ReCaptcha($this->CI->dbvars->GOOGLE_CAPTCHA_SECRET);
            $resp = $reCaptcha->verifyResponse($this->CI->input->server("REMOTE_ADDR"), $this->CI->input->post("g-recaptcha-response"));

            if (!$resp->success) {
                $this->error($this->CI->lang->line('aauth_error_recaptcha_not_correct'));
                return FALSE;
            }
        }

        if (!$identifier OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max']) {
            $this->CI->load->helper('email');
            if (!valid_email($identifier) OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max']) {
                $this->error($this->CI->lang->line('aauth_error_login_failed_name'));
                return FALSE;
            }
        }

        if($type == 'employee'){
            $user_table = $this->config_vars['employee'];
            $db_identifier = "(user_name ='$identifier') AND (".$user_table.".status ='1')";
        }elseif($type == 'autofill'){
            $user_table = $this->config_vars['autofill'];
            $db_identifier = "(user_name ='$identifier') AND (node_status ='1')";
        }elseif($type == 'affiliate'){
            $user_table = $this->config_vars['affiliate'];
            $db_identifier = "(username ='$identifier') AND (status ='1')";
        }else{
            $user_table = $this->config_vars['users'];
            $db_identifier = "(user_name ='$identifier' OR email ='$identifier') AND (login_block ='1')";
        }



        // to find user id, create sessions and cookies
        $query = $this->aauth_db->where($db_identifier);
        $query = $this->aauth_db->get($user_table);

        if ($query->num_rows() == 0) {
            $this->error($this->CI->lang->line('aauth_error_no_user'));
            return FALSE;
        }
        if (($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == FALSE AND $this->config_vars['totp_two_step_login_active'] == FALSE) AND $type == 'user') {

            if ($this->config_vars['totp_two_step_login_active'] == TRUE) {
                $this->CI->session->set_userdata('totp_required', true);
            }

            $query = null;
            $query = $this->aauth_db->where($db_identifier);
            $query = $this->aauth_db->get($this->config_vars['users']);
            $totp_secret = $query->row()->totp_secret;
            if ($query->num_rows() > 0 AND ! $totp_code) {
                $this->error($this->CI->lang->line('aauth_error_totp_code_required'));
                return FALSE;
            } else {
                if (!empty($totp_secret)) {
                    $this->CI->load->helper('googleauthenticator');
                    $ga = new PHPGangsta_GoogleAuthenticator();
                    $checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
                    if (!$checkResult) {
                        $this->error($this->CI->lang->line('aauth_error_totp_code_invalid'));
                        return FALSE;
                    }
                }
            }
        }

        if (( $this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == TRUE ) AND $type == 'user') {
            $query = null;
            $query = $this->aauth_db->where($db_identifier);
            $query = $this->aauth_db->get($this->config_vars['users']);
            $totp_secret = $query->row()->totp_secret;
            $ip_address = $query->row()->ip_address;
            $current_ip_address = $this->CI->input->ip_address();

            if ($query->num_rows() > 0 AND ! $totp_code) {
                if ($ip_address != $current_ip_address) {
                    if ($this->config_vars['totp_two_step_login_active'] == FALSE) {
                        $this->error($this->CI->lang->line('aauth_error_totp_code_required'));
                        return FALSE;
                    } else if ($this->config_vars['totp_two_step_login_active'] == TRUE) {
                        $this->CI->session->set_userdata('totp_required', true);
                    }
                }
            } else {
                if (!empty($totp_secret)) {
                    if ($ip_address != $current_ip_address) {
                        $this->CI->load->helper('googleauthenticator');
                        $ga = new PHPGangsta_GoogleAuthenticator();
                        $checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
                        if (!$checkResult) {
                            $this->error($this->CI->lang->line('aauth_error_totp_code_invalid'));
                            return FALSE;
                        }
                    }
                }
            }
        }

        $query = null;

        if($type == 'employee'){
            $this->aauth_db->select('mlm_employee_details.employee_id as mlm_user_id,user_name,"employee" as user_type ,email,password,"0" as  banned ,"" as verification_code');
            $this->aauth_db->from('mlm_employee_details');
            $this->aauth_db->join($user_table, 'mlm_employee_login.employee_id = mlm_employee_details.employee_id');
            $this->aauth_db->where($db_identifier);
            $query = $this->aauth_db->get();

        }elseif($type == 'affiliate'){

            $this->aauth_db->select('id as mlm_user_id,username as user_name, "affiliate" as user_type,email,password, "0" as banned, "" as verification_cod');
            $this->aauth_db->where($db_identifier);
            $query = $this->aauth_db->get($user_table);

        }elseif($type == 'autofill'){

            $this->aauth_db->select('id as mlm_user_id,user_name as user_name, "autofill" as user_type,"" as email,password, "0" as banned, "" as verification_cod');
            $this->aauth_db->where($db_identifier);
            $query = $this->aauth_db->get($user_table);

        }else{

            $this->aauth_db->select('mlm_user_id,user_name,user_type,email,password,banned,verification_code');
            $this->aauth_db->where($db_identifier);
            $query = $this->aauth_db->get($user_table);
        }

        $row = $query->row();

        // if email and pass matches and not banned
        $password = ($this->config_vars['use_password_hash'] ? $pass : $this->hash_password($pass, ''));
        // $password = ($this->config_vars['use_password_hash'] ? $pass : $this->hash_password($pass, $row->mlm_user_id));

        if ($query->num_rows() != 0 && $this->verify_password($password, $row->password)) {
            $this->CI->session->unset_userdata('admin_override');
            // If email and pass matches
            // create session
            // if user is not verified
            if($this->CI->dbvars->EMAIL_VERIFICATION_STATUS > 0 && $row->banned == 1){
                return TRUE;
            }

            if($this->CI->dbvars->MAINTANANCE_STATUS > 0 && $row->user_type != 'admin'){
                return FALSE;
            }

            $data = array(
                'mlm_user_id' => $row->mlm_user_id,
                'mlm_username' => $row->user_name,
                'mlm_user_type' => $row->user_type,
                'mlm_email' => $row->email,
                'is_logged_in' => TRUE
            );

            $this->CI->main->set_usersession('mlm_logged_arr', $data);

            if ($remember && $type ='user') {
                $this->CI->load->helper('string');
                $expire = $this->config_vars['remember'];
                $today = date("Y-m-d");
                $remember_date = date("Y-m-d", strtotime($today . $expire));
                $random_string = random_string('alnum', 16);
                $this->update_remember($row->mlm_user_id, $random_string, $remember_date);
                $cookie = array(
                    'name' => 'user',
                    'value' => $row->mlm_user_id . "-" . $random_string,
                    'expire' => $this->config_vars['auto_login_expiry'],
                    'path' => '/',
                );
                $this->CI->input->set_cookie($cookie);
            }

            // update last login
            $this->update_last_login($row->mlm_user_id,$type);
            $this->update_activity();

            if ($this->config_vars['remove_successful_attempts'] == TRUE) {
                $this->reset_login_attempts();
            }

            return TRUE;
        }
        // if not matches
        else {
            $this->error($this->CI->lang->line('aauth_error_login_failed_all'));
            return FALSE;
        }
    }

    //tested
    /**
     * Check user login
     * Checks if user logged in, also checks remember.
     * @return bool
     */
    public function is_loggedin() {

        if (isset($this->CI->session->userdata['mlm_logged_arr']['is_logged_in'])) {
            return TRUE;
        } else {
            if (!$this->CI->input->cookie('user', TRUE)) {
                return FALSE;
            } else {
                $cookie = explode('-', $this->CI->input->cookie('user', TRUE));
                if (!is_numeric($cookie[0]) OR strlen($cookie[1]) < 13) {
                    return FALSE;
                } else {
                    $query = $this->aauth_db->where('mlm_user_id', $cookie[0]);
                    $query = $this->aauth_db->where('remember_exp', $cookie[1]);
                    $query = $this->aauth_db->get($this->config_vars['users']);

                    $row = $query->row();

                    if ($query->num_rows() < 1) {
                        $this->update_remember($cookie[0]);
                        return FALSE;
                    } else {

                        if (strtotime($row->remember_time) > strtotime("now")) {
                            $this->login_fast($cookie[0]);
                            return TRUE;
                        }
                        // if time is expired
                        else {
                            return FALSE;
                        }
                    }
                }
            }
        }
        return FALSE;
    }

    /**
     * Controls if a logged or public user has permission
     *
     * If user does not have permission to access page, it stops script and gives
     * error message, unless 'no_permission' value is set in config.  If 'no_permission' is
     * set in config it redirects user to the set url and passes the 'no_access' error message.
     * It also updates last activity every time function called.
     *
     * @param bool $perm_par If not given just control user logged in or not
     */
    public function control($perm_par = FALSE) {

        $this->CI->load->helper('url');

        if ($this->CI->session->userdata('totp_required')) {
            $this->error($this->CI->lang->line('aauth_error_totp_verification_required'));
            redirect($this->config_vars['totp_two_step_login_redirect']);
        }

        $perm_id = $this->get_perm_id($perm_par);
        $this->update_activity();
        if ($perm_par == FALSE) {
            if ($this->is_loggedin()) {
                return TRUE;
            } else if (!$this->is_loggedin()) {
                $this->error($this->CI->lang->line('aauth_error_no_access'));
                if ($this->config_vars['no_permission'] !== FALSE) {
                    redirect($this->config_vars['no_permission']);
                }
            }
        } else if (!$this->is_allowed($perm_id) OR ! $this->is_group_allowed($perm_id)) {
            if ($this->config_vars['no_permission']) {
                $this->error($this->CI->lang->line('aauth_error_no_access'));
                if ($this->config_vars['no_permission'] !== FALSE) {
                    redirect($this->config_vars['no_permission']);
                }
            } else {
                echo $this->CI->lang->line('aauth_error_no_access');
                die();
            }
        }
    }

    //tested
    /**
     * Logout user
     * Destroys the CodeIgniter session and remove cookies to log out user.
     * @return bool If session destroy successful
     */
    public function logout() {

        $cookie = array(
            'name' => 'user',
            'value' => '',
            'expire' => -3600,
            'path' => '/',
        );
        $this->CI->input->set_cookie($cookie);

        // echo '<pre>';
        // print_r($this->CI->session->userdata());echo '-----------------';
        $this->CI->session->sess_destroy();
        $this->CI->session->unset_userdata('mlm_data_language');
        $this->CI->session->unset_userdata('mlm_data_currency');
        $this->CI->session->unset_userdata('mlm_logged_arr');
        $this->CI->session->unset_userdata('mlm_theme_details');
        $this->CI->session->unset_userdata('mlm_site_info');


        return TRUE;
    }

    //tested
    /**
     * Fast login
     * Login with just a user id
     * @param int $user_id User id to log in
     * @return bool TRUE if login successful.
     */
    public function login_fast($user_id) {

        $query = $this->aauth_db->select('mlm_user_id,user_name,user_type,email');
        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        $query = $this->aauth_db->where('banned', 0);
        $query = $this->aauth_db->get($this->config_vars['users']);

        $row = $query->row();

        if ($query->num_rows() > 0) {

            // if id matches
            // create session
            $data = array(
                'mlm_user_id' => $row->mlm_user_id,
                'mlm_username' => $row->user_name,
                'mlm_user_type' => $row->user_type,
                'mlm_email' => $row->email,
                'is_logged_in' => TRUE
            );

            $this->CI->main->set_usersession('mlm_logged_arr', $data);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Reset last login attempts
     * Removes a Login Attempt
     * @return bool Reset fails/succeeds
     */
    public function reset_login_attempts() {
        $ip_address = $this->CI->input->ip_address();
        $this->aauth_db->where(
                array(
                    'ip_address' => $ip_address,
                    'timestamp >=' => date("Y-m-d H:i:s", strtotime("-" . $this->config_vars['max_login_attempt_time_period']))
                )
        );
        return $this->aauth_db->delete($this->config_vars['login_attempts']);
    }

    /**
     * Remind password
     * Emails user with link to reset password
     * @param string $email Email for account to remind
     * @return bool Remind fails/succeeds
     */
    public function remind_password($email) {

        $query = $this->aauth_db->where('email', $email);
        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $ver_code = sha1(strtotime("now"));

            $data['verification_code'] = $ver_code;

            $this->aauth_db->where('email', $email);
            $this->aauth_db->or_where('user_name', $email);
            $this->aauth_db->update($this->config_vars['users'], $data);

            return $ver_code;
        }
        return FALSE;
    }

    /**
     * Reset password
     * Generate new password and email it to the user
     * @param string $ver_code Verification code for account
     * @return bool Password reset fails/succeeds
     */
    public function reset_password($ver_code) {

        $query = $this->aauth_db->where('verification_code', $ver_code);
        $query = $this->aauth_db->get($this->config_vars['users']);

        $this->CI->load->helper('string');
        $pass_length = ($this->config_vars['min'] & 1 ? $this->config_vars['min'] + 1 : $this->config_vars['min']);
        $pass = random_string('alnum', $pass_length);

        if ($query->num_rows() > 0) {

            $row = $query->row();
            $data = array(
                'verification_code' => '',
                'password' => $this->hash_password($pass, $row->mlm_user_id)
            );

            if ($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_reset_over_reset_password'] == TRUE) {
                $data['totp_secret'] = NULL;
            }

            $email = $row->email;

            $this->aauth_db->where('mlm_user_id', $row->mlm_user_id);
            $this->aauth_db->update($this->config_vars['users'], $data);

            $this->CI->load->library('email');

            if (isset($this->config_vars['email_config']) && is_array($this->config_vars['email_config'])) {
                $this->CI->email->initialize($this->config_vars['email_config']);
            }

            $this->CI->email->from($this->config_vars['email'], $this->config_vars['name']);
            $this->CI->email->to($email);
            $this->CI->email->subject($this->CI->lang->line('aauth_email_reset_success_subject'));
            $this->CI->email->message($this->CI->lang->line('aauth_email_reset_success_new_password') . $pass);
            $this->CI->email->send();

            return TRUE;
        }

        return FALSE;
    }

    //tested
    /**
     * Update last login
     * Update user's last login date
     * @param int|bool $user_id User id to update or FALSE for current user
     * @return bool Update fails/succeeds
     */
    public function update_last_login($user_id = FALSE,$type ='user') {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata['mlm_logged_arr']['mlm_user_id'];
        //$user_id = $this->CI->session->userdata('id');

        $data['last_login'] = date("Y-m-d H:i:s");
        $data['ip_address'] = $this->CI->input->ip_address();

        $this->aauth_db->where('mlm_user_id', $user_id);
        return $this->aauth_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Update login attempt and if exceeds return FALSE
     * @return bool
     */
    public function update_login_attempts($type='user') {
        $ip_address = $this->CI->input->ip_address();
        $query = $this->aauth_db->where(
                array(
                    'ip_address' => $ip_address,
                    'timestamp >=' => date("Y-m-d H:i:s", strtotime("-" . $this->config_vars['max_login_attempt_time_period'])),
                    'type' => $type
                )
        );
        $query = $this->aauth_db->get($this->config_vars['login_attempts']);

        if ($query->num_rows() == 0) {
            $data = array();
            $data['ip_address'] = $ip_address;
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['login_attempts'] = 1;
            $data['type'] = $type;
            $this->aauth_db->insert($this->config_vars['login_attempts'], $data);
            return TRUE;
        } else {
            $row = $query->row();
            $data = array();
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['login_attempts'] = $row->login_attempts + 1;
            $this->aauth_db->where('id', $row->id);
            $this->aauth_db->update($this->config_vars['login_attempts'], $data);

            if ($data['login_attempts'] > $this->config_vars['max_login_attempt']) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    /**
     * Get login attempt
     * @return int
     */
    public function get_login_attempts($type='user') {
        $ip_address = $this->CI->input->ip_address();
        $query = $this->aauth_db->where(
                array(
                    'ip_address' => $ip_address,
                    'type' => $type,
                    'timestamp >=' => date("Y-m-d H:i:s", strtotime("-" . $this->config_vars['max_login_attempt_time_period']))
                )
        );
        $query = $this->aauth_db->get($this->config_vars['login_attempts']);

        if ($query->num_rows() != 0) {
            $row = $query->row();
            return $row->login_attempts;
        }

        return 0;
    }

    /**
     * Update remember
     * Update amount of time a user is remembered for
     * @param int $user_id User id to update
     * @param int $expression
     * @param int $expire
     * @return bool Update fails/succeeds
     */
    public function update_remember($user_id, $expression = null, $expire = null) {

        $data['remember_time'] = $expire;
        $data['remember_exp'] = $expression;

        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        return $this->aauth_db->update($this->config_vars['users'], $data);
    }

    ########################
    # User Functions
    ########################
    //tested
    /**
     * Get user
     * Get user information
     * @param int|bool $user_id User id to get or FALSE for current user
     * @return object User information
     */

    public function get_user($user_id = FALSE) {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata['mlm_logged_arr']['mlm_user_id'];

        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() <= 0) {
            $this->error($this->CI->lang->line('aauth_error_no_user'));
            return FALSE;
        }
        return $query->row();
    }

    /**
     * Verify user
     * Activates user account based on verification code
     * @param int $user_id User id to activate
     * @param string $ver_code Code to validate against
     * @return bool Activation fails/succeeds
     */
    public function verify_user($user_id, $ver_code) {

        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        $query = $this->aauth_db->where('verification_code', $ver_code);
        $query = $this->aauth_db->get($this->config_vars['users']);

        // if ver code is TRUE
        if ($query->num_rows() > 0) {

            $data = array(
                'verification_code' => '',
                'banned' => 0
            );

            $this->aauth_db->where('mlm_user_id', $user_id);
            $this->aauth_db->update($this->config_vars['users'], $data);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Send verification email
     * Sends a verification email based on user id
     * @param int $user_id User id to send verification email to
     * @todo return success indicator
     */
    public function send_verification($user_id) {

        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->CI->load->helper('string');
            $ver_code = random_string('alnum', 16);

            $data['verification_code'] = $ver_code;

            $this->aauth_db->where('mlm_user_id', $user_id);
            $this->aauth_db->update($this->config_vars['users'], $data);

            $this->CI->load->library('email');
            $this->CI->load->helper('url');

            if (isset($this->config_vars['email_config']) && is_array($this->config_vars['email_config'])) {
                $this->CI->email->initialize($this->config_vars['email_config']);
            }

            $this->CI->email->from($this->config_vars['email'], $this->config_vars['name']);
            $this->CI->email->to($row->email);
            $this->CI->email->subject($this->CI->lang->line('aauth_email_verification_subject'));
            $this->CI->email->message($this->CI->lang->line('aauth_email_verification_code') . $ver_code .
            $this->CI->lang->line('aauth_email_verification_text') . site_url() . $this->config_vars['verification_link'] . $user_id . '/' . $ver_code);
            $this->CI->email->send();
        }
    }

    //tested
    /**
     * Ban user
     * Bans a user account
     * @param int $user_id User id to ban
     * @return bool Ban fails/succeeds
     */
    public function ban_user($user_id) {

        $data = array(
            'banned' => 1,
            'verification_code' => ''
        );

        $this->aauth_db->where('mlm_user_id', $user_id);

        return $this->aauth_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Unban user
     * Activates user account
     * Same with unlock_user()
     * @param int $user_id User id to activate
     * @return bool Activation fails/succeeds
     */
    public function unban_user($user_id) {

        $data = array(
            'banned' => 0
        );

        $this->aauth_db->where('mlm_user_id', $user_id);

        return $this->aauth_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Check user banned
     * Checks if a user is banned
     * @param int $user_id User id to check
     * @return bool False if banned, True if not
     */
    public function is_banned($user_id) {

        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        $query = $this->aauth_db->where('banned', 0);

        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * user_exist_by_username
     * Check if user exist by username
     * @param $user_id
     *
     * @return bool
     */
    public function user_exist_by_username($name) {
        $query = $this->aauth_db->where('user_name', $name);

        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * user_exist_by_name !DEPRECATED!
     * Check if user exist by name
     * @param $user_id
     *
     * @return bool
     */
    public function user_exist_by_name($name) {
        return $this->user_exist_by_username($name);
    }

    /**
     * user_exist_by_email
     * Check if user exist by user email
     * @param $user_email
     *
     * @return bool
     */
    public function user_exist_by_email($user_email) {
        $query = $this->aauth_db->where('email', $user_email);

        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * user_exist_by_id
     * Check if user exist by user email
     * @param $user_email
     *
     * @return bool
     */
    public function user_exist_by_id($user_id) {
        $query = $this->aauth_db->where('mlm_user_id', $user_id);

        $query = $this->aauth_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Get user id
     * Get user id from email address, if par. not given, return current user's id
     * @param string|bool $email Email address for user
     * @return int User id
     */
    public function getId($email = FALSE) {

        $mlm_user_type = $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_type');
        if($mlm_user_type == 'admin' || $mlm_user_type == 'user'){
            $query = $this->aauth_db->select('mlm_user_id');
            if (!$email) {
                $query = $this->aauth_db->where('mlm_user_id', $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_id'));
            } else {
                $query = $this->aauth_db->where('email', $email);
            }
            $query = $this->aauth_db->get($this->config_vars['users']);

            if ($query->num_rows() <= 0) {
                $this->error($this->CI->lang->line('aauth_error_no_user'));
                return FALSE;
            }
            return $query->row()->mlm_user_id;
        }else{

            return $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_id');
        }

    }


    /**
     * Get user id
     * Get user id from email address, if par. not given, return current user's id
     * @param string|bool $email Email address for user
     * @return int User id
     */
    public function logStatus($email = FALSE) {

        $status  = false;
        if ($this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_id')){
             $status  = true;
        }
        return $status;
    }


    /**
     * Get User Name
     * @param bool $email
     * @return bool
     */
    public function getUserName($email = FALSE) {

        $mlm_user_type = $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_type');
        if($mlm_user_type == 'admin' || $mlm_user_type == 'user'){


            $query = $this->aauth_db->select('user_name');
            if (!$email) {
                $query = $this->aauth_db->where('user_name', $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_username'));
            } else {
                $query = $this->aauth_db->where('email', $email);
            }
            $query = $this->aauth_db->get($this->config_vars['users']);
            if ($query->num_rows() <= 0) {
                $this->error($this->CI->lang->line('aauth_error_no_user'));
                return FALSE;
            }

            return $query->row()->user_name;
        }else{
            return $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_username');
        }
    }

    public function getUserType() {
        return $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_type') ? $this->CI->main->get_usersession('mlm_logged_arr', 'mlm_user_type') : FALSE;
    }

    //tested
    /**
     * Update activity
     * Update user's last activity date
     * @param int|bool $user_id User id to update or FALSE for current user
     * @return bool Update fails/succeeds
     */
    public function update_activity($user_id = FALSE) {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata['mlm_logged_arr']['mlm_user_id'];

        if ($user_id == FALSE) {
            return FALSE;
        }

        $data['last_activity'] = date("Y-m-d H:i:s");

        $query = $this->aauth_db->where('mlm_user_id', $user_id);
        return $this->aauth_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Hash password
     * Hash the password for storage in the database
     * (thanks to Jacob Tomlinson for contribution)
     * @param string $pass Password to hash
     * @param $userid
     * @return string Hashed password
     */
    function hash_password($pass, $userid) {
        if ($this->config_vars['use_password_hash']) {
            return password_hash($pass, $this->config_vars['password_hash_algo'], $this->config_vars['password_hash_options']);
        } else {
//			$salt = md5($userid);
//			return hash($this->config_vars['hash'], $salt.$pass);
            return hash($this->config_vars['hash'], $pass);
        }
    }

    /**
     * Verify password
     * Verfies the hashed password
     * @param string $password Password
     * @param string $hash Hashed Password
     * @param string $user_id
     * @return bool False or True
     */
    function verify_password($password, $hash) {
        if ($this->config_vars['use_password_hash']) {
            return password_verify($password, $hash);
        } else {
            return ($password == $hash ? TRUE : FALSE);
        }
    }

    ########################
    # Permission Functions
    ########################
    /**
     * Is user allowed
     * Check if user allowed to do specified action, admin always allowed
     * first checks user permissions then check group permissions
     * @param $url
     * @param $user_type
     * @return bool
     * @internal param int $perm_par Permission id or name to check
     * @internal param bool|int $user_id User id to check, or if FALSE checks current user
     */

    public function is_allowed($url, $user_type) {
        $permission = $user_type . "_permission";
        $this->aauth_db->select($permission);
        $this->aauth_db->where('link', $url);
        $this->aauth_db->or_where('original_link', $url);
        $query = $this->aauth_db->get($this->config_vars['menus']);

        if ($query->num_rows() > 0)
            return true;
        return FALSE;
    }

    public function error_return() {
        return $this->errors;
    }

    public function error($message = '') {
        $this->errors = $message;
    }

}

// end class

// $this->CI->session->userdata('id')

/* coming with v3
----------------
 * captcha (hmm bi bakalım)
 * parametre olarak array alma
 * stacoverflow
 * public id sini 0 a eşitleyip öyle kontrol yapabilirdik (oni boşver uşağum)
 * lock_user (until parametrsi)
 * unlock_user
 * send_pm() in errounda receiver ve sender için ayrı errorlar olabilür
 * ddos protect olayını daha mantıklı hale getür
 * geçici ban ve e-mail ile tkrar aktifleştime olayı
*/

/**
 * Coming with v2
 * -------------
 *
 * tmam // permission id yi permission parametre yap
 * mail fonksiyonları imtihanı
 * tamam // login e ip aderesi de eklemek lazım
 * list_users da grup_par verilirse ve adamın birden fazla grubu varsa nolurkun? // bi denemek lazım belki distinct ile düzelir
 * tamam // eğer grup silinmişse kullanıcıları da o gruptan sil (fire)
 * tamam //	 ismember la is admine 2. parametre olarak user id ekle
 * tamam // kepp infos errors die bişey yap ajax requestlerinde silinir errorlar
 * tmam // user variables
 * tamam // sistem variables
 * tmam // user perms
 * tamam gibi // 4mysql index fulltext index??
 * tamam //delete_user dan sonra grup ve perms ler de silinmeli
 * login() içinde login'i doğru şekilde olsa da yine de login attempt artıyo kesin düzeltilecek
 * keep_errors ve keep_infos calismiyor
 *
 *
 *
 * -----------
 * ok
 *
 * unban_user() added // unlock_user
 * remove member added // fire_member
 * allow() changed to allow_group
 * deny() changed to deny_group
 * is member a yeni parametre eklendi
 * allow_user() added
 * deny_user() added
 * keep_infos() added
 * kepp_errors() added
 * get_errors() changed to print_errors()
 * get_infos() changed to print_infos()
 * User and Aauth System Variables.
set_user_var( $key, $value, $user_id = FALSE )
get_user_var( $key, $user_id = FALSE)
unset
set_system_var( $key, $value, $user_id = FALSE )
get_system_var( $key, $user_id = FALSE)
unset
functions added
 *
 *
 *
 *
 *
 * Done staff v1
 * -----------
 * tamam hacı // control die bi fonksiyon yazıp adam önce login omuşmu sonra da yetkisi var mı die kontrol et. yetkisi yoksa yönlendir ve aktivitiyi güncelle
 * tamam hacı // grupları yetkilendirme, yetki ekleme, alma alow deny
 * tamam gibi // Email and pass validation with form helper
 * biraz oldu // laguage file support
 * tamam // forget pass
 * tamam // yetkilendirme sistemi
 * tamam // Login e remember eklencek
 * tamam // şifremi unuttum ve random string
 * sanırım şimdi tamam // hatalı girişde otomatik süreli kilit
 * ??  tamam heral // mail ile bilgilendirme
 * tamam heral // activasyon emaili
 * tamam gibi // yerine email check // username check
 * tamamlandı // public erişimi
 * tamam // Private messsages
 * tamam össen // errorlar düzenlenecek hepisiiii
 * tamam ama engelleme ve limit olayı koymadım. // pm için okundu ve göster, sil, engelle? die fonksiyonlar eklencek , gönderilen pmler, alınan pmler, arasındaki pmler,
 * tamm// already existedleri info yap onlar error değil hacım
 *




/*
// if user's email is found
if ($query->num_rows() > 0) {
$row = $query->row();

// DDos protection
if ( $this->config_vars['dos_protection'] and $row->last_login_attempt != '' and
(strtotime("now") + 30 * $this->config_vars['try'] ) < strtotime($row->last_login_attempt) ) {
$this->error($this->CI->lang->line('exceeded'));
return FALSE;
}
}
 */



/* End of file Aauth.php */
/* Location: ./application/libraries/Aauth.php */
