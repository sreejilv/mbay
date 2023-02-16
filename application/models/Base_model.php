<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 * For base operation
 * @package     Site
 * @subpackage  Base Extended
 * @category    base
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Base_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * For getting leftside menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @param type $currenturl
     * @return type
     */
    public function getSideMenus($user_id, $user_type, $currenturl) {
        $side_menu = array();
        $url_id = $this->getUrlOriginalId($currenturl);
        $side_menu = $this->getMenuArray($user_id, $user_type, $url_id);
        return $side_menu;
    }

    /**
     * For getting the menu array
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @param type $user_type
     * @param type $url_id
     * @return type
     */
    public function getMenuArray($user_id, $user_type, $url_id) {

        $menu_array = $permitted_menus = array();
        $i = 0;

        $redirect_user = $user_type;
        if ($user_type == 'employee') {
            $permitted_menus = $this->getEmployeeMenuPermission($user_id);
            $redirect_user = 'admin';
        }

        $res = $this->db->select("id, name, link, icon, order, lock, target")
                ->where("status", 1)
                ->where("root_id", '#')
                ->where($user_type . '_permission', 1)
                ->order_by("order")
                ->get("menus");

//        echo $this->db->last_query();die;
//print_r($res->result_array());die;
        foreach ($res->result_array() as $row) {
            $menu_permisson = true;
            if ($user_type == 'employee') {
                $menu_permisson = in_array($row['id'], $permitted_menus);
            }
            if ($menu_permisson) {
                $sub_menu = ($row['link'] == '#') ? $this->getSubMenu($row['id'], $user_type, $url_id, $permitted_menus, $redirect_user) : null;
                if ($row['link'] != '#' || $sub_menu) {
                    $menu_array[$i]['id'] = $row['id'];
                    $menu_array[$i]['name'] = $row['name'];
                    $menu_array[$i]['link'] = ($row['link'] != '#') ? $redirect_user . '/' . $row['link'] : 'javascript:void(0)';
                    $menu_array[$i]['icon'] = ' '.$row['icon'];
                    $menu_array[$i]['sub_menu'] = $sub_menu;
                    $menu_array[$i]['target'] = $row['target'];
                    $menu_array[$i]['selected'] = (in_array($row['id'], $url_id)) ? 'selected' : null;
                    $menu_array[$i]['lock'] = $row['lock'];
                    $i++;
                }
            }
        }
        return $menu_array;
    }

    /**
     * For getting the side sub-menu
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $menu_id
     * @param type $user_type
     * @param type $url_id
     * @param type $permitted_menus
     * @param type $redirect_user
     * @return type
     */
    public function getSubMenu($menu_id, $user_type, $url_id, $permitted_menus, $redirect_user) {

        $menu_permisson = true;
        $menu_array = array();
        $i = 0;
        $res = $this->db->select("id, name, link, icon, order, lock, target")
                ->where("status", 1)
                ->where("root_id", $menu_id)
                ->where($user_type . '_permission', 1)
                ->order_by("order")
                ->get("menus");

        foreach ($res->result_array() as $row) {
            if ($user_type == 'employee') {
                $menu_permisson = in_array($row['id'], $permitted_menus);
            }
            if ($menu_permisson) {
                $sub_menu = ($row['link'] == '#') ? $this->getSubSubMenu($row['id'], $user_type, $url_id, $permitted_menus, $redirect_user) : null;
                if ($row['link'] != '#' || $sub_menu) {
                    $menu_array[$i]['name'] = $row['name'];
                    $menu_array[$i]['id'] = $row['id'];
                    $menu_array[$i]['link'] = ($row['link'] != '#') ? $redirect_user . '/' . $row['link'] : 'javascript:void(0)';
                    $menu_array[$i]['icon'] = $row['icon'];
                    $menu_array[$i]['sub_menu'] = $sub_menu;
                    $menu_array[$i]['target'] = $row['target'];
                    $menu_array[$i]['selected'] = (in_array($row['id'], $url_id)) ? 'selected' : null;
                    $menu_array[$i]['lock'] = $row['lock'];
                    $i++;
                }
            }
        }
        return $menu_array;
    }

    /**

     * For getting the 3rd level menu
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $menu_id
     * @param type $user_type
     * @param type $url_id
     * @param type $permitted_menus
     * @param type $redirect_user
     * @return \type * @param type $menu_id
     * @param type $user_type
     * @param type $url_id
     * @param type $permitted_menus
     * @param type $redirect_user
     * @return type   *
     */
    public function getSubSubMenu($menu_id, $user_type, $url_id, $permitted_menus, $redirect_user) {

        $menu_permisson = true;
        $menu_array = array();
        $i = 0;
        $res = $this->db->select("id, name, link, icon, order, lock, target")
                ->where("status", 1)
                ->where("root_id", $menu_id)
                ->where($user_type . '_permission', 1)
                ->order_by("order")
                ->get("menus");
        foreach ($res->result_array() as $row) {
            if ($user_type == 'employee') {
                $menu_permisson = in_array($row['id'], $permitted_menus);
            }
            if ($menu_permisson) {
                $menu_array[$i]['id'] = $row['id'];
                $menu_array[$i]['name'] = $row['name'];
                $menu_array[$i]['link'] = $redirect_user . '/' . $row['link'];
                $menu_array[$i]['icon'] = $row['icon'];
                $menu_array[$i]['target'] = $row['target'];
                $menu_array[$i]['selected'] = (in_array($row['id'], $url_id)) ? 'selected' : null;
                $menu_array[$i]['lock'] = $row['lock'];
                $i++;
            }
        }
        return $menu_array;
    }

    /**
     * For get administrator user id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return type
     */
    public function getAdminUserId() {
        $query = $this->db->select("mlm_user_id")
                ->where("user_type", 'admin')
                ->limit(1)
                ->get("user");

        if ($query->num_rows() > 0) {
            return $query->row()->mlm_user_id;
        }
        return false;
    }

    /**
     * For get currency details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    public function getCurrencyDetails($user_id, $user_type) {
        $data = array();
        $this->db->select("cu.currency_ratio,cu.currency_name,cu.currency_code,cu.symbol_left,cu.symbol_right,cu.icon");
        if ($user_type == 'employee') {
            $this->db->where("us.employee_id", $user_id);
            $this->db->from("mlm_employee_login as us");
        } elseif ($user_type == 'affiliate') {
            $this->db->where("us.id", $user_id);
            $this->db->from("mlm_affiliates as us");
        } else {
            $this->db->where("us.mlm_user_id", $user_id);
            $this->db->from("user as us");
        }
        $this->db->join("currencies as cu", 'cu.id = us.currency', 'inner');
        $this->db->limit(1);
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * For getting the language details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    public function getLanguageDetails($user_id, $user_type) {
        $data = array();
        $this->db->select("la.lang_name,la.lang_eng_name,la.lang_code,la.lang_flag");
        if ($user_type == 'employee') {
            $this->db->where("us.employee_id", $user_id);
            $this->db->from("mlm_employee_login as us");
        } elseif ($user_type == 'affiliate') {
            $this->db->where("us.id", $user_id);
            $this->db->from("mlm_affiliates as us");
        } else {
            $this->db->where("us.mlm_user_id", $user_id);
            $this->db->from("user as us");
        }
        $this->db->join("languages as la", 'la.id = us.language', 'inner');
        $this->db->limit(1);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * For get all Currency
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function getAllCurrency() {
        $data = array();
        $query = $this->db->select("id,currency_name,currency_code,symbol_left,symbol_right,currency_ratio,icon")
                ->where("status", 1)
                ->get("currencies");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * For get all Languages
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function getAllLanguages() {
        $data = array();
        $query = $this->db->select("id,lang_name,lang_eng_name,lang_code,lang_flag")
                ->where("status", 1)
                ->get("languages");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * For get all Language details from language code
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     *
     * @param type $lang_code
     * @return type
     */
    public function getLanguageDetailsFromCode($lang_code) {
        $data = array();
        $query = $this->db->select("id,lang_name,lang_eng_name,lang_flag,lang_code")
                ->where("lang_code", $lang_code)
                ->get("languages");
        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * For change the theme
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return string
     */
    public function getThemeDetails($user_id) {
        $theme = array(
            'color_scheama' => 'theme_default',
            'body_class' => 'header-fixed footer-default',
            'header' => 'header-fixed',
            'footer' => 'footer-default',
            'layout' => ''
        );
        $query = $this->db->select("color_scheama,layout,header,footer")
                ->where("user_id", $user_id)
                ->limit(1)
                ->get("theme_settings");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $theme['color_scheama'] = $row['color_scheama'];
                $theme['header'] = $row['header'];
                $theme['footer'] = $row['footer'];
                $theme['layout'] = $row['layout'];
                $theme['body_class'] = $row['header'] . ' ' . $row['footer'] . ' ' . $row['layout'];
            }
        }
        return $theme;
    }

    /**
     * For getting the bread-crumbs
     *
     * For get all Currency
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param string $path
     * @param type $method
     * @param type $user_type
     * @return string
     */
    function getBreadCrumbs($path, $method, $user_type) {
        $bread_crumb = array(
            'page_title' => '',
            'page_sub_title' => '',
            'page_header' => '',
            'page_header_link' => '',
        );
        $full_path = $path;
        $full_path .= '/' . $method;
        $user_type = ($user_type == 'employee') ? 'admin' : $user_type;
        $res = $this->db->select('id,name,link')
                ->limit(1)
                ->like('original_link', $full_path, 'before')
                ->get('menus');
        if ($res->num_rows() > 0) {
            $bread_crumb['page_title'] = $res->row()->id;
            $bread_crumb['page_header'] = ($path == 'home') ? '' : $res->row()->id;
            $bread_crumb['page_header_link'] = $user_type . '/' . $res->row()->link;
        }
        return $bread_crumb;
    }

    /**
     *
     * For getting the url id from url name     *
     * For get all Currency
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $currenturl
     * @return type
     */
    function getUrlId($currenturl) {
        $url_ids = array();
        $variable = $this->db->select('id,root_id')
                ->like('link', $currenturl, 'before')
                ->from('menus')
                ->limit('1')
                ->get();

        if ($variable->num_rows() > 0) {

            if ($variable->row()->root_id != '#') {
                $url_ids = $this->getRootMenus($variable->row()->root_id, $url_ids);
            }
            array_push($url_ids, $variable->row()->root_id);
            array_push($url_ids, $variable->row()->id);
        }
        return $url_ids;
    }

    /**
     *
     * For get Route menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $root_id
     * @param type $url_ids
     * @return type     *
     */
    function getRootMenus($root_id, $url_ids) {
        $variable = $this->db->select('root_id')
                ->where('id', $root_id)
                ->from('menus')
                ->limit('1')
                ->get();

        if ($variable->num_rows() > 0) {
            array_push($url_ids, $variable->row()->root_id);
        }
        return $url_ids;
    }

    /**
     *
     * For getting the site info
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getSiteInfo() {
        $data = array();
        $query = $this->db->select('*')
                ->get('site_info');

        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * For check menu permission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_type
     * @param type $currenturl
     * @return type
     */
    function checkMenuPermitted($user_type, $currenturl) {

        $status = FALSE;
        $res = $this->db->select('status')
                ->like('link', $currenturl, 'before')
                ->where($user_type . '_permission', 1)
                ->get('menus');

        if ($res->num_rows() > 0) {
            $status = $res->row()->status;
        }

        return $status;
    }

    /**
     * For check menu locked
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_type
     * @param type $currenturl
     * @return type
     */
    function checkMenuLocked($user_type, $currenturl) {

        $lock = false;
        $res = $this->db->select('lock')
                ->like('link', $currenturl, 'before')
                ->where($user_type . '_permission', 1)
                ->get('menus');

        if ($res->num_rows() > 0) {
            $lock = $res->row()->lock;
        }

        return $lock;
    }

    /**
     * For currency details From currency code
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $currency_code
     * @return type
     */
    public function currencyDetailsFromCode($currency_code) {

        $data = array();
        $query = $this->db->select("id,currency_code,currency_name,symbol_left,symbol_right,currency_ratio,icon")
                ->where("currency_code", $currency_code)
                ->limit(1)
                ->get("currencies");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data = $row;
            }
        }

        return $data;
    }

    /**
     * For change the user currency user
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $currency_id
     * @param type $user_type
     * @return type
     */
    public function changeUserCurrency($user_id, $currency_id, $user_type) {

        $this->db->set("currency", $currency_id);
        $this->db->limit(1);
        if ($user_type == 'employee') {
            $this->db->where("employee_id", $user_id);
            $res = $this->db->update("employee_login");
        } elseif ($user_type == 'affiliate') {
            $this->db->where("id", $user_id);
            $res = $this->db->update("mlm_affiliates");
        } else {
            $this->db->where("mlm_user_id", $user_id);
            $res = $this->db->update("user");
        }
        return $res;
    }

    /**
     * For language details from language code
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $lang_code
     * @return type
     */
    public function langDetailsFromCode($lang_code) {

        $data = array();
        $query = $this->db->select("id,lang_code,lang_name,lang_eng_name,lang_flag")
                ->where("lang_code", $lang_code)
                ->limit(1)
                ->get("languages");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data = $row;
            }
        }

        return $data;
    }

    /**
     * For change user language
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @param type $lang_id
     * @param type $user_type
     * @return type
     */
    public function changeUserLanguage($user_id, $lang_id, $user_type) {

        $this->db->set("language", $lang_id);
        $this->db->limit(1);
        if ($user_type == 'employee') {
            $this->db->where("employee_id", $user_id);
            $res = $this->db->update("employee_login");
        } elseif ($user_type == 'affiliate') {
            $this->db->where("id", $user_id);
            $res = $this->db->update("mlm_affiliates");
        } else {
            $this->db->where("mlm_user_id", $user_id);
            $res = $this->db->update("user");
        }
        return $res;
    }

    /**
     * For theme change
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $data
     * @param type $user_id
     * @return type
     */
    public function themeChange($data, $user_id) {

        $res = $this->db->set('color_scheama', $data["skinClass"])
                ->set('layout', $data["layoutBoxed"])
                ->set('header', $data["headerDefault"])
                ->set('footer', $data["footerDefault"])
                ->where('user_id', $user_id)
                ->limit(1)
                ->update('theme_settings');

        if ($this->db->affected_rows() > 0) {
            return $res;
        }

        return false;
    }

    /**
     * For employee menu permission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    public function getEmployeeMenuPermission($user_id) {

        $data = array();
        $query = $this->db->select('modules')
                ->where('employee_id', $user_id)
                ->limit(1)
                ->get('employee_login');

        if ($query->num_rows() > 0 && $query->row()->modules) {

            $data = array_values(unserialize($query->row()->modules));
        }

        return $data;
    }

    /**
     * For getting maintenance status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function maintenceStatus() {
        $value = '';
        $query = $this->db->select('maintence_mode')
                ->from('configuration')
                ->get();
        foreach ($query->result() as $row) {
            $value = $row->maintence_mode;
        }
        return $value;
    }

    /**
     * For getting the total Ticket Count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTicketCount() {
        $count = '';
        $result = $this->db->select('count(*) as cnt')
                ->from('ticket')
                ->where('status', 12)
                ->get();
        foreach ($result->result() as $row) {
            return $row->cnt;
        }
    }

    /**
     * For getting the total income
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function getIncome($user_id) {
        $currency_symbol = $this->dbvars->DEFAULT_SYMBOL_LEFT . $this->dbvars->DEFAULT_SYMBOL_RIGHT;
        if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
            $currency_symbol = $this->main->get_usersession('mlm_data_currency', 'symbol_left') . $this->main->get_usersession('mlm_data_currency', 'symbol_right');
        }

        $data['income'] = 0;
        $data['released'] = 0;
        $data['Income_lang'] = lang('income'); //'Income';
        $data['Amount_lang'] = lang('amount'); //'Amount';
        $data['Balance_lang'] = lang('balance') . '(' . $currency_symbol . ')'; //'Balance(USD)';
        $data['Payout_lang'] = lang('payout') . '(' . $currency_symbol . ')'; //'Payout(USD)';

        $result = $this->db->select('total_amount,released_amount')
                ->where('mlm_user_id', $user_id)
                ->get('user_balance');

        if ($result->num_rows() > 0) {
            $data['income'] = $this->helper_model->currency_conversion($result->row()->total_amount, 1);
            $data['released'] = $this->helper_model->currency_conversion($result->row()->released_amount, 1);
        }

        return json_encode($data);
    }

    /**
     * For getting the  monthly statistics
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return string
     */
    function getMonthlyStatistics($user_id) {

        $data = '';
        $this_month = date('Y-m');

        $sponsor = $this->getSponsorCount($user_id, $this_month);
        $sales = $this->getSalesCount($user_id, $this_month);
        $e_pin = $this->getEpinCount($user_id, $this_month);
        $fund_transfer = $this->getFundTransfer($user_id, $this_month);

        $data = '<table class="table">
                    <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td>' . lang('sponsored') . '</td>
                            <td class="center">' . $sponsor . '</td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>' . lang('sales') . '</td>
                            <td class="center">' . $sales . '</td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td>' . lang('epin_used') . '</td>
                            <td class="center">' . $e_pin . '</td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                             <td>' . lang('fund_tranfer') . '</td>
                            <td class="center">' . $fund_transfer . '</td>
                        </tr>
                    </tbody>
                </table>';

        return $data;
    }

    /**
     * For last monthly statistics
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return string
     */
    function getLastMonthStatistics($user_id) {
        $data = '';
        $last_month = date('Y-m', strtotime("-1 month"));
        $sponsor = $this->getSponsorCount($user_id, $last_month);
        $sales = $this->getSalesCount($user_id, $last_month);
        $e_pin = $this->getEpinCount($user_id, $last_month);
        $fund_transfer = $this->getFundTransfer($user_id, $last_month);

        $data = '<table class="table">
                    <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td>' . lang('sponsored') . '</td>
                            <td class="center">' . $sponsor . '</td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>' . lang('sales') . '</td>
                            <td class="center">' . $sales . '</td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td>' . lang('epin_used') . '</td>
                            <td class="center">' . $e_pin . '</td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                             <td>' . lang('fund_tranfer') . '</td>
                            <td class="center">' . $fund_transfer . '</td>
                        </tr>
                    </tbody>
                </table>';

        return $data;
    }

    /**
     * For overall statistics
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return string
     */
    function getOverallStatistics($user_id) {
        $data = '';

        $sponsor = $this->getSponsorCount($user_id, '');
        $sales = $this->getSalesCount($user_id, '');
        $e_pin = $this->getEpinCount($user_id, '');
        $fund_transfer = $this->getFundTransfer($user_id, '');

        $data = '<table class="table">
                    <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td>' . lang('sponsored') . '</td>
                            <td class="center">' . $sponsor . '</td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>' . lang('sales') . '</td>
                            <td class="center">' . $sales . '</td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td>' . lang('epin_used') . '</td>
                            <td class="center">' . $e_pin . '</td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                             <td>' . lang('fund_tranfer') . '</td>
                            <td class="center">' . $fund_transfer . '</td>
                        </tr>
                    </tbody>
                </table>';

        return $data;
    }

    /**
     * For getting the sponsor count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $date
     * @return type
     */
    function getSponsorCount($user_id, $date) {
        $data = 0;
        $this->db->where('sponsor_id', $user_id);
        if ($date) {
            $this->db->like('date', $date, 'after');
        }
        $data = $this->db->count_all_results('user');
        return $data;
    }

    /**
     * For getting the sales count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @param type $date
     * @return type
     */
    function getSalesCount($user_id, $date) {
        $data = 0;
        $this->db->where('user_id', $user_id)
                ->where('order_status', 1);
        if ($date) {
            $this->db->like('order_date', $date, 'after');
        }
        $data = $this->db->count_all_results('orders');
        return $data;
    }

    /**
     * For getting the E-pin Count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @param type $date
     * @return type
     */
    function getEpinCount($user_id, $date) {
        $data = 0;
        $this->db->where('used_by', $user_id);
        if ($date) {
            $this->db->like('used_date', $date, 'after');
        }
        $data = $this->db->count_all_results('pin_numbers');
        return $data;
    }

    /**
     *
     * For getting the fund transfer
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $date
     * @return type
     */
    function getFundTransfer($user_id, $date) {
        $data = 0;
        $this->db->where('mlm_user_id', $user_id)
                ->where('type', 'credit')
                ->where('wallet_type', 'fund_transfer');
        if ($date) {
            $this->db->like('date', $date, 'before');
        }
        $data = $this->db->count_all_results('wallet_details');
        return $data;
    }

    /**
     * For getting the joining details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return type
     */
    function getJoiningData() {

        $i = 0;
        $data = array();
        $result = $this->db->select(' CAST(`date` AS DATE) date, COUNT( `mlm_user_id` ) count')
                ->group_by('CAST( `date` AS DATE )')
                ->get('user');

        foreach ($result->result_array() as $row) {

            if ($row['date']) {

                $date = explode('-', $row['date']);

                $data[$i]['year'] = $date[0];
                $data[$i]['month'] = $date[1] - 1;
                $data[$i]['day'] = $date[2];
                $data[$i]['count'] = $row['count'];

                $i = $i + 1;
            }
        }

        return json_encode($data);
    }

    /**
     * For getting the user complient
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    function userCompliment($user_id) {

        $data['top_earners'] = $this->topEarners($user_id);
        $data['new_joinings'] = $this->newJoinings($user_id);

        return json_encode($data);
    }

    /**
     * For getting the top earners
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return string
     */
    function topEarners($user_id) {
        $downlines = $this->helper_model->getDownlinesUnilevel($user_id);
        if ($downlines) {
            $data = '<table class="table table-striped table-hover"><tbody>';

            $this->db->select_sum('original_amount', 't_amount')
                    ->select('mlm_user_id')
                    ->from('wallet_details')
                    ->limit('10')
                    ->group_by('mlm_user_id')
                    ->where('wallet_details.type', 'credit')
                    //->where_in('wallet_details.mlm_user_id', $downlines)
                    ->where('bonus_flag', 1)
                    ->like('wallet_details.wallet_type', '_bonus', 'before')
                    ->order_by('t_amount', 'DESC');
            $query = $this->db->get();

            $res_data = $query->result_array();
            $original_amount=0;
            foreach ($res_data as $row) {

                $encoded_id = $this->helper_model->encode($row["mlm_user_id"]);
                $original_amount=$this->helper_model->currency_conversion($row['t_amount']);

                $row = $this->helper_model->getUserProfileData($row["mlm_user_id"]);

                $data .= '   <tr><td class="center"><img src="assets/images/users/' . $row["user_dp"] . '" class="img-circle" alt="profile" style="width:40px;height:40px;"/></td><td><span class="text-large">' . $row["first_name"] . ' ' . $row["last_name"] . ' (<b>'.$original_amount.'</b>)</span></td>';
                if ($this->aauth->getUserType() == 'admin') {
                    $data .= '  <td class="center">
                                <div>
                                    <a  class="btn btn-transparent-grey dropdown-toggle btn-sm" tabindex="-1" href="admin/profile-view/' . $encoded_id . '">
                                        <i class="fa fa-external-link"></i>
                                    </a>
                                </div>
                            </td>';
                }
            }
            $data .= '</tr></tbody></table>';
        } else {
            $data = '<div style="position:absolute; width:100%; height:100%"><img src="assets/images/NoRecordFound.png" class="img-circle" alt="" style="width:100%;height:100%;"/></div>';
        }
        return $data;
    }

    // function topEarners($user_id) {
    //      $downlines = $this->helper_model->getDownlinesUnilevel($user_id);
    //      $data = '<table class="table table-striped table-hover"><tbody>';
    //      $this->db->select_sum('amount1', 't_amount')
    //              ->select('last_name,first_name,user_dp,user_details.mlm_user_id')
    //              ->from('wallet_details')
    //              ->join('user_details', 'user_details.mlm_user_id=wallet_details.mlm_user_id')
    //              ->limit('10')
    //              ->group_by('user_details.mlm_user_id')
    //              ->where('wallet_details.type', 'credit')
    //              ->where_in('wallet_details.mlm_user_id', $downlines)
    //              ->like('wallet_details.wallet_type', '_bonus', 'before')
    //              ->order_by('t_amount', 'DESC');
    //      $query = $this->db->get();
    //      foreach ($query->result_array() as $row) {
    //          $encoded_id = $this->helper_model->encode($row["mlm_user_id"]);
    //          $data .= '   <tr><td class="center"><img src="assets/images/users/' . $row["user_dp"] . '" class="img-circle" alt="profile" style="width:40px;height:40px;"/></td><td><span class="text-large">' . $row["first_name"] . ' ' . $row["last_name"] . '</span></td>';
    //          if ($this->aauth->getUserType() == 'admin') {
    //              $data .= '  <td class="center">
    //                              <div>
    //                                  <a  class="btn btn-transparent-grey dropdown-toggle btn-sm" tabindex="-1" href="admin/profile-view/' . $encoded_id . '">
    //                                      <i class="fa fa-external-link"></i>
    //                                  </a>
    //                              </div>
    //                          </td>';
    //          }
    //      }
    //      $data .= '</tr></tbody></table>';
    //      return $data;
    //  }

    /**
     * For getting the new joining details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @return string
     */
    function newJoinings($user_id) {


        $this->db->select('user_id')
                ->from('traverse_father')
                ->where('traverse_father.path', $user_id)
                // ->join('user_details', 'user_details.mlm_user_id=traverse_father.user_id')
                // ->order_by('user_details.date_of_joining', 'DESC')
                ->limit(10);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = '<table class="table table-striped table-hover"><tbody>';
            foreach ($query->result_array() as $row) {

                $encoded_id = $this->helper_model->encode($row["user_id"]);

                $row = $this->helper_model->getUserProfileData($row["user_id"]);


                $date = Carbon::parse($row['date_of_joining'])->formatLocalized('%a %d-%b-%Y');

                $data .= '<tr><td class="center"><img src="assets/images/users/' . $row["user_dp"] . '" class="img-circle" alt="profile" style="width:40px;height:40px;"/></td><td><span class="text-large">' . $row["first_name"] . ' ' . $row["last_name"] . '</span> <span class="text-small block text-light"><i class="fa fa-clock-o"></i>&nbsp;<b><em>' . $date . '</em></b></span></td>';
                if ($this->aauth->getUserType() == 'admin') {
                    $data .= '<td class="center">
                                    <div>
                                        <a  class="btn btn-transparent-grey dropdown-toggle btn-sm" tabindex="-1" href="admin/profile-view/' . $encoded_id . '">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </div>
                                </td>';
                }
            }
            $data .= '</tr></tbody></table>';
        } else {
            $data = '<div style="position:absolute; width:100%; height:100%"><img src="assets/images/NoRecordFound.png" class="img-circle" alt="" style="width:100%;height:100%;"/></div>';
        }
        return $data;
    }

    // function newJoinings($user_id) {
    //       $data = '<table class="table table-striped table-hover"><tbody>';
    //       $this->db->select('mlm_user_id,first_name,last_name,user_dp,date_of_joining')
    //               ->from('traverse_father')
    //               ->join('user_details', 'user_details.mlm_user_id=traverse_father.user_id')
    //               ->where('traverse_father.path', $user_id)
    //               ->order_by('user_details.date_of_joining', 'DESC')
    //               ->limit(10);
    //       $query = $this->db->get();
    //       foreach ($query->result_array() as $row) {
    //           $date = Carbon::parse($row['date_of_joining'])->formatLocalized('%a %d-%b-%Y');
    //           $encoded_id = $this->helper_model->encode($row["mlm_user_id"]);
    //           $data .= '<tr><td class="center"><img src="assets/images/users/' . $row["user_dp"] . '" class="img-circle" alt="profile" style="width:40px;height:40px;"/></td><td><span class="text-large">' . $row["first_name"] . ' ' . $row["last_name"] . '</span> <span class="text-small block text-light"><i class="fa fa-clock-o"></i>&nbsp;<b><em>' . $date . '</em></b></span></td>';
    //               if ($this->aauth->getUserType() == 'admin') {
    //                   $data .= '<td class="center">
    //                                   <div>
    //                                       <a  class="btn btn-transparent-grey dropdown-toggle btn-sm" tabindex="-1" href="admin/profile-view/' . $encoded_id . '">
    //                                           <i class="fa fa-external-link"></i>
    //                                       </a>
    //                                   </div>
    //                               </td>';
    //               }
    //       }
    //       $data .= '</tr></tbody></table>';
    //       return $data;
    //   }

    /**
     * For getting the dashboard settings details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $type
     * @param type $filter
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function dashboardSettings($type, $filter, $user_id, $user_type) {

        $data = 0;

        switch ($filter) {
            case 't':
                $date = date('Y-m-d');
                break;

            case 'm':
                $date = date('Y-m');
                break;

            case 'y':
                $date = date('Y');
                break;

            default:
                $date = '';
                break;
        }

        if ($type == 'joining') {

            $this->db->from('traverse_father')
                    ->join('user', 'user.mlm_user_id=traverse_father.user_id')
                    ->where('traverse_father.path', $user_id);
            if ($date) {
                $this->db->like('user.date', $date, 'after');
            }
            $data = $this->db->count_all_results();
        } else if ($type == 'commission') {

            $this->db->select('SUM(amount1) + SUM(amount2)  original_amount', FALSE);
            $this->db->where('type', 'credit');
            if ($user_type != 'admin') {
                $this->db->where('mlm_user_id', $user_id);
            }
            $this->db->where('bonus_flag', 1);
            if ($date) {
                $this->db->like('date', $date, 'after');
            }

            $query = $this->db->get('wallet_details');

            if ($query->num_rows() > 0 && $query->row()->original_amount != '') {
                $data = $this->helper_model->currency_conversion($query->row()->original_amount);
            } else {
                $data = $this->helper_model->currency_conversion($data);
            }
        } else if ($type == 'credit') {


            $this->db->select('SUM(amount1) + SUM(amount2)  original_amount', FALSE);
            $this->db->where('type', 'credit');
            $this->db->where('mlm_user_id', $user_id);

            if ($user_type != 'admin') {
                $this->db->where('mlm_user_id', $user_id);
            }
            if ($date) {
                $this->db->like('date', $date, 'after');
            }

            $query = $this->db->get('wallet_details');

            if ($query->num_rows() > 0 && $query->row()->original_amount != '') {
                $data = $this->helper_model->currency_conversion($query->row()->original_amount);
            } else {
                $data = $this->helper_model->currency_conversion($data);
            }
        } else if ($type == 'debit') {

            $this->db->select('SUM(amount1) + SUM(amount2)  original_amount', FALSE);
            $this->db->where('type', 'debit');

            if ($user_type != 'admin') {
                $this->db->where('mlm_user_id', $user_id);
            }
            if ($date) {
                $this->db->like('date', $date, 'after');
            }

            $query = $this->db->get('wallet_details');

            if ($query->num_rows() > 0 && $query->row()->original_amount != '') {
                $data = $this->helper_model->currency_conversion($query->row()->original_amount);
            } else {
                $data = $this->helper_model->currency_conversion($data);
            }
        }

        return $data;
    }

    /**
     * For transaction start for common method
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return type
     */
    public function transactionStart() {
        return $this->db->trans_begin();
    }

    /**
     * For transaction checking
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return type
     */
    public function transationCheck() {
        return $this->db->trans_status();
    }

    /**
     * For transaction commit
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return type
     */
    public function transationCommit() {
        return $this->db->trans_commit();
    }

    /**
     * For transaction rollback
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @return type
     */
    public function transationRollback() {
        return $this->db->trans_rollback();
    }

//  pagination column------------
    /**
     * For getting total data limit
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $request
     * @return string
     */
    function getTotalDataLimit($request) {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }
        return $limit;
    }

    /**
     * For getting total order
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $request
     * @param type $columns
     * @return string
     */
    function getTotalDataOrder($request, $columns) {
        $order = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['order']) && count($request['order'])) {
            $orderBy = '';
            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy = ' ' . $column['db'] . '  ' . $dir;
                }
            }
            $order = 'ORDER BY ' . $orderBy;
        }
        return $order;
    }

    /**
     * For get total data order courses
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $request
     * @param type $columns
     * @return string
     */
    function getTotalDataOrderCOURSES($request, $columns) {

        $order = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['order']) && count($request['order'])) {
            $orderBy = '';
            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy = '`' . $column['db'] . '` ' . $dir;
                }
            }
            $order = 'ORDER BY `order` ASC ,' . $orderBy;
        }
        return $order;
    }

    function getTotalDataOrderDBACKUP($request, $columns) {

        $order = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['order']) && count($request['order'])) {
            $orderBy = '';
            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy = '`' . $column['db'] . '` ' . $dir;
                }
            }
            $order = 'ORDER BY `id` DESC ,' . $orderBy;
        }
        return $order;
    }

    /**
     * For getting total data for wallet
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $request
     * @param type $columns
     * @return string
     */
    function getTotalDataOrderWALLET($request, $columns) {

        $order = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['order']) && count($request['order'])) {
            $orderBy = '';
            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy = '`' . $column['db'] . '` ' . $dir;
                }
            }
            $order = 'ORDER BY date DESC ,' . $orderBy;
        }
        return $order;
    }

    /**
     * For getting total data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $request
     * @param type $columns
     * @return string
     */
    function getTotalDataWhere($request, $columns) {
        $where = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['search']) && $request['search']['value'] != '') {
            $str = $request['search']['value'];
            for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['searchable'] == 'true' && $str != '') {
                    $where .= " " . $column['db'] . " LIKE " . '"%' . $str . '%" or';
                }
            }
            if ($where) {
                $where = 'where' . ' (' . rtrim($where, 'or') . ')';
            }
        }
        return $where;
    }

    /**
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $a
     * @param type $prop
     * @return type
     */
    function pluck($a, $prop) {
        $out = array();
        for ($i = 0, $len = count($a); $i < $len; $i++) {
            $out[] = $a[$i][$prop];
        }
        return $out;
    }

// pagination end------------
    /**
     * For getting the language folder
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $lang_code
     * @return type
     */
    public function getLanguageFolder($lang_code) {
        $language_folder = 'english';
        $query = $this->db->select("language_folder")
                ->where("lang_code", $lang_code)
                ->limit(1)
                ->get("languages");
        if ($query->num_rows() > 0 && $query->row()->language_folder != '') {
            $language_folder = $query->row()->language_folder;
        }
        return $language_folder;
    }

    /**
     * For refresh messages
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    public function refreshMessages($user_id, $user_type) {
        $data = '';
        $query = $this->db->select("id,from_id,subject,content,date")
                ->where("read_status", "unread")
                ->where("spam", "no")
                ->where("catagories", "inbox")
                ->where("user_id", $user_id)
                ->order_by("date", "DESC")
                ->get("mail_system");

        $num_rows = $query->num_rows();
        if ($num_rows) {

            $data .= '<li>
                      <span class="dropdown-header"> You have ' . $num_rows . ' messages</span>
                   </li>';

            $output = array_slice($query->result_array(), 0, 5);
            $now = new DateTime();

            foreach ($output as $key => $val) {

                $time_two = new DateTime($val['date']);

                $difference = $now->diff($time_two);
                $days = $difference->format('%a');
                $hrs = $difference->format('%h');
                $min = $difference->format('%i');

                $time = 'Just Now';
                if ($days) {
                    if ($days == 1)
                        $time = $days . ' Day';
                    else
                        $time = $days . ' Days';
                }elseif ($hrs) {
                    $time = $hrs . ' Hrs';
                } elseif ($min > 2) {
                    $time = $min . ' Mins';
                }


                $from_user_name = $this->helper_model->IdToUserName($val['from_id']);
                $from_user_dp = $this->helper_model->getUserDp($val['from_id']);

                if (strlen($val['content']) > 80) {
                    $content = substr($val['content'], 0, 80) . '...';
                } else {
                    $content = $val['content'];
                }

                $data .= '<li>
                        <div class="drop-down-wrapper ps-container">
                            <ul>
                                <li class="unread">
                                    <a href="' . $user_type . '/mail/read/' . $val['id'] . '"class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="assets/images/users/' . $from_user_dp . '" alt="" style="width:55px;height:55px;">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">' . $from_user_name . '</span>
                                                <span class="preview">' . $content . '</span>
                                                <span class="time"> ' . $time . '</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>';
            }

            $data .= '<li class="view-all">
                        <a href="' . $user_type . '/inbox">
                            See All
                        </a>
                    </li>';
        } else {
            $data .= '<li><div class="padding-10">You don\'t have any new messages...</div></li>';
        }

        $res['data'] = $data;
        $res['count'] = $num_rows;
        return json_encode($res);
    }

    /**
     * For getting user transactionx
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return string
     */
    public function getUserTransactions($user_id, $user_type) {

        $data = '';
        $query = $this->db->select("mlm_user_id,from_user,type,wallet_type,date,original_amount")
                ->where("mlm_user_id", $user_id)
                ->order_by("date", "DESC")
                ->limit(10)
                ->get("wallet_details");

        $now = new DateTime();

        foreach ($query->result_array() as $value) {

            $time_two = new DateTime($value['date']);

            $difference = $now->diff($time_two);
            $days = $difference->format('%a');
            $hrs = $difference->format('%h');
            $min = $difference->format('%i');

            $time = 'Just Now';
            if ($days) {
                if ($days == 1)
                    $time = $days . ' Day';
                else
                    $time = $days . ' Days';
            }elseif ($hrs) {
                $time = $hrs . ' Hrs';
            } elseif ($min > 2) {
                $time = $min . ' Mins';
            }

            $label = 'label-primary';
            $ico = 'fa-ellipsis-h';

            if ($value['type'] == 'credit') {
                $label = 'label-success';
                $ico = 'fa-chevron-circle-up';
                $type = lang('credited');
            } elseif ($value['type'] == 'debit') {
                $label = 'label-danger';
                $ico = 'fa-chevron-circle-down';
                $type = lang('debited');
            }

            $data .= '<li>
                            <a>
                                <span class="label ' . $label . '"><i class="fa ' . $ico . '"></i></span> <span class="message" style="font-size:13px;"><b>' . $this->helper_model->currency_conversion($value["original_amount"]) . '</b> ' . lang($value["wallet_type"]) . '</span> <span class="time">' . $time . '</span>
                            </a>
                      </li>';
        }

        $data .= '<div class="view-all">
                                    <a href="' . $user_type . '/wallet-one"> ' . lang('see_all_transactions') . ' <i class="fa fa-arrow-circle-o-right"></i>
                                    </a>
                                </div>';
        return $data;
    }

    /**
     * For refresh site summery
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return string
     */
    function refreshSiteSummary($user_id, $user_type) {
        $data = '';
        $wallet_balance = $this->helper_model->currency_conversion($this->userWalletBalance($user_id, $user_type));
        $payout_request = $this->helper_model->currency_conversion($this->userPayoutRequests($user_id, $user_type));
        $payout_request_count = $this->userPayoutRequestsCount($user_id, $user_type);
        $payout_recived = $this->helper_model->currency_conversion($this->userPayoutRecived($user_id, $user_type));
        $payout_recived_count = $this->userPayoutRecivedCount($user_id, $user_type);
        $epin_created = $this->epinCreated($user_id, $user_type);
        $epin_created_amount = $this->helper_model->currency_conversion($this->epinCreatedAmount($user_id, $user_type));
        $epin_used = $this->epinUsed($user_id, $user_type);
        $epin_used_amount = number_format($this->epinUsedAmount($user_id, $user_type), 2);
        $epin_used_amount = $this->helper_model->currency_conversion($this->epinUsedAmount($user_id, $user_type));

        if ($user_type == 'admin') {
            $kyc_confirmed = $this->kycConfirmed();
            $kyc_pending = $this->kycPendingCount();
            $blocked_user = $this->blockedUserCount();
        }

        $epin_status = $this->dbvars->EPIN_STATUS;
        $kyc_status = $this->dbvars->KYC_STATUS;

        $data .= '<h5 class="sidebar-title">' . lang('wallet') . '</h5>
                <ul class="media-list" id="style_selector_container" style="padding: 0px;">
                    <li class="media" style="border-radious:0px;">
                         <a>
                            <span class="fa-stack media-object box-title" >
                                <i class="fa fa-money fa-stack-1x fa-2x active"></i>
                                <i class="fa fa-file-text-o fa-stack-1x stack-right-bottom text-primary"></i>
                            </span>
                            <div class="media-body">
                                <h4 class="media-heading">' . lang('wallet_balance') . '</h4>
                                <span>' . $wallet_balance . '</span>
                            </div>
                        </a >
                    </li>

                    <li class="media">';
        if ($payout_request_count) {
            $data .= '<div class="user-label">
                                <span class="label label-default">' . $payout_request_count . '</span>
                            </div>';
        }
        $data .= '<a >
                            <span class="fa-stack media-object  box-title">
                                <i class="fa fa-money fa-stack-1x fa-2x "></i>
                                <i class="fa fa-pencil-square-o fa-stack-1x stack-right-bottom text-warning "></i>
                            </span>

                            <div class="media-body">
                                <h4 class="media-heading">' . lang('payout_in_process') . '</h4>
                                <span> ' . $payout_request . '</span>
                            </div></a >
                    </li>
                    <li class="media">';
        if ($payout_recived_count) {
            $data .= '<div class="user-label">
                                    <span class="label label-default">' . $payout_recived_count . '</span>
                              </div>';
        }

        $data .= '<a >
                            <span class="fa-stack media-object box-title" >
                                <i class="fa fa-money fa-stack-1x fa-2x"></i>
                                <i class="fa fa-check-square-o fa-stack-1x stack-right-bottom text-success "></i>
                            </span>

                            <div class="media-body">
                                <h4 class="media-heading">' . lang('compleated_payout') . '</h4>
                                <span>' . $payout_recived . '</span>
                            </div></a >
                    </li>
                </ul>';
        if ($epin_status) {

            $data .= '<h5 class="sidebar-title">' . lang('e-pin') . '</h5>
                        <ul class="media-list" id="style_selector_container" style="padding: 0px;">
                            <li class="media">';
            if ($epin_created) {
                $data .= ' <div class="user-label">
                                        <span class="label label-default">' . $epin_created . '</span>
                                    </div>';
            }
            $data .= '<a >
                                     <span class="fa-stack media-object  box-title">
                                        <i class="fa fa-barcode fa-stack-1x fa-2x "></i>
                                        <i class="fa fa-angle-double-right fa-stack-1x stack-right-bottom text-primary "></i>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="media-heading">' . lang('allocated') . '</h4>
                                        <span>' . $epin_created_amount . '</span>
                                    </div></a >

                            </li>
                            <li class="media">';
            if ($epin_used) {
                $data .= ' <div class="user-label">
                                    <span class="label label-default">' . $epin_used . '</span>
                                </div>';
            }
            $data .= '<a >
                                     <span class="fa-stack media-object  box-title">
                                        <i class="fa fa-barcode fa-stack-1x fa-2x "></i>
                                        <i class="fa fa-angle-double-left fa-stack-1x stack-right-bottom text-success "></i>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="media-heading">' . lang('used') . '</h4>
                                        <span> ' . $epin_used_amount . ' </span>
                                    </div>
                                    </a>
                            </li>
                        </ul>';
        }

        if ($user_type == 'admin') {

            if ($kyc_status) {

                $data .= '<h5 class="sidebar-title">' . lang('kyc_details') . '</h5>
                        <ul class="media-list"  id="style_selector_container" style="padding: 0px;">
                            <li class="media">
                                <a>
                                    <span class="fa-stack media-object  box-title">
                                        <i class="fa fa-file fa-stack-1x fa-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x stack-right-bottom text-primary "></i>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="media-heading">' . lang('kyc_pending') . '</h4>
                                        <span> ' . $kyc_confirmed . '</span>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a>
                                    <span class="fa-stack media-object  box-title" >
                                        <i class="fa fa-file fa-stack-1x fa-2x"></i>
                                        <i class="fa fa-check fa-stack-1x stack-right-bottom text-success "></i>
                                    </span>

                                    <div class="media-body">
                                        <h4 class="media-heading">' . lang('kyc_confirmed') . '</h4>
                                        <span> ' . $kyc_pending . ' </span>
                                    </div>
                                </a>
                            </li>
                             <li class="media">
                                <a>
                                    <span class="fa-stack media-object  box-title" >
                                        <i class="fa fa-user fa-stack-1x fa-2x"></i>
                                        <i class="fa fa-ban fa-stack-1x stack-right-bottom text-danger "></i>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="media-heading">' . lang('blocked_members') . '</h4>
                                        <span> ' . $blocked_user . ' </span>
                                    </div>
                                </a>
                            </li>
                        </ul>';
            } else {

                $data .= '<h5 class="sidebar-title">' . lang('blocked_members') . '</h5>
                                <ul class="media-list"  id="style_selector_container" style="padding: 0px;">
                                    <li class="media">
                                        <a>
                                            <span class="fa-stack media-object  box-title" >
                                                <i class="fa fa-user fa-stack-1x fa-2x"></i>
                                                <i class="fa fa-ban fa-stack-1x stack-right-bottom text-danger "></i>
                                            </span>
                                            <div class="media-body">
                                                <h4 class="media-heading">' . lang('blocked_members') . '</h4>
                                                <span> ' . $blocked_user . ' </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>';
            }
        }
        return $data;
    }

    /**
     * For blocked user count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function blockedUserCount() {
        return $this->db->where('login_block', 0)
                        ->count_all_results('user');
    }

    /**
     * For kyc pending
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function kycPendingCount() {
        return $this->db->where('status', 'pending')
                        ->count_all_results('user_kyc');
    }

    /**
     * For Kyc cnfirmed
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function kycConfirmed() {
        return $this->db->where('status', 'accepted')
                        ->count_all_results('user_kyc');
    }

    /**
     * For E-pin used
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function epinUsed($user_id, $user_type) {

        $this->db->where('status', 0);
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        return $this->db->count_all_results('pin_numbers');
    }

    /**
     * For E-pin used amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function epinUsedAmount($user_id, $user_type) {
        $amount = 0;
        $this->db->select("SUM(allocate_amount - balance_amount) as usedepin", false);
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get('pin_numbers');
        if ($res->num_rows() > 0 && $res->row()->usedepin != '') {
            $amount = $res->row()->usedepin;
        }
        return $amount;
    }

    /**
     * For E-pin created
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function epinCreated($user_id, $user_type) {

        $this->db->where('status', 1);
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        return $this->db->count_all_results('pin_numbers');
    }

    /**
     * E-pin created amount
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function epinCreatedAmount($user_id, $user_type) {
        $this->db->select_sum('balance_amount');
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get('pin_numbers');


        if ($res->num_rows() > 0) {
            return $res->row()->balance_amount;
        }
        return false;
    }

    /**
     * For user wallet balance
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function userWalletBalance($user_id, $user_type) {
        $amount = 0;
        $this->db->select_sum('amount1');
        $this->db->where('type', 'credit');
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get('wallet_details');
        if ($res->num_rows() > 0 && $res->row()->amount1 != '') {
            $amount = $res->row()->amount1;
        }
        return $amount;
    }

    /**
     * For payout request
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function userPayoutRequests($user_id, $user_type) {

        $amount = 0;
        $this->db->select_sum('original_amount')
                ->where('type', 'debit')
                ->where('wallet_type', 'payout_requested');
//                ->where('payout_status', 'pending');
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get('wallet_details');
        if ($res->num_rows() > 0 && $res->row()->original_amount != '') {
            $amount = $res->row()->original_amount;
        }
        return $amount;
    }

    /**
     *
     * For user Payout request count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function userPayoutRequestsCount($user_id, $user_type) {

        $this->db->where('type', 'debit')
                ->where('wallet_type', 'payout_request')
                ->where('payout_status', 'pending');
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        return $this->db->count_all_results('wallet_details');
    }

    /**
     * For payout received
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function userPayoutRecived($user_id, $user_type) {
        $amount = 0;

        $this->db->select_sum('original_amount')
                ->where('type', 'debit')
                ->where('wallet_type', 'payout_released');
//                ->where('payout_status', 'confirmed');
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        $res = $this->db->get('wallet_details');
        if ($res->num_rows() > 0 && $res->row()->original_amount != '') {
            $amount = $res->row()->original_amount;
        }
        return $amount;
    }

    /**
     *
     * For user payout received count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $user_type
     * @return type
     */
    function userPayoutRecivedCount($user_id, $user_type) {

        $this->db->where('type', 'debit')
                ->where('wallet_type', 'payout_request')
                ->where('payout_status', 'confirmed');
        if ($user_type != 'admin')
            $this->db->where('mlm_user_id', $user_id);
        return $this->db->count_all_results('wallet_details');
    }

    /**
     * For get new message count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @return type
     */
    function getNewmessageCount($user_id) {
        $unread_msg_count = 0;
        $query = $this->db->select('user1,user2,chat_referance')
                ->where('user1',$user_id)
                ->or_where('user2',$user_id)
                //->where("(user1 = '$user_id' OR user2 = '$user_id') ")
                ->group_by('chat_referance')
                ->get('messages');
        foreach ($query->result() as $row) {
            if ($row->user1 == $user_id) {
                $read_status = 'read_status1';
                $chat_user = $row->user2;
            } else {
                $read_status = 'read_status2';
                $chat_user = $row->user1;
            }
            $unread_msg_count += $this->getUnreadMsgCount($row->chat_referance, $read_status);
        }

        $res['content'] = '';
        if ($unread_msg_count) {
            $res['content'] = ' <span class="notifications-count badge badge-default animated bounceIn">' . $unread_msg_count . '</span> ';
        }
        $res['count'] = $unread_msg_count;
        return json_encode($res);
    }

    /**
     * For user unread message count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $chat_referance
     * @param type $read_status
     * @return type
     */
    function getUnreadMsgCount($chat_referance, $read_status) {
        $this->db->select('id')
                ->from("messages")
                ->where($read_status, 0)
                ->where('chat_referance', $chat_referance);
        return $this->db->count_all_results();
    }

    /**
     * For getting the original
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $currenturl
     * @return type
     */
    function getUrlOriginalId($currenturl) {
        $url_ids = array();
        $variable = $this->db->select('id,root_id')
                ->where('original_link', $currenturl)
                ->from('menus')
                ->limit('1')
                ->get();
        if ($variable->num_rows() > 0) {
            if ($variable->row()->root_id != '#') {
                $url_ids = $this->getRootMenus($variable->row()->root_id, $url_ids);
            }
            array_push($url_ids, $variable->row()->root_id);
            array_push($url_ids, $variable->row()->id);
        }
        return $url_ids;
    }

    /**
     * For check menu locked status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $currenturl
     * @return type
     */
    function checkMenuLockedStatus($currenturl) {
        $lock = false;
        $res = $this->db->select('lock')
                ->like('original_link', $currenturl)
                ->where('lock', 1)
                ->get('menus');
        if ($res->num_rows() > 0) {
            $lock = $res->row()->lock;
        }
        return $lock;
    }

    /**
     * For load page script
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $currenturl
     * @return type
     */
    public function loadAlllPageScript($currenturl) {
        $script_array = array();
        $query = $this->db->select("id")
                ->like('original_link', $currenturl)
                ->limit(1)
                ->get('menus');
        if ($query->num_rows() > 0) {
            $script_array = $this->script_model->loadScript($query->row()->id);
        }
        return $script_array;
    }

    /**
     * For get user registration menu permission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    public function getUserRegPermission($user_id) {
        $perm = true;
        $query = $this->db->select("registration_block")
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $perm = $query->row()->registration_block;
        }
        return $perm;
    }

    /**
     *
     * For get user menu permission
     *
     * For transaction checking
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $user_id
     * @param type $user_type
     * @param type $currenturl
     * @return boolean
     */
    function getUserMenuPermission($user_id, $user_type, $currenturl) {
        if ($user_type == 'admin') {
            $perm = 'admin_permission';
        } elseif ($user_type == 'user') {
            $perm = 'user_permission';
        } elseif ($user_type == 'employee') {
            $perm = 'employee_permission';
        } elseif ($user_type == 'affiliate') {
            $perm = 'affiliate_permission';
        } else {
            return TRUE;
        }
        $lock = false;
        $id = '';
        $res = $this->db->select("$perm,id")
                ->where('original_link', $currenturl)
                ->where($perm, 1)
                ->order_by('id','desc')
                ->limit(1)
                ->get('menus');
        if ($res->num_rows() > 0) {
            $lock = $res->row()->$perm;
            $id = $res->row()->id;
        }
        if ($user_type == 'employee' && $id) {
            $res = $this->db->select('modules')
                    ->where('employee_id', $user_id)
                    ->get('employee_login');
            if ($res->num_rows() > 0) {
                $modules = $res->row()->modules;
                $available_menus = unserialize($modules);
                if (!in_array($id, $available_menus)) {
                    $lock = false;
                }
            }
        }
        return $lock;
    }

    public function checkInBlacklist($ip) {
        $id = false;
        $query = $this->db->select("id")
                ->where('blacklist_ip', $ip)
                ->where('status', 1)
                ->limit(1)
                ->get('ip_blacklist');
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
        }
        return $id;
    }

    public function updateLoginStatus() {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $res= 1;
        } else {
            $res=$this->db->set($this->dbvars->LOGIN_REFERANCE, 0)
                    ->update('user');
            if($this->db->affected_rows() > 0){
                return 1;
            }
            return 0;
        }
        return $res;
    }

}

?>
