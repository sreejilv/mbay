<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 * For kyc related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    kyc
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Kyc_model extends CI_Model {

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function insertKycDetails($data_arr) {
        $this->db->trans_start();
        $post_arr = array(
            'bank_proof' => $data_arr['bank_proof'],
            'id_proof' => $data_arr['id_proof'],
            'to_user_id' => $data_arr['user_id'],
            'created_user_id' => isset($data_arr['created_user_id']) ? $data_arr['created_user_id'] : $data_arr['user_id'],
        );
        $result = $this->db->insert('kyc_details', $post_arr);
        if ($result) {
            $this->helper_model->insertActivity($data_arr['user_id'], 'upload_Kyc_details', serialize($data_arr));
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function checkUserAlreadyUploadedOrNot($user_id) {
        $result = $this->db->select('count(*)')
                ->from('kyc_details')
                ->where('to_user_id', $user_id)
                ->count_all_results();
        if ($result > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getKycDetails($user_id = 0) {
        $this->db->select("kyc_details.id,kyc_details.created_user_id,user.user_name,user.email,user.date,kyc_details.created_date");
        $this->db->from('kyc_details');
        $this->db->join('user', 'kyc_details.created_user_id=user.mlm_user_id');
        if ($user_id) {
            $this->db->where('user.mlm_user_id', $user_id);
        }
        $query = $this->db->get();
        $i = 0;
        $data = [];
        foreach ($query->result_array() as $row) {
            $data[$i]['user_name'] = $row['user_name'];
            $data[$i]['user_id'] = $row['created_user_id'];
            $data[$i]['email'] = $row['email'];
            $data[$i]['date'] = $row['created_date'];
            $data[$i]['id'] = $row['id'];
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getAllKycDetails($user_name = '', $email = '') {
        $this->db->select("kyc_details.id,kyc_details.created_user_id,user.user_name,user.email,user.date,kyc_details.created_date");
        $this->db->from('kyc_details');
        if ($user_name != '' || $email != '') {
            $this->db->like('user.user_name', $user_name)->$this->db->or_where('user.email =', $email);
        }
        $this->db->join('user', 'kyc_details.created_user_id=user.mlm_user_id');
        $query = $this->db->get();
        $i = 0;
        $data = [];
        foreach ($query->result_array() as $row) {
            $data['user_name'] = $row['user_name'];
            $data['user_id'] = $row['created_user_id'];
            $data['email'] = $row['email'];
            $data['date'] = $row['created_date'];
            $data['id'] = $row['id'];
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function gettingUserWiseKycDetails($user_id, $type = '') {
        $query = $this->db->select('*')
                ->from('kyc_details')
                ->where('id', $user_id)
                ->get();
        $data = $bank_status = $id_proof_status = '';
        foreach ($query->result_array() as $row) {
            $bank_status = $row['bank_proof_status'];
            $id_proof_status = $row['id_proof_status'];
            $data .= '<div class="row">';
            $data .= '<input type="hidden" name="user_id" id="user_id" value="' . $row['created_user_id'] . '">';
            $data .= '<div class="col-md-6 pull-left">';


            $data .= '<div class="form-group">';
            $data .= '<label class="control-label">' . lang('bank_details') . ':</label>';
            $data .= '<div class="input-group">';
            $data .= '<img width="150" height="150" src="' . BASE_PATH . 'assets/images/bank_details/' . $row['bank_proof'] . '"/>';
            $data .= '<p>' . date('F-d-Y', strtotime($row['created_date'])) . '</p>';
            $data .= '</div>';
            $data .= '</div>';
            $data .= '<div class="form-group">';
            $data .= '<div class="input-group">';
            $flag = 'none';
            if ($type != 'admin') {


                if ($bank_status == 'accept') {
                    $data .= '<input type="hidden" name="bank_proof_status"   id="bank_accept" value="accept" onclick="setIdProofAccept(' . $row['created_user_id'] . ', 1)" > <span style="color:green" class="fa fa-check">  ' . lang('accepted') . '</span>&nbsp;&nbsp;';
                } elseif ($bank_status == 'reject') {
                    $flag = 'block';
                    $data .= '<input type="hidden" name="bank_proof_status"  id="bank_reject" value="reject" onclick="setIdProofReject(' . $row['created_user_id'] . ', 1)"  > <span style="color:red" class="fa fa-trash">  ' . lang('rejected') . '</span>';
                } else {
                    
                }
            } else {
                if ($bank_status == 'accept') {
                    $data .= '<input type="hidden" name="bank_proof_status"   id="bank_accept" value="accept" onclick="setIdProofAccept(' . $row['created_user_id'] . ', 1)" > <span style="color:green" class="fa fa-check">  ' . lang('accepted') . '</span>&nbsp;&nbsp;';
                    $data .= '<input type="radio" name="bank_proof_status"  id="bank_reject" value="reject" onclick="setIdProofReject(' . $row['created_user_id'] . ', 1)"  > ' . lang('reject') . '';
                } elseif ($bank_status == 'reject') {
                    $flag = 'block';
                    $data .= '<input type="radio" name="bank_proof_status"   id="bank_accept" value="accept" onclick="setIdProofAccept(' . $row['created_user_id'] . ', 1)" > ' . lang('accept') . '</span>&nbsp;&nbsp;';
                    $data .= '<input type="hidden" name="bank_proof_status"  id="bank_reject" value="reject" onclick="setIdProofReject(' . $row['created_user_id'] . ', 1)"  > <span style="color:red" class="fa fa-trash">  ' . lang('rejected') . '</span>';
                } else {
                    $data .= '<input type="radio" name="bank_proof_status"   id="bank_accept" value="accept" onclick="setIdProofAccept(' . $row['created_user_id'] . ', 1)" > ' . lang('accept') . '&nbsp;&nbsp';
                    $data .= '<input type="radio" name="bank_proof_status"  id="bank_reject" value="reject" onclick="setIdProofReject(' . $row['created_user_id'] . ', 1)"  > ' . lang('reject') . '';
                }
            }

            $data .= '</div>';
            $data .= '</div>';

            $data .= '<div class="form-group" id="bank_reject_div" style="display:' . $flag . ';
            ">';
            $data .= '<div class="input-group">';

            $data .= '<textarea type="text" rows="4" cols="50" name="bank_reason" id="bank_reason">' . $row['bank_proof_cancel_reason'] . '</textarea>';

            $data .= '</div>';
            $data .= '</div>';

            $data .= '</div>';

            $data .= '<div class="col-md-6">';


            $data .= '<div class="form-group">';
            $data .= '<label class="control-label">' . lang('id_proof') . ':</label>';
            $data .= '<div class = "input-group">';
            $data .= '<img width = "150" height = "150" src = "' . BASE_PATH . 'assets/images/id_proof/' . $row['id_proof'] . '">';
            $data .= '<p>' . date('F-d-Y', strtotime($row['created_date'])) . '</p>';
            $data .= '</div>';
            $data .= '</div>';

            $data .= '<div class = "form-group">';
            $data .= '<div class = "input-group">';
            $status = 'none';
            if ($type != 'admin') {
                if ($id_proof_status == 'accept') {
                    $data .= '<input type = "hidden" name = "id_proof_status"  id = "id_accept" value = "accept" onclick = "setIdProofAccept(' . $row['created_user_id'] . ',2)" ><span style="color:green" class="fa fa-check"> ' . lang('accepted') . '</span>&nbsp;&nbsp;';
                } else if ($id_proof_status == 'reject') {
                    $status = 'block';

                    $data .= '<input type = "hidden"  name = "id_proof_status"  id = "id_reject" value = "reject" onclick = "setIdProofReject(' . $row['created_user_id'] . ',2)" ><span style="color:red" class="fa fa-trash">  ' . lang('rejected') . '</span>';
                } else {
                    
                }
            } else {
                if ($id_proof_status == 'accept') {
                    $data .= '<input type = "hidden" name = "id_proof_status"  id = "id_accept" value = "accept" onclick = "setIdProofAccept(' . $row['created_user_id'] . ',2)" ><span style="color:green" class="fa fa-check"> ' . lang('accepted') . '</span>&nbsp;&nbsp;';
                    $data .= '<input type = "radio"  name = "id_proof_status"  id = "id_reject" value = "reject" onclick = "setIdProofReject(' . $row['created_user_id'] . ',2)" > ' . lang('reject') . '';
                } else if ($id_proof_status == 'reject') {
                    $status = 'block';
                    $data .= '<input type = "radio" name = "id_proof_status"  id = "id_accept" value = "accept" onclick = "setIdProofAccept(' . $row['created_user_id'] . ',2)" > ' . lang('accept') . '</span>&nbsp;&nbsp;';
                    $data .= '<input type = "hidden"  name = "id_proof_status"  id = "id_reject" value = "reject" onclick = "setIdProofReject(' . $row['created_user_id'] . ',2)" ><span style="color:red" class="fa fa-trash">  ' . lang('rejected') . '</span>';
                } else {
                    $data .= '<input type = "radio"  name = "id_proof_status"  id = "id_accept" value = "accept" onclick = "setIdProofAccept(' . $row['created_user_id'] . ',2)" >' . lang('accept') . '</span>&nbsp;&nbsp;';
                    $data .= '<input type = "radio" name = "id_proof_status"  id = "id_reject" value = "reject" onclick = "setIdProofReject(' . $row['created_user_id'] . ',2)" > ' . lang('reject') . '';
                }
            }
            $data .= '</div>';
            $data .= '</div>';

            $data .= '<div class = "form-group" id = "id_reject_div" style = "display:' . $status . ';">';
            $data .= '<div class = "input-group">';

            $data .= '<textarea type = "text" rows = "4" cols = "50" name = "id_reason" id = "id_reason" >' . $row['id_proof_cancel_reason'] . '</textarea>';

            $data .= '</div>';
            $data .= '</div>';

            $data .= '</div>';
            $data .= '</div>';
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function gettingUserKycDetails($user_id, $type = '') {
        $query = $this->db->select('*')
                ->from('kyc_details')
                ->where('created_user_id', $user_id)
                ->get();

        $data = [];
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data['id'] = $row['id'];
            $data['bank_proof'] = BASE_PATH . 'assets/images/bank_details/' . $row['bank_proof'];
            $data['id_proof'] = BASE_PATH . 'assets/images/id_proof/' . $row['id_proof'];
            $data['created_user_id'] = $this->helper_model->IdToUserName($row['created_user_id']);
            $data['id_proof_status'] = $row['id_proof_status'];
            $data['bank_proof_status'] = $row['bank_proof_status'];
            $data['id_proof_cancel_reason'] = $row['id_proof_cancel_reason'];
            $data['bank_proof_cancel_reason'] = $row['bank_proof_cancel_reason'];
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $row['created_date']);
            $data['created_date'] = $date->diffForHumans();
            $i++;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function isUserExits($user_id) {
        $flag = false;
        $result = $this->db->select("count(*) ")
                ->from("kyc_details")
                ->where('created_user_id', $user_id)
                ->count_all_results();
        if ($result > 0) {
            $flag = true;
        }
        return $flag;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateKycStatus($userid, $status, $type) {
        $result = $this->db->set($type . '_proof_status', $status)->where('created_user_id', $userid)->update('kyc_details');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateRejectKycDetails($userid, $status, $type, $data) {
        $result = $this->db->set($type . '_proof_status', $status)->set($type . '_proof_cancel_reason', $data)->where('created_user_id', $userid)->update('kyc_details');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getEditedUserKycDetails($user_id) {
        $details = $this->db->select('*')
                ->from('kyc_details')
                ->where('id', $user_id)
                ->get();
        $data = array();
        foreach ($details->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateKycDetails($data_arr) {
        $this->db->trans_start();

        $data = array(
            'bank_proof' => $data_arr['bank_proof'],
            'id_proof' => $data_arr['id_proof'],
            'created_user_id' => $data_arr['created_user_id'],
            'to_user_id' => isset($data_arr['created_user_id']) ? $data_arr['created_user_id'] : FALSE,
        );
        $result = $this->db->where('id', $data_arr['id'])->update('kyc_details', $data);

        if ($result) {
            $this->helper_model->insertActivity($data_arr['user_id'], 'update_Kyc_details', serialize($data));
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateIdProof($post_arr) {
        $this->db->set('id_proof', $post_arr['id_proof'])
                ->set('created_date', date('Y-m-d H:i:s'))
                ->set('id_proof_status', 'pending')
                ->where('created_user_id', $post_arr['user_id'])
                ->update('kyc_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function updateAddressProof($post_arr) {
        $this->db->set('bank_proof', $post_arr['bank_proof'])
                ->set('created_date', date('Y-m-d H:i:s'))
                ->set('bank_proof_status', 'pending')
                ->where('created_user_id', $post_arr['user_id'])
                ->update('kyc_details');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfKyc($user_id = '') {
        $this->db->select('id');
        if ($user_id) {
            $this->db->where('created_user_id', $user_id);
        }
        $this->db->from("kyc_details");
        return $this->db->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnKyc() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'email', 'dt' => 2),
            array('db' => 'created_date', 'dt' => 3),
            array('db' => 'created_user_id', 'dt' => 4),
        );
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredKyc($table1, $table2, $where, $user_id = '') {
        if ($user_id) {
            if ($where) {
                $where = $where . " AND t2.created_user_id =  $user_id AND ";
            } else {
                $where = " WHERE t2.created_user_id =  $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND ";
            } else {
                $where = " WHERE ";
            }
        }

        $query = $this->db->query("select t2.id,t1.user_name,t1.email,t2.created_date,t2.created_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.created_user_id ");
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataKyc($table1, $table2, $where, $order, $limit, $user_id = '') {
        $data = array();
        if ($user_id) {
            if ($where) {
                $where = $where . " AND t2.created_user_id =  $user_id AND ";
            } else {
                $where = " WHERE t2.created_user_id =  $user_id AND ";
            }
        } else {
            if ($where) {
                $where = $where . " AND ";
            } else {
                $where = " WHERE ";
            }
        }
        $query = $this->db->query("select t2.id,t1.user_name,t1.email,t2.created_date,t2.created_user_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.created_user_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getKycStatus($user_id, $type) {
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', $type);
        $this->db->where('status !=', 'rejected');
        $this->db->from("user_kyc");
        return $this->db->count_all_results();
    }

    function insertUserKyc($user_id, $type, $data, $status = 'pending') {
        $this->db->set('file', $data['upload_data']['file_name'])
                ->set('user_id', $user_id)
                ->set('type', $type)
                ->set('status', $status)
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('user_kyc');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getTableColumnKycDetails() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't3.first_name', 'dt' => 2),
            array('db' => 't2.email', 'dt' => 3),
            array('db' => 't1.file', 'dt' => 4),
            array('db' => 't1.date', 'dt' => 5),
            array('db' => 't1.status', 'dt' => 6),
            array('db' => 't1.reason', 'dt' => 7)
        );
    }

    function countOfKycDetails($table1, $table2, $table3, $user_id, $proof) {
        if ($user_id == '') {
            $where = " WHERE t1.type='$proof' ";
        }
        if ($user_id) {
            $where = " WHERE t1.type='$proof' AND t1.user_id = $user_id ";
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id INNER JOIN " . $table3 . " AS t3 ON t1.user_id = t3.mlm_user_id " . $where . "");

        return $query->num_rows();
    }

    function getTotalFilteredKycDetails($table1, $table2, $table3, $where, $user_id, $proof) {
        if ($where) {

            if ($user_id == '') {
                $where = " AND t1.type='$proof' ";
            }
            if ($user_id) {
                $where = " AND t1.type='$proof' AND t1.user_id = $user_id ";
            }
        } else {
            if ($user_id == '') {
                $where = " WHERE t1.type='$proof' ";
            }
            if ($user_id) {
                $where = " WHERE t1.type='$proof' AND t1.user_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id INNER JOIN " . $table3 . " AS t3 ON t1.user_id = t3.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataKycDetails($table1, $table2, $table3, $where, $order, $limit, $user_id, $proof) {
        $data = array();


        if ($where) {

            if ($user_id == '') {
                $where = " AND t1.type='$proof' ";
            }
            if ($user_id) {
                $where = " AND t1.type='$proof' AND t1.user_id = $user_id ";
            }
        } else {
            if ($user_id == '') {
                $where = " WHERE t1.type='$proof' ";
            }
            if ($user_id) {
                $where = " WHERE t1.type='$proof' AND t1.user_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.id,t2.user_name,t3.first_name,t2.email,t1.file,t1.date,t1.status,t1.reason from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id  INNER JOIN " . $table3 . " AS t3 ON t1.user_id = t3.mlm_user_id " . $where . " " . $order . " " . $limit . "");


        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getTableColumnKycDetailsUser() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'file', 'dt' => 1),
            array('db' => 'date', 'dt' => 2),
            array('db' => 'status', 'dt' => 3),
            array('db' => 'reason', 'dt' => 4)
        );
    }

    function countOfKycDetailsUser($table1, $user_id, $proof) {
        if ($user_id == '') {
                $where = " WHERE type='$proof' ";
            }
            if ($user_id) {
                $where = " WHERE type='$proof' AND user_id = $user_id ";
            }

        $query = $this->db->query("select id from " . $table1 . "  " . $where . "");

        return $query->num_rows();
    }

    function getTotalFilteredKycDetailsUser($table1, $where, $user_id, $proof) {
        if ($where) {

            if ($user_id == '') {
                $where = " AND type='$proof' ";
            }
            if ($user_id) {
                $where = " AND type='$proof' AND user_id = $user_id ";
            }
        } else {
            if ($user_id == '') {
                $where = " WHERE type='$proof' ";
            }
            if ($user_id) {
                $where = " WHERE type='$proof' AND user_id = $user_id ";
            }
        }

        $query = $this->db->query("select id from " . $table1 . "  " . $where . " ");
        return $query->num_rows();
    }

    function getResultDataKycDetailsUser($table1, $where, $order, $limit, $user_id, $proof) {
        $data = array();


        if ($where) {

            if ($user_id == '') {
                $where = " AND type='$proof' ";
            }
            if ($user_id) {
                $where = " AND type='$proof' AND user_id = $user_id ";
            }
        } else {
            if ($user_id == '') {
                $where = " WHERE type='$proof' ";
            }
            if ($user_id) {
                $where = " WHERE type='$proof' AND user_id = $user_id ";
            }
        }

        $query = $this->db->query("select id,file,date,status,reason from " . $table1 . "  " . $where . " " . $order . " " . $limit . "");


        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    
    function setUserKycStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('user_kyc');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function updateRejectReason($id, $reason) {
        $this->db->set('reason', $reason)
                ->where('id', $id)
                ->update('user_kyc');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
