<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For system support Reset Model
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Reset_model extends CI_Model {

    /**
     * For cleanup all table details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function wipeOutAllData() {
        return $this->cleanAllTables();
    }

    /**
     * For cleanAllTables function 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function cleanAllTables() {
        $tables = array();
        $database_name = $this->db->database;
        $dbprefix = $this->db->dbprefix;
        $table_query = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='$database_name' AND TABLE_NAME LIKE '$dbprefix%' ");
        foreach ($table_query->result_array() AS $rows) {
            $tables[] = $rows['TABLE_NAME'];
        }

        $admin_id = $this->helper_model->getAdminId();
        $user_details = $this->getAdminDetails($admin_id);

        if (in_array($dbprefix . 'user', $tables)) {
            $this->db->truncate('user');
            $user = $dbprefix . "user";
            $this->db->query("ALTER TABLE $user AUTO_INCREMENT=$admin_id");
            $this->db->insert('user', $user_details);
        }
        if (in_array($dbprefix . 'user_details', $tables)) {
            $user_data = $this->getUserData($admin_id);
            $user_data['mlm_user_id'] = $admin_id;
            $this->db->truncate('user_details');
            $this->db->insert('user_details', $user_data);
        }
        if (in_array($dbprefix . 'user_balance', $tables)) {
            $this->db->truncate('user_balance');
            $user_balance_details = array(
                'mlm_user_id' => $admin_id,
                'balance_amount' => '0',
                'total_amount' => '0',
                'released_amount' => '0',
                'coupon_balance' => '1000'
            );
            $this->db->insert('user_balance', $user_balance_details);
        }
        if (in_array($dbprefix . 'theme_settings', $tables)) {
            $this->db->truncate('theme_settings');
            $theme_settings_details = array(
                'user_id' => $admin_id
            );
            $this->db->insert('theme_settings', $theme_settings_details);
        }

        $this->db->set('sales_count', 0)
                ->set('quantity', '3500')
                ->update('products');
        
        $this->db->set('reg_count', 0)
                ->update('countries');
        $this->db->set('reg_count', 0)
                ->update('states');

        if (in_array($dbprefix . 'activity', $tables)) {
            $this->db->truncate('activity');
        }
        if (in_array($dbprefix . 'leads', $tables)) {
            $this->db->truncate('leads');
        }

        if (in_array($dbprefix . 'inv_release_history', $tables)) {
            $this->db->truncate('inv_release_history');
        }

        if (in_array($dbprefix . 'traverse_father', $tables)) {
            $this->db->truncate('traverse_father');
            $traverse_father_details = array(
                'user_id' => $admin_id,
                'path' => 0
            );
            $this->db->insert('traverse_father', $traverse_father_details);
        }
        if (in_array($dbprefix . 'traverse_sponsor', $tables)) {
            $this->db->truncate('traverse_sponsor');
            $traverse_sponsor_details = array(
                'user_id' => $admin_id,
                'path' => 0
            );
            $this->db->insert('traverse_sponsor', $traverse_sponsor_details);
        }

        if (in_array($dbprefix . 'currency_values', $tables)) {
            $this->db->truncate('currency_values');
        }
        if (in_array($dbprefix . 'curl_history', $tables)) {
            $this->db->truncate('curl_history');
        }
        if (in_array($dbprefix . 'order_details', $tables)) {
            $this->db->truncate('order_details');
        }
        if (in_array($dbprefix . 'rank_history', $tables)) {
            $this->db->truncate('rank_history');
        }
        if (in_array($dbprefix . 'register_history', $tables)) {
            $this->db->truncate('register_history');
        }
        if (in_array($dbprefix . 'wallet_details', $tables)) {
            $this->db->truncate('wallet_details');
        }
        if (in_array($dbprefix . 'wallet_transfer', $tables)) {
            $this->db->truncate('wallet_transfer');
        }
        
        if (in_array($dbprefix . 'user_logins', $tables)) {
            $this->db->truncate('user_logins');
        }

        if (in_array($dbprefix . 'user_files', $tables)) {
            $this->db->truncate('user_files');
        }
        
        if (in_array($dbprefix . 'coin_payment_response', $tables)) {
            $this->db->truncate('coin_payment_response');
        }

        if (in_array($dbprefix . 'binary_bonus_history', $tables)) {
            $this->db->truncate('binary_bonus_history');
        }
        if (in_array($dbprefix . 'orders', $tables)) {
            $this->db->truncate('orders');
        }
        if (in_array($dbprefix . 'gift_requests', $tables)) {
            $this->db->truncate('gift_requests');
        }
        if (in_array($dbprefix . 'order_products', $tables)) {
            $this->db->truncate('order_products');
        }
        if (in_array($dbprefix . 'cron_job', $tables)) {
            $this->db->truncate('cron_job');
        }
        if (in_array($dbprefix . 'documents', $tables)) {
            $this->db->truncate('documents');
        }
        if (in_array($dbprefix . 'donations', $tables)) {
            $this->db->truncate('donations');
        }
        if (in_array($dbprefix . 'employee_details', $tables)) {
            $this->db->truncate('employee_details');
        }
        if (in_array($dbprefix . 'employee_login', $tables)) {
            $this->db->truncate('employee_login');
        }

        if (in_array($dbprefix . 'investment_history', $tables)) {
            $this->db->truncate('investment_history');
        }
        if (in_array($dbprefix . 'investment_user_balance', $tables)) {
            $this->db->truncate('investment_user_balance');
            $investment_details = array(
                'mlm_user_id' => $admin_id
            );
            $this->db->insert('investment_user_balance', $investment_details);
        }
        if (in_array($dbprefix . 'kyc_details', $tables)) {
            $this->db->truncate('kyc_details');
        }
        
        if (in_array($dbprefix . 'pair_calculation', $tables)) {
            $this->db->truncate('pair_calculation');
        }
        
        if (in_array($dbprefix . 'language_conversion', $tables)) {
            $this->db->truncate('language_conversion');
        }
        if (in_array($dbprefix . 'login_attempts', $tables)) {
            $this->db->truncate('login_attempts');
        }
        if (in_array($dbprefix . 'maintence_mode_history', $tables)) {
            $this->db->truncate('maintence_mode_history');
        }
        if (in_array($dbprefix . 'migration_files', $tables)) {
            $this->db->truncate('migration_files');
        }
        if (in_array($dbprefix . 'news', $tables)) {
            $this->db->truncate('news');
        }
        if (in_array($dbprefix . 'party', $tables)) {
            $this->db->truncate('party');
        }
        if (in_array($dbprefix . 'party_products', $tables)) {
            $this->db->truncate('party_products');
        }
        if (in_array($dbprefix . 'party_requests', $tables)) {
            $this->db->truncate('party_requests');
        }
        if (in_array($dbprefix . 'party_users', $tables)) {
            $this->db->truncate('party_users');
        }
        if (in_array($dbprefix . 'pending_registrations', $tables)) {
            $this->db->truncate('pending_registrations');
        }
        if (in_array($dbprefix . 'pin_numbers', $tables)) {
            $this->db->truncate('pin_numbers');
        }
        if (in_array($dbprefix . 'pin_request', $tables)) {
            $this->db->truncate('pin_request');
        }
        if (in_array($dbprefix . 'testimonial', $tables)) {
            $this->db->truncate('testimonial');
        }
        if (in_array($dbprefix . 'ticket', $tables)) {
            $this->db->truncate('ticket');
        }
        if (in_array($dbprefix . 'ticket_replies', $tables)) {
            $this->db->truncate('ticket_replies');
        }
        if (in_array($dbprefix . 'user_payment_config', $tables)) {
            $this->db->truncate('user_payment_config');

            $details = array(
                'user_id' => $admin_id                
            );
            $this->db->insert('user_payment_config', $details);

        }
        if (in_array($dbprefix . 'messages', $tables)) {
            $this->db->truncate('messages');
        }
        if (in_array($dbprefix . 'events', $tables)) {
            $this->db->truncate('events');
        }
        if (in_array($dbprefix . 'mail_system', $tables)) {
            $this->db->truncate('mail_system');
        }
        if (in_array($dbprefix . 'mlm_track', $tables)) {
            $this->db->truncate('mlm_track');
        }
        if (in_array($dbprefix . 'cms_visitors', $tables)) {
            $this->db->truncate('cms_visitors');
        }
        if (in_array($dbprefix . 'cms_ci_sessions', $tables)) {
            $this->db->truncate('cms_ci_sessions');
        }
        if (in_array($dbprefix . 'affiliates', $tables)) {
            $this->db->truncate('affiliates');
        }
        if (in_array($dbprefix . 'affiliate_activity', $tables)) {
            $this->db->truncate('affiliate_activity');
        }
        if (in_array($dbprefix . 'issues', $tables)) {
            $this->db->truncate('issues');
        }
        if (in_array($dbprefix . 'reset_password', $tables)) {
            $this->db->truncate('reset_password');
        }
        if (in_array($dbprefix . 'ip_blacklist', $tables)) {
            $this->db->truncate('ip_blacklist');
        }
        if (in_array($dbprefix . 'ip_whitelist', $tables)) {
            $this->db->truncate('ip_whitelist');
        }
        if (in_array($dbprefix . 'return', $tables)) {
            $this->db->truncate('return');
        }
        
        if (in_array($dbprefix . 'user_kyc', $tables)) {
            $this->db->truncate('user_kyc');
        }

        if ($_SERVER['HTTP_HOST'] != 'localhost') {
            if (in_array($dbprefix . 'translated_files', $tables)) {
                $this->db->truncate('translated_files');
            }
            if (in_array($dbprefix . 'translator_history', $tables)) {
                $this->db->truncate('translator_history');
            }
        }

        if ($this->dbvars->OC_STATUS) {
            $oc_admin_id = 1;
            if (in_array($dbprefix . 'oc_customer', $tables)) {
                $oc_user_details = $this->getAdminDetailsOC($oc_admin_id);                
                $this->db->truncate('oc_customer');
                $this->db->insert('oc_customer', $oc_user_details);
            }

            if (in_array($dbprefix . 'oc_address', $tables)) {
                $oc_user_data = $this->getUserDataOC($oc_admin_id);
                $this->db->truncate('oc_address');
                $this->db->insert('oc_address', $oc_user_data);
            }

            if (in_array($dbprefix . 'oc_order_voucher', $tables)) {
                $this->db->truncate('oc_order_voucher');
            }

            if (in_array($dbprefix . 'oc_order_total', $tables)) {
                $this->db->truncate('oc_order_total');
            }

            if (in_array($dbprefix . 'oc_order_recurring_transaction', $tables)) {
                $this->db->truncate('oc_order_recurring_transaction');
            }

            if (in_array($dbprefix . 'oc_order_shipment', $tables)) {
                $this->db->truncate('oc_order_shipment');
            }

            if (in_array($dbprefix . 'oc_order_product', $tables)) {
                $this->db->truncate('oc_order_product');
            }

            if (in_array($dbprefix . 'oc_order_recurring', $tables)) {
                $this->db->truncate('oc_order_recurring');
            }

            if (in_array($dbprefix . 'oc_customer_transaction', $tables)) {
                $this->db->truncate('oc_customer_transaction');
            }

            if (in_array($dbprefix . 'oc_customer_wishlist', $tables)) {
                $this->db->truncate('oc_customer_wishlist');
            }

            if (in_array($dbprefix . 'oc_order', $tables)) {
                $this->db->truncate('oc_order');
            }

            if (in_array($dbprefix . 'oc_order_history', $tables)) {
                $this->db->truncate('oc_order_history');
            }

            if (in_array($dbprefix . 'oc_customer_reward', $tables)) {
                $this->db->truncate('oc_customer_reward');
            }

            if (in_array($dbprefix . 'oc_customer_online', $tables)) {
                $this->db->truncate('oc_customer_online');
            }

            if (in_array($dbprefix . 'oc_customer_login', $tables)) {
                $this->db->truncate('oc_customer_login');
            }

            if (in_array($dbprefix . 'oc_customer_affiliate', $tables)) {
                $this->db->truncate('oc_customer_affiliate');
            }

            if (in_array($dbprefix . 'oc_customer_approval', $tables)) {
                $this->db->truncate('oc_customer_approval');
            }

            if (in_array($dbprefix . 'oc_customer_history', $tables)) {
                $this->db->truncate('oc_customer_history');
            }

            if (in_array($dbprefix . 'oc_customer_activity', $tables)) {
                $this->db->truncate('oc_customer_activity');
            }

            if (in_array($dbprefix . 'oc_curl_history', $tables)) {
                $this->db->truncate('oc_curl_history');
            }

            if (in_array($dbprefix . 'oc_cart', $tables)) {
                $this->db->truncate('oc_cart');
            }

            if (in_array($dbprefix . 'oc_customer_approval', $tables)) {
                $this->db->truncate('oc_customer_approval');
            }

            if (in_array($dbprefix . 'oc_customer_ip', $tables)) {
                $this->db->truncate('oc_customer_ip');
            }

            if (in_array($dbprefix . 'oc_customer_search', $tables)) {
                $this->db->truncate('oc_customer_search');
            }

            if (in_array($dbprefix . 'oc_order_option', $tables)) {
                $this->db->truncate('oc_order_option');
            }

            if (in_array($dbprefix . 'oc_return', $tables)) {
                $this->db->truncate('oc_return');
            }

            if (in_array($dbprefix . 'oc_return_history', $tables)) {
                $this->db->truncate('oc_return_history');
            }

            if (in_array($dbprefix . 'oc_session', $tables)) {
                $this->db->truncate('oc_session');
            }

            if (in_array($dbprefix . 'oc_voucher', $tables)) {
                $this->db->truncate('oc_voucher');
            }
        }

        return TRUE;
    }

    /**
     * For getting administration details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $admin_id
     * @return type
     */
    function getAdminDetails($admin_id) {

        $data = array();
        $res = $this->db->select("user_name,email,password,customer_id,tran_password,user_type,user_status,date,language,currency,banned")
                ->from("user")
                ->where("mlm_user_id", $admin_id)
                ->limit(1)
                ->get();
        foreach ($res->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * For getting the user details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function getUserData($user_id) {
        $data = array();
        $res = $this->db->select("*")
                ->from("user_details")
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get();
        foreach ($res->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * 
     * For update default settings 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $lang
     * @param type $crncy
     */
    function updateDefaultSettings($lang, $crncy) {
        if ($lang) {
            $data = $this->getLanguageDetails($lang);
            $this->dbvars->LANG_ID = $lang;
            $this->dbvars->LANG_CODE = $data['lang_code'];
            $this->dbvars->LANG_FLAG = $data['lang_flag'];
            $this->dbvars->LANG_NAME = $data['lang_name'];
        }
        if ($crncy) {
            $data = $this->getCurrencyDetails($crncy);
            $this->dbvars->DEFAULT_CURRENCY_ID = $crncy;
            $this->dbvars->DEFAULT_CURRENCY_VALUE = '1';
            $this->dbvars->DEFAULT_CURRENCY_CODE = $data['currency_code'];
            $this->dbvars->DEFAULT_CURRENCY_NAME = $data['currency_name'];
            $this->dbvars->DEFAULT_SYMBOL_LEFT = $data['symbol_left'];
            $this->dbvars->DEFAULT_SYMBOL_RIGHT = $data['symbol_right'];
            $this->dbvars->DEFAULT_CURRENCY_ICON = $data['icon'];
        }
    }

    /**
     * For getting Currency Details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getCurrencyDetails($id) {
        $data = array();
        $res = $this->db->select("id,currency_code,currency_name,icon,symbol_left,symbol_right")
                ->from("currencies")
                ->where("id", $id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $data['currency_code'] = $row->currency_code;
            $data['currency_name'] = $row->currency_name;
            $data['symbol_left'] = $row->symbol_left;
            $data['symbol_right'] = $row->symbol_right;
            $data['icon'] = $row->icon;
        }
        return $data;
    }

    /**
     * For getting Language Details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getLanguageDetails($id) {
        $data = array();
        $res = $this->db->select("lang_code,lang_name,lang_flag")
                ->from("languages")
                ->where('id', $id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $data['lang_code'] = $row->lang_code;
            $data['lang_name'] = $row->lang_name;
            $data['lang_flag'] = $row->lang_flag;
        }
        return $data;
    }

    /**
     * For getting Currency Details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getAllResetFolders() {
        $data = array();
        $res = $this->db->select("folder_path,required_files")
                ->from("reset_folders")
                ->where("status", '1')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['folder_path'] = $row->folder_path;
            $data[$i]['required_files'] = $row->required_files;
            $i++;
        }
        return $data;
    }

    /**
     * For getting Cache file Count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getCacheFileCount() {
        $directory = FCPATH . 'application/cache';
        $fi = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory)
        );
        return iterator_count($fi);
    }

    function getAdminDetailsOC($oc_admin_id) {
        $data = array();
        $res = $this->db->select("username,store_id,customer_group_id,language_id,replicate_status,firstname,lastname,telephone,password,salt,address_id,status,email,date_added")
                ->from("oc_customer")
                ->where("customer_id", $oc_admin_id)
                ->limit(1)
                ->get();
        foreach ($res->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    function getUserDataOC($oc_admin_id) {
        $data = array();
        $res = $this->db->select("*")
                ->from("oc_address")
                ->where("customer_id", $oc_admin_id)
                ->limit(1)
                ->get();
        foreach ($res->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    public function getAdminImages($admin_id,$field) {
        $image = NULL;
        $query = $this->db->select("$field")
                ->where('mlm_user_id', $admin_id)
                ->limit(1)
                ->get('user_details');
        if ($query->num_rows() > 0) {
            $image = $query->row()->$field;
        }
        return $image;
    }
    
}
