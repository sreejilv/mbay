<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * Controller used for the wallet related functions
 * Like fund transfer,payout request,release etc..
 * @author Techffodils Technologies LLP
 * @date 2017-12-28
 */
class Wallet extends Base_Controller {

    /**
     * For fund transfer details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     *
     */
    function fund_transfer() {
        $currency_ratio = 1;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
        }
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $tab1 = ' active';
        $tab2 = $tab3 = '';
        if ($this->input->post('add_button') && $this->validate_add_fund()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post['username_add']);
            $post['amount_add_multi_crncy'] = $post['amount_add'];
            $amount = $post['amount_add'] / $currency_ratio;
            $wallet_type = 'credited_by_admin';
            $this->base_model->transactionStart();
            $res = $this->wallet_model->addFundTransfer(0, $user_id, $amount, $wallet_type, $post['credit_reason']);
            if ($res && $this->base_model->transationCheck()) {
                $this->helper_model->insertWalletDetails($user_id, 'credit', $amount, $wallet_type);
                $this->helper_model->insertActivity($logged_user, 'add_fund_to_user', $post);
                $this->base_model->transationCommit();
                $this->loadPage(lang('fund_added_successfully'), 'transfer-funds');
            } else {
                $this->base_model->transationRollback();
                $failed_data = array('user_id' => $user_id, 'amount' => $amount, 'wallet_type' => $wallet_type, 'credit_reason' => $post['credit_reason']);
                $this->helper_model->insertFailedActivity($this->aauth->getId(), 'fund_credit_failed', $failed_data);
                $this->loadPage(lang('fund_add_failed'), 'transfer-funds', 'danger');
            }
        }

        if ($this->input->post('ded_button') && $this->validate_ded_fund()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post['username_ded']);
            $post['amount_ded_multi_crncy'] = $post['amount_ded'];
            $amount = $post['amount_ded'] / $currency_ratio;
            $wallet_type = 'debited_by_admin';
            if ($amount <= $this->helper_model->getUserBalance($user_id)) {
                $this->base_model->transactionStart();
                $res = $this->wallet_model->addFundTransfer($user_id, 0, $amount, $wallet_type, $post['debit_reason']);
                if ($res && $this->base_model->transationCheck()) {
                    $this->helper_model->insertWalletDetails($user_id, 'debit', $amount, $wallet_type);
                    $this->helper_model->insertActivity($logged_user, 'deduct_fund_from_user', $post);
                    $this->base_model->transationCommit();
                    $this->loadPage(lang('fund_deducted_successfully'), 'transfer-funds');
                } else {
                    $this->base_model->transationRollback();
                    $failed_data = array('user_id' => $user_id, 'amount' => $amount, 'wallet_type' => $wallet_type, 'debit_reason' => $post['debit_reason']);
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'fund_debit_failed', $failed_data);
                    $this->loadPage(lang('fund_deducted_failed'), 'transfer-funds', 'danger');
                }
            } else {
                $this->loadPage(lang('insufficient_balance'), 'transfer-funds', 'danger');
            }
        }

        if ($this->input->post('trans_button') && $this->validate_transfer()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $from_user = $this->helper_model->userNameToID($post['from_username']);
            $post['amount_trans_multi_crncy'] = $post['amount_trans'];
            $amount = $post['amount_trans'] / $currency_ratio;
            $wallet_type = 'transfer_by_admin';
            if ($amount <= $this->helper_model->getUserBalance($from_user)) {
                $to_user = $this->helper_model->userNameToID($post['to_username']);
                $this->base_model->transactionStart();
                $res = $this->wallet_model->addFundTransfer($from_user, $to_user, $amount, $wallet_type, $post['transfer_reason']);
                if ($res && $this->base_model->transationCheck()) {
                    $this->helper_model->insertWalletDetails($from_user, 'debit', $amount, $wallet_type, $to_user);
                    $this->helper_model->insertWalletDetails($to_user, 'credit', $amount, $wallet_type, $from_user);
                    $this->helper_model->insertActivity($logged_user, 'deduct_fund_from_user', $post);
                    $this->base_model->transationCommit();
                    $this->loadPage(lang('fund_transfered_successfully'), 'transfer-funds');
                } else {
                    $this->base_model->transationRollback();
                    $failed_data = array('from_user' => $from_user, 'to_user' => $to_user, 'amount' => $amount, 'wallet_type' => $wallet_type, 'transfer_reason' => $post['transfer_reason']);
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'fund_debit_failed', $failed_data);
                    $this->loadPage(lang('fund_transfered_failed'), 'transfer-funds', 'danger');
                }
            } else {
                $this->loadPage(lang('insufficient_balance'), 'transfer-funds', 'danger');
            }
        }

        $active_tab = '';
        if ($this->session->userdata('active_fund_tab') != null) {
            $tab1 = $tab2 = $tab3 = '';
            $active_tab = $this->session->userdata('active_fund_tab');
        }

        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('count1', $this->wallet_model->countOfTotalAddFund('wal-1', 'credited_by_admin'));
        $this->setData('count2', $this->wallet_model->countOfTotalDedFund('wal-1', 'debited_by_admin'));
        $this->setData('count3', $this->wallet_model->countOfTotalTransfer('transfer_by_admin','wal-1'));
        $this->setData($active_tab, ' active');
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_18'));
        $this->loadView();
    }

    function transfer_points() {
        $currency_ratio = 1;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
        }
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $tab1 = ' active';
        $tab2 = $tab3 = '';
        if ($this->input->post('add_button') && $this->validate_add_fund()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post['username_add']);
            $post['amount_add_multi_crncy'] = $post['amount_add'];
            $amount = $post['amount_add'] / $currency_ratio;
            $wallet_type = 'credited_by_admin';
            $this->base_model->transactionStart();
            $res = $this->wallet_model->addFundTransfer(0, $user_id, $amount, $wallet_type, $post['credit_reason'], 'wal-2');
            if ($res && $this->base_model->transationCheck()) {
                $this->helper_model->insertWalletDetails($user_id, 'credit', $amount, $wallet_type, '', '', '', '', '', 1);
                $this->helper_model->insertActivity($logged_user, 'add_fund_to_user', $post);
                $this->base_model->transationCommit();
                $this->loadPage(lang('fund_added_successfully'), 'transfer-wallet');
            } else {
                $this->base_model->transationRollback();
                $failed_data = array('user_id' => $user_id, 'amount' => $amount, 'wallet_type' => $wallet_type, 'credit_reason' => $post['credit_reason']);
                $this->helper_model->insertFailedActivity($this->aauth->getId(), 'fund_credit_failed2', $failed_data);
                $this->loadPage(lang('fund_add_failed'), 'transfer-wallet', 'danger');
            }
        }

        if ($this->input->post('ded_button') && $this->validate_ded_fund()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post['username_ded']);
            $post['amount_ded_multi_crncy'] = $post['amount_ded'];
            $amount = $post['amount_ded'] / $currency_ratio;
            $wallet_type = 'debited_by_admin';
            if ($amount <= $this->helper_model->getUserPoint($user_id)) {
                $this->base_model->transactionStart();
                $res = $this->wallet_model->addFundTransfer($user_id, 0, $amount, $wallet_type, $post['debit_reason'], 'wal-2');
                if ($res && $this->base_model->transationCheck()) {
                    $this->helper_model->insertWalletDetails($user_id, 'debit', $amount, $wallet_type, '', '', '', '', '', 1);
                    $this->helper_model->insertActivity($logged_user, 'deduct_fund_from_user', $post);
                    $this->base_model->transationCommit();
                    $this->loadPage(lang('fund_deducted_successfully'), 'transfer-wallet');
                } else {
                    $this->base_model->transationRollback();
                    $failed_data = array('user_id' => $user_id, 'amount' => $amount, 'wallet_type' => $wallet_type, 'debit_reason' => $post['debit_reason']);
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'fund_debit_failed2', $failed_data);
                    $this->loadPage(lang('fund_deducted_failed'), 'transfer-wallet', 'danger');
                }
            } else {
                $this->loadPage(lang('insufficient_balance'), 'transfer-wallet', 'danger');
            }
        }

        if ($this->input->post('trans_button') && $this->validate_transfer()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $from_user = $this->helper_model->userNameToID($post['from_username']);
            $post['amount_trans_multi_crncy'] = $post['amount_trans'];
            $amount = $post['amount_trans'] / $currency_ratio;
            $wallet_type = 'transfer_by_admin';
            if ($amount <= $this->helper_model->getUserPoint($from_user)) {
                $to_user = $this->helper_model->userNameToID($post['to_username']);
                $this->base_model->transactionStart();
                $post['transfer_reason'] = isset($post['transfer_reason']) ? $post['transfer_reason'] : 'NA';
                $res = $this->wallet_model->addFundTransfer($from_user, $to_user, $amount, $wallet_type, $post['transfer_reason'], 'wal-2');
                if ($res && $this->base_model->transationCheck()) {
                    $this->helper_model->insertWalletDetails($from_user, 'debit', $amount, $wallet_type, $to_user, '', '', '', '', 1);
                    $this->helper_model->insertWalletDetails($to_user, 'credit', $amount, $wallet_type, $from_user, '', '', '', '', 1);
                    $this->helper_model->insertActivity($logged_user, 'deduct_fund_from_user', $post);
                    $this->base_model->transationCommit();
                    $this->loadPage(lang('fund_transfered_successfully'), 'transfer-wallet');
                } else {
                    $this->base_model->transationRollback();
                    $failed_data = array('from_user' => $from_user, 'to_user' => $to_user, 'amount' => $amount, 'wallet_type' => $wallet_type, 'transfer_reason' => $post['transfer_reason']);
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'fund_debit_failed2', $failed_data);
                    $this->loadPage(lang('fund_transfered_failed'), 'transfer-wallet', 'danger');
                }
            } else {
                $this->loadPage(lang('insufficient_balance'), 'transfer-wallet', 'danger');
            }
        }

        $active_tab = '';
        if ($this->session->userdata('active_fund_tab') != null) {
            $tab1 = $tab2 = $tab3 = '';
            $active_tab = $this->session->userdata('active_fund_tab');
        }

        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('count1', $this->wallet_model->countOfTotalAddFund('wal-2', 'credited_by_admin'));
        $this->setData('count2', $this->wallet_model->countOfTotalDedFund('wal-2', 'debited_by_admin'));
        $this->setData('count3', $this->wallet_model->countOfTotalTransfer('transfer_by_admin', 'wal-2'));
        $this->setData($active_tab, ' active');
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_188'));
        $this->loadView();
    }

    function get_user_point() {
        if ($this->input->get('username')) {
            $user_id = $this->helper_model->userNameToID($this->input->get('username'));
            if ($user_id) {
                $balance = $this->helper_model->getUserPoint($user_id);
                echo $this->helper_model->currency_conversion($balance, 1);
                exit();
            }
        }
        echo '';
    }

    /**
     * For validate the fund transfer form
     * @return type
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function validate_add_fund() {
        $this->session->set_userdata('active_fund_tab', 'tab1');
        $this->form_validation->set_rules('username_add', lang('username'), 'required|callback_validate_username|trim');
        $this->form_validation->set_rules('amount_add', lang('amount'), 'required|greater_than[0]');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate the deduct fund form
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     * @return type
     */
    function validate_ded_fund() {
        $this->session->set_userdata('active_fund_tab', 'tab2');
        $this->form_validation->set_rules('username_ded', lang('username'), 'required|callback_validate_username|trim');
        $this->form_validation->set_rules('amount_ded', lang('amount'), 'required|greater_than[0]');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate the fund transfer
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     * @return type
     */
    function validate_transfer() {
        $this->session->set_userdata('active_fund_tab', 'tab3');
        $this->form_validation->set_rules('from_username', lang('from_username'), 'required|callback_validate_username|trim');
        $this->form_validation->set_rules('to_username', lang('to_username'), 'required|callback_validate_username|trim');
        $this->form_validation->set_rules('amount_trans', lang('amount'), 'required|greater_than[0]');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate transfered user name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     * @param type $username
     * @return boolean
     */
    function validate_username($username) {
        $flag = false;
        if ($this->helper_model->userNameToID($username)) {
            $flag = true;
        }
        $this->form_validation->set_message('validate_username', lang('enter_a_valid_username'));
        return $flag;
    }

    /**
     * For getting the user balance
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_user_balance() {
        if ($this->input->get('username')) {
            $user_id = $this->helper_model->userNameToID($this->input->get('username'));
            if ($user_id) {
                $balance = $this->helper_model->getUserBalance($user_id);
                echo $this->helper_model->currency_conversion($balance, 1);
                exit();
            }
        }
        echo '';
    }

    /**
     * For multiple wallet module on user wallet one enable commission amount split into 2 one or wallet one and wallet two
     * * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function user_wallet_one() {
        if (empty($this->session->userdata('wallet_id'))) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->session->set_userdata('wallet_id', $user_id);
        } else {
            $user_id = $this->session->userdata('wallet_id');
        }

        if ($this->input->post('submit')) {
            $user_name = $this->input->post('user_name');
            $user_id = $this->helper_model->userNameToID($user_name);
            $this->session->set_userdata('wallet_id', $user_id);
        }
        $user_dp = $this->helper_model->getUserDp($user_id);
        $this->setData('user_dp', $user_dp);
        $user_full_name = $this->helper_model->IdToUserName($user_id);
        $total_credits = $this->wallet_model->getSumWalletsWallet1($user_id, 'credit');
        $total_debits = $this->wallet_model->getSumWalletsWallet1($user_id, 'debit');

        $count_all = $this->wallet_model->countAllTransationWallet1($user_id);
        $count_credits = $this->wallet_model->countCreditDebitWallet1($user_id, 'credit');
        $count_debits = $this->wallet_model->countCreditDebitWallet1($user_id, 'debit');

        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_71'));
        $this->setData('user_full_name', $user_full_name);

        $this->setData('count_all', $count_all);
        $this->setData('count_credits', $count_credits);
        $this->setData('count_debits', $count_debits);
        $this->setData('total_credits', round($total_credits, 8));
        $this->setData('total_debits', round($total_debits, 8));
        $this->setData('balance_amount', $this->helper_model->getUserBalance($user_id));

        $this->loadView();
    }

    /**
     * For multiple wallet module on user wallet two enable commission amount split into 2 one or wallet one and wallet two
     * * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function user_wallet_two() {
        if (empty($this->session->userdata('wallet_id'))) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->session->set_userdata('wallet_id', $user_id);
        } else {
            $user_id = $this->session->userdata('wallet_id');
        }
        if ($this->input->post('submit')) {
            $user_name = $this->input->post('user_name');
            $user_id = $this->helper_model->userNameToID($user_name);
            $this->session->set_userdata('wallet_id', $user_id);
        }
        $user_dp = $this->helper_model->getUserDp($user_id);
        $user_full_name = $this->helper_model->IdToUserName($user_id);
        $total_credits = $this->wallet_model->getSumWalletsWallet2($user_id, 'credit');
        $total_debits = $this->wallet_model->getSumWalletsWallet2($user_id, 'debit');
        $count_all = $this->wallet_model->countAllTransationWallet2($user_id);
        $count_credits = $this->wallet_model->countCreditDebitWallet2($user_id, 'credit');
        $count_debits = $this->wallet_model->countCreditDebitWallet2($user_id, 'debit');


        $this->setData('user_dp', $user_dp);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_72'));
        $this->setData('user_full_name', $user_full_name);
        $this->setData('count_all', $count_all);
        $this->setData('count_credits', $count_credits);
        $this->setData('count_debits', $count_debits);
        $this->setData('total_credits', round($total_credits, 8));
        $this->setData('total_debits', round($total_debits, 8));
        $this->setData('balance_amount', $this->helper_model->getUserPoint($user_id));

        $this->loadView();
    }

    /**
     * For Payout release option done here for example:- one user request the payout request list out here administrator who release it
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     * @param type $action
     * @param type $id
     */
    function payout_release($action = "", $id = "") {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $table = 'user_wallet_one';
        if ($action && $id) {
            $details = $this->wallet_model->getRejectedDetails($id);
            if ($action == "delete") {
                $res = $this->wallet_model->rejectPayoutRelease($id, $details);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'payout_rejected', $details);
                    $this->loadPage(lang('with_req_rejected'), 'withdarw-confirm');
                } else {
                    $this->loadPage(lang('payout_rejected_failed'), 'withdarw-confirm', 'danger');
                }
            } elseif ($action == "confirm") {
                $res = $this->wallet_model->confirmPayoutRelease($id);
                if ($res) {
                    $data['id'] = $id;
                    $data['action'] = $action;
                    $this->helper_model->insertActivity($user_id, 'payout_confirmed', $details);
                    $this->loadPage(lang('with_req_confirmed'), 'withdarw-confirm');
                } else {
                    $this->loadPage(lang('with_req_confirm_failed'), 'withdarw-confirm', 'danger');
                }
            }
        }
        $res = false;
        if ($this->input->post('payout_release')) {
            if (!$this->input->post('checkbox')) {
                $this->loadPage(lang('please_select_any_request'), 'withdarw-confirm', 'danger');
            }
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());

            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $details = $this->wallet_model->getRejectedDetails($id);
                    $res = $this->wallet_model->confirmPayoutRelease($id);
                    if ($res) {
                        $data['id'] = $id;
                        $data['action'] = $action;
                        $this->helper_model->insertActivity($user_id, 'payout_confirmed', $details);
                    }
                }
                if ($res) {
                    $this->loadPage(lang('with_req_confirmed'), 'withdarw-confirm');
                } else {
                    $this->loadPage(lang('with_req_confirm_failed'), 'withdarw-confirm', 'danger');
                }
            }
        }
        if ($this->input->post('payout_rejected')) {
            if (!$this->input->post('checkbox')) {
                $this->loadPage(lang('please_select_any_request'), 'withdarw-confirm', 'danger');
            }
            $this->load->helper('security');
            $post_data = $this->security->xss_clean($this->input->post());
            $count = count($post_data['checkbox']);
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $id = $post_data['checkbox'][$i];
                    $details = $this->wallet_model->getRejectedDetails($id);
                    $res = $this->wallet_model->rejectPayoutRelease($id, $details);
                    if ($res) {
                        $data['id'] = $id;
                        $data['action'] = 'payout_reject';
                        $this->helper_model->insertActivity($user_id, 'payout_rejected', $details);
                    }
                }
                if ($res) {
                    $this->loadPage(lang('with_req_rejected'), 'withdarw-confirm');
                } else {
                    $this->loadPage(lang('with_req_reject_failed'), 'withdarw-confirm', 'danger');
                }
            }
        }


        $this->setData('count1', $this->wallet_model->countOfPayoutRelease());
        $this->setData('count2', $this->wallet_model->countAdminPayout('payout_released'));
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_81'));
        $this->loadView();
    }

    /**
     *
     * For getting the wallet one details
     * * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_all_wallet_one() {
        $request = $this->input->get();
        $limit = $order = $where = '';
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $user_id = $this->session->userdata('wallet_id');
        $amount_field = 'amount1';
        $tax_field = 'tax1';
        $type = '';
        $column = $this->wallet_model->getTableColumnTransationWallet($amount_field, $tax_field);
        $total_records = $this->wallet_model->countTransationWallet($table1, $table2, $user_id, $type, $amount_field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field);
        $res_data = $this->wallet_model->getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field);

        $count_wallet = count($res_data);

        for ($i = 0; $i < $count_wallet; $i++) {
            $tax = $res_data[$i][6];
            $res_data[$i][6] = round($res_data[$i][5], 8);
            $res_data[$i][5] = round($res_data[$i][7], 8);
            $res_data[$i][6] = $this->helper_model->currency_conversion($res_data[$i][6]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);

            if ($res_data[$i][4] == 'credit') {
                $res_data[$i][1] = '<span style="color:green;">' . $res_data[$i][1] . '</span>';
                $res_data[$i][6] = '<span style="color:green;"> <i class="fa fa-level-up"></i> ' . $res_data[$i][6] . '</span>';
                if ($res_data[$i][0] == '') {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited');
                } else {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited_from') . ' <b>' . $res_data[$i][0] . '</b>';
                }
            } else {
                $res_data[$i][1] = '<span style="color:red;">' . $res_data[$i][1] . '</span>';
                $res_data[$i][6] = '<span style="color:red;"> <i class="fa fa-level-down"></i> ' . $res_data[$i][6] . '</span>';
                if ($res_data[$i][0] == '') {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited');
                } else {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited_by') . ' <b>' . $res_data[$i][0] . '</b>';
                }
            }
            $res_data[$i][2] = lang('' . $res_data[$i][2] . '');
            $res_data[$i][4] = round($tax, 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);

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

    /**
     * For credit the amount to wallet one
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_credit_wallet_one() {
        $request = $this->input->get();
        $limit = $order = $where = '';
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $user_id = $this->session->userdata('wallet_id');
        $amount_field = 'amount1';
        $tax_field = 'tax1';
        $type = 'credit';
        $column = $this->wallet_model->getTableColumnTransationWallet($amount_field, $tax_field);
        $total_records = $this->wallet_model->countTransationWallet($table1, $table2, $user_id, $type, $amount_field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field);
        $res_data = $this->wallet_model->getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field);
        $count_wallet = count($res_data);
        for ($i = 0; $i < $count_wallet; $i++) {

            $res_data[$i][4] = round($res_data[$i][6], 8);
            $res_data[$i][6] = round($res_data[$i][5], 8);
            $res_data[$i][5] = round($res_data[$i][7], 8);
            $res_data[$i][6] = $this->helper_model->currency_conversion($res_data[$i][6]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][1] = '<span style="color:green;">' . $res_data[$i][1] . '</span>';
            $res_data[$i][6] = '<span style="color:green;"> <i class="fa fa-level-up"></i> ' . $res_data[$i][6] . '</span>';

            if ($res_data[$i][0] == '') {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited');
            } else {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited_from') . ' <b>' . $res_data[$i][0] . '</b>';
            }

            $res_data[$i][2] = lang('' . $res_data[$i][2] . '');
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

    /**
     * For debit wallet one
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_debit_wallet_one() {
        $request = $this->input->get();
        $limit = $order = $where = '';
        $user_id = $this->session->userdata('wallet_id');
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $user_id = $this->session->userdata('wallet_id');
        $amount_field = 'amount1';
        $tax_field = 'tax1';
        $type = 'debit';
        $column = $this->wallet_model->getTableColumnTransationWallet($amount_field, $tax_field);
        $total_records = $this->wallet_model->countTransationWallet($table1, $table2, $user_id, $type, $amount_field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field);
        $res_data = $this->wallet_model->getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field);
        $count_wallet = count($res_data);
        for ($i = 0; $i < $count_wallet; $i++) {

            $res_data[$i][4] = round($res_data[$i][6], 8);
            $res_data[$i][6] = round($res_data[$i][5], 8);
            $res_data[$i][5] = round($res_data[$i][7], 8);
            $res_data[$i][6] = $this->helper_model->currency_conversion($res_data[$i][6]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][1] = '<span style="color:red;">' . $res_data[$i][1] . '</span>';
            $res_data[$i][6] = '<span style="color:red;"> <i class="fa fa-level-down"></i> ' . $res_data[$i][6] . '</span>';

            if ($res_data[$i][0] == '') {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited');
            } else {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited_by') . ' <b>' . $res_data[$i][0] . '</b>';
            }


            $res_data[$i][2] = lang('' . $res_data[$i][2] . '');
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

    /**
     * For get all wallet two details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_all_wallet_two() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $user_id = $this->session->userdata('wallet_id');
        $amount_field = 'amount2';
        $tax_field = 'tax2';
        $type = '';
        $column = $this->wallet_model->getTableColumnTransationWallet($amount_field, $tax_field);
        $total_records = $this->wallet_model->countTransationWallet($table1, $table2, $user_id, $type, $amount_field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field);
        $res_data = $this->wallet_model->getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field);

        $count_wallet = count($res_data);


        for ($i = 0; $i < $count_wallet; $i++) {

            $res_data[$i][5] = round($res_data[$i][5], 8);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            if ($res_data[$i][4] == 'credit') {
                $res_data[$i][1] = '<span style="color:green;">' . $res_data[$i][1] . '</span>';
                $res_data[$i][5] = '<span style="color:green;"> <i class="fa fa-level-up"></i> ' . $res_data[$i][5] . '</span>';
                if ($res_data[$i][0] == '') {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited');
                } else {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited_from') . ' <b>' . $res_data[$i][0] . '</b>';
                }
            } else {
                $res_data[$i][1] = '<span style="color:red;">' . $res_data[$i][1] . '</span>';
                $res_data[$i][5] = '<span style="color:red;"> <i class="fa fa-level-down"></i> ' . $res_data[$i][5] . '</span>';
                if ($res_data[$i][0] == '') {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited');
                } else {
                    $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited_by') . ' <b>' . $res_data[$i][0] . '</b>';
                }
            }
            $res_data[$i][4] = round($res_data[$i][6], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][2] = lang('' . $res_data[$i][2] . '');
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

    /**
     * For credit wallet two details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_credit_wallet_two() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $user_id = $this->session->userdata('wallet_id');
        $amount_field = 'amount2';
        $tax_field = 'tax2';
        $type = 'credit';
        $column = $this->wallet_model->getTableColumnTransationWallet($amount_field, $tax_field);
        $total_records = $this->wallet_model->countTransationWallet($table1, $table2, $user_id, $type, $amount_field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field);
        $res_data = $this->wallet_model->getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field);

        $count_wallet = count($res_data);

        for ($i = 0; $i < $count_wallet; $i++) {

            $res_data[$i][5] = round($res_data[$i][5], 8);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][1] = '<span style="color:green;">' . $res_data[$i][1] . '</span>';
            $res_data[$i][5] = '<span style="color:green;"> <i class="fa fa-level-up"></i> ' . $res_data[$i][5] . '</span>';

            if ($res_data[$i][0] == '') {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited');
            } else {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_credited_from') . ' <b>' . $res_data[$i][0] . '</b>';
            }
            $res_data[$i][4] = round($res_data[$i][6], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
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

    /**
     * For debit wallet two details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function get_debit_wallet_two() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $user_id = $this->session->userdata('wallet_id');
        $amount_field = 'amount2';
        $tax_field = 'tax2';
        $type = 'debit';
        $column = $this->wallet_model->getTableColumnTransationWallet($amount_field, $tax_field);
        $total_records = $this->wallet_model->countTransationWallet($table1, $table2, $user_id, $type, $amount_field);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field);
        $res_data = $this->wallet_model->getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field);
        $count_wallet = count($res_data);

        for ($i = 0; $i < $count_wallet; $i++) {


            $res_data[$i][5] = round($res_data[$i][5], 8);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);


            $res_data[$i][1] = '<span style="color:red;">' . $res_data[$i][1] . '</span>';
            $res_data[$i][5] = '<span style="color:red;"> <i class="fa fa-level-down"></i> ' . $res_data[$i][5] . '</span>';


            if ($res_data[$i][0] == '') {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited');
            } else {
                $res_data[$i][2] = '<b>' . lang($res_data[$i][2]) . '</b> - ' . lang('amount_debited_by') . ' <b>' . $res_data[$i][0] . '</b>';
            }
            $res_data[$i][4] = round($res_data[$i][6], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
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

    /**
     * For investment history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function investment_history() {
        $investments = $this->wallet_model->getAllInvCategory();
        $this->setData('investments', $investments);
        $this->setData('title', lang('menu_name_99'));
        $this->loadView();
    }

    /**
     * View the investment history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     * @param type $category_id
     */
    function inv_history($category_id = '') {

        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'investment_history';
        $table3 = DB_PREFIX_SYSTEM . 'products';
        $limit = $order = $where = '';

        $column = $this->wallet_model->getTableColumnInvestmentHistory();
        $total_records = $this->wallet_model->countOfInvestmentHistory($category_id);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->wallet_model->getTotalFilteredInvestmentHistory($table1, $table2, $table3, $where, $category_id);
        $res_data = $this->wallet_model->getResultDataInvestmentHistory($table1, $table2, $table3, $where, $order, $limit, $category_id);
        $count_wallet = count($res_data);
        for ($i = 0; $i < $count_wallet; $i++) {
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

    /**
     * For release investment amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     * @param type $action
     * @param type $request_id
     */
    function release_investment_amount($action = '', $request_id = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        if ($action && $request_id) {
            if ($action == 'confirm') {
                $res = $this->wallet_model->updateInvRequest($request_id, 'released');
                if ($res) {
                    $this->loadPage(lang('req_confirmed'), 'wallet/release_investment_amount');
                } else {
                    $this->loadPage(lang('failed_to_release'), 'wallet/release_investment_amount', 'danger');
                }
            } elseif ($action == 'delete') {
                $res = $this->wallet_model->updateInvRequest($request_id, 'deleted');
                if ($res) {
                    $this->wallet_model->revertInvestmentBalance($request_id);
                    $this->loadPage(lang('req_deleted'), 'wallet/release_investment_amount');
                } else {
                    $this->loadPage(lang('failed_to_delete'), 'wallet/release_investment_amount', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_action'), 'wallet/release_investment_amount', 'danger');
            }
        }
//        $req = $this->wallet_model->getAllInvestmentRequests();
//        $this->setData('request', $req);
        $this->setData('title', lang('menu_name_114'));
        $this->loadView();
    }

    /**
     * For view payout release list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function payout_release_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'wallet_details';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnPayoutRelease();
        $total_records = $this->wallet_model->countOfPayoutRelease();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->wallet_model->getTotalFilteredPayoutRelease($table1, $table2, $where);
        $res_data = $this->wallet_model->getResultDataPayoutRelease($table1, $table2, $where, $order, $limit);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {

            $res_data[$i][4] = round($res_data[$i][4], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][5] = '<div class="checkbox-table">
                                        <label>
                                           <input value=' . $res_data[$i][0] . ' name="checkbox[]" type="checkbox" class="flat-grey foocheck">
                                        </label>
                                    </div>';
            $res_data[$i][6] = '<a href="javascript:confirm_payout(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('send') . '"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                    <a href="javascript:delete_payout(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            $res_data[$i][2] = $this->wallet_model->getUserAccountSettings($res_data[$i][2]);
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

    /**
     * For release investment
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access Public
     */
    function release_investment() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'inv_release_history';
        $table3 = DB_PREFIX_SYSTEM . 'investment_category';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnInvestment();
        $total_records = $this->wallet_model->countOfInvestment();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredInvestment($table1, $table2, $table3, $where);
        $res_data = $this->wallet_model->getResultDataInvestment($table1, $table2, $table3, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            if ($res_data[$i][5] == 'released') {
                $res_data[$i][6] = '<font color="green">' . lang('released') . '</font> ';
            } elseif ($res_data[$i][5] == 'deleted') {
                $res_data[$i][6] = '<font color="red">' . lang('deleted') . '</font>';
            } else {
                $res_data[$i][6] = '<a href="javascript:confirm_req(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('confirm') . '"><i class="glyphicon glyphicon-ok-sign"></i></a>
                                                <a href="javascript:delete_req(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            }
            $res_data[$i][5] = lang($res_data[$i][5]);
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

    function add_fund_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_details';
        $table3 = DB_PREFIX_SYSTEM . 'wallet_transfer';
        $type = 'wal-1';
        $wallet_type = 'credited_by_admin';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnAddFund();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->wallet_model->countOfTotalAddFund($type, $wallet_type);
        $record_filtered = $this->wallet_model->getTotalFilteredAddFund($table1, $table2, $table3, $where, $type, $wallet_type);
        $res_data = $this->wallet_model->getResultDataTotalAddFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][6];
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function deduct_fund_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_details';
        $table3 = DB_PREFIX_SYSTEM . 'wallet_transfer';
        $type = 'wal-1';
        $wallet_type = 'debited_by_admin';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnDedFund();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->wallet_model->countOfTotalDedFund($type, $wallet_type);
        $record_filtered = $this->wallet_model->getTotalFilteredDedFund($table1, $table2, $table3, $where, $type, $wallet_type);
        $res_data = $this->wallet_model->getResultDataTotalDedFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][6];
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function transfer_fund_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_details';
        $table3 = DB_PREFIX_SYSTEM . 'wallet_transfer';
        $type = 'wal-1';
        $wallet_type = 'transfer_by_admin';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnTransfer();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->wallet_model->countOfTotalTransfer($wallet_type, $type);
        $record_filtered = $this->wallet_model->getTotalFilteredTransfer($table1, $table2, $table3, $where, $wallet_type, $type);
        $res_data = $this->wallet_model->getResultDataTotalTransfer($table1, $table2, $table3, $where, $order, $limit, $wallet_type, $type);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
//            $res_data[$i][1] = $this->helper_model->IdToUserName($res_data[$i][1]);
            $res_data[$i][2] = $this->helper_model->IdToUserName($res_data[$i][2]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function B_add_fund_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_details';
        $table3 = DB_PREFIX_SYSTEM . 'wallet_transfer';
        $type = 'wal-2';
        $wallet_type = 'credited_by_admin';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnAddFund();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->wallet_model->countOfTotalAddFund($type, $wallet_type);
        $record_filtered = $this->wallet_model->getTotalFilteredAddFund($table1, $table2, $table3, $where, $type, $wallet_type);
        $res_data = $this->wallet_model->getResultDataTotalAddFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][6];
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function B_deduct_fund_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_details';
        $table3 = DB_PREFIX_SYSTEM . 'wallet_transfer';
        $type = 'wal-2';
        $wallet_type = 'debited_by_admin';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnDedFund();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->wallet_model->countOfTotalDedFund($type, $wallet_type);
        $record_filtered = $this->wallet_model->getTotalFilteredDedFund($table1, $table2, $table3, $where, $type, $wallet_type);
        $res_data = $this->wallet_model->getResultDataTotalDedFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][6];
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function B_transfer_fund_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_details';
        $table3 = DB_PREFIX_SYSTEM . 'wallet_transfer';
        $type = 'wal-2';
        $wallet_type = 'transfer_by_admin';
        $limit = $order = $where = '';
        $column = $this->wallet_model->getTableColumnTransfer();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->wallet_model->countOfTotalTransfer($wallet_type, $type);
        $record_filtered = $this->wallet_model->getTotalFilteredTransfer($table1, $table2, $table3, $where, $wallet_type, $type);
        $res_data = $this->wallet_model->getResultDataTotalTransfer($table1, $table2, $table3, $where, $order, $limit, $wallet_type, $type);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
//            $res_data[$i][1] = $this->helper_model->IdToUserName($res_data[$i][1]);
            $res_data[$i][2] = $this->helper_model->IdToUserName($res_data[$i][2]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function get_confirm_payout() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'wallet_details';
        $wallet_name = 'user_wallet_one';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'transation_id',
            'mlm_user_id',
            'date',
            'transation_charges',
            'tax1',
            'amount1',
            'payout_status',
            'payout_details'
        );
        $column = $this->wallet_model->getTableColumnAdminPayout();
        $total_records = $this->wallet_model->countAdminPayout('payout_released');
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrderWALLET($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->wallet_model->getTotalFilteredAdminPayout($table, $where, 'payout_released');
        $res_data = $this->wallet_model->getResultDataAdminPayout($table, $columns, $where, $order, $limit, 'payout_released');
        $count_payout = count($res_data);
        for ($i = 0; $i < $count_payout; $i++) {
            $res_data[$i][1] = '<span style="color:green;">' . $res_data[$i][1] . '</span>';
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][5]);
            $res_data[$i][6] = '<span style="color:green;"> ' . $this->helper_model->currency_conversion($res_data[$i][6]) . '</span>';
            $res_data[$i][2] = $this->helper_model->IdToUserName($res_data[$i][2]);

            $payment_details = $this->wallet_model->getPayoutDetails($res_data[$i][8]);
            $res_data[$i][7] = $payment_details;
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
