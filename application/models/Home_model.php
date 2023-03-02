<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * For home related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    home
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use Carbon\Carbon;

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * for getting events
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getEvents() {
        $data = [];
        $res = $this->db->select('name,desc,start_date')
        ->get('events');
        if ($res->num_rows() > 0) {
            $i = 0;
            foreach ($res->result_array() as $row) {
                $date = explode(' ', $row['start_date'], 2);
                $data[$i]['date'] = $date[0];
                $data[$i]['time'] = $date[1];
                $data[$i]['name'] = $row['name'];
                $i ++;
            }
        }
        return $data;
    }

    /**
     * for getting news
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getNews() {
        $data = array();
        $res = $this->db->select('title,image,content,date')
        ->where('status', 1)
        ->limit(4)
        ->order_by('id', 'desc')
        ->get('news');

        if ($res->num_rows() > 0) {
            $i = 0;
            foreach ($res->result_array() as $row) {
                $data[$i]['title'] = $row['title'];
                $data[$i]['image'] = $row['image'];
                $data[$i]['content'] = strip_tags($row['content']);
                $data[$i]['date'] = Carbon::parse($row['date'])->formatLocalized('%a %d-%b-%Y');
                $i ++;
            }
        }
        return $data;
    }

    /**
     * for getting tickets
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getTickets() {
        $data = array();
        $res = $this->db->select('title,content,created_date')
        ->limit(3)
        ->order_by('id', 'desc')
        ->get('ticket');

        if ($res->num_rows() > 0) {
            $i = 0;
            foreach ($res->result_array() as $row) {
                $data[$i]['title'] = $row['title'];
                $data[$i]['content'] = strip_tags($row['content']);
                $data[$i]['created_date'] = $row['created_date'];
                $i ++;
            }
        }
        return $data;
    }

    /**
     * for getting leads
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getLead() {
        $data = array();
        $res = $this->db->select('first_name,last_name,email,comment,date')
        ->limit(3)
        ->order_by('id', 'desc')
        ->get('leads');

        if ($res->num_rows() > 0) {
            $i = 0;
            foreach ($res->result_array() as $row) {
                $data[$i]['full_name'] = $row['first_name'] . ' ' . $row['last_name'];
                $data[$i]['email'] = $row['email'];
                $data[$i]['comment'] = strip_tags($row['comment']);
                $data[$i]['date'] = $row['date'];
                $i++;
            }
        }
        return $data;
    }

    /**
     * for getting documens
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getDocs() {
        $data = array();
        $res = $this->db->select('title,document')
        ->where('status', 1)
        ->where('file_type', 'img')
        ->limit(4)
        ->order_by('id', 'desc')
        ->get('documents');
        $i = 0;
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $row) {
                $data[$i]['title'] = $row['title'];
                $data[$i]['document'] = $row['document'];
                $i ++;
            }
        } else {
            $data[$i]['title'] = '';
            $data[$i]['document'] = 'no_img.jpg';
        }
        return $data;
    }

    /**
     * for getting affiliate enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getAffiliateEnquiry($affiliate_id, $status_1 = 0, $status_2 = 0) {

        if (!empty($status_1) || !empty($status_2)) {
            return $this->db->select('count(*)')
            ->from('affiliate_enquiry')
            ->where('affiliate_id', $affiliate_id)
            ->where('enq_status', $status_1)
            ->where('enq_close_status', $status_2)
            ->count_all_results();
        } else {
            return $this->db->select('count(*)')
            ->from('affiliate_enquiry')
            ->where('affiliate_id', $affiliate_id)
            ->count_all_results();
        }
    }

    /**
     * for getting affiliate pending enquiry
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getAffiliatePendingEnquiry($affiliate_id, $enq_status, $enq_complete_status) {
        return $this->db->select('count(*)')
        ->from('affiliate_enquiry')
        ->where('affiliate_id', $affiliate_id)
        ->where('enq_status', $enq_status)
        ->where('enq_close_status', $enq_complete_status)
        ->count_all_results();
    }

    function getPayoutDetails($user_id = 0) {
        $bal_amount = $this->getTotalBalanceAmount($user_id);
        $pay_req = $this->getTotalPAyoutRequested($user_id);
        $pay_complete = $this->getTotalPAyoutCompleted($user_id);

        $data['bal_amount'] = $this->helper_model->currency_conversion($bal_amount);
        $data['pay_req'] = $this->helper_model->currency_conversion($pay_req);
        $data['pay_com'] = $this->helper_model->currency_conversion($pay_complete);
        $data['ratio'] = 100;
        if ($pay_complete + $pay_req > 0)
            $data['ratio'] = $pay_complete / ($pay_complete + $pay_req) * 100;

        return $data;
    }

    function getTotalBalanceAmount($user_id) {
        $amount = 0;
        $this->db->select_sum('balance_amount');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $res = $this->db->get('user_balance');
        if ($res->num_rows() > 0 && $res->row()->balance_amount > 0) {
            $amount = $res->row()->balance_amount;
        }
        return $amount;
    }

    function getTotalPAyoutRequested($user_id) {
        $amount = 0;
        $this->db->select_sum('original_amount');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $this->db->where('wallet_type', 'payout_requested');
        $res = $this->db->get('wallet_details');
        if ($res->num_rows() > 0 && $res->row()->original_amount > 0) {
            $amount = $res->row()->original_amount;
        }
        return $amount;
    }

    function getTotalPAyoutCompleted($user_id) {
        $amount = 0;
        $this->db->select_sum('original_amount');
        $this->db->where('wallet_type', 'payout_released');
        if ($user_id) {
            $this->db->where('mlm_user_id', $user_id);
        }
        $res = $this->db->get('wallet_details');
        if ($res->num_rows() > 0 && $res->row()->original_amount > 0) {
            $amount = $res->row()->original_amount;
        }
        return $amount;

    }



    function getUserOrderPerMonth($year_month)
    {
        return $this->db->select('count(*)')
        ->where("DATE_FORMAT(confirm_date,'%Y-%m')", $year_month)
        ->where('order_status' , 1)
        ->from('orders')
        ->count_all_results();
    }    

    function getUserSalesPerMonth($year_month)
    {                       

        $total_amount = 0;
        $query = $this->db->select_sum('total_amount')
        ->where('order_status', 1)
        ->like("DATE_FORMAT(confirm_date,'%Y-%m')", $year_month)
        ->get('orders');
        if ($query->num_rows() > 0 && $query->row()->total_amount != '') {
            $total_amount = $query->row()->total_amount;
        }
        return $total_amount;


    }
    function getCustomersCount($year_month)
    {
        return $this->db->select('count(*)')
        ->where("DATE_FORMAT(date,'%Y-%m')", $year_month)
        ->where('user_type', 'user')
        ->from('user')
        ->count_all_results();
    }
    function getMonthNames($monthNum)
    {

        $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
        
    }


    function getTotalOrders() {
        return $this->db->select('count(*)')
        ->from('orders')
        ->where('order_status', 1)
        ->count_all_results();
        
    }

    function getTotalSales() {
        $total_amount = 0;
        $query = $this->db->select_sum('total_amount')
        ->where('order_status', 1)
        ->get('orders');
        if ($query->num_rows() > 0 && $query->row()->total_amount != '') {
            $total_amount = $query->row()->total_amount;
        }
        return $total_amount;

    }

    function getTotalUsers() {
     $this->db->select('mlm_user_id')
     ->from("user")
     ->where('user_type', 'user');
     return $this->db->count_all_results();

 }

 function getLastWeekOrders($from_date , $to_date) {
    return $this->db->select('count(*)')
    ->from('orders')
    ->where('order_status', 1)
    ->where('order_date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
    ->count_all_results();

}

function getLastWeekSales($from_date , $to_date) {
    $total_amount = 0;
    $query = $this->db->select_sum('total_amount')
    ->where('order_status', 1)
    ->where('order_date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
    ->get('orders');
    if ($query->num_rows() > 0 && $query->row()->total_amount != '') {
        $total_amount = $query->row()->total_amount;
    }
    return $total_amount;

}

function getLastWeekTotalUsers($from_date , $to_date) {
 $this->db->select('mlm_user_id')
 ->from("user")
 ->where('user_type', 'user')
 ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"');
 return $this->db->count_all_results();

}

function getUserOrderTotal($date) {

  return $this->db->select('count(*)')
  ->from('orders')
  ->where('order_status', 1)
  ->like('order_date', $date)
  ->count_all_results();

}

function getUserSalesTotal($date) {
    $total_amount = 0;
    $query = $this->db->select_sum('total_amount')
    ->where('order_status', 1)
    ->like('order_date', $date)
    ->get('orders');
    if ($query->num_rows() > 0 && $query->row()->total_amount != '') {
        $total_amount = $query->row()->total_amount;
    }
    return $total_amount;

}

function getTotalUserCount($date) {
 $this->db->select('mlm_user_id')
 ->from("user")
 ->like('date', $date)
 ->where('user_type', 'user');
 return $this->db->count_all_results();

}

function getAllOrdersData($date){        
    $data = array();
    $query = $this->db->select('orders.id, orders.order_status,orders.total_amount,orders.order_date,user_name')
    ->join('user', 'user.mlm_user_id = orders.user_id', 'inner')
    ->like('order_date', $date)
    ->get('orders');
    if ($query->num_rows() > 0) {
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['order_id'] = 'MB00'.$row['id'];
            $data[$i]['customer'] = $row['user_name'];
            $data[$i]['order_status'] = lang($this->getOrderStatus($row['order_status']));
            $data[$i]['order_date'] = $row['order_date'];
            $data[$i]['total_amount'] = $this->helper_model->currency_conversion(round($row['total_amount'], 8));
            $i++;
        }
    }
    return $data;
}

function getOrderStatus($id){
  $status_name = '';
  $query = $this->db->select('status_name')
  ->where('id', $id)
  ->get('orderstatus');
  if ($query->num_rows() > 0) {
    $status_name = $query->row()->status_name;
}
return $status_name;
}

function getProductStock(){
    $data = array();
    $query = $this->db->select('product_name')
    ->where('quantity <' , 5)
    ->where('quantity >' , 0)
    ->get('products');
    if ($query->num_rows() > 0) {
        $i = 0;
        foreach ($query->result_array() as $value) {
            $data[$i]['product_name'] = $value['product_name'];
            $i++;
        }
    }
    return $data;
}

function getProductStockOut(){
    $data = array();
    $query = $this->db->select('product_name')
    ->where('quantity' , 0)
    ->get('products');
   
    if ($query->num_rows() > 0) {
      
        foreach ($query->result_array() as $value) {
            $data[]['product_name'] = $value['product_name'];
       
        }
    }
    return $data;
}


}
