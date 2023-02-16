<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Base_Controller.php';

class Migration extends Base_Controller {

    function index($action = '', $excel_id = '') {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($action && $excel_id) {
            $activity['action'] = $action;
            $activity['excel_id'] = $excel_id;
            if ($action == 'delete') {
                $res = $this->migration_model->deleteFile($excel_id);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'mig_file_delete', $activity);
                    $this->loadPage(lang('file_deleted'), 'migration');
                } else {
                    $this->loadPage('failed_to_delete', 'migration', 'danger');
                }
            } elseif ($action == 'activate') {
                $res = $this->migration_model->changeFileStatus($excel_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'mig_file_activate', $activity);
                    $this->loadPage(lang('file_activated'), 'migration');
                } else {
                    $this->loadPage(lang('failed_to_activated'), 'migration', 'danger');
                }
            } elseif ($action == 'inactivate') {
                $res = $this->migration_model->changeFileStatus($excel_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'mig_file_inactivate', $activity);
                    $this->loadPage(lang('file_inactivated'), 'migration');
                } else {
                    $this->loadPage(lang('failed_to_inactivate'), 'migration', 'danger');
                }
            } else {
                $this->loadPage($msg, 'migration', 'danger');
            }
        }
        if ($this->input->post('add_docs') && $this->validate_docs()) {

            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $config['upload_path'] = FCPATH . 'assets/excel/migration';
            $config['allowed_types'] = 'xlx|xlsx';
            $new_name = 'migration_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $msg = lang('upload_failed');
            if ($this->upload->do_upload('document')) {
                $upload_data = array('upload_data' => $this->upload->data());
                $document = $upload_data['upload_data']['file_name'];
                $extension = $upload_data['upload_data']['file_ext'];
                $file_size = $upload_data['upload_data']['file_size'];
                $doc_title = $post['doc_title'];
                $res = $this->migration_model->addFile($doc_title, $document, $extension, $file_size, $upload_data);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user, 'migration_file_uploaded', $post);
                    $this->loadPage(lang('doc_uploaded'), 'migration');
                }
            } else {
                $msg = $this->upload->display_errors();
            }
            $this->loadPage($msg, 'migration', 'danger');
        }
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_95'));
        $this->loadView();
    }

    function view_data($excel_id = '') {
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $file_name = $this->migration_model->validateExcelFile($excel_id);
        if (!$file_name) {
            $this->loadPage(lang('file_not_exist'), 'migration', 'danger');
        }

        include('assets/excel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
        $file_path = FCPATH . "assets/excel/migration/" . $file_name;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($file_path);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file_path);
        } catch (Exception $e) {
            $this->loadPage(lang('file_loading_failed'), 'migration', 'danger');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $excel_row = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            $data = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
            $er = array();
            $er['sponser_name'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][0]);
            if ($mlm_plan == 'BINARY') {
                $er['register_leg'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][1]);
                $er['username'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][2]);
            } else {
                $er['register_leg'] = '';
                $er['username'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][1]);
            }
            $er['email'] = $data[0][3];
            $er['password'] = $er['confirm_password'] = $data[0][4];
            $er['first_name'] = $data[0][5];


            $excel_row[$row] = $er;
            $excel_row[$row]['status'] = $this->migration_model->checkMigrationData($mlm_plan, $er);
        }
        $this->setData('excel_row', $excel_row);
        $this->setData('title', lang('menu_name_15'));
        $this->loadView();
    }

    function validate_docs() {
        $this->form_validation->set_rules('doc_title', lang('doc_title'), 'required');
        if (empty($_FILES['document']['name'])) {
            $this->form_validation->set_rules('document', lang('document'), 'required');
        }
        return $this->form_validation->run();
    }

    function migrate($action = '', $excel_id = '') {
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $file_name = $this->migration_model->validateExcelFile($excel_id);
        if (!$file_name) {
            $this->loadPage(lang('file_not_exist'), 'migration', 'danger');
        }

        include('assets/excel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
        $file_path = FCPATH . "assets/excel/migration/" . $file_name;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($file_path);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file_path);
        } catch (Exception $e) {
            $this->loadPage(lang('file_loading_failed'), 'migration', 'danger');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $excel_row = array();
        $reg_count = 0;
        for ($row = 1; $row <= $highestRow; $row++) {
            $data = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
            $er = $this->helper_model->autoRegisterArray();
            $er['sponser_name'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][0]);
            if ($mlm_plan == 'BINARY') {
                $er['register_leg'] = 'L';
                if (preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][1]) != 'left') {
                    $er['register_leg'] = 'R';
                }
                $er['username'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][2]);
                $er['email'] = $data[0][3];
                $er['password'] = $data[0][4];
                $er['first_name'] = $data[0][5];
            } else {
                $er['register_leg'] = '';
                $er['username'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data[0][1]);
                $er['email'] = $data[0][2];
                $er['password'] = $data[0][3];
                $er['first_name'] = $data[0][4];
            }

            $er['register_type'] = 'single_step';
            $er['payment_method'] = 'migration';

            $excel_row_status = $this->migration_model->checkMigrationData($mlm_plan, $er);
            if ($excel_row_status == 'Valid Details') {
                $this->base_model->transactionStart();
                $user_res = $this->register_model->addUser('migration', $er, $mlm_plan, 1);
                if ($user_res && $this->base_model->transationCheck()) {
                    $reg_count++;
                    $this->base_model->transationCommit();
                } else {
                    $this->base_model->transationRollback();
                    $failed_data = array('er' => $er, 'mlm_plan' => $mlm_plan);
                    $this->helper_model->insertFailedActivity($this->aauth->getId(), 'migration_failed', $failed_data);
                }
            }
        }
        if ($reg_count) {
            $post['action'] = $action;
            $post['excel_id'] = $excel_id;
            $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'migrated_users', $post);
            $this->loadPage($reg_count . lang('user_registered'), 'migration');
        } else {
            $this->loadPage(lang('no_user_registered'), 'migration', 'danger');
        }
    }

    function download_sample_file() {
        $mlm_plan = $this->dbvars->MLM_PLAN;
        if ($mlm_plan == 'BINARY') {
            $path = FCPATH . "assets/excel/migration/binary.xlsx";
        } else {
            $path = FCPATH . "assets/excel/migration/other.xlsx";
        }
        $this->load->helper('download');
        force_download($path, NULL);
    }

    function migration_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'migration_files';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'file_size',
            'file_type',
            'date',
            'status'
        );
        $column = $this->migration_model->getTableColumnMigrationList();
        $total_records = $this->migration_model->countOfMigrationList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->migration_model->getTotalFilteredMigrationList($table, $where);
        $res_data = $this->migration_model->getResultDataMigrationList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a target="_BLANK" href="admin/migrate-data/' . $res_data[$i][0] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="view">
                                                    <i class="fa fa-times fa fa-eye"></i>
                                                </a>

                                                <a href="javascript:register_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-dark-orange tooltips" data-placement="top" title="register">
                                                    <i class="fa fa-refresh fa fa-white"></i>
                                                </a>
                                                <a href="javascript:inactivate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="inactivate">
                                                    <i class="fa fa-times fa fa-white"></i>
                                                </a>
                                                <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="delete">
                                                <i class="fa fa-trash fa fa-white"></i>
                                            </a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:activate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="activate">
                                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                                </a><a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="delete">
                                                <i class="fa fa-trash fa fa-white"></i>
                                            </a>';
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
