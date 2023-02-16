<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

class Document extends Base_Controller {

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     * @param type $action
     * @param type $file_id
     * @param type $tab
     */
    function upload($action = '', $file_id = '', $tab = '') {
        $logged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $error1 = $error2 = $error3 = $error4 = array();
        if ($this->input->post('add_docs')) {
            if ($this->validate_docs('tab1', 'add_docs')) {
                $this->load->helper('security');
                $post = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = FCPATH . 'assets/images/documents/';
                $config['allowed_types'] = 'ppt|txt|pdf|pptx|csv|zip|xlx|xlxs';
                $new_name = 'doc_' . time();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('document')) {
                    $upload_data = array('upload_data' => $this->upload->data());
                    $document = $upload_data['upload_data']['file_name'];
                    $extension = $upload_data['upload_data']['file_ext'];
                    $file_size = $upload_data['upload_data']['file_size'];
                    $doc_title = $post['doc_title'];

                    $res = $this->document_model->addDocument($logged_user_id, $doc_title, $document, $extension, $file_size, $upload_data, 'docs');
                    if ($res) {
                        $this->helper_model->insertActivity($logged_user_id, 'doc_added', $post);
                        $this->loadPage(lang('doc_uploaded'), 'document-upload');
                    }
                }
                $this->loadPage(lang('upload_failed'), 'document-upload', 'danger');
            }
            $error1 = $this->form_validation->error_array();
        }

        if ($this->input->post('add_vdos')) {
            if ($this->validate_docs('tab2', 'add_vdos')) {
                $this->load->helper('security');
                $post = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = FCPATH . 'assets/images/documents/';
                $config['allowed_types'] = 'mp4|3gp|mkv|flv';
                $new_name = 'vdo_' . time();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('document')) {
                    $upload_data = array('upload_data' => $this->upload->data());
                    $document = $upload_data['upload_data']['file_name'];
                    $extension = $upload_data['upload_data']['file_ext'];
                    $file_size = $upload_data['upload_data']['file_size'];
                    $doc_title = $post['doc_title'];

                    $res = $this->document_model->addDocument($logged_user_id, $doc_title, $document, $extension, $file_size, $upload_data, 'vdo');
                    if ($res) {
                        $this->helper_model->insertActivity($logged_user_id, 'vdo_added', $post);
                        $this->loadPage(lang('doc_uploaded'), 'document-upload');
                    }
                }
                $this->loadPage(lang('upload_failed'), 'document-upload', 'danger');
            }
            $error2 = $this->form_validation->error_array();
        }


        if ($this->input->post('add_img')) {
            if ($this->validate_docs('tab3', 'add_img')) {
                $this->load->helper('security');
                $post = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = FCPATH . 'assets/images/documents/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $new_name = 'img_' . time();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('document')) {
                    $upload_data = $this->upload->data();
                    $document = $upload_data['file_name'];
                    $extension = $upload_data['file_ext'];
                    $file_size = $upload_data['file_size'];
                    $doc_title = $post['doc_title'];

                    if ($this->dbvars->IMAGE_RESIZE_STATUS) {
                        if (isset($upload_data['full_path'])) {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $upload_data['full_path'],
                                'maintain_ratio' => TRUE,
                                'width' => 500,
                                'height' => 500,
                            );
                            $this->image_lib->initialize($configer);
                            if (!$this->image_lib->resize()) {
                                $error['reason'] = $this->image_lib->display_errors();
                                $this->helper_model->insertFailedActivity($logged_user_id, 'resize_fail', $error);
                            }
                            $this->image_lib->clear();
                        }
                    }
                    $res = $this->document_model->addDocument($logged_user_id, $doc_title, $document, $extension, $file_size, $upload_data, 'img');
                    if ($res) {
                        $this->helper_model->insertActivity($logged_user_id, 'img_added', $post);
                        $this->loadPage(lang('doc_uploaded'), 'document-upload');
                    }
                }
                $this->loadPage(lang('upload_failed'), 'document-upload', 'danger');
            }
            $error3 = $this->form_validation->error_array();
        }

        if ($this->input->post('add_aud')) {
            if ($this->validate_docs('tab4', 'add_aud')) {
                $this->load->helper('security');
                $post = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = FCPATH . 'assets/images/documents/';
                $config['allowed_types'] = 'mp3|wav|pcm';
                $new_name = 'aud_' . time();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('document')) {
                    $upload_data = array('upload_data' => $this->upload->data());
                    $document = $upload_data['upload_data']['file_name'];
                    $extension = $upload_data['upload_data']['file_ext'];
                    $file_size = $upload_data['upload_data']['file_size'];
                    $doc_title = $post['doc_title'];
                    $res = $this->document_model->addDocument($logged_user_id, $doc_title, $document, $extension, $file_size, $upload_data, 'aud');
                    if ($res) {
                        $this->helper_model->insertActivity($logged_user_id, 'aud_added', $post);
                        $this->loadPage(lang('doc_uploaded'), 'document-upload');
                    }
                }
                $this->loadPage(lang('upload_failed'), 'document-upload', 'danger');
            }
            $error4 = $this->form_validation->error_array();
        }


        if ($action && $file_id) {
            $activity['action'] = $action;
            $activity['file_id'] = $file_id;
            $this->session->set_userdata('file_active_tab', $tab);
            if ($action == 'inactivate') {
                $res = $this->document_model->changeFileStatus($file_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'file_inactivated', $activity);
                    $this->loadPage(lang('file_inactivated'), 'document-upload');
                }
                $this->loadPage(lang('inactivation_failed'), 'document-upload', 'danger');
            } elseif ($action == 'activate') {
                $res = $this->document_model->changeFileStatus($file_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'file_activated', $activity);
                    $this->loadPage(lang('file_activated'), 'document-upload');
                }
                $this->loadPage(lang('activation_failed'), 'document-upload', 'danger');
            } elseif ($action == 'delete') {
                $res = $this->document_model->deleteFile($file_id);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'file_deleted', $activity);
                    $this->loadPage(lang('file_deleted'), 'document-upload');
                }
                $this->loadPage(lang('deletion_failed'), 'document-upload', 'danger');
            } else {
                $this->loadPage(lang('invalid_action'), 'document-upload', 'danger');
            }
        }

        $tab1 = $tab2 = $tab3 = $tab4 = '';
        if ($this->session->userdata('file_active_tab')) {
            $tab = $this->session->userdata('file_active_tab');
            if ($tab == 'tab1') {
                $tab1 = ' active';
            } elseif ($tab == 'tab2') {
                $tab2 = ' active';
            } elseif ($tab == 'tab3') {
                $tab3 = ' active';
            } elseif ($tab == 'tab4') {
                $tab4 = ' active';
            } else {
                $tab1 = ' active';
            }
        } else {
            $tab1 = ' active';
        }
        $this->setData('error1', $error1);
        $this->setData('error2', $error2);
        $this->setData('error3', $error3);
        $this->setData('error4', $error4);
        $this->setData('tab1', $tab1);
        $this->setData('tab2', $tab2);
        $this->setData('tab3', $tab3);
        $this->setData('tab4', $tab4);

        $this->setData('title', lang('menu_name_73'));
        $this->loadView();
    }

    /**
     * @author Techffodils Technologies LLP
     * @date 2018-1-30

     * @param type $tab
     * @return type
     */
    function validate_docs($tab = '', $form_btn = '') {
        $this->session->set_userdata('file_active_tab', $tab);
        $this->form_validation->set_rules('doc_title', lang('doc_title'), 'required');
        if ($form_btn == 'add_docs') {
            if (empty($_FILES['document']['name'])) {
                $this->form_validation->set_rules('document', lang('document'), 'required|callback_check_valid_docsupload');
            }
        } else if ($form_btn == 'add_img') {
            if (empty($_FILES['document']['name'])) {
                $this->form_validation->set_rules('document', lang('document'), 'required|callback_check_valid_fileupload');
            }
        } else if ($form_btn == 'add_vdos') {
            if (empty($_FILES['document']['name'])) {
                $this->form_validation->set_rules('document', lang('document'), 'required|callback_check_valid_vdosupload');
            }
        } else if ($form_btn == 'add_aud') {
            if (empty($_FILES['document']['name'])) {
                $this->form_validation->set_rules('document', lang('document'), 'required|callback_check_valid_audioupload');
            }
        }

        return $this->form_validation->run();
    }

    /*
     * For checking only valid fileupload
     * 
     * @param type $str
     * @return boolean
     */

    function _check_valid_fileupload($str) {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
        $mime = get_mime_by_extension($_FILES['news_image']['name']);
        if (isset($_FILES['document']['name']) && $_FILES['document']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('check_valid_fileupload', lang('please_upload_allowed_file_types'));
                return false;
            }
        } else {
            $this->form_validation->set_message('check_valid_fileupload', lang('please_select_file'));
            return false;
        }
    }

    /**
     * 
     * @param type $str
     * @return boolean
     */
    function _check_valid_audioupload($str) {
        $allowed_mime_type_arr = array('audio/mpeg', 'audio/mpg', 'audio/mp3', 'application/octet-stream');
        $mime = get_mime_by_extension($_FILES['news_image']['name']);
        if (isset($_FILES['document']['name']) && $_FILES['document']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('check_valid_fileupload', lang('please_upload_allowed_file_types'));
                return false;
            }
        } else {
            $this->form_validation->set_message('check_valid_fileupload', lang('please_select_file'));
            return false;
        }
    }

    /**
     * 
     * @param type $str
     * @return boolean
     */
    function _check_valid_docsupload($str) {

        $allowed_mime_type_arr = array('document/ppt', 'document/txt', 'document/pdf', 'document/pptx', 'document/csv', 'document/zip');
        $mime = get_mime_by_extension($_FILES['news_image']['name']);
        if (isset($_FILES['document']['name']) && $_FILES['document']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('check_valid_fileupload', lang('please_upload_allowed_file_types'));
                return false;
            }
        } else {
            $this->form_validation->set_message('check_valid_fileupload', lang('please_select_file'));
            return false;
        }
    }

    /**
     * 
     * @param type $str
     * @return boolean
     */
    function _check_valid_vdosupload($str) {
        $allowed_mime_type_arr = array('video/mp4', 'video/3gpp', 'application/octet-stream');
        $mime = get_mime_by_extension($_FILES['news_image']['name']);
        if (isset($_FILES['document']['name']) && $_FILES['document']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('check_valid_fileupload', lang('please_upload_allowed_file_types'));
                return false;
            }
        } else {
            $this->form_validation->set_message('check_valid_fileupload', lang('please_select_file'));
            return false;
        }
    }

    /**
     * For download file
     * @param type $file_name
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function download_file($file_name = "") {
        //$file_name='aud_1510579588.mp3';
        if ($file_name) {
            $path = FCPATH . "assets/images/documents/" . $file_name;
            $this->load->helper('download');
            force_download($path, NULL);
        }
    }

    /**
     * for document 
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function document_docs() {
        $request = $this->input->get();
        $doc_type = 'docs';
        $table = DB_PREFIX_SYSTEM . 'documents';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'document',
            'size',
            'date',
            'status'
        );
        $column = $this->document_model->getTableColumnDocumentList();
        $total_records = $this->document_model->countOfDocumentList($doc_type);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->document_model->getTotalFilteredDocumentList($table, $where, $doc_type);
        $res_data = $this->document_model->getResultDataDocumentList($table, $columns, $where, $order, $limit, $doc_type);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:inactivate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:activate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
     * For document vdo
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function document_vdo() {
        $request = $this->input->get();
        $doc_type = 'vdo';
        $table = DB_PREFIX_SYSTEM . 'documents';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'document',
            'size',
            'date',
            'status'
        );
        $column = $this->document_model->getTableColumnDocumentList();
        $total_records = $this->document_model->countOfDocumentList($doc_type);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->document_model->getTotalFilteredDocumentList($table, $where, $doc_type);
        $res_data = $this->document_model->getResultDataDocumentList($table, $columns, $where, $order, $limit, $doc_type);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:inactivate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:activate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
     * For document Images
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function document_img() {
        $request = $this->input->get();
        $doc_type = 'img';
        $table = DB_PREFIX_SYSTEM . 'documents';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'document',
            'size',
            'date',
            'status'
        );
        $column = $this->document_model->getTableColumnDocumentList();
        $total_records = $this->document_model->countOfDocumentList($doc_type);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->document_model->getTotalFilteredDocumentList($table, $where, $doc_type);
        $res_data = $this->document_model->getResultDataDocumentList($table, $columns, $where, $order, $limit, $doc_type);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:inactivate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:activate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
     * For document audio
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function document_aud() {
        $request = $this->input->get();
        $doc_type = 'aud';
        $table = DB_PREFIX_SYSTEM . 'documents';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'document',
            'size',
            'date',
            'status'
        );
        $column = $this->document_model->getTableColumnDocumentList();
        $total_records = $this->document_model->countOfDocumentList($doc_type);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->document_model->getTotalFilteredDocumentList($table, $where, $doc_type);
        $res_data = $this->document_model->getResultDataDocumentList($table, $columns, $where, $order, $limit, $doc_type);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:inactivate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a target="_BLANK" href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-times fa fa-eye"></i></a> <a href="javascript:activate_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a> <a href="javascript:delete_file(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash fa fa-white"></i></a>';
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
     * 
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    function grid_view() {
        $files = $this->document_model->getAllFiles();

        $logged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();

        $this->setData('files', $files);
        $this->setData('title', lang('menu_name_157'));
        $this->loadView();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @date 2018-1-30
     */
    public function view() {
        $this->setData('title', lang('menu_name_74'));


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

    function view_document_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'documents';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'document',
            'size',
            'file_type',
            'date',
            'status'
        );

        $to_date = $this->session->userdata('view_to_date');
        $from_date = $this->session->userdata('view_from_date');

        $column = $this->document_model->getTableColumnViewDocumentList();
        $total_records = $this->document_model->countViewDocumentList($from_date, $to_date);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->document_model->getTotalFilteredViewDocumentList($table, $where, $from_date, $to_date);
        $res_data = $this->document_model->getResultDataViewDocumentList($table, $columns, $where, $order, $limit, $from_date, $to_date);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][6] = '<a target=' . '_BLANK' . ' href="assets/images/documents/' . $res_data[$i][2] . '" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('view') . '"><i class="fa fa-eye"></i> </a>
                                       <a href="admin/document-download/' . $res_data[$i][2] . '" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('download') . '"><i class="fa fa-download"></i></a>';
            if ($res_data[$i][4] == 'img') {
                $res_data[$i][2] = '<img src="assets/images/documents/' . $res_data[$i][2] . '" alt="offce" width="50px;" height="auto">';
            } elseif ($res_data[$i][4] == 'docs') {
                $res_data[$i][2] = '<img src="assets/images/documents/no_doc.jpg" alt="offce" width="50px;" height="auto">';
            } elseif ($res_data[$i][4] == 'vdo') {
                $res_data[$i][2] = '<img src="assets/images/documents/no_vdo.jpg" alt="offce" width="50px;" height="auto">';
            } elseif ($res_data[$i][4] == 'aud') {
                $res_data[$i][2] = '<img src="assets/images/documents/no_aud.png" alt="offce" width="50px;" height="auto">';
            }
            $res_data[$i][4] = lang('' . $res_data[$i][4] . '');




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

}
