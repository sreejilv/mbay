<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * For Rank related option where done here 
 * @author Techffodils Technologies LLP
 * @date 2017-12-12
 */
class Rank extends Base_Controller {

    /**
     * For rank setting like add,edit,delete are under the function 
     * @param type $action
     * @param type $id
     */
    public function rank_setting($action = '', $id = '') {
        $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $rank_details = array();
        $edit_flag = FALSE;
        if ($action && $id) {
            $activity['action'] = $action;
            $activity['id'] = $id;
            if ($action == "activate") {
                $res = $this->rank_model->changeRankStatus($id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($log_user_id, 'rank_activate', $activity);
                    $this->loadPage(lang('rank_activated'), 'title-settings');
                } else {
                    $this->loadPage(lang('rank_activated_failed'), 'title-settings', 'danger');
                }
            } elseif ($action == "inactivate") {
                $res = $this->rank_model->changeRankStatus($id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($log_user_id, 'rank_inactivate', $activity);
                    $this->loadPage(lang('rank_inactivated'), 'title-settings');
                } else {
                    $this->loadPage(lang('rank_inactivated_failed'), 'title-settings', 'danger');
                }
            } elseif ($action == "delete") {
                if ($this->rank_model->checkRankAchieved($id)) {
                    $this->loadPage(lang('cant_delete_this_rank'), 'title-settings');
                }
                $res = $this->rank_model->deleteRank($id);
                if ($res) {
                    $this->helper_model->insertActivity($log_user_id, 'rank_deleted', $activity);
                    $this->loadPage(lang('rank_deleted'), 'title-settings');
                } else {
                    $this->loadPage(lang('rank_deleted_failed'), 'title-settings', 'danger');
                }
            } elseif ($action == "edit") {
                $edit_flag = TRUE;
                $rank_details = $this->rank_model->getRankDetails($id);
            } else {
                $this->loadPage(lang('invalid_action'), 'title-settings', 'warning');
            }
        }

        if ($this->input->post('add_rank') && $this->validate_rank_addition()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->rank_model->addNewRank($post);
            if ($res) {
                $this->helper_model->insertActivity($log_user_id, 'new_rank_created', $post);
                $this->loadPage(lang('rank_added'), 'title-settings');
            } else {
                $this->loadPage(lang('rank_added_failed'), 'title-settings', 'warning');
            }
        }

        if ($this->input->post('update_rank') && $this->validate_rank_addition()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->rank_model->updateRank($post['edited_rank'], $post);
            if ($res) {
                $this->helper_model->insertActivity($log_user_id, 'rank_updated', $post);
                $this->loadPage(lang('rank_updated'), 'title-settings');
            } else {
                $this->loadPage(lang('rank_updated_failed'), 'title-settings', 'warning');
            }
        }


        //$ranks = $this->rank_model->getAllRanks();
        //$this->setData('ranks', $ranks);
        $this->setData('validation_error', $this->form_validation->error_array());
        $this->setData('edit_flag', $edit_flag);
        $this->setData('edited_rank', $id);
        $this->setData('rank_details', $rank_details);
        $this->setData('title', lang('menu_name_55'));
        $this->loadView();
    }

    /**
     * For validate the rank form
     * @author Techffodils Technologies LLP
     * @date 2017-12-12
     * @return type
     */
    function validate_rank_addition() {
        $this->form_validation->set_rules('rank_name', lang('rank_name'), 'required|callback_validate_rank_name');
        $this->form_validation->set_rules('total_sales', lang('total_sales'), 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('referal_count', lang('referal_count'), 'required|numeric|greater_than[0]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For validate the rank name already exists or not
     * @param type $rank_name
     * @return boolean
     */
    function validate_rank_name($rank_name = '') {
        if ($rank_name) {
            $flag = false;
            $edit_id = $this->input->post('edited_rank');
            if (!$this->rank_model->checkRankName($rank_name, $edit_id)) {
                $flag = true;
            }
            return $flag;
        } elseif ($this->input->get('rank_name')) {
            $rank_name = $this->input->get('rank_name');
            $edit_id = $this->input->get('edited_rank');
            if (!$this->rank_model->checkRankName($rank_name, $edit_id)) {
                echo 'yes';
                exit();
            }
            echo 'no';
            exit();
        }
    }

    /**
     * For list out the ranks added
     * @author Techffodils Technologies LLP
     * @date 2017-12-12
     */
    function rank_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'rank';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'rank_name',
            'referal_count',
            'total_sales',
            'status',
            'rank_bonus'
        );
        $column = $this->rank_model->getTableColumnRankList();
        $total_records = $this->rank_model->countOfRankList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->rank_model->getTotalFilteredRankList($table, $where);
        $res_data = $this->rank_model->getResultDataRankList($table, $columns, $where, $order, $limit);

        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {

            if ($res_data[$i][4]) {
                $res_data[$i][5] = '<a href="javascript:edit_rank(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_rank(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_rank(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
                $res_data[$i][4] = lang('active');
            } else {
                $res_data[$i][5] = ' <a href="javascript:activate_rank(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_rank(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
