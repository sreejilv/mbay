<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * For system settings and configuration controller
 * For example Multiple Wallet,Generation settings and all plan related function where done here
 * @author Techffodils Technologies LLP
 * @date 2017-12-18 
 */
class Settings extends Base_Controller {

    /**
     * For load  Multiple wallet view
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function multiple_wallet() {
        $status_muti_wallet = $this->settings_model->getStatusMutiWallet();
        if (!$status_muti_wallet) {
            $this->loadPage('', 'home');
        }
        $wallet_percentage = $this->settings_model->getValueMultiWallet();
//        $this->setData('validation_error', $this->form_validation->error_array());
        $this->setData('wallet_percentage', $wallet_percentage);
        $this->setData('title', lang('menu_name_115'));
        $this->loadView();
    }

    /**
     * For update the multiple wallet details
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function update_multi_wallet() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $wallet_a = $post['wallet_a'];
        $wallet_b = $post['wallet_b'];
        if ($wallet_a + $wallet_b == 100) {
            $update = $this->settings_model->updateMultiWallet($wallet_a, $wallet_b);
            if ($update) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'multi_wal_set_updated', $post);
                echo"yes";
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For generation plan settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function generation_settings() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('gen_set')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = 0;
            foreach ($post['gen'] as $gen) {
                $gen_id = $gen;
                if (isset($post['rank_' . $gen_id])) {
                    $res = $this->settings_model->updateGenerationDetails($gen_id, $post['rank_' . $gen_id], $post['value1_' . $gen_id], $post['value2_' . $gen_id], $post['value3_' . $gen_id]);
                }
            }
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'generation_updated', $post);
                $this->loadPage(lang('settings_updated'), 'generation-plan');
            } else {
                $this->loadPage(lang('failed_to_update'), 'generation-plan', 'danger');
            }
        }
        $generation = $this->settings_model->getGenerations();
        $ranks = $this->settings_model->getAllRanks();

        $this->setData('generation', $generation);
        $this->setData('ranks', $ranks);
        $this->setData('title', lang('menu_name_76'));
        $this->loadView();
    }

    /**
     * For investment plan settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function investment_settings() {
        $currency = $this->settings_model->getInvestmentCurrencies();
        $this->setData('crypto_currenct_status', $this->dbvars->INVESTMENT_CATEGORY);
        $this->setData('currency', $currency);
        $this->setData('title', lang('menu_name_77'));
        $this->loadView();
    }

    /**
     * For investment category settings 
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function change_investment_category() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['status']) {
            $type = $post['status'];
            if ($type == 'default' || $type == 'crypto') {
                $this->dbvars->INVESTMENT_CATEGORY = $type;
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'change_investment_category', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For change the currency status
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function change_currency_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['status'] && $post['id']) {
            $type = $post['status'];
            $id = $post['id'];
            if ($type == 'active' || $type == 'inactive') {
                if ($type == 'active') {
                    $status = 1;
                } else {
                    $status = 0;
                }

                $res = $this->settings_model->updateInvestmentCurrencyStatus($id, $status);
                if ($res) {
                    $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'change_investment_currency_status', $post);
                    echo 'yes';
                    exit;
                }
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For tax settings for the payment
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function tax_and_payment() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $tab1 = ' active';
        $tab2 = $tab3 = '';
        if ($this->input->post('tax_settings')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $per_or_static = $post['per_or_static'];
            $tax = $post['tax'];
            if ($per_or_static != '' && $tax >= 0) {
                $res = $this->settings_model->updateTax($per_or_static, $tax);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'tax_set_updated', $post);
                    $this->loadPage(lang('sucessfully_updated'), 'tax-manage');
                } else {
                    $this->loadPage(lang('failed_to_update'), 'tax-manage', 'danger');
                }
            } else {
                $this->loadPage(lang('failed_to_update'), 'tax-manage', 'danger');
            }
        }


        $tax = $this->helper_model->getTaxValues();
        $this->setData('tax', $tax);


        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('DEFAULT_CURRENCY_SYMBOL', $this->dbvars->DEFAULT_SYMBOL_LEFT . '' . $this->dbvars->DEFAULT_SYMBOL_RIGHT);

        $this->setData('title', lang('menu_name_90'));
        $this->loadView();
    }

    /**
     * For update the tax data
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function update_tax() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $per_or_static = $post['per_or_static'];
        $tax = $post['tax'];

        if ($tax >= 0) {

            $update = $this->settings_model->updateTax($per_or_static, $tax);
            if ($update) {
                echo"yes";
                exit;
            } else {
                echo"Error On Updating...";
                exit;
            }
        } else {
            echo"please enter postive value...";
            exit;
        }
    }

    /**
     * For setting-up the stair step plan settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function stair_step_settings() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('ss_set')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = 0;
            foreach ($post['sss'] as $sss) {
                $stair_id = $sss;
                $res = $this->settings_model->updateStairStepDetails($stair_id, $post['ql_' . $stair_id], $post['gv_' . $stair_id], $post['ptg_' . $stair_id]);
            }
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'stair_step_updated', $post);
                $this->loadPage(lang('settings_updated'), 'stair-step-plan');
            } else {
                $this->loadPage(lang('failed_to_update'), 'stair-step-plan', 'danger');
            }
        }
        $stair_steps = $this->settings_model->getStairSteps();

        $this->setData('stair_steps', $stair_steps);
        $this->setData('title', lang('menu_name_100'));
        $this->loadView();
    }

    /**
     * For IP white-list list
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function ip_whitelist($action = '', $id = '') {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $whitelisted_ip = '';
        $edit_flag = FALSE;
        if ($action && $id) {
            if ($action == 'remove') {
                $res = $this->settings_model->removeIpWhitelist($id);
                if ($res) {
                    $this->loadPage(lang('ip_removed_from_whitelist'), 'ip-whitelisting');
                } else {
                    $this->loadPage(lang('ip_removed_failed_whitelist'), 'ip-whitelisting', 'danger');
                }
            } elseif ($action == "activate") {
                $res = $this->settings_model->changeIpStatus($id, 1);
                if ($res) {
                    $data['id'] = $id;
                    $this->helper_model->insertActivity($loged_user_id, 'ip-whitelisting', $data);
                    $this->loadPage(lang('ip_activated'), 'ip-whitelisting');
                } else {
                    $this->loadPage(lang('ip_activation_failed'), 'ip-whitelisting', 'danger');
                }
            } elseif ($action == "inactivate") {
                $res = $this->settings_model->changeIpStatus($id, 0);
                if ($res) {
                    $data['id'] = $id;
                    $this->helper_model->insertActivity($loged_user_id, 'ip-whitelisting', $data);
                    $this->loadPage(lang('ip_inactivated'), 'ip-whitelisting');
                } else {
                    $this->loadPage(lang('ip_inactivation_failed'), 'ip-whitelisting', 'danger');
                }
            } elseif ($action == "edit") {
                $edit_flag = TRUE;
                $whitelisted_ip = $this->settings_model->getWhitelistedIP($id);
            } else {
                $this->loadPage(lang('invalid_action'), 'ip-whitelisting', 'danger');
            }
        }


        if ($this->input->post('add_ip') && $this->validate_ip()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->settings_model->InsertWhitelistIP($post);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'ip_whitelisted', $post);
                $this->loadPage(lang('ip_added_to_whitelist'), 'ip-whitelisting');
            } else {
                $this->loadPage(lang('ip_added_failed_whitelist'), 'ip-whitelisting', 'danger');
            }
        }

        if ($this->input->post('update_ip') && $this->validate_ip()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->settings_model->updateWhitelistIP($post, $id);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'ip_whitelisted', $post);
                $this->loadPage(lang('ip_updated_to_whitelist'), 'ip-whitelisting');
            } else {
                $this->loadPage(lang('ip_updated_failed_whitelist'), 'ip-whitelisting', 'danger');
            }
        }

        $this->setData('whitelisted_ip', $whitelisted_ip);
        $this->setData('id', $id);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('ip_address', $this->helper_model->getUserIP());
        $this->setData('title', lang('menu_name_132'));
        $this->loadView();
    }

    function validate_ip() {
        $this->form_validation->set_rules('whitelist_ip_name', lang('whitelisted_ip'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function ip_whitelist_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'ip_whitelist';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'whitelist_ip',
            'date',
            'status'
        );

        $column = $this->settings_model->getTableColumnWhitelistList();
        $total_records = $this->settings_model->countOfWhitelistIp();

        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->settings_model->getTotalFilteredWhiteListIp($table, $where);
        $res_data = $this->settings_model->getResultDataWhiteList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][3] == 1) {
                $res_data[$i][3] = '<a href="javascript:edit_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title=' . lang('inactivate') . '><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:remove_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('remove') . '><i class="fa fa-trash fa fa-white"></i></a> ';
            } else {
                $res_data[$i][3] = '<a href="javascript:activate_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a>';
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

    /**
     * For white-list IP list
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function whitelist_ip() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $id = $post['id'];
        $ip = $post['ip'];
        $update = $this->settings_model->updateWhitelistIP($id, $ip);
        if ($update) {
            $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'ip_whitelisted', $post);
            echo"yes";
            exit;
        }

        echo 'no';
        exit;
    }

    /**
     * For SMS Settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function sms_settings() {
        $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('submit') && $this->validate_bulkSms()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $this->dbvars->BULKSMS_USERNAME = $post['account_username'];
            $this->dbvars->BULKSMS_PASSWORD = $post['account_password'];
            $this->helper_model->insertActivity($log_user_id, 'sms_credentials_updated', $post);
            $this->loadPage(lang('sms_settings_updated_successfully'), 'sms-settings');
        } elseif ($this->input->post('update_content') && $this->validate_sms_content()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $this->dbvars->REG_SMS_CONTENT = $post['register_sms_content'];
            $this->dbvars->CHECKOUT_SMS_CONTENT = $post['checkout_sms_content'];
            $this->helper_model->insertActivity($log_user_id, 'sms_content_updated', $post);
            $this->loadPage(lang('sms_content_updated_successfully'), 'sms-settings');
        }
        $this->setData('account_username', $this->dbvars->BULKSMS_USERNAME);
        $this->setData('account_password', $this->dbvars->BULKSMS_PASSWORD);
        $this->setData('register_sms_permission', $this->dbvars->REG_SMS_PERMISSION);
        $this->setData('checkout_sms_permission', $this->dbvars->CHECKOUT_SMS_PERMISSION);
        $this->setData('checkout_sms_content', $this->dbvars->CHECKOUT_SMS_CONTENT);
        $this->setData('register_sms_content', $this->dbvars->REG_SMS_CONTENT);
        $this->setData('validation_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_156'));
        $this->loadView();
    }

    /**
     * For Validating Bulk SMS credentials
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function validate_sms_content() {

        $this->form_validation->set_rules('register_sms_content', lang('register_sms_content'), 'required');
        $this->form_validation->set_rules('checkout_sms_content', lang('checkout_sms_content'), 'required');
        return $this->form_validation->run();
    }

    /**
     * For Validating Bulk SMS credentials
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function validate_bulkSms() {

        $this->form_validation->set_rules('account_username', lang('account_username'), 'required');
        $this->form_validation->set_rules('account_password', lang('account_password'), 'required');
        return $this->form_validation->run();
    }

    /**
     * For Updating Config Values
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function change_config_value() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $module = $post['module'];
        $status = $post['status'];
        if ($module && ($status == 1 || $status == 0)) {
            $this->dbvars->$module = $status;
            $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($log_user_id, 'sms_permission_changed', $post);
            echo 'yes';
            exit();
        }
        echo 'no';
        exit();
    }

    public function ip_blacklist($action = '', $id = '') {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $blacklist_ip = '';
        $edit_flag = FALSE;
        if ($action && $id) {
            if ($action == 'remove') {
                $res = $this->settings_model->removeIpBlacklist($id);
                if ($res) {
                    $this->loadPage(lang('ip_removed_blacklist'), 'ip-blacklist');
                } else {
                    $this->loadPage(lang('ip_removed_failed_blacklist'), 'ip-blacklist', 'danger');
                }
            } elseif ($action == "activate") {
                $res = $this->settings_model->changeIpBlackStatus($id, 1);
                if ($res) {
                    $data['id'] = $id;
                    $this->helper_model->insertActivity($loged_user_id, 'ip-blacklist', $data);
                    $this->loadPage(lang('ip_activated'), 'ip-blacklist');
                } else {
                    $this->loadPage(lang('ip_activation_failed'), 'ip-blacklist', 'danger');
                }
            } elseif ($action == "inactivate") {
                $res = $this->settings_model->changeIpBlackStatus($id, 0);
                if ($res) {
                    $data['id'] = $id;
                    $this->helper_model->insertActivity($loged_user_id, 'ip-blacklist', $data);
                    $this->loadPage(lang('ip_inactivated'), 'ip-blacklist');
                } else {
                    $this->loadPage(lang('ip_inactivation_failed'), 'ip-blacklist', 'danger');
                }
            } elseif ($action == "edit") {
                $edit_flag = TRUE;
                $blacklist_ip = $this->settings_model->getBlacklistedIP($id);
            } else {die;
                $this->loadPage(lang('invalid_action'), 'ip-blacklist', 'danger');
            }
        }
        if ($this->input->post('blacklist') && $this->validate_blacklist()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->settings_model->inserIpBlacklist($post);
            if ($res) {
                $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($log_user_id, 'ip_blacklisted', $post);
                $this->loadPage(lang('ip_added_to_blacklist'), 'ip-blacklist');
            } else {
                $this->loadPage(lang('ip_added_failed_blacklist'), 'ip-blacklist', 'danger');
            }
        }

        if ($this->input->post('update_ip') && $this->validate_blacklist()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->settings_model->updateBlacklistIP($post, $id);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'ip-blacklist', $post);
                $this->loadPage(lang('ip_updated_to_blacklist'), 'ip-blacklist');
            } else {
                $this->loadPage(lang('ip_updated_failed_blacklist'), 'ip-blacklist', 'danger');
            }
        }

        $this->setData('blacklisted_ip', $blacklist_ip);
        $this->setData('id', $id);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('title', lang('menu_name_175'));
        $this->setData('ip_address', $this->helper_model->getUserIP());
        $this->loadView();
    }

    function validate_blacklist() {
        $this->form_validation->set_rules('ip_address', lang('ip_address'), 'required|valid_ip');
        $this->form_validation->set_rules('reason', lang('reason'), 'required');
        return $this->form_validation->run();
    }

    function blacklist_ip() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'ip_blacklist';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'blacklist_ip',
            'reason',
            'date',
            'status'
        );

        $column = $this->settings_model->getTableColumnBlacklistList();
        $total_records = $this->settings_model->countOfBlacklistIp();

        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->settings_model->getTotalFilteredBlackListIp($table, $where);
        $res_data = $this->settings_model->getResultDataBlackList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][4] == 1) {
                $res_data[$i][4] = '<a href="javascript:edit_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title=' . lang('inactivate') . '><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:remove_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('remove') . '><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][4] = '<a href="javascript:activate_ip(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a>';
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

}
