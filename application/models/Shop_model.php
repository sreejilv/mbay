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
class Shop_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    function insertNotificationDetails($phone,$pro_id,$user_id=0) {
    
        $this->db->set('user_id', $user_id)
        ->set('phone', $phone)
        ->set('pro_id', $pro_id)
        ->insert('update_notify`');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getAllNotification(){        
        $data = array();
        $query = $this->db->select('update_notify.user_id,update_notify.user_id, update_notify.phone,update_notify.pro_id,user_name,email,product_name')
        ->join('user','user.mlm_user_id = update_notify.user_id', 'left')
        ->join('products','products.id = update_notify.pro_id', 'inner')
        ->get('update_notify');
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result_array() as $row) {
                $data[$i]['username'] = $row['user_name'];
                $data[$i]['email'] = $row['email'];
                $data[$i]['product_name'] = $row['product_name'];
                $data[$i]['phone'] = $row['phone'];
                $i++;
            }
        }
        return $data;
    }



}

?>
