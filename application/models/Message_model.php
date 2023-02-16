<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For message related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    message
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Message_model extends CI_Model {

    /**
     * for add message
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $message
     * @param type $guid
     * @param type $to_user
     * @return type
     */
    function add_message($message, $guid, $to_user) {
        $chat_referance = '';
        if ($to_user > $guid) {
            $field = 'read_status2';
            $user1 = $to_user;
            $user2 = $guid;
            $chat_referance = $to_user . '_' . $guid;
        } else {
            $field = 'read_status1';
            $user1 = $guid;
            $user2 = $to_user;
            $chat_referance = $guid . '_' . $to_user;
        }

        $nickname = 'NA';
        $data = array(
            'message' => (string) $message,
            'nickname' => (string) $nickname,
            'guid' => (string) $guid,
            'timestamp' => time(),
            'chat_referance' => $chat_referance,
            'date' => date("Y-m-d H:i:s"),
            'user1' => $user1,
            'user2' => $user2,
        );

        $res = $this->db->insert('messages', $data);

        if ($res) {
            $this->db->set($field, 1)
                    ->where('chat_referance', $chat_referance)
                    ->update('messages');
        }
        return $res;
    }

    /**
     * for get message
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $timestamp
     * @param type $from
     * @param type $to
     * @return type
     */
    function get_messages($timestamp, $from, $to) {
        $img = $this->getUserImage($from);
        $chat_referance = '';
        if ($from > $to) {
            $field = 'read_status1';
            $read_field = 'read_status2';
            $chat_referance = $from . '_' . $to;
        } else {
            $field = 'read_status2';
            $read_field = 'read_status1';
            $chat_referance = $to . '_' . $from;
        }
        $query = $this->db->select('id,message,guid,timestamp,read_status1,read_status2')
                ->where('timestamp >', $timestamp)
                ->where('chat_referance', $chat_referance)
                ->order_by('timestamp', 'DESC')
                ->limit(10)
                ->get('messages');

        $data = array();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['message'] = $row['message'];
            $data[$i]['guid'] = $row['guid'];
            $data[$i]['timestamp'] = $row['timestamp'];
            $data[$i]['read_status'] = $row[$read_field];
            if ($row[$read_field]) {
                $data[$i]['read_msg'] = lang('msg_read');
            } else {
                $data[$i]['read_msg'] = lang('msg_send');
            }

            if ($row['guid'] == $from) {
                $data[$i]['nickname'] = lang('me');
                $data[$i]['img'] = $img;
            } else {
                $data[$i]['nickname'] = $this->helper_model->IdToUserName($row['guid']);
                $data[$i]['img'] = $this->getUserImage($row['guid']);
            }
            $i++;
        }

        $this->db->set($field, 1)
                ->where('chat_referance', $chat_referance)
                ->update('messages');


        return array_reverse($data);
    }

    /**
     * for get user image
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    public function getUserImage($user_id) {
        $user_dp = 'no_user.jpg';
        $query = $this->db->select('user_dp')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user_details');
        foreach ($query->result() as $row) {
            $user_dp = $row->user_dp;
        }
        return $user_dp;
    }

    /**
     * for getting user latest chats
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function getLatestChats($user_id) {
        $chat = array();
        $i = 0;
        $query = $this->db->select('chat_referance,user1,user2,max(timestamp) as time,max(date) as date')
                //->where("(user1 = '$user_id' OR user2 = '$user_id') ")
                ->where('user2',$user_id)
                ->or_where('user1',$user_id)
                ->limit(10)
                ->group_by('chat_referance')
                ->group_by('user1')
                ->group_by('user2')
                ->order_by('time', 'DESC')
                ->get('messages');
        foreach ($query->result() as $row) {
            $chat[$i]['code'] = $row->chat_referance;
            $chat[$i]['date'] = $row->date;
            if ($row->user1 == $user_id) {
                $read_status = 'read_status1';
                $chat_user = $row->user2;
            } else {
                $read_status = 'read_status2';
                $chat_user = $row->user1;
            }
            $chat[$i]['unread_msg_count'] = $this->getUnreadMsgCount($row->chat_referance, $read_status);

            $chat[$i]['to_user'] = $chat_user;
            $chat[$i]['to_username'] = $this->helper_model->IdToUserName($chat_user);
            $chat[$i]['to_user_pic'] = $this->getUserImage($chat_user);
            $chat[$i]['last_message'] = $this->getLastMessage($row->chat_referance);
            $i++;
        }
        return $chat;
    }

    /**
     * for getting user unread message count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $chat_referance
     * @param type $read_status
     * @return type
     */
    function getUnreadMsgCount($chat_referance, $read_status) {
        $this->db->select('id')
                ->from("messages")
                ->where($read_status, 0)
                ->where('chat_referance', $chat_referance);
        return $this->db->count_all_results();
    }

    /**
     * for get last message
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $chat_referance
     * @return type
     */
    public function getLastMessage($chat_referance) {
        $msg = '';
        $query = $this->db->select('message')
                ->where('chat_referance', $chat_referance)
                ->limit(1)
                ->order_by('id', 'DESC')
                ->get('messages');
        foreach ($query->result() as $row) {
            $msg = $row->message;
        }
        return $msg;
    }

    /**
     * foe get all usernames
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $query
     * @return type
     */
    function getAllUserNames($query) {
        $downlines = $this->helper_model->getDownlinesUnilevel($this->aauth->getId());
        $data = array();
        if ($query != '') {
            $res = $this->db->select("mlm_user_id,user_name")
                    ->from('user')
                    ->like('user_name', trim($query))
                    ->where('user_type != ', 'admin')
                    ->get();
        } else {
            $res = $this->db->select("mlm_user_id,user_name")
                    ->from('user')
                    ->where('user_type != ', 'admin')
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            if (in_array($row['mlm_user_id'], $downlines))
                $json[] = $row['user_name'];
        }

        return json_encode($json);
    }

    /**
     * for loading more messages
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $msg_id
     * @param type $from
     * @param type $to
     * @return type
     */
    function loadMoreMsgs($msg_id, $from, $to) {
        $img = $this->getUserImage($from);
        $chat_referance = '';
        if ($from > $to) {
            $read_field = 'read_status2';
            $chat_referance = $from . '_' . $to;
        } else {
            $read_field = 'read_status1';
            $chat_referance = $to . '_' . $from;
        }
        $query = $this->db->select('id,message,guid,timestamp,read_status1,read_status2')
                ->where('id <', $msg_id)
                ->where('chat_referance', $chat_referance)
                ->order_by('id', 'DESC')
                ->limit(10)
                ->get('messages');

        $data = array();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['message'] = $row['message'];
            $data[$i]['guid'] = $row['guid'];
            $data[$i]['timestamp'] = $row['timestamp'];
            $data[$i]['read_status'] = $row[$read_field];
            if ($row[$read_field]) {
                $data[$i]['read_msg'] = lang('msg_read');
            } else {
                $data[$i]['read_msg'] = lang('msg_send');
            }
            if ($row['guid'] == $from) {
                $data[$i]['nickname'] = lang('me');
                $data[$i]['img'] = $img;
            } else {
                $data[$i]['nickname'] = $this->helper_model->IdToUserName($row['guid']);
                $data[$i]['img'] = $this->getUserImage($row['guid']);
            }
            $i++;
        }

        return $data;
    }

    /**
     * for getting more message count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $msg_id
     * @param type $from
     * @param type $to
     * @return type
     */
    function getMoreMsgsCount($msg_id, $from, $to) {
        $img = $this->getUserImage($from);
        $chat_referance = '';
        if ($from > $to) {
            $chat_referance = $from . '_' . $to;
        } else {
            $chat_referance = $to . '_' . $from;
        }
        return $this->db->select("id")
                        ->where('id <', $msg_id)
                        ->from("messages")
                        ->where('chat_referance', $chat_referance)
                        ->count_all_results();
    }

}
