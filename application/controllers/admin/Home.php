<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;

require_once 'Base_Controller.php';

class Home extends Base_Controller {

    function index() {
        // $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        // $replica_link = $this->helper_model->getUserReplicaLink($user_name);
        // $lcp_link = $this->helper_model->getUserLCPLink($user_name);

        // $top_sales = $this->helper_model->getTopSales();

        // $col = '';
        // $replica_status = $this->dbvars->REPLICATED_WEBSITE_STATUS;
        // $lcp_status = $this->dbvars->LCP_STATUS;
        // if ($replica_status && $lcp_status) {
        //     $col = '6';
        // } elseif ($replica_status || $lcp_status) {
        //     $col = '12';
        // }
        // $user_type = $this->aauth->getUserType();
        // $user_id = ($user_type == 'user') ? $this->aauth->getId() : '';
        // $total_users=$this->helper_model->getUserCounts('',$user_id);
        
        // $lat_docs = $this->home_model->getDocs();
        // $pay_details = $this->home_model->getPayoutDetails();
               
        // $this->setData('pay_details', $pay_details);
        // $this->setData('lat_docs', $lat_docs);
        // $this->setData('total_users', $total_users);
        // $this->setData('replica_status', $replica_status);
        // $this->setData('lcp_status', $lcp_status);
        // $this->setData('col', $col);
        // $this->setData('top_sales', $top_sales);
        // $this->setData('replica_link', $replica_link);
        // $this->setData('replica_link_encode', urlencode($replica_link));
        // $this->setData('lcp_link_encode', urlencode($lcp_link));
        // $this->setData('lcp_link', $lcp_link);
        // $this->setData('year', date('Y'));
        // $this->setData('title', lang('menu_name_1'));
        $last_monday = date("Y-m-d", strtotime("last week monday"));
        $last_sunday = date("Y-m-d", strtotime("last week sunday"));
        $total_orders_last_week = $this->home_model->getLastWeekOrders($last_monday , $last_sunday );
        $total_sales_last_week = $this->home_model->getLastWeekSales($last_monday , $last_sunday);
        $total_customers_last_week = $this->home_model->getLastWeekTotalUsers($last_monday , $last_sunday);
        $order_data = $this->home_model->getAllOrdersData();
        $total_orders = $this->home_model->getTotalOrders();
        $total_sales = $this->home_model->getTotalSales(); 
        $total_customers = $this->home_model->getTotalUsers();
        $this->setData('total_customers_last_week', $total_customers_last_week);
        $this->setData('total_orders_last_week', $total_orders_last_week);
        $this->setData('total_sales_last_week', $total_sales_last_week);
        $this->setData('total_customers', $total_customers);
        $this->setData('total_orders', $total_orders);
        $this->setData('total_sales', $total_sales);
        $this->setData('order_data', $order_data);
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


    
    
}
