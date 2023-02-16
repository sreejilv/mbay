<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once'Base_Controller.php';

class Ticket_system extends Base_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * For load ticket system
     * @author Techffodils Technologies LLP
     * @date 2018-02-27
     */
    function index() {
        $this->setData('title', lang('menu_name_168'));
        $this->setData('tickets_ratio', $this->ticket_system_model->getTicketRation());
        $this->setData('new_tickets', $this->ticket_system_model->getTicketCount('new'));
        $this->setData('open_tickets', $this->ticket_system_model->getTicketCount('open'));
        $this->setData('processed_tickets', $this->ticket_system_model->getTicketCount('procesed'));
        $this->setData('completed_tickets', $this->ticket_system_model->getTicketCount('completed'));
        $this->setData('tag_wise_ticket', $this->ticket_system_model->getTagWiseTicket());
        $this->setData('tickets_by_status', $this->ticket_system_model->getStatusWiseTicket());
        $this->setData('recent_ticket', $this->ticket_system_model->getRecentTicket());

        $this->loadView();
    }

    /**
     * For Ticket Type Configuration
     * @author Techffodils Technologies LLP
     * @access public
     * @date 2018-02-27
     * @param type $action
     * @param type $id
     */
    function ticket_type_configuration($action = '', $id = NULL) {


        $ticket_type = $this->ticket_system_model->getAllTypeName();
        $this->setData('ticket_type', $ticket_type);


        if ($this->input->post('type_names') && $this->validate_type_name_settings()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $this->dbvars->DEF_TICKET_TYPE = $post['type_name'];
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'type_name_changed', $post);
        }



        $type_name = '';
        if ($action && $id) {
            if ($action == 'edit') {
                $edit_data = $this->ticket_system_model->getEditeTypeDetails($id);
                $type_name = $edit_data['type_name'];

                $this->setData('type_name', $type_name);
                $this->setData('action', $action);
                $this->setData('id', $id);
            } elseif ($action == 'delete') {
                $result = $this->ticket_system_model->deleteType($id);
                if ($result) {
                    $msg = lang('delete_type');
                    $this->loadPage($msg, 'support-manage-type');
                }
            }
        }

        //$details = $this->ticket_system_model->getAllTypes();

        if ($this->input->post('insert_type') && $this->validation_type()) {

            $this->load->helper('security');
            $post_array = $this->security->xss_clean($this->input->post());

            $result = $this->ticket_system_model->insertTicketType($post_array);
            if ($result) {
                $message = lang('type_inserted_successfully');
                $this->loadPage($message, 'support-manage-type');
            } else {
                $message = lang('error_while_type_insertion');
                $this->loadPage($message, 'support-manage-type', 'danger');
            }
        } else {
            $this->setData('error', $this->form_validation->error_array());
        }

        if ($this->input->post('update_type') && $this->validation_type()) {
            $this->load->helper('security');
            $post_array = $this->security->xss_clean($this->input->post());
            $id = $post_array['type_id'];
            $type_name = $post_array['type_name'];
            $result = $this->ticket_system_model->updateType($id, $type_name);
            if ($result) {
                $message = lang('type_update_successfully');
                $this->loadPage($message, 'support-manage-type');
            } else {
                $message = lang('error_while_type_updation');
                $this->loadPage($message, 'support-manage-type', 'danger');
            }
        }

        $title = lang('menu_name_170');
        $this->setData('title', $title);
        $this->setData('def_type', $this->dbvars->DEF_TICKET_TYPE);
        $this->loadView();
    }

    function validate_type_name_settings() {
        $this->form_validation->set_rules('type_name', lang('type_name'), 'required');
        if ($this->input->post('type_name') == 'type_name')
            $this->form_validation->set_rules('type_name', lang('type_name'), 'required');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For ticket Department Configuration add,update ,edit,delete
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies LLP
     * @param type $action
     * @param type $id
     */
    function ticket_department_configuration($action = '', $id = NULL) {
        $title = lang('department_configuration');
        $this->setData('title', $title);

        $type_name = '';
        if ($action && $id) {
            if ($action == 'edit') {
                $edit_data = $this->ticket_system_model->getEditedepartmentDetails($id);
                $department_name = $edit_data['type_name'];

                $this->setData('department_name', $department_name);
                $this->setData('action', $action);
                $this->setData('id', $id);
            } elseif ($action == 'delete') {
                $result = $this->ticket_system_model->deletedepartment($id);
                if ($result) {
                    $msg = lang('delete_department');
                    $this->loadPage($msg, 'support-manage-department');
                }
            }
        }
        //$details = $this->ticket_system_model->getAllDepartments();

        if ($this->input->post('insert_department') && $this->validation_department()) {
            $this->load->helper('security');
            $post_array = $this->security->xss_clean($this->input->post());

            $result = $this->ticket_system_model->insertTicketdepartment($post_array);
            if ($result) {
                $message = lang('department_inserted_successfully');
                $this->loadPage($message, 'support-manage-department');
            } else {
                $message = lang('error_while_department_insertion');
                $this->loadPage($message, 'support-manage-department', 'danger');
            }
        } else {
            $this->setData('error', $this->form_validation->error_array());
        }

        if ($this->input->post('update_department') && $this->validation_department()) {
            $this->load->helper('security');
            $post_array = $this->security->xss_clean($this->input->post());
            $id = $post_array['department_id'];
            $type_name = $post_array['department_name'];
            $result = $this->ticket_system_model->updatedepartment($id, $type_name);
            if ($result) {
                $message = lang('department_update_successfully');
                $this->loadPage($message, 'support-manage-department');
            } else {
                $message = lang('error_while_department_updation');
                $this->loadPage($message, 'support-manage-department', 'danger');
            }
        }
        $this->loadView();
    }

    /**
     * For ticket deprtment configuration add,update,delete
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * @param type $action
     * @param type $id
     */
    function ticket_priority_configuration($action = '', $id = NULL) {
        $title = lang('priority_configuration');
        $this->setData('title', $title);

        $type_name = '';
        if ($action && $id) {
            if ($action == 'edit') {
                $edit_data = $this->ticket_system_model->getEditepriorityDetails($id);
                $department_name = $edit_data['type_name'];

                $this->setData('priority_name', $department_name);
                $this->setData('action', $action);
                $this->setData('id', $id);
            } elseif ($action == 'delete') {
                $result = $this->ticket_system_model->deletePriority($id);
                if ($result) {
                    $msg = lang('delete_priority');
                    $this->loadPage($msg, 'support-manage-priority');
                }
            }
        }

        if ($action == 'activate') {
            $result = $this->ticket_system_model->activatePriority($id);
            if ($result) {
                $msg = lang('activate_priority');
                $this->loadPage($msg, 'support-manage-priority');
            }
        }

        if ($this->input->post('insert_priority') && $this->validation_priority()) {
            $this->load->helper('security');
            $post_array = $this->security->xss_clean($this->input->post());
            $result = $this->ticket_system_model->insertTicketPriority($post_array);
            if ($result) {
                $message = lang('priority_inserted_successfully');
                $this->loadPage($message, 'support-manage-priority');
            } else {
                $message = lang('error_while_priority_insertion');
                $this->loadPage($message, 'support-manage-priority', 'danger');
            }
        } else {
            $this->setData('error', $this->form_validation->error_array());
        }

        if ($this->input->post('update_priority') && $this->validation_priority()) {
            $this->load->helper('security');
            $post_array = $this->security->xss_clean($this->input->post());
            $id = $post_array['priority_id'];
            $type_name = $post_array['priority_name'];
            $result = $this->ticket_system_model->updatePriority($id, $type_name);
            if ($result) {
                $message = lang('priority_update_successfully');
                $this->loadPage($message, 'support-manage-priority');
            } else {
                $message = lang('error_while_priority_updation');
                $this->loadPage($message, 'support-manage-priority', 'danger');
            }
        }

        $this->loadView();
    }

    /**
     * For add ticket faq also edit,update,delete option are here
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $action
     * @param type $id
     */
    public function faq($action = '', $id = NULL) {
        $title = lang('faq');
        $this->setData('title', $title);


        $department = $this->ticket_system_model->getAllDepartments();
        $edited_details = array();

        if ($action == "delete") {
            $result = $this->ticket_system_model->updateStatus($id);
            if ($result) {
                $this->loadPage(lang('delete_faq'), 'support-faq');
            } else {
                $this->loadPage(lang('error_delete_faq'), 'support-faq', 'danger');
            }
        } elseif ($action == 'edit') {
            $edited_details = $this->ticket_system_model->getEditedFaqData($id);

            $this->setData('department_id', $edited_details['department_id']);
            $this->setData('question', $edited_details['question']);
            $this->setData('answer', $edited_details['answer']);
        } elseif ($action == "activate") {
            $result = $this->ticket_system_model->changeStatus($id, 1);
            if ($result) {
                $this->loadPage(lang('activate_faq'), 'support-faq');
            } else {
                $this->loadPage(lang('error_activate_faq'), 'support-faq', 'danger');
            }
        } elseif ($action == "inactivate") {
            $result = $this->ticket_system_model->changeStatus($id, 0);
            if ($result) {
                $this->loadPage(lang('activate_faq'), 'support-faq');
            } else {
                $this->loadPage(lang('error_activate_faq'), 'support-faq', 'danger');
            }
        }

        if ($this->input->post('faq_update') && $this->form_faq_validate()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());
            $post_arr['id'] = $id;

            $result = $this->ticket_system_model->updateFaq($post_arr);
            if ($result) {
                $this->loadPage(lang('faq_updated_successfully'), 'support-faq');
            } else {
                $this->loadPage(lang('error_while_faq_updation'), 'support-faq', 'danger');
            }
        } else {
            $this->setData('error', 'support-faq');
        }


        if ($this->input->post('faq_submit') && $this->form_faq_validate()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            $result = $this->ticket_system_model->insertFaq($post_arr);
            if ($result) {
                $this->loadPage(lang('faq_submitted_successfully'), 'support-faq');
            } else {
                $this->loadPage(lang('error_while_faq_insertion'), 'support-faq', 'danger');
            }
        } else {
            $this->setData('error', 'support-faq');
        }



        //$get_all_faqdetails = $this->ticket_system_model->getAllFaqDetails();

        $this->setData('details', $department);

        //$this->setData('data_arr', $get_all_faqdetails);


        $this->setData('action', $action);


        $this->loadView();
    }

    /**
     * For validate the Frequently Asked Question(FAQ)Form
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function form_faq_validate() {
        $this->form_validation->set_rules('department', lang('department'), 'required');
        $this->form_validation->set_rules('question', lang('question'), 'required|trim');
        $this->form_validation->set_rules('answer', lang('answer'), 'required|trim');
        $form_result = $this->form_validation->run();
        // print_r(validation_errors());die;
        return $form_result;
    }

    /**
     * For list out the resolved(closed) tickets
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function resolved_tickets() {
        $title = lang('resolved_tickets');
        $this->setData('title', $title);

        $details = $this->ticket_system_model->getAllResolvedTickets();

        $this->setData('details', $details);


        $this->loadView();
    }

    /**
     * For listed up the open tickets
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function open_tickets() {
        $title = lang('open_tickets');
        $this->setData('title', $title);

        $details = $this->ticket_system_model->getAllOpenedTickets();

        $this->setData('details', $details);

        $this->loadView();
    }

    /**
     * For validate type form
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function validation_type() {
        $this->form_validation->set_rules('type_name', lang('type_name'), 'required|trim|alpha_numeric_spaces');
        $validation_result = $this->form_validation->run();
        return $validation_result;
    }

    /**
     * For validate department form
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function validation_department() {
        $this->form_validation->set_rules('department_name', lang('department_name'), 'required|trim|alpha_numeric_spaces');
        $validation_result = $this->form_validation->run();
        return $validation_result;
    }

    /**
     * For validate priority
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function validation_priority() {
        $this->form_validation->set_rules('priority_name', lang('priority_name'), 'required|trim|alpha_numeric_spaces');
        $validation_result = $this->form_validation->run();
        return $validation_result;
    }

    /**
     * For view all tickets details
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     */
    function view_all_details($id = '') {

        $title = lang('view_full_details');
        $this->setData('title', $title);
        $details = [];

        $check_status = $this->ticket_system_model->checkTickettIdExistsOrNot($id);
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        if ($check_status) {
            $details = $this->ticket_system_model->getAllTicketsUserWise($id);
        }
        $type = $this->ticket_system_model->getAllTypes();

        $this->setData('types', $type);
        $this->setData('user_id', $user_id);
        $this->setData('details', $details);
        $this->session->set_userdata('sess_tktid', $id);


        $this->loadView();
    }

    /**
     * For change the ticket assignee
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function change_assignee() {
        $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->load->helper('security');
        $post_arr = $this->security->xss_clean($this->input->post());

        $user_name = $post_arr['user_name'];
        $ticket = $post_arr['ticket'];
        $user_id = $this->ticket_system_model->EmpUserNameToId($user_name);
        $result = $this->ticket_system_model->changeAssignee($user_id, $ticket);
        if ($result) {
            $data = array();
            $data['emp_id'] = $user_id;
            $data['ticket'] = $ticket;
            $this->helper_model->insertActivity($log_user, 'ticket_assignee_changed', $data);
            echo 'yes';
            exit();
        } else {
            echo 'no';
            exit();
        }
    }

    /**
     * For chnage ticket status
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function change_status() {
        $this->load->helper('security');
        $post_arr = $this->security->xss_clean($this->input->post());

        $status = $post_arr['status'];
        $ticket = $post_arr['ticket'];
        $user_id = $this->aauth->getId();
        $result = $this->ticket_system_model->updateTicketStatus($status, $ticket, $user_id);
        if ($result) {
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $data = array();
            $data['status'] = $status;
            $data['ticket'] = $ticket;
            $data['done_by'] = $user_id;
            $this->helper_model->insertActivity($log_user, 'ticket_status_changed', $data);
            echo 'yes';
            exit();
        } else {
            echo'no';
            exit();
        }
    }

    /**
     * For reply for the ticket message
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function reply_message() {

        if ($this->input->post()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            $post_arr['user_id'] = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $config['upload_path'] = FCPATH . 'assets/images/tickets/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';

            $this->load->library('upload', $config);

            $upload_data = array();

            $files = $_FILES;
            $cpt = count($_FILES['fields']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $new_name = 'ticket_' . $i . '_' . time();
                $config['file_name'] = $new_name;
                $_FILES['userfile']['name'] = $files['fields']['name'][$i];
                $_FILES['userfile']['type'] = $files['fields']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['fields']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['fields']['error'][$i];
                $_FILES['userfile']['size'] = $files['fields']['size'][$i];

                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $upload_data[] = $this->upload->data();
                }
            }

            $result = $this->ticket_system_model->updateReplyImage($post_arr, $upload_data);

            if ($result) {
                $this->load->model('send_mail_model');
                $mail_user_id = $this->ticket_system_model->getFromUserIdFromTicketId($post_arr['ticket_id']);
                $ticket_status = $this->ticket_system_model->getTicketStatus($post_arr['ticket_id']);
                ;
                if ($ticket_status == 1) {
                    $this->ticket_system_model->updateTicketStatus(2, $post_arr['ticket_id'], $mail_user_id, 1);
                }
                $this->send_mail_model->send($mail_user_id, '', 'ticket_reply', $post_arr);
                $result = $this->ticket_system_model->updateReplyStatus(1, $post_arr['ticket_id'], $this->aauth->getUserType());
                $id = $this->session->sess_tktid;
                $this->loadPage(lang('message_send_successfully'), 'ticket_system/view_all_details/' . $id);
            } else {
                $this->loadPage(lang('message_send_failed'), 'ticket_system/view_all_details/' . $id);
            }




            $id = $this->session->sess_tktid;
        }
    }

    function get_new_tickets() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'ticket';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';
        $column = $this->ticket_system_model->getTableColumnNewTickets();
        $total_records = $this->ticket_system_model->countOfTotalNewTickets();
        $limit = $this->ticket_system_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->ticket_system_model->getTotalFilteredTotalNewTickets($table1, $table2, $where);
        $res_data = $this->ticket_system_model->getNewTicketResultData($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $user_dp = $this->ticket_system_model->getUserDpFromName($res_data[$i][1]);
            $res_data[$i][1] = '<img src="assets/images/users/' . $user_dp . '" alt="image" height="50px" width="60px"> <b>' . $res_data[$i][1] . '</b>';
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function get_faq() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'ticket_faq';
        $table2 = DB_PREFIX_SYSTEM . 'ticket_department';
        $limit = $order = $where = '';
        $column = $this->ticket_system_model->getTableColumnFAQ();
        $total_records = $this->ticket_system_model->countOfTotalFAQ();
        $limit = $this->ticket_system_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->ticket_system_model->getTotalFilteredTotalFAQ($table1, $table2, $where);
        $res_data = $this->ticket_system_model->getFAQResultData($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {

            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a href="javascript:editFaqDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:inactivateFaqDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title=' . lang('inactivate') . '><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:deleteFaqDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:activateFaqDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:deleteFaqDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            }
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function get_ticket_types() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'ticket_type';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'type_name',
            'date',
            'status'
        );

        $column = $this->ticket_system_model->getTableColumnTicketTypesList();
        $total_records = $this->ticket_system_model->countOfTicketTypes();

        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->ticket_system_model->getTotalFilteredTicketTypes($table, $where);
        $res_data = $this->ticket_system_model->getResultDataTicketTypes($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][3]) {
                $res_data[$i][4] = '<a href="javascript:editDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> ';
                if ($res_data[$i][0] != $this->dbvars->DEF_TICKET_TYPE) {
                    $res_data[$i][4] .= '  <a href="javascript:deleteType(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
                }
                $res_data[$i][3] = lang('active');
            } else {
                $res_data[$i][4] = '<a href="javascript:deleteType(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][3] = lang('inactive');
            }
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function get_ticket_departments() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'ticket_department';
        $limit = $order = $where = '';
        $columns = array(
            'department_id',
            'department_name',
            'date',
            'status'
        );

        $column = $this->ticket_system_model->getTableColumnTicketDepartmentList();
        $total_records = $this->ticket_system_model->countOfTicketDepartment();

        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->ticket_system_model->getTotalFilteredTicketDepartment($table, $where);
        $res_data = $this->ticket_system_model->getResultDataTicketDepartment($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][3]) {
                $res_data[$i][4] = '<a href="javascript:editDepartmentDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a>  <a href="javascript:deleteDepartment(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][3] = lang('active');
            } else {
                $res_data[$i][4] = '<a href="javascript:deleteDepartment(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][3] = lang('inactive');
            }
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function get_ticket_priorities() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'ticket_priority';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'name',
            'date',
            'status'
        );

        $column = $this->ticket_system_model->getTableColumnTicketPriorityList();
        $total_records = $this->ticket_system_model->countOfTicketPriority();

        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->ticket_system_model->getTotalFilteredTicketPriority($table, $where);
        $res_data = $this->ticket_system_model->getResultDataTicketPriority($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            if ($res_data[$i][3]) {
                $res_data[$i][4] = '<a href="javascript:editPriorityDetails(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a>  <a href="javascript:deletePriority(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][3] = lang('active');
            } else {
                $res_data[$i][4] = '<a href="javascript:deletePriority(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][3] = lang('inactive');
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

    function ticket_management($action = '', $ticket_id = '') {
        if ($action && $ticket_id) {
            if ($action == 'open') {
                $result = $this->ticket_system_model->openTicket($ticket_id);
                if ($result) {
                    $this->loadPage(lang('ticket_opened_successfully'), 'tickets');
                } else {
                    $this->loadPage(lang('ticket_opened_failed'), 'tickets', 'danger');
                }
            } elseif ($action == 'delete') {
                $result = $this->ticket_system_model->deleteTicket($ticket_id);
                if ($result) {
                    $this->loadPage(lang('ticket_deleted_successfully'), 'tickets');
                } else {
                    $this->loadPage(lang('ticket_deleted_failed'), 'tickets', 'danger');
                }
            }
        }
        $this->setData('title', lang('menu_name_174'));
        $this->setData('new_ticket', $this->ticket_system_model->countOfTotalNewTicketList());
        $this->setData('open_ticket', $this->ticket_system_model->countOfTotalOpenTicketList());
        $this->setData('processing_ticket', $this->ticket_system_model->countOfTotalProcessingTicketList());
        $this->setData('completed_ticket', $this->ticket_system_model->countOfTotalCompletedTicketList());


        $this->loadView();
    }

    function new_ticket_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'ticket';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';
        $column = $this->ticket_system_model->getTableColumnNewTicketList();
        $total_records = $this->ticket_system_model->countOfTotalNewTicketList();
        $limit = $this->ticket_system_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->ticket_system_model->getTotalFilteredTotalNewTicketList($table1, $table2, $where);
        $res_data = $this->ticket_system_model->getResultDataNewTicketList($table1, $table2, $where, $order, $limit);

        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {

            $reply_status = 0;
            $date1 = date("Y-m-d", strtotime($res_data[$i][6]));
            $date2 = date("Y-m-d");
            $created_date = date_create($date1);
            $update_date = date_create($date2);

            $diff = date_diff($created_date, $update_date);
            $interv = $diff->format("%r%a");
            if ($interv >= 2) {
                $reply_status = 1;
            }
            if ($reply_status > 0) {
                $res_data[$i][1] = '<span class="blink_me" style=" float:left;height: 25px;width: 25px; background-color: red; border-radius: 50%; display: inline-block;"></span>&nbsp;<span class="badge badge-danger">' . $res_data[$i][1] . '</span>';
            }
            $res_data[$i][7] = '<a href="javascript:activateTicket(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:deleteTicket(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            $res_data[$i][2] = '<a style="color:green" href="admin/manage-ticket/' . $res_data[$i][0] . '">' . $res_data[$i][2] . '</a> ';

            if ($res_data[$i][8] == 1) {

                $res_data[$i][1] = '<span class="badge badge-danger">' . $res_data[$i][1] . '</span>';
            } else {
                $res_data[$i][1] = '<span >' . $res_data[$i][1] . '</span>';
            }



            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function open_ticket_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'ticket';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';
        $column = $this->ticket_system_model->getTableColumnOpenTicketList();
        $total_records = $this->ticket_system_model->countOfTotalOpenTicketList();
        $limit = $this->ticket_system_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->ticket_system_model->getTotalFilteredTotalOpenTicketList($table1, $table2, $where);
        $res_data = $this->ticket_system_model->getResultDataOpenTicketList($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $reply_status = 0;
            $reopen_status = $res_data[$i][10];

            $date1 = date("Y-m-d", strtotime($res_data[$i][6]));
            $date2 = date("Y-m-d");
            $created_date = date_create($date1);
            $update_date = date_create($date2);

            $diff = date_diff($created_date, $update_date);
            $interv = $diff->format("%r%a");
            if ($interv >= 2) {
                $reply_status = 1;
            }

            if ($reply_status > 0) {
                $res_data[$i][1] = '<span class="blink_me" style=" float:left;height: 25px;width: 25px; background-color: red; border-radius: 50%; display: inline-block;"></span>&nbsp;<span>' . $res_data[$i][1] . '</span>';
            }
            $res_data[$i][2] = '<a style="color:#b7950b" href="admin/manage-ticket/' . $res_data[$i][0] . '">' . $res_data[$i][2] . '</a> ';

            if ($res_data[$i][8] == 1) {

                $res_data[$i][1] = '<span class="badge badge-danger">' . $res_data[$i][1] . '</span>';
            } else {
                $res_data[$i][1] = '<span >' . $res_data[$i][1] . '</span>';
            }
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function processing_ticket_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'ticket';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';
        $column = $this->ticket_system_model->getTableColumnProcessingTicketList();
        $total_records = $this->ticket_system_model->countOfTotalProcessingTicketList();
        $limit = $this->ticket_system_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->ticket_system_model->getTotalFilteredTotalProcessingTicketList($table1, $table2, $where);
        $res_data = $this->ticket_system_model->getResultDataProcessingTicketList($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $reply_status = 0;


            $date1 = date("Y-m-d", strtotime($res_data[$i][6]));
            $date2 = date("Y-m-d");
            $created_date = date_create($date1);
            $update_date = date_create($date2);
            $diff = date_diff($created_date, $update_date);
            $interv = $diff->format("%r%a");
            if ($interv >= 2) {
                $reply_status = 1;
            }

            if ($reply_status > 0) {
                $res_data[$i][1] = '<span class="blink_me" style=" float:left;height: 25px;width: 25px; background-color: red; border-radius: 50%; display: inline-block;"></span>&nbsp;<span>' . $res_data[$i][1] . '</span>';
            }
            $res_data[$i][2] = '<a style="color:#a04000" href="admin/manage-ticket/' . $res_data[$i][0] . '">' . $res_data[$i][2] . '</a> ';
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function completed_ticket_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'ticket';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';
        $column = $this->ticket_system_model->getTableColumnCompletedTicketList();
        $total_records = $this->ticket_system_model->countOfTotalCompletedTicketList();
        $limit = $this->ticket_system_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->ticket_system_model->getTotalFilteredTotalCompletedTicketList($table1, $table2, $where);
        $res_data = $this->ticket_system_model->getResultDataCompletedTicketList($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
//            $res_data[$i][2] = "<a href='manage-ticket/'.$res_data[$i][0]' style='color:   #f60000   '>"" . $res_data[$i][2] . '</a>';

            $res_data[$i][2] = '<a style="color:#f60000" href="admin/manage-ticket/' . $res_data[$i][0] . '">' . $res_data[$i][2] . '</a> ';

            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function view_attached_files($ticket_id = '') {
        $attached_file = '';
        if ($ticket_id != "" && $this->ticket_system_model->checkTicketExist($ticket_id) > 0) {
            $attached_file = $this->ticket_system_model->getAttachedFile($ticket_id);
        } else {
            $this->loadPage('invalid ticket id', 'tickets', 'danger');
        }

        $this->setData('attached_files', $attached_file);

        $this->setData('title', lang('menu_name_193'));
        $this->loadView();
    }

}
