<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For menu related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    menu
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Menu_model extends CI_Model {

    /**
     * for getting all main menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return string
     */
    function getAllMainMenus($setup_flag = 0) {
        $lang_name = 'english';
        $this->lang->load('common', $lang_name);

        $array = array();
        $query = $this->db->select('id,icon,status,admin_permission,user_permission,employee_permission,order,permission,affiliate_permission,affiliate_status,link')
                ->from('menus')
                ->where('root_id', '#')
                ->where('permission >', 0)
                ->order_by('order', 'ASC')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $id = $row['id'];
            $sub_menus = array();
            if ($row['link'] == '#' || $setup_flag) {                
                $sub_menus = $this->getAllSubMenus($id, 1, $setup_flag);                
            }
            $array[$i]["id"] = $id;
            $array[$i]["sub_menus"] = $sub_menus;
            $array[$i]["name"] = lang("menu_name_$id");
            $array[$i]["icon"] = ' '.$row['icon'];
            $array[$i]["status"] = $row['status'];
            $array[$i]["admin_permission"] = $row['admin_permission'];
            $array[$i]["user_permission"] = $row['user_permission'];
            $array[$i]["employee_permission"] = $row['employee_permission'];
            $array[$i]["affiliate_permission"] = $row['affiliate_permission'];
            $array[$i]["affiliate_status"] = $row['affiliate_status'];
            $array[$i]["order"] = $row['order'];
            if ($row['permission'] == 1) {
                $permission = 'admin';
            } elseif ($row['permission'] == 2) {
                $permission = 'user';
            } elseif ($row['permission'] == 4) {
                $permission = '';
            } else {
                $permission = 'both';
            }
            $array[$i]["permission"] = $permission;
            $i++;
        }
        $lang_name = $this->getLangName($this->main->get_usersession('mlm_data_language', 'lang_code'), 'lang_code');
        $this->lang->load('common', $lang_name);

        return $array;
    }

    /**
     * for getting language name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $language_ref
     * @param type $lang_code
     * @return type
     */
    public function getLangName($language_ref, $lang_code = 'id') {
        $language = 'english';
        $query = $this->db->select('language_folder')
                ->where($lang_code, $language_ref)
                ->limit(1)
                ->get('languages');
        if ($query->num_rows() > 0) {
            $language = $query->row()->language_folder;
        }
        return $language;
    }

    /**
     * for getting all sub menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $menu_id
     * @param type $flag
     * @return string
     */
    function getAllSubMenus($menu_id, $flag = 0, $setup_flag = 0) {
        $array = array();
        $query = $this->db->select('id,icon,status,admin_permission,user_permission,employee_permission,order,permission,affiliate_permission,affiliate_status,link')
                ->from('menus')
                ->where('root_id', $menu_id)
                ->order_by('order', 'ASC')
                //->where('permission !=', 'none')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $id = $row['id'];
            $sub_menus = array();
            if (($flag && $row['link'] == '#') || $setup_flag) {
                $sub_menus = $this->getAllSubMenus($id,0,$setup_flag);
            }
            $array[$i]["id"] = $id;
            $array[$i]["sub_menus"] = $sub_menus;
            $array[$i]["name"] = lang("menu_name_$id");
            $array[$i]["icon"] = $row['icon'];
            $array[$i]["status"] = $row['status'];
            $array[$i]["admin_permission"] = $row['admin_permission'];
            $array[$i]["user_permission"] = $row['user_permission'];
            $array[$i]["employee_permission"] = $row['employee_permission'];
            $array[$i]["affiliate_permission"] = $row['affiliate_permission'];
            $array[$i]["affiliate_status"] = $row['affiliate_status'];
            $array[$i]["order"] = $row['order'];
            if ($row['permission'] == 1) {
                $permission = 'admin';
            } elseif ($row['permission'] == 2) {
                $permission = 'user';
            } elseif ($row['permission'] == 4) {
                $permission = '';
            } else {
                $permission = 'both';
            }
            $array[$i]["permission"] = $permission;
            $i++;
        }
        
        return $array;
    }

    /**
     * for changing menu permission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $menu_id
     * @param type $status
     * @param type $type
     * @return int
     */
    function changeMenuPermission($menu_id, $status, $type) {
        if ($type == 'admin') {
            $this->db->set('admin_permission', $status);
        } elseif ($type == 'user') {
            $this->db->set('user_permission', $status);
        } elseif ($type == 'employee') {
            $this->db->set('employee_permission', $status);
        } elseif ($type == 'affiliate') {
            $this->db->set('affiliate_permission', $status);
        } else {
            return 0;
        }
        $this->db->where('id', $menu_id);
        $res = $this->db->update('menus');
        return $res;
    }

    /**
     * for changing menu status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $menu_id
     * @param type $status
     * @return type
     */
    function changeMenuStatus($menu_id, $status) {
        $this->db->set('status', $status)
                ->where('id', $menu_id)
                ->update('menus');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating menu icons
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $menu_id
     * @param type $icon
     * @return type
     */
    function updateMenuIcon($menu_id, $icon) {
        $this->db->set('icon', $icon)
                ->where('id', $menu_id)
                ->update('menus');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating menu orders
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $menu_id
     * @param type $order
     * @return type
     */
    function updateMenuOrder($menu_id, $order) {
        $this->db->set('order', $order)
                ->where('id', $menu_id)
                ->update('menus');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
