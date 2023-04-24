<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * For
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Register_model extends CI_Model {

    /**
     * For insert the users to the system and related function like distribute bonus ,rank etc..
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $register_type
     * @param type $user_details
     * @param type $mlm_plan
     * @param type $package_id
     * @return boolean
     */
    function addUser($register_type, $user_details, $mlm_plan = 'BINARY', $package_id = 0) {
    
        // $new_user = FALSE;
        // $obj_class = "plan_" . strtolower($mlm_plan) . "_model";
        // include_once("Plan_" . strtolower($mlm_plan) . "_model.php");
        // $plan_obj = new $obj_class();
        // $user_details['register_leg'] = isset($user_details['register_leg']) ? $user_details['register_leg'] : 'NA';
        // $user_details['sponsor_id'] = $sponsor_id = $this->helper_model->userNameToID($user_details['sponser_name']);
        // $user_details['leg'] = $plan_obj->getUserLeg($user_details['sponsor_id'], $user_details['register_leg']);

        // if ($user_details['placement_username'] != '' && $this->dbvars->REG_FROM_TREE_STATUS && $placement_id = $this->helper_model->userNameToID($user_details['placement_username'])) {
        //     $position_array = $plan_obj->createFatherID($placement_id, $user_details['leg']);
        // } else {
        //     $position_array = $plan_obj->createFatherID($sponsor_id, $user_details['leg']);
        // }

        // $user_details['father_id'] = $father_id = $position_array['father_id'];
        // $user_details['leg'] = $position_array['position'];
        // $this->base_model->transactionStart();
        $add_user = $this->createUsers($user_details, $package_id);
        // $traverse_father_status = $plan_obj->updateFatherTraverse($add_user, $father_id, $level = 1, $user_details['leg']);
        // $traverse_sponsor_status = $plan_obj->updateSponsorTraverse($add_user, $sponsor_id, $level = 1);
        // if (!$traverse_father_status || !$traverse_sponsor_status) {
        //     $this->base_model->transationRollback();

        //     $failed_data = array('register_type' => $register_type, 'user_details' => $user_details, 'mlm_plan' => $mlm_plan, 'package_id' => $package_id);
        //     $this->helper_model->insertFailedActivity($sponsor_id, 'reg_fai-1', $failed_data);
        //     return false;
        // }
        if ($add_user) {
            $new_user['new_user'] = $add_user;
            $user_details['del_data_type'] = isset($user_details['del_data_type']) ? $user_details['del_data_type'] : 'same';
            $country_id = isset($user_details['country']) ? $user_details['country'] : 0;
            $state_id = isset($user_details['state']) ? $user_details['state'] : 0;
            $ud = $this->insertUserDetails($add_user, $user_details);
            $entry = $this->insertUsersEntry($add_user, $package_id, $country_id, $state_id);
            // if ($entry && $ud && $this->base_model->transationCheck()) {
            //     $user_details['new_user_id'] = $add_user;
            //     if ($register_type == 'multiple_step') {
            //         $this->updateUserDetails($add_user, $user_details);
            //     } elseif ($register_type == 'advanced') {
            //         $this->updateAdvancedUserDetails($add_user, $user_details);
            //     }
            //     $user_details['package_id'] = $package_id;
            //     $this->insertRegisterHistory($add_user, $register_type, $user_details);
            //     $this->helper_model->insertActivity($this->aauth->getId(), 'user_registered', $user_details);
            //     if ($package_id) {
            //         $this->helper_model->updateSalesCount($package_id, 1);
            //         $this->addOrder($add_user, $user_details, $package_id);
            //     }
            //     $res = $plan_obj->distributeCommissionBasedPlan($add_user, $package_id, $sponsor_id);
            //     $this->base_model->transationCommit();

            //     if ($_SERVER['HTTP_HOST'] != 'localhost') {
            //         //For Bulk SMS
            //         if ($this->dbvars->SMS_MODULES_STATUS > 0 && $this->dbvars->REG_SMS_PERMISSION > 0) {
            //             $message = $this->dbvars->REG_SMS_CONTENT;
            //             $mobile = $this->helper_model->getCompleteMobileNumber($add_user);
            //             $res = $this->helper_model->bulkSMS($mobile, $message);
            //         }

            //         //for Email Notifications
            //         $this->load->model('send_mail_model');
            //         if ($this->dbvars->EMAIL_VERIFICATION_STATUS) {
            //             $data['ver_code'] = $this->helper_model->generateRandomString(8);
            //             $this->send_mail_model->send($add_user, '', 'send_verification_code', $data);
            //             $this->helper_model->updateEmailVerfication($add_user, $data['ver_code']);
            //         }
            //         $this->send_mail_model->send($add_user, $user_details['email'], 'register_mail', $user_details);
            //         $admin_mail_id = $this->helper_model->getAdminMailId();
            //         $this->send_mail_model->send('', $admin_mail_id, 'new_register_mail', $user_details);
            //     }
            // }
        } else {
            $this->base_model->transationRollback();
            $failed_data = array('register_type' => $register_type, 'user_details' => $user_details, 'mlm_plan' => $mlm_plan, 'package_id' => $package_id);
            $this->helper_model->insertFailedActivity($sponsor_id, 'reg_fai-2', $failed_data);
        }
        return $new_user;
    }

    /**
     * For create user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_details
     * @param type $package_id
     * @return type
     */
    public function createUsers($user_details, $package_id = 0) {
        $password = hash("sha256", $user_details['password']);
        if ($_SERVER['HTTP_HOST'] == 'localhost' || strpos($_SERVER['HTTP_HOST'], "leadmlm") > 0) {
            $transaction_pass = '123456';
        } else {
            $transaction_pass = $this->generateRandomString();
        }

        $customer_id = isset($user_details['customer_id']) ? $user_details['customer_id'] : '0';
        $this->db->set('user_name ', $user_details['user_name'])
                ->set('email', $user_details['email'])
                ->set('password ', $password)
                ->set('tran_password', $transaction_pass)
                // ->set('position', $user_details['leg'])
                ->set('position',1)

                ->set('reg_pack', $package_id)
                ->set('user_type', 'user')
                // ->set('father_id ', $user_details['father_id'])
                // ->set('sponsor_id', $user_details['sponsor_id'])
                // ->set('reg_fee', $user_details['reg_amount'])
                ->set('father_id ', 1900)//$user_details['father_id'])
                ->set('sponsor_id', 1900)//$user_details['sponsor_id'])
                ->set('reg_fee',0)// $user_details['reg_amount'])
                ->set('user_status', 'active')
                ->set('date', $user_details['date_of_joining'])
                ->set('customer_id', $customer_id)
                ->insert('user');
        return $this->db->insert_id();
    }

    /**
     * for generate the random string
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function generateRandomString() {
        $this->load->helper('string');
        return random_string('alnum', 8);
    }

    /**
     * For insert user details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_details
     * @return type
     */
    public function insertUserDetails($user_id, $user_details) {
        $this->db->set('mlm_user_id ', $user_id);
        $this->db->set('first_name', $user_details['first_name']);
        $this->db->set('last_name', $user_details['last_name']);
        $this->db->set('country_id', $user_details['country']);
        $this->db->set('state_id', $user_details['state']);
        if ($user_details['del_data_type'] == 'same') {
            $this->db->set('shipping_country', $user_details['country']);
            $this->db->set('shipping_state', $user_details['state']);
        } else {
            $this->db->set('shipping_country', isset($user_details['del_country']) ? $user_details['del_country'] : $user_details['country']);
            $this->db->set('shipping_state', isset($user_details['del_state']) ? $user_details['del_state'] : $user_details['country']);
        }
        $this->db->set('date_of_joining', $user_details['date_of_joining']);
        $this->db->insert('user_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update user details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_details
     * @return type
     */
    public function updateUserDetails($user_id, $user_details) {
        $this->db->set('first_name', $user_details['first_name']);
        $this->db->set('last_name ', $user_details['last_name']);
        $this->db->set('address_1', $user_details['address']);
        $this->db->set('city', $user_details['city']);
        $this->db->set('zip_code', $user_details['zip_code']);

        if ($user_details['del_data_type'] == 'same') {
            $this->db->set('shipping_address', $user_details['address']);
            $this->db->set('shipping_city', $user_details['city']);
            $this->db->set('shipping_zipcode', $user_details['zip_code']);
        } else {
            $this->db->set('shipping_address', isset($user_details['del_address']) ? $user_details['del_address'] : $user_details['address']);
            $this->db->set('shipping_city', isset($user_details['del_city']) ? $user_details['del_city'] : $user_details['city']);
            $this->db->set('shipping_zipcode', isset($user_details['del_zip_code']) ? $user_details['del_zip_code'] : $user_details['zip_code']);
        }
        $this->db->set('gender', $user_details['gender']);
        $this->db->set('phone_number', $user_details['phone_number']);
        $this->db->where('mlm_user_id', $user_id);
        $this->db->update('user_details');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For insert user entry
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $package_id
     * @return boolean
     */
    public function insertUsersEntry($user_id, $package_id = 0, $country_id = 0, $state_id = 0) {
        $amount = 0;
        if ($package_id) {
            $amount = $this->helper_model->getUplineUpdateValue('product_amount', $package_id);
        }
        $user_balance = $this->db->set('mlm_user_id ', $user_id)
                ->set('balance_amount', 0)
                ->set('total_amount ', 0)
                ->set('released_amount', 0)
                ->set('coupon_balance', $amount)
                ->insert('user_balance');

        $theme_settings = $this->db->set('user_id ', $user_id)
                ->insert('theme_settings');

        $this->db->set('user_id', $user_id);
        if ($this->dbvars->PRESET_DEMO_STATUS) {
            $this->db->set('paypal_email', 'pay@leadmlmsoftware.com');
            $this->db->set('bank_name', 'ICICI');
            $this->db->set('bank_ac_holder_name', 'Techffodils');
            $this->db->set('bank_ac_number', '298796784564356');
            $this->db->set('bank_branch', 'Kallyi');
            $this->db->set('bank_ifsc_code', '567564');
            $this->db->set('paypal_email', 'pay@leadmlmsoftware.com');
            $this->db->set('wallet_address', 'GDSDJGEJFSKJDIFJIOJFIHSFSFSDSORP');
        }
        $pay_settings = $this->db->insert('user_payment_config');

        if ($this->dbvars->INVESTMENT_STATUS)
            $this->initiateInvestmentAddition($user_id);

        if ($country_id) {
            $this->db->set('reg_count', 'ROUND(reg_count + 1)', FALSE)
                    ->where('id', $country_id)
                    ->limit(1)
                    ->update('countries');
        }

        if ($state_id) {
            $this->db->set('reg_count', 'ROUND(reg_count + 1)', FALSE)
                    ->where('id', $state_id)
                    ->limit(1)
                    ->update('states');
        }
        if ($user_balance && $theme_settings && $pay_settings) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * For insert the register history
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $add_user
     * @param type $register_type
     * @param type $user_details
     */
    public function insertRegisterHistory($add_user, $register_type, $user_details) {
        $this->db->set('mlm_user_id ', $add_user)
                ->set('register_type', $register_type)
                ->set('user_details ', serialize($user_details))
                ->set('date', $user_details['date_of_joining'])
                ->set('payment_type', $user_details['payment_method'])
                ->insert('register_history');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update the advanced registration user details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_details
     * @return type
     */
    public function updateAdvancedUserDetails($user_id, $user_details) {
        $res = 0;
        $new = $this->getAllNewRegFields();
        if (count($new)) {
            foreach ($new as $fld) {
                if ($this->checkTable($fld['name'])) {
                    if (isset($user_details[$fld['name']])) {
                        $val = $user_details[$fld['name']];
                    } else {
                        $val = $fld['default_value'];
                    }
                    $this->db->set($fld['name'], $val);
                }
            }

            $this->db->set('shipping_address', isset($user_details['address']) ? $user_details['address'] : '');
            $this->db->set('shipping_city', isset($user_details['city']) ? $user_details['city'] : '');
            $this->db->set('shipping_zipcode', isset($user_details['state']) ? $user_details['state'] : '');
            $this->db->where('mlm_user_id', $user_id);
            $res = $this->db->update('user_details');
        }
        return $res;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $field
     * @return int
     */
    function checkTable($field) {
        $res = 0;
        $columns = $this->db->list_fields('user_details');
        foreach ($columns AS $key => $value) {
            if ($value == $field) {
                $res = 1;
            }
        }
        return $res;
    }

    /**
     * For all newly added registration fields
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllNewRegFields() {
        $data = array();
        $query = $this->db->select("field_name,default_value")
                ->from("register_fields")
                ->where("status", 'active')
                ->where("editable_status", '1')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['name'] = $row['field_name'];
            $data[$i]['default_value'] = $row['default_value'];
            $i++;
        }
        return $data;
    }

    /**
     * For getting the user level
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getUserLevel($user_id) {
        return $this->db->select('mlm_user_id')
                        ->from("user")
                        ->where('father_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For get last user ID
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getLastUserId() {
        $mlm_user_id = '';
        $query = $this->db->select('mlm_user_id')
                ->order_by('mlm_user_id', 'DESC')
                ->limit(1)
                ->get('users');
        foreach ($query->result() as $val) {
            $mlm_user_id = $val->mlm_user_id;
        }
        return $mlm_user_id;
    }

    /**
     * For generate the random username
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $length
     * @return string
     */
    public function generateRandomUsername($length) {
        $username = '';
        $this->load->helper('string');
        $username_prefix = $this->dbvars->USERNAME_PREFIX;
        $flag = 1;
        while ($flag) {
            $username = $username_prefix . random_string('alnum', $length);
            if (!$this->helper_model->userNameToID($username)) {
                $flag = 0;
            }
        }
        return $username;
    }

    /**
     * For getting all registration Fields
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $country
     * @param type $mlm_plan
     * @param type $username_type
     * @return type
     */
    function getAllRegFields($country = '', $mlm_plan = '', $username_type = '') {
        $data = array();
        $data['step-1'] = $data['step-2'] = $data['step-3'] = array();
        $query = $this->db->select("*")
                ->from("register_fields")
                ->where("status", 'active')
                ->order_by('register_step', 'ASC')
                ->order_by('order', 'ASC')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $flag = 1;
            if ($row['field_name'] == "username" && $username_type == 'dynamic') {
                $flag = 0;
            }
            if ($row['field_name'] == "register_leg" && ($mlm_plan != 'BINARY')) {
                $flag = 0;
            }
            if ($flag) {
                $data[$row['register_step']][$i] = $row;

                switch ($row['register_step']) {
                    case "step-1" :
                        $tab_index = '1' . $row['order'];
                        break;
                    case "step-2" :
                        $tab_index = '2' . $row['order'];
                        break;
                    case "step-3" :
                        $tab_index = '3' . $row['order'];
                        break;
                    default : {
                            $tab_index = '1';
                            break;
                        }
                }
                $data[$row['register_step']][$i]['tab_index'] = $tab_index;
                $data[$row['register_step']][$i]['select_box_values'] = array();
                switch ($row['field_name']) {
                    case "country" :
                        $data[$row['register_step']][$i]['select_box_values'] = $this->helper_model->getAllCountries();
                        break;
                    case "state":
                        $data[$row['register_step']][$i]['select_box_values'] = $this->helper_model->getAllStates($country);
                        break;
                    case "register_leg": {
                            $data[$row['register_step']][$i]['select_box_values'][1]['id'] = 'L';
                            $data[$row['register_step']][$i]['select_box_values'][1]['name'] = lang('left');
                            $data[$row['register_step']][$i]['select_box_values'][2]['id'] = 'R';
                            $data[$row['register_step']][$i]['select_box_values'][2]['name'] = lang('right');
                            break;
                        }
                    default : {
                            $data[$row['register_step']][$i]['select_box_values'][1]['id'] = $row['select_option1'];
                            $data[$row['register_step']][$i]['select_box_values'][1]['name'] = $row['select_option1'];
                            $data[$row['register_step']][$i]['select_box_values'][2]['id'] = $row['select_option2'];
                            $data[$row['register_step']][$i]['select_box_values'][2]['name'] = $row['select_option2'];
                            $data[$row['register_step']][$i]['select_box_values'][3]['id'] = $row['select_option3'];
                            $data[$row['register_step']][$i]['select_box_values'][3]['name'] = $row['select_option3'];
                            $data[$row['register_step']][$i]['select_box_values'][4]['id'] = $row['select_option4'];
                            $data[$row['register_step']][$i]['select_box_values'][4]['name'] = $row['select_option4'];
                            break;
                        }
                }
                $i++;
            }
        }
        return $data;
    }

    /**
     * for getting the active payment methods
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAvailablePaymentMethods() {
        $data = array();
        $query = $this->db->select("code,payment_method")
                ->from("payment_methods")
                ->where("status", 'active')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['code'] = $row['code'];
            $data[$i]['payment_method'] = $row['payment_method'];
            $i++;
        }
        return $data;
    }

    /**
     * for checking the username exits in the pending table
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $username
     * @return type
     */
    public function checkInPending($username) {
        $user_id = 0;
        $query = $this->db->select('id')
                ->where('user_name', $username)
                ->where('status', 'pending')
                ->limit(1)
                ->get('pending_registrations');
        foreach ($query->result() as $row) {
            $user_id = $row->id;
        }
        return $user_id;
    }

    /**
     * For check email exits in pending table
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $email
     * @return type
     */
    public function checkEmailInPending($email) {
        $user_id = 0;
        $query = $this->db->select('id')
                ->where('email', $email)
                ->where('status', 'pending')
                ->limit(1)
                ->get('pending_registrations');
        foreach ($query->result() as $row) {
            $user_id = $row->id;
        }
        return $user_id;
    }

    /**
     * For insert the details to pending users table
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $payment_method
     * @param type $register_type
     * @param type $user_details
     * @param type $mlm_plan
     * @param type $leg_type
     * @param type $reg_amount
     * @param type $package_id
     * @param type $mail_flag
     * @return type
     */
    function addToPendingUser($payment_method, $register_type, $user_details, $mlm_plan, $leg_type, $reg_amount, $package_id, $mail_flag = 1) {
        $user_details['sponsor_id'] = $this->helper_model->userNameToID($user_details['sponser_name']);
        $this->db->set('user_name ', $user_details['username'])
                ->set('email', $user_details['email'])
                ->set('payment_method', $payment_method)
                ->set('register_type ', $register_type)
                ->set('user_details', serialize($user_details))
                ->set('mlm_plan', $mlm_plan)
                ->set('leg_type', $leg_type)
                ->set('reg_amount', $reg_amount)
                ->set('package_id', $package_id)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('pending_registrations');
        $res = $this->db->insert_id();
        if ($res && $mail_flag) {
            $this->load->model('send_mail_model');
            $this->send_mail_model->send(0, $user_details['email'], 'pending_register_mail', $user_details);
        }
        return $res;
    }

    /**
     * For validate the user transaction password
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $username
     * @param type $tran_pass
     * @param type $amount
     * @return int
     */
    function validateuserTransaction($username, $tran_pass, $amount) {
        $val = $this->db->select('mlm_user_id')
                ->from("user")
                ->where('tran_password', $tran_pass)
                ->where('user_name', $username)
                ->count_all_results();
        if ($val) {
            $user_id = $this->helper_model->userNameToID($username);
            if ($this->helper_model->getUserBalance($user_id) >= $amount) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * For get all Products
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllProducts() {
        $data = array();
        $res = $this->db->select("id,product_name,product_amount,product_pv,product_code,images,recurring_type")
                ->from("products")
                ->where("status", '1')
                ->where("product_type", 'register')
                ->order_by('id', 'DESC')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['product_name'] = $short_name = $row->product_name;
            if (strlen($row->product_name) > 15) {
                $short_name = substr($row->product_name, 0, 15) . '...';
            }
            $data[$i]['short_name'] = $short_name;
            $data[$i]['product_amount'] = $row->product_amount;
            $data[$i]['product_pv'] = $row->product_pv;
            $data[$i]['product_code'] = $row->product_code;
            $images = unserialize($row->images);
            $data[$i]['images'] = $images;
            $data[$i]['recurring_type'] = $row->recurring_type;
            $i++;
        }
        return $data;
    }

    /**
     * For get product details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $product_id
     * @return type
     */
    function getProductDetails($product_id) {
        $data = array();
        $res = $this->db->select('product_name,product_amount,product_pv,product_code,images,recurring_type,description,product_type')
                ->from('products')
                ->where('id', $product_id)
                ->limit('1')
                ->get();
        foreach ($res->result() as $row) {
            $data['product_name'] = $row->product_name;
            $data['product_amount'] = $row->product_amount;
            $data['product_pv'] = $row->product_pv;
            $data['product_code'] = $row->product_code;
            $images = unserialize($row->images);
            $data['images'] = $images;
            $data['recurring_type'] = $row->recurring_type;
            $data['description'] = $row->description;
            $data['product_type'] = $row->product_type;
        }
        return $data;
    }

    /**
     * For check registration product
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $product_id
     * @return int
     */
    function checkRegProduct($product_id) {
        $val = $this->db->select('id')
                ->from("products")
                ->where('product_type', 'register')
                ->where('status', '1')
                ->where('id', $product_id)
                ->limit('1')
                ->count_all_results();
        if ($val) {
            return 1;
        }
        return 0;
    }

    /**
     * For getting the registration product amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $product_id
     * @return type
     */
    public function getRegProductAmount($product_id) {
        $product_amount = 0;
        $query = $this->db->select('product_amount')
                ->where('id', $product_id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $row) {
            $product_amount = $row->product_amount;
        }
        return $product_amount;
    }

    public function getRegProductImage($product_id) {
        $pro_image = 'our-products.png';
        $query = $this->db->select('images')
                ->where('id', $product_id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $row) {
            $image = unserialize($row->images);
            if (count($image)) {
                $pro_image = $image[0]['file_name'];
            }
        }
        return $pro_image;
    }

    /**
     * For getting the investment addition
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $add_user
     * @return boolean
     */
    public function initiateInvestmentAddition($add_user) {
        $this->db->set('mlm_user_id', $add_user)
                ->insert('investment_user_balance');
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }

    /**
     * For call the checkEPinValidOrNotGetEPinDetails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin
     * @param type $epin_user_id
     * @return type
     */
    function checkEpinDataValidOrNot($epin, $epin_user_id) {
        return $this->checkEPinValidOrNotGetEPinDetails($epin);
    }

    /**
     * For getting the count epin exits or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin
     * @return type
     */
    function checkEPinValidOrNotGetEPinDetails($epin) {

        $res = $this->db->select('*')
                ->from('pin_numbers')
                ->where_in('pin_number', $epin)
                ->where('balance_amount >', 0)
                ->where('status', 1)
                ->where('expiry_date >=', date("Y-m-d"))
                ->count_all_results();


        return $res;
    }

    /**
     * For checking E-pin Data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin
     * @param type $total_amount
     * @param type $user_id
     * @return type
     */
    function checkEpinData($epin, $total_amount, $user_id) {
        $this->load->model('cart_model');
        return $this->cart_model->checkEpinDetails($epin, $total_amount, $user_id, 'register');
    }

    /**
     * For check Epin valid or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin
     * @param type $user_name
     * @return type
     */
    function checkEpinValidate($epin, $user_name) {
        $flag = false;
        $epin_id = [];
        if (is_array($epin)) {
            $flag = $this->checkEpinExitsOrNot($epin, $user_name);
        }

        return $flag;
    }

    /**
     * For check E-pin Exits Or Not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin_arr
     * @param type $user_name
     * @return boolean
     */
    function checkEpinExitsOrNot($epin_arr, $user_name) {

        $user_id = $this->helper_model->userNameToId($user_name);


        $status = $this->db->select('count(*)')
                ->from('pin_numbers')
                ->where_in('pin_number', $epin_arr)
                ->where('mlm_user_id', $user_id)
                ->count_all_results();


        if ($status > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * For getting the registration Preview details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getPreviewDetails($user_id) {
        $user_details = array();
        $query = $this->db->select('user_details')
                ->from('register_history')
                ->where('mlm_user_id', $user_id)
                ->limit('1')
                ->get();
        if ($query->num_rows() > 0) {
            $user_details = unserialize($query->row()->user_details);
            $user_details['date'] = date('M d Y');
            $user_details['tran_password'] = $this->helper_model->getTransactionPassword($user_id);
            $user_details['product'] = $this->getUserPackageDetails($user_details['package_id']);
        }
        return $user_details;
    }

    /**
     * For getting the user package details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $product_id
     * @return int
     */
    function getUserPackageDetails($product_id) {
        $user_details = array();
        $query = $this->db->select('product_name,product_amount,description')
                ->from('products')
                ->where('id', $product_id)
                ->limit('1')
                ->get();
        if ($query->num_rows() > 0) {
            $user_details['product_name'] = $query->row()->product_name;
            $user_details['product_amount'] = $query->row()->product_amount;
            $user_details['description'] = $query->row()->description;
            $user_details['quantity'] = 1;
        }
        return $user_details;
    }

    /**
     * For add order to the order table
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_details
     * @param type $package_id
     * @return type
     */
    function addOrder($user_id, $user_details, $package_id) {
        $amounts = $user_details['total_amount_data'];
        $total_pv = $this->helper_model->getUplineUpdateValue('product_pv', $package_id);
        $recurring_type = $this->helper_model->getUplineUpdateValue('recurring_type', $package_id);
        $res = $this->db->set('user_id ', $user_id)
                ->set('total_amount', $user_details['order_amount'])
                ->set('total_pv ', $total_pv)
                ->set('product_count', 1)
                ->set('payment_type', $user_details['payment_method'])
                ->set('order_date', $user_details['date_of_joining'])
                ->set('confirm_date ', $user_details['date_of_joining'])
                ->set('address ', isset($user_details['address']) ? $user_details['address'] : 'NA')
                ->set('country ', isset($user_details['country']) ? $user_details['country'] : '0')
                ->set('state ', isset($user_details['state']) ? $user_details['state'] : '0')
                ->set('city ', isset($user_details['city']) ? $user_details['city'] : 'NA')
                ->set('zip_code ', isset($user_details['zip_code']) ? $user_details['zip_code'] : '0')
                ->set('order_status ', 1)
                ->set('delivery_charge ', $amounts['delivery_charge'])
                ->set('shipping_charge ', $amounts['shipping_charge'])
                ->set('tax', $amounts['tax'])
                ->set('order_type', 'register')
                ->insert('orders');
        if ($res) {
            $order_id = $this->db->insert_id();
            $expiry_date = date("Y-m-d H:i:s");
            $category_id = '';
            if ($this->dbvars->INVESTMENT_STATUS > 0) {
                $category_id = $this->helper_model->getInvestCategoryId($package_id);
                $expiry_date = $this->helper_model->getInvestExpiry($package_id);
            }
            $this->db->set('order_id ', $order_id)
                    ->set('product_id', $package_id)
                    ->set('party_id', 0)
                    ->set('quantity ', 1)
                    ->set('amount', $this->getRegProductAmount($package_id))
                    ->set('pv', $total_pv)
                    ->set('recurring ', $recurring_type)
                    ->set('date ', $user_details['date_of_joining'])
                    ->set('category_id', $category_id)
                    ->set('expiry_date', $expiry_date)
                    ->set('image', $this->getRegProductImage($package_id))
                    ->insert('order_products');
        }
        return $order_id;
    }

    /**
     * For check the E-pin Valid Or Not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $pin_arr
     * @return type
     */
    function checkEpinValidOrNot($pin_arr) {
        $query = $this->db->select('*')
                ->from('pin_numbers')
                ->where_in('pin_number', $pin_arr)
                ->where('status', 1)
                ->where('expiry_date >=', date('Y-m-d H:i:s'))
                ->count_all_results();
        //echo $this->db->last_query();die;
        return $query;
    }

    /**
     * For getting the count of user created E-pins
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $pin_arr
     * @param type $user_id
     * @return boolean
     */
    function epinCreatedByUser($pin_arr, $user_id) {

        $status = $this->db->select('count(*)')
                ->from('pin_numbers')
                ->where_in('pin_number', $pin_arr)
                ->where('mlm_user_id', $user_id)
                ->where('expiry_date >=', date('y-m-d H:i:s'))
                ->count_all_results();

        if ($status > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * For getting the E-pin balance amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin_arr
     * @param type $user_id
     * @param type $total
     * @return boolean
     */
    function getEpinBalanceAmount($epin_arr, $user_id, $total) {
        $this->load->model('cart_model');
        $balance_amount = $this->getPinAmountByUserId($epin_arr, $user_id);

        if ($balance_amount >= $total) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * For getting the E-pin amount
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $epin_arr
     * @param type $user_id
     * @return type
     */
    function getPinAmountByUserId($epin_arr, $user_id) {
        $amount = $this->db->select_sum('balance_amount')
                ->from('pin_numbers')
                ->where_in('pin_number', $epin_arr)
                ->where('mlm_user_id', $user_id)
                ->get();

        if ($amount->num_rows() > 0) {
            return $amount->row()->balance_amount;
        }
        return 0;
    }

    /**
     * For update paypal reposnse reference
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $reference
     * @return type
     */
    function updatePaypalReference($id, $reference) {
        $this->db->set('paypal_reference', $reference);
        $this->db->where('id', $id);
        $this->db->update('pending_registrations');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the pending details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $paypal_reference
     * @return int
     */
    function getPendingDetails($id = 0, $paypal_reference = '') {
        $this->db->select('user_name,email,payment_method,reg_amount,user_details,mlm_plan,register_type,leg_type,package_id');
        $this->db->from('pending_registrations');
        if ($id) {
            $this->db->where('id', $id);
        } else {
            $this->db->where('paypal_reference', $paypal_reference);
        }
        $this->db->where('status', 'pending');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $user_details = array();
            $user_details['user_name'] = $query->row()->user_name;
            $user_details['email'] = $query->row()->email;
            $user_details['payment_method'] = $query->row()->payment_method;
            $user_details['reg_amount'] = $query->row()->reg_amount;
            $user_details['user_details'] = unserialize($query->row()->user_details);
            $user_details['user_details']['sponser_name'] = $this->helper_model->IdToUserName($user_details['user_details']['sponsor_id']);
            $user_details['mlm_plan'] = $query->row()->mlm_plan;
            $user_details['register_type'] = $query->row()->register_type;
            $user_details['leg_type'] = $query->row()->leg_type;
            $user_details['package_id'] = $query->row()->package_id;
            return $user_details;
        } else {
            return 0;
        }
    }

    /**
     * For update the pay-pal response
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @param type $reference
     * @return type
     */
    function updatePaypalResponse($data, $reference) {
        $this->db->set('paypal_response', serialize($data));
        $this->db->where('paypal_reference', $reference);
        $this->db->update('pending_registrations');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update the payment status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $reference
     * @return type
     */
    function updatePaymentStatus($reference, $id = 0) {
        $this->db->set('payment_status', 1);
        if ($id) {
            $this->db->where('id', $id);
        } else {
            $this->db->where('paypal_reference', $reference);
        }
        $this->db->update('pending_registrations');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update the register status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $reference
     * @return type
     */
    function updateRegisterStatus($reference, $id = 0) {
        $this->db->set('register_status', 1);
        $this->db->set('status', 'registered');
        if ($id) {
            $this->db->where('id', $id);
        } else {
            $this->db->where('paypal_reference', $reference);
        }
        $this->db->update('pending_registrations');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the pending Pre-view details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $pend_id
     * @return type
     */
    function getPendingPreviewDetails($pend_id) {
        $user_details = array();
        $query = $this->db->select('user_details')
                ->from('pending_registrations')
                ->where('id', $pend_id)
                ->limit('1')
                ->get();
        if ($query->num_rows() > 0) {
            $user_details = unserialize($query->row()->user_details);
            $user_details['date'] = date('M d Y');
            $user_details['new_user_id'] = $pend_id;
        }
        return $user_details;
    }

}
