<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For migration related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    migration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Migration_model extends CI_Model {

    /**
     * for adding migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $title
     * @param type $document
     * @param type $extension
     * @param type $file_size
     * @param type $upload_data
     * @return type
     */
    public function addFile($title, $document, $extension, $file_size, $upload_data = array()) {
        $this->db->set('title', $title)
                ->set('file_name', $document)
                ->set('file_type ', $extension)
                ->set('file_size', $file_size)
                ->set('total_rows', 0)
                ->set('register_rows', 0)
                ->set('failed_rows', 0)
                ->set('date', date("Y-m-d H:i:s"))
                ->set('upload_data', serialize($upload_data))
                ->set('status', 1)
                ->insert('migration_files');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for get all migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    public function getAllFiles() {
        $data = array();
        $res = $this->db->select("id,title,file_name,file_type,file_size,date,status")
                ->from("migration_files")
                ->order_by('id', 'DESC')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['title'] = $row->title;
            $data[$i]['file_name'] = $row->file_name;
            $data[$i]['file_type'] = $row->file_type;
            $data[$i]['file_size'] = $row->file_size;
            $data[$i]['date'] = $row->date;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * for deleting a migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function deleteFile($id) {
        $this->db->where('id ', $id)
                ->delete('migration_files');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing migration files status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $status
     * @return type
     */
    public function changeFileStatus($id, $status) {
        $this->db->set('status ', "$status")
                ->where('id ', $id)
                ->update('migration_files');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for validating migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $excel_id
     * @return type
     */
    public function validateExcelFile($excel_id) {
        $flag = 0;
        $file_name = '';
        $query = $this->db->select('file_name')
                ->where('id', $excel_id)
                ->limit(1)
                ->get('migration_files');
        foreach ($query->result() as $val) {
            $file_name = $val->file_name;
        }
        if ($file_name) {
            $path = FCPATH . "assets/excel/migration/" . $file_name;
            if (file_exists($path)) {
                $flag = $file_name;
            }
        }
        return $flag;
    }

    /**
     * for checking migration files data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $mlm_plan
     * @param type $data
     * @return string
     */
    public function checkMigrationData($mlm_plan, $data) {
        $flag = 0;
        $this->load->model('register_model');
        $status = '';
        if (!$this->helper_model->userNameToID($data['sponser_name'])) {
            $status .= lang('invalid_sponsor') . '<p>';
            $flag = 1;
        }
        if ($mlm_plan == 'BINARY') {
            if ($data['register_leg'] != 'L' && $data['register_leg'] != 'R' && $data['register_leg'] != 'left' && $data['register_leg'] != 'right') {
                $status .= lang('invalid_leg') . '<p>';
                $flag = 1;
            }
        }
        if ($this->helper_model->userNameToID($data['username']) || $this->register_model->checkInPending($data['username'])) {
            $status .= lang('invalid_user') . '<p>';
            $flag = 1;
        }
        if ($this->helper_model->getUserIdFromEmailId($data['email']) || $this->register_model->checkEmailInPending($data['email'])) {
            $status .= lang('invalid_email') . '<p>';
            $flag = 1;
        }

        if (!$flag) {
            $status = 'Valid Details';
        }
        return $status;
    }

    /**
     * for getting count of migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfMigrationList() {
        return $this->db->select('id')
                        ->from("migration_files")
                        ->count_all_results();
    }

    /**
     * for setting datatable heading for migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnMigrationList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'file_size', 'dt' => 2),
            array('db' => 'file_type', 'dt' => 3),
            array('db' => 'date', 'dt' => 4),
            array('db' => 'status', 'dt' => 5)
        );
    }

    /**
     * for getting filtered count of migration files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredMigrationList($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting migration files details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataMigrationList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

}
