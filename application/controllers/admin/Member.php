<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Member extends Base_Controller {

    /**
     * For Load the view
     * @author Techffodils Technologies LLP
     * @date 2017-12-01
     */
    function account_settings() {
        $tab1 = ' active';
        $tab2 = $tab3 = $tab4 = $tab5 = $tab6 = '';
        if ($this->input->post('search_member')) {
            $user = $this->helper_model->userNameToID($this->input->post('username'));
            if ($user) {
                $this->session->set_userdata('user_account', $user);
            }
        }
        if (empty($this->session->userdata('user_account'))) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->session->set_userdata('user_account', $user_id);
        } else {
            $user_id = $this->session->userdata('user_account');
        }
        $user_status = $this->member_model->getUserRegLogStatus($user_id);

        $flag = true;
        if ($user_id == $this->helper_model->getAdminId()) {
            $flag = false;
        }

        $this->setData('flag', $flag);
        $this->setData('user_status', $user_status);
        $this->setData('username', $this->helper_model->IdToUserName($user_id));
        $this->setData('user_id', $user_id);
        $this->setData('username_edit', $this->dbvars->USERNAME_EDIT);
        $this->setData('email_edit', $this->dbvars->EMAIL_EDIT);
        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('tab4', $tab4);
        $this->setData('tab5', $tab5);
        $this->setData('tab6', $tab6);
        $this->setData('title', lang('menu_name_36'));
        $this->setData('header', lang('menu_name_36'));
        $this->loadView();
    }

    /**
     * For updat the username
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_username() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['username'] && ($post['username'] == $post['confirm_username'])) {
            $username = $post['username'];
            if (!$this->helper_model->userNameToID($username) && !$this->member_model->checkInPending($username)) {
                $user_id = $this->session->userdata('user_account');
                $res = $this->member_model->updateUserName($user_id, $username);
                if ($res) {
                    $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                    $data = array();
                    $data['user_id'] = $user_id;
                    $data['username'] = $username;
                    $this->helper_model->insertActivity($log_user_id, 'change_username_admin', $data);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo 'no';
        exit;
    }

    function change_email() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['email'] && ($post['email'] == $post['con_email'])) {
            $email = $post['email'];
            if (!$this->helper_model->getUserIdFromEmailId($email) && !$this->member_model->checkEmailInPending($email)) {
                $user_id = $this->session->userdata('user_account');
                $res = $this->member_model->updateUserEmail($user_id, $email);
                if ($res) {
                    $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                    $data = array();
                    $data['user_id'] = $user_id;
                    $data['email'] = $email;
                    $this->helper_model->insertActivity($log_user_id, 'change_useremail_admin', $data);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For update the password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_password() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['password'] && ($post['password'] == $post['con_password'])) {
            $password = $post['password'];
            if ($password) {
                $user_id = $this->session->userdata('user_account');
                $res = $this->member_model->updatePassword($user_id, $password);
                if ($res) {
                    $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                    $data = array();
                    $data['user_id'] = $user_id;
                    $data['password'] = $password;
                    $this->helper_model->insertActivity($log_user_id, 'change_password_admin', $data);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_transaction() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        if ($post && $this->validate_transaction_password()) {
            $tran_pass = $post['tran_pass_password'];
            if ($tran_pass) {
                $user_id = $this->session->userdata('user_account');
                $res = $this->member_model->updateTranPassword($user_id, $tran_pass);
                if ($res) {
                    $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                    $data = array();
                    $data['user_id'] = $user_id;
                    $data['tran_pass'] = $tran_pass;
                    $this->helper_model->insertActivity($log_user_id, 'change_transation_password_admin', $data);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function validate_transaction_password() {
        $this->form_validation->set_rules('tran_pass_password', lang('please_enter_new_transation_password_js'), 'trim|required|matches[tran_pass_re_enter_password]');
        $this->form_validation->set_rules('tran_pass_re_enter_password', lang('please_re_enter_transation_password_js'), 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_user_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        $user_id = $this->session->userdata('user_account');
        if ($user_id) {
            $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $res = $this->member_model->updateUserStatus($user_id, $status);
            $this->helper_model->insertActivity($log_user_id, 'acitvate_or_inactivate_admin', $post);
            if ($res) {
                echo "yes";
                exit;
            }
        }
        echo'no';
        exit;
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_user_login_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        $user_id = $this->session->userdata('user_account');
        if ($user_id) {
            $res = $this->member_model->updateBlockStatus($user_id, $status, 'login_block');
            if ($res) {
                $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($log_user_id, 'user_login_unblock_admin', $post);
                echo "yes";
                exit;
            }
        }
        echo "no";
        exit;
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_user_register_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        $user_id = $this->session->userdata('user_account');
        if ($user_id) {
            $res = $this->member_model->updateBlockStatus($user_id, $status, 'registration_block');
            if ($res) {
                $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($log_user_id, 'user_register_block_admin', $post);
                echo "yes";
                exit;
            }
        }
        echo "no";
        exit;
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function send_transaction_pass() {
        $user_id = $this->session->userdata('user_account');
        if ($user_id) {
            $this->load->model('send_mail_model');
            $res = $this->send_mail_model->send($user_id, '', 'transaction_password');
            if ($res) {
                echo"yes";
                exit;
            }
        }
        echo"no";
        exit;
    }

    /*
     * For Fetching the usernames
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */

    function get_usernames() {
        $query = $this->input->get('query');
        $result = $this->member_model->getAllUserNames($query);
        echo $result;
        exit();
    }

    /**
     * For update the password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function update_password() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $user_name = $post['username'];
        $pass_password = $post['pass_password'];
        $pass_re_enter_password = $post['pass_re_enter_password'];
        $user_id = $this->helper_model->userNameToID($user_name);
        if ($user_id) {

            if ($pass_password == $pass_re_enter_password && $pass_password != '' && $pass_re_enter_password != '') {
                $res = $this->member_model->updatePassword($user_id, $pass_password);
                $this->helper_model->insertActivity($user_id, 'change_password_admin');
                if ($res) {
                    echo "yes";
                    exit;
                } else {
                    echo lang('change_password_is_error');
                    exit;
                }
            } else {
                echo lang('password_empty_or_missmatching_pls_try_again');
                exit;
            }
        } else {
            echo lang('username_is_invalid');
            exit;
        }
    }

    /**
     * For updat the username
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function update_username() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $uname_user_name = $post['uname_user_name'];
        $uname_new_username = $post['uname_new_username'];
        $uname_re_entry_username = $post['uname_re_entry_username'];
        $user_id = $this->helper_model->userNameToID($uname_user_name);
        if ($user_id) {

            if ($uname_new_username == $uname_re_entry_username && $uname_new_username != '' && $uname_re_entry_username != '') {
                $exisit = $this->member_model->checkUserNameExisit($uname_new_username);
                if ($exisit) {
                    echo lang('username_is_alredy_exist_sorry');
                    exit;
                }
                $res = $this->member_model->updateUserName($user_id, $uname_new_username);
                $this->helper_model->insertActivity($user_id, 'change_username_admin');
                if ($res) {
                    echo "yes";
                    exit;
                } else {
                    echo lang('change_user_name_is_error');
                    exit;
                }
            } else {
                echo lang('username_empty_or_miss_matching_please_try_again');
                exit;
            }
        } else {
            echo lang('username_is_invalid');
            exit;
        }
    }

    function update_email() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $uname_user_name = $post['uname_user_name'];
        $email_id = $post['email_id'];
        $re_enter_email_id = $post['re_enter_email_id'];
        $user_id = $this->helper_model->userNameToID($uname_user_name);
        if ($user_id) {

            if ($email_id == $re_enter_email_id && $email_id != '' && $re_enter_email_id != '') {
                $exisit = $this->member_model->checkUserEmailExisit($email_id);
                if ($exisit) {
                    echo lang('useremail_is_alredy_exist_sorry');
                    exit;
                }
                $res = $this->member_model->updateUserEmail($user_id, $email_id);
                $this->helper_model->insertActivity($user_id, 'change_useremail_admin');
                if ($res) {
                    echo "yes";
                    exit;
                } else {
                    echo lang('change_user_email_is_error');
                    exit;
                }
            } else {
                echo lang('email_empty_or_miss_matching_please_try_again');
                exit;
            }
        } else {
            echo lang('username_is_invalid');
            exit;
        }
    }

    /**
     * For change the transaction password
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function update_transation() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $tran_user_name = $post['tran_user_name'];
        $tran_pass_password = $post['tran_pass_password'];
        $tran_pass_re_enter_password = $post['tran_pass_re_enter_password'];
        $user_id = $this->helper_model->userNameToID($tran_user_name);
        if ($user_id) {

            if ($tran_pass_password == $tran_pass_re_enter_password && $tran_pass_password != '' && $tran_pass_re_enter_password != '') {
                $this->helper_model->insertActivity($user_id, 'change_transation_password_user');
                $res = $this->member_model->updateTranPassword($user_id, $tran_pass_password);
                if ($res) {
                    echo "yes";
                    exit;
                } else {
                    echo lang('change_transation_password_is_error');
                    exit;
                }
            } else {
                echo lang('empty_r_miss_matching_please_try_again');
                exit;
            }
        } else {
            echo lang('username_is_invalid');
            exit;
        }
    }

    /**
     * For Maintenence status
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function change_maintence_status() {
        $status = $this->input->get('status');
        $time = $this->input->get('time');
        $date = date('Y-m-d H:i:s');
        if ($time == '' || $time <= $date) {
            $time = date('Y-m-d H:i:s', strtotime("+1 days"));
        }
        $res = $this->member_model->changeMaintenceStatus($status);
        if ($status == 'active') {
            $this->member_model->insertMaintenceStatusHistory($status, $time);
        } else {
            $this->member_model->updateMaintenceHistory($status);
            $this->member_model->changeMaintenceStatus($status);
        }

        if ($res) {
            echo"yes";
            exit;
        } else {
            echo"no";
            exit;
        }
    }

    /**
     * For View the Pending registered users details
     * @param type $action
     * @param type $req_id
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function pending_registrations($action = "", $req_id = "") {
        if ($action && $req_id) {
            $activity['action'] = $action;
            $activity['req_id'] = $req_id;
            if ($this->member_model->checkRequestValidity($req_id)) {
                if ($action == 'activate') {
                    $details = $this->member_model->getRequestDetails($req_id);
                    if ($details) {
                        $this->load->model('register_model');
                        $res = $this->register_model->addUser($details['register_type'], $details['user_details'], $details['mlm_plan'], $details['package_id']);
                        if ($res) {
                            $this->member_model->updatePendingRequest($req_id, 'registered');
                            $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'pend_reg_confirmed', $activity);
                            $this->loadPage(lang('user_activated'), 'payment-enrolls');
                        } else {
                            $this->loadPage(lang('failed_to_activate'), 'payment-enrolls', 'danger');
                        }
                    }
                } elseif ($action == 'delete') {
                    $res = $this->member_model->updatePendingRequest($req_id, 'deleted');
                    if ($res) {
                        $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'pend_reg_deleted', $activity);
                        $this->loadPage(lang('request_deleted'), 'payment-enrolls');
                    }
                    $this->loadPage(lang('failed_to_delete_request'), 'payment-enrolls', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_request'), 'payment-enrolls', 'danger');
            }
        }
        $this->setData('title', lang('menu_name_48'));
        $this->loadView();
    }

    /**
     * For List out the pending orders
     * @param type $action
     * @param type $req_id
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    function pending_orders($action = "", $req_id = "") {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($action && $req_id) {
            $data['order_id'] = $req_id;
            if ($this->member_model->validateOrder($req_id)) {
                if ($action == 'activate') {
                    $res = $this->member_model->activateOrder($req_id);
                    if ($res) {

                        $this->helper_model->insertActivity($user_id, 'pend_order_activated', $data);
                        $this->loadPage(lang('order_confirmed'), 'payment-orders');
                    }

                    $this->loadPage(lang('failed_to_activate'), 'payment-orders', 'danger');
                } elseif ($action == 'delete') {
                    $res = $this->member_model->deleteOrder($req_id);
                    if ($res) {
                        $this->helper_model->insertActivity($user_id, 'pend_order_deleted', $data);
                        $this->loadPage(lang('request_deleted'), 'payment-orders');
                    }
                    $this->loadPage(lang('failed_to_delete_request'), 'payment-orders', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_request'), 'payment-orders', 'danger');
            }
        }

        $this->setData('title', lang('menu_name_49'));
        $this->loadView();
    }

    function showButton() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $act_user_name = $post['act_user_name'];
        $user_id = $this->helper_model->userNameToID($act_user_name);
        if ($user_id) {
            $user_status = $this->member_model->getUserStatus($user_id);
            echo $user_status;
            exit;
        } else {
            echo' ';
            exit;
        }
    }

    function LogButton() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $act_user_name = $post['act_user_name'];
        $user_id = $this->helper_model->userNameToID($act_user_name);
        if ($user_id) {
            $user_status = $this->member_model->getLogUserStatus($user_id);
            echo $user_status;
            exit;
        } else {
            echo' ';
            exit;
        }
    }

    function RegButton() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $act_user_name = $post['act_user_name'];
        $user_id = $this->helper_model->userNameToID($act_user_name);
        if ($user_id) {
            $user_status = $this->member_model->getregUserStatus($user_id);
            echo $user_status;
            exit;
        } else {
            echo' ';
            exit;
        }
    }

    function ActivateInactivateUser() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $user_name = $post['username'];
        $status = $post['status'];
        $user_id = $this->helper_model->userNameToID($user_name);
        if ($user_id) {
            $res = $this->member_model->updateUserStatus($user_id, $status);
            $this->helper_model->insertActivity($user_id, 'acitvate_or_inactivate_admin', $post);
            if ($res) {
                echo "yes";
                exit;
            } else {
                echo "no";
                exit;
            }
        } else {
            echo'no';
            exit;
        }
    }

    function login_block() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        $username = $post['username'];
        $user_id = $this->helper_model->userNameToID($username);
        if ($user_id) {
            $res = $this->member_model->updateBlockStatus($user_id, $status, 'login_block');
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'user_login_unblock_admin', $post);
                echo "yes";
                exit;
            }
        }
        echo "no";
        exit;
    }

    function block_register() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        $username = $post['username'];
        $user_id = $this->helper_model->userNameToID($username);
        if ($user_id) {
            $res = $this->member_model->updateBlockStatus($user_id, $status, 'registration_block');
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'user_register_block_admin', $post);
                echo "yes";
                exit;
            }
        }
        echo "no";
        exit;
    }

    function forget_tran_pass() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($user_id) {
            $this->load->model('send_mail_model');
            $res = $this->send_mail_model->send($user_id, '', 'transaction_password');
            if ($res) {
                echo"yes";
                exit;
            }
        }
        echo"no";
        exit;
    }

    function pending_ord_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'orders';
        $limit = $order = $where = '';
        $column = $this->member_model->getTableColumnPendingOrder();
        $total_records = $this->member_model->countOfPendingOrder();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->member_model->getTotalFilteredPendingOrder($table1, $table2, $where);
        $res_data = $this->member_model->getResultDataPendingOrder($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $this->member_model->getAllProductDetails($res_data[$i][0]);
            $res_data[$i][3] = lang($res_data[$i][3]);
            $res_data[$i][5] = '<a href="javascript:activate_order(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_order(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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

    function pending_reg_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'pending_registrations';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'user_name',
            'email',
            'reg_amount',
            'payment_method',
            'date',
            'status'
        );
        $column = $this->member_model->getTableColumnPendingReg();
        $total_records = $this->member_model->countOfPendingReg();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->member_model->getTotalFilteredPendingReg($table, $where);
        $res_data = $this->member_model->getResultDataPendingReg($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][3] = round($res_data[$i][3], 8);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][4] = lang($res_data[$i][4]);
            $res_data[$i][6] = '<a href="javascript:activate_user(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_user(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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

    function position_settings() {
        if ($this->input->post('change_position') && $this->validate_change_position()) {

            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $message = $this->helper_model->checkUserActivity($this->helper_model->userNameToID($post_data['username']));
            if ($message['status'] == 'true') {
                $this->base_model->transactionStart();
                $result = $this->member_model->performPositionChange($post_data);
                if ($result) {
                    $this->helper_model->insertActivity($this->aauth->getId(), 'user_position_change', $post_data);
                    $this->base_model->transationCommit();
                    $this->loadPage(lang('successfully_changed_position'), 'position-management');
                } else {
                    $this->base_model->transationRollback();
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'user_position_change', $post_data);
                    $this->loadPage(lang('something_went_wrong'), 'position-management', 'danger');
                }
            } else {
                $this->helper_model->insertFailedActivity($this->aauth->getId(), 'user_position_change', $post_data);
                $this->loadPage($message['msg'], 'position-management', 'danger');
            }
        }

        if ($this->input->post('remove_position') && $this->validate_remove_position()) {
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $message = $this->helper_model->checkUserActivity($this->helper_model->userNameToID($post_data['del_username']));
            if ($message['status'] == 'true') {
                $this->base_model->transactionStart();
                $result = $this->member_model->performRemoveUser($post_data);
                if ($result) {
                    $this->helper_model->insertActivity($this->aauth->getId(), 'user_position_delete', $post_data);
                    $this->base_model->transationCommit();
                    $this->loadPage(lang('successfully_deleted_user'), 'position-management');
                } else {
                    $this->base_model->transationRollback();
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'user_position_delete', $post_data);
                    $this->loadPage(lang('something_went_wrong'), 'position-management', 'danger');
                }
            } else {
                $this->helper_model->insertFailedActivity($this->aauth->getId(), 'user_position_delete', $post_data);
                $this->loadPage($message['msg'], 'position-management', 'danger');
            }
        }

        $this->setData('pos_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_147'));
        $this->loadView();
    }

    function validate_change_position() {
        $this->form_validation->set_rules('username', lang('username'), 'required|callback_validate_user|trim');
        $this->form_validation->set_rules('new_position', lang('new_position'), 'required|callback_validate_user|trim');
        if ($this->dbvars->MLM_PLAN == 'BINARY' || $this->dbvars->MLM_PLAN == 'binary')
            $this->form_validation->set_rules('position_leg', lang('position_leg'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function validate_remove_position() {
        $this->form_validation->set_rules('del_username', lang('username'), 'required|callback_validate_user|trim');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function validate_user($username = '') {
        if ($username != '') {
            $flag = false;
            if ($this->helper_model->userNameToID($username)) {
                $flag = TRUE;
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

    function recently_used_devices() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->load->model('cron_job_model');
        $this->cron_job_model->updateLocation();

        $rec_devices = $this->member_model->getRecentDevices($user_id);

        $this->setData('rec_devices', $rec_devices);
        $this->setData('title', lang('menu_name_160'));
        $this->loadView();
    }

    function order_history() {
        $order_data = $this->member_model->getAllOrdersData();
        $order_status_list = $this->member_model->getOrderStatusList();
         // print_r($order_data);die;
        $this->setData('order_status_list', $order_status_list);
        $this->setData('order_data', $order_data);
        $this->setData('title', lang('menu_name_178'));
        $this->loadView();
    }

    function order_history_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'orders';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $column = $this->member_model->getTableColumnReortOrders();
        $total_records = $this->member_model->countRportOrders($table1, $table2);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->member_model->getTotalFilteredReportOrders($table1, $table2, $where);
        $res_data = $this->member_model->getResultDataReportOrders($table1, $table2, $where, $order, $limit);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][4] = $this->member_model->getAllProductDetails($res_data[$i][0]);
            $res_data[$i][2] = '<a href="admin/order-invoice/' . $res_data[$i][0] . '" target="_BLANK" title="' . lang('view_invoice') . '">#' . ($res_data[$i][0] + 1000) . '</a>';
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

    /*
     * For Fetching the usernames
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */

    function get_affiliatee_usernames() {
        $query = $this->input->post('query');
        $result = $this->member_model->getAllAffiliateUserNames($query);
        echo $result;
        exit();
    }

    function validate_affiliate_name() {
        if ($this->input->get('username')) {
            if ($this->helper_model->userNameToAffID($this->input->get('username'), 1)) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    function get_employee_usernames() {
        $query = $this->input->post('query');
        $result = $this->member_model->getAllEmployeeUserNames($query);
        echo $result;
        exit();
    }

    function validate_employee_name() {
        if ($this->input->get('username')) {
            if ($this->helper_model->userNameToEmpID($this->input->get('username'), 1)) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    function order_return_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'return';
        $table2 = DB_PREFIX_SYSTEM . 'products';
        $table3 = DB_PREFIX_SYSTEM . 'user';
        $table4 = DB_PREFIX_SYSTEM . 'order_products';
        $limit = $order = $where = '';

        $column = $this->member_model->getTableColumnOrderReturn();
        $total_records = $this->member_model->countOrderReturn($table1, $table2, $table3, $table4);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->member_model->getTotalFilteredOrderReturn($table1, $table2, $table3, $table4, $where);
        $res_data = $this->member_model->getResultDataOrderReturn($table1, $table2, $table3, $table4, $where, $order, $limit);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][1] = $res_data[$i][7];

            $pro_status = $res_data[$i][6];
            $res_data[$i][6] = '<select class="form-control" id="ret_status_' . $res_data[$i][0] . '" name="ret_status_' . $res_data[$i][0] . '" onchange="changeReturnStatus(' . $res_data[$i][0] . ')">';

            $res_data[$i][6] .= '<option value="pending"';
            if ($pro_status == 'pending') {
                $res_data[$i][6] .= ' selected';
            }
            $res_data[$i][6] .= ' >' . lang("pending") . '</option>';


            $res_data[$i][6] .= '<option value="processing"';
            if ($pro_status == 'processing') {
                $res_data[$i][6] .= ' selected';
            }
            $res_data[$i][6] .= ' >' . lang("processing") . '</option>';


            $res_data[$i][6] .= '<option value="canceled"';
            if ($pro_status == 'canceled') {
                $res_data[$i][6] .= ' selected';
            }
            $res_data[$i][6] .= ' >' . lang("canceled") . '</option>';

            $res_data[$i][6] .= '<option value="pro_replaced"';
            if ($pro_status == 'pro_replaced') {
                $res_data[$i][6] .= ' selected';
            }
            $res_data[$i][6] .= ' >' . lang("pro_replaced") . '</option>';

            $res_data[$i][6] .= '</select>';


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

    function product_return() {
        $this->setData('title', lang('menu_name_182'));
        $this->loadView();
    }

    function change_return_status() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        if ($get['ret_id'] && $get['status']) {
            $res = $this->member_model->updateReturnStatus($get['ret_id'], $get['status']);
            if ($res) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    function invoice($ord_id) {
        $invoice_details = $this->member_model->getInvoiceDetails($ord_id);
        if (!$invoice_details) {
            $this->loadPage(lang('invalid_link'), 'order-history', 'warning');
        }
        $this->setData('invoice_details', $invoice_details);
        $this->setData('title', lang('menu_name_183'));
        $this->loadView();
    }

    function payment_details($id = '') {
        if ($id) {
//            $paypal = $this->member_model->getStatusPayment('paypal');
//            $bank = $this->member_model->getStatusPayment('bank_transfer');
//            $coinpayments = $this->member_model->getStatusPayment('coinpayments');
//            if ($coinpayments && $coinpayments['status'] == "active") {
//                $payout_type = 'coinpayments';
//            } elseif ($paypal && $paypal['status'] == "active") {
//                $payout_type = 'paypal';
//            } else {
//                $payout_type = 'bank';
//            }
            $payout_type = $this->dbvars->PAYOUT_METHOD;
            $config_details = $this->member_model->getPaymentConfig(0, $id);
            $this->setData('username', $this->helper_model->IdToUserName($config_details['user_id']));
            $this->setData('config_details', $config_details);
            $this->setData('payout_type', $payout_type);
            $this->session->set_userdata('payment_user_id', $config_details['user_id']);
        }

        $this->setData('title', lang('menu_name_189'));
        $this->loadView();
    }

    function payment_details_list() {
        $this->load->model('wallet_model');
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user_payment_config';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $column = $this->member_model->getTableColumnPaymentDetails();
        $total_records = $this->member_model->countPaymentDetails($table1, $table2);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->member_model->getTotalFilteredPaymentDetails($table1, $table2, $where);
        $res_data = $this->member_model->getResultDataPaymentDetails($table1, $table2, $where, $order, $limit);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][4] = $this->wallet_model->getUserAccountSettings($res_data[$i][0]);
            $res_data[$i][5] = '<a href="javascript:edit_prod(' . $res_data[$i][7] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a>';
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

    function change_username_edit_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        if ($status >= 0) {
            $this->dbvars->USERNAME_EDIT = $status;
            echo "yes";
            exit;
        }
        echo'no';
        exit;
    }

    function change_email_edit_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $status = $post['status'];
        if ($status >= 0) {
            $this->dbvars->EMAIL_EDIT = $status;
            echo "yes";
            exit;
        }
        echo'no';
        exit;
    }

    function default_images() {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('update_dp')) {
            $flag = 0;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $config['upload_path'] = FCPATH . 'assets/images/users/';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $new_name = 'dp0_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_0')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp0 = $data_upload['file_name'];
                $flag = 1;
            }
            $new_name = 'dp1_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_1')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp1 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'dp2_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_2')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp2 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'dp3_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_3')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp3 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'dp4_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_4')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp4 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'dp5_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_5')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp5 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'dp6_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_6')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp6 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'dp7_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_dp_7')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Dp7 = $data_upload['file_name'];
                $flag = 1;
            }

            if ($flag) {
                $this->helper_model->insertActivity($loged_user_id, 'defualt_dp_updated');
                $this->loadPage(lang('defualt_dp_updated'), 'default-images');
            } else {
                $this->loadPage(lang('defualt_dp_updation_failed'), 'default-images', 'danger');
            }
        }


        if ($this->input->post('update_cover')) {
            $flag = 0;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $config['upload_path'] = FCPATH . 'assets/images/users/';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $new_name = 'cover0_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_cover_0')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Cover0 = $data_upload['file_name'];
                $flag = 1;
            }
            $new_name = 'cover1_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_cover_1')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Cover1 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'cover2_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_cover_2')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Cover2 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'cover3_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_cover_3')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Cover3 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'cover4_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_cover_4')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Cover4 = $data_upload['file_name'];
                $flag = 1;
            }

            $new_name = 'cover5_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('def_cover_5')) {
                $data_upload = $this->upload->data();
                $this->dbvars->Cover5 = $data_upload['file_name'];
                $flag = 1;
            }

            if ($flag) {
                $this->helper_model->insertActivity($loged_user_id, 'defualt_cover_updated');
                $this->loadPage(lang('defualt_cover_updated'), 'default-images');
            } else {
                $this->loadPage(lang('defualt_cover_updation_failed'), 'default-images', 'danger');
            }
        }


        $def_cov = array($this->dbvars->Cover0, $this->dbvars->Cover1, $this->dbvars->Cover2, $this->dbvars->Cover3, $this->dbvars->Cover4, $this->dbvars->Cover5);

        $def_dp = array($this->dbvars->Dp0, $this->dbvars->Dp1, $this->dbvars->Dp2, $this->dbvars->Dp3, $this->dbvars->Dp4, $this->dbvars->Dp5, $this->dbvars->Dp6, $this->dbvars->Dp7);

        $this->setData('def_dp', $def_dp);
        $this->setData('def_cov', $def_cov);
        $this->setData('title', lang('menu_name_190'));
        $this->loadView();
    }

    public function blocktrail_payment_config() {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($user_id = $this->session->userdata('payment_user_id')) {
            $data = $this->security->xss_clean($this->input->get());
            $data['user_id'] = $user_id;
            $wallet_address = $data['wallet_address'];
            if ($wallet_address && $user_id) {
                if ($this->member_model->updateBlocktrailAccountConfig($user_id, $wallet_address)) {
                    $this->helper_model->insertActivity($loged_user_id, 'update_btc_info', $data);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo lang('something_went_wrong');
        exit;
    }

    public function paypal_payment_config($operation_flag = 0) {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($user_id = $this->session->userdata('payment_user_id')) {
            $data = $this->security->xss_clean($this->input->get());
            $data['user_id'] = $user_id;
            $paypal_email = $data['paypal_email'];
            if ($paypal_email && $user_id) {
                if ($this->member_model->updatePaypalAccountConfig($user_id, $paypal_email)) {
                    $this->helper_model->insertActivity($user_id, 'update_paypal_info', $data);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo lang('something_went_wrong');
        exit;
    }

    public function bank_payment_config($operation_flag = 0) {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($user_id = $this->session->userdata('payment_user_id')) {
            $data = $this->security->xss_clean($this->input->get());
            $data['user_id'] = $user_id;
            if ($this->member_model->updateBankAccountConfig($user_id, $data)) {
                $this->helper_model->insertActivity($user_id, 'update_bank_info', $data);
                echo 'yes';
                exit;
            }
        }
        echo lang('something_went_wrong');
        exit;
    }

    public function user_login() {
        $user_type = $this->aauth->getUserType();
        $log_user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('login_member') && $this->user_login_val()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $user_name = $post['username'];
            $user_id = $this->helper_model->userNameToID($user_name);

            if ($this->aauth->login_fast($user_id)) {
                $this->member_model->insertUserLoginHistory($user_id);
                $this->helper_model->insertActivity($user_id, 'user_login');
                $this->helper_model->insertActivity($log_user_id, 'user_login');
                $this->loadPage('', 'dashboard');
            }
        }
        $this->setData('title', lang('user_login'));
        $this->loadView();
    }

    function user_login_val() {
        $this->form_validation->set_rules('username', lang('user_name'), 'required|callback_validate_user');
        $validate_form = $this->form_validation->run();
        return $validate_form;
    }

    function user_login_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user_logins';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $column = $this->member_model->getTableColumnUserLoginDetails();
        $total_records = $this->member_model->countUserLoginDetails($table1, $table2);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->member_model->getTotalFilteredUserLoginDetails($table1, $table2, $where);
        $res_data = $this->member_model->getResultUserLoginDetails($table1, $table2, $where, $order, $limit);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
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

    public function update_order_status() {
        $request = $this->input->get();
        // dd($request);
        $this->db->where('id', $request['order_id']);
        $this->db->update('orders', array('order_status' => $request['order_status']));
        
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
             echo 'yes';
              exit;
        }
        echo 'no';
         exit;
    }


    function invoice_details($ord_id) {
        $invoice_details = $this->member_model->getInvoiceDetails($ord_id);
        // print_r($invoice_details);die;
        if (!$invoice_details) {
            $this->loadPage(lang('invalid_link'), 'order-history', 'warning');
        }
        $this->setData('invoice_details', $invoice_details);
        $this->setData('title', lang('menu_name_202'));
        $this->loadView();
    }

       
}
