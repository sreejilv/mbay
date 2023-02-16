<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For 
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Testimonial_model extends CI_Model {

    /**
     * For insert testimonial data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $post_arr
     * @param type $user_id
     * @return type
     */
    function insertTestinomials($post_arr, $user_id) {
        $result = $this->db->set('title', $post_arr['title'])
                ->set('content', $post_arr['content'])
                ->set('created_by', $user_id)
                ->set('created_date', date('Y-m-d'))
                ->set('created_by', $user_id)
                ->set('status', 0)
                ->insert('testimonial');

        if ($this->db->affected_rows() > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For get all testimonials
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllTestimonial() {
        $result = $this->db->select('id,title,content,status,created_by,created_date')
                ->from('testimonial')
                ->get();
        $i = 0;
        $data = [];
        foreach ($result->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['title'] = $row['title'];
            $data[$i]['content'] = strip_tags($row['content']);
            $data[$i]['date'] = $row['created_date'];
            if ($row['status'] == 0) {
                $status = 'inactive';
            } else if ($row['status'] == 1) {
                $status = 'active';
            } else if ($row['status'] == 2) {
                $status = 'delete';
            }
            $data[$i]['status'] = $status;
            $data[$i]['created_by'] = $this->helper_model->IdToUserName($row['created_by']);
            $i++;
        }
        return $data;
    }

    /**
     * For update the testimonial status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @param type $id
     * @return type
     */
    function updateTestimonialStatus($status, $id) {
        if ($status == 'activate') {
            $result = $this->db->set('status', 1)
                    ->where('id', $id)
                    ->update('testimonial');
        } else if ($status == 'delete') {
            $result = $this->db->set('status', 2)
                    ->where('id', $id)
                    ->update('testimonial');
        } else if ($status == 'inactive') {
            $result = $this->db->set('status', 0)
                    ->where('id', $id)
                    ->update('testimonial');
        }
        return $result;
    }

    /**
     * For getting all added testimonials
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getAllAddedTestmonials($user_id) {
        $result = $this->db->select('id,title,content,status,created_by,created_date')
                ->from('testimonial')
                ->where('created_by', $user_id)
                ->get();
        $i = 0;
        $data = [];
        foreach ($result->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['title'] = $row['title'];
            $data[$i]['content'] = strip_tags($row['content']);
            $data[$i]['date'] = $row['created_date'];
            if ($row['status'] == 0) {
                $status = 'inactive';
            } else if ($row['status'] == 1) {
                $status = 'active';
            } else if ($row['status'] == 2) {
                $status = 'delete';
            }
            $data[$i]['status'] = $status;
            $data[$i]['created_by'] = $this->helper_model->IdToUserName($row['created_by']);
            $i++;
        }
        return $data;
    }

    /**
     * For get table column names
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnTestmonial() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'content', 'dt' => 2),
            array('db' => 'user_name', 'dt' => 3),
            array('db' => 't2.status', 'dt' => 4),
            array('db' => 'rating', 'dt' => 5)
        );
    }

    /**
     * For count of testimonials
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfTestmonial() {
        return $this->db->select('id')
                        ->from('testimonial')
                        ->count_all_results();
    }

    /**
     * For get fetching details to show in table
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredTestmonial($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }

        $query = $this->db->query("select t2.id,t2.title,t2.content,t1.user_name,t2.status,t2.rating from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.created_by ");

        return $query->num_rows();
    }

    /**
     * For get total data 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataTestmonial($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t2.id,t2.title,t2.content,t1.user_name,t2.status,t2.rating from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.created_by " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of testimonials
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countOfTestimonialList($user_id) {
        return $this->db->select('id')
                        ->from("testimonial")
                        ->where("created_by", $user_id)
                        ->count_all_results();
    }

    /**
     * For testimonials table column name list
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnTestimonialList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'content', 'dt' => 2),
            array('db' => 'status', 'dt' => 3)
        );
    }

    /**
     * For total filtered testimonials sql query 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredTestimonialList($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND created_by=$user_id ";
        } else {
            $where = " WHERE created_by=$user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For fetching the result details data testimonials
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
    function getResultDataTestimonialList($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND created_by=$user_id ";
        } else {
            $where = " WHERE created_by=$user_id ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

}
