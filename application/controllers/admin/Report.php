<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * Controller used for list out the Reports
 * Like user join,total join report etc..
 * @author Techffodils Technologies LLP
 * @date 2017-12-16
 */
class Report extends Base_Controller {

    /**
     * For joined users report
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function user_join($user_id ='') {
        $this->session->set_userdata('user_id', $user_id);
        if ($this->session->userdata('uj_user_id') == null)
        $this->session->set_userdata('uj_user_id', '');
        if ($this->session->userdata('uj_from_date') == null)
            $this->session->set_userdata('uj_from_date', '');
        if ($this->session->userdata('uj_to_date') == null)
            $this->session->set_userdata('uj_to_date', '');
        if($user_id){

            $details = $this->report_model->edituserdetails($user_id);
            $address = $this->db->select('*')
                        ->from('user_address')
                        ->where('mlm_user_id', $user_id)
                        ->get();
            $j =0;
            foreach ($address->result() as $row) {
                $details['add_address'][$j]['address_2'] = $row->address_2;
                $details['add_address'][$j]['address_1'] = $row->address_1;
                $details['add_address'][$j]['city'] = $row->city;
                $details['add_address'][$j]['zip_code'] = $row->zip_code;
                $details['add_address'][$j]['country'] = $row->country_id;
                $j++;
             }
             $flag = 1;
             $this->setData('details', $details);
        }else{
            $datauser = $this->report_model->joinuserdetails();
            $flag = 0;
            $this->setData('userreport', $datauser);
        }



        // if ($this->input->post('edit_user')){ //&& $this->validate_registration_new()){
        //     $this->load->helper('security');
        //     $edit_user = $this->security->xss_clean($this->input->post());
        //     $user_id = $edit_user['edit_user'];
        //     $details = $this->report_model->edituserdetails($user_id);
        //     $address = $this->db->select('*')
        //                 ->from('user_address')
        //                 ->where('mlm_user_id', $user_id)
        //                 ->get();
        //     $j =0;
        //     foreach ($address->result() as $row) {
        //         $details['add_address'][$j]['address_2'] = $row->address_2;
        //         $details['add_address'][$j]['address_1'] = $row->address_1;
        //         $details['add_address'][$j]['city'] = $row->city;
        //         $details['add_address'][$j]['zip_code'] = $row->zip_code;
        //         $details['add_address'][$j]['country'] = $row->country_id;
        //         $j++;
        //      }
            
        //     $this->setData('details', $details);
        //     $flag = 1;
        // }
     
        if ($this->input->post('general') && $this->validate_general_update()){
     
            $this->load->helper('security');
            $update_user_data = $this->security->xss_clean($this->input->post());
            $res = $this->report_model->updategeneral($update_user_data,$update_user_data['user_id']);

            $this->loadPage('Update Profile Details Success','join-report/'.$user_id, 'success');
        }

        if ($this->input->post('update_password') && $this->validate_general_password()){
           
            $this->load->helper('security');
            $update_user_data = $this->security->xss_clean($this->input->post());
            $res =  $this->report_model->updatepassword($update_user_data,$update_user_data['user_id']);
            $this->loadPage(lang('Update Password Success'),'join-report/'.$user_id, 'success');
        }

        if($this->input->post('add_address')){

            $address_post = $this->security->xss_clean($this->input->post());
            $res = $this->report_model->updateAddaddress($address_post);

          $this->loadPage(lang('Update Address Success'),'join-report/'.$user_id, 'success');
         
        }
        $details = $this->report_model->edituserdetails($user_id);
        $countries = $this->helper_model->getAllCountries();
        if($user_id){
            $country_id = $details['country_id'];
            $states = $this->helper_model->getAllStates($country_id);
            $this->setData('states', $states);
        }

        $this->setData('details', $details);
        $this->setData('countries', $countries);
        $this->setData('flag', $flag);
        $this->setData('login_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_38'));
        $this->loadView();
    }
    public function validate_general_update() {
        $this->form_validation->set_rules('email', lang('email'), 'required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('phone_number', lang('phone_number'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }
    public function validate_general_password() {
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[6]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }
    /**
     * For total Joined users report
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function report_total_join() {
        $request = $this->input->get();
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table3 = DB_PREFIX_SYSTEM . 'user_details';
        $table1 = DB_PREFIX_SYSTEM . 'traverse_sponsor';
        $limit = $order = $where = '';

        $user_id = $this->session->userdata('uj_user_id');
        $to_date = $this->session->userdata('uj_to_date');
        $from_date = $this->session->userdata('uj_from_date');

        $column = $this->report_model->getTableColumn();
        $total_records = $this->report_model->countDateJoin($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredTotalJoin($table1, $table2, $table3, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataTotalJoin($table1, $table2, $table3, $where, $order, $limit, $from_date, $to_date, $user_id);

        $count_total_join = count($res_data);
        for ($i = 0; $i < $count_total_join; $i++) {
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][14];
            $res_data[$i][3] = $this->helper_model->IdToUserName($res_data[$i][3]);
            $res_data[$i][8] = lang($res_data[$i][8]);
            $res_data[$i][10] = $this->report_model->IdToCountryName($res_data[$i][10]);
            $res_data[$i][11] = $this->report_model->IdToStateName($res_data[$i][11]);
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_uj_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('uj_user_id', $this->helper_model->userNameToID($get['uj_user']));
            $this->session->set_userdata('uj_from_date', '');
            $this->session->set_userdata('uj_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('uj_user_id', ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId());
            $this->session->set_userdata('uj_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('uj_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('uj_user_id', $this->helper_model->userNameToID($get['uj_user']));
            $this->session->set_userdata('uj_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('uj_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('uj_user_id', ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId());
            $this->session->set_userdata('uj_from_date', '');
            $this->session->set_userdata('uj_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For view the user commission report
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function user_commission() {

        if ($this->session->userdata('uc_user_id') == null)
            $this->session->set_userdata('uc_user_id', '');
        if ($this->session->userdata('uc_from_date') == null)
            $this->session->set_userdata('uc_from_date', '');
        if ($this->session->userdata('uc_to_date') == null)
            $this->session->set_userdata('uc_to_date', '');

        $this->setData('title', lang('menu_name_39'));
        $this->loadView();
    }

    /**
     * For all commission reports
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function report_commission_all() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'wallet_details';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table3 = DB_PREFIX_SYSTEM . 'user_details';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('uc_to_date');
        $from_date = $this->session->userdata('uc_from_date');
        $user_id = $this->session->userdata('uc_user_id');

        $column = $this->report_model->getTableColumnReortCommission();
        $total_records = $this->report_model->countRportCommission($table1, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredReportCommission($table1, $table2, $table3, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataReportCommission($table1, $table2, $table3, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][4];
            //$res_data[$i][4] = $this->report_model->totalAmountCommission($table1, $from_date, $to_date, $res_data[$i][0]);
            $res_data[$i][4] = $this->report_model->totalCommissionAmount($res_data[$i][0], $from_date, $to_date, $res_data[$i][3],$table1);
            $res_data[$i][3] = lang($res_data[$i][3]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_uc_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('uc_user_id', $this->helper_model->userNameToID($get['uc_user']));
            $this->session->set_userdata('uc_from_date', '');
            $this->session->set_userdata('uc_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('uc_user_id', '');
            $this->session->set_userdata('uc_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('uc_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('uc_user_id', $this->helper_model->userNameToID($get['uc_user']));
            $this->session->set_userdata('uc_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('uc_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('uc_user_id', '');
            $this->session->set_userdata('uc_from_date', '');
            $this->session->set_userdata('uc_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For users purchase order product reports
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function user_orders() {
        if ($this->session->userdata('uo_user_id') == null)
            $this->session->set_userdata('uo_user_id', '');
        if ($this->session->userdata('uo_from_date') == null)
            $this->session->set_userdata('uo_from_date', '');
        if ($this->session->userdata('uo_to_date') == null)
            $this->session->set_userdata('uo_to_date', '');
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_110'));
        $this->loadView();
    }
    
       /**
     * For view all purchase orders report
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function report_order_all() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'orders';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table3 = DB_PREFIX_SYSTEM . 'user_details';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('uo_to_date');
        $from_date = $this->session->userdata('uo_from_date');
        $user_id = $this->session->userdata('uo_user_id');

        $column = $this->report_model->getTableColumnReortOrders();
        $total_records = $this->report_model->countRportOrders($table1, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredReportOrders($table1, $table2, $table3, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataReportOrders($table1, $table2, $table3, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][6];
            $res_data[$i][6] = $this->report_model->getAllProductDetails($res_data[$i][0]);
            $res_data[$i][0] = $i + $request['start'] + 1;
            //$res_data[$i][3] = round($res_data[$i][3], 8);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_uo_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('uo_user_id', $this->helper_model->userNameToID($get['uo_user']));
            $this->session->set_userdata('uo_from_date', '');
            $this->session->set_userdata('uo_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('uo_user_id', '');
            $this->session->set_userdata('uo_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('uo_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('uo_user_id', $this->helper_model->userNameToID($get['uo_user']));
            $this->session->set_userdata('uo_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('uo_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('uo_user_id', '');
            $this->session->set_userdata('uo_from_date', '');
            $this->session->set_userdata('uo_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For users rank achieving reports
     * @author Techffodils Technologies LLP
     * @date 2017-12-16
     */
    function rank_history_report() {

        if ($this->session->userdata('ut_user_id') == null)
            $this->session->set_userdata('ut_user_id', '');
        if ($this->session->userdata('ut_from_date') == null)
            $this->session->set_userdata('ut_from_date', '');
        if ($this->session->userdata('ut_to_date') == null)
            $this->session->set_userdata('ut_to_date', '');

        $this->setData('title', lang('menu_name_177'));
        $this->loadView();
    }

    function rank_history_report_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'rank_history';
        $table2 = DB_PREFIX_SYSTEM . 'rank';
        $table3 = DB_PREFIX_SYSTEM . 'user';
        $table4 = DB_PREFIX_SYSTEM . 'user_details';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('ut_to_date');
        $from_date = $this->session->userdata('ut_from_date');
        $user_id = $this->session->userdata('ut_user_id');

        $column = $this->report_model->getTableColumnRankHistoryList();
        $total_records = $this->report_model->countOfRankHistoryList($table1, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredRankHistoryList($table1, $table2, $table3, $table4, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataRankHistoryList($table1, $table2, $table3, $table4, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][5];
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_ut_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('ut_user_id', $this->helper_model->userNameToID($get['ut_user']));
            $this->session->set_userdata('ut_from_date', '');
            $this->session->set_userdata('ut_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('ut_user_id', '');
            $this->session->set_userdata('ut_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ut_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('ut_user_id', $this->helper_model->userNameToID($get['ut_user']));
            $this->session->set_userdata('ut_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ut_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('ut_user_id', '');
            $this->session->set_userdata('ut_from_date', '');
            $this->session->set_userdata('ut_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For activity history report
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function history_report() {
        if ($this->session->userdata('ua_user_id') == null)
            $this->session->set_userdata('ua_user_id', '');
        if ($this->session->userdata('ua_from_date') == null)
            $this->session->set_userdata('ua_from_date', '');
        if ($this->session->userdata('ua_to_date') == null)
            $this->session->set_userdata('ua_to_date', '');
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_112'));
        $this->loadView();
    }

    /**
     * For total history report
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function report_total_history() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'activity';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('ua_to_date');
        $from_date = $this->session->userdata('ua_from_date');
        $user_id = $this->session->userdata('ua_user_id');

        $column = $this->report_model->getTableColumnReortHistory();
        $total_records = $this->report_model->countOfTotalHistory($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredTotalHistory($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataTotalHistory($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = lang($res_data[$i][2]);
            $res_data[$i][4] = "<label title='" . $res_data[$i][8] . "'>" .
                    $res_data[$i][4]
                    . "</label>";
            if ($res_data[$i][5]) {
                $res_data[$i][5] = $res_data[$i][5] . "<br>" . $res_data[$i][6] . "<br>" . $res_data[$i][7];
            } else {
                $res_data[$i][5] = lang('na');
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_ua_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('ua_user_id', $this->helper_model->userNameToID($get['ua_user']));
            $this->session->set_userdata('ua_from_date', '');
            $this->session->set_userdata('ua_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('ua_user_id', '');
            $this->session->set_userdata('ua_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ua_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('ua_user_id', $this->helper_model->userNameToID($get['ua_user']));
            $this->session->set_userdata('ua_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ua_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('ua_user_id', '');
            $this->session->set_userdata('ua_from_date', '');
            $this->session->set_userdata('ua_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For user balance report
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function user_balance() {
        if ($this->session->userdata('ub_user_id') == null)
            $this->session->set_userdata('ub_user_id', '');
        if ($this->session->userdata('ub_from_date') == null)
            $this->session->set_userdata('ub_from_date', '');
        if ($this->session->userdata('ub_to_date') == null)
            $this->session->set_userdata('ub_to_date', '');

        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_111'));
        $this->loadView();
    }

    /**
     * For total balance report
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function report_total_balance() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'user_balance';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('ub_to_date');
        $from_date = $this->session->userdata('ub_from_date');
        $user_id = $this->session->userdata('ub_user_id');

        $column = $this->report_model->getTableColumnReortBalance();
        $total_records = $this->report_model->countOfTotalBalance($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredTotalBalance($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataTotalBalance($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
//            $res_data[$i][2] = round($res_data[$i][2], 8);
//            $res_data[$i][3] = round($res_data[$i][3], 8);
//            $res_data[$i][4] = round($res_data[$i][4], 8);
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_ub_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('ub_user_id', $this->helper_model->userNameToID($get['ub_user']));
            $this->session->set_userdata('ub_from_date', '');
            $this->session->set_userdata('ub_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('ub_user_id', '');
            $this->session->set_userdata('ub_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ub_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('ub_user_id', $this->helper_model->userNameToID($get['ub_user']));
            $this->session->set_userdata('ub_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ub_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('ub_user_id', '');
            $this->session->set_userdata('ub_from_date', '');
            $this->session->set_userdata('ub_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For listing up all cron running history FG
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function cron_report() {

        if ($this->session->userdata('cj_user_id') == null)
            $this->session->set_userdata('cj_user_id', '');
        if ($this->session->userdata('cj_from_date') == null)
            $this->session->set_userdata('cj_from_date', '');
        if ($this->session->userdata('cj_to_date') == null)
            $this->session->set_userdata('cj_to_date', '');

        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_118'));
        $this->loadView();
    }

    /**
     * For list out all the cron jobs 
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function cron_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'cron_job';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'cron_job',
            'ip',
            'date',
            'status'
        );

        $to_date = $this->session->userdata('cj_to_date');
        $from_date = $this->session->userdata('cj_from_date');
        $user_id = $this->session->userdata('cj_user_id');

        $column = $this->report_model->getTableColumnCronList();
        $total_records = $this->report_model->countOfCronList($table, $from_date, $to_date, $user_id);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->report_model->getTotalFilteredCronList($table, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataCronList($table, $columns, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][1] = lang('' . $res_data[$i][1] . '');
            $res_data[$i][4] = lang('' . $res_data[$i][4] . '');
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_cj_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('cj_user_id', $this->helper_model->userNameToID($get['cj_user']));
            $this->session->set_userdata('cj_from_date', '');
            $this->session->set_userdata('cj_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('cj_user_id', '');
            $this->session->set_userdata('cj_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('cj_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('cj_user_id', $this->helper_model->userNameToID($get['cj_user']));
            $this->session->set_userdata('cj_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('cj_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('cj_user_id', '');
            $this->session->set_userdata('cj_from_date', '');
            $this->session->set_userdata('cj_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For affiliates List
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function affiliates_list() {

        if ($this->session->userdata('aj_user_id') == null)
            $this->session->set_userdata('aj_user_id', '');
        if ($this->session->userdata('aj_from_date') == null)
            $this->session->set_userdata('aj_from_date', '');
        if ($this->session->userdata('aj_to_date') == null)
            $this->session->set_userdata('aj_to_date', '');

        $this->setData('title', lang('menu_name_134'));
        $this->loadView();
    }

    /**
     * For list out the active affiliates list
     * @author Techffodils Technologies LLP
     * @date 2017-12-18  
     */
    function active_affiliates_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliates';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('aj_to_date');
        $from_date = $this->session->userdata('aj_from_date');
        $user_id = $this->session->userdata('aj_user_id');

        $column = $this->report_model->getTableColumnAffiliates();
        $total_records = $this->report_model->countOfAffiliatesActive($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredAffiliatesActive($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataAffiliatesActive($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);

        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][5] = $res_data[$i][5] . ' ' . $res_data[$i][6];
            if ($res_data[$i][7] == 1) {
                $res_data[$i][6] = ' <a  class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('activate') . '">' . lang('activate') . '</a> ';
            } else {
                $res_data[$i][6] = ' <a  class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('inactive') . '">' . lang('inactive') . '</a>';
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_aj_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('aj_user_id', $this->helper_model->userNameToAffID($get['aj_user'], 1));
            $this->session->set_userdata('aj_from_date', '');
            $this->session->set_userdata('aj_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('aj_user_id', '');
            $this->session->set_userdata('aj_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('aj_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('aj_user_id', $this->helper_model->userNameToAffID($get['aj_user'], 1));
            $this->session->set_userdata('aj_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('aj_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('aj_user_id', '');
            $this->session->set_userdata('aj_from_date', '');
            $this->session->set_userdata('aj_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For History affiliates report
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function history_report_affiliates() {
        if ($this->session->userdata('aa_user_id') == null)
            $this->session->set_userdata('aj_user_id', '');
        if ($this->session->userdata('aa_from_date') == null)
            $this->session->set_userdata('aa_from_date', '');
        if ($this->session->userdata('aa_to_date') == null)
            $this->session->set_userdata('aa_to_date', '');
        $this->setData('title', lang('menu_name_131'));
        $this->loadView();
    }

    /**
     * For affiliates activity history
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function report_total_history_affiliates() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_activity';
        $table2 = DB_PREFIX_SYSTEM . 'affiliates';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('aa_to_date');
        $from_date = $this->session->userdata('aa_from_date');
        $user_id = $this->session->userdata('aa_user_id');

        $column = $this->report_model->getTableColumnReortHistoryAffiliates();
        $total_records = $this->report_model->countOfTotalHistoryAffiliates($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredTotalHistoryAffiliates($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataTotalHistoryAffiliates($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = lang($res_data[$i][2]);
            $res_data[$i][4] = "<label title='" . $res_data[$i][8] . "'>" .
                    $res_data[$i][4]
                    . "</label>";
            if ($res_data[$i][5]) {
                $res_data[$i][5] = $res_data[$i][5] . "<br>" . $res_data[$i][6] . "<br>" . $res_data[$i][7];
            } else {
                $res_data[$i][5] = lang('na');
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_aa_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('aa_user_id', $this->helper_model->userNameToAffID($get['aa_user']));
            $this->session->set_userdata('aa_from_date', '');
            $this->session->set_userdata('aa_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('aa_user_id', '');
            $this->session->set_userdata('aa_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('aa_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('aa_user_id', $this->helper_model->userNameToAffID($get['aa_user']));
            $this->session->set_userdata('aa_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('aa_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('aa_user_id', '');
            $this->session->set_userdata('aa_from_date', '');
            $this->session->set_userdata('aa_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For listing up all employee list
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function employee_list() {

        if ($this->session->userdata('ej_user_id') == null)
            $this->session->set_userdata('ej_user_id', '');
        if ($this->session->userdata('ej_from_date') == null)
            $this->session->set_userdata('ej_from_date', '');
        if ($this->session->userdata('ej_to_date') == null)
            $this->session->set_userdata('ej_to_date', '');

        $this->setData('title', lang('menu_name_117'));
        $this->loadView();
    }

    /**
     * For active employee report
     * @author Techffodils Technologies LLP
     * @date 2017-12-18
     */
    function active_employee_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'employee_login';
        $table2 = DB_PREFIX_SYSTEM . 'employee_details';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('ej_to_date');
        $from_date = $this->session->userdata('ej_from_date');
        $user_id = $this->session->userdata('ej_user_id');

        $column = $this->report_model->getTableColumnEmployee();
        $total_records = $this->report_model->countOfEmployeeActive($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredEmployeeActive($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataEmployeeActive($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][5] = $res_data[$i][5] . " " . $res_data[$i][6];
            if ($res_data[$i][7] == 1) {
                $res_data[$i][6] = ' <a  class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('activate') . '">' . lang('activate') . '</a> ';
            } else {
                $res_data[$i][6] = ' <a  class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('inactive') . '">' . lang('inactive') . '</a>';
            }
            $res_data[$i][0] = $i + $request['start'] + 1;
            //$res_data[$i][1] = '<a href="' . $path . '"><i class="fa fa-user fa-fw"></i>' . $res_data[$i][1] . '</a>';
            $res_data[$i][0] = $i + $request['start'] + 1;
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_ej_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('ej_user_id', $this->helper_model->userNameToEmpID($get['ej_user']));
            $this->session->set_userdata('ej_from_date', '');
            $this->session->set_userdata('ej_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('ej_user_id', '');
            $this->session->set_userdata('ej_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ej_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('ej_user_id', $this->helper_model->userNameToEmpID($get['ej_user']));
            $this->session->set_userdata('ej_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ej_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('ej_user_id', '');
            $this->session->set_userdata('ej_from_date', '');
            $this->session->set_userdata('ej_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    /**
     * For List out the employee's
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function employee_histroy() {
        if ($this->session->userdata('ea_user_id') == null)
            $this->session->set_userdata('ea_user_id', '');
        if ($this->session->userdata('ea_from_date') == null)
            $this->session->set_userdata('ea_from_date', '');
        if ($this->session->userdata('ea_to_date') == null)
            $this->session->set_userdata('ea_to_date', '');
        $this->setData('title', lang('menu_name_133'));
        $this->loadView();
    }

    /**
     * For list out the employee activity history
     * @author Techffodils Technologies LLP
     * @date 2017-12-18 
     */
    function employee_histroy_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'activity';
        $table2 = DB_PREFIX_SYSTEM . 'employee_login';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('ea_to_date');
        $from_date = $this->session->userdata('ea_from_date');
        $user_id = $this->session->userdata('ea_user_id');

        $column = $this->report_model->getTableColumnEmployeeReortHistory();
        $total_records = $this->report_model->countOfTotalEmployeeHistory($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredTotalEmployeeHistory($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataTotalEmployeeHistory($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        for ($i = 0; $i < $count_commission; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = lang($res_data[$i][2]);
            $res_data[$i][4] = "<label title='" . $res_data[$i][8] . "'>" .
                    $res_data[$i][4]
                    . "</label>";
            if ($res_data[$i][5]) {
                $res_data[$i][5] = $res_data[$i][5] . "<br>" . $res_data[$i][6] . "<br>" . $res_data[$i][7];
            } else {
                $res_data[$i][5] = lang('na');
            }
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    function set_ea_variables() {
        $get = $this->input->get();

        if ($get['report_type'] == 'user') {
            $this->session->set_userdata('ea_user_id', $this->helper_model->userNameToEmpID($get['ea_user'], 1));
            $this->session->set_userdata('ea_from_date', '');
            $this->session->set_userdata('ea_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('ea_user_id', '');
            $this->session->set_userdata('ea_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ea_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('ea_user_id', $this->helper_model->userNameToEmpID($get['ea_user'], 1));
            $this->session->set_userdata('ea_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ea_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('ea_user_id', '');
            $this->session->set_userdata('ea_from_date', '');
            $this->session->set_userdata('ea_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }
    
    
    function binary_history_report() {

        if ($this->session->userdata('ubin_user_id') == null)
            $this->session->set_userdata('ubin_user_id', '');
        if ($this->session->userdata('ubin_from_date') == null)
            $this->session->set_userdata('ubin_from_date', '');
        if ($this->session->userdata('ubin_to_date') == null)
            $this->session->set_userdata('ubin_to_date', '');

        $this->setData('title', lang('menu_name_191'));
        $this->loadView();
    }
    
    function binary_history_report_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'binary_bonus_history';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $to_date = $this->session->userdata('ubin_to_date');
        $from_date = $this->session->userdata('ubin_from_date');
        $user_id = $this->session->userdata('ubin_user_id');

        $column = $this->report_model->getTableColumnBinaryHistory();
        $total_records = $this->report_model->countOfTotalBinaryHistory($table1, $table2, $from_date, $to_date, $user_id);
        $limit = $this->report_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->report_model->getTotalFilteredTotalBinaryHistory($table1, $table2, $where, $from_date, $to_date, $user_id);
        $res_data = $this->report_model->getResultDataTotalBinaryHistory($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id);
        $count_commission = count($res_data);
        $a = 0;
        $b = 0;
        for ($i = 0; $i < $count_commission; $i++) {
             $res_data[$i][0] = $i + $request['start'] + 1;
             $a += $res_data[$i][7];
             $b += $res_data[$i][8];
            $res_data[$i][7] = $this->helper_model->currency_conversion($res_data[$i][7]);
            $res_data[$i][8] = $this->helper_model->currency_conversion($res_data[$i][8]);
        }
        
        if ($i = $count_commission) {
            $b = $this->helper_model->currency_conversion($b);
            $a = $this->helper_model->currency_conversion($a);
            $res_data[$i][0] = '';
            $res_data[$i][1] = 'Total';
            $res_data[$i][2] = '';
            $res_data[$i][3] = '';
            $res_data[$i][4] = '';
            $res_data[$i][5] = '';
            $res_data[$i][6] = '';
            $res_data[$i][7] = $a;
            $res_data[$i][8] = $b;
            $res_data[$i][9] = '';
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

     function set_ubin_variables() {
        $get = $this->input->get();
         if ($get['report_type'] == 'user') {
            $this->session->set_userdata('ubin_user_id', $this->helper_model->userNameToID($get['ubin_user']));
            $this->session->set_userdata('ubin_from_date', '');
            $this->session->set_userdata('ubin_to_date', '');
        } elseif ($get['report_type'] == 'date') {
            $this->session->set_userdata('ubin_user_id', '');
            $this->session->set_userdata('ubin_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ubin_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'user_date') {
            $this->session->set_userdata('ubin_user_id', $this->helper_model->userNameToID($get['ubin_user']));
            $this->session->set_userdata('ubin_from_date', $get['from_date'] . "  00:00:00");
            $this->session->set_userdata('ubin_to_date', $get['to_date'] . " 23:59:59");
        } elseif ($get['report_type'] == 'all') {
            $this->session->set_userdata('ubin_user_id', '');
            $this->session->set_userdata('ubin_from_date', '');
            $this->session->set_userdata('ubin_to_date', '');
        } else {
            echo 'no';
            exit();
        }
        echo 'yes';
        exit();
    }

    public function check_current_password() {
        $this->load->helper('security');
        $this->load->model('profile_model');
        $post = $this->security->xss_clean($this->input->get());
        $user_id = $this->session->userdata('user_id');

        if ($this->profile_model->checkUserCurrentPasswod($user_id, $post['current_password'])) {
            echo 'yes';
            exit;
        }
        echo 'no';
        $this->session->unset_userdata('user_id');
    }

}
