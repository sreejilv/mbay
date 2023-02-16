<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * For lcp related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    lcp
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Lcp_model extends CI_Model {

    /**
     * for inserting leads
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function addLCP($data, $user_id) {
        $this->db->set('lead_user', $user_id)
                ->set('first_name', $data['first_name'])
                ->set('last_name', $data['last_name'])
                ->set('email', $data['email'])
                ->set('phone', $data['mobile'])
                ->set('comment', $data['comment'])
                ->set('country', $data['country'])
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('leads');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
