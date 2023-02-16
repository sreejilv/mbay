<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * For system internal mail management  related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    login
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Mail_model extends CI_Model {

    /**
     * for getting sytem mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $catagories
     * @param type $page
     * @return string
     */
    function getAllMails($user_id, $catagories, $page = '') {
        $data = array();
        $res = $this->db->select("stared,from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                ->from("mail_system")
                ->where("catagories", $catagories)
                ->where("user_id", $user_id)
                ->where("stared", 'no')
                ->where("spam", 'no')
                ->order_by("read_status", "DESC")
                ->order_by("date", "DESC")
                ->limit(10, $page)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['user_id'] = $row->user_id;
            $data[$i]['subject'] = strip_tags($row->subject);
            $data[$i]['content'] = strip_tags($row->content);
            $data[$i]['show_subject'] = strip_tags(implode(' ', array_slice(explode(' ', $row->subject), 0, 3))) . '..';
            $data[$i]['show_content'] = strip_tags(implode(' ', array_slice(explode(' ', $row->content), 0, 4))) . '....';
            $data[$i]['attachment_name'] = $row->attachment_name;
            $data[$i]['catagories'] = $row->catagories;
            $data[$i]['date'] = Carbon::parse($row->date)->formatLocalized('%a %d-%b-%Y');
            $data[$i]['stared'] = $row->stared;
            $data[$i]['read_status'] = $row->read_status;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->user_id);
            $data[$i]['from_username'] = $this->helper_model->IdToUserName($row->from_id);
            $image = $this->imageDetails($row->from_id);
            $data[$i]['dp'] = BASE_PATH . 'assets/images/users/' . $image;
            $i++;
        }
        return $data;
    }

    /**
     * for getting user image
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function imageDetails($user_id) {
        $qry = $this->db->select('user_dp')
                ->where('mlm_user_id', $user_id)
                ->get('user_details');
        if ($qry->num_rows() > 0) {
            return $qry->row()->user_dp;
        }
        return false;
    }

    /**
     * for getting system mail details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $id
     * @param type $catagories
     * @return string
     */
    function getMailDetails($user_id, $id, $catagories) {
        $data = array();
        $user_type=$this->helper_model->getUserType($user_id);
        if($user_type=='user'){
            $res = $this->db->select("from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                      ->limit(1)
                      ->where("id", $id)
                      ->where('user_id',$user_id)
                      ->get('mail_system');
        }else{
            $res = $this->db->select("from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                      ->limit(1)
                      ->where("id", $id)
                      ->get('mail_system');
        }

        foreach ($res->result() as $row) {
            $data['id'] = $row->id;
            $data['user_id'] = $row->user_id;
            $data['subject'] = strip_tags($row->subject);
            $data['content'] = strip_tags($row->content);
            $data['show_subject'] = strip_tags(implode(' ', array_slice(explode(' ', $row->subject), 0, 3))) . '..';
            $data['show_content'] = strip_tags(implode(' ', array_slice(explode(' ', $row->content), 0, 4))) . '....';
            $data['attachment_name'] = $row->attachment_name;
            $data['catagories'] = $row->catagories;
            $data['date'] = Carbon::parse($row->date)->formatLocalized('%a %d-%b-%Y');
            $data['read_status'] = $row->read_status;
            $data['username'] = $this->helper_model->IdToUserName($row->user_id);
            if ($data['catagories'] == 'draft') {
                $data['from_username'] = $this->helper_model->IdToUserName($row->user_id);
            } else {
                $data['from_username'] = $this->helper_model->IdToUserName($row->from_id);
            }
            $image = $this->imageDetails($row->from_id);
            $data['dp'] = BASE_PATH . 'assets/images/users/' . $image;
        }
        return $data;
    }

    /**
     * for getting count of unread mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $catagories
     * @return type
     */
    function getCountUnReadMail($user_id, $catagories) {
        $numrows = $this->db->select('id')
                ->from("mail_system")
                ->where('read_status', "unread")
                ->where("catagories", $catagories)
                ->where("user_id", $user_id)
                ->where("stared", 'no')
                ->where("spam", 'no')
                ->count_all_results();
        return $numrows;
    }

    /**
     * for inserting mail data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return type
     */
    function insertMailData($data) {
        $this->db->set('user_id', $data['user_id'])
                ->set('from_id', $data['from_id'])
                ->set('subject', $data['subject'])
                ->set('content', $data['content'])
                ->set('attachment_name', $data['images'])
                ->set('catagories', $data['catagories'])
                ->set('date', $data['date'])
                ->set('read_status', $data['read_status'])
                ->insert('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing category
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $user_id
     * @param type $catogories
     * @return type
     */
    function changeCatagories($id, $user_id, $catogories) {
        $this->db->set('catagories ', $catogories)
                ->where('user_id ', $user_id)
                ->where('id ', $id)
                ->update('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing to starred
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @param type $user_id
     * @param type $catogories
     * @return type
     */
    function changestared($id, $user_id, $catogories) {
        $this->db->set('stared ', $catogories)
                ->where('id ', $id)
                ->update('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing to spam
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $user_id
     * @param type $catogories
     * @return type
     */
    function changespam($id, $user_id, $catogories) {
        $this->db->set('spam ', $catogories)
                ->where('id ', $id)
                ->update('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing read status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $user_id
     * @param type $read_status
     * @return type
     */
    function changeReadStatus($id, $user_id, $read_status) {
        $this->db->set('read_status ', $read_status)
                ->where('user_id ', $user_id)
                ->where('id ', $id)
                ->update('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all sent mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $catagories
     * @return string
     */
    function getAllSentMails($user_id, $catagories) {
        $data = array();
        $res = $this->db->select("from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                ->from("mail_system")
                ->where("catagories", $catagories)
                ->where("from_id", $user_id)
                ->where("stared", 'no')
                ->where("spam", 'no')
                ->order_by("read_status", "DESC")
                ->order_by("date", "DESC")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['user_id'] = $row->from_id;
            $data[$i]['subject'] = strip_tags($row->subject);
            $data[$i]['content'] = strip_tags($row->content);
            $data[$i]['show_subject'] = strip_tags(implode(' ', array_slice(explode(' ', $row->subject), 0, 3))) . '..';
            $data[$i]['show_content'] = strip_tags(implode(' ', array_slice(explode(' ', $row->content), 0, 4))) . '....';
            $data[$i]['attachment_name'] = $row->attachment_name;
            $data[$i]['catagories'] = $row->catagories;
            $data[$i]['date'] = $row->date;
            $data[$i]['read_status'] = $row->read_status;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->from_id);
            $data[$i]['from_username'] = $this->helper_model->IdToUserName($row->user_id);
            $image = $this->imageDetails($row->from_id);
            $data[$i]['dp'] = BASE_PATH . 'assets/images/users/' . $image;
            $i++;
        }
        return $data;
    }

    /**
     * for changing to trash
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
//    function changeStatusTrash($id) {
//        return $this->db->set('catagories', 'delete')
//                        ->where('id', $id)
//                        ->update('mail_system');
//    }
    public function deleteMail($id) {
        $this->db->where('id', $id)
                ->delete('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing mail status to delete
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function changeStatusDelete($id) {
        $this->db->set('catagories', 'delete')
                ->where('id', $id)
                ->update('mail_system');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all spam mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return string
     */
    function getAllMailsSpam($user_id) {
        $data = array();
        $res = $this->db->select("from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                ->from("mail_system")
                ->where("user_id", $user_id)
                ->where("spam", 'yes')
                ->order_by("read_status", "DESC")
                ->order_by("date", "DESC")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['user_id'] = $row->user_id;
            $data[$i]['subject'] = strip_tags($row->subject);
            $data[$i]['content'] = strip_tags($row->content);
            $data[$i]['show_subject'] = strip_tags(implode(' ', array_slice(explode(' ', $row->subject), 0, 3))) . '..';
            $data[$i]['show_content'] = strip_tags(implode(' ', array_slice(explode(' ', $row->content), 0, 4))) . '....';
            $data[$i]['attachment_name'] = $row->attachment_name;
            $data[$i]['catagories'] = $row->catagories;
            $data[$i]['date'] = $row->date;
            $data[$i]['read_status'] = $row->read_status;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->user_id);
            $data[$i]['from_username'] = $this->helper_model->IdToUserName($row->from_id);
            $image = $this->imageDetails($row->from_id);
            $data[$i]['dp'] = BASE_PATH . 'assets/images/users/' . $image;
            $i++;
        }
        return $data;
    }

    /**
     * for getting all draft mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $catagories
     * @param type $page
     * @return string
     */
    function getAllMailsDraft($user_id, $catagories, $page) {
        $data = array();
        $res = $this->db->select("from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                ->from("mail_system")
                ->where("catagories", $catagories)
                ->where("from_id", $user_id)
                ->where("stared", 'no')
                ->where("spam", 'no')
                ->order_by("read_status", "DESC")
                ->order_by("date", "DESC")
                ->limit(10, $page)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['user_id'] = $row->user_id;
            $data[$i]['subject'] = strip_tags($row->subject);
            $data[$i]['content'] = strip_tags($row->content);
            $data[$i]['show_subject'] = strip_tags(implode(' ', array_slice(explode(' ', $row->subject), 0, 3))) . '..';
            $data[$i]['show_content'] = strip_tags(implode(' ', array_slice(explode(' ', $row->content), 0, 4))) . '....';
            $data[$i]['attachment_name'] = $row->attachment_name;
            $data[$i]['catagories'] = $row->catagories;
            $data[$i]['date'] = $row->date;
            $data[$i]['read_status'] = $row->read_status;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->user_id);
            $data[$i]['from_username'] = $this->helper_model->IdToUserName($row->user_id);
            $image = $this->imageDetails($row->user_id);
            $data[$i]['dp'] = BASE_PATH . 'assets/images/users/' . $image;
            $i++;
        }
        return $data;
    }

    /**
     * for getting all starred mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @param type $page
     * @return string
     */
    function getAllMailsStared($user_id, $page = 0) {
        $data = array();
        $res = $this->db->select("from_id,id,user_id,subject,attachment_name,catagories,date,read_status,content")
                ->from("mail_system")
                ->where("user_id", $user_id)
                ->where("stared", 'yes')
                ->order_by("read_status", "DESC")
                ->order_by("date", "DESC")
                ->limit(10, $page)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['user_id'] = $row->user_id;
            $data[$i]['subject'] = strip_tags($row->subject);
            $data[$i]['content'] = strip_tags($row->content);
            $data[$i]['show_subject'] = strip_tags(implode(' ', array_slice(explode(' ', $row->subject), 0, 3))) . '..';
            $data[$i]['show_content'] = strip_tags(implode(' ', array_slice(explode(' ', $row->content), 0, 4))) . '....';
            $data[$i]['attachment_name'] = $row->attachment_name;
            $data[$i]['catagories'] = $row->catagories;
            $data[$i]['date'] = $row->date;
            $data[$i]['read_status'] = $row->read_status;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->user_id);
            $data[$i]['from_username'] = $this->helper_model->IdToUserName($row->from_id);
            $image = $this->imageDetails($row->from_id);
            $data[$i]['dp'] = BASE_PATH . 'assets/images/users/' . $image;
            $i++;
        }
        return $data;
    }

    /**
     * for getting all usernames
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $query
     * @return type
     */
    function getAllUserNames($query) {
        $user_id = $this->aauth->getId();
        $data = array();
        if ($query != '') {
            $res = $this->db->select("user_name")
                    ->from('user')
                    ->like('user_name', trim($query))
                    ->where('mlm_user_id != ', $user_id)
                    ->get();
        } else {
            $res = $this->db->select("user_name")
                    ->from('user')
                    ->where('mlm_user_id != ', $user_id)
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            $json[] = $row['user_name'];
        }

        return json_encode($json);
    }

    /**
     * for getting all downlines
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_status
     * @return type
     */
    function getAdminDownlines($user_status = '') {
        $this->db->select("mlm_user_id");
        $this->db->from("user");
        if ($user_status) {
            $this->db->where("user_status", $user_status);
        }
        $this->db->where("user_type", 'user');
        $res = $this->db->get();
        $i = 0;
        $data = array();
        foreach ($res->result() as $row) {
            $data[$i] = $row->mlm_user_id;
            $i++;
        }
        return $data;
    }

    function getTableColumnSent() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't1.content', 'dt' => 1),
            array('db' => 't1.from_id', 'dt' => 2),
            array('db' => 't2.user_name', 'dt' => 3),
            array('db' => 't1.subject', 'dt' => 4),
            array('db' => 't1.date', 'dt' => 5),
            array('db' => 't1.read_status', 'dt' => 6),
            array('db' => 't1.attachment_name', 'dt' => 7),
        );
    }
    function getTableColumnInbox() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't1.content', 'dt' => 1),
            array('db' => 't1.from_id', 'dt' => 2),
            array('db' => 't2.user_name', 'dt' => 3),
            array('db' => 't1.subject', 'dt' => 4),
            array('db' => 't1.date', 'dt' => 5),
            array('db' => 't1.read_status', 'dt' => 6),
            array('db' => 't1.attachment_name', 'dt' => 7),
        );
    }

    /**
     * For COUNT sent mail
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $user_id
     * @return type
     */
    function countSpam($table1, $table2, $user_id,$field) {
        $where = " WHERE t1.user_id = '$user_id' AND t1.".$field."='yes'  ";
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.from_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }
    function countInbox($table1, $table2, $user_id,$categorie) {
        $where = " WHERE t1.user_id = '$user_id' AND t1.catagories = '$categorie' AND t1.stared='no' AND t1.spam='no'  ";
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.from_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * For getting the filtered order report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies


     * @param type $where
     * @param type $table1
     * @param type $table2
     * @param type $user_id

     * @return type
     */
    function getTotalFilteredSpam($table1, $table2, $where, $user_id,$field) {
        if ($where) {
            $where = $where . " AND t1.user_id = '$user_id' AND t1.".$field."='yes'  ";
        } else {
            $where = " WHERE t1.user_id = '$user_id' AND t1.".$field."='yes'  ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.from_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }
    function getTotalFilteredInbox($table1, $table2, $where, $user_id,$categorie) {
        if ($where) {
            $where = $where . " AND t1.user_id = '$user_id' AND t1.catagories = '$categorie' AND t1.stared='no' AND t1.spam='no'  ";
        } else {
            $where = " WHERE t1.user_id = '$user_id' AND t1.catagories = '$categorie' AND t1.stared='no' AND t1.spam='no'  ";
        }
        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.from_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the result all order details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataInbox($table1, $table2,$where, $order, $limit,$user_id,$categorie) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.user_id = '$user_id' AND t1.catagories = '$categorie' AND t1.stared='no' AND t1.spam='no'  ";
        } else {
            $where = " WHERE t1.user_id = '$user_id' AND t1.catagories = '$categorie' AND t1.stared='no' AND t1.spam='no'  ";
        }

        $query = $this->db->query("select t1.id,t1.content,t1.from_id,t2.user_name,t1.subject,t1.date,t1.read_status,t1.attachment_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.from_id = t2.mlm_user_id " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    function getResultDataSpam($table1, $table2,$where, $order, $limit,$user_id,$field) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.user_id = '$user_id'  AND t1.".$field."='yes'  ";
        } else {
            $where = " WHERE t1.user_id = '$user_id' AND t1.".$field."='yes'  ";
        }

        $query = $this->db->query("select t1.id,t1.content,t1.from_id,t2.user_name,t1.subject,t1.date,t1.read_status,t1.attachment_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.from_id = t2.mlm_user_id " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
}
