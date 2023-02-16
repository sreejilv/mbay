<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For binary plan related 
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Plan_binary_model extends CI_Model {

    public $up_fathers = array();
    public $up_fathers_chunk = array();
    public $down_unilevel = array();

    public function __construct() {
        parent::__construct();
        $this->up_fathers = null;
        $this->up_fathers_chunk = null;
        $this->down_unilevel = null;
        $this->load->model('configuration_model');
    }

    /**
     * For get user position to register
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $sponsor_id
     * @param type $reg_leg
     * @return type
     */
    function getUserLeg($sponsor_id, $reg_leg = '') {
        $leg_type = $this->helper_model->getUserDefaultLeg($sponsor_id);
        switch ($leg_type) {
            case 'balanced';
                $leg = $this->getBalancedLeg($sponsor_id);
                break;
            case 'left';
                $leg = 'L';
                break;
            case 'right';
                $leg = 'R';
                break;
            default:
                $leg = $reg_leg;
                break;
        }
        return $leg;
    }

    /**
     * For balanced position
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getBalancedLeg($user_id) {
        return $this->helper_model->getBalancedLeg($user_id);
    }

    /**
     * For create father ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $sponsor_id
     * @param type $leg_type
     * @return type
     */
    function createFatherIDBinary($sponsor_id, $leg_type) {
        $father_id = $sponsor_id;
        $query = $this->db->select('mlm_user_id')
                ->where('father_id', $sponsor_id)
                ->where('position', $leg_type)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {

            $father_id = $this->createFatherIDBinary($query->row()->mlm_user_id, $leg_type);
        }
        return $father_id;
    }

    /**
     * For create Father ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $sponsor_id
     * @param type $leg_type
     * @return type
     */
    function createFatherID($sponsor_id, $leg_type) {
        $return_array['father_id'] = $this->createFatherIDBinary($sponsor_id, $leg_type);
        $return_array['position'] = $leg_type;
        return $return_array;
    }

    /**
     * For Update the father ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $father_id
     * @param type $level
     * @param type $position
     * @return type
     */
    function updateFatherTraverse($user_id, $father_id, $level = 1, $position = '') {
        $admin_id = $this->helper_model->getAdminId();
        $query = $this->db->set('user_id', $user_id)
                ->set('path', $father_id)
                ->set('level', $level)
                ->set('position', $position)
                ->insert('traverse_father');
        if ($this->db->affected_rows()) {
            $query = $this->db->query("INSERT INTO `mlm_traverse_father` ( user_id, path, level, position ) SELECT $user_id, path, level+1, position FROM `mlm_traverse_father` WHERE user_id =$father_id AND user_id != $admin_id");
        }
        return $query;
    }

    /**
     * For update Sponsor
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $sponsor_id
     * @param type $level
     * @return type
     */
    function updateSponsorTraverse($user_id, $sponsor_id, $level = 1) {
        $admin_id = $this->helper_model->getAdminId();
        $query = $this->db->set('user_id', $user_id)
                ->set('path', $sponsor_id)
                ->set('level', $level)
                ->insert('traverse_sponsor');
        if ($this->db->affected_rows()) {
            $query = $this->db->query("INSERT INTO `mlm_traverse_sponsor` ( user_id, path, level ) SELECT $user_id, path, level+1 FROM `mlm_traverse_sponsor` WHERE user_id =$sponsor_id AND user_id != $admin_id");
        }
        return $query;
    }

    /**
     * For distribute the commission based on baln
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $add_user
     * @param type $package_id
     * @param type $sponsor_id
     * @return boolean
     */
    function distributeCommissionBasedPlan($add_user, $package_id, $sponsor_id) {
        $success['rank_status'] = $success['referral_status'] = $success['generation_status'] = $success['investment_status'] = $success['stair_step_status'] = true;
        $update_point = 1;
        if ($this->dbvars->REGISTER_PACKAGE > 0) {
            $update_point = $this->helper_model->getUplineUpdateValue($this->dbvars->UPLINE_UPDATE_VALUE, $package_id);
        }
        if ($update_point > 0)
            $success['point_update_status'] = $this->updatePointsToLeg($add_user, $update_point);

        if ($this->configuration_model->getBonusStatus('rank_bonus')) {//Rank Commission
            $success['rank_status'] = $this->checkRanksUpUsers($add_user);
        }
        if ($this->configuration_model->getBonusStatus('refferal_bonus')) {//Referral Commission
            $dist_amount = $this->getReferralAmount($package_id);
            if ($dist_amount > 0) {
                $success['referral_status'] = $this->distributeReferralBonus($sponsor_id, 'credit', $dist_amount, 'referral_bonus', $add_user);
            }
        }

        if ($this->dbvars->GENERATION_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {//Generation Commission
            if ($package_id > 0) {
                $down_sales = $this->helper_model->getUplineUpdateValue($this->dbvars->UPLINE_UPDATE_VALUE, $package_id);
                $up_father = $this->helper_model->getUplineWithGenerationRank($add_user);
                if (!empty($up_father)) {
                    $tier = 1;
                    $success['generation_status'] = $this->distributeGenerationAmount($up_father['user_id'], $down_sales, $tier, $up_father['rank_id'], $add_user);
                }
            }
        }

        if ($this->dbvars->INVESTMENT_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {//Investment Commission
            if ($package_id > 0) {
                $investment_array = $this->configuration_model->getInvestmentDetails();
                $success['investment_status'] = $this->distributeInvestmentBonus($add_user, $investment_array, $package_id);
            }
        }

        if ($this->dbvars->STAIR_STEP_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {//Stair Step Bonus
            if ($package_id > 0) {
                $paid_stair = 0;
                $start_date = date('Y-m') . '-01 00:00:00';
                $end_date = date('Y-m-t', strtotime($start_date)) . ' 23:59:59';
                $down_sales = $this->helper_model->getUplineUpdateValue($this->dbvars->UPLINE_UPDATE_VALUE, $package_id);
                $success['stair_step_status'] = $this->distributeStairStepAmount($add_user, $down_sales, $paid_stair, $start_date, $end_date, $add_user);
            }
        }
        if (!$success['point_update_status'] || !$success['rank_status'] || !$success['referral_status'] || !$success['generation_status'] || !$success['investment_status'] || !$success['stair_step_status']) {
            $this->helper_model->insertFailedActivity($add_user, 'registration_error', $success);
            return false;
        }
        return true;
    }

    /**
     * For distribute the re-purchase commission
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $update_point
     * @return boolean
     */
    function distributeRepurchaseCommission($user_id, $update_point = '') {
        $success['rank_status'] = $success['generation_status'] = $success['stair_step_status'] = true;

        $success['point_update_status'] = $this->updatePointsToLeg($user_id, $update_point);

        if ($this->configuration_model->getBonusStatus('rank_bonus')) {//Rank Commission
            $success['rank_status'] = $this->checkRanksUpUsers($user_id);
        }

        if ($this->dbvars->GENERATION_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {//Generation Commission
            if ($update_point > 0) {
                $up_father = $this->helper_model->getUplineWithGenerationRank($user_id);
                if (!empty($up_father)) {
                    $tier = 1;
                    $success['generation_status'] = $this->distributeGenerationAmount($up_father['user_id'], $update_point, $tier, $up_father['rank_id'], $user_id);
                }
            }
        }

        if ($this->dbvars->STAIR_STEP_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {//Stair Step Bonus
            $paid_stair = 0;
            $start_date = date('Y-m') . '-01 00:00:00';
            $end_date = date('Y-m-t', strtotime($start_date)) . ' 23:59:59';
            $success['stair_step_status'] = $this->distributeStairStepAmount($user_id, $update_point, $paid_stair, $start_date, $end_date, $user_id);
        }

        if (!$success['point_update_status'] || !$success['rank_status'] || !$success['generation_status'] || !$success['stair_step_status']) {
            $this->helper_model->insertFailedActivity($user_id, 'purchasse_error', $success);
            return false;
        }
        return true;
    }

    /**
     * For getting the referral amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $package_id
     * @return type
     */
    function getReferralAmount($package_id) {
        $consider_amount = $this->dbvars->ENTRI_FEE;
        ;
        if ($package_id > 0) {
            $consider_amount += $this->helper_model->getUplineUpdateValue($this->dbvars->UPLINE_UPDATE_VALUE, $package_id);
        }
        $query = $this->db->select('bonus_type, amount, percentage')
                ->get('referal_bonus_settings');
        if ($query->row()->bonus_type == 'fixed') {
            $referral_amount = $query->row()->amount;
        } else {
            $referral_amount = ($consider_amount * $query->row()->percentage) / 100;
        }
        return $referral_amount;
    }

    /**
     * For distribute Referral Bonus
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $sponsor_id
     * @param type $type
     * @param type $dist_amount
     * @param type $wallet_type
     * @param type $add_user
     * @return type
     */
    function distributeReferralBonus($sponsor_id, $type, $dist_amount, $wallet_type = 'referral_bonus', $add_user) {
        $result = $this->helper_model->insertWalletDetails($sponsor_id, $type, $dist_amount, $wallet_type, $add_user, 'code', '', '', 1);
        return $result;
    }

    /**
     * For check Ranksup the user
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function checkRanksUpUsers($user_id) {
        $result = false;
        $this->upline_fathers = array();
        $rank_array = $this->helper_model->getAllRankDetails();
        $this->upline_fathers = $this->helper_model->getUplineFathers($user_id);
        foreach ($this->upline_fathers as $row) {
            $result = $this->helper_model->checkQualification($row['path'], $rank_array, $user_id);
        }
        return $result;
    }

    /**
     * For point update leg
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $update_point
     * @return boolean
     */
    function updatePointsToLeg($user_id, $update_point, $order_id = 0) {
        $pair_cal=array();
        $this->upline_fathers = array();
        $this->upline_fathers_chunk = null;
        $this->upline_fathers = $this->helper_model->getUplineFathers($user_id);
        $this->upline_fathers_chunk = array_chunk($this->upline_fathers, 500);
        $i = 0;
        while (!empty($this->upline_fathers_chunk[$i])) {

            $data = array();
            foreach ($this->upline_fathers_chunk[$i] as $row) {
                $update_leg_carry = "user_" . $row['position'] . "_carry";
                $update_leg = "user_" . $row['position'];
                $user_carry = $this->helper_model->getUserLeftRightCarry($row['path']);
                $each_user_point = $user_carry["$update_leg_carry"] + $update_point;
                $each_user_leg = $user_carry["$update_leg"] + $update_point;
                array_push($data, array("$update_leg_carry" => "$each_user_point", "$update_leg" => "$each_user_leg", "mlm_user_id" => $row['path']));
            }

            $this->db->update_batch('user', $data, 'mlm_user_id');
            if (!$this->db->affected_rows()) {
                return false;
            }
            $pair_cal['point_update'][]=$data;
            $binary_settings = $this->configuration_model->getBinaryBonusDetails();
            foreach ($this->upline_fathers_chunk[$i] as $row) {
                $user_data=array();
                $user_data['user_id']=$row['path'];
                if ($this->dbvars->BINARY_RUN == 'instant') {//For Checking the Binary Pairs
                    $dist_amount = $binary_pair = $binary_pair_normal = 0;
                    $user_carry = $this->helper_model->getUserLeftRightCarry($row['path']);
                    $user_data['user_carry']=$user_carry;
                    $update_l_carry = $user_carry['user_L_carry'];
                    $update_r_carry = $user_carry['user_R_carry'];
                    if ($this->dbvars->BINARY_PLAN == 'one_to_one') {
                        $binary_pair = $this->getBinaryPair($binary_settings, $user_carry);
                        if ($binary_pair > 0) {
                            $update_carry = $binary_pair * $binary_settings['pair_value'];
                            if ($binary_settings['binary_bonus_type'] == 'fixed') {
                                $dist_amount = $binary_pair * $binary_settings['pair_amount'];
                            } elseif ($binary_settings['binary_bonus_type'] == 'percentage') {
                                $dist_amount = (($binary_pair * $binary_settings['pair_value']) * $binary_settings['pair_percentage']) / 100;
                            }
                            $update_l_carry = $user_carry['user_L_carry'] - $update_carry;
                            $update_r_carry = $user_carry['user_R_carry'] - $update_carry;
                        }
                    } elseif ($this->dbvars->BINARY_PLAN == 'two_to_one') {
                        $binary_pair = $this->getBinaryPairForTwoOne($row['path'], $binary_settings, $user_carry);
                        if ($binary_pair > 0) {
                            $update_carry = $binary_pair * $binary_settings['pair_value'];
                            if ($user_carry['user_L_carry'] < $user_carry['user_R_carry']) {
                                $update_r_carry = $user_carry['user_R_carry'] = $user_carry['user_R_carry'] - $update_carry * 2;
                                $update_l_carry = $user_carry['user_L_carry'] = $user_carry['user_L_carry'] - $update_carry;
                            } else {
                                $update_r_carry = $user_carry['user_R_carry'] = $user_carry['user_R_carry'] - $update_carry;
                                $update_l_carry = $user_carry['user_L_carry'] = $user_carry['user_L_carry'] - $update_carry * 2;
                            }
                        }
                        if ($this->getFirstPairStatus($row['path']) || $binary_pair > 0) {
                            $binary_pair_normal = $this->getBinaryPair($binary_settings, $user_carry);
                            if ($binary_pair_normal > 0 || $binary_pair > 0) {
                                $update_carry = $binary_pair_normal * $binary_settings['pair_value'];
                                if ($binary_settings['binary_bonus_type'] == 'fixed') {
                                    $dist_amount = ($binary_pair + $binary_pair_normal) * $binary_settings['pair_amount'];
                                } elseif ($binary_settings['binary_bonus_type'] == 'percentage') {
                                    $dist_amount = ((($binary_pair + $binary_pair_normal) * $binary_settings['pair_value']) * $binary_settings['pair_percentage']) / 100;
                                }
                                $update_l_carry = $user_carry['user_L_carry'] - $update_carry;
                                $update_r_carry = $user_carry['user_R_carry'] - $update_carry;
                            }
                        }
                    } else {
                        if ($user_carry['user_L_carry'] < $user_carry['user_R_carry']) {
                            $binary_pair = $user_carry['user_L_carry'];
                        } else {
                            $binary_pair = $user_carry['user_R_carry'];
                        }
                        $dist_amount = ($binary_pair * $binary_settings['pair_percentage']) / 100;
                        $update_carry = $binary_pair;
                        $binary_pair = $binary_pair > 0 ? $binary_pair : 0;
                        $update_l_carry = $user_carry['user_L_carry'] - $update_carry;
                        $update_r_carry = $user_carry['user_R_carry'] - $update_carry;
                    }
                    
                    $user_data['binary_pair']=$binary_pair;
                    $user_data['binary_pair_normal']=$binary_pair_normal;
                    $user_data['update_l_carry']=$update_l_carry;
                    $user_data['update_r_carry']=$update_r_carry;
                    
                    if ($binary_pair > 0 || $binary_pair_normal > 0) {
                        $dist_status = $update_carry_status = $history_status = TRUE;
                        $ceiling_amount = $this->getCeilingAmount($row['path'], $binary_settings['cap_type'], $binary_settings['cap_amount'], $dist_amount);
                        $dist_amount = $ceiling_amount['payable_amount']; //Distribute Binary Commission
                        $capped_amount = $ceiling_amount['capped_amount'];
                        if ($dist_amount > 0) {                            
                            $dist_status = $this->helper_model->insertWalletDetails($row['path'], 'credit', $dist_amount, 'binary_bonus', $user_id, '', '', '', 1);
                            $user_data['bonus_status']=$dist_status;
                        }
                        if ($dist_status) {
                            $update_carry_status = $this->updateCarry($row['path'], $update_l_carry, $update_r_carry);
                            $binary_pair = $binary_pair + $binary_pair_normal;
                            $history_status = $this->addBinaryBonusHistory($row['path'], $user_carry['user_L_carry'], $user_carry['user_R_carry'], $update_l_carry, $update_r_carry, $binary_pair, $capped_amount, $dist_amount);
                        }
                        if (!$dist_status || !$update_carry_status || !$history_status) {
                            return false;
                        }
                    }
                }
                $pair_update[]=$user_data;
            }
            $pair_cal['pair_update'][]=$pair_update;
            $i++;
        }        
        
        $this->db->set('binary_data', serialize($pair_cal))
                ->set('user_id', $user_id)
                ->set('order_id', $order_id)
                ->set('update_point', $update_point)
                ->set('date', date("Y-m-d H:i:s"))
                ->insert('pair_calculation');     
        return true;
    }

    /**
     * For getting the binary Pair
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $binary_settings
     * @param type $user_carry
     * @return type
     */
    function getBinaryPair($binary_settings, $user_carry = array()) {
        $binary_pair = 0;
        if ($user_carry['user_L_carry'] >= $binary_settings['pair_value'] && $user_carry['user_R_carry'] >= $binary_settings['pair_value']) {
            if ($user_carry['user_L_carry'] < $user_carry['user_R_carry']) {
                $binary_pair = intval($user_carry['user_L_carry'] / $binary_settings['pair_value']);
            } else {
                $binary_pair = intval($user_carry['user_R_carry'] / $binary_settings['pair_value']);
            }
        }
        return $binary_pair;
    }

    /**
     * For binary pair for 2:1
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $binary_settings
     * @param type $user_carry
     * @return int
     */
    function getBinaryPairForTwoOne($user_id, $binary_settings, $user_carry = array()) {
        $binary_pair = 0;
        if (!$this->getFirstPairStatus($user_id)) {
            if (($user_carry['user_L_carry'] >= (2 * $binary_settings['pair_value']) && $user_carry['user_R_carry'] >= $binary_settings['pair_value']) || ($user_carry['user_L_carry'] >= $binary_settings['pair_value'] && $user_carry['user_R_carry'] >= (2 * $binary_settings['pair_value']))) {
                $binary_pair = 1;
            }
        }
        return $binary_pair;
    }

    /**
     * For ceiling amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $cap_type
     * @param type $cap_amount
     * @param type $dist_amount
     * @return type
     */
    function getCeilingAmount($user_id, $cap_type, $cap_amount, $dist_amount) {
        $binary_bonus['payable_amount'] = $binary_bonus['capped_amount'] = 0;
        $end_date = date('Y-m-d') . " 23:59:59";
        switch ($cap_type) {
            case "instant": {
                    $total_amount = $dist_amount;
                    if ($total_amount > $cap_amount) {
                        $binary_bonus['payable_amount'] = $cap_amount;
                        $binary_bonus['capped_amount'] = $total_amount - $cap_amount;
                    } else {
                        $binary_bonus['payable_amount'] = $total_amount;
                    }
                    return $binary_bonus;
                    break;
                }
            case "daily":
                $start_date = date('Y-m-d', strtotime($end_date . ' -1 day')) . " 00:00:00";
                break;
            case "weekly":
                $start_date = date('Y-m-d', strtotime($end_date . ' -6 day')) . " 00:00:00";
                break;
            case "monthly":
                $start_date = date('Y-m-d', strtotime($end_date . ' -1 month')) . " 00:00:00";
                break;
            default :
                $start_date = date('Y-m-d') . " 00:00:00";
                break;
        }
        $total_amount = 0;
        $query = $this->db->select_sum('original_amount')
                ->where('mlm_user_id', $user_id)
                ->where('date >=', $start_date)
                ->where('date <=', $end_date)
                ->get('wallet_details');
        if ($query->num_rows() > 0) {
            $total_amount = $query->row()->original_amount;
        }
        if ($total_amount > $cap_amount) {
            $binary_bonus['payable_amount'] = 0;
            $binary_bonus['capped_amount'] = $dist_amount;
        } else {
            $cap_amount = $cap_amount - $total_amount;
            if ($dist_amount < $cap_amount) {
                $binary_bonus['payable_amount'] = $dist_amount;
                $binary_bonus['capped_amount'] = 0;
            } else {
                $binary_bonus['capped_amount'] = $dist_amount - $cap_amount;
                $binary_bonus['payable_amount'] = $dist_amount - $binary_bonus['capped_amount'];
            }
        }
        return $binary_bonus;
    }

    /**
     * For update Carry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $update_l_carry
     * @param type $update_r_carry
     * @return boolean
     */
    function updateCarry($user_id, $update_l_carry, $update_r_carry) {
        $result = false;
        $this->db->set('user_L_carry', $update_l_carry)
                ->set('user_R_carry', $update_r_carry)
                ->where('mlm_user_id', $user_id)
                ->update('user');
        if ($this->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * For binary bonus history details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_l_carry
     * @param type $user_r_carry
     * @param type $update_l_carry
     * @param type $update_r_carry
     * @param type $binary_pair
     * @param type $capped_amount
     * @param type $dist_amount
     * @return boolean
     */
    function addBinaryBonusHistory($user_id, $user_l_carry, $user_r_carry, $update_l_carry, $update_r_carry, $binary_pair, $capped_amount, $dist_amount) {
        $result = false;
        $this->db->set('mlm_user_id', $user_id)
                ->set('user_L', $user_l_carry)
                ->set('user_R', $user_r_carry)
                ->set('user_L_carry', $update_l_carry)
                ->set('user_R_carry', $update_r_carry)
                ->set('binary_pair', $binary_pair)
                ->set('capped_amount', $capped_amount)
                ->set('dist_amount', $dist_amount)
                ->set('date', date('Y-m-d H:m:s'))
                ->insert('binary_bonus_history');
        if ($this->db->affected_rows()) {
            $result = true;
        }
        return $result;
    }

    /**
     * For First pair status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return boolean
     */
    function getFirstPairStatus($user_id) {
        $result = false;
        $query = $this->db->select('id')
                ->where('wallet_type', 'binary_bonus')
                ->where('mlm_user_id', $user_id)
                ->get('wallet_details');
        if ($query->num_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * For distribute generation bonus
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_rank
     * @return type
     */
    function distributeGenerationBonus($user_id, $user_rank) {
        $return_status = true;
        $start_date = date('Y-m', strtotime('-1 month')) . '-01 00:00:00';
        $end_date = date('Y-m-t', strtotime($start_date)) . ' 23:59:59';
        $down_sales = $this->helper_model->getUserSale($user_id, $start_date, $end_date);
        if ($down_sales > 0) {
            $tier = 1;
            if ($user_rank < 2) {
                $up_father = $this->helper_model->getUplineWithGenerationRank($user_id);
                $return_status = $this->distributeGenerationAmount($up_father['user_id'], $down_sales, $tier, $up_father['rank_id'], $user_id);
            } else {
                $return_status = $this->distributeGenerationAmount($user_id, $down_sales, $tier, $user_rank, $user_id);
            }
        }
        return $return_status;
    }

    /**
     * For Distribute generation amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $down_sales
     * @param type $tier
     * @param type $user_rank
     * @param type $from_user
     * @return type
     */
    function distributeGenerationAmount($user_id, $down_sales, $tier, $user_rank, $from_user = '') {
        $paid_status = true;
        $admin_id = $this->helper_model->getAdminId();
        $generation_array = $this->configuration_model->getGenerationDetails();
        $percentage = $generation_array["$user_rank"]["g" . "$tier" . "_value"];
        if ($percentage > 0) {
            $dist_amount = $down_sales * $percentage / 100;
            $paid_status = $this->helper_model->insertWalletDetails($user_id, 'credit', $dist_amount, 'generation_bonus', $from_user, 'code', '', '', 1);
            $tier = $tier + 1;
            if ($tier <= count($generation_array) && $user_id != $admin_id) {
                $up_father = $this->helper_model->getUplineWithGenerationRank($user_id);
                if (!empty($up_father)) {
                    $paid_status = $this->distributeGenerationAmount($up_father['user_id'], $down_sales, $tier, $up_father['rank_id'], $from_user);
                } else {
                    return $paid_status;
                }
            } else {
                return $paid_status;
            }
        }
        return $paid_status;
    }

    /**
     * Distribute the investment bonus
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $investment_array
     * @param type $product_id
     * @return boolean
     */
    function distributeInvestmentBonus($user_id, $investment_array = array(), $product_id = '') {
        if ($product_id) {
            $package_pay[1]['product_id'] = $product_id;
            $package_pay[1]['category_id'] = $this->helper_model->getInvestCategoryId($product_id);
            $package_pay[1]['amount'] = $this->helper_model->getUplineUpdateValue('product_amount', $product_id);
        } else {
            $package_pay = $this->helper_model->getAllActivePurchases($user_id);
        }
        if (!empty($package_pay)) {
            foreach ($package_pay as $pay_pack) {
                $pack_id = $pay_pack['product_id'];
                if ($pack_id && $investment_array["$pack_id"] != NULL) {
                    $pay_amount = $pay_pack['amount'] * ($investment_array["$pack_id"] / 100);
                    if ($pay_amount > 0)
                        if (!$this->helper_model->updateInvestmentHistory($user_id, $pay_amount, $pay_pack['product_id'], $pay_pack['category_id']))
                            return false;
                }
            }
        }
        return true;
    }

    /**
     * For distribute the stair step bonus
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $mlm_user
     * @return type
     */
    function distributeStairStepBonus($mlm_user) {
        $return_status = true;
        $start_date = date('Y-m', strtotime('-1 month')) . '-01 00:00:00';
        $end_date = date('Y-m-t', strtotime($start_date)) . ' 23:59:59';
        $down_sales = $this->helper_model->getUserSale($mlm_user, $start_date, $end_date);
        if ($down_sales > 0) {
            $paid_stair = 0;
            $return_status = $this->distributeStairStepAmount($mlm_user, $down_sales, $paid_stair, $start_date, $end_date, $mlm_user);
        }
        return $return_status;
    }

    /**
     * For distribute the stair step amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $down_sales
     * @param type $paid_stair
     * @param type $start_date
     * @param type $end_date
     * @param type $from_user
     * @return type
     */
    function distributeStairStepAmount($user_id, $down_sales, $paid_stair, $start_date, $end_date, $from_user) {
        $up_father = $this->helper_model->getUplineWithGenerationRank($user_id);
        $paid_status = true;
        if (!empty($up_father)) {
            $stair_step_array = $this->configuration_model->getStairStepDetails();
            $up_father_volume = $this->helper_model->getDownUsersUnilevelsale($up_father['user_id'], $start_date, $end_date);
            $up_father_qualified_enrolls = $this->helper_model->getReferralCount($up_father['user_id']);
            $matched_array = array_first($stair_step_array, function ($value) use ($up_father_volume, $up_father_qualified_enrolls) {
                return $value['qualifying_legs'] >= $up_father_qualified_enrolls && $value['group_volume'] >= $up_father_volume;
            });
            if (!empty($matched_array)) {
                $stair = array_only($matched_array, ['stair_step', 'percentage']);
                if ($stair['percentage'] > 0 && $paid_stair < $stair['stair_step']) {
                    $dist_amount = $down_sales * (($stair['percentage'] - $paid_stair > 0) ? $stair['percentage'] - $paid_stair : 0) / 100;
                    $paid_status = $this->helper_model->insertWalletDetails($user_id, 'credit', $dist_amount, 'stair_step_bonus', $from_user, 'code', '', '', 1);
                    $paid_stair = $paid_stair + $stair['stair_step'];
                    if ($paid_stair <= count($stair_step_array)) {
                        $up_father = $this->helper_model->getUplineWithGenerationRank($up_father['user_id']);
                        if (!empty($up_father)) {
                            $paid_status = $this->distributeStairStepAmount($up_father['user_id'], $down_sales, $paid_stair, $start_date, $end_date, $from_user);
                        } else {
                            return $paid_status;
                        }
                    } else {
                        return $paid_status;
                    }
                }
            }
        }
        return $paid_status;
    }

}
