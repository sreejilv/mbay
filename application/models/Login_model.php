<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 * For login related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    login
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * for checking email exist or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $email
     * @return type
     */
    function checkEmailExitsOrNot($email) {

        $result = $this->db->select("COUNT(*) as cnt")->from('mlm_user')->where('email', $email)->count_all_results();
        return $result;
    }

    /**
     * for getting user id from email
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $email
     * @return type
     */
    function getMlmEmailToUserId($email) {
        $user_id = '';
        if ($email != '') {
            $query = $this->db->select('mlm_user_id')
                    ->from('user')
                    ->where('email', $email)
                    ->get();
            $result = $query->row();
            $user_id = $result->mlm_user_id;
        }
        return $user_id;
    }

    /**
     * for resetting user password
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $password
     * @param type $user_id
     * @return type
     */
    function resetPassword($password, $user_id) {
        $result = $this->db->set('password', $password)->where('mlm_user_id', $user_id)->update('user');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * for getting maintanance time
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getMaintenctTime() {
        $value = '';
        $query = $this->db->select('setdate')
                ->from('maintence_mode_history')
                ->where('status', 'active')
                ->order_by('date', 'DESC')
                ->get();
        foreach ($query->result() as $row) {
            $value = $row->setdate;
        }
        return $value;
    }

    /**
     * for updating maintanance history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @return type
     */
    function updateMaintenceHistory($status) {
        $this->db->set('status ', "$status")
                ->update('maintence_mode_history');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing maintanance status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @return type
     */
    function changeMaintenceStatus($status) {
        $this->db->set('maintence_mode ', "$status")
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting user verification code
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function userVerficationCode($user_id) {
        $value = '';
        $query = $this->db->select('verification_code')
                ->from('user')
                ->where('mlm_user_id', $user_id)
                ->get();
        if ($query->num_rows() > 0)
            $value = $query->row()->verification_code;

        return $value;
    }

    /**
     * for encoding uses
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $string
     * @param type $action
     * @return type
     */
    function crypt($string, $action = 'e') {
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    /**
     * for update lock screen status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $value
     * @return type
     */
    function updateLockScreenStatus($value) {
        $result = $this->db->set('value', $value)->where('key', 'LOCK_SCREEN_STATUS')->update('config');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * for getting user password
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getUserPassword($user_id) {
        $user_type = $this->aauth->getUserType();
        if ($user_type == 'employee') {
            $qry = $this->db->select('password')
                    ->from('employee_login')
                    ->where('employee_id', $user_id)
                    ->get();
            if ($qry->num_rows() > 0) {
                return $qry->row()->password;
            }
            return false;
        } elseif ($user_type == 'affiliate') {
            $qry = $this->db->select('password')
                    ->from('affiliates')
                    ->where('id', $user_id)
                    ->get();
            if ($qry->num_rows() > 0) {
                return $qry->row()->password;
            }
            return false;
        } else {
            $qry = $this->db->select('password')
                    ->from('user')
                    ->where('mlm_user_id', $user_id)
                    ->get();
            if ($qry->num_rows() > 0) {
                return $qry->row()->password;
            }
            return false;
        }
    }

    /**
     * for resetting employee password
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $password
     * @param type $employee_id
     * @return type
     */
    function resetEmployeePassword($password, $employee_id) {
        $result = $this->db->set('password', $password)->where('employee_id', $employee_id)->update('employee_login');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * for resetting affiliate password
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $password
     * @param type $affiliate_id
     * @return type
     */
    function resetAffiliatePassword($password, $affiliate_id) {
        $result = $this->db->set('password', $password)->where('id', $affiliate_id)->update('affiliates');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    public function validateResetCode($user_id,$code) {
        $id = NULL;
        $date=date("Y-m-d H:i:s", strtotime("-30 minutes", strtotime(date("Y-m-d H:i:s"))));
        $query = $this->db->select('id')
                ->where('user_id', $user_id)
                ->where('random_code', $code)
                ->where('status', 1)
                ->where('date >=', $date)
                ->limit(1)
                ->get('random_codes');
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
        }
        return $id;
    }
    
    public function inactivateAllResetCodes($user_id) {
        $this->db->set('status', 0)
                ->where('user_id', $user_id)
                ->where('status', 1)
                ->update('random_codes');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function inactivateResetLink($id) {
        $this->db->set('status', 0)
                ->where('id', $id)
                ->where('status', 1)
                ->update('reset_password');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function userIdFromResetLink($id) {
        $user_id = NULL;
        $date=date("Y-m-d H:i:s", strtotime("-45 minutes", strtotime(date("Y-m-d H:i:s"))));
        $query = $this->db->select('user_id')
                ->where('id', $id)
                ->where('status', 1)
                ->where('date >=', $date)
                ->limit(1)
                ->get('reset_password');
        if ($query->num_rows() > 0) {
            $user_id = $query->row()->user_id;
        }
        return $user_id;
    }
    
    public function getLinkExpiryReason($id) {
        $reason = lang('na');
        $date=date("Y-m-d H:i:s", strtotime("-45 minutes", strtotime(date("Y-m-d H:i:s"))));
        $query = $this->db->select('status,date')
                ->where('id', $id)
                ->limit(1)
                ->get('reset_password');
        if ($query->num_rows() > 0) {
            if($query->row()->status!=1){
                $reason=lang('already_used');
            }elseif($date>$query->row()->date){
                $reason=lang('link_expired');
            }            
        }else{
            $reason=lang('invalid_link');
        }
        return $reason;
    }
    

}

?>
