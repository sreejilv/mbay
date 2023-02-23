<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * For product management related operation done here
 * For example add new product(Package) into system also update also done here like edit,delete,activate so on 
 * @author Techffodils Technologies LLP
 * @date 2018-01-4
 */
class Product extends Base_Controller {

    /**
     * For Load Product management view
     * add new product ,update edit ,delete done here
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     * @param type $action
     * @param type $product_id
     */
    public function product_management($action = "", $product_id = "") {
    // die('dsfg');
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $product = array();
        if ($this->session->userdata('product_post_data') != null)
            $product = $this->session->userdata('product_post_data');
           // print_r($this->input->post());die;
        if ($this->input->post('add_product')) {

            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
           
            // $pro_image = 'cat-banner-1.jpg';
            // // $config['upload_path'] = FCPATH . 'assets/images/products/';
            // $config['upload_path'] = FCPATH . 'assets/shop/images/product/';
            // $config['allowed_types'] = 'jpg|png|jpeg';
            // $new_name = 'pro_' . time();
            // $config['file_name'] = $new_name;
            // $this->load->library('upload', $config);

            // if ($this->upload->do_upload('images')) {
            //     $data_upload = $this->upload->data();
            //     $pro_image = $data_upload['file_name'];

            //     if ($this->dbvars->IMAGE_RESIZE_STATUS) {
            //         if (isset($data_upload['full_path'])) {
            //             $this->load->library('image_lib');
            //             $configer = array(
            //                 'image_library' => 'gd2',
            //                 'source_image' => $data_upload['full_path'],
            //                 'maintain_ratio' => TRUE,
            //                 'width' => 500,
            //                 'height' => 500,
            //             );
            //             $this->image_lib->initialize($configer);
            //             if (!$this->image_lib->resize()) {
            //                 $error['reason'] = $this->image_lib->display_errors();
            //                 $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
            //             }
            //             $this->image_lib->clear();
            //         }
            //     }
            // }


            // $config['upload_path'] = FCPATH . 'assets/images/products/';
            $config['upload_path'] = FCPATH . 'assets/shop/images/product/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->load->library('upload', $config);
            $upload_data = array();
            
            $files = $_FILES;
            // print_r($files);die;
            $cpt = count($_FILES['images']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['images']['name'][$i];
                $_FILES['userfile']['type'] = $files['images']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['images']['error'][$i];
                $_FILES['userfile']['size'] = $files['images']['size'][$i];

                $new_name = 'pro_' . $i . time();
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $data_upload = $this->upload->data();
                    $upload_data[] = $data_upload;
                    if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                        if (isset($data_upload['full_path'])) {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $data_upload['full_path'],
                                'maintain_ratio' => TRUE,
                                'width' => 500,
                                'height' => 500,
                            );
                            $this->image_lib->initialize($configer);
                            if (!$this->image_lib->resize()) {
                                $error['reason'] = $this->image_lib->display_errors();
                                $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
                            }
                            $this->image_lib->clear();
                        }
                    }
                }
            }
            $res = $this->product_model->addProduct($post, $upload_data);
            print_r($res);die;
            if ($res) {
                $this->session->unset_userdata('product_post_data');
                $this->helper_model->insertActivity($loged_user_id, 'product_added', $post);
                $this->loadPage(lang('product_added_successfully'), 'product-manage');
            } else {
                $this->loadPage(lang('product_adding_failed'), 'product-manage', 'danger');
            }
        }

        $edit_flag = FALSE;
        if ($action && $product_id) {
            if ($action == "edit") {
                $edit_flag = TRUE;
                $product = $this->product_model->getProductDetails($product_id);
            } elseif ($action == "delete") {
                if ($this->product_model->checkProductOrdered($product_id)) {
                    $this->loadPage(lang('cant_delete_this_product'), 'product-manage');
                }
                $res = $this->product_model->deleteProduct($product_id);
                if ($res) {
                    $data['product_id'] = $product_id;
                    $this->helper_model->insertActivity($loged_user_id, 'product_deleted', $data);
                    $this->loadPage(lang('product_deleted'), 'product-manage');
                } else {
                    $this->loadPage(lang('product_deletion_failed'), 'product-manage', 'danger');
                } 
            } else {
                $this->loadPage(lang('invalid_action'), 'product-manage', 'danger');
            }
        }

        if ($this->input->post('update_product')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
           
            $pro_image = $this->product_model->getProductImage($post['update_product']);
            // $config['upload_path'] = FCPATH . 'assets/images/products/';
            $config['upload_path'] = FCPATH . 'assets/shop/images/product/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'pro_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('images')) {
                $data_upload = $this->upload->data();
                $cat_image = $data_upload['file_name'];

                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($data_upload['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $data_upload['full_path'],
                            'maintain_ratio' => TRUE,
                            'width' => 500,
                            'height' => 500,
                        );
                        $this->image_lib->initialize($configer);
                        if (!$this->image_lib->resize()) {
                            $error['reason'] = $this->image_lib->display_errors();
                            $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }

            $res = $this->product_model->updateProduct($post, $pro_image);
            // print_r($res);die;
            if ($res) {
                $this->session->unset_userdata('product_post_data');
                $this->helper_model->insertActivity($loged_user_id, 'product_updated', $post);
                $this->loadPage(lang('product_updated_successfully'), 'product-manage');
            } else {
                $this->loadPage(lang('product_updation_failed'), 'product-manage', 'danger');
            }
        }

        $crypto_curr_status = 0;
        $investment_status = 0;
        if ($this->dbvars->INVESTMENT_STATUS) {
            if ($this->dbvars->INVESTMENT_CATEGORY == 'crypto') {
                $crypto_curr_status = 1;
                $investment_category = $this->product_model->getInvestmentCategories();
                $this->setData('investment_category', $investment_category);
            }
            $investment_status = 1;
        }

        $data = $this->product_model->getProductLists();
        $categories = $this->product_model->getAllCaegories();
        $category_id = isset($product['category']) ? $product['category'] : 0;
        $sub_categories = $this->product_model->getAllSubCategories($category_id);

        $this->setData('basic_cart', $this->dbvars->BASIC_CART_STATUS);
        $this->setData('categories', $categories);
        $this->setData('sub_categories', $sub_categories);
        $this->setData('crypto_curr_status', $crypto_curr_status);
        $this->setData('investment_status', $investment_status);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('product_id', $product_id);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('product', $product);
        $this->setData('data', $data);
        $this->setData('title', lang('menu_name_21'));
        $this->loadView();
    }

    /**
     * For validate the add product form
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     * @return type
     */
    function validate_add_product() {
        $this->session->set_userdata('product_post_data', $this->input->post());
        $this->form_validation->set_rules('product_name', lang('product_name'), 'required');
        $this->form_validation->set_rules('product_amount', lang('product_amount'), 'required|numeric|greater_than[0]');
        // $this->form_validation->set_rules('product_pv', lang('product_pv'), 'required|numeric|greater_than[0]');
        // $this->form_validation->set_rules('product_type', lang('product_type'), 'required');
        // if ($this->dbvars->BASIC_CART_STATUS)
            $this->form_validation->set_rules('pro_category', lang('pro_category'), 'required');
        $this->form_validation->set_rules('quantity', lang('quantity'), 'required|numeric|greater_than[0]');

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    /**
     * For list out the added product to the system
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function product_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'products';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'product_code',
            'product_name',
            'status',
            'product_amount',
            'product_pv',
            'product_type',
            'images',
        );

        $column = $this->product_model->getTableColumnProductList();
        $total_records = $this->product_model->countOfProductList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->product_model->getTotalFilteredProductList($table, $where);
        $res_data = $this->product_model->getResultDataProductList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][4] = round($res_data[$i][4], 8);
            $res_data[$i][4] = $this->helper_model->currency_conversion($res_data[$i][4]);
            if ($res_data[$i][3] == 1) {
                $res_data[$i][7] = '<a href="javascript:edit_prod(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_prod(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title=' . lang('inactivate') . '><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_prod(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][7] = '<a href="javascript:edit_prod(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:activate_prod(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_prod(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            }
            if ($this->dbvars->BASIC_CART_STATUS){
                $res_data[$i][3] = $this->product_model->getProductCategory($res_data[$i][0]);
            }else{
                $res_data[$i][3] = $this->product_model->getProductDescription($res_data[$i][0]);
            }
            

            $res_data[$i][6] = lang('' . $res_data[$i][6] . '');
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

    function get_sub_categories() {
        $id = 'sub_category';
        $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        $tab_index = isset($get['tab_index']) ? $get['tab_index'] : '0';
        $options = "<select class='form-control search-select' id='" . $id . "' name='" . $id . "' tabindex='" . $tab_index . "'><option value=''>" . lang('select_a_sub_category') . "</option>";

        if ($get['cat_id']) {
            $data = $this->product_model->getAllSubCategories($get['cat_id']);
            foreach ($data as $d) {
                $options .= "<option value='" . $d['id'] . "'>" . $d['category'] . "</option>";
            }
        }
        $options .= "</select>";

        echo $options;
        exit();
    }

    // public function category_management($action = "", $product_id = "") {
    //     $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
    //     $cat_details = array();
    //     $edit_id = 0;
    //     $cat_details['image'] = 'cat-banner-1.jpg';

    //     $edit_flag = FALSE;
    //     if ($action && $product_id) {
    //         if ($action == "cat_edit") {
    //             $edit_flag = TRUE;
    //             $cat_details = $this->product_model->getCatDetails($product_id);
    //         } elseif ($action == "cat_delete") {
    //             $res = $this->product_model->deleteCategory($product_id);
    //             if ($res) {
    //                 $data['product_id'] = $product_id;
    //                 $this->helper_model->insertActivity($loged_user_id, 'cat_deleted', $data);
    //                 $this->loadPage(lang('cat_deleted_complete'), 'cat-manage');
    //             } else {
    //                 $this->loadPage(lang('cat_deleted_failed'), 'cat-manage', 'danger');
    //             }
    //         } elseif ($action == "cat_activate") {
    //             $res = $this->product_model->changeCatStatus($product_id, 1);
    //             if ($res) {
    //                 $data['product_id'] = $product_id;
    //                 $this->helper_model->insertActivity($loged_user_id, 'cat_activate', $data);
    //                 $this->loadPage(lang('cat_activated'), 'cat-manage');
    //             } else {
    //                 $this->loadPage(lang('cat_activation_failed'), 'cat-manage', 'danger');
    //             }
    //         } elseif ($action == "cat_inactivate") {
    //             $res = $this->product_model->changeCatStatus($product_id, 0);
    //             if ($res) {
    //                 $data['product_id'] = $product_id;
    //                 $this->helper_model->insertActivity($loged_user_id, 'cat_inactivate', $data);
    //                 $this->loadPage(lang('cat_inactivated'), 'cat-manage');
    //             } else {
    //                 $this->loadPage(lang('cat_inactivation_failed'), 'cat-manage', 'danger');
    //             }
    //         } else {
    //             $this->loadPage(lang('invalid_action'), 'cat-manage', 'danger');
    //         }
    //     }

    //     if ($this->input->post('add_cat') && $this->validate_add_cat()) {
    //         $this->load->helper('security');
    //         $post = $this->security->xss_clean($this->input->post());
    //         $cat_image = 'cat-banner-1.jpg';
    //         $config['upload_path'] = FCPATH . 'assets/cart/images/banners/';
    //         $config['allowed_types'] = 'jpg|png|jpeg';
    //         $new_name = 'cat_' . time();
    //         $config['file_name'] = $new_name;
    //         $this->load->library('upload', $config);
    //         if ($this->upload->do_upload('cat_image')) {
    //             $data_upload = $this->upload->data();
    //             $cat_image = $data_upload['file_name'];
    //             if ($this->dbvars->IMAGE_RESIZE_STATUS) {
    //                 if (isset($data_upload['full_path'])) {
    //                     $this->load->library('image_lib');
    //                     $configer = array(
    //                         'image_library' => 'gd2',
    //                         'source_image' => $data_upload['full_path'],
    //                         'maintain_ratio' => TRUE,
    //                         'width' => 500,
    //                         'height' => 500,
    //                     );
    //                     $this->image_lib->initialize($configer);
    //                     if (!$this->image_lib->resize()) {
    //                         $error['reason'] = $this->image_lib->display_errors();
    //                         $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
    //                     }
    //                     $this->image_lib->clear();
    //                 }
    //             }
    //         }

    //         $res = $this->product_model->addCategory($post, $cat_image);
    //         if ($res) {
    //             $this->helper_model->insertActivity($loged_user_id, 'cat_added', $post);
    //             $this->loadPage(lang('cat_added_successfully'), 'cat-manage');
    //         } else {
    //             $this->loadPage(lang('cat_adding_failed'), 'cat-manage', 'danger');
    //         }
    //     }

    //     if ($this->input->post('update_cat') && $this->validate_add_cat()) {
    //         $this->load->helper('security');
    //         $post = $this->security->xss_clean($this->input->post());

    //         $cat_image = $this->product_model->getCategoryImage($post['update_cat']);
    //         $config['upload_path'] = FCPATH . 'assets/cart/images/banners/';
    //         $config['allowed_types'] = 'jpg|png|jpeg';
    //         $new_name = 'cat_' . time();
    //         $config['file_name'] = $new_name;
    //         $this->load->library('upload', $config);
    //         if ($this->upload->do_upload('cat_image')) {
    //             $data_upload = $this->upload->data();
    //             $cat_image = $data_upload['file_name'];
    //             if ($this->dbvars->IMAGE_RESIZE_STATUS) {
    //                 if (isset($data_upload['full_path'])) {
    //                     $this->load->library('image_lib');
    //                     $configer = array(
    //                         'image_library' => 'gd2',
    //                         'source_image' => $data_upload['full_path'],
    //                         'maintain_ratio' => TRUE,
    //                         'width' => 500,
    //                         'height' => 500,
    //                     );
    //                     $this->image_lib->initialize($configer);
    //                     if (!$this->image_lib->resize()) {
    //                         $error['reason'] = $this->image_lib->display_errors();
    //                         $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
    //                     }
    //                     $this->image_lib->clear();
    //                 }
    //             }
    //         }
    //         $res = $this->product_model->updateCategory($post, $cat_image);
    //         if ($res) {
    //             $this->helper_model->insertActivity($loged_user_id, 'cat_updated', $post);
    //             $this->loadPage(lang('cat_updated_successfully'), 'cat-manage');
    //         } else {
    //             $this->loadPage(lang('cat_updation_failed'), 'cat-manage', 'danger');
    //         }
    //     }


    //     $this->setData('category', $cat_details);
    //     $this->setData('error', $this->form_validation->error_array());
    //     $this->setData('product_id', $product_id);
    //     $this->setData('edit_flag', $edit_flag);
    //     $this->setData('title', lang('menu_name_179'));
    //     $this->setData('edit_id', $edit_id);
    //     $this->loadView();
    // }

    public function sub_category_management($action = "", $product_id = "") {
        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $sub_cat_details['image'] = 'cat-banner-2.jpg';
        if ($this->session->userdata('product_post_data') != null)
            $product = $this->session->userdata('product_post_data');
        $edit_flag = FALSE;
        if ($action && $product_id) {
            if ($action == "sub_cat_edit") {
                $edit_flag = TRUE;
                $sub_cat_details = $this->product_model->getSubCatDetails($product_id);
            } elseif ($action == "sub_cat_delete") {
                $res = $this->product_model->deleteSubCategory($product_id);
                if ($res) {
                    $data['product_id'] = $product_id;
                    $this->helper_model->insertActivity($loged_user_id, 'sub_cat_deleted', $data);
                    $this->loadPage(lang('sub_cat_deleted_complete'), 'sub-cat-manage');
                } else {
                    $this->loadPage(lang('sub_cat_deleted_failed'), 'sub-cat-manage', 'danger');
                }
            } elseif ($action == "sub_cat_activate") {
                $res = $this->product_model->changeSubCatStatus($product_id, 1);
                if ($res) {
                    $data['product_id'] = $product_id;
                    $this->helper_model->insertActivity($loged_user_id, 'sub_cat_activate', $data);
                    $this->loadPage(lang('sub_cat_activated'), 'sub-cat-manage');
                } else {
                    $this->loadPage(lang('sub_cat_activation_failed'), 'sub-cat-manage', 'danger');
                }
            } elseif ($action == "sub_cat_inactivate") {
                $res = $this->product_model->changeSubCatStatus($product_id, 0);
                if ($res) {
                    $data['product_id'] = $product_id;
                    $this->helper_model->insertActivity($loged_user_id, 'sub_cat_inactivate', $data);
                    $this->loadPage(lang('sub_cat_inactivated'), 'sub-cat-manage');
                } else {
                    $this->loadPage(lang('sub_cat_inactivation_failed'), 'sub-cat-manage', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_action'), 'sub-cat-manage', 'danger');
            }
        }

        if ($this->input->post('add_sub_cat') && $this->validate_add_sub_cat()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $cat_image = 'cat-banner-2.jpg';
            $config['upload_path'] = FCPATH . 'assets/cart/images/banners/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'sub_cat_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sub_cat_image')) {
                $data_upload = $this->upload->data();
                $cat_image = $data_upload['file_name'];
                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($data_upload['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $data_upload['full_path'],
                            'maintain_ratio' => TRUE,
                            'width' => 500,
                            'height' => 500,
                        );
                        $this->image_lib->initialize($configer);
                        if (!$this->image_lib->resize()) {
                            $error['reason'] = $this->image_lib->display_errors();
                            $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }

            $res = $this->product_model->addSubCategory($post, $cat_image);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'sub_cat_added', $post);
                $this->loadPage(lang('sub_cat_added_successfully'), 'sub-cat-manage');
            } else {
                $this->loadPage(lang('sub_cat_adding_failed'), 'sub-cat-manage', 'danger');
            }
        }

        if ($this->input->post('update_sub_cat') && $this->validate_add_sub_cat()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $cat_image = $this->product_model->getSubCategoryImage($post['update_sub_cat']);
            $config['upload_path'] = FCPATH . 'assets/cart/images/banners/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'sub_cat_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sub_cat_image')) {
                $data_upload = $this->upload->data();
                $cat_image = $data_upload['file_name'];
                if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                    if (isset($data_upload['full_path'])) {
                        $this->load->library('image_lib');
                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $data_upload['full_path'],
                            'maintain_ratio' => TRUE,
                            'width' => 500,
                            'height' => 500,
                        );
                        $this->image_lib->initialize($configer);
                        if (!$this->image_lib->resize()) {
                            $error['reason'] = $this->image_lib->display_errors();
                            $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }


            $res = $this->product_model->updateSubCategory($post, $cat_image);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'sub_cat_updated', $post);
                $this->loadPage(lang('sub_cat_updated_successfully'), 'sub-cat-manage');
            } else {
                $this->loadPage(lang('sub_cat_updation_failed'), 'sub-cat-manage', 'danger');
            }
        }


        $all_cat = $this->product_model->getAllCaegories();
        $category_id = isset($product['category_id']) ? $product['category_id'] : 0;
        $sub_cat = $this->product_model->getAllSubCategories($category_id);

        $this->setData('sub_cats', $sub_cat);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('product_id', $product_id);
        $this->setData('sub_cat', $sub_cat_details);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('all_cat', $all_cat);
        $this->setData('title', lang('menu_name_180'));
        $this->loadView();
    }

    function validate_add_cat() {
        $this->form_validation->set_rules('category', lang('category'), 'required');
        $this->form_validation->set_rules('description', lang('description'), 'required');
        $this->form_validation->set_rules('parent', lang('parent'), 'required');
        $this->form_validation->set_rules('stores', lang('stores'), 'required');
        $this->form_validation->set_rules('keyword', lang('keyword'), 'required');
        $this->form_validation->set_rules('sort_order', lang('sort_order'), 'required|numeric|greater_than[0]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function validate_add_sub_cat() {
        $this->form_validation->set_rules('category', lang('category'), 'required');
        $this->form_validation->set_rules('sub_cat_name', lang('sub_cat_name'), 'required');
        $this->form_validation->set_rules('sub_cat_order', lang('sub_cat_order'), 'required|numeric|greater_than[0]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $validation = $this->form_validation->run();
        return $validation;
    }

    function category_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'category';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'category',
            'description',
            'sort_order',
            'creation_date',
            'status',
        );

        $column = $this->product_model->getTableColumnCategoryList();
        $total_records = $this->product_model->countOfCategoryList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->product_model->getTotalFilteredProductList($table, $where);
        $res_data = $this->product_model->getResultDataProductList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][3] = $this->product_model->getCatOrder($res_data[$i][0]);

            if ($res_data[$i][5] == 1) {
                $res_data[$i][5] = '<a href="javascript:edit_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title=' . lang('inactivate') . '><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:edit_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:activate_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
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

    function sub_category_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'subcategory';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'sub_category',
            'category_id',
            'creation_date',
            'updation_date',
            'status',
        );

        $column = $this->product_model->getTableColumnSubCategoryList();
        $total_records = $this->product_model->countOfSubCategoryList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->product_model->getTotalFilteredProductList($table, $where);
        $res_data = $this->product_model->getResultDataProductList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][4] = $this->product_model->getSubCatOrder($res_data[$i][0]);
            $res_data[$i][2] = $this->product_model->catIdToName($res_data[$i][2]);

            if ($res_data[$i][5] == 1) {
                $res_data[$i][5] = '<a href="javascript:edit_sub_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_sub_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title=' . lang('inactivate') . '><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_sub_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:edit_sub_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title=' . lang('edit') . '><i class="fa fa-edit"></i></a> <a href="javascript:activate_sub_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title=' . lang('activate') . '><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_sub_cat(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title=' . lang('delete') . '><i class="fa fa-trash fa fa-white"></i></a>';
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


    // Categories

    public function categories($action = "", $product_id = "") {

        $loged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $cat_details = array();
        $cat_image = array();
        $files = array();
        $edit_id = 0;
        $cat_details['image'] = 'cat-banner-1.jpg';

        $edit_flag = FALSE;
        if ($action && $product_id) {

            if ($action == "cat_edit") {
                $edit_flag = TRUE;
                $cat_details = $this->product_model->getCatDetails($product_id);
                // $cat_image =$this->product_model->getAllFiles($cat_details['image']);

                $image = unserialize($cat_details['image']);
               
                $i = 0;
                foreach ($image as $key => $img) {
                    $files[$i]['id'] = $key;
                    $files[$i]['src'] = 'assets/shop/images/product/'.$img['file_name'];
                    $i++;
                }
            } elseif ($action == "cat_delete") {
                $res = $this->product_model->deleteCategory($product_id);
                if ($res) {
                    $data['product_id'] = $product_id;
                    $this->helper_model->insertActivity($loged_user_id, 'cat_deleted', $data);
                    $this->loadPage(lang('cat_deleted_complete'), 'categories','success');
                } else {
                    $this->loadPage(lang('cat_deleted_failed'), 'categories', 'danger');
                }
            } else {
                $this->loadPage(lang('invalid_action'), 'categories', 'danger');
            }
        }
        
        if ($this->input->post('add_cat')) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $config['upload_path'] = FCPATH . 'assets/shop/images/product/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->load->library('upload', $config);
            $upload_data = array();
            
            $files = $_FILES;
            // print_r($files);die;
            $cpt = count($_FILES['images']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['images']['name'][$i];
                $_FILES['userfile']['type'] = $files['images']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['images']['error'][$i];
                $_FILES['userfile']['size'] = $files['images']['size'][$i];

                $new_name = 'cat_' . time();
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $data_upload = $this->upload->data();
                    $upload_data[] = $data_upload;
                    if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                        if (isset($data_upload['full_path'])) {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $data_upload['full_path'],
                                'maintain_ratio' => TRUE,
                                'width' => 500,
                                'height' => 500,
                            );
                            $this->image_lib->initialize($configer);
                            if (!$this->image_lib->resize()) {
                                $error['reason'] = $this->image_lib->display_errors();
                                $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
                            }
                            $this->image_lib->clear();
                        }
                    }
                }
            }
              $res = $this->product_model->addCategory($post, $upload_data);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'cat_added', $post);

                $this->loadPage(lang('cat_added_successfully'), 'categories', 'success');
            } else {
                $this->loadPage(lang('cat_adding_failed'), 'categories', 'danger');
            }
        }

        if ($this->input->post('update_cat')) {
            $files = $_FILES;
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $cat_image = $this->product_model->getCategoryImage($post['update_cat']);
            $cat_image1 = unserialize($cat_image);
        
            $config['upload_path'] = FCPATH . 'assets/shop/images/product/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->load->library('upload', $config);
            $upload_data = array();
            $upload_data = $cat_image1;
            
            $files = $_FILES;
            // print_r($files);die;
            $cpt = count($_FILES['images']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['images']['name'][$i];
                $_FILES['userfile']['type'] = $files['images']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['images']['error'][$i];
                $_FILES['userfile']['size'] = $files['images']['size'][$i];

                $new_name = 'cat_' . time();
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload()) {
                    $data_upload = $this->upload->data();
                    $upload_data[] = $data_upload;
                    if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                        if (isset($data_upload['full_path'])) {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $data_upload['full_path'],
                                'maintain_ratio' => TRUE,
                                'width' => 500,
                                'height' => 500,
                            );
                            $this->image_lib->initialize($configer);
                            if (!$this->image_lib->resize()) {
                                $error['reason'] = $this->image_lib->display_errors();
                                $this->helper_model->insertFailedActivity($loged_user_id, 'resize_fail', $error);
                            }
                            $this->image_lib->clear();
                        }
                    }
                }
            }
            $res = $this->product_model->updateCategory($post, $upload_data);
            if ($res) {
                $this->helper_model->insertActivity($loged_user_id, 'cat_updated', $post);
                $this->loadPage(lang('cat_updated_successfully'), 'categories','success');
            } else {
                $this->loadPage(lang('cat_updation_failed'), 'categories', 'danger');
            }
        }
        $data = $this->product_model->getCategoryLists();
        $this->setData('data', $data);
        $this->setData('category', $cat_details);
        $this->setData('cat_image', $files);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('product_id', $product_id);
        $this->setData('edit_flag', $edit_flag);
        $this->setData('title', lang('menu_name_195'));
        $this->setData('edit_id', $edit_id);
        $this->loadView();
    }
    function image_upload(){
        $request = $_FILES;
        print_r($request);die;
    }
    public function imagedelete(){
        $this->load->helper('security');
        $get = $this->input->get();
        $cat_details = $this->product_model->getCatDetails($get['product_id']);
        $cat_image = unserialize($cat_details['image']);
        unset($cat_image[$get['parent']]);
        $res = $this->product_model->updateimage($get['product_id'],$cat_image);
        if($res){
            echo 'yes';
            exit();
        }
        echo 'no';
        exit();
    }
}
