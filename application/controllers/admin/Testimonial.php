<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once'Base_Controller.php';

Class Testimonial extends Base_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * @author Techffodils Technologies LLP
     *  @date 2018-02-27
     * @param type $action
     * @param type $id
     */
    function view_testimonial($action = '', $id = NULL) {
        $this->setData('title', lang('view_testimonial'));

        //$details = $this->testimonial_model->getAllTestimonial();
        if ($action != '' && $id != '') {
            $result = $this->testimonial_model->updateTestimonialStatus($action, $id);
            if ($result) {
                $this->loadPage(lang($action . '_success'), 'testimonial-view', 'success');
            } else {
                $this->loadPage(lang('error'), 'testimonial-view', 'danger');
            }
        }

        //$this->setData('detail', $details);
        $this->setData('title', lang('menu_name_96'));
        $this->loadView();
    }

    /**
     * For List out the testimonial created
     * @author Techffodils Technologies LLP
     * @date 2018-02-27
     * 
     */
    function testimonial() {
        $request = $this->input->get();
        if ($request) {
            $table1 = DB_PREFIX_SYSTEM . 'user';
            $table2 = DB_PREFIX_SYSTEM . 'testimonial';
            $limit = $order = $where = '';
            $column = $this->testimonial_model->getTableColumnTestmonial();
            $total_records = $this->testimonial_model->countOfTestmonial();
            $limit = $this->base_model->getTotalDataLimit($request);
            $order = $this->base_model->getTotalDataOrder($request, $column);
            $where = $this->base_model->getTotalDataWhere($request, $column);
            $record_filtered = $this->testimonial_model->getTotalFilteredTestmonial($table1, $table2, $where);
            $res_data = $this->testimonial_model->getResultDataTestmonial($table1, $table2, $where, $order, $limit);
            $count_pin_active = count($res_data);
            for ($i = 0; $i < $count_pin_active; $i++) {
                if ($res_data[$i][4] == '0') {
                    $res_data[$i][4] = '<span class="label label-warning">' . lang('inactive') . '</span>';
                    $res_data[$i][5] = ' <a href="javascript:activate_testimonial(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green" title="' . lang('active') . '"><i class="fa fa-check-square-o"></i></a> <a href="javascript:delete_testimonial(' . $res_data[$i][0] . ')" class="btn btn-xs btn-danger" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a> ';
                }
                if ($res_data[$i][4] == '1') {
                    $res_data[$i][4] = '<span class="label label-success">' . lang('active') . '</span>';
                    $res_data[$i][5] = ' <a href="javascript:inactive_testimonial(' . $res_data[$i][0] . ')" class="btn btn-xs btn-info" title="' . lang('inactivate') . '"><i class="fa fa-minus-square"></i></a> <a href="javascript:delete_testimonial(' . $res_data[$i][0] . ')" class="btn btn-xs btn-danger" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a> ';
                }
                if ($res_data[$i][4] == '2') {
                    $res_data[$i][4] = '<span class="label label-danger">' . lang('delete') . '</span>';
                    $res_data[$i][5] = ' <a href="javascript:delete_testimonial(' . $res_data[$i][0] . ')" class="btn btn-xs btn-danger" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a> ';
                }
                $res_data[$i][0] = $i + $request['start'] + 1;
            }
            echo json_encode(array(
                "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
                "recordsTotal" => $total_records,
                "recordsFiltered" => $record_filtered,
                "data" => $res_data
            ));
        }
        exit();
    }

}
