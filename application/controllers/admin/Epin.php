<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Epin extends Base_Controller {

    /**
     * For E-pin management create delete,edit,update
     * @param type $action
     * @param type $request_id
     * @param type $expiry_date
     * @date 2107-12-03
     */
    function epin_management($action = '', $request_id = '', $expiry_date = '') {
        $tab1 = ' active';
        $tab2 = $tab3 = $tab4 = '';
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($action && $request_id) {
            $this->session->set_userdata('active_pin_tab', 'tab2');
            if ($action == 'cancel') {
                $res = $this->epin_model->updateRequestStatus($request_id, 'canceled');
                if ($res) {
                    $activity['request_id'] = $request_id;
                    $this->helper_model->insertActivity($user_id, 'pin_requested_canceled', $activity);
                    $this->loadPage(lang('request_canceled'), 'e-pin-manage');
                } else {
                    $this->loadPage(lang('canceletion_failed'), 'e-pin-manage', 'danger');
                }
            } elseif ($expiry_date && $action == 'confirm') {
                $d = DateTime::createFromFormat('Y-m-d', $expiry_date);
                if (!$this->helper_model->validateDate($expiry_date) || strtotime(date("Y-m-d H:i:s") < strtotime($expiry_date))) {
                    $this->loadPage(lang('invalid_expiry_date'), 'e-pin-manage', 'danger');
                }
                $data = $this->epin_model->getRequestData($request_id);
                if ($data) {
                    $data['expiry_date'] = $expiry_date;
                    if ($this->epin_model->checkUserBalance($data)) {
                        $res = $this->epin_model->addPinToUser($data);
                        if ($res) {
                            $this->helper_model->insertWalletDetails($data['user_id'], 'debit', $data['pin_amount'] * $data['pin_count'], 'pin_purchased');
                            $this->epin_model->updateRequestStatus($request_id, 'confirmed');
                            $this->helper_model->insertActivity($user_id, 'pin_requested_confirmed', $data);
                            $this->loadPage(lang('request_confirmed'), 'e-pin-manage');
                        } else {
                            $this->loadPage(lang('failed_to_confirm'), 'e-pin-manage', 'danger');
                        }
                    } else {
                        $this->loadPage(lang('insuff_balance'), 'e-pin-manage', 'danger');
                    }
                } else {
                    $this->loadPage(lang('invalid_request'), 'e-pin-manage', 'danger');
                }
            }
        }
        if ($this->input->post('add_pin') && $this->validate_add_pin()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $post['user_id'] = $this->helper_model->userNameToID($post['username']);
            $res = $this->epin_model->addPinToUser($post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'pin_added', $post);
                $this->loadPage(lang('pin_added_successfully'), 'e-pin-manage');
            } else {
                $this->loadPage(lang('failed_to_add'), 'e-pin-manage', 'danger');
            }
        }
        $active_tab = '';
        if ($this->session->userdata('active_pin_tab') != null) {
            $tab1 = $tab2 = $tab3 = $tab4 = '';
            $active_tab = $this->session->userdata('active_pin_tab');
        }
        $active_pin_count = $this->epin_model->countOfTotalPinActive();
        $used_pin_count = $this->epin_model->countOfTotalPinUsed();
        $pin_req_count = $this->epin_model->countOfTotalPinRequest();
        $this->setData('active_pins_count', $active_pin_count);
        $this->setData('used_pins_count', $used_pin_count);
        $this->setData('pin_req_count', $pin_req_count);
        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('tab4', $tab4);
        $this->setData($active_tab, ' active');
        $this->setData('pin_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_8'));
        $this->loadView();
    }

    /**
     * For change the E-pin status
     * @param type $action
     * @param type $id
     * @date 2107-12-03
     */
    function change_pin_status($action = '', $id = '') {
        if ($action && $id) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($action == 'inactivate') {
                $res = $this->epin_model->updatePinStatus($id, 0);
                if ($res) {
                    $activity['pin_id'] = $id;
                    $this->helper_model->insertActivity($user_id, 'pin_inactivated', $activity);
                    $this->loadPage(lang('pin_inactivated_successfully'), 'e-pin-manage');
                } else {
                    $this->loadPage(lang('failed_to_inactivate_epin'), 'e-pin-manage', 'danger');
                }
            } elseif ($action == 'activate') {
                $res = $this->epin_model->updatePinStatus($id, 1);
                if ($res) {
                    $activity['pin_id'] = $id;
                    $this->helper_model->insertActivity($user_id, 'pin_activated', $activity);
                    $this->loadPage(lang('pin_activated_successfully'), 'e-pin-manage');
                } else {
                    $this->loadPage(lang('failed_to_activate_epin'), 'e-pin-manage', 'danger');
                }
            }
        }
        $this->loadPage(lang('invalid_request'), 'e-pin-manage', 'danger');
    }

    /**
     * for validate the E-pin
     * @date 2107-12-03
     * @return type
     */
    function validate_add_pin() {
        $this->session->set_userdata('active_pin_tab', 'tab1');
        $this->form_validation->set_rules('username', lang('username'), 'required|callback_validate_username|trim');
        $this->form_validation->set_rules('pin_amount', lang('pin_amount'), 'required|greater_than[0]');
        $this->form_validation->set_rules('pin_count', lang('pin_count'), 'required|greater_than[0]');
        $this->form_validation->set_rules('expiry_date', lang('expiry_date'), 'required|callback_validate_date');

        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate username
     * @date 2017-12-03
     * @param type $username
     * @return boolean
     */
    function validate_username($username) {
        $flag = false;
        if ($this->helper_model->userNameToID($username)) {
            $flag = true;
        }
        $this->form_validation->set_message('validate_username', lang('validate_username'));
        return $flag;
    }

    /**
     * For validate the date
     * @date 2107-12-03
     * @param type $date
     * @return boolean
     */
    function validate_date($date) {
        $startDate = strtotime(date("Y-m-d H:i:s"));
        $endDate = strtotime($date);

        if ($endDate >= $startDate)
            return True;
        else {
            $this->form_validation->set_message('validate_date', lang('should_be_greate than today'));
            return False;
        }
    }

    /**
     * For list out the all active E-pin
     * @author Techffodils Technologies LLP
     * @date 2107-12-03
     */
    function active_pin() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'pin_numbers';
        $limit = $order = $where = '';
        $column = $this->epin_model->getTableColumnPinActive();
        $total_records = $this->epin_model->countOfTotalPinActive();
        $limit = $this->epin_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->epin_model->getTotalFilteredTotalPinActive($table1, $table2, $where);
        $res_data = $this->epin_model->getResultDataTotalPinActive($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            if ($res_data[$i][7]) {
                $res_data[$i][7] = lang('active');
                $res_data[$i][8] = '<center><a href="javascript:inactivate_epin(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a></center>';
            } else {
                $res_data[$i][7] = lang('inactive');
                $res_data[$i][8] = '<center><a href="javascript:activate_epin(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a></center>';
            }
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

    /**
     * for list-out the used E-pins
     * @author Techffodils Technologies LLP
     * @date 2018-01-05
     */
    function used_pin() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'pin_numbers';
        $limit = $order = $where = '';
        $column = $this->epin_model->getTableColumnPinUsed();
        $total_records = $this->epin_model->countOfTotalPinUsed();
        $limit = $this->epin_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->epin_model->getTotalFilteredTotalPinUsed($table1, $table2, $where);
        $res_data = $this->epin_model->getResultDataTotalPinUsed($table1, $table2, $where, $order, $limit);
        $count_pin_used = count($res_data);
        $today = date("Y-m-d H:i:s");
        for ($i = 0; $i < $count_pin_used; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            if ($res_data[$i][4] == 0) {
                $res_data[$i][6] = $this->helper_model->IdToUserName($res_data[$i][6]);
            }
            if ($res_data[$i][4] > 0 && $res_data[$i][6] < $today) {
                $res_data[$i][6] = lang('nill');
                $res_data[$i][5] = lang('expired');
            }
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

    /**
     * For Requested Users E-pin Details
     * @author Techffodils Technologies LLP
     * @date 2018-01-05 
     */
    function request_pin() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'pin_request';
        $limit = $order = $where = '';
        $column = $this->epin_model->getTableColumnPinRequest();
        $total_records = $this->epin_model->countOfTotalPinRequest();
        $limit = $this->epin_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->epin_model->getTotalFilteredTotalPinRequest($table1, $table2, $where);
        $res_data = $this->epin_model->getResultDataTotalPinRequest($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][3] = round($res_data[$i][3], 8);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][2] = $this->helper_model->getUserBalance($res_data[$i][2]);
            $res_data[$i][2] = $this->helper_model->currency_conversion($res_data[$i][2]);
            if ($res_data[$i][6] == 'requested') {
                $res_data[$i][6] = '<div class="input-group">
                                                                <input name="expiry_date_' . $res_data[$i][0] . '" id="expiry_date_' . $res_data[$i][0] . '" type="text" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker">
                                                                <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>                                                                </div>
                                                            <span name="expiry_error_' . $res_data[$i][0] . '" id="expiry_error_' . $res_data[$i][0] . '" style="color: #a94442;"></span>';
                $res_data[$i][7] = '<a href="javascript:confirm_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="confirm">
                                                                <i class="glyphicon glyphicon-ok-sign"></i>
                                                            </a>

                                                            <a href="javascript:cancel_request(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="cancel">
                                                                <i class="fa fa-trash fa fa-white"></i>
                                                            </a>';
            } else {
                $res_data[$i][7] = lang('' . $res_data[$i][6] . '');
                ;
                $res_data[$i][6] = '';
            }

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

}
