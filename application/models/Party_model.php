<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For Party plan related model
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Party_model extends CI_Model {

    /**
     * For getting all party 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $party_id
     * @return type
     */
    function getAllParty($user_id = '', $party_id = '') {
        $array = array();
        $this->db->select('id,name,image,user_id,start_date,address_type,address,country_id,state_id,city,zip_code,phone,email,date,status,end_date,party_code,confirmation');
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        if ($party_id) {
            $this->db->where('id', $party_id);
            $this->db->limit(1);
        }
        $this->db->where('end_date >', date("Y-m-d H:i:s"));
        $query = $this->db->get('party');
        $i = 0;
        foreach ($query->result_array() as $row) {
            $array[$i]["id"] = $row['id'];
            $array[$i]["party_code"] = $row['party_code'];
            $array[$i]["name"] = $row['name'];
            $array[$i]["image"] = $row['image'];
            $array[$i]["user_id"] = $row['user_id'];
            $array[$i]["host_username"] = $this->helper_model->IdToUserName($row['user_id']);
            $array[$i]["start_date"] = $row['start_date'];
            $array[$i]["end_date"] = $row['end_date'];
            $array[$i]["address"] = $row['address'];
            $array[$i]["country_id"] = $row['country_id'];
            $array[$i]["state_id"] = $row['state_id'];
            $array[$i]["city"] = $row['city'];
            $array[$i]["zip_code"] = $row['zip_code'];
            $array[$i]["phone"] = $row['phone'];
            $array[$i]["email"] = $row['email'];
            $array[$i]["date"] = $row['date'];
            $array[$i]["status"] = $row['status'];
            $array[$i]["confirmation"] = $row['confirmation'];
            $array[$i]["address_type"] = $row['address_type'];
            $i++;
        }
        if ($party_id) {
            return $array[0];
        }
        return $array;
    }

    /**
     * For create Party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $data
     * @param type $status
     * @return type
     */
    function createParty($user_id, $data, $status = 0) {
        $party_user = $this->helper_model->userNameToID($data['host_username']);
        $details = $data;
        if ($data['address_type'] == 'host') {
            $details = $this->getUserDetails($party_user);
        }

        if ($status) {
            $confirmation = 'confirmed';
        } else {
            $confirmation = 'pending';
        }
        $party_code = $this->createPartyCode();
        $res = $this->db->set('name', $data['name'])
                ->set('party_code', $party_code)
                ->set('image', $data['document'])
                ->set('user_id ', $party_user)
                ->set('start_date', $data['start_date'])
                ->set('end_date', $data['end_date'])
                ->set('address_type', $data['address_type'])
                ->set('address', $details['address'])
                ->set('country_id ', $details['country_id'])
                ->set('state_id ', $details['state_id'])
                ->set('city', $details['city'])
                ->set('zip_code', $details['zip_code'])
                ->set('phone', $details['phone'])
                ->set('email', $details['email'])
                ->set('date', date("Y-m-d H:i:s"))
                ->set('status', $status)
                ->set('confirmation', $confirmation)
                ->set('creating_user ', $user_id)
                ->insert('party');
        if ($this->db->affected_rows() > 0) {
            return $res;
        }
        return false;
    }

    /**
     * For update the party list
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @param type $data
     * @return type
     */
    function updateParty($party_id, $data) {
        $party_user = $this->helper_model->userNameToID($data['host_username']);
        $details = $data;
        if ($data['address_type'] == 'host') {
            $details = $this->getUserDetails($party_user);
        }
        $this->db->set('name', $data['name']);
        if ($data['document'])
            $this->db->set('image', $data['document']);
        $this->db->set('user_id ', $party_user);
        $this->db->set('start_date', $data['start_date']);
        $this->db->set('end_date', $data['end_date']);
        $this->db->set('address_type', $data['address_type']);
        $this->db->set('address', $details['address']);
        $this->db->set('country_id ', $details['country_id']);
        $this->db->set('state_id ', $details['state_id']);
        $this->db->set('city', $details['city']);
        $this->db->set('zip_code', $details['zip_code']);
        $this->db->set('phone', $details['phone']);
        $this->db->set('email', $details['email']);
        $this->db->set('date', date("Y-m-d H:i:s"));
        $this->db->where('id', $party_id);
        $this->db->update('party');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update the user details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getUserDetails($user_id) {
        $array = array();
        $query = $this->db->select('address_1,city,zip_code,state_id,country_id,phone_number')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_details');
        foreach ($query->result_array() as $row) {
            $array["address"] = $row['address_1'];
            $array["city"] = $row['city'];
            $array["zip_code"] = $row['zip_code'];
            $array["state_id"] = $row['state_id'];
            $array["country_id"] = $row['country_id'];
            $array["phone"] = $row['phone_number'];
            $array["email"] = $this->helper_model->getUserEmailId($user_id);
        }
        return $array;
    }

    /**
     * For change party status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @param type $status
     * @param type $confirmation
     * @return type
     */
    function changePartyStatus($party_id, $status, $confirmation = 0) {
        $this->db->set('status', $status);
        if ($confirmation) {
            $this->db->set('confirmation', 'confirmed');
        }
        $this->db->where('id', $party_id);
        $this->db->update('party');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For delete party 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @return type
     */
    function deleteParty($party_id) {
        $this->db->where('id', $party_id)
                ->delete('party');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For create party code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function createPartyCode() {
        $this->load->helper('string');
        $code = '';
        $flag = 1;
        while ($flag) {
            $code = random_string('alpha', 10);
            if (!$this->partyExist($code)) {
                $flag = 0;
            }
        }
        return $code;
    }

    /**
     * For check create party already exits
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $code
     * @return type
     */
    public function partyExist($code) {
        return $this->db->select("id")
                        ->from("party")
                        ->where('party_code', $code)
                        ->count_all_results();
    }

    /**
     * For validate party code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $code
     * @param type $user_id
     * @return type
     */
    public function validatePartyCode($code, $user_id = 0) {
        $id = 0;
        $this->db->select('id');
        $this->db->where('party_code', $code);
        $this->db->where('status', 1);
        $this->db->limit(1);
        if ($user_id)
            $this->db->where('user_id', $user_id);
        $query = $this->db->get('party');
        foreach ($query->result() as $row) {
            $id = $row->id;
        }

        return $id;
    }

    /**
     * For get Party code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getPartyCode($id) {
        $code = '';
        $query = $this->db->select('party_code')
                ->where('id', $id)
                ->where('status', 1)
                ->limit(1)
                ->get('party');
        foreach ($query->result() as $row) {
            $code = $row->party_code;
        }
        return $code;
    }

    /**
     * For validate the party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function validateParty($id) {
        return $this->db->select("id")
                        ->from("party")
                        ->where('id', $id)
                        ->where('status', 1)
                        ->count_all_results();
    }

    /**
     * for check product code exits or not
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $code
     * @return type
     */
    public function checkProductCode($code) {
        return $this->db->select("id")
                        ->from("products")
                        ->where('product_code', $code)
                        ->where('status', 1)
                        ->where('product_type', 'repurchase')
                        ->count_all_results();
    }

    /**
     * For get product ID form code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $code
     * @return type
     */
    public function getProIdFromCode($code) {
        $id = '';
        $query = $this->db->select('id')
                ->where('status', 1)
                ->where('product_code', $code)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $row) {
            $id = $row->id;
        }
        return $id;
    }

    /**
     * For check product in party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @param type $product_id
     * @return type
     */
    public function checkProductInParty($party_id, $product_id) {
        return $this->db->select("id")
                        ->from("party_products")
                        ->where('party_id', $party_id)
                        ->where('prod_id', $product_id)
                        ->count_all_results();
    }

    /**
     * For add product to party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $log_user
     * @param type $party_id
     * @param type $data
     * @param type $status
     * @return type
     */
    function addProdToParty($log_user, $party_id, $data, $status = 0) {
        $currency_ratio = 1;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
        }
        $this->db->set('party_id', $party_id)
                ->set('prod_id', $data['product_id'])
                ->set('amount', $data['request_amount'] / $currency_ratio)
                ->set('added_user ', $log_user)
                ->set('status ', $status)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('party_products');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for check user in party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @param type $user
     * @return type
     */
    public function checkUserInParty($party_id, $user) {
        return $this->db->select("id")
                        ->from("party_users")
                        ->where('party_id', $party_id)
                        ->where('user_id', $user)
                        ->count_all_results();
    }

    /**
     * For add user to party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $log_user
     * @param type $party_id
     * @param type $user_id
     * @param type $status
     * @return type
     */
    function addUserToParty($log_user, $party_id, $user_id, $status = 0) {
        $this->db->set('party_id', $party_id)
                ->set('user_id', $user_id)
                ->set('added_user ', $log_user)
                ->set('status ', $status)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('party_users');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get all party added products
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @return type
     */
    public function getAllPartyProducts($party_id) {
        $party_code = $this->getPartyCode($party_id);
        $array = array();
        $query = $this->db->select('id,party_id,prod_id,amount,added_user,date,status')
                ->where('party_id', $party_id)
                ->get('party_products');
        $i = 0;
        foreach ($query->result_array() as $row) {
            $array[$i]["id"] = $row['id'];
            $array[$i]["party_id"] = $row['party_id'];
            $array[$i]["prod_id"] = $row['prod_id'];
            $array[$i]["suggested_amount"] = $row['amount'];
            $array[$i]["request_date"] = $row['date'];
            $array[$i]["added_user"] = $this->helper_model->IdToUserName($row['added_user']);
            $array[$i]["status"] = $row['status'];

            $array[$i]["party_code"] = $party_code;
            $array[$i]["product_code"] = $this->getProductCode($row['prod_id']);
            $array[$i]["original_amount"] = $this->getProductAmount($row['prod_id']);
            $i++;
        }
        return $array;
    }

    /**
     * For generate the product code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getProductCode($id) {
        $code = '';
        $query = $this->db->select('product_code')
                ->where('id', $id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $row) {
            $code = $row->product_code;
        }
        return $code;
    }

    /**
     * For get Product amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getProductAmount($id) {
        $product_amount = 0;
        $query = $this->db->select('product_amount')
                ->where('id', $id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $row) {
            $product_amount = $row->product_amount;
        }
        return $product_amount;
    }

    /**
     * For get all party users details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @return type
     */
    public function getAllPartyUsers($party_id) {
        $party_code = $this->getPartyCode($party_id);
        $array = array();
        $query = $this->db->select('id,party_id,user_id,added_user,date,status')
                ->where('party_id', $party_id)
                ->get('party_users');
        $i = 0;
        foreach ($query->result_array() as $row) {
            $array[$i]["id"] = $row['id'];
            $array[$i]["party_id"] = $row['party_id'];
            $array[$i]["user_id"] = $row['user_id'];
            $array[$i]["username"] = $this->helper_model->IdToUserName($row['user_id']);
            $array[$i]["added_date"] = $row['date'];
            $array[$i]["added_user"] = $this->helper_model->IdToUserName($row['added_user']);
            $array[$i]["status"] = $row['status'];
            $array[$i]["party_code"] = $party_code;
            $i++;
        }
        return $array;
    }

    /**
     * For change the product party status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    function changePartyProductStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('party_products');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For delete the product status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function deletePartyProduct($id) {
        $this->db->where('id', $id)
                ->delete('party_products');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For change party user status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    function changePartyUserStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('party_users');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For delete party users
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function deletePartyUser($id) {
        $this->db->where('id', $id)
                ->delete('party_users');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get all party invites
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getAllPartyInvites($user_id) {
        $array = array();
        $this->db->select("pu.user_id,pu.added_user,p.party_code,p.name,p.image,p.address,p.country_id,p.state_id,p.city,p.zip_code,p.phone,p.email");
        $this->db->from("party_users as pu");
        $this->db->join("party as p", 'pu.party_id = p.id', 'inner');
        $this->db->where("pu.status", 1);
        $this->db->where("pu.user_id", $user_id);
        $this->db->where("p.status", 1);
        $query = $this->db->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $array[$i]["user_id"] = $row['user_id'];
            $array[$i]["inviter"] = $this->helper_model->IdToUserName($row['added_user']);
            $array[$i]["added_user"] = $row['added_user'];
            $array[$i]["party_code"] = $row['party_code'];
            $array[$i]["name"] = $row['name'];
            $array[$i]["image"] = $row['image'];

            $array[$i]["address"] = $row['address'];
            $array[$i]["country"] = $this->helper_model->getCountryName($row['country_id']);
            $array[$i]["state"] = $this->helper_model->getStateName($row['state_id']);
            $array[$i]["city"] = $row['city'];
            $array[$i]["zip_code"] = $row['zip_code'];
            $array[$i]["phone"] = $row['phone'];
            $array[$i]["email"] = $row['email'];
            $i++;
        }
        return $array;
    }

    /**
     * For get all product codes
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $query
     * @return type
     */
    function getAllProductCodes($query) {
        $json = [];

        $this->db->select("product_code");
        $this->db->from('products');
        if ($query != '') {
            $this->db->like('product_code', trim($query));
        }
        $this->db->where('status', 1);
        $this->db->where('product_type', 'repurchase');
        $res = $this->db->get();
        foreach ($res->result_array() as $row) {
            $json[] = $row['product_code'];
        }

        return json_encode($json);
    }

    /**
     * For get product amount from party code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $code
     * @return type
     */
    public function getProductAmountFromCode($code) {
        $product_amount = 0;
        $query = $this->db->select('product_amount')
                ->where('product_code', $code)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $row) {
            $product_amount = $row->product_amount;
        }
        return $product_amount;
    }

    /**
     * For check party code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $code
     * @param type $user_id
     * @return type
     */
    public function checkPartyCode($code, $user_id = 0) {
        $this->db->select("id");
        $this->db->from("party");
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('party_code', $code);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /**
     * For getting all party code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $query
     * @return type
     */
    function getAllPartyCodes($query) {
        $json = [];

        $this->db->select("party_code");
        $this->db->from('party');
        if ($query != '') {
            $this->db->like('party', trim($query));
        }
        $this->db->where('status', 1);
        $res = $this->db->get();
        foreach ($res->result_array() as $row) {
            $json[] = $row['party_code'];
        }

        return json_encode($json);
    }

    /**
     * For check users in the party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $log_user
     * @param type $party_id
     * @return type
     */
    public function checkUserParty($log_user, $party_id) {
        return $this->db->select("id")
                        ->from("party")
                        ->where('id', $party_id)
                        ->where('user_id', $log_user)
                        ->count_all_results();
    }

    /**
     * For validate the user party product
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $pro_ref
     * @param type $user_id
     * @return type
     */
    public function validateUserPartyProduct($pro_ref, $user_id) {
        $party_id = 0;
        $query = $this->db->select('party_id')
                ->where('id', $pro_ref)
                ->get('party_products');
        foreach ($query->result() as $row) {
            $party_id = $row->party_id;
        }
        return $this->checkUserParty($user_id, $party_id);
    }

    /**
     * For validate the user party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_ref
     * @param type $user_id
     * @return type
     */
    public function validateUserPartyUsers($user_ref, $user_id) {
        $party_id = 0;
        $query = $this->db->select('party_id')
                ->where('id', $user_ref)
                ->get('party_users');
        foreach ($query->result() as $row) {
            $party_id = $row->party_id;
        }
        return $this->checkUserParty($user_id, $party_id);
    }

    /**
     * For  getting the count of created party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countOfCreateParty($user_id = '') {
        $this->db->select('id');
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('end_date >', date("Y-m-d H:i:s"));
        $this->db->from("party");
        return $this->db->count_all_results();
    }

    /**
     * For getting the column name table
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnCreateParty() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'party_code', 'dt' => 1),
            array('db' => 'image', 'dt' => 2),
            array('db' => 'name', 'dt' => 3),
            array('db' => 'user_name', 'dt' => 4),
            array('db' => 'start_date', 'dt' => 5),
            array('db' => 'end_date', 'dt' => 6),
            array('db' => 'status', 'dt' => 7),
            array('db' => 'confirmation', 'dt' => 8),
        );
    }

    /**
     * For getting the sql command for created party list
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredCreateParty($table1, $table2, $where, $user_id = '') {
        $date = date("Y-m-d H:i:s");
        if ($user_id) {
            if ($where) {
                $where = $where . " AND end_date > '$date' AND user_id= $user_id AND ";
            } else {
                $where = " WHERE end_date > '$date' AND user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND end_date > '$date' AND ";
            } else {
                $where = " WHERE end_date > '$date' AND ";
            }
        }
        $query = $this->db->query("select t2.id,t2.party_code,t2.image,t2.name,t1.user_name,t2.start_date,t2.end_date,t2.status,t2.confirmation from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.user_id ");
        return $query->num_rows();
    }

    /**
     * For get result data fetching
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @return type
     */
    function getResultDataCreateParty($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        $date = date("Y-m-d H:i:s");
        if ($user_id) {
            if ($where) {
                $where = $where . " AND end_date > '$date' AND user_id= $user_id AND ";
            } else {
                $where = " WHERE end_date > '$date' AND user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND end_date > '$date' AND ";
            } else {
                $where = " WHERE end_date > '$date' AND ";
            }
        }
        $query = $this->db->query("select t2.id,t2.party_code,t2.image,t2.name,t1.user_name,t2.start_date,t2.end_date,t2.status,t2.confirmation from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of invites party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countOfInvitesParty($user_id) {
        $this->db->select("pu.user_id");
        $this->db->from("party_users as pu");
        $this->db->join("party as p", 'pu.party_id = p.id', 'inner');
        $this->db->where("pu.status", 1);
        $this->db->where("pu.user_id", $user_id);
        $this->db->where("p.status", 1);
        return $this->db->count_all_results();
    }

    /**
     * For getting the table column names for party invites
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnInvitesParty() {
        return array(
            array('db' => 'party_id', 'dt' => 0),
            array('db' => 'image', 'dt' => 1),
            array('db' => 'party_code', 'dt' => 2),
            array('db' => 'added_user', 'dt' => 3),
            array('db' => 'name', 'dt' => 4),
            array('db' => 'address', 'dt' => 5),
            array('db' => 'country_id', 'dt' => 6),
            array('db' => 'state_id', 'dt' => 7),
            array('db' => 'city', 'dt' => 8),
            array('db' => 'zip_code', 'dt' => 9),
            array('db' => 'phone', 'dt' => 10),
            array('db' => 'email', 'dt' => 11)
        );
    }

    /**
     * For Total Filtered Invests Party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredInvitesParty($table1, $table2, $where, $user_id) {

        if ($where) {
            $where = $where . " AND t1.status=1 AND t1.user_id = $user_id AND t2.status = 1 AND ";
        } else {
            $where = " WHERE t1.status=1 AND t1.user_id = $user_id AND t2.status = 1 AND ";
        }
        $query = $this->db->query("select t1.party_id,t2.image,t2.party_code,t1.added_user,t2.name,t2.address,t2.country_id,t2.state_id,t2.city,t2.zip_code,t2.phone,t2.email from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.party_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For getting all data invites party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @return type
     */
    function getResultDataInvitesParty($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status=1 AND t1.user_id = $user_id AND t2.status = 1 AND ";
        } else {
            $where = " WHERE t1.status=1 AND t1.user_id = $user_id AND t2.status = 1 AND ";
        }
        $query = $this->db->query("select t1.party_id,t2.image,t2.party_code,t1.added_user,t2.name,t2.address,t2.country_id,t2.state_id,t2.city,t2.zip_code,t2.phone,t2.email from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.party_id = t2.id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For count of users party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @return type
     */
    function countOfUsersParty($party_id) {
        $this->db->select("id");
        $this->db->from("party_users");
        $this->db->where("party_id", $party_id);
        return $this->db->count_all_results();
    }

    /**
     * For get table column names users party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnUsersParty() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'party_id', 'dt' => 1),
            array('db' => 'user_name', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'status', 'dt' => 4),
            array('db' => 'user_id', 'dt' => 5)
        );
    }

    /**
     * For getting the Total filtered users party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $party_id
     * @return type
     */
    function getTotalFilteredUsersParty($table1, $table2, $where, $party_id) {

        if ($where) {
            $where = $where . " AND party_id='$party_id' AND ";
        } else {
            $where = " WHERE party_id='$party_id' AND ";
        }
        $query = $this->db->query("select t2.id,t2.party_id,t1.user_name,t2.date,t2.status,t2.user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.mlm_user_id = t2.user_id ");
        return $query->num_rows();
    }

    /**
     * For get the result data users party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $party_id
     * @return type
     */
    function getResultDataUsersParty($table1, $table2, $where, $order, $limit, $party_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND party_id='$party_id' AND ";
        } else {
            $where = " WHERE party_id='$party_id' AND ";
        }
        $query = $this->db->query("select t2.id,t2.party_id,t1.user_name,t2.date,t2.status,t2.user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.mlm_user_id = t2.user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For count of product party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $party_id
     * @return type
     */
    function countOfProductsParty($party_id) {
        $this->db->select("id");
        $this->db->from("party_products");
        $this->db->where("party_id", $party_id);
        return $this->db->count_all_results();
    }

    /**
     * For get table column party
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnProductsParty() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'party_id', 'dt' => 1),
            array('db' => 'product_code', 'dt' => 2),
            array('db' => 'product_amount', 'dt' => 3),
            array('db' => 'amount', 'dt' => 4),
            array('db' => 'status', 'dt' => 5),
            array('db' => 'date', 'dt' => 6)
        );
    }

    /**
     * For getting the sql query for
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $party_id
     * @return type
     */
    function getTotalFilteredProductsParty($table1, $table2, $where, $party_id) {

        if ($where) {
            $where = $where . " AND party_id='$party_id' AND ";
        } else {
            $where = " WHERE party_id='$party_id' AND ";
        }
        $query = $this->db->query("select t2.id,t2.party_id,t1.product_code,t1.product_amount,t2.amount,t2.status,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.id = t2.prod_id ");
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
     * @param type $party_id
     * @return type
     */
    function getResultDataProductsParty($table1, $table2, $where, $order, $limit, $party_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND party_id='$party_id' AND ";
        } else {
            $where = " WHERE party_id='$party_id' AND ";
        }
        $query = $this->db->query("select t2.id,t2.party_id,t1.product_code,t1.product_amount,t2.amount,t2.status,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.id = t2.prod_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

}
