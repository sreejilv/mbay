<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * Controller used for reset functionalities 
 * For example cleanup database ,wipe the cache folder etc...
 * @author Techffodils Technologies LLP
 * @date 2017-12-18  
 */
class Reset extends Base_Controller {

    /**
     * For Cleanup the system database
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function clean() {
        $this->load->model('configuration_model');
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $langs = $this->configuration_model->getLanguages(1);
            $crns = $this->configuration_model->getCurrencies(1);
            $this->setData('langs', $langs);
            $this->setData('lang_id', $this->dbvars->DEFAULT_VALUE1);
            $this->setData('crns', $crns);
            $this->setData('crns_id', $this->dbvars->DEFAULT_VALUE2);
        }
        $cache_files = $this->reset_model->getCacheFileCount();
        $this->setData('cache_files', $cache_files);
        $this->setData('flag', $this->dbvars->MULTI_CURRENCY_STATUS);
        $this->setData('title', lang('menu_name_40'));
        $this->loadView();
    }

    /**
     * For chnage the database value
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function change_def_values() {
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        if ($get['def_crns'] && $get['def_lang']) {
            $this->dbvars->DEFAULT_VALUE1 = $get['def_lang'];
            $this->dbvars->DEFAULT_VALUE2 = $get['def_crns'];
            echo 'yes';
            exit();
        }
        echo 'no';
        exit();
    }

    /**
     * For cleanup the database
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function reset_dbvars() {
        $res = $this->reset_model->resetDbVars();
    }

    /**
     * For Clear the cache folder
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function wipe() {
        $logged_user_id = $profile_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->get('wipe_status')) {
            $res = $this->reset_model->wipeOutAllData();
            if ($res) {
                if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
                    $this->reset_model->updateDefaultSettings($this->dbvars->DEFAULT_VALUE1, $this->dbvars->DEFAULT_VALUE2);
                    $this->load->model('cron_job_model');
                    $this->cron_job_model->updateCurrencyRates($this->dbvars->DEFAULT_CURRENCY_CODE);
                }
                $this->reset_folders($logged_user_id);
                $this->helper_model->insertFailedActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'clean_up');
                echo 'yes';
                exit();
            } else {
                echo 'no';
                exit();
            }
        }
        die('Can`t Access This Page!');
    }

    /**
     * For Clear the cache folder
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    public function reset_folders($admin_id) {
        $folders = $this->reset_model->getAllResetFolders();
        foreach ($folders as $fol) {
            $path = $fol['folder_path'];
            $req_files = $fol['required_files'];
            $wanted_files = explode(",", $req_files);            
            if($path=='assets/images/users'){
                $wanted_files[]=$this->dbvars->Cover0;
                $wanted_files[]=$this->dbvars->Cover1;
                $wanted_files[]=$this->dbvars->Cover2;
                $wanted_files[]=$this->dbvars->Cover3;
                $wanted_files[]=$this->dbvars->Cover4;
                $wanted_files[]=$this->dbvars->Cover5;
                $wanted_files[]=$this->dbvars->Dp0;
                $wanted_files[]=$this->dbvars->Dp1;
                $wanted_files[]=$this->dbvars->Dp2;
                $wanted_files[]=$this->dbvars->Dp3;
                $wanted_files[]=$this->dbvars->Dp4;
                $wanted_files[]=$this->dbvars->Dp5;
                $wanted_files[]=$this->dbvars->Dp6;
                $wanted_files[]=$this->dbvars->Dp7;            
                $wanted_files[]=$this->reset_model->getAdminImages($admin_id,'user_dp');            
                $wanted_files[]=$this->reset_model->getAdminImages($admin_id,'user_cover');            
            }
            //chmod(FCPATH . $path, 0777);
            $complete_path = FCPATH . $path . '/*';
            $complete_files = glob($complete_path);
            foreach ($complete_files as $cf) {
                $flag = 0;
                foreach ($wanted_files as $wf) {
                    $wan_path = FCPATH . $path . '/' . $wf;
                    if ($wan_path == $cf) {
                        $flag = 1;
                    }
                }
                if (!$flag && is_file($cf)) {
                    unlink($cf);
                }
            }
        }
        return 1;
    }

}
