<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

use Omnipay\Omnipay;
//use Blocktrail\SDK\BlocktrailSDK;
use Jimmerioles\BitcoinCurrencyConverter\Converter;

class Cart extends Base_Controller {

    /**
     * Function for view all party created products
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $party_code
     */
    public function index($party_code = '') {
        $party_id = 0;
        $party_prod = array();
        if ($party_code) {
            $this->load->model('party_model');
            $party_id = $this->party_model->validatePartyCode($party_code);
            if ($party_id) {
                $party_prod = $this->cart_model->getAllProductsInParty($party_id);
                $party_cart = $this->cart->contents();

                foreach ($party_cart as $key => $c) {
                    if (!in_array($c['id'], $party_prod)) {
                        $this->cart->remove($key);
                    }
                }
            } else {
                $this->loadPage(lang('invalid_party'), 'shopping-cart', 'danger');
            }
        }

        $user_type = $this->aauth->getUserType();
        if ($party_id) {
            $products = $this->cart_model->getAllPartyProducts($party_id, $party_prod);
        } else {
            $products = $this->cart_model->getAllProducts();
        }
        $this->setData('party_id', $party_id);
        $this->setData('items', $this->cart->total_items());
        $this->setData('total_items_amount', $this->cart->total());
        $this->setData('products', $products);
        $this->setData('user_type', $user_type);
        $this->setData('title', lang('menu_name_11'));
        $this->loadView();
    }

    /**
     * For load the product or packages added by admin
     * @author Techffofdils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     */
    public function view() {
        $user_type = $this->aauth->getUserType();
        $cart = $this->cart->contents();
        $this->setData('items', $this->cart->total_items());
        $this->setData('total_amount', $this->cart->total());
        $this->setData('cart', $cart);
        $this->setData('user_type', $user_type);
        $this->setData('title', lang('menu_name_12'));
        $this->loadView();
    }

    /**
     * For checkout function
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     *
     */
    public function checkout() {
        $user_name = $this->aauth->getUserName();
        $user_type = $this->aauth->getUserType();
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $cart = $this->cart->contents();
        $total_items = $this->cart->total_items();
        $cart_amount = $this->cart->total();

        $delivery_charge = $shipping_charge = $tax = 0;

        if ($cart_amount > 0) {
            $delivery_charge = $this->dbvars->DELIVARY_CHARGE;
            $shipping_charge = $this->dbvars->SHIPPING_CHARGE;
            $tax = $this->dbvars->PURCHASE_TAX;
            $total_amount = $cart_amount + $delivery_charge + $shipping_charge + $tax;
        } else {
            $total_amount = $cart_amount;
        }

        $total_pv = $this->cart->total_pv();

        if ($this->input->post('product_checkout') && $this->validate_checkout()) {
            $this->load->helper('security');
            $checkout_data = $this->security->xss_clean($this->input->post());

            $payment_method = $checkout_data['product_checkout'];

            $checkout_data['payment_method'] = $payment_method;
            $checkout_data['checkout_date'] = date('Y-m-d H:i:s');
            $checkout_data['total_amount'] = $total_amount;
//Action based on payment method
            $payment_status = FALSE;
            $order_status = 0;
            if ($payment_method == "free_checkout") {
                if (!$this->helper_model->getPaymentMethodStatus('free_registration')) {
                    $this->loadPage(lang('payment_method_not_available'), 'shopping-checkout', 'warning');
                }
                $order_status = 1;
                $payment_status = TRUE; //for testing purpose only
            } elseif ($payment_method == "bank_transfer") {
                if (!$this->helper_model->getPaymentMethodStatus('bank_transfer')) {
                    $this->loadPage(lang('payment_method_not_available'), 'shopping-checkout', 'warning');
                }
                $order_status = 0;
                $payment_status = TRUE;
            } elseif ($payment_method == "ewallet") {
                if (!$this->helper_model->getPaymentMethodStatus('ewallet')) {
                    $this->loadPage(lang('payment_method_not_available'), 'shopping-checkout', 'warning');
                }
                $wallet_username = $checkout_data['wallet_username'];
                $transaction_password = $checkout_data['transaction_password'];
                if ($this->cart_model->validateuserTransaction($wallet_username, $transaction_password, $total_amount)) {
                    $wallet_user = $this->helper_model->userNameToID($wallet_username);
                    $res = $this->helper_model->insertWalletDetails($wallet_user, 'debit', $total_amount, 'repurchase', 0, $user_id);
                    if ($res) {
                        $order_status = 1;
                        $payment_status = TRUE;
                    } else {
                        $this->loadPage(lang('invalid_transaction_details'), 'shopping-checkout', 'danger');
                    }
                } else {
                    $this->loadPage(lang('invalid_transaction_details'), 'shopping-checkout', 'danger');
                }
            } elseif ($payment_method == "epin") {
                if (!$this->helper_model->getPaymentMethodStatus('epin')) {
                    $this->loadPage(lang('payment_method_not_available'), 'shopping-checkout', 'warning');
                }
                $this->load->helper('security');
                $post_arr = $this->security->xss_clean($this->input->post());

                $totalamount = $total_amount;

                if (!empty($post_arr['epin'])) {
                    $chek_epin_used_user_status = $this->cart_model->getCheckEpinUsedCartDetails($post_arr['epin'], $user_name);
                    if ($chek_epin_used_user_status) {
                        $status = $this->cart_model->checkEpinDetails($post_arr['epin'], $totalamount, $user_id);
                        if ($status) {
                            $payment_status = TRUE;
                            $order_status = 1;
                        } else {
                            $this->loadPage(lang('invalid_epin_details'), 'shopping-checkout', 'danger');
                        }
                    } else {
                        $this->loadPage(lang('no_such_epin_created'), 'shopping-checkout', 'danger');
                    }
                } else {
                    $this->loadPage(lang('please_enter_epins'), 'shopping-checkout', 'danger');
                }
            } elseif ($payment_method == "paypal") {
                if (!$this->helper_model->getPaymentMethodStatus('paypal')) {
                    $this->loadPage(lang('payment_method_not_available'), 'shopping-checkout', 'warning');
                }
                $order_status = 0;
                $payment_status = TRUE;
            } elseif ($payment_method == "coinpayments") {
                if (!$this->helper_model->getPaymentMethodStatus('coinpayments')) {
                    $this->loadPage(lang('payment_method_not_available'), 'shopping-checkout', 'warning');
                }
                $order_status = 0;
                $payment_status = TRUE;
            }
//Action based on payment method

            if ($payment_status) {
                $this->base_model->transactionStart();
                $order_id = $this->cart_model->addOrder($user_id, $checkout_data, $cart, $total_items, $total_amount, $total_pv, $payment_method, $order_status, $delivery_charge, $shipping_charge, $tax);
                if ($order_id && $this->base_model->transationCheck()) {
                    $arr['user_id'] = $user_id;
                    $arr['order_id'] = $order_id;
                    $arr['post'] = $checkout_data;
                    $arr['cart'] = $cart;
                    $arr['payment_method'] = $payment_method;
                    $arr['total_amount'] = $total_amount;
                    $this->base_model->transationCommit();
                    $this->cart->destroy();
                    $this->load->model('send_mail_model');
                    if ($order_status) {//commission and mails here
                        $msg = lang('checkout_success');
                        $this->helper_model->insertActivity($user_id, 'create_order', $arr);
                        $this->send_mail_model->send($user_id, '', 'order_mail', $arr);
                        $admin_mail_id = $this->helper_model->getAdminMailId();
                        $this->send_mail_model->send('', $admin_mail_id, 'new_order_mail', $arr);

                        //For Bulk SMS
                        if ($_SERVER['HTTP_HOST'] != 'localhost' && $this->dbvars->SMS_MODULES_STATUS > 0) {
                            if ($this->dbvars->CHECKOUT_SMS_PERMISSION > 0) {
                                $message = $this->dbvars->CHECKOUT_SMS_CONTENT;
                                $mobile = $this->helper_model->getCompleteMobileNumber($user_id);
                                $res = $this->helper_model->bulkSMS($mobile, $message);
                            }
                        }
                    } else {
                        if ($payment_method == "paypal") {
                            $pending_order_id = $this->helper_model->encode($order_id);
                            $this->loadPage('', 'paypal-checkout/' . $pending_order_id);
                        } elseif ($payment_method == "coinpayments") {
                            if ($order_id) {
                                $this->load->model('register_model');
                                $user_details['username'] = $user_details['email'] = $user_details['sponser_name'] = 'purchase';
                                $pending = $this->register_model->addToPendingUser('cart', 'cart', $user_details, 'cart', 'cart', $total_amount, $order_id, 0);

                                $pending_encode_id = $this->helper_model->encode($order_id);
                                $user_details=$this->cart_model->getUserDetails($user_id);
                                $first_name = $user_details['first_name'];
                                $last_name = $user_details['last_name'];
                                $email_id = $user_details['email_id'];
                                $url = 'https://www.coinpayments.net/index.php';

                                $coin_data = array();
                                $coin_data['cmd'] = '_pay';
                                $coin_data['reset'] = 1;
                                $coin_data['merchant'] = $this->dbvars->COINPAYMENT_MERCHANT;
                                $coin_data['item_name'] = 'For Purchase';
                                $coin_data['amountf'] = $total_amount;
                                $coin_data['shippingf'] = 0.00;
                                $coin_data['taxf'] = 0.00;
                                $coin_data['want_shipping'] = 0;
                                $coin_data['currency'] = 'USD';
                                $coin_data['first_name'] = $first_name;
                                $coin_data['last_name'] = $last_name;
                                $coin_data['email'] = $email_id;
                                $coin_data['invoice'] = $pending;
                                $coin_data['success_url'] = BASE_PATH . 'cart/coin_success/' . $pending_encode_id;
                                $coin_data['ipn_url'] = BASE_PATH . 'cart/ipn_check';
                                $coin_data['cancel_url'] = BASE_PATH . 'cart/coin_cancel';
                   
                                $coin_data['author'] = $this->dbvars->COINPAYMENT_AUTHOR;
                                $url .= '?' . http_build_query($coin_data);
                                header('Location:' . $url);
                            } else {
                                $this->loadPage(lang('something_went_wrong'), $url, 'danger');
                            }
                            die('insert pending status');
                        }
                        $this->send_mail_model->send($user_id, '', 'pending_order_mail', $arr);
                        $msg = lang('checkout_pending');
                    }
                    $this->loadPage($msg, 'shopping-cart');
                } else {
                    $this->base_model->transationRollback();

                    $failed_data = array('user_id' => $user_id, 'checkout_data' => $checkout_data, 'cart' => $cart, 'total_items' => $total_items, 'total_amount' => $total_amount, 'total_pv' => $total_pv, 'payment_method' => $payment_method, 'order_status' => $order_status, 'delivery_charge' => $delivery_charge, 'shipping_charge' => $shipping_charge, 'tax' => $tax);
                    $this->helper_model->insertFailedActivity($user_id, 'order_failed', $failed_data);

                    $this->loadPage(lang('checkout_failed'), 'shopping-checkout', 'danger');
                }
            }
        }


        if (!$this->helper_model->IdToUserName($user_id)) {
            $this->loadPage(lang('login_first_for_purchase'), 'login', 'warning');
        }

        if ($total_items <= 0) {
            $this->loadPage(lang('cart_empty'), 'shopping-cart', 'warning');
        }



        $free_registration = $this->helper_model->getPaymentMethodStatus('free_registration');
        $bank_transfer = $this->helper_model->getPaymentMethodStatus('bank_transfer');
        $ewallet = $this->helper_model->getPaymentMethodStatus('ewallet');
        $epin = $this->helper_model->getPaymentMethodStatus('epin');
        $paypal = $this->helper_model->getPaymentMethodStatus('paypal');
        $coinpayments = $this->helper_model->getPaymentMethodStatus('coinpayments');

        $free_registration_tab = $bank_transfer_tab = $ewallet_tab = $epin_tab = $paypal_tab = $coinpayments_tab = '';
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
        $checkout_data = $this->cart_model->getCheckoutData($user_id, $user_name);
        $country = '';
        if (isset($checkout_data['country'])) {
            $country = $checkout_data['country'];
        }
        $countries = $this->helper_model->getAllCountries();
        $states = $this->helper_model->getAllStates($country);

        $this->setData('checkout_error', $this->form_validation->error_array());
        $this->setData('checkout_data', $checkout_data);
        $this->setData('states', $states);
        $this->setData('countries', $countries);
        $this->setData('free_registration', $free_registration);
        $this->setData('bank_transfer', $bank_transfer);
        $this->setData('ewallet', $ewallet);
        $this->setData('epin', $epin);
        $this->setData('paypal', $paypal);
        $this->setData('coinpayments', $coinpayments);
        $this->setData('free_registration_tab', $free_registration_tab);
        $this->setData('bank_transfer_tab', $bank_transfer_tab);
        $this->setData('ewallet_tab', $ewallet_tab);
        $this->setData('epin_tab', $epin_tab);
        $this->setData('paypal_tab', $paypal_tab);
        $this->setData('coinpayments_tab', $coinpayments_tab);
        $this->setData('total_items', $total_items);
        $this->setData('total_amount', $total_amount);
        $this->setData('cart', $cart);
        $this->setData('user_type', $user_type);
        $this->setData('title', lang('menu_name_13'));
        $this->setData('user_name', $user_name);
        $this->loadView();
    }

    /**
     * For add the product/package where added to the cart
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function add_to_cart() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        if ($get['product_id']) {
            // $party_id = 0;
            // if ($get['party_id']) {
            //     $party_id = $get['party_id'];
            // }

            $product_id = $get['product_id'];
            $product_details = $this->cart_model->getProductDetails($product_id, 1);
            if ($product_details) {
                $img = 'our-products.png';
                if (isset($product_details['images'][0]['file_name'])) {
                    $img = $product_details['images'][0]['file_name'];
                }
                $short_name = $product_details['product_name'];
                if (strlen($product_details['product_name']) > 15) {
                    $short_name = substr($product_details['product_name'], 0, 15) . '...';
                }
                // if ($party_id) {
                //     $party_pro_amount = $this->cart_model->getPartyProductAmount($party_id, $product_id);
                //     if ($party_pro_amount > 0) {
                //         $product_details['product_amount'] = $party_pro_amount;
                //     }
                // }

                $data = array(
                    'id' => $product_id,
                    'qty' => 1,
                    'name' => $product_details['product_name'],
                    'short_name' => $short_name,
                    'price' => $product_details['product_amount'],
                    'pv' => $product_details['product_pv'],
                    'image' => $img,
                    'recurring_type' => $product_details['recurring_type'],
                    'description' => $product_details['description'],
                    'product_type' => $product_details['product_type'],
                    // 'party_id' => $party_id
                );

                $cart = $this->cart->contents();
                foreach ($cart as $key => $value) {
                    if ($value['id'] == $product_id) {
                        if (!$this->cart_model->checkProductQuantity($product_id, $cart[$key]['qty'] + 1)) {

                            echo lang('product_quantity_exceeded_stock');
                            exit();
                        }
                    }
                }
                $res = $this->cart->insert($data);
                if ($res) {
                    echo 'yes';
                    exit();
                }
            } else {
                echo lang('product_quantity_exceeded_stock');
                exit();
            }
        }
        echo lang('failed_to_add_js');
        exit();
    }

    /**
     * For getting the product amount or package count
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function get_product_count() {
        echo $this->cart->total_items();
    }

    /**
     * For getting the product amount or package amount
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function get_product_amount() {
        echo $this->cart->total();
    }

    /**
     * For remove the product from the cart
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function remove_product() {
        if ($this->input->get('key')) {
            $res = $this->cart->remove($this->input->get('key'));
            if ($res) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For add the product count to the cart
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function add_product_count() {
        if ($this->input->get('key')) {
            $key = $this->input->get('key');
            $cart = $this->cart->contents();
            if (isset($cart[$key]['qty'])) {
                $data = array(
                    'rowid' => $key,
                    'qty' => $cart[$key]['qty'] + 1
                );
                if ($this->cart_model->checkProductQuantity($cart[$key]['id'], $cart[$key]['qty'] + 1)) {
                    $res = $this->cart->update($data);
                    if ($res) {
                        $qty =$cart[$key]['qty']+1;
                echo json_encode(['status'=>'yes','value'=>($cart[$key]['price']*$qty)]);
                    
                        exit();
                    }
                } else {
                    echo lang('product_quantity_exceeded_stock');
                    exit();
                }
            }
            echo lang('failed_to_add_js');
            exit();
        }
    }

    /**
     * For deduct the product count
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function ded_product_count() {
        if ($this->input->get('key')) {
            $key = $this->input->get('key');
            $cart = $this->cart->contents();
            if (isset($cart[$key]['qty'])) {
                $data = array(
                    'rowid' => $key,
                    'qty' => $cart[$key]['qty'] - 1
                );

                $res = $this->cart->update($data);
                if ($res) {
                    $qty =$cart[$key]['qty']-1;
                echo json_encode(['status'=>'yes','value'=>($cart[$key]['price']*$qty)]);
                    
                    exit();
                }
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For refresh the cart
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function refresh_cart() {
        $data = $this->cart->contents();
        foreach ($data as $key => $value) {
            $data[$key]['conv_price'] = $this->helper_model->currency_conversion($data[$key]['price']);
        }
        $this->_setOutput($data);
    }

    /**
     * For refresh the price
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function refresh_price() {
        $data['items'] = $this->cart->total_items();
        $data['total_amount'] = $this->helper_model->currency_conversion($this->cart->total());
        $data['total_amount_only'] = $this->cart->total();
        if ($this->cart->total_items() > 0) {
            $data['delivery_charge'] = $this->helper_model->currency_conversion($this->dbvars->DELIVARY_CHARGE);
            $data['shipping_charge'] = $this->helper_model->currency_conversion($this->dbvars->SHIPPING_CHARGE);
            $data['tax'] = $this->helper_model->currency_conversion($this->dbvars->PURCHASE_TAX);

            $data['delivery_charge_only'] = $this->dbvars->DELIVARY_CHARGE;
            $data['shipping_charge_only'] = $this->dbvars->SHIPPING_CHARGE;
            $data['tax_only'] = $this->dbvars->PURCHASE_TAX;
        } else {
            $data['delivery_charge'] = $data['delivery_charge_only'] = 0;
            $data['shipping_charge'] = $data['shipping_charge_only'] = 0;
            $data['tax'] = $data['tax_only'] = 0;
        }
        $grand_total = $data['total_amount_only'] + $data['delivery_charge_only'] + $data['shipping_charge_only'] + $data['tax_only'];
        $data['grand_total'] = $this->helper_model->currency_conversion($grand_total);
        $data['grand_total_amount'] = $grand_total;
        $this->_setOutput($data);
    }

    /**
     * For set the data to the view
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    private function _setOutput($data) {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo json_encode($data);
        exit();
    }

    /**
     * For validate the user transaction password
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function validate_user_tp() {
        $get = $this->input->get();
        if ($get['username'] && $get['tp']) {
            $res = $this->cart_model->validateUserTransactionPassword($get['username'], $get['tp']);
            if ($res) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For validate the user balance
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function validate_user_balance() {
        $get = $this->input->get();
        if ($get['username'] && $get['amount']) {
            $res = $this->cart_model->validateUserBalance($get['username'], $get['amount']);
            if ($res) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For validate the username
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    function validate_username($username = '') {
        if ($username != '') {
            $flag = false;
            if ($this->helper_model->userNameToID($username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->helper_model->userNameToID($this->input->get('username'))) {
            echo 'yes';
            exit();
        }
        echo 'no';
        exit();
    }

    /**
     * For for validate the checkout form
     * for purchase the packages for register whom to the system
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function validate_checkout() {
        $this->form_validation->set_rules('address', lang('address'), 'required');
        $this->form_validation->set_rules('country', lang('country'), 'required');
        $this->form_validation->set_rules('state', lang('state'), 'required');
        $this->form_validation->set_rules('city', lang('city'), 'required');
        $this->form_validation->set_rules('zip_code', lang('zip_code'), 'required');
        if ($this->input->post('product_checkout') == 'ewallet') {
            $this->form_validation->set_rules('wallet_username', lang('wallet_username'), 'required|callback_validate_username');
            $this->form_validation->set_rules('transaction_password', lang('transaction_password'), 'required');
        }
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For check validate the E-pin
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    function cart_check_validate_epin() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());

        $epin = $post['pin'];
        $amount = $post['total'];
        $epin_status = $this->cart_model->checkEpinStatus($epin, $amount);
        $remaing_amount = 0;
        $epin_amount = $this->cart_model->getPinAmount($epin);
        $remaing_amount += $epin_amount;
        if ($epin_status) {
            echo $this->helper_model->currency_conversion($remaing_amount);
            exit();
        } else {
            echo $this->helper_model->currency_conversion($remaing_amount);
            exit();
        }
    }

    /**
     * For check validate the E-pin
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function check_epin_validate() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $post_arr = $post['data'];
        $user_name = $post['userid'];
        $flag = 'no';

        $status = $this->register_model->checkEpinValidate($post_arr, $user_name);
        if ($status) {
            $flag = 'yes';
            exit();
//$this->output->set_output(json_encode(array('status' => true, 'data' => ['message' => 'success'])));
        } else {
// $this->output->set_output(json_encode(array('status' => false, 'data' => ['message' => 'success'])));
            $flag = 'no';
            exit();
        }
    }

    /**
     * For checkout using paypal
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function paypal_checkout($encoded_id) {
        $this->setData('title', 'paypal');
        $id = $this->helper_model->decode($encoded_id);
        $order_details = $this->cart_model->getOrderDetails($id);
        if ($order_details) {
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
                $gateway->setTestMode(true);
            }

            $response = $gateway->purchase(
                            array(
                                'returnUrl' => BASE_PATH . 'cart/paypal_response',
                                'cancelUrl' => BASE_PATH . 'shopping-cart',
                                'amount' => $order_details['total_amount'],
                                'currency' => $this->dbvars->DEFAULT_CURRENCY_CODE,
                                'Description' => 'Product Purchase(Order ID: #ORD' . $id . ')',
                                'logoImageUrl' => 'https://www.leadmlmsoftware.com/img/logo_lead.png'
                            )
                    )->send();
            $this->cart_model->updatePaypalReference($id, $response->getTransactionReference());
            if ($response->getRedirectMethod() == 'GET') {
                $redirectUrl = $response->getRedirectUrl();
                header("Location: " . $redirectUrl);
            } else {
                $response->redirect();
            }
        }
        $this->loadPage(lang('something_went_wrong'), 'shopping-cart', 'danger');
    }

    /**
     * For getting the pay-pal payment gate-way response
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
     */
    public function paypal_response() {
        $this->setData('title', 'paypal');
        $get = $this->input->get();
        $order_details = $this->cart_model->getOrderDetails(0, $get['token']);
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
            $gateway->setTestMode(true);
        }
        $response = $gateway->completePurchase(
                        array(
                            'returnUrl' => BASE_PATH . 'cart/paypal_response',
                            'cancelUrl' => BASE_PATH . 'shopping-cart',
                            'amount' => $order_details['total_amount'],
                            'currency' => $this->dbvars->DEFAULT_CURRENCY_CODE,
                        )
                )->send();

        if ($response->isSuccessful()) {
            $this->load->model('member_model');
            $res = $this->member_model->activateOrder($order_details['order_id']);
            if ($res) {
                $this->loadPage(lang('checkout_success'), 'shopping-cart');
            } else {
                $this->loadPage(lang('checkout_failed'), 'shopping-cart', 'danger');
            }
        }
        $this->loadPage(lang('something_went_wrong'), 'shopping-cart', 'danger');
    }

    /**

     * For checkout using block trail
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $encoded_id
     */
    public function blocktrail_checkout($encoded_id) {
        $user_type = $this->aauth->getUserType();
        $id = $this->helper_model->decode($encoded_id);
        $order_details = $this->cart_model->getOrderDetails($id);
        if ($order_details) {
            $credentials = $this->helper_model->getBlockTrailCredentials();
            if ($credentials['blocktrail_production']) {
                $client = new BlocktrailSDK($credentials['api_key'], $credentials['api_secret'], "BTC", false /* livenet */);
            } else {
                $client = new BlocktrailSDK($credentials['api_key'], $credentials['api_secret'], "BTC", true /* testnet */);
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
            $data['bit_coin'] = $convert->toBtc($order_details['total_amount'], $this->dbvars->DEFAULT_CURRENCY_CODE);
            $data['addr'] = $wallet->getNewAddress();
            $data['pay_amount'] = BlocktrailSDK::toSatoshi($data['bit_coin']);
            $email = $this->helper_model->getUserEmailId($order_details['user_id']);
            $data['qr_code'] = 'https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=bitcoin:' . $data['addr'] . '?amount=' . $data['bit_coin'];
            $data['url'] = BASE_PATH . 'cart/webhook_blocktrail';
            $time_stamp = time();
            $insert_id = $this->helper_model->addBlockTrailPaymentData($email, $order_details['order_id'], $data, $time_stamp);
            $client->setupWebhook($data['url'] . '?token=' . $insert_id, $time_stamp);
            $client->subscribeAddressTransactions($time_stamp, $data['addr'], 6);
            $this->setData('bit_coin', $data['bit_coin']);
            $this->setData('address', $data['addr']);
            $this->setData('qr_code', $data['qr_code']);
            $this->setData('user_type', $user_type);
            $this->setData('title', lang('menu_name_146'));
            $this->loadView();
        } else {
            $this->loadPage(lang('something_went_wrong'), 'shopping-cart', 'danger');
        }
    }

    /**
     * For block-trail operation
     * @author Techffodils Technologies LLP
     * @access public
     * @copyright (c) 2017, Techffodils Technologies
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
                    $this->load->model('member_model');
                    $res = $this->member_model->activateOrder($pending_id);
                    if ($res) {
                        $msg = 'Success';
                    }
                }
            }
            $this->output->set_output($msg);
        } elseif ($payload['event_type'] == "transaction") {
            
        }
    }

    public function coin_success($encode_id = '') {
        $this->loadPage(lang('checkout_success'), 'shopping-cart');
    }

    public function coin_cancel() {
        $this->loadPage(lang('checkout_failed'), 'shopping-cart', 'danger');
    }

    public function ipn_check() {
        $resp_id = $this->helper_model->insertCoinPaymentResponse($_POST, 'purchase');
        if (null !== $this->input->post('invoice')) {
            $order_id = $this->input->post('invoice');
        } else {
            $order_id = 0;
        }
        $this->load->model('register_model');
        $pending_details = $this->register_model->getPendingDetails($order_id);
        if ($pending_details) {
            if ($this->input->post('merchant') == trim($this->dbvars->COINPAYMENT_MERCHANT)) {
                if ($this->input->post('currency1') == 'USD') {
                    if ($this->input->post('amount1') >= $pending_details['reg_amount']) {
                        $status = (int) $this->input->post('status');
                        if ($status == 1) {
                            $this->register_model->updatePaymentStatus(0, $order_id);
                            $this->helper_model->updateCoinPaymentResponse($resp_id, 'Payment Complete');
                            $ord_id = $pending_details['package_id'];
                            $this->load->model('member_model');
                            $res = $this->member_model->activateOrder($ord_id);
                            if ($res) {
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


    public function quantity_change() {
        if ($this->input->get('key')) {
            $key = $this->input->get('key');
            $quantity = $this->input->get('quantity');
            $cart = $this->cart->contents();
            if (isset($cart[$key]['qty'])) {
                $data = array(
                    'rowid' => $key,
                    'qty' => $quantity
                );
                
                $res = $this->cart->update($data);
                    if ($res) {
                        echo 'yes';
                        exit();
                    }

            }
            echo lang('failed_to_add_js');
            exit();
        }
    }

}
