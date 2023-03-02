<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;

require_once 'Base_Controller.php';

class Home extends Base_Controller {

    function index() {

        $prod_stock_out_soon = $this->home_model->getProductStock();
        $prod_stock_out = $this->home_model->getProductStockOut();
        // print_r($prod_stock_out);die;
        $last_monday = date("Y-m-d", strtotime("last week monday"));
        $last_sunday = date("Y-m-d", strtotime("last week sunday"));
        $total_orders_last_week = $this->home_model->getLastWeekOrders($last_monday , $last_sunday );
        $total_sales_last_week = $this->home_model->getLastWeekSales($last_monday , $last_sunday);
        $total_customers_last_week = $this->home_model->getLastWeekTotalUsers($last_monday , $last_sunday);
        $date = date('Y-m-d');
        $order_data = $this->home_model->getAllOrdersData($date);
        $total_orders = $this->home_model->getTotalOrders();
        $total_sales = $this->home_model->getTotalSales(); 
        $total_customers = $this->home_model->getTotalUsers();
        $country_orders =$this->countryorders_details();
        $this->setData('country_orders', $country_orders);
        $this->setData('total_customers_last_week', $total_customers_last_week);
        $this->setData('total_orders_last_week', $total_orders_last_week);
        $this->setData('total_sales_last_week', $total_sales_last_week);
        $this->setData('total_customers', $total_customers);
        $this->setData('total_orders', $total_orders);
        $this->setData('total_sales', $total_sales);
        $this->setData('order_data', $order_data);
        $this->setData('prod_stock_out_soon', $prod_stock_out_soon);
        $this->setData('prod_stock_out', $prod_stock_out);
        $this->loadView();
    }
    
    
    /**
     * for show all the details of the system like commission,joining date
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * 
     */
    function index2() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $replica_link = $this->helper_model->getUserReplicaLink($user_name);
        $lcp_link = $this->helper_model->getUserLCPLink($user_name);

        $events = $this->home_model->getEvents();
        $news = $this->home_model->getNews();
        $lat_docs = $this->home_model->getDocs();
        $top_sales = $this->helper_model->getTopSales();

        $col = '';
        $replica_status = $this->dbvars->REPLICATED_WEBSITE_STATUS;
        $lcp_status = $this->dbvars->LCP_STATUS;
        if ($replica_status && $lcp_status) {
            $col = '6';
        } elseif ($replica_status || $lcp_status) {
            $col = '12';
        }
        
        $this->setData('replica_status', $replica_status);
        $this->setData('lcp_status', $lcp_status);
        $this->setData('col', $col);
        $this->setData('events', $events);
        $this->setData('lat_docs', $lat_docs);
        $this->setData('news', $news);
        $this->setData('top_sales', $top_sales);
        $this->setData('replica_link', $replica_link);
        $this->setData('replica_link_encode', urlencode($replica_link));
        $this->setData('lcp_link_encode', urlencode($lcp_link));
        $this->setData('lcp_link', $lcp_link);
        $this->setData('title', lang('menu_name_1'));
        $this->loadView();
    }

    /**
     * for show all the details of the system like commission,joining date
     * @author Techffodils Technologies LLP
     * @date 2018-01-06
     * 
     */
    function index3() {

        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $replica_link = $this->helper_model->getUserReplicaLink($user_name);
        $lcp_link = $this->helper_model->getUserLCPLink($user_name);

        $events = $this->home_model->getEvents();
        $news = $this->home_model->getNews();
        $lat_docs = $this->home_model->getDocs();
        $top_sales = $this->helper_model->getTopSales();

        $col = '';
        $replica_status = $this->dbvars->REPLICATED_WEBSITE_STATUS;
        $lcp_status = $this->dbvars->LCP_STATUS;
        if ($replica_status && $lcp_status) {
            $col = '6';
        } elseif ($replica_status || $lcp_status) {
            $col = '12';
        }
        
        $this->setData('replica_status', $replica_status);
        $this->setData('lcp_status', $lcp_status);
        $this->setData('col', $col);
        $this->setData('events', $events);
        $this->setData('lat_docs', $lat_docs);
        $this->setData('news', $news);
        $this->setData('top_sales', $top_sales);
        $this->setData('replica_link', $replica_link);
        $this->setData('replica_link_encode', urlencode($replica_link));
        $this->setData('lcp_link_encode', urlencode($lcp_link));
        $this->setData('lcp_link', $lcp_link);
        $this->setData('title', lang('menu_name_1'));
        $this->loadView();
    }
    
    function change_theme_mode() {
        if($this->dbvars->DARK_MODE==1){
            $this->dbvars->DARK_MODE=0;
        }else{
            $this->dbvars->DARK_MODE=1;
        }
        echo 'yes';exit;
    }

    public function totalorder() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $date = date("Y-m-d H:i:s");
        $date = date("Y-m-d", strtotime($date));
        $value1 = array();
        for ($i = 8; $i >= 1; $i--) {
            $value1[] = $this->home_model->getUserOrderTotal($date);
            $date = date('Y-m-d', strtotime($date . ' -1 day'));
        }
        echo json_encode($value1);
        exit();

    }

    public function totalsales() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $date = date("Y-m-d H:i:s");
        $date = date("Y-m-d", strtotime($date));
        $value1 = array();
        for ($i = 8; $i >= 1; $i--) {
            $value1[] = $this->home_model->getUserSalesTotal($date);
            $date = date('Y-m-d', strtotime($date . ' -1 day'));
        }
        echo json_encode($value1);
        exit();

    }

    public function total_users() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $date = date("Y-m-d H:i:s");
        $date = date("Y-m-d", strtotime($date));
        $value1 = array();
        for ($i = 8; $i >= 1; $i--) {
            $value1[] = $this->home_model->getTotalUserCount($date);
            $date = date('Y-m-d', strtotime($date . ' -1 day'));
        }
        echo json_encode($value1);
        exit();

    }
    public function mapdatafun(){
        $data= array();
        $this->db->select('country,COUNT(country) as countorder')
                ->from('orders')
                ->where('order_status >','0')
                ->group_by('country');
        $res =  $this->db->get()->result_array();
        $i=0;
        
        foreach($res as $result){
            $latti = $this->db->where("id", $result['country'])->get('countries')->row()->latitude;
            $longi = $this->db->where("id", $result['country'])->get('countries')->row()->longitude;
            $data[$i]['latLng'] = [$latti, $longi];
            $data[$i]['name'] = $this->db->where("id", $result['country'])->get('countries')->row()->country_name;
            $i++;
        }
        echo json_encode($data);
        exit();
    }

    public function countryorders_details(){
        $data = array();
        $this->db->select('country,COUNT(country) as countorder')
        ->from('orders')
        ->where('order_status >','0')
        ->order_by("countorder", "DESC")
        ->limit(3)
        ->group_by('country');
        $res =  $this->db->get()->result_array();
        $totalorders  =$this->db->select('*')
                ->from('orders')
                ->where('order_status >','0')
                ->get()->num_rows();
        $i =0;
        foreach($res as $result){
            $data[$i]['country'] = $this->db->where("id", $result['country'])->get('countries')->row()->country_name;
            $percent = ($result['countorder'] / $totalorders) * 100;
            $data[$i]['order_count'] = $percent;
            $i++;
        }

       return $data;
    }
   
    
    
}
