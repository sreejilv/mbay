<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'admin/Base_Controller.php';

/**
 * @author Techffodils Technologies LLP
 * Class Login
 */
class Shop extends Base_Controller {

    /**
     * loading index page.
     * @author Techffodils Technologies LLP
     */
    public function index() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  

        $this->load->model('site_management_model');
        $slider_images = $this->site_management_model->getSliderLists();
        // if ($this->aauth->getId()) {
        //     $this->loadPage('', 'dashboard');
        // }
        // if ($this->input->post('login') && $this->site_login()) {
        //     $this->helper_model->insertActivity(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), 'user_login');
        //     $this->loadPage('', 'dashboard');
        // }

        // if ($this->dbvars->CAPTCHA_STATUS > 0 || $this->aauth->get_login_attempts() > $this->dbvars->CAPTCHA_LOGIN)
        //     $this->setData('CAPTCHA_STATUS', 1);
        // $this->setData('key', $key);
        // $this->setData('login_error', $this->form_validation->error_array());
        // $this->setData('EMPLOYEE_STATUS', $this->dbvars->EMPLOYEE_STATUS);
        // $this->setData('AFFILIATES_STATUS', $this->dbvars->AFFILIATES_STATUS);
        // $this->setData('sytem_title', $this->helper_model->getSystemPath());
        // $this->setData('title', lang('login'));

        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $cart = $this->cart->contents();
        $cart_amount = $this->cart->total();
        
        $deals_of_the_day = $this->product_model->getAllDealOftheDayProducts();
        $popular_categories = $this->product_model->getAllPopularCategories();
        $this->setData('deals_of_the_day', $deals_of_the_day);
        $this->setData('popular_categories', $popular_categories);
        $this->setData('cart', $cart);
        $this->setData('items', $this->cart->total_items());
        $this->setData('cart_amount', $cart_amount);
        $this->setData('nav_category', $nav_category);
        $this->setData('slider_images', $slider_images);
        $this->loadView();
    }

    public function login_register(){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        
        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function shop($cat_id=""){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $user_type = $this->aauth->getUserType();

        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $products = '';
        if($cat_id){
            $products = $this->product_model->getProducts($cat_id);
        }
        $this->setData('nav_category', $nav_category);
        $this->setData('products', $products);
        $this->setData('items', $this->cart->total_items());

        $this->loadView();
    }

    public function cart(){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->load->model('product_model');
        $this->load->model('cart_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $products = $this->cart_model->getAllProducts();

        $user_name = $this->aauth->getUserName();
        $user_type = $this->aauth->getUserType();
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();


        // $data = array(
        //         'id'      => 'sku_123ABC',
        //         'qty'     => 1,
        //         'pv'     => 1,
        //         'price'   => 39.95,
        //         'name'    => 'T-Shirt',
        //         'options' => array('Size' => 'L', 'Color' => 'Red')
        // );
        
        // $this->cart->insert($data);

        $cart = $this->cart->contents();
        $cart_amount = $this->cart->total();
        $pro_count = count($cart);
        $this->setData('pro_count', $pro_count);
        $this->setData('cart', $cart);
        $this->setData('cart_amount', $cart_amount);
        $this->setData('nav_category', $nav_category);
        $this->setData('products', $products);
        $this->setData('items', $this->cart->total_items());
        $this->setData('total_items_amount', $this->cart->total());
        $this->loadView();
    }

    public function about_us(){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        
        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function contact(){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        
        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function app(){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        
        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function shop_details($pro_id=""){
        $party_id = 0;
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $products = '';
        if($pro_id){
            $products = $this->product_model->getProductDtls($pro_id);
            $party_cart = $this->cart->contents();
            // foreach ($party_cart as $key => $c) {
            //     if (!in_array($c['id'], $products)) {
            //         $this->cart->remove($key);
            //     }
            // }
        } else {
            // $this->loadPage(lang('invalid_party'), 'shop-details', 'danger');
        }

        $this->setData('party_id', $party_id);
        $this->setData('nav_category', $nav_category);
        $this->setData('products', $products);
        $this->setData('items', $this->cart->total_items());
        $this->setData('party_cart', $party_cart);
        $this->setData('total_items_amount', $this->cart->total());
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->loadView();
    }

    public function checkout(){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);  
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $cart = $this->cart->contents();
        // print_r($cart);die;

        $this->setData('nav_category', $nav_category);
        $this->setData('cart', $cart);
        $this->loadView();
    }
    
    public function account($active =''){
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $active = $active;
        $this->load->model('report_model');
        $user= $this->aauth->get_user();
        $user_id = $this->aauth->getId();

        if ($this->input->post('change_password') && $this->validate_general_password()) {
            $active = 5;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $hash_pass = $this->aauth->hash_password($post['current_password'], '');
            if($this->aauth->verify_password($user->password,$hash_pass)){
                $res = $this->report_model->updatepassword($post,$user_id);
                if($res){
                    $this->loadPage('update success', 'account/'.$active, 'success');
                }
            }else{
               $this->loadPage('Current password does not match', 'account/'.$active, 'danger');
           }
       }
       if ($this->input->post('account_details') && $this->validate_general_update()) {
        $active = 4;
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $res = $this->report_model->updategeneral($post ,$user_id);
        if($res){
            $this->loadPage('update success', 'account/'.$active, 'success');
        }else{
           $this->loadPage('something went wrong', 'account/'.$active, 'danger');
       }
   }
   $user_detail = $this->db->select('first_name,last_name,phone_number')
   ->from('user_details')
   ->where('mlm_user_id', $user_id)
   ->get();
   foreach ($user_detail->result() as $row) {
      $detail = $row;
  }
  $this->setData('active', $active);  
  $this->setData('user_name', $user_name);  
  $this->setData('user_mail', $user->email);  
  $this->setData('user_details', $detail); 
  $this->setData('login_error', $this->form_validation->error_array());
  $this->loadView();
}
public function validate_general_password() {
    $this->form_validation->set_rules('current_password', lang('password'), 'trim|required');
    $this->form_validation->set_rules('password', lang('password'), 'trim|required|matches[confirm_password]|min_length[6]');
    $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[6]');
    $this->form_validation->set_error_delimiters('<li>', '</li>');
    $validation = $this->form_validation->run();
    return $validation;
}
public function validate_general_update() {
    $this->form_validation->set_rules('email', lang('email'), 'required');
    $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
    $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
    $this->form_validation->set_rules('phone_number', lang('phone_number'), 'required||regex_match[/^[0-9]{10}$/]');
    $this->form_validation->set_error_delimiters('<li>', '</li>');
    $validation = $this->form_validation->run();
    return $validation;
}

function update_notify($phone) {
    $logged_user = $this->aauth->getId($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
    $this->load->helper('security');
    $post = $this->security->xss_clean($this->input->get());
    if ($post['phone']) {
        $phone = $post['phone'];
        $pro_id = $post['pro_id'];
        $res = $this->shop_model->insertNotificationDetails($phone,$pro_id,$logged_user);
        if ($res) {
            $log_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
            $this->helper_model->insertActivity($log_user, 'update_notify', $post);
            echo 'yes';
            exit;
        }

    }
    echo 'no';
    exit;
}

}
