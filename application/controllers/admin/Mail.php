<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Mail extends Base_Controller {

    /**
     * For load the view
     * @author Techffodils Technologies LLP
     * @date 2018-02-5
     */
    function inbox() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('checkbox') && $this->input->post('delete')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());

            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $this->mail_model->deleteMail($id);
                }
            }
        }
        $unread_mail = $this->mail_model->getCountUnReadMail($user_id, 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('Inbox'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-02-6
     * @return type
     */
    function validate_mail_send() {
        $this->form_validation->set_rules('subject', lang('subject'), 'required');
        $this->form_validation->set_rules('content', lang('content'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2017-12-03
     */
    function compose() {
        
        $from_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $reply_user = '';
        $reply_subject = '';
        $forward_content = '';
        $attachment = '';

        if ($this->input->post('send') && $this->validate_mail_send()) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post_data['to_user']);
            $post_data['date'] = date("Y-m-d h:i:s");
            $post_data['read_status'] = 'unread';
            $post_data['images'] = '';
            $config['upload_path'] = FCPATH . 'assets/images/mail_system/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xls|xlsx|sql';
            $config['file_name'] = 'attachment' . time();
            $this->load->library('upload', $config);

            $upload_data = array();
            $files = $_FILES;
            if ($files) {
                $_FILES['userfile']['name'] = $files['images']['name'];
                $_FILES['userfile']['type'] = $files['images']['type'];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'];
                $_FILES['userfile']['error'] = $files['images']['error'];
                $_FILES['userfile']['size'] = $files['images']['size'];
                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $upload_data = $this->upload->data();
                    $post_data['images'] = $upload_data['orig_name'];
                }
            } else {
                $post_data['images'] = $this->input->post('images');
            }
            $user_array = array();
            $mail_type = isset($post_data['mail_type']) ? $post_data['mail_type'] : '';
            if ($mail_type == 'all_downlines') {
                $user_array = $this->mail_model->getAdminDownlines();
            } elseif ($mail_type == 'active_downlines') {
                $user_array = $this->mail_model->getAdminDownlines('active');
            } elseif ($mail_type == 'inactive_downlines') {
                $user_array = $this->mail_model->getAdminDownlines('inactive');
            } else {
                $user_array[] = $user_id;
            }
            $mail_res = false;
            foreach ($user_array as $user_id) {
                $post_data['from_id'] = $from_id;
                $post_data['user_id'] = $user_id;
                $post_data['catagories'] = 'inbox';
                $res = $this->mail_model->insertMailData($post_data);
                if ($res) {
                    $post_data['from_id'] = $user_id;
                    $post_data['user_id'] = $from_id;
                    $post_data['catagories'] = 'sent';
                    $mail_res = $this->mail_model->insertMailData($post_data);
                }
            }

            if ($mail_res) {
                $this->loadPage(lang('mail_send_sucessfully'), 'sent');
            } else {
                $this->loadPage(lang('something_error_occoured'), 'sent', 'danger');
            }
        }
        if ($this->input->post('draft')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $to_user = $post_data['to_user'];
            $to_id = $this->helper_model->userNameToID($to_user);
            if (!$user_id || $user_id == $to_id) {
                $this->loadPage(lang('enter_a_valid_username'), 'sent', 'danger');
            }
            $post_data['from_id'] = $user_id;
            $post_data['user_id'] = $to_id;
            $post_data['catagories'] = 'draft';
            $post_data['attachment'] = '';
            $post_data['read_status'] = 'unread';
            $post_data['date'] = date("Y-m-d h:i:s");

            $config['upload_path'] = FCPATH . 'assets/images/mail_system/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx';
            $new_name = 'pro_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $upload_data = array();
            $files = $_FILES;
            $post_data['images'] = '';
            if ($files) {
                $_FILES['userfile']['name'] = $files['images']['name'];
                $_FILES['userfile']['type'] = $files['images']['type'];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'];
                $_FILES['userfile']['error'] = $files['images']['error'];
                $_FILES['userfile']['size'] = $files['images']['size'];
                $new_name = 'attachment_' . time();
                $config['file_name'] = $new_name;
                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $upload_data = $this->upload->data();
                    $post_data['images'] = $upload_data['orig_name'];
                }
            } else {
                $post_data['images'] = $this->input->post('images');
            }
            ///////////////////////////////////////////////////
            $res = $this->mail_model->insertMailData($post_data);

            if ($res) {
                $this->loadPage(lang('mail_is_saved_in_draft_boxes'), 'sent');
            } else {
                $this->loadPage(lang('something_error_occoured'), 'sent', 'danger');
            }
        }

        $compose_flag = true;
        if ($this->input->post('reply')) {
            $compose_flag = false;
            $reply_user = $this->input->post('to_user');
            $reply_subject = $this->input->post('subject');
        }
        if ($this->input->post('forward')) {
            $compose_flag = false;
            $reply_user = '';
            $forward_content = $this->input->post('content');
            $attachment = $this->input->post('attachment');
            $reply_subject = $this->input->post('subject');
        }

        $this->setData('compose_flag', $compose_flag);
        $this->setData('reply_user', $reply_user);
        $this->setData('reply_user', $reply_user);
        $this->setData('reply_subject', $reply_subject);
        $this->setData('forward_content', $forward_content);
        $this->setData('attachment', $attachment);
        $unread_mail = $this->mail_model->getCountUnReadMail(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('compose'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2017-12-23
     * @param type $id
     */
    function read($id = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $mail_details = array();
        if ($id) {
            $this->mail_model->changeReadStatus($id, $user_id, 'read');
            $mail_details = $this->mail_model->getMailDetails($user_id, $id, 'inbox');
          
        }
        $this->setData('mail_details', $mail_details);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('read'));
        $unread_mail = $this->mail_model->getCountUnReadMail($user_id, 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $img_url = FCPATH . "assets/images/mail_system/";
        $this->setData('image_path', $img_url);
        $this->loadView();
    }

    /**
     * For View the spam
     *  @author Techffodils Technologies LLP
     * @date 2017-12-26
     */
    function spam() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('checkbox') && $this->input->post('delete')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $this->mail_model->deleteMail($id);
                }
            }
        }
        $unread_mail = $this->mail_model->getCountUnReadMail($user_id, 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('spam_messages'));
        $this->loadView();
    }

    /**
     * For sent mail listing
     * @author Techffodils Technologies LLP
     * @date 2017-12-26
     */
    function sent() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('checkbox') && $this->input->post('delete')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $this->mail_model->deleteMail($id);
                }
            }
        }
        $unread_mail = $this->mail_model->getCountUnReadMail($user_id, 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('sent'));
        $this->loadView();
    }

    /**
     * For viewing the drafted details
     * @author Techffodils Technologies LLP
     * @date 2017-12-26
     */
    function draft() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('checkbox') && $this->input->post('delete')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $this->mail_model->deleteMail($id);
                }
            }
        }
        $unread_mail = $this->mail_model->getCountUnReadMail($user_id, 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('draft'));
        $this->loadView();
    }

    /**
     * For star for each the internal mail
     * @author Techffodils Technologies LLP

     */
    function stared() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('checkbox') && $this->input->post('delete')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $this->mail_model->deleteMail($id);
                }
            }
        }
        $unread_mail = $this->mail_model->getCountUnReadMail($user_id, 'inbox');
        $this->setData('unread_mail', $unread_mail);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('stared'));
        $this->loadView();
    }

    /**
     * View stared
     * @author Techffodils Technologies LLP
     */
    function set_stared() {
        $id = $this->input->get('id');
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->mail_model->changestared($id, $user_id, 'yes');
        echo 'yes';
        exit;
    }

    /**
     * For unset the stared
     * @author Techffodils Technologies LLP
     */
    function unset_stared() {
        $id = $this->input->get('id');
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->mail_model->changestared($id, $user_id, 'no');
        echo 'yes';
        exit;
    }

    /**
     * For set the spam
     * @author Techffodils Technologies LLP
     */
    function set_spam() {
        $id = $this->input->get('id');
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->mail_model->changespam($id, $user_id, 'yes');
        echo 'yes';
        exit;
    }

    /**
     * for unset spam
     * @author Techffodils Technologies LLP
     */
    function unset_spam() {
        $id = $this->input->get('id');
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->mail_model->changespam($id, $user_id, 'no');
        echo 'yes';
        exit;
    }

    /**
     * For  getting the username
     * @author Techffodils Technologies LLP
     */
    function get_usernames() {
        $query = $this->input->get('query');
        $result = $this->mail_model->getAllUserNames($query);
        echo $result;
        exit();
    }

    function compose_mail() {
        $from_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $reply_user = '';
        $reply_subject = '';
        $forward_content = '';
        $attachment = '';

        if ($this->input->post('send') && $this->validate_mail_send()) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post_data['to_user']);
            $post_data['date'] = date("Y-m-d h:i:s");
            $post_data['read_status'] = 'unread';
            $post_data['images'] = '';
            $config['upload_path'] = FCPATH . 'assets/images/mail_system/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xls|xlsx|sql';
            $config['file_name'] = 'attachment' . time();
            $this->load->library('upload', $config);

            $upload_data = array();
            $files = $_FILES;
            if ($files) {
                $_FILES['userfile']['name'] = $files['images']['name'];
                $_FILES['userfile']['type'] = $files['images']['type'];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'];
                $_FILES['userfile']['error'] = $files['images']['error'];
                $_FILES['userfile']['size'] = $files['images']['size'];
                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $upload_data[] = $this->upload->data();
                    $post_data['images'] = $upload_data[0]['orig_name'];
                }
            } else {
                $post_data['images'] = $this->input->post('images');
            }
            $user_array = array();
            $mail_type = isset($post_data['mail_type']) ? $post_data['mail_type'] : '';
            if ($mail_type == 'all_downlines') {
                $user_array = $this->mail_model->getAdminDownlines();
            } elseif ($mail_type == 'active_downlines') {
                $user_array = $this->mail_model->getAdminDownlines('active');
            } elseif ($mail_type == 'inactive_downlines') {
                $user_array = $this->mail_model->getAdminDownlines('inactive');
            } else {
                $user_array[] = $user_id;
            }
            $mail_res = false;
            foreach ($user_array as $user_id) {
                $post_data['from_id'] = $from_id;
                $post_data['user_id'] = $user_id;
                $post_data['catagories'] = 'inbox';
                $res = $this->mail_model->insertMailData($post_data);
                if ($res) {
                    $post_data['from_id'] = $user_id;
                    $post_data['user_id'] = $from_id;
                    $post_data['catagories'] = 'sent';
                    $mail_res = $this->mail_model->insertMailData($post_data);
                }
            }

            if ($mail_res) {
                $this->loadPage(lang('mail_send_sucessfully'), 'sent');
            } else {
                $this->loadPage(lang('something_error_occoured'), 'sent', 'danger');
            }
        }
        if ($this->input->post('draft')) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $to_user = $this->input->post('to_user');
            $to_id = $this->helper_model->userNameToID($to_user);
            if (!$user_id || $user_id == $to_id) {
                $this->loadPage(lang('enter_a_valid_username'), 'sent', 'danger');
            }
            $post_data['from_id'] = $to_id;
            $post_data['user_id'] = $user_id;
            $post_data['catagories'] = 'draft';
            $post_data['attachment'] = '';
            $post_data['read_status'] = 'unread';
            $post_data['date'] = date("Y-m-d h:i:s");
            $config['upload_path'] = FCPATH . 'assets/images/mail_system/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xls|xlsx|sql';
            $new_name = 'attachment_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $upload_data = array();
            $files = $_FILES;
            $post_data['images'] = '';
            if ($files) {

                $_FILES['userfile']['name'] = $files['images']['name'];
                $_FILES['userfile']['type'] = $files['images']['type'];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'];
                $_FILES['userfile']['error'] = $files['images']['error'];
                $_FILES['userfile']['size'] = $files['images']['size'];

                $new_name = 'attachment_' . time();
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $upload_data[] = $this->upload->data();
                    $post_data['images'] = $upload_data[0]['orig_name'];
                }
            } else {
                $post_data['images'] = $this->input->post('images');
            }
            $res = $this->mail_model->insertMailData($post_data);

            if ($res) {
                $this->loadPage(lang('mail_is_saved_in_draft_boxes'), 'sent');
            } else {
                $this->loadPage(lang('something_error_occoured'), 'sent', 'danger');
            }
        }
        $this->loadPage('', 'sent');
    }

    function sent_list() {
        $request = $this->input->get();
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table1 = DB_PREFIX_SYSTEM . 'mail_system';
        $categorie = 'sent';
        $limit = $order = $where = '';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $column = $this->mail_model->getTableColumnSent();
        $total_records = $this->mail_model->countInbox($table1, $table2, $user_id, $categorie);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->mail_model->getTotalFilteredInbox($table1, $table2, $where, $user_id, $categorie);
        $res_data = $this->mail_model->getResultDataInbox($table1, $table2, $where, $order, $limit, $user_id, $categorie);

        $count_total_join = count($res_data);
        for ($i = 0; $i < $count_total_join; $i++) {
            $res_data[$i][2] = 'assets/images/users/' . $this->mail_model->imageDetails($res_data[$i][2]);


            $res_data[$i][2] = '<a class="mailbox-name" href="admin/mail/read/' . $res_data[$i][0] . '"><img src="' . $res_data[$i][2] . '" width="30px" height="30px" class="img-circle">&nbsp;&nbsp;<span class="label label-primary">' . $res_data[$i][3] . '</span></a>';
            $res_data[$i][3] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][1]), 0, 3))) . '..';
            $res_data[$i][4] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][4]), 0, 4))) . '....';
            $res_data[$i][1] = '<i value="1" onclick="stared(' . $res_data[$i][0] . ')"  class="fa fa-star-o text-yellow"></i>';
            $res_data[$i][0] = '<input value="' . $res_data[$i][0] . '"  name="checkbox[]" type="checkbox">';
            if ($res_data[$i][7]) {
                $res_data[$i][6] = '<a class="mailbox-attachment"><i class="fa fa-paperclip"></i></a>';
            } else {
                $res_data[$i][6] = ' ';
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function inbox_list() {
        $request = $this->input->get();
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table1 = DB_PREFIX_SYSTEM . 'mail_system';
        $categorie = 'inbox';
        $table_list = 'inbox_list';
        $limit = $order = $where = '';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $column = $this->mail_model->getTableColumnInbox();
        $total_records = $this->mail_model->countInbox($table1, $table2, $user_id, $categorie);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->mail_model->getTotalFilteredInbox($table1, $table2, $where, $user_id, $categorie);
        $res_data = $this->mail_model->getResultDataInbox($table1, $table2, $where, $order, $limit, $user_id, $categorie);

        $count_total_join = count($res_data);
        for ($i = 0; $i < $count_total_join; $i++) {
            $res_data[$i][2] = 'assets/images/users/' . $this->mail_model->imageDetails($res_data[$i][2]);


            $res_data[$i][2] = '<a class="mailbox-name" href="admin/mail/read/' . $res_data[$i][0] . '"><img src="' . $res_data[$i][2] . '" width="30px" height="30px" class="img-circle">&nbsp;&nbsp;<span class="label label-primary">' . $res_data[$i][3] . '</span></a>';
            $res_data[$i][3] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][1]), 0, 3))) . '..';
            $res_data[$i][4] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][4]), 0, 4))) . '....';
            $res_data[$i][1] = '<i value="1" onclick="stared(' . $res_data[$i][0] . ')"  class="fa fa-star-o text-yellow"></i>';

            if ($res_data[$i][7]) {
                $res_data[$i][6] = '<a class="mailbox-attachment"><i class="fa fa-paperclip"></i></a>';
            } else {
                $res_data[$i][6] = ' ';
            }

            $res_data[$i][7] = '<i onclick="spam(' . $res_data[$i][0] . ')" class="fa fa-check-square-o" aria-hidden="true" style="color: #bb8344 ">Spam</i>';
            $res_data[$i][0] = '<input value="' . $res_data[$i][0] . '"  name="checkbox[]" type="checkbox">';
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function draft_list() {
        $request = $this->input->get();
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table1 = DB_PREFIX_SYSTEM . 'mail_system';
        $categorie = 'draft';
        $limit = $order = $where = '';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $column = $this->mail_model->getTableColumnSent();
        $total_records = $this->mail_model->countInbox($table1, $table2, $user_id, $categorie);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->mail_model->getTotalFilteredInbox($table1, $table2, $where, $user_id, $categorie);
        $res_data = $this->mail_model->getResultDataInbox($table1, $table2, $where, $order, $limit, $user_id, $categorie);

        $count_total_join = count($res_data);
        for ($i = 0; $i < $count_total_join; $i++) {
            $res_data[$i][2] = 'assets/images/users/' . $this->mail_model->imageDetails($res_data[$i][2]);


            $res_data[$i][2] = '<a class="mailbox-name" href="admin/mail/read/' . $res_data[$i][0] . '"><img src="' . $res_data[$i][2] . '" width="30px" height="30px" class="img-circle">&nbsp;&nbsp;<span class="label label-primary">' . $res_data[$i][3] . '</span></a>';
            $res_data[$i][3] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][1]), 0, 3))) . '..';
            $res_data[$i][4] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][4]), 0, 4))) . '....';
            $res_data[$i][1] = '<i value="1" onclick="stared(' . $res_data[$i][0] . ')"  class="fa fa-star-o text-yellow"></i>';
            $res_data[$i][0] = '<input value="' . $res_data[$i][0] . '"  name="checkbox[]" type="checkbox">';
            if ($res_data[$i][7]) {
                $res_data[$i][6] = '<a class="mailbox-attachment"><i class="fa fa-paperclip"></i></a>';
            } else {
                $res_data[$i][6] = ' ';
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function spam_list() {
        $request = $this->input->get();
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table1 = DB_PREFIX_SYSTEM . 'mail_system';
        $field = 'spam';
        $limit = $order = $where = '';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $column = $this->mail_model->getTableColumnSent();
        $total_records = $this->mail_model->countSpam($table1, $table2, $user_id, $field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->mail_model->getTotalFilteredSpam($table1, $table2, $where, $user_id, $field);
        $res_data = $this->mail_model->getResultDataSpam($table1, $table2, $where, $order, $limit, $user_id, $field);

        $count_total_join = count($res_data);
        for ($i = 0; $i < $count_total_join; $i++) {
            $res_data[$i][2] = 'assets/images/users/' . $this->mail_model->imageDetails($res_data[$i][2]);


            $res_data[$i][2] = '<a class="mailbox-name" href="admin/mail/read/' . $res_data[$i][0] . '"><img src="' . $res_data[$i][2] . '" width="30px" height="30px" class="img-circle">&nbsp;&nbsp;<span class="label label-primary">' . $res_data[$i][3] . '</span></a>';
            $res_data[$i][3] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][1]), 0, 3))) . '..';
            $res_data[$i][4] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][4]), 0, 4))) . '....';
            $res_data[$i][1] = '<i value="1" onclick="stared(' . $res_data[$i][0] . ')"  class="fa fa-star-o text-yellow"></i>';

            if ($res_data[$i][7]) {
                $res_data[$i][6] = '<a class="mailbox-attachment"><i class="fa fa-paperclip"></i></a>';
            } else {
                $res_data[$i][6] = ' ';
            }
            $res_data[$i][7] = '<i onclick="spam_unset(' . $res_data[$i][0] . ')" class="fa fa-check-square-o" aria-hidden="true" style="color: #bb8344 ">NotSpam</i>';
            $res_data[$i][0] = '<input value="' . $res_data[$i][0] . '"  name="checkbox[]" type="checkbox">';
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function star_list() {
        $request = $this->input->get();
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table1 = DB_PREFIX_SYSTEM . 'mail_system';
        $field = 'stared';
        $limit = $order = $where = '';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $column = $this->mail_model->getTableColumnSent();
        $total_records = $this->mail_model->countSpam($table1, $table2, $user_id, $field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->mail_model->getTotalFilteredSpam($table1, $table2, $where, $user_id, $field);
        $res_data = $this->mail_model->getResultDataSpam($table1, $table2, $where, $order, $limit, $user_id, $field);

        $count_total_join = count($res_data);
        for ($i = 0; $i < $count_total_join; $i++) {
            $res_data[$i][2] = 'assets/images/users/' . $this->mail_model->imageDetails($res_data[$i][2]);


            $res_data[$i][2] = '<a class="mailbox-name" href="admin/mail/read/' . $res_data[$i][0] . '"><img src="' . $res_data[$i][2] . '" width="30px" height="30px" class="img-circle">&nbsp;&nbsp;<span class="label label-primary">' . $res_data[$i][3] . '</span></a>';
            $res_data[$i][3] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][1]), 0, 3))) . '..';
            $res_data[$i][4] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][4]), 0, 4))) . '....';
            $res_data[$i][1] = '<i value="1" onclick="unstared(' . $res_data[$i][0] . ')"  class="fa fa-star text-yellow"></i>';
            $res_data[$i][0] = '<input value="' . $res_data[$i][0] . '"  name="checkbox[]" type="checkbox">';
            if ($res_data[$i][7]) {
                $res_data[$i][6] = '<a class="mailbox-attachment"><i class="fa fa-paperclip"></i></a>';
            } else {
                $res_data[$i][6] = ' ';
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

}
