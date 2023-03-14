<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For Profile related function are listed here
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Profile_model extends CI_Model {

    /**
     * For user details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    public function getUserDetails($user_id) {

        $data = array();
        $res = $this->db->select("us.user_name,us.email,us.tran_password,us.sponsor_id,us.date,us.user_rank_id")
                ->select("ud.first_name,ud.last_name,ud.date_of_birth,ud.gender,ud.phone_number,ud.address_1,ud.address_2,ud.city,ud.zip_code,ud.state_id,ud.country_id,ud.user_dp,ud.user_cover,ud.facebook,ud.twiter,ud.gplus,ud.instagram")
                ->from("user as us")
                ->join('user_details as ud', "us.mlm_user_id=ud.mlm_user_id", "INNER")
                ->where("us.mlm_user_id", $user_id)
                ->get();
        foreach ($res->result() as $row) {
            $data['user_name'] = $row->user_name;
            $data['email'] = $row->email;
            $data['tran_password'] = $row->tran_password;
            $data['sponsor_name'] = $this->helper_model->IdToUserName($row->sponsor_id);
            $data['date'] = $row->date;
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
            $data['address_1'] = $row->address_1;
            $data['address_2'] = $row->address_2;
            $data['zipcode'] = $row->zip_code;
            $data['state'] = $row->state_id;
            $data['country'] = $row->country_id;
            $data['user_dp'] = $row->user_dp;
            $data['user_cover'] = $row->user_cover;
            $data['gender'] = $row->gender;
            $data['city'] = $row->city;
            $data['phone_number'] = $row->phone_number;
            $data['date_of_birth'] = $row->date_of_birth;
            $data['rank_name'] = $this->helper_model->getRankIBydName($row->user_rank_id);
            $data['replica_link'] = $this->helper_model->getUserReplicaLink($row->user_name);
            $data['lcp_link'] = $this->helper_model->getUserLCPLink($row->user_name);
            // $data['ref_link'] = $this->helper_model->getUserRefLink($user_id);
            $data['facebook'] = $row->facebook;
            $data['twiter'] = $row->twiter;
            $data['gplus'] = $row->gplus;
            $data['instagram'] = $row->instagram;
        }
        return $data;
    }

    /**
     * For update user details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $post
     * @return type
     */
    function updateUserProfile($user_id, $post) {
        $this->db->set('first_name ', $post['first_name'])
                ->set('last_name ', $post['last_name'])
                ->set('address_1 ', $post['address'])
                ->set('city ', $post['city'])
                ->set('zip_code ', $post['zipcode'])
                ->set('state_id ', $post['state'])
                ->set('country_id ', $post['country'])
                ->set('date_of_birth ', $post['dob'])
                ->set('gender ', $post['gender'])
                ->set('phone_number ', $post['phone_number'])
                ->where('mlm_user_id ', "$user_id")
                ->update('user_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update user image
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $file
     * @return type
     */
    function updateUserPic($user_id, $file) {
        $res = $this->db->set('user_dp ', $file['upload_data']['file_name'])
                ->where('mlm_user_id ', "$user_id")
                ->update('user_details');
        if ($res) {
            $this->insertUserPictureHistory($user_id, $file['upload_data']['file_name'], 'user_dp');
        }
        return $res;
    }

    /**
     * For update the user cover photo
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $file
     * @return type
     */
    function updateUserCover($user_id, $file) {
        $res = $this->db->set('user_cover ', $file['upload_data']['file_name'])
                ->where('mlm_user_id ', "$user_id")
                ->update('user_details');
        if ($res) {
            $this->insertUserPictureHistory($user_id, $file['upload_data']['file_name'], 'user_cover');
        }
        return $res;
    }

    /**
     * For insert the update activity
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $file_name
     * @param type $file_type
     * @return type
     */
    function insertUserPictureHistory($user_id, $file_name, $file_type) {
        $this->db->set('mlm_user_id', $user_id)
                ->set('file_name', $file_name)
                ->set('file_type', $file_type)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('user_files');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting user files
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getUserFiles($user_id) {
        $data['dp'] = $data['co'] = array();
        $dp = $co = 0;
        $res = $this->db->select("id,file_name,file_type")
                ->from("user_files")
                ->where("mlm_user_id", $user_id)
                ->get();
        foreach ($res->result() as $row) {
            if ($row->file_type == "user_dp") {
                $data['dp'][$dp]['id'] = $row->id;
                $data['dp'][$dp]['file'] = $row->file_name;
                $dp++;
            } else {
                $data['co'][$co]['id'] = $row->id;
                $data['co'][$co]['file'] = $row->file_name;
                $co++;
            }
        }
        return $data;
    }

    /**
     * For reset user profile pic
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function resetUserFile($id) {
        $flag = 0;
        $res = $this->db->select("mlm_user_id,file_name,file_type")
                ->from("user_files")
                ->where("id", $id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            if ($row->file_type == "user_cover") {
                $flag = $this->setCover($row->mlm_user_id, $row->file_name);
            } elseif ($row->file_type == "user_dp") {
                $flag = $this->setDp($row->mlm_user_id, $row->file_name);
            }
        }
        return $flag;
    }

    /**
     * For setCover Picture
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $mlm_user_id
     * @param type $file_name
     * @return type
     */
    public function setCover($mlm_user_id, $file_name) {
        $this->db->set('user_cover ', $file_name)
                ->where('mlm_user_id ', $mlm_user_id)
                ->update('user_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * set user profile picture
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $mlm_user_id
     * @param type $file_name
     * @return type
     */
    public function setDp($mlm_user_id, $file_name) {
        $this->db->set('user_dp ', $file_name)
                ->where('mlm_user_id ', $mlm_user_id)
                ->update('user_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get all countries
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllCountries() {
        $data = array();
        $query = $this->db->select("country_id,country_name")
                ->from("countries")
                ->where("status", '1')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['name'] = lang($row['country_name']);
            $data[$i]['id'] = $row['country_id'];
            $i++;
        }
        return $data;
    }

    /**
     * For get all states
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $country_id
     * @return type
     */
    function getAllStates($country_id) {
        $data = array();
        $query = $this->db->select("state_id,state_name")
                ->from("states")
                ->where("status", '1')
                ->where('country_id', $country_id)
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['name'] = $row['state_name'];
            $data[$i]['id'] = $row['state_id'];
            $i++;
        }

        return $data;
    }

    /**
     * For get affiliates Details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @return type
     */
    public function getAffiliateDetails($affiliate_id) {
        $data = array();
        $res = $this->db->select('*')
                ->from("affiliates")
                ->where("id", $affiliate_id)
                ->get();
        foreach ($res->result() as $row) {
            $data['user_name'] = $row->username;
            $data['sponser_name'] = $this->helper_model->IdToUserName($row->sponser_id);
            $data['sponser_id'] = $row->sponser_id;
            $data['email'] = $row->email;
            $data['mobile'] = $row->mobile;
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
            $data['state'] = $row->state;
            $data['state_name'] = $this->helper_model->getStateName($row->state);
            $data['country'] = $row->country;
            $data['country_name'] = $this->helper_model->getCountryName($row->country);
            $data['enroll_date'] = $row->enroll_date;
            $data['zip_code'] = $row->zip_code;
            $data['city'] = $row->city;
            $data['gender'] = $row->gender;
        }
        return $data;
    }

    /**
     * For update affiliates details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $post
     * @return type
     */
    function updateAffiliateDetails($user_id, $post) {
        $this->db->set('email', $post['email'])
                ->set('mobile', $post['mobile'])
                ->set('first_name', $post['first_name'])
                ->set('last_name', $post['last_name'])
                ->set('state', $post['state'])
                ->set('country', $post['country'])
                ->set('zip_code', $post['zip_code'])
                ->set('city', $post['city'])
                ->set('gender', $post['gender'])
                ->where('id', "$user_id")
                ->update('affiliates');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get affiliate activity
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @return type
     */
    public function getAffiliateActivity($affiliate_id) {
        $data = array();
        $i = 0;
        $res = $this->db->select('activity,date,ip_address,icon,text_color')
                ->from("affiliate_activity")
                ->where("affiliate_id", $affiliate_id)
                ->order_by('id', 'DESC')
                ->limit(10)
                ->get();
        foreach ($res->result() as $row) {
            $dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $row->date);
            $data[$i]['date'] = $dtKtm->diffForHumans();
            $data[$i]['activity'] = lang($row->activity);
            $data[$i]['ip_address'] = $row->ip_address;
            $data[$i]['text_color'] = $row->text_color;
            $data[$i]['icon'] = $row->icon;
            $i++;
        }
        return $data;
    }

    /**
     * For validate affiliate password
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @param type $password
     * @return type
     */
    public function validateAffiliatePassword($affiliate_id, $password) {
        return $this->db->select('id')
                        ->from("affiliates")
                        ->where('id', $affiliate_id)
                        ->where('password', hash("sha256", $password))
                        ->count_all_results();
    }

    /**
     * for update affiliate password
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $post
     * @return type
     */
    function updateAffiliatePassword($user_id, $post) {
        $this->db->set('password', hash("sha256", $post['new_password']))
                ->where('id', "$user_id")
                ->update('affiliates');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get Total Enquiry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @return type
     */
    public function getTotalEnquiry($affiliate_id) {
        return $this->db->select('id')
                        ->from("affiliate_enquiry")
                        ->where('affiliate_id', $affiliate_id)
                        ->count_all_results();
    }

    /**
     * For pending Enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @return type
     */
    public function getPendingEnquiry($affiliate_id) {
        return $this->db->select('id')
                        ->from("affiliate_enquiry")
                        ->where('affiliate_id', $affiliate_id)
                        ->where('enq_status', 0)
                        ->count_all_results();
    }

    /**
     * For getting the active enquiry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @return type
     */
    public function getActiveEnquiry($affiliate_id) {
        return $this->db->select('id')
                        ->from("affiliate_enquiry")
                        ->where('affiliate_id', $affiliate_id)
                        ->where('enq_close_status', 0)
                        ->where('enq_status', 1)
                        ->count_all_results();
    }

    /**
     * For getting the close enquiry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $affiliate_id
     * @return type
     */
    public function getClosedEnquiry($affiliate_id) {
        return $this->db->select('id')
                        ->from("affiliate_enquiry")
                        ->where('affiliate_id', $affiliate_id)
                        ->where('enq_close_status', 1)
                        ->count_all_results();
    }
    
    
    function updateSocialProfile($user_id, $data) {
        $this->db->set($data['name'], $data['value'])
                ->where('mlm_user_id ', "$user_id")
                ->update('user_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function checkUserCurrentPasswod($user_id, $password) {
        $id = 0;
        $query = $this->db->select('mlm_user_id')
                ->where('password', hash("sha256", $password))
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        foreach ($query->result() as $row) {
            $id = $row->mlm_user_id;
        }
        return $id;
    }

}
