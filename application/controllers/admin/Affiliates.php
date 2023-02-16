<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Affiliates extends Base_Controller {

    /**
     * For enroll new affiliates to the system
     * @author Techffodils Technologies LLP
     * @date 2018-02-01
     * @param type $action
     * @param type $event_id
     */
    function affiliates_users($action = '', $event_id = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $edit_details = '';
        $countries = '';
        $states = '';
        if ($action && $event_id) {
            $data['action'] = $action;
            $data['event_id'] = $event_id;
            if ($action == 'delete') {

                $res = $this->affiliates_model->deleteAffiliate($event_id);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'delete_affiliate_user', $data);
                    $this->loadPage(lang('affiliate_user_deleted'), 'affiliate-details');
                } else {
                    $this->loadPage(lang('affiliate_deletion_failed'), 'affiliate-details', 'danger');
                }
            } elseif ($action == 'inactivate') {
                $res = $this->affiliates_model->updateAffiliateStatus($event_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'affiliate_user_inactivated', $data);
                    $this->loadPage(lang('affiliates_inactivated'), 'affiliate-details');
                } else {
                    $this->loadPage(lang('affiliates_inactition_failed'), 'affiliate-details', 'danger');
                }
            } elseif ($action == 'activate') {
                $res = $this->affiliates_model->updateAffiliateStatus($event_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'affiliate_user_activated', $data);
                    $this->loadPage(lang('affiliates_activated'), 'affiliate-details');
                } else {
                    $this->loadPage(lang('affiliates_activation_failed'), 'affiliate-details', 'danger');
                }
            } elseif ($action == 'edit') {
                $country_id = $this->affiliates_model->getcountryCode($event_id);
                $countries = $this->helper_model->getAllCountries();
                $states = $this->helper_model->getAllStates($country_id);
                $this->setData('countries', $countries);
                $this->setData('states', $states);
                $edit_details = $this->affiliates_model->gettingAffiliatesDetails($event_id);
                $this->setData('edit_details', $edit_details);
            } else {
                $this->loadPage(lang('invalid_action'), 'affiliate-details', 'danger');
            }
        }

        if ($this->input->post('update_affiliates') && $this->validate_affiliates_details()) {
            $this->load->helper('security');
            $data = $this->security->xss_clean($this->input->post());

            $res = $this->affiliates_model->updateAffiliatesDetails($data);
            if ($res) {
                $msg = lang('successfully_updated_affiliated_details');
                $this->loadPage($msg, 'affiliate-details');
            } else {
                $msg = lang('error_updated_affiliated_details');
                $this->loadPage($msg, 'affiliate-details', 'danger');
            }
        }

        $this->setData('edit_details', $edit_details);
        $this->setData('title', lang('menu_name_122'));
        $this->loadView();
    }

    /**
     * For Getting the affiliates users
     * @author Techffodils Technologies LLP
     * @date 2018-02-01
     */
    function affiliates_user_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliates';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesList();
        $total_records = $this->affiliates_model->countOfAffiliatesList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesList($table1, $table2, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesList($table1, $table2, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][6]) {
                $res_data[$i][6] = '<a href="javascript:edit_affiliates(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_affiliates(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_affiliates(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][6] = '<a href="javascript:edit_affiliates(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activate_affiliates(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_affiliates(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
     * For Validating the affiliates
     * @author validate the affilates details
     * @date 2018-02-01
     * @return type
     */
    public function validate_affiliates_details() {
        $this->form_validation->set_rules('email', lang('email_id'), 'trim|required|valid_email');
        $this->form_validation->set_rules('mobile', lang('mobile'), 'trim|required|numeric');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required');
        $this->form_validation->set_rules('country', lang('country'), 'trim|required');
        $result = $this->form_validation->run();
        return $result;
    }

    /**
     * For adding the course management
     * @author Techffodils Technologies LLP
     * @param type $action
     * @param type $course_id
     * @param type $action
     * @param type $course_id
     * @param type $action
     * @param type $course_id
     */
    function course_management($action = '', $course_id = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('create_course') && $this->validate_course()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $res = $this->affiliates_model->createCourse($post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'new_course_created', $post);
                $this->loadPage(lang('new_course_created_successfully'), 'manage-courses');
            } else {
                $this->loadPage(lang('failed_to_create_course'), 'manage-courses', 'danger');
            }
        }
        $data = array();
        $flag = 0;
        if ($action && $course_id) {
            $action_data['action'] = $action;
            $action_data['course_id'] = $course_id;
            if ($action == 'activate') {
                $res = $this->affiliates_model->changeCourseStatus($course_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'course_activated', $action_data);
                    $this->loadPage(lang('course_activated_successfully'), 'manage-courses');
                } else {
                    $this->loadPage(lang('failed_to_activated_course'), 'manage-courses', 'danger');
                }
            } elseif ($action == 'inactivate') {
                $res = $this->affiliates_model->changeCourseStatus($course_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'course_inactivated', $action_data);
                    $this->loadPage(lang('course_inactivated_successfully'), 'manage-courses');
                } else {
                    $this->loadPage(lang('failed_to_inactivated_course'), 'manage-courses', 'danger');
                }
            } elseif ($action == 'edit') {
                $flag = 1;
                $data = $this->affiliates_model->getCourseDetails($course_id);
            }
        }

        if ($this->input->post('update_course') && $this->validate_course()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());


            $res = $this->affiliates_model->updateCourse($post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'course_updated', $post);
                $this->loadPage(lang('course_updated_successfully'), 'manage-courses');
            } else {
                $this->loadPage(lang('failed_to_updated_course'), 'manage-courses', 'danger');
            }
        }

        $this->setData('course_id', $course_id);
        $this->setData('flag', $flag);
        $this->setData('data', $data);
        $this->setData('course_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_128'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies
     * For validate the course
     * @author 2018-02-02
     * @return type
     */
    public function validate_course() {
        $this->form_validation->set_rules('course_name', lang('course_name'), 'trim|required|callback_validate_course_name');
        $this->form_validation->set_rules('course_order', lang('order'), 'trim|required|numeric');
        $result = $this->form_validation->run();
        return $result;
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-02-02
     * @param type $course
     * @return boolean
     */
    function validate_course_name($course = '') {
        $flag = false;
        if ($course) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $id = $post['course_id'];
            if (!$this->affiliates_model->validateCourseName($course, $id)) {
                $flag = true;
            }
            return $flag;
        } elseif ($course = $this->input->get('course_name')) {
            $id = $this->input->get('course_id');
            if (!$this->affiliates_model->validateCourseName($course, $id)) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
        return $flag;
    }

    /**
     * 
     */
    function course_management_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'affiliate_courses';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'course_name',
            '`order`',
            'added_date',
            'enquiry_count',
            'status'
        );
        $column = $this->affiliates_model->getTableColumnCourseManagementList();
        $total_records = $this->affiliates_model->countOfCourseManagementList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrderCOURSES($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredCourseManagementList($table, $where);
        $res_data = $this->affiliates_model->getResultDataCourseManagementList($table, $columns, $where, $order, $limit);
        $count_affiliates = count($res_data);
        for ($i = 0; $i < $count_affiliates; $i++) {
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a href="javascript:edit_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:edit_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activate_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a>';
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
     * For Coupon Management
     * @author Tehffodils Technologies LLP
     * @date 2018-02-02
     */
    function coupon_management() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $available_balance = $this->helper_model->currency_conversion($this->affiliates_model->getUserCouponBalance($user_id), 1);
        if ($this->input->post('create_coupon') && $this->validate_coupon($available_balance)) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $res = $this->affiliates_model->createCoupon($user_id, $post['coupon_amount']);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'coupon_created', $post);
                $this->loadPage(lang('coupon_created_successfully'), 'manage-coupons');
            } else {
                $this->loadPage(lang('failed_to_create_coupon'), 'manage-coupons', 'danger');
            }
        }
        $this->setData('coupon_error', $this->form_validation->error_array());
        $this->setData('available_balance', $available_balance);
        $this->setData('title', lang('menu_name_129'));
        $this->loadView();
    }

    /**
     * for listing the coupons list
     * @author Techffodils Technologies LLP
     * @date 2018-02-02
     */
    function affiliates_coupons_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_coupons';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesCouponsList();
        $total_records = $this->affiliates_model->countOfAffiliatesCouponsList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesCouponsList($table1, $table2, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesCouponsList($table1, $table2, $where, $order, $limit);
        $count_coupon = count($res_data);
        for ($i = 0; $i < $count_coupon; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<button style="background-color: #4CAF50;color: white;padding: 5px 10px;text-align: center;">' . lang('active') . '</button>';
            } else {
                $res_data[$i][5] = '<button style="background-color: #ffcc66;color: white;padding: 5px 10px;text-align: center;">' . lang('used') . '</button>';
            }
            $res_data[$i][3] = round($res_data[$i][3], 8);
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

    /**
     * for validate Coupon
     * @author Techffodils Technologies LLP
     * @date 2018-02-3
     * @param type $available_balance
     * @return type
     */
    public function validate_coupon($available_balance) {
        $this->form_validation->set_rules('coupon_amount', lang('coupon_amount'), 'trim|required|numeric|callback_maximum_coupon_amount');
        $result = $this->form_validation->run();
        return $result;
    }

    /**
     * For coupon amount settings
     * @author Techffodils Technologies LLP
     * @date 2018-02-3
     * @param type $coupon_amount
     * @return boolean
     */
    public function maximum_coupon_amount($coupon_amount = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $available_balance = $this->helper_model->currency_conversion($this->affiliates_model->getUserCouponBalance($user_id), 1);
        $flag = false;
        if ($coupon_amount > 0) {
            if ($coupon_amount < $available_balance) {
                $flag = true;
            }
            return $flag;
        } elseif ($course = $this->input->get('course_name')) {
            $coupon_amount = $this->helper_model->currency_conversion($this->input->get('coupon_amount'), 1);
            if ($coupon_amount < $available_balance) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For Affiliate Inquiry
     * @author Techffodils Technologies LLP
     * @date 2018-02-3
     * 
     * @param type $action
     * @param type $id
     * @param type $coupon_code
     */
    function affiliates_enquiry($action = '', $id = '', $coupon_code = '') {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($action == 'activate' && $id) {
            $flag = 0;
            $amount = 0;
            if ($coupon_code) {
                if (!$this->helper_model->validateCouponCode($logged_user, $coupon_code)) {
                    $this->loadPage(lang('invalid_coupon_code'), 'affiliate-enquiry', 'danger');
                }
                $amount = $this->helper_model->getCouponAmount($coupon_code);
                $flag = 1;
            }
            $res = $this->affiliates_model->activateEnquiry($id, 1, 0, $coupon_code, $amount);
            if ($res) {
                if ($flag) {
                    $this->affiliates_model->inactivateCoupon($coupon_code);
                }
                $this->helper_model->insertActivity($logged_user, 'enquiry_activated', array('action' => $action, 'id' => $id, 'coupon_code' => $coupon_code));
                $this->loadPage(lang('enquiry_activated_successfully'), 'affiliate-enquiry');
            } else {
                $this->loadPage(lang('enquiry_activation_failed'), 'affiliate-enquiry', 'danger');
            }
        }

        $this->setData('count_all', $this->affiliates_model->countOfAffiliatesEnquiryList($logged_user));
        $this->setData('count_active', $this->affiliates_model->countOfAffiliatesEnquiryActiveAdminList());
        $this->setData('count_completed', $this->affiliates_model->countOfAffiliatesEnquiryConfirmAdminList());
        $this->setData('title', lang('menu_name_130'));
        $this->loadView();
    }

    /**
     * For Enquiry Conformation 
     * @author Techffodils Technologies LLP
     * @date 2018-02-3
     * @param type $action
     * @param type $id
     * @param type $coupon_amount
     */
    function enquiry_confirmation($action = '', $id = '', $coupon_amount = '') {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($action == 'activate' && $id) {
            if ($this->affiliates_model->validateActiveEnquiry($id)) {
                if ($this->dbvars->MULTI_CURRENCY_STATUS > 0) {
                    $currency_ratio = $this->main->get_usersession('mlm_data_currency', 'currency_ratio');
                    $coupon_amount = $coupon_amount / $currency_ratio;
                }
                $res = $this->affiliates_model->completeEnquiry($id, 1, 1, $coupon_amount);
                if ($res) {
                    $this->affiliates_model->addSheduledTask($id);
                    $this->helper_model->insertActivity($logged_user, 'enquiry_completed', array('action' => $action, 'id' => $id, 'coupon_amount' => $coupon_amount));
                    $this->loadPage(lang('enquiry_completed_successfully'), 'affiliate-enquiry');
                } else {
                    $this->loadPage(lang('enquiry_completion_failed'), 'affiliate-enquiry', 'danger');
                }
            }
        }
        $this->loadPage(lang('invalid_action'), 'affiliate-enquiry', 'danger');
    }

    /**
     * For List out the all Enquiry Added
     * @author Techffodils Technologies LLP
     * @date 2018-02-3
     */
    function affiliates_enquiry_active_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'affiliate_enquiry';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesEnquiryActiveAdminList();
        $total_records = $this->affiliates_model->countOfAffiliatesEnquiryActiveAdminList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesEnquiryActiveAdminList($table, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesEnquiryActiveAdminList($table, $where, $order, $limit);
        $count_enquiry = count($res_data);
        for ($i = 0; $i < $count_enquiry; $i++) {
            $res_data[$i][2] = $this->affiliates_model->getAffiliatesUserName($res_data[$i][2]);
            $res_data[$i][9] = round($res_data[$i][9], 8);
            $res_data[$i][9] = $this->helper_model->currency_conversion($res_data[$i][9], 1);

            if ($res_data[$i][3]) {
                $res_data[$i][3] = '<b >' . $this->affiliates_model->getCourseIdToName($res_data[$i][3]) . '</b>';
            }
            if ($res_data[$i][4]) {
                $res_data[$i][4] = $this->affiliates_model->getSubCourseIdToName($res_data[$i][4]);
            } else {
                $res_data[$i][4] = ' ';
            }


            $res_data[$i][5] = $res_data[$i][5] . ' ' . $res_data[$i][10] . '<br>' . $res_data[$i][8] . '<br>' . $res_data[$i][9];
            $res_data[$i][7] = '<input class="form-control" type="text" name="coupon_amount_' . $res_data[$i][0] . '" id="coupon_amount_' . $res_data[$i][0] . '" value=' . $res_data[$i][7] . ' >   <span name="coupon_error_' . $res_data[$i][0] . '" id="coupon_error_' . $res_data[$i][0] . '" style="color: #a94442;"></span> ';
            if ($res_data[$i][6] == '') {
                $res_data[$i][6] = lang('na');
            }
            $res_data[$i][8] = '<a href="javascript:activate_active_enquiry(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> 
                   <a href="javascript:view_enquiry_details(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a>';
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
     * for List all the confirmed enquiry list
     * @author Techffodils Technologies LLP
     * @date 2018-02-03
     */
    function affiliates_enquiry_confirm_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'affiliate_enquiry';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesEnquiryConfirmAdminList();
        $total_records = $this->affiliates_model->countOfAffiliatesEnquiryConfirmAdminList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesEnquiryConfirmAdminList($table, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesEnquiryConfirmAdminList($table, $where, $order, $limit);
        $count_enquiry = count($res_data);
        for ($i = 0; $i < $count_enquiry; $i++) {
            $res_data[$i][2] = $this->affiliates_model->getAffiliatesUserName($res_data[$i][2]);

            if ($res_data[$i][3]) {
                $res_data[$i][3] = '<b >' . $this->affiliates_model->getCourseIdToName($res_data[$i][3]) . '</b>';
            }
            if ($res_data[$i][4]) {
                $res_data[$i][4] = $this->affiliates_model->getSubCourseIdToName($res_data[$i][4]);
            } else {
                $res_data[$i][4] = ' ';
            }

            $res_data[$i][5] = $res_data[$i][5] . ' ' . $res_data[$i][9] . '<br>' . $res_data[$i][7] . '<br>' . $res_data[$i][8];
            $res_data[$i][6] = round($res_data[$i][6], 8);
            $res_data[$i][6] = $this->helper_model->currency_conversion($res_data[$i][6]);
            $res_data[$i][7] = '<a href="javascript:view_enquiry_details(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a>';

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
     * for listing the affiliate enquiry list
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function affiliates_enquiry_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_enquiry';
        $table2 = DB_PREFIX_SYSTEM . 'affiliates';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesEnquiryList();
        $total_records = $this->affiliates_model->countOfAffiliatesEnquiryList($user_id);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesEnquiryList($table1, $table2, $where, $user_id);
        $res_data = $this->affiliates_model->getResultDataAffiliatesEnquiryList($table1, $table2, $where, $order, $limit, $user_id);
        $count_enquiry = count($res_data);
        for ($i = 0; $i < $count_enquiry; $i++) {
            if ($res_data[$i][3]) {
                $res_data[$i][3] = '<b >' . $this->affiliates_model->getCourseIdToName($res_data[$i][3]) . '</b>';
            }

            if ($res_data[$i][4]) {
                $res_data[$i][4] = $this->affiliates_model->getSubCourseIdToName($res_data[$i][4]);
            } else {
                $res_data[$i][4] = ' ';
            }


            $res_data[$i][5] = $res_data[$i][5] . ' ' . $res_data[$i][10] . '<br>' . $res_data[$i][8] . '<br>' . $res_data[$i][9];


            $res_data[$i][6] = '<input class="form-control" type="text" name="coupon_code_' . $res_data[$i][0] . '" id="coupon_code_' . $res_data[$i][0] . '"  >
                    <span name="coupon_error_' . $res_data[$i][0] . '" id="coupon_error_' . $res_data[$i][0] . '" style="color: #a94442;"></span>';
            $res_data[$i][7] = '<a href="javascript:activate_enquiry(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a>  
                    <a href="javascript:view_enquiry_details(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a>';
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
     * for getting  the enquiry details
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function get_enquiry_details() {
        if ($course = $this->input->get('enq_id')) {
            $enq_id = $this->input->get('enq_id');
            echo $this->affiliates_model->createEnquiryDetails($enq_id);
            exit();
        }
        echo 'no';
        exit();
    }

    /**
     * for sub course management
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function sub_course_management($action = '', $course_id = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('create_course') && $this->validate_sub_course()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->affiliates_model->createSubCourse($post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'new_sub_course_created', $post);
                $this->loadPage(lang('new_sub_course_created_successfully'), 'manage-sub-courses');
            } else {
                $this->loadPage(lang('failed_to_create_sub_course'), 'manage-sub-courses', 'danger');
            }
        }
        $data = array();
        $flag = 0;
        if ($action && $course_id) {
            $action_data['action'] = $action;
            $action_data['course_id'] = $course_id;
            if ($action == 'activate') {
                $res = $this->affiliates_model->changeSubCourseStatus($course_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'sub_course_activated', $action_data);
                    $this->loadPage(lang('sub_course_activated_successfully'), 'manage-sub-courses');
                } else {
                    $this->loadPage(lang('failed_to_activated_sub_course'), 'manage-sub-courses', 'danger');
                }
            } elseif ($action == 'inactivate') {
                $res = $this->affiliates_model->changeSubCourseStatus($course_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'course_inactivated', $action_data);
                    $this->loadPage(lang('sub_course_inactivated_successfully'), 'manage-sub-courses');
                } else {
                    $this->loadPage(lang('failed_to_inactivated_sub_course'), 'manage-sub-courses', 'danger');
                }
            } elseif ($action == 'edit') {
                $flag = 1;
                $data = $this->affiliates_model->getSubCourseDetails($course_id);
            }
        }

        if ($this->input->post('update_course') && $this->validate_sub_course()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->affiliates_model->updateSubCourse($post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'sub_course_updated', $post);
                $this->loadPage(lang('sub_course_updated_successfully'), 'manage-sub-courses');
            } else {
                $this->loadPage(lang('failed_to_updated_sub_course'), 'manage-sub-courses', 'danger');
            }
        }
        $course_details = $this->affiliates_model->getCourseNameDetails();
        $this->setData('course_details', $course_details);
        $this->setData('course_id', $course_id);
        $this->setData('flag', $flag);
        $this->setData('data', $data);
        $this->setData('course_error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_135'));
        $this->loadView();
    }

    /**
     * for validate sub course management
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    public function validate_sub_course() {
        $this->form_validation->set_rules('course_name', lang('course_name'), 'trim|required');
        $this->form_validation->set_rules('sub_course_name', lang('sub_course_name'), 'trim|required');
        $this->form_validation->set_rules('course_order', lang('order'), 'trim|required|numeric');
        $result = $this->form_validation->run();
        return $result;
    }

    /**
     * for list sub course management
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function sub_course_management_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_sub_courses';
        $table2 = DB_PREFIX_SYSTEM . 'affiliate_courses';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnSubCourseList();
        $total_records = $this->affiliates_model->countOfSubCourseList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredSubCourseList($table1, $table2, $where);
        $res_data = $this->affiliates_model->getResultDataSubCourseList($table1, $table2, $where, $order, $limit);
        $count_affiliates = count($res_data);
        for ($i = 0; $i < $count_affiliates; $i++) {
            if ($res_data[$i][6]) {
                $res_data[$i][6] = '<a href="javascript:edit_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a>';
            } else {
                $res_data[$i][6] = '<a href="javascript:edit_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activate_course(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a>';
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
     * for affiliate schedule
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function affiliates_shedules() {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->setData('count_all', $this->affiliates_model->countOfAffiliatesShedulesPendingList());
        $this->setData('count_active', $this->affiliates_model->countOfAffiliatesShedulesActiveList());
        $this->setData('count_completed', $this->affiliates_model->countOfAffiliatesShedulesCompletedList());
        $this->setData('title', lang('menu_name_136'));
        $this->loadView();
    }

    /**
     * for list the pending schedules
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function affiliates_shedules_pending_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_shedules';
        $table2 = DB_PREFIX_SYSTEM . 'affiliate_enquiry';
        $table3 = DB_PREFIX_SYSTEM . 'affiliates';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesShedulesPendingList();
        $total_records = $this->affiliates_model->countOfAffiliatesShedulesPendingList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesShedulesPendingList($table1, $table2, $table3, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesShedulesPendingList($table1, $table2, $table3, $where, $order, $limit);
        $count_enquiry = count($res_data);
        for ($i = 0; $i < $count_enquiry; $i++) {
            if ($res_data[$i][3]) {
                $res_data[$i][3] = $this->affiliates_model->getCourseIdToName($res_data[$i][3]);
            }
            if ($res_data[$i][4]) {
                $res_data[$i][4] = $this->affiliates_model->getSubCourseIdToName($res_data[$i][4]);
            }
            $res_data[$i][5] = round($res_data[$i][7], 8);
            $res_data[$i][5] = $this->helper_model->currency_conversion($res_data[$i][7]);
            $res_data[$i][7] = '<a href="javascript:view_enquiry_details(' . $res_data[$i][10] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:resend_mail(' . $res_data[$i][10] . ')" class="btn btn-xs btn-orange tooltips" data-placement="top" title="' . lang('resend_mail') . '"><i class="fa fa-refresh fa-spin"></i></a>';
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][6] = $res_data[$i][11] . ' ' . $res_data[$i][12] . '<br>' . $res_data[$i][13] . '<br>' . $res_data[$i][14];
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
     * For Listing the active schedules
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function affiliates_shedules_active_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_shedules';
        $table2 = DB_PREFIX_SYSTEM . 'affiliate_enquiry';
        $table3 = DB_PREFIX_SYSTEM . 'affiliates';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesShedulesActiveList();
        $total_records = $this->affiliates_model->countOfAffiliatesShedulesActiveList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesShedulesActiveList($table1, $table2, $table3, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesShedulesActiveList($table1, $table2, $table3, $where, $order, $limit);
        $count_enquiry = count($res_data);
        for ($i = 0; $i < $count_enquiry; $i++) {
            if ($res_data[$i][3]) {
                $res_data[$i][3] = $this->affiliates_model->getCourseIdToName($res_data[$i][3]);
            }
            if ($res_data[$i][4]) {
                $res_data[$i][4] = $this->affiliates_model->getSubCourseIdToName($res_data[$i][4]);
            }
            $res_data[$i][7] = round($res_data[$i][7], 8);
            $res_data[$i][7] = $this->helper_model->currency_conversion($res_data[$i][7]);
            $res_data[$i][9] = '<a href="javascript:view_enquiry_details(' . $res_data[$i][10] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:complete_shedule(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('complete') . '"><i class="glyphicon glyphicon-ok-sign"></i></a>';
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][8] = $res_data[$i][11] . ' ' . $res_data[$i][12] . '<br>' . $res_data[$i][13] . '<br>' . $res_data[$i][14];
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
     * for Listing the completed schedules list
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function affiliates_shedules_completed_list() {
        $user_id = $this->aauth->getId();
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'affiliate_shedules';
        $table2 = DB_PREFIX_SYSTEM . 'affiliate_enquiry';
        $table3 = DB_PREFIX_SYSTEM . 'affiliates';
        $limit = $order = $where = '';

        $column = $this->affiliates_model->getTableColumnAffiliatesShedulesCompletedList();
        $total_records = $this->affiliates_model->countOfAffiliatesShedulesCompletedList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->affiliates_model->getTotalFilteredAffiliatesShedulesCompletedList($table1, $table2, $table3, $where);
        $res_data = $this->affiliates_model->getResultDataAffiliatesShedulesCompletedList($table1, $table2, $table3, $where, $order, $limit);
        $count_enquiry = count($res_data);
        for ($i = 0; $i < $count_enquiry; $i++) {
            if ($res_data[$i][3]) {
                $res_data[$i][3] = $this->affiliates_model->getCourseIdToName($res_data[$i][3]);
            }
            if ($res_data[$i][4]) {
                $res_data[$i][4] = $this->affiliates_model->getSubCourseIdToName($res_data[$i][4]);
            }
            $res_data[$i][7] = round($res_data[$i][7], 8);
            $res_data[$i][7] = $this->helper_model->currency_conversion($res_data[$i][7]);
            $res_data[$i][9] = '<a href="javascript:view_enquiry_details(' . $res_data[$i][10] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a>';
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][8] = $res_data[$i][11] . ' ' . $res_data[$i][12] . '<br>' . $res_data[$i][13] . '<br>' . $res_data[$i][14];
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
     * For resend the enquiry mail
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function resend_enquiry_mail() {
        if ($this->input->get('enq_id')) {
            $enq_id = $this->input->get('enq_id');
            $shdl_id = $this->affiliates_model->getSheduleID($enq_id);
            $res = $this->affiliates_model->sendEnquiryMail($enq_id, $shdl_id);
            if ($res) {
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * for complete the schedule
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function complete_shedule($action = '', $shd_id = '') {
        if ($action == 'complete' && $shd_id) {
            $res = $this->affiliates_model->completeSheduleStatus($shd_id);
            if ($res) {
                $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                $data = array('action' => $action, 'shd_id' => $shd_id);
                $this->helper_model->insertActivity($user_id, 'shedules_completed', $data);
                $this->loadPage(lang('shedules_completed_successfully'), 'affiliate-shedules');
            } else {
                $this->loadPage(lang('failed_to_complete'), 'affiliate-shedules', 'danger');
            }
        }
        $this->loadPage(lang('invalid_operation'), 'affiliate-shedules', 'danger');
    }

    /**
     * for change the affiliate password
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function change_affiliate_password() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        if ($this->input->post('reset_pass') && $this->validate_reset_password()) {
            $this->load->helper('security');
            $data = $this->security->xss_clean($this->input->post());

            $result = $this->affiliates_model->updateAffiliatesPassword($data);
            if ($result) {
                $this->helper_model->insertActivity($user_id, 'affiliate_password_changed', $data);
                $this->loadPage(lang('affiliate_password_changed_successfully'), 'change-affiliate-password');
            } else {
                $this->loadPage(lang('failed_to_reset_password'), 'change-affiliate-password', 'danger');
            }
        }

        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_148'));
        $this->loadView();
    }

    /**
     * for validate the reset the password
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function validate_reset_password() {
        $this->form_validation->set_rules('affiliate_username', lang('username'), 'trim|required|callback_username_exits');
        $this->form_validation->set_rules('affiliate_password', lang('affiliate_password'), 'trim|required');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|matches[affiliate_password]');
        $result = $this->form_validation->run();

        return $result;
    }

    /**
     * for checking the username exits
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function username_exits($user_name = '') {
        if ($user_name) {
            $flag = FALSE;
            $result = $this->affiliates_model->checkIsUserNameExistsOrNot($user_name);
            if ($result) {
                $flag = TRUE;
            } else {
                $this->form_validation->set_message('username_exits', lang('user_name_doest_exits'));
            }
            return $flag;
        } elseif ($this->input->post('username')) {
            $res = $this->affiliates_model->checkIsUserNameExistsOrNot($this->input->post('username'));
            if ($res) {
                echo 'yes';
                exit();
            } else {
                echo 'no';
                exit();
            }
        }
    }

    /**
     * for getting the affiliate username
     * @author Techffodils Technologies LLP
     * @date 2018-02-4
     */
    function get_affiliate_usernames() {
        $this->load->helper('security');
        $data = $this->security->xss_clean($this->input->post());
        $details = $this->affiliates_model->getAllActiveAffiliateList($data['query']);
        echo $details;
        exit();
    }

}
