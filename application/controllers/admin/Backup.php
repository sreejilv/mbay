<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Base_Controller.php';

/**
 * For taking the system backup like :database backup
 * 
 */
class Backup extends Base_Controller {

    /**
     * For configuration view

     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function index() {
        $this->setData('count', $this->backup_model->countOfBackupList());
        $this->setData('backup_type', $this->dbvars->BACKUP_TYPE);
        $this->setData('db_optimize', $this->dbvars->DB_OPTIMIZE_STATUS);
        $this->setData('small_db', $this->dbvars->SMALL_DB);
        $this->setData('backup_deletion_period', $this->dbvars->BACKUP_DELETION_PERIOD);
        $this->setData('title', lang('menu_name_41'));
        $this->loadView();
    }

    /**
     * for getting the database backup

     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function db_backup() {
        $res = $this->backup_model->dbBackup();
        if ($res) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($user_id, 'backup_created');
            echo 'yes';
            exit;
        }
        echo 'no';
        exit;
    }

    /**
     * For download db
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function download_db($file_name = "") {
        if ($file_name) {
            $path = FCPATH . "application/backup/" . $file_name;
            $this->load->helper('download');
            force_download($path, NULL);
        }
    }

    /**
     * for delete the backup deletion
     * @author Techffodils Technologies LLP
     * @date 2018-1-29
     */
    function change_settings() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['backup_deletion_period']) {
            $backup_deletion_period = $this->dbvars->BACKUP_DELETION_PERIOD = $post['backup_deletion_period'];
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($this->helper_model->insertActivity($user_id, 'backup_settings_changed', $post)) {
                $this->backup_model->deleteOlderBackup($backup_deletion_period);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    function backup_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'cron_job';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'status',
            'done_by',
            'date',
            'data'
        );
        $column = $this->backup_model->getTableColumnBackupList();
        $total_records = $this->backup_model->countOfBackupList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrderDBACKUP($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->backup_model->getTotalFilteredBackupList($table, $where);
        $res_data = $this->backup_model->getResultDataBackupList($table, $columns, $where, $order, $limit);

        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;

            if ($this->dbvars->PRESET_DEMO_STATUS > 0) {
                $path = "javascript:show_notification('warning','" . lang('operation_blocked') . "','" . lang('this_operation_blocked_in_preset_demo') . "')";
                $res_data[$i][1] = '<a href="' . $path . '" download="proposed_file_name"><i class="fa fa-download fa-fw"></i>' . lang('download') . '</a>';
            } else {
                $res_data[$i][1] = '<a href="admin/backup/download_db/' . $res_data[$i][4] . '" download="proposed_file_name"><i class="fa fa-download fa-fw"></i>' . lang('download') . '</a>';
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

    function change_db_optimize_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['status'] >= 0) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($user_id) {
                $this->dbvars->DB_OPTIMIZE_STATUS = $post['status'];
                $this->helper_model->insertActivity($user_id, 'backup_settings_changed', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

    function change_db_size_limit_status() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());

        if ($post['status'] >= 0) {
            $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            if ($user_id) {
                $this->dbvars->SMALL_DB = $post['status'];
                $this->helper_model->insertActivity($user_id, 'backup_settings_changed', $post);
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

}
