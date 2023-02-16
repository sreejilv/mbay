<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For Tree related model
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Tree_model extends CI_Model {

    var $tree_depth;
    var $tree_tooltip_array;

    public function __construct() {
        parent::__construct();

        $this->tree_depth = 3; // set tree depth
        $this->tree_array = [];
    }

    /**
     * 
     * for getting the user downline tee details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $logged_user
     * @param type $type
     * @return string
     */
    public function getUserDownlineTreeDetails($user_id, $logged_user, $type = 'father') {

        $node = $this->nodeDetails($user_id, $type);

        $up_user = ($type == 'father') ? $node['father_id'] : $node['sponsor_id'];

        $tree = "<div id='tree_overflow' class='overflow'>
                    <div id='tree-div' class=''>
                        <ul class='tree'>
                            <li class='node'>
                                <div class='person' id='tree_root_user'";
        if ($logged_user != $user_id) {
            $tree .= " onclick='javascript:load(" . $up_user . ")'";
        }
        $tree .= ">
                                <a href='javascript:void(0)' class='show-pop tooltipstered' id='my-tooltip' 
                                data-content='" . $node['tooltip'] . "'> 
                                <div class='person_img'>
                                    <img  class='prof_img' src='assets/images/users/" . $node['user_dp'] . "' />
                                </div>
                                    <div class='person_title' style='background: #f7f3f3;     text-align: center;top: 75px;width:78px;left: 7px;max-width:78px;word-wrap: break-word;'>";
        if ($node['user_status'] == 'active') {
            $tree .= $node['user_name'];
        } else {
            $tree .= "<span style='color:red;'><del>" . $node['user_name'] . "</del></span>";
        }
        $tree .= "</div>
                            </a>
                        </div>";

        $tree .= $this->createSubTree($user_id, $type, 1);
        $tree .= "</li>
                </ul>
            </div>
        </div>";

        return $tree;
    }

    /**
     * For create subtree
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @param type $level
     * @return type
     */
    public function createSubTree($user_id, $type, $level = 1) {
        $tree = '';

        if ($down_node = $this->downNodeDetails($user_id, $type)) {

            $tree = '<ul>';

            if ($this->dbvars->MLM_PLAN == 'BINARY' && $type == 'father' && $down_node[0]['position'] == 'R') {
                $tree .= $this->createPlusEntry($type, $down_node, $user_id, 'L');
            }
            foreach ($down_node as $val) {

                $node = $this->nodeDetails($val['mlm_user_id'], $type);
                $tree .= "<li class='node'>
                                    <div class='person'  onclick='javascript:load(" . $node['mlm_user_id'] . ")' >
                                        <a href='javascript:void(0)' class='show-pop'  data-content='" . $node['tooltip'] . "'> 
                                            <div class='person_img'>
                                                <img  class='prof_img' src='assets/images/users/" . $node['user_dp'] . "' />
                                            </div>
                                            <div class='person_title' style='background:#f7f3f3;text-align: center;top: 75px;width:78px;left: 7px;max-width:78px;word-wrap: break-word;'>";
                if ($node['user_status'] == 'active') {
                    $tree .= $node['user_name'];
                } else {
                    $tree .= "<span style='color:red;'><del>" . $node['user_name'] . "</del></span>";
                }
                $tree .= "</div></a></div>";


                if ($level < $this->tree_depth) {

                    $down_no = $this->downUserStatus($node['mlm_user_id'], $type);
                    if ($down_no) {
                        $tree .= $this->createSubTree($node['mlm_user_id'], $type, $level + 1);
                    } else {
                        if ($type == 'father')
                            $tree .= $this->createLeafEntry($type, $node['mlm_user_id']);
                    }
                }
                $tree .= "</li>";
            }
            if (!($this->dbvars->MLM_PLAN == 'BINARY' && $down_node[0]['position'] != 'L')) {
                if ($type == 'father')
                    $tree .= $this->createPlusEntry($type, $down_node, $user_id, 'R');
            }

            $tree .= "</ul>";
        } else {

            $tree .= $this->createLeafEntry($type, $user_id);
        }
        return $tree;
    }

    /**
     * For node details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return string
     */
    function nodeDetails($user_id, $type) {

        $data = array();
        $tooltip = '';
        $query = $this->db->select('user.mlm_user_id,user_name,email,point,phone_number,user_rank_id,user_type,position,father_id,sponsor_id,user_status,user.date,first_name,last_name,date_of_birth,user_dp,user_cover,user_details.date_of_joining,CONCAT(first_name,last_name) as full_name,country_id,user_L_carry,user_R_carry,user_L,user_R')
                ->from('user')
                ->join('user_details', "user.mlm_user_id = user_details.mlm_user_id")
                ->where('user.mlm_user_id', $user_id)
                ->order_by('user.position')
                ->limit(1)
                ->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $val) {

                $country_name = $this->helper_model->getCountryName($val['country_id']);
                $rank_name = $this->helper_model->getRankIBydName($val['user_rank_id']);
                $count = count($this->helper_model->getDownlinesBinary($val['mlm_user_id']));
                $tooltip .= '<div class="hovercard"><div>
        <div class="display-pic">
            <div class="cover-photo">
                <div class="display-pic-gradient"></div><img src="assets/images/users/' . $val['user_cover'] . '" style="width: 377px; height: 137px; top: -3px; left: 0px;"/></div>

            <div class="profile-pic">
                <div class="pic"><img src="assets/images/users/' . $val['user_dp'] . '" title=
                                      "Profile Image"style="width:92px;height:92px;"></div>

                <div class="details">
                    <ul class="details-list">
                        <li class="details-list-item">
                            <p><span class="glyph glyph-home"></span><i class="fa fa-home"></i>
                                <span>' . lang('lives_in') . ' <a href="javascript:void(0)"><span class="label label-primary">' . html_escape($country_name) . '</span></a>
                                    <a href="javascript:void(0)"></a></span></p>
                        </li>
                        <li class="details-list-item">
                            <p><span class="glyph glyph-home"></span><i class="fa fa-diamond"></i>
                                <span>' . lang('rank') . ' <a href="javascript:void(0)"><span class="label label-green">' . $rank_name . '</span></a>
                                    <a href="javascript:void(0)"></a></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="display-pic-gradient"></div>

        <div class="title-container">
            <code><a class="title" href="javascript:void(0)">' . html_escape($val['first_name']) . ' ' .html_escape($val['last_name']). '</a></code>

            <p class="other-info"><code>' . lang('downlines') . ':' . $count . '</code></br><code><i class="fa fa-calendar"></i>:' . $val['date_of_joining'] . '</code></p>
        </div>';


                if ($this->dbvars->MLM_PLAN == 'BINARY' && $type == 'father') {

                    $tooltip .= '<div "class="panel-group" style="top:80px;position:relative;">
        <div class="col-md-12">';
                    $tooltip .= '<div class = "col-sm-6">
<p>' . lang('user_total_left') . ': ' . $val['user_L'] . '</p>
<p>' . lang('user_total_right') . ': ' . $val['user_R'] . '</p>
</div>';
                    $tooltip .= '<div class = "col-sm-6">
<p>' . lang('left_user_count') . ': ' . $val['user_L_carry'] . '</p>
<p>' . lang('right_user_count') . ': ' . $val['user_R_carry'] . '</p>
</div>';
                } else {
                    $tooltip .= '<div "class="panel-group" style="top:80px;position:relative;">
        <div class="col-md-12">
                    <p><i class="fa fa-envelope"></i>' . lang('email_address') . ' : ' . html_escape($val['email']) . '</p>
                    
                    <p><i class="fa fa-phone"></i>' . lang('phone_number') . ' : ';
                    if ($val['phone_number']) {
                        $tooltip .= html_escape($val['phone_number']);
                    } else {
                        $tooltip .= lang('na');
                    }
                    $tooltip .= '</p>';
                }
                $tooltip .= '</div></div></div></div>';
                $val['tooltip'] = $tooltip;
                $data = $val;
            }
        }
        return $data;
    }

    /**
     * For dwonline node details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    function downNodeDetails($user_id, $type) {

        $data = array();
        $this->db->select('*');

        if ($type == 'sponsor') {
            $this->db->where('sponsor_id', $user_id);
            $this->db->order_by('mlm_user_id', 'ASC');
        } else {
            $this->db->where('father_id', $user_id);
            if ($this->dbvars->MLM_PLAN == 'BINARY') {
                $this->db->order_by('position', 'ASC');
            } else {
                $this->db->order_by('LENGTH(position)', 'position');
            }
        }

        $query = $this->db->get('user');

        foreach ($query->result_array() as $res) {
            $data[] = $res;
        }
        return $data;
    }

    /**
     * For downline users status
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    function downUserStatus($user_id, $type) {


        if ($type == 'sponsor') {
            $this->db->where('sponsor_id', $user_id);
        } else {
            $this->db->where('father_id', $user_id);
        }
        return $this->db->from("user")->count_all_results();
    }

    /**
     * for create leaf entry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @return string
     */
    function createLeafEntry($type, $reg_user = '') {
        $encoded_user = $this->helper_model->encode($reg_user);

        $url = 'javascript:void(0)';
        if ($this->dbvars->REG_FROM_TREE_STATUS) {
            $url = $this->dbvars->REG_MODE.'/' . $encoded_user . '/L/1';
        }

        $leaf_node = "<ul>
                        <li> 
                            <div class='person' style='padding: 2px;
'>
                                <div class='person_img' style='width: 62px;
height: 63px;
'>
<a href='" . $url . "'>
                                    <img  class='prof_img' src='assets/images/plus-square.png'  style='width: 62px;
height: 63px;
'/>
</a>
                                </div>
                            </div>
                        </li>";

        if ($this->dbvars->MLM_PLAN == 'BINARY' && $type == 'father') {
            $url = 'javascript:void(0)';
            if ($this->dbvars->REG_FROM_TREE_STATUS) {
                $url = $this->dbvars->REG_MODE.'/' . $encoded_user . '/R/1';
            }
            $leaf_node .= " <li> 
                                <div class='person' style='padding: 2px;
'>
                                    <div class='person_img' style='width: 62px;
height: 63px;
'>
<a href='" . $url . "'>
                                        <img  class='prof_img' src='assets/images/plus-square.png'  style='width: 62px;
height: 63px;
'/>
</a>
                                    </div>
                                </div>
                            </li>";
        }

        $leaf_node .= "</ul>";

        return $leaf_node;
    }

    /**
     * for create plus entry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @param type $childs
     * @return string
     */
    function createPlusEntry($type, $childs, $reg_user = '', $reg_leg = '') {
        $encoded_user = $this->helper_model->encode($reg_user);

        $url = 'javascript:void(0)';
        if ($this->dbvars->REG_FROM_TREE_STATUS) {
            $url = $this->dbvars->REG_MODE.'/' . $encoded_user . '/' . $reg_leg . '/1';
        }
        $child_count = count($childs);

        $plus_node = '';
        if ($type == 'father') {
            $child_limit = 0;
            if ($this->dbvars->MONOLINE_STATUS) {
                $child_limit = 1;
            } elseif ($this->dbvars->MLM_PLAN == 'BINARY') {
                $child_limit = 2;
            } elseif ($this->dbvars->MLM_PLAN == 'MATRIX') {
                $child_limit = $this->dbvars->MATRIX_WIDTH;
            } elseif ($this->dbvars->MLM_PLAN == 'UNILEVEL') {
                $child_limit = $child_count + 1;
            }

            if (($child_count < $child_limit)) {

                $plus_node .= "<li> 
                    
                                        <div class='person' style='padding: 2px;
'>
                                            <div class='person_img' style='width: 62px;
height: 63px;
'>
<a href='" . $url . "'>
                                                <img  class='prof_img' src='assets/images/plus-square.png'  style='width: 62px;
height: 63px;
'/>
</a>
                                            </div>
                                        </div>
                                        
                                    </li>";
            }
        } else {

            $plus_node .= "<li> 
                
                                <div class='person' style='padding: 2px;
'>
                                    <div class='person_img' style='width: 62px;
height: 63px;
'>
<a href='" . $url . "'>
                                        <img  class='prof_img' src='assets/images/plus-square.png'  style='width: 62px;
height: 63px;
'/>
</a>
                                    </div>
                                </div>
                                
                            </li>";
        }

        return $plus_node;
    }

    /**
     * For get root tree
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_name
     * @return type
     */
    public function getRootTreeFile($user_id, $user_name) {
        $d3_downlines['user_id'] = $user_id;
        $d3_downlines['name'] = $user_name;
        $d3_downlines['children'] = $this->getRootDownlines($user_id);
        $d3_downlines['html'] = '';
        return json_encode($d3_downlines, JSON_PRETTY_PRINT);
    }

    /**
     * For get root downlines
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getRootDownlines($user_id) {
        if ($user_id) {
            $this->db->select('mlm_user_id, user_name, email, date');
            $this->db->where('father_id', $user_id);
            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                $d3_downlines = array();
                foreach ($query->result() as $row) {
                    if ($row->mlm_user_id > 0) {
                        $user['user_id'] = $row->mlm_user_id;
                        $user['name'] = $row->user_name;
                        $user['children'] = $this->getRootDownlines($row->mlm_user_id);
                        $user['html'] = $this->createRootTreePopup($row);
                        $d3_downlines[] = $user;
                    }
                }
                return $d3_downlines;
            }
        }
    }

    /**
     * 
     * For root level one downlines
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getRootLevel1Downlines($user_id) {
        return $this->db->where('father_id', $user_id)
                        ->from('user')->count_all_results();
    }

    /**
     * For create ROOT tree pop-up
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return string
     */
    public function createRootTreePopup($data) {
        $tooltip = '';
        $query = $this->db->select('user.mlm_user_id,user_dp,country_id,first_name,last_name')
                ->from('user')
                ->join('user_details', "user.mlm_user_id = user_details.mlm_user_id")
                ->where('user.mlm_user_id', $data->mlm_user_id)
                ->order_by('user.position')
                ->limit(1)
                ->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $val) {
                $country_name = $this->helper_model->getCountryName($val['country_id']);
                $count = count($this->helper_model->getDownlinesBinary($val['mlm_user_id']));

                $tooltip = '<div class="card">
                    <img src="assets/images/users/' . $val['user_dp'] . '" alt="John" style="width:25%">
  <h4><b>' . $val['first_name'] .' '.$val['last_name']. '</b></h4>
  <p class="title">' . lang('lives_in') . ':' . $country_name . '</p>
  <p class="title">' . lang('downlines') . ':<span class="label label-yellow">' . $count . '</span></p>'
                        . '<hr>'
                        . '</div>';
            }
        }
        return $tooltip;
    }

    /**
     * For get tabular tree
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $user_name
     * @return type
     */
    public function getTabularTreeFile($user_id, $user_name) {
        $d3_downlines['id'] = $user_id;
        $d3_downlines['name'] = $user_name;
        $d3_downlines['children'] = $this->getTabularDownlines($user_id);
        return json_encode($d3_downlines, JSON_PRETTY_PRINT);
    }

    /**
     * For get tabular downlines
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getTabularDownlines($user_id) {
        if ($user_id) {
            $this->db->select('mlm_user_id, user_name, email, date');
            $this->db->where('father_id', $user_id);
            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                $d3_downlines = array();
                foreach ($query->result() as $row) {
                    if ($row->mlm_user_id > 0) {
                        $user['id'] = $row->mlm_user_id;
                        $user['name'] = $row->user_name;
                        $user['parent'] = $user_id;
                        $user['children'] = $this->getTabularDownlines($row->mlm_user_id);
                        $d3_downlines[] = $user;
                    }
                }
                return $d3_downlines;
            }
        }
    }

    /**
     * For get user tree width one
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return int
     */
//    public function getUserTreeWidthOld($user_id, $type) {
//        $table = 'traverse_sponsor';
//        if ($type == 'father') {
//            $table = 'traverse_father';
//        }
//        $levels = $this->tree_depth;
//        $width = 0;
//        for ($i = 1; $i <= $levels; $i++) {
//            $width += $this->getTreeLevelWidth($table, $user_id, $i, $type);
//        }
////        if ($width < 5) {
////            $width = 5;
////        }
//        return $width;
//    }

    /**
     * For get TREE LEVEL Width
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $user_id
     * @param type $level
     * @return type
     */
//    public function getTreeLevelWidth($table, $user_id, $level, $type = '') {
//        $val = $this->db->where('path', $user_id)
//                        ->where('level', $level)
//                        ->from($table)->count_all_results();
//        $count = $val;
//        if ($type == 'father') {
//            $count = $count + 1;
//        }
////        if ($val > 2) {
////            $count = $val - 1;
////        }
//        return $count;
//    }

    /**
     * For get user TREE width
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return int
     */
    public function getUserTreeWidth($user_id, $type) {
        $field = 'father_id';
        if ($type == 'sponsor') {
            $field = 'sponsor_id';
        }
        $res = $this->db->select("mlm_user_id")
                ->from("user")
                ->where($field, $user_id)
                ->get();
        $width = 0;
        foreach ($res->result() as $row) {
            $mlm_user_id = $row->mlm_user_id;
            $width += $this->calculateUserWidth($mlm_user_id, $field, $type);
        }
        if ($width < 25) {
            $width = 25;
        }
        return $width;
    }

    /**
     * For calculate user width
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $field
     * @return int
     */
    public function calculateUserWidth($user_id, $field, $type = '') {
        $width = 0;
        $res = $this->db->select("mlm_user_id")
                ->from("user")
                ->where($field, $user_id)
                ->get();
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $row) {
                $mlm_user_id = $row->mlm_user_id;
                $width += $this->getNodeWidth($mlm_user_id, $field, $type);
            }
        } else {
            $mlm_plan = $this->dbvars->MLM_PLAN;
            if ($mlm_plan == 'MATRIX') {
                $matrix_width = $this->dbvars->MATRIX_WIDTH;
                if ($matrix_width > $width) {
                    $width = $width + 1;
                }
            } elseif ($mlm_plan == 'BINARY' && $type == 'father') {
                $width = $width + 2;
            } else {
                $width = $width + 1;
            }
        }
        return $width;
    }

    /**
     * For get node width
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $field
     * @return int
     */
    public function getNodeWidth($user_id, $field, $type = '') {
        $mlm_plan = $this->dbvars->MLM_PLAN;

        $count = $this->db->where($field, $user_id)
                        ->from('user')->count_all_results();
        if ($count <= 0) {
            $count = 1;
            if ($type == 'father' && $mlm_plan == 'BINARY') {
                $count = 2;
            }
        } else {
            if ($type == 'father') {
                if ($mlm_plan == 'MATRIX') {
                    $matrix_width = $this->dbvars->MATRIX_WIDTH;
                    if ($matrix_width > $count) {
                        $count = $count + 1;
                    }
                } else {
                    if ($mlm_plan == 'UNILEVEL') {
                        $count = $count + 1.5;
                    } else {
                        $count = $count + 1;
                    }
                }
            }
        }
        return $count;
    }

    /**
     * For getting user affiliates tree details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $logged_user
     * @param type $type
     * @return string
     */
    public function getUserAffiliateTreeDetails($user_id, $logged_user, $type = 'sponsor') {
        $node = $this->affiliateRootDetails($user_id, 'sponsor');
        $tree = "<div id='tree_overflow' class='overflow'>
                    <div id='tree-div' class=''>
                        <ul class='tree'>
                            <li class='node'>
                                <div class='person' id='tree_root_user'";

        $tree .= ">
                                <a href='javascript:void(0)' class='show-pop tooltipstered' id='my-tooltip' 
                                data-content='" . $node['tooltip'] . "'> 
                                <div class='person_img'>
                                    <img  class='prof_img' src='assets/images/users/" . $node['user_dp'] . "' />
                                </div>
                                    <div class='person_title' style='background: #f7f3f3;     text-align: center;top: 75px;width:78px;left: 7px;max-width:78px;word-wrap: break-word;'>" . $node['user_name'] . "</div>
                            </a>
                        </div>";

        $tree .= $this->createAffiliateTree($user_id);
        $tree .= "</li>
                </ul>
            </div>
        </div>";

        return $tree;
    }

    /**
     * For affiliate ROOT details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return string
     */
    function affiliateRootDetails($user_id, $type) {

        $data = array();
        $tooltip = '';
        $query = $this->db->select('user.mlm_user_id,user_name,email,point,phone_number,user_rank_id,user_type,position,father_id,sponsor_id,user_status,user.date,first_name,last_name,date_of_birth,user_dp,user_cover,user_details.date_of_joining,CONCAT(first_name,last_name) as full_name,country_id,user_L_carry,user_R_carry')
                ->from('user')
                ->join('user_details', "user.mlm_user_id = user_details.mlm_user_id")
                ->where('user.mlm_user_id', $user_id)
                ->order_by('user.position')
                ->limit(1)
                ->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $val) {

                $country_name = $this->helper_model->getCountryName($val['country_id']);
                $rank_name = $this->helper_model->getRankIBydName($val['user_rank_id']);
                $count = $this->getUserAffiliateCount($val['mlm_user_id'], 1);
                $tooltip .= '<div class="hovercard"><div>
        <div class="display-pic">
            <div class="cover-photo">
                <div class="display-pic-gradient"></div><img src="assets/images/users/' . $val['user_cover'] . '" style="width: 377px; height: 137px; top: -3px; left: 0px;"/></div>

            <div class="profile-pic">
                <div class="pic"><img src="assets/images/users/' . $val['user_dp'] . '" title=
                                      "Profile Image"style="width:92px;height:92px;"></div>

                <div class="details">
                    <ul class="details-list">
                        <li class="details-list-item">
                            <p><span class="glyph glyph-home"></span><i class="fa fa-home"></i>
                                <span>' . lang('lives_in') . ' <a href="javascript:void(0)"><span class="label label-primary">' . $country_name . '</span></a>
                                    <a href="javascript:void(0)"></a></span></p>
                        </li>
                        <li class="details-list-item">
                            <p><span class="glyph glyph-home"></span><i class="fa fa-diamond"></i>
                                <span>' . lang('rank') . ' <a href="javascript:void(0)"><span class="label label-green">' . $rank_name . '</span></a>
                                    <a href="javascript:void(0)"></a></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="display-pic-gradient"></div>

        <div class="title-container">
            <a class="title" href="javascript:void(0)" title="Visit Page">' . $val['full_name'] . '</a>

            <p class="other-info">' . lang('affiliates') . ':' . $count . '</br><i class="fa fa-calendar"></i>:' . $val['date_of_joining'] . '</p>
        </div>';

                $tooltip .= '<div "class="panel-group" style="top:80px;position:relative;">
        <div class="col-md-12">
                    <p><i class="fa fa-envelope"></i> ' . lang('email_address') . ' : ' . $val['email'] . '</p>
                    
                    <p><i class="fa fa-phone"></i>' . lang('phone_number') . ' : ' . $val['phone_number'] . '</p>
</div>
</div>
</div>
</div>
</div>';



                $val['tooltip'] = $tooltip;
                $data = $val;
            }
        }
        return $data;
    }

    /**
     * For create affiliate tree
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $type
     * @return type
     */
    public function createAffiliateTree($user_id, $type = 'sponsor') {
        $tree = '';
        if ($down_node = $this->downAffiliateDetails($user_id)) {
            $tree = '<ul>';
            foreach ($down_node as $val) {
                $node = $this->affiliateNodeDetails($val);
                $tree .= "<li class='node'>
                                    <div class='person'>
                                        <a href='javascript:void(0)' class='show-pop'  data-content='" . $node['tooltip'] . "'> 
                                            <div class='person_img'>
                                                <img  class='prof_img' src='assets/images/users/" . $node['user_dp'] . "' />
                                            </div>
                                            <div class='person_title' style='background:#f7f3f3;text-align: center;top: 75px;width:78px;left: 7px;max-width:78px;word-wrap: break-word;'>
                                                " . $node['user_name'] . "
                                            </div>
                                         </a>
                                    </div>";
                $tree .= "</li>";
            }
            $tree .= "</ul>";
        } else {
            $tree .= $this->createAffiliateLeafEntry($type);
        }
        return $tree;
    }

    /**
     * For create affiliate entry
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $type
     * @return string
     */
    function createAffiliateLeafEntry($type) {

        $leaf_node = "<ul>
                        <li> 
                            <div class='person' style='padding: 2px;
'>
                                <div class='person_img' style='width: 62px;
height: 63px;
'>
                                    <img  class='prof_img' src='assets/images/plus-square.png'  style='width: 62px;
height: 63px;
'/>
                                </div>
                            </div>
                        </li>";

        $leaf_node .= "</ul>";

        return $leaf_node;
    }

    /**
     * For download affiliates details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function downAffiliateDetails($user_id) {
        $data = array();
        $this->db->select('id');
        $this->db->where('sponser_id', $user_id);
        $this->db->order_by('id');
        $query = $this->db->get('affiliates');
        foreach ($query->result_array() as $res) {
            $data[] = $res['id'];
        }
        return $data;
    }

    /**
     * For affiliates node details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function affiliateNodeDetails($user_id) {

        $data = array();
        $tooltip = '';
        $query = $this->db->select('username,email,mobile,first_name,last_name,country,state,enroll_date,status')
                ->from('affiliates')
                ->where('id', $user_id)
                ->order_by('id')
                ->limit(1)
                ->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $val) {
                $country_name = $this->helper_model->getCountryName($val['country']);
                $val['user_dp'] = 'inactive.png';
                if ($val['status']) {
                    $val['user_dp'] = 'active.png';
                }
                $tooltip .= '<div class="hovercard"><div>
        <div class="display-pic">
            <div class="cover-photo">
                <div class="display-pic-gradient"></div><img src="assets/images/users/' . 'cover3.jpg' . '" style="width: 377px; height: 137px; top: -3px; left: 0px;"/></div>

            <div class="profile-pic">
                <div class="pic"><img src="assets/images/users/' . $val['user_dp'] . '" title=
                                      "Profile Image"style="width:92px;height:92px;"></div>

                <div class="details">
                    <ul class="details-list">
                        <li class="details-list-item">
                            <p><span class="glyph glyph-home"></span><i class="fa fa-home"></i>
                                <span>' . lang('lives_in') . ' <a href="javascript:void(0)"><span class="label label-primary">' . $country_name . '</span></a>
                                    <a href="javascript:void(0)"></a></span></p>
                        </li>
                        <li class="details-list-item">
                            <p><span class="glyph glyph-home"></span><i class="fa fa-diamond"></i>
                                <span>' . lang('enroll_date') . ' <a href="javascript:void(0)"><span class="label label-green">' . $val['enroll_date'] . '</span></a>
                                    <a href="javascript:void(0)"></a></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="display-pic-gradient"></div>
        <div class="title-container">
            <a class="title" href="javascript:void(0)" title="Visit Page"><font color="black">' . $val['first_name'] . ' ' . $val['last_name'] . '</font></a>

            </br><i class="fa fa-calendar"></i>:<font color="black">' . $val['enroll_date'] . '</font></p>
        </div>';

                $tooltip .= '<div "class="panel-group" style="top:80px;position:relative;">
        <div class="col-md-12">
                    <p><i class="fa fa-envelope"></i>' . lang('email_address') . ' : ' . $val['email'] . '</p>
                    
                    <p><i class="fa fa-phone"></i>' . lang('phone_number') . ' : ' . $val['mobile'] . '</p>
</div>
</div>
</div>
</div>
</div>';

                $val['tooltip'] = $tooltip;
                $val['user_name'] = $val['username'];
                $data = $val;
            }
        }
        return $data;
    }

    /**
     * For user affiliates count
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $flag
     * @return int
     */
    public function getUserAffiliateCount($user_id, $flag = 0) {
        $data = array();
        $this->db->select('id');
        $this->db->where('sponser_id', $user_id);
        $this->db->order_by('id');
        $count = $this->db->from("affiliates")->count_all_results();
        if ($count < 9 && !$flag) {
            $count = 9;
        }
        return $count;
    }

    public function getDownlineTreeWidth($user_id, $type) {
        $field = 'father_id';
        $width = 1;
        if ($type == 'sponsor') {
            $field = 'sponsor_id';
            $width = 0;
        }
        $res = $this->db->select("mlm_user_id")
                ->from("user")
                ->where($field, $user_id)
                ->get();

        foreach ($res->result() as $row) {
            $mlm_user_id = $row->mlm_user_id;
            $width += $this->calculateDownlineWidth($mlm_user_id, $field, $type);
        }
        if ($width < 6) {
            $width = 6;
        }
        return $width;
    }

    public function calculateDownlineWidth($user_id, $field, $type = '') {
        $width = 1;
        if ($type == 'sponsor') {
            $width = 0;
        }
        $res = $this->db->select("mlm_user_id")
                ->from("user")
                ->where($field, $user_id)
                ->get();
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $row) {
                $mlm_user_id = $row->mlm_user_id;
                $width += $this->getDownlineNodeWidth($mlm_user_id, $field, $type);
            }
        } else {
            if ($type == 'father') {
                $mlm_plan = $this->dbvars->MLM_PLAN;
                if ($mlm_plan == 'BINARY') {
                    $width = 2;
                } else {
                    $width = 1;
                }
            } else {
                $width = 1;
            }
        }
        return $width;
    }

    public function getDownlineNodeWidth($user_id, $field, $type = '') {
        $width = 1;
        if ($type == 'sponsor') {
            $width = 0;
        }
        $width = $this->db->where($field, $user_id)
                ->from('user')
                ->count_all_results();
        if ($width <= 0) {
            if ($type == 'father') {
                $mlm_plan = $this->dbvars->MLM_PLAN;
                if ($mlm_plan == 'BINARY') {
                    $width = 2;
                } else {
                    $width = 1;
                }
            } else {
                $width = 1;
            }
        } else {
            if ($type == 'father') {
                $mlm_plan = $this->dbvars->MLM_PLAN;
                if ($mlm_plan == 'MATRIX') {
                    $matrix_width = $this->dbvars->MATRIX_WIDTH;
                    if ($matrix_width > $width) {
                        $width = $width + 1;
                    }
                } else {
                    $width = $width + 1;
                }
            }
        }
        return $width;
    }

}
