<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Base_Controller.php';

/**
 * For create news  into the system
 * Controller used to add latest news the system
 * @author Techffodils Technologis LLP
 * @date 2017-12-04
 */
class News extends Base_Controller {

    /**
     * For add news and edit,update,delete option where done using this function
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     * @param type $action
     * @param type $news_id
     */
    public function add($action = '', $news_id = '') {
        $edit_flag = FALSE;
        $logged_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $news_data = array();
        if ($this->input->post('add_news') && $this->validate_news()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $post['news_img'] = '';
            $config['upload_path'] = FCPATH . 'assets/images/news/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'news_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('news_image')) {
                $data_upload = $this->upload->data();
                $post['news_img'] = $data_upload['file_name'];
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
                            $this->helper_model->insertFailedActivity($logged_user_id, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }

            $res = $this->news_model->addNews($logged_user_id, $post, 1);

            if ($res) {
                $this->helper_model->insertActivity($logged_user_id, 'news_added', $post);
                $this->loadPage(lang('news_added'), 'news-add');
            } else {
                $this->loadPage(lang('add_failed'), 'news-add', 'danger');
            }
        }


        if ($action && $news_id) {
            $activity['action'] = $action;
            $activity['news_id'] = $news_id;
            if ($action == 'activate') {
                $res = $this->news_model->changeNewsStatus($news_id, 1);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'news_activate', $activity);
                    $this->loadPage(lang('news_activated'), 'news-add');
                } else {
                    $this->loadPage(lang('failed_to_activate'), 'news-add');
                }
            } elseif ($action == 'inactivate') {
                $res = $this->news_model->changeNewsStatus($news_id, 0);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'news_inactivate', $activity);
                    $this->loadPage(lang('news_inactivated'), 'news-add');
                } else {
                    $this->loadPage(lang('failed_to_inactivate'), 'news-add');
                }
            } elseif ($action == 'delete') {
                $res = $this->news_model->deleteNews($news_id);
                if ($res) {
                    $this->helper_model->insertActivity($logged_user_id, 'news_deleted', $activity);
                    $this->loadPage(lang('news_deleted_succ'), 'news-add');
                } else {
                    $this->loadPage(lang('failed_to_news_deleted'), 'news-add');
                }
            } elseif ($action == 'edit') {
                $edit_flag = TRUE;
                $news_data = $this->news_model->getAllNews('', $news_id);
            }
        }


        if ($this->input->post('update_news') && $this->validate_news()) {
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());
            $post['news_img'] = '';
            $config['upload_path'] = FCPATH . 'assets/images/news/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = 'news_' . time();
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('news_image')) {
                $data_upload = $this->upload->data();
                $post['news_img'] = $data_upload['file_name'];
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
                            $this->helper_model->insertFailedActivity($logged_user_id, 'resize_fail', $error);
                        }
                        $this->image_lib->clear();
                    }
                }
            }
            $res = $this->news_model->updateNews($post);
            if ($res) {
                $this->helper_model->insertActivity($logged_user_id, 'news_updated', $post);
                $this->loadPage(lang('news_updated'), 'news-add');
            } else {
                $this->loadPage(lang('update_failed'), 'news-add', 'danger');
            }
        }

        $this->setData('edit_flag', $edit_flag);
        $this->setData('news_data', $news_data);
        $this->setData('news_id', $news_id);
        $this->setData('error', $this->form_validation->error_array());
        $this->setData('title', lang('menu_name_45'));
        $this->loadView();
    }

    /**
     * For validate the entered news form fields
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     * @return type
     */
    function validate_news() {
        $this->form_validation->set_rules('news_title', lang('new_title'), 'trim|required');
        $this->form_validation->set_rules('news_content', lang('new_content'), 'trim|required');
        if (!empty($_FILES['news_image']['name'])) {
            $this->form_validation->set_rules('news_image', lang('please_select_file'), 'trim');
        }


        return $this->form_validation->run();
    }

    /**
     * For valid file mime types
     * 
     * @param type $str
     * @return boolean
     */
    function valid_uploadfile() {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
        $mime = get_mime_by_extension($_FILES['news_image']['name']);
        if (isset($_FILES['news_image']['name']) && $_FILES['news_image']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('valid_uploadfile', lang('please_upload_allowed_file'));
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('valid_uploadfile', lang('please_select_file'));
            return false;
        }
    }

    /**
     * For load the news timeline
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    public function timeline() {
        $news = $this->news_model->getAllNews(1);
        $this->setData('news', $news);
        $this->setData('title', lang('menu_name_154'));
        $this->loadView();
    }

    /**
     * For more news to the system
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    public function load_more() {
        $msg_id = $this->input->get('last_news', null);
        $news = $this->news_model->getAllNews(1, 0, $msg_id);
        $this->_setOutput($news);
    }

    /**
     * For setting up the news to the view
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     * @param type $data
     */
    private function _setOutput($data) {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo json_encode($data);
        exit();
    }

    /**
     * For view the news list
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    function news_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'news';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'content',
            'image',
            'date',
            'status'
        );
        $column = $this->news_model->getTableColumnNewsList();
        $total_records = $this->news_model->countOfNewsList();
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->news_model->getTotalFilteredNewsList($table, $where);
        $res_data = $this->news_model->getResultDataNewsList($table, $columns, $where, $order, $limit);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][2] = strip_tags(implode(' ', array_slice(explode(' ', $res_data[$i][2]), 0, 3))) . '.....';

            if ($res_data[$i][3]) {
                $res_data[$i][3] = '<img src="assets/images/news/' . $res_data[$i][3] . '" alt="offce" width="50px;" height="auto">';
            } else {
                $res_data[$i][3] = lang('na');
            }
            if ($res_data[$i][5]) {
                $res_data[$i][5] = '<a href="javascript:edit_news(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:inactivate_news(' . $res_data[$i][0] . ')" class="btn btn-xs btn-yellow tooltips" data-placement="top" title="' . lang('inactivate') . '"><i class="fa fa-times fa fa-white"></i></a>';
            } else {
                $res_data[$i][5] = '<a href="javascript:edit_news(' . $res_data[$i][0] . ')" class="btn btn-xs btn-blue tooltips" data-placement="top" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a> <a href="javascript:activate_news(' . $res_data[$i][0] . ')" class="btn btn-xs btn-green tooltips" data-placement="top" title="' . lang('activate') . '"><i class="glyphicon glyphicon-ok-sign"></i></a>';
            }

            $res_data[$i][5] .= ' <a href="javascript:delete_news(' . $res_data[$i][0] . ')" class="btn btn-xs btn-red tooltips" data-placement="top" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

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
     * For load the news view
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    public function view() {
        $this->setData('title', lang('menu_name_46'));
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

    function view_news_list() {
        $request = $this->input->get();
        $table = DB_PREFIX_SYSTEM . 'news';
        $limit = $order = $where = '';
        $columns = array(
            'id',
            'title',
            'content',
            'image',
            'date'
        );
        $to_date = $this->session->userdata('view_to_date');
        $from_date = $this->session->userdata('view_from_date');

        $column = $this->news_model->getTableColumnViewNewsList();
        $total_records = $this->news_model->countViewNewsList($from_date, $to_date);
        $limit = $this->base_model->getTotalDataLimit($request);
        $order = $this->base_model->getTotalDataOrder($request, $column);
        $where = $this->base_model->getTotalDataWhere($request, $column);

        $record_filtered = $this->news_model->getTotalFilteredViewNewsList($table, $where, $from_date, $to_date);
        $res_data = $this->news_model->getResultDataViewNewsList($table, $columns, $where, $order, $limit, $from_date, $to_date);
        $count_product = count($res_data);
        for ($i = 0; $i < $count_product; $i++) {
            $res_data[$i][1] = '<a href="javascript:view_image(' . $res_data[$i][0] . ')"><div style="width:200px;">' . $res_data[$i][1] . '</div></a>';
            $res_data[$i][2] = '<div style="height: 75px;overflow:auto;">' . $res_data[$i][2] . '</div>';
            if ($res_data[$i][3]) {
                $res_data[$i][3] = '<a href="javascript:view_image(' . $res_data[$i][0] . ')"><img src="assets/images/news/' . $res_data[$i][3] . '" alt="" width="50px;" height="auto"></a>';
            } else {
                $res_data[$i][3] = lang('na');
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

    function get_news_details() {
        if ($news_id = $this->input->get('news_id')) {
            echo $this->news_model->createNewsDetails($news_id);
            exit();
        }
        echo 'no';
        exit();
    }

}
