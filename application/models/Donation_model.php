<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 * For donation related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    donation
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Donation_model extends CI_Model {

    /**
     * for updating donation settings
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return boolean
     */
    function updateDonationSettings($data) {
        $currency_ratio = 1;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
        }
        $this->dbvars->DONATION_AMOUNT_SETTINGS = $data['donation_amount'];
        $this->dbvars->DONATION_AMOUNT = $data['amount'] / $currency_ratio;
        $this->dbvars->DONATION_ORDER = $data['eligibility_order'];
        $this->dbvars->DONATION_PERCENTAGE = $data['eligibility_percentage'];
        return true;
    }

    /**
     * for donating amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $amount
     * @return type
     */
    function donateAmount($user_id, $amount) {
        $res = 0;
        $data = array();
        $order = $this->dbvars->DONATION_ORDER;
        $max_amount_perc = $this->dbvars->DONATION_PERCENTAGE / 100;

        while ($amount) {
            $flag = 0;
            $user = $this->findEligibleUser($user_id, $order);
            $id = $user['id'];
            $to_user = $user['user_id'];
            $reap_amount = $user['amount'] * $max_amount_perc;
            $credit_amount = $user['credit_amount'];

            $to_amount = $amount;
            if (($reap_amount - $credit_amount) < $amount) {
                $to_amount = $amount - ($credit_amount / $max_amount_perc);
            }

            if (($reap_amount - $credit_amount) <= $amount) {
                $flag = 1;
                $to_amount = ($reap_amount - $credit_amount);
            }
            if ($to_amount > 0) {
                $res = $this->confirmDonation($user_id, $to_user, $to_amount);
                if ($res) {
                    $data[]['user_id'] = $to_user;
                    $data[]['amount'] = $to_amount;
                    $amount -= $to_amount;
                    $this->updateReapStatus($id, $to_amount, $flag);
                }
            }
        }
        if ($res) {
            $data['user_id'] = $to_user;
            return $data;
        }
        return $res;
    }

    /**
     * for finding an eligible user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $order
     * @return int
     */
    function findEligibleUser($user_id, $order = 'fifo') {
        $user = array();
        $this->db->select("id,from_user,amount,reap_amount");
        $this->db->from("donations");
        $this->db->where("reap_status", '0');
        $this->db->where("from_user !=", $user_id);
        if ($order == 'fifo') {
            $this->db->order_by('id', 'ASC');
        } else {
            $this->db->order_by('id', 'RANDOM');
        }
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $user['id'] = $row['id'];
                $user['user_id'] = $row['from_user'];
                $user['amount'] = $row['amount'];
                $user['credit_amount'] = $row['reap_amount'];
            }
        } else {
            $user['id'] = 0;
            $user['user_id'] = $this->helper_model->getAdminId();
            $user['amount'] = 99999999;
            $user['credit_amount'] = 0;
        }

        return $user;
    }

    /**
     * for confirming a donation
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_user
     * @param type $to_user
     * @param type $amount
     * @return type
     */
    function confirmDonation($from_user, $to_user, $amount) {
        $res = $this->db->set('from_user', $from_user)
                ->set('to_user', $to_user)
                ->set('amount', $amount)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('donations');
        if ($res) {
            $this->db->set('donation_send', 'ROUND(donation_send +' . $amount . ',8)', FALSE)
                    ->where('mlm_user_id', $from_user)
                    ->limit(1)
                    ->update('user_balance');
            $this->db->set('donation_recieved', 'ROUND(donation_recieved +' . $amount . ',8)', FALSE)
                    ->where('mlm_user_id', $to_user)
                    ->limit(1)
                    ->update('user_balance');
        }
        return $res;
    }

    /**
     * for updating rap status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $amount
     * @param type $flag
     */
    function updateReapStatus($id, $amount, $flag) {
        $this->db->set('reap_amount', 'ROUND(reap_amount +' . $amount . ',8)', FALSE);
        if ($flag)
            $this->db->set('reap_status', $flag);
        $this->db->where('id', $id);
        $this->db->limit(1);
        $res = $this->db->update('donations');
    }

    /**
     * for getting user donations
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getUserDonations($user_id) {
        $from = $this->helper_model->IdToUserName($user_id);
        $data = array();
        $res = $this->db->select("id,from_user,amount,reap_amount,to_user,date")
                ->from("donations")
                ->where("from_user", $user_id)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['from_user'] = $from;
            $data[$i]['amount'] = $row->amount;
            $data[$i]['date'] = $row->date;
            $data[$i]['reap_amount'] = $row->reap_amount;
            $data[$i]['to_user'] = $this->helper_model->IdToUserName($row->to_user);
            $i++;
        }
        return $data;
    }

    /**
     * for getting donation details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $date1
     * @param type $date2
     * @return type
     */
    function getDonationDetails($user_id, $date1 = '', $date2 = '') {
        $data = array();
        $this->db->select("id,from_user,amount,reap_amount,to_user,date");
        $this->db->from("donations");
        $this->db->group_start();
        $this->db->where("from_user", $user_id);
        $this->db->or_where('to_user', $user_id);
        $this->db->group_end();
        if ($date1 && $date2) {
            $this->db->group_start();
            $this->db->where('date >=', $date1 . ' 00:00:00');
            $this->db->where('date <=', $date2 . ' 23:59:59');
            $this->db->group_end();
        }
        $res = $this->db->get();
        $i = 0;

        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['from_user'] = $this->helper_model->IdToUserName($row->from_user);
            $data[$i]['amount'] = $row->amount;
            $data[$i]['date'] = $row->date;
            $data[$i]['reap_amount'] = $row->reap_amount;
            $data[$i]['to_user'] = $this->helper_model->IdToUserName($row->to_user);
            $i++;
        }
        return $data;
    }

    /**
     * for datatable headng for donation
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnDonationHistory() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'to_user', 'dt' => 2),
            array('db' => 'amount', 'dt' => 3),
            array('db' => 'reap_amount', 'dt' => 4),
            array('db' => 't2.date', 'dt' => 5)
        );
    }

    /**
     * for getting count of total donation send by an user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $used_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countOfTotalDonationHistorySearch($used_id, $from_date, $to_date) {
        return $this->db->select('from_user')
                        ->from('donations')
                        ->where('from_user', $used_id)
                        ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->or_where('to_user', $used_id)
                        ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->count_all_results();
    }

    /**
     * for getting count of total donation history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $used_id
     * @return type
     */
    function countOfTotalDonationHistory($used_id) {
        $today = date("Y-m-d H:i:s");
        return $this->db->select('from_user')
                        ->from('donations')
                        ->where('from_user', $used_id)
                        ->or_where('to_user', $used_id)
                        ->count_all_results();
    }

    /**
     * for getting filtered donation count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalDonationHistorySearch($table1, $table2, $where, $user_id, $from_date, $to_date) {
        if ($where) {
            $where = $where . " AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND ";
        } else {
            $where = " WHERE  ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.to_user,t2.amount,t2.reap_amount,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.from_user ");
        return $query->num_rows();
    }

    /**
     * for getting donation history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredTotalDonationHistory($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND ";
        } else {
            $where = " WHERE  ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND ";
        }

        $query = $this->db->query("select t2.id,t1.user_name,t2.to_user,t2.amount,t2.reap_amount,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.from_user ");
        return $query->num_rows();
    }

    /**
     * for getting total donation history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataTotalDonationHistorySearch($table1, $table2, $where, $order, $limit, $user_id, $from_date, $to_date) {
        $data = array();
        if ($where) {
            $where = $where . " AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND ";
        } else {
            $where = " WHERE  ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.to_user,t2.amount,t2.reap_amount,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.from_user " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting donation history
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
    function getResultDataTotalDonationHistory($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND ";
        } else {
            $where = " WHERE  ( t2.to_user = $user_id OR t2.from_user = $user_id ) AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.to_user,t2.amount,t2.reap_amount,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.from_user " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting total data limit
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $request
     * @return string
     */
    function getTotalDataLimit($request) {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }
        return $limit;
    }

}
