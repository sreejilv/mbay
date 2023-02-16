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
class Settings_model extends CI_Model {

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getValueMultiWallet() {
        $data = array();
        $query = $this->db->select("wallet_a,wallet_b")
                ->from("configuration")
                ->get();
        foreach ($query->result_array() as $row) {
            $data['wallet_a'] = $row['wallet_a'];
            $data['wallet_b'] = $row['wallet_b'];
        }
        return $data;
    }

    /**
     * For update multi-wallet
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $wallet_a
     * @param type $wallet_b
     * @return type
     */
    function updateMultiWallet($wallet_a, $wallet_b) {
        $this->db->set('wallet_a ', $wallet_a)
                ->set('wallet_b ', $wallet_b)
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update Tax
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $per_or_static
     * @param type $tax
     * @return type
     */
    function updateTax($per_or_static, $tax) {
        $this->db->set('tax ', $tax)
                ->set('tax_type ', $per_or_static)
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting the status of multi-wallet
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getStatusMutiWallet() {
        $status = '';
        $query = $this->db->select('value')
                ->from('config')
                ->where('key', 'MULTIPLE_WALLET_STATUS')
                ->get();
        foreach ($query->result() as $row) {
            $status = $row->value;
        }
        return $status;
    }

    /**
     * For generation
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getGenerations() {
        $data = array();
        $res = $this->db->select("id,rank_id,g1_value,g2_value,g3_value")
                ->from("genertion_settings")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['rank_id'] = $row->rank_id;
            $data[$i]['g1_value'] = $row->g1_value;
            $data[$i]['g2_value'] = $row->g2_value;
            $data[$i]['g3_value'] = $row->g3_value;
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getAllRanks() {
        $data = array();
        $res = $this->db->select("id,rank_name")
                ->from("rank")
                ->where('status', '1')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['rank_name'] = $row->rank_name;
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $rank
     * @param type $value1
     * @param type $value2
     * @param type $value3
     * @return type
     */
    public function updateGenerationDetails($id, $rank, $value1 = 0, $value2 = 0, $value3 = 0) {
        $this->db->set('rank_id ', "$rank")
                ->set('g1_value ', "$value1")
                ->set('g2_value ', "$value2")
                ->set('g3_value ', "$value3")
                ->where('id ', $id)
                ->update('genertion_settings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For investment currencies
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getInvestmentCurrencies() {
        $data = array();
        $res = $this->db->select("id,name,status")
                ->from("investment_category")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['name'] = $row->name;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * For update investment Currency status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    public function updateInvestmentCurrencyStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id ', $id)
                ->update('investment_category');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * get Silder data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getSliderData($id) {

        $data = array();
        $res = $this->db->where('id', $id)->get('cms_slider');

        foreach ($res->result_array() as $row) {
            $row['enc_id'] = $this->helper_model->safe_encode($row['id']);
            $row['title_position'] = $row['position'];
            $data = $row;
        }

        return $data;
    }

    /**
     * For page details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getPageDetails($id) {

        $data = array();
        $res = $this->db->where('id', $id)->get('cms_pages');

        foreach ($res->result_array() as $row) {
            $row['enc_id'] = $this->helper_model->safe_encode($row['id']);
            $row['page_title'] = $row['page'];
            $row['page_content'] = $row['description'];
            $data = $row;
        }

        return $data;
    }

    /**
     * For delete slider
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function deleteSlider($id) {

        $data = array();
        $res = $this->db->where('id', $id)->delete('cms_slider');

        return $res;
        
    }

    /**
     * For delete page
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function deletePage($id) {

        $data = array();
        $res = $this->db->where('id', $id)->delete('cms_pages');

        return $res;
    }

    /**
     * For getting the slider list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getSliderList() {

        $data = array();
        $res = $this->db->get('cms_slider');

        foreach ($res->result_array() as $row) {
            $row['enc_id'] = $this->helper_model->safe_encode($row['id']);
            $data[] = $row;
        }

        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getPageList() {

        $data = array();
        $res = $this->db->get('cms_pages');

        foreach ($res->result_array() as $row) {
            $row['enc_id'] = $this->helper_model->safe_encode($row['id']);
            $data[] = $row;
        }

        return $data;
    }

    /**
     * For get page category list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getPageCategoryList() {

        $data = array();
        $res = $this->db->get('cms_pages_category');

        foreach ($res->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * For module list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getModuleList() {

        $data = array();
        $res = $this->db->where('status', 1)
                ->get('cms_modules');

        foreach ($res->result_array() as $row) {
            $row['enc_id'] = $this->helper_model->safe_encode($row['id']);
            $data[] = $row;
        }

        return $data;
    }

    /**
     * For delete module
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function deleteModule($id) {

        $this->db->set('status', 0)
                ->where('id', $id)
                ->limit(1)
                ->update('cms_modules');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For activate page
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function activatePage($id) {

        $this->db->set('status', 1)
                ->where('id', $id)
                ->limit('1');
        $this->db->update('cms_pages');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For disable page
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function disablePage($id) {

        $this->db->set('status', 0)
                ->where('id', $id)
                ->limit('1');
        $this->db->update('cms_pages');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For insertCMS Slider
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return type
     */
    public function insertCMSSlider($data) {

        $this->db->set('title', $data['title'])
                ->set('image', $data['file_name'])
                ->set('position', $data['title_position'])
                ->set('title_animation', $data['title_animation'])
                ->set('sub_title', $data['sub_title'])
                ->set('sub_title_animation', $data['sub_title_animation'])
                ->insert('cms_slider');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For insert CMS Module
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return type
     */
    public function insertCMSmodule($data) {

        $this->db->set('name', $data['module_title'])
                ->set('data', $data['module_content'])
                ->set('order', 1)
                ->set('type', 'custom')
                ->set('status', 1)
                ->set('nav_status', $data['nav_status'])
                ->insert('cms_modules');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update CMS Slider
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @param type $update_file_name
     * @param type $update_id
     * @return type
     */
    public function updateCMSSlider($data, $update_file_name, $update_id) {

        if ($update_file_name != '') {
            $this->db->set('image', $update_file_name);
        }
        $this->db->set('title', $data['title'])
                ->set('position', $data['title_position'])
                ->set('title_animation', $data['title_animation'])
                ->set('sub_title', $data['sub_title'])
                ->set('sub_title_animation', $data['sub_title_animation'])
                ->where('id', $update_id);
        $this->db->update('cms_slider');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For insert CMS page
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @param type $document
     * @param type $image
     * @return type
     */
    public function insertCMSpage($data, $document, $image) {

        $this->db->set('page', $data['page_title'])
                ->set('page_category', $data['page_category'])
                ->set('description', $data['page_content'])
                ->set('document', $document)
                ->set('image', $image)
                ->set('date', date('Y-m-d H:i:s'))
                ->set('page_link', str_replace(' ', '_', $data['page_title']))
                ->insert('cms_pages');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update CMS page
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @param type $cms_page_document
     * @param type $cms_page_image
     * @param type $update_id
     * @return type
     */
    public function updateCMSpage($data, $cms_page_document, $cms_page_image, $update_id) {

        if ($cms_page_document != '') {
            $this->db->set('document', $cms_page_document);
        }
        if ($cms_page_image != '') {
            $this->db->set('image', $cms_page_image);
        }
        $this->db->set('page', $data['page_title'])
                ->set('page_category', $data['page_category'])
                ->set('description', $data['page_content'])
                ->where('id', $update_id);
        $this->db->update('cms_pages');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For stair step details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getStairSteps() {
        $data = array();
        $res = $this->db->select("id,percentage,group_volume,qualifying_legs,stair_step")
                ->from("stair_step_settings")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['stair_step'] = $row->stair_step;
            $data[$i]['qualifying_legs'] = $row->qualifying_legs;
            $data[$i]['group_volume'] = $row->group_volume;
            $data[$i]['percentage'] = $row->percentage;
            $i++;
        }
        return $data;
    }

    /**
     * For update stair step details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $qualifying_legs
     * @param type $group_volume
     * @param type $percentage
     * @return type
     */
    public function updateStairStepDetails($id, $qualifying_legs, $group_volume, $percentage) {
        $this->db->set('qualifying_legs', $qualifying_legs)
                ->set('group_volume', $group_volume)
                ->set('percentage', $percentage)
                ->where('id', $id)
                ->update('stair_step_settings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For get while listed IP
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getWhitelistedIP($id) {
        $data = NULL;
        $res = $this->db->select("whitelist_ip")
                ->where('id', $id)
                ->from("ip_whitelist")
                ->get();
        foreach ($res->result() as $row) {
            $data = $row->whitelist_ip;
        }
        return $data;
    }

    /**
     * For update white listed IP
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $ip
     * @return type
     */
    public function updateWhitelistIP($data,$id) {
        $this->db->set('whitelist_ip', $data['whitelist_ip_name'])
                ->where('id', $id)
                ->update('ip_whitelist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function InsertWhitelistIP($data) {
        $this->db->set('whitelist_ip', $data['whitelist_ip_name'])
                ->set('date', date('Y-m-d H:i:s'))
                ->Insert('ip_whitelist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

      function getTableColumnWhitelistList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'whitelist_ip', 'dt' => 1),
            array('db' => 'date', 'dt' => 2),
            array('db' => 'status', 'dt' => 3)
        );
    }
    
     function countOfWhitelistIp() {
        return $this->db->select('id')
                        ->from("ip_whitelist")
                        ->count_all_results();
    }
    
    function getTotalFilteredWhiteListIp($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }
    
    function getResultDataWhiteList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    
    public function inserIpBlacklist($data) {
        $this->db->set('blacklist_ip', $data['ip_address'])
                ->set('reason', $data['reason'])
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('ip_blacklist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getTableColumnBlacklistList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'blacklist_ip', 'dt' => 1),
            array('db' => 'reason', 'dt' => 2),
            array('db' => 'date', 'dt' => 3)
        );
    }
    
    function countOfBlacklistIp() {
        return $this->db->select('id')
                        ->from("ip_blacklist")
                        ->count_all_results();
    }
    
    function getTotalFilteredBlackListIp($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }
    
    function getResultDataBlackList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    
    function removeIpBlacklist($id) {
        $this->db->where('id', $id)
                ->delete('ip_blacklist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function removeIpWhitelist($id) {
        $this->db->where('id', $id)
                ->delete('ip_whitelist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    
     function changeIpStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('ip_whitelist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function changeIpBlackStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('ip_blacklist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    
     public function getBlacklistedIP($id) {
        $data = NULL;
        $res = $this->db->select("blacklist_ip,reason")
                ->where('id', $id)
                ->from("ip_blacklist")
                ->get();
        foreach ($res->result() as $row) {
            $data['ip'] = $row->blacklist_ip;
            $data['reason'] = $row->reason;
        }
        return $data;
    }
    
      public function updateBlacklistIP($data,$id) {
        $this->db->set('blacklist_ip', $data['ip_address'])
                ->set('reason', $data['reason'])
                ->where('id', $id)
                ->update('ip_blacklist');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
