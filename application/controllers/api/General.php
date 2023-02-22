<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Carbon\Carbon;

class General extends Core_Base_Controller {

    /**
     *
     * @return type
     */
    public function changeCurrencySettings() {
        $currency_code = stripslashes($this->input->post('currency_code'));
        $this->changedCurrencySettings($currency_code);
        echo 'yes';
        exit();
    }

    /**
     *
     * @return type
     */
    public function changeLanguageSettings() {
        $lang_code = stripslashes($this->input->post('lang_code'));
        $this->changedLanguageSettings($lang_code);
        echo 'yes';
        exit();
    }

    /**
     *
     */
    public function changeBoxData() {

        $type = stripslashes($this->input->post('type'));
        $filter = stripslashes($this->input->post('filter'));

        $user_type = $this->aauth->getUserType();

        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_type = ($user_type == 'employee') ? 'admin' : $user_type;

        echo $this->base_model->dashboardSettings($type, $filter, $user_id, $user_type);
        exit();
    }

    public function getIncome() {

        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        // $user_type = ($user_type =='employee') ? 'admin': $user_type;
        echo $this->base_model->getIncome($user_id);
        exit();
    }

    public function userCompliment() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        // $user_type = ($user_type =='employee') ? 'admin': $user_type;
        echo $this->base_model->userCompliment($user_id);
        exit();
    }

    public function getJoiningData() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        // $user_type = ($user_type =='employee') ? 'admin': $user_type;
        echo $this->base_model->getJoiningData($user_id);
        exit();
    }

    public function getOverallStatistics() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        // $user_type = ($user_type =='employee') ? 'admin': $user_type;
        echo $this->base_model->getOverallStatistics($user_id);
        exit();
    }

    public function getMonthlyStatistics() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        // $user_type = ($user_type =='employee') ? 'admin': $user_type;
        echo $this->base_model->getMonthlyStatistics($user_id);
        exit();
    }

    public function getLastMonthStatistics() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        // $user_type = ($user_type =='employee') ? 'admin': $user_type;
        echo $this->base_model->getLastMonthStatistics($user_id);
        exit();
    }

    function changeThemeSettings() {
        $this->load->model('base_model');
        $res = false;
        $data = json_decode(stripslashes($this->input->post('result')), true);
        $user_id = $this->aauth->getId();
        $res = $this->base_model->themeChange($data, $user_id);
        if ($res) {
            $this->session->unset_userdata('mlm_theme_details');
        }
        echo $res;
        exit();
    }

    function refreshMessages() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_type = ($user_type == 'employee') ? 'admin' : $user_type;
        echo $this->base_model->refreshMessages($user_id, $user_type);
        exit();
    }

    function refreshTransactions() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_type = ($user_type == 'employee') ? 'admin' : $user_type;
        echo $this->base_model->getUserTransactions($user_id, $user_type);
        exit();
    }

    function refreshSiteSummary() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_type = ($user_type == 'employee') ? 'admin' : $user_type;
        echo $this->base_model->refreshSiteSummary($user_id, $user_type);
        exit();
    }

    function refreshSmsCount() {
        if ($this->dbvars->LIVE_CHAT_STATUS > 0) {
            $user_type = $this->aauth->getUserType();
            $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $user_type = ($user_type == 'employee') ? 'admin' : $user_type;
            echo $this->base_model->getNewmessageCount($user_id);
            exit();
        }
        echo 'no';
        exit();
    }

    function get_top_sales() {
        echo json_encode($this->helper_model->getTopSales());
        exit();
    }

    function get_graph1_data() {
        $user_type = $this->aauth->getUserType();
        $user_id = 0;
        if ($user_type == 'user') {
            $user_id = $this->aauth->getId();
        }
        echo json_encode($this->helper_model->getGraph1Data($user_id));
        exit();
    }

    function get_enquiry_data() {

        $this->load->model('enquiry_model');
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_type = ($user_type == 'employee') ? 'admin' : $user_type;
        echo json_encode($this->enquiry_model->getEnquiryData($this->aauth->getId()));
        exit();
    }

    function get_sparkline_data() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        echo json_encode($this->helper_model->getSparklineData($user_id));
        exit();
    }

    function get_enquiry() {
        $this->load->model('enquiry_model');
        echo json_encode($this->enquiry_model->getEnquiryDetails($this->aauth->getId()));
        exit();
    }

    function get_sparkline4_data() {
        $user_type = $this->aauth->getUserType();
        $user_id = ($user_type == 'user') ? $this->aauth->getId() : '';
        echo json_encode($this->helper_model->getSparkline4Data($user_id));
        exit();
    }

    function get_ticket_details() {
        $this->load->model('ticket_system_model');
        echo json_encode($this->ticket_system_model->getTicketDetails());
        exit();
    }

    function get_ticket_deails() {
        echo json_encode($this->helper_model->getTicketDetails());
        exit();
    }

    function get_ticket_graph() {
        $user_type = $this->aauth->getUserType();
        $user_id = 0;
        if ($user_type == 'admin') {
            $user_id = $this->aauth->getId();
        }
        echo json_encode($this->helper_model->getGraphTicketData($user_id));
        exit();
    }
    
    function get_graph_data()
    {
        $this->load->model('home_model');
        $date = date("Y-m-d", strtotime('-1year'));

        $values1 = $values2 =$values3=$values4= array();

        for ($i = 0; $i < 12; $i++) 
        {
           $month = date("m", strtotime( date( 'Y-m-01' )." -$i months"));
           $year = date("Y", strtotime( date( 'Y-m-01' )." -$i months"));
           $year_month=$year.'-'.$month;
            
           $values1[] = $this->home_model->getUserOrderPerMonth($year_month);

           $values2[] = $this->home_model->getUserSalesPerMonth($year_month);
          
           $values3[] = $this->home_model->getCustomersCount($year_month);
           $values4[] = date("M", mktime(0, 0, 0, $month, 10));
       }
    
        $data1 =$data2=$data3=$data4=array();
        $data1['key'] = "Orders";
        $data1['color'] = '#26001b';
        $data1['values'] = array_reverse($values1);

        $data2['key'] = "Sales";
        $data2['color'] = '#93329e';
        $data2['values'] = array_reverse($values2);

        $data3['key'] = "Customers";
        $data3['color'] = '#e48900';
        $data3['values'] =array_reverse($values3);

        $data4['values'] = array_reverse($values4);
       
        $graph[] = $data1;
        $graph[] = $data2;
        $graph[] = $data3;
        $graph[] = $data4;

        echo json_encode($graph);
        exit;
    }


}
