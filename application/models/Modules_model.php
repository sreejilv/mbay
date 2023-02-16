<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For module  related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    module
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Modules_model extends CI_Model {

    /**
     * for getting all modules
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getAllModules() {
        $data = array();
        $res = $this->db->select("id,name,icon,link")
                ->from("modules")
                ->where("status", '1')
                ->order_by('sort_order', 'ASC')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $db_vars = $row->name . '_status';
            $key = strtoupper($db_vars);
            if (!$this->dbvars->__isset($key)) {
                $this->dbvars->$key = '1';
            }

            $data[$i]['id'] = $row->id;
            $data[$i]['name'] = $row->name;
            $data[$i]['icon'] = $row->icon;
            $data[$i]['link'] = $row->link;
            $data[$i]['module_status'] = $this->dbvars->$key;
            $i++;
        }
        return $data;
    }

    /**
     * for change menu status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $module
     * @param type $status
     * @return boolean
     */
    public function changeMenus($module, $status) {
        $data = array();
        $res = $this->db->select("menus,menu_type")
                ->from("modules")
                ->where("name", $module)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $menus = $row->menus;
            $menu_array = explode(',', $menus);

            $menu_type = $row->menu_type;
            $menu_type_array = explode(',', $menu_type);

            $i = 0;
            foreach ($menu_array as $ma) {
                if ($ma && $menu_type_array[$i]) {
                    if ($menu_type_array[$i] == 1) {
                        $this->changeMenuPermission($ma, $status, 1);
                    } elseif ($menu_type_array[$i] == 2) {
                        $this->changeMenuPermission($ma, $status, '', 1);
                    } elseif ($menu_type_array[$i] == 3) {
                        $this->changeMenuPermission($ma, $status, 1, 1);
                    }
                }
                $i++;
            }
        }

        $this->changeModuleRelatedFunctions($module, $status);
        return TRUE;
    }

    /**
     * for change menu permission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $menu
     * @param type $status
     * @param type $admin_status
     * @param type $user_status
     * @return type
     */
    public function changeMenuPermission($menu, $status, $admin_status = '', $user_status = '') {
        if ($admin_status) {
            $this->db->set('admin_permission', $status);
            $this->db->set('employee_permission', $status);
        }
        if ($user_status) {
            $this->db->set('user_permission ', $status);
        }
        if (($admin_status && $user_status) || $status == 1) {
            $this->db->set('status ', $status);
        }
        $this->db->where('id', $menu);
        $res = $this->db->update('menus');
        if ($this->db->affected_rows() > 0) {
            return $res;
        }
        return false;
    }

    /**
     * for getting redirect URL
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $module
     * @return type
     */
    public function getConfigUrl($module) {
        $link = $tab = $tab_session = '';
        $res = $this->db->select("link,tab,tab_session")
                ->from("modules")
                ->where("id", $module)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $link = $row->link;
            $tab = $row->tab;
            $tab_session = $row->tab_session;
        }
        $data['link'] = $link;
        $data['tab'] = $tab;
        $data['tab_session'] = $tab_session;
        return $data;
    }

    /**
     * for getting menu url
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getMenuUrl($id) {
        $link = '';
        $res = $this->db->select("link")
                ->from("menus")
                ->where("id", $id)
                ->get();
        foreach ($res->result() as $row) {
            $link = $row->link;
        }
        return $link;
    }

    public function changeModuleRelatedFunctions($module, $status) {
        if ($module == 'multi_lang') {
            if ($status) {
                $this->db->set('status', 1)
                        ->update('languages');
            } else {
                $this->db->set('status', 0)
                        ->where('id !=', 1)
                        ->update('languages');
            }
        }elseif ($module == 'multi_currency') {
            if ($status) {
                $this->db->set('status', 1)
                        ->update('currencies');
            } else {
                $this->db->set('status', 0)
                        ->where('id !=', 1)
                        ->update('currencies');
            }
        }elseif ($module == 'rank') {
            if ($status) {
                $this->db->set('status', 1)
                        ->where('id', 5)
                        ->update('bonuses');
            } else {
                $this->db->set('status', 0)
                        ->where('id', 5)
                        ->update('bonuses');
            }
        }elseif ($module == 'stair_step_plan') {
            if ($status) {
                $this->db->set('status', 1)
                        ->where('id', 8)
                        ->update('bonuses');
            } else {
                $this->db->set('status', 0)
                        ->where('id', 8)
                        ->update('bonuses');
            }
        }elseif ($module == 'generation') {
            if ($status) {
                $this->db->set('status', 1)
                        ->where('id', 7)
                        ->update('bonuses');
            } else {
                $this->db->set('status', 0)
                        ->where('id', 7)
                        ->update('bonuses');
            }
        }
        return 1;
    }

}
