<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');

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
        $order_data = '';
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
    
}
