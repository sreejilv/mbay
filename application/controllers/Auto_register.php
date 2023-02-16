<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * For System related operation like plan change , automatic register
 * @author Techffodils Technologies LLP
 * @copyright (c) 2017, Techffodils Technologies
 * @access public
 */
require_once 'admin/Base_Controller.php';

class Auto_register extends Base_Controller {

    /**
     * For auto Register users to the system for (testing purpose)
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * @param type $sponsor_name
     * @param type $count
     * @param type $leg_type
     */
    public function register($sponsor_name = 'admin', $count = 1, $leg_type = 'L') {
        $sponsor_id = $this->helper_model->userNameToID($sponsor_name);
        $mlm_plan = $this->dbvars->MLM_PLAN;
        if (!$sponsor_id) {
            echo "Invalid Sponsor";
            die;
        }
        if ($count <= 0) {
            echo "Invalid Count";
            die;
        }
        if ($leg_type == '') {
            $leg = '';
        } elseif ($leg_type == "L") {
            $leg = 'L';
        } else {
            $leg = 'R';
        }

        $this->load->model('register_model');
        $user_details = $this->helper_model->autoRegisterArray();

        $user_details['sponser_name'] = $sponsor_name;
        $user_details['register_leg'] = $leg;
        $user_details['register_type'] = $user_details['payment_method'] = 'auto_register';

        for ($i = 0; $i < $count; $i++) {
            $user_details['date_of_joining'] = date('Y-m-d H:i:s');
            $user_details['username'] = $this->register_model->generateRandomUsername(4);

            $j = 1;
            while ($j) {
                $next_name = 'user' . $j;
                if (!$this->helper_model->userNameToID($next_name)) {
                    $j = 0;
                    $username = $next_name;
                } else {
                    $j++;
                }
            }
            $user_details['username'] = $user_details['username'] = $username;
            $user_details['email'] = $user_details['username'] . '@lead.mlm';

            $res = $this->register_model->addUser('auto_register', $user_details, $mlm_plan, $this->helper_model->getARegPro());
            echo '<p>' . $user_details['username'];
            if ($res) {
                echo ': Success';
            } else {
                echo ': Failed';
            }
        }
    }

    /**
     * For changing plan. (Delete this code after LIVE)
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * @param string $plan
     * @param int $flag
     */
    function change_plan($plan = '', $flag = 0, $preset_demo = 0) {
        $this->dbvars->PRESET_DEMO_STATUS = 0;
        if(!$preset_demo) {
            $this->dbvars->BASIC_FLAG = 0;
        }
        if ($preset_demo) {
            $this->dbvars->PRESET_DEMO_STATUS = 1;
            $this->load->model('message_model');
        }

        if ($plan) {
            $this->dbvars->SYSTEM_PLAN = $plan;
            $admin_name = $this->helper_model->getAdminUsername();
            $user_name = 'leaduser';
            $this->dbvars->MONOLINE_STATUS = 0;
            switch ($plan) {
                case 'BINARY';
                    $mlm_plan = 'BINARY';
                    break;
                case 'MATRIX';
                    $mlm_plan = 'MATRIX';
                    break;
                case 'UNILEVEL';
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'MONOLINE';
                    $this->dbvars->MONOLINE_STATUS = 1;
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'DONATION';
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'STAIRSTEP';
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'PARTY';
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'INVESTMENT';
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'GENERATION';
                    $mlm_plan = 'UNILEVEL';
                    break;
                case 'GIFT';
                    $mlm_plan = 'UNILEVEL';
                    break;
                default:
                    echo 'Select a Plan (<b> BINARY , DONATION , GENERATION , GIFT , INVESTMENT , MATRIX , MONOLINE , PARTY , STAIRSTEP , UNILEVEL </b>)...';
                    die;
            }

            if ($plan == 'BINARY') {
                $this->db->set('status', '1')
                        ->where('id', 191)
                        ->update('menus');
            } else {
                $this->db->set('status', '1')
                        ->where('id', 191)
                        ->update('menus');
            }

            $admin_id = $this->helper_model->getAdminId();
            $this->dbvars->MLM_PLAN = $mlm_plan;
            $this->dbvars->EMAIL_VERIFICATION_STATUS = 0;

            if (!$flag && !$preset_demo) {
                $this->auto_register_model->updatePlanBonuses($plan);
            }

            $this->load->model('reset_model');
            $this->reset_model->wipeOutAllData();

            $this->load->model('member_model');
            $this->member_model->updateUserName($admin_id, $admin_name);
            $this->member_model->updatePassword($admin_id, '010101');
            //$this->auto_register_model->updateUserProfilePic($admin_id, 1, 'admin-logo.jpg', 'admin-cover.jpg');

            $this->load->model('wallet_model');
            $wallet_res = $this->wallet_model->addFundTransfer(0, $admin_id, 100, 'credited_by_admin');
            if ($wallet_res) {
                $this->helper_model->insertWalletDetails($admin_id, 'credit', 100, 'credited_by_admin');
            }

            $sys_mail['subject'] = 'Welcome Message';
            $sys_mail['images'] = '';
            $sys_mail['read_status'] = 'unread';
            $sys_mail['content'] = 'Welcome To Lead MLM Software';
            $this->load->model('mail_model');

            $reg_array = $this->helper_model->autoRegisterArray();
            $this->load->model('register_model');
            $pro_id = $this->helper_model->getARegPro();
            $sponsor_id = $admin_id;
            $user_details = array();
            $user_details = $reg_array;
            $user_details['sponser_name'] = $admin_name;
            $user_details['register_leg'] = 'L';
            $user_details['register_type'] = $user_details['payment_method'] = 'demo_register';
            $user_details['username'] = $user_name;
            $user_details['email'] = $user_details['username'] . '@lead.mlm';
            $user_details['order_amount'] += $this->auto_register_model->getARegProAmount($pro_id);

            $res = $this->register_model->addUser('auto_register', $user_details, $mlm_plan, $pro_id);
            echo '<p>' . $user_details['username'];
            $first_user_id = 0;
            if ($res) {
                $first_user_id = $res['new_user'];
                $wallet_res = $this->wallet_model->addFundTransfer(0, $res['new_user'], 25, 'credited_by_admin');
                if ($this->dbvars->PRESET_DEMO_STATUS > 0) {
                    $post_arr['title'] = 'Sample Testinomial';
                    $post_arr['content'] = 'It is a sample Testinomial';
                    $this->load->model('testimonial_model');
                    $this->testimonial_model->insertTestinomials($post_arr, $res['new_user']);
                }
                if ($wallet_res) {
                    $this->helper_model->insertWalletDetails($res['new_user'], 'credit', 25, 'credited_by_admin');
                }
                $this->auto_register_model->updateUserProfilePic($res['new_user'], 1);
                if ($this->dbvars->PRESET_DEMO_STATUS > 0)
                    $this->message_model->add_message('Welcome to Leadmlm software', $admin_id, $res['new_user']);

                $sys_mail['date'] = date("Y-m-d H:i:s");
                $sys_mail['from_id'] = $admin_id;
                $sys_mail['user_id'] = $res['new_user'];
                $sys_mail['catagories'] = 'inbox';
                $this->mail_model->insertMailData($sys_mail);
                $sys_mail['from_id'] = $res['new_user'];
                $sys_mail['user_id'] = $admin_id;
                $sys_mail['catagories'] = 'sent';
                $this->mail_model->insertMailData($sys_mail);

                echo ': Success';
            } else {
                echo ': Failed';
            }
            $j = 1;
            if ($flag) {
                for ($k = 1; $k < 13; $k++) {
                    if (date('m') > $k) {
                        $user_count = rand(1, 7);
                    } else {
                        $user_count = 0;
                    }
                    while ($user_count) {
                        $pro_id = $this->helper_model->getARegPro();
                        $user_count--;
                        $user_details = array();
                        $user_details = $reg_array;
                        $user_details['sponser_name'] = $this->helper_model->getRandomUsername($admin_name);
                        $user_details['register_leg'] = 'R';
                        if ($k % 2 == 1) {
                            $user_details['register_leg'] = 'L';
                        }
                        $user_details['register_type'] = $user_details['payment_method'] = 'demo_register';
                        $date = date('Y-m', strtotime(date('Y') . '-' . $k)) . '-12 15:43:26';
                        $user_details['date_of_joining'] = $date;
                        $user_details['username'] = 'user' . $j;
                        $user_details['email'] = $user_details['username'] . '@lead.mlm';
                        $user_details['first_name'] = ucfirst(strtolower(random_string('alpha', 5)));
                        $user_details['last_name'] = ucfirst(strtolower(random_string('alpha', 5)));
                        $j++;
                        $user_details['order_amount'] += $this->auto_register_model->getARegProAmount($pro_id);
                        $this->base_model->transactionStart();
                        $res = $this->register_model->addUser('auto_register', $user_details, $mlm_plan, $pro_id);
                        echo '<p>' . $user_details['username'];
                        if ($res) {
                            $wallet_res = $this->wallet_model->addFundTransfer(0, $res['new_user'], 25, 'credited_by_admin');
                            if ($wallet_res) {
                                $this->helper_model->insertWalletDetails($res['new_user'], 'credit', 25, 'credited_by_admin');
                            }
                            $this->auto_register_model->updateUserProfilePic($res['new_user']);

                            if ($this->dbvars->PRESET_DEMO_STATUS > 0)
                                $this->message_model->add_message('Welcome to Leadmlm software', $admin_id, $res['new_user']);

                            $sys_mail['date'] = date("Y-m-d H:i:s");
                            $sys_mail['from_id'] = $admin_id;
                            $sys_mail['user_id'] = $res['new_user'];
                            $sys_mail['catagories'] = 'inbox';
                            $this->mail_model->insertMailData($sys_mail);
                            $sys_mail['from_id'] = $res['new_user'];
                            $sys_mail['user_id'] = $admin_id;
                            $sys_mail['catagories'] = 'sent';
                            $this->mail_model->insertMailData($sys_mail);

                            echo ': Success';
                        } else {
                            echo ': Failed';
                        }
                    }
                }

                for ($k = 0; $k < 31; $k++) {
                    $user_count = rand(0, 3);
                    while ($user_count) {
                        $pro_id = $this->helper_model->getARegPro();
                        $user_count--;
                        $user_details = array();
                        $user_details = $reg_array;
                        $user_details['sponser_name'] = $this->helper_model->getRandomUsername($admin_name);
                        $user_details['register_leg'] = 'R';
                        if ($k % 2 == 1) {
                            $user_details['register_leg'] = 'L';
                        }
                        $user_details['register_type'] = $user_details['payment_method'] = 'demo_register';
                        $days = 30 - $k;
                        $date = date('Y-m-d H:i:s', strtotime("today - $days days"));
                        $user_details['date_of_joining'] = $date;
                        $user_details['username'] = 'user' . $j;
                        $user_details['email'] = $user_details['username'] . '@lead.mlm';
                        $user_details['first_name'] = ucfirst(strtolower(random_string('alpha', 5)));
                        $user_details['last_name'] = ucfirst(strtolower(random_string('alpha', 5)));
                        $j++;
                        $user_details['order_amount'] += $this->auto_register_model->getARegProAmount($pro_id);
                        $this->base_model->transactionStart();
                        $res = $this->register_model->addUser('auto_register', $user_details, $mlm_plan, $pro_id);
                        echo '<p>' . $user_details['username'];
                        if ($res) {
                            $wallet_res = $this->wallet_model->addFundTransfer(0, $res['new_user'], 25, 'credited_by_admin');
                            if ($wallet_res) {
                                $this->helper_model->insertWalletDetails($res['new_user'], 'credit', 25, 'credited_by_admin');
                            }
                            $this->auto_register_model->updateUserProfilePic($res['new_user']);
                            if ($this->dbvars->PRESET_DEMO_STATUS > 0)
                                $this->message_model->add_message('Welcome to Leadmlm software', $admin_id, $res['new_user']);
                            $sys_mail['date'] = date("Y-m-d H:i:s");
                            $sys_mail['from_id'] = $admin_id;
                            $sys_mail['user_id'] = $res['new_user'];
                            $sys_mail['catagories'] = 'inbox';
                            $this->mail_model->insertMailData($sys_mail);
                            $sys_mail['from_id'] = $res['new_user'];
                            $sys_mail['user_id'] = $admin_id;
                            $sys_mail['catagories'] = 'sent';
                            $this->mail_model->insertMailData($sys_mail);

                            echo ': Success';
                        } else {
                            echo ': Failed';
                        }
                    }
                }
            }

            $this->load->model('news_model');
            $data['news_title'] = 'Multi-level marketing';
            $data['news_content'] = 'Multi-level marketing is a strategy that some direct sales companies use to encourage their existing distributors to recruit new distributors by paying the existing distributors a percentage of their recruits sales; the recruits are known as a distributor`s "downline."';
            $data['news_img'] = '';
            $this->news_model->addNews($admin_id, $data, 1);

            $data['news_title'] = 'Lead MLM Software - Multi level Network Marketing Software Company India';
            $data['news_content'] = 'A MLM software is a must for a MLM company to manage its revenues and down-line in an organized way. Lead MLM Software, the most promising software, plays a vital role which will contribute to your MLM business success. The MLM software provided by Lead MLM Software are not only versatile but can also be customized as per the requirement of the plan. Lead MLM Software comes with a live MLM Software demo that can help you to understand the features without any sort of external assistance. With our continuous research on ever changing market requirements, we made it possible – The Ultimate MLM software, which provides you the flexibility to launch the MLM scripts integrated with different E-commerce platforms, Payment gateways including different Crypto-currencies etc.';
            $this->news_model->addNews($admin_id, $data, 1);

            $data['news_title'] = 'MLM Business Solution for Cryptocurrency';
            $data['news_content'] = 'Cryptocurrency is considered as the best asset that is introduced in the MLM world and it is considered as an opportunity for various scenario like, Payment option, Investment scenario, Trading sector, Transaction system etc. We, at Lead MLM, are offering an opportunity to perform all the transactions in Onecoin, Bitcoin, Gemcoin or any other cryptocurrency coins as per client’s requirement. Each member’s choices vary just like their nationality or their presentation talents. Some may have got Bitcoin with them, other with Ethereum or Litecoin etc. So their mode of payment might be in that form and that’s why it’s best to integrate most of the digital coins within the MLM Software package. Using our Bitcoin wallet in the MLM software, one can Purchase products and packages, Upgrade his account, Transfer coins to his down-line members,  Receive commissions etc. ';
            $this->news_model->addNews($admin_id, $data, 1);


            $this->load->model('document_model');
            $this->document_model->addDocument($admin_id, 'Sample Image1', 'img.jpg', 'jpg', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Video1', 'vdo.mp4', 'mp4', 500, array(), 'vdo');
            $this->document_model->addDocument($admin_id, 'Sample Image2', 'img2.png', 'png', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Document1', 'doc.pdf', 'pdf', 500, array(), 'docs');
            $this->document_model->addDocument($admin_id, 'Sample Image3', 'img3.jpg', 'jpg', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Audio1', 'aud.mp3', 'mp3', 500, array(), 'aud');
            $this->document_model->addDocument($admin_id, 'Sample Image4', 'image02.jpg', 'png', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Video2', 'vdo.mp4', 'mp4', 500, array(), 'vdo');
            $this->document_model->addDocument($admin_id, 'Sample Image5', 'image03.jpg', 'png', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Document2', 'doc.pdf', 'pdf', 500, array(), 'docs');
            $this->document_model->addDocument($admin_id, 'Sample Image6', 'image06.jpg', 'png', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Audio2', 'aud.mp3', 'mp3', 500, array(), 'aud');
            $this->document_model->addDocument($admin_id, 'Sample Image8', 'image08.jpg', 'png', 500, array(), 'img');
            $this->document_model->addDocument($admin_id, 'Sample Image9', 'image12.jpg', 'png', 500, array(), 'img');


            if ($this->dbvars->PRESET_DEMO_STATUS > 0) {
                $this->load->model('client_model');
                $data = array('affiliate_name' => 'affiliate1', 'sponser_name' => 'admin', 'email' => 'affiliate1@lead.mlm', 'mobile_no' => 555555, 'first_name' => 'aaaaaa', 'last_name' => 'bbbb', 'password' => '010101', 'country' => '101', 'state' => '1643');
                $this->client_model->enrollAffiliate($data);
                $data = array('affiliate_name' => 'affiliate2', 'sponser_name' => 'admin', 'email' => 'affiliate2@lead.mlm', 'mobile_no' => 555555, 'first_name' => 'ccccc', 'last_name' => 'ddddd', 'password' => '010101', 'country' => '101', 'state' => '1643');
                $this->client_model->enrollAffiliate($data);
                $data = array('affiliate_name' => 'affiliate3', 'sponser_name' => 'admin', 'email' => 'affiliate3@lead.mlm', 'mobile_no' => 555555, 'first_name' => 'eeeee', 'last_name' => 'fffff', 'password' => '010101', 'country' => '101', 'state' => '1643');
                $this->client_model->enrollAffiliate($data);
                $this->load->model('client_model');
                $data = array('affiliate_name' => 'affiliate4', 'sponser_name' => 'leaduser', 'email' => 'affiliate4@lead.mlm', 'mobile_no' => 555555, 'first_name' => 'ggggg', 'last_name' => 'hhhhhh', 'password' => '010101', 'country' => '101', 'state' => '1643');
                $this->client_model->enrollAffiliate($data);
                $data = array('affiliate_name' => 'affiliate5', 'sponser_name' => 'leaduser', 'email' => 'affiliate5@lead.mlm', 'mobile_no' => 555555, 'first_name' => 'iiiiii', 'last_name' => 'jjjjj', 'password' => '010101', 'country' => '101', 'state' => '1643');
                $this->client_model->enrollAffiliate($data);
                $data = array('affiliate_name' => 'affiliate6', 'sponser_name' => 'leaduser', 'email' => 'affiliate6@lead.mlm', 'mobile_no' => 555555, 'first_name' => 'kkkkk', 'last_name' => 'lllll', 'password' => '010101', 'country' => '101', 'state' => '1643');
                $this->client_model->enrollAffiliate($data);


                $this->load->model('employee_model');
                $data = array('user_name' => 'employee1', 'password' => '010101', 'firstname' => 'aaaa', 'lastname' => 'bbbb', 'gender' => 'm', 'year' => '2000', 'month' => '10', 'day' => '5', 'email' => 'asd@qwe.jkl', 'phone' => 111111, 'address' => 'fffff', 'country' => '101', 'state' => '1643', 'photo' => 'no_user.jpg', 'city' => 'city', 'zipcode' => '1234', 'user_id' => $admin_id);
                $this->employee_model->enrollEmployee($data);
                $data = array('user_name' => 'employee2', 'password' => '010101', 'firstname' => 'ccccc', 'lastname' => 'ddddd', 'gender' => 'm', 'year' => '2000', 'month' => '10', 'day' => '5', 'email' => 'asd@qwe.jkl', 'phone' => 111111, 'address' => 'fffff', 'country' => '101', 'state' => '1643', 'photo' => 'no_user.jpg', 'city' => 'city', 'zipcode' => '1234', 'user_id' => $admin_id);
                $this->employee_model->enrollEmployee($data);
                $data = array('user_name' => 'employee3', 'password' => '010101', 'firstname' => 'eeeee', 'lastname' => 'fffff', 'gender' => 'm', 'year' => '2000', 'month' => '10', 'day' => '5', 'email' => 'asd@qwe.jkl', 'phone' => 111111, 'address' => 'fffff', 'country' => '101', 'state' => '1643', 'photo' => 'no_user.jpg', 'city' => 'city', 'zipcode' => '1234', 'user_id' => $admin_id);
                $this->employee_model->enrollEmployee($data);
                $data = array('user_name' => 'employee4', 'password' => '010101', 'firstname' => 'ggggg', 'lastname' => 'hhhhh', 'gender' => 'm', 'year' => '2000', 'month' => '10', 'day' => '5', 'email' => 'asd@qwe.jkl', 'phone' => 111111, 'address' => 'fffff', 'country' => '101', 'state' => '1643', 'photo' => 'no_user.jpg', 'city' => 'city', 'zipcode' => '1234', 'user_id' => $admin_id);
                $this->employee_model->enrollEmployee($data);
                $data = array('user_name' => 'employee5', 'password' => '010101', 'firstname' => 'iiiii', 'lastname' => 'jjjjj', 'gender' => 'm', 'year' => '2000', 'month' => '10', 'day' => '5', 'email' => 'asd@qwe.jkl', 'phone' => 111111, 'address' => 'fffff', 'country' => '101', 'state' => '1643', 'photo' => 'no_user.jpg', 'city' => 'city', 'zipcode' => '1234', 'user_id' => $admin_id);
                $this->employee_model->enrollEmployee($data);
            }
            $this->load->model('events_model');
            $data = array('event_type' => 'single_day', 'event_date' => date("m/d/Y"), 'event_time' => '10:30 AM', 'event_name' => 'Event 1', 'event_desc' => 'Samaple Event');
            $this->events_model->addEvent($data);
            $data = array('event_type' => 'single_day', 'event_date' => date('m/d/Y', strtotime(date("m/d/Y") . ' + 10 days')), 'event_time' => '10:30 AM', 'event_name' => 'Event 2', 'event_desc' => 'Samaple Event');
            $this->events_model->addEvent($data);
            $data = array('event_type' => 'multiple_day', 'event_intervell' => date("m/d/Y") . ' 08:45 PM-' . date('m/d/Y', strtotime(date("m/d/Y") . ' + 3 days')) . ' 08:45 PM', 'event_name' => 'Event 3', 'event_desc' => 'Samaple Event');
            $data = array('event_type' => 'single_day', 'event_date' => date('m/d/Y', strtotime(date("m/d/Y") . ' + 15 days')), 'event_time' => '10:30 AM', 'event_name' => 'Event 4', 'event_desc' => 'Samaple Event');
            $data = array('event_type' => 'single_day', 'event_date' => date('m/d/Y', strtotime(date("m/d/Y") . ' + 30 days')), 'event_time' => '10:30 AM', 'event_name' => 'Event 5', 'event_desc' => 'Samaple Event');
            $data = array('event_type' => 'single_day', 'event_date' => date('m/d/Y', strtotime(date("m/d/Y") . ' + 45 days')), 'event_time' => '10:30 AM', 'event_name' => 'Event 6', 'event_desc' => 'Samaple Event');
            $data = array('event_type' => 'single_day', 'event_date' => date('m/d/Y', strtotime(date("m/d/Y") . ' + 60 days')), 'event_time' => '10:30 AM', 'event_name' => 'Event 7', 'event_desc' => 'Samaple Event');
            $this->events_model->addEvent($data);

            if ($plan == 'DONATION') {
                $this->load->model('donation_model');
                $user_id = $this->helper_model->userNameToID($user_name);
                $wallet_res = $this->wallet_model->addFundTransfer(0, $user_id, 200, 'credited_by_admin');
                if ($wallet_res) {
                    $this->helper_model->insertWalletDetails($user_id, 'credit', 200, 'credited_by_admin');
                }
                $res = $this->donation_model->donateAmount($user_id, 50);
                if ($res) {
                    $this->helper_model->insertWalletDetails($user_id, 'debit', 50, 'donates', $res['user_id'], '', $res);
                }
                $res = $this->donation_model->donateAmount($admin_id, 50);
                if ($res) {
                    $this->helper_model->insertWalletDetails($admin_id, 'debit', 25, 'donates', $res['user_id'], '', $res);
                }
            } elseif ($plan == 'GIFT') {
                $this->load->model('gift_model');
                $user_id = $this->helper_model->userNameToID($user_name);
                $res = $this->gift_model->createGift($user_id, 25, 1);
                $res = $this->gift_model->createGift($user_id, 50, 0);
            }

            if ($this->dbvars->PRESET_DEMO_STATUS > 0) {
                $post_arr['ticket_id'] = 'qwerty';
                $post_arr['title'] = 'Sample Ticket';
                $post_arr['subject'] = 'Testing';
                $post_arr['email'] = 'user@leadmlm.in';
                $post_arr['message'] = 'This is a test Ticket';
                $post_arr['rating'] = 4;
                $post_arr['priority'] = 4;
                $post_arr['department'] = 3;
                $post_arr['user_id'] = $first_user_id;
                $this->load->model('ticket_system_model');
                $this->ticket_system_model->insertTicket($post_arr, array());
            }

            $this->auto_register_model->clearUserActivity();

            $this->load->model('cron_job_model');
            $this->cron_job_model->updateLocation();
        } else {
            echo 'Select a Plan (<b> BINARY , DONATION , GENERATION , GIFT , INVESTMENT , MATRIX , MONOLINE , PARTY , STAIRSTEP , UNILEVEL </b>)...';
            die;
        }
    }

    /**
     * For Change all file permission to 0644
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * 
     */
    function change_system_path($delete_status = 0) {
        $this->dbvars->SYSTEM_PATH = FCPATH;
        $this->db->set($this->dbvars->LOGIN_REFERANCE, 1)
                ->update('user');

        if ($_SERVER['HTTP_HOST'] != 'localhost') {
            if ($delete_status) {
                $this->db->where('status', 0)
                        ->delete('menus');
                $this->db->where('admin_permission', 0)
                        ->where('user_permission', 0)
                        ->delete('menus');
                $this->db->where('status', 0)
                        ->delete('languages');
                $this->db->where('status', 0)
                        ->delete('currencies');
                $this->db->where('status', 'inactive')
                        ->delete('payment_methods');
                $this->db->where('status', '0')
                        ->delete('bonuses');
                $this->db->where('status', '0')
                        ->delete('system_mails');
                $this->db->set('status', '0')
                        ->where('id', 92)
                        ->or_where('id', 9)
                        ->update('menus');
            }
        }
        $this->db->set('employee_permission', 0)
                ->update('menus');

        $this->db->set('employee_permission', 1)
                ->where('admin_permission', 1)
                ->update('menus');

        $this->db->truncate('login_attempts');
        echo FCPATH;
        die;
    }

    function set_basic_system($delete_status = 0) {
//        if ($delete_status && $_SERVER['HTTP_HOST'] == 'localhost') {
//            die('Not possible in local');
//        }
        $this->dbvars->SYSTEM_PATH = FCPATH;
        $this->db->set($this->dbvars->LOGIN_REFERANCE, 1)
                ->update('user');
        $this->dbvars->BASIC_FLAG = 1;
        $res = $this->auto_register_model->setSystemAsBasic($delete_status);
        if ($res) {
            echo 'Success';
            die;
        }
    }

    function change_captcha_key($demo = '') {
        if ($demo == 'LOCAL') {
            echo "LOCAL";
            $this->dbvars->GOOGLE_CAPTCHA_KEY = '6LdOgjUUAAAAAMBypkm_-E69Z7fehRqQ5dH4UWW_';
            $this->dbvars->GOOGLE_CAPTCHA_SECRET = '6LdOgjUUAAAAADeZaeCcIvEEULJ6qtG-UI6iMXWX';
        } elseif ($demo == 'DEMO') {
            echo "DEMO";
            $this->dbvars->GOOGLE_CAPTCHA_KEY = '6Lf9zXYUAAAAALZhV-g7fiWgn08nhk4GW6ipDF0l';
            $this->dbvars->GOOGLE_CAPTCHA_SECRET = '6Lf9zXYUAAAAAFrq5Q76YcbU9sIiJoKvo3KOy_UJ';
        } else {
            echo 'Select a Demo Type (<b> LOCAL , DEMO </b>)...';
        }
    }

    /**
     * For updating new type mail contents
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * 
     */
    function update_mail_content() {
        $this->load->model('site_management_model');
        $this->site_management_model->checkAllMailContents();
        echo 'Complete';
        die;
    }

    /**
     * For Reset a Ip Address from blacklist
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * 
     */
    function reset_blacklist_ip() {
        $res = $this->auto_register_model->removeUserIp($this->helper_model->getUserIP());
        if ($res) {
            $this->loadPage('', 'login-site');
        }
    }

    /**
     * For Change all file permission to 0644
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @access public
     * 
     */
    function change_permission() {
        $full_permission = array('1' => 'application/cache', '2' => 'application/backup', '3' => 'assets/images', '4' => 'application/language', '5' => 'assets/excel/migration', '6' => 'assets/cart/images/banners');
        $Path = FCPATH;
        $rootpath = $Path;
        $fileinfos = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootpath)
        );

        foreach ($fileinfos as $pathname => $fileinfo) {
            if ($fileinfo->isFile()) {
                echo PHP_EOL . $pathname;
                $flag = 1;
                foreach ($full_permission as $fp) {
                    if (strpos($pathname, $fp) !== false) {
                        $flag = 0;
                    }
                }
                if ($flag) {
                    exec("find $pathname -type f -exec chmod 0644 {} +");
                }
            }
        }
    }

    function change_ip_address() {
        $res = $this->auto_register_model->changeIpAddress();
        if ($res) {
            echo 'Success';
            die;
        }
    }

    function change_collation() {
        $res = $this->auto_register_model->changeCollation();
        if ($res) {
            echo 'Success';
            die;
        }
    }

    function login($admin_flag = 0) {
        $username = 'leaduser';
        $password = '010101';
        if ($admin_flag)
            $username = 'admin';
        if ($this->aauth->login($username, $password)) {
            $this->helper_model->insertActivity($this->helper_model->userNameToID($username), 'user_login');
            $this->loadPage('', 'dashboard');
        } else {
            $this->loadPage('Something Went Wrong', 'login-site', 'danger');
        }
    }

    function set_register_model($type = '') {
        if ($type == 3) {
            $this->dbvars->REGISTER_PACKAGE = 0;
            $this->dbvars->REG_MODE = 'enroll-advanced';
            $link = '../enroll-advanced';
            $path = 'register/advanced';
        } elseif ($type == 2) {
            $this->dbvars->REGISTER_PACKAGE = 0;
            $this->dbvars->REG_MODE = 'enroll-multi';
            $link = '../enroll-multi';
            $path = 'register/multiple_step';
        } elseif ($type == 1) {
            $this->dbvars->REGISTER_PACKAGE = 0;
            $this->dbvars->REG_MODE = 'enroll';
            $link = '../enroll';
            $path = 'register/single_step';
        } else {
            $this->dbvars->REGISTER_PACKAGE = 1;
            $this->dbvars->REG_MODE = 'packages';
            $link = '../packages';
            $path = 'register/packages';
        }
        $this->db->set('link', $link)
                ->set('original_link', $path)
                ->where('id', 3)
                ->update('menus');
        echo 'Complete';
    }

    function set_payout_method($type = '') {
        if ($type == 'paypal' || $type == 'bank' || $type == 'coinpayments') {
            $this->dbvars->PAYOUT_METHOD = $type;
            echo 'Payout Method Changed';
            die;
        } else {
            echo 'Select a valid method (<b> paypal , bank , coinpayments </b>)...';
        }
    }

}
