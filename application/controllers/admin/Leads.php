<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base_Controller.php';

class Leads extends Base_Controller {

    /**
     * For  load the page
     * @author Techffodils Technologies LLP
     * @date 2017-10-27
     */
    function index() {
        $this->setData('title', lang('menu_name_98'));
        $this->loadView();
    }

    /**
     * For Lead listing the added the  leads
     * @author Techffodils Technologies LLP
     * @date 2017-10-27
     */
    function Lead_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'leads';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'lead_user',
            'first_name',
            'last_name',
            'email',
            'phone',
            'country',
            'comment',
            'date',
        );
        $column = $this->leads_model->getTableColumnLeadList();
        $total_records = $this->leads_model->countOfLeadList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->leads_model->getTotalFilteredLeadList($table, $where);
        $res_data = $this->leads_model->getResultDataLeadList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][0] = $i + $request['start'] + 1;
            $res_data[$i][1] = $this->helper_model->IdToUserName($res_data[$i][1]);
            ;
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
