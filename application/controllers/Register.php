<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

use Omnipay\Omnipay;
//use Blocktrail\SDK\BlocktrailSDK;
use Jimmerioles\BitcoinCurrencyConverter\Converter;

/**
 * Base Controller
 *
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Register extends Base_Controller {

    /**
     * For registration package
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $encoded_data
     */
    public function packages($encoded_data = '', $leg = '', $tree_reg = '') {
        $reg_pack_status = $this->dbvars->REGISTER_PACKAGE;

        if (!$reg_pack_status) {
            $this->loadPage('', $this->dbvars->REG_MODE);
        }
        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();
        $reg_pack = 0;
        if ($this->session->userdata('reg_pack') != null)
            $reg_pack = $this->session->userdata('reg_pack');
        $products = $this->register_model->getAllProducts();

        $this->setData('basic_flag', $this->dbvars->BASIC_FLAG);
        $this->setData('product_id', $reg_pack);
        $this->setData('products', $products);
        $this->setData('user_type', $user_type);
        $this->setData('title', lang('menu_name_3'));
        $this->setData('encode_id', $encoded_data);
        $this->setData('encode_leg', $leg);
        $this->setData('tree_reg', $tree_reg);
        $this->loadView();
    }

    /**
     * For checking registration package
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     */
    public function check_reg_pack() {

        $reg_pack = 0;
        if ($this->session->userdata('reg_pack') != null)
            $reg_pack = $this->session->userdata('reg_pack');
        if ($this->register_model->checkRegProduct($reg_pack)) {
            $encode_id = $this->input->post('encodeid');
            $encode_leg = $this->input->post('encode_leg');
            if ($encode_id) {
                $reg_url = 'register/' . $this->dbvars->REGISTER_FORM_TYPE . '/' . $encode_id . '/' . $encode_leg;
            } else {
                $reg_url = 'register/' . $this->dbvars->REGISTER_FORM_TYPE;
            }
            echo $reg_url;
            exit();
        }
        echo 'no';
        exit();
    }

    /**
     * For single step registration
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologiesa
     * @param string $encoded_data
     */
    public function single_step($encoded_data = '', $automatic_leg = '', $tree_reg = '') {
        $register_data = array();
        $reg_pack_status = $this->dbvars->REGISTER_PACKAGE;
        $product_id = $pro_amount = $delivery_charge = $shipping_charge = $tax = 0;
        $url = 'enroll';
        if ($reg_pack_status) {
            $url = 'packages';
            $reg_pack = 0;
            if ($this->session->userdata('reg_pack') != null)
                $reg_pack = $this->session->userdata('reg_pack');
            if ($this->register_model->checkRegProduct($reg_pack)) {
                $product_id = $reg_pack;

                $pro_amount = $this->register_model->getRegProductAmount($product_id);
                $delivery_charge = $this->dbvars->DELIVARY_CHARGE;
                $shipping_charge = $this->dbvars->SHIPPING_CHARGE;
                $tax = $this->dbvars->PURCHASE_TAX;
            } else {
                $this->loadPage(lang('please_select_a_pack'), 'packages', 'warning');
            }
        }
        $entree_fee = $this->dbvars->ENTRI_FEE;
        $package_amount = $pro_amount + $delivery_charge + $shipping_charge + $tax;
        $total_amount = $entree_fee + $package_amount;

        $total_amount_data = array('entree_fee' => $entree_fee, 'pro_amount' => $pro_amount, 'delivery_charge' => $delivery_charge, 'shipping_charge' => $shipping_charge, 'tax' => $tax);

        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $leg_type = $this->dbvars->REGISTER_LEG;
        $username_type = $this->dbvars->USERNAME_TYPE;
        $username_size = $this->dbvars->USERNAME_SIZE;
        $logged_username = $this->aauth->getUserName();
        $placement_username = '';
        if ($encoded_data) {
            $decode_id = $this->helper_model->decode($encoded_data);
            $decode_name = $this->helper_model->IdToUserName($decode_id);
            if ($decode_name) {
                if ($tree_reg && $this->dbvars->REG_FROM_TREE_STATUS) {
                    $placement_username = $decode_name;
                } else {
                    $logged_username = $decode_name;
                }
            }
        } else {
            if (!$logged_username) {
                $logged_username = $this->helper_model->getAdminUsername();
            }
        }
        $leg_status = FALSE;
        if ($mlm_plan == 'BINARY') {
            $leg_status = TRUE;
        }
        if ($this->input->post('add_user') && $this->validate_registration('single_step', $leg_status, $username_type)) {
            $this->load->helper('security');
            $user_details = $this->security->xss_clean($this->input->post());

            $user_details['date_of_joining'] = date('Y-m-d H:i:s');
            $user_details['register_type'] = 'single_step';
            if ($username_type == 'dynamic') {
                $user_details['username'] = $this->register_model->generateRandomUsername($username_size);
            }
            $payment_method = $user_details['add_user'];
            $user_details['payment_method'] = $payment_method;
            $user_details['reg_amount'] = $total_amount;
            $user_details['order_amount'] = $package_amount;
            $user_details['total_amount_data'] = $total_amount_data;
            $user_details['placement_username'] = $placement_username;

            $payment_status = FALSE;
            if ($payment_method == "free_registration") {
                if (!$this->helper_model->getPaymentMethodStatus('free_registration')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $payment_status = TRUE; //for testing purpose only
            } elseif ($payment_method == "bank_transfer") {
                if (!$this->helper_model->getPaymentMethodStatus('bank_transfer')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'single_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id);
                if ($pending) {
                    $this->helper_model->insertActivity($logged_user, 'pending_registration', $user_details);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('single_step_post');
                    $encode_id = $this->helper_model->encode($pending);
                    $this->session->set_userdata('pending_preview_user', $pending);
                    $this->loadPage(lang('pending_registration_msg'), 'pending-preview/' . $encode_id);
                } else {
                    $this->loadPage(lang('pending_register_failed'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "ewallet") {
                if (!$this->helper_model->getPaymentMethodStatus('ewallet')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $wallet_username = $user_details['wallet_username'];
                $transaction_password = $user_details['transaction_password'];
                if ($this->register_model->validateuserTransaction($wallet_username, $transaction_password, $total_amount)) {
                    $payment_status = TRUE;
                } else {
                    $this->loadPage(lang('invalid_transaction_details'), $url, 'danger');
                }
            } elseif ($payment_method == "epin") {
                if (!$this->helper_model->getPaymentMethodStatus('epin')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }

                if (!empty($user_details['epin']) && $this->validate_epin()) {
                    $sponsor_user = $this->helper_model->userNameToID($user_details['sponser_name']);

                    $status = $this->register_model->checkEpinDataValidOrNot($user_details['epin'], $sponsor_user);
                    if ($status) {
                        $payment_status = TRUE;
                        $order_status = 1;
                    } else {
                        $this->loadPage(lang('invalid_epin_details'), $url, 'danger');
                    }
                } else {
                    $this->loadPage(lang('please_enter_epins'), $url, 'danger');
                }
            } elseif ($payment_method == "paypal") {
                if (!$this->helper_model->getPaymentMethodStatus('paypal')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'single_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('single_step_post');
                    $this->loadPage('', 'paypal-register/' . $pending_encode_id);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "coinpayments") {
                if (!$this->helper_model->getPaymentMethodStatus('coinpayments')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'single_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('single_step_post');

                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('single_step_post');

                    $first_name = $user_details['first_name'];
                    $last_name = $user_details['last_name'];
                    $email_id = $user_details['email'];
                    $url = 'https://www.coinpayments.net/index.php';

                    $coin_data = array();
                    $coin_data['cmd'] = '_pay';
                    $coin_data['reset'] = 1;
                    $coin_data['merchant'] = $this->dbvars->COINPAYMENT_MERCHANT;
                    $coin_data['item_name'] = 'For Registration';
                    $coin_data['amountf'] = $total_amount;
                    $coin_data['shippingf'] = 0.00;
                    $coin_data['taxf'] = 0.00;
                    $coin_data['want_shipping'] = 0;
                    $coin_data['currency'] = 'USD';
                    $coin_data['first_name'] = $first_name;
                    $coin_data['last_name'] = $last_name;
                    $coin_data['email'] = $email_id;
                    $coin_data['invoice'] = $pending;
                    $coin_data['success_url'] = BASE_PATH . 'register/coin_success/' . $pending_encode_id;
                    $coin_data['ipn_url'] = BASE_PATH . 'register/ipn_check';
                    $coin_data['cancel_url'] = BASE_PATH . 'register/coin_cancel';
                    $coin_data['author'] = $this->dbvars->COINPAYMENT_AUTHOR;
                    $url .= '?' . http_build_query($coin_data);
                    header('Location:' . $url);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            }

            if ($payment_status) {
                $user_res = $this->register_model->addUser('single_step', $user_details, $mlm_plan, $product_id);
                if ($user_res) {
                    if ($payment_method == "ewallet") {
                        $wallet_user = $this->helper_model->userNameToID($wallet_username);
                        $res = $this->helper_model->insertWalletDetails($wallet_user, 'debit', $total_amount, 'register_user', 0, $logged_user, $user_res['new_user']);
                    } else if ($payment_method == 'epin') {
                        $sponsor_user = $this->helper_model->userNameToID($user_details['sponser_name']);
                        $result = $this->register_model->checkEpinData($user_details['epin'], $total_amount, $sponsor_user);
                    }
                    $this->helper_model->insertActivity($logged_user, 'user_registrered', $user_res);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('single_step_post');

                    $encode_id = $this->helper_model->encode($user_res['new_user']);
                    $this->session->set_userdata('preview_user', $user_res['new_user']);
                    $this->loadPage(lang('register_success'), 'register-preview/' . $encode_id);
                } else {
                    $this->loadPage(lang('register_failed'), $url, 'danger');
                }
            } else {
                $this->loadPage(lang('payment_failed'), $url, 'danger');
            }
        }

        $register_data['sponser_name'] = $logged_username;
        if ($this->session->userdata('single_step_post') != null)
            $register_data = $this->session->userdata('single_step_post');

        $register_data['register_leg'] = $automatic_leg;
        $country = '';
        if (isset($register_data['country'])) {
            $country = $register_data['country'];
        }
        $countries = $this->helper_model->getAllCountries();
        $states = $this->helper_model->getAllStates($country);
        $free_registration = $this->helper_model->getPaymentMethodStatus('free_registration');
        $bank_transfer = $this->helper_model->getPaymentMethodStatus('bank_transfer');
        $ewallet = $this->helper_model->getPaymentMethodStatus('ewallet');
        $epin = $this->helper_model->getPaymentMethodStatus('epin');
        $paypal = $this->helper_model->getPaymentMethodStatus('paypal');
        //$blocktrail = $this->helper_model->getPaymentMethodStatus('blocktrail');
        $coinpayments = $this->helper_model->getPaymentMethodStatus('coinpayments');
        $free_registration_tab = $bank_transfer_tab = $ewallet_tab = $epin_tab = $paypal_tab = $blocktrail_tab = $coinpayments_tab = '';
        if ($free_registration) {
            $free_registration_tab = " active";
        } elseif ($bank_transfer) {
            $bank_transfer_tab = " active";
        } elseif ($ewallet) {
            $ewallet_tab = " active";
        } elseif ($epin) {
            $epin_tab = " active";
        } elseif ($paypal) {
            $paypal_tab = " active";
        } elseif ($coinpayments) {
            $coinpayments_tab = " active";
        }

        $company_bank_details=array();
        if ($bank_transfer) {
            $company_bank_details = $this->helper_model->getCompanyBankDetail();
        }
        
        $this->setData('company_bank_details', $company_bank_details);
        $this->setData('free_registration', $free_registration);
        $this->setData('bank_transfer', $bank_transfer);
        $this->setData('ewallet', $ewallet);
        $this->setData('epin', $epin);
        $this->setData('paypal', $paypal);
        //$this->setData('blocktrail', $blocktrail);
        $this->setData('coinpayments', $coinpayments);
        $this->setData('free_registration_tab', $free_registration_tab);
        $this->setData('bank_transfer_tab', $bank_transfer_tab);
        $this->setData('ewallet_tab', $ewallet_tab);
        $this->setData('epin_tab', $epin_tab);
        $this->setData('paypal_tab', $paypal_tab);
        //$this->setData('blocktrail_tab', $blocktrail_tab);
        $this->setData('coinpayments_tab', $coinpayments_tab);
        if ($this->aauth->is_loggedin()) {

            $lang_id = $this->helper_model->getUserLang($logged_user);
        } else {
            if (!empty($this->main->get_usersession('mlm_data_language', 'lang_code'))) {
                $lang_id = $this->helper_model->getLangNameToId($this->main->get_usersession('mlm_data_language', 'lang_code'));
            }
            $lang_id = $this->dbvars->LANG_ID;
        }

        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();
        $this->setData('user_type', $user_type);
        $this->setData('terms_and_condition', $this->helper_model->getTermsAndCondition($lang_id));
        $this->setData('privacy_policy', $this->helper_model->getPrivacyPolicy($lang_id));
        $this->setData('entry_fee', $this->dbvars->ENTRI_FEE);
        $this->setData('total_amount', $total_amount);
        $this->setData('pro_amount', $pro_amount);
        $this->setData('delivery_charge', $delivery_charge);
        $this->setData('shipping_charge', $shipping_charge);
        $this->setData('tax', $tax);
        $this->setData('package_amount', $package_amount);
        $this->setData('total_amount', $total_amount);
        $this->setData('username_type', $username_type);
        $this->setData('username_size', $username_size);
        $this->setData('states', $states);
        $this->setData('countries', $countries);
        $this->setData('leg_status', $leg_status);
        $this->setData('register_data', $register_data);
        $this->setData('register_error', $this->form_validation->error_array());
        $this->setData('logged_user', $logged_user);
        $this->setData('tree_reg', $tree_reg);
        $this->setData('placement_username', $placement_username);
        $this->setData('title', lang('menu_name_29'));
        $this->loadView();
    }

    /**
     * For Multi step registration
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $encoded_data
     */
    public function multiple_step($encoded_data = '', $automatic_leg = '', $tree_reg = '') {
        $register_data = array();

        $reg_pack_status = $this->dbvars->REGISTER_PACKAGE;
        $package_flag = TRUE;
        $product_id = $pro_amount = $delivery_charge = $shipping_charge = $tax = 0;
        $url = 'enroll-multi';
        if ($reg_pack_status) {
            $url = 'packages';
            $reg_pack = 0;
            if ($this->session->userdata('reg_pack') != null)
                $reg_pack = $this->session->userdata('reg_pack');
            if ($this->register_model->checkRegProduct($reg_pack)) {
                $product_id = $reg_pack;

                $pro_amount = $this->register_model->getRegProductAmount($product_id);
                $delivery_charge = $this->dbvars->DELIVARY_CHARGE;
                $shipping_charge = $this->dbvars->SHIPPING_CHARGE;
                $tax = $this->dbvars->PURCHASE_TAX;
            } else {
                $this->loadPage(lang('please_select_a_pack'), 'packages', 'warning');
            }
        }
        $entree_fee = $this->dbvars->ENTRI_FEE;
        $package_amount = $pro_amount + $delivery_charge + $shipping_charge + $tax;
        $total_amount = $entree_fee + $package_amount;

        $total_amount_data = array('entree_fee' => $entree_fee, 'pro_amount' => $pro_amount, 'delivery_charge' => $delivery_charge, 'shipping_charge' => $shipping_charge, 'tax' => $tax);


        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $leg_type = $this->dbvars->REGISTER_LEG;
        $username_type = $this->dbvars->USERNAME_TYPE;
        $username_size = $this->dbvars->USERNAME_SIZE;
        $logged_username = $this->aauth->getUserName();
        $placement_username = '';
        if ($encoded_data) {
            $decode_id = $this->helper_model->decode($encoded_data);
            $decode_name = $this->helper_model->IdToUserName($decode_id);
            if ($decode_name) {
                if ($tree_reg && $this->dbvars->REG_FROM_TREE_STATUS) {
                    $placement_username = $decode_name;
                } else {
                    $logged_username = $decode_name;
                }
            }
        } else {
            if (!$logged_username) {
                $logged_username = $this->helper_model->getAdminUsername();
            }
        }
        $leg_status = FALSE;
        if ($mlm_plan == 'BINARY') {
            $leg_status = TRUE;
        }
        if ($this->input->post('add_user') && $this->validate_registration('multiple_step', $leg_status, $username_type)) {
            $this->load->helper('security');
            $user_details = $this->security->xss_clean($this->input->post());

            $user_details['date_of_joining'] = date('Y-m-d H:i:s');
            $user_details['register_type'] = 'multiple_step';
            if ($username_type == 'dynamic') {
                $user_details['username'] = $this->register_model->generateRandomUsername($username_size);
            }

            $payment_method = $user_details['add_user'];
            $user_details['payment_method'] = $payment_method;
            $user_details['reg_amount'] = $total_amount;
            $user_details['order_amount'] = $package_amount;
            $user_details['total_amount_data'] = $total_amount_data;
            $user_details['placement_username'] = $placement_username;
            if ($payment_method == "free_registration") {
                if (!$this->helper_model->getPaymentMethodStatus('free_registration')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $payment_status = TRUE; //for testing purpose only
            } elseif ($payment_method == "bank_transfer") {
                if (!$this->helper_model->getPaymentMethodStatus('bank_transfer')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'multiple_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id);
                if ($pending) {
                    $this->helper_model->insertActivity($logged_user, 'pending_registration', $user_details);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('multiple_step_post');
                    $encode_id = $this->helper_model->encode($pending);
                    $this->session->set_userdata('pending_preview_user', $pending);
                    $this->loadPage(lang('pending_registration_msg'), 'pending-preview/' . $encode_id);
                } else {
                    $this->loadPage(lang('pending_register_failed'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "ewallet") {
                if (!$this->helper_model->getPaymentMethodStatus('ewallet')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $wallet_username = $user_details['wallet_username'];
                $transaction_password = $user_details['transaction_password'];
                if ($this->register_model->validateuserTransaction($wallet_username, $transaction_password, $total_amount)) {
                    $payment_status = TRUE;
                } else {
                    $this->loadPage(lang('invalid_transaction_details'), $url, 'danger');
                }
            } elseif ($payment_method == "epin") {
                if (!$this->helper_model->getPaymentMethodStatus('epin')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }

                if (!empty($user_details['epin']) && $this->validate_epin()) {
                    $sponsor_user = $this->helper_model->userNameToID($user_details['sponser_name']);

                    $status = $this->register_model->checkEpinDataValidOrNot($user_details['epin'], $sponsor_user);
                    if ($status) {
                        $payment_status = TRUE;
                        $order_status = 1;
                    } else {
                        $this->loadPage(lang('invalid_epin_details'), $url, 'danger');
                    }
                } else {
                    $this->loadPage(lang('please_enter_epins'), $url, 'danger');
                }
            } elseif ($payment_method == "paypal") {
                if (!$this->helper_model->getPaymentMethodStatus('paypal')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'multiple_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('multiple_step_post');
                    $this->loadPage('', 'paypal-register/' . $pending_encode_id);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "blocktrail") {
                if (!$this->helper_model->getPaymentMethodStatus('blocktrail')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'multiple_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('multiple_step_post');
                    $this->loadPage('', 'blocktrail-register/' . $pending_encode_id);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "coinpayments") {
                if (!$this->helper_model->getPaymentMethodStatus('coinpayments')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'multiple_step', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('multiple_step_post');

                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('single_step_post');

                    $first_name = $user_details['first_name'];
                    $last_name = $user_details['last_name'];
                    $email_id = $user_details['email'];
                    $url = 'https://www.coinpayments.net/index.php';

                    $coin_data = array();
                    $coin_data['cmd'] = '_pay';
                    $coin_data['reset'] = 1;
                    $coin_data['merchant'] = $this->dbvars->COINPAYMENT_MERCHANT;
                    $coin_data['item_name'] = 'For Registration';
                    $coin_data['amountf'] = $total_amount;
                    $coin_data['shippingf'] = 0.00;
                    $coin_data['taxf'] = 0.00;
                    $coin_data['want_shipping'] = 0;
                    $coin_data['currency'] = 'USD';
                    $coin_data['first_name'] = $first_name;
                    $coin_data['last_name'] = $last_name;
                    $coin_data['email'] = $email_id;
                    $coin_data['invoice'] = $pending;
                    $coin_data['success_url'] = BASE_PATH . 'register/coin_success/' . $pending_encode_id;
                    $coin_data['ipn_url'] = BASE_PATH . 'register/ipn_check';
                    $coin_data['cancel_url'] = BASE_PATH . 'register/coin_cancel';
                    $coin_data['author'] = $this->dbvars->COINPAYMENT_AUTHOR;
                    $url .= '?' . http_build_query($coin_data);
                    header('Location:' . $url);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            }

            if ($payment_status) {
                $user_res = $this->register_model->addUser('multiple_step', $user_details, $mlm_plan, $product_id);
                if ($user_res) {
                    if ($payment_method == "ewallet") {
                        $wallet_user = $this->helper_model->userNameToID($wallet_username);
                        $res = $this->helper_model->insertWalletDetails($wallet_user, 'debit', $total_amount, 'register_user', 0, $logged_user, $user_res['new_user']);
                    } elseif ($payment_method == 'epin') {
                        $sponsor_user = $this->helper_model->userNameToID($user_details['sponser_name']);
                        $result = $this->register_model->checkEpinData($user_details['epin'], $total_amount, $sponsor_user);
                    }
                    $this->helper_model->insertActivity($logged_user, 'user_registrered', $user_res);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('multiple_step_post');

                    $encode_id = $this->helper_model->encode($user_res['new_user']);
                    $this->session->set_userdata('preview_user', $user_res['new_user']);
                    $this->loadPage(lang('register_success'), 'register-preview/' . $encode_id);
                } else {
                    $this->loadPage(lang('register_failed'), $url, 'danger');
                }
            } else {
                $this->loadPage(lang('payment_failed'), $url, 'danger');
            }
        }
        $register_data['sponser_name'] = $logged_username;
        if ($this->session->userdata('multiple_step_post') != null)
            $register_data = $this->session->userdata('multiple_step_post');

        $register_data['register_leg'] = $automatic_leg;
        $country = '';
        if (isset($register_data['country'])) {
            $country = $register_data['country'];
        }
        $countries = $this->helper_model->getAllCountries();
        $states = $this->helper_model->getAllStates($country);
        $free_registration = $this->helper_model->getPaymentMethodStatus('free_registration');
        $bank_transfer = $this->helper_model->getPaymentMethodStatus('bank_transfer');
        $ewallet = $this->helper_model->getPaymentMethodStatus('ewallet');
        $epin = $this->helper_model->getPaymentMethodStatus('epin');
        $paypal = $this->helper_model->getPaymentMethodStatus('paypal');
        //$blocktrail = $this->helper_model->getPaymentMethodStatus('blocktrail');
        $coinpayments = $this->helper_model->getPaymentMethodStatus('coinpayments');
        $free_registration_tab = $bank_transfer_tab = $ewallet_tab = $epin_tab = $paypal_tab = $blocktrail_tab = $coinpayments_tab = '';
        if ($free_registration) {
            $free_registration_tab = " active";
        } elseif ($bank_transfer) {
            $bank_transfer_tab = " active";
        } elseif ($ewallet) {
            $ewallet_tab = " active";
        } elseif ($epin) {
            $epin_tab = " active";
        } elseif ($paypal) {
            $paypal_tab = " active";
        } elseif ($coinpayments) {
            $coinpayments_tab = " active";
        }
        
        $company_bank_details=array();
        if ($bank_transfer) {
            $company_bank_details = $this->helper_model->getCompanyBankDetail();
        }
        
        $this->setData('company_bank_details', $company_bank_details);
        $this->setData('free_registration', $free_registration);
        $this->setData('bank_transfer', $bank_transfer);
        $this->setData('ewallet', $ewallet);
        $this->setData('epin', $epin);
        $this->setData('paypal', $paypal);
        //$this->setData('blocktrail', $blocktrail);
        $this->setData('coinpayments', $coinpayments);
        $this->setData('free_registration_tab', $free_registration_tab);
        $this->setData('bank_transfer_tab', $bank_transfer_tab);
        $this->setData('ewallet_tab', $ewallet_tab);
        $this->setData('epin_tab', $epin_tab);
        $this->setData('paypal_tab', $paypal_tab);
        //$this->setData('blocktrail_tab', $blocktrail_tab);
        $this->setData('coinpayments_tab', $coinpayments_tab);
        if ($this->aauth->is_loggedin()) {

            $lang_id = $this->helper_model->getUserLang($logged_user);
        } else {
            if (!empty($this->main->get_usersession('mlm_data_language', 'lang_code'))) {
                $lang_id = $this->helper_model->getUserLang($this->main->get_usersession('mlm_data_language', 'lang_code'));
            }
            $lang_id = $this->dbvars->LANG_ID;
        }

        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();
        $this->setData('user_type', $user_type);
        $this->setData('terms_and_condition', $this->helper_model->getTermsAndCondition($lang_id));
        $this->setData('privacy_policy', $this->helper_model->getPrivacyPolicy($lang_id));
        $this->setData('entry_fee', $this->dbvars->ENTRI_FEE);
        $this->setData('total_amount', $total_amount);
        $this->setData('pro_amount', $pro_amount);
        $this->setData('delivery_charge', $delivery_charge);
        $this->setData('shipping_charge', $shipping_charge);
        $this->setData('tax', $tax);
        $this->setData('username_type', $username_type);
        $this->setData('username_size', $username_size);
        $this->setData('states', $states);
        $this->setData('countries', $countries);
        $this->setData('leg_status', $leg_status);
        $this->setData('register_data', $register_data);
        $this->setData('register_error', $this->form_validation->error_array());
        $this->setData('logged_user', $logged_user);
        $this->setData('tree_reg', $tree_reg);
        $this->setData('placement_username', $placement_username);
        $this->setData('title', lang('menu_name_30'));
        $this->loadView();
    }

    /**
     * For advanced registration
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $encoded_data
     */
    public function advanced($encoded_data = '', $automatic_leg = '', $tree_reg = '') {
        $register_data = array();

        $reg_pack_status = $this->dbvars->REGISTER_PACKAGE;
        $package_flag = TRUE;
        $product_id = $pro_amount = $delivery_charge = $shipping_charge = $tax = 0;
        $url = 'enroll-advanced';
        if ($reg_pack_status) {
            $url = 'packages';
            $reg_pack = 0;
            if ($this->session->userdata('reg_pack') != null)
                $reg_pack = $this->session->userdata('reg_pack');
            if ($this->register_model->checkRegProduct($reg_pack)) {
                $product_id = $reg_pack;

                $pro_amount = $this->register_model->getRegProductAmount($product_id);
                $delivery_charge = $this->dbvars->DELIVARY_CHARGE;
                $shipping_charge = $this->dbvars->SHIPPING_CHARGE;
                $tax = $this->dbvars->PURCHASE_TAX;
            } else {
                $this->loadPage(lang('please_select_a_pack'), 'packages', 'warning');
            }
        }
        $entree_fee = $this->dbvars->ENTRI_FEE;
        $package_amount = $pro_amount + $delivery_charge + $shipping_charge + $tax;
        $total_amount = $entree_fee + $package_amount;

        $total_amount_data = array('entree_fee' => $entree_fee, 'pro_amount' => $pro_amount, 'delivery_charge' => $delivery_charge, 'shipping_charge' => $shipping_charge, 'tax' => $tax);


        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $leg_type = $this->dbvars->REGISTER_LEG;
        $username_type = $this->dbvars->USERNAME_TYPE;
        $username_size = $this->dbvars->USERNAME_SIZE;
        $logged_username = $this->aauth->getUserName();
        $placement_username = '';
        if ($encoded_data) {
            $decode_id = $this->helper_model->decode($encoded_data);
            $decode_name = $this->helper_model->IdToUserName($decode_id);
            if ($decode_name) {
                if ($tree_reg && $this->dbvars->REG_FROM_TREE_STATUS) {
                    $placement_username = $decode_name;
                } else {
                    $logged_username = $decode_name;
                }
            }
        } else {
            if (!$logged_username) {
                $logged_username = $this->helper_model->getAdminUsername();
            }
        }
        $leg_status = FALSE;
        if ($mlm_plan == 'BINARY') {
            $leg_status = TRUE;
        }
        $country = '';
        if (isset($register_data['country'])) {
            $country = $register_data['country'];
        }
        $fields = $this->register_model->getAllRegFields($country, $mlm_plan, $username_type);
        if ($this->input->post('add_user') && $this->validate_registration('advanced', $leg_status, $username_type)) {
            $this->load->helper('security');
            $user_details = $this->security->xss_clean($this->input->post());

            $user_details['date_of_joining'] = date('Y-m-d H:i:s');
            $user_details['payment_type'] = 'free_join';
            $user_details['register_type'] = 'advanced';
            if ($username_type == 'dynamic') {
                $user_details['username'] = $this->register_model->generateRandomUsername($username_size);
            }

            $payment_method = $user_details['add_user'];
            $user_details['payment_method'] = $payment_method;
            $user_details['reg_amount'] = $total_amount;
            $user_details['order_amount'] = $package_amount;
            $user_details['total_amount_data'] = $total_amount_data;
            $user_details['placement_username'] = $placement_username;
            if ($payment_method == "free_registration") {
                if (!$this->helper_model->getPaymentMethodStatus('free_registration')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $payment_status = TRUE;
            } elseif ($payment_method == "bank_transfer") {
                if (!$this->helper_model->getPaymentMethodStatus('bank_transfer')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'advanced', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id);
                if ($pending) {
                    $this->helper_model->insertActivity($logged_user, 'pending_registration', $user_details);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('advanced_post');
                    $encode_id = $this->helper_model->encode($pending);
                    $this->session->set_userdata('pending_preview_user', $pending);
                    $this->loadPage(lang('pending_registration_msg'), 'pending-preview/' . $encode_id);
                } else {
                    $this->loadPage(lang('pending_register_failed'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "ewallet") {
                if (!$this->helper_model->getPaymentMethodStatus('ewallet')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $wallet_username = $user_details['wallet_username'];
                $transaction_password = $user_details['transaction_password'];
                if ($this->register_model->validateuserTransaction($wallet_username, $transaction_password, $total_amount)) {
                    $payment_status = TRUE;
                } else {
                    $this->loadPage(lang('invalid_transaction_details'), $url, 'danger');
                }
            } elseif ($payment_method == "epin") {
                if (!$this->helper_model->getPaymentMethodStatus('epin')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }


                if (!empty($user_details['epin']) && $this->validate_epin()) {
                    $sponsor_user = $this->helper_model->userNameToID($user_details['sponser_name']);

                    $status = $this->register_model->checkEpinDataValidOrNot($user_details['epin'], $sponsor_user);
                    if ($status) {
                        $payment_status = TRUE;
                        $order_status = 1;
                    } else {
                        $this->loadPage(lang('invalid_epin_details'), $url, 'danger');
                    }
                } else {
                    $this->loadPage(lang('please_enter_epins'), $url, 'danger');
                }
            } elseif ($payment_method == "paypal") {
                if (!$this->helper_model->getPaymentMethodStatus('paypal')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'advanced', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('advanced_post');
                    $this->loadPage('', 'paypal-register/' . $pending_encode_id);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "blocktrail") {
                if (!$this->helper_model->getPaymentMethodStatus('blocktrail')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'advanced', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('advanced_post');
                    $this->loadPage('', 'blocktrail-register/' . $pending_encode_id);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            } elseif ($payment_method == "coinpayments") {
                if (!$this->helper_model->getPaymentMethodStatus('coinpayments')) {
                    $this->loadPage(lang('payment_method_not_available'), $url, 'warning');
                }
                $pending = $this->register_model->addToPendingUser($payment_method, 'advanced', $user_details, $mlm_plan, $leg_type, $total_amount, $product_id, 0);
                if ($pending) {
                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('multiple_step_post');

                    $pending_encode_id = $this->helper_model->encode($pending);
                    $this->session->unset_userdata('single_step_post');

                    $first_name = $user_details['first_name'];
                    $last_name = $user_details['last_name'];
                    $email_id = $user_details['email'];
                    $url = 'https://www.coinpayments.net/index.php';

                    $coin_data = array();
                    $coin_data['cmd'] = '_pay';
                    $coin_data['reset'] = 1;
                    $coin_data['merchant'] = $this->dbvars->COINPAYMENT_MERCHANT;
                    $coin_data['item_name'] = 'For Registration';
                    $coin_data['amountf'] = $total_amount;
                    $coin_data['shippingf'] = 0.00;
                    $coin_data['taxf'] = 0.00;
                    $coin_data['want_shipping'] = 0;
                    $coin_data['currency'] = 'USD';
                    $coin_data['first_name'] = $first_name;
                    $coin_data['last_name'] = $last_name;
                    $coin_data['email'] = $email_id;
                    $coin_data['invoice'] = $pending;
                    $coin_data['success_url'] = BASE_PATH . 'register/coin_success/' . $pending_encode_id;
                    $coin_data['ipn_url'] = BASE_PATH . 'register/ipn_check';
                    $coin_data['cancel_url'] = BASE_PATH . 'register/coin_cancel';
                    $coin_data['author'] = $this->dbvars->COINPAYMENT_AUTHOR;
                    $url .= '?' . http_build_query($coin_data);
                    header('Location:' . $url);
                } else {
                    $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                }
                die('insert pending status');
            }

            if ($payment_status) {
                $user_res = $this->register_model->addUser('advanced', $user_details, $mlm_plan, $product_id);
                if ($user_res) {
                    if ($payment_method == "ewallet") {
                        $wallet_user = $this->helper_model->userNameToID($wallet_username);
                        $res = $this->helper_model->insertWalletDetails($wallet_user, 'debit', $total_amount, 'register_user', 0, $logged_user, $user_res['new_user']);
                    } elseif ($payment_method == 'epin') {
                        $sponsor_user = $this->helper_model->userNameToID($user_details['sponser_name']);
                        $result = $this->register_model->checkEpinData($user_details['epin'], $total_amount, $sponsor_user);
                    }
                    $this->helper_model->insertActivity($logged_user, 'user_registrered', $user_res);
                    $this->session->unset_userdata('reg_pack');
                    $this->session->unset_userdata('advanced_post');

                    $encode_id = $this->helper_model->encode($user_res['new_user']);
                    $this->session->set_userdata('preview_user', $user_res['new_user']);
                    $this->loadPage(lang('register_success'), 'register-preview/' . $encode_id);
                } else {
                    $failed_data = array();
                    $failed_data['type'] = 'advanced';
                    $failed_data['user_details'] = $user_details;
                    $failed_data['mlm_plan'] = $mlm_plan;
                    $failed_data['product_id'] = $product_id;
                    $this->helper_model->insertFailedActivity($logged_user, 'registration_failed', $failed_data);
                    $this->loadPage(lang('register_failed'), $url, 'danger');
                }
            } else {
                $this->loadPage(lang('payment_failed'), $url, 'danger');
            }
        }
        $register_data['sponser_name'] = $logged_username;
        if ($this->session->userdata('advanced_post') != null)
            $register_data = $this->session->userdata('advanced_post');

        $register_data['register_leg'] = $automatic_leg;

        $free_registration = $this->helper_model->getPaymentMethodStatus('free_registration');
        $bank_transfer = $this->helper_model->getPaymentMethodStatus('bank_transfer');
        $ewallet = $this->helper_model->getPaymentMethodStatus('ewallet');
        $epin = $this->helper_model->getPaymentMethodStatus('epin');
        $paypal = $this->helper_model->getPaymentMethodStatus('paypal');
        //$blocktrail = $this->helper_model->getPaymentMethodStatus('blocktrail');
        $coinpayments = $this->helper_model->getPaymentMethodStatus('coinpayments');
        $free_registration_tab = $bank_transfer_tab = $ewallet_tab = $epin_tab = $paypal_tab = $blocktrail_tab = $coinpayments_tab = '';
        if ($free_registration) {
            $free_registration_tab = " active";
        } elseif ($bank_transfer) {
            $bank_transfer_tab = " active";
        } elseif ($ewallet) {
            $ewallet_tab = " active";
        } elseif ($epin) {
            $epin_tab = " active";
        } elseif ($paypal) {
            $paypal_tab = " active";
        } elseif ($coinpayments) {
            $coinpayments_tab = " active";
        }
        
        $company_bank_details=array();
        if ($bank_transfer) {
            $company_bank_details = $this->helper_model->getCompanyBankDetail();
        }
        
        $this->setData('company_bank_details', $company_bank_details);
        $this->setData('free_registration', $free_registration);
        $this->setData('bank_transfer', $bank_transfer);
        $this->setData('ewallet', $ewallet);
        $this->setData('epin', $epin);
        $this->setData('paypal', $paypal);
        //$this->setData('blocktrail', $blocktrail);
        $this->setData('coinpayments', $coinpayments);
        $this->setData('free_registration_tab', $free_registration_tab);
        $this->setData('bank_transfer_tab', $bank_transfer_tab);
        $this->setData('ewallet_tab', $ewallet_tab);
        $this->setData('epin_tab', $epin_tab);
        $this->setData('paypal_tab', $paypal_tab);
        //$this->setData('blocktrail_tab', $blocktrail_tab);
        $this->setData('coinpayments_tab', $coinpayments_tab);
        if ($this->aauth->is_loggedin()) {

            $lang_id = $this->helper_model->getUserLang($logged_user);
        } else {
            if (!empty($this->main->get_usersession('mlm_data_language', 'lang_code'))) {
                $lang_id = $this->helper_model->getUserLang($this->main->get_usersession('mlm_data_language', 'lang_code'));
            }
            $lang_id = $this->dbvars->LANG_ID;
        }
        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();
        $this->setData('user_type', $user_type);
        $this->setData('terms_and_condition', $this->helper_model->getTermsAndCondition($lang_id));
        $this->setData('privacy_policy', $this->helper_model->getPrivacyPolicy($lang_id));

        $this->setData('entry_fee', $this->dbvars->ENTRI_FEE);
        $this->setData('total_amount', $total_amount);
        $this->setData('pro_amount', $pro_amount);
        $this->setData('delivery_charge', $delivery_charge);
        $this->setData('shipping_charge', $shipping_charge);
        $this->setData('tax', $tax);
        $this->setData('username_type', $username_type);
        $this->setData('username_size', $username_size);
        $this->setData('leg_status', $leg_status);
        $this->setData('fields', $fields);
        $this->setData('register_data', $register_data);
        $this->setData('register_error', $this->form_validation->error_array());
        $this->setData('logged_user', $logged_user);
        $this->setData('tree_reg', $tree_reg);
        $this->setData('placement_username', $placement_username);
        $this->setData('title', lang('menu_name_31'));
        $this->loadView();
    }

    /**
     * For validating registration input's
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $type
     * @param bool $leg_status
     * @param string $username_type
     * @return mixed
     */
    public function validate_registration($type, $leg_status = FALSE, $username_type = 'static') {
        $this->session->set_userdata($type . '_post', $this->input->post());

        $this->form_validation->set_rules('sponser_name', lang('sponser_name'), 'required|callback_validate_sponsor|trim');
        if ($leg_status) {
            if ($this->helper_model->getUserDefaultLeg($this->helper_model->userNameToID($this->input->post('sponser_name'))) == "static") {
                $this->form_validation->set_rules('register_leg', lang('register_leg'), 'required');
            }
        }
        if ($username_type == 'static') {
            $this->form_validation->set_rules('username', lang('username'), 'required|callback_validate_username|trim|min_length[4]|max_length[10]|alpha_numeric');
        }
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|callback_valid_email');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[6]');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('agree', lang('agree'), 'required');
        $this->form_validation->set_rules('privacy_policy', lang('privacy_policy'), 'required');
        if ($type == "multiple_step") {
            $this->form_validation->set_rules('phone_number', lang('phone_number'), 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('gender', lang('gender'), 'required');
            $this->form_validation->set_rules('address', lang('address'), 'required');
            $this->form_validation->set_rules('country', lang('country'), 'required');
            $this->form_validation->set_rules('zip_code', lang('zip_code'), 'numeric|greater_than[0]');
        }

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For product adding to cart
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     */
    public function add_to_cart() {
        if ($this->input->get('product_id')) {
            $product_id = $this->input->get('product_id');
            if ($this->register_model->checkRegProduct($product_id)) {
                $this->session->set_userdata('reg_pack', $product_id);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For validating E-pin
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @return mixed
     */
    function validate_epin() {

        $this->form_validation->set_rules('epin[]', 'epins', 'required|callback__check_epin_valid_or_not');

        $response = $this->form_validation->run();

        return $response;
    }

    /**
     * For validating sponsor name
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $username
     * @return bool
     */
    function validate_sponsor($username = '') {
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

    /**
     * For validating user name
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $username
     * @return bool
     */
    function validate_username($username = '') {
        if ($username != '') {
            $flag = false;
            if (!$this->helper_model->userNameToID($username) && !$this->register_model->checkInPending($username)) {
                $flag = TRUE;
            }
            return $flag;
        } elseif ($this->input->get('username')) {
            if (!$this->helper_model->userNameToID($this->input->get('username')) && !$this->register_model->checkInPending($this->input->get('username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For validating email
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $email
     * @return bool
     */
    function valid_email($email = '') {
        if ($email != '') {
            $flag = false;
            if (!$this->helper_model->getUserIdFromEmailId($email) && !$this->register_model->checkEmailInPending($email)) {
                $flag = TRUE;
            }
            return $flag;
        } elseif ($this->input->get('email')) {
            if (!$this->helper_model->getUserIdFromEmailId($this->input->get('email')) && !$this->register_model->checkEmailInPending($this->input->get('email'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For getting sates
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $id
     */
    function get_states($id = 'state') {
        $get = $this->input->get();
        $tab_index = isset($get['tab_index']) ? $get['tab_index'] : '0';
        $options = "<select class='form-control search-select' id='" . $id . "' name='" . $id . "' tabindex='" . $tab_index . "'><option value=''>" . lang('select_a_state') . "</option>";

        if ($this->input->get('country_id')) {
            $states = $this->helper_model->getAllStates($this->input->get('country_id'));
            foreach ($states as $s) {
                $options .= "<option value='" . $s['id'] . "'>" . $s['name'] . "</option>";
            }
        }
        $options .= "</select>";

        echo $options;
        exit();
    }

    /**
     * For checking e-pin valid or not
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param string $stingr_arr
     * @return bool
     */
    function _check_epin_valid_or_not($stingr_arr = '') {

        $result = $this->register_model->checkEPinValidOrNotGetEPinDetails($stingr_arr);
        if ($result > 0) {

            return TRUE;
        } else {
            $this->form_validation->set_messages('_check_epin_valid_or_not', lang('epin_invalid'));
            return FALSE;
        }
    }

    /**
     * For registration preview
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param $encoded_id
     */
    public function register_preview($encoded_id) {
        $preview_details = array();
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $userid = $this->helper_model->decode($encoded_id);

        if ($this->session->userdata('preview_user') != $userid) {
            $this->loadPage(lang('you_dont_access_to_this_page'), $this->dbvars->REG_MODE, 'warning');
        }
        if ($this->helper_model->IdToUserName($userid)) {
            $preview_details = $this->register_model->getPreviewDetails($userid);
        }
        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();
        $this->setData('user_type', $user_type);
        $this->setData('logged_user', $logged_user);
        $this->setData('preview_details', $preview_details);
        $this->setData('title', lang('menu_name_109'));
        $this->loadView();
    }

    /**
     * For validating e-pin
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function validate_epin_details() {
        $this->load->helper('security');
        $epin_arr = $this->security->xss_clean($this->input->post('epins'));

        $status = $this->register_model->checkEpinValidOrNot($epin_arr);
        if ($status) {
            echo 'yes';
            exit;
        } else {
            echo 'no';
            exit;
        }
    }

    /**
     * For checking e-pin validity
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function check_epin_valid_or_not() {
        $this->load->helper('security');
        $epin_arr = $this->security->xss_clean($this->input->post('epins'));
        $epin_status = $this->register_model->checkEpinValidOrNot($epin_arr);
        if ($epin_status) {
            echo 'yes';
            exit;
        } else {
            echo 'no';
            exit;
        }
    }

    /**
     * For checking e-pin created user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function check_epin_created_by_user() {
        $this->load->helper('security');
        $epin_arr = $this->security->xss_clean($this->input->post('epins'));
        $userid = $this->helper_model->userNameToID($this->input->post('username'));
        $staus = $this->register_model->epinCreatedByUser($epin_arr, $userid);
        if ($staus) {
            echo 'yes';
            exit;
        } else {
            echo 'no';
            exit;
        }
    }

    /**
     * For checking e-pin balance
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function check_epin_balance_amount() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $remaing_amount = 0;
        $epin_arr = $post['epins'];
        $userid = $this->helper_model->userNameToId($post['username']);
        $total_amount = $post['total'];
        $status = $this->register_model->getEpinBalanceAmount($epin_arr, $userid, $total_amount);
        $epin_amount = $this->register_model->getPinAmountByUserId($epin_arr, $userid);
        $remaing_amount += $epin_amount;
        if ($status) {
            echo $this->helper_model->currency_conversion($remaing_amount, 1);
            exit;
        } else {
            echo "no";
            //echo $this->helper_model->currency_conversion($remaing_amount, 1);
            exit;
        }
    }

    /**
     * For checking the user existence
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param string $username
     * @return bool
     */
    function validate_downlines($username = '') {
        if ($username != '') {
            $flag = false;
            if ($this->helper_model->userNameToID($username) && $this->aauth->getUserName() != $username) {
                $flag = TRUE;
            }
            return $flag;
        } elseif ($this->input->get('username')) {
            $username = $this->input->get('username');
            if ($this->helper_model->userNameToID($username) && $this->aauth->getUserName() != $username) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For validating the coupon
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     */
    public function validate_coupon() {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $coupn = $this->input->get('coupn');
        if ($this->helper_model->validateCouponCode($logged_user, $coupn)) {
            echo 'yes';
            exit();
        }
        echo 'no';
        exit();
    }

    /**
     * For paypal registration
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $encoded_id
     */
    public function paypal_registration($encoded_id) {
        $this->setData('title', 'paypal');
        $id = $this->helper_model->decode($encoded_id);
        $pending_details = $this->register_model->getPendingDetails($id);
        if ($pending_details) {
            $credentials = $this->helper_model->getPaypalCredentials();
            $gateway = Omnipay::create('PayPal_Express');
            $gateway->setUsername($credentials['paypal_api_username']);
            $gateway->setPassword($credentials['paypal_api_password']);
            $gateway->setSignature($credentials['paypal_signature']);
            if ($credentials['paypal_production']) {
                if (method_exists($gateway, 'setDeveloperMode')) {
                    $gateway->setDeveloperMode(TRUE);
                }
            } else {
                $gateway->setTestMode(TRUE);
            }

            $response = $gateway->purchase(
                            array(
                                'returnUrl' => BASE_PATH . 'register/paypal_response',
                                'cancelUrl' => BASE_PATH . 'register/' . $this->dbvars->REGISTER_FORM_TYPE,
                                'amount' => $pending_details['reg_amount'],
                                'currency' => $this->dbvars->DEFAULT_CURRENCY_CODE,
                                'Description' => 'User Registration',
                                'logoImageUrl' => BASE_PATH . 'assets/images/logos/' . $this->main->get_usersession('mlm_site_info', 'company_logo')
                            )
                    )->send();
            $this->register_model->updatePaypalReference($id, $response->getTransactionReference());
            if ($response->getRedirectMethod() == 'GET') {
                $redirectUrl = $response->getRedirectUrl();
                header("Location: " . $redirectUrl);
            } else {
                $response->redirect();
            }
        }
        $this->loadPage(lang('something_went_wrong'), 'register/' . $this->dbvars->REGISTER_FORM_TYPE, 'danger');
    }

    /**
     * For paypal response
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function paypal_response() {
        $this->setData('title', 'paypal');
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $get = $this->input->get();
        $pending_details = $this->register_model->getPendingDetails(0, $get['token']);
        $credentials = $this->helper_model->getPaypalCredentials();

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername($credentials['paypal_api_username']);
        $gateway->setPassword($credentials['paypal_api_password']);
        $gateway->setSignature($credentials['paypal_signature']);
        if ($credentials['paypal_production']) {
            if (method_exists($gateway, 'setDeveloperMode')) {
                $gateway->setDeveloperMode(TRUE);
            }
        } else {
            $gateway->setTestMode(TRUE);
        }
        $response = $gateway->completePurchase(
                        array(
                            'returnUrl' => BASE_PATH . 'register/paypal_response',
                            'cancelUrl' => BASE_PATH . 'register/' . $this->dbvars->REGISTER_FORM_TYPE,
                            'amount' => $pending_details['reg_amount'],
                            'currency' => $this->dbvars->DEFAULT_CURRENCY_CODE
                        )
                )->send();

        if ($response->isSuccessful()) {
            $this->register_model->updatePaymentStatus($get['token']);
            $user_res = $this->register_model->addUser($pending_details['register_type'], $pending_details['user_details'], $pending_details['mlm_plan'], $pending_details['package_id']);
            if ($user_res) {
                $this->register_model->updateRegisterStatus($get['token']);
                $this->helper_model->insertActivity($logged_user, 'user_registrered', $user_res);
                $encode_id = $this->helper_model->encode($user_res['new_user']);
                $this->loadPage(lang('register_success'), 'register-preview/' . $encode_id);
            } else {
                $failed_data = array();
                $failed_data['response'] = $get;
                $failed_data['token'] = $get['token'];
                $failed_data['user_details'] = $pending_details;
                $this->helper_model->insertFailedActivity($logged_user, 'registration_failed', $failed_data);
                $this->loadPage(lang('register_failed'), 'register/' . $this->dbvars->REGISTER_FORM_TYPE, 'danger');
            }
        }
        $this->loadPage(lang('something_went_wrong'), 'register/' . $this->dbvars->REGISTER_FORM_TYPE, 'danger');
    }

    /**
     * For blocktrail registration
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param $encoded_id
     */
    public function blocktrail_registration($encoded_id) {
        $user_type = $this->aauth->getUserType();
        $id = $this->helper_model->decode($encoded_id);
        $pending_details = $this->register_model->getPendingDetails($id);
        if ($pending_details) {
            $credentials = $this->helper_model->getBlockTrailCredentials();

            if ($credentials['blocktrail_production']) {
                $client = new BlocktrailSDK($credentials['api_key'], $credentials['api_secret'], "BTC", FALSE /* livenet */);
            } else {
                $client = new BlocktrailSDK($credentials['api_key'], $credentials['api_secret'], "BTC", TRUE /* testnet */);
            }

            try {
                /** @var Wallet $wallet */
                $wallet = $client->initWallet([
                    "identifier" => $credentials['wallet_identifier'],
                    "passphrase" => $credentials['wallet_password']
                ]);
            } catch (ObjectNotFound $e) {
                list($wallet, $backupInfo) = $client->createNewWallet([
                    "identifier" => $credentials['wallet_identifier'],
                    "passphrase" => "example-strong-password",
                    "key_index" => 9999
                ]);
                $wallet->doDiscovery();
            }

            $convert = new Converter();
            $data['bit_coin'] = $convert->toBtc($pending_details['reg_amount'], $this->dbvars->DEFAULT_CURRENCY_CODE);
            $data['addr'] = $wallet->getNewAddress();
            $data['pay_amount'] = BlocktrailSDK::toSatoshi($data['bit_coin']);
            $data['url'] = BASE_PATH . 'register/webhook_blocktrail';
            $data['qr_code'] = 'https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=bitcoin:' . $data['addr'] . '?amount=' . $data['bit_coin'];
            $time_stamp = time();
            $insert_id = $this->helper_model->addBlockTrailPaymentData($pending_details['email'], $id, $data, $time_stamp);
            $client->setupWebhook($data['url'] . '?token=' . $insert_id, $time_stamp);
            $client->subscribeAddressTransactions($time_stamp, $data['addr'], 6);
            $this->setData('bit_coin', $data['bit_coin']);
            $this->setData('address', $data['addr']);
            $this->setData('qr_code', $data['qr_code']);
            $this->setData('user_type', $user_type);
            $this->setData('title', lang('menu_name_144'));
            $this->loadView();
        } else {
            $this->loadPage(lang('something_went_wrong'), 'register/' . $this->dbvars->REGISTER_FORM_TYPE, 'danger');
        }
    }

    /**
     * For receiving blocktrail response as webhook
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     */
    public function webhook_blocktrail() {
        $payload = BlocktrailSDK::getWebhookPayload();
        if ($payload['event_type'] == "block") {
            //do stuff with the newly found block data
        } elseif ($payload['event_type'] == "address-transactions") {
            $msg = 'Failed';
            $get = $this->input->get();
            foreach ($payload['addresses'] as $key => $value) {
                $tran_address = $key;
                $tran_amount = $value;
            }
            if ($tran_address && $tran_amount) {
                $status = $this->helper_model->updateBlockTrailPaymentData($payload, $get['token'], $tran_address, $tran_amount);
                if ($status) {
                    $pending_id = $this->helper_model->getPendingIdBlocktrail($get['token'], $tran_address);
                    $pending_details = $this->register_model->getPendingDetails($pending_id);
                    $this->register_model->updatePaymentStatus($get['token']);
                    $user_res = $this->register_model->addUser($pending_details['register_type'], $pending_details['user_details'], $pending_details['mlm_plan'], $pending_details['package_id']);
                    if ($user_res) {
                        $this->register_model->updateRegisterStatus($pending_id);
                        $this->helper_model->insertActivity($this->helper_model->getAdminId(), 'user_registrered', $user_res);
                        $msg = 'Success';
                    } else {
                        $failed_data = array();
                        $failed_data['type'] = 'advanced';
                        $failed_data['user_details'] = $pending_details;
                        $failed_data['mlm_plan'] = $this->dbvars->MLM_PLAN;
                        $failed_data['product_id'] = $pending_details['product_id'];
                        $this->helper_model->insertFailedActivity($this->helper_model->getAdminId(), 'registration_failed', $failed_data);
                    }
                }
            }
            $this->output->set_output($msg);
        } elseif ($payload['event_type'] == "transaction") {
            
        }
    }

    /**
     * For validate the tree user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function validate_tree_user() {
        $res = 'no';
        if ($this->input->get('username')) {
            $username = $this->input->get('username');
            $user_id = $this->helper_model->userNameToID($username);
            $downlines = $this->helper_model->getDownlinesUnilevel(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId());
            if ($user_id && in_array($user_id, $downlines)) {
                $res = 'yes';
            }
        }
        echo $res;
        exit();
    }

    /**
     * For registration preview
     *  @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     * @param $encoded_id
     */
    public function pending_preview($encoded_id) {
        $preview_details = array();
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $pend_id = $this->helper_model->decode($encoded_id);

        if ($this->session->userdata('pending_preview_user') != $pend_id) {
            $this->loadPage(lang('you_dont_access_to_this_page'), $this->dbvars->REG_MODE, 'warning');
        }

        if ($pend_id) {
            $preview_details = $this->register_model->getPendingPreviewDetails($pend_id);
        }
        $this->setData('logged_user', $logged_user);
        $this->setData('preview_details', $preview_details);
        $this->setData('title', lang('menu_name_149'));
        $this->loadView();
    }

    /**
     * For checking registration package
     * @author Techffodils Technologies LLP
     *    @copyright (c) 2017, Techffodils Technologies
     */
    public function check_reg_pack_presence() {

        $reg_pack = 0;
        if ($this->session->userdata('reg_pack') != null)
            $reg_pack = $this->session->userdata('reg_pack');
        if ($this->register_model->checkRegProduct($reg_pack)) {
            $encode_id = $this->input->post('encodeid');
            $encode_leg = $this->input->post('encode_leg');
            $reg_type = $this->input->post('reg_type');
            $tree_reg = $this->input->post('tree_reg');
            if ($encode_id) {
                $reg_url = $reg_type . '/' . $encode_id . '/' . $encode_leg . '/' . $tree_reg;
            } else {
                $reg_url = $reg_type;
            }
            echo $reg_url;
            exit();
        }
        echo 'no';
        exit();
    }

    public function coin_success($encode_id = '') {
        $this->loadPage(lang('register_success'), 'register-preview/' . $encode_id);
    }

    public function coin_cancel() {
        $this->loadPage(lang('registration_canceled'), 'enroll', 'danger');
    }

    public function ipn_check() {
        $resp_id = $this->helper_model->insertCoinPaymentResponse($_POST, 'registration');
        if (null !== $this->input->post('invoice')) {
            $order_id = $this->input->post('invoice');
        } else {
            $order_id = 0;
        }
        $pending_details = $this->register_model->getPendingDetails($order_id);
        if ($pending_details) {
            if ($this->input->post('merchant') == trim($this->dbvars->COINPAYMENT_MERCHANT)) {
                if ($this->input->post('currency1') == 'USD') {
                    if ($this->input->post('amount1') >= $pending_details['reg_amount']) {
                        $status = (int) $this->input->post('status');
                        if ($status == 1) {
                            $this->register_model->updatePaymentStatus(0, $order_id);
                            $this->helper_model->updateCoinPaymentResponse($resp_id, 'Payment Complete');

                            $user_res = $this->register_model->addUser($pending_details['register_type'], $pending_details['user_details'], $pending_details['mlm_plan']);
                            if ($user_res) {
                                $this->register_model->updateRegisterStatus($order_id);
                                $this->helper_model->updateCoinPaymentResponse($resp_id, 'Registration Complete');
                            } else {
                                $this->helper_model->updateCoinPaymentResponse($resp_id, 'Registration Failed');
                            }
                        } else {
                            $this->helper_model->updateCoinPaymentResponse($resp_id, 'Payment Not Confirmed Yet');
                        }
                    } else {
                        $this->helper_model->updateCoinPaymentResponse($resp_id, 'Amount received is less than the total');
                        die("Amount received is less than the total!");
                    }
                } else {
                    $this->helper_model->updateCoinPaymentResponse($resp_id, 'Original currency doesn`t match');
                    die("Original currency doesn't match!");
                }
            } else {
                $this->helper_model->updateCoinPaymentResponse($resp_id, 'Merchant ID doesn`t match!');
                die("Merchant ID doesn't match!");
            }
        } else {
            $this->helper_model->updateCoinPaymentResponse($resp_id, "Could not find order info for order: " . $order_id);
            die("Could not find order info for order: " . $order_id);
        }
        return true;
    }

    public function get_full_name() {
        $username = $this->input->get('username');
        $user_id = $this->helper_model->UserNameToID($username);
        $user_fullname = $this->helper_model->getUserFullName($user_id);
        $user_email = $this->helper_model->getUserEmailId($user_id);
        $data = 'no';
        if ($user_email) {
            $data = '<label class="label label-info">' . lang('full_name') . ' :- ' . $user_fullname . ' , ' . lang('email_address') . ' :- ' . $user_email . '</label>';
        }
        echo $data;
        exit();
    }
}
