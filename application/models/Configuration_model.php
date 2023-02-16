<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * For configuration related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    configuration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Configuration_model extends CI_Model {

    /**
     * for checking an registration field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $name
     * @param int $id
     * @return type
     */
    function checkField($name, $id = 0) {
        $this->db->select('field_name');
        $this->db->from("register_fields");
        $this->db->where('field_name', $name);
        $this->db->where('status !=', "deleted");
        if ($id) {
            $this->db->where('id !=', $id);
        }
        return $this->db->count_all_results();
    }

    /**
     * for getting an untranslated fields
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return mixed
     */
    function getUntranslatedFields() {
        return $this->db->select('id')
                        ->from("language_conversion")
                        ->where('conv_stat', '0')
                        ->count_all_results();
    }

    /**
     * for checking register field in table
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $field
     * @return int
     */
    function checkTable($field) {
        $res = 0;
        $columns = $this->db->list_fields('user_details');
        foreach ($columns AS $key => $value) {
            if ($value == $field) {
                $res = 1;
            }
        }
        return $res;
    }

    /**
     * for creating the database field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $field_name
     * @param $data_types
     * @param $constraint
     * @return mixed
     */
    function createDbField($field_name, $data_types, $constraint) {
        $this->load->dbforge();
        if ($data_types == "text" || $data_types == "double") {
            if (!empty($field_name)) {
                $fields = array(
                    $field_name => array('type' => $data_types)
                );
            }
        } else {
            if (!empty($field_name)) {
                $fields = array(
                    $field_name => array('type' => $data_types,
                        'constraint' => $constraint,
                        'null' => true
                    )
                );
            }
        }
        return $this->dbforge->add_column('user_details', $fields);
    }

    /**
     * for creating new registration field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function addNewRegistrationField($data) {
        $this->db->set('field_name', $data['field_name'])
                ->set('field_name_en', $data['field_name_en'])
                ->set('required_status', $data['required_status'])
                ->set('unique_status', $data['unique_status'])
                ->set('register_step', $data['register_step'])
                ->set('order', $data['order'])
                ->set('default_value', $data['default_value'])
                ->set('data_types', $data['data_types'])
                ->set('data_type_max_size', $data['data_type_max_size'])
                ->set('field_type', $data['field_type'])
                ->set('radio_value1', $data['radio_value1'])
                ->set('radio_value2', $data['radio_value2'])
                ->set('select_option1', $data['select_option1'])
                ->set('select_option2', $data['select_option2'])
                ->set('select_option3', $data['select_option3'])
                ->set('select_option4', $data['select_option4'])
                ->set('status', "active")
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('register_fields');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all registration fields
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getAllRegFields() {
        $data = array();
        $res = $this->db->select("id,status,field_name,editable_status,required_status,unique_status,register_step,order,default_value")
                ->from("register_fields")
                ->where("status !=", 'deleted')
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['field_name'] = $row->field_name;
            $data[$i]['required_status'] = $row->required_status;
            $data[$i]['unique_status'] = $row->unique_status;
            $data[$i]['register_step'] = $row->register_step;
            $data[$i]['order'] = $row->order;
            $data[$i]['default_value'] = $row->default_value;
            $data[$i]['editable_status'] = $row->editable_status;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * for validating field eligibility
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $id
     * @return mixed
     */
    function checkFieldEligibility($id) {
        $numrows = $this->db->select('id')
                ->from("register_fields")
                ->where('status !=', "deleted")
                ->where('editable_status', 1)
                ->where('id', $id)
                ->count_all_results();
        return $numrows;
    }

    /**
     * for change field status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $id
     * @param $status
     * @return mixed
     */
    function changeFieldStatus($id, $status) {
        $this->db->set('status ', "$status")
                ->where('editable_status ', 1)
                ->where('id ', $id)
                ->update('register_fields');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * get a register field details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $id
     * @return array
     */
    function getRegFieldDetails($id) {
        $data = array();
        $res = $this->db->select("*")
                ->from("register_fields")
                ->where("status !=", 'deleted')
                ->where("id", $id)
                ->get();
        foreach ($res->result() as $row) {
            $data['id'] = $row->id;
            $data['field_name'] = $row->field_name;
            $data['field_name_en'] = $row->field_name_en;
            $data['required_status'] = $row->required_status;
            $data['unique_status'] = $row->unique_status;
            $data['register_step'] = $row->register_step;
            $data['order'] = $row->order;
            $data['default_value'] = $row->default_value;
            $data['editable_status'] = $row->editable_status;
            $data['data_types'] = $row->data_types;
            $data['data_type_max_size'] = $row->data_type_max_size;
            $data['field_type'] = $row->field_type;
            $data['radio_value1'] = $row->radio_value1;
            $data['radio_value2'] = $row->radio_value2;
            $data['select_option1'] = $row->select_option1;
            $data['select_option2'] = $row->select_option2;
            $data['select_option3'] = $row->select_option3;
            $data['select_option4'] = $row->select_option4;
            $data['status'] = $row->status;
        }
        return $data;
    }

    /**
     * for checking a updating register field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $name
     * @param $edit_id
     * @return mixed
     */
    function checkUpdatingField($name, $edit_id) {
        return $this->db->select('field_name')
                        ->from("register_fields")
                        ->where('field_name', $name)
                        ->where('status !=', "deleted")
                        ->where('id !=', $edit_id)
                        ->count_all_results();
    }

    /**
     * for get field old name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $id
     * @return string
     */
    public function getFieldOldName($id) {
        $field_name = '';
        $query = $this->db->select('field_name')
                ->from('register_fields')
                ->where('id', $id)
                ->get();
        foreach ($query->result() as $row) {
            $field_name = $row->field_name;
        }
        return $field_name;
    }

    /**
     * for altering database field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $field_name
     * @param $data_types
     * @param $constraint
     * @param $old_name
     * @return mixed
     */
    function alterDbField($field_name, $data_types, $constraint, $old_name) {
        $this->load->dbforge();

        if ($data_types == "text" || $data_types == "double") {
            if (!empty($old_name)) {
                $fields = array(
                    $old_name => array(
                        'name' => $field_name,
                        'type' => $data_types,
                    ),
                );
            }
        } else {
            if (!empty($old_name)) {
                $fields = array(
                    $old_name => array(
                        'name' => $field_name,
                        'type' => $data_types,
                        'constraint' => $constraint,
                        'null' => true
                    ),
                );
            }
        }
        return $this->dbforge->modify_column('user_details', $fields);
    }

    /**
     * for updating registration field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function updateRegistrationField($data) {
        $this->db->set('field_name', $data['field_name'])
                ->set('field_name_en', $data['field_name_en'])
                ->set('required_status', $data['required_status'])
                ->set('unique_status', $data['unique_status'])
                ->set('register_step', $data['register_step'])
                ->set('order', $data['order'])
                ->set('default_value', $data['default_value'])
                ->set('data_types', $data['data_types'])
                ->set('data_type_max_size', $data['data_type_max_size'])
                ->set('field_type', $data['field_type'])
                ->set('radio_value1', $data['radio_value1'])
                ->set('radio_value2', $data['radio_value2'])
                ->set('select_option1', $data['select_option1'])
                ->set('select_option2', $data['select_option2'])
                ->set('select_option3', $data['select_option3'])
                ->set('select_option4', $data['select_option4'])
                ->where('id', $data['edited_field'])
                ->update('register_fields');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all payment methods
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getAllPaymentMethods() {
        $data = array();
        $res = $this->db->select("id,code,payment_method,status,payout_status,settings")
                ->from("payment_methods")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['payment_method'] = $row->payment_method;
            $data[$i]['code'] = $row->code;
            $data[$i]['status'] = $row->status;
            $data[$i]['settings'] = $row->settings;
            $data[$i]['payout_status'] = $row->payout_status;
            $i++;
        }
        return $data;
    }

    /**
     * for getting payment status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $code
     * @param $status
     * @return mixed
     */
    function changePaymentStatus($code, $status) {
        $this->db->set('status ', "$status")
                ->where('code ', $code)
                ->update('payment_methods');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for changing Payment status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $code
     * @param $status
     * @return mixed
     */
    function changePayoutPaymentStatus($code, $status) {
        $this->db->set('payout_status ', "$status")
                ->where('code ', $code)
                ->update('payment_methods');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting payout payment status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $code
     * @return string
     */
    public function getPayoutPaymentStatus($code) {
        $status = '';
        $query = $this->db->select('payout_status')
                ->from('payment_methods')
                ->where('code', $code)
                ->get();
        foreach ($query->result() as $row) {
            $status = $row->payout_status;
        }
        return $status;
    }

    /**
     * for getting all currencies
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return array
     */
    function getCurrencies($status = 0) {
        $data = array();
        $this->db->select("id,currency_code,currency_name,status,icon,currency_ratio");
        $this->db->from("currencies");
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by("status", "desc");
        $res = $this->db->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['code'] = $row->currency_code;
            $data[$i]['name'] = $row->currency_name;
            $data[$i]['status'] = $row->status;
            $data[$i]['icon'] = $row->icon;
            $data[$i]['currency_ratio'] = $row->currency_ratio;
            $i++;
        }
        return $data;
    }

    /**
     * for changing currency status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $id
     * @param $status
     * @return mixed
     */
    function changeCurrencyStatus($id, $status) {
        $this->db->set('status ', "$status")
                ->where('id ', $id)
                ->update('currencies');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting all languages
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getLanguages($status = 0) {

        $data = array();
        $this->db->select("id,lang_code,lang_name,lang_eng_name,status");
        $this->db->from("languages");
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by("status", "desc");
        $res = $this->db->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['code'] = $row->lang_code;
            $data[$i]['name'] = $row->lang_name;
            $data[$i]['status'] = $row->status;
            $data[$i]['lang_eng_name'] = $row->lang_eng_name;
            $i++;
        }
        return $data;
    }

    /**
     * for changing language status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $id
     * @param $status
     * @return mixed
     */
    function changeLanguageStatus($id, $status) {
        $this->db->set('status ', "$status")
                ->where('id ', $id)
                ->update('languages');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting currency symbols
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $code
     * @return string
     */
    public function getCurrencySymbol($code) {
        $icon = '';
        $query = $this->db->select('icon')
                ->from('currencies')
                ->where('currency_code', $code)
                ->get();
        foreach ($query->result() as $row) {
            $icon = $row->icon;
        }
        return $icon;
    }

    /**
     * for adding new language field
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $user_id
     * @param $field_name
     * @param $in_english
     * @return mixed
     */
    function addNewLanguageField($user_id, $field_name, $in_english) {
        $this->db->set('mlm_user_id', $user_id)
                ->set('field_name', $field_name)
                ->set('in_english', $in_english)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('language_conversion');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting bonus status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $bonus
     * @return string
     */
    public function getBonusStatus($bonus) {
        $status = '';
        $query = $this->db->select('status')
                ->from('bonuses')
                ->where('name', $bonus)
                ->get();
        if ($query->num_rows() > 0) {
            $status = $query->row()->status;
        }
        return $status;
    }

    /**
     * for updating bonus status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $bonus
     * @param $status
     * @return mixed
     */
    function updateBonusStatus($bonus, $status) {
        $this->db->set('status ', "$status")
                ->where('name ', $bonus)
                ->update('bonuses');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting binary bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getBinaryBonusDetails() {
        $data = array();
        $query = $this->db->select('bonus_type as binary_bonus_type,pair_amount,pair_percentage,pair_value,cap_type,cap_amount')
                ->from('binary_bonus_settings')
                ->where('id', '1')
                ->get();
        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    /**
     * for updating binary settings
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function updateBinarySettings($data) {
        $this->db->set('bonus_type', $data['binary_bonus_type'])
                ->set('pair_amount', $data['pair_amount'])
                ->set('pair_value', $data['pair_value'])
                ->set('pair_percentage', $data['pair_percentage'])
                ->set('cap_type', $data['cap_type'])
                ->set('cap_amount', $data['cap_amount'])
                ->where('id', 1)
                ->update('binary_bonus_settings');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * for getting referal bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getReferalBonusDetails() {
        $data = array();
        $query = $this->db->select('bonus_type,amount,percentage')
                ->from('referal_bonus_settings')
                ->where('id', '1')
                ->get();
        foreach ($query->result_array() as $row) {
            $data['bonus_type'] = $row['bonus_type'];
            $data['amount'] = $row['amount'];
            $data['percentage'] = $row['percentage'];
        }
        return $data;
    }

    /**
     * for updating referal bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function updateReferalSettings($data) {
        $this->db->set('bonus_type ', $data['referal_bonus_type'])
                ->set('amount', $data['referal_amount'])
                ->set('percentage ', $data['referal_percentage'])
                ->where('id ', 1)
                ->update('referal_bonus_settings');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting rank bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return array
     */
    function getRankBonusDetails() {
        $data = array();
        $query = $this->db->select('id,rank_name,rank_bonus')
                ->from('rank')
                ->where('status', '1')
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['rank_name'] = $row['rank_name'];
            $data[$i]['id'] = $row['id'];
            $data[$i]['rank_bonus'] = $row['rank_bonus'];
            $i++;
        }
        return $data;
    }

    /**
     * for updating rank bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $rank_name
     * @param $rank_bonus
     * @return mixed
     */
    function updateRankSettings($rank_name, $rank_bonus) {
        $this->db->set('rank_bonus', $rank_bonus)
                ->where('rank_name ', $rank_name)
                ->update('rank');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting matrix level bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return array
     */
    function getMatrixLevelBonusDetails() {
        $depth = $this->dbvars->MATRIX_DEPTH;
        $data = array();
        for ($i = 1; $i <= $depth; $i++) {
            $details = $this->getMatrixLevelDetails($i);
            if ($details) {
                $data[$i] = $details;
                $data[$i]['level'] = $i;
            } else {
                $this->insertMatrixNewLevel($i);
                $details['percentage'] = 0;
                $details['amount'] = 0;
                $details['bonus_type'] = 'fixed';

                $data[$i] = $details;
                $data[$i]['level'] = $i;
            }
        }
        return $data;
    }

    /**
     * for getting matrix level details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $level
     * @return array
     */
    function getMatrixLevelDetails($level) {
        $data = array();
        $query = $this->db->select('bonus_type,fixed,percentage')
                ->from('matrix_level_bonus_settings')
                ->where('level', $level)
                ->get();
        foreach ($query->result_array() as $row) {
            $data['percentage'] = $row['percentage'];
            $data['amount'] = $row['fixed'];
            $data['bonus_type'] = $row['bonus_type'];
        }
        return $data;
    }

    /**
     * for creating matrix new level
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $level
     * @return mixed
     */
    function insertMatrixNewLevel($level) {
        if (!empty($level)) {
            $this->db->set('percentage', 0)
                    ->set('fixed', 0)
                    ->set('level', $level)
                    ->set('fixed_name', 'fixed_' . $level)
                    ->set('perc_name', 'perc_' . $level)
                    ->insert('matrix_level_bonus_settings');

            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        }
    }

    /**
     * for updating matrix settings
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $key
     * @param $value
     * @param $bonus_type
     * @param $flag
     * @return mixed
     */
    function updateMatrixSettings($key, $value, $bonus_type, $flag) {
        if ($flag) {
            $this->db->set('fixed', $value)
                    ->set('bonus_type', $bonus_type)
                    ->where('fixed_name ', $key)
                    ->update('matrix_level_bonus_settings');

            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        } else {
            return $this->db->set('percentage', $value)
                            ->set('bonus_type', $bonus_type)
                            ->where('perc_name ', $key)
                            ->update('matrix_level_bonus_settings');

            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        }
    }

    /**
     * for getting unilevel bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return int
     */
    function getUniLevelBonusDetails() {
        $depth = $this->dbvars->UNILEVEL_LEVEL_DEPTH;
        $data = array();
        for ($i = 1; $i <= $depth; $i++) {
            $details = $this->getUnilevelLevelDetails($i);
            if ($details) {
                $data[$i] = $details;
                $data[$i]['level'] = $i;
            } else {
                $this->insertUnilevelNewLevel($i);
                $details['percentage'] = 0;
                $details['amount'] = 0;
                $details['bonus_type'] = 'fixed';

                $data[$i] = $details;
                $data[$i]['level'] = $i;
            }
        }
        return $data;
    }

    /**
     * for getting unilevel bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $level
     * @return array
     */
    function getUnilevelLevelDetails($level) {
        $data = array();
        $query = $this->db->select('bonus_type,fixed,percentage')
                ->from('unilevel_level_bonus_settings')
                ->where('level', $level)
                ->get();
        foreach ($query->result_array() as $row) {
            $data['percentage'] = $row['percentage'];
            $data['amount'] = $row['fixed'];
            $data['bonus_type'] = $row['bonus_type'];
        }
        return $data;
    }

    /**
     * for insering unilevel new level
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $level
     * @return mixed
     */
    function insertUnilevelNewLevel($level) {
        if (!empty($level)) {
            $this->db->set('percentage', 0)
                    ->set('fixed', 0)
                    ->set('level', $level)
                    ->set('fixed_name', 'fixed_uni_' . $level)
                    ->set('perc_name', 'perc_uni_' . $level)
                    ->insert('unilevel_level_bonus_settings');

            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        }
    }

    /**
     * for updating unilevel bonus settings
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $key
     * @param $value
     * @param $bonus_type
     * @param $flag
     * @return mixed
     */
    function updateUnilevelSettings($key, $value, $bonus_type, $flag) {
        if ($flag) {
            $this->db->set('fixed', $value)
                    ->set('bonus_type', $bonus_type)
                    ->where('fixed_name ', $key)
                    ->update('unilevel_level_bonus_settings');
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        } else {
            $this->db->set('percentage', $value)
                    ->set('bonus_type', $bonus_type)
                    ->where('perc_name ', $key)
                    ->update('unilevel_level_bonus_settings');
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        }
    }

    /**
     * for getting matching bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getMatchingBonusDetails() {
        $data = array();
        $query = $this->db->select('level,percentage')
                ->from('matching_bonus')
                ->where('status', 1)
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['level'] = $row['level'];
            $data[$i]['percentage'] = $row['percentage'];
            $i++;
        }
        return $data;
    }

    /**
     * for updating matching bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $name
     * @param $bonus
     * @return mixed
     */
    function updateMatchingSettings($name, $bonus) {
        $this->db->set('percentage', $bonus)
                ->where('name ', $name)
                ->update('matching_bonus');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting generation bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getGenerationDetails() {
        $data = array();
        $query = $this->db->select('rank_id,g1_value,g2_value,g3_value')
                ->from('genertion_settings')
                ->get();
        foreach ($query->result_array() as $row) {
            $key = $row['rank_id'];
            $data["$key"]['g1_value'] = $row['g1_value'];
            $data["$key"]['g2_value'] = $row['g2_value'];
            $data["$key"]['g3_value'] = $row['g3_value'];
        }
        return $data;
    }

    /**
     * for updating bank configuration
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function updateBankConfig($data) {

        $this->db->set('bank_holder_name ', $data['account_holder_name'])
                ->set('bank_name', $data['bank_name'])
                ->set('bank_ac_number', $data['account_number'])
                ->set('bank_branch ', $data['branch_name'])
                ->set('bank_ifsc ', $data['ifsc_code'])
                ->update('payment_config');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting payment configuration
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    function getPaymentConfig() {
        $data = array();
        $query = $this->db->select('*')
                ->from('payment_config')
                ->where('id', 1)
                ->get();
        if ($query->num_rows() > 0) {
            $data['bank_name'] = $query->row()->bank_name;
            $data['bank_holder_name'] = $query->row()->bank_holder_name;
            $data['bank_branch'] = $query->row()->bank_branch;
            $data['bank_ac_number'] = $query->row()->bank_ac_number;
            $data['bank_ac_number'] = $query->row()->bank_ac_number;
            $data['bank_ifsc'] = $query->row()->bank_ifsc;
            $data['paypal_api_password'] = $query->row()->paypal_api_password;
            $data['paypal_api_username'] = $query->row()->paypal_api_username;
            $data['paypal_signater'] = $query->row()->paypal_signater;
            $data['paypal_production'] = $query->row()->paypal_production;
            $data['paypal_payout_status'] = $this->getPayoutPaymentStatus('paypal');
            $data['bank_transfer'] = $this->getPayoutPaymentStatus('bank_transfer');
            $data['blocktrail_payout_status'] = $this->getPayoutPaymentStatus('blocktrail');
            $data['blocktrail_api_key'] = $query->row()->blocktrail_api_key;
            $data['blocktrail_api_secret'] = $query->row()->blocktrail_api_secret;
            $data['blocktrail_wallet_identifier'] = $query->row()->blocktrail_wallet_identifier;
            $data['blocktrail_wallet_pass'] = $query->row()->blocktrail_wallet_pass;
            $data['blocktrail_production'] = $query->row()->blocktrail_production;
        }
        return $data;
    }

    /**
     * for updating paypal configuration
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function updatePaypalConfig($data) {
        $this->db->set('paypal_api_password ', $data['paypal_api_password'])
                ->set('paypal_api_username', $data['paypal_api_username'])
                ->set('paypal_signater ', $data['paypal_signater'])
                ->update('payment_config');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating payout settings
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $data
     * @return mixed
     */
    function updatePayoutSetting($data) {
        $this->db->set('payout_min', $data['payout_min'])
                ->set('payout_max', $data['payout_max'])
                ->set('payout_cut_off_balance', $data['payout_cut_off_balance'])
                ->set('payout_transation_charges', $data['payout_transation_charges'])
                ->set('time_limit1', $data['time_limit1'])
                ->set('time_limit2', $data['time_limit2'])
                ->update('configuration');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function updatePayoutDayStatus($field, $status) {
        $this->db->set($field, $status)
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating payout automatic status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $status
     * @return mixed
     */
    function updatePayoutAutomaticStatus($status) {
        $this->db->set('automatic_payout_status', $status)
                ->update('configuration');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /** for geting investment details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return array
     */
    public function getInvestmentDetails() {
        $investment_array = array();
        $query = $this->db->select('investment_amount,id')
                ->get('products');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $key = $row['id'];
                $investment_array["$key"] = $row['investment_amount'];
            }
        }
        return $investment_array;
    }

    /** for get stairstep details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    public function getStairStepDetails() {
        $stair_step_array = array();
        $query = $this->db->select('*')
                ->get('stair_step_settings');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $stair_step_array[] = $row;
            }
        }
        return $stair_step_array;
    }

    /** for getting database field name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    function getDbFieldName($id) {
        $field_name = '';
        $query = $this->db->select('field_name')
                ->where('id', $id)
                ->limit(1)
                ->get('register_fields');
        if ($query->num_rows() > 0) {
            $field_name = $query->row()->field_name;
        }
        return $field_name;
    }

    /**
     * For getting All Langauge Based System mails
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @date 2018-01-04
     * @day Tuesday
     * @param type $lang_arr
     * @return type
     */
    function getAllSystemMails($lang_arr = array()) {
        $this->load->model('site_management_model');
        $active_mail_content_tab = '';
        if ($this->session->userdata('active_mail_content_type') != null)
            $active_mail_content_tab = $this->session->userdata('active_mail_content_type');

        $result = $this->db->select('id,type,status')
                ->from('system_contents')
                ->get();
        $details = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            if ($active_mail_content_tab) {
                if ($active_mail_content_tab == $row['type']) {
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

            $details[$i]['contents'] = $this->getContents($row['type'], $lang_arr, $active_mail_content_tab, $i);
            $i++;
        }

        return $details;
    }

    /**
     * For getting the Contents 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $type
     * @param type $lang_arr
     * @param type $active_mail_content_tab
     * @param type $index
     * @return string
     */
    function getContents($type, $lang_arr, $mail_content_tab, $index) {
        $active_mail_content_tab=0;
        if ($this->session->userdata('active_mail_content_tab') != null)
            $active_mail_content_tab = $this->session->userdata('active_mail_content_tab');
        $this->load->model('site_management_model');
        foreach ($lang_arr as $row) {
            $result = $this->db->select("terms_condition,privacy_policy,lang_code,id,status,lang_name")
                    ->from('languages')
                    ->where('status', 1)
                    ->get();
            $data = [];
            $i = 0;
            
            foreach ($result->result_array() as $raw) {
                if ($active_mail_content_tab) {
                    if ($active_mail_content_tab == $raw['id'] && $mail_content_tab == $type) {
                        $data[$i]['active'] = 1;
                    } else {
                        $data[$i]['active'] = 0;
                    }
                } elseif ($i==$index && $i==0) {
                    $data[$i]['active'] = 1;
                } else {
                    $data[$i]['active'] = 0;
                }
                $data[$i]['id'] = $raw['id'];
                if ($type == "terms_condition") {
                    $data[$i]['terms_condition'] = $raw['terms_condition'];
                } elseif ($type == "privacy_policy") {
                    $data[$i]['privacy_policy'] = $raw['privacy_policy'];
                }
                $data[$i]['form'] = "method='post' class='mail_cont_form_" . $type . $raw['id'] . "'";
                $data[$i]['lang_id'] = $raw['id'];
                $data[$i]['lang_name'] = $raw['lang_name'];
                $data[$i]['status'] = $raw['status'];

                $i++;
            }
            return $data;
        }
    }

    /**
     * For Update the content corresponding Language Wise
     * @date: 2018-01-04
     * @day :Thursday
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $post_arr
     * @return type
     */
    function updateMailContent($id, $post_arr) {
        $result = $this->db->set($post_arr['type'], $post_arr['mail_content'])
                ->where('id', $post_arr['update_mail_content'])
                ->limit(1)
                ->update('languages');
        if ($this->db->affected_rows() > 0) {
            return $result;
        }
        return false;
    }

    /**
     * for updating currency ratio
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @param type $currency_ratio
     * @return type
     * 
     */
    function updateCrncyRation($id, $currency_ratio) {
        $this->db->set('currency_ratio ', $currency_ratio)
                ->where('id ', $id)
                ->update('currencies');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting count of register fields
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @return type
     */
    function countOfRegFieldList() {
        return $this->db->select('id')
                        ->from("register_fields")
                        ->where("status !=", 'deleted')
                        ->count_all_results();
    }

    /**
     * for setting headings for register fields
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnRegFieldList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'field_name', 'dt' => 1),
            array('db' => 'status', 'dt' => 2),
            array('db' => 'required_status', 'dt' => 3),
            array('db' => 'unique_status', 'dt' => 4),
            array('db' => 'register_step', 'dt' => 5),
            array('db' => '`order`', 'dt' => 6),
            array('db' => 'default_value', 'dt' => 7),
            array('db' => 'editable_status', 'dt' => 8),
        );
    }

    /**
     * for getting filtered register field count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredRegFieldList($table, $where) {
        if ($where) {
            $where = $where . " AND status != 'deleted' ";
        } else {
            $where = " WHERE status != 'deleted' ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * for getting datatable details for register fields
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataRegFieldList($table, $column, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND status != 'deleted' ";
        } else {
            $where = " WHERE status != 'deleted' ";
        }
        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting other bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getOtherBonusDetails() {
        $data = array();
        $res = $this->db->select("id,name,status")
                ->from("bonuses")
                ->where("flag", 0)
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['name'] = $row->name;
            $data[$i]['status'] = $row->status;
            $i++;
        }
        return $data;
    }

    /**
     * for changing paypal production status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param $code
     * @param $status
     * @return mixed
     */
    function changePaypalProductionStatus($field, $status) {
        $this->db->set($field, $status)
                ->where('id', 1)
                ->update('payment_config');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for updating blocktrail credentials
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $data
     * @return type
     */
    function updateBlocktrailCredentials($data) {
        $this->db->set('blocktrail_api_key', $data['blocktrail_api_key'])
                ->set('blocktrail_api_secret', $data['blocktrail_api_secret'])
                ->set('blocktrail_wallet_identifier', $data['blocktrail_wallet_identifier'])
                ->set('blocktrail_wallet_pass', $data['blocktrail_wallet_pass'])
                ->where('id', 1)
                ->update('payment_config');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * for getting other bonus details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getAllBonusDetails() {
        $data = array();
        $res = $this->db->select("id,name,status,flag")
                ->from("bonuses")
                ->order_by("status", "desc")
                ->get();
        $i = 0;
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['name'] = $row->name;
            $data[$i]['status'] = $row->status;
            $data[$i]['flag'] = $row->flag;
            $i++;
        }
        return $data;
    }

    function changeMenuPermission($link, $status) {
        $this->db->set('status', $status)
                ->set('user_permission', $status)
                ->where('link', $link)
                ->update('menus');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}
