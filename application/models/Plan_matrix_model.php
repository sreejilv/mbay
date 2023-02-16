<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For Matrix Plan related operation
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Plan_matrix_model extends CI_Model {

    public $up_fathers = array();
    public $up_fathers_chunk = array();
    public $up_sponsors = array();

    public function __construct() {
        parent::__construct();
        $this->up_fathers = null;
        $this->up_fathers_chunk = null;
        $this->up_sponsors = null;
        $this->load->model('configuration_model');
    }

    /**
     * For get user leg
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return string
     */
    function getUserLeg() {
        $leg = '';
        return $leg;
    }

    /**
     * For getting the balanced leg
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
     * For create matrix father ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $father_array
     * @return int
     */
    function createFatherIDMatrix($father_array) {
        $this->upline_fathers = array();
        $return_array = array();
        $matrix_width = $this->dbvars->MATRIX_WIDTH;
        foreach ($father_array as $key => $value) {
            $query = $this->db->select('mlm_user_id')
                    ->where('father_id', $value)
                    ->get('user');
            if ($query->num_rows() > 0) {
                if ($query->num_rows() >= $matrix_width) {
                    $this->upline_fathers = array_merge($this->upline_fathers, array_column($query->result_array(), 'mlm_user_id'));
                } else {
                    $return_array['father_id'] = $value;
                    $return_array['position'] = $query->num_rows() + 1;
                    return $return_array;
                }
            } else {
                $return_array['father_id'] = $value;
                $return_array['position'] = 1;
                return $return_array;
            }
        }
        if (count($this->upline_fathers) > 0) {
            return $this->createFatherIDMatrix($this->upline_fathers);
        }
        return array();
    }

    /**
     * For Create Father ID
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $sponsor_id
     * @return type
     */
    function createFatherID($sponsor_id) {
        $father_array[] = $sponsor_id;
        return $this->createFatherIDMatrix($father_array);
    }

    /**
     * For update father form traversing
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $father_id
     * @param type $level
     * @return type
     */
    function updateFatherTraverse($user_id, $father_id, $level = 1) {
        $admin_id = $this->helper_model->getAdminId();
        $query = $this->db->set('user_id', $user_id)
                ->set('path', $father_id)
                ->set('level', $level)
                ->insert('traverse_father');
        if ($this->db->affected_rows()) {
            $query = $this->db->query("INSERT INTO `mlm_traverse_father` ( user_id, path, level ) SELECT $user_id, path, level+1 FROM `mlm_traverse_father` WHERE user_id =$father_id AND user_id != $admin_id");
        }
        return $query;
    }

    /**
     * For update the Sponsor 
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
     * For distribute the commission
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $add_user
     * @param type $package_id
     * @param type $sponsor_id
     * @return boolean
     */
    function distributeCommissionBasedPlan($add_user, $package_id, $sponsor_id) {
        $success['point_update_status'] = $success['rank_status'] = $success['referral_status'] = $success['generation_status'] = $success['investment_status'] = $success['stair_step_status'] = $success['matrix_complete_status'] = $success['level_bonus_status'] = true;
        $update_point = 1;
        if ($this->dbvars->UPLINE_UPDATE > 0) {
            if ($this->dbvars->REGISTER_PACKAGE > 0) {
                $update_point = $this->helper_model->getUplineUpdateValue($this->dbvars->UPLINE_UPDATE_VALUE, $package_id);
            }
            if ($update_point > 0)
                $success['point_update_status'] = $this->updatePointsToLeg($add_user, $update_point);
        }

        if ($this->configuration_model->getBonusStatus('rank_bonus')) {//Rank Commission
            $success['rank_status'] = $this->checkRanksUpUsers($add_user);
        }
        if ($this->configuration_model->getBonusStatus('refferal_bonus')) {//Referral Commission
            $dist_amount = $this->getReferralAmount($package_id);
            if ($dist_amount > 0) {
                $success['refferal_bonus'] = $this->distributeReferralBonus($sponsor_id, 'credit', $dist_amount, 'refferal_bonus', $add_user);
            }
        }

        if ($this->configuration_model->getBonusStatus('matrix_level')) {
            $success['level_bonus_status'] = $this->distributeLevelBonus($package_id, $add_user);
        }

        if ($this->configuration_model->getBonusStatus('matrix_complete_bonus')) {
            $success['matrix_complete_status'] = $this->distributeMatrixCompletionBonus($add_user);
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
                $success['investment_status'] = $this->distributeInvestmentBonus($add_user, $investment_array);
            }
        }

        if ($this->dbvars->STAIR_STEP_STATUS > 0 && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing')) {//Stair Step Bonus
            if ($package_id > 0)
                $success['stair_step_status'] = $this->distributeStairStepBonus($add_user);
        }

        if (!$success['point_update_status'] || !$success['rank_status'] || !$success['referral_status'] || !$success['generation_status'] || !$success['investment_status'] || !$success['stair_step_status'] || !$success['matrix_complete_status'] || !$success['level_bonus_status']) {
            $this->helper_model->insertFailedActivity($add_user, 'registration_error', $success);
            return false;
        }
        return true;
    }

    /**
     * For re-purchase commission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $update_point
     * @return boolean
     */
    function distributeRepurchaseCommission($user_id, $update_point = '') {
        $success['point_update_status'] = $success['rank_status'] = $success['generation_status'] = $success['stair_step_status'] = true;
        if ($this->dbvars->UPLINE_UPDATE > 0)
            $success['point_update_status'] = $this->updatePointsToLeg($user_id, $update_point);

        if ($this->configuration_model->getBonusStatus('rank_bonus')) {//Rank Commission
            $success['rank_status'] = $this->checkRanksUpUsers($user_id);
        }

        if ($this->configuration_model->getBonusStatus('matrix_level')) {
            $success['level_bonus_status'] = $this->distributeLevelBonus('', $user_id, $update_point);
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
            $success['stair_step_status'] = $this->distributeStairStepBonus($user_id);
        }
        if (!$success['point_update_status'] || !$success['rank_status'] || !$success['generation_status'] || !$success['stair_step_status'] || !$success['level_bonus_status']) {
            $this->helper_model->insertFailedActivity($user_id, 'purchasse_error', $success);
            return false;
        }
        return true;
    }

    /**
     * For Referral Amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $package_id
     * @return type
     */
    function getReferralAmount($package_id) {
        $consider_amount = $this->dbvars->ENTRI_FEE;
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
     * For insert the referral bonus
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
        return $this->helper_model->insertWalletDetails($sponsor_id, $type, $dist_amount, $wallet_type, $add_user, 'code', '', '', 1);
    }

    /**
     * For Check Rank increment Users
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
     * For update  users leg  points
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $update_point
     * @return boolean
     */
    function updatePointsToLeg($user_id, $update_point) {
        $this->upline_fathers = array();
        $this->upline_fathers_chunk = null;
        $this->upline_fathers = $this->helper_model->getUplineFathers($user_id);
        $this->upline_fathers_chunk = array_chunk($this->upline_fathers, 500);
        $i = 0;
        while (!empty($this->upline_fathers_chunk[$i])) {
            foreach ($this->upline_fathers_chunk[$i] as $row) {
                $this->db->set("point", "point + " . $update_point, false)
                        ->where('mlm_user_id', $row['path'])
                        ->update('user');
                if (!$this->db->affected_rows()) {
                    return false;
                }
            }
            $i++;
        }
        return true;
    }

    /**
     * For distribute the level bonus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $package_id
     * @param type $user_id
     * @param type $total_value
     * @return type
     */
    function distributeLevelBonus($package_id, $user_id, $total_value = 0) {
        $level_bonus_status = false;
        $this->upline_fathers = array();
        if ($total_value > 0) {
            $consider_amount = $total_value;
        } else {
            $consider_amount = $this->dbvars->ENTRI_FEE;
            if ($package_id > 0) {
                $consider_amount += $this->helper_model->getUplineUpdateValue($this->dbvars->UPLINE_UPDATE_VALUE, $package_id);
            }
        }
        $this->upline_fathers = $this->helper_model->getUplineFathers($user_id, $this->dbvars->MATRIX_DEPTH);
        foreach ($this->upline_fathers as $users) {
            if ($this->dbvars->MATRIX_LEVEL_BONUS_TYPE == 'percentage')
                $dist_amount = $consider_amount * $this->levelAmountForUser($users['level'], $this->dbvars->MATRIX_LEVEL_BONUS_TYPE) / 100;
            else
                $dist_amount = $this->levelAmountForUser($users['level'], $this->dbvars->MATRIX_LEVEL_BONUS_TYPE);
            $level_bonus_status = $this->helper_model->insertWalletDetails($users['path'], $type = 'credit', $dist_amount, 'matrix_level', $user_id, 'code', '', '', 1);
            if ($level_bonus_status) {
                if ($this->configuration_model->getBonusStatus('matching_bonus'))
                    $this->distributeMatchingBonus($users['path'], $dist_amount, $this->dbvars->MATCH_LEVEL);
            }
        }
        return $level_bonus_status;
    }

    /**
     * For user level amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $level
     * @param type $type
     * @return type
     */
    function levelAmountForUser($level, $type = 'amount') {
        $return_amount = 0;
        $query = $this->db->select("$type")
                ->where('level', $level)
                ->get('matrix_level_bonus_settings');
        if ($query->num_rows() > 0) {
            $return_amount = $query->row()->$type;
        }
        return $return_amount;
    }

    /**
     * For distribute the matrix completion bonus
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function distributeMatrixCompletionBonus($user_id) {
        $user = $this->helper_model->getUplineFathersOnLevel($user_id, $this->dbvars->MATRIX_DEPTH);
        return $this->checkMatrixCompletion($user, $user_id);
    }

    /**
     * For check Matrix Completion Reached
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $from_id
     * @return type
     */
    function checkMatrixCompletion($user_id, $from_id) {
        $user_array[] = $user_id;
        $level = 1;
        $matrix_complete_bonus = true;
        if ($this->checkCompletion($user_array, $level)) {
            $dist_amount = 5;
            $matrix_complete_bonus = $this->helper_model->insertWalletDetails($user_id, $type = 'credit', $dist_amount, 'matrix_complete_bonus', $from_id, 'code', '', '', 1);
        }
        return $matrix_complete_bonus;
    }

    /**
     * For Check Completion
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $father_array
     * @param type $level
     * @return boolean
     */
    function checkCompletion($father_array, $level = 1) {
        $matrix_width = $this->dbvars->MATRIX_WIDTH;
        $matrix_depth = $this->dbvars->MATRIX_DEPTH;
        $this->upline_fathers = array();
        foreach ($father_array as $key => $value) {
            $query = $this->db->select('mlm_user_id')
                    ->where('father_id', $value)
                    ->get('user');
            if ($query->num_rows() > 0) {
                if ($query->num_rows() >= $matrix_width) {
                    $this->upline_fathers = $merge = array_merge($this->upline_fathers, array_column($query->result_array(), 'mlm_user_id'));
                } else {
                    if ($level > $matrix_depth)
                        return true;
                    return false;
                }
            } else {
                if ($level > $matrix_depth)
                    return true;
                return false;
            }
        }

        if (count($this->upline_fathers) > 0 && $level <= $matrix_depth) {
            $level++;
            return $this->checkCompletion($this->upline_fathers, $level);
        } else {
            return false;
        }
    }

    /**
     * For matching bonus
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $dist_amount
     * @param type $level
     * @return type
     */
    function distributeMatchingBonus($user_id, $dist_amount, $level) {
        $this->upline_sponsors = null;
        $result = true;
        $this->upline_sponsors = $this->helper_model->getUplineSponsors($user_id, $level);
        foreach ($this->upline_sponsors as $row) {
            $percentage = $this->getMatchingLevelAmount($row['level']);
            $pay_amount = ($dist_amount * $percentage) / 100;
            $result = $this->helper_model->insertWalletDetails($row['path'], $type = 'credit', $pay_amount, 'matching_bonus', $user_id, $user_id, '', '', 1);
        }
        return $result;
    }

    /**
     * For matching level amount
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $level
     * @return type
     */
    function getMatchingLevelAmount($level) {
        $return_amount = 0;
        $query = $this->db->select('percentage')
                ->where('level', $level)
                ->where('status', 1)
                ->limit(1)
                ->get('matching_bonus');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_amount = $row->percentage;
            }
        }
        return $return_amount;
    }

    /**
     * For generation bonus
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
     * For generation amount distribute each members
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
     * For investment bonus
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
     * For distribute stair step bonus
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
     * For distribute stair step amount
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
    function distributeStairStepAmount($user_id, $down_sales, $paid_stair, $start_date, $end_date, $from_user = '') {
        $up_father = $this->helper_model->getUplineWithGenerationRank($user_id);
        $paid_status = true;
        if (!empty($up_father)) {
            $stair_step_array = $this->configuration_model->getStairStepDetails();
            $up_father = $this->helper_model->getUplineWithGenerationRank($user_id);
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
