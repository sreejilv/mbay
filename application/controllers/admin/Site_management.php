<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include_once 'Base_Controller.php';

class Site_management extends Base_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * For Site Management
     * @author Techffodils Technologies LLP
     * @Date 2017-10-18
     *
     */
    function site_configuration() {
        $title = lang('site_settings');
        $this->setData('title', lang('menu_name_42'));
        $this->setData('page_title', $title);
        $site_info = $this->site_management_model->get_site_info();

        if ($this->input->post('update_site_info') && $this->validate_site_info()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            $company_name = $post_arr['company_name'];
            $company_address = $post_arr['company_address'];
            $company_email = $post_arr['company_email'];
            $company_phone = $post_arr['company_phone'];
            $google_analytics = $post_arr['google_analytics'];
            $admin_email = 'na';
            $data = array();
            $logo_name = $site_info['company_logo'];
            if ($_FILES['company_logo']['error'] == 0) {
                $config['upload_path'] = FCPATH . 'assets/images/logos/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $new_name = 'logo_' . time();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('company_logo')) {
                    $uploadData = $this->upload->data();
                    $logo_name = $uploadData['file_name'];
                }
            }
            $fav_icon = $site_info['company_fav_icon'];
            if ($_FILES['company_fav_icon']['error'] == 0) {
                $config1['upload_path'] = FCPATH . 'assets/images/logos/';
                $config1['allowed_types'] = 'jpg|png|jpeg';
                $new_name = 'fav_' . time();
                $config1['file_name'] = $new_name;
                $this->load->library('upload', $config1);
                $this->upload->initialize($config1);
                if ($this->upload->do_upload('company_fav_icon')) {
                    $uploadData = $this->upload->data();
                    $fav_icon = $uploadData['file_name'];
                }
            }
            $result = $this->site_management_model->updateSiteInformation($company_name, $admin_email, $company_address, $company_email, $company_phone, $logo_name, $fav_icon,$google_analytics);
            if ($result) {
                $this->session->unset_userdata('mlm_site_info');
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'site_information_updated', $post_arr);

                $msg = lang('successfully_update_site_settings');
                $this->loadPage($msg, "website-manage");
            } else {
                $msg = lang('error_while_entring_site_settings');
                $this->loadPage($msg, "website-manage", 'danger');
            }
        } else {
            $this->setData('error', $this->form_validation->error_array());
        }
        $this->setData('site_info', $site_info);
        $this->loadView();
    }

    /**
     * For validate the site info 

     * @author Techffodils Technologies LLP
     * @date 2017-12-18 

     * @return type
     */
    function validate_site_info() {
        $this->form_validation->set_rules('company_name', lang('company_name'), 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('company_address', lang('address'), 'trim|required');
        $this->form_validation->set_rules('company_email', lang('company_email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('company_phone', lang('company_phone'), 'trim|required');

        $result = $this->form_validation->run();
        return $result;
    }

    /**
     * 
     *  @author techffodils Technologies LLP
     * @dataProvider
     * @date 2017-10-19 Thursday
     * @param type $lang_code
     */
    function mail_content_management($lang_code = '') {

        $title = lang('mail_content_management');
        $this->setData('title', $title);

        $all_lang = $this->site_management_model->getAllActiveLangauges();
        $avail_lang = $this->site_management_model->getAllLangauage('registration');
        $password_reset = $this->site_management_model->getAllLangauage('password_reset');
        $subject = $content = $lang_id = '';
        $array_arr = $details = array();
        $i = 0;
        $default_lang = 'en';

        if ($this->input->post() && $this->validate_mail_content()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            $content = $post_arr['content' . '_' . $post_arr['lang_code']];
            $subject = $post_arr['subject' . '_' . $post_arr['lang_code']];
            $lang_id = $post_arr['lang_id'];

            $result = $this->site_management_model->insertMailContent($content, $subject, $lang_id, $post_arr['lang_type'], $post_arr['lang_code']);


            if ($result) {

                $msg = lang('succesfully_' . $post_arr['lang_type'] . '_inserted_mail_management');
                $this->loadPage($msg, 'mail-template-manage');
            } else {
                $msg = lang('error_while_insert_' . $post_arr['lang_type'] . '_mail_management');
                $this->loadPage($msg, 'mail-template-manage', 'danger');
            }
        } else {
            $error = $this->form_validation->error_array();

            $this->setData('form_error', $error);
        }

        $this->setData('default_lang', $default_lang);
        $this->setData('all_lang', $all_lang);
        $this->setData('page_header', "Registration Content");
        $this->setData('page_title', "Password Recovery Content");
        $this->setData('title', "MailContent");
        $this->setData('data', $avail_lang);
        $this->setData('password_reset', $password_reset);

        $this->loadView();
    }

    /**
     * For Form Validation
     * @author Techffodils Technologies LLP

     * @date 2017-10-19 Thursday
     * @return boolean
     */
    function validate_mail_content() {
        $post_arr = $this->input->post(NULL, TRUE);

        $this->form_validation->set_rules('content_' . $post_arr['lang_code'], 'Mail Content', 'trim|required');
        $this->form_validation->set_rules('subject_' . $post_arr['lang_code'], 'Subject', 'trim|required|strip_tags');
        $this->form_validation->set_error_delimiters("<div style='color:#b94a48;'>", "</div>");
        $validation_status = $this->form_validation->run();

        return $validation_status;
    }

    /**
     *
     * For Mail Settings
     * @author Techffodils Technologies LLP
     * @date 2017-10-25
     *
     */
    function mail_settings() {
        $title = lang('mail_configuration');
        $this->setData('title', $title);
        $getMailDetails = $this->site_management_model->getSiteManagementData($this->session->userdata('mail_management', 'mail_engine'));
        if ($this->input->post() && $this->validate_mail_settings()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            if ($this->aauth->getUserType() == 'admin' || $this->aauth->getUserType() == 'emloyee') {
                $post_arr['user_id'] = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            }

            $result = $this->site_management_model->insertMailContenetDetails($post_arr);
            if ($result) {

                $this->session->unset_userdata('mail_management');
                $msg = lang('successfully_insert_mail_content');
                $this->loadPage($msg, 'mail-manage');
            } else {

                $msg = lang('error_while_inserting_mail_settings', danger);
                $this->loadPage($msg, 'mail-manage');
            }
        } else {

            $this->setData('error', $this->form_validation->error_array());
        }

        $this->setData('mail_status', $this->dbvars->MAIL_STATUS);
        $this->setData('page_title', lang('menu_name_37'));
        $this->setData('mail_data', $getMailDetails);

        $this->loadView();
    }

    function change_mail_send_status() {
        $status = $this->input->get('status');
        if ($status == 1 || $status == 0) {
            $this->dbvars->MAIL_STATUS = $status;
            echo 'yes';
            exit();
        }
        echo 'no';
        exit();
    }

    /**
     * For Validate Email content
     *  @author Techffodils Technologies LLP
     * @date 2017-12-1
     * @return type
     */
    function validate_mail_settings() {
        $this->load->helper('security');
        $data_arr = $this->security->xss_clean($this->input->post());
        $this->session->set_userdata('mail_management', $data_arr);
        $this->form_validation->set_rules('mail_engine', lang('mail_engine'), 'required');
        if ($data_arr['mail_engine'] != 'mail') {
            $this->form_validation->set_rules('from_mail', lang('from_mail'), 'required|valid_email');
            $this->form_validation->set_rules('host_name', lang('smtp_hostname'), 'required');
            $this->form_validation->set_rules('smtp_username', lang('smtp_username'), 'required');
            $this->form_validation->set_rules('smtp_password', lang('smtp_password'), 'required');
        }

        $form_result = $this->form_validation->run();
        return $form_result;
    }

    /**
     * For Mail Content Settings
     *  @author Techffodils Technologies LLP
     * @date 2018-02-27
     * @param type $lang_code
     */
    function mail_contents($lang_code = '') {
        $content_id = 0;
        $content_id = $this->input->post('update_mail_content') ? $this->input->post('update_mail_content') : 0;
        if ($this->input->post('update_mail_content') && $this->validate_mail_contents($content_id)) {

            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $result = $this->site_management_model->updateMailContent($content_id, $post);
            if ($result) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'mail_content_updated', $post);
                $this->loadPage(lang('mail_content_updated_successfully'), 'mail-template');
            } else {
                $this->loadPage(lang('failed_mail_content_update'), 'mail-template', 'danger');
            }
        }
        $sys_mails = $this->site_management_model->getAllSystemMails();
        $mails = $this->site_management_model->getSystemMails();

        $this->setData('error', $this->form_validation->error_array());
        $this->setData('content_id', $content_id);
        $this->setData('sys_mails', $sys_mails);
        $this->setData('mails', $mails);
        $this->setData('host', $_SERVER['HTTP_HOST']);
        $this->setData('title', lang('menu_name_43'));
        $this->loadView();
    }

    /**
     * For Validate Mail Content
     *  @author Techffodils Technologies LLP
     * @date 2018-02-27
     * @param type $content_id
     * @return type
     */
    function validate_mail_contents($content_id) {
        $this->session->set_userdata('active_mail_content_tab', $content_id);

        $this->form_validation->set_rules('mail_subject', lang('mail_subject'), 'required');
        $this->form_validation->set_rules('mail_content', lang('mail_content'), 'required');
        $form_result = $this->form_validation->run();
        return $form_result;
    }

    /**
     * For mail Status Settings
     *  @author Techffodils Technologies LLP
     * @date 2018-02-27
     */
    function change_mail_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        
        $mail_id = $post['id'];
        $status = $post['status'];
        if ($mail_id && ($status == 1 || $status == 0)) {
            $res = $this->site_management_model->changeMailStatus($mail_id, $status);
            if ($res) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'change_mail_status', $post);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For Validate AdminEmail Settings
     * @author Techffodils Technologies LLP
     * @date 2018-02-27
     * @param type $admin_email
     * @return boolean
     */
    public function check_valid_admin_email_unique($admin_email = '') {
        if ($admin_email != '') {
            $flag = false;
            if ($this->site_management_model->checkAdminEmailExistsOrNot($admin_email)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->post('username')) {
            if ($this->site_management_model->checkAdminEmailExistsOrNot($this->input->post('username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

}
