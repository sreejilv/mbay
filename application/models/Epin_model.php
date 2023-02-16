<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * For epin related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    epin
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Epin_model extends CI_Model {

    /**
     * for adding epin to user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function addPinToUser($data) {
        $currency_ratio = 1;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
        }
        $res = 0;
        for ($i = 0; $i < $data['pin_count']; $i++) {
            $pin_number = $this->generatePin();
            $res = $this->db->set('mlm_user_id', $data['user_id'])
                    ->set('pin_number', $pin_number)
                    ->set('allocate_amount', $data['pin_amount'] / $currency_ratio)
                    ->set('balance_amount', $data['pin_amount'] / $currency_ratio)
                    ->set('allocate_date', date("Y-m-d H:i:s"))
                    ->set('expiry_date', $data['expiry_date'])
                    ->insert('pin_numbers');
        }
        return $res;
    }

    /**
     * for generating epin
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function generatePin() {
        $this->load->helper('string');
        $pin = '';
        $flag = 1;
        while ($flag) {
            $pin = random_string('alnum', 16);
            if (!$this->pinExist($pin)) {
                $flag = 0;
            }
        }
        return $pin;
    }

    /**
     * for validating epin existing or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function pinExist($pin) {
        return $this->db->select("id")
                        ->from("pin_numbers")
                        ->where('pin_number', $pin)
                        ->count_all_results();
    }

    /**
     * for getting all pin requests
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getAllPinRequests($user_id = 0) {
        $data = array();
        $this->db->select("id,mlm_user_id,amount,count,date,status");
        $this->db->from("pin_request");
        $this->db->order_by('id', 'DESC');
        if ($user_id)
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['slno'] = $i + 1;
            $data[$i]['id'] = $row->id;
            $data[$i]['amount'] = $row->amount;
            $data[$i]['count'] = $row->count;
            $data[$i]['mlm_user_id'] = $row->mlm_user_id;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->mlm_user_id);
            $data[$i]['user_balance'] = $this->helper_model->getUserBalance($row->mlm_user_id);
            $data[$i]['date'] = $row->date;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * for updating epin request status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function updateRequestStatus($id, $status) {
        $this->db->set('status ', $status)
                ->where('id ', "$id")
                ->update('pin_request');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting epin request details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getRequestData($id) {
        $data = array();
        $res = $this->db->select("mlm_user_id,amount,count")
                ->from("pin_request")
                ->where("id", $id)
                ->get();
        foreach ($res->result() as $row) {
            $data['pin_amount'] = $row->amount;
            $data['pin_count'] = $row->count;
            $data['user_id'] = $row->mlm_user_id;
        }
        return $data;
    }

    /**
     * for getting all user epins
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getAllPins($user_id = 0) {
        $today = strtotime(date("Y-m-d H:i:s"));
        $data['inactive'] = $data['active'] = array();
        $res = $this->db->select("mlm_user_id,pin_number,allocate_amount,balance_amount,allocate_date,expiry_date,status,used_by,used_for");
        $this->db->from("pin_numbers");
        if ($user_id)
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get();
        $i = $j = 0;

        foreach ($res->result() as $row) {
            if ($row->balance_amount <= 0 || strtotime($row->expiry_date) < $today) {
                $data['inactive'][$i]['slno'] = $i + 1;
                $data['inactive'][$i]['username'] = $this->helper_model->IdToUserName($row->mlm_user_id);
                $data['inactive'][$i]['pin_number'] = $row->pin_number;
                $data['inactive'][$i]['allocate_amount'] = $row->allocate_amount;
                $data['inactive'][$i]['balance_amount'] = $row->balance_amount;
                if (strtotime($row->expiry_date) > $today) {
                    $data['inactive'][$i]['used_by'] = lang('nill');
                    ;
                    $data['inactive'][$i]['used_for'] = lang('expired');
                } else {
                    $data['inactive'][$i]['used_by'] = $this->helper_model->IdToUserName($row->used_by);
                    $data['inactive'][$i]['used_for'] = $row->used_for;
                }

                $i++;
            } else {
                $data['active'][$j]['slno'] = $j + 1;
                $data['active'][$j]['username'] = $this->helper_model->IdToUserName($row->mlm_user_id);
                $data['active'][$j]['pin_number'] = $row->pin_number;
                $data['active'][$j]['allocate_amount'] = $row->allocate_amount;
                $data['active'][$j]['balance_amount'] = $row->balance_amount;
                $data['active'][$j]['allocate_date'] = $row->allocate_date;
                $data['active'][$j]['expiry_date'] = $row->expiry_date;
                $j++;
            }
        }
        return $data;
    }

    /**
     * for checking user balance
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function checkUserBalance($data) {
        $amount_needed = $data['pin_amount'] * $data['pin_count'];
        $user_balance = $this->helper_model->getUserBalance($data['user_id']);
        if ($user_balance >= $amount_needed) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * for creating an epin request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function addPinRequest($data) {
        $this->db->set('mlm_user_id', $data['user_id'])
                ->set('amount', $data['pin_amount'])
                ->set('count', $data['pin_count'])
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('pin_request');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting total data limit
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalDataLimit($request) {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }
        return $limit;
    }

    /**
     * for setting datatable headings for epin
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnPinActive() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'pin_number', 'dt' => 2),
            array('db' => 'allocate_amount', 'dt' => 3),
            array('db' => 'balance_amount', 'dt' => 4),
            array('db' => 'allocate_date', 'dt' => 5),
            array('db' => 'expiry_date', 'dt' => 6),
            array('db' => 'status', 'dt' => 7),
            array('db' => 'used_by', 'dt' => 8)
        );
    }

    /**
     * for getting all active pin count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfTotalPinActive() {
        $today = date("Y-m-d H:i:s");
        return $this->db->select('mlm_user_id')
                        ->from('pin_numbers')
                        ->where('balance_amount >', 0)
                        ->where('expiry_date >', $today)
                        ->count_all_results();
    }

    /**
     * for getting all filtered active pin count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredTotalPinActive($table1, $table2, $where) {
        $today = date("Y-m-d H:i:s");
        if ($where) {
            $where = $where . " AND t2.balance_amount > 0 AND t2.expiry_date >='" . $today . "' AND ";
        } else {
            $where = " WHERE t2.balance_amount > 0 AND t2.expiry_date >='" . $today . "' AND ";
        }

        $query = $this->db->query("select t2.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id");

        return $query->num_rows();
    }

    /**
     * for getting all active pin details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataTotalPinActive($table1, $table2, $where, $order, $limit) {
        $today = date("Y-m-d H:i:s");
        $data = array();
        if ($where) {
            $where = $where . " AND t2.balance_amount > 0 AND t2.expiry_date >='" . $today . "' AND ";
        } else {
            $where = " WHERE t2.balance_amount > 0 AND t2.expiry_date >='" . $today . "' AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.pin_number,t2.allocate_amount,t2.balance_amount,t2.allocate_date,t2.expiry_date,t2.status,t2.used_by from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for setting datatable headings for epin
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnPinUsed() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'pin_number', 'dt' => 2),
            array('db' => 'allocate_amount', 'dt' => 3),
            array('db' => 'balance_amount', 'dt' => 4),
            array('db' => 'used_for', 'dt' => 5),
            array('db' => 'used_by', 'dt' => 6),
            array('db' => 'expiry_date', 'dt' => 7)
        );
    }

    /**
     * for getting all used pin count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfTotalPinUsed() {
        $today = date("Y-m-d H:i:s");
        return $this->db->select('mlm_user_id')
                        ->from('pin_numbers')
                        ->where('balance_amount <=', 0)
                        ->or_where('expiry_date <', $today)
                        ->count_all_results();
    }

    /**
     * for getting all filtered used pin count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredTotalPinUsed($table1, $table2, $where) {
        $today = date("Y-m-d H:i:s");
        if ($where) {
            $where = $where . " AND ( t2.balance_amount <= 0 OR t2.expiry_date <'" . $today . "' ) AND ";
        } else {
            $where = " WHERE ( t2.balance_amount <= 0 OR t2.expiry_date <'" . $today . "' ) AND ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.pin_number,t2.allocate_amount,t2.balance_amount,t2.used_for,t2.used_by,t2.expiry_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id");
        return $query->num_rows();
    }

    /**
     * for getting all used pin details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataTotalPinUsed($table1, $table2, $where, $order, $limit) {
        $today = date("Y-m-d H:i:s");
        $data = array();
        if ($where) {
            $where = $where . " AND ( t2.balance_amount <= 0 OR t2.expiry_date <'" . $today . "' ) AND ";
        } else {
            $where = " WHERE ( t2.balance_amount <= 0 OR t2.expiry_date <'" . $today . "' ) AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.pin_number,t2.allocate_amount,t2.balance_amount,t2.used_for,t2.used_by,t2.expiry_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for setting datatable headings for pin requests
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnPinRequest() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 't2.mlm_user_id', 'dt' => 2),
            array('db' => 'amount', 'dt' => 3),
            array('db' => 'count', 'dt' => 4),
            array('db' => 't2.date', 'dt' => 5),
            array('db' => 'status', 'dt' => 6),
            array('db' => 'email', 'dt' => 7)
        );
    }

    /**
     * for getting all epin request count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfTotalPinRequest() {
        return $this->db->select('mlm_user_id')
                        ->from('pin_request')
                        ->count_all_results();
    }

    /**
     * for getting all filtered epin request count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredTotalPinRequest($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.mlm_user_id,t2.amount,t2.count,t2.date,t2.status,t1.email from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");

        return $query->num_rows();
    }

    /**
     * for getting all epin request details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataTotalPinRequest($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.mlm_user_id,t2.amount,t2.count,t2.date,t2.status,t1.email from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting all count of previous list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfPreviousList($user_id) {
        return $this->db->select('id')
                        ->where("mlm_user_id", $user_id)
                        ->from("pin_request")
                        ->count_all_results();
    }

    /**
     * for setting datatable heading for previous list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnPreviousList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'amount', 'dt' => 1),
            array('db' => 'count', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'status', 'dt' => 4)
        );
    }

    /**
     * for getting filtered count of previous list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredPreviousList($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id ";
        } else {
            $where = " WHERE mlm_user_id=$user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting all previous list details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataPreviousList($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id ";
        } else {
            $where = " WHERE mlm_user_id=$user_id ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting count of active list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfActiveList($user_id) {
        return $this->db->select('id')
                        ->where("mlm_user_id", $user_id)
                        ->from("pin_numbers")
                        ->count_all_results();
    }

    /**
     * for setting datatable heading for active list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnActiveList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'pin_number', 'dt' => 1),
            array('db' => 'allocate_amount', 'dt' => 2),
            array('db' => 'balance_amount', 'dt' => 3),
            array('db' => 'allocate_date', 'dt' => 4),
            array('db' => 'expiry_date', 'dt' => 5),
            array('db' => 'status', 'dt' => 6)
        );
    }

    /**
     * for getting filtered count of active list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredActiveList($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id ";
        } else {
            $where = " WHERE mlm_user_id=$user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting all active list details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataActiveList($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id ";
        } else {
            $where = " WHERE mlm_user_id=$user_id ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for setting datatable heading for user used epins
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnPinUsedUser() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'pin_number', 'dt' => 1),
            array('db' => 'allocate_amount', 'dt' => 2),
            array('db' => 'balance_amount', 'dt' => 3),
            array('db' => 'used_for', 'dt' => 4),
            array('db' => 'used_by', 'dt' => 5),
            array('db' => 'expiry_date', 'dt' => 6)
        );
    }

    /**
     * for getting all count of epin used by an user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfPinUsedUser($user_id) {
        $today = date("Y-m-d H:i:s");
        return $this->db->select('mlm_user_id')
                        ->from('pin_numbers')
                        ->where('balance_amount <=', 0)
                        ->where('mlm_user_id', $user_id)
                        ->or_where('expiry_date <', $today)
                        ->count_all_results();
    }

    /**
     * for getting filtered count of epin used by an user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredPinUsedUser($table, $where, $user_id) {
        $today = date("Y-m-d H:i:s");
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id AND ( balance_amount <= 0 OR expiry_date <'" . $today . "' ) ";
        } else {
            $where = " WHERE mlm_user_id=$user_id AND ( balance_amount <= 0 OR expiry_date <'" . $today . "' ) ";
        }

        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting all epin used by an user details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataPinUsedUser($table, $column, $where, $order, $limit, $user_id) {
        $today = date("Y-m-d H:i:s");
        $data = array();
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id AND ( balance_amount <= 0 OR expiry_date <'" . $today . "' ) ";
        } else {
            $where = " WHERE mlm_user_id=$user_id AND ( balance_amount <= 0 OR expiry_date <'" . $today . "' ) ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for updating epin status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function updatePinStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id ', "$id")
                ->update('pin_numbers');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
