<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 *
 * For cart related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    cart
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
$this->obj_plan_model = '';

class Cart_model extends CI_Model {

    /**
     * For Fetch All Products
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param NILL
     * @return Product Details
     */
    function getAllProducts() {
        $data = array();
        $res = $this->db->select("id,product_name,product_amount,product_pv,product_code,images,recurring_type,description,quantity")
                ->from("products")
                ->where("status", '1')
                ->where("quantity >", '0')
                ->where("product_type !=", 'register')
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
            $data[$i]['quantity'] = $row->quantity;
            $data[$i]['product_code'] = $row->product_code;
            $images = unserialize($row->images);
            $data[$i]['images'] = $images;
            $data[$i]['recurring_type'] = $row->recurring_type;
            $data[$i]['description'] = $row->description;
            $i++;
        }
        return $data;
    }

    /**
     * For Fetch A Product Details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param Product Id
     * @return Product Details
     */
    function getProductDetails($product_id, $quantity = '0') {
        $data = array();
        $res = $this->db->select('product_name,product_amount,product_pv,product_code,images,recurring_type,description,product_type,quantity')
                ->from('products')
                ->where('id', $product_id);
        if ($quantity > 0) {
            $this->db->where('quantity >=', $quantity);
        }
        $res = $this->db->limit('1')
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
            $data['quantity'] = $row->quantity;
        }
        return $data;
    }

    /**
     * For Fetching Shipping Details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param User Id
     * @param Username
     * @return Shipping Details
     */
    function getCheckoutData($user_id, $user_name) {
        $data = array();
        $res = $this->db->select('shipping_address,shipping_city,shipping_zipcode,shipping_country,shipping_state')
                ->from('user_details')
                ->where('mlm_user_id', $user_id)
                ->limit('1')
                ->get();
        foreach ($res->result() as $row) {
            $data['address'] = $row->shipping_address;
            $data['city'] = $row->shipping_city;
            $data['zip_code'] = $row->shipping_zipcode;
            $data['state'] = $row->shipping_state;
            $data['country'] = $row->shipping_country;
        }
        $data['username'] = $user_name;
        return $data;
    }

    /**
     * For Add Order
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param User Id
     * @param Order Details
     * @return Order ID
     */
    function addOrder($user_id, $post, $cart, $total_items, $total_amount, $total_pv, $payment_method, $order_status, $delivery_charge = 0, $shipping_charge = 0, $tax = 0) {
        $order_id = $total_update_value = 0;
        if ($this->dbvars->INVESTMENT_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {
            $obj_class = "plan_" . strtolower($this->dbvars->MLM_PLAN) . "_model";
            include_once("Plan_" . strtolower($this->dbvars->MLM_PLAN) . "_model.php");
            $plan_obj = new $obj_class();
            $this->load->model('configuration_model');
            $investment_array = $this->configuration_model->getInvestmentDetails();
        }
        $confirm_date = '';
        if ($order_status) {
            $confirm_date = $post['checkout_date'];
        }
        $res = $this->db->set('user_id ', $user_id)
                ->set('total_amount', $total_amount)
                ->set('total_pv ', $total_pv)
                ->set('product_count', $total_items)
                ->set('payment_type', $payment_method)
                ->set('order_date', $post['checkout_date'])
                ->set('confirm_date ', $confirm_date)
                ->set('address ', $post['address'])
                ->set('country ', $post['country'])
                ->set('state ', $post['state'])
                ->set('city ', $post['city'])
                ->set('zip_code ', $post['zip_code'])
                ->set('order_status ', $order_status)
                ->set('delivery_charge ', $delivery_charge)
                ->set('shipping_charge ', $shipping_charge)
                ->set('tax ', $tax)
                ->insert('orders');
        if ($res) {
            $order_id = $this->db->insert_id();
            foreach ($cart as $c) {
                $expiry_date = date("Y-m-d H:i:s");
                $category_id = '';
                if ($this->dbvars->INVESTMENT_STATUS > 0) {
                    $category_id = $this->helper_model->getInvestCategoryId($c['id']);
                    $expiry_date = $this->helper_model->getInvestExpiry($c['id']);
                }
                $this->session->set_userdata('package_id', $c['id']);
                $this->db->set('order_id ', $order_id)
                        ->set('product_id', $c['id'])
                        ->set('party_id', $c['party_id'])
                        ->set('quantity ', $c['qty'])
                        ->set('amount', $c['price'])
                        ->set('pv', $c['pv'])
                        ->set('image', $c['image'])
                        ->set('recurring ', $c['recurring_type'])
                        ->set('date ', $post['checkout_date'])
                        ->set('category_id', $category_id)
                        ->set('expiry_date', $expiry_date)
                        ->insert('order_products');
                if ($order_status) {
                    $this->helper_model->updateSalesCount($c['id'], $c['qty']);
                    if ($this->dbvars->INVESTMENT_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {
                        $plan_obj->distributeInvestmentBonus($user_id, $investment_array, $c['id']);
                    }
                    if ($this->dbvars->UPLINE_UPDATE_VALUE == 'product_pv') {
                        $total_update_value += $c['pv'] * $c['qty'];
                    } else {
                        $total_update_value += $c['price'] * $c['qty'];
                    }
                }
            }

            if (isset($post['shipping_address_save'])) {
                $this->db->set('shipping_address', $post['address'])
                        ->set('shipping_city', $post['city'])
                        ->set('shipping_zipcode', $post['zip_code'])
                        ->set('shipping_country', $post['country'])
                        ->set('shipping_state', $post['state'])
                        ->where('mlm_user_id', $user_id)
                        ->update('user_details');
            }

            if ($order_status) {
                if ($this->dbvars->INVESTMENT_STATUS < 1 && (ENVIRONMENT != 'development' || ENVIRONMENT != 'testing')) {
                    $obj_class = "plan_" . strtolower($this->dbvars->MLM_PLAN) . "_model";
                    include_once("Plan_" . strtolower($this->dbvars->MLM_PLAN) . "_model.php");
                    $plan_obj = new $obj_class();
                }
                $plan_obj->distributeRepurchaseCommission($user_id, $total_update_value);

                //Commissions and other operations
                //Add same operation in pendig Orders in admin
            }
        }
        return $order_id;
    }

    /**
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
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $username
     * @param type $tran_pass
     * @return type
     */
    function validateUserTransactionPassword($username, $tran_pass) {
        return $this->db->select('mlm_user_id')
                        ->from("user")
                        ->where('tran_password', $tran_pass)
                        ->where('user_name', $username)
                        ->count_all_results();
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $username
     * @param type $amount
     * @return int
     */
    function validateUserBalance($username, $amount) {
        $user_id = $this->helper_model->userNameToID($username);
        if ($this->helper_model->getUserBalance($user_id) >= $amount) {
            return 1;
        }
        return 0;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $epin
     * @param type $amount
     * @return boolean
     */
    function checkEpinStatus($epin, $amount) {
        $result = $this->checkEpinActiveOrNot($epin);
        if ($result) {

            $epin_amount = $this->getPinAmount($epin);
            if ($amount <= $epin_amount) {

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $pin
     * @return type
     */
    function gettingEpinAssignee($pin) {
        $user_id = $this->db->select('mlm_user_id')->get_where('pin_numbers', array('pin_number' => $pin))->row()->mlm_user_id;

        return $user_id;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $pin
     * @param type $user_id
     * @return boolean
     */
    function checkEpinActiveOrNot($pin) {
        $result = $this->db->select('count(*) as cnt')->where('pin_number', $pin)->where('expiry_date >=', date('Y-m-d'))->where('status', 1)->get('pin_numbers');

        foreach ($result->result() as $row) {
            if (($row->cnt) > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $pin_arr
     * @param type $total_amount
     * @param type $user_id
     * @return boolean
     */
    function checkEpinDetails($pin_arr, $total_amount, $user_id, $used_for = 'repurchase') {

        $check_amount_status = $this->checkEpinAmountGreaterThanTotalAmount($pin_arr, $total_amount, $user_id);
        $epin_result = false;
        $balce_amount = $i = $epin_used_amount = 0;
        $pin_array = array();
        $total_balance = $total_amount;
        if ($check_amount_status) {
            foreach ($pin_arr as $key => $value) {
                $pin_details = $this->checkEPinValidOrNotGetEPinDetails($value);
                if (!empty($pin_details)) {
                    if ($pin_details['pin_amount'] >= $total_balance) {
                        $epin_balance_amount = $pin_details['pin_amount'] - $total_balance;
                        $epin_amount_used = $total_balance;
                        $total_balance = 0;
                    } else {
                        $epin_balance_amount = 0;
                        $reg_balance = $total_balance - $pin_details['pin_amount'];
                        $total_balance = ($reg_balance >= 0) ? $reg_balance : 0;
                    }
                    $result = $this->updateEpinDetails($epin_balance_amount, $pin_details['pin_assigneed'], $user_id, $pin_details['pin_id'], $used_for);
                    if ($result) {
                        $epin_result = TRUE;
                    }
                }
            }
        }
        return $epin_result;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param array $pin_array
     * @param type $total_amount
     * @return boolean
     */
    function checkEpinAmountGreaterThanTotalAmount($pin_array, $total_amount, $user_id) {
        $balance_amount = $this->db->select_sum('balance_amount')
                        ->from('pin_numbers')
                        ->where_in('pin_number', $pin_array)
                        ->where('mlm_user_id', $user_id)
                        ->where('expiry_date >=', date('Y-m-d'))
                        ->get()->row()->balance_amount;
        if ($total_amount <= $balance_amount) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $assignee_id
     * @param type $user_id
     * @return boolean
     */
    function updateEpinDetails($amount, $assignee_id, $user_id, $pin_id, $used_for) {
        if ($amount == 0) {
            $this->db->set('status', 0);
        }
        $this->db->set('balance_amount', $amount);
        $this->db->set('used_by', $user_id);
        $this->db->set('used_for', $used_for);
        $this->db->where('mlm_user_id', $assignee_id);
        $this->db->where('id', $pin_id);
        $result = $this->db->update('pin_numbers');
        if ($this->db->affected_rows() > 0)
            return TRUE;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function getEpinNameToId($pin) {
        $epin_id = $this->db->select("id")->from('pin_numbers')->like('pin_number', $pin)->get()->row()->id;
        if ($epin_id > 0) {
            return $epin_id;
        }
        return false;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function checkEPinValidOrNotGetEPinDetails($epin) {
        $res = $this->db->select('id,pin_number,balance_amount,used_by,mlm_user_id')
                ->from('pin_numbers')
                ->where('pin_number', $epin)
                ->where('balance_amount >', 0)
                ->where('status', 1)
                ->where('expiry_date >=', date("Y-m-d"))
                ->get();
        $epin_arr = array();
        foreach ($res->result_array() as $row) {
            $epin_arr['pin_numbers'] = $row['pin_number'];
            $epin_arr['pin_amount'] = $row['balance_amount'];
            $epin_arr['pin_assigneed'] = $row['mlm_user_id'];
            $epin_arr['pin_id'] = $row['id'];
        }
        return $epin_arr;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function getInvestCategoryId($pro_id) {
        $cat_id = 0;
        if ($this->dbvars->INVESTMENT_CATEGORY == 'crypto' && $this->dbvars->INVESTMENT_STATUS > 0) {
            $query = $this->db->select('inv_cat')
                    ->where('id', $pro_id)
                    ->limit(1)
                    ->get('products');
            foreach ($query->result() as $val) {
                if ($val->inv_cat > 0) {
                    $cat_id = $val->inv_cat;
                }
            }
        }

        return $cat_id;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function getInvestAmount($pro_id) {
        $investment_amount = 0;
        $query = $this->db->select('investment_amount')
                ->where('id', $pro_id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $val) {
            $investment_amount = $val->investment_amount;
        }
        return $investment_amount;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return booleana
     */
    function getInvestExpiry($pro_id) {
        $expiry_date = date("Y-m-d H:i:s");
        $query = $this->db->select('expiry_date')
                ->where('id', $pro_id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $val) {

            $date = $val->expiry_date;
            if ($date > 0) {
                $expiry_date = date('Y-m-d', strtotime("+$date days"));
            }
        }
        return $expiry_date;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return booleana
     */
    function getAllPartyProducts($party_id, $party_prod = array()) {
        $data = array();
        if (count($party_prod)) {
            $res = $this->db->select("id,product_name,product_amount,product_pv,product_code,images,recurring_type")
                    ->from("products")
                    ->where("status", '1')
                    ->where_in('id', $party_prod)
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
                $data[$i]['product_amount'] = $this->getPartyProductAmount($party_id, $row->id) + 0;
                $data[$i]['original_product_amount'] = $row->product_amount + 0;
                $data[$i]['product_pv'] = $row->product_pv;
                $data[$i]['product_code'] = $row->product_code;
                $images = unserialize($row->images);
                $data[$i]['images'] = $images;
                $data[$i]['recurring_type'] = $row->recurring_type;
                $i++;
            }
        }
        return $data;
    }

    /**
     * For fetch the All Product in party plan
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function getAllProductsInParty($party_id) {
        $data = array();
        $res = $this->db->select("prod_id")
                ->from("party_products")
                ->where("status", '1')
                ->where("party_id", $party_id)
                ->order_by('id', 'DESC')
                ->get();
        foreach ($res->result() as $row) {
            $data[] = $row->prod_id;
        }
        return $data;
    }

    /**
     * For get all party product amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return boolean
     */
    function getPartyProductAmount($party_id, $prod_id) {
        $amount = 0;
        $query = $this->db->select('amount')
                ->where('prod_id', $prod_id)
                ->where('party_id', $party_id)
                ->limit(1)
                ->get('party_products');
        foreach ($query->result() as $val) {
            $amount = $val->amount;
        }
        return $amount;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $pin_arr
     * @param type $user_id
     */
    function getCheckEpinUsedCartDetails($pin_arr, $user_id) {
        $this->load->model('register_model');
        $return_status = '';
        $status = $this->register_model->checkEpinExitsOrNot($pin_arr, $user_id);
        if ($status) {
            $return_status = true;
        } else {
            $return_status = false;
        }


        return $return_status;
    }

    function validateEpins($epin) {
        $res = $this->db->select('*')
                ->from('pin_numbers')
                ->where('pin_number', $epin)
                ->where('balance_amount >', 0)
                ->where('status', 1)
                ->where('expiry_date >=', date("Y-m-d"))
                ->count_all_results();
        if ($res > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * For Fetching Order Details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param Order Id
     * @return Order Details
     */
    function getOrderDetails($order_id = '', $paypal_reference = 'NA') {
        $data = array();
        $this->db->select('id,total_amount,user_id');
        $this->db->from('orders');
        if ($order_id) {
            $this->db->where('id', $order_id);
        } else {
            $this->db->where('paypal_reference', $paypal_reference);
        }
        $this->db->limit('1');
        $res = $this->db->get();
        foreach ($res->result() as $row) {
            $data['total_amount'] = round($row->total_amount, 2);
            $data['order_id'] = $row->id;
            $data['user_id'] = $row->user_id;
        }
        return $data;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $reference
     * @return type
     */
    function updatePaypalReference($id, $reference) {
        $this->db->set('paypal_reference', $reference);
        $this->db->where('id', $id);
        $this->db->update('orders');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function checkProductQuantity($pro_id, $quantity) {
        $res = $this->db->select('id')
                ->from('products')
                ->where('id', $pro_id)
                ->where('quantity >=', $quantity)
                ->where('status', 1)
                ->count_all_results();
        if ($res > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function getUserDetails($user_id) {
        $data = array();
        $this->db->select('email,first_name,last_name');
        $this->db->from('user as us');
        $this->db->join("user_details as ud", 'us.mlm_user_id = ud.mlm_user_id', 'inner');                
        $this->db->where('us.mlm_user_id', $user_id);
        $this->db->limit('1');
        $res = $this->db->get();
        foreach ($res->result() as $row) {
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
            $data['email_id'] = $row->email;
        }
        return $data;
    }

}
