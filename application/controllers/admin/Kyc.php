<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * controller for add Kyc details for admin and verifying when the user added kyc details
 * Know Your Customer
 * @author Techffodils Technologies LLP
 * $data 2017-12-4
 * @day Monday
 */
class Kyc extends Core_Base_Controller {

    /**
     * For Add Know-your-customer(KYC) details
     * @author Techffodils Technologies LLP
     * @date 2017-12-04
     * @day Monday
     */
    function add($action = '', $kyc_id = '') {
        $logged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($this->input->post('search_member')) {
            $user = $this->helper_model->userNameToID($this->input->post('username'));
            if ($user) {
                $this->session->set_userdata('kyc_user', $user);
                $this->loadPage('', 'user-kyc');
            }
        }
        if ($action == 'all') {
            $this->session->unset_userdata('kyc_user');
            $this->loadPage('', 'user-kyc');
        } elseif ($action && $kyc_id) {
            if ($action == 'reject') {
                $res = $this->kyc_model->setUserKycStatus($kyc_id, 'rejected');
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'kyc_rejected');
                    $this->loadPage(lang('user_kyc_rejected'), 'user-kyc');
                } else {
                    $this->loadPage(lang('user_kyc_rejection_failed'), 'user-kyc', 'danger');
                }
            } elseif ($action == 'accept') {
                $res = $this->kyc_model->setUserKycStatus($kyc_id, 'accepted');
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'kyc_accepted');
                    $this->loadPage(lang('user_kyc_accepted'), 'user-kyc');
                } else {
                    $this->loadPage(lang('user_kyc_accepted_failed'), 'user-kyc', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_action'), 'user-kyc', 'danger');
            }
        }
        $kyc_user = 0;
        if (!empty($this->session->userdata('kyc_user'))) {
            $kyc_user = $this->session->userdata('kyc_user');
        }

        if ($this->input->post('address_submit')) {
            $this->session->set_userdata('kyc_tab', 1);
            $config['upload_path'] = FCPATH . 'assets/images/kyc/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'address_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('address_kyc')) {
                $error = array('error' => $this->upload->display_errors());
                $this->loadPage(lang('address_proof_updation_failed'), 'user-kyc', 'danger');
            } else {
                $data_upload = $this->upload->data();
                $data = array('upload_data' => $data_upload);
                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($data_upload['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $data_upload['full_path'],
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
                $this->kyc_model->insertUserKyc($kyc_user, 'address_proof', $data, 'accepted');
                $data['user_id'] = $kyc_user;
                $this->helper_model->insertActivity($logged_user_id, 'kyc_added', $data);
                $this->loadPage(lang('address_proof_updated'), 'user-kyc');
            }
        }

        if ($this->input->post('identity_submit')) {
            $this->session->set_userdata('kyc_tab', 2);
            $config['upload_path'] = FCPATH . 'assets/images/kyc/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'identity_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('identity_kyc')) {
                $error = array('error' => $this->upload->display_errors());
                $this->loadPage(lang('identity_proof_updation_failed'), 'user-kyc', 'danger');
            } else {
                $data_upload = $this->upload->data();
                $data = array('upload_data' => $data_upload);
                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($data_upload['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $data_upload['full_path'],
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
                $this->kyc_model->insertUserKyc($kyc_user, 'identity_proof', $data, 'accepted');
                $data['user_id'] = $kyc_user;
                $this->helper_model->insertActivity($logged_user_id, 'kyc_added', $data);
                $this->loadPage(lang('identity_proof_updated'), 'user-kyc');
            }
        }



        $this->setData('address_flag', $this->kyc_model->getKycStatus($kyc_user, 'address_proof'));
        $this->setData('identity_flag', $this->kyc_model->getKycStatus($kyc_user, 'identity_proof'));
        $this->setData('kyc_user', $kyc_user);
        $this->setData('username', $this->helper_model->IdToUserName($kyc_user));
        $this->setData('kyc_tab', $this->session->userdata('kyc_tab'));
        $this->setData('title', lang('menu_name_97'));
        $this->loadView();
    }

    /**
     * For Add Know-your-customer(KYC) details
     * @author Techffodils Technologies LLP
     * @date 2017-12-04
     * @day Monday
     */

    /**
     * @author Techffodils Technologies LLP
     * @date 2017-10-27
     * @return boolean
     */
    function user_name_exists() {
        $flag = false;

        $status = $this->helper_model->isUserExist($this->input->post('user_name'));

        if ($status) {
            $flag = true;
        } else {
            $this->form_validation->set_message('user_name_exists', lang('user_name_doest_exits'));
        }
        return $flag;
    }

    function kyc_list_address() {

        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user_kyc';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table3 = DB_PREFIX_SYSTEM . 'user_details';
        $kyc_user = $this->session->userdata('kyc_user');
        $limit = $order = $where = '';
        $column = $this->kyc_model->getTableColumnKycDetails();
        $total_records = $this->kyc_model->countOfKycDetails($table1, $table2, $table3, $kyc_user, 'address_proof');
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->kyc_model->getTotalFilteredKycDetails($table1, $table2, $table3, $where, $kyc_user, 'address_proof');
        $res_data = $this->kyc_model->getResultDataKycDetails($table1, $table2, $table3, $where, $order, $limit, $kyc_user, 'address_proof');
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][7];
            $res_data[$i][4] = '<a href="assets/images/kyc/' . $res_data[$i][4] . '" target="_BLANK"><img src="assets/images/kyc/' . $res_data[$i][4] . '" alt="offce" width="50px;" height="auto"></a>';
            if ($res_data[$i][6] == 'pending') {
                $res_data[$i][6] = '<a href="javascript:kyc_accept(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('accept') . '><i class="fa fa-check"></i></a> <a href="javascript:kyc_reject(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('reject') . '><i class="fa fa-ban" aria-hidden="true"></i>
</a>';
            } elseif ($res_data[$i][6] == 'rejected') {
                $res_data[$i][6] = '<textarea class="torned_status" id="reject_' . $res_data[$i][0] . '" name="reject_' . $res_data[$i][0] . '" placeholder="' . lang('reason_for_reject') . '" onblur="change_reason(' . $res_data[$i][0] . ')">' . lang($res_data[$i][7]) . '</textarea> ';
            } else {
                $res_data[$i][6] = ' <a  class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('accepted') . '"><i class="fa fa-check"></i> ' . lang('accepted') . '</a>';
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

    function kyc_list_identity() {

        $request = $this->input->get();
        $table1 = DB_PREFIX_SYSTEM . 'user_kyc';
        $table2 = DB_PREFIX_SYSTEM . 'user';
        $table3 = DB_PREFIX_SYSTEM . 'user_details';
        $kyc_user = $this->session->userdata('kyc_user');
        $limit = $order = $where = '';
        $column = $this->kyc_model->getTableColumnKycDetails();
        $total_records = $this->kyc_model->countOfKycDetails($table1, $table2, $table3, $kyc_user, 'identity_proof');
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);
        $record_filtered = $this->kyc_model->getTotalFilteredKycDetails($table1, $table2, $table3, $where, $kyc_user, 'identity_proof');
        $res_data = $this->kyc_model->getResultDataKycDetails($table1, $table2, $table3, $where, $order, $limit, $kyc_user, 'identity_proof');
        $count_pin_active = count($res_data);
        for ($i = 0; $i < $count_pin_active; $i++) {
            $res_data[$i][2] = $res_data[$i][2] . ' ' . $res_data[$i][7];
            $res_data[$i][4] = '<a href="assets/images/kyc/' . $res_data[$i][4] . '" target="_BLANK"><img src="assets/images/kyc/' . $res_data[$i][4] . '" alt="offce" width="50px;" height="auto"></a>';
            if ($res_data[$i][6] == 'pending') {
                $res_data[$i][6] = '<a href="javascript:kyc_accept(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('accept') . '><i class="fa fa-check"></i></a> <a href="javascript:kyc_reject(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('reject') . '><i class="fa fa-ban" aria-hidden="true"></i>
</a>';
            } elseif ($res_data[$i][6] == 'rejected') {
                $res_data[$i][6] = '<textarea class="torned_status" id="reject_' . $res_data[$i][0] . '" name="reject_' . $res_data[$i][0] . '" placeholder="' . lang('reason_for_reject') . '" onblur="change_reason(' . $res_data[$i][0] . ')">' . lang($res_data[$i][7]) . '</textarea> ';
            } else {
                $res_data[$i][6] = ' <a  class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('accepted') . '"><i class="fa fa-check"></i> ' . lang('accepted') . '</a>';
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

    function change_reject_reason() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['id'] && $post['reason']) {
            $res = $this->kyc_model->updateRejectReason($post['id'], $post['reason']);
            if ($res) {
                echo 'yes';
                exit;
            }
        }
        echo 'no';
        exit;
    }

}
