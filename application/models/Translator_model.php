<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For Language translator related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Translator_model extends CI_Model {

    /**
     * For getting the un-translate data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getUntraslatedData() {
        $data = array();
        $res = $this->db->select("id,field_name,in_english")
                ->from("language_conversion")
                ->where('conv_stat', '0')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['field_name'] = $row->field_name;
            $data[$i]['in_english'] = $row->in_english;
            $i++;
        }
        return $data;
    }

    /**
     * For getting all languages
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $lang_code
     * @param type $order
     * @return type
     */
    function getAllLanguages($lang_code = '', $status = 0) {
        $data = array();
        $this->db->select("lang_code,lang_name,language_folder");
        $this->db->from("languages");
        if ($lang_code)
            $this->db->where('lang_code !=', $lang_code);
        if ($status)
            $this->db->where('status', 1);        
        $res = $this->db->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['lang_code'] = $row->lang_code;
            $data[$i]['lang_name'] = $row->lang_name;
            $data[$i]['language_folder'] = $row->language_folder;
            $i++;
        }
        return $data;
    }

    /**
     * For update conversion status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    function updateConversionStatus($id) {
        $this->db->set('conv_stat ', "1")
                ->where('id ', $id)
                ->update('language_conversion');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For check translate status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $file
     * @return type
     */
    function checkTranslatedStatus($file) {
        return $this->db->select('id')
                        ->from("translated_files")
                        ->where('status', 1)
                        ->where('path', $file)
                        ->count_all_results();
    }

    /**
     * For insert translated files
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $file
     * @return type
     */
    function insertTranslatedFiles($file) {
        $this->db->set('status', 0)
                ->set('date', date("Y-m-d H:i:s"))
                ->set('path', $file)
                ->insert('translated_files');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For update translated files
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $file
     * @return type
     */
    function updateTranslatedFile($file) {
        $this->db->set('status ', "1")
                ->where('path ', $file)
                ->update('translated_files');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * For getting all un-translate files
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getUntranslatedFields() {
        return $this->db->select('id')
                        ->from("language_conversion")
                        ->where('conv_stat', '0')
                        ->count_all_results();
    }

    public function getTranslationHistory($source, $target, $input) {
        $output = '';
        $query = $this->db->select('output')
                ->where('source', $source)
                ->where('target', $target)
                ->where('input', $input)
                ->where('status', 1)
                ->limit(1)
                ->get('translator_history');
        if ($query->num_rows() > 0) {
            $output = $query->row()->output;
        }
        return $output;
    }

    public function updateTranslationHistory($source, $target, $input, $output) {
        if ($output == '') {
            return 0;
        } else {
            $this->db->set('source', $source)
                    ->set('target', $target)
                    ->set('input', $input)
                    ->set('output', $output)
                    ->set('date', date("Y-m-d H:i:s"))
                    ->insert('translator_history');
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        }
    }

}
