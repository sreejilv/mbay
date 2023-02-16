<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'Base_Controller.php';

class Employee extends Base_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * 
     * For Employee Enroll
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     */
    function employee_register() {
        $logged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $employee_reg_data = [];
        $this->setData('employee_status', $this->dbvars->EMPLOYEE_NAME_GENERATION_STATUS);
        if ($this->dbvars->EMPLOYEE_NAME_GENERATION_STATUS == 1) {
            $employee_prefix = 'EMP';
            $employee_last_id = $this->employee_model->getLastNumber();
            $employee_name = $employee_prefix . '0000' . $employee_last_id;
        } elseif ($this->dbvars->EMPLOYEE_NAME_GENERATION_STATUS == 0) {
            $employee_name = '';
        }

        if ($this->input->post() && $this->validate_employee_enroll()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            $post_arr['photo'] = 'no_user.jpg';
            if ($_FILES['user_photo']['error'] == 0) {
                $config['upload_path'] = FCPATH . 'assets/images/employees/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $new_name = 'emp_' . time();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('user_photo')) {
                    $uploadData = $this->upload->data();
                    $post_arr['photo'] = $uploadData['file_name'];
                    if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                        if (isset($uploadData['full_path'])) {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $uploadData['full_path'],
                                'maintain_ratio' => TRUE,
                                'width' => 500,
                                'height' => 500,
                            );
                            $this->image_lib->initialize($configer);
                            if (!$this->image_lib->resize()) {
                                $error['reason'] = $this->image_lib->display_errors();
                                $this->helper_model->insertFailedActivity($logged_user_id, 'resize_fail', $error);
                            }
                            $this->image_lib->clear();
                        }
                    }
                }
            }

            $post_arr['user_id'] = $logged_user_id;
            $result = $this->employee_model->enrollEmployee($post_arr);

            if ($result) {
                $this->session->unset_userdata('employee_reg');
                $this->loadPage(lang('employee_enroll_successfully'), 'employee-enroll');
            } else {
                $this->loadPage(lang('error_while_enroll_emplyee'), 'employee-enroll', 'danger');
            }
        } else {
            $this->setData('error', $this->form_validation->error_array());
        }


        if ($this->session->userdata('employee_reg') == NULL)
            $employee_reg_data = $this->session->userdata('emploree_reg');

        $country = '';
        if (isset($employee_reg_data['country'])) {
            $country = $employee_reg_data['country'];
        }

        $countries = $this->helper_model->getAllCountries();
        $states = $this->helper_model->getAllStates($country);

        $title = lang('employee_enroll');

        $this->setData('page_header', $title);
        $this->setData('countries', $countries);
        $this->setData('states', $states);
        $this->setData('register', $employee_reg_data);
        $this->setData('employee_name', $employee_name);
        $this->setData('title', lang('menu_name_50'));
        $this->loadView();
    }

    /**
     * For Validat Enroll Employeee
     * @author Techffodils Technologies LLP
     * @date 2017-12-01
     * @return type
     */
    function validate_employee_enroll() {
        $this->load->helper('security');
        $post_arr = $this->security->xss_clean($this->input->post());
        $this->session->set_userdata('employee_reg', $post_arr);

        $this->form_validation->set_rules('user_name', lang('user_name'), 'trim|required|callback_username_exits|alpha_numeric');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|min_length[2]');
        $this->form_validation->set_rules('password_again', lang('password_again'), 'trim|required|matches[password]');
        $this->form_validation->set_rules('firstname', lang('first_name'), 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('lastname', lang('last_name'), 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('address', lang('address'), 'trim|required');
        $this->form_validation->set_rules('phone', lang('phone'), 'trim|required|numeric');
        $this->form_validation->set_rules('gender', lang('gender'), 'trim|required');
        $this->form_validation->set_rules('month', lang('month'), 'trim|required');
        $this->form_validation->set_rules('day', lang('day'), 'trim|required');
        $this->form_validation->set_rules('year', lang('year'), 'trim|required');
        $this->form_validation->set_rules('country', lang('country'), 'trim|required');
        $this->form_validation->set_rules('zipcode', lang('zipcode'), 'trim|required');
        $validation_result = $this->form_validation->run();

        return $validation_result;
    }

    /**
     *    Method is used to validate strings to allow alpha
     *    numeric spaces underscores and dashes ONLY.
     *    @param $str    String    The item to be validated.
     *    @author Techffodils Technologies LLP
     *    @return BOOLEAN   True if passed validation false if otherwise.
     */
    function _alpha_dash_space($str_in = '') {
        if (!preg_match("/^([A-Za-z0-9 ])+$/i", $str_in)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 
     * 
     * Method for  Validate UserName exists or not
     * Return True if passed validation false if otherwise
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     */
    function username_exits($user_name = '') {
        if ($user_name != '') {
            $flag = FALSE;
            $result = $this->employee_model->checkIsUserNameExistsOrNot($user_name);

            if (!$result) {
                $flag = TRUE;
            } else {
                $this->form_validation->set_message('username_exits', lang('user_name_doest_exits'));
            }
            return $flag;
        } elseif ($this->input->post('username')) {
            $res = $this->employee_model->checkIsUserNameExistsOrNot($this->input->post('username'));
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
     * Method For check given employee username exists or not
     * @param ajax post user_name
     * @return boolean
     * @author Techffodils Technologies LLP
     */
    function check_username_exits() {
        $user_name = $this->input->post('user_name');
        $res = $this->employee_model->checkIsUserNameExistsOrNot($user_name);
        if (!$res) {
            $this->form_validation->set_message('check_username_exits', lang('user_name_doest_exits'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 
     * 
     * For Edit Employee Form Option 
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     * 
     */
    function edit_form($id) {
        $title = lang('edit_employee_form');
        $edit_single_data = $this->employee_model->getSelectedUserData($id);
        $countries = $this->helper_model->getAllCountries($edit_single_data['country']);
        $states = $this->helper_model->getAllStates($edit_single_data['country']);
        if ($this->input->post() && $this->update_form_validation()) {
            $this->load->helper('security');
            $post_arr = $this->security->xss_clean($this->input->post());

            $post_arr['id'] = $id;
            $post_arr['user_id'] = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($_FILES['user_photo']['error'] == 0) {
                $config['upload_path'] = FCPATH . 'assets/images/employees';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $new_name = 'emp_' . time();
                $config['file_name'] = $new_name;
                $this->removePreviousUploadedFile($id, $edit_single_data['user_photo']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('user_photo')) {
                    $uploadData = $this->upload->data();
                    $post_arr['photo'] = $uploadData['file_name'];
                    if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                        if (isset($uploadData['full_path'])) {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $uploadData['full_path'],
                                'maintain_ratio' => TRUE,
                                'width' => 500,
                                'height' => 500,
                            );
                            $this->image_lib->initialize($configer);
                            if (!$this->image_lib->resize()) {
                                $error['reason'] = $this->image_lib->display_errors();
                                $this->helper_model->insertFailedActivity($post_arr['user_id'], 'resize_fail', $error);
                            }
                            $this->image_lib->clear();
                        }
                    }
                } else {
                    $post_arr['photo'] = '';
                }
            } else {
                $post_arr['photo'] = $edit_single_data['user_photo'];
            }

            $result = $this->employee_model->updateEmployeeDetails($post_arr);
            if ($result) {
                $msg = lang('successfully_update_employee_details');
                $this->loadPage($msg, 'view-all-employee');
            } else {
                $msg = lang('error_while_update_employee_deials');
                $this->loadPage($msg, 'employee-update/' . $id);
            }
        } else {
            $this->setData('error', $this->form_validation->error_array());
        }
        $this->setData('edit_details', $edit_single_data);
        $this->setData('countries', $countries);
        $this->setData('states', $states);
        $this->setData('title', $title);
        $this->loadView();
    }

    /**
     * 
     * For Delete Option 
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     */
    function delete_form($id) {

        $result = $this->employee_model->deleteEmployee($id);
        if ($result) {
            $msg = lang('employee_deleted_successfully');
            $this->loadPage($msg, 'view-all-employee');
        } else {
            $msg = lang('error_while_delete_an_employee');
            $this->loadPage($msg, 'view-all-employee', false);
        }
    }

    /**
     * For activate Employee
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     * 
     * 
     */
    function activate_employee($activate_id) {

        $result = $this->employee_model->editEmployee($activate_id, 1);
        if ($result) {
            $msg = lang('employee_activated_successfully');
            $this->loadPage($msg, 'view-all-employee');
        } else {
            $msg = lang('error_while_activate_an_employee');
            $this->loadPage($msg, 'view-all-employee', false);
        }
    }

    /**
     * For activate Employee
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     * 
     * 
     */
    function inactivate_employee($inactivate_id) {

        $result = $this->employee_model->editEmployee($inactivate_id, 2);
        if ($result) {
            $msg = lang('employee_inactivated_successfully');
            $this->loadPage($msg, 'view-all-employee');
        } else {
            $msg = lang('error_while_activate_an_employee');
            $this->loadPage($msg, 'view-all-employee', false);
        }
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @date 2017-10-23
     * for form validation for update
     * @return type
     */
    function update_form_validation() {
        $this->form_validation->set_rules('firstname', lang('first_name'), 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('lastname', lang('last_name'), 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('address', lang('address'), 'trim|required');
        $this->form_validation->set_rules('phone', lang('phone'), 'trim|required|numeric');
        $this->form_validation->set_rules('gender', lang('gender'), 'trim|required');
        $this->form_validation->set_rules('month', lang('month'), 'trim|required');
        $this->form_validation->set_rules('day', lang('day'), 'trim|required');
        $this->form_validation->set_rules('year', lang('year'), 'trim|required');
        $this->form_validation->set_rules('country', lang('country'), 'trim|required');
        $this->form_validation->set_rules('zipcode', lang('zipcode'), 'trim|required');
        $validation_result = $this->form_validation->run();

        return $validation_result;
    }

    /**
     * 
     * For Set Employee Permission
     * 
     * @date 2017-10-23
     * 
     * @author Techffodils Technologies LLP
     * 
     */
    function menu_permission($emp_id = '') {
        $flag = false;
        $user_name = '';
        if ($emp_id) {
            $user_name = $this->employee_model->getEmployeeUsername($emp_id);
        }
        $employee_id = 0;
        if ($this->input->post() && $this->validate_employee()) {
            $user_name = $this->input->post('user_name');
            $employee_id = $this->employee_model->getEmployeeId($user_name);
            if ($employee_id) {
                $emp_id = $employee_id;
            } else {
                $msg = lang('employee_not_found');
                $this->loadPage($msg, 'employee-permission', 'danger');
            }
        }
        $employee_menu = array();
        if ($emp_id) {
            $flag = true;
            $allocate_menu = $this->employee_model->getAllEmployeeAllocatedMenus($emp_id);
            $employee_menu = $this->employee_model->getEmployeeMenus($allocate_menu);
        }

        $this->setData('user_name', $user_name);
        $this->setData('emp_id', $emp_id);
        $this->setData('employee_menu', $employee_menu);
        $this->setData('title', lang('menu_name_51'));
        $this->setData('page_header', lang('set_employee_permission'));
        $this->setData('flag', $flag);

        $this->loadView();
    }

    function change_employee_menu_permission() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        
        $employee_id = $post['employee_id'];
        $status = $post['status'];
        $menu_id = $post['menu_id'];
        if ($employee_id && $menu_id) {
            $res = $this->employee_model->updateAllocatedMenus($employee_id, $menu_id, $status);
            if ($res) {
                $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'change_employee_menu_permission', $post);
                echo 'yes';
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For Ajax request for validating Employee
     * @return type
     * @author Techffodils Technologies LLP
     * @date 2017-12-12
     */
    function validate_employee() {
        $this->form_validation->set_rules('user_name', lang('user_name'), 'required|callback_check_validate_employee');
        $form_result = $this->form_validation->run();

        return $form_result;
    }

    /**
     * Method is user for Validating Employee Ajax and Server side Checking
     * @param type $user_name
     * @return boolean True if return 
     * @author Techffodils Technologies LLP
     * @date 2017-12-12
     */
    function check_validate_employee($user_name) {

        if ($user_name != '') {
            $flag = false;
            if ($this->employee_model->checkIsUserNameExistsOrNot($user_name)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->post('username')) {
            $user_name = $this->input->post('username');
            $res = $this->employee_model->checkIsUserNameExistsOrNot($user_name);
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
     * Method used for Employees popup for typeahed
     * @author Techffodils Technologies LLP
     * @date 2017-12-1
     * @return List
     */
    function employee_username() {
        $string = $this->input->post('query');
        $details = $this->employee_model->getAllActiveEmployeeList($string);
        echo $details;
        exit();
    }

    /**
     * For Unlink the previously uploaded file 
     * @author Techffodils Technologies LLP Technologies
     * @date 2017-12-12
     * @day Friday
     * @param type $file_name
     */
    function removePreviousUploadedFile($id, $file_name) {
        if ($this->employee_model->checkImageUploadFirstTimeOrNot($id, $file_name)) {
            $folder = 'assets/images/employees/' . $file_name;
            if (is_file($folder)) {
                unlink($folder);
            }
        } else {
            return TRUE;
        }
    }

    /**
     * Manage uploadImage
     * @author Techffodils Technologies LLP
     * @date 2017-01-10
     * @return Response
     */
    public function resizeImage($filename) {
        $source_path = FCPATH . '/assets/images/employees/' . $filename;
        $target_path = FCPATH . '/assets/images/employees/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '_thumb',
            'width' => 50,
            'height' => 50
        );


        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            $this->setData('error', $this->image_lib->display_errors());
            return FALSE;
        }


        $this->image_lib->clear();
        return TRUE;
    }

    /**
     * For waterMark images
     * @date 2017-01-10
     * day  wednesday
     * @author Techffodils Technologies LLP
     * @param type $image_data
     * @return boolean
     */
    public function waterMarkImage($image_data) {
        $img = substr($image_data['full_path'], 51);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['wm_text'] = COMPANY_NAME;
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size'] = '50';
        $config['wm_font_color'] = '#707A7C';
        $config['wm_hor_alignment'] = 'center';
        $config['new_image'] = FCPATH . 'assets/images/employees/' . $img;

//send config array to image_lib's  initialize function
        $this->image_lib->initialize($config);
        $src = $config['new_image'];
        $data['watermark_image'] = substr($src, 2);
        $data['watermark_image'] = base_url() . $data['watermark_image'];
// Call watermark function in image library.
        $this->image_lib->watermark();
// Return new image contains above properties and also store in "upload" folder.
        return TRUE;
    }

    /**
     * For list all enrolled employees
     * @author Techffodils Technologies LLP
     * @date 2017-12-12
     */
    function employee_list() {
        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'employee_login';
        $table2 = DB_PREFIX_SYSTEM . 'employee_details';
        $limit = $order = $where = '';
        $column = $this->employee_model->getTableColumnEmployee();
        $total_records = $this->employee_model->countOfEmployee();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->employee_model->getTotalFilteredEmployee($table1, $table2, $where);
        $res_data = $this->employee_model->getResultDataEmployee($table1, $table2, $where, $order, $limit);

        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            if ($res_data[$i][7] == 1) {
                $res_data[$i][7] = '<a href="javascript:editEmployee(' . $res_data[$i][0] . ');" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivateEmployee(' . $res_data[$i][10] . ');" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times"></i></a> <a href="javascript:deleteEmployee(' . $res_data[$i][10] . ');" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('remove') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][7] = '<a href="javascript:editEmployee(' . $res_data[$i][0] . ');" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activateEmployee(' . $res_data[$i][10] . ');" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:deleteEmployee(' . $res_data[$i][10] . ');" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('remove') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            }

            $res_data[$i][3] = $res_data[$i][8] . " " . $res_data[$i][9];
            $res_data[$i][1] = '<a href="admin/employee-permission/' . $res_data[$i][0] . '" title="' . lang('set_employee_permission') . '"><i class="fa fa-user fa-fw"></i>' . $res_data[$i][1] . '</a>';
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][2] = '<center><img src="' . BASE_PATH . 'assets/images/employees/' . $res_data[$i][2] . ' " style="width:30px;height:30px; border-radius: 10px;"> </center>';
        }
        echo json_encode(array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $record_filtered,
            "data" => $res_data
        ));
        exit();
    }

    /*
     * For List All Employess
     * @author Techffodils Technologies LLP
     * @date 2018-02-01
     * 
     */

    function view_all_employee($id = '', $action = '') {
        $this->setData('title', lang('view_all_employee_list'));
        $get_all_details = $this->employee_model->getAllRegisteredEmployee();
        if ($action == 'edit') {
            $edit_single_data = $this->employee_model->getSelectedUserData($id);
            $countries = $this->helper_model->getAllCountries($edit_single_data['country']);
            $states = $this->helper_model->getAllStates($edit_single_data['country']);


            if ($this->input->post() && $this->update_form_validation()) {
                $this->load->helper('security');
                $post_arr = $this->security->xss_clean($this->input->post());
                $post_arr['id'] = $id;
                $post_arr['user_id'] = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
                if ($_FILES['user_photo']['error'] == 0) {
                    $config['upload_path'] = FCPATH . 'assets/images/employees';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $new_name = 'emp_' . time();
                    $config['file_name'] = $new_name;
                    $this->removePreviousUploadedFile($id, $edit_single_data['user_photo']);
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('user_photo')) {
                        $uploadData = $this->upload->data();
                        $post_arr['photo'] = $uploadData['file_name'];

                        if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                            if (isset($uploadData['full_path'])) {
                                $this->load->library('image_lib');
                                $configer = array(
                                    'image_library' => 'gd2',
                                    'source_image' => $uploadData['full_path'],
                                    'maintain_ratio' => TRUE,
                                    'width' => 500,
                                    'height' => 500,
                                );
                                $this->image_lib->initialize($configer);
                                if (!$this->image_lib->resize()) {
                                    $error['reason'] = $this->image_lib->display_errors();
                                    $this->helper_model->insertFailedActivity($post_arr['user_id'], 'resize_fail', $error);
                                }
                                $this->image_lib->clear();
                            }
                        }
                    } else {
                        $post_arr['photo'] = '';
                    }
                } else {
                    $post_arr['photo'] = $edit_single_data['user_photo'];
                }

                $result = $this->employee_model->updateEmployeeDetails($post_arr);
                if ($result) {
                    $msg = lang('successfully_update_employee_details');
                    $this->loadPage($msg, 'view-all-employee');
                } else {
                    $msg = lang('error_while_update_employee_deials');
                    $this->loadPage($msg, 'employee-update/' . $id);
                }
            } else {
                $this->setData('error', $this->form_validation->error_array());
            }
            $this->setData('edit_details', $edit_single_data);
            $this->setData('countries', $countries);
            $this->setData('states', $states);
        }

        $this->setData('details', $get_all_details);
        $this->setData('action', $action);
        $this->loadView();
    }

    /**
     * For Employee Password Change
     * @date 2018-02-2
     * @author Techffodils Technologies LLP
     * 
     */
    function change_employee_password() {
        $this->setData('title', lang('change_employee_password'));

        if ($this->input->post('btn_submit') && $this->form_validate_employee()) {
            $this->load->helper('security');
            $employee_data = $this->security->xss_clean($this->input->post());

            $employee_userid = $this->employee_model->getEmployeeId($employee_data['employee_username']);
            $result = $this->employee_model->updateEmployeePassword($employee_userid, $employee_data['employee_password']);

            if ($result) {
                $this->loadPage(lang('change_employee_password_successfully'), 'change-employee-password');
            } else {
                $this->loadPage(lang('error_change_employee_password_successfully'), 'change-employee-password', 'danger');
            }
        }
        $this->setData('page_header', lang('change_employee_password'));

        $this->loadView();
    }

    /**
     * For validate employee password
     * @date 2018-02-2
     * @author Techffodils Technologies LLP
     * 
     */
    function form_validate_employee() {
        $this->form_validation->set_rules('employee_username', lang('employee_username'), 'trim|required|callback_check_valid_employeename');
        $this->form_validation->set_rules('employee_password', lang('employee_password'), 'trim|required');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|matches[employee_password]');
        $result = $this->form_validation->run();

        return $result;
    }

    /**
     * For check valid employee name
     * @return boolean
     * @author Techffodils Technologies LLP
     * @date 2018-02-2
     */
    function check_valid_employeename() {
        $employee_name = $this->input->post('employee_username');
        $res = $this->employee_model->checkIsUserNameExistsOrNot($employee_name);
        if (!$res) {
            $this->form_validation->set_message('check_valid_employeename', lang('employee_user_name_doest_exits'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * For Employee status
     * @author Techffodils Technologies LLP
     * @date 2018-02-2
     */
    function change_employee_status() {
        $value = $this->input->post('value');
        $result = $this->employee_model->changeEmployeeStatus($value);
        if ($result) {
            echo "yes";
            exit();
        } else {
            echo "no";
            exit();
        }
    }

}
