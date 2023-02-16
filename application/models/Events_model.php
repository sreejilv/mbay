<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * For event related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    event
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Events_model extends CI_Model {

    /**
     * for adding an event
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function addEvent($data) {
        if ($data['event_type'] == 'single_day') {
            $start_date = $data['event_date'] . ' ' . $data['event_time'];
            $end_date = '';
        } else {
            $event_date = explode("-", $data['event_intervell']);
            $start_date = $event_date[0];
            $end_date = $event_date[1];
        }

        $this->db->set('name', $data['event_name'])
                ->set('desc', $data['event_desc'])
                ->set('event_type', $data['event_type'])
                ->set('start_date', $start_date)
                ->set('end_date', $end_date)
                ->set('added_date', date("Y-m-d H:i:s"))
                ->set('status', 1)
                ->insert('events');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all events
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getEvents() {
        $data = array();
        $this->db->select("id,name,desc,start_date,end_date,added_date,status,event_type");
        $this->db->from("events");
        $this->db->order_by('id', 'DESC');
        $res = $this->db->get();
        $i = 0;
        $month = '';
        foreach ($res->result() as $row) {
            if ($row->event_type == 'single_day') {
                $event_date = $row->start_date;
            } else {
                $event_date = $row->start_date . ' - ' . $row->end_date;
            }
            $data[$i]['id'] = $row->id;
            $data[$i]['event_name'] = $row->name;
            $data[$i]['event_desc'] = $row->desc;
            $data[$i]['event_date'] = $event_date;
            $data[$i]['added_date'] = $row->added_date;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * for getting an event details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getEventDetails($id) {
        $data = array();
        $res = $this->db->select("id,name,desc,added_date,status,event_type,start_date,end_date")
                ->from("events")
                ->limit(1)
                ->where('id', $id)
                ->get();
        foreach ($res->result() as $row) {
            $data['id'] = $row->id;
            $data['event_name'] = $row->name;
            $data['event_desc'] = $row->desc;
            $data['added_date'] = $row->added_date;
            $data['status'] = $row->status;
            $data['event_type'] = $row->event_type;


            $dates = explode(" ", $row->start_date);
            $data['event_date'] = $dates[0];
            $data['event_time'] = $dates[1] . ' ' . $dates['2'];
            $data['event_intervell'] = $row->start_date . ' - ' . $row->end_date;
        }
        return $data;
    }

    /**
     * for updating an event
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function updateEvent($id, $data) {
        if ($data['event_type'] == 'single_day') {
            $start_date = $data['event_date'] . ' ' . $data['event_time'];
            $end_date = '';
        } else {
            $event_date = explode("-", $data['event_intervell']);
            $start_date = $event_date[0];
            $end_date = $event_date[1];
        }

        $this->db->set('name', $data['event_name'])
                ->set('desc', $data['event_desc'])
                ->set('event_type', $data['event_type'])
                ->set('start_date', $start_date)
                ->set('end_date', $end_date)
                ->where('id', $id)
                ->update('events');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for deleting an event
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function deleteEvent($id) {
        $this->db->where('id', $id)
                ->delete('events');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating an event status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function updateEventStatus($id, $status) {
        $this->db->set('status', $status)
                ->where('id', $id)
                ->update('events');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all callendar events
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    public function getCalendarEvents() {
        $cla[1]['className'] = 'event-job';
        $cla[1]['category'] = 'Job';
        $cla[2]['className'] = 'event-offsite';
        $cla[2]['category'] = 'Off-site work';
        $cla[3]['className'] = 'event-generic';
        $cla[3]['category'] = 'Generic';
        $cla[4]['className'] = 'event-todo';
        $cla[4]['category'] = 'To Do';


        $events = array();
        $res = $this->db->select("id,name,desc,added_date,status,event_type,start_date,end_date")
                ->from("events")
                ->where('status', 1)
                ->order_by('id', 'DESC')
                ->get();
        foreach ($res->result() as $row) {
            $data = array();
            $rand = rand(1, 4);

            if ($row->event_type == 'single_day') {
                $date1 = date("D M d Y H:i:s O", strtotime($row->start_date));
                $date2 = date("D M d Y H:i:s O", strtotime($row->start_date));
            } else {
                $date1 = date("D M d Y H:i:s O", strtotime($row->start_date));
                $date2 = date("D M d Y H:i:s O", strtotime($row->end_date));
            }
            $data['title'] = $row->name;
            $data['content'] = $row->desc;
            $data['start'] = $date1;
            $data['end'] = $date2;
            $data['className'] = $cla[$rand]['className'];
            $data['category'] = $cla[$rand]['category'];
            $data['allDay'] = false;
            $events[] = $data;
        }
        return $events;
    }

    /**
     * for getting event counts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function countOfEventList() {
        return $this->db->select('id')
                        ->from("events")
                        ->count_all_results();
    }

    /**
     * for setting datatable heading for events
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTableColumnEventList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => '`desc`', 'dt' => 2),
            array('db' => 'added_date', 'dt' => 3),
            array('db' => 'status', 'dt' => 4),
            array('db' => 'event_type', 'dt' => 5),
            array('db' => 'start_date', 'dt' => 6),
            array('db' => 'end_date', 'dt' => 7)
        );
    }

    /**
     * for getting filtered event count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTotalFilteredEventList($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting datatable event details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getResultDataEventList($table, $column, $where, $order, $limit) {
        $data = array();
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
    function getTableColumnViewEventsList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => '`desc`', 'dt' => 2),
            array('db' => 'event_type', 'dt' => 3),
            array('db' => 'start_date', 'dt' => 4),
            array('db' => 'end_date', 'dt' => 5)
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
    function getTotalFilteredViewEventsList($table, $where, $from_date, $to_date) {
        if ($where) {
            $where = $where . "  AND added_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE  added_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
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
    function getResultDataViewEventsList($table, $column, $where, $order, $limit,  $from_date, $to_date) {
        $data = array();
        if ($where) {
            $where = $where . " AND added_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE added_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
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

    function countViewEventsList($from_date, $to_date) {
        return $this->db->select('id')
                        ->from('events')                                       
                        ->where('added_date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->count_all_results();
    }

}
