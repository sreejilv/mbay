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
use Carbon\Carbon;

class Replication_model extends CI_Model {

    /**
     * For getting the administrator  username 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @return type
     */
    function getAdminUserName($type) {
        $admin_username = $this->db->select('user_name')
                ->where('user_type', $type)
                ->get('user');
        if ($admin_username->num_rows() > 0) {
            return $admin_username->row()->user_name;
        }
        return false;
    }

    /**
     * For getting the replicate user details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getReplicatinUserDetails($user_id) {

        $details = $this->db->select('us.user_rank_id,us.mlm_user_id,us.user_name,ud.first_name,ud.last_name,ud.address_1,ud.city,ud.country_id,ud.state_id,ud.zip_code,ud.date_of_birth,ud.user_dp,ud.user_cover,ud.date_of_joining,ud.phone_number,us.email,ud.facebook,ud.twiter,ud.gplus,ud.instagram')
                ->from('user as us')
                ->join('user_details as ud', 'us.mlm_user_id=ud.mlm_user_id', 'LEFT')
                ->where('ud.mlm_user_id', $user_id)
                ->get();
        $data = array();

        foreach ($details->result_array() as $row) {
            $data['username'] = $row['user_name'];
            $data['user_id'] = $row['mlm_user_id'];
            $data['first_name'] = $row['first_name'];
            $data['last_name'] = $row['last_name'];
            $data['full_name'] = $row['first_name'] . ' ' . $row['last_name'];
            $data['email'] = $row['email'];
            $data['address'] = $row['address_1'];
            $data['city'] = $row['city'];
            $data['cover_photo'] = $row['user_cover'];
            $data['phone_number'] = $row['phone_number'];
            $data['cover_dp'] = $row['user_dp'];
            $data['country'] = $this->helper_model->getCountryName($row['country_id']);
            $data['state'] = $this->helper_model->getStateName($row['state_id']);
            $data['zip_code'] = $row['zip_code'];
            $data['dob'] = $row['date_of_birth'];
            $data['user_rank'] = $this->getRankIdByName($row['user_rank_id']);
            $data['commission'] = number_format($this->getCommission($user_id), 2, '.', '');
            $data['downline'] = count($this->helper_model->getDownlinesUnilevel($user_id));
            $dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $row['date_of_joining']);
            $data['joining_time'] = $dtKtm->diffForHumans();
            $data['facebook'] = $row['facebook'];
            $data['twiter'] = $row['twiter'];
            $data['gplus'] = $row['gplus'];
            $data['instagram'] = $row['instagram'];
        }
        return $data;
    }

    /**
     * For getting the user types
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getUserTypes($user_id) {
        $type = $this->db->select('user_type')
                ->from('user')
                ->where('mlm_user_id', $user_id)
                ->get();
        if ($type->num_rows() > 0) {
            return $type->row()->user_type;
        }
        return false;
    }

    /**
     * For getting th rank ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_rank_id
     * @return type
     */
    function getRankIdByName($user_rank_id) {
        $query = $this->db->select('rank_name')
                ->from('rank')
                ->where('id', $user_rank_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->rank_name;
        }
        return false;
    }

    /**
     * For getting the commission
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getCommission($user_id) {
        $query = $this->db->select_sum('amount1')
                ->where('type', 'credit')
                //->like('wallet_type', '_bonus', 'before')
                ->where('bonus_flag', 1)
                ->where('mlm_user_id', $user_id)
                ->get('wallet_details');
        if ($query->num_rows() > 0) {
            return $query->row()->amount1;
        }
        return false;
    }

    /**
     * For getting the Events
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getEvents() {
        $query = $this->db->select('name,desc')
                ->where('status', 1)
                ->get('events');
        if ($query->num_rows > 0) {
            return $query->result_array();
        }
        return false;
    }

    /**
     * For getting the news
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getNews() {
        $query = $this->db->select('title,content,image,date')
                ->from('news')
                ->where('status', 1)
                ->get();
        if ($query->num_rows > 0) {
            return $query->result_array();
        }
        return false;
    }

}
