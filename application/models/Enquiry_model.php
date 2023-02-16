<?php

/**
 * 
 * 
 * For enquiry related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    enquiry
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */

Class Enquiry_model extends CI_Model {

    /**
     * for inserting an enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function insertEnquiry($data_arr) {
        $this->db->trans_start();
        $data = array(
            'enquiry_id' => $data_arr['unique_id'],
            'affiliate_id' => $data_arr['user_id'],
            'course' => $data_arr['course'],
            'sub_course' => $data_arr['sub_course'],
            'wish_to_join' => $data_arr['wish_to_join'],
            'description' => $data_arr['description'],
            'accommodation' => isset($data_arr['accommodation']) ? $data_arr['accommodation'] : 0,
            'native_lang' => isset($data_arr['nativelang']) ? $data_arr['nativelang'] : 0,
            'flight' => isset($data_arr['flight']) ? $data_arr['flight'] : 0,
            'transport' => isset($data_arr['transport']) ? $data_arr['transport'] : 0,
            'first_name' => $data_arr['first_name'],
            'last_name' => $data_arr['last_name'],
            'email' => $data_arr['email'],
            'address' => $data_arr['address'],
            'address2' => $data_arr['address2'],
            'country' => $data_arr['country'],
            'state' => $data_arr['state'],
            'phone' => $data_arr['phone'],
            'city' => $data_arr['city'],
            'zip' => $data_arr['zip'],
            'created_date' => date("Y-m-d H:i:s"),
        );
        $result = $this->db->insert('affiliate_enquiry', $data);
        $this->updateEquiryCount($data_arr['course']);
        $this->updateEquirySubCourseCount($data_arr['sub_course']);
        if ($result) {
            $this->helper_model->insertAffiliateActivity($data_arr['user_id'], 'enquiry_add', $data_arr, 'fa fa-user-plus', 'orange');
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * for getting enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getLoggedAffiliateAddedEnquiry($affliate) {
        $details = $this->db->select("*")
                ->from('affiliate_enquiry')
                ->where('affiliate_id', $affliate)
                ->get();
        $data = [];
        $i = 0;
        foreach ($details->result_array() as $row) {
            $data[$i]['affiliate_name'] = $this->affiliateIdToName($affliate);
            $data[$i]['course'] = $this->getCourseIdToName($row['course']);
            $data[$i]['accommodation'] = ($row['accommodation'] != 0) ? lang('yes') : lang('no');
            $data[$i]['flight'] = ($row['flight'] != 0) ? lang('yes') : lang('no');
            $data[$i]['transport'] = ($row['transport'] != 0) ? lang('yes') : lang('no');
            $data[$i]['first_name'] = $row['first_name'];
            $data[$i]['last_name'] = isset($row['last_name']) ? $row['last_name'] : NULL;
            $data[$i]['email'] = $row['email'];
            $data[$i]['address'] = $row['address'];
            $data[$i]['phone'] = $row['phone'];
            $data[$i]['country'] = $this->helper_model->getCountryName($row['country']);
            $data[$i]['state'] = $this->helper_model->getStateName($row['country']);
            $data[$i]['enquiry_id'] = $row['id'];
            $data[$i]['affiliate_id'] = $affliate;
            $i++;
        }
        return $data;
    }

    /**
     * for getting affiliate name from id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function affiliateIdToName($id) {
        return $this->db->select('username')
                        ->from('affiliates')
                        ->where('id', $id)->get()->row()->username;
    }

    /**
     * for getting all courses
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getAllCourses() {
        $details = $this->db->select('id,course_name')
                ->from('affiliate_courses')
                ->where('status', 1)
                ->order_by('order', 'ASC')
                ->get();
        $data = [];
        $i = 0;
        foreach ($details->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['course_name'] = $row['course_name'];
            $i++;
        }
        return $data;
    }

    /**
     * for getting course name from id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getCourseIdToName($id) {
        return $this->db->select('course_name')
                        ->from('affiliate_courses')
                        ->where('id', $id)
                        ->get()->row()->course_name;
    }

    /**
     * for generating random enquiry id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function generateEnquiryId($prefix, $length) {
        $this->load->helper('string');
        return $unquie_id = $prefix . random_string('alnum', $length);
    }

    /**
     * for updating enquiry count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateEquiryCount($course_id, $count = 1) {
        return $this->db->set('enquiry_count', 'enquiry_count +' . $count, FALSE)
                        ->where('id', $course_id)
                        ->update('affiliate_courses');
    }

    /**
     * for updating enquiry sub-course count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateEquirySubCourseCount($sub_course_id, $count = 1) {
        return $this->db->set('enquiry_count', 'enquiry_count +' . $count, FALSE)
                        ->where('id', $sub_course_id)
                        ->update('affiliate_sub_courses');
    }

    /**
     * for setting datatable heading for enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnEnquiryList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'enquiry_id', 'dt' => 1),
            array('db' => 'course', 'dt' => 2),
            array('db' => 'sub_course', 'dt' => 3),
            array('db' => 'first_name', 'dt' => 4),
            array('db' => 'address', 'dt' => 5),
            array('db' => 'created_date', 'dt' => 6),
            array('db' => 'enq_status', 'dt' => 7),
            array('db' => 'last_name', 'dt' => 8),
            array('db' => 'email', 'dt' => 9),
            array('db' => 'country', 'dt' => 10),
            array('db' => 'state', 'dt' => 11),
            array('db' => 'phone', 'dt' => 12),
            array('db' => 'enq_close_status', 'dt' => 13)
        );
    }

    /**
     * for getting filtered enquiry count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredEnquiryList($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND affiliate_id=$user_id ";
        } else {
            $where = " WHERE affiliate_id=$user_id ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting datatable enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataEnquiryList($table, $column, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND affiliate_id=$user_id ";
        } else {
            $where = " WHERE affiliate_id=$user_id ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting enquiry list count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfEnquiryList($user_id) {
        return $this->db->select('id')
                        ->where('affiliate_id', $user_id)
                        ->from("affiliate_enquiry")
                        ->count_all_results();
    }

    /**
     * for getting all enquiries of an affiliate
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getEnquiryDetails($affliate_id) {
        $this->load->model('home_model');
        $data = array();
        $data[0]['label'] = lang('active');
        $data[0]['value'] = $this->home_model->getAffiliatePendingEnquiry($affliate_id, 1, 0);
        $data[1]['label'] = lang('pending');
        $data[1]['value'] = $this->home_model->getAffiliatePendingEnquiry($affliate_id, 0, 0);
        $data[2]['label'] = lang('complete');
        $data[2]['value'] = $this->home_model->getAffiliatePendingEnquiry($affliate_id, 1, 1);

        return $data;
    }

    /**
     * for getting an enquiry details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getEnquiryData($user_id) {
        $graph_data = array();
        $date = date('Y-m-d', strtotime('today - 29 days'));
        $max_limit = 5;
        for ($i = 0; $i < 31; $i++) {
            $graph_data[$i]['date'] = $date;
            $graph_data[$i]['value1'] = $this->getAllAffiliateEnquires($date, $user_id); //joins
            $graph_data[$i]['value2'] = $this->affiliateEarnCommissionForAddEnquiry($user_id); //commission to be in 

            if ($max_limit < $graph_data[$i]['value1']) {
                $max_limit = $graph_data[$i]['value1'] + 5;
            }
            if ($max_limit < $graph_data[$i]['value2']) {
                $max_limit = $graph_data[$i]['value2'] + 5;
            }

            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $data = array();
        $data['graph'] = $graph_data;
        $data['key1'] = lang('enquiry');
        $data['key2'] = lang('commissions');
        $data['max_limit'] = $max_limit;
        return $data;
    }

    /**
     * for getting count of affiliate enquiries
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getAllAffiliateEnquires($date, $affiliate) {
        return $this->db->select("count(*)")
                        ->from('affiliate_enquiry')
                        ->where('affiliate_id', $affiliate)
                        ->where('DATE(created_date) BETWEEN "' . $date . '" AND "' . $date . '"')
                        ->count_all_results();
    }

    /**
     * for commission section for enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function affiliateEarnCommissionForAddEnquiry($user_id) {
        return 0;
    }

    /**
     * for getting all sub-courses
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getSubCourses($course_id) {
        $details = $this->db->select('id,course_id,sub_course_name')
                ->from('affiliate_sub_courses')
                ->where('status', 1)
                ->where('course_id', $course_id)
                ->order_by('order', 'ASC')
                ->get();
        $data = [];
        $i = 0;
        foreach ($details->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['course_id'] = $row['course_id'];
            $data[$i]['sub_course_name'] = $row['sub_course_name'];
            $i++;
        }
        return $data;
    }

    /**
     * for getting sub-course name fron id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getSubCourseIdToName($id) {
        return $this->db->select('sub_course_name')
                        ->from('affiliate_sub_courses')
                        ->where('id', $id)
                        ->get()->row()->sub_course_name;
    }

}
