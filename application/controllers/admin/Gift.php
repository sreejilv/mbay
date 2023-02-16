<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Base_Controller.php';

class Gift extends Base_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     *  @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @param type $action
     * @param type $req_id
     */
    function gift_requests($action = '', $req_id = '') {
        $logged_user = $this->aauth->getId($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $gift_amount = $this->dbvars->GIFT_AMOUNT_SETTINGS;
        $fixed_amount = $this->dbvars->GIFT_AMOUNT;

        if ($this->input->post('gift') && $this->validate_gift()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $user_id = $this->helper_model->userNameToID($post['username']);
            if ($gift_amount == 'fixed') {
                $amount = $fixed_amount;
            } else {
                $currency_ratio = 1;
                if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
                    $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
                }
                $amount = $post['amount'] / $currency_ratio;
            }
            $status = 1;
            $res = $this->gift_model->createGift($user_id, $amount, $status);
            if ($res) {
                $this->helper_model->insertActivity($logged_user, 'gift_requested', $post);
                $this->loadPage(lang('gift_request_created'), 'gift/gift_requests');
            } else {
                $this->loadPage(lang('failed_to_create_gift_request'), 'gift/gift_requests', 'danger');
            }
        }
        if ($action && $req_id) {
            $data['user'] = $logged_user;
            $data['action'] = $action;
            $data['req_id'] = $req_id;
            if ($action == 'activate') {
                $status = 1;
                $res = $this->gift_model->activateGiftRequest($req_id, $status);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'gift_req_activated', $data);
                    $this->loadPage(lang('gift_request_activated'), 'gift/gift_requests');
                } else {
                    $this->loadPage(lang('failed_to_activate_gift_request'), 'gift/gift_requests', 'danger');
                }
            }if ($action == 'inactivate') {
                $status = 0;
                $res = $this->gift_model->activateGiftRequest($req_id, $status);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'gift_req_inactivate', $data);
                    $this->loadPage(lang('gift_request_inactivated'), 'gift/gift_requests');
                } else {
                    $this->loadPage(lang('failed_to_inactivate_gift_request'), 'gift/gift_requests', 'danger');
                }
            } elseif ($action == 'delete') {
                $res = $this->gift_model->deleteGiftRequest($req_id);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'gift_req_deleted', $data);
                    $this->loadPage(lang('gift_request_deleted'), 'gift/gift_requests');
                } else {
                    $this->loadPage(lang('failed_to_deleted_gift_request'), 'gift/gift_requests', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_action'), 'gift/gift_requests', 'danger');
            }
        }
        //$gifts = array();//$this->gift_model->getAllGiftRequests();

        $this->setData('pending_gifts', $this->gift_model->countOfPendingGift());
        $this->setData('active_gifts', $this->gift_model->countOfActiveGift());
        $this->setData('inactive_gifts', $this->gift_model->countOfInActiveGift());
        $this->setData('completed_gifts', $this->gift_model->countOfCompleteGift());

        $this->setData('gift_amount_type', $gift_amount);
        $this->setData('fixed_amount', $fixed_amount);
        $this->setData('gift_error', $this->form_validation->error_array());

        $this->setData('title', lang('menu_name_93'));
        $this->loadView();
    }

    /**
     *  @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @return type
     */
    function validate_gift() {
        $this->form_validation->set_rules('username', lang('username'), 'required|callback_validate_user|trim');
        $this->form_validation->set_rules('amount', lang('amount'), 'required|numeric|greater_than[0]');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @param type $username
     * @return boolean
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
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @param type $req_id
     */
    function help_requests($req_id) {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if (!$this->gift_model->validateRequestId($req_id, $logged_user)) {
            $this->loadPage(lang('invalid_request'), 'gift/gift_requests', 'danger');
        }
        $request = $this->gift_model->getRequestDetails($req_id);
        $user_balance = $this->helper_model->getUserBalance($logged_user);

        if ($this->input->post('gift_help') && $this->validate_help()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            if ($user_balance >= $request['gift_amount']) {
                $debit = $this->helper_model->insertWalletDetails($logged_user, 'debit', $request['gift_amount'], 'gift_send', $request['mlm_user_id'], 0, $request);
                $credit = $this->helper_model->insertWalletDetails($request['mlm_user_id'], 'credit', $request['gift_amount'], 'gift_recieved', $logged_user, 0, $request);
                if ($debit && $credit) {
                    $res = $this->gift_model->updateHelpRequest($req_id, $logged_user);
                    if ($res) {
                        $this->loadPage(lang('gift_send_successfully'), 'gift/gift_requests');
                    } else {
                        $msg = lang('gift_send_failed');
                    }
                } else {
                    $msg = lang('failed_to_help');
                }
            } else {
                $msg = lang('insuff_bal');
            }
            $this->loadPage($msg, 'help-gift-request/' . $req_id, 'danger');
        }
        $this->setData('gift_error', $this->form_validation->error_array());
        $this->setData('user_balance', $user_balance);
        $this->setData('request', $request);
        $this->setData('req_id', $req_id);
        $this->setData('title', lang('menu_name_94'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @return type
     */
    function validate_help() {
        $this->form_validation->set_rules('tran_pass', lang('tran_pass'), 'required|callback_validate_tran_pass');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * validate the transaction password
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @param type $tran_pass
     * @return boolean
     */
    function validate_tran_pass($tran_pass = '') {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($tran_pass != '') {
            $flag = false;
            if ($this->helper_model->getTransactionPassword($logged_user) == $tran_pass) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('tran_pass')) {
            if ($this->helper_model->getTransactionPassword($logged_user) == $this->input->get('tran_pass')) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For setting the gift
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     */
    function settings() {
        if ($this->input->post('gift_set') && $this->validate_gift_settings()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $res = $this->gift_model->updateGiftSettings($post);
            if ($res) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'gift_settings_updated', $post);
                $this->loadPage(lang('gift_sett_success'), 'gift/settings');
            } else {
                $this->loadPage(lang('failed_to_update_gift_sett'), 'gift/settings', 'danger');
            }
        }

        $gift_amount = $this->dbvars->GIFT_AMOUNT_SETTINGS;
        $amount = $this->dbvars->GIFT_AMOUNT;
        $this->setData('gift_error', $this->form_validation->error_array());
        $this->setData('amount', $amount);
        $this->setData('gift_amount', $gift_amount);
        $this->setData('title', lang('menu_name_103'));
        $this->loadView();
    }

    /**
     *  @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @return type
     */
    function validate_gift_settings() {
        $this->form_validation->set_rules('gift_amount', lang('gift_amount'), 'required');
        if ($this->input->post('gift_amount') == 'fixed')
            $this->form_validation->set_rules('amount', lang('amount'), 'required');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     */
    function history() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $date1 = $date2 = '';
        if ($this->input->post('gift_search') && $this->validate_gift_search()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $user_id = $this->helper_model->userNameToID($post['username']);
            $date1 = $post['from_date'];
            $date2 = $post['to_date'];
        }
        $this->session->set_userdata('gift_id', $user_id);
        $this->session->set_userdata('gift_from_date', $date1);
        $this->session->set_userdata('gift_to_date', $date2);

//        $gift = $this->gift_model->getGiftDetails($user_id, $date1, $date2);
//        $this->setData('gift', $gift);
        $this->setData('gift_error', $this->form_validation->error_array());
        $this->setData('title', lang('gift_history'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @return type
     */
    function validate_gift_search() {
        $this->form_validation->set_rules('username', lang('username'), 'required|callback_validate_user');
        $this->form_validation->set_rules('from_date', lang('from_date'), 'required');
        $this->form_validation->set_rules('to_date', lang('to_date'), 'required');

        $validation = $this->form_validation->run();
        return $validation;
    }

    /*
     * For Gift Hidtory
     * @author Techffodils Technologies LLP
     * @date 2018-01-06 
     */

    function gift_history() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'gift_requests';
        $user_id = $this->session->userdata('gift_id');
        $from_date = $this->session->userdata('gift_from_date');
        $to_date = $this->session->userdata('gift_to_date');

        $limit = $order = $where = '';
        $column = $this->gift_model->getTableColumnGiftHistory();

        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);


        if ($from_date && $to_date) {
            $total_records = $this->gift_model->countOfTotalGiftHistorySearch($user_id, $from_date, $to_date);
            $record_filtered = $this->gift_model->getTotalFilteredTotalGiftHistorySearch($table1, $table2, $where, $user_id, $from_date, $to_date);
            $res_data = $this->gift_model->getResultDataTotalGiftHistorySearch($table1, $table2, $where, $order, $limit, $user_id, $from_date, $to_date);
        } else {
            $total_records = $this->gift_model->countOfTotalGiftHistory($user_id);
            $record_filtered = $this->gift_model->getTotalFilteredTotalGiftHistory($table1, $table2, $where, $user_id);
            $res_data = $this->gift_model->getResultDataTotalGiftHistory($table1, $table2, $where, $order, $limit, $user_id);
        }
        $count_gift = count($res_data);
        for ($i = 0; $i < $count_gift; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            $res_data[$i][4] = $this->helper_model->IdToUserName($res_data[$i][4]);
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
     * For Listing gift pending
     * @author Techffodils Technologies LLP
     * @date 2018-01-06 
     */

    function gift_pending_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'gift_requests';
        $limit = $order = $where = '';
        $column = $this->gift_model->getTableColumnPendingGift();
        $total_records = $this->gift_model->countOfPendingGift();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->gift_model->getTotalFilteredPendingGift($table1, $table2, $where);
        $res_data = $this->gift_model->getResultDataPendingGift($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            $res_data[$i][4] = $this->gift_model->getTotalGiftAmount($res_data[$i][6], 'send');
            $res_data[$i][5] = $this->gift_model->getTotalGiftAmount($res_data[$i][6], 'recieved');
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][6] = '<a href="javascript:activate_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
     * For Listing active gift
     * @author Techffodils Technologies LLP
     * @date 2018-01-06 
     */

    function gift_active_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'gift_requests';
        $limit = $order = $where = '';
        $column = $this->gift_model->getTableColumnActiveGift();
        $total_records = $this->gift_model->countOfActiveGift();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->gift_model->getTotalFilteredActiveGift($table1, $table2, $where);
        $res_data = $this->gift_model->getResultDataActiveGift($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            $res_data[$i][4] = $this->gift_model->getTotalGiftAmount($res_data[$i][6], 'send');
            $res_data[$i][5] = $this->gift_model->getTotalGiftAmount($res_data[$i][6], 'recieved');
            $res_data[$i][4] = round($res_data[$i][4], 8);
            $res_data[$i][5] = round($res_data[$i][5], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][6] = '<a href="admin/help-gift-request/' . $res_data[$i][0] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('help') . '"><i class="fa fa-share"></i></a>  <a href="javascript:inactivate_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';

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
     * For Listing inactive list
     * @author Techffodils Technologies LLP
     * @date 2018-01-06 
     */

    function gift_inactive_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'gift_requests';
        $limit = $order = $where = '';
        $column = $this->gift_model->getTableColumnInActiveGift();
        $total_records = $this->gift_model->countOfInActiveGift();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->gift_model->getTotalFilteredInActiveGift($table1, $table2, $where);
        $res_data = $this->gift_model->getResultDataInActiveGift($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            $res_data[$i][4] = $this->gift_model->getTotalGiftAmount($res_data[$i][6], 'send');
            $res_data[$i][5] = $this->gift_model->getTotalGiftAmount($res_data[$i][6], 'recieved');
            $res_data[$i][4] = round($res_data[$i][4], 8);
            $res_data[$i][5] = round($res_data[$i][5], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][6] = '  <a href="javascript:activate_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('active') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';

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
     * For Listing complete Gift
     * @author Techffodils Technologies LLP
     * @date 2018-01-06 
     */

    function gift_complete_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'gift_requests';
        $limit = $order = $where = '';
        $column = $this->gift_model->getTableColumnCompleteGift();
        $total_records = $this->gift_model->countOfCompleteGift();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->gift_model->getTotalFilteredCompleteGift($table1, $table2, $where);
        $res_data = $this->gift_model->getResultDataCompleteGift($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            $res_data[$i][4] = $this->helper_model->IdToUserName($res_data[$i][4]);
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

}
