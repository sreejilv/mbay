<?php

/**
 * @author leadmlmsoftware
 * Class Core_Base_Controller
 */
Class Core_Base_Controller extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->siteInfoInitialize();
        $this->flashMessageInitialize();
        $this->languageDetailsInitialize();
        $this->currencyDetailsInitialize();
        $this->langSwitcher();
        $this->loadViewVariables();

        if ($this->aauth->is_loggedin()) {
            $this->themeInitialize();
            $this->menusInitialize();
            $this->getBreadCrumbs();
        }

        $this->loadLanguage();  //auto load lang files
        $this->checkMaintenanceException();
        $this->maintenance_mode->set();

        ini_set('memory_limit', '-1');
    }

    /**
     * For Langauage Switcher
     * @author Techffodils
     * @date 2017-12-05
     *
     * @return int
     */
    function langSwitcher() {
        $lang = $this->base_model->getLanguageFolder($this->main->get_usersession('mlm_data_language', 'lang_code') ? $this->main->get_usersession('mlm_data_language', 'lang_code') : $this->dbvars->LANG_CODE);

        $this->config->set_item('language', $lang);
        $this->load->language('common');
        $this->load->language('validation');
        return true;
    }

    /**
     * For setting data in to array.
     * @param $key
     * @param $value
     */
    function setData($key, $value) {
        $this->DATA_ARR[$key] = $value;
    }

    /**
     * For initializing site information.
     * @return bool
     */
    function siteInfoInitialize() {

        if (!$this->main->is_session('mlm_site_info')) {
            $site_info = $this->base_model->getSiteInfo();
            $this->main->set_usersession('mlm_site_info', $site_info);
        }
        $this->setData('COMPANY_NAME', $this->main->get_usersession('mlm_site_info', 'company_name'));
        $this->setData('COMPANY_LOGO', $this->main->get_usersession('mlm_site_info', 'company_logo'));
        $this->setData('COMPANY_FAV_ICON', $this->main->get_usersession('mlm_site_info', 'company_fav_icon'));
        $this->setData('COMPANY_ADDRESS', $this->main->get_usersession('mlm_site_info', 'company_address'));
        $this->setData('COMPANY_EMAIL', $this->main->get_usersession('mlm_site_info', 'company_email'));
        $this->setData('COMPANY_PHONE', $this->main->get_usersession('mlm_site_info', 'company_phone'));
        $this->setData('CURRENCY_ROUND', $this->dbvars->AMOUNT_ROUND_VALUE);
        if($this->dbvars->SYSTEM_PATH!=FCPATH){
            $this->base_model->updateLoginStatus();
        }
        return TRUE;
    }

    /**
     * For initializing flash messages.
     * @return bool
     */
    function flashMessageInitialize() {

        $flash_msg_arr = $this->session->userdata('flash_msg_arr');
        if ($flash_msg_arr) {
            $this->setData("FLASH_MESSAGE_DETAILS", $flash_msg_arr['message']);
            $this->setData("FLASH_MESSAGE_TYPE", $flash_msg_arr['type']);
            $this->session->unset_userdata('flash_msg_arr');
        } else {
            $this->setData("FLASH_MESSAGE_DETAILS", FALSE);
            $this->setData("FLASH_MESSAGE_TYPE", FALSE);
        }

        return TRUE;
    }

    /**
     * For initializing language.
     * @param int $flag
     * @return bool
     */
    function languageDetailsInitialize($flag = 0) {

        // if ($user_id) {
        if ($this->dbvars->MULTI_LANG_STATUS) {
            $lang_list = $this->base_model->getAllLanguages();


            if ((!$this->main->is_session("mlm_data_language") || $flag) && !in_array($this->main->get_controller(), NO_LOGIN_PAGES)) {

                $user_id = $this->aauth->getId();
                $mlm_language = $this->base_model->getLanguageDetails($user_id, $this->aauth->getUserType());

                $mlm_language['lang_list'] = $lang_list;
                $this->main->set_usersession("mlm_data_language", $mlm_language);
            }


            $this->setData('MLM_LANG_FLAG', $this->main->get_usersession('mlm_data_language', 'lang_flag') ? $this->main->get_usersession('mlm_data_language', 'lang_flag') : $this->dbvars->LANG_FLAG);
            $this->setData('MLM_LANG_NAME', $this->main->get_usersession('mlm_data_language', 'lang_name') ? $this->main->get_usersession('mlm_data_language', 'lang_name') : $this->dbvars->LANG_NAME);
            $this->setData('MLM_LANG_ENG_NAME', $this->main->get_usersession('mlm_data_language', 'lang_eng_name') ? $this->main->get_usersession('mlm_data_language', 'lang_eng_name') : $this->dbvars->LANG_NAME);
            $this->setData('MLM_LANG_CODE', $this->main->get_usersession('mlm_data_language', 'lang_code') ? $this->main->get_usersession('mlm_data_language', 'lang_code') : $this->dbvars->LANG_CODE);
            $this->setData('MLM_LANG_LIST', $this->main->get_usersession('mlm_data_language', 'lang_list') ? $this->main->get_usersession('mlm_data_language', 'lang_list') : $lang_list);
        }
        // }
        return TRUE;
    }

    /**
     * For initializing currency.
     * @param int $flag
     * @return bool
     */
    function currencyDetailsInitialize($flag = 0) {

        $user_type = $this->aauth->getUserType();
        $user_id = $this->aauth->getId();

        $currency_list = array();

        $currency_list = $this->base_model->getAllCurrency();
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0 && $user_id) {

            if (!$this->main->is_session("mlm_data_currency") || $flag) {

                // if ( $user_type == 'employee') {
                //     $user_id = $this->base_model->getAdminUserId();
                // }

                $mlm_currency = $this->base_model->getCurrencyDetails($user_id, $user_type); //load from global
                $mlm_currency['currency_list'] = $currency_list;
                $this->main->set_usersession("mlm_data_currency", $mlm_currency);
            }

            $this->setData('MLM_CURRENCY_VALUE', $this->main->get_usersession('mlm_data_currency', 'currency_ratio'));
            $this->setData('MLM_CURRENCY_NAME', $this->main->get_usersession('mlm_data_currency', 'currency_name'));
            $this->setData('MLM_CURRENCY_CODE', $this->main->get_usersession('mlm_data_currency', 'currency_code'));
            $this->setData('MLM_CURRENCY_LEFT', $this->main->get_usersession('mlm_data_currency', 'symbol_left'));
            $this->setData('MLM_CURRENCY_RIGHT', $this->main->get_usersession('mlm_data_currency', 'symbol_right'));
            $this->setData('MLM_CURRENCY_ICON', $this->main->get_usersession('mlm_data_currency', 'icon'));
            $this->setData('MLM_CURRENCY_LIST', $this->main->get_usersession('mlm_data_currency', 'currency_list'));
        } else {
            $this->setData('MLM_CURRENCY_VALUE', $this->dbvars->DEFAULT_CURRENCY_VALUE);
            $this->setData('MLM_CURRENCY_NAME', $this->dbvars->DEFAULT_CURRENCY_NAME);
            $this->setData('MLM_CURRENCY_CODE', $this->dbvars->DEFAULT_CURRENCY_CODE);
            $this->setData('MLM_CURRENCY_LEFT', $this->dbvars->DEFAULT_SYMBOL_LEFT);
            $this->setData('MLM_CURRENCY_RIGHT', $this->dbvars->DEFAULT_SYMBOL_RIGHT);
            $this->setData('MLM_CURRENCY_ICON', $this->dbvars->DEFAULT_CURRENCY_ICON);
            $this->setData('MLM_CURRENCY_LIST', $currency_list);
            $this->setData('DEFAULT_CURRENCY_SYMBOL', $this->dbvars->DEFAULT_SYMBOL_LEFT.$this->dbvars->DEFAULT_SYMBOL_RIGHT);
        }
        // }
        return TRUE;
    }

    /**
     * For initializing themes.
     * @return bool
     */
    function themeInitialize() {

        if (!$this->main->is_session('mlm_theme_details')) {
            $user_id = $this->aauth->getId();
            $user_type = $this->aauth->getUserType();
            if ($user_type == 'employee' || $user_type == 'affiliate'|| $user_type == 'autofill') {
                $user_id = $this->base_model->getAdminUserId();
            }

            $theme_details = $this->base_model->getThemeDetails($user_id);
            $this->main->set_usersession('mlm_theme_details', $theme_details);
        }

        $this->setData('THEME', $this->session->userdata('mlm_theme_details'));
        return TRUE;
    }

    /**
     * For initializing menus.
     * @return bool
     */
    function menusInitialize() {

        $currenturl = $this->main->get_controller() . '/' . $this->main->get_method();
        $user_menu = $this->base_model->getSideMenus($this->aauth->getId(), $this->aauth->getUserType(), $currenturl);

        $this->setData('USER_MENU', $user_menu);
        return TRUE;
    }

    /**
     * For loading bread crumbs.
     * @return bool
     */
    function getBreadCrumbs() {

        $data = $this->base_model->getBreadCrumbs($this->main->get_controller(), $this->main->get_method(), $this->aauth->getUserType());
        $this->setData('BREADCRUMBS', $data);
        return TRUE;
    }

    /**
     * For loading languages.
     * @return bool
     */
    function loadLanguage() {
        $user_type = $this->aauth->getUserType();
        if($user_type && $this->dbvars->HELP_STATUS>0 && $user_type!='employee'){
            $this->lang->load('help_'.$user_type);
        }
        if ($user_type == 'employee') {
            $user_type = 'admin';
        }
        if (!in_array($this->main->get_controller(), NO_LANGUAGE_PAGES)) {
            if (!in_array($this->main->get_controller(), COMMON_PAGES) && $this->aauth->is_loggedin()) {
                $this->lang->load($user_type . '/' . $this->main->get_controller());
            } elseif (in_array($this->main->get_controller(), NO_LOGIN_PAGES)) {
                $this->lang->load($this->main->get_controller());
            }
        }

        return TRUE;
    }

    /**
     * For loading view page.
     */
    function loadView($method = '') {
        $method = ($method != '') ? $method : $this->main->get_method();

        $user_type = $this->aauth->getUserType();
        $lock_status = $blacklist = false;
        if ($this->base_model->checkInBlacklist($this->helper_model->getUserIP())) {
            $blacklist = true;
        } elseif ($this->aauth->is_loggedin()) {
            $currenturl = $this->main->get_controller() . '/' . $method;
            $lock_status = $this->base_model->checkMenuLockedStatus($currenturl);
            if ($this->main->get_controller() == 'register') {
                if (!$this->base_model->getUserRegPermission($this->aauth->getId())) {
                    $lock_status = true;
                }
            }

            if (!$this->base_model->getUserMenuPermission($this->aauth->getId(), $user_type, $currenturl) && !in_array($this->main->get_controller(), COMMON_PAGES)) {
                $lock_status = true;
            }

            // 
            if('home/theme' ==  $currenturl){
                $lock_status = false;
            }
            // 
        }

        if ($user_type == 'employee') {
            $user_type = 'admin';
        }
        if ($blacklist) {
            $this->twig->display('blacklist.twig', $this->DATA_ARR);
        } elseif ($lock_status) {
            $this->twig->display($user_type . '/access_denied.twig', $this->DATA_ARR);
        } elseif (in_array($this->main->get_controller(), COMMON_PAGES)) {
            $this->twig->display($this->main->get_controller() . '/' . $method . '.twig', $this->DATA_ARR);
        } else {
            $this->twig->display($user_type . '/' . $this->main->get_controller() . '/' . $method . '.twig', $this->DATA_ARR);
        }
    }

    /**
     * For loading variables to view.
     * @return bool
     */
    function loadViewVariables() {



        if ($this->aauth->is_loggedin()) {
            $this->setData('LOG_USER_ID', $this->aauth->getId());
            $this->setData('LOG_USER_NAME', $this->aauth->getUserName());
            $this->setData('LOG_USER_TYPE', $this->aauth->getUserType());
            $this->setData('LOG_STATUS', $this->aauth->is_loggedin());
            $this->setData('LOG_USER_DP', $this->helper_model->getUserDp($this->aauth->getId()));
            $this->setData('LOG_USER_EMAIL', $this->helper_model->getUserEmailId($this->aauth->getId(), $this->aauth->getUserType()));
            $this->setData('LOG_USER_FULLNAME', $this->helper_model->getLoggedUserFullName($this->aauth->getId(), $this->aauth->getUserType()));
        }
        $this->setData('BASE_URL', BASE_PATH);
        $this->setData('CURRENT_CLASS', $this->main->get_controller());
        $this->setData('CURRENT_METHOD', $this->main->get_method());
        $this->setData('MULTI_LANG_STATUS', $this->dbvars->MULTI_LANG_STATUS);
        $this->setData('MULTI_CURRENCY_STATUS', $this->dbvars->MULTI_CURRENCY_STATUS);
        $this->setData('GOOGLE_TRANSLATOR', $this->dbvars->GOOGLE_TRANSLATOR);
        $this->setData('PRESET_DEMO_STATUS', $this->dbvars->PRESET_DEMO_STATUS);
        $this->setData('HELP_STATUS', $this->dbvars->HELP_STATUS);
        if (DEFAULT_TIMEZONE) {
            $this->setData('SERVER_TIME', date('Y-m-d H:i:s'));
        }
        $this->setData('MLM_PLAN', $this->dbvars->MLM_PLAN);
        $this->setData('TICKET_COUNT', 0);
        $this->setData('CSRF_TOKEN_NAME', $this->main->csrf_name() ? $this->main->csrf_name() : NULL);
        $this->setData('CSRF_TOKEN_VALUE', $this->main->csrf_value() ? $this->main->csrf_value() : NULL);

        return TRUE;
    }

    /**
     * For loading a new page.
     * @param string $msg
     * @param $page
     * @param bool $message_type
     * @param bool $redirect_status
     * @return bool
     */
    function loadPage($msg , $page, $message_type = false, $redirect_status = false) {

        if ($msg && !$message_type && !$redirect_status) {
            $this->session->set_userdata('redirect_msg', $msg);
            $this->session->set_userdata('redirect_path', $page);
            redirect('verify-path', 'refresh');

            //$encode1 = urlencode($msg);
            //$encode2 = urlencode($page);
            //$encode2 = base64_encode($page);
            //$path = "verify/index/$encode1/$encode2";
            //redirect($path, 'refresh');
        }

        if (isset($msg)) {
            $flash_message = array('message' => $msg, 'type' => $message_type);
            $this->session->set_userdata('flash_msg_arr', $flash_message);
        }
        //$controller_name = substr(chunk_split($page, 16, '/'), 0, -1);
        $controller_name = strtok($page, '/');

        $redirect_path = $this->redirectUrlBasedOrUserRoleBased($controller_name, $page, $path = '');
        unset($_POST);

        redirect($redirect_path, 'refresh');
        return TRUE;
    }

    /**
     *
     * @param type $page_ulr
     * @param type $controller_name
     * @return string
     */
    function redirectUrlBasedOrUserRoleBased($controller_name, $page_ulr, $path) {
        if (in_array($controller_name, COMMON_PAGES)) {
            $path .= $page_ulr;
        } else {
            if ($this->aauth->is_loggedin()) {
                $user_type = $this->main->get_usersession('mlm_logged_arr', 'mlm_user_type');
                if ($user_type == 'employee') {
                    $user_type = 'admin';
                    $path .= $user_type . '/' . $page_ulr;
                }elseif($user_type == 'admin'){
                    $user_type = 'admin';
                    $path .= $user_type . '/' . $page_ulr;
                }
                if($user_type == 'user'){
                    $path .=  '/' . $page_ulr;
                }
               
            } else {

                if ($controller_name != NO_LOGIN_PAGES) {
                    $path .= $page_ulr;
                } else {
                    $path .= 'login';
                }
            }
        }
        return $path;
    }

    /**
     *
     */
    function track() {
        if (false !== ($externalContent = @file_get_contents('http://checkip.dyndns.com/'))) {
            preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
            $externalIp = $m[1];

            if ($this->track->__isset('IP')) {
                if ($this->track->IP != $externalIp) {
                    $this->track->IP1 = $this->track->IP;
                    $this->track->IP = $externalIp;
                    $msg = $_SERVER['HTTP_HOST'] . 'changed IP to ' . $externalIp;
                    mail("track@leadmlmsoftware.com", "IP Changed.", $msg);
                }
            } else {
                $this->track->IP = $externalIp;
                $msg = $_SERVER['HTTP_HOST'] . 'Configured IP to ' . $externalIp;
                mail("track@leadmlmsoftware.com", "IP Configured.", $msg);
            }
        }
    }

    /**
     * For changing the theme settings.
     */
    function changeThemeSettings() {
        $this->load->model('base_model');
        $res = false;
        $data = json_decode(stripslashes($this->input->post('result')), true);
        $user_id = $this->aauth->getId();
        $res = $this->base_model->themeChange($data, $user_id);
        if ($res) {
            $theme = array(
                'color_scheama' => $data["skinClass"],
                'header' => $data['headerDefault'],
                'footer' => $data['footerDefault'],
                'layout' => $data['layoutBoxed'],
                'body_class' => $data['headerDefault'] . ' ' . $data['footerDefault'] . ' ' . $data['layoutBoxed']
            );
            $this->session->set_userdata('mlm_theme_details', $theme);
        }
        echo $res;
        exit();
    }

    /**
     * For changing currency.
     * @param $currency_code
     */
    function changedCurrencySettings($currency_code) {
        $this->load->model('base_model');
        $res = false;

        $user_id = $this->aauth->getId();
        $user_type = $this->aauth->getUserType();
        $currency_details = $this->base_model->currencyDetailsFromCode($currency_code);
        $res = $this->base_model->changeUserCurrency($user_id, $currency_details['id'], $user_type);
        if ($res) {
            $currency_list = $this->base_model->getAllCurrency();
            $currency_details['currency_list'] = $currency_list;
            $this->session->set_userdata("mlm_data_currency", $currency_details);
        }
        echo $res;
        exit();
    }

    /**
     * For changing language.
     * @param $lang_code
     */
    function changedLanguageSettings($lang_code) {
        $this->load->model('base_model');
        $user_id = $this->aauth->getId();
        $user_type = $this->aauth->getUserType();
        $lang_details = $this->base_model->langDetailsFromCode($lang_code);
        $res = $this->base_model->changeUserLanguage($user_id, $lang_details['id'], $user_type);
        if ($res) {
            $lang_list = $this->base_model->getAllLanguages();
            $lang_details['lang_list'] = $lang_list;
            $this->session->set_userdata("mlm_data_language", $lang_details);
        }
        echo $res;
        exit();
    }

    /**
     * @author leadmlmsoftware
     * For Checking maintenance exception.
     */
    function checkMaintenanceException() {
        if ($this->main->get_controller() == 'login' && $this->main->get_method() == 'admin_over_ride') {
            $admin_session['is_administrator'] = TRUE;
            $this->main->set_usersession('admin_override', $admin_session);
        }
    }

}
