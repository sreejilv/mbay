<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * For cron job related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    cron job
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Cron_job_model extends CI_Model {

    /**
     * for inserting cron job history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $cron_job
     * @param type $done_by
     * @return type
     */
    function insertCronJobHistory($cron_job, $done_by = "Cron Job") {
        $this->db->set('cron_job', $cron_job)
                ->set('status', 'Started')
                ->set('done_by', $done_by)
                ->set('ip', $this->helper_model->getUserIP())
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('cron_job');

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * for updating cron job history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies G
     * 
     * @param type $cron_job_id
     * @param type $status
     * @return type
     */
    function updateCronJobHistory($cron_job_id, $status = 'NA') {
        $this->db->set('status ', "$status")
                ->where('id ', "$cron_job_id")
                ->update('cron_job');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for generating database backup
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $insert_id
     * @param type $backup_type
     * @param type $backup_deletion_period
     * @return type
     */
    function generateBackup($insert_id) {
        $backup_type = $this->dbvars->BACKUP_TYPE;
        $backup_deletion_period = $this->dbvars->BACKUP_DELETION_PERIOD;

        $compression = FALSE;
        if ($backup_type == 'zip') {
            $compression = TRUE;
        }
        $this->load->model("backup_model");
        $this->backup_model->deleteOlderBackup($backup_deletion_period);
        return $this->backup_model->generateBackup($insert_id, $compression);
    }

    /**
     * for updaing currency rates
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $default_currency
     * @return type
     */
    public function updateCurrencyRates($default_currency) {
//http://fixer.io/
        $flag = FALSE;
        $result = 0;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://api.fixer.io/latest?base=' . $default_currency);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $content = curl_exec($curl);
        curl_close($curl);

        $decodedText = html_entity_decode($content);
        $data = json_decode($decodedText, true);
        if (isset($data['base'])) {
            if ($data['base'] == $default_currency) {
                $rates = $data['rates'];
                $currencies = $this->getAllCurrencies();
                $this->resetAllConversionStatus($default_currency);
                foreach ($currencies as $value) {
                    $code = $value['code'];
                    //echo "<p>$code///";
                    if (isset($rates[$code])) {
                        $result = $this->updateCurrencyRatio($code, $rates[$code]);
                    }
                    if ($code == 'BTC') {
                        $flag = TRUE;
                    }
                }
            }
        }

        if ($flag) {//updation for BTC
            $btc_value = file_get_contents("https://blockchain.info/tobtc?currency=$default_currency&value=1");
            if ($btc_value > 0) {
                $this->updateCurrencyRatio('BTC', $btc_value);
            }
//            $curl = curl_init();
//            curl_setopt($curl, CURLOPT_URL, "https://blockchain.info/tobtc?currency=$default_currency&value=1");
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($curl, CURLOPT_HEADER, false);
//            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
//            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
//            $btc_value = curl_exec($curl);
//            curl_close($curl);
//            if($btc_value>0){
//                $this->updateCurrencyRatio('BTC',$btc_value);
//            }
        }
        $this->updateCurrencyRatio($default_currency, 1);

        return $result;
    }

    /**
     * for getting all currencies
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getAllCurrencies() {
        $data = array();
        $res = $this->db->select("id,currency_code")
                ->from("currencies")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['code'] = $row->currency_code;
            $i++;
        }
        return $data;
    }

    /**
     * for resetting all currency conversions
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $default_currency
     * @return type
     */
    public function resetAllConversionStatus($default_currency) {
        $this->db->set('conversion_status ', "no")
                ->where('currency_code !=', $default_currency)
                ->update('currencies');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating currency ratio
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $code
     * @param type $ratio
     * @return type
     */
    public function updateCurrencyRatio($code, $ratio) {
        $this->db->set('conversion_status ', "yes")
                ->set('currency_ratio ', $ratio)
                ->where('currency_code', $code)
                ->update('currencies');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for destribute generation bonus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return boolean
     */
    public function distributeGenerationBonus() {
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $obj_class = "plan_" . strtolower($mlm_plan) . "_model";
        include_once("Plan_" . strtolower($mlm_plan) . "_model.php");
        $plan_obj = new $obj_class();
        $this->setGenerationStatus(0);
        $start = $this->setGenerationStatus(1);
        if ($start) {
            $users_array = $this->getCronUsers(100);
            while ($users_array) {
                foreach ($users_array as $users) {
                    $this->base_model->transactionStart();
                    $result = $plan_obj->distributeGenerationBonus($users['mlm_user_id'], $users['user_rank_id']);
                    if ($result) {
                        $complete = $this->changeStatus($users['mlm_user_id'], 0);
                        if ($complete && $this->base_model->transationCheck()) {
                            $this->base_model->transationCommit();
                        } else {
                            $this->base_model->transationRollback();
                        }
                    } else {
                        $this->base_model->transationRollback();
                    }
                }
                $users_array = $this->getCronUsers(100);
            }
        } else {
            return false;
        }
        return true;
    }

    /**
     * 
     * for setting generation status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $type
     * @return boolean
     */
    public function setGenerationStatus($type) {
        $result = false;
        $this->db->set('cron_status', $type)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * 
     * for getting user rank id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $limit
     * @return type
     */
    public function getCronUsers($limit) {
        $users_array = array();
        $query = $this->db->select('mlm_user_id, user_rank_id')
                ->where('cron_status', 1)
                ->limit($limit)
                ->order_by('date', 'DESC')
                ->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $users_array[] = $row;
            }
        }
        return $users_array;
    }

    /**
     * for changing user cron status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $user_id
     * @param type $type
     * @return boolean
     */
    public function changeStatus($user_id, $type) {
        $result = false;
        $this->db->set('cron_status', $type)
                ->where('mlm_user_id', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * for destributing investment bonus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    public function distributeInvestmentBonus() {
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $obj_class = "plan_" . strtolower($mlm_plan) . "_model";
        include_once("Plan_" . strtolower($mlm_plan) . "_model.php");
        $plan_obj = new $obj_class();
        $investment_array = $this->configuration_model->getInvestmentDetails();
        $start = $this->setCronStatus(1);
        if ($start) {
            $users_array = $this->getCronUsers(100);
            while ($users_array) {
                foreach ($users_array as $users) {
                    $this->base_model->transactionStart();
                    $result = $plan_obj->distributeInvestmentBonus($users['mlm_user_id'], $investment_array);
                    if ($result) {
                        $complete = $this->changeStatus($users['mlm_user_id'], 0);
                        if ($complete && $this->base_model->transationCheck()) {
                            $this->base_model->transationCommit();
                        } else {
                            $this->base_model->transationRollback();
                        }
                    } else {
                        $this->base_model->transationRollback();
                    }
                }
                $users_array = $this->getCronUsers(100);
            }
        }
        return TRUE;
    }

    /**
     * for setting cron status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $type
     * @return boolean
     */
    public function setCronStatus($type) {
        $result = false;
        $this->db->set('cron_status', $type)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * for deleting sub folders in cache
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param string $dirPath
     * @return boolean
     */
    public function deleteDir($dirPath) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        $del = FCPATH . "/application/cache/";
        if ($dirPath != $del) {
            rmdir($dirPath);
            return true;
        }
        return true;
    }

    /**
     * for auto responder
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    function autoResponder() {
        $this->load->model('send_mail_model');
        $data = array();
        $query = $this->db->select("id,email")
                ->from("leads")
                ->where('status', '1')
                ->get();
        foreach ($query->result() as $row) {
            $id = $row->id;
            $email = $row->email;
            $first_name = $row->first_name;
            $last_name = $row->last_name;

            $data['fullname'] = $first_name . '' . $last_name;
            $res = $this->send_mail_model->send('', $email, 'lcp', $data);
            if ($res) {
                $this->db->set('status ', 0)
                        ->where('id ', $id)
                        ->update('leads');
            }
        }
        return TRUE;
    }

    /**
     * for destributing stairstep bonus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return boolean
     */
    public function distributeStairStepBonus() {
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $obj_class = "plan_" . strtolower($mlm_plan) . "_model";
        include_once("Plan_" . strtolower($mlm_plan) . "_model.php");
        $plan_obj = new $obj_class();
        $this->setCronStatus(0);
        $start = $this->setCronStatus(1);
        if ($start) {
            $users_array = $this->getCronUsers(100);
            while ($users_array) {
                foreach ($users_array as $users) {
                    $this->base_model->transactionStart();
                    $result = $plan_obj->distributeStairStepBonus($users['mlm_user_id']);
                    if ($result) {
                        $complete = $this->changeStatus($users['mlm_user_id'], 0);
                        if ($complete && $this->base_model->transationCheck()) {
                            $this->base_model->transationCommit();
                        } else {
                            $this->base_model->transationRollback();
                        }
                    } else {
                        $this->base_model->transationRollback();
                    }
                }
                $users_array = $this->getCronUsers(100);
            }
        } else {
            return false;
        }
        return true;
    }

    /**
     * for updating activity location
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies G
     * 
     * @param 
     * @param 
     * @return response
     */
    function updateLocation() {
        $data = array();
        $query = $this->db->select("ip_address")
                ->group_by('ip_address')
                ->from("activity")
                ->limit(50)
                ->where('location_status', 0)
                ->get();
        foreach ($query->result() as $row) {
            $ip_address = $row->ip_address;
            $result = json_decode(file_get_contents("http://ip-api.io/json/$ip_address"));
            if ($result && isset($result->country_name)) {
                $this->db->set('country', $result->country_name)
                        ->set('region', $result->region_name)
                        ->set('city', $result->city)
                        ->set('location_details', serialize($result))
                        ->set('location_status', 1)
                        ->where('location_status', 0)
                        ->where('ip_address', $ip_address)
                        ->update('activity');
            }
        }

        if ($this->dbvars->AFFILIATES_STATUS > 0) {
            $query = $this->db->select("ip_address")
                    ->group_by('ip_address')
                    ->from("affiliate_activity")
                    ->limit(50)
                    ->where('location_status', 0)
                    ->get();
            foreach ($query->result() as $row) {
                $ip_address = $row->ip_address;
                $result = json_decode(file_get_contents("http://ip-api.io/json/$ip_address"));
                if ($result && isset($result->country_name)) {
                    $this->db->set('country', $result->country_name)
                            ->set('region', $result->region_name)
                            ->set('city', $result->city)
                            ->set('location_details', serialize($result))
                            ->set('location_status', 1)
                            ->where('location_status', 0)
                            ->where('ip_address', $ip_address)
                            ->update('affiliate_activity');
                }
            }
        }

        return TRUE;
    }

    /**
     * for updating activity location
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies G
     * 
     * @param 
     * @param 
     * @return response
     */
    function sendBdayMsgs() {
        $data['subject'] = 'Birth Day Notification';
        $data['images'] = '';
        $data['date'] = date("Y-m-d 00:00:01");
        $data['read_status'] = 'unread';

        $this->load->model('mail_model');
        $query = $this->db->select("mlm_user_id,first_name,last_name")
                ->from("user_details")
                ->like('date_of_birth', date("d/m/"))
                ->get();
        foreach ($query->result() as $row) {
            $from_id = $this->helper_model->getAdminId();
            $user_id = $row->mlm_user_id;
            if ($from_id != $user_id) {
                $data['user_id'] = $user_id;
                $data['from_id'] = $from_id;
                $data['catagories'] = 'inbox';
                $data['content'] = 'Happy Birth Day ' . $row->first_name . ' ' . $row->last_name;
                $res = $this->mail_model->insertMailData($data);
                if ($res) {
                    $data['from_id'] = $user_id;
                    $data['user_id'] = $from_id;
                    $data['catagories'] = 'sent';
                    $mail_res = $this->mail_model->insertMailData($data);
                }
            }
        }
        return TRUE;
    }

    function automaticPayout() {
        $data = array();
        $query = $this->db->select("mlm_user_id,balance_amount")
                ->from("user_balance")
                ->where('balance_amount >', 0)
                ->where('mlm_user_id !=', 1900)
                ->get();
        foreach ($query->result() as $row) {
            $mlm_user_id = $row->mlm_user_id;
            $balance_amount = $row->balance_amount;

            $result = $this->helper_model->insertWalletDetails($mlm_user_id, 'debit', $balance_amount, 'payout_requested', $mlm_user_id, $mlm_user_id);
        }
        return TRUE;
    }

    function checkAutomaticPayoutStatus() {
        $flag = FALSE;
        $query = $this->db->select('automatic_payout_status')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('configuration');
        if ($query->num_rows() > 0) {
            if ($query->row()->automatic_payout_status == 'active') {
                $flag = TRUE;
            }
        }
        return $flag;
    }

    function clearDatabase() {
        $days = $this->dbvars->OPTIMIZE_LIMIT;
        $deleting_day = date('Y-m-d', strtotime("-$days days"));
        $this->load->dbutil();
        $this->load->helper('file');
        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $res = $this->db->select("table_name,date_fleld")
                ->from("db_optimize")
                ->where('status', 1)
                ->get();
        foreach ($res->result() as $row) {
            $table_name = $row->table_name;
            $date_fleld = $row->date_fleld;

            $query = $this->db->select("*")
                    ->from("$table_name")
                    ->where("$date_fleld <", $deleting_day)
                    ->get();
            if ($query->num_rows() > 0) {
                $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
                if ($data) {
                    $file = $table_name . '-' . date('Y-m-d') . '.csv';
                    $path = FCPATH . "application/backup/optimize/" . $file;
                    if (write_file("$path", $data)) {
                        $this->db->where("$date_fleld <", $deleting_day)
                                ->delete("$table_name");
                    }
                }
            }
        }
        return TRUE;
    }

}
