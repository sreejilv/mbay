<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * For gift related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    gift
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */

class Gift_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * for getting all gift request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getAllGiftRequests($user_id = '') {
        $this->db->select('id,mlm_user_id,gift_amount,date,confirm_status,paid_status,paid_user,status,paid_date');
        $this->db->from('gift_requests');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $details = $this->db->get();
        $data = array();
        $data['active'] = $data['inactive'] = $data['pending'] = $data['completed'] = array();
        $i = 0;
        foreach ($details->result_array() as $row) {
            if ($row['paid_status']) {
                $val = 'completed';
            } elseif ($row['confirm_status']) {
                if ($row['status']) {
                    $val = 'active';
                } else {
                    $val = 'inactive';
                }
            } else {
                $val = 'pending';
            }
            $data[$val][$i]['id'] = $row['id'];
            $data[$val][$i]['username'] = $this->helper_model->IdToUserName($row['mlm_user_id']);
            $data[$val][$i]['user_id'] = $row['mlm_user_id'];
            $data[$val][$i]['paid_username'] = $this->helper_model->IdToUserName($row['paid_user']);
            $data[$val][$i]['paid_user'] = $row['paid_user'];
            $data[$val][$i]['paid_date'] = $row['paid_date'];
            $data[$val][$i]['gift_amount'] = $row['gift_amount'];
            $data[$val][$i]['date'] = $row['date'];
            $data[$val][$i]['gift_send'] = $this->getTotalGiftAmount($row['mlm_user_id'], 'send');
            $data[$val][$i]['gift_recieved'] = $this->getTotalGiftAmount($row['mlm_user_id'], 'recieved');

            $i++;
        }
        return $data;
    }

    /**
     * for getting total gifted amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalGiftAmount($user_id, $type) {
        $amt = 0;
        $this->db->select_sum('gift_amount');
        $this->db->from('gift_requests');
        $this->db->where('paid_status', 1);
        if ($type == 'send') {
            $this->db->where('paid_user', $user_id);
        } else {
            $this->db->where('mlm_user_id', $user_id);
        }
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            if ($row->gift_amount > 0)
                $amt = $row->gift_amount;
        }
        return $amt;
    }

    /**
     * for creating a gift
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function createGift($user_id, $amount, $status = 0) {
        $this->db->set('mlm_user_id', $user_id)
                ->set('gift_amount', $amount)
                ->set('date', date('Y-m-d'))
                ->set('confirm_status', $status)
                ->set('status', $status)
                ->insert('gift_requests');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for activating gift request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function activateGiftRequest($req_id, $status) {
        if ($status) {
            $this->db->set('confirm_status', $status);
        }
        $this->db->set('status', $status);
        $this->db->where('id', $req_id);
        $this->db->update('gift_requests');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for deleting gift request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function deleteGiftRequest($req_id) {
        $this->db->where('id', $req_id)
                ->delete('gift_requests');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for validating request id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function validateRequestId($req_id, $user_id) {
        $this->db->select('id');
        $this->db->from("gift_requests");
        $this->db->where('id', $req_id);
        $this->db->where('mlm_user_id !=', $user_id);
        $this->db->where('paid_status', 0);
        $this->db->where('confirm_status', 1);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /**
     * for getting request details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getRequestDetails($req_id) {
        $details = $this->db->select('mlm_user_id,gift_amount')
                ->from('gift_requests')
                ->where('id', $req_id)
                ->get();
        $data = array();
        foreach ($details->result_array() as $row) {
            $data['username'] = $this->helper_model->IdToUserName($row['mlm_user_id']);
            $data['gift_amount'] = $row['gift_amount'];
            $data['mlm_user_id'] = $row['mlm_user_id'];
        }
        return $data;
    }

    /**
     * for updating help request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateHelpRequest($req_id, $paid_user) {
        $this->db->set('paid_status', 1)
                ->set('paid_user', $paid_user)
                ->set('paid_date', date("Y-m-d H:i:s"))
                ->where('id', $req_id)
                ->update('gift_requests');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating gift settings
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateGiftSettings($data) {
        $currency_ratio = 1;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
        }
        $this->dbvars->GIFT_AMOUNT_SETTINGS = $data['gift_amount'];
        $this->dbvars->GIFT_AMOUNT = $data['amount'] / $currency_ratio;
        return 1;
    }

    /**
     * for getting gift details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getGiftDetails($user_id, $date1 = '', $date2 = '') {
        $data = array();
        $this->db->select("id,mlm_user_id,gift_amount,date,paid_user,paid_date");
        $this->db->from("gift_requests");
        $this->db->group_start();
        $this->db->where("mlm_user_id", $user_id);
        $this->db->or_where('paid_user', $user_id);
        $this->db->group_end();
        if ($date1 && $date2) {
            $this->db->group_start();
            $this->db->where('paid_date >=', $date1 . ' 00:00:00');
            $this->db->where('paid_date <=', $date2 . ' 23:59:59');
            $this->db->group_end();
        }$this->db->where('paid_status', 1);
        $res = $this->db->get();
        $i = 0;

        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['req_user_id'] = $row->mlm_user_id;
            $data[$i]['req_user'] = $this->helper_model->IdToUserName($row->mlm_user_id);
            $data[$i]['gift_amount'] = $row->gift_amount;
            $data[$i]['req_date'] = $row->date;
            $data[$i]['paid_user_id'] = $row->paid_user;
            $data[$i]['paid_user'] = $this->helper_model->IdToUserName($row->paid_user);
            $data[$i]['paid_date'] = $row->paid_date;
            $i++;
        }
        return $data;
    }

    /**
     * for validating user request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function validateUserRequest($req_id, $logged_user) {
        $this->db->select('id');
        $this->db->from("gift_requests");
        $this->db->where('id', $req_id);
        $this->db->where('mlm_user_id', $logged_user);
        $this->db->where('paid_status', 0);
        return $this->db->count_all_results();
    }

    /**
     * for getting other gift details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getOtherGiftRequests($user_id) {
        $this->db->select('id,mlm_user_id,gift_amount,date,confirm_status,paid_status,paid_user,status,paid_date');
        $this->db->from('gift_requests');
        $this->db->where('mlm_user_id !=', $user_id);
        $this->db->where('paid_status', 0);
        $this->db->where('confirm_status', 1);
        $this->db->where('status', 1);
        $details = $this->db->get();
        $data = array();
        $i = 0;
        foreach ($details->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['username'] = $this->helper_model->IdToUserName($row['mlm_user_id']);
            $data[$i]['user_id'] = $row['mlm_user_id'];
            $data[$i]['paid_username'] = $this->helper_model->IdToUserName($row['paid_user']);
            $data[$i]['paid_user'] = $row['paid_user'];
            $data[$i]['paid_date'] = $row['paid_date'];
            $data[$i]['gift_amount'] = $row['gift_amount'];
            $data[$i]['date'] = $row['date'];
            $data[$i]['gift_send'] = $this->getTotalGiftAmount($row['mlm_user_id'], 'send');
            $data[$i]['gift_recieved'] = $this->getTotalGiftAmount($row['mlm_user_id'], 'recieved');

            $i++;
        }
        return $data;
    }

    /**
     * for getting user gift status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getUserGiftStatus($logged_user) {
        $this->db->select('id');
        $this->db->from("gift_requests");
        $this->db->where('paid_user', $logged_user);
        $this->db->where('paid_status', 1);
        return $this->db->count_all_results();
    }

    /**
     * for setting datatable heading for paid gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnGiftHistory() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'gift_amount', 'dt' => 2),
            array('db' => 't2.date', 'dt' => 3),
            array('db' => 'paid_user', 'dt' => 4),
            array('db' => 't2.paid_date', 'dt' => 5)
        );
    }

    /**
     * for getting total count of paid gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfTotalGiftHistorySearch($used_id, $from_date, $to_date) {
        return $this->db->select('mlm_user_id')
                        ->from('gift_requests')
                        ->group_start()
                        ->where('mlm_user_id', $used_id)
                        ->or_where('paid_user', $used_id)
                        ->group_end()
                        ->where('paid_status', 1)
                        ->where('paid_date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->count_all_results();
    }

    /**
     * for getting count of paid gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfTotalGiftHistory($used_id) {
        return $this->db->select('mlm_user_id')
                        ->from('gift_requests')
                        ->group_start()
                        ->where('mlm_user_id', $used_id)
                        ->or_where('paid_user', $used_id)
                        ->group_end()
                        ->where('paid_status', 1)
                        ->where('confirm_status', 1)
                        ->count_all_results();
    }

    /**
     * for getting filtered count of paid gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredTotalGiftHistorySearch($table1, $table2, $where, $user_id, $from_date, $to_date) {
        if ($where) {
            $where = $where . " AND t2.paid_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND paid_status=1 AND confirm_status=1 AND ";
        } else {
            $where = " WHERE  ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND t2.paid_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND AND paid_status=1 AND confirm_status=1 AND ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.paid_user,t2.paid_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting filtered count of gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredTotalGiftHistory($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND paid_status=1 AND confirm_status=1 AND  ";
        } else {
            $where = " WHERE  ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND paid_status=1 AND confirm_status=1 AND ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.paid_user,t2.paid_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting paid gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataTotalGiftHistorySearch($table1, $table2, $where, $order, $limit, $user_id, $from_date, $to_date) {
        $data = array();
        if ($where) {
            $where = $where . " AND t2.paid_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND paid_status=1 AND confirm_status=1 AND ";
        } else {
            $where = " WHERE  ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND t2.paid_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND paid_status=1 AND confirm_status=1 AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.paid_user,t2.paid_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataTotalGiftHistory($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND paid_status=1 AND confirm_status=1 AND ";
        } else {
            $where = " WHERE  ( t2.mlm_user_id = $user_id OR t2.paid_user = $user_id ) AND paid_status=1 AND confirm_status=1 AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.paid_user,t2.paid_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting count of pending gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfPendingGift($user_id = '') {
        $this->db->select('id');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $this->db->where('confirm_status', 0);
        $this->db->from("gift_requests");
        return $this->db->count_all_results();
    }

    /**
     * for setting headings for pending gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnPendingGift() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'gift_amount', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'confirm_status', 'dt' => 4),
            array('db' => 'status', 'dt' => 5),
            array('db' => 'mlm_user_id', 'dt' => 6)
        );
    }

    /**
     * for getting count pending gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredPendingGift($table1, $table2, $where, $user_id = '') {
        if ($user_id) {
            if ($where) {
                $where = $where . " AND confirm_status=0 AND  t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE confirm_status=0 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND confirm_status=0 AND ";
            } else {
                $where = " WHERE confirm_status=0 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting pending gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataPendingGift($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($user_id) {
            if ($where) {
                $where = $where . " AND confirm_status=0 AND  t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE confirm_status=0 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND confirm_status=0 AND ";
            } else {
                $where = " WHERE confirm_status=0 AND ";
            }
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting active gifts count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfActiveGift($user_id = '') {
        $this->db->select('id');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $this->db->where('confirm_status', 1);
        $this->db->where('paid_status', 0);
        $this->db->where('status', 1);
        $this->db->from("gift_requests");
        return $this->db->count_all_results();
    }

    /**
     * for setting active gifts heading
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnActiveGift() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'gift_amount', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'confirm_status', 'dt' => 4),
            array('db' => 'status', 'dt' => 5),
            array('db' => 'mlm_user_id', 'dt' => 6)
        );
    }

    /**
     * for getting filtered active gifts count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredActiveGift($table1, $table2, $where, $user_id = '') {
        if ($user_id) {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=1 AND paid_status=0 AND t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=1 AND paid_status=0 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=1 AND paid_status=0 AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=1 AND paid_status=0 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting active gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataActiveGift($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($user_id) {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=1 AND paid_status=0 AND t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=1 AND paid_status=0 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND paid_status=0 AND status=1 AND ";
            } else {
                $where = " WHERE confirm_status=1 AND paid_status=0 AND status=1 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting count of inactive gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfInActiveGift($user_id = '') {
        $this->db->select('id');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $this->db->where('confirm_status', 1);
        $this->db->where('status', 0);
        $this->db->from("gift_requests");
        return $this->db->count_all_results();
    }

    /**
     * for setting heading of inactive gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnInActiveGift() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'gift_amount', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'confirm_status', 'dt' => 4),
            array('db' => 'status', 'dt' => 5),
            array('db' => 'mlm_user_id', 'dt' => 6)
        );
    }

    /**
     * for getting count of filtered inactive gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredInActiveGift($table1, $table2, $where, $user_id = '') {
        if ($user_id) {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=0 AND  t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=0 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=0 AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=0 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting inactive gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataInActiveGift($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($user_id) {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=0 AND  t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=0 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND confirm_status=1 AND status=0 AND ";
            } else {
                $where = " WHERE confirm_status=1 AND status=0 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting count of completed gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfCompleteGift($user_id = '') {
        $this->db->select('id');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $this->db->where('paid_status', 1);
        $this->db->from("gift_requests");
        return $this->db->count_all_results();
    }

    /**
     * for setting heading for completed gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnCompleteGift() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'gift_amount', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'paid_user', 'dt' => 4),
            array('db' => 'paid_date', 'dt' => 5)
        );
    }

    /**
     * for getting count of filtered completed gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredCompleteGift($table1, $table2, $where, $user_id = '') {
        if ($user_id) {
            if ($where) {
                $where = $where . " AND paid_status=1 AND t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE paid_status=1 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND paid_status=1 AND ";
            } else {
                $where = " WHERE paid_status=1 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.paid_user,t2.paid_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting completed gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataCompleteGift($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($user_id) {
            if ($where) {
                $where = $where . " AND paid_status=1 AND t2.mlm_user_id= $user_id AND ";
            } else {
                $where = " WHERE paid_status=1 AND t2.mlm_user_id= $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND paid_status=1 AND ";
            } else {
                $where = " WHERE paid_status=1 AND ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.paid_user,t2.paid_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting count of help gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfhelpGift($user_id = '') {
        $this->db->select('id');
        $this->db->where('mlm_user_id !=', $user_id);
        $this->db->where('paid_status', 0);
        $this->db->where('confirm_status', 1);
        $this->db->where('status', 1);
        $this->db->from("gift_requests");
        return $this->db->count_all_results();
    }

    /**
     * for setting heading for help gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnhelpGift() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'gift_amount', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'confirm_status', 'dt' => 4),
            array('db' => 'status', 'dt' => 5),
            array('db' => 'mlm_user_id', 'dt' => 6)
        );
    }

    /**
     * for getting filtered count of help gifts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredhelpGift($table1, $table2, $where, $user_id) {

        if ($where) {
            $where = $where . " AND confirm_status=1 AND paid_status=0 AND status=1 AND  t2.mlm_user_id != $user_id AND ";
        } else {
            $where = " WHERE confirm_status=1 AND paid_status=0 AND status=1 AND t2.mlm_user_id != $user_id AND ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * for getting help gifts details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDatahelpGift($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($where) {
            $where = $where . " AND confirm_status=1 AND paid_status=0 AND status=1 AND  t2.mlm_user_id != $user_id AND ";
        } else {
            $where = " WHERE confirm_status=1 AND paid_status=0 AND status=1 AND t2.mlm_user_id != $user_id AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.gift_amount,t2.date,t2.confirm_status,t2.status,t2.mlm_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

}
