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
    public function index($product_seo_key = '') {

        $prod_view_flag = 0;
        $products = [];

        if ($product_seo_key != '') {
            $check_seo_key = $this->shop_model->checkSeoKeyExists($product_seo_key);
            if (is_array($check_seo_key) && isset($check_seo_key['seo_value'])) {
                $pro_id = $check_seo_key['seo_value'];
                $prod_view_flag = 1;

                $this->load->model('product_model');
                if ($pro_id) {
                    $products = $this->product_model->getProductDetailsView($pro_id);
                }
            }
        }

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
        $this->setData('prod_view_flag', $prod_view_flag);
        $this->setData('products', $products);
        $this->loadView();
    }

    // public function get_products($name){
    // }


    public function login_register() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();

        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function shop($cat_id = "") {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);
        $user_type = $this->aauth->getUserType();

        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $min_amt=$max_amt=$color ='';
        $brand=[];
        $brands = $this->product_model->getAllBrands();
        if ($this->input->post('filter_btn')) {
            
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
 
            $brand=(isset($post['brand']))?$post['brand']:[];
            $min_amt = $post['min_amt'];
            $max_amt = $post['max_amt'];
        }

        $products = '';
        if ($cat_id) {
            $products = $this->product_model->getProducts($cat_id,$min_amt,$max_amt,$brand);
        }

        $cat_name = $this->product_model->getCatName($cat_id);
        $this->setData('brands', $brands);
        $this->setData('cat_name', $cat_name);
        $this->setData('nav_category', $nav_category);
        $this->setData('products', $products);
        $this->setData('items', $this->cart->total_items());

        $this->loadView();
    }

    public function cart() {
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
        $items = $this->cart->total_items();
        if ($items == 0) {
            $this->loadPage(lang('Cart Is Empty'), './', 'warning');
        }
        
        $cart_amount = $this->cart->total();
        $pro_count = count($cart);
        $this->setData('user_id', $user_id);
        $this->setData('pro_count', $pro_count);
        $this->setData('cart', $cart);
        $this->setData('cart_amount', $cart_amount);
        $this->setData('nav_category', $nav_category);
        $this->setData('products', $products);
        $this->setData('items', $items);
        $this->setData('items_count', $items);
        $this->setData('total_items_amount', $this->cart->total());
        $this->loadView();
    }

    public function about_us() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();

        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function contact() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();

        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function app() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();

        $this->setData('nav_category', $nav_category);
        $this->loadView();
    }

    public function shop_details($pro_id = "") {
        $party_id = 0;
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $products = '';
        if ($pro_id) {
            $products = $this->product_model->getProductDtls($pro_id);
            // dd($products['0']['files']);die;
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

    public function product_details($pro_id = '') {

        $party_id = 0;
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $products = '';
        if ($pro_id) {
            $products = $this->product_model->getProductDetailsView($pro_id);
            // print_r($products);die;
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

    public function checkout() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);
        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $cart = $this->cart->contents();
        $total_items = $this->cart->total_items();
        $total_amount = $this->cart->total();
        $total_pv = $this->cart->total_pv();

        if ($this->input->post('shop_checkout')) {
            $this->load->helper('security');
            $checkout_data = $this->security->xss_clean($this->input->post());
            $order_id = $this->shop_model->insertOrder($this->aauth->getId(), $checkout_data, $cart, $total_items, $total_amount, $total_pv, 1);
            if ($order_id) {
                $this->cart->destroy();
                $this->loadPage('Order success', 'checkout', 'success');
            } else {
                $this->loadPage('Something went wrong', 'checkout', 'danger');
            }
        }

        $user_address_data = $this->shop_model->getUserAddressData($this->aauth->getId());
        $country = '';
        if (isset($user_address_data['country'])) {
            $country = $user_address_data['country'];
        }
        $states = $this->helper_model->getAllStates($country);
        $countries = $this->helper_model->getAllCountries();
        $this->setData('countries', $countries);
        $this->setData('states', $states);
        $this->setData('user_name', $user_name);
        $this->setData('user_details', $user_address_data);
        $this->setData('nav_category', $nav_category);
        $this->setData('cart', $cart);
        $this->loadView();
    }

    public function account($active = '', $action = '', $add_id = '') {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $active = $active;
        $this->load->model('report_model');
        $user = $this->aauth->get_user();
        $user_id = $this->aauth->getId();


        if ($this->input->post('change_password') && $this->validate_general_password()) {
            $active = 5;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $hash_pass = $this->aauth->hash_password($post['current_password'], '');
            if ($this->aauth->verify_password($user->password, $hash_pass)) {
                $res = $this->report_model->updatepassword($post, $user_id);
                if ($res) {
                    $this->loadPage('Update success', 'account/' . $active, 'success');
                }
            } else {
                $this->loadPage('Current password does not match', 'account/' . $active, 'danger');
            }
        }

        if ($this->input->post('account_details') && $this->validate_general_update()) {
            $active = 4;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->report_model->updategeneral($post, $user_id);
            if ($res) {
                $this->loadPage('Update success', 'account/' . $active, 'success');
            } else {
                $this->loadPage('Something went wrong', 'account/' . $active, 'danger');
            }
        }


        $edit_flag = FALSE;
        if ($this->input->post('add_address')) {
            $active = 3;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->shop_model->addUserAddress($post, $user_id);
            $country_id = $post['country_id'];
            $countries = $this->helper_model->getAllCountries();
            $states = $this->helper_model->getAllStates($country_id);


            $this->setData('states', $states);
            $this->setData('countries', $countries);
            $this->loadPage('Address Added Successfully', 'account/' . $active, 'success');
        }


        if ($action && $add_id) {
            $active = 3;
            if ($action == "edit") {
                $edit_flag = TRUE;
                $usr_addr = $this->shop_model->getUserAddress($add_id);
                $country_id = $usr_addr['country_id'];
                $countries = $this->helper_model->getAllCountries();
                $states = $this->helper_model->getAllStates($country_id);

                $this->setData('states', $states);
                $this->setData('countries', $countries);
                $this->setData('usr_addr', $usr_addr);
            } else {
                $this->loadPage('invalid_action', 'account/' . $active, 'danger');
            }
        }

        if ($this->input->post('update_address')) {
            $active = 3;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $res = $this->shop_model->UpdateUserAddress($post, $user_id);
            $country_id = $usr_addr['country_id'];
            $countries = $this->helper_model->getAllCountries();
            $states = $this->helper_model->getAllStates($country_id);

            $this->setData('countries', $countries);
            $this->setData('usr_addr', $usr_addr);
            $this->loadPage('Update Address Successfully', 'account/' . $active, 'success');
        }

        $user_detail = $this->db->select('first_name,last_name,phone_number')
                ->from('user_details')
                ->where('mlm_user_id', $user_id)
                ->get();
        foreach ($user_detail->result() as $row) {
            $detail = $row;
        }
        $address = $this->shop_model->getAllAddress($user_id);
        $usr_addr = $this->shop_model->getUserAddress($add_id);
        $countries = $this->helper_model->getAllCountries();
        $user_orders = $this->shop_model->getUserOrdersData($user_id);
        $this->setData('user_orders', $user_orders);
        $this->setData('countries', $countries);
        $this->setData('usr_addr', $usr_addr);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('add_id', $add_id);
        $this->setData('address', $address);
        $this->setData('login_error', $this->form_validation->error_array());
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
        $this->form_validation->set_rules('phone_number', lang('phone_number'), 'trim|required|numeric');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function update_notify() {
        $logged_user = $this->aauth->getId($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        if ($logged_user == '') {
            $logged_user = $this->base_model->getAdminUserId();
        }
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get());
        if ($post['phone']) {
            $phone = $post['phone'];
            $pro_id = $post['pro_id'];
            $res = $this->shop_model->insertNotificationDetails($phone, $pro_id, $logged_user);
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

    public function products() {
        $user_name = ($this->aauth->getUserType() == 'employee') ? $this->helper_model->getAdminUsername() : $this->aauth->getUserName();
        $this->setData('user_name', $user_name);

        $this->load->model('product_model');
        $nav_category = $this->product_model->getNavCategoryLists();
        $products = $this->product_model->getAllPros();
        $cart = $this->cart->contents();
        $cart_amount = $this->cart->total();


        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . "products";
        $config['total_rows'] = count($products);
        $config['per_page'] = 12;
        $config['num_links'] = 10;
        $config["uri_segment"] = 2;


        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['first_link']       = false;
        $config['last_link']        = false;
        $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul>';
        $config['attributes']       = ['class' => 'page-link'];
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $pagination["links"] = $this->pagination->create_links();


        $min_amt=$max_amt=$color ='';
        $brand=[];
        $category=[];
        if ($this->input->post('filter_btn')) {
            
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $brand=(isset($post['brand']))?$post['brand']:'';
            $category=(isset($post['category']))?$post['category']:'';
            $min_amt = $post['min_amt'];
            $max_amt = $post['max_amt'];
        }
        $products = $this->product_model->getAllProducts($config['per_page'], $page, $min_amt,$max_amt,$brand,$category);
        $brands = $this->product_model->getAllBrands();
        $categories = $this->product_model->getAllCaegories();
        $this->setData('link', $pagination['links']);
        $this->setData('cart', $cart);
        $this->setData('items', $this->cart->total_items());
        $this->setData('cart_amount', $cart_amount);
        $this->setData('nav_category', $nav_category);
        $this->setData('products', $products);
        $this->setData('brands', $brands);
        $this->setData('categories', $categories);

        $this->loadView();
    }

    function get_products() {


        $query = $this->input->get('query');
        $result = $this->shop_model->getAllProductNames($query);
        echo $result;
        exit();
    }

    function user_invoice($ord_id) {
        $active = 2;
        $this->load->model('member_model');
        $invoice_details = $this->member_model->getInvoiceDetails($ord_id);
        if (!$invoice_details) {
            $this->loadPage(lang('invalid_link'), 'account/' . $active, 'warning');
        }
        $this->setData('invoice_details', $invoice_details);
        $this->setData('active', $active);
        $this->loadView();
    }

}
