<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

/**
 * @author Techffodils Technologies LLP
 * Class Login
 */
class Shop extends Base_Controller {

    /**
     * loading index page.
     * @author Techffodils Technologies LLP
     */
    public function index() {
        $this->load->model('site_management_model');
        $slider_images = $this->site_management_model->getSliderLists();
        // if ($this->aauth->getId()) {
        //     $this->loadPage('', 'dashboard');
        // }
        // if ($this->input->post('login') && $this->site_login()) {
        //     $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'user_login');
        //     $this->loadPage('', 'dashboard');
        // }

        // if ($this->dbvars->CAPTCHA_STATUS > 0 || $this->aauth->get_login_attempts() > $this->dbvars->CAPTCHA_LOGIN)
        //     $this->setData('CAPTCHA_STATUS', 1);
        // $this->setData('key', $key);
        // $this->setData('login_error', $this->form_validation->error_array());
        // $this->setData('EMPLOYEE_STATUS', $this->dbvars->EMPLOYEE_STATUS);
        // $this->setData('AFFILIATES_STATUS', $this->dbvars->AFFILIATES_STATUS);
        // $this->setData('sytem_title', $this->helper_model->getSystemPath());
        // $this->setData('title', lang('login'));
        $this->setData('slider_images', $slider_images);
        $this->loadView();
    }

    public function login_register(){
        $this->loadView();
    }

    public function shop(){
        $user_type = $this->aauth->getUserType();
        $this->loadView();
    }

    public function cart(){
        $this->loadView();
    }

    public function about_us(){
        $this->loadView();
    }

    public function contact(){
        $this->loadView();
    }

    public function app(){
        $this->loadView();
    }

    public function shop_details(){
        $this->loadView();
    }

    public function checkout(){
        $this->loadView();
    }
    
    public function account($active =''){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $active = $active;
        $this->load->model('report_model');
        $user= $this->aauth->get_user();
        $user_id = $this->aauth->getId();

        if ($this->input->post('change_password') && $this->validate_general_password()) {
            $active = 5;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $hash_pass = $this->aauth->hash_password($post['current_password'], '');
            if($this->aauth->verify_password($user->password,$hash_pass)){
                $res = $this->report_model->updatepassword($post,$user_id);
                if($res){
                    $this->loadPage('update success', 'account/'.$active, 'success');
                }
           }else{
                 $this->loadPage('Current password does not match', 'account/'.$active, 'danger');
           }
        }
        if ($this->input->post('account_details') && $this->validate_general_update()) {
            $active = 4;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->report_model->updategeneral($post ,$user_id);
            if($res){
                $this->loadPage('update success', 'account/'.$active, 'success');
            }else{
                 $this->loadPage('something went wrong', 'account/'.$active, 'danger');
            }
        }
       $user_detail = $this->db->select('first_name,last_name,phone_number')
        ->from('user_details')
        ->where('mlm_user_id', $user_id)
        ->get();
        foreach ($user_detail->result() as $row) {
          $detail = $row;
        }
        $this->setData('active', $active);  
        $this->setData('user_name', $user_name);  
        $this->setData('user_mail', $user->email);  
        $this->setData('user_details', $detail); 
        $this->setData('login_error', $this->form_validation->error_array());
        $this->loadView();
    }
    public function validate_general_password() {
        $this->form_validation->set_rules('current_password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[6]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }
    public function validate_general_update() {
        $this->form_validation->set_rules('email', lang('email'), 'required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('phone_number', lang('phone_number'), 'required||regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }
    // function tab_actives(){
    //     $this->load->helper('security');
    //     $id = $this->security->xss_clean($this->input->post('tab_id')); 
    //     echo $id;die;
    //     $this->session->set_userdata('active_tab', $id);
    //     echo 'yes';
    //     exit();
    // }
}
