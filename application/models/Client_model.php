<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * For client related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    client
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Client_model extends CI_Model {

    /**
     * for validating an affiliate
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $username
     * @return type
     */
    public function validateAffiliate($username) {
        $id = 0;
        $query = $this->db->select('id')
                ->where('username', $username)
                ->limit(1)
                ->get('affiliates');
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
        }
        return $id;
    }

    /**
     * for enroll an affiliate
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    public function enrollAffiliate($data) {
        $res = $this->db->set('username', $data['affiliate_name'])
                ->set('sponser_id', $this->helper_model->userNameToID($data['sponser_name']))
                ->set('email', $data['email'])
                ->set('mobile ', $data['mobile_no'])
                ->set('first_name', $data['first_name'])
                ->set('last_name', $data['last_name'])
                ->set('password', hash("sha256", $data['password']))
                ->set('country', $data['country'])
                ->set('state', $data['state'])
                ->set('enroll_date', date("Y-m-d H:i:s"))
                ->insert('affiliates');
        if ($res) {
            $this->load->model('send_mail_model');
            $this->send_mail_model->send('', $data['email'], 'affiliate_mail', $data);
        }
        return $res;
    }

    /**
     * for validation a shedule
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return int
     */
    public function validateSheduleId($id) {
        $query = $this->db->select('id')
                ->where('id', $id)
                ->where('status', 'pending')
                ->where('completed_status', 0)
                ->limit(1)
                ->get('affiliate_shedules');
        if ($query->num_rows() > 0) {
            return 1;
        }
        return 0;
    }

    /**
     * for adding a shedule time
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    public function addSheduleTime($data) {
        $this->db->set('date', $data['sdl_date'])
                ->set('time', $data['sdl_time'])
                ->set('status', 'sheduled')
                ->where('id', $data['shedule'])
                ->update('affiliate_shedules');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting an affiliate id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $shd_id
     * @return type
     */
    public function getAffiliateId($shd_id) {
        $data = array();
        $query = $this->db->select("affiliate_id,enquiry_id")
                ->from("affiliate_enquiry as ae")
                ->join("affiliate_shedules as as", 'ae.id = as.enq_id', 'inner')
                ->where("as.id", $shd_id)
                ->get();
        if ($query->num_rows() > 0) {
            $data['affiliate_id'] = $query->row()->affiliate_id;
            $data['enquiry_id'] = $query->row()->enquiry_id;
        }
        return $data;
    }

    /**
     * for geting an affiliate details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $aff_data
     * @return type
     */
    function getAffiliateDetails($aff_data) {
        $data = array();
        $query = $this->db->select('username,first_name,last_name,email')
                ->from('affiliates')
                ->where('id', $aff_data['affiliate_id'])
                ->get();
        $data = array();
        foreach ($query->result_array() as $row) {
            $data['username'] = $row['username'];
            $data['fullname'] = $row['first_name'] . ' ' . $row['last_name'];
            $data['email'] = $row['email'];
            $data['enquiry_id'] = $aff_data['enquiry_id'];
        }
        return $data;
    }

}
