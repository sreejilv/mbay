<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * For document related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    document
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Document_model extends CI_Model {

    /**
     * for adding document
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $doc_title
     * @param type $document
     * @param type $extension
     * @param type $size
     * @param type $upload_data
     * @param type $file_type
     * @return type
     */
    public function addDocument($user_id, $doc_title, $document, $extension, $size, $upload_data, $file_type) {
        $this->db->set('mlm_user_id ', $user_id)
                ->set('title', $doc_title)
                ->set('document ', $document)
                ->set('extension', $extension)
                ->set('size', $size)
                ->set('file_type', $file_type)
                ->set('date', date("Y-m-d H:i:s"))
                ->set('upload_data', serialize($upload_data))
                ->insert('documents');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting document details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $type
     * @return type
     */
    public function getDocuments($type) {
        $data = array();
        $res = $this->db->select("id,extension,title,document,date,file_type,size,status")
                ->from("documents")
                ->order_by('id', 'DESC')
                ->where("file_type", $type)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['extension'] = $row->extension;
            $data[$i]['title'] = $row->title;
            $data[$i]['document'] = $row->document;
            $data[$i]['date'] = $row->date;
            $data[$i]['file_type'] = $row->file_type;
            $data[$i]['size'] = $row->size;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * for getting all files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $last
     * @return string
     */
    public function getAllFiles($last = 0) {
        $data = array();
        $this->db->select("id,extension,title,document,date,file_type,size");
        $this->db->from("documents");
        $this->db->order_by('id', 'DESC');
        $this->db->where("status", 1);
        $res = $this->db->get();
        $i = 0;
        $month = '';
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['extension'] = $row->extension;
            $data[$i]['title'] = $row->title;
            $data[$i]['document'] = $row->document;
            $data[$i]['date'] = $row->date;
            $data[$i]['file_type'] = ' '.$row->file_type;
            $data[$i]['size'] = $row->size;
            $img = 'no_vdo.png';
            $img = '';
            if ($row->file_type == 'img') {
                $img = $row->document;
            } elseif ($row->file_type == 'docs') {
                $img = 'no_doc.jpg';
            } elseif ($row->file_type == 'vdo') {
                $img = 'no_vdo.jpg';
            } elseif ($row->file_type == 'aud') {
                $img = 'no_aud.png';
            }
            $data[$i]['img'] = $img;
            $i++;
        }
        return $data;
    }

    /**
     * for changing a document status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     *
     * @param type $id
     * @param type $status
     * @return type
     */
    public function changeFileStatus($id, $status) {
        $this->db->set('status ', $status)
                ->where('id ', $id)
                ->update('documents');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for deleting a file
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function deleteFile($id) {
        $this->db->where('id ', $id)
                ->delete('documents');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting count of files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $doc_type
     * @return type
     */
    function countOfDocumentList($doc_type) {
        return $this->db->select('id')
                        ->where('file_type ', $doc_type)
                        ->from("documents")
                        ->count_all_results();
    }

    /**
     * for setting headings foe files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnDocumentList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'document', 'dt' => 2),
            array('db' => 'size', 'dt' => 3),
            array('db' => 'date', 'dt' => 4),
            array('db' => 'status', 'dt' => 5)
        );
    }

    /**
     * for getting filtered file count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $doc_type
     * @return type
     */
    function getTotalFilteredDocumentList($table, $where, $doc_type) {
        if ($where) {
            $where = $where . " AND file_type = '$doc_type' ";
        } else {
            $where = " WHERE file_type = '$doc_type' ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting datatable details for files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $doc_type
     * @return type
     */
    function getResultDataDocumentList($table, $column, $where, $order, $limit, $doc_type) {
        $data = array();
        if ($where) {
            $where = $where . " AND file_type = '$doc_type' ";
        } else {
            $where = " WHERE file_type = '$doc_type' ";
        }
        $query = $this->db->query("select " . implode(' , ', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

        /**
     * For getting the table column
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnViewDocumentList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'document', 'dt' => 2),
            array('db' => 'size', 'dt' => 3),
            array('db' => 'file_type', 'dt' => 4),
            array('db' => 'date', 'dt' => 5),
            array('db' => 'status', 'dt' => 6)
        );
    }

    /**
     * For Filtered Data
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredViewDocumentList($table, $where, $from_date, $to_date) {
        if ($where) {
            $where = $where . " AND status > 0 AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE  status > 0 AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For getting the Result data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataViewDocumentList($table, $column, $where, $order, $limit,  $from_date, $to_date) {
        $data = array();
        if ($where) {
            $where = $where . " AND status > 0 AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE  status > 0 AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }
        $query = $this->db->query("select " . implode(' , ', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */

    function countViewDocumentList($from_date, $to_date) {
        return $this->db->select('id')
                        ->from('documents')
                        ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->count_all_results();
    }

}
