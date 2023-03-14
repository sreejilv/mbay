<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Base_Controller.php';

/**
 * For using the profile updates only 
 * @author Techffodils Technologies LLP
 * @date 2017-12-4
 */
class Profile extends Base_Controller {

    /**
     * For load the profile view update the profile details
     * @author Techffodils Technologies LLP
     * @date 2017-12-15 
     * @param type $encoded_id
     */
    function index($encoded_id = '') {
        
        $logged_user_id = $profile_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->load->model('report_model');
        $user_details = $this->profile_model->getUserDetails($logged_user_id);
        $country_id = $user_details['country'];
        $countries = $this->helper_model->getAllCountries();
        $states = $this->helper_model->getAllStates($country_id);

        if ($this->input->post('general') && $this->validate_general_pro_update()){
            $flag = 1;
            $this->load->helper('security');
            $update_user_data = $this->security->xss_clean($this->input->post());

            $res = $this->report_model->updategeneral($update_user_data,$logged_user_id);
            $this->loadPage(lang('update_profile_success'),'profile-view', 'success');
        }
        if ($this->input->post('update_password') && $this->validate_general_password()){
            $flag = 1;
            $this->load->helper('security');
            $update_user_data = $this->security->xss_clean($this->input->post());
            $res =  $this->report_model->updatepassword($update_user_data,$logged_user_id);
           $this->loadPage(lang('update_profile_success'),'profile-view', 'success');

        }

        if($this->input->post('add_address')){
          $flag = 1;
          $address_post = $this->security->xss_clean($this->input->post());
          $res = $this->report_model->updateAddress($address_post, $logged_user_id);
          $this->loadPage(lang('update_profile_success'),'profile-view', 'success');
        }

        
        $this->setData('user_details', $user_details);
        $this->setData('countries', $countries);
        $this->setData('states', $states);
        $this->setData('login_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_4'));
        $this->loadView();

    }

    public function validate_general_pro_update() {
        $this->form_validation->set_rules('email', lang('email'), 'required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('phone_number', lang('phone_number'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    public function validate_general_password() {
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[6]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate the profile form
     * @author Techffodils Technologies LLP
     * @date 2017-12-15
     * @return type
     */
    function validate_profile_update() {
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('phone_number', lang('phone_number'), 'required|greater_than[0]');
        $this->form_validation->set_rules('gender', lang('gender'), 'required');
        $this->form_validation->set_rules('address', lang('address'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('dob', lang('dob'), 'required|callback_validate_dob|callback_validate_age');

        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate the update profile view entered date of birth G
     * @param type $date
     * @return boolean|string
     */
    function validate_dob($dob = '') {
        if ($dob) {
            $flag = false;
            $test_arr = explode('/', $dob);

            if (isset($test_arr[1]) && isset($test_arr[0]) && isset($test_arr[2])) {
                $day = $test_arr[0];
                $month = $test_arr[1];
                $year = $test_arr[2];
                if ($year > 1920 && $year <= date('Y') && checkdate($month, $day, $year)) {
                    $flag = true;
                }
            }
            return $flag;
        } elseif ($this->input->get('dob')) {
            $dob = $this->input->get('dob');
            $test_arr = explode('/', $dob);

            if (isset($test_arr[1]) && isset($test_arr[0]) && isset($test_arr[2])) {
                $day = $test_arr[0];
                $month = $test_arr[1];
                $year = $test_arr[2];
                if ($year > 1920 && $year < date('Y') && checkdate($month, $day, $year)) {
                    echo 'yes';
                    exit();
                }
            }
        }
    }

    /**
     * For validate the update profile view entered date of birth G
     * @param type $date
     * @return boolean|string
     */
    function validate_age($dob = '') {
        if ($dob) {
            $flag = false;
            $test_arr = explode('/', $dob);

            if (isset($test_arr[1]) && isset($test_arr[0]) && isset($test_arr[2])) {
                $day = $test_arr[0];
                $month = $test_arr[1];
                $year = $test_arr[2];
                if ($year > 1920 && $year <= date('Y') && checkdate($month, $day, $year)) {
                    $date = date("Y-m-d", strtotime("$year-$month-$day"));
                    $date1 = date_create($date);
                    $date2 = date_create(date('Y-m-d'));
                    $diff = date_diff($date1, $date2);
                    $year = $diff->format("%r%y");
                    if ($year >= 18) {
                        $flag = true;
                    }
                }
            }
            return $flag;
        } elseif ($this->input->get('dob')) {
            $dob = $this->input->get('dob');
            $test_arr = explode('/', $dob);

            if (isset($test_arr[1]) && isset($test_arr[0]) && isset($test_arr[2])) {
                $day = $test_arr[0];
                $month = $test_arr[1];
                $year = $test_arr[2];
                if ($year > 1920 && $year < date('Y') && checkdate($month, $day, $year)) {
                    $date = date("Y-m-d", strtotime("$year-$month-$day"));
                    $date1 = date_create($date);
                    $date2 = date_create(date('Y-m-d'));
                    $diff = date_diff($date1, $date2);
                    $year = $diff->format("%r%y");
                    if ($year >= 18) {
                        echo 'yes';
                        exit();
                    }
                }
            }
        }
    }

    /**
     * For  reset the profle images
     * @author Techffodils Technologies LLP
     * @date 2017-12-15 
     */
    function reset_user_file() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        if ($get['id']) {
            $res = $this->profile_model->resetUserFile($get['id']);
            if ($res) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'reset_user_file', $get);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For setting up the default cover photo
     * @author Techffodils Technologies LLP
     * @date 2017-12-15
     */
    function set_def_cover() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());

        if ($get['id']) {
            $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($this->session->userdata('profile_user') != null) {
                $user_id = $this->session->userdata('profile_user');
            } else {
                $user_id = $log_user_id;
            }
            $res = $this->profile_model->setCover($user_id, $get['id']);
            if ($res) {
                $this->helper_model->insertActivity($log_user_id, 'set_def_cover', $get);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For setting up  the default profile images
     * @author Techffodils Technologies LLP
     * @date 2017-12-15
     */
    function set_def_dp() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        if ($get['id']) {
            $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($this->session->userdata('profile_user') != null) {
                $user_id = $this->session->userdata('profile_user');
            } else {
                $user_id = $log_user_id;
            }
            $res = $this->profile_model->setDp($user_id, $get['id']);
            if ($res) {
                $this->helper_model->insertActivity($log_user_id, 'set_def_dp', $get);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For Update the social profile
     * @author Techffodils Technologies LLP
     * @date 2017-12-03
     */
    function change_social_profile() {
        $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $response['success'] = false;
        $response['msg'] = lang('failed_to_update');


        if ($this->session->userdata('profile_user') != null) {
            $user_id = $this->session->userdata('profile_user');
        } else {
            $user_id = $log_user_id;
        }
        if ($user_id) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            if ($post['value']) {
                $res = $this->profile_model->updateSocialProfile($user_id, $post);
                if ($res) {
                    $this->helper_model->insertActivity($log_user_id, 'social_profile_updated', $post);
                    $response['success'] = true;
                    $response['msg'] = lang('updated');
                } else {
                    $response['msg'] = lang('something_went_wrong');
                }
            } else {
                $response['msg'] = lang('empty_url');
            }
        }
        echo json_encode($response);
        exit();
    }

    public function check_current_password() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $user_id = $this->aauth->getId();
        if ($this->profile_model->checkUserCurrentPasswod($user_id, $post['current_password'])) {
            echo 'yes';
            exit;
        }
        echo 'no';
    }

}
