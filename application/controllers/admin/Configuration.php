<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * This controller used for admin configuration and settings all these functionalites done in this server
 *
 */
class Configuration extends Base_Controller {

    /**
     * Plan settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-15
     */
    public function plan_settings() {
        $tab1 = $tab2 = $tab3 = $tab3 = $tab4 = $tab5 = $tab6 = $tab7 = '';
        if ($this->session->userdata('plan_active_tab') == '') {
            $this->session->set_userdata('plan_active_tab', 'tab1');
        }
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $mlm_plan = $this->dbvars->MLM_PLAN;
        $payment_method = $this->configuration_model->getAllPaymentMethods();
        $payment_config = $this->configuration_model->getPaymentConfig();
        $payout_setting = $this->helper_model->getPayoutMinMaxAmount();
        $username_type = $this->dbvars->USERNAME_TYPE;
        $username_prefix = $this->dbvars->USERNAME_PREFIX;
        $username_size = $this->dbvars->USERNAME_SIZE;
        $register_form_type = $this->dbvars->REGISTER_FORM_TYPE;
        $register_field_configuration = $this->dbvars->REGISTER_FIELD_CONFIGURATION;
        $matrix_depth = $this->dbvars->MATRIX_DEPTH;
        $matrix_width = $this->dbvars->MATRIX_WIDTH;
        $reg_packs = $this->dbvars->REGISTER_PACKAGE;
        $register_leg = $this->helper_model->getUserDefaultLeg($user_id);
        $coin_payment_author=$this->dbvars->COINPAYMENT_AUTHOR;
        $coin_payment_merchant=$this->dbvars->COINPAYMENT_MERCHANT;


        $binary = $this->configuration_model->getBinaryBonusDetails();
        $referal = $this->configuration_model->getReferalBonusDetails();
        $rank = $this->configuration_model->getRankBonusDetails();
        $other_bonuses = $this->configuration_model->getAllBonusDetails();
        $matrix_level = $this->configuration_model->getMatrixLevelBonusDetails();
        $unilevel = $this->configuration_model->getUniLevelBonusDetails();
        $matching_bonus_level = $this->configuration_model->getMatchingBonusDetails();

        $this->setData('binary', $binary);
        $this->setData('referal', $referal);
        $this->setData('ranks', $rank);
        $this->setData('other_bonuses', $other_bonuses);
        $this->setData('matrix_level_bonus', $matrix_level);
        $this->setData('unilevel_level_bonus', $unilevel);
        $this->setData('matching_bonus_level', $matching_bonus_level);
        $this->setData('matrix_level_bonus_type', $this->dbvars->MATRIX_LEVEL_BONUS_TYPE);
        $this->setData('unilevel_level_bonus_type', $this->dbvars->UNILEVEL_LEVEL_BONUS_TYPE);
        $this->setData('register_fee', $this->dbvars->ENTRI_FEE);
        $this->setData('maintanance_status', $this->dbvars->MAINTANANCE_STATUS);
        $this->setData('register_leg', $register_leg);
        $this->setData('matrix_depth', $matrix_depth);
        $this->setData('matrix_width', $matrix_width);
        $this->setData('register_type', $register_form_type);
        $this->setData('register_field_configuration', $register_field_configuration);
        $this->setData('payment_method', $payment_method);
        $this->setData('mlm_plan', $mlm_plan);
        $this->setData('username_type', $username_type);
        $this->setData('username_prefix', $username_prefix);
        $this->setData('username_size', $username_size);
        $this->setData('reg_packs', $reg_packs);
        $this->setData('payment_config', $payment_config);
        $this->setData('payout_setting', $payout_setting);
        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('tab4', $tab4);
        $this->setData('tab5', $tab5);
        $this->setData('tab6', $tab6);
        $this->setData('tab7', $tab7);
        $this->setData($this->session->userdata('plan_active_tab'), ' active');
        $this->setData('currency_symbol', $this->dbvars->DEFAULT_SYMBOL_LEFT . '' . $this->dbvars->DEFAULT_SYMBOL_RIGHT);
        $this->setData('title', lang('menu_name_32'));
        $this->setData('coin_payment_author', $coin_payment_author);
        $this->setData('coin_payment_merchant',  $coin_payment_merchant);
        $this->loadView();
    }

    /**
     * For Set the additional registration Fields
     * @author 2017-11-10
     * @param type $action
     * @param type $field_id
     */
    public function set_register_fields($action = '', $field_id = '') {
        $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();


        $error_array = $post = $post_data = array();
        if ($this->session->userdata('post_data') != null)
            $post_data = $this->session->userdata('post_data');
        if ($this->input->post('add_new') && $this->validate_reg_field()) {//add new fields
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $res = $this->configuration_model->createDbField($post['field_name'], $post['data_types'], $post['data_type_max_size']);
            if ($res) {
                $res = $this->configuration_model->addNewRegistrationField($post);
                if ($res) {
                    $this->helper_model->addNewLanguageField($log_user, $post['field_name'], $post['field_name_en']);
                    $this->helper_model->insertActivity($log_user, 'new_registration_field_added', $post);
                    $this->session->unset_userdata('post_data');
                    $this->loadPage(lang('new_field_added'), 'custom-field');
                } else {
                    $this->loadPage(lang('new_field_creation_failed'), 'custom-field', 'danger');
                }
            } else {
                $this->loadPage(lang('new_field_creation_failed'), 'custom-field', 'danger');
            }
        }

        if ($this->session->userdata('post_data') != null)
            $post_data = $this->session->userdata('post_data');

        $edit_status = FALSE;
        $editable_fields = array();
        if ($field_id && $action) {//update new fields
            if ($this->configuration_model->checkFieldEligibility($field_id)) {
                if ($action == 'activate') {
                    $actived_field['id'] = $field_id;
                    $res = $this->configuration_model->changeFieldStatus($field_id, 'active');
                    if ($res) {
                        $this->session->unset_userdata('post_data');
                        $this->helper_model->insertActivity($log_user, 'reg_field_activated', $actived_field);
                        $this->loadPage(lang('field_activated'), 'custom-field');
                    } else {
                        $this->loadPage(lang('field_activation_failed'), 'custom-field', 'danger');
                    }
                } elseif ($action == 'inactivate') {
                    $res = $this->configuration_model->changeFieldStatus($field_id, 'inactive');
                    if ($res) {
                        $this->session->unset_userdata('post_data');
                        $inactivated_data['id'] = $field_id;
                        $this->helper_model->insertActivity($log_user, 'reg_field_inactivated', $inactivated_data);
                        $this->loadPage(lang('field_inactivated'), 'custom-field');
                    } else {
                        $this->loadPage(lang('field_inactivation_failed'), 'custom-field', 'danger');
                    }
                } elseif ($action == 'delete') {

                    $res = $this->configuration_model->changeFieldStatus($field_id, 'deleted');
                    if ($res) {
                        $this->session->unset_userdata('post_data');
                        $deletedted_data['id'] = $field_id;
                        $this->helper_model->insertActivity($log_user, 'reg_field_deleted', $deletedted_data);
                        $this->loadPage(lang('field_deleted'), 'custom-field');
                    } else {
                        $this->loadPage(lang('field_deletion_failed'), 'custom-field', 'danger');
                    }
                } elseif ($action == 'edit') {
                    $edit_status = TRUE;
                    $post_data = $this->configuration_model->getRegFieldDetails($field_id);
                } else {
                    $this->loadPage(lang('invalid_action'), 'custom-field', 'danger');
                }
            } else {
                $this->loadPage(lang('this_cant_edit'), 'custom-field', 'danger');
            }
        }

        if ($this->input->post('update_field') && $this->validate_reg_field()) {//add new fields
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            if ($this->configuration_model->checkFieldEligibility($post['edited_field'])) {
                $old_name = $this->configuration_model->getFieldOldName($post['edited_field']);
                if ($this->configuration_model->checkTable($old_name)) {
                    $upd_res = $this->configuration_model->alterDbField($post['field_name'], $post['data_types'], $post['data_type_max_size'], $old_name);
                } else {
                    $upd_res = $this->configuration_model->createDbField($post['field_name'], $post['data_types'], $post['data_type_max_size']);
                }
                if ($upd_res) {
                    $res = $this->configuration_model->updateRegistrationField($post);
                    if ($res) {
                        if (lang($post['field_name_en']) == $post['field_name_en']) {
                            $this->helper_model->addNewLanguageField($log_user, $post['field_name'], $post['field_name_en']);
                        }
                        $this->helper_model->insertActivity($log_user, 'registration_field_updated', $post);
                        $this->session->unset_userdata('post_data');
                        $this->loadPage(lang('field_updated_successfully'), 'custom-field');
                    } else {
                        $this->loadPage(lang('field_updation_failed'), 'custom-field', 'danger');
                    }
                } else {
                    $this->loadPage(lang('field_updation_failed'), 'custom-field', 'danger');
                }
            } else {
                $this->loadPage(lang('this_cant_edit'), 'custom-field', 'danger');
            }
        }

        if ($this->input->post('update_cancel')) {//cancel updates
            $this->loadPage(lang('updation_canceled'), 'custom-field');
        }

        if ($this->dbvars->GOOGLE_TRANSLATOR_STATUS > 0) {
            $untranslated_fields = $this->configuration_model->getUntranslatedFields();
        } else {
            $untranslated_fields = 0;
        }

        $this->setData('untranslated_fields', $untranslated_fields);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('post_data', $post_data);
        $this->setData('edit_status', $edit_status);
        $this->setData('edited_field', $field_id);
        $this->setData('title', lang('menu_name_35'));
        $this->loadView();
    }

    /**
     * For author validate registration fileds
     * @author Techffodils Technologies LLP
     *
     * @return type
     */
    function validate_reg_field() {
        $this->session->set_userdata('post_data', $this->input->post());
        $this->form_validation->set_rules('field_name_en', lang('field_name'), 'required');
        $this->form_validation->set_rules('field_name', lang('field_name'), 'required|callback_validate_field_name|trim');
        $this->form_validation->set_rules('required_status', lang('required_status'), 'required');
        $this->form_validation->set_rules('register_step', lang('register_step'), 'required');
        $this->form_validation->set_rules('order', lang('order'), 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('unique_status', lang('unique_status'), 'required');
        $this->form_validation->set_rules('data_types', lang('data_types'), 'required');
        if ($this->input->post('data_types') != 'double' && $this->input->post('data_types') != 'text') {
            $this->form_validation->set_rules('data_type_max_size', lang('data_type_max_size'), 'required|numeric|greater_than[0]');
        }

        $this->form_validation->set_rules('field_type', lang('field_type'), 'required');
        if ($this->input->post('field_type') == 'radio') {
            $this->form_validation->set_rules('radio_value1', lang('radio_value1'), 'required');
            $this->form_validation->set_rules('radio_value2', lang('radio_value2'), 'required');
        }
        if ($this->input->post('field_type') == 'select_box') {
            $this->form_validation->set_rules('select_option1', lang('select_option1'), 'required');
            $this->form_validation->set_rules('select_option2', lang('select_option2'), 'required');
            $this->form_validation->set_rules('select_option3', lang('select_option3'), 'required');
            $this->form_validation->set_rules('select_option4', lang('select_option4'), 'required');
        }
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For valiidate registered field name
     * @author Techffodils Technologies LLP
     * @param type $field
     * @return boolean
     */
    function validate_field_name($field = '') {
        if ($field) {
            $flag = FALSE;
            $edit_id = $this->input->post('edited_field');
            if (!$this->configuration_model->checkField($field, $edit_id)) {
                if ($edit_id) {
                    $current_name = $this->configuration_model->getDbFieldName($edit_id);
                    if ($current_name == $field) {
                        $flag = TRUE;
                    } elseif (!$this->configuration_model->checkTable($field)) {
                        $flag = TRUE;
                    }
                } else {
                    if (!$this->configuration_model->checkTable($field)) {
                        $flag = TRUE;
                    }
                }
            }
            return $flag;
        } elseif ($this->input->get('field_name')) {
            $this->load->helper('security');
            $get = $this->security->xss_clean($this->input->get());

            $field = $get['field_name'];
            $edit_id = $get['edited_field'];
            if (!$this->configuration_model->checkField($field, $edit_id)) {
                if ($edit_id) {
                    $current_name = $this->configuration_model->getDbFieldName($edit_id);
                    if ($current_name == $field) {
                        echo 'yes';
                        exit();
                    } elseif (!$this->configuration_model->checkTable($field)) {
                        echo 'yes';
                        exit();
                    }
                } else {
                    if (!$this->configuration_model->checkTable($field)) {
                        echo 'yes';
                        exit();
                    }
                }
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For Validate filed
     * @author Techffodils Technologies LLP
     * @date 2017-12-12
     * @param type $field
     * @return boolean
     */
    function validate_field($field) {
        $flag = true;
        $edit_field = $this->input->post('edited_field');
        if ($this->configuration_model->checkField($field) || $this->configuration_model->checkTable($field)) {
            $flag = false;
        }
        return $flag;
    }

    /**
     * for validate update field
     * @author Techffodils Technologies LLP
     * @date 2017-12-13
     * @param type $field
     * @return boolean
     */
    function validate_field_update($field) {
        $flag = true;
        $edit_field = $this->input->post('edited_field');
        if ($this->configuration_model->checkUpdatingField($field, $edit_field)) {
            $flag = false;
        }
        return $flag;
    }

    /**
     * For Plan based bonus settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function binary_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['binary_bonus_type']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = $this->configuration_model->updateBinarySettings($post);
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'binary_bonus_settings_update', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For Update the registartion fee
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function change_reg_fee() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['register_fee'] >= 0) {
            $this->session->set_userdata('plan_active_tab', 'tab6');
            $this->dbvars->ENTRI_FEE = $post['register_fee'];
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'reg_amount_changed', $post);
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
    }

    /**
     * For Update the registartion fee
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function change_maintanance_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['status'] >= 0) {
            $this->session->set_userdata('plan_active_tab', 'tab7');
            $this->dbvars->MAINTANANCE_STATUS = $post['status'];
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'change_maintanance_status', $post);
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
    }

    /**
     * For Rank bonus Configuration
     * @author Techffodils Technologies LLP
     * @date 2017-12-20
     */
    function rank_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['inputs']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = 0;
            $data = explode(',', $post['inputs']);
            foreach ($data as $d) {
                $rank_bonus = explode(':', $d);
                if (count($rank_bonus) == 2) {
                    $rank_name = $rank_bonus[0];
                    $rank_bonus = $rank_bonus[1];
                    if ($rank_bonus >= 0) {
                        $res = $this->configuration_model->updateRankSettings($rank_name, $rank_bonus);
                    }
                }
            }

            if ($res) {
                $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($log_user, 'rank_bonus_settings_updated', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For configure the referral bonus
     * @author Techffodils Technologies LLP
     * @date 2017-12-22
     */
    function referal_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['referal_bonus_type']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = $this->configuration_model->updateReferalSettings($post);
            if ($res) {
                $this->helper_model->insertActivity($this->aauth->getId(), 'referal_bonus_settings_updated', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * for bank payment configuration
     * @author Techffodils Technologies LLP
     * @date 2017-12-24
     */
    function bank_payment_config() {
        $this->session->set_userdata('plan_active_tab', 'tab1');
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $res = $this->configuration_model->updateBankConfig($post);
        if ($res) {
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($log_user, 'bank_payment_config_update', $post);
            echo 'yes';
            exit;
        }

        echo 'no';
        exit;
    }

    /**
     * For Paypal Configuration
     * @author Techffofils Technologies LLP
     * @date 2017-12-24
     */
    function paypal_payment_config() {
        $this->session->set_userdata('plan_active_tab', 'tab1');
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $res = $this->configuration_model->updatePaypalConfig($post);
        if ($res) {
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($log_user, 'paypal_payment_config_update', $post);
            echo 'yes';
            exit;
        }

        echo 'no';
        exit;
    }

    /**
     * For matrix plan level bonuns Configuration/Settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-24
     */
    function matrix_level_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['inputs']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = 0;
            $data = explode(',', $post['inputs']);

            foreach ($data as $d) {
                $rank_bonus = explode(':', $d);
                if (count($rank_bonus) == 2) {
                    $key = $rank_bonus[0];
                    $value = $rank_bonus[1];
                    if ($key == 'matrix_level_bonus_type') {
                        $this->dbvars->MATRIX_LEVEL_BONUS_TYPE = $value;
                    } else {
                        $flag = 0;
                        $bonus_type = $this->dbvars->MATRIX_LEVEL_BONUS_TYPE;
                        if ($bonus_type == 'fixed') {
                            $flag = 1;
                        }
                        $res = $this->configuration_model->updateMatrixSettings($key, $value, $bonus_type, $flag);
                    }
                }
            }

            if ($res) {
                $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($log_user, 'matrix_level_bonus_settings_update', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For Uni-level bonus settings
     * @author Techffodils Technologies LLP
     * @author 2017-12-25
     */
    function unilevel_level_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['inputs']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = 0;
            $data = explode(',', $post['inputs']);
            foreach ($data as $d) {
                $rank_bonus = explode(':', $d);
                if (count($rank_bonus) == 2) {
                    $key = $rank_bonus[0];
                    $value = $rank_bonus[1];
                    if ($key == 'unilevel_level_bonus_type') {
                        $this->dbvars->UNILEVEL_LEVEL_BONUS_TYPE = $value;
                    } else {
                        $flag = 0;
                        $bonus_type = $this->dbvars->UNILEVEL_LEVEL_BONUS_TYPE;
                        if ($bonus_type == 'fixed') {
                            $flag = 1;
                        }
                        $res = $this->configuration_model->updateUnilevelSettings($key, $value, $bonus_type, $flag);
                    }
                }
            }

            if ($res) {
                $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($log_user, 'unilevel_level_bonus_settings_update', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For Change Bonus Status
     * @author Techffodils Technologies LLP
     * @date 2017-12-27
     */
    function change_bonus_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['bonus']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = $this->configuration_model->updateBonusStatus($post['bonus'], $post['status']);
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($log_user, 'change_bonus_status', $post);
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
    }

    /**
     * For change the bonus settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-27
     */
    function change_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['referal_bonus'] >= 0) {
            if ($this->dbvars->MLM_PLAN == "BINARY")
                $this->dbvars->PAIR_BONUS = $post['pair_bonus'];
            $this->dbvars->REFEAL_BONUS = $post['referal_bonus'];
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $res = $this->helper_model->insertActivity($log_user, 'change_bonus_settings', $post);
            if ($res) {
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For Username settings for example username static or dynamic
     * @author Techffodils Technologies LLP
     * @date 2017-12-27
     */
    function change_username_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['username_type'] && $post['username_size'] && $post['username_prefix']) {
            $this->session->set_userdata('plan_active_tab', 'tab3');
            $this->dbvars->USERNAME_TYPE = $post['username_type'];
            $this->dbvars->USERNAME_PREFIX = $post['username_prefix'];
            $this->dbvars->USERNAME_SIZE = $post['username_size'];
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $res = $this->helper_model->insertActivity($log_user, 'plan_settings_changed', $post);
            if ($res) {
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For setting up the binary level leg for example:- LEFT,RIGHT,DEFAULT
     * @author Techffodils Technologies LLP
     * @date 2017-12-27
     */
    function change_leg_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['register_leg']) {
            $this->session->set_userdata('plan_active_tab', 'tab6');
            //$this->dbvars->REGISTER_LEG = $post['register_leg'];
            //$user_id = $this->aauth->getId();
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $res = $this->helper_model->updateDefaultLeg($user_id, $post['register_leg']);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'change_leg_settings', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For getting the user tree leg
     * @author Techffodils Technologies LLP
     * @date 2017-12-28
     */
    function get_user_leg() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());


        $options = "<select class='form-control search-select' id='other_register_leg' name='other_register_leg'><option value=''>" . lang('select_leg') . "</option>";

        if ($this->input->get('username')) {
            $user_id = $this->helper_model->userNameToID($this->input->get('username'));
            $register_leg = $this->helper_model->getUserDefaultLeg($user_id);
            $static_status = $balanced_status = $left_status = $right_status = "";
            if ($register_leg == 'static') {
                $static_status = 'selected';
            }if ($register_leg == 'balanced') {
                $balanced_status = 'selected';
            }if ($register_leg == 'left') {
                $left_status = 'selected';
            }if ($register_leg == 'right') {
                $right_status = 'selected';
            }

            $options .= "<option value='static' $static_status >" . lang('static') . "</option>";
            $options .= "<option value='balanced' $balanced_status >" . lang('balanced') . "</option>";
            $options .= "<option value='left' $left_status >" . lang('left') . "</option>";
            $options .= "<option value='right' $right_status >" . lang('right') . "</option>";
        }
        $options .= "</select>";

        echo $options;exit();
    }

    /**
     * For setting up the registration LEG
     * @author Techffodils Tecnologies LLP
     * @date 2017-12-28
     */
    function change_other_leg_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['register_leg']) {
            $this->session->set_userdata('plan_active_tab', 'tab6');
            if ($post['other_username']) {
                $user = $this->helper_model->userNameToID($post['other_username']);
                if ($user) {
                    $res = $this->helper_model->updateDefaultLeg($user, $post['register_leg']);
                    if ($res) {
                        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                        $this->helper_model->insertActivity($user_id, 'change_other_leg_settings', $post);
                        echo 'yes';
                        exit;
                    }
                }
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For change the matrix settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function change_matrix_settings() {

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['matrix_width'] && $post['matrix_depth']) {
            $this->session->set_userdata('plan_active_tab', 'tab5');
            $this->dbvars->MATRIX_WIDTH = $post['matrix_width'];
            $this->dbvars->MATRIX_DEPTH = $post['matrix_depth'];
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $res = $this->helper_model->insertActivity($user_id, 'change_matrix_settings', $post);
            if ($res) {
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For change payment status
     * @author Techffodils Technologies LLP
     * @date 2017-12-28
     */
    function change_payment_status() {
        $this->session->set_userdata('plan_active_tab', 'tab1');
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $payment_code = $post['payment_code'];
        $status = $post['status'];
        if ($payment_code && $status) {
            $res = $this->configuration_model->changePaymentStatus($payment_code, $status);
            if ($res) {
                $post['code'] = $payment_code;
                $post['status'] = $status;
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'change_payment_status', $post);

                echo 'yes';
                exit;
            }
        }
        echo 'no';
    }

    /**
     * For change Payout Payment Status
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function change_payout_payment_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $payment_code = $post['payment_code'];
        $status = $post['status'];
        if ($payment_code && $status) {
            $this->session->set_userdata('plan_active_tab', 'tab5');
            $res = $this->configuration_model->changePayoutPaymentStatus($payment_code, $status);
            if ($res) {
                $post['code'] = $payment_code;
                $post['payout_status'] = $status;
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'change_payout_payment_status', $post);

                echo 'yes';
                exit;
            }
        }
        echo 'no';
    }

    function change_reg_field_status() {
        $this->session->set_userdata('plan_active_tab', 'tab4');

        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $status = $post['status'];
        if ($status == 'active' || $status == 'inactive') {
            $this->dbvars->REGISTER_FIELD_CONFIGURATION = $status;
            $post['status'] = $status;
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'changed_reg_field_status', $post);

            echo 'yes';
            exit;
        }
        echo 'no';
    }

    /**
     * For Change the register form type For Example:-Single step,Multiple Step
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function change_register_form_type() {
        $this->session->set_userdata('plan_active_tab', 'tab4');
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $status = $post['status'];
        if ($status == 'single' || $status == 'multiple') {
            $this->dbvars->REGISTER_FORM_TYPE = $status;
            $post['status'] = $status;
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'changed_register_form_type', $post);
            echo 'yes';
            exit;
        }
        echo 'no';
    }

    /**
     * For multiple option enabling For Example:-Currency enabling,Language enabling,etc...
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    public function multiple_options() {
        $error_array = $post = array();
        $langs = $this->configuration_model->getLanguages();
        $curns = $this->configuration_model->getCurrencies();
        $default_currency = $this->dbvars->DEFAULT_CURRENCY_CODE;
        $default_language = $this->dbvars->LANG_CODE;
        $default_currency_symbol = $this->configuration_model->getCurrencySymbol($default_currency);

        $multi_lang = $this->dbvars->MULTI_LANG_STATUS;
        $multi_cur = $this->dbvars->MULTI_CURRENCY_STATUS;
        if ($this->input->post('crncy_settings')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = 0;
            foreach ($curns as $c) {
                if (isset($post['crncy_' . $c['id']])) {
                    if ($post['crncy_' . $c['id']] > 0) {
                        $res = $this->configuration_model->updateCrncyRation($c['id'], $post['crncy_' . $c['id']]);
                    }
                }
            }
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'crncy_value_changed', $post);
                $this->helper_model->insertTodayCurrencyValues();
                $this->loadPage(lang('crncy_value_changed'), 'configuration/multiple_options');
            } else {
                $this->loadPage(lang('failed_crncy_value_changed'), 'configuration/multiple_options', 'danger');
            }
        }
        $this->setData('default_currency', $default_currency);
        $this->setData('default_language', $default_language);
        $this->setData('default_currency_symbol', $default_currency_symbol);
        $this->setData('langs', $langs);
        $this->setData('curns', $curns);
        $this->setData('def_lang', $this->dbvars->LANG_NAME);
        $this->setData('def_curr', $this->dbvars->DEFAULT_CURRENCY_NAME);
        $this->setData('multi_lang', $multi_lang);
        $this->setData('multi_cur', $multi_cur);
        $this->setData('title', lang('menu_name_33'));
        $this->loadView();
    }

    /**
     * for setting the Language status
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    public function change_language_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $lang_id = $post['lang_id'];
        $status = $post['status'];
        if ($lang_id && $status) {
            $flag = 0;
            if ($status == 'active')
                $flag = 1;
            if ($this->configuration_model->changeLanguageStatus($lang_id, $flag)) {
                $post['lang_id'] = $lang_id;
                $post['status'] = $flag;
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'change_language_status', $post);
                $this->languageDetailsInitialize(1);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
    }

    /**
     * for Currency status enabling
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    public function change_currency_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        $currency_id = $post['currency_id'];
        $status = $post['status'];
        if ($currency_id && $status) {
            $flag = 0;
            if ($status == 'active')
                $flag = 1;
            if ($this->configuration_model->changeCurrencyStatus($currency_id, $flag)) {
                $post['currency_id'] = $currency_id;
                $post['status'] = $flag;
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'change_currency_status', $post);
                $this->currencyDetailsInitialize(1);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
    }

    /**
     * For change the payout autmatic status
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function change_payout_automatic_status() {
        $status = $this->input->get('status');
        if ($status != '') {
            $result = $this->configuration_model->updatePayoutAutomaticStatus($status);
            if ($result) {
                $permision = 1;
                if ($status == 'active') {
                    $permision = 0;
                }
                $this->configuration_model->changeMenuPermission('withdraw-request',$permision);
                echo 'yes';
                exit();
            } else {
                echo 'no';
                exit();
            }
        } else {
            echo 'no';
            exit();
        }
    }

    /**
     * For registration pack status
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function change_reg_pack_status() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());

        if ($get['status']) {
            $this->session->set_userdata('plan_active_tab', 'tab4');
            if ($get['status'] == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }
            $this->dbvars->REGISTER_PACKAGE = $status;
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'change_reg_pack_status', $get);
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
    }

    /**
     * for change the registration Type
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function change_register_type() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());

        if ($get['register_type']) {
            $this->session->set_userdata('plan_active_tab', 'tab4');
            $this->dbvars->REGISTER_FORM_TYPE = $get['register_type'];
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'change_register_type', $get);
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
    }

    /**
     * For matching bonus settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function matching_bonus_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['inputs']) {
            $this->session->set_userdata('plan_active_tab', 'tab2');
            $res = 0;
            $data = explode(',', $post['inputs']);
            foreach ($data as $d) {
                $rank_bonus = explode(':', $d);
                if (count($rank_bonus) == 2) {
                    $name = $rank_bonus[0];
                    $bonus = $rank_bonus[1];
                    if ($bonus >= 0) {
                        $res = $this->configuration_model->updateMatchingSettings($name, $bonus);
                    }
                }
            }

            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'matching_bonus_settings_updated', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For Payout settings
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function payout_setting() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $res = $this->configuration_model->updatePayoutSetting($post);
        if ($res) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'change_payout_setting', $post);
            echo 'yes';
            exit;
        }

        echo 'no';
        exit;
    }

    /**
     * For Updating the terms and conditions for the given software
     * @author Techffodils Technologies LLP
     * @date 2017-01-04
     * @license http://URL name
     *
     */
    function terms_and_condition() {
        $this->setData('title', lang('menu_name_116'));

        $content_id = $this->input->post('update_mail_content') ? $this->input->post('update_mail_content') : 0;
        $type = $this->input->post('type') ? $this->input->post('type') : 0;
        if ($this->input->post('update_mail_content') && $this->validate_mail_contents($content_id,$type)) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $result = $this->configuration_model->updateMailContent($content_id, $post);
            if ($result) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, $type . '_updated', $post);
                $this->loadPage(lang($type . '_updated_successfully'), 'terms-condition');
            } else {
                $this->loadPage(lang('failed_' . $type . '_update'), 'terms-condition', 'danger');
            }
        }
        $this->load->model('site_management_model');

        $all_lang = $this->site_management_model->getAllActiveLangauges();

        $sys_mails = $this->configuration_model->getAllSystemMails($all_lang);

        $this->setData('error', $this->form_validation->error_array());
        $this->setData('content_id', $content_id);
        $this->setData('type', $type);
        $this->setData('sys_mails', $sys_mails);
        $this->setData('all_lang', $all_lang);

        $this->loadView();
    }

    /**
     * for validate the mail contents
     * @param type $content_id
     * @param type $type
     * @return type
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function validate_mail_contents($content_id,$type) {
        $this->session->set_userdata('active_mail_content_tab', $content_id);
        $this->session->set_userdata('active_mail_content_type', $type);

        $this->form_validation->set_rules('mail_content', lang('mail_content'), 'required');
        $form_result = $this->form_validation->run();
        return $form_result;
    }

    /**
     * For register field listing
     * @author Techffodils Technologies LLP
     * @date 2017-12-29
     */
    function reg_field_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'register_fields';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'field_name',
            'status',
            'required_status',
            'unique_status',
            'register_step',
            '`order`',
            'default_value',
            'editable_status',
        );
        $column = $this->configuration_model->getTableColumnRegFieldList();
        $total_records = $this->configuration_model->countOfRegFieldList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->configuration_model->getTotalFilteredRegFieldList($table, $where);
        $res_data = $this->configuration_model->getResultDataRegFieldList($table, $columns, $where, $order, $limit);

        $this->lang->load('register');

        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][1] = lang($res_data[$i][1]);
            if ($res_data[$i][3]) {
                $res_data[$i][3] = lang('yes');
            } else {
                $res_data[$i][3] = lang('no');
            }
            if ($res_data[$i][4]) {
                $res_data[$i][4] = lang('yes');
            } else {
                $res_data[$i][4] = lang('no');
            }
            if ($res_data[$i][8]) {
                if ($res_data[$i][2] == 'active') {
                    $res_data[$i][8] = '<a href="javascript:edit_field(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_field(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_field(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
                } else {
                    $res_data[$i][8] = '<a href="javascript:edit_field(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activate_field(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_field(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
                }
            } else {
                $res_data[$i][8] = lang('no_access');
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
     * For Paypal Prodution status
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function change_paypal_production_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        $payment_code = $post['payment_code'];
        $status = $post['status'];
        if ($payment_code) {
            $res = $this->configuration_model->changePaypalProductionStatus($payment_code, $status);
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'paypal_producton_mode_changed', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    /**
     * For update the block-chain credentials
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function update_blockchain_credentials() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post) {
            $res = $this->configuration_model->updateBlocktrailCredentials($post);
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'blocktrail_credential_updated', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    function change_payout_day() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['status'] >= 0) {
            $res = $this->configuration_model->updatePayoutDayStatus($post['week_day'], $post['status']);
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $this->helper_model->insertActivity($user_id, 'payout_days_changed', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    
   function coin_payment_config() {
       $this->session->set_userdata('plan_active_tab', 'tab1');
       $this->load->helper('security');
       $post = $this->security->xss_clean($this->input->get());
        $res = $this->dbvars->COINPAYMENT_AUTHOR =  $post['coin_payment_author'];
        $res1 = $this->dbvars->COINPAYMENT_MERCHANT = $post['coin_payment_merchant'];
        if ($res && $res1) {
 
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($log_user, 'coin_payment_config_update', $post);
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
       
   }
}
