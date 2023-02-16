<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Events extends Base_Controller {

    /**
     * For Event Management
     * @author Techffodils Technologies LLP
     * @param type $action
     * @param type $event_id
     */
    function event_management($action = '', $event_id = '') {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $edit_flag = FALSE;
        $data = array();
        if ($action && $event_id) {
            $data['action'] = $action;
            $data['event_id'] = $event_id;
            if ($action == 'edit') {
                $edit_flag = TRUE;
                $data = $this->events_model->getEventDetails($event_id);
            } elseif ($action == 'delete') {
                $res = $this->events_model->deleteEvent($event_id);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'event_deleted', $data);
                    $this->loadPage(lang('event_deleted'), 'event-manage');
                } else {
                    $this->loadPage(lang('event_deletion_failed'), 'event-manage', 'danger');
                }
            } elseif ($action == 'inactivate') {
                $res = $this->events_model->updateEventStatus($event_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'event_inactivated', $data);
                    $this->loadPage(lang('event_inactivated'), 'event-manage');
                } else {
                    $this->loadPage(lang('event_inactition_failed'), 'event-manage', 'danger');
                }
            } elseif ($action == 'activate') {
                $res = $this->events_model->updateEventStatus($event_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($user_id, 'event_activated', $data);
                    $this->loadPage(lang('event_activated'), 'event-manage');
                } else {
                    $this->loadPage(lang('event_activation_failed'), 'event-manage', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_action'), 'event-manage', 'danger');
            }
        }
        if ($this->input->post('add_event') && $this->validate_event()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $res = $this->events_model->addEvent($post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'event_added', $post);
                $this->loadPage(lang('event_added'), 'event-manage');
            } else {
                $this->loadPage(lang('event_add_failed'), 'event-manage', 'danger');
            }
        }

        if ($this->input->post('update_event') && $this->validate_event()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $res = $this->events_model->updateEvent($this->input->post('update_event'), $post);
            if ($res) {
                $this->helper_model->insertActivity($user_id, 'event_updated', $post);
                $this->loadPage(lang('event_updated'), 'event-manage');
            } else {
                $this->loadPage(lang('event_updation_failed'), 'event-manage', 'danger');
            }
        }

//        $events = $this->events_model->getEvents();
//        $this->setData('events', $events);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('edit_flag', $edit_flag);
        $this->setData('event_id', $event_id);
        $this->setData('data', $data);
        $this->setData('title', lang('menu_name_107'));
        $this->loadView();
    }

    /**
     * For validate Event
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * @return type
     */
    function validate_event() {
        $post_arr = $this->input->post();

        $this->form_validation->set_rules('event_name', lang('event_name'), 'required');
        //$this->form_validation->set_rules('event_desc', lang('event_desc'), 'required');
        $this->form_validation->set_rules('event_type', lang('event_type'), 'required');
        if ($post_arr['event_type'] == 'single_day') {
            $this->form_validation->set_rules('event_date', lang('event_date'), 'required');
            $this->form_validation->set_rules('event_time', lang('event_time'), 'required');
        } elseif ($post_arr['event_type'] == 'multiple_day') {
            $this->form_validation->set_rules('event_intervell', lang('event_intervell'), 'required');
        }
        return $this->form_validation->run();
    }

    /**
     * For Calender View
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     */
    function calendar() {
        $this->setData('title', lang('menu_name_108'));
        $this->loadView();
    }

    /**
     * For getting the events 
     * @author Techffodils Technologies LLP
     * @date 201-01-06
     */
    function get_events() {
        $events = $this->events_model->getCalendarEvents();
        echo json_encode($events, JSON_PRETTY_PRINT);
        exit();
    }

    /*
     * For Listing the events
     * @author Techffodils Technologies LLP
     * @date 2018-01-06 
     */

    function event_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'events';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'name',
            '`desc`',
            'added_date',
            'status',
            'event_type',
            'start_date',
            'end_date'
        );
        $column = $this->events_model->getTableColumnEventList();
        $total_records = $this->events_model->countOfEventList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->events_model->getTotalFilteredEventList($table, $where);
        $res_data = $this->events_model->getResultDataEventList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][2] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][2]), 0, 5))) . '.....';

            if ($res_data[$i][4]) {
                $res_data[$i][4] = '<a href="javascript:edit_event(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_event(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_event(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][4] = '<a href="javascript:edit_event(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activate_event(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_event(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            }
            if ($res_data[$i][5] == 'single_day') {
                $res_data[$i][3] = $res_data[$i][6];
            } else {
                $res_data[$i][3] = $res_data[$i][6] . ' - ' . $res_data[$i][7];
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

    /**
     * For Event View
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     */
    public function view_event() {
        $this->setData('title', lang('menu_name_155'));


        $to_date = date('Y-m-d 23:59:59');
        $from_date = '2010-01-01 00:00:00';

        if ($this->input->post('submit')) {
            $to = $this->input->post('to');
            $from = $this->input->post('from');
            $to_date = $to . ' 23:59:59';
            $from_date = $from . ' 00:00:00';
            if ($to == '') {
                $to_date = date('Y-m-d 23:59:59');
            }
            if ($from == '') {
                $from_date = '2010-01-01 00:00:00';
            }
        }
        if ($to_date < $from_date) {
            $this->loadPage(lang('pls_select_to_date_is_greather_than_from_date'), 'join-report', 'danger');
        }
        $this->session->set_userdata('view_to_date', $to_date);
        $this->session->set_userdata('view_from_date', $from_date);

        $this->loadView();
    }

    function view_events_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'events';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'name',
            '`desc`',
            'event_type',
            'start_date',
            'end_date'
        );

        $to_date = $this->session->userdata('view_to_date');
        $from_date = $this->session->userdata('view_from_date');

        $column = $this->events_model->getTableColumnViewEventsList();
        $total_records = $this->events_model->countViewEventsList($from_date, $to_date);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->events_model->getTotalFilteredViewEventsList($table, $where, $from_date, $to_date);
        $res_data = $this->events_model->getResultDataViewEventsList($table, $columns, $where, $order, $limit, $from_date, $to_date);



        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {

            if ($res_data[$i][3] == 'single_day') {
                $res_data[$i][4] = $res_data[$i][4];
            } else {
                $res_data[$i][4] = $res_data[$i][4] . ' - <br/>' . $res_data[$i][5];
            }
            $res_data[$i][3] = lang($res_data[$i][3]);
            $res_data[$i][0] = $i + $request['start'] + 1;
            unset($res_data[$i][5]);
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
