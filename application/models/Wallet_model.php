<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For Wallet model
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Wallet_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * For add fund transfer
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_user
     * @param type $to_user
     * @param type $amount
     * @param type $wallet_type
     * @return type
     */
    public function addFundTransfer($from_user, $to_user, $amount, $wallet_type, $reason = 'NA', $type = 'wal-1') {
        $this->db->set('from_user', $from_user)
                ->set('to_user', $to_user)
                ->set('transfer_type', $wallet_type)
                ->set('date', date("Y-m-d H:i:s"))
                ->set('amount', $amount)
                ->set('reason', $reason)
                ->set('wallet_type', $type)
                ->insert('wallet_transfer');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get user wallets transfer details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getUserWalletTransferDetails($user_id) {
        $data = array();
        $res = $this->db->select("to_user,amount,transfer_type,date")
                ->from("wallet_transfer")
                ->where("from_user", $user_id)
                ->where("transfer_type", "transfer_by_user")
                ->order_by('id', 'desc')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['slno'] = $i + 1;
            $data[$i]['to_user'] = $this->helper_model->IdToUserName($row->to_user);
            $data[$i]['full_name'] = $this->helper_model->getUserFullName($row->to_user);
            $data[$i]['transfer_type'] = $row->transfer_type;
            $data[$i]['date'] = $row->date;
            $data[$i]['amount'] = $row->amount;
            $i++;
        }
        return $data;
    }

    /**
     * For get sum of wallets one
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    public function getSumWalletsWallet1($user_id, $type) {
        $amt = '';
        $field = 'amount1';
        if ($type == 'debit') {
            $field = 'original_amount';
        }
        $query = $this->db->select_sum($field)
                ->from('wallet_details')
                ->where('mlm_user_id', $user_id)
                ->where('type', $type)
                ->where('amount1 >', 0)
                ->get();
        foreach ($query->result() as $row) {
            $amt = $row->$field;
        }
        return $amt;
    }

    /**
     * For get sum wallet two
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    public function getSumWalletsWallet2($user_id, $type) {
        $amt = '';
        $field = 'amount2';
        $query = $this->db->select_sum($field)
                ->from('wallet_details')
                ->where('mlm_user_id', $user_id)
                ->where('type', $type)
                ->where('amount2 >', 0)
                ->get();
        foreach ($query->result() as $row) {
            $amt = $row->$field;
        }
        return $amt;
    }

    /**
     * For count DEBIT value wallet two
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    function countCreditDebitWallet2($user_id, $type) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount2 > ", 0)
                        ->where('type', $type)
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For count of DEBIT wallet two
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    function countCreditDebitWallet1($user_id, $type) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount1 > ", 0)
                        ->where('type', $type)
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For count of month wallet one
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countCurrentMonthWallet1($user_id, $from_date, $to_date) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount1 > ", 0)
                        ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For count current month wallet two
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countCurrentMonthWallet2($user_id, $from_date, $to_date) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount2 > ", 0)
                        ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For get sum of payout
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $status
     * @param type $amount_type
     * @return type
     */
    public function getSumPayout($user_id, $status) {
        $amt = '';
        $query = $this->db->select_sum('original_amount')
                ->from('wallet_details')
                ->where('mlm_user_id', $user_id)
                ->where("amount1 > ", 0)
                ->where('wallet_type', $status)
                ->get();

        foreach ($query->result() as $row) {
            $amt = $row->original_amount;
        }
        return $amt;
    }

    /**
     * For get payout release details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getPayoutReleaseDetails() {
        $data = array();
        $res = $this->db->select("id,from_user,amount1,date,transation_id")
                ->from("wallet_details")
                ->where("amount1 > ", 0)
                ->where("payout_status", 'pending')
                ->where("wallet_type", 'payout_release')
                ->order_by('date', 'desc')
                ->get();

        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['slno'] = $i + 1;
            $data[$i]['from_user'] = $this->helper_model->IdToUserName($row->from_user);
            $data[$i]['full_name'] = $this->helper_model->getUserFullName($row->from_user);
            $data[$i]['date'] = $row->date;
            $data[$i]['amount'] = $row->amount1;
            $data[$i]['transation_id'] = $row->transation_id;
            $data[$i]['user_id'] = $row->from_user;
            $data[$i]['id'] = $row->id;
            $i++;
        }
        return $data;
    }

    /**
     * For update payout status reject
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @param type $amount
     * @return type
     */
    function updatePayoutStatusReject($id, $status, $amount) {
        $this->db->set('payout_status ', "$status")
                ->set('amount1 ', $amount)
                ->set('transation_charges', 0)
                ->where('id ', $id)
                ->update('wallet_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update payout status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    function updatePayoutStatus($id, $status) {
        $this->db->set('payout_status ', "$status")
                ->where('id ', $id)
                ->update('wallet_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update delete status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $tran_id
     * @return type
     */
    function updateDeletePayoutStatus($tran_id) {
        $this->db->set('type ', "credit")
                ->where('transation_id ', $tran_id)
                ->update('wallet_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting Transaction ID from User ID
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getUserIdTransId($id) {
        $mlm_user_id = '';
        $query = $this->db->select('mlm_user_id')
                ->from('wallet_details')
                ->where('id', $id)
                ->where("wallet_type", 'payout_release')
                ->get();
        foreach ($query->result() as $row) {
            $mlm_user_id = $row->mlm_user_id;
        }
        return $mlm_user_id;
    }

    /**
     * For getting the amount For  transaction ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getAmountTransId($id) {
        $amount = '';
        $query = $this->db->select('original_amount')
                ->from('wallet_details')
                ->where('id', $id)
                ->where("wallet_type", 'payout_release')
                ->get();
        foreach ($query->result() as $row) {
            $amount = $row->original_amount;
        }
        return $amount;
    }

    /**
     * For getting the column name wallet two
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnWallet2() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'transation_id', 'dt' => 1),
            array('db' => 'wallet_type', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'tax2', 'dt' => 4),
            array('db' => 'amount2', 'dt' => 5),
            array('db' => 'type', 'dt' => 6),
            array('db' => 'from_user', 'dt' => 7)
        );
    }

    /**
     * 
     * for getting column name for wallet one
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnWallet1() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'transation_id', 'dt' => 1),
            array('db' => 'wallet_type', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'tax1', 'dt' => 4),
            array('db' => 'transation_charges', 'dt' => 5),
            array('db' => 'amount1', 'dt' => 6),
            array('db' => 'type', 'dt' => 7),
            array('db' => 'from_user', 'dt' => 8)
        );
    }

    /**
     * 
     * for getting the count of wallet transaction one
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function countAllTransationWallet1($user_id) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount1 >", 0)
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    function getTableColumnTransationWallet($amount_field, $tax_field) {
        return array(
            array('db' => 't2.user_name', 'dt' => 0),
            array('db' => 't1.transation_id', 'dt' => 1),
            array('db' => 't1.wallet_type', 'dt' => 2),
            array('db' => 't1.date', 'dt' => 3),
            array('db' => 't1.type', 'dt' => 4),
            array('db' => "t1.$amount_field", 'dt' => 5),
            array('db' => "t1.$tax_field", 'dt' => 6),
            array('db' => "t1.transation_charges", 'dt' => 7)
        );
    }

    function countTransationWallet($table1, $table2, $user_id, $type, $amount_field) {

        if ($type == '') {
            $where = " WHERE t1.mlm_user_id = $user_id AND $amount_field > 0 ";
        } else {
            $where = " WHERE t1.mlm_user_id = $user_id AND type= '" . $type . "' AND $amount_field > 0 ";
        }

        $query = $this->db->query("select t1.mlm_user_id from " . $table1 . " AS t1  LEFT JOIN " . $table2 . " AS t2 ON t1.from_user = t2.mlm_user_id " . $where . " ");


        return $query->num_rows();
    }

    function getTotalFilteredTransationWallet($table1, $table2, $where, $user_id, $type, $amount_field) {
        if ($where) {

            if ($type == '') {
                $where = $where . " AND t1.mlm_user_id = $user_id AND $amount_field > 0 ";
            } else {
                $where = $where . " AND t1.mlm_user_id = $user_id AND type= '" . $type . "' AND $amount_field > 0 ";
            }
        } else {
            if ($type == '') {
                $where = " WHERE t1.mlm_user_id = $user_id AND $amount_field > 0 ";
            } else {
                $where = " WHERE t1.mlm_user_id = $user_id AND type= '" . $type . "' AND $amount_field > 0 ";
            }
        }
        $query = $this->db->query("select t1.mlm_user_id from " . $table1 . " AS t1  LEFT JOIN " . $table2 . " AS t2 ON t1.from_user = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataTransationWallet($table1, $table2, $where, $order, $limit, $user_id, $type, $amount_field, $tax_field) {
        $data = array();
        if ($where) {

            if ($type == '') {
                $where = $where . " AND t1.mlm_user_id = $user_id AND $amount_field > 0 ";
            } else {
                $where = $where . " AND t1.mlm_user_id = $user_id AND type= '" . $type . "' AND $amount_field > 0 ";
            }
        } else {
            if ($type == '') {
                $where = " WHERE t1.mlm_user_id = $user_id AND $amount_field > 0 ";
            } else {
                $where = " WHERE t1.mlm_user_id = $user_id AND type= '" . $type . "' AND $amount_field > 0 ";
            }
        }

        $query = $this->db->query("select t2.user_name,t1.transation_id,t1.wallet_type,t1.date,t1.type,t1.$amount_field,t1.$tax_field,t1.transation_charges from " . $table1 . " AS t1  LEFT JOIN " . $table2 . " AS t2 ON t1.from_user = t2.mlm_user_id " . $where . $order . " " . $limit);

        //  echo $this->db->last_query();die;

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }

        return $data;
    }

    /**
     * For getting the count of transaction wallet two
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countAllTransationWallet2($user_id) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount2 >", 0)
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * 
     * for getting all month wise details of wallet one
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    public function getSumWalletsMonthWallet1($user_id, $type, $from_date, $to_date) {
        $amt = '';
        $query = $this->db->select_sum('amount1')
                ->from('wallet_details')
                ->where('mlm_user_id', $user_id)
                ->where('type', $type)
                ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                ->get();
        foreach ($query->result() as $row) {
            $amt = $row->amount1;
        }
        return $amt;
    }

    /**
     * For getting the sum of month wise wallet two
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    public function getSumWalletsMonthWallet2($user_id, $type, $from_date, $to_date) {
        $amt = '';
        $query = $this->db->select_sum('amount2')
                ->from('wallet_details')
                ->where('mlm_user_id', $user_id)
                ->where('type', $type)
                ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                ->get();
        foreach ($query->result() as $row) {
            $amt = $row->amount2;
        }
        return $amt;
    }

    /**
     * For getting the column name of 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnPayout() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'transation_id', 'dt' => 1),
            array('db' => 'wallet_type', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'transation_charges', 'dt' => 4),
            array('db' => 'tax1', 'dt' => 5),
            array('db' => 'amount1', 'dt' => 6),
            array('db' => 'payout_status', 'dt' => 7),
            array('db' => 'payout_details', 'dt' => 8)
        );
    }

    /**
     * For getting the all payout details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredPayoutAll($table, $where, $user_id) {
        if ($where) {
            $where = $where . ' AND amount1 > 0 AND ';
        } else {
            $where = ' WHERE amount1 > 0 AND ';
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "mlm_user_id ='" . $user_id . "' AND wallet_type= 'payout_release'");

        return $query->num_rows();
    }

    /**
     * For payout details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $user_id
     * @param type $payout_status
     * @return type
     */
    function getTotalFilteredPayout($table, $where, $user_id, $payout_status) {
        if ($where) {
            $where = $where . ' AND amount1 > 0 AND ';
        } else {
            $where = ' WHERE amount1 > 0 AND ';
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "mlm_user_id =" . $user_id . " AND  wallet_type ='" . $payout_status . "'");


        return $query->num_rows();
    }

    /**
     * For getting all payout details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @return type
     */
    function getResultDataPayoutAll($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND wallet_type='payout_release' AND amount1 > 0 AND ";
        } else {
            $where = " WHERE wallet_type='payout_release' AND amount1 > 0 AND ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . "mlm_user_id =" . $user_id . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For all payout data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @param type $payout_status
     * @return type
     */
    function getResultDataPayout($table, $column, $where, $order, $limit, $user_id, $payout_status) {
        $data = array();
        if ($where) {
            $where = $where . " AND wallet_type='" . $payout_status . "' AND amount1 > 0 AND ";
        } else {
            $where = " WHERE wallet_type='" . $payout_status . "' AND amount1 > 0 AND ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . "mlm_user_id =" . $user_id . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count all payout
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countPayoutAll($user_id) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount1 >", 0)
                        ->where('mlm_user_id', $user_id)
                        ->where("wallet_type", 'payout_release')
                        ->count_all_results();
    }

    /**
     * For getting count of payout
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $payout_status
     * @return type
     */
    function countPayout($user_id, $payout_status) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount1 >", 0)
                        ->where('mlm_user_id', $user_id)
                        ->where("wallet_type", $payout_status)
                        ->count_all_results();
    }

    /**
     * For getting all investment history details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return int
     */
    public function getAllInvestmentHistory($user_id = 0) {
        $investments = array();
        $res = $this->db->select("id,name")
                ->from("investment_category")
                ->where("status", 1)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $category_id = $row->id;
            $category_name = $row->name;
            $data = $this->getCategoryHistory($user_id, $category_id);
            $total_investment = $this->getTotalInvestment($user_id, $category_id);
            $investments[$i]['category_id'] = $category_id;
            $investments[$i]['category_name'] = $category_name;
            $investments[$i]['investment_data'] = $data;
            $investments[$i]['total_investment'] = $total_investment;
            if (!$i) {
                $investments[$i]['active'] = 1;
            } else {
                $investments[$i]['active'] = 0;
            }
            $i++;
        }
        return $investments;
    }

    /**
     * For get total investment details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $category_id
     * @return type
     */
    public function getTotalInvestment($user_id = 0, $category_id) {
        $amt = 0;
        $this->db->select_sum("pay_amount");
        $this->db->from("investment_history");
        if ($user_id)
            $this->db->where("mlm_user_id", $user_id);
        $this->db->where("category_id", $category_id);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $amt = $row->pay_amount;
        }
        return $amt;
    }

    /**
     * For get product name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $product_id
     * @return type
     */
    public function getProductName($product_id) {
        $product_name = '';
        $query = $this->db->select('product_name')
                ->from('products')
                ->where('id', $product_id)
                ->get();
        foreach ($query->result() as $row) {
            $product_name = $row->product_name;
        }
        return $product_name;
    }

    /**
     * For getting all investment currency details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getAllInvestmentCurrency() {
        $inv = array();
        $res = $this->db->select("id,name")
                ->from("investment_category")
                ->where("status", 1)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $inv[$i]['category_id'] = $row->id;
            $inv[$i]['category_name'] = $row->name;
            $i++;
        }
        return $inv;
    }

    /**
     * For get investment balance 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $cat_id
     * @return type
     */
    public function getInCateBalance($user_id, $cat_id) {
        $fld_name = $cat_id . '_balance_amount';
        $balance = 0;
        $query = $this->db->select($fld_name)
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('investment_user_balance');
        if ($query->num_rows() > 0) {
            $balance = $query->row()->$fld_name;
        }
        return $balance;
    }

    /**
     * For add investment request
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $inv_category
     * @param type $req_amount
     * @return type
     */
    public function addInvestmentRequest($user_id, $inv_category, $req_amount) {
        $this->db->set('user_id', $user_id)
                ->set('cat_id', $inv_category)
                ->set('req_amount', $req_amount)
                ->set('req_date', date("Y-m-d H:i:s"))
                ->insert('inv_release_history');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For deduct the investment balance
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $inv_category
     * @param type $req_amount
     * @return type
     */
    public function dedUserInvBalance($user_id, $inv_category, $req_amount) {
        $fld_name = $inv_category . '_balance_amount';
        $this->db->set($fld_name, "ROUND(" . $fld_name . "-" . $req_amount . ",8)", FALSE)
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->update('investment_user_balance');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting all investment request 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getAllInvestmentRequests($user_id = 0) {
        $inv = array();
        $this->db->select("user_id,cat_id,req_amount,req_date,status");
        $this->db->from("inv_release_history");
        if ($user_id) {
            $this->db->where("user_id", $user_id);
        }
        $res = $this->db->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $inv[$i]['cat_id'] = $row->cat_id;
            $inv[$i]['cat_name'] = $this->getInvCateName($row->cat_id);
            $inv[$i]['req_amount'] = $row->req_amount;
            $inv[$i]['req_date'] = $row->req_date;
            $inv[$i]['status'] = $row->status;
            $i++;
        }
        return $inv;
    }

    /**
     * For get investment category name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
      FD
     * @param type $cat_id
     * @return type
     */
    public function getInvCateName($cat_id) {
        $name = '';
        $query = $this->db->select('name')
                ->where('id', $cat_id)
                ->limit(1)
                ->get('investment_category');
        if ($query->num_rows() > 0) {
            $name = $query->row()->name;
        }
        return $name;
    }

    /**
     * For update the investment request
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    function updateInvRequest($id, $status) {
        $this->db->set('status ', "$status")
                ->set('confirm_date', date("Y-m-d H:i:s"))
                ->where('id ', $id)
                ->update('inv_release_history');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For revert investment details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return boolean
     */
    function revertInvestmentBalance($id) {
        $query = $this->db->select("user_id,cat_id,req_amount")
                ->from("inv_release_history")
                ->where("id", $id)
                ->get();
        if ($query->num_rows() > 0) {
            $cat_id = $query->row()->cat_id;
            $user_id = $query->row()->user_id;
            $req_amount = $query->row()->req_amount;

            if ($req_amount > 0 && $cat_id > 0) {
                $fld_name = $cat_id . '_balance_amount';
                $this->db->set($fld_name, "ROUND(" . $fld_name . "+" . $req_amount . ",8)", FALSE)
                        ->where('mlm_user_id', $user_id)
                        ->limit(1)
                        ->update('investment_user_balance');
            }
        }
        return TRUE;
    }

    /**
     * For count of investment 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfInvestment() {
        return $this->db->select('id')
                        ->from('inv_release_history')
                        ->count_all_results();
    }

    /**
     * For table column investment table
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnInvestment() {
        return array(
            array('db' => "t2.id", 'dt' => 0),
            array('db' => "user_name", 'dt' => 1),
            array('db' => "name", 'dt' => 2),
            array('db' => "req_amount", 'dt' => 3),
            array('db' => "req_date", 'dt' => 4),
            array('db' => "t2.status", 'dt' => 5),
            array('db' => "cat_id", 'dt' => 6)
        );
    }

    /**
     * For getting the total investment details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @return type
     */
    function getTotalFilteredInvestment($table1, $table2, $table3, $where) {
        $query = $this->db->query("select t2.id,t1.user_name,t3.name,t2.req_amount,t2.req_date,t2.status,t2.cat_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.user_id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.cat_id " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the investment
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataInvestment($table1, $table2, $table3, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select t2.id,t1.user_name,t3.name,t2.req_amount,t2.req_date,t2.status,t2.cat_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.user_id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.cat_id " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For count of payout release
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfPayoutRelease() {
        return $this->db->select('t2.mlm_user_id')
                        ->where("t2.amount1 > ", 0)
                        ->where("t2.wallet_type", 'payout_requested')
                        ->from('user AS t1')
                        ->join("wallet_details as t2", 't1.mlm_user_id = t2.mlm_user_id', 'inner')
                        ->count_all_results();
    }

    /**
     * For getting table payout release column names
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnPayoutRelease() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 't1.mlm_user_id', 'dt' => 2),
            array('db' => 't2.date', 'dt' => 3),
            array('db' => 'amount1', 'dt' => 4),
            array('db' => 'transation_id', 'dt' => 5),
            array('db' => 'payout_status', 'dt' => 6),
        );
    }

    /**
     * For getting total filtered payout release
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredPayoutRelease($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND t2.amount1 > 0   AND t2.wallet_type='payout_requested' AND ";
        } else {
            $where = " WHERE t2.amount1 > 0  AND  t2.wallet_type='payout_requested' AND ";
        }
        $query = $this->db->query("select t2.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id");
        return $query->num_rows();
    }

    /**
     * For getting the payout release details
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
    function getResultDataPayoutRelease($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND t2.amount1 > 0  AND t2.wallet_type='payout_requested' AND ";
        } else {
            $where = " WHERE t2.amount1 > 0  AND  t2.wallet_type='payout_requested' AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t1.mlm_user_id,t2.date,t2.amount1,t2.mlm_user_id,t2.payout_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For get all investment category
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return int
     */
    public function getAllInvCategory() {
        $investments = array();
        $res = $this->db->select("id,name")
                ->from("investment_category")
                ->where("status", 1)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $investments[$i]['category_id'] = $row->id;
            $investments[$i]['name'] = $row->name;
            $investments[$i]['count'] = $this->countOfInvestmentHistory($row->id);
            if (!$i) {
                $investments[$i]['active'] = 1;
            } else {
                $investments[$i]['active'] = 0;
            }
            $i++;
        }
        return $investments;
    }

    /**
     * For get the category history
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $category_id
     * @return type
     */
    function getCategoryHistory($user_id = 0, $category_id) {
        $data = array();
        $this->db->select("mlm_user_id,date,product_id,pay_amount");
        $this->db->from("investment_history");
        if ($user_id)
            $this->db->where("mlm_user_id", $user_id);
        $this->db->where("category_id", $category_id);
        $this->db->where("pay_amount >", 0);
        $this->db->order_by('id', 'desc');
        $res = $this->db->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['user_id'] = $row->mlm_user_id;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->mlm_user_id);
            $data[$i]['pay_amount'] = $row->pay_amount;
            $data[$i]['product_id'] = $row->product_id;
            $data[$i]['product_name'] = $this->getProductName($row->product_id);
            $data[$i]['date'] = $row->date;
            $i++;
        }
        return $data;
    }

    /**
     * 
     * for investment history table column name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnInvestmentHistory() {
        return array(
            array('db' => "t2.id", 'dt' => 0),
            array('db' => "user_name", 'dt' => 1),
            array('db' => "pay_amount", 'dt' => 2),
            array('db' => "product_name", 'dt' => 3),
            array('db' => "t2.date", 'dt' => 4)
        );
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfInvestmentHistory($category_id) {
        return $this->db->select('id')
                        ->from('investment_history')
                        ->where("category_id", $category_id)
                        ->where("pay_amount >", 0)
                        ->count_all_results();
    }

    /**
     * For get investment history
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @param type $category_id
     * @return type
     */
    function getTotalFilteredInvestmentHistory($table1, $table2, $table3, $where, $category_id) {
        if ($where) {
            $where = $where . " AND pay_amount > 0  AND t2.category_id=$category_id ";
        } else {
            $where = " WHERE pay_amount > 0  AND t2.category_id=$category_id  ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.pay_amount,t3.product_name,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.product_id " . $where);
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataInvestmentHistory($table1, $table2, $table3, $where, $order, $limit, $category_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND pay_amount > 0  AND t2.category_id=$category_id ";
        } else {
            $where = " WHERE pay_amount > 0  AND t2.category_id=$category_id ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.pay_amount,t3.product_name,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.product_id " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For investment history for users column names
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnInvestmentHistoryUser() {
        return array(
            array('db' => "t1.id", 'dt' => 0),
            array('db' => "pay_amount", 'dt' => 1),
            array('db' => "product_name", 'dt' => 2),
            array('db' => "t1.date", 'dt' => 3)
        );
    }

    /**
     * For count of investment history user
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $category_id
     * @param type $user_id
     * @return type
     */
    function countOfInvestmentHistoryUser($category_id, $user_id) {
        return $this->db->select('id')
                        ->from('investment_history')
                        ->where("category_id", $category_id)
                        ->where("mlm_user_id", $user_id)
                        ->where("pay_amount >", 0)
                        ->count_all_results();
    }

    /**
     * For users investment history details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $category_id
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredInvestmentHistoryUser($table1, $table2, $where, $category_id, $user_id) {
        if ($where) {
            $where = $where . " AND pay_amount > 0  AND category_id = $category_id AND mlm_user_id=$user_id AND ";
        } else {
            $where = " WHERE pay_amount > 0  AND category_id=$category_id AND mlm_user_id=$user_id AND ";
        }
        $query = $this->db->query("select t1.id,t1.pay_amount,t2.product_name,t1.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.product_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For user investment history details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $category_id
     * @param type $user_id
     * @return type
     */
    function getResultDataInvestmentHistoryUser($table1, $table2, $where, $order, $limit, $category_id, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND pay_amount > 0  AND category_id = $category_id AND mlm_user_id=$user_id AND ";
        } else {
            $where = " WHERE pay_amount > 0  AND category_id = $category_id AND mlm_user_id=$user_id AND ";
        }
        $query = $this->db->query("select t1.id,t1.pay_amount,t2.product_name,t1.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.product_id = t2.id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For count investment registration
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countOfInvestmentReq($user_id) {
        return $this->db->select('id')
                        ->from('inv_release_history')
                        ->where("user_id", $user_id)
                        ->count_all_results();
    }

    /**
     * count of investment request table column names
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnInvestmentReq() {
        return array(
            array('db' => "t1.id", 'dt' => 0),
            array('db' => "name", 'dt' => 1),
            array('db' => "req_amount", 'dt' => 2),
            array('db' => "req_date", 'dt' => 3),
            array('db' => "t1.status", 'dt' => 4)
        );
    }

    /**
     * For investment request details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredInvestmentReq($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND user_id=$user_id AND ";
        } else {
            $where = " WHERE user_id=$user_id AND ";
        }
        $query = $this->db->query("select t1.id,t2.name,t1.req_amount,t1.req_date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.cat_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For investment request details
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
    function getResultDataInvestmentReq($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND user_id=$user_id AND ";
        } else {
            $where = " WHERE user_id=$user_id AND ";
        }
        $query = $this->db->query("select t1.id,t2.name,t1.req_amount,t1.req_date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.cat_id = t2.id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getUserAddedKycDetails($user_id) {
        $ads_flag = $this->db->where('status', 'accepted')
                ->where('user_id', $user_id)
                ->where('type', 'address_proof')
                ->count_all_results('user_kyc');
        $idt_flag = $this->db->where('status', 'accepted')
                ->where('user_id', $user_id)
                ->where('type', 'identity_proof')
                ->count_all_results('user_kyc');
        if ($ads_flag && $idt_flag) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * For Rejecting Payout Release
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function rejectPayoutRelease($wallet_id, $details) {
        if ($details['amount'] > 0) {
            $rejected_user_id = $details['mlm_user_id'];
            $amount = $details['amount'];
            $res = $this->addBalance($rejected_user_id, $amount);
            if ($res) {
                return $this->db->where('id', $wallet_id)
                                ->delete('wallet_details');
            }
        }
        return 0;
    }

    public function addBalance($user_id, $amount) {
        $this->db->set('balance_amount', 'ROUND(balance_amount +' . $amount . ',8)', FALSE);
        $this->db->set('released_amount', 'ROUND(released_amount -' . $amount . ',8)', FALSE);
        $this->db->where('mlm_user_id', $user_id);
        $this->db->limit(1);
        $this->db->update('user_balance');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the Amount & Userid For  rejected transaction ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getRejectedDetails($id) {
        $data = array();
        $query = $this->db->select('mlm_user_id,original_amount,id,date,transation_charges')
                ->from('wallet_details')
                ->where('id', $id)
                ->where("wallet_type", 'payout_requested')
                ->get();
        foreach ($query->result() as $row) {
            $data['amount'] = $row->original_amount;
            $data['id'] = $row->id;
            $data['mlm_user_id'] = $row->mlm_user_id;
            $data['date'] = $row->date;
            $data['transation_charges'] = $row->transation_charges;
            $data['action'] = 'delete';
        }
        return $data;
    }

    /**
     * For Rejecting Payout Release
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function confirmPayoutRelease($wallet_id) {
        $user_id = $this->getUserIdFromPayoutRequest($wallet_id);
        $payout_details = $this->getUserAccountSettings($user_id, 1);
        $this->db->set('wallet_type', 'payout_released')
                ->set('payout_details', serialize($payout_details))
                ->where('wallet_type', 'payout_requested')
                ->where('id', $wallet_id)
                ->update('wallet_details');
        if ($this->db->affected_rows()) {
            return TRUE;
        }
    }

    public function getUserIdFromPayoutRequest($wallet_id) {
        $mlm_user_id = NULL;
        $query = $this->db->select('mlm_user_id')
                ->where('id', $wallet_id)
                ->limit(1)
                ->get('wallet_details');
        if ($query->num_rows() > 0) {
            $mlm_user_id = $query->row()->mlm_user_id;
        }
        return $mlm_user_id;
    }

    function getUserAccountSettings($user_id, $flag = 0) {
        if ($flag) {
            $details = array();
        } else {
            $details = '';
        }

        $this->load->model('member_model');
//        $paypal = $this->member_model->getStatusPayment('paypal');
//        $bank = $this->member_model->getStatusPayment('bank_transfer');
//        $coinpayments = $this->member_model->getStatusPayment('coinpayments');

        $payout_type = $this->dbvars->PAYOUT_METHOD;
        $data = $this->member_model->getPaymentConfig($user_id);
        if ($payout_type == "coinpayments") {
            $wallet_address = lang('na');
            if ($data['wallet_address']) {
                $wallet_address = $data['wallet_address'];
            }
            if ($flag) {
                $details['type'] = 'btc';
                $details['wallet_address'] = $wallet_address;
            } else {
                $details = lang('wallet_address') . ' : <b>' . $wallet_address . '</b>';
            }
        } elseif ($payout_type == "paypal") {
            $paypal_email = lang('na');
            if ($data['paypal_email']) {
                $paypal_email = $data['paypal_email'];
            }
            if ($flag) {
                $details['type'] = 'paypal';
                $details['paypal_email'] = $paypal_email;
            } else {
                $details = lang('paypal_email') . ' : <b>' . $paypal_email . '</b>';
            }
        } else {
            $bank_name = $bank_ac_holder_name = $bank_ac_number = $bank_branch = $bank_ifsc_code = lang('na');
            if ($data['bank_ac_holder_name']) {
                $bank_ac_holder_name = $data['bank_ac_holder_name'];
            }
            if ($data['bank_name']) {
                $bank_name = $data['bank_name'];
            }
            if ($data['bank_ac_number']) {
                $bank_ac_number = $data['bank_ac_number'];
            }
            if ($data['bank_branch']) {
                $bank_branch = $data['bank_branch'];
            }
            if ($data['bank_ifsc_code']) {
                $bank_ifsc_code = $data['bank_ifsc_code'];
            }

            if ($flag) {
                $details['type'] = 'bank';
                $details['bank_name'] = $bank_name;
                $details['ac_holder_name'] = $bank_ac_holder_name;
                $details['ac_number'] = $bank_ac_number;
                $details['branch'] = $bank_branch;
                $details['ifsc'] = $bank_ifsc_code;
            } else {
                $details = lang('bank_name') . ' : <b>' . $bank_name . '</b><br>'
                        . lang('bank_ac_holder_name') . ' : <b>' . $bank_ac_holder_name . '</b><br>'
                        . lang('bank_ac_number') . ' : <b>' . $bank_ac_number . '</b><br>'
                        . lang('bank_branch') . ' : <b>' . $bank_branch . '</b><br>'
                        . lang('bank_ifsc_code') . ' : <b>' . $bank_ifsc_code . '</b>';
            }
        }
        return $details;
    }

    function getTableColumnAddFund() {
        return array(
            array('db' => 't3.id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't2.first_name', 'dt' => 2),
            array('db' => 't3.amount', 'dt' => 3),
            array('db' => 't3.date', 'dt' => 4),
            array('db' => 't3.reason', 'dt' => 5),
            array('db' => 't2.last_name', 'dt' => 6)
        );
    }

    function countOfTotalAddFund($wal, $wallet_type) {
        return $this->db->select('id')
                        ->from('wallet_transfer')
                        ->where('wallet_type', $wal)
                        ->where('transfer_type', $wallet_type)
                        ->count_all_results();
    }

    function getPayoutDetails($data) {
        $details = unserialize($data);
        if ($details['type'] == 'btc') {
            $res = lang('wallet_address') . ' : <b>' . $details['wallet_address'] . '</b>';
        } elseif ($details['type'] == 'paypal') {
            $res = lang('paypal_email') . ' : <b>' . $details['paypal_email'] . '</b>';
        } elseif ($details['type'] == 'bank') {
            $res = lang('bank_name') . ' : <b>' . $details['bank_name'] . '</b><br>'
                    . lang('bank_ac_holder_name') . ' : <b>' . $details['ac_holder_name'] . '</b><br>'
                    . lang('bank_ac_number') . ' : <b>' . $details['ac_number'] . '</b><br>'
                    . lang('bank_branch') . ' : <b>' . $details['branch'] . '</b><br>'
                    . lang('bank_ifsc_code') . ' : <b>' . $details['ifsc'] . '</b>';
        } else {
            $res = lang('na');
        }
        return $res;
    }

    function getTotalFilteredAddFund($table1, $table2, $table3, $where, $type, $wallet_type) {
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        }

        $query = $this->db->query("select t3.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.to_user " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataTotalAddFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type) {
        $data = array();
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        }
        $query = $this->db->query("select t3.id,t1.user_name,t2.first_name,t3.amount,t3.reason,t3.date,t2.last_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.to_user " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnDedFund() {
        return array(
            array('db' => 't3.id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't2.first_name', 'dt' => 2),
            array('db' => 't3.amount', 'dt' => 3),
            array('db' => 't3.date', 'dt' => 4),
            array('db' => 't3.reason', 'dt' => 5),
            array('db' => 't2.last_name', 'dt' => 6)
        );
    }

    function countOfTotalDedFund($wal, $wallet_type) {
        return $this->db->select('id')
                        ->from('wallet_transfer')
                        ->where('wallet_type', $wal)
                        ->where('transfer_type', $wallet_type)
                        ->count_all_results();
    }

    function getTotalFilteredDedFund($table1, $table2, $table3, $where, $type, $wallet_type) {
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        }

        $query = $this->db->query("select t3.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.from_user " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataTotalDedFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type) {
        $data = array();
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        }
        $query = $this->db->query("select t3.id,t1.user_name,t2.first_name,t3.amount,t3.reason,t3.date,t2.last_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.from_user " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnTransfer() {
        return array(
            array('db' => 't3.id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't3.to_user', 'dt' => 2),
            array('db' => 't3.amount', 'dt' => 3),
            array('db' => 't3.reason', 'dt' => 4),
            array('db' => 't3.date', 'dt' => 5),
        );
    }

    function countOfTotalTransfer($wallet_type, $wal) {
        return $this->db->select('id')
                        ->from('wallet_transfer')
                        ->where('wallet_type', $wal)
                        ->where('transfer_type', $wallet_type)
                        ->count_all_results();
    }

    function getTotalFilteredTransfer($table1, $table2, $table3, $where, $wallet_type, $type) {
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        }

        $query = $this->db->query("select t3.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.from_user " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataTotalTransfer($table1, $table2, $table3, $where, $order, $limit, $wallet_type, $type) {
        $data = array();
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' ";
        }
        $query = $this->db->query("select t3.id,t1.user_name,t3.to_user,t3.amount,t3.reason,t3.date from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.from_user " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnAdminPayout() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'transation_id', 'dt' => 1),
            array('db' => 'mlm_user_id', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'transation_charges', 'dt' => 4),
            array('db' => 'tax1', 'dt' => 5),
            array('db' => 'amount1', 'dt' => 6),
            array('db' => 'payout_status', 'dt' => 7),
            array('db' => 'payout_details', 'dt' => 8)
        );
    }

    function countAdminPayout($payout_status) {
        return $this->db->select('mlm_user_id')
                        ->from('wallet_details')
                        ->where("amount1 >", 0)
                        ->where("wallet_type", $payout_status)
                        ->count_all_results();
    }

    function getTotalFilteredAdminPayout($table, $where, $payout_status) {
        if ($where) {
            $where = $where . ' AND amount1 > 0 AND ';
        } else {
            $where = ' WHERE amount1 > 0 AND ';
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "  wallet_type ='" . $payout_status . "'");


        return $query->num_rows();
    }

    function getResultDataAdminPayout($table, $column, $where, $order, $limit, $payout_status) {
        $data = array();
        if ($where) {
            $where = $where . " AND wallet_type='" . $payout_status . "' AND amount1 > 0 ";
        } else {
            $where = " WHERE wallet_type='" . $payout_status . "' AND amount1 > 0 ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnUserAddFund() {
        return array(
            array('db' => 't3.id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't3.amount', 'dt' => 2),
            array('db' => 't3.date', 'dt' => 3),
            array('db' => 't3.reason', 'dt' => 4)
        );
    }

    function countOfTotalUserAddFund($wal, $wallet_type) {
        $logged_user = $this->aauth->getId();
        return $this->db->select('id')
                        ->from('wallet_transfer')
                        ->where('from_user', $logged_user)
                        ->where('wallet_type', $wal)
                        ->where('transfer_type', $wallet_type)
                        ->count_all_results();
    }

    function getTotalFilteredUserAddFund($table1, $table2, $table3, $where, $type, $wallet_type) {
        $logged_user = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' AND t3.from_user=$logged_user";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' AND t3.from_user= $logged_user ";
        }

        $query = $this->db->query("select t3.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.to_user " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataTotalUserAddFund($table1, $table2, $table3, $where, $order, $limit, $type, $wallet_type) {
        $data = array();
        $logged_user = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' AND t3.from_user=$logged_user";
        } else {
            $where = " WHERE  t3.wallet_type = '$type' AND t3.transfer_type = '$wallet_type' AND t3.from_user= $logged_user ";
        }
        $query = $this->db->query("select t3.id,t1.user_name,t3.amount,t3.reason,t3.date from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.to_user " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

}
