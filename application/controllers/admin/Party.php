<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Base_Controller.php';

/**
 * For Party plan realted Controller
 * For example create party,edit party,delete party etc..
 * @author Techffodils Technologis LLP
 * @date 2018-1-4
 */
class Party extends Base_Controller {

    /**
     * For create the party load create party form too 
     * also some option to be done under the functions like edit and delete ,update
     * 
     * @author Techffodils Technologis LLP
     * @date 2018-1-4
     * @param type $action
     * @param type $party_id
     */
    function create_party($action = '', $party_id = '') {
        $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $edit_flag = 0;
        $post = array();
        if ($this->input->post('create') && $this->validate_party()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $config['upload_path'] = FCPATH . 'assets/images/party/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'party_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $post['document'] = 'party.png';
            if ($this->upload->do_upload('party_image')) {
                $upload_data = $this->upload->data();
                $post['document'] = $upload_data['file_name'];
                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($upload_data['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $upload_data['full_path'],
                            'maintain_ratio' => TRUE,
                            'width' => 500,
                            'height' => 500,
                        );
                        $this->image_lib->initialize($configer);
                        if (!$this->image_lib->resize()) {
                            $error['reason'] = $this->image_lib->display_errors();
                            $this->helper_model->insertFailedActivity($log_user, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }
            $status = 1;
            $res = $this->party_model->createParty($log_user, $post, $status);
            if ($res) {
                $this->helper_model->insertActivity($log_user, 'party_created', $post);
                $this->session->unset_userdata('party_post');
                $this->loadPage(lang('party_created'), 'party-plan');
            }
            $this->loadPage(lang('party_creation_failed'), 'party-plan', 'danger');
        }
        if ($this->session->userdata('party_post') != null)
            $post = $this->session->userdata('party_post');

        if ($this->input->post('update_party') && $this->validate_party()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $config['upload_path'] = FCPATH . 'assets/images/party/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'party_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $post['document'] = '';
            if ($this->upload->do_upload('party_image')) {
                $upload_data = $this->upload->data();
                $post['document'] = $upload_data['file_name'];
                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($upload_data['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $upload_data['full_path'],
                            'maintain_ratio' => TRUE,
                            'width' => 500,
                            'height' => 500,
                        );
                        $this->image_lib->initialize($configer);
                        if (!$this->image_lib->resize()) {
                            $error['reason'] = $this->image_lib->display_errors();
                            $this->helper_model->insertFailedActivity($log_user, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }
            $status = 1;
            $res = $this->party_model->updateParty($post['update_party'], $post);
            if ($res) {
                $this->helper_model->insertActivity($log_user, 'party_updated', $post);
                $this->session->unset_userdata('party_post');
                $this->loadPage(lang('party_updated'), 'party-plan');
            }
            $this->loadPage(lang('party_updation_failed'), 'party-plan', 'danger');
        }

        if ($action && $party_id) {
            $activity['action'] = $action;
            $activity['party_id'] = $party_id;
            if ($action == 'edit') {
                $edit_flag = 1;
                $post = $this->party_model->getAllParty('', $party_id);
            } elseif ($action == 'activate') {
                $res = $this->party_model->changePartyStatus($party_id, 1, 1);
                if ($res) {
                    $this->helper_model->insertActivity($log_user, 'party_activated', $activity);
                    $this->loadPage(lang('party_activated'), 'party-plan');
                }
                $this->loadPage(lang('party_activation_failed'), 'party-plan', 'danger');
            } elseif ($action == 'inactivate') {
                $res = $this->party_model->changePartyStatus($party_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($log_user, 'party_inactivated', $activity);
                    $this->loadPage(lang('party_inactivated'), 'party-plan');
                }
                $this->loadPage(lang('party_inactivation_failed'), 'party-plan', 'danger');
            } elseif ($action == 'delete') {
                $res = $this->party_model->deleteParty($party_id);
                if ($res) {
                    $this->helper_model->insertActivity($log_user, 'party_deleted', $activity);
                    $this->loadPage(lang('party_deleted'), 'party-plan');
                }
                $this->loadPage(lang('party_deletion_failed'), 'party-plan', 'danger');
            } else {
                $this->loadPage(lang('invalid_action'), 'party-plan', 'danger');
            }
        }
        $country = '';
        if (isset($post['country_id'])) {
            $country = $post['country_id'];
        }
        $countries = $this->helper_model->getAllCountries();
        $states = $this->helper_model->getAllStates($country);

        $this->setData('party_id', $party_id);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('post_data', $post);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('countries', $countries);
        $this->setData('states', $states);
        $this->setData('title', lang('menu_name_87'));
        $this->loadView();
    }

    /**
     * 
     * @return typeFor validate the party form
     * @author Techffodils Technologis LLP
     * @date 2018-1-4
     */
    function validate_party() {
        $this->session->set_userdata('party_post', $this->input->post());

        $this->form_validation->set_rules('name', lang('party_name'), 'required');
        $this->form_validation->set_rules('host_username', lang('host_username'), 'required|callback_validate_username');
        $this->form_validation->set_rules('start_date', lang('start_date'), 'required|callback_greater_than_today');
        $this->form_validation->set_rules('end_date', lang('end_date'), 'required|callback_greater_start_date');
        $this->form_validation->set_rules('address_type', lang('address_type'), 'required');

        if ($this->input->post('address_type') == "new") {
            $this->form_validation->set_rules('address', lang('address'), 'required');
            $this->form_validation->set_rules('country_id', lang('country_id'), 'required');
            $this->form_validation->set_rules('phone', lang('phone'), 'required');
            $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
        }

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For checking the entered valid or existing one 
     * @author Techffodils Technologis LLP
     * @date 2018-1-4
     * @param type $username
     * @return boolean
     */
    function validate_username($username = '') {
        if ($username != '') {
            $flag = false;
            if ($this->helper_model->userNameToID($username)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('username')) {
            if ($this->helper_model->userNameToID($this->input->get('username'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For checking  the party date > today
     * @author Techffodils Technologis LLP
     * @date 2018-1-4
     * @param type $start_date
     * @return boolean
     */
    function greater_than_today($start_date = '') {
        if ($start_date != '') {
            $flag = false;
            if ($start_date > date("Y-m-d H:i:s")) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('start_date')) {
            if ($this->input->get('start_date') > $start_date) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /** For checking  the party date > start date
     * @author Techffodils Technologis LLP
     * @date 2018-1-4
     * @param type $start_date
     * @return boolean
     */
    function greater_start_date($date1 = '') {
        $date2 = $this->input->post('start_date');
        $flag = false;
        if ($date1 && $date2) {
            if ($date1 > $date2) {
                $flag = true;
            }
        }
        return $flag;
    }

    /**
     * For manage the party events add, edit,delete,update
     * @author Techffodils Technologis LLP
     * @date 2018-1-4
     * @param type $tab
     * @param type $action
     * @param type $action_id
     */
    function party_management($tab = '', $action = '', $action_id = '') {
        $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $management_id = 0;
        if ($this->party_model->validateParty($this->session->userdata('management_id')))
            $management_id = $this->session->userdata('management_id');

        if ($this->input->post('manage_party') && $this->validate_party_management()) {
            $party_code = $this->input->post('party_code');
            $val = $this->party_model->validatePartyCode($party_code);
            if ($val) {
                //$this->session->set_userdata('party_code', $management_id);
                $this->session->set_userdata('management_id', $val);
                $management_id = $val;
            } else {
                $this->loadPage(lang('invalid_party_code'), 'party-manage', 'danger');
            }
        }

        if ($this->input->post('add_prod') && $this->validate_add_product()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $product_id = $this->party_model->getProIdFromCode($post['product_code']);
            if (!$this->party_model->checkProductInParty($management_id, $product_id)) {
                $post['product_id'] = $product_id;
                $post['management_id'] = $management_id;
                $status = 1;
                $res = $this->party_model->addProdToParty($log_user, $management_id, $post, $status);
                if ($res) {
                    $this->helper_model->insertActivity($log_user, 'product_added_to_party', $post);
                    $this->loadPage(lang('product_added'), 'party-manage');
                }
                $this->loadPage(lang('failed_to_add_product'), 'party-manage', 'danger');
            }
            $this->loadPage(lang('product_already_in_this_party'), 'party-manage', 'danger');
        }

        if ($this->input->post('add_user') && $this->validate_add_user()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $post['management_id'] = $management_id;
            $status = 1;
            $new_user = $this->helper_model->userNameToID($post['username']);
            if (!$this->party_model->checkUserInParty($management_id, $new_user)) {
                $res = $this->party_model->addUserToParty($log_user, $management_id, $new_user, $status);
                if ($res) {
                    $this->helper_model->insertActivity($log_user, 'user_added_to_party', $post);
                    $this->loadPage(lang('user_added'), 'party-manage');
                }
                $this->loadPage(lang('failed_to_add_user'), 'party-manage', 'danger');
            }
            $this->loadPage(lang('user_already_in_this_party'), 'party-manage', 'danger');
        }

        if ($tab && $action && $action_id) {
            $activity['action'] = $action;
            $activity['action_id'] = $action_id;
            if ($tab == 'product') {
                $this->session->set_userdata('management_tab', 1);
                if ($action == 'activate') {
                    $res = $this->party_model->changePartyProductStatus($action_id, 1);
                    if ($res) {
                        $this->helper_model->insertActivity($log_user, 'party_prod_activated', $activity);

                        $this->loadPage(lang('product_activated'), 'party-manage');
                    }
                    $this->loadPage(lang('failed_to_activate_product'), 'party-manage', 'danger');
                } elseif ($action == 'inactivate') {
                    $res = $this->party_model->changePartyProductStatus($action_id, 0);
                    if ($res) {
                        $this->helper_model->insertActivity($log_user, 'party_prod_inactivated', $activity);
                        $this->loadPage(lang('product_inactivated'), 'party-manage');
                    }
                    $this->loadPage(lang('failed_to_inactivate_product'), 'party-manage', 'danger');
                } elseif ($action == 'delete') {
                    $res = $this->party_model->deletePartyProduct($action_id);
                    if ($res) {
                        $this->helper_model->insertActivity($log_user, 'party_prod_deleted', $activity);
                        $this->loadPage(lang('product_deleted'), 'party-manage');
                    }
                    $this->loadPage(lang('failed_to_product_deleted'), 'party-manage', 'danger');
                } else {
                    $this->loadPage(lang('invalid_action'), 'party-manage', 'danger');
                }
            } elseif ($tab == 'user') {
                $this->session->set_userdata('management_tab', 2);
                if ($action == 'activate') {
                    $res = $this->party_model->changePartyUserStatus($action_id, 1);
                    if ($res) {
                        $this->helper_model->insertActivity($log_user, 'party_user_activated', $activity);
                        $this->loadPage(lang('user_activated'), 'party-manage');
                    }
                    $this->loadPage(lang('failed_to_activate_user'), 'party-manage', 'danger');
                } elseif ($action == 'inactivate') {
                    $res = $this->party_model->changePartyUserStatus($action_id, 0);
                    if ($res) {
                        $this->helper_model->insertActivity($log_user, 'party_user_inactivated', $activity);
                        $this->loadPage(lang('user_inactivated'), 'party-manage');
                    }
                    $this->loadPage(lang('failed_to_inactivate_user'), 'party-manage', 'danger');
                } elseif ($action == 'delete') {
                    $res = $this->party_model->deletePartyUser($action_id);
                    if ($res) {
                        $this->helper_model->insertActivity($log_user, 'party_user_deleted', $activity);
                        $this->loadPage(lang('user_deleted'), 'party-manage');
                    }
                    $this->loadPage(lang('failed_to_user_deleted'), 'party-manage', 'danger');
                } else {
                    $this->loadPage(lang('invalid_action'), 'party-manage', 'danger');
                }
            }
        }


        $active_tab = '';
        if ($this->session->userdata('management_tab'))
            $active_tab = $this->session->userdata('management_tab');

        $tab1 = $tab2 = '';
        if ($active_tab == 2) {
            $tab2 = ' active';
        } else {
            $tab1 = ' active';
        }

        $party_code = $this->party_model->getPartyCode($management_id);
        //$products = $this->party_model->getAllPartyProducts($management_id);
        // $users = $this->party_model->getAllPartyUsers($management_id);

        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('party_code', $party_code);
        // $this->setData('products', $products);
        // $this->setData('users', $users);
        $this->setData('management_id', $management_id);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_88'));
        $this->loadView();
    }

    /**
     * For validate the party management form
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     * @return type
     */
    function validate_party_management() {
        $this->form_validation->set_rules('party_code', lang('party_code'), 'required|callback_validate_party_code');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();

        return $validation;
    }

    /**
     * For validate the product added for the party
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     * @return type
     */
    function validate_add_product() {
        $this->session->set_userdata('management_tab', 1);
        $this->form_validation->set_rules('product_code', lang('product_code'), 'required|callback_validate_prod_code');
        $this->form_validation->set_rules('request_amount', lang('request_amount'), 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();

        return $validation;
    }

    /**
     * For validate the entered product code for adding product for party created
      @author Techffodils Technologies LLP
     * @date 2018-01-4
     * @param type $pro_code
     * @return boolean
     */
    function validate_prod_code($pro_code = '') {
        if ($pro_code != '') {
            $flag = false;
            if ($this->party_model->checkProductCode($pro_code)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('pro_code')) {
            if ($this->party_model->checkProductCode($this->input->get('pro_code'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For validate the party code
      @author Techffodils Technologies LLP
     * @date 2018-01-4
     * @param type $code
     * @return boolean
     */
    function validate_party_code($code = '') {
        if ($code != '') {
            $flag = false;
            if ($this->party_model->checkPartyCode($code)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('code')) {
            if ($this->party_model->checkPartyCode($this->input->get('code'))) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For validate the party added user
     * @author Techffodils Technologies LLP
     * @date 2018-01-4 
     * @return type
     */
    function validate_add_user() {
        $this->session->set_userdata('management_tab', 2);
        $this->form_validation->set_rules('username', lang('username'), 'required|callback_validate_username');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();

        return $validation;
    }

    /**
     * For load the view for party invites users
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function party_invite() {
        $this->setData('title', lang('menu_name_89'));
        $this->loadView();
    }

    /**
     * For get the product code 
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function get_product_codes() {
        $query = $this->input->post('query');
        $result = $this->party_model->getAllProductCodes($query);
        echo $result;
        exit();
    }

    /**
     * For getting the product amount
      @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function get_product_amount() {
        $code = $this->input->get('code');
        $result = $this->party_model->getProductAmountFromCode($code);
        echo $result;
        exit();
    }

    /**
     * For getting the party code
      @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function get_party_codes() {
        $query = $this->input->post('query');
        $result = $this->party_model->getAllPartyCodes($query);
        echo $result;
        exit();
    }

    /**
     * For list out the created party list
      @author Techffodils Technologies LLP
     * @date 2018-01-4 
     */
    function party_create_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'party';
        $limit = $order = $where = '';
        $column = $this->party_model->getTableColumnCreateParty();
        $total_records = $this->party_model->countOfCreateParty();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->party_model->getTotalFilteredCreateParty($table1, $table2, $where);
        $res_data = $this->party_model->getResultDataCreateParty($table1, $table2, $where, $order, $limit);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $dt = new DateTime($res_data[$i][5]);
            $res_data[$i][5] = $dt->format('Y-m-d');
            $dt = new DateTime($res_data[$i][6]);
            $res_data[$i][6] = $dt->format('Y-m-d');
            $res_data[$i][2] = '<img src="assets/images/party/' . $res_data[$i][2] . '" alt="Party" height="42" width="42">';
            if ($res_data[$i][7]) {
                $res_data[$i][7] = '<a target="_BLANK" href="cart/index/' . $res_data[$i][1] . '" class="btn btn-xs btn-grey tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-eye fa fa-white"></i></a> <a href="javascript:inactivate_party(' . $res_data[$i][0] . ',' . "'admin'" . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_party(' . $res_data[$i][0] . ',' . "'admin'" . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a> <a href="javascript:edit_party(' . $res_data[$i][0] . ',' . "'admin'" . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            } else {
                $res_data[$i][7] = '<a href="javascript:activate_party(' . $res_data[$i][0] . ',' . "'admin'" . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_party(' . $res_data[$i][0] . ',' . "'admin'" . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a> <a href="javascript:edit_party(' . $res_data[$i][0] . ',' . "'admin'" . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
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
     * For listed out the party invites users list
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function party_invites_list() {
        $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'party_users';
        $table2 = DB_PREFIX_SYSTEM . 'party';
        $limit = $order = $where = '';
        $column = $this->party_model->getTableColumnInvitesParty();
        $total_records = $this->party_model->countOfInvitesParty($log_user);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->party_model->getTotalFilteredInvitesParty($table1, $table2, $where, $log_user);
        $res_data = $this->party_model->getResultDataInvitesParty($table1, $table2, $where, $order, $limit, $log_user);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][3] = $this->helper_model->IdToUserName($res_data[$i][3]);
            $res_data[$i][6] = $this->helper_model->getCountryName($res_data[$i][6]);
            $res_data[$i][7] = $this->helper_model->getStateName($res_data[$i][7]);
            $res_data[$i][5] = '<span class="text-bold">' . lang('address') . '</span> :- ' . $res_data[$i][5] . ' <br><span class="text-bold">' . lang('country') . '</span> :- ' . $res_data[$i][6] . ' <br><span class="text-bold">' . lang('state') . '</span> :- ' . $res_data[$i][7] . ' <br><span class="text-bold">' . lang('city') . '</span> :- ' . $res_data[$i][8] . ' <br><span class="text-bold">' . lang('zip_code') . '</span> :- ' . $res_data[$i][9] . ' <br><span class="text-bold">' . lang('phone') . '</span> :- ' . $res_data[$i][10] . ' <br><span class="text-bold">' . lang('email') . '</span> :- ' . $res_data[$i][11] . ' <br>';
            $res_data[$i][1] = '<img src="assets/images/party/' . $res_data[$i][1] . '" alt="Party" height="50" width="50"> </td>';
            $res_data[$i][6] = '<a target="_BLANK" href="cart/index/' . $res_data[$i][2] . '" class="btn btn-xs btn-grey tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-eye fa fa-white"></i></a>';
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
     * For listed out party users list
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function party_users_list() {
        $party_code = $this->session->userdata('management_id');
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user';
        $table2 = DB_PREFIX_SYSTEM . 'party_users';
        $limit = $order = $where = '';
        $column = $this->party_model->getTableColumnUsersParty();
        $total_records = $this->party_model->countOfUsersParty($party_code);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->party_model->getTotalFilteredUsersParty($table1, $table2, $where, $party_code);
        $res_data = $this->party_model->getResultDataUsersParty($table1, $table2, $where, $order, $limit, $party_code);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {

            $res_data[$i][1] = $this->party_model->getPartyCode($party_code);
            if ($res_data[$i][4]) {
                $res_data[$i][4] = lang('active');
                $res_data[$i][5] = '<a href="javascript:inactivate_user(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_user(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:activate_user(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_user(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][4] = lang('inactive');
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
     * For listed out the party added product lists
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function party_products_list() {
        $party_code = $this->session->userdata('management_id');
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'products';
        $table2 = DB_PREFIX_SYSTEM . 'party_products';
        $limit = $order = $where = '';
        $column = $this->party_model->getTableColumnProductsParty();
        $total_records = $this->party_model->countOfProductsParty($party_code);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->party_model->getTotalFilteredProductsParty($table1, $table2, $where, $party_code);
        $res_data = $this->party_model->getResultDataProductsParty($table1, $table2, $where, $order, $limit, $party_code);
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][1] = $this->party_model->getPartyCode($party_code);
            $res_data[$i][3] = round($res_data[$i][3], 8);
            $res_data[$i][4] = round($res_data[$i][4], 8);
            $res_data[$i][3] = $this->helper_model->currency_conversion($res_data[$i][3]);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            if ($res_data[$i][5]) {

                $res_data[$i][5] = lang('active');
                $res_data[$i][6] = '<a href="javascript:inactivate_product(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_product(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][6] = '<a href="javascript:activate_product(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_product(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][4] = lang('inactive');
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
