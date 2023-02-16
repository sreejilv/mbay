<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base_Controller.php';

/**
 * For system users view in pictorial representation
 * Like geanology,Horizotal,Tabular ,sponsor etc..

 * @access public
 * @author Techffodils Technologies LLP
 * @copyright (c) 2017, Techffodils Technologies
 * @return type

 */
class Tree extends Base_Controller {

    /**
     * For system users view in genealogy
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function genealogy() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->setData('node_size', 165);
        $this->setData('user_id', $user_id);
        $this->setData('title', lang('menu_name_26'));
        $this->loadView();
    }

    /**
     * For validate the search user name
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function validate_username() {
        if ($this->input->get('username')) {
            if ($user_id = $this->helper_model->userNameToID($this->input->get('username'))) {
                echo $user_id;
                exit();
            }
        }
        echo 'no';
        exit();
    }

    /**
     * For view user sponsor wise representation Sponsor Tree
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function sponsor() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $this->setData('node_size', 165);
        $this->setData('user_id', $user_id);
        $this->setData('title', lang('menu_name_27'));
        $this->loadView();
    }

    /**
     * For view user tree
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function getUserTree() {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_id = $this->input->post('user_id');
        $type = $this->input->post('type');

        $tree = $this->tree_model->getUserDownlineTreeDetails($user_id, $logged_user, $type);
        $width = $this->tree_model->getDownlineTreeWidth($user_id, $type);

        $data = array();
        $data['tree'] = $tree;
        $data['user_width'] = $width;

        echo json_encode($data);
        exit;
    }

    /**
     * For view root tree
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function root() {
        $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $childs = $this->tree_model->getRootLevel1Downlines($log_user_id);
        //$max_childs = $this->tree_model->getUserTreeWidth($log_user_id, 'father') + 2;
        if($childs<5){
            $max_childs=40;
        }else{
            $max_childs=$childs*10;
        }
        $this->setData('childs', $childs);
        $this->setData('max_childs', $max_childs);
        $this->setData('title', lang('menu_name_102'));
        $this->loadView();
    }

    function root_tree_json($user_id = '') {
        if ($user_id) {
            $log_user_id = $user_id;
        } else {
            $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        }
        $username = $this->helper_model->IdToUserName($log_user_id);
        echo $this->tree_model->getRootTreeFile($log_user_id, $username);
        exit();
    }

    /**
     * For view Tabular Tree
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function tabular_tree() {
        $this->setData('title', lang('menu_name_28'));
        $this->loadView();
    }

    function tabular_tree_json($user_id = '') {
        if ($user_id) {
            $log_user_id = $user_id;
        } else {
            $log_user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        }
        $username = $this->helper_model->IdToUserName($log_user_id);
        echo $this->tree_model->getTabularTreeFile($log_user_id, $username);
        exit();
    }

    function affiliate() {
        $user_id = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $mlm_plan = $this->dbvars->MLM_PLAN;
        $node_size = 130;
        $this->setData('node_size', $node_size);
        $this->setData('user_id', $user_id);
        $this->setData('title', lang('menu_name_121'));
        $this->loadView();
    }

    /**
     * For view the affiliate tree
     * @access public
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type

     */
    function getAffiliateTree() {
        $logged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $user_id = $this->input->post('user_id');
        $tree = $this->tree_model->getUserAffiliateTreeDetails($user_id, $logged_user);
        $data = array();
        $data['tree'] = $tree;
        $width = count($this->tree_model->downAffiliateDetails($user_id)) + 2;
        if ($width < 7) {
            $width = 7;
        }
        $data['user_width'] = $width;

        echo json_encode($data);
        exit;
    }

}
