<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For auto registration related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    auto registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Auto_register_model extends CI_Model {

    /**
     * For deleting unwanted Menus And Modules
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return true
     */
    function delteUnwantedModules() {
        return TRUE;

        $res = $this->db->where('status', 0)
                ->delete('modules');
        if ($res) {
            echo '<p>Modules Deleted';
        }

        $res = $this->db->where('status', 0)
                ->delete('menus');
        if ($res) {
            echo '<p>Menus Deleted';
        }

        return TRUE;
    }

    /**
     * For updating random Profile Picutures
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return true
     */
    function updateUserProfilePic($user_id, $flag = 0, $logo = '', $cover = '') {
        if ($logo == '') {
            $dp_array = array('no_user.jpg', $this->dbvars->Dp0, $this->dbvars->Dp1, $this->dbvars->Dp2, $this->dbvars->Dp3, $this->dbvars->Dp4, $this->dbvars->Dp5, $this->dbvars->Dp6, $this->dbvars->Dp7, 'no_user.jpg');

            //$dp_array = array('dp2.jpg', 'no_user.jpg', 'dp3.jpg', 'dp4.jpg', 'no_user.jpg', 'dp5.jpg', 'dp6.jpg', 'no_user.jpg', 'dp7.jpg', 'dp8.jpg', 'no_user.jpg');
            $dp_flag = 1;
            while ($dp_flag) {
                $k = array_rand($dp_array);
                $dp = $dp_array[$k];
                if ($flag) {
                    if ($dp != 'no_user.jpg') {
                        $dp_flag = 0;
                    }
                } else {
                    $dp_flag = 0;
                }
            }
        } else {
            $dp = $logo;
        }

        if ($cover == '') {
            $cover_array = array($this->dbvars->Cover0, $this->dbvars->Cover1, $this->dbvars->Cover2, $this->dbvars->Cover3, $this->dbvars->Cover4, $this->dbvars->Cover5);
            //$cover_array = array('cover1.jpg', 'cover2.jpg', 'cover3.jpg', 'cover4.jpg', 'cover5.jpg', 'cover6.jpg');
            $k = array_rand($cover_array);
            $cov = $cover_array[$k];
        } else {
            $cov = $cover;
        }

        $gender = 'm';
        if ($user_id % 2) {
            $gender = 'f';
        }
        $dob = '02/04/' . rand(1950, 1999);
        $this->db->set('user_dp', $dp)
                ->set('user_cover', $cov)
                ->set('phone_number', '987654321')
                ->set('gender', $gender)
                ->set('date_of_birth', $dob)
                ->where('mlm_user_id', $user_id)
                ->update('user_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function removeUserIp($ip) {
        $this->db->where('blacklist_ip', $ip)
                ->delete('ip_blacklist');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function clearUserActivity() {
        return $this->db->truncate('activity');
    }

    public function getARegProAmount($product_id) {
        $product_amount = 0;
        $query = $this->db->select('product_amount')
                ->where('id', $product_id)
                ->limit(1)
                ->get('products');
        if ($query->num_rows() > 0) {
            $product_amount = $query->row()->product_amount;
        }
        return $product_amount;
    }

    public function updatePlanBonuses($mlm_plan) {
        $this->db->set('status', 0)
                ->update('bonuses');
        if ($mlm_plan == 'BINARY') {
            $bonuses = array('0' => 1, '1' => 2, '2' => 5, '3' => 6);
            $this->db->set('status', 1)
                    ->where_in('id', $bonuses)
                    ->update('bonuses');
        } elseif ($mlm_plan == 'UNILEVEL' || $mlm_plan == 'MONOLINE' || $mlm_plan == 'DONATION' || $mlm_plan == 'PARTY' || $mlm_plan == 'INVESTMENT' || $mlm_plan == 'GIFT') {
            $bonuses = array('0' => 1, '1' => 3, '2' => 5, '3' => 6);
            $this->db->set('status', 1)
                    ->where_in('id', $bonuses)
                    ->update('bonuses');
        } elseif ($mlm_plan == 'MATRIX') {
            $bonuses = array('0' => 1, '1' => 4, '2' => 5, '3' => 6, '4' => 9);
            $this->db->set('status', 1)
                    ->where_in('id', $bonuses)
                    ->update('bonuses');
        } elseif ($mlm_plan == 'GENERATION') {
            $bonuses = array('0' => 1, '1' => 3, '2' => 5, '3' => 6, '4' => 7);
            $this->db->set('status', 1)
                    ->where_in('id', $bonuses)
                    ->update('bonuses');
        } elseif ($mlm_plan == 'STAIRSTEP') {
            $bonuses = array('0' => 1, '1' => 5, '2' => 6, '3' => 8);
            $this->db->set('status', 1)
                    ->where_in('id', $bonuses)
                    ->update('bonuses');
        }
        return true;
    }

    public function changeIpAddress() {
        $this->db->set('ip_address', '175.138.87.6')
                ->set('location_status', 0)
                ->where('ip_address', $this->helper_model->getUserIP())
                ->update('activity');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function changeCollation() {
        $tables = array();
        $database_name = $this->db->database;
        $dbprefix = $this->db->dbprefix;
        $table_query = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='$database_name' AND TABLE_NAME LIKE '$dbprefix%' ");

        foreach ($table_query->result_array() AS $rows) {
            echo '<p>' . $rows['TABLE_NAME'];

            if (!$this->db->simple_query("ALTER TABLE " . $rows['TABLE_NAME'] . " CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci ")) {
                echo ' - Failed';
            }
        }
        return TRUE;
    }

    public function setSystemAsBasic($delete_status) {
        if ($delete_status) {
            //if ($_SERVER['HTTP_HOST'] != 'localhost') {
                $this->db->where('status', 0)
                        ->delete('languages');

                $this->db->where('status', 0)
                        ->delete('currencies');

                $this->db->where('status', 'inactive')
                        ->delete('payment_methods');

                $this->db->where('status', '0')
                        ->delete('bonuses');

                $this->db->where('status', '0')
                        ->delete('system_mails');

                $this->db->set('status', '0')
                        ->where('id', 92)
                        ->or_where('id', 9)
                        ->update('menus');
//            }else{
//                echo 'Not Possible In Local';
//            }
            return TRUE;
        } else {
            $dis_mod = $this->getAllModules();
            $this->load->model('modules_model');
            foreach ($dis_mod as $dm) {
                $module = $dm['name'];
                $status = $dm['basic_status'];

                $db_vars = $module . '_status';
                $key = strtoupper($db_vars);
                $this->dbvars->$key = $status;
                if ($status == $this->dbvars->$key) {
                    $this->modules_model->changeMenus($module, $status);
                }
            }
            echo 'Module setting Completed <p>';

            $this->db->set('status', 0)
                    ->where('basic_status', 0)
                    ->update('menus');

            $this->db->set('original_link', 'home/index')
                    ->set('link', 'dashboard')
                    ->where('id', 1)
                    ->update('menus');

            $this->db->set('original_link', 'cart/index')
                    ->set('link', '../shopping-cart')
                    ->where('id', 185)
                    ->update('menus');

            $this->db->set('root_id', '145')
                    ->where('id', 21)
                    ->update('menus');

            $this->db->set('root_id', '59')
                    ->where('root_id', 61)
                    ->update('menus');


            echo 'Menu setting Completed <p>';

            $this->db->set('status', 0)
                    ->where('id !=', 1)
                    ->update('languages');

            $this->db->set('status', 0)
                    ->where('id !=', 1)
                    ->update('currencies');

            $this->db->set('status', 'inactive')
                    ->where('id !=', 1)
                    ->where('id !=', 3)
                    ->update('payment_methods');

            $this->db->set('status', '0')
                    ->where('basic_status', 0)
                    ->update('system_mails');
        }
    }

    public function getBasicMenus() {
        $basic_menus = NULL;
        $query = $this->db->select('basic_menus')
                ->where('id', 1)
                ->limit(1)
                ->get('configuration');
        if ($query->num_rows() > 0) {
            $basic_menus = unserialize($query->row()->basic_menus);
        }
        return $basic_menus;
    }

    public function getBasicModules() {
        $basic_modules = NULL;
        $query = $this->db->select('basic_modules')
                ->where('id', 1)
                ->limit(1)
                ->get('configuration');
        if ($query->num_rows() > 0) {
            $basic_modules = unserialize($query->row()->basic_modules);
        }
        return $basic_modules;
    }

    function getAllModules() {
        $data = array();
        $res = $this->db->select("id,name,basic_status")
                ->from("modules")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['name'] = $row->name;
            $data[$i]['basic_status'] = $row->basic_status;
            $i++;
        }
        return $data;
    }

}
