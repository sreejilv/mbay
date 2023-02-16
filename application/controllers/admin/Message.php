<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base_Controller.php';

/**
 * For controller for internal message in the system
 */
class Message extends Base_Controller {

    /**
     * For Load the message view
     * @author Techffodils Technologies LLP
     * @date 2107-12-1 
     */
    public function index() {
        $loged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $latest = $this->message_model->getLatestChats($loged_user);
        //print_r($latest);die();
        $to_user = $to_username = '';
        if (count($latest)) {
            $to_user = $latest[0]['to_user'];
            $to_username = $latest[0]['to_username'];
        }

        $this->setData('latest', $latest);
        $this->setData('to_user', $to_user);
        $this->setData('to_username', $to_username);
        $this->setData('loged_user', $loged_user);
        $this->setData('title', lang('menu_name_10'));
        $this->loadView();
    }

    /**
     * For send message to users 
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    public function send_message() {
         $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        
        $message = $get['message'];
        $guid = $get['guid'];
        $to_user = $get['to_user'];

        if ($this->helper_model->IdToUserName($to_user))
            $this->message_model->add_message($message, $guid, $to_user);

        $this->_setOutput($message);
    }

    /**
     * For getting the messages form users
     * @author Techffodils Technologies LLP
     * @date 2017-12-02
     */
    public function get_messages() {
         $this->load->helper('security');
        $get = $this->security->xss_clean($this->input->get());
        $timestamp = $get['timestamp'];
        $to_user = $get['to_user'];
        $messages = $this->message_model->get_messages($timestamp, ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), $to_user);

        $this->_setOutput($messages);
    }

    /**
     * For set the messages  received 
     * @author Techffodils Technologies LLP
     * @date 2017-12-3
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
     * For getting the chat list
     * @author Techffodils Technologies LLP
     * @date 2017-12-4
     */
    public function get_chat_list() {
        $loged_user = ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId();
        $latest = $this->message_model->getLatestChats($loged_user);

        $this->_setOutput($latest);
    }

    /**
     * For validate the down-line users are valid or existing
     * @author Techffodils Technologies LLP
     * @date 2017-12-4
     */
    public function validate_downline_user() {
        $res = 0;
        if ($this->input->get('downline_user')) {
            $username = $this->input->get('downline_user');
            $user_id = $this->helper_model->userNameToID($username);
            if ($user_id) {
                $res = $user_id;
            }
        }
        echo $res;
        exit();
    }

    /**
     * For validate entered user under the logged user
     * @author Techffodils Technologies LLP
     * @date 2017-12-4
     */
    public function validate_downline() {
        $res = 'no';
        if ($this->input->get('downline_user')) {
            $username = $this->input->get('downline_user');
            $user_id = $this->helper_model->userNameToID($username);
            $downlines = $this->helper_model->getDownlinesUnilevel(($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId());
            if ($user_id && in_array($user_id, $downlines)) {
                $res = 'yes';
            }
        }
        echo $res;
        exit();
    }

    /**
     * For fetch All down-line users
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    function get_downline_usernames() {
        $query = $this->input->post('query');
        $result = $this->message_model->getAllUserNames($query);
        echo $result;
        exit();
    }

    /**
     * For getting the messages based on the messages received to whom
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    public function load_more() {
        $msg_id = $this->input->get('msg_id', null);
        $to_user = $this->input->get('to_user', null);
        $messages = $this->message_model->loadMoreMsgs($msg_id, ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), $to_user);

        $this->_setOutput($messages);
    }

    /**
     * For getting the count of messages where received
     * @author Techffodils Technologis LLP
     * @date 2017-12-04
     */
    public function load_more_count() {
        $msg_id = $this->input->get('msg_id', null);
        $to_user = $this->input->get('to_user', null);
        $messages = $this->message_model->getMoreMsgsCount($msg_id, ($this->aauth->getUserType() == 'employee') ? $this->base_model->getAdminUserId() : $this->aauth->getId(), $to_user);

        if ($messages > 0) {
            $msg = 'yes';
        } else {
            $msg = 'no';
        }
        echo json_encode($msg);
        exit();
    }

}
