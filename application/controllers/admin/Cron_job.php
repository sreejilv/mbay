<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * For cron job function are declare under this controller
 * For example database backup
 * For cash clear etc 
 */
class Cron_Job extends Base_Controller {

    /**
     * Prevent direct access to this controller via URL
     *
     * @access public
     * @param  string $method name of method to call
     * @param  array  $params Parameters that would normally get passed on to the method
     * @return void
     */
    public function _remap($method, $params = array()) {
        // get controller name
        $controller = mb_strtolower(get_class($this));

        if ($controller === mb_strtolower($this->uri->segment(2))) {
            // if requested controller and this controller have the same name
            // show 404 error
            show_404();
        } elseif (method_exists($this, $method)) {
            // if method exists
            // call method and pass any parameters we recieved onto it.
            return call_user_func_array(array($this, $method), $params);
        } else {
            // method doesn't exist, show error
            show_404();
        }
    }

    /**
     * For Daily Cron For Database Backup
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function db_backup($done_by = 'Cron Job') {//Daily Cron For Database Backup
        $insert_id = $this->cron_job_model->insertCronJobHistory('db_backup', $done_by);
        $res = $this->cron_job_model->generateBackup($insert_id);
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

    /**
     * For Cashe Clear
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function cashe_clr() {//Daily Cron For Clear Cache
        $insert_id = $this->cron_job_model->insertCronJobHistory('cashe_clr');
        $path = FCPATH . "/application/cache";
        $res = $this->cron_job_model->deleteDir($path);
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo "yes";
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo "no";
            exit();
        }
    }

    /**
     * For Updating Activity Location
     * @author Techffodils Technologies LLP
     * Run Quarterly
     * @date 2018-1-30
     */
    function update_activity_location() {
        $insert_id = $this->cron_job_model->insertCronJobHistory('location_updation');
        $res = $this->cron_job_model->updateLocation();
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

    /**
     * For Reducing Database Size
     * @author Techffodils Technologies LLP
     * @date 2019-11-29
     */
    function clear_database() {
        if ($this->dbvars->DB_OPTIMIZE_STATUS) {
            $insert_id = $this->cron_job_model->insertCronJobHistory('clear_database');
            $res = $this->cron_job_model->clearDatabase();
            if ($res) {
                $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
                echo 'yes';
                exit();
            } else {
                $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
                echo 'no';
                exit();
            }
        }
    }

    /**
     * For Sending Birthday Wish
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function send_bday_msg() {
        $insert_id = $this->cron_job_model->insertCronJobHistory('bday_msg_cron');
        $res = $this->cron_job_model->sendBdayMsgs();
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

    /**
     * For Automatic Payout
     * @author Techffodils Technologies LLP
     * @date 2019-2-20
     */
    function automatic_payout() {
        if ($this->cron_job_model->checkAutomaticPayoutStatus()) {
            $insert_id = $this->cron_job_model->insertCronJobHistory('automatic_payout');
            $res = $this->cron_job_model->automaticPayout();
            if ($res) {
                $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
                echo 'yes';
                exit();
            } else {
                $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
                echo 'no';
                exit();
            }
        }
    }

    /**
     * For auto responder setting for example auto responder
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function auto_responder() {//Daily Cron For Lead-Auto Responder
        $insert_id = $this->cron_job_model->insertCronJobHistory('auto_responder');
        $res = $this->cron_job_model->autoResponder();
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

    /**
     * for update currency rate
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function update_currency_rate() {//Daily Cron For Update Currency Values 
        //sudo apt-get install php7.0-curl
        if ($this->dbvars->MULTI_CURRENCY_STATUS) {
            $default_currency = $this->dbvars->DEFAULT_CURRENCY_CODE;
            $insert_id = $this->cron_job_model->insertCronJobHistory('update_currency_rate');
            $res = $this->cron_job_model->updateCurrencyRates($default_currency);
            if ($res) {
                $this->helper_model->insertTodayCurrencyValues();
                $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
                echo 'yes';
                exit();
            } else {
                $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
                echo 'no';
                exit();
            }
        }
    }

    /**
     * For Monthly Cron for Generation Bonus
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function run_generation_calculation() {//Monthly Cron for Generation Bonus
        $insert_id = $this->cron_job_model->insertCronJobHistory('generation_bonus');
        $res = $this->cron_job_model->distributeGenerationBonus();
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

    /**
     * For run the investment Calculation
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function run_investment_calculations() {
        $insert_id = $this->cron_job_model->insertCronJobHistory('investment_bonus');
        $res = $this->cron_job_model->distributeInvestmentBonus();
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

    /**
     * For stair step calculations
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function run_stair_step_clculations() {
        $insert_id = $this->cron_job_model->insertCronJobHistory('stair_step_bonus');
        $res = $this->cron_job_model->distributeStairStepBonus();
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
            echo 'yes';
            exit();
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
            echo 'no';
            exit();
        }
    }

}
