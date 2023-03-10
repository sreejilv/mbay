<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For member related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    member
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Member_model extends CI_Model {

    /**
     * for checking username availability
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_name
     * @return type
     */
    public function checkUserNameExisit($user_name) {
        $count1 = $this->checkUserNamePending($user_name);
        $count2 = $this->checkUserName($user_name);
        return $count = $count1 + $count2;
    }

    /**
     * for checking email availability
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $email
     * @return type
     */
    public function checkUserEmailExisit($email) {
        $count1 = $this->checkUserEmailPending($email);
        $count2 = $this->checkUserEmail($email);
        return $count = $count1 + $count2;
    }

    /**
     * for checking username availability
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_name
     * @return type
     */
    public function checkUserName($user_name) {
        $table = "mlm_user";
        $query = $this->db->query("SELECT COUNT(`user_name`) AS count FROM $table WHERE `user_name` = '$user_name'");
        $count = $query->row_array()['count'];
        return $count !== NULL && $count > 0;
    }

    /**
     * for checking username in pending registration
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_name
     * @return type
     */
    public function checkUserNamePending($user_name) {
        $table = "mlm_pending_registrations";
        $query = $this->db->query("SELECT COUNT(`user_name`) AS count FROM $table WHERE `status`='pending' AND `user_name` = '$user_name'");
        $count = $query->row_array()['count'];
        return $count !== NULL && $count > 0;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $email
     * @return type
     */
    public function checkUserEmailPending($email) {
        $table = "mlm_pending_registrations";
        $query = $this->db->query("SELECT COUNT(`email`) AS count FROM $table WHERE `status`='pending' AND `email` = '$email'");
        $count = $query->row_array()['count'];
        return $count !== NULL && $count > 0;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $email
     * @return type
     */
    public function checkUserEmail($email) {
        $table = "mlm_user";
        $query = $this->db->query("SELECT COUNT(`email`) AS count FROM $table WHERE `email` = '$email'");
        $count = $query->row_array()['count'];
        return $count !== NULL && $count > 0;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $tran_password
     * @return type
     */
    function updateTranPassword($user_id, $tran_password) {
        $this->db->set('tran_password ', "$tran_password")
                ->where('mlm_user_id ', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_name
     * @return type
     */
    function updateUserName($user_id, $user_name) {
        $this->db->set('user_name ', "$user_name")
                ->where('mlm_user_id ', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $email
     * @return type
     */
    function updateUserEmail($user_id, $email) {
        $this->db->set('email', "$email")
                ->where('mlm_user_id', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $password
     * @return type
     */
    function updatePassword($user_id, $password) {
        $sha_password = hash("sha256", $password);
        $this->db->set('password ', "$sha_password")
                ->where('mlm_user_id ', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $query
     * @return type
     */
    function getAllUserNames($query) {
        $data = array();
        if ($query != '') {
            $res = $this->db->select("user_name")
                    ->from('user')
                    ->like('user_name', trim($query))
                    ->get();
        } else {
            $res = $this->db->select("user_name")
                    ->from('user')
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            $json[] = $row['user_name'];
        }

        return json_encode($json);
    }

    /**
     * For activate and in-activate user
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $status
     * @return type
     */
    function activateInactivateUser($user_id, $status) {
        $this->db->set('user_status ', $status)
                ->where('mlm_user_id ', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the transaction Password
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getTransationPassword($id) {
        $tran_password = '';
        $query = $this->db->select('tran_password')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $tran_password = $row->tran_password;
        }
        return $tran_password;
    }

    /**
     * For get Password
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getPassword($id) {
        $password = '';
        $query = $this->db->select('password')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $password = $row->password;
        }
        return $password;
    }

    /**
     * For get user name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getUserName($id) {
        $user_name = '';
        $query = $this->db->select('user_name')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $user_name = $row->user_name;
        }
        return $user_name;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getUserStatus($id) {
        $user_status = '';
        $query = $this->db->select('user_status')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $user_status = $row->user_status;
        }
        return $user_status;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function registrationBlockStatus() {
        $value = '';
        $query = $this->db->select('registration_block')
                ->from('configuration')
                ->get();
        foreach ($query->result() as $row) {
            $value = $row->registration_block;
        }
        return $value;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function maintenceStatus() {
        $value = '';
        $query = $this->db->select('maintence_mode')
                ->from('configuration')
                ->get();
        foreach ($query->result() as $row) {
            $value = $row->maintence_mode;
        }
        return $value;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $status
     * @return type
     */
    function updateUserStatus($user_id, $status) {
        $this->db->set('user_status ', "$status")
                ->where('mlm_user_id ', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @return type
     */
    function changeRegistrationStatus($status) {
        $this->db->set('registration_block ', "$status")
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @return type
     */
    function changeMaintenceStatus($status) {
        $this->db->set('maintence_mode ', "$status")
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @param type $time
     * @return type
     */
    function insertMaintenceStatusHistory($status, $time) {
        $date = date('Y-m-d H:i:s');
        $this->db->set('date', $date)
                ->set('setdate', $time)
                ->set('status', $status)
                ->insert('maintence_mode_history');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @return type
     */
    function updateMaintenceHistory($status) {
        $this->db->set('status ', "$status")
                ->update('maintence_mode_history');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getLogUserStatus($id) {
        $user_status = '';
        $query = $this->db->select('login_block')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->where('user_type !=', 'admin')
                ->get();
        foreach ($query->result() as $row) {
            $user_status = $row->login_block;
        }
        return $user_status;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getregUserStatus($id) {
        $user_status = '';
        $query = $this->db->select('registration_block')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $user_status = $row->registration_block;
        }
        return $user_status;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $status
     * @param type $field
     * @return boolean
     */
    function updateBlockStatus($user_id, $status, $field) {
        $result = false;
        $this->db->set($field, "$status");
        $this->db->where('mlm_user_id ', $user_id);
        if ($field == 'login_block')
            $this->db->where('user_type !=', 'admin');
        $result = $this->db->update('user');
        if ($this->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllPendingRegistrations() {
        $data = array();
        $res = $this->db->select("id,user_name,email,payment_method,register_type,date,reg_amount")
                ->from("pending_registrations")
                ->where("status", 'pending')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['slno'] = $i + 1;
            $data[$i]['id'] = $row->id;
            $data[$i]['user_name'] = $row->user_name;
            $data[$i]['email'] = $row->email;
            $data[$i]['payment_method'] = $row->payment_method;
            $data[$i]['date'] = $row->date;
            $data[$i]['reg_amount'] = $row->reg_amount;
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    function updatePendingRequest($id, $status) {
        $this->db->set('status ', $status)
                ->where('id ', $id)
                ->update('pending_registrations');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function checkRequestValidity($id) {
        return $this->db->select('id')
                        ->from("pending_registrations")
                        ->where('status', "pending")
                        ->where('id', $id)
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function getRequestDetails($id) {
        $data = array();
        $res = $this->db->select("mlm_plan,payment_method,register_type,leg_type,user_details,package_id,reg_amount")
                ->from("pending_registrations")
                ->where("id", $id)
                ->get();
        foreach ($res->result() as $row) {
            $data['payment_method'] = $row->payment_method;
            $data['user_details'] = unserialize($row->user_details);
            $data['user_details']['sponser_name'] = $this->helper_model->IdToUserName($data['user_details']['sponsor_id']);
            $data['register_type'] = $row->register_type;
            $data['mlm_plan'] = $row->mlm_plan;
            $data['leg_type'] = $row->leg_type;
            $data['package_id'] = $row->package_id;
            $data['reg_amount'] = $row->reg_amount;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function getUserDefaultLeg($id) {
        $default_leg = '';
        $query = $this->db->select('default_leg')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $default_leg = $row->default_leg;
        }
        return $default_leg;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $leg
     * @return type
     */
    function updateDefaultLeg($id, $leg) {
        $this->db->set('default_leg', $leg)
                ->where('mlm_user_id ', $id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getAllPendingOrders() {
        $data = array();
        $res = $this->db->select("id,user_id,total_amount,product_count,payment_type,order_date")
                ->from("orders")
                ->where("order_status", 0)
                ->order_by('id', 'DESC')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['slno'] = $i + 1;
            $data[$i]['id'] = $row->id;
            $data[$i]['user_id'] = $row->user_id;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->user_id);
            $data[$i]['total_amount'] = $row->total_amount;
            $data[$i]['product_count'] = $row->product_count;
            $data[$i]['payment_type'] = $row->payment_type;
            $data[$i]['order_date'] = $row->order_date;
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $order_id
     * @return type
     */
    function deleteOrder($order_id) {
        $res = $this->db->where('id ', $order_id)
                ->where('order_status', 0)
                ->delete('orders');
        if ($res) {
            $this->db->where('order_id ', $order_id)
                    ->delete('order_products');
        }
        return $res;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function activateOrder($id) {
        $total_update_value = 0;
        $obj_class = "plan_" . strtolower($this->dbvars->MLM_PLAN) . "_model";
        include_once("Plan_" . strtolower($this->dbvars->MLM_PLAN) . "_model.php");
        $plan_obj = new $obj_class();
        if ($this->dbvars->INVESTMENT_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {
            $this->load->model('configuration_model');
            $investment_array = $this->configuration_model->getInvestmentDetails();
        }
        $user_id = $this->helper_model->getUserIdFromOrder($id);
        $order_flag = $this->db->set('order_status', 1)
                ->set('confirm_date', date("Y-m-d H:i:s"))
                ->where('id', $id)
                ->where('order_status', 0)
                ->update('orders');
        if ($order_flag && $this->db->affected_rows()) {
            $res = $this->db->select("id,product_id,quantity,amount,pv")
                    ->from("order_products")
                    ->where("order_id", $id)
                    ->get();
            $tot_pv = 0;
            foreach ($res->result() as $row) {
                $product_id = $row->product_id;
                $quantity = $row->quantity;
                $amount = $row->amount;
                $pv = $row->pv;
                $tot_pv += $pv * $amount;
                $op_id = $row->id;
                $this->helper_model->updateSalesCount($product_id, $quantity);
                if ($this->dbvars->INVESTMENT_STATUS > 0) {
                    $expiry_date = $this->helper_model->getInvestExpiry($product_id);
                    $this->db->set('expiry_date', $expiry_date)
                            ->where('id ', $op_id)
                            ->update('order_products');
                    if (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')
                        $plan_obj->distributeInvestmentBonus($user_id, $investment_array, $product_id);
                }

                if ($this->dbvars->UPLINE_UPDATE_VALUE == 'product_pv') {
                    $total_update_value += $pv * $quantity;
                } else {
                    $total_update_value += $amount * $quantity;
                }
            }

            $plan_obj->distributeRepurchaseCommission($user_id, $total_update_value);
            $arr['order_id'] = $id;
            $arr['user_id'] = $user_id;
            $arr['total_amount'] = $this->getOrderTotal($id);

            $this->load->model('send_mail_model');
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
        }
        return $order_flag;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function getOrderTotal($id) {
        $total_amount = 0;
        $query = $this->db->select('total_amount')
                ->where('id', $id)
                ->limit(1)
                ->get('orders');
        if ($query->num_rows() > 0) {
            $total_amount = $query->row()->total_amount;
        }
        return $total_amount;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $order_id
     * @return type
     */
    function getUserIdFromOrder($order_id) {
        $qry = $this->db->select('user_id')
                ->from('orders')
                ->where('id', $order_id)
                ->get();
        if ($qry->num_rows() > 0) {
            return $qry->row()->user_id;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function validateOrder($id) {
        return $this->db->select('id')
                        ->from("orders")
                        ->where('order_status', 0)
                        ->where('id', $id)
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $paypal_email
     * @return type
     */
    function updatePaypalAccountConfig($user_id, $paypal_email) {
        $this->db->set('paypal_email ', "$paypal_email")
                ->where('user_id ', $user_id)
                ->update('user_payment_config');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $wallet_address
     * @return type
     */
    function updateBlocktrailAccountConfig($user_id, $wallet_address) {
        $this->db->set('wallet_address', "$wallet_address")
                ->where('user_id', $user_id)
                ->update('user_payment_config');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $code
     * @return type
     */
    function getStatusPayment($code) {
        $data = array();
        $res = $this->db->select("status,payout_status")
                ->from("payment_methods")
                ->where("code", $code)
                ->where("status", 'active')
                ->where("payout_status", 'active')
                ->get();
        foreach ($res->result() as $row) {
            $data['status'] = $row->status;
            $data['payout_status'] = $row->payout_status;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $data
     * @return type
     */
    function updateBankAccountConfig($user_id, $data) {
        $this->db->set('bank_ac_holder_name ', $data['bank_ac_holder_name'])
                ->set('bank_ac_number', $data['bank_ac_number'])
                ->set('bank_name', $data['bank_name'])
                ->set('bank_branch ', $data['bank_branch'])
                ->set('bank_ifsc_code ', $data['bank_ifsc_code'])
                ->where('user_id ', $user_id)
                ->update('user_payment_config');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function getPaymentConfig($user_id, $id = '0') {
        $data = array();
        $res = $this->db->select("paypal_email,bank_ac_holder_name,bank_branch,bank_ac_number,bank_ifsc_code,bank_name,wallet_address,user_id")
                ->from("user_payment_config");
        if ($id) {
            $this->db->where("id", $id);
        } else {
            $this->db->where("user_id", $user_id);
        }

        $res = $this->db->get();
        foreach ($res->result() as $row) {
            $data['bank_ac_holder_name'] = $row->bank_ac_holder_name;
            $data['bank_name'] = $row->bank_name;
            $data['bank_ac_number'] = $row->bank_ac_number;
            $data['bank_branch'] = $row->bank_branch;
            $data['bank_ifsc_code'] = $row->bank_ifsc_code;
            $data['paypal_email'] = $row->paypal_email;
            $data['wallet_address'] = $row->wallet_address;
            $data['user_id'] = $row->user_id;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfPendingOrder() {
        return $this->db->select('id')
                        ->where("order_status", 0)
                        ->from('orders')
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnPendingOrder() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'product_count', 'dt' => 2),
            array('db' => 'payment_type', 'dt' => 3),
            array('db' => 'order_date', 'dt' => 4),
            array('db' => 'order_status', 'dt' => 5),
        );
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredPendingOrder($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND order_status=0 AND ";
        } else {
            $where = " WHERE order_status=0 AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.product_count,t2.total_amount,t2.payment_type,t2.order_date,t2.order_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.user_id ");
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataPendingOrder($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND order_status=0 AND ";
        } else {
            $where = " WHERE order_status=0 AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.product_count,t2.payment_type,t2.order_date,t2.order_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfPendingReg() {
        return $this->db->select('id')
                        ->where("status", 'pending')
                        ->where("email !=", 'purchase')
                        ->from("pending_registrations")
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnPendingReg() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'email', 'dt' => 2),
            array('db' => 'reg_amount', 'dt' => 3),
            array('db' => 'payment_method', 'dt' => 4),
            array('db' => 'date', 'dt' => 5),
            array('db' => 'status', 'dt' => 6)
        );
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredPendingReg($table, $where) {
        if ($where) {
            $where = $where . " AND status='pending' AND email!='purchase' ";
        } else {
            $where = " WHERE status='pending' AND email!='purchase' ";
        }

        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataPendingReg($table, $column, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND status='pending' AND email!='purchase' ";
        } else {
            $where = " WHERE status='pending' AND email!='purchase' ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $post_data
     * @return boolean
     */
    public function performPositionChange($post_data) {
        $change_user = $this->helper_model->userNameToID($post_data['username']);
        $new_position = $this->helper_model->userNameToID($post_data['new_position']);

        $mlm_plan = $this->dbvars->MLM_PLAN;
        $position = isset($post_data['position_leg']) ? $post_data['position_leg'] : '';
        $obj_class = "plan_" . strtolower($mlm_plan) . "_model";
        include_once("Plan_" . strtolower($mlm_plan) . "_model.php");
        $plan_obj = new $obj_class();

        $position_array = $plan_obj->createFatherID($new_position, $position);
        $father_id = $position_array['father_id'];
        $position = $position_array['position'];

        $update_status = $this->updatePositionChange($new_position, $father_id, $position, $change_user);

        if ($update_status) {
            if ($this->deleteFatherTraverse($change_user) AND $this->deleteSponsorTraverse($change_user)) {
                $traverse_father_status = $plan_obj->updateFatherTraverse($change_user, $father_id, $level = 1, $position); //Updating Traversing table
                $traverse_sponsor_status = $plan_obj->updateSponsorTraverse($change_user, $new_position, $level = 1); //Updating Traversing table
                if ($traverse_father_status AND $traverse_sponsor_status) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $sponsor_id
     * @param type $father_id
     * @param type $position
     * @param type $change_user
     * @return boolean
     */
    public function updatePositionChange($sponsor_id, $father_id, $position, $change_user) {
        $this->db->set('position', $position)
                ->set('father_id ', $father_id)
                ->set('sponsor_id', $sponsor_id)
                ->where('mlm_user_id', $change_user)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return boolean
     */
    public function deleteFatherTraverse($user_id) {
        $query = $this->db->where('user_id', $user_id)
                ->delete('traverse_father');
        if ($this->db->affected_rows()) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $user_id
     * @return boolean
     */
    public function deleteSponsorTraverse($user_id) {
        $query = $this->db->where('user_id', $user_id)
                ->delete('traverse_sponsor');
        if ($this->db->affected_rows()) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $post_data
     * @return boolean
     */
    public function performRemoveUser($post_data) {
        $delete_user = $this->helper_model->userNameToID($post_data['del_username']);

        $this->db->where('mlm_user_id', $delete_user)
                ->delete('user');

        if ($this->db->affected_rows() > 0) {
            $father_delete = $this->deleteFatherTraverse($delete_user);
            $sponsor_delete = $this->deleteSponsorTraverse($delete_user);
        }
        if ($father_delete AND $sponsor_delete) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getRecentDevices($user_id) {
        $data = array();
        $res = $this->db->select("ip_address,country,region,city,date,user_agent")
                ->from("activity")
                ->where("mlm_user_id", $user_id)
                ->where("activity", 'user_login')
                //->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
                ->order_by('id', 'DESC')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            if ($row->country != '') {
                $created = new Carbon($row->date);
                $now = Carbon::now();
                $difference = $created->diffForHumans($now);

                $data[$i]['ip_address'] = $row->ip_address;
                $data[$i]['country'] = $row->country;
                $data[$i]['region'] = $row->region;
                $data[$i]['city'] = $row->city;
                $data[$i]['date'] = $created;
                $data[$i]['carbon_date'] = $difference;
                $data[$i]['user_agent'] = $row->user_agent;
                $i++;
            }
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
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getUserRegLogStatus($user_id) {
        $data = array();
        $res = $this->db->select("user_status,login_block,registration_block")
                ->from("user")
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $data['login_block'] = $row->login_block;
            $data['status'] = $row->user_status;
            $data['registration_block'] = $row->registration_block;
        }
        return $data;
    }

    function checkUserCurrentPasswod($user_id, $password) {
        $id = 0;
        $query = $this->db->select('mlm_user_id')
                ->where('password', hash("sha256", $password))
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        foreach ($query->result() as $row) {
            $id = $row->mlm_user_id;
        }
        return $id;
    }

    /**
     * foe get all usernames
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $query
     * @return type
     */
    function getAllDownlineUserNames($query) {
        $downlines = $this->helper_model->getDownlinesUnilevel($this->aauth->getId());
        $data = array();
        if ($query != '') {
            $res = $this->db->select("mlm_user_id,user_name")
                    ->from('user')
                    ->like('user_name', trim($query))
                    ->where('user_type != ', 'admin')
                    ->get();
        } else {
            $res = $this->db->select("mlm_user_id,user_name")
                    ->from('user')
                    ->where('user_type != ', 'admin')
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            if (in_array($row['mlm_user_id'], $downlines))
                $json[] = $row['user_name'];
        }

        return json_encode($json);
    }

    function getTableColumnReortOrders() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't1.product_count', 'dt' => 2),
            array('db' => 't1.order_date', 'dt' => 3),
            array('db' => 't1.payment_type', 'dt' => 4)
        );
    }

    /**
     * For COUNT report orders
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countRportOrders($table1, $table2) {
        $where = " WHERE t1.order_status = 1 ";
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the filtered order report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredReportOrders($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND t1.order_status = 1  ";
        } else {
            $where = " WHERE t1.order_status = 1   ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the result all order details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataReportOrders($table1, $table2, $where, $order, $limit) {
        $data = array();

        if ($where) {
            $where = $where . " AND order_status = 1 ";
        } else {
            $where = " WHERE order_status = 1 ";
        }

        $query = $this->db->query("select t1.id,t2.user_name,t1.product_count,t1.order_date,t1.payment_type from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        if ($where) {
            $where = $where . " AND t1.order_status = 1  ";
        } else {
            $where = " WHERE t1.order_status = 1   ";
        }

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getAllProductDetails($order_id, $return_status = '') {
        $data = array();
        $details = '';
        $query = $this->db->select("id,amount,quantity,product_id,date")
                ->from("order_products")
                ->where("order_id", $order_id)
                ->get();
        $i = 0;
        $total = 0;
        $qty = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['amount'] = $row['amount'];
            $data[$i]['quantity'] = $row['quantity'];
            $data[$i]['product_name'] = $this->getProductName($row['product_id']);
            $sl = $i + 1;
            $pro_amount = round($data[$i]['amount'] * $data[$i]['quantity'], 8);
            $pro_amount_cur = $this->helper_model->currency_conversion($pro_amount);

            $return_link = '';
            if ($return_status && $this->dbvars->RETURN_STATUS > 0) {
                $limit = '-' . $this->dbvars->RETURN_DAY_LIMIT . ' days';
                $date_limit = date('Y-m-d', strtotime($limit));
                if ($row['date'] > $date_limit) {
                    $return_link = '<a class="btn btn-xs" href="user/product-return/' . $row['id'] . '" title="' . lang('return') . '"><i class="fa fa-share"></i></a>';
                }
            }

            $details = $details . "<tr><td>" . $sl . "</td><td>" . $data[$i]['product_name'] . "</td><td>" . $data[$i]['quantity'] . "</td><td>" . $pro_amount_cur . $return_link . "</td></tr>";

            $total += $pro_amount;

            $qty += $data[$i]['quantity'];

            $i++;
        }
        $tax = $this->getTaxAmount($order_id);
        $total_sub = $this->helper_model->currency_conversion($total);
        $total = $total + $tax;
        $tax = $this->helper_model->currency_conversion($tax);
        $total = $this->helper_model->currency_conversion($total);
        $details = '<table class="table " >'
                . '<tr style="font-weight:bold;"><td>' . lang('slno') . '</td><td>' . lang('product_name') . '</td><td>' . lang('count') . '</td><td>' . lang('Amount') . '</td></tr>' . $details
                . '<tr  style="font-weight:bold;"><td colspan="2" style="text-align:right;font-weight:bold;">' . lang('sub_total') . '</td><td>' . $qty . '</td><td>' . $total_sub . '</td></tr>'
                . '<tr  style="font-weight:bold;"><td colspan="2" style="text-align:right;font-weight:bold;">' . lang('other_charges') . '</td><td></td><td>' . $tax . '</td></tr>'
                . '<tr  style="font-weight:bold;"><td colspan="2" style="text-align:right;font-weight:bold;">' . lang('total') . '</td><td></td><td>' . $total . '</td></tr>'
                . '</table>';

        return $details;
    }

    public function getProductName($id) {
        $product_name = '';
        $query = $this->db->select("product_name")
                ->where("id", $id)
                ->limit(1)
                ->get("products");
        if ($query->num_rows() > 0) {
            $product_name = $query->row()->product_name;
        }
        return $product_name;
    }

    function getTableColumnReortOrdersUser() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'total_amount', 'dt' => 1),
            array('db' => 'order_date', 'dt' => 2),
            array('db' => 'payment_type', 'dt' => 3)
        );
    }

    /**
     * For COUNT report orders
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countRportOrdersUser($table) {
        $user_id = $this->aauth->getId();
        $where = " WHERE order_status = 1 AND user_id = $user_id";
        $query = $this->db->query("select user_id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the filtered order report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredReportOrdersUser($table, $where) {
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND order_status = 1 AND user_id = $user_id ";
        } else {
            $where = " WHERE order_status = 1  AND user_id = $user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the result all order details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataReportOrdersUser($table, $where, $order, $limit) {
        $data = array();
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND order_status = 1 AND user_id = $user_id ";
        } else {
            $where = " WHERE order_status = 1  AND user_id = $user_id ";
        }
        $query = $this->db->query("select id,total_amount,order_date,payment_type from " . $table . " " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    public function getTaxAmount($id) {
        $delivery_charge = '';
        $shipping_charge = '';
        $tax = '';
        $query = $this->db->select("delivery_charge,shipping_charge,tax")
                ->where("id", $id)
                ->limit(1)
                ->get("orders");
        if ($query->num_rows() > 0) {
            $delivery_charge = $query->row()->delivery_charge;
            $shipping_charge = $query->row()->shipping_charge;
            $tax = $query->row()->tax;
        }
        $total = $delivery_charge + $shipping_charge + $tax;
        return $total;
    }

    function getAllAffiliateUserNames($query) {
        $data = array();
        if ($query != '') {
            $res = $this->db->select("username")
                    ->from('affiliates')
                    ->like('username', trim($query))
                    ->get();
        } else {
            $res = $this->db->select("username")
                    ->from('affiliates')
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            $json[] = $row['username'];
        }

        return json_encode($json);
    }

    function getAllEmployeeUserNames($query) {
        $data = array();
        if ($query != '') {
            $res = $this->db->select("user_name")
                    ->from('employee_login')
                    ->like('user_name', trim($query))
                    ->get();
        } else {
            $res = $this->db->select("user_name")
                    ->from('employee_login')
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            $json[] = $row['user_name'];
        }

        return json_encode($json);
    }

    function getReturnProductDetails($ord_pro_id) {
        $data = array();
        $limit = '-' . $this->dbvars->RETURN_DAY_LIMIT . ' days';
        $date_limit = date('Y-m-d', strtotime($limit));

        $query = $this->db->select("order_id,product_id,quantity,amount,image")
                ->where("id", $ord_pro_id)
                ->where("date >", $date_limit)
                ->limit(1)
                ->get("order_products");
        foreach ($query->result_array() as $row) {
            $data['order_id'] = $row['order_id'];
            $data['order_product_id'] = $ord_pro_id;
            $data['product_id'] = $row['product_id'];

            $quantity = $row['quantity'];
            $returned = $this->getReturnCount($data['order_id'], $data['product_id']);

            $data['order_placed'] = $quantity;
            $data['order_returned'] = $returned;
            $data['amount'] = $this->helper_model->currency_conversion($row['amount']);
            $data['image'] = $row['image'];
            $data['pro_name'] = $this->getProductName($row['product_id']);


            $data['quantity'] = $quantity - $returned;
        }
        return $data;
    }

    function getReturnCount($order_id, $product_id) {
        $quantity = 0;
        $res = $this->db->select_sum('quantity')
                ->where('order_id', $order_id)
                ->where('product_id', $product_id)
                ->get('return');
        if ($res->num_rows() > 0 && $res->row()->quantity != '') {
            $quantity = $res->row()->quantity;
        }
        return $quantity;
    }

    function validateUserOrder($user_id, $order_id) {
        return $this->db->select('id')
                        ->from("orders")
                        ->where("user_id", $user_id)
                        ->where("id", $order_id)
                        ->count_all_results();
    }

    function addToReturn($user_id, $post, $data) {
        $this->db->set('user_id', $user_id)
                ->set('quantity', $post['quantity'])
                ->set('reason', $post['reason'])
                ->set('order_id', $data['order_id'])
                ->set('ord_pro_id', $data['order_product_id'])
                ->set('product_id', $data['product_id'])
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('return');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function countOrderReturn($table1, $table2, $table3, $table4, $user_id = '') {
        if ($user_id) {
            $where = " WHERE t1.user_id = $user_id ";
        } else {
            $where = " ";
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.product_id = t2.id INNER JOIN " . $table3 . " As t3 ON t1.user_id=t3.mlm_user_id INNER JOIN " . $table4 . " As t4 ON t1.ord_pro_id=t4.id " . $where . " ");


        return $query->num_rows();
    }

    function getTableColumnOrderReturn() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't4.image', 'dt' => 1),
            array('db' => 't2.product_name', 'dt' => 2),
            array('db' => 't1.quantity', 'dt' => 3),
            array('db' => 't1.reason', 'dt' => 4),
            array('db' => 't1.date', 'dt' => 5),
            array('db' => 't1.status', 'dt' => 6),
            array('db' => 't3.user_name', 'dt' => 7)
        );
    }

    function getTotalFilteredOrderReturn($table1, $table2, $table3, $table4, $where, $user_id = '') {
        if ($user_id) {
            if ($where) {
                $where = $where . " AND t1.user_id = $user_id ";
            } else {
                $where = " WHERE t1.user_id = $user_id ";
            }
        } else {
            if ($where) {
                $where = $where . "  ";
            } else {
                $where = "  ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.product_id = t2.id INNER JOIN " . $table3 . " As t3 ON t1.user_id=t3.mlm_user_id INNER JOIN " . $table4 . " As t4 ON t1.ord_pro_id=t4.id " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataOrderReturn($table1, $table2, $table3, $table4, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($user_id) {
            if ($where) {
                $where = $where . " AND t1.user_id = $user_id ";
            } else {
                $where = " WHERE t1.user_id = $user_id ";
            }
        } else {
            if ($where) {
                $where = $where . "  ";
            } else {
                $where = "  ";
            }
        }
        $query = $this->db->query("select t1.id,t4.image,t2.product_name,t1.quantity,t1.reason,t1.date,t1.status,t3.user_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.product_id = t2.id INNER JOIN " . $table3 . " As t3 ON t1.user_id=t3.mlm_user_id INNER JOIN " . $table4 . " As t4 ON t1.ord_pro_id=t4.id " . $where . $order . " " . $limit);


        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function updateReturnStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('return');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getInvoiceDetails($ord_id) {
        $ord = array();
        $query = $this->db->select('user_id,total_amount,delivery_charge,shipping_charge,tax,total_pv,payment_type,address,country,state,city,zip_code,confirm_date')
                ->where('id', $ord_id)
                ->from('orders')
                ->get();
        if ($query->num_rows() > 0) {
            $ord['invoice_id'] = '#' . $ord_id;
            $ord['order_id'] = '#' . (1000 + $ord_id);
            // $ord['invoice_date'] = Carbon::parse($query->row()->confirm_date)->formatLocalized('%a,%b-%d-%Y');
            $ord['invoice_date'] = date_format(date_create($query->row()->confirm_date),"F d, Y");
            $ord['username'] = $this->helper_model->IdToUserName($query->row()->user_id);
            $ord['address'] = $query->row()->address;
            $ord['user_id'] = $query->row()->user_id;
            $ord['country'] = $this->helper_model->getCountryName($query->row()->country);
            $ord['state'] = $this->helper_model->getStateName($query->row()->state);
            $ord['city'] = $query->row()->city;
            $ord['zip_code'] = $query->row()->zip_code;
            $ord['payment_type'] = lang($query->row()->payment_type);

            $ord['total_pv'] = round($query->row()->total_pv, 2);
            $ord['total_amount'] = $this->helper_model->currency_conversion($query->row()->total_amount);
            $ord['delivery_charge'] = $this->helper_model->currency_conversion($query->row()->delivery_charge);
            $ord['shipping_charge'] = $this->helper_model->currency_conversion($query->row()->shipping_charge);
            $ord['tax'] = $this->helper_model->currency_conversion($query->row()->tax);

            $ord['delivery_charge_only'] = $query->row()->delivery_charge;
            $ord['shipping_charge_only'] = $query->row()->shipping_charge;
            $ord['tax_only'] = $query->row()->tax;

            $order_products = $this->getOrderProducts($ord_id);
            $i = 0;
            $total = 0;
            foreach ($order_products as $op) {
                $ord['products'][$i]['product_name'] = $op['product_name'];
                $ord['products'][$i]['amount'] = $this->helper_model->currency_conversion($op['amount']);
                $ord['products'][$i]['quantity'] = $op['quantity'];
                $ord['products'][$i]['product_total'] = $this->helper_model->currency_conversion($op['amount'] * $op['quantity']);
                $i++;
                $total += $op['amount'] * $op['quantity'];
            }
            $ord['total'] = $this->helper_model->currency_conversion($total);
        }
        return $ord;
    }

    function getOrderProducts($order_id) {
        $data = array();
        $query = $this->db->select("id,amount,quantity,product_id,date")
                ->from("order_products")
                ->where("order_id", $order_id)
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['amount'] = $row['amount'];
            $data[$i]['quantity'] = $row['quantity'];
            $data[$i]['product_name'] = $this->getProductName($row['product_id']);
            $i++;
        }
        return $data;
    }

    function getTableColumnPaymentDetails() {
        return array(
            array('db' => 't2.mlm_user_id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't2.email', 'dt' => 2),
            array('db' => 't2.date', 'dt' => 3),
            array('db' => 't1.wallet_address', 'dt' => 4),
            array('db' => 't1.bank_ac_number', 'dt' => 5),
            array('db' => 't1.paypal_email', 'dt' => 6),
            array('db' => 't1.id', 'dt' => 7)
        );
    }

    /**
     * For COUNT report orders
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countPaymentDetails($table1, $table2) {
        $where = " WHERE t2.user_type != 'admin' ";
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the filtered order report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredPaymentDetails($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND t2.user_type != 'admin' ";
        } else {
            $where = " WHERE t2.user_type != 'admin' ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the result all order details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataPaymentDetails($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND t2.user_type != 'admin' ";
        } else {
            $where = " WHERE t2.user_type != 'admin' ";
        }
        $query = $this->db->query("select t2.mlm_user_id,t2.user_name,t2.email,t2.date,t1.wallet_address,t1.bank_ac_number,t1.paypal_email,t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    public function insertUserLoginHistory($user_id) {
        $ip_address = $this->helper_model->getUserIP();

        return $this->db->set('user_id', $user_id)
                        ->set('ip_address', $ip_address)
                        ->set('date', date("Y-m-d H:i:s"))
                        ->insert('user_logins');
    }

    function getTableColumnUserLoginDetails() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't2.email', 'dt' => 2),
            array('db' => 't1.ip_address', 'dt' => 3),
            array('db' => 't1.date', 'dt' => 4),
        );
    }

    function countUserLoginDetails($table1, $table2) {
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    function getTotalFilteredUserLoginDetails($table1, $table2, $where) {

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    function getResultUserLoginDetails($table1, $table2, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select t1.id,t2.user_name,t2.email,t1.ip_address,t1.date from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getAllOrdersData(){        
        $data = array();
        $query = $this->db->select('orders.id, orders.order_status,orders.total_amount,orders.order_date,user_name')
        ->join('user', 'user.mlm_user_id = orders.user_id', 'inner')
        ->get('orders');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result_array() as $row) {
                // $data[$i]['order_id'] = 'MB00'.$row['id'];
                $data[$i]['order_id'] = $row['id'];
                $data[$i]['customer'] = $row['user_name'];
                $data[$i]['order_status'] = lang($this->getOrderStatus($row['order_status']));
                $data[$i]['order_date'] = $row['order_date'];
                $data[$i]['total_amount'] = $this->helper_model->currency_conversion(round($row['total_amount'], 8));
                $i++;
            }
        }
        return $data;
    }


    function getOrderStatusList() {
        $data = array();
        $query = $this->db->select("id,status_name")
                ->from("orderstatus")
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['status_name'] = lang($row['status_name']);
            $data[$i]['id'] = $row['id'];
            $i++;
        }
        return $data;
    }

    function getOrderStatus($id){
      $status_name = '';
      $query = $this->db->select('status_name')
      ->where('id', $id)
      ->get('orderstatus');
      if ($query->num_rows() > 0) {
        $status_name = $query->row()->status_name;
    }
    return $status_name;
    }



}
