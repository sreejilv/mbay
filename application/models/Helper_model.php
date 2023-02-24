<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 *
 * For helper related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    helper
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Helper_model extends CI_Model {

    public $upline_fathers = array();
    public $upline_sponsors = array();
    public $downline_binary = array();
    public $downline_unilevel = array();

    public function __construct() {
        parent::__construct();
        $this->upline_fathers = NULL;
        $this->upline_sponsors = NULL;
        $this->downline_binary = NULL;
        $this->downline_unilevel = NULL;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function insertActivity($user_id, $activity, $data = array(), $employee_id = 0) {
        if ($user_id) {
            if (!$employee_id)
                $employee_id = ($this->aauth->getUserType() == 'employee') ? $this->aauth->getId() : 0;

            $ip_address = $this->getUserIP();

            $result = array();
            $country_name = $region_name = $city = '';
            $location_status = 0;
            if ($this->dbvars->GEO_LOCATION_STATUS > 0) {
                $result = json_decode(file_get_contents("http://ip-api.io/json/$ip_address"));
                if ($result) {
                    $country_name = $result->country_name;
                    $region_name = $result->region_name;
                    $city = $result->city;
                    $location_status = 1;
                }
            }

            $this->db->set('mlm_user_id', $user_id)
                    ->set('employee_id', $employee_id)
                    ->set('activity', $activity)
                    ->set('ip_address', $ip_address)
                    ->set('user_agent', $this->getUserAgent())
                    ->set('date', date("Y-m-d H:i:s"))
                    ->set('data', serialize($data))
                    ->set('country', $country_name)
                    ->set('region', $region_name)
                    ->set('city', $city)
                    ->set('location_details', serialize($result))
                    ->set('location_status', $location_status)
                    ->insert('activity');
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        }
        return FALSE;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function insertFailedActivity($user_id, $activity, $data = array()) {
        $employee_id = ($this->aauth->getUserType() == 'employee') ? $this->aauth->getId() : 0;
        $this->db->set('mlm_user_id', $user_id)
                ->set('employee_id', $employee_id)
                ->set('activity', $activity)
                ->set('ip_address', $this->getUserIP())
                ->set('user_agent', $this->getUserAgent())
                ->set('date', date("Y-m-d H:i:s"))
                ->set('data', serialize($data))
                ->insert('issues');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserAgent() {
        $user_agent = '';
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        }
        return $user_agent;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function stripTagsPost($post_arr = array()) {
        $temp_arr = array();
        if (is_array($post_arr) && count($post_arr)) {
            foreach ($post_arr AS $key => $value) {
                if (is_string($value)) {
                    $temp_arr["$key"] = strip_tags($value);
                } else {
                    $temp_arr["$key"] = $value;
                }
            }
        }
        return $temp_arr;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTotalUserCount($status = 'active') {
        $this->db->select('mlm_user_id');
        $this->db->from("user");
        if ($status)
            $this->db->where('user_status', $status);
        return $this->db->count_all_results();
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserFullName($user_id) {
        $user_full_name = '';
        $query = $this->db->select('first_name,last_name ')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_details');
        if ($query->num_rows() > 0) {
            $user_full_name = $query->row()->first_name . " " . $query->row()->last_name;
        }
        return $user_full_name;
    }

    public function getUserProfileData($user_id) {
        $data = array();
        $query = $this->db->select('last_name,first_name,user_dp,mlm_user_id,date_of_joining')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_details');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $data = $value;
            }
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function changeUserStatus($user_id, $status = 'active') {
        $this->db->set('user_status', "$status")
                ->where('mlm_user_id', "$user_id")
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function userNameToID($username) {
        $user_id = 0;
        $query = $this->db->select('mlm_user_id')
//->where("(user_name = '$username' OR email = '$username') ")
                ->where("user_name", "$username")
                ->or_where("email", "$username")
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->mlm_user_id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function isUserExist($username) {

        $qry = $this->db->select('mlm_user_id')
                ->where('user_name', $username)
                ->limit(1)
                ->get('user');

        if ($qry->num_rows() > 0) {
            return $qry->num_rows();
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function IdToUserName($user_id) {
        $user_name = NULL;
        $query = $this->db->select('user_name')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $user_name = $query->row()->user_name;
        }
        return $user_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getFatherId($user_id) {
        $father_id = NULL;
        $query = $this->db->select('father_id')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $father_id = $query->row()->father_id;
        }
        return $father_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getSponsorId($user_id) {
        $sponsor_id = NULL;
        $query = $this->db->select('sponsor_id')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $sponsor_id = $query->row()->sponsor_id;
        }
        return $sponsor_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserEmailId($user_id, $user_type = '') {
        $email_id = NULL;
        if ($user_type == 'affiliate') {
            return $this->getAffiliateEmailId($user_id);
        } elseif ($user_type == 'employee') {
            return $this->getEmployeeEmailId($user_id);
        } else {
            $query = $this->db->select("email")
                    ->where("mlm_user_id", $user_id)
                    ->limit(1)
                    ->get("user");
            if ($query->num_rows() > 0) {
                $email_id = $query->row()->email;
            }
            return $email_id;
        }
    }

    function getEmployeeEmailId($employee_id) {
        $query = $this->db->select('email')
                ->from('employee_details')
                ->where('employee_id', $employee_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->email;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserIdFromEmailId($email) {
        $user_id = NULL;
        $query = $this->db->select("mlm_user_id")
                ->where("email", $email)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->mlm_user_id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function isUserAvailable($user_id) {
        return $this->db->select("mlm_user_id")
                        ->from("user")
                        ->where('mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getProductId($user_id) {
        $product_id = '';
        $query = $this->db->select("product_id")
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $product_id = $query->row()->product_id;
        }
        return $product_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getAdminId() {
        $user_id = '';
        $query = $this->db->select('mlm_user_id')
                ->where('user_type', 'admin')
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->mlm_user_id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getAdminUsername() {
        $user_name = '';
        $query = $this->db->select('user_name')
                ->where('user_type', "admin")
                ->limit(1)
                ->from('user')
                ->get();
        if ($query->num_rows() > 0) {
            $user_name = $query->row()->user_name;
        }
        return $user_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserLoginStatus($user_id, $password) {
        $user_status = 'NA';
        $query = $this->db->select("user_status")
                ->where("mlm_user_id", $user_id)
                ->where("password ", $password)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $user_status = $query->row()->user_status;
        }
        return $user_status;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getJoiningDate($user_id) {
        $doj = '';
        $query = $this->db->select("date")
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $doj = $query->row()->date;
        }
        return $doj;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserRank($user_id) {
        $rank = NULL;
        $query = $this->db->select('user_rank_id')
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $rank = $query->row()->user_rank_id;
        }
        return $rank;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserType($user_id) {
        $user_type = "";
        $query = $this->db->select('user_type')
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $user_type = $query->row()->user_type;
        }
        return $user_type;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function encode($string = '') {
        $encode_key = '';
        if ($string != '') {
            $encrypt_string = $this->encryption->encrypt($string);
            $encode_key = urlencode(base64_encode($encrypt_string));
        }

        return $encode_key;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function decode($encode_data = '') {
        $decode_key = '';
        if ($encode_data != '') {
            $decode_string = base64_decode(urldecode($encode_data));
            $decode_key = $this->encryption->decrypt($decode_string);
        }
        return $decode_key;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserBalance($user_id) {
        $balance_amount = 0;
        $query = $this->db->select('balance_amount')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_balance');
        if ($query->num_rows() > 0) {
            $balance_amount = $query->row()->balance_amount;
        }
        return round($balance_amount, 2);
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function validateDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getTransactionPassword($user_id) {
        $tran_password = NULL;
        $query = $this->db->select('tran_password')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $tran_password = $query->row()->tran_password;
        }
        return $tran_password;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getBalancedLeg($user_id) {
        $balanced_leg = 'L';
        $query = $this->db->select('user_L_carry, user_R_carry')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->row()->user_R_carry < $query->row()->user_L_carry)
            $balanced_leg = 'R';
        return $balanced_leg;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUplineFathers($user_id, $level = null) {
        $this->upline_fathers = array();
        $this->db->select('path,position,level');
        $this->db->where('user_id', $user_id);
        $this->db->where('path !=', 0);
        if ($level)
            $this->db->where('level <=', $level);
        $query = $this->db->get('traverse_father');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $this->upline_fathers[] = $row;
            }
        }
        return $this->upline_fathers;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUplineSponsors($user_id, $level = null) {
        $this->upline_sponsors = array();
        $this->db->select('path,level');
        $this->db->where('user_id', $user_id);
        $this->db->where('path !=', 0);
        if ($level)
            $this->db->where('level <=', $level);
        $query = $this->db->get('traverse_sponsor');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $this->upline_sponsors[] = $row;
            }
        }
        return $this->upline_sponsors;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getDownlinesBinary($user_id, $level = null) {//Geneology
        $this->downline_binary = array();
        $this->db->select('user_id');
        $this->db->where('path', $user_id);
        if ($level)
            $this->db->where('level <=', $level);
        $query = $this->db->get('traverse_father');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->downline_binary[] = $row->user_id;
            }
        }
        return $this->downline_binary;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getDownlinesUnilevel($user_id, $level = null) {//Sponsor
        $this->downline_unilevel = array();
        $this->db->select('user_id');
        $this->db->where('path', $user_id);
        if ($level)
            $this->db->where('level <=', $level);
        $query = $this->db->get('traverse_sponsor');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->downline_unilevel[] = $row->user_id;
            }
        }
        return $this->downline_unilevel;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getAllRankDetails() {
        $rank_array = array();
        $query = $this->db->select('id,referal_count,total_sales,rank_bonus')
                ->where('status', 1)
                ->get('rank');
        if ($query->num_rows() > 0) {
            $i = 1;
            foreach ($query->result_array() as $row) {
                $rank_array["$i"] = $row;
                $i++;
            }
        }
        return $rank_array;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function checkQualification($user_id, $rank_array = array(), $from_user = null) {
        $check_rank = $this->getUserRank($user_id);
        $check_next_rank = $dist_status = true;
        $qualified_rank = null;
        $user_qualification = $this->getUserQualificationDetails($user_id);
        foreach ($rank_array as $row) {
            if ($check_next_rank) {
                if ($row['id'] > $check_rank) {
                    if ($user_qualification['referral_count'] >= $row['referal_count'] && $user_qualification['total_sales'] >= $row['total_sales']) {
                        $qualified_rank = $row['id'];
                        $rank_update = $this->updateUserRank($user_id, $qualified_rank);
                        $history_update = $this->updateRankHistory($user_id, $check_rank, $qualified_rank, $from_user);
                        if ($rank_update && $history_update) {
                            $check_rank = $qualified_rank;
                            $dist_status = $this->insertWalletDetails($user_id, 'credit', $row['rank_bonus'], 'rank_bonus', $from_user, 'code', 0, 0, 1);
                        }
                    } else {
                        $check_next_rank = false;
                    }
                }
            } else {
                return true;
            }
        }
        return $dist_status;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserQualificationDetails($user_id) {
        $referral_count = $this->getReferralCount($user_id);
        $sales = $this->getDownUsersUnilevelsale($user_id);
        $return_array['referral_count'] = ($referral_count > 0) ? $referral_count : 0;
        $return_array['total_sales'] = ($sales > 0) ? $sales : 0;
        return $return_array;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function updateRankHistory($user_id, $check_rank, $qualified_rank, $from_user = null) {
        $result = false;
        $query = $this->db->set('mlm_user_id', $user_id)
                ->set('current_rank', $check_rank)
                ->set('new_rank', $qualified_rank)
                ->set('update_date', date('Y-m-d H:m:s'))
                ->set('from_user', $from_user)
                ->insert('rank_history');
        if ($this->db->affected_rows()) {
            $result = true;
        }
        return $result;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function updateUserRank($user_id, $qualified_rank) {
        $result = false;
        $query = $this->db->set('user_rank_id', $qualified_rank)
                ->where('mlm_user_id', $user_id)
                ->update('user');
        if ($this->db->affected_rows()) {
            $result = true;
        }
        return $result;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getReferralCount($user_id) {
        $query = $this->db->select('mlm_user_id')
                ->where('sponsor_id', $user_id)
                ->where('user_status', 'active')
                ->get('user');
        $referral_count = $query->num_rows();

        return ($referral_count > 0) ? $referral_count : 0;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserLeftRightCarry($user_id) {
        $user_carry['user_L_carry'] = $user_carry['user_R_carry'] = $user_carry['user_R'] = $user_carry['user_L'] = 0;
        $query = $this->db->select('user_L_carry, user_R_carry, user_R, user_L')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $user_carry['user_L_carry'] = $query->row()->user_L_carry;
            $user_carry['user_R_carry'] = $query->row()->user_R_carry;
            $user_carry['user_L'] = $query->row()->user_L;
            $user_carry['user_R'] = $query->row()->user_R;
        }
        return $user_carry;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserDefaultLeg($id) {
        $default_leg = '';
        $query = $this->db->select('default_leg')
                ->from('user')
                ->where('mlm_user_id', $id)
                ->get();
        if ($query->num_rows() > 0) {
            $default_leg = $query->row()->default_leg;
        }
        return $default_leg;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function updateDefaultLeg($id, $leg) {
        $this->db->set('default_leg', $leg)
                ->where('mlm_user_id ', $id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getPaymentMethodStatus($code) {
        $flag = FALSE;
        $query = $this->db->select("status")
                ->where("code", $code)
                ->limit(1)
                ->get('payment_methods');
        if ($query->num_rows() > 0) {
            if ($query->row()->status == "active") {
                $flag = TRUE;
            }
        }
        return $flag;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllCountries() {
        $data = array();
        $query = $this->db->select("id,country_name")
                ->from("countries")
                ->where("status", '1')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['name'] = lang($row['country_name']);
            $data[$i]['id'] = $row['id'];
            $i++;
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllStates($country_id) {
        $data = array();
        $query = $this->db->select("id,state_name")
                ->from("states")
                ->where("status", '1')
                ->where('country_id', $country_id)
                ->get();

        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['name'] = lang($row['state_name']);
            $data[$i]['id'] = $row['id'];
            $i++;
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserDp($user_id) {
        $user_dp = 'no_user.jpg';
        $query = $this->db->select("user_dp")
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get("user_details");
        if ($query->num_rows() > 0) {
            $user_dp = $query->row()->user_dp;
        }

        return $user_dp;
    }



    public function getCompanyAddress() {
        $address = '';
        $query = $this->db->select("company_address")
                ->get("site_info");
        if ($query->num_rows() > 0) {
            $address = $query->row()->address;
        }

        return $address;
    }



    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function generateRandomString($size = 15) {
        $this->load->helper('string');
        return random_string('alnum', $size);
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUplineFathersOnLevel($user_id, $level = null) {
        $level_father = NULL;
        $this->db->select('path');
        $this->db->where('user_id', $user_id);
        $this->db->where('level', $level);
        $query = $this->db->get('traverse_father');
        if ($query->num_rows() > 0) {
            $level_father = $query->row()->path;
        }
        return $level_father;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUplineUpdateValue($type, $package_id) {
        $return_value = 0;
        if ($this->dbvars->OC_STATUS > 0 && 0) {
            $type = 'pv';
            if ($type == 'product_amount')
                $type = 'price';
            $query = $this->db->select("$type")
                    ->where('product_id', $package_id)
                    ->limit(1)
                    ->get('oc_product');
            if ($query->num_rows() > 0) {
                $return_value = $query->row()->$type;
            }
        } else {
            $query = $this->db->select("$type")
                    ->where('id', $package_id)
                    ->limit(1)
                    ->get('products');
            if ($query->num_rows() > 0) {
                $return_value = $query->row()->$type;
            }
        }
        return $return_value;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUplineWithGenerationRank($user_id) {
        $upline_sponsor = array();
        if ($user_id != $this->getAdminId()) {
            $this->db->select('path, user.user_rank_id');
            $this->db->where('user_id', $user_id);
            $this->db->from('traverse_sponsor');
            $this->db->join('user', 'traverse_sponsor.path = user.mlm_user_id', 'inner');
            $this->db->where('user.user_rank_id >=', 2);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $upline_sponsor['user_id'] = $query->row()->path;
                $upline_sponsor['rank_id'] = $query->row()->user_rank_id;
            }
        }
        return $upline_sponsor;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getPayoutMinMaxAmount() {
        $details = array();
        $query = $this->db->select('payout_min, payout_max,payout_cut_off_balance,automatic_payout_status,payout_transation_charges,time_limit1,time_limit2,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday')
                ->get('configuration');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $details['payout_min'] = $row['payout_min'];
                $details['payout_max'] = $row['payout_max'];
                $details['payout_cut_off_balance'] = $row['payout_cut_off_balance'];
                $details['automatic_payout_status'] = $row['automatic_payout_status'];
                $details['payout_transation_charges'] = $row['payout_transation_charges'];
                $details['time_limit1'] = $row['time_limit1'];
                $details['time_limit2'] = $row['time_limit2'];
                $details['Sunday'] = $row['Sunday'];
                $details['Monday'] = $row['Monday'];
                $details['Tuesday'] = $row['Tuesday'];
                $details['Wednesday'] = $row['Wednesday'];
                $details['Thursday'] = $row['Thursday'];
                $details['Friday'] = $row['Friday'];
                $details['Saturday'] = $row['Saturday'];
            }
        }
        return $details;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getAllActivePurchases($user_id) {
        $date = date('Y-m-d') . " 23:59:59";
        $product_array = array();
        $query = $this->db->select('order_products.product_id, order_products.category_id,order_products.amount')
                ->join('orders', 'orders.id = order_products.order_id', 'right')
                ->where('orders.user_id', $user_id)
                ->where('order_products.expiry_date >=', $date)
                ->get('order_products');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $product_array[] = $row;
            }
        }
        return $product_array;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function addInvestmentBalance($field_name, $user_id, $amount) {

        $result = false;
        $query = $this->db->set($field_name, 'ROUND(' . $field_name . ' +' . $amount . ',8)', FALSE)
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->update('investment_user_balance');
        if ($this->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function updateInvestmentHistory($user_id, $pay_amount, $pay_pack_id, $package_pay_category_id) {
        $result = false;
        if ($package_pay_category_id > 0) {
            $query = $this->db->set('mlm_user_id', $user_id)
                    ->set('pay_amount', $pay_amount)
                    ->set('product_id', $pay_pack_id)
                    ->set('category_id', $package_pay_category_id)
                    ->set('date', date('Y-m-d H:i:s'))
                    ->insert('investment_history');
            if ($this->db->affected_rows() > 0) {
                $field_name = $package_pay_category_id . "_balance_amount";
                $result = $this->addInvestmentBalance($field_name, $user_id, $pay_amount);
            }
        }
        return $result;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getCountryName($id) {
        $country_name = '';
        $query = $this->db->select('country_name')
                ->where('id', $id)
                ->limit(1)
                ->get('countries');
        if ($query->num_rows() > 0) {
            $country_name = lang($query->row()->country_name);
        }
        return $country_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getStateName($id) {
        $state_name = lang('na');
        $query = $this->db->select('state_name')
                ->where('id', $id)
                ->limit(1)
                ->get('states');
        if ($query->num_rows() > 0) {
            $state_name = lang($query->row()->state_name);
        }
        return $state_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function addNewLanguageField($user_id, $field_name, $in_english) {
        $this->db->set('mlm_user_id', $user_id)
                ->set('field_name', $field_name)
                ->set('in_english', $in_english)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('language_conversion');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function safe_encode($string) {
        return urlencode(strtr(base64_encode($string), '+/=', '-_-'));
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function safe_decode($encode_data) {
        return base64_decode(strtr(urldecode($encode_data), '-_-', '+/='));
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserLCPLink($user_name) {
        return BASE_PATH . 'user-lead/' . $user_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserReplicaLink($user_name) {
        return BASE_PATH . 'replicate-site/' . $user_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserRefLink($user_id) {
        $encoded_id = $this->encode($user_id);
        return BASE_PATH . $this->dbvars->REG_MODE . '/' . $encoded_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function updateEmailVerfication($user_id, $code) {
        $this->db->set('verification_code ', $code)
                ->set('banned', 1)
                ->where('mlm_user_id', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @return
     */
    public function insertWalletDetails($user_id, $type = 'credit', $amount = '0', $wallet_type = '', $from_user = 0, $done_by = 0, $data = array(), $transaction_fee = 0, $bonus_type = 0, $wallet_b_transfer = 0) {
        $original_amount = $amount;

        /* Multi Wallet Calculation */
        $multi_wallet_status = $this->dbvars->MULTIPLE_WALLET_STATUS;
        if ($wallet_b_transfer) {
            $amount1 = 0;
            $amount2 = $amount;
        } else if ($multi_wallet_status && $type == 'credit' && $bonus_type) {
            $wallet_percentage = $this->getMultiwalletPercentage();
            $amount1 = $amount * $wallet_percentage['wallet_a'] / 100;
            $amount2 = $amount * $wallet_percentage['wallet_b'] / 100;
        } else {
            $amount1 = $amount;
            $amount2 = 0;
        }

        /* Tax Calculation */
        $tax_amount = $tax_amount1 = $tax_amount2 = 0;
        if ($this->dbvars->TAX_STATUS && $type == 'credit' && $bonus_type) {
            $tax = $this->getTaxValues();
            if ($tax['tax'] > 0) {
                if ($tax['tax_type'] == 'percentage') {
                    $tax_amount = $tax_amount1 = $amount1 * $tax['tax'] / 100;
                    $amount1 -= $tax_amount;
                } else {
                    $tax_amount = $tax_amount1 = $tax['tax'];
                    $amount1 -= $tax_amount;
                }
            }
        }
        return $this->addUserWalletDetails($user_id, $type, $original_amount, $amount1, $amount2, $wallet_type, $from_user, $done_by, $tax_amount, $tax_amount1, $tax_amount2, $transaction_fee, $data, $bonus_type);
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @return
     */
    public function addUserWalletDetails($user_id, $type, $original_amount, $amount1 = 0, $amount2 = 0, $wallet_type = '', $from_user = 0, $done_by = 0, $tax = 0, $tax1 = 0, $tax2 = 0, $transaction_fee = 0, $data=array(), $bonus_type = 0) {
        $flag = FALSE;
        $credited_amount = $amount1;
        if ($transaction_fee > 0) {
            $credited_amount = $amount1 - $transaction_fee;
        }

        if ($amount2 < 0) {
            $amount2 = 0;
        }
        $res = $this->db->set('mlm_user_id', $user_id)
                ->set('from_user', $from_user)
                ->set('type', $type)
                ->set('transation_id', 'TR-' . $this->generateRandomString(5))
                ->set('original_amount', $original_amount)
                ->set('amount1', $credited_amount)
                ->set('amount2', $amount2)
                ->set('wallet_type', $wallet_type)
                ->set('done_by', $done_by)
                ->set('transation_charges', $transaction_fee)
                ->set('tax_amount', $tax)
                ->set('tax1', $tax1)
                ->set('tax2', $tax2)
                ->set('date', date("Y-m-d H:i:s"))
                ->set('data', serialize($data))
                ->set('bonus_flag', $bonus_type)
                ->insert('wallet_details');
        if ($res) {
            $this->load->model('send_mail_model');
            $mail_data = array();
            $mail_data['amount'] = $credited_amount;
            $mail_data['amount_type'] = $wallet_type;
            $mail_data['from_user'] = $from_user;

            if ($type == 'credit') {
                $flag = $this->addBalance($user_id, $credited_amount, $amount2);
                $this->send_mail_model->send($user_id, '', 'fund_credit', $mail_data);
            } else {
                $flag = $this->deductBalance($user_id, $amount1, $amount2);
                $this->send_mail_model->send($user_id, '', 'fund_debit', $mail_data);
            }
            return $flag;
        }
        return $flag;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function addBalance($user_id, $amount, $amount2 = 0) {
        $this->db->set('balance_amount', 'ROUND(balance_amount +' . $amount . ',8)', FALSE);
        $this->db->set('total_amount', 'ROUND(total_amount +' . $amount . ',8)', FALSE);
        if ($amount2 > 0) {
            $this->db->set('user_wallet_two', 'ROUND(user_wallet_two +' . $amount2 . ',8)', FALSE);
        }
        $this->db->where('mlm_user_id', $user_id);
        $this->db->limit(1);
        $this->db->update('user_balance');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function deductBalance($user_id, $amount, $amount2) {
        $this->db->set('balance_amount', 'ROUND(balance_amount -' . $amount . ',8)', FALSE)
                ->set('released_amount', 'ROUND(released_amount +' . $amount . ',8)', FALSE);
        if ($amount2 > 0) {
            $this->db->set('user_wallet_two', 'ROUND(user_wallet_two -' . $amount2 . ',8)', FALSE);
        }
        $this->db->where('mlm_user_id', $user_id)
                ->limit(1)
                ->update('user_balance');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTaxValues() {
        $data = array();
        $query = $this->db->select("tax,tax_type")
                ->from("configuration")
                ->get();
        if ($query->num_rows() > 0) {
            $data['tax_type'] = $query->row()->tax_type;
            $data['tax'] = $query->row()->tax;
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getMultiwalletPercentage() {
        $muti_per = array();
        $query = $this->db->select('wallet_a, wallet_b')
                ->get('configuration');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $muti_per['wallet_a'] = $row['wallet_a'];
                $muti_per['wallet_b'] = $row['wallet_b'];
            }
        }
        return $muti_per;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserLang($user_id) {
        $query = $this->db->select('language')
                ->from('user')
                ->where('mlm_user_id', $user_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->language;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTermsAndCondition($lang_id) {
        $query = $this->db->select('terms_condition')
                ->from('languages')
                ->where('id', $lang_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->terms_condition;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getPrivacyPolicy($lang_id) {
        $query = $this->db->select('privacy_policy')
                ->from('languages')
                ->where('id', $lang_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->privacy_policy;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getLangNameToId($lang_code) {
        $query = $this->db->select('id')
                ->from('languages')
                ->where('lang_code', $lang_code)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getInvestCategoryId($pro_id) {
        $cat_id = 0;
        if ($this->dbvars->INVESTMENT_CATEGORY == 'crypto' && $this->dbvars->INVESTMENT_STATUS > 0) {
            $query = $this->db->select('inv_cat')
                    ->where('id', $pro_id)
                    ->limit(1)
                    ->get('products');
            foreach ($query->result() as $val) {
                if ($val->inv_cat > 0) {
                    $cat_id = $val->inv_cat;
                }
            }
        }

        return $cat_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getInvestAmount($pro_id) {
        $investment_amount = 0;
        $query = $this->db->select('investment_amount')
                ->where('id', $pro_id)
                ->limit(1)
                ->get('products');
        foreach ($query->result() as $val) {
            $investment_amount = $val->investment_amount;
        }
        return $investment_amount;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getInvestExpiry($pro_id) {
        $expiry_date = date("Y-m-d H:i:s");
        $query = $this->db->select('expiry_date')
                ->where('id', $pro_id)
                ->limit(1)
                ->get('products');
        if ($query->num_rows() > 0) {
            $date = $query->row()->expiry_date;
            if ($date > 0) {
                $expiry_date = date('Y-m-d', strtotime("+$date days"));
            }
        }
        return $expiry_date;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserIdFromOrder($order_id) {
        $query = $this->db->select('user_id')
                ->from('orders')
                ->where('id', $order_id)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->row()->user_id;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function updateSalesCount($pro_id, $count) {
        $res = false;
        if ($count > 0) {
            $res = $this->db->set('sales_count', 'sales_count +' . $count, FALSE)
                    ->set('quantity', 'quantity -' . $count, FALSE)
                    ->where('id', $pro_id)
                    ->update('products');
        }
        return $res;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTopSales() {
        $total = 0;
        $i = 0;
        $data = array();
        $query = $this->db->select('product_name, sales_count')
                ->limit(3)
                ->order_by('sales_count', 'DESC')
                ->where('sales_count >', 0)
                ->get('products');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result_array() as $row) {
                $data[$i]['label'] = $row['product_name'];
                $data[$i]['value'] = $row['sales_count'];
                $total += $row['sales_count'];
                $i++;
            }
        }
        $data[$i]['label'] = lang('others');
        $data[$i]['value'] = $this->getTotalSalesCount() - $total;
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTotalSalesCount() {
        $sales_count = 0;
        $query = $this->db->select_sum('sales_count')
                ->get('products');
        if ($query->num_rows() > 0 && $query->row()->sales_count != '') {
            $sales_count = $query->row()->sales_count;
        }
        return $sales_count;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getGraph1DataOld($user_id) {
        $currency_symbol = $this->dbvars->DEFAULT_SYMBOL_LEFT . $this->dbvars->DEFAULT_SYMBOL_RIGHT;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_symbol = $this->main->get_usersession('mlm_data_currency', 'symbol_left') . $this->main->get_usersession('mlm_data_currency', 'symbol_right');
        }

        $downlines = $this->getDownlinesUnilevel($user_id);
        $graph_data = array();
        $date = date('Y-m-d', strtotime('today - 29 days'));
        for ($i = 0; $i < 31; $i++) {
            $graph_data[$i]['date'] = $date;
            $graph_data[$i]['value1'] = $this->getDownlineJoins($date, $downlines); //joins
            $graph_data[$i]['value2'] = $this->getDownlineSales($user_id, $date, $downlines); //sales
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $data = array();
        $data['graph'] = $graph_data;
        $data['key1'] = lang('joins');
        $data['key2'] = lang('sales');
        $data['currency'] = $currency_symbol;
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getDownlineJoins($date, $downlines) {
        $count = 0;
        foreach ($downlines as $user) {
            $join_date = date('Y-m-d', strtotime($this->getJoiningDate($user)));
            if ($join_date == $date) {
                $count++;
            }
        }
        return $count;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getDownlineSales($user_id, $date, $downlines) {
        $sales_amount = $this->getUsersDailyPurchaseTotal($user_id, $date);
        foreach ($downlines as $user) {
            $sales_amount += $this->getUsersDailyPurchaseTotal($user, $date);
        }
        return $this->currency_conversion($sales_amount, 1);
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUsersDailyPurchaseTotal($user_id, $date) {
        $sales = 0;
        $query = $this->db->select_sum('total_amount')
                ->where('user_id', $user_id)
                ->where('order_status', 1)
                ->like('confirm_date', $date, 'after')
                ->get('orders');
        if ($query->num_rows() > 0 && $query->row()->total_amount > 0) {
            $sales = $query->row()->total_amount;
        }
        return $this->currency_conversion($sales, 1);
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUsersDailyCreditTotal($user_id, $date) {
        $credits = 0;
        $query = $this->db->select_sum('amount1')
                ->where('mlm_user_id', $user_id)
                ->like('date', $date, 'after')
                ->get('wallet_details');
        if ($query->num_rows() > 0 && $query->row()->amount1 > 0) {
            $credits = $query->row()->amount1;
        }
        return $this->currency_conversion($credits, 1);
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUsersDailyReferrals($user_id, $date) {
        return $this->db->select('mlm_user_id')
                        ->from("user")
                        ->where('sponsor_id', $user_id)
                        ->like('date', $date, 'after')
                        ->count_all_results();
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getSparklineData($user_id) {
        $data = array();
        $sales = '';
        $date = date('Y-m-d', strtotime('today - 6 days'));
        for ($i = 0; $i < 7; $i++) {
            $data['day' . $i] = lang(date("D", strtotime($date)));
            $data['sales' . $i] = $this->getUsersDailyPurchaseTotal($user_id, $date);
            $data['credits' . $i] = $this->getUsersDailyCreditTotal($user_id, $date);
            $data['referrals' . $i] = $this->getUsersDailyReferrals($user_id, $date);

            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $data['sales_data'] = $sales;
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getDownUsersUnilevelsale($user_id, $start_date = '', $end_date = '') {
        $this->down_unilevel = array();
        $down_sales = $this->getUserSale($user_id);
        $this->down_unilevel = $this->getDownlinesUnilevel($user_id);
        if (!empty($this->down_unilevel)) {
            foreach ($this->down_unilevel as $row) {
                $sales = 0;
                $this->db->select_sum('total_amount')
                        ->where('user_id', $row);
                if ($start_date != '' && $end_date != '') {
                    $this->db->where('confirm_date >=', $start_date)
                            ->where('confirm_date <=', $end_date);
                }
                $this->db->where('order_status', 1);
                $query = $this->db->get('orders');
                if ($query->num_rows() > 0) {
                    $sales = $query->row()->total_amount;
                }
                $down_sales += $sales;
            }
        }
        return $down_sales;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserSale($user_id, $start_date = '', $end_date = '') {
        $down_sales = 0;
        $this->db->select_sum('total_amount')
                ->where('user_id', $user_id);
        if ($start_date != '' && $end_date != '') {
            $this->db->where('confirm_date >=', $start_date);
            $this->db->where('confirm_date <=', $end_date);
        }
        $this->db->where('order_status', 1);
        $query = $this->db->get('orders');
        if ($query->num_rows() > 0) {
            $down_sales = $query->row()->total_amount;
        }
        return $down_sales ? $down_sales : 0;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function currency_conversion($amount = 0, $amount_only = 0) {
        $round = $this->dbvars->AMOUNT_ROUND_VALUE;
        $user_id = $this->aauth->getId();
        if ($user_id && $this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $value = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
            $left = $this->main->get_usersession('mlm_data_currency', 'symbol_left');
            $right = $this->main->get_usersession('mlm_data_currency', 'symbol_right');
        } else {
            $value = $this->dbvars->DEFAULT_CURRENCY_VALUE;
            $left = $this->dbvars->DEFAULT_SYMBOL_LEFT;
            $right = $this->dbvars->DEFAULT_SYMBOL_RIGHT;
        }
        $con_amount = round($amount * $value, $round);
        if ($amount_only) {
            return $con_amount;
        } else {
            return $left . ' ' . $con_amount . ' ' . $right;
        }
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getARegPro() {
        $id = '';
        $query = $this->db->select('id')
                ->where('product_type', 'register')
                ->limit(1)
                ->order_by('id', 'RANDOM')
                ->get('products');
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
        }
        return $id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function insertTodayCurrencyValues() {
        $data = array();
        $res = $this->db->select("currency_code,currency_ratio")
                ->from("currencies")
                ->get();
        foreach ($res->result() as $row) {
            $this->db->set('code', $row->currency_code)
                    ->set('value', $row->currency_ratio)
                    ->set('date', date("Y-m-d H:i:s"))
                    ->insert('currency_values');
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getRankIBydName($rank_id) {
        $rank_name = '';
        $query = $this->db->select('rank_name')
                ->where('id', $rank_id)
                ->limit(1)
                ->get('rank');
        if ($query->num_rows() > 0) {
            $rank_name = $query->row()->rank_name;
        }
        return $rank_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getLastInsertId() {
        $query = $this->db->select_max('mlm_user_id')
                ->get('user');
        if ($query->num_rows() > 0) {
            return $query->row()->mlm_user_id;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function insertAffiliateActivity($affiliate_id, $activity, $data = array(), $icon = 'fa-bolt', $text_color = 'blue') {
        $ip_address = $this->getUserIP();
        if ($this->dbvars->PRESET_DEMO_STATUS > 0) {
            if ($ip_address == '103.243.47.198') {
                $ip_address = '185.38.92.101';
            }
        }

        $result = array();
        $country_name = $region_name = $city = '';
        $location_status = 0;
        if ($this->dbvars->GEO_LOCATION_STATUS > 0) {
            $result = json_decode(file_get_contents("http://ip-api.io/json/$ip_address"));
            if ($result) {
                $country_name = $result->country_name;
                $region_name = $result->region_name;
                $city = $result->city;
                $location_status = 1;
            }
        }
        $this->db->set('affiliate_id', $affiliate_id)
                ->set('activity', $activity)
                ->set('ip_address', $ip_address)
                ->set('user_agent', $this->getUserAgent())
                ->set('date', date("Y-m-d H:i:s"))
                ->set('data', serialize($data))
                ->set('text_color', $text_color)
                ->set('icon', $icon)
                ->set('country', $country_name)
                ->set('region', $region_name)
                ->set('city', $city)
                ->set('location_details', serialize($result))
                ->set('location_status', $location_status)
                ->insert('affiliate_activity');
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function autoRegisterArray() {
        $data = array();
        $data['password'] = '123123';
        $data['first_name'] = 'Lead';
        $data['last_name'] = 'User';
        $data['country'] = '99';
        $data['state'] = '1428';
        $data['address'] = '445 Mount Eden Road';
        $data['city'] = 'Delhi';
        $data['zip_code'] = '673458';
        $data['placement_username'] = '';
        $data['reg_amount'] = $this->dbvars->ENTRI_FEE;
        $data['order_amount'] = $this->dbvars->DELIVARY_CHARGE + $this->dbvars->SHIPPING_CHARGE + $this->dbvars->PURCHASE_TAX;
        $data['date_of_joining'] = date('Y-m-d H:i:s');
        $data['password'] = '010101';
        $data['del_data_type'] = 'same';
        $data['total_amount_data'] = array('entree_fee' => $this->dbvars->ENTRI_FEE, 'pro_amount' => 0, 'delivery_charge' => $this->dbvars->DELIVARY_CHARGE, 'shipping_charge' => $this->dbvars->SHIPPING_CHARGE, 'tax' => $this->dbvars->PURCHASE_TAX);

        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAffiliateEmailId($affiliate_id) {
        $query = $this->db->select('email')
                ->from('affiliates')
                ->where('id', $affiliate_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->email;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function validateCouponCode($user_id, $coupon_code) {
        return $this->db->select('id')
                        ->from("affiliate_coupons")
                        ->where('mlm_user_id', $user_id)
                        ->where('coupon_code', $coupon_code)
                        ->where('status', 1)
                        ->where('coupon_amount >', 0)
                        ->count_all_results();
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getCouponAmount($coupon_code) {
        $query = $this->db->select('coupon_amount')
                ->from('affiliate_coupons')
                ->where('coupon_code', $coupon_code)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->row()->coupon_amount;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function userNameToEmpID($username, $all = 0) {
        $user_id = 0;
        $this->db->select('employee_id')
                ->where('user_name', $username);
        if (!$all)
            $this->db->where('status', 1);
        $query = $this->db->limit(1)
                ->get('employee_login');
        //  echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->employee_id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function userNameToAffID($username, $all = 0) {
        $user_id = 0;
        $this->db->select('id')
                ->where('username', $username);
        if (!$all)
            $this->db->where('status', 1);
        $query = $this->db->limit(1)
                ->get('affiliates');
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getLoggedUserFullName($user_id, $user_type) {
        if ($user_type == 'admin' || $user_type == 'user') {
            $query = $this->db->select('CONCAT(first_name ,"  ", last_name) as full_name')
                    ->from('user_details')
                    ->where('mlm_user_id', $user_id)
                    ->get();
            if ($query->num_rows() > 0) {
                return $query->row()->full_name;
            }
            return false;
        } elseif ($user_type == 'employee') {
            $query = $this->db->select('CONCAT(first_name ,"  ", last_name) as full_name')
                    ->from('employee_details')
                    ->where('employee_id', $user_id)
                    ->get();
            if ($query->num_rows() > 0) {
                return $query->row()->full_name;
            }
            return false;
        } elseif ($user_type == 'affiliate') {
            $query = $this->db->select('CONCAT(first_name ,"  ", last_name) as full_name')
                    ->from('affiliates')
                    ->where('id', $user_id)
                    ->get();
            if ($query->num_rows() > 0) {
                return $query->row()->full_name;
            }
            return false;
        }
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function employeeUsernameOrEmailToId($credential) {
        $user_id = 0;
        $query = $this->db->select('el.employee_id')
                ->from('employee_login as el')
                ->join('employee_details as ed', 'ed.employee_id=el.employee_id', 'INNER')
                //  ->where("(el.user_name = '$credential' OR ed.email = '$credential') ")
                ->where("el.user_name", "$credential")
                ->or_where("ed.email", "$credential")
                ->where('el.status', 1)
                ->get();
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->employee_id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function employeeIdToUsername($employee_id) {

        $query = $this->db->select('user_name')
                ->from('employee_login')
                ->where('employee_id', $employee_id)
                ->where('status', 1)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->user_name;
        }
        return false;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function affiliateUserNameToID($username) {
        $user_id = 0;
        $query = $this->db->select('id as affiliate_id')
                //->where("(username = '$username' OR email = '$username') ")
                ->where("username", "$username")
                ->or_where("email", "$username")
                ->limit(1)
                ->get('affiliates');
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->affiliate_id;
        }
        return $user_id;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function affiliateToIDUserName($affiliate_id) {
        $username = 0;
        $query = $this->db->select('username')
                ->where('id', $affiliate_id)
                ->limit(1)
                ->get('affiliates');
        if ($query->num_rows() > 0) {
            $username = $query->row()->username;
        }
        return $username;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getAdminMailId() {
        $email = '';
        $query = $this->db->select('email')
                ->where('user_type', 'admin')
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $email = $query->row()->email;
        }
        return $email;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getPaypalCredentials() {
        $data = array();
        $query = $this->db->select('paypal_api_username,paypal_api_password,paypal_signater,paypal_production')
                ->where('id', 1)
                ->limit(1)
                ->get('payment_config');
        if ($query->num_rows() > 0) {
            $data['paypal_api_username'] = $query->row()->paypal_api_username;
            $data['paypal_api_password'] = $query->row()->paypal_api_password;
            $data['paypal_signature'] = $query->row()->paypal_signater;
            $data['paypal_production'] = $query->row()->paypal_production;
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function addBlockTrailPaymentData($email, $pending_id, $data = array(), $time_stamp='') {
        $this->db->set('email_id', $email)
                ->set('pending_id', $pending_id)
                ->set('address', $data['addr'])
                ->set('data', serialize($data))
                ->set('timestamp', $time_stamp)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('blocktrail_payment');
        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function updateBlockTrailPaymentData($response, $id, $tran_address, $tran_amount) {
        $confirm = $this->checkAmountAgainstAddress($id, $tran_address, $tran_amount);
        if ($confirm) {
            $this->db->set('response', serialize($response))
                    ->set('status', 1)
                    ->where('id', $id)
                    ->update('blocktrail_payment');
            if ($this->db->affected_rows()) {
                return TRUE;
            }
        } else {
            $this->db->set('response', serialize($response))
                    ->set('status', 2)
                    ->where('id', $id)
                    ->update('blocktrail_payment');
        }

        return FALSE;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function checkAmountAgainstAddress($id, $tran_address, $tran_amount) {
        $query = $this->db->select('data')
                ->where('address', $tran_address)
                ->where('id', $id)
                ->where('status', 0)
                ->get('blocktrail_payment');
        if ($query->num_rows() > 0) {
            $un_serial = unserialize($query->row()->data);

            if ($un_serial['addr'] == $tran_address AND $un_serial['pay_amount'] <= $tran_amount)
                return TRUE;
        }
        return FALSE;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getBlockTrailCredentials() {
        $data = array();
        $query = $this->db->select('blocktrail_api_key,blocktrail_api_secret,blocktrail_wallet_identifier,blocktrail_wallet_pass,blocktrail_production')
                ->where('id', 1)
                ->limit(1)
                ->get('payment_config');
        if ($query->num_rows() > 0) {
            $data['api_key'] = $query->row()->blocktrail_api_key;
            $data['api_secret'] = $query->row()->blocktrail_api_secret;
            $data['wallet_identifier'] = $query->row()->blocktrail_wallet_identifier;
            $data['wallet_password'] = $query->row()->blocktrail_wallet_pass;
            $data['blocktrail_production'] = $query->row()->blocktrail_production;
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getPendingIdBlocktrail($id, $address) {
        $query = $this->db->select('pending_id')
                ->where('id', $id)
                ->where('address', $address)
                ->get('blocktrail_payment');
        if ($query->num_rows() > 0) {
            return $query->row()->pending_id;
        }
        return FALSE;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function checkUserActivity($change_user) {
        $message = array();
        $purchase_details = $this->getAllActivePurchases($change_user);
        if (count($purchase_details) > 0) {
            $message['status'] = 'false';
            $message['msg'] = lang('user_has_an_active_purchase_position_change_not_possible');
            return $message;
        }

        if ($this->getDownlinesUnilevel($change_user) > 0 || $this->getDownlinesBinary($change_user) > 0) {
            $message['status'] = 'false';
            $message['msg'] = lang('user_has_down_line_users_position_change_not_possible');
            return $message;
        }

        if ($this->getUserLifeTimeBalance($change_user) > 0) {
            $message['status'] = 'false';
            $message['msg'] = lang('user_has_done_some_transaction_in_the_system_position_change_not_possible');
            return $message;
        }
        $message['status'] = 'true';
        $message['msg'] = lang('allow_position_change');
        return $message;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getUserLifeTimeBalance($user_id) {
        $balance_amount = 0;
        $query = $this->db->select('total_amount')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_balance');
        if ($query->num_rows() > 0) {
            $balance_amount = $query->row()->total_amount;
        }
        return $balance_amount;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return Username
     */
    public function getRandomUsername($admin_name = '') {
        $user_name = $admin_name;
        $query = $this->db->select('user_name')
                ->limit(1)
                ->order_by('id', 'RANDOM')
                ->get('user');
        if ($query->num_rows() > 0) {
            $user_name = $query->row()->user_name;
        }
        return $user_name;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return Yearly Joining Count
     */
    public function getSparkline4Data($user_id = '') {
        $data = array();
        for ($m = 1; $m <= 12; $m++) {
            $date = date('Y-m', strtotime(date('Y') . '-' . $m));
            if (date('m') < $m) {
                $data['month_' . $m] = 0;
            } else {
                $data['month_' . $m] = $this->getUserCounts($date, $user_id);
            }
        }
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return Yearly Joining Count
     */
    public function getUserCounts($date = '', $user_id = '') {
        $this->db->select('mlm_user_id')
                ->from("user")
                ->where('user_type', 'user');
        if ($date) {
            $this->db->like('date', $date);
        }
        if ($user_id) {
            $this->db->where('sponsor_id', $user_id);
        }
        return $this->db->count_all_results();
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return Mobile Number with Country code
     */
    public function getCompleteMobileNumber($user_id) {
        $country_id = $phone_number = $phone_code = '';
        $query = $this->db->select('phone_number,country_id')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_details');
        if ($query->num_rows() > 0) {
            $phone_number = $query->row()->phone_number;
            $country_id = $query->row()->country_id;
        }

        $query = $this->db->select('phone_code')
                ->where('id', $country_id)
                ->limit(1)
                ->get('countries');
        if ($query->num_rows() > 0) {
            $phone_code = $query->row()->phone_code;
        }

        return $phone_code . $phone_number;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return Bulk sms Response
     */
    public function bulkSMS($mobile_no, $message) {
        $flag = array();
        $username = $this->dbvars->BULKSMS_USERNAME;
        $password = $this->dbvars->BULKSMS_PASSWORD;
        $msisdn = $mobile_no;
        $url = 'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
        $seven_bit_msg = $message;
        $post_body = $this->seven_bit_sms($username, $password, $seven_bit_msg, $msisdn);
        $result = $this->send_message($post_body, $url);
        $flag['response'] = $result;
        if ($result['success']) {
            $flag['status'] = TRUE;
            $flag['formatted_response'] = $this->formatted_server_response($result);
        } else {
            $flag['status'] = FALSE;
            $flag['formatted_response'] = $this->formatted_server_response($result);
            $flag['mobile_no'] = $mobile_no;
            $flag['message'] = $message;
            $this->insertFailedActivity('1111', 'bulk_sms_failed', $flag);
        }
        return $flag;
    }

    public function seven_bit_sms($username, $password, $message, $msisdn) {
        $post_fields = array(
            'username' => $username,
            'password' => $password,
            'message' => $this->character_resolve($message),
            'msisdn' => $msisdn,
            'allow_concat_text_sms' => 0, # Change to 1 to enable long messages
            'concat_text_sms_max_parts' => 2
        );

        return $this->make_post_body($post_fields);
    }

    public function character_resolve($body) {
        $special_chrs = array(
            'Δ' => '0xD0', 'Φ' => '0xDE', 'Γ' => '0xAC', 'Λ' => '0xC2', 'Ω' => '0xDB',
            'Π' => '0xBA', 'Ψ' => '0xDD', 'Σ' => '0xCA', 'Θ' => '0xD4', 'Ξ' => '0xB1',
            '¡' => '0xA1', '£' => '0xA3', '¤' => '0xA4', '¥' => '0xA5', '§' => '0xA7',
            '¿' => '0xBF', 'Ä' => '0xC4', 'Å' => '0xC5', 'Æ' => '0xC6', 'Ç' => '0xC7',
            'É' => '0xC9', 'Ñ' => '0xD1', 'Ö' => '0xD6', 'Ø' => '0xD8', 'Ü' => '0xDC',
            'ß' => '0xDF', 'à' => '0xE0', 'ä' => '0xE4', 'å' => '0xE5', 'æ' => '0xE6',
            'è' => '0xE8', 'é' => '0xE9', 'ì' => '0xEC', 'ñ' => '0xF1', 'ò' => '0xF2',
            'ö' => '0xF6', 'ø' => '0xF8', 'ù' => '0xF9', 'ü' => '0xFC',
        );

        $ret_msg = '';
        if (mb_detect_encoding($body, 'UTF-8') != 'UTF-8') {
            $body = utf8_encode($body);
        }
        for ($i = 0; $i < mb_strlen($body, 'UTF-8'); $i++) {
            $c = mb_substr($body, $i, 1, 'UTF-8');
            if (isset($special_chrs[$c])) {
                $ret_msg .= chr($special_chrs[$c]);
            } else {
                $ret_msg .= $c;
            }
        }
        return $ret_msg;
    }

    public function make_post_body($post_fields) {
        $stop_dup_id = $this->make_stop_dup_id();
        if ($stop_dup_id > 0) {
            $post_fields['stop_dup_id'] = $this->make_stop_dup_id();
        }
        $post_body = '';
        foreach ($post_fields as $key => $value) {
            $post_body .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $post_body = rtrim($post_body, '&');

        return $post_body;
    }

    public function make_stop_dup_id() {
        return 0;
    }

    public function send_message($post_body, $url) {
        /*
         * Do not supply $post_fields directly as an argument to CURLOPT_POSTFIELDS,
         * despite what the PHP documentation suggests: cUrl will turn it into in a
         * multipart formpost, which is not supported:
         */

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
        // Allowing cUrl funtions 20 second to execute
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        // Waiting 20 seconds while trying to connect
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);

        $response_string = curl_exec($ch);
        $curl_info = curl_getinfo($ch);

        $sms_result = array();
        $sms_result['success'] = 0;
        $sms_result['details'] = '';
        $sms_result['transient_error'] = 0;
        $sms_result['http_status_code'] = $curl_info['http_code'];
        $sms_result['api_status_code'] = '';
        $sms_result['api_message'] = '';
        $sms_result['api_batch_id'] = '';

        if ($response_string == FALSE) {
            $sms_result['details'] .= "cURL error: " . curl_error($ch) . "\n";
        } elseif ($curl_info['http_code'] != 200) {
            $sms_result['transient_error'] = 1;
            $sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info['http_code'] . "\n";
        } else {
            $sms_result['details'] .= "Response from server: $response_string\n";
            $api_result = explode('|', $response_string);
            $status_code = $api_result[0];
            $sms_result['api_status_code'] = $status_code;
            $sms_result['api_message'] = $api_result[1];
            if (count($api_result) != 3) {
                $sms_result['details'] .= "Error: could not parse valid return data from server.\n" . count($api_result);
            } else {
                if ($status_code == '0') {
                    $sms_result['success'] = 1;
                    $sms_result['api_batch_id'] = $api_result[2];
                    $sms_result['details'] .= "Message sent - batch ID $api_result[2]\n";
                } else if ($status_code == '1') {
                    # Success: scheduled for later sending.
                    $sms_result['success'] = 1;
                    $sms_result['api_batch_id'] = $api_result[2];
                } else {
                    $sms_result['details'] .= "Error sending: status code [$api_result[0]] description [$api_result[1]]\n";
                }
            }
        }
        curl_close($ch);

        return $sms_result;
    }

    function formatted_server_response($result) {
        $this_result = "";

        if ($result['success']) {
            $this_result .= "Success: batch ID " . $result['api_batch_id'] . "API message: " . $result['api_message'] . "\nFull details " . $result['details'];
        } else {
            $this_result .= "Fatal error: HTTP status " . $result['http_status_code'] . ", API status " . $result['api_status_code'] . " API message " . $result['api_message'] . " full details " . $result['details'];

            if ($result['transient_error']) {
                $this_result .= "This is a transient error - you should retry it in a production environment";
            }
        }
        return $this_result;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getGraph1Data($user_id) {
        $currency_symbol = $this->dbvars->DEFAULT_SYMBOL_LEFT . $this->dbvars->DEFAULT_SYMBOL_RIGHT;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_symbol = $this->main->get_usersession('mlm_data_currency', 'symbol_left') . $this->main->get_usersession('mlm_data_currency', 'symbol_right');
        }
        $graph_data = array();
        $date = date('Y-m-d', strtotime('today - 29 days'));
        for ($i = 0; $i < 31; $i++) {
            $graph_data[$i]['date'] = $date;
            $graph_data[$i]['value1'] = $this->getUserRegisterCount($date, $user_id);
            $graph_data[$i]['value2'] = $this->getUserPurchaseTotal($date, $user_id);
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $data = array();
        $data['graph'] = $graph_data;
        $data['key1'] = lang('joins');
        $data['key2'] = lang('sales');
        $data['currency'] = $currency_symbol;
        return $data;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserRegisterCount($date, $sponsor_id = '') {
        $this->db->select('mlm_user_id');
        $this->db->from("user");
        if ($sponsor_id)
            $this->db->where('sponsor_id', $sponsor_id);
        $this->db->like('date', $date);
        return $this->db->count_all_results();
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getUserPurchaseTotal($date, $user_id = '') {
        $amount = 0;
        $this->db->select_sum('total_amount');
        if ($user_id)
            $this->db->where('user_id', $user_id);
        $this->db->where('order_status', 1);
        $this->db->like('confirm_date', $date);
        $res = $this->db->get('orders');
        if ($res->num_rows() > 0 && $res->row()->total_amount != '') {
            $amount = round($res->row()->total_amount, 2);
        }
        return $amount;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getSystemPath() {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            return 'local';
        } elseif ($this->dbvars->SYSTEM_PATH != FCPATH) {
            $this->db->set('login_block', 0)
                    ->update('user');
        }
        return FCPATH;
    }

    public function getUserPoint($user_id) {
        $balance_amount = 0;
        $query = $this->db->select('user_wallet_two')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_balance');
        if ($query->num_rows() > 0) {
            $balance_amount = $query->row()->user_wallet_two;
        }
        return round($balance_amount, 2);
    }

    public function getDemoSwitcherDetails() {
        $plan = $this->dbvars->SYSTEM_PLAN;
        switch ($plan) {
            case 'BINARY';
                $mlm_plan = 'binary';
                break;
            case 'MATRIX';
                $mlm_plan = 'matrix';
                break;
            case 'UNILEVEL';
                $mlm_plan = 'unilevel';
                break;
            case 'MONOLINE';
                $mlm_plan = 'monoline';
                break;
            case 'DONATION';
                $mlm_plan = 'donation';
                break;
            case 'STAIRSTEP';
                $mlm_plan = 'stairstep';
                break;
            case 'PARTY';
                $mlm_plan = 'party';
                break;
            case 'INVESTMENT';
                $mlm_plan = 'investment';
                break;
            case 'GENERATION';
                $mlm_plan = 'generation';
                break;
            case 'GIFT';
                $mlm_plan = 'gift';
                break;
            default:
                break;
        }

        $data = FALSE;
        $demo_type = 'advanced';
        if ($this->dbvars->BASIC_FLAG == 0) {
            $demo_type = 'basic';
        }
        $query = $this->db->select($demo_type)
                ->where('plan', $mlm_plan)
                ->limit(1)
                ->get('demo_switcher');
        if ($query->num_rows() > 0 && $query->row()->$demo_type != '') {
            $user = 'admin-login';
            if ($this->aauth->getUserType() == 'user') {
                $user = 'user-login';
            }
            $data['switch_msg'] = lang('switch_to_basic_demo');
            $type = 'basic';
            if ($this->dbvars->BASIC_FLAG != 0) {
                $data['switch_msg'] = lang('switch_to_advanced_demo');
                $type = 'advanced';
            }
            $data['link'] = $query->row()->$demo_type . $user;
        }
        return $data;
    }

    function insertCoinPaymentResponse($data, $type = '') {
        $this->db->set('response_data', serialize($data))
                ->set('type', $type)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('coin_payment_response');
        return $this->db->insert_id();
    }

    function updateCoinPaymentResponse($id, $response) {
        return $this->db->set('response', "$response")
                        ->where('id', "$id")
                        ->update('coin_payment_response');
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getGraphTicketData($user_id) {
        $this->load->model('ticket_system_model');
        $currency_symbol = $this->dbvars->DEFAULT_SYMBOL_LEFT . $this->dbvars->DEFAULT_SYMBOL_RIGHT;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_symbol = $this->main->get_usersession('mlm_data_currency', 'symbol_left') . $this->main->get_usersession('mlm_data_currency', 'symbol_right');
        }
        $graph_data = array();
        $date = date('Y-m-d', strtotime('today - 30 days'));
        for ($i = 0; $i < 31; $i++) {
            $graph_data[$i]['date'] = $date;
            $graph_data[$i]['value1'] = $this->ticket_system_model->getTicketCount('new', $date);
            $graph_data[$i]['value2'] = $this->ticket_system_model->getTicketCount('completed', $date);
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $data = array();
        $data['graph'] = $graph_data;
        $data['key1'] = lang('new');
        $data['key2'] = lang('complete');
        $data['currency'] = '';

        return $data;
    }

    function getCompanyBankDetail() {
        $data = array();
        $query = $this->db->select('bank_name,bank_holder_name,bank_branch,bank_ac_number,bank_ifsc')
                ->from('payment_config')
                ->where('id', 1)
                ->get();
        if ($query->num_rows() > 0) {
            $data['bank_name'] = $query->row()->bank_name;
            $data['bank_holder_name'] = $query->row()->bank_holder_name;
            $data['bank_branch'] = $query->row()->bank_branch;
            $data['bank_ac_number'] = $query->row()->bank_ac_number;
            $data['bank_ifsc'] = $query->row()->bank_ifsc;
        }
        return $data;
    }

}

?>
