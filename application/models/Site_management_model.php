<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For 
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Site_management_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * For getting site info
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function get_site_info() {
        $result = $this->db->select("*")
                ->from('site_info')
                ->get();
        foreach ($result->result_array() as $row) {
            $site_data['company_name'] = $row['company_name'];
            $site_data['company_address'] = $row['company_address'];
            $site_data['company_logo'] = $row['company_logo'];
            $site_data['company_fav_icon'] = $row['company_fav_icon'];
            $site_data['company_email'] = $row['company_email'];
            $site_data['company_phone'] = $row['company_phone'];
            $site_data['admin_email'] = $row['admin_email'];
            $site_data['google_analytics'] = $row['google_analytics'];
        }
        return $site_data;
    }

    /**
     * For update the site information
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $company_name
     * @param type $admin_email
     * @param type $company_address
     * @param type $company_email
     * @param type $company_phone
     * @param type $logo
     * @param type $fav_icon
     * @return type
     */
    function updateSiteInformation($company_name, $admin_email, $company_address, $company_email, $company_phone, $logo, $fav_icon) {
        $data_array = array('company_name' => $company_name, 'admin_email' => $admin_email, 'company_address' => $company_address, 'company_email' => $company_email, 'company_phone' => $company_phone, 'company_logo' => $logo, 'company_fav_icon' => $fav_icon);
        $this->db->where('id', 1)
                ->update('site_info', $data_array);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return true;
//        if ($result) {
//            $this->db->set('email', $admin_email)->where('user_type', 'admin')->where('mlm_user_id', 1900)->update('user');
//        }
        //return $result;
    }

    /**
     * For get all language
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @return type
     */
    function getAllLangauage($type = '') {
        $result = $this->db->select("l.id ,l.lang_code,mc.subject,mc.content,l.lang_name")
                ->from('languages as l')
                ->join('mail_content as mc', 'mc.lang_id=l.id')
                ->where('mc.status', 1)
                ->where('mc.content_type', $type)
                ->get();

        $i = 0;
        $data = array();
        foreach ($result->result_array() as $row) {
            $index = $row['lang_code'];
            $data[$index]['lang_id'] = $row['id'];
            $data[$index]['lang_name'] = $row['lang_name'];
            $data[$index]['lang_code'] = $row['lang_code'];

            $data[$index]['subject'] = $row['subject'];
            $data[$index]['content'] = $row['content'];
            $i++;
        }
        return $data;
    }

    /**
     * For insert mail content
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $content
     * @param type $subject
     * @param type $lang_id
     * @param type $content_type
     * @param type $content_lang_type
     * @return type
     */
    function insertMailContent($content, $subject, $lang_id, $content_type, $content_lang_type) {

        if ($this->checkContentBasedOnIdAlreadyExits($lang_id, $content_type)) {

            $result = $this->db->set('content', $content)->set('subject', $subject)->set('lang_id', $lang_id)->set('content_type', $content_type)->set('status', 1)->insert('mail_content');
            return $result;
        } else {

            $data = array('content' => $content, 'subject' => $subject);
            $result = $this->db->where('lang_id', $lang_id)->where('content_type', $content_type)->update('mail_content', $data);
            return $result;
        }
    }

    /**
     * For check content based already exists or not
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $lang_id
     * @param type $type
     * @return boolean
     */
    function checkContentBasedOnIdAlreadyExits($lang_id, $type) {

        $exists = $this->db->select("count(*)")->from('mail_content')->where('content_type', $type)->where('lang_id', $lang_id)->count_all_results();

        if ($exists > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * For all mail content details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllMailContentDetails() {

        $result = $this->db->select('subject,content,lang_id')->from('mail_content')->where('status', 1)->get();

        $i = 0;
        $data = array();
        foreach ($result->result() as $row) {
            $index = $this->getLangcode($row->lang_id);
            $data[$index]['subject'] = $row->subject;
            $data[$index]['content'] = $row->content;
            $data[$index]['lang_id'] = $row->lang_id;

            $i++;
        }
        return $data;
    }

    /**
     * For getting lang code
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function getLangcode($id) {
        $result = $this->db->select("lang_code")->from('languages')->where('id', $id)->get();
        foreach ($result->result() as $row) {
            $lang_code = $row->lang_code;
        }
        return $lang_code;
    }

    /**
     * For insert mail content details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $post_arr
     * @return boolean
     */
    function insertMailContenetDetails($post_arr) {
        //print_r($post_arr);die;
        $flag = '';
        $activity = 'mail_settings_updated';
        $result_status = $this->db->set('host_name', $post_arr['host_name'])
                ->set('smtp_username', $post_arr['smtp_username'])
                ->set('from_mail', $post_arr['from_mail'])
                ->set('smtp_password', $post_arr['smtp_password'])
                ->set('smtp_port', $post_arr['smtp_port'])
                ->set('mail_engine', $post_arr['mail_engine'])
                ->where('id', 1)
                ->update('mail_settings');

        $flag = TRUE;

        if ($result_status) {
            $this->helper_model->insertActivity($post_arr['user_id'], $activity, serialize($post_arr));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * For check email mail engine already exits or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $mail_engine
     * @return boolean
     */
    function checkMailEnginealreadyExitsOrNot($mail_engine) {
        $count_result = $this->db->select('count(*)')->from('mail_settings')->where('mail_engine', $mail_engine)->count_all_results();
        if ($count_result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * For get all active languages
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @return type
     */
    function getAllActiveLangauges($status = 1) {
        $this->db->select("lang_code,id,lang_name");
        $this->db->from('languages');
        if ($status) {
            $this->db->where('status', $status);
        }
        $result = $this->db->get();
        $details = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['lang_code'] = $row['lang_code'];
            $details[$i]['lang_name'] = $row['lang_name'];
            $i++;
        }
        return $details;
    }

    /**
     * For get all system emails
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getAllSystemMails() {
        $active_mail_content_tab = '';
        if ($this->session->userdata('active_mail_content_tab') != null)
            $active_mail_content_tab = $this->session->userdata('active_mail_content_tab');

        $result = $this->db->select('id,type,status')
                ->where('status', 1)
                ->from('system_mails')
                ->get();
        $details = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            if ($active_mail_content_tab) {
                if ($this->getMailType($active_mail_content_tab) == $row['type']) {
                    $details[$i]['active'] = 1;
                } else {
                    $details[$i]['active'] = 0;
                }
            } elseif (!$i) {
                $details[$i]['active'] = 1;
            } else {
                $details[$i]['active'] = 0;
            }
            $details[$i]['id'] = $row['id'];
            $details[$i]['type'] = $row['type'];
            $details[$i]['status'] = $row['status'];
            $details[$i]['contents'] = $this->getAllMailContents($row['type'], $i, $active_mail_content_tab);
            $i++;
        }
        return $details;
    }

    /**
     * For get all mail contents
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @param type $index
     * @param type $active_mail_content_tab
     * @return string
     */
    function getAllMailContents($type, $index, $active_mail_content_tab = 0) {
        $lang_id = 0;
        if ($this->dbvars->MULTI_LANG_STATUS == 0) {
            $lang_id = $this->dbvars->LANG_ID;
        }
        $this->db->select('id,subject,content,status,lang_id')
                ->from('mail_content')
                ->where('content_type', $type);
        if ($lang_id) {
            $this->db->where('lang_id', $lang_id);
        }
        $result = $this->db->order_by('lang_id', 'ASC')
                ->get();
        $details = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            $lang_name = $this->getLangName($row['lang_id']);
            if ($lang_name) {
                if ($active_mail_content_tab) {
                    if ($active_mail_content_tab == $row['id']) {
                        $details[$i]['active'] = 1;
                    } else {
                        $details[$i]['active'] = 0;
                    }
                } elseif (!$i && !$index) {
                    $details[$i]['active'] = 1;
                } else {
                    $details[$i]['active'] = 0;
                }
                $details[$i]['id'] = $row['id'];
                $details[$i]['subject'] = $row['subject'];
                $details[$i]['content'] = $row['content'];
                $details[$i]['lang_id'] = $row['lang_id'];
                $details[$i]['status'] = $row['status'];
                $details[$i]['lang_name'] = $this->getLangName($row['lang_id']);
                $details[$i]['form'] = "method='post' class='mail_cont_form" . $row['id'] . "'";
                $i++;
            }
        }
        return $details;
    }

    /**
     * For getting language name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getLangName($id) {
        $lang_name = '';
        $query = $this->db->select('lang_name')
                ->where('id', $id)
                ->where('status', 1)
                ->limit(1)
                ->get('languages');
        foreach ($query->result() as $row) {
            $lang_name = $row->lang_name;
        }
        return $lang_name;
    }

    /**
     * For mail type
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getMailType($id) {
        $content_type = '';
        $query = $this->db->select('content_type')
                ->where('id', $id)
                ->limit(1)
                ->get('mail_content');
        foreach ($query->result() as $row) {
            $content_type = $row->content_type;
        }
        return $content_type;
    }

    /**
     * For update mail contents
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $content_id
     * @param type $data
     * @return type
     */
    function updateMailContent($content_id, $data) {
        $this->db->set('subject ', $data['mail_subject'])
                ->set('content ', $data['mail_content'])
                ->where('id ', $content_id)
                ->limit(1)
                ->update('mail_content');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For check all mail contents
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return boolean
     */
    function checkAllMailContents() {
        $langs = $this->getAllActiveLangauges(0);
        $result = $this->db->select('type')
                ->from('system_mails')
                ->get();
        foreach ($result->result_array() as $row) {
            $type = $row['type'];
            foreach ($langs as $l) {
                $langid = $l['id'];
                if (!$this->checkContentStatus($type, $langid)) {
                    $subj = $type . '_subject -' . $l['lang_name'];
                    $content = $type . '_content -' . $l['lang_name'];
                    $this->db->set('content', $content)
                            ->set('subject', $subj)
                            ->set('lang_id', $langid)
                            ->set('content_type', $type)
                            ->set('status', 1)
                            ->insert('mail_content');
                }
            }
        }
        return true;
    }

    /**
     * For check content status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @param type $lang_id
     * @return type
     */
    function checkContentStatus($type, $lang_id) {
        return $this->db->select("id")
                        ->from('mail_content')
                        ->where('content_type', $type)
                        ->where('lang_id', $lang_id)
                        ->count_all_results();
    }

    /**
     * For mail settings
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function mailSettingsInformation() {
        $mail_settings = array();
        $query = $this->db->get('mail_settings');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $mail_settings = $row;
            }
        }
        return $mail_settings;
    }

    /**
     * For getting site management data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getSiteManagementData() {
        $query = $this->db->select('mail_engine,host_name,from_mail,smtp_password,smtp_username,smtp_port')
                ->from('mail_settings')
                ->get();
        $data = [];
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $row;
    }

    /**
     * For system e-mails
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getSystemMails() {
        $result = $this->db->select('id,type,status')
                ->from('system_mails')
                ->get();
        $details = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['type'] = $row['type'];
            $details[$i]['status'] = $row['status'];
            $i++;
        }
        return $details;
    }

    /**
     * For change email status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $mail_id
     * @param type $status
     * @return type
     */
    function changeMailStatus($mail_id, $status) {
        $this->db->set('status', $status)
                ->where('id', $mail_id)
                ->update('system_mails');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For check admin email exits or  not
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $adminemail
     * @return boolean
     */
    function checkAdminEmailExistsOrNot($adminemail = '') {
        $currrent_email = $this->db->select('email')->from('user')->where('user_type', 'admin')->get()->row()->email;
        if ($adminemail == $currrent_email) {
            return TRUE;
        } else {
            $count_result = $this->db->select('count(*)')->from('user')->like('email', $adminemail)->where('user_status', 'active')->count_all_results();
            if ($count_result > 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    // Brand Settings

    function addBrand($data, $brand_image) {
        $this->db->set('brand_name', $data['brand_name'])
                ->set('image', $brand_image)
                ->set('created_date', date("Y-m-d H:i:s"))
                ->insert('brand_settings');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getBrandSettings($id) {
        $data = array();
        $res = $this->db->select("brand_name,image")
                ->from("brand_settings")
                ->where('id', $id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $data['brand_name'] = $row->brand_name;
            $data['image'] = $row->image;
        }
        return $data;
    }

    function getBrandLists() {
        $data = array();
        $res = $this->db->select("id,brand_name,image,created_date")
                ->from("brand_settings")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['brand_name'] = $row->brand_name;
            $data[$i]['image'] = $row->image;
            $data[$i]['created_date'] = $row->created_date;
            $i++;
        }
        return $data;
    }

    public function getBrandImage($id) {
        $image = ' ';
        $query = $this->db->select('image')
                ->where('id', $id)
                ->limit(1)
                ->get('brand_settings');
        if ($query->num_rows() > 0) {
            $image = $query->row()->image;
        }
        return $image;
    }

    function updateBrand($data, $brand_image) {

        $this->db->set('brand_name', $data['brand_name'])
                ->set('image', $brand_image)
                ->set('created_date', date("Y-m-d H:i:s"))
                ->where('id', $data['update_brand'])
                ->update('brand_settings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

// Slider Settings

    function getSliderSettings($id) {
        $data = array();
        $res = $this->db->select("title,subtitle,image,type,link")
                ->from("slider_info")
                ->where('id', $id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $data['title'] = $row->title;
            $data['subtitle'] = $row->subtitle;
            $data['image'] = $row->image;
            $data['type'] = $row->type;
            $data['link'] = $row->link;
        }
        return $data;
    }

    function addSlider($data, $brand_image) {
        $this->db->set('title', $data['title'])
                ->set('subtitle', $data['subtitle'])
                ->set('image', $brand_image)
                ->set('created_date', date("Y-m-d H:i:s"))
                ->set('type', $data['type'])
                ->set('link', $data['link'])
                ->set('pro_id', $data['product'])
                ->set('cat_id', $data['category'])
                ->insert('slider_info');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function updateSlider($data, $slider_image) {

        $this->db->set('title', $data['title'])
                ->set('subtitle', $data['subtitle'])
                ->set('image', $slider_image)
                ->set('created_date', date("Y-m-d H:i:s"))
                ->set('type', $data['type'])
                ->set('link', $data['link'])
                ->set('pro_id', $data['product'])
                ->set('cat_id', $data['category'])
                ->where('id', $data['update_slider'])
                ->update('slider_info');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getSliderLists() {
        $data = array();
        $res = $this->db->select("id,title,subtitle,image,created_date,type,link,pro_id,cat_id")
                ->from("slider_info")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['title'] = $row->title;
            $data[$i]['subtitle'] = $row->subtitle;
            $data[$i]['image'] = $row->image;
            $data[$i]['created_date'] = $row->created_date;
            $data[$i]['type'] = $row->type;
            $data[$i]['link'] = $row->link;
            $data[$i]['pro_id'] = $row->pro_id;
            $data[$i]['cat_id'] = $row->cat_id;
            $i++;
        }
        return $data;
    }

    public function getSliderImage($id) {
        $image = ' ';
        $query = $this->db->select('image')
                ->where('id', $id)
                ->limit(1)
                ->get('slider_info');
        if ($query->num_rows() > 0) {
            $image = $query->row()->image;
        }
        return $image;
    }

    function deleteSliderSettings($id) {
        $this->db->where('id', $id)
                ->delete('slider_info');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function deleteSeoSettings($id) {
        $this->db->where('id', $id)
                ->delete('seo_url');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function checkBrandId($brand_id) {
        // dd($brand_id);
        $data='';
        
        $query=$this->db->select('id')
                ->where('brand', $brand_id)
                ->limit(1)
                ->get('products');

            if ($query->num_rows() > 0) {
            // $data = $query->row()->id;
                return true;
        }
              return false;

                
    }
     function deleteBrandSettings($id) {

        $this->db->where('id', $id)
                ->delete('brand_settings');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function addSeoUrl($data) {
        
        // print_r($data);die;
        $this->db->set('seo_keyword', $data['seo_keyword'])
                ->set('seo_key', $data['seo_key'])
                ->set('seo_value', $data['seo_value'])
                ->insert('seo_url');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }


    function getAllSeoUrl(){        
        $data = array();
        $query = $this->db->select('id,seo_keyword,seo_key,seo_value')
                          ->from('seo_url')
                          ->get();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result_array() as $row) {
                $data[$i]['id'] = $row['id'];
                $data[$i]['seo_keyword'] = $row['seo_keyword'];
                $data[$i]['seo_key'] = $row['seo_key'];
                $data[$i]['seo_value'] = $row['seo_value'];
                
                $i++;
            }
        }
        return $data;
    }

    function getSeoDetails($id) {
        $data = array();
        $res = $this->db->select("id,seo_keyword,seo_key,seo_value,")
                ->from("seo_url")
                ->where('id', $id)
                ->limit(1)
                ->get();
        foreach ($res->result() as $row) {
            $data['seo_keyword'] = $row->seo_keyword;
            $data['seo_key'] = $row->seo_key;
            $data['seo_value'] = $row->seo_value;
            
        }
        return $data;
    }

    function updateSeo_url($data) {
        
        $this->db->set('seo_keyword', $data['seo_keyword'])
                ->set('seo_key', $data['seo_key'])
                ->set('seo_value', $data['seo_value'])
                ->where('id', $data['update_seo'])
                ->update('seo_url');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return true;
    }


}
