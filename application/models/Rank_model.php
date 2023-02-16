<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For Rank Related function
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Rank_model extends CI_Model {

    /**
     * For get all Ranks details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllRanks() {
        $data = array();
        $query = $this->db->select('id,rank_name,referal_count,total_sales,status')
                ->from('rank')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['slno'] = $i + 1;
            $data[$i]['id'] = $row['id'];
            $data[$i]['rank_name'] = $row['rank_name'];
            $data[$i]['referal_count'] = $row['referal_count'];
            $data[$i]['total_sales'] = $row['total_sales'];
            $data[$i]['status'] = $row['status'];
            $i++;
        }
        return $data;
    }

    /**
     * For change the rank status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $rank_id
     * @param type $status
     * @return type
     */
    function changeRankStatus($rank_id, $status) {
        $this->db->set('status ', "$status")
                ->where('id ', $rank_id)
                ->update('rank');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For delete Rank
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $rank_id
     * @return type
     */
    function deleteRank($rank_id) {
        $this->db->where('id ', $rank_id)
                ->delete('rank');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For add new Rank
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return type
     */
    function addNewRank($data) {
        $this->db->set('rank_name', $data['rank_name'])
                ->set('referal_count', $data['referal_count'])
                ->set('total_sales', $data['total_sales'])
                ->insert('rank');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get Rank Details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $rank_id
     * @return type
     */
    function getRankDetails($rank_id) {
        $data = array();
        $query = $this->db->select('id,rank_name,referal_count,total_sales')
                ->from('rank')
                ->where('id', $rank_id)
                ->limit(1)
                ->get();
        foreach ($query->result_array() as $row) {
            $data['id'] = $row['id'];
            $data['rank_name'] = $row['rank_name'];
            $data['referal_count'] = $row['referal_count'];
            $data['total_sales'] = $row['total_sales'];
        }
        return $data;
    }

    /**
     * For update Rank
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $rank_id
     * @param type $data
     * @return type
     */
    function updateRank($rank_id, $data) {
        $this->db->set('rank_name', $data['rank_name'])
                ->set('referal_count', $data['referal_count'])
                ->set('total_sales', $data['total_sales'])
                ->where('id ', $rank_id)
                ->update('rank');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For Check Rank Name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $rank_name
     * @param type $edit_id
     * @return type
     */
    function checkRankName($rank_name, $edit_id = 0) {
        return $this->db->select('id')
                        ->from("rank")
                        ->where('rank_name', $rank_name)
                        ->where('id !=', $edit_id)
                        ->count_all_results();
    }

    /**
     * For Count of Rank List
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfRankList() {
        return $this->db->select('id')
                        ->from("register_fields")
                        ->where("status !=", 'deleted')
                        ->count_all_results();
    }

    /**
     * For Rank table details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnRankList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'rank_name', 'dt' => 1),
            array('db' => 'referal_count', 'dt' => 2),
            array('db' => 'total_sales', 'dt' => 3),
            array('db' => 'status', 'dt' => 4),
            array('db' => 'rank_bonus', 'dt' => 5)
        );
    }

    /**
     * For sql statement for rank 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredRankList($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For sql statement for rank result details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataRankList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    
    /**
     *  For getting count of product Ordered
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return count
     */
    function checkRankAchieved($rank_id) {
        return $this->db->select('mlm_user_id')
                        ->from("user")
                        ->where('user_rank_id', $rank_id)
                        ->count_all_results();
    }

}
