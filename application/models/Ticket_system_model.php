<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * For Ticket related Model
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Ticket_system_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * For insert the ticket type
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type_arr
     * @return boolean
     */
    function insertTicketType($type_arr) {
        $result = $this->db->set('type_name', $type_arr['type_name'])->set('status', 1)->set('date', date('Y-m-d H:i:s'))->insert('ticket_type');
        if ($result > 0) {
            return TRUE;
        } else {
            $error = $this->db->error();
            return $error;
        }
    }

    /**
     * For get type details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getEditeTypeDetails($id) {
        $result = $this->db->select('type_name,status')->from('ticket_type')->where('id', $id)->get();
        $details = [];
        foreach ($result->result_array() as $row) {
            $details['type_name'] = $row['type_name'];
            $details['status'] = $row['status'];
        }
        return $details;
    }

    /**
     * For delete the type
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function deleteType($id) {
        $this->db->where('id', $id)->delete('ticket_type');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update the tyoe status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $update_id
     * @param type $type_name
     * @return type
     */
    function updateType($update_id, $type_name) {
        $result = $this->db->set('type_name', $type_name)->where('id', $update_id)->update('ticket_type');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For getting all department
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllDepartments() {
        $result = $this->db->select("department_id,department_name,status,date")
                ->from('ticket_department')
                ->get();
        if (!$result) {
            $error = $this->db->error();
            return $error;
        } else {


            return $result->result_array();
        }
    }

    /**
     * For getting all priority
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllPriority() {
        $result = $this->db->select("id,name,status,date")
                ->from('ticket_priority')
                ->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }

    /**
     * For delete the priority
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function deletePriority($id) {
        $result = $this->db->where('id', $id)->delete('ticket_priority');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For activate priority
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function activatePriority($id) {
        $result = $this->db->set('status', 1)->where('id', $id)->update('ticket_priority');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For update priority
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $update_id
     * @param type $type_name
     * @return type
     */
    function updatePriority($update_id, $type_name) {
        $result = $this->db->set('name', $type_name)->where('id', $update_id)->update('ticket_priority');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For get all priority details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getEditepriorityDetails($id) {
        $result = $this->db->select('name,status')->from('ticket_priority')->where('id', $id)->get();
        $details = [];
        foreach ($result->result_array() as $row) {
            $details['type_name'] = $row['name'];
            $details['status'] = $row['status'];
        }
        return $details;
    }

    /**
     * For insert department
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type_arr
     * @return boolean
     */
    function insertTicketDepartment($type_arr) {
        $result = $this->db->set('department_name', $type_arr['department_name'])->set('status', 1)->set('date', date('Y-m-d H:i:s'))->insert('ticket_department');
        if ($result) {
            return TRUE;
        } else {
            $error = $this->db->error();
            print_r($error);
            die;
            return $error;
        }
    }

    /**
     * For get all department details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getEditeDepartmentDetails($id) {
        $result = $this->db->select('department_name,status')->from('ticket_department')->where('department_id', $id)->get();
        $details = [];
        foreach ($result->result_array() as $row) {
            $details['type_name'] = $row['department_name'];
            $details['status'] = $row['status'];
        }
        return $details;
    }

    /**
     * For delete the department
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function deleteDepartment($id) {
        $this->db->where('department_id', $id)
                ->delete('ticket_department');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update department
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $update_id
     * @param type $type_name
     * @return type
     */
    function updateDepartment($update_id, $type_name) {
        $result = $this->db->set('department_name', $type_name)->where('department_id', $update_id)->update('ticket_department');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For get random ticket id
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return string
     */
    function getRandomTicketId() {
        $keys = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        );
        shuffle($keys);

        $num_chars = count($keys) - 1;
        $token = 'TKT-';

        for ($i = 0; $i < 7; $i++) { // <-- $num_chars instead of $len
            $token .= $keys[mt_rand(0, $num_chars)];
        }
        $result = $this->checkUniqueTicketId($token);
        if ($result) {
            return $token;
        }
    }

    /**
     * For check unique ticket id
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $token
     * @return boolean
     */
    function checkUniqueTicketId($token) {
        $result = $this->db->select('count(*) as cnt')->from('ticket')->like('ticket_id', $token)->get();
        foreach ($result->result() as $row) {
            $count = $row->cnt;
        }
        if ($count > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * For create ticket
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @param type $images
     * @return type
     */
    public function insertTicket($data, $images = array()) {

        $result = $this->db->set('ticket_id', $data['ticket_id'])
                ->set('title', $data['title'])
                ->set('subject', $data['subject'])
                ->set('mail', $data['email'])
                ->set('content', $data['message'])
                ->set('attach_file', serialize($images))
                ->set('rating', isset($data['rating'][0]) ? $data['rating'][0] : FALSE)
                ->set('priority', $data['priority'])
                //->set('assignee', $this->helper_model->getAdminId())
                ->set('department', $data['department'])
                ->set('from_userid', $data['user_id'])
                ->set('created_date', date('Y-m-d H:i:s'))
                ->set('status', $this->dbvars->DEF_TICKET_TYPE)
                ->insert('ticket');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For get all tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getAllTickets($id = '') {
        $status_change_id = '';
        if ($id != '') {
            $status_change_id = $id;

            $result = $this->db->select('*')
                    ->from('ticket')
                    ->where('assignee', $status_change_id)
                    ->get();
        } else {
            $result = $this->db->select('*')
                    ->from('ticket')
                    ->get();
        }
        $details = array();
        $i = 0;
        foreach ($result->result_array()as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['ticket_id'] = $row['ticket_id'];
            $details[$i]['title'] = $row['title'];
            $details[$i]['email'] = $row['mail'];
            $details[$i]['message'] = $row['content'];
            $details[$i]['subject'] = $row['subject'];
            $details[$i]['priority'] = $this->getPriorityName($row['priority']);
            $details[$i]['department'] = $this->getDepartmentName($row['department']);
            $details[$i]['status'] = $this->getStatusName($row['status']);
            $details[$i]['attched_file'] = $this->getAllAttachedFiles($row['attach_file']);
            $details[$i]['from_userid'] = $this->helper_model->IdToUserName($row['from_userid']);
            $details[$i]['user_image'] = $this->getUserImage($row['from_userid']);
            $details[$i]['replies'] = $this->getReplies($row['id']);
            $details[$i]['assignee'] = ($row['assignee']) ? $this->EmpIdToUserName($row['assignee']) : $this->helper_model->IdToUserName($row['assignee']);
            $details[$i]['assignee_image'] = ($row['assignee'] != '') ? $this->getEmpUserImage($row['assignee']) : $this->getUserImage($row['assignee']);

            $dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $row['created_date']);
            $details[$i]['time'] = $dtKtm->diffForHumans();
            if (!empty($row['updated_date'])) {
                $update_dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $row['updated_date']);
                $details[$i]['update_time'] = $update_dtKtm->diffForHumans();
            }
            $i++;
        }

        return $details;
    }

    /**
     * For get latest ticket details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $limit
     * @return type
     */
    function getLatestTickets($limit = '', $user_id = '') {
        $change_status_id = '';
        if ($user_id != '') {
            $change_status_id = $user_id;

            $result = $this->db->select('*')
                    ->from('ticket')
                    ->limit($limit)
                    ->where('assignee', $change_status_id)
                    ->order_by('created_date', 'DESC')
                    ->get();
        } else {
            $result = $this->db->select('*')
                    ->from('ticket')
                    ->limit($limit)
                    ->order_by('created_date', 'DESC')
                    ->get();
        }

        $details = array();
        $i = 0;
        foreach ($result->result_array()as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['ticket_id'] = $row['ticket_id'];
            $details[$i]['title'] = $row['title'];
            $details[$i]['email'] = $row['mail'];
            $details[$i]['message'] = $row['content'];
            $details[$i]['subject'] = $row['subject'];
            $details[$i]['priority'] = $this->getPriorityName($row['priority']);
            $details[$i]['department'] = $this->getDepartmentName($row['department']);
            $details[$i]['status'] = $this->getStatusName($row['status']);
            $details[$i]['attched_file'] = $this->getAllAttachedFiles($row['attach_file']);
            $details[$i]['from_userid'] = $this->helper_model->IdToUserName($row['from_userid']);
            $details[$i]['user_image'] = $this->getUserImage($row['from_userid']);
            $details[$i]['replies'] = $this->getReplies($row['id']);
            $details[$i]['assignee'] = ($row['assignee']) ? $this->EmpIdToUserName($row['assignee']) : $this->helper_model->IdToUserName($row['assignee']);
            $details[$i]['assignee_image'] = ($row['assignee'] != '') ? $this->getEmpUserImage($row['assignee']) : $this->getUserImage($row['assignee']);

            $dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $row['created_date']);
            $details[$i]['time'] = $dtKtm->diffForHumans();
            if (!empty($row['updated_date'])) {
                $update_dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $row['updated_date']);
                $details[$i]['update_time'] = $update_dtKtm->diffForHumans();
            }

            $i++;
        }

        return $details;
    }

    /**
     * For get replies
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getReplies($id) {
        $details = $this->db->select("id,ticket_id,user_id,message,reply_attachement,date")->from('ticket_replies')->where('ticket_id', $id)->get();
        $files = array();
        $i = 0;
        foreach ($details->result_array() as $img) {
            $files[$i]['id'] = $img['id'];
            $files[$i]['user_id'] = $img['user_id'];
            $files[$i]['user_name'] = $this->helper_model->IdTOUserName($img['user_id']);
            $files[$i]['user_image'] = $this->getUserImage($img['user_id']);
            $files[$i]['message'] = strip_tags($img['message']);
            $files[$i]['attachement'] = $this->getAllAttachedFiles($img['reply_attachement']);
            $dtKtm = Carbon::createFromFormat('Y-m-d H:i:s', $img['date']);
            $files[$i]['rply_time'] = $dtKtm->diffForHumans();
            $i++;
        }
        return $files;
    }

    /**
     * For get all attached files
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $file_array
     * @return type
     */
    function getAllAttachedFiles($file_array) {
        $image = unserialize($file_array);
        $files = array();
        $i = 0;
        foreach ($image as $key => $img) {
            $files[$i]['id'] = $key;
            $files[$i]['file_name'] = $img['file_name'];
            $i++;
        }
        return $files;
    }

    /**
     * For get user images
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getUserImage($id) {
        $user_dp = '';
        $result = $this->db->select('user_dp')
                ->from('user_details')
                ->where('mlm_user_id', $id)
                ->get();
        if ($result->num_rows() > 0) {
            $user_dp = $result->row()->user_dp;
        }
        return $user_dp;
    }

    /**
     * For get user images
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getEmpUserImage($id) {
        $user_dp = '';
        $result = $this->db->select('user_photo')
                ->from('employee_details')
                ->where('employee_id', $id)
                ->get();
        if ($result->num_rows() > 0) {
            $user_dp = $result->row()->user_photo;
        }
        return $user_dp;
    }

    /**
     * For getting the ticket priority
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getPriorityName($id) {
        $priority_name = lang('na');

        $result = $this->db->select('name')
                ->get_where('ticket_priority', array('id' => $id));

        if ($result->num_rows() > 0) {
            $priority_name = $result->row()->name;
        }
        return $priority_name;
    }

    /**
     * for get the department name
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getDepartmentName($id) {
        $priority_name = lang('na');
        $result = $this->db->select('department_name')
                ->get_where('ticket_department', array('department_id' => $id));

        if ($result->num_rows() > 0) {
            $priority_name = $result->row()->department_name;
        }
        return $priority_name;
    }

    /**
     * For get status name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getStatusName($id) {
        $priority_name = lang('na');
        $result = $this->db->select('type_name')
                ->get_where('ticket_type', array('id' => $id));

        if ($result->num_rows() > 0) {
            $priority_name = $result->row()->type_name;
        }
        return $priority_name;
    }

    /**
     * For getting all closed tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllClosedTickets() {
        $result = $this->db->select("count(*) as cnt")->get_where('ticket', array('status' => 1))->row()->cnt;
        if ($result > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    /**
     * For getting all news
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllNewTickets() {
        $result = $this->db->select("count(*) as cnt")->get_where('ticket', array('status' => $this->dbvars->DEF_TICKET_TYPE))->row()->cnt;
        if ($result > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    /**
     * For checkTicketID exits or not
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return boolean
     */
    function checkTickettIdExistsOrNot($id) {
        $result = $this->db->select('count(*) as cnt')->get_where('ticket', array('id' => $id))->row()->cnt;
        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getAllTicketsUserWise($id = '', $user_id = '') {

        if ($user_id != '') {
            $result = $this->db->select('*')
                    ->from('ticket')
                    ->where('id', $id)
                    ->where('from_userid', $user_id)
                    ->get();
        } else {
            $result = $this->db->select('*')
                    ->from('ticket')
                    ->where('id', $id)
                    ->get();
        }


        $details = array();
        foreach ($result->result()as $row) {

            $details['id'] = $row->id;
            $details['ticket_id'] = $row->ticket_id;
            $details['title'] = $row->title;
            $details['email'] = $row->mail;
            $details['message'] = $row->content;
            $details['subject'] = $row->subject;
            $details['priority'] = $this->getPriorityName($row->priority);
            $details['department'] = $this->getDepartmentName($row->department);
            $details['status'] = $this->getStatusName($row->status);
            $details['status_id'] = $row->status;
            $details['attched_file'] = $this->getAllAttachedFiles($row->attach_file);
            $details['from_userid'] = $this->helper_model->IdToUserName($row->from_userid);
            $details['user_image'] = $this->getUserImage($row->from_userid);
            $details['created_date'] = $row->created_date;
            $details['updated_date'] = $row->updated_date;
            $details['rating'] = $row->rating;
            if ($row->assignee != '') {
                $details['assignee'] = ($row->assignee) ? $this->EmpIdToUserName($row->assignee) : $this->helper_model->IdToUserName($row->assignee);
            } else {
                $details['assignee'] = $this->helper_model->IdToUserName($this->helper_model->getAdminId());
            }
            $details['assignee_image'] = ($row->assignee != '') ? $this->getEmpUserImage($row->assignee) : $this->getUserImage($row->assignee);

            $details['replies'] = $this->getReplies($row->id);
        }

        return $details;
    }

    function getUserIdFromTicket($ticket_id, $user_id) {
        $query = $this->db->select('id')
                ->from('ticket')
                ->where('id', $ticket_id)
                ->where('from_userid', $user_id)
                ->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting all tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getAllTicketsUser($id = '') {

        $result = $this->db->select('*')
                ->from('ticket')
                ->where('from_userid', $id)
                ->get();

        $details = array();
        $i = 0;
        foreach ($result->result_array()as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['ticket_id'] = $row['ticket_id'];
            $details[$i]['title'] = $row['title'];
            $details[$i]['email'] = $row['mail'];
            $details[$i]['message'] = $row['content'];
            $details[$i]['subject'] = $row['subject'];
            $details[$i]['priority'] = $this->getPriorityName($row['priority']);
            $details[$i]['department'] = $this->getDepartmentName($row['department']);
            $details[$i]['status'] = $this->getStatusName($row['status']);
            $details[$i]['status_id'] = $row['status'];
            $details[$i]['attched_file'] = $this->getAllAttachedFiles($row['attach_file']);
            $details[$i]['from_userid'] = $this->helper_model->IdToUserName($row['from_userid']);
            $details[$i]['user_image'] = $this->getUserImage($row['from_userid']);
            $details[$i]['created_date'] = $row['created_date'];
            $details[$i]['updated_date'] = $row['updated_date'];
            $details[$i]['rating'] = $row['rating'];
            $details[$i]['assignee'] = ($row['assignee']) ? $this->EmpIdToUserName($row['assignee']) : $this->helper_model->IdToUserName($row['assignee']);
            $details[$i]['assignee_image'] = ($row['assignee'] != '') ? $this->getEmpUserImage($row['assignee']) : $this->getUserImage($row['assignee']);
            $details[$i]['replies'] = $this->getReplies($row['assignee']);
            $i++;
        }

        return $details;
    }

    /**
     * For getting all Employee name to ID
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_name
     * @return type
     */
    function EmpUserNameToId($user_name) {

        $employee_id = $this->db->select('employee_id')->get_where('employee_login', array('user_name' => $user_name))->row()->employee_id;

        if ($employee_id > 0) {
            return $employee_id;
        } else {
            return FALSE;
        }
    }

    /**
     * For getting ID to username
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function EmpIdToUserName($user_id) {
        $name = '';
        if ($user_id != '') {

            $query = $this->db->select('user_name')->from('employee_login')->where('employee_id', $user_id)->get();
            if ($query->num_rows() > 0) {
                $name = $query->row()->user_name;
            }
        }
        return $name;
    }

    /**
     * For change Assignee
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $ticket
     * @return type
     */
    function changeAssignee($user_id, $ticket) {
        $result = $this->db->set('assignee', $user_id)->where('ticket_id', $ticket)->update('ticket');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For update ticket status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status_id
     * @param type $ticket
     * @return type
     */
    function updateTicketStatus($status_id, $ticket, $user_id) {
        $result = $this->db->set('status', $status_id)->set('status_changed_by', $user_id)->set('updated_date', date('Y-m-d H:i:s'))->where('ticket_id', $ticket)->update('ticket');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For getting all open tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllOpenTickets($user_id = '') {
        $status_change_id = '';
        if ($user_id != '') {
            $status_change_id = $user_id;
            $result = $this->db->select('count(*) as cnt')->get_where('ticket', array('status' => 2, 'status_changed_by' => $status_change_id))->row()->cnt;
        } else {
            $result = $this->db->select('count(*) as cnt')->get_where('ticket', array('status' => 2))->row()->cnt;
        }

        return $result;
    }

    /**
     * For getting all open tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getAllOpenedTickets($id = '') {

        $result = $this->db->select('*')
                ->from('ticket')
                ->where('status', 2)
                ->get();

        $details = array();
        $i = 0;
        foreach ($result->result_array()as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['ticket_id'] = $row['ticket_id'];
            $details[$i]['title'] = $row['title'];
            $details[$i]['email'] = $row['mail'];
            $details[$i]['message'] = $row['content'];
            $details[$i]['subject'] = $row['subject'];
            $details[$i]['priority'] = $this->getPriorityName($row['priority']);
            $details[$i]['department'] = $this->getDepartmentName($row['department']);
            $details[$i]['status'] = $this->getStatusName($row['status']);
            $details[$i]['attched_file'] = $this->getAllAttachedFiles($row['attach_file']);
            $details[$i]['from_userid'] = $this->helper_model->IdToUserName($row['from_userid']);
            $details[$i]['user_image'] = $this->getUserImage($row['from_userid']);
            $i++;
        }

        return $details;
    }

    /**
     * For Resolved Tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getAllResolvedTickets($id = '') {

        $result = $this->db->select('*')
                ->from('ticket')
                ->where('status', 1)
                ->get();

        $details = array();
        $i = 0;
        foreach ($result->result_array()as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['ticket_id'] = $row['ticket_id'];
            $details[$i]['title'] = $row['title'];
            $details[$i]['email'] = $row['mail'];
            $details[$i]['message'] = $row['content'];
            $details[$i]['subject'] = $row['subject'];
            $details[$i]['priority'] = $this->getPriorityName($row['priority']);
            $details[$i]['department'] = $this->getDepartmentName($row['department']);
            $details[$i]['status'] = $this->getStatusName($row['status']);
            $details[$i]['attched_file'] = $this->getAllAttachedFiles($row['attach_file']);
            $details[$i]['from_userid'] = $this->helper_model->IdToUserName($row['from_userid']);
            $details[$i]['user_image'] = $this->getUserImage($row['from_userid']);
            $i++;
        }

        return $details;
    }

    /**
     * For getting Employee user image
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getEmpoyeeUserImage($id) {
        $image = $this->db->select('user_photo')->get_where('employee_details', array('employee_id', $id))->row()->user_photo;

        if ($image > 0) {
            return $image;
        }
        return false;
    }

    /**
     * For ticket ID to name
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $ticket_name
     * @return type
     */
    function ticketIdToName($ticket_name) {
        $ticket_id = $this->db->select('id')->get_where('ticket', array('ticket_id' => $ticket_name))->row()->id;

        if ($ticket_id > 0) {
            return $ticket_id;
        }
        return false;
    }

    /**
     * For update Replay Image
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @param type $file
     * @return type
     */
    function updateReplyImage($data, $file) {
        $ticket_id = $this->ticketIdToName($data['ticket_id']);
        $result = $this->db->set('message', $data['message'])
                ->set('user_id', $data['user_id'])
                ->set('ticket_id', $ticket_id)
                ->set('reply_attachement', serialize($file))
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('ticket_replies');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For InsertFaq
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return boolean
     */
    function insertFaq($data) {
        $result = $this->db->set('department_id', $data['department'])
                ->set('question', $data['question'])
                ->set('answer', $data['answer'])
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('ticket_faq');
        if ($result) {
            return TRUE;
        } else {
            $error = $this->db->error();

            return $error;
        }
    }

    /**
     * For update FAQ
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return boolean
     */
    function updateFaq($data) {

        $result = $this->db->set('department_id', $data['department'])
                ->set('question', $data['question'])
                ->set('answer', $data['answer'])
                ->set('date', date('Y-m-d H:i:s'))
                ->where('id', $data['id'])
                ->update('ticket_faq');
        if ($result) {
            return TRUE;
        } else {
            $error = $this->db->error();

            return $error;
        }
    }

    /**
     * For get all faq details we added
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllFaqDetails() {
        $result = $this->db->select('*')->from('ticket_faq')->get();
        $i = 0;
        $details = array();
        foreach ($result->result_array() as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['department_id'] = $this->getDepartmentName($row['department_id']);
            $details[$i]['question'] = $row['question'];
            $details[$i]['answer'] = $row['answer'];
            $details[$i]['date'] = $row['date'];
            $i++;
        }
        return $details;
    }

    /**
     * For getting Edited data
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getEditedFaqData($id) {
        $result = $this->db->select("*")->from('ticket_faq')->where('id', $id)->get();
        $data = array();
        foreach ($result->result() as $row) {
            $data['id'] = $row->id;
            $data['department_id'] = $row->department_id;
            $data['question'] = $row->question;
            $data['answer'] = $row->answer;
        }

        return $data;
    }

    /**
     * For change status
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function changeStatus($id, $status = 1) {
        $result = $this->db->set("status", $status)->where('id', $id)->update('ticket_faq');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For update ticket faq status
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function updateStatus($id) {
        $result = $this->db->set("status", 2)->where('id', $id)->update('ticket_faq');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * For getting all tickets month-wise
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllTikcetsMonthWise() {
        $start_and_end_dates = $details = array();
        $start_date = $date = $end_date = $startdate = $enddate = "";
        $year = date("Y");
        for ($i = 1; $i <= 12; $i++) {
            $date = date("Y-m-d", strtotime("$year-$i-01"));
            $start_date = date('Y-m-1', strtotime($date));
            $end_date = date('Y-m-t', strtotime($date));
            $startdate = $start_date . " 00:00:00";
            $enddate = $end_date . " 23:59:59";
            $open_count = $this->getAllOpenTicketsMonthWise($startdate, $enddate);
            $close_count = $this->getAllClosedTicketsMonthWise($startdate, $enddate);
            $details[$i]["count"] = "a:$open_count,b:$close_count";
            $details[$i]["month"] = $this->getAllMonths($i);
        }
        return $details;
    }

    /**
     * For getting all  months
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $month_number
     * @return string
     */
    function getAllMonths($month_number) {
        switch ($month_number) {
            case 1:
                $month = "Jan";
                break;
            case 2:
                $month = "Feb";
                break;
            case 3:
                $month = "Mar";
                break;
            case 4:
                $month = "Apr";
                break;
            case 5:
                $month = "May";
                break;
            case 6:
                $month = "Jun";
                break;
            case 7:
                $month = "Jul";
                break;
            case 8:
                $month = "Aug";
                break;
            case 9:
                $month = "Sep";
                break;
            case 10:
                $month = "Oct";
                break;
            case 11:
                $month = "Nov";
                break;
            case 12:
                $month = "Dec";
                break;
        }
        return $month;
    }

    /**
     * For getting all open tickets month wise
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $start_date
     * @param type $end_date
     * @return type
     */
    function getAllOpenTicketsMonthWise($start_date, $end_date) {

        $result = $this->db->select('count(status) as open_count,created_date')
                ->from('ticket')
                ->where("created_date BETWEEN '$start_date' AND '$end_date'")
                ->where('status', $this->dbvars->DEF_TICKET_TYPE)
                ->get();
        if ($result > 0) {
            return $result->row()->open_count;
        }
        return false;
    }

    /**
     * For getting all closed tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $start_date
     * @param type $end_date
     * @return type
     */
    function getAllClosedTicketsMonthWise($start_date, $end_date) {
        $result = $this->db->select('count(status) as close_count,created_date')
                ->from('ticket')
                ->where("created_date BETWEEN '$start_date' AND '$end_date'")
                ->where('status', 1)
                ->get();
        if ($result > 0) {
            return $result->row()->close_count;
        }
        return false;
    }

    /**
     * For getting all FAQ details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllFaqDettails() {
        $result = $this->db->select("tf.*,td.department_name")
                ->from('ticket_faq as tf')
                ->join('ticket_department as td', 'td.department_id=tf.department_id', 'left')
                ->where('tf.status', 1)
                ->get();
        $details = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            $index = $row['department_id'];
            $details[$index]["department_id"] = $row['department_id'];
            $details[$index]["department_name"] = $row['department_name'];
            $details[$index]["question"][$i] = $row['question'];
            $details[$index]["answer"][$i] = $row['answer'];
            $i++;
        }
        return $details;
    }

    /**
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countOfTicketList($user_id) {
        return $this->db->select('id')
                        ->from('ticket')
                        ->where('from_userid', $user_id)
                        ->count_all_results();
    }

    /**
     * For get column name for Tickets
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTableColumnTicketList() {
        return array(
            array('db' => "id", 'dt' => 0),
            array('db' => "ticket_id", 'dt' => 1),
            array('db' => "title", 'dt' => 2),
            array('db' => "mail", 'dt' => 3),
            array('db' => "subject", 'dt' => 4),
            array('db' => "priority", 'dt' => 5),
            array('db' => "from_userid", 'dt' => 6),
            array('db' => "status", 'dt' => 7),
            array('db' => "admin_reply_status", 'dt' => 8)
        );
    }

    /**
     *
     * for getting the filtered tickets details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @return type
     */
    function getTotalFilteredTicketList($table1, $table2, $where, $user_id) {
        if ($where) {
            $where = $where . " AND from_userid=$user_id AND ";
        } else {
            $where = " WHERE from_userid=$user_id AND ";
        }
        $query = $this->db->query("select t1.id,t1.ticket_id,t1.title,t1.mail,t1.subject,t1.priority,t2.user_name,t1.status,t1.admin_reply_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.from_userid = t2.mlm_user_id ");
        return $query->num_rows();
    }

    /**
     * For getting all details
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $user_id
     * @return type
     */
    function getResultDataTicketList($table1, $table2, $where, $order, $limit, $user_id) {
        $data = array();

        if ($where) {
            $where = $where . " AND from_userid=$user_id AND ";
        } else {
            $where = " WHERE from_userid=$user_id AND ";
        }
        $query = $this->db->query("select t1.id,t1.ticket_id,t1.title,t1.mail,t1.subject,t1.priority,t2.user_name,t1.status,t1.admin_reply_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t1.from_userid = t2.mlm_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the logged user email
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getLoggedUserEmail($user_id) {
        $query = $this->db->select('email')
                ->from('user')
                ->where('mlm_user_id', $user_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->row()->email;
        }
        return false;
    }

    public function getTicketDetails($user_id = '') {
        $data = array();
        $data['label0'] = lang('new');
        $data['label1'] = lang('open');
        $data['label2'] = lang('procesed');
        $data['label3'] = lang('completed');
        $data['value0'] = $this->getTicketCount('new');
        $data['value1'] = $this->getTicketCount('open');
        $data['value2'] = $this->getTicketCount('procesed');
        $data['value3'] = $this->getTicketCount('completed');
        return $data;
    }

    function getTicketCount($type = 'completed', $date = '') {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $this->db->select('count(id)')
                ->from('ticket');
        if ($date) {
            $this->db->like('created_date', $date);
        }
        if ($type == 'open') {
            $this->db->where('status', 2);
        } elseif ($type == 'completed') {
            $this->db->where('status', 1);
        } elseif ($type == 'new') {
            $this->db->where('status', $this->dbvars->DEF_TICKET_TYPE);
        } elseif ($type == 'procesed') {
            $this->db->where('status !=', 1);
            $this->db->where('status !=', 2);
            $this->db->where('status !=', $this->dbvars->DEF_TICKET_TYPE);
        } elseif ($type != 'all') {
            return 0;
        }

        if ($employee_id) {
            $this->db->where('assignee', $employee_id);
        }
        return $this->db->count_all_results();
    }

    public function getTicketRation() {
        $val = 0;
        $all = $this->getTicketCount('all');
        if ($all) {
            $val = ($this->getTicketCount('completed') * 100) / $all;
        }
        return round($val, 2);
    }

    function getTableColumnNewTickets() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'ticket_id', 'dt' => 2),
            array('db' => 'title', 'dt' => 3),
            array('db' => 'subject', 'dt' => 4),
            array('db' => 'content', 'dt' => 5),
            array('db' => 'created_date', 'dt' => 6)
        );
    }

    function countOfTotalNewTickets() {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $this->db->select('id')
                ->from('ticket')
                ->where('status', $this->dbvars->DEF_TICKET_TYPE);
        if ($employee_id) {
            $this->db->where('assignee', $employee_id);
        }
        return $this->db->count_all_results();
    }

    function getTotalDataLimit($request) {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }
        return $limit;
    }

    function getTotalFilteredTotalNewTickets($table1, $table2, $where) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $def_type = $this->dbvars->DEF_TICKET_TYPE;
        if ($where) {
            $where = $where . " AND t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid");

        return $query->num_rows();
    }

    function getNewTicketResultData($table1, $table2, $where, $order, $limit) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $data = array();
        $def_type = $this->dbvars->DEF_TICKET_TYPE;
        if ($where) {
            $where = $where . " AND t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }
        $query = $this->db->query("select t1.id,t2.user_name,t1.ticket_id,t1.title,t1.subject,t1.content,t1.created_date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getUserDpFromName($username) {
        $dp = '';
        if ($user_id = $this->helper_model->userNameToID($username)) {
            $dp = $this->db->select('user_dp')
                            ->from('user_details')
                            ->where('mlm_user_id', $user_id)
                            ->get()->row()->user_dp;
        }
        return $dp;
    }

    function getTableColumnFAQ() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'department_name', 'dt' => 1),
            array('db' => 'question', 'dt' => 2),
            array('db' => 'answer', 'dt' => 3),
            array('db' => 't1.date', 'dt' => 4),
            array('db' => 't1.status', 'dt' => 5)
        );
    }

    function countOfTotalFAQ() {
        return $this->db->select('id')
                        ->from('ticket_faq')
                        ->count_all_results();
    }

    function getTotalFilteredTotalFAQ($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t2.department_id = t1.department_id");

        return $query->num_rows();
    }

    function getFAQResultData($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND ";
        } else {
            $where = " WHERE ";
        }
        $query = $this->db->query("select t1.id,t2.department_name,t1.question,t1.answer,t1.date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . " t2.department_id = t1.department_id " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnTicketTypesList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'type_name', 'dt' => 1),
            array('db' => 'date', 'dt' => 2),
            array('db' => 'status', 'dt' => 3)
        );
    }

    function countOfTicketTypes() {
        return $this->db->select('id')
                        ->from("ticket_type")
                        ->count_all_results();
    }

    function getTotalFilteredTicketTypes($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    function getResultDataTicketTypes($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnTicketDepartmentList() {
        return array(
            array('db' => 'department_id', 'dt' => 0),
            array('db' => 'department_name', 'dt' => 1),
            array('db' => 'date', 'dt' => 2),
            array('db' => 'status', 'dt' => 3)
        );
    }

    function countOfTicketDepartment() {
        return $this->db->select('id')
                        ->from("ticket_department")
                        ->count_all_results();
    }

    function getTotalFilteredTicketDepartment($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    function getResultDataTicketDepartment($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnTicketPriorityList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => 'date', 'dt' => 2),
            array('db' => 'status', 'dt' => 3)
        );
    }

    function countOfTicketPriority() {
        return $this->db->select('id')
                        ->from("ticket_priority")
                        ->count_all_results();
    }

    function getTotalFilteredTicketPriority($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    function getResultDataTicketPriority($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnNewTicketList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'ticket_id', 'dt' => 2),
            array('db' => 'title', 'dt' => 3),
            array('db' => 'subject', 'dt' => 4),
            array('db' => 'content', 'dt' => 5),
            array('db' => 'created_date', 'dt' => 6),
            array('db' => 'status', 'dt' => 7),
            array('db' => 'user_reply_status', 'dt' => 8)
        );
    }

    function countOfTotalNewTicketList() {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $this->db->select('id')
                ->from('ticket')
                ->where('status', $this->dbvars->DEF_TICKET_TYPE);
        if ($employee_id) {
            $this->db->where('assignee', $employee_id);
        }
        return $this->db->count_all_results();
    }

    function getTotalFilteredTotalNewTicketList($table1, $table2, $where) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $def_type = $this->dbvars->DEF_TICKET_TYPE;
        if ($where) {
            $where = $where . " AND t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid");

        return $query->num_rows();
    }

    function getResultDataNewTicketList($table1, $table2, $where, $order, $limit) {
        $data = array();
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $def_type = $this->dbvars->DEF_TICKET_TYPE;
        if ($where) {
            $where = $where . " AND t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }
        $query = $this->db->query("select t1.id,t2.user_name,t1.ticket_id,t1.title,t1.subject,t1.content,t1.created_date,t1.status,t1.user_reply_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnOpenTicketList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'ticket_id', 'dt' => 2),
            array('db' => 'title', 'dt' => 3),
            array('db' => 'subject', 'dt' => 4),
            array('db' => 'content', 'dt' => 5),
            array('db' => 'created_date', 'dt' => 6),
            array('db' => 'status', 'dt' => 7),
            array('db' => 'user_reply_status', 'dt' => 8),
            array('db' => 'admin_reply_status', 'dt' => 9),
            array('db' => 'reopen_status', 'dt' => 10)
        );
    }

    function countOfTotalOpenTicketList() {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $this->db->select('id')
                ->from('ticket')
                ->where('status', 2);
        if ($employee_id) {
            $this->db->where('assignee', $employee_id);
        }
        return $this->db->count_all_results();
    }

    function getTotalFilteredTotalOpenTicketList($table1, $table2, $where) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        if ($where) {
            $where = $where . " AND t1.status = 2 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = 2 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid");

        return $query->num_rows();
    }

    function getResultDataOpenTicketList($table1, $table2, $where, $order, $limit) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status = 2 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = 2 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }
        $query = $this->db->query("select t1.id,t2.user_name,t1.ticket_id,t1.title,t1.subject,t1.content,t1.created_date,t1.status ,t1.user_reply_status,t1.admin_reply_status,t1.reopen_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnCompletedTicketList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'ticket_id', 'dt' => 2),
            array('db' => 'title', 'dt' => 3),
            array('db' => 'subject', 'dt' => 4),
            array('db' => 'content', 'dt' => 5),
            array('db' => 'created_date', 'dt' => 6),
            array('db' => 'status', 'dt' => 6),
        );
    }

    function countOfTotalCompletedTicketList() {

        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $this->db->select('id')
                ->from('ticket')
                ->where('status', 1);
        if ($employee_id) {
            $this->db->where('assignee', $employee_id);
        }
        return $this->db->count_all_results();
    }

    function getTotalFilteredTotalCompletedTicketList($table1, $table2, $where) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        if ($where) {
            $where = $where . " AND t1.status = 1 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = 1 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid");

        return $query->num_rows();
    }

    function getResultDataCompletedTicketList($table1, $table2, $where, $order, $limit) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status = 1 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status = 1 AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }
        $query = $this->db->query("select t1.id,t2.user_name,t1.ticket_id,t1.title,t1.subject,t1.content,t1.created_date,t1.status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnProcessingTicketList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'ticket_id', 'dt' => 2),
            array('db' => 'title', 'dt' => 3),
            array('db' => 'subject', 'dt' => 4),
            array('db' => 'content', 'dt' => 5),
            array('db' => 'created_date', 'dt' => 6),
            array('db' => 'status', 'dt' => 7),
            array('db' => 'user_reply_status', 'dt' => 8),
            array('db' => 'admin_reply_status', 'dt' => 9),
        );
    }

      function countOfTotalProcessingTicketList() {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
            $this->load->model('employee_model');
            $employee_allowcated_dep = implode(',', $this->employee_model->getAllEmployeeAllocatedDepartment($employee_id));
        }
        if ($employee_id > 0) {
            if (!empty($employee_allowcated_dep)) {
                $query = $this->db->query(" SELECT id FROM `mlm_ticket` WHERE `status` != 1 AND `status` !=2 AND `status` !=12 AND `department` IN($employee_allowcated_dep)  ");
            } else {
                $query = $this->db->query(" SELECT id FROM `mlm_ticket` WHERE `status` = 1 AND  `assignee` = $employee_id ");
            }

            return $query->num_rows();
        } else {
            $this->db->select('id')
                    ->from('ticket')
                    ->where('status !=', 1)
                    ->where('status !=', 2)
                    ->where('status !=', 12);
            return $this->db->count_all_results();
        }
    }

    function getTotalFilteredTotalProcessingTicketList($table1, $table2, $where) {
        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $def_type = $this->dbvars->DEF_TICKET_TYPE;
        if ($where) {
            $where = $where . " AND t1.status != 1 AND t1.status != 2 AND t1.status != $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status != 1 AND t1.status != 2 AND t1.status != $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid");

        return $query->num_rows();
    }

    function getResultDataProcessingTicketList($table1, $table2, $where, $order, $limit) {
        $data = array();

        $employee_id = 0;
        if ($this->aauth->getUserType() == 'employee') {
            $employee_id = $this->aauth->getId();
        }
        $def_type = $this->dbvars->DEF_TICKET_TYPE;
        if ($where) {
            $where = $where . " AND t1.status != 1 AND t1.status != 2 AND t1.status != $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        } else {
            $where = " WHERE t1.status != 1 AND t1.status != 2 AND t1.status != $def_type AND ";
            if ($employee_id) {
                $where = $where . " t1.assignee = $employee_id AND ";
            }
        }
        $query = $this->db->query("select t1.id,t2.user_name,t1.ticket_id,t1.title,t1.subject,t1.content,t1.created_date,t1.status, t1.user_reply_status,t1.admin_reply_status from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t2.mlm_user_id = t1.from_userid " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function openTicket($id) {
        $this->db->set('status', 2)
                ->where('id', $id)
                ->where('status', $this->dbvars->DEF_TICKET_TYPE)
                ->update('ticket');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function deleteTicket($id) {
        $this->db->where('id', $id)
                ->where('status', $this->dbvars->DEF_TICKET_TYPE)
                ->delete('ticket');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting all priority
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function insertTicketPriority($type_arr) {
        $result = $this->db->set('name', $type_arr['priority_name'])->set('status', 1)->set('date', date('Y-m-d H:i:s'))->insert('ticket_priority');
        if ($result) {
            return TRUE;
        } else {
            $error = $this->db->error();
            return $error;
        }
    }

    /**
     * For getting the tagWisePercntage
     * @author Techffodils Technologies LLP
     * @copyright (c) 2019,Technologies Technologies LLP
     *
     * */
    function getTagWiseTicket() {
        $data = [];
        $result = $this->db->select('department_id,department_name')
                ->from('ticket_department')
                ->where('status', 1)
                ->get();
        if ($result->num_rows() > 0) {
            $i = 0;
            foreach ($result->result_array() as $row) {
                $res = $this->db->select('count(id) as cnt')
                        ->from('ticket')
                        ->where('department', $row['department_id'])
                        ->get();
                if ($res->num_rows() > 0) {
                    $pertage = 100;
                    $per = ($res->row()->cnt * $pertage) / 100;
                    if ($per <= $pertage) {
                        $data[$i]['per'] = $per;
                        $data[$i]['department_name'] = $row['department_name'];
                    }
                }
                $i++;
            }
        }
        return $data;
    }

    /**
     * For Recent Ticket Details
     * @author Techffodils Technologies LLP
     *
     * */
    function getRecentTicket() {
        $result = $this->db->select('count(id) as cnt')
                ->from('ticket')
                ->or_where('created_date', date("Y-m-d H:i:s"))
                ->get();
        $res_data = '';
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $res_data = $result->row()->cnt;
            }
        }
        return $res_data;
    }

    /**
     * For getting the StatusWisePercntage
     * @author Techffodils Technologies LLP
     * @copyright (c) 2019,Technologies Technologies LLP
     *
     * */
    function getStatusWiseTicket() {
        $data = [];
        $result = $this->db->select('id,type_name')
                ->from('ticket_type')
                ->where('status', 1)
                ->get();
        if ($result->num_rows() > 0) {
            $i = 0;
            foreach ($result->result_array() as $row) {
                $res = $this->db->select('count(id) as cnt')
                        ->from('ticket')
                        ->where('status', $row['id'])
                        ->get();
                if ($res->num_rows() > 0) {
                    $pertage = 100;
                    $per = ($res->row()->cnt * $pertage) / 100;
                    if ($per <= $pertage) {
                        $data[$i]['per'] = $per;
                        $data[$i]['type_name'] = $row['type_name'];
                    }
                }
                $i++;
            }
        }
        return $data;
    }

    /**
     * For getting all types
     *
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAlltypes() {
        $details = array();
        $result = $this->db->select("id,type_name,status,date")
                ->from('ticket_type')
                ->where('status', 1)
                ->get();
        $i = 0;
        foreach ($result->result_array() as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['type_name'] = $row['type_name'];
            $details[$i]['status'] = $row['status'];
            $details[$i]['date'] = $row['date'];
            $i++;
        }
        return $details;
    }

    function getAllTypeName() {
        $data = array();
        $query = $this->db->select("id,type_name")
                ->from("ticket_type")
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['type_name'] = lang($row['type_name']);
            $data[$i]['id'] = $row['id'];
            $i++;
        }
        return $data;
    }

    function getAttachedFile($ticket_id) {
        $data = [];
        $res = $this->db->select("*")
                ->from('ticket')
                ->where('ticket_id', $ticket_id)
                ->get();
        if ($res->num_rows() > 0) {
            $res = $this->db->select("attach_file")
                    ->from('ticket')
                    ->where('ticket_id', $ticket_id)
                    ->get();
            if ($res->num_rows() > 0) {
                $data = $this->getAllAttachedFiles($res->row()->attach_file);
            }
        }

        return $data;
    }

    function checkTicketExist($ticket_id) {
        $flag = 0;
        $res = $this->db->select("*")
                ->from('ticket')
                ->where('ticket_id', $ticket_id)
                ->get();
        if ($res->num_rows() > 0) {
            $flag = 1;
        }

        return $flag;
    }

    function getFromUserIdFromTicketId($ticket_id) {
        $from_id = '';
        $query = $this->db->select('from_userid')
                ->from('ticket')
                ->where('ticket_id', $ticket_id)
                ->get();
        if ($query->num_rows() > 0) {
            $from_id = $query->row()->from_userid;
        }
        return $from_id;
    }

    function getTicketStatus($ticket_id) {
        $name = '';
        $query = $this->db->select('status')
                ->from('ticket')
                ->where('ticket_id', $ticket_id)
                ->get();
        if ($query->num_rows() > 0) {
            $name = $query->row()->status;
        }
        return $name;
    }

    function updateReplyStatus($status_id, $ticket, $user_type) {

        $filed = 'admin_reply_status';

        $result = $this->db->set($filed, $status_id)
                ->set('user_reply_status', 0)
                ->where('ticket_id', $ticket)
                ->update('ticket');

        return $result;
    }
    
    function updateReplyStatusUserSide($status_id, $ticket) {
        $result = $this->db->set('user_reply_status', $status_id)
                ->set('admin_reply_status', 0)
                ->set('updated_date', date('Y-m-d H:i:s'))
                ->where('ticket_id', $ticket)
                ->update('ticket');
        return $result;
    }

}
