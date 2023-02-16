<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Donation extends Base_Controller {

    /**
     * For Donation settings
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function index() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $donation_amount_type = $this->dbvars->DONATION_AMOUNT_SETTINGS;
        if ($donation_amount_type == 'fixed') {
            $amount = $this->dbvars->DONATION_AMOUNT;
        } else {
            $amount = 0;
        }
        $user_balance = $this->helper_model->getUserBalance($user_id);
        if ($this->input->post('donate')) {
            $amount = 0;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            if ($donation_amount_type == 'fixed') {
                $amount = $this->dbvars->DONATION_AMOUNT;
            } else {
                $currency_ratio = 1;
                if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
                    $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
                }
                $amount = $post['amount'] / $currency_ratio;
            }
            if ($amount > 0) {
                if ($post['payment_method'] == 'ewallet') {
                    if ($user_balance < $amount) {
                        $this->loadPage(lang('insufficient_balance'), 'donation-plan', 'danger');
                    }
                }

                $res = $this->donation_model->donateAmount($user_id, $amount);
                if ($res) {
                    if ($post['payment_method'] == 'ewallet') {
                        $this->helper_model->insertWalletDetails($user_id, 'debit', $amount, 'donates', $res['user_id'], '', $res);
                    }
                    $this->helper_model->insertActivity($user_id, 'donate_amount', $post);
                    $this->loadPage(lang('donation_successfull'), 'donation-plan');
                } else {
                    $this->loadPage(lang('failed_to_donate'), 'donation-plan', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_amount'), 'donation-plan', 'danger');
            }
        }

        //$donations = $this->donation_model->getUserDonations($user_id);

        $this->setData('user_balance', $user_balance);
        //$this->setData('donations', $donations);
        $this->setData('donation_amount_type', $donation_amount_type);
        $this->setData('amount', $amount);
        $this->setData('title', lang('menu_name_83'));
        $this->loadView();
    }

    /**
     * For listing up the donations
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function history() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $date1 = $date2 = '';
        if ($this->input->post('don_search')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $user_id = $this->helper_model->userNameToID($post['username']);
            $date1 = $post['from_date'];
            $date2 = $post['to_date'];
        }
        $this->session->set_userdata('donation_id', $user_id);
        $this->session->set_userdata('donation_from_date', $date1);
        $this->session->set_userdata('donation_to_date', $date2);
        //$donations = $this->donation_model->getDonationDetails($user_id, $date1, $date2);
        //$this->setData('donations', $donations);
        $this->setData('title', lang('menu_name_84'));
        $this->loadView();
    }

    /**
     * Donation settings
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function settings() {
        if ($this->input->post('don_set')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->donation_model->updateDonationSettings($post);
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'donation_settings_updated', $post);
                $this->loadPage(lang('update_success'), 'donation/settings');
            } else {
                $this->loadPage(lang('failed_to_update'), 'donation/settings', 'danger');
            }
        }
        $donation_amount = $this->dbvars->DONATION_AMOUNT_SETTINGS;
        $amount = $this->dbvars->DONATION_AMOUNT;
        $eligibility_order = $this->dbvars->DONATION_ORDER;
        $eligibility_percentage = $this->dbvars->DONATION_PERCENTAGE;

        $this->setData('eligibility_percentage', $eligibility_percentage);
        $this->setData('eligibility_order', $eligibility_order);
        $this->setData('amount', $amount);
        $this->setData('donation_amount', $donation_amount);

        $this->setData('title', lang('menu_name_85'));
        $this->loadView();
    }

    /**
     * For Donation History 
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function donation_history() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'donations';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $limit = $order = $where = '';
        $column = $this->donation_model->getTableColumnDonationHistory();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $total_records = $this->donation_model->countOfTotalDonationHistory($user_id);
        $record_filtered = $this->donation_model->getTotalFilteredTotalDonationHistory($table1, $table2, $where, $user_id);
        $res_data = $this->donation_model->getResultDataTotalDonationHistory($table1, $table2, $where, $order, $limit, $user_id);
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $this->helper_model->IdToUserName($res_data[$i][2]);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
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
     * Donation settings
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function donation_index() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'donations';
        $user_id = $this->session->userdata('donation_id');
        $from_date = $this->session->userdata('donation_from_date');
        $to_date = $this->session->userdata('donation_to_date');

        $limit = $order = $where = '';
        $column = $this->donation_model->getTableColumnDonationHistory();

        $limit = $this->donation_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);


        if ($from_date && $to_date) {
            $total_records = $this->donation_model->countOfTotalDonationHistorySearch($user_id, $from_date, $to_date);
            $record_filtered = $this->donation_model->getTotalFilteredTotalDonationHistorySearch($table1, $table2, $where, $user_id, $from_date, $to_date);
            $res_data = $this->donation_model->getResultDataTotalDonationHistorySearch($table1, $table2, $where, $order, $limit, $user_id, $from_date, $to_date);
        } else {
            $total_records = $this->donation_model->countOfTotalDonationHistory($user_id);
            $record_filtered = $this->donation_model->getTotalFilteredTotalDonationHistory($table1, $table2, $where, $user_id);
            $res_data = $this->donation_model->getResultDataTotalDonationHistory($table1, $table2, $where, $order, $limit, $user_id);
        }
        $count_donation = count($res_data);
        for ($i = 0; $i < $count_donation; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $this->helper_model->IdToUserName($res_data[$i][2]);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
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
