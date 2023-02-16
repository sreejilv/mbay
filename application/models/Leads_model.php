<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 * For leads related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    leads
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Leads_model extends CI_Model {

    /**
     * for getting count of leads
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfLeadList() {
        return $this->db->select('id')
                        ->from("leads")
                        ->count_all_results();
    }

    /**
     * for setting datatable headings for leads
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnLeadList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'lead_user', 'dt' => 1),
            array('db' => 'first_name', 'dt' => 2),
            array('db' => 'last_name', 'dt' => 3),
            array('db' => 'email', 'dt' => 4),
            array('db' => 'phone', 'dt' => 5),
            array('db' => 'country', 'dt' => 6),
            array('db' => 'comment', 'dt' => 7),
            array('db' => 'date', 'dt' => 8),
        );
    }

    /**
     * for getting filtered lead count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredLeadList($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting lead details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataLeadList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting user lead count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countOfLeadListUser($user_id) {
        return $this->db->select('id')
                        ->where("lead_user", $user_id)
                        ->from("leads")
                        ->count_all_results();
    }

    /**
     * for setting headings for user leads
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnLeadListUser() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'first_name', 'dt' => 1),
            array('db' => 'last_name', 'dt' => 2),
            array('db' => 'email', 'dt' => 3),
            array('db' => 'phone', 'dt' => 4),
            array('db' => 'country', 'dt' => 5),
            array('db' => 'comment', 'dt' => 6),
            array('db' => 'date', 'dt' => 7),
        );
    }

    /**
     * for getting filtered count of user leads
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredLeadListUser($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND lead_user=$user_id ";
        } else {
            $where = " WHERE lead_user=$user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting user lead details 
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
    function getResultDataLeadListUser($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND lead_user=$user_id ";
        } else {
            $where = " WHERE lead_user=$user_id ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

}
