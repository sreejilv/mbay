<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 * For affiliates related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    affiliates
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Affiliates_model extends CI_Model {

    /**
     * For getting the count of affiliates list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfAffiliatesList() {
        return $this->db->select('id')
                        ->from('affiliates')
                        ->count_all_results();
    }

    /**
     * For getting the table column affiliates 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'username', 'dt' => 1),
            array('db' => 'user_name', 'dt' => 2),
            array('db' => 't1.email', 'dt' => 3),
            array('db' => 't1.mobile', 'dt' => 4),
            array('db' => 'enroll_date', 'dt' => 5),
            array('db' => 't1.status', 'dt' => 6)
        );
    }

    /**
     * For total filtered affiliates list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredAffiliatesList($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t1.username,t2.user_name,t1.email,t1.mobile,t1.enroll_date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.sponser_id = t2.mlm_user_id");
        return $query->num_rows();
    }

    /**
     * For getting the affiliates List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataAffiliatesList($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t1.username,t2.user_name,t1.email,t1.mobile,t1.enroll_date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.sponser_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of affiliates added users
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $user_id
     * @return type
     */
    function countOfAffiliatesUserList($user_id) {
        return $this->db->select('id')
                        ->where("sponser_id", $user_id)
                        ->from("affiliates")
                        ->count_all_results();
    }

    /**
     * For getting the affiliates users list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesUserList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'username', 'dt' => 1),
            array('db' => 'email', 'dt' => 2),
            array('db' => 'mobile', 'dt' => 3),
            array('db' => 'enroll_date', 'dt' => 4),
            array('db' => 'status', 'dt' => 5)
        );
    }

    /**
     * For getting the affiliates users list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredAffiliatesUserList($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND sponser_id=$user_id ";
        } else {
            $where = " WHERE sponser_id=$user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For fetch the Jquery table related datas
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
    function getResultDataAffiliatesUserList($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND sponser_id=$user_id ";
        } else {
            $where = " WHERE sponser_id=$user_id ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For delete the affiliates 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function deleteAffiliate($id) {
        $this->db->where('id', $id)
                ->delete('affiliates');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For updates the affiliates status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $id
     * @param type $status
     * @return type
     */
    public function updateAffiliateStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('affiliates');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the affiliates List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function gettingAffiliatesDetails($id) {
        $query = $this->db->select('id,email,mobile,first_name,last_name,country,state')
                ->from('affiliates')
                ->where('id', $id)
                ->get();
        $data = [];
        foreach ($query->result_array() as $row) {
            $data['id'] = $row['id'];
            $data['email'] = $row['email'];
            $data['mobile'] = $row['mobile'];
            $data['first_name'] = $row['first_name'];
            $data['last_name'] = $row['last_name'];
            $data['country'] = $row['country'];
            $data['state'] = $row['state'];
        }
        return $data;
    }

    /**
     * For update the affiliates details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $post_arr
     * @return type
     */
    function updateAffiliatesDetails($post_arr) {
        $this->db->set('email', $post_arr['email'])
                ->set('mobile', $post_arr['mobile'])
                ->set('first_name', $post_arr['first_name'])
                ->set('last_name', $post_arr['last_name'])
                ->set('country', $post_arr['country'])
                ->set('state', $post_arr['state'])
                ->where('id', $post_arr['id'])
                ->update('affiliates');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the country code
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $id
     * @return type
     */
    public function getcountryCode($id) {
        $country = NULL;
        $query = $this->db->select('country')
                ->where('id', $id)
                ->limit(1)
                ->get('affiliates');
        if ($query->num_rows() > 0) {
            $country = $query->row()->country;
        }
        return $country;
    }

    /**
     * For course management table list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnCourseManagementList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'course_name', 'dt' => 1),
            array('db' => '`order`', 'dt' => 2),
            array('db' => 'added_date', 'dt' => 3),
            array('db' => 'enquiry_count', 'dt' => 4),
            array('db' => 'status', 'dt' => 5)
        );
    }

    /**
     * For getting the Filtered Course Management List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredCourseManagementList($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For Result Data Course Management
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataCourseManagementList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For Count Course Management
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfCourseManagementList() {
        return $this->db->select('id')
                        ->from("affiliate_courses")
                        ->count_all_results();
    }

    /**
     * For count affiliates enquiry List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function countOfAffiliatesEnquiryList($user_id) {
        return $this->db->select('id')
                        ->where('sponser_id', $user_id)
                        ->where('enq_status', 0)
                        ->from('affiliates')
                        ->join('affiliate_enquiry', 'affiliates.id = affiliate_enquiry.affiliate_id', 'inner')
                        ->count_all_results();
    }

    /**
     * For getting the Table column name for affiliate enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesEnquiryList() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 'enquiry_id', 'dt' => 1),
            array('db' => 'username', 'dt' => 2),
            array('db' => 'course', 'dt' => 3),
            array('db' => 'sub_course', 'dt' => 4),
            array('db' => 't1.first_name', 'dt' => 5),
            array('db' => 'enq_close_status', 'dt' => 6),
            array('db' => 'enq_status', 'dt' => 7),
            array('db' => 't1.email', 'dt' => 8),
            array('db' => 'phone', 'dt' => 9),
            array('db' => 't1.last_name', 'dt' => 10)
        );
    }

    /**
     * For getting the total filtered affiliates Enquiry List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredAffiliatesEnquiryList($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND sponser_id = $user_id AND enq_status=0 AND ";
        } else {
            $where = " WHERE sponser_id = $user_id AND enq_status=0 AND ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.affiliate_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For getting the data for affiliates enquiry list
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
    function getResultDataAffiliatesEnquiryList($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND sponser_id = $user_id AND enq_status=0 AND ";
        } else {
            $where = " WHERE sponser_id = $user_id AND enq_status=0 AND ";
        }
        $query = $this->db->query("select t1.id,t1.enquiry_id,t2.username,t1.course,t1.sub_course,t1.first_name,t1.enq_close_status,t1.enq_status,t1.email,t1.phone,t1.last_name from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.affiliate_id = t2.id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For course creation
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    function createCourse($data) {
        $this->db->set('course_name', $data['course_name'])
                ->set('order', $data['course_order'])
                ->set('added_date', date("Y-m-d H:i:s"))
                ->set('enquiry_count', 0)
                ->set('status', 1)
                ->insert('affiliate_courses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update course details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    function updateCourse($data) {
        $this->db->set('course_name', $data['course_name'])
                ->set('order', $data['course_order'])
                ->where('id', $data['course_id'])
                ->update('affiliate_courses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For validate course Name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $name
     * @param type $id
     * @return type
     */
    function validateCourseName($name, $id = 0) {
        return $this->db->select('id')
                        ->from("affiliate_courses")
                        ->where('course_name', $name)
                        ->where('id !=', $id)
                        ->count_all_results();
    }

    /**
     * For change course status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $course_id
     * @param type $status
     * @return type
     */
    function changeCourseStatus($course_id, $status = '1') {
        $this->db->set('status', $status)
                ->where('id', $course_id)
                ->update('affiliate_courses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For gettings course details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function getCourseDetails($id) {
        $query = $this->db->select('course_name,order')
                ->from('affiliate_courses')
                ->where('id', $id)
                ->get();
        $data = array();
        foreach ($query->result_array() as $row) {
            $data['course_name'] = $row['course_name'];
            $data['order'] = $row['order'];
        }
        return $data;
    }

    /**
     * For getting the user coupon balanace
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    public function getUserCouponBalance($user_id) {
        $coupon_balance = 0;
        $query = $this->db->select('coupon_balance')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_balance');
        if ($query->num_rows() > 0) {
            $coupon_balance = $query->row()->coupon_balance;
        }
        return $coupon_balance;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $amount
     * @return type
     */
    function createCoupon($user_id, $amount) {
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
            $amount = $amount / $currency_ratio;
        }
        if ($amount > 0) {
            $res = $this->db->set('mlm_user_id', $user_id)
                    ->set('coupon_code', $this->genrateCouponCode())
                    ->set('coupon_amount', $amount)
                    ->set('date', date("Y-m-d H:i:s"))
                    ->set('status', 1)
                    ->insert('affiliate_coupons');
            if ($res) {
                $this->db->set('coupon_balance', 'ROUND(coupon_balance -' . $amount . ',8)', FALSE)
                        ->where('mlm_user_id', $user_id)
                        ->limit(1)
                        ->update('user_balance');

                if ($this->db->affected_rows() > 0) {
                    return true;
                }
                return false;
            }
        }
    }

    /**
     * For generate the coupon code
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return string
     */
    function genrateCouponCode() {
        $this->load->helper('string');
        $code = '';
        $flag = 1;
        while ($flag) {
            $code = 'CPN-' . random_string('alpha', 5);
            if (!$this->checkCouponCode($code)) {
                $flag = 0;
            }
        }
        return $code;
    }

    /**
     * For check coupon code is valid/exists or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $code
     * @return type
     */
    public function checkCouponCode($code) {
        return $this->db->select("id")
                        ->from("affiliate_coupons")
                        ->where('coupon_code', $code)
                        ->count_all_results();
    }

    /**
     * For count of coupon list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfAffiliatesCouponsList() {
        return $this->db->select('id')
                        ->from('affiliate_coupons')
                        ->count_all_results();
    }

    /**
     * For getting the coupon column names
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesCouponsList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'coupon_code', 'dt' => 1),
            array('db' => 'user_name', 'dt' => 2),
            array('db' => 'coupon_amount', 'dt' => 3),
            array('db' => 't1.date', 'dt' => 4),
            array('db' => 'status', 'dt' => 5)
        );
    }

    /**
     * For getting the coupon list count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredAffiliatesCouponsList($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t1.coupon_code,t2.user_name,t1.coupon_amount,t1.date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id");
        return $query->num_rows();
    }

    /**
     * For fetching the coupon list based on the column names
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataAffiliatesCouponsList($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t1.coupon_code,t2.user_name,t1.coupon_amount,t1.date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the affiliates created users coupon count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function countOfAffiliatesCouponsListUser($user_id) {
        return $this->db->select('id')
                        ->from('affiliate_coupons')
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For affiliates users table column coupon list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type 
     */
    function getTableColumnAffiliatesCouponsListUser() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'coupon_code', 'dt' => 1),
            array('db' => 'coupon_amount', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'status', 'dt' => 4)
        );
    }

    /**
     * For getting the total filtered affiliates coupon list users 
     * @param type $table
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredAffiliatesCouponsListUser($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND mlm_user_id= $user_id  ";
        } else {
            $where = " WHERE mlm_user_id= $user_id ";
        }
        $query = $this->db->query("select id,coupon_code,coupon_amount,date,status from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the affiliates coupon list result
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @return type
     */
    function getResultDataAffiliatesCouponsListUser($table, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND mlm_user_id= $user_id ";
        } else {
            $where = " WHERE mlm_user_id= $user_id ";
        }
        $query = $this->db->query("select id,coupon_code,coupon_amount,date,status from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For get the course name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @date 2018-02-10
     * @param type $id
     * @return type
     */
    function getCourseIdToName($id) {
        $qry = $this->db->select('course_name')
                ->from('affiliate_courses')
                ->where('id', $id)
                ->get();

        if ($this->db->num_rows() > 0) {
            return $qry->row()->course_name;
        }
        return false;
    }

    /**
     * For get count affiliates active 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function countOfAffiliatesEnquiryActiveList($user_id) {
        return $this->db->select('id')
                        ->where('sponser_id', $user_id)
                        ->where('enq_status', 1)
                        ->where('enq_close_status', 0)
                        ->from('affiliates')
                        ->join('affiliate_enquiry', 'affiliates.id = affiliate_enquiry.affiliate_id', 'inner')
                        ->count_all_results();
    }

    /**
     * For get table column affiliates enquiry active table column name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesEnquiryActiveList() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 'enquiry_id', 'dt' => 1),
            array('db' => 'username', 'dt' => 2),
            array('db' => 'course', 'dt' => 3),
            array('db' => 'sub_course', 'dt' => 4),
            array('db' => 't1.first_name', 'dt' => 5),
            array('db' => 'coupon_code', 'dt' => 6),
            array('db' => 'coupon_amount', 'dt' => 7),
            array('db' => 'email', 'dt' => 8),
            array('db' => 'phone', 'dt' => 9),
            array('db' => 't1.last_name', 'dt' => 10)
        );
    }

    /**
     * For total filtered affiliates enquiry active list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredAffiliatesEnquiryActiveList($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND sponser_id = $user_id AND enq_status=1 AND enq_close_status=0 AND ";
        } else {
            $where = " WHERE sponser_id = $user_id AND enq_status=1 AND enq_close_status=0 AND ";
        }
        $query = $this->db->query(" select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.affiliate_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For getting the Enquiry details 
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @return type
     */
    function getResultDataAffiliatesEnquiryActiveList($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND sponser_id = $user_id AND enq_status=1 AND enq_close_status=0 AND ";
        } else {
            $where = " WHERE sponser_id = $user_id AND enq_status=1 AND enq_close_status=0 AND ";
        }
        $query = $this->db->query("select t1.id,t1.enquiry_id,t2.username,t1.course,t1.sub_course,t1.first_name,t1.coupon_code,t1.coupon_amount,t1.email,t1.phone,t1.last_name from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.affiliate_id = t2.id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of confirmed enquiry form
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function countOfAffiliatesEnquiryConfirmList($user_id) {
        return $this->db->select('id')
                        ->where('sponser_id', $user_id)
                        ->where('enq_status', 1)
                        ->where('enq_close_status', 1)
                        ->from('affiliates')
                        ->join('affiliate_enquiry', 'affiliates.id = affiliate_enquiry.affiliate_id', 'inner')
                        ->count_all_results();
    }

    /**
     * 
     * @return typeFor getting the confirmed column names
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesEnquiryConfirmList() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 'enquiry_id', 'dt' => 1),
            array('db' => 'username', 'dt' => 2),
            array('db' => 'course', 'dt' => 3),
            array('db' => 'sub_course', 'dt' => 4),
            array('db' => 't1.first_name', 'dt' => 5),
            array('db' => 'applied_coupon', 'dt' => 6),
            array('db' => 'email', 'dt' => 7),
            array('db' => 'phone', 'dt' => 8),
            array('db' => 't1.last_name', 'dt' => 9)
        );
    }

    /**
     * For filtered confirmed details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredAffiliatesEnquiryConfirmList($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND sponser_id = $user_id AND enq_status=1 AND enq_close_status=1 AND ";
        } else {
            $where = " WHERE sponser_id = $user_id AND enq_status=1 AND enq_close_status=1 AND ";
        }
        $query = $this->db->query(" select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.affiliate_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For getting the actual confirmed enquiry details
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
    function getResultDataAffiliatesEnquiryConfirmList($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND sponser_id = $user_id AND enq_status=1 AND enq_close_status=1 AND ";
        } else {
            $where = " WHERE sponser_id = $user_id AND enq_status=1 AND enq_close_status=1 AND ";
        }
        $query = $this->db->query("select t1.id,t1.enquiry_id,t2.username,t1.course,t1.sub_course,t1.first_name,t1.applied_coupon,t1.email,t1.phone,t1.last_name from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.affiliate_id = t2.id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of confirmed enquiry list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfAffiliatesEnquiryConfirmAdminList() {
        return $this->db->select('id')
                        ->where('enq_status', 1)
                        ->where('enq_close_status', 1)
                        ->from('affiliate_enquiry')
                        ->count_all_results();
    }

    /**
     * For getting the confirmed enquiry column names
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesEnquiryConfirmAdminList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'enquiry_id', 'dt' => 1),
            array('db' => 'affiliate_id', 'dt' => 2),
            array('db' => 'course', 'dt' => 3),
            array('db' => 'sub_course', 'dt' => 4),
            array('db' => 'first_name', 'dt' => 5),
            array('db' => 'applied_coupon', 'dt' => 6),
            array('db' => 'email', 'dt' => 7),
            array('db' => 'phone', 'dt' => 8),
            array('db' => 'last_name', 'dt' => 9)
        );
    }

    /**
     * For getting the affiliates admin confirmed enquiry list 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     *  @return type
     */
    function getTotalFilteredAffiliatesEnquiryConfirmAdminList($table, $where) {
        if ($where) {
            $where = $where . " AND  enq_status=1 AND enq_close_status=1 ";
        } else {
            $where = " WHERE enq_status=1 AND enq_close_status=1 ";
        }
        $query = $this->db->query(" select id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For administrator confirmed affiliates enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataAffiliatesEnquiryConfirmAdminList($table, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND  enq_status=1 AND enq_close_status=1 ";
        } else {
            $where = " WHERE  enq_status=1 AND enq_close_status=1 ";
        }
        $query = $this->db->query("select id,enquiry_id,affiliate_id,course,sub_course,first_name,applied_coupon,email,phone,last_name from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of administrator confirmed enquiry list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfAffiliatesEnquiryActiveAdminList() {
        return $this->db->select('id')
                        ->where('enq_status', 1)
                        ->where('enq_close_status', 0)
                        ->from('affiliate_enquiry')
                        ->count_all_results();
    }

    /**
     * For administrator confirmed affiliates enquiry table column names
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesEnquiryActiveAdminList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'enquiry_id', 'dt' => 1),
            array('db' => 'affiliate_id', 'dt' => 2),
            array('db' => 'course', 'dt' => 3),
            array('db' => 'sub_course', 'dt' => 4),
            array('db' => 'first_name', 'dt' => 5),
            array('db' => 'coupon_code', 'dt' => 6),
            array('db' => 'coupon_amount', 'dt' => 7),
            array('db' => 'email', 'dt' => 8),
            array('db' => 'phone', 'dt' => 9),
            array('db' => 'last_name', 'dt' => 10),
            array('db' => 'description', 'dt' => 11)
        );
    }

    /**
     * For administrator confirmed affiliates enquiry filtered details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTotalFilteredAffiliatesEnquiryActiveAdminList($table, $where) {
        if ($where) {
            $where = $where . " AND  enq_status=1 AND enq_close_status=0 ";
        } else {
            $where = " WHERE  enq_status=1 AND enq_close_status=0 ";
        }
        $query = $this->db->query(" select id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For administrator confirmed affiliates enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getResultDataAffiliatesEnquiryActiveAdminList($table, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND  enq_status=1 AND enq_close_status=0 ";
        } else {
            $where = " WHERE  enq_status=1 AND enq_close_status=0 ";
        }
        $query = $this->db->query("select id,enquiry_id,affiliate_id,course,sub_course,first_name,coupon_code,coupon_amount,email,phone,last_name,description from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For affiliates user name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getAffiliatesUserName($id) {
        $query = $this->db->select('username')
                ->from('affiliates')
                ->where('id', $id)
                ->get();
        if ($this->db->num_rows() > 0) {
            return $query->row()->username;
        }
        return false;
    }

    /**
     * For activate enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function activateEnquiry($id, $enq_status, $enq_close_status, $coupon_code = 'NA', $amount = 0) {
        $this->db->set('enq_status', $enq_status)
                ->set('enq_close_status', $enq_close_status)
                ->set('coupon_code', $coupon_code)
                ->set('coupon_amount', $amount)
                ->where('id', $id)
                ->update('affiliate_enquiry');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For inactivate coupon
     * @param type $coupon_code
     * @return type  
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     */
    public function inactivateCoupon($coupon_code) {
        $this->db->set('status', 0)
                ->where('coupon_code', $coupon_code)
                ->update('affiliate_coupons');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For validate active enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function validateActiveEnquiry($id) {
        return $this->db->select('id')
                        ->where('enq_status', 1)
                        ->where('enq_close_status', 0)
                        ->where('id', $id)
                        ->from('affiliate_enquiry')
                        ->count_all_results();
    }

    /**
     * For complete enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $id
     * @param type $enq_status
     * @param type $enq_close_status
     * @param type $amount
     * @return type
     */
    public function completeEnquiry($id, $enq_status, $enq_close_status, $amount = 0) {
        $this->db->set('enq_status', $enq_status)
                ->set('enq_close_status', $enq_close_status)
                ->set('applied_coupon', $amount)
                ->where('id', $id)
                ->update('affiliate_enquiry');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For course subid to name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function getCourseSubIdToName($id) {
        $affiliate_sub_courses = 0;
        $query = $this->db->select('sub_course_name')
                ->where('id', $id)
                ->limit(1)
                ->get('affiliate_sub_courses');
        if ($query->num_rows() > 0) {
            $affiliate_sub_courses = $query->row()->sub_course_name;
        }
        return $affiliate_sub_courses;
    }

    /**
     * For created Enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $enq_id
     * @return string
     */
    public function createEnquiryDetails($enq_id) {
        $query = $this->db->select('enquiry_id,course,sub_course,wish_to_join,native_lang,description,first_name,last_name,email,address,address2,country,state,city,phone,created_date,zip')
                ->from('affiliate_enquiry')
                ->where('id', $enq_id)
                ->limit(1)
                ->get();
        foreach ($query->result_array() as $row) {
            $course_name = $this->getCourseIdToName($row['course']);
            $course = lang('NA');
            if ($course_name) {
                $course = $course_name;
            }
            $sub_course_name = $this->getCourseSubIdToName($row['sub_course']);
            $sub_course = lang('NA');
            if ($sub_course_name) {
                $sub_course = $sub_course_name;
            }
            $wish_to_join = lang('NA');
            if ($row['wish_to_join']) {
                $wish_to_join = lang($row['wish_to_join']);
            }
            $native_lang = lang('no');
            if ($row['native_lang']) {
                $native_lang = lang('yes');
            }
            $description = lang('NA');
            if ($row['description']) {
                $description = $row['description'];
            }
            $first_name = lang('NA');
            if ($row['first_name']) {
                $first_name = $row['first_name'];
            }
            $last_name = lang('NA');
            if ($row['last_name']) {
                $last_name = $row['last_name'];
            }
            $email = lang('NA');
            if ($row['email']) {
                $email = $row['email'];
            }
            $address = lang('NA');
            if ($row['address']) {
                $address = $row['address'];
            }
            $address2 = lang('NA');
            if ($row['address2']) {
                $address2 = $row['address2'];
            }
            $country = lang('NA');
            if ($row['country']) {
                $country = $this->helper_model->getCountryName($row['country']);
            }
            $state = lang('NA');
            if ($row['state']) {
                $state = $this->helper_model->getStateName($row['state']);
            }
            $city = lang('NA');
            if ($row['city']) {
                $city = $row['city'];
            }

            $phone = lang('NA');
            if ($row['phone']) {
                $phone = $row['phone'];
            }
            $zip = lang('NA');
            if ($row['zip']) {
                $zip = $row['zip'];
            }
        }


        $data = '<div class="row form-horizontal">  
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="courses">
                                ' . lang('course') . ' :
                            </label>
                            <label class="col-sm-6 control-label"  style="text-align: left;">
                                ' . $course . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('sub_course') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $sub_course . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('created_date') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $row['created_date'] . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('wish_to_join') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $wish_to_join . '
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('enq_description') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $description . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('native_lang') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $native_lang . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('first_name') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $first_name . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('last_name') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $last_name . '
                            </label>
                        </div>                        
                    </div>
                    <div class="col-md-6">                     
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('email') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $email . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('str_address') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $address . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('str_address2') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $address2 . '
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('country') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $country . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('state') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $state . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('city') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $city . '
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('phone') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $phone . '
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label">
                                ' . lang('zipcode') . ' :
                            </label>
                            <label class="col-sm-6 control-label" style="text-align: left;">
                                ' . $zip . '
                            </label>
                        </div>
                    </div>    
                </div>';

        return $data;
    }

    /**
     * For getting the course name details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getCourseNameDetails() {
        $data = array();
        $res = $this->db->select("id,course_name")
                ->from("affiliate_courses")
                ->where("status", 1)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['course_name'] = $row->course_name;
            $i++;
        }
        return $data;
    }

    /**
     * For create the course sub courses
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    function createSubCourse($data) {
        $this->db->set('sub_course_name', $data['sub_course_name'])
                ->set('order', $data['course_order'])
                ->set('course_id', $data['course_name'])
                ->set('added_date', date("Y-m-d H:i:s"))
                ->set('enquiry_count', 0)
                ->set('status', 1)
                ->insert('affiliate_sub_courses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For change sub-course status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $course_id
     * @param type $status
     * @return type
     */
    function changeSubCourseStatus($course_id, $status = '1') {
        $this->db->set('status', $status)
                ->where('id', $course_id)
                ->update('affiliate_sub_courses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get sub-course details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $id
     * @return type
     */
    function getSubCourseDetails($id) {
        $query = $this->db->select('sub_course_name,order,course_id')
                ->from('affiliate_sub_courses')
                ->where('id', $id)
                ->get();
        $data = array();
        foreach ($query->result_array() as $row) {
            $data['sub_course_name'] = $row['sub_course_name'];
            $data['order'] = $row['order'];
            $data['course_id'] = $row['course_id'];
            $data['course_name'] = $this->getCourseName($row['course_id']);
        }
        return $data;
    }

    /**
     * For getting the course name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function getCourseName($id) {
        $qry = $this->db->select('course_name')
                ->from('affiliate_courses')
                ->where('id', $id)
                ->get();

        if ($qry->num_rows > 0) {
            return $qry->row()->course_name;
        }
        return false;
    }

    /**
     * For update the sub-course name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    function updateSubCourse($data) {
        $this->db->set('sub_course_name', $data['sub_course_name'])
                ->set('order', $data['course_order'])
                ->set('course_id', $data['course_name'])
                ->where('id', $data['course_id'])
                ->update('affiliate_sub_courses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the count of sub-course list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfSubCourseList() {
        return $this->db->select('id')
                        ->from("affiliate_sub_courses")
                        ->count_all_results();
    }

    /**
     * For getting the subcourse column name list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnSubCourseList() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 'course_name', 'dt' => 1),
            array('db' => 'sub_course_name', 'dt' => 2),
            array('db' => '`t1.order`', 'dt' => 3),
            array('db' => 't1.added_date', 'dt' => 4),
            array('db' => 't1.enquiry_count', 'dt' => 5),
            array('db' => 't1.status', 'dt' => 6)
        );
    }

    /**
     * For getting the filtered details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredSubCourseList($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t2.course_name,t1.sub_course_name,t1.order,t1.added_date,t1.enquiry_count,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.course_id = t2.id ");
        return $query->num_rows();
    }

    /**
     * For getting the total sub-course details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataSubCourseList($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t2.course_name,t1.sub_course_name,t1.order,t1.added_date,t1.enquiry_count,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.course_id = t2.id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the subcourse id to name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $id
     * @return type
     */
    function getSubCourseIdToName($id) {
        $qry = $this->db->select('sub_course_name')
                ->from('affiliate_sub_courses')
                ->where('id', $id)
                ->get();
        if ($qry->num_rows() > 0) {
            return $qry->row()->sub_course_name;
        }
        return false;
    }

    /**
     * For adding the schedule task
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return boolean
     */
    function addSheduledTask($id) {
        $this->db->set('enq_id', $id)
                ->set('status', 'pending')
                ->insert('affiliate_shedules');
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $this->sendEnquiryMail($id, $insert_id);
        }
        return TRUE;
    }

    /**
     * For getting the schedule ID
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function getSheduleID($id) {
        $qry = $this->db->select('id')
                ->from('affiliate_shedules')
                ->where('enq_id', $id)
                ->get();

        if ($qry->num_rows() > 0) {
            return $qry->row()->id;
        }
        return false;
    }

    /**
     * For send Enquiry E-mail
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $insert_id
     * @return type
     */
    function sendEnquiryMail($id, $insert_id) {
        $this->load->model('send_mail_model');
        $client_details = $this->getEnquiryDetails($id, $insert_id);
        return $this->send_mail_model->send('', $client_details['email'], 'meeting_shedule', $client_details);
    }

    /**
     * For getting the complete schedule status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $id
     * @return type
     */
    function completeSheduleStatus($id) {
        $this->db->set('completed_status', 1)
                ->where('id', $id)
                ->update('affiliate_shedules');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get the enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $id
     * @param type $meeting_id
     * @return type
     */
    function getEnquiryDetails($id, $meeting_id) {
        $query = $this->db->select('enquiry_id,first_name,last_name,email')
                ->from('affiliate_enquiry')
                ->where('id', $id)
                ->get();
        $data = array();
        foreach ($query->result_array() as $row) {
            $data['enquiry_id'] = $row['enquiry_id'];
            $data['fullname'] = $row['first_name'] . ' ' . $row['last_name'];
            $data['email'] = $row['email'];
            $data['id'] = $meeting_id;
        }
        return $data;
    }

    /**
     * For getting the count of affiliates pending schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfAffiliatesShedulesPendingList() {
        return $this->db->select('id')
                        ->from('affiliate_shedules')
                        ->where('status', 'pending')
                        ->where('completed_status', 0)
                        ->count_all_results();
    }

    /**
     * For getting the count of active affiliates schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfAffiliatesShedulesActiveList() {
        return $this->db->select('id')
                        ->from('affiliate_shedules')
                        ->where('status', 'sheduled')
                        ->where('completed_status', 0)
                        ->count_all_results();
    }

    /**
     * For getting the count of complete affiliates schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return type
     */
    function countOfAffiliatesShedulesCompletedList() {
        return $this->db->select('id')
                        ->from('affiliate_shedules')
                        ->where('status', 'sheduled')
                        ->where('completed_status', 1)
                        ->count_all_results();
    }

    /**
     * For getting the affiliates column name for pending schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesShedulesPendingList() {
        return array(
            array('db' => "t1.id", 'dt' => 0),
            array('db' => "t2.enquiry_id", 'dt' => 1),
            array('db' => "t3.username", 'dt' => 2),
            array('db' => "t2.course", 'dt' => 3),
            array('db' => "t2.sub_course", 'dt' => 4),
            array('db' => "t1.date", 'dt' => 5),
            array('db' => "t1.time", 'dt' => 6),
            array('db' => "t2.applied_coupon", 'dt' => 7),
            array('db' => "t1.status", 'dt' => 8),
            array('db' => "t1.completed_status ", 'dt' => 9),
            array('db' => "t1.enq_id", 'dt' => 10),
            array('db' => "t2.first_name", 'dt' => 11),
            array('db' => "t2.last_name", 'dt' => 12),
            array('db' => "t2.email", 'dt' => 13),
            array('db' => "t2.phone", 'dt' => 14)
        );
    }

    /**
     * For getting the affiliates schedule active column name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnAffiliatesShedulesActiveList() {
        return array(
            array('db' => "t1.id", 'dt' => 0),
            array('db' => "t2.enquiry_id", 'dt' => 1),
            array('db' => "t3.username", 'dt' => 2),
            array('db' => "t2.course", 'dt' => 3),
            array('db' => "t2.sub_course", 'dt' => 4),
            array('db' => "t1.date", 'dt' => 5),
            array('db' => "t1.time", 'dt' => 6),
            array('db' => "t2.applied_coupon", 'dt' => 7),
            array('db' => "t1.status", 'dt' => 8),
            array('db' => "t1.completed_status ", 'dt' => 9),
            array('db' => "t1.enq_id", 'dt' => 10),
            array('db' => "t2.first_name", 'dt' => 11),
            array('db' => "t2.last_name", 'dt' => 12),
            array('db' => "t2.email", 'dt' => 13),
            array('db' => "t2.phone", 'dt' => 14)
        );
    }

    /**
     * For getting the completed affiliates schedule column name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return type
     */
    function getTableColumnAffiliatesShedulescompletedList() {
        return array(
            array('db' => "t1.id", 'dt' => 0),
            array('db' => "t2.enquiry_id", 'dt' => 1),
            array('db' => "t3.username", 'dt' => 2),
            array('db' => "t2.course", 'dt' => 3),
            array('db' => "t2.sub_course", 'dt' => 4),
            array('db' => "t1.date", 'dt' => 5),
            array('db' => "t1.time", 'dt' => 6),
            array('db' => "t2.applied_coupon", 'dt' => 7),
            array('db' => "t1.status", 'dt' => 8),
            array('db' => "t1.completed_status ", 'dt' => 9),
            array('db' => "t1.enq_id", 'dt' => 10),
            array('db' => "t2.first_name", 'dt' => 11),
            array('db' => "t2.last_name", 'dt' => 12),
            array('db' => "t2.email", 'dt' => 13),
            array('db' => "t2.phone", 'dt' => 14)
        );
    }

    /**
     * For getting the pending schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @return type
     */
    function getTotalFilteredAffiliatesShedulesPendingList($table1, $table2, $table3, $where) {
        if ($where) {
            $where = $where . " AND t1.status = 'pending' AND  t1.completed_status=0 ";
        } else {
            $where = " WHERE t1.status = 'pending' AND  t1.completed_status=0 ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.enq_id = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.affiliate_id " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the details pending schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataAffiliatesShedulesPendingList($table1, $table2, $table3, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status = 'pending' AND  t1.completed_status=0 ";
        } else {
            $where = " WHERE t1.status = 'pending' AND  t1.completed_status=0 ";
        }
        $query = $this->db->query("select t1.id,t2.enquiry_id,t3.username,t2.course,t2.sub_course,t1.date,t1.time,t2.applied_coupon,t1.status,t1.completed_status,t1.enq_id,t2.first_name,t2.last_name,t2.email,t2.phone from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.enq_id = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.affiliate_id " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the filtered schedule lists
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @return type
     */
    function getTotalFilteredAffiliatesShedulesActiveList($table1, $table2, $table3, $where) {
        if ($where) {
            $where = $where . " AND t1.status = 'sheduled' AND  t1.completed_status=0 ";
        } else {
            $where = " WHERE t1.status = 'sheduled' AND  t1.completed_status=0 ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.enq_id = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.affiliate_id " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the active schedule lists
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
    function getResultDataAffiliatesShedulesActiveList($table1, $table2, $table3, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status = 'sheduled' AND  t1.completed_status=0 ";
        } else {
            $where = " WHERE t1.status = 'sheduled' AND  t1.completed_status=0 ";
        }
        $query = $this->db->query("select t1.id,t2.enquiry_id,t3.username,t2.course,t2.sub_course,t1.date,t1.time,t2.applied_coupon,t1.status,t1.completed_status,t1.enq_id,t2.first_name,t2.last_name,t2.email,t2.phone from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.enq_id = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.affiliate_id " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the completed schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @return type
     */
    function getTotalFilteredAffiliatesShedulesCompletedList($table1, $table2, $table3, $where) {
        if ($where) {
            $where = $where . " AND t1.status = 'sheduled' AND  t1.completed_status=1 ";
        } else {
            $where = " WHERE t1.status = 'sheduled' AND  t1.completed_status=1 ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.enq_id = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.affiliate_id " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the completed schedule list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataAffiliatesShedulesCompletedList($table1, $table2, $table3, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status = 'sheduled' AND  t1.completed_status=1 ";
        } else {
            $where = " WHERE t1.status = 'sheduled' AND  t1.completed_status=1 ";
        }
        $query = $this->db->query("select t1.id,t2.enquiry_id,t3.username,t2.course,t2.sub_course,t1.date,t1.time,t2.applied_coupon,t1.status,t1.completed_status,t1.enq_id,t2.first_name,t2.last_name,t2.email,t2.phone from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.enq_id = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.id = t2.affiliate_id " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For check username exists or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_name
     * @return boolean
     */
    function checkIsUserNameExistsOrNot($user_name) {
        $result = $this->db->select('count(*)')
                ->from('affiliates')
                ->where('username', $user_name)
                ->where('status=', '1')
                ->count_all_results();
        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * For getting all active affiliates list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $query
     * @return type
     */
    function getAllActiveAffiliateList($query) {
        if ($query != '') {
            $res = $this->db->select("username")
                    ->from('affiliates')
                    ->like('username', trim($query))
                    ->where('status', 1)
                    ->get();
        } else {
            $res = $this->db->select("username")
                    ->from('affiliates')
                    ->where('status', 1)
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            $json[] = $row['username'];
        }
        return json_encode($json);
    }

    /**
     * For update affiliates password
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    function updateAffiliatesPassword($data) {
        $this->db->set('password', hash("sha256", $data['affiliate_password']))
                ->where('username', $data['affiliate_username'])
                ->update('affiliates');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
