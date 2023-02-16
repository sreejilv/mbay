<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base_Controller.php';

/**
 * For using for the promotion management
 * @author Techffodils Technologies LLP
 * @date 2018-01-4
 */
class Promotion extends Base_Controller {

    /**
     * For Promotion Management
     * @author Techffodils Technologies LLP
     * @date 2018-01-4
     */
    function index() {
        $username = $this->aauth->getUserName();
        $relica_link = $this->helper_model->getUserReplicaLink($username);
        $lcp_link = $this->helper_model->getUserLCPLink($username);
        $referal_link = $this->helper_model->getUserRefLink(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId());

        $logo = BASE_PATH . 'assets/images/logos/' . $this->main->get_usersession('mlm_site_info', 'company_logo');

        $gp_text1 = 'Test';
        $gp_text2 = 'Test';
        $gp_text3 = 'Test';

        $lt = 'Lead';
        $lsm = 'MLM';
        $lso = 'Promoting Site';

        $this->setData('lt', $lt);
        $this->setData('lsm', $lsm);
        $this->setData('lso', $lso);
        $this->setData('gp_text1', $gp_text1);
        $this->setData('gp_text2', $gp_text2);
        $this->setData('gp_text3', $gp_text3);
        $this->setData('referal_link_encode', urlencode($referal_link));
        $this->setData('relica_link_encode', urlencode($relica_link));
        $this->setData('lcp_link_encode', urlencode($lcp_link));
        $this->setData('referal_link', $referal_link);
        $this->setData('relica_link', $relica_link);
        $this->setData('lcp_link', $lcp_link);
        $this->setData('logo', $logo);
        $this->setData('title', lang('menu_name_75'));
        $this->loadView();
    }

}
