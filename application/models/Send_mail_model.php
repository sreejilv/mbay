<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * For Mail sending
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
use PHPMailer\PHPMailer;

class Send_mail_model extends CI_Model {

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $to_user
     * @param type $email
     * @param type $mail_type
     * @param type $data
     * @return boolean
     */
    function send($to_user = 0, $email = '', $mail_type, $data = array()) {
        if (!$this->dbvars->MAIL_STATUS) {
            return FALSE;
        }
        if ($_SERVER['HTTP_HOST'] == 'localhost' || !$this->checkMailStatus($mail_type)) {
            return FALSE;
        }

        if ($email) {
            $to_mail = $email;
        } else {
            $user_type = '';
            if ($mail_type == 'employee_forgot_password') {
                $user_type = 'employee';
            } elseif ($mail_type == 'affiliate_forgot_password' || $mail_type == 'affiliate_mail') {
                $user_type = 'affiliate';
            }
            $to_mail = $this->helper_model->getUserEmailId($to_user, $user_type);
        }

        $link = $link_button = $button_message = $mail_info = '';
        $lang_id = $this->getUserLangId($to_user);
        $lang_name = $this->getLangName($lang_id, 'id');
        $current_lang_code = $this->main->get_usersession('mlm_data_language', 'lang_code');
        $this->load->helper('language');
        $this->lang->load('common', $lang_name);

        $details = $this->getMailContents($mail_type, $lang_id);
        $subject = $details['subject'];
        $content = $details['content'];

        $company_name = $this->main->get_usersession('mlm_site_info', 'company_name');
        $flag = 1;
        switch ($mail_type) {
            case 'register_mail';
                $username = $data['username'];
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{company_name}", $company_name, $content);

                $mail_info = $this->getUserInfo($data);
                $link = BASE_PATH;
                $link_button = lang('login_link');
                $button_message = lang('but_msg_reg_mail');
                break;
            case 'order_mail';
                $order_id = $data['order_id'];
                $username = $this->helper_model->IdToUserName($data['user_id']);
                $amount = $data['total_amount'];
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{amount}", $amount, $content);


                $mail_info = $this->getOrderInfo($order_id);
                break;
            case 'forgot_password';
                $username = $this->helper_model->IdToUserName($to_user);
                $content = str_replace("{username}", $username, $content);

                $insert_id = $this->inForgPassHistrory($to_user);
                $encode_id = $this->helper_model->encode($insert_id);
                $link = BASE_PATH . 'reset-password/' . $encode_id;
                $link_button = lang('reset_link');
                $button_message = lang('but_msg_for_pass_mail') . lang('button_expiry_msg');
                break;
            case 'send_verification_code';
                $username = $this->helper_model->IdToUserName($to_user);
                $verification_code = $data['ver_code'];
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{verification_code}", $verification_code, $content);
                break;
            case 'fund_debit';
                $username = $this->helper_model->IdToUserName($to_user);
                $amount = $data['amount'];
                $description = lang($data['amount_type']);
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{amount}", $amount, $content);
                $mail_info = $this->getDebitInfo($amount, $description);
                break;
            case 'fund_credit';
                $username = $this->helper_model->IdToUserName($to_user);
                $from_user = $this->helper_model->IdToUserName($data['from_user']);
                $amount = $data['amount'];
                $description = lang($data['amount_type']);
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{amount}", $amount, $content);
                $mail_info = $this->getCreditInfo($from_user, $amount, $description);

                break;
            case 'pending_order_mail';
                $username = $this->helper_model->IdToUserName($to_user);
                $content = str_replace("{username}", $username, $content);
                $button_message = lang('pending_order_notification');

                break;
            case 'pending_register_mail';
                $username = $data['username'];
                $to_mail = $data['email'];
                $content = str_replace("{username}", $username, $content);
                $button_message = lang('pending_registration_notification');
                break;
            case 'lcp';
                $fullname = $data['fullname'];
                $content = str_replace("{fullname}", $fullname, $content);
                break;
            case 'affiliate_mail';
                $username = $data['affiliate_name'];
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{company_name}", $company_name, $content);

                $mail_info = $this->getAffiliateInfo($data);
                $link = BASE_PATH . 'affiliate-login';
                $link_button = lang('login_link');
                $button_message = lang('but_msg_reg_mail');
                break;
            case 'maintanance_mail';
                $username = $this->helper_model->IdToUserName($to_user);
                $content = str_replace("{username}", $username, $content);

                $link = BASE_PATH . 'login-override';
                $link_button = lang('login_link');
                $button_message = lang('maintanance_login');
                break;
            case 'employee_forgot_password';
                $username = $this->helper_model->employeeIdToUsername($to_user);
                $content = str_replace("{username}", $username, $content);
                $encode_id = $this->helper_model->encode($to_user);
                $link = BASE_PATH . 'employee-reset-password/' . $encode_id;
                $link_button = lang('reset_link');
                $button_message = lang('but_msg_for_pass_mail');
                break;
            case 'affiliate_forgot_password';
                $username = $this->helper_model->affiliateToIDUserName($to_user);
                $content = str_replace("{username}", $username, $content);
                $encode_id = $this->helper_model->encode($to_user);
                $link = BASE_PATH . 'login/affiliate_reset_password/' . $encode_id;
                $link_button = lang('reset_link');
                $button_message = lang('but_msg_for_pass_mail');
                break;
            case 'new_register_mail';
                $username = $this->helper_model->getAdminUsername();
                $content = str_replace("{admin}", $username, $content);
                $mail_info = $this->getUserInfo($data);
                break;
            case 'new_order_mail';
                $username = $this->helper_model->getAdminUsername();
                $content = str_replace("{admin}", $username, $content);
                $order_id = $data['order_id'];
                $username = $this->helper_model->IdToUserName($data['user_id']);
                $amount = $data['total_amount'];
                $mail_info = $this->getNewOrderInfo($order_id, $username, $amount);
                break;
            case 'transaction_password';
                $username = $this->helper_model->IdToUserName($to_user);
                $tran_pass = $this->helper_model->getTransactionPassword($to_user);
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{transaction_password}", $tran_pass, $content);
                break;
            case 'otp';
                $username = $this->helper_model->IdToUserName($to_user);
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{operation}", $data['operation'], $content);
                $content = str_replace("{otp_code}", $data['otp_code'], $content);
                break;
            case 'ticket_mail';
                $username = $this->helper_model->IdToUserName($data['from_id']);
                $content = str_replace("{username}", $username, $content);
                $content = str_replace("{ticket_id}", $data['ticket_id'], $content);

                break;
            default:
                $flag = 0;
                break;
        }
        $res = FALSE;
        if ($to_mail && $flag && $subject && $content) {
            $mail_data = array();
            $mail_data['logo'] = $this->main->get_usersession('mlm_site_info', 'company_logo');
            $mail_data['company_name'] = $company_name;
            $mail_data['company_email'] = $this->main->get_usersession('mlm_site_info', 'company_email');
            $mail_data['company_phone'] = $this->main->get_usersession('mlm_site_info', 'company_phone');
            $mail_data['subject'] = $subject;
            $mail_data['content'] = $content;
            $mail_data['link'] = $link;
            $mail_data['button_name'] = $link_button;
            $mail_data['button_message'] = $button_message;
            $mail_data['mail_info'] = $mail_info;

            $mail_body = $this->generateMailBody($mail_data);

            $asy_flag = false;

            try {
                if ($asy_flag) {
                    $params_array['to_mail'] = $to_mail;
                    $params_array['subject'] = $subject;
                    $params_array['mail_body'] = $mail_body;

                    $this->load->library('asynclibrary');
                    $url = base_url() . 'login/parallel_mail';
                    $res = $this->asynclibrary->do_in_background($url, $params_array);
                } else {
                    $res = $this->mailSend($to_mail, $subject, $mail_body);
                }
            } catch (Exception $e) {
                $data['Message'] = $e->getMessage();
                $this->helper_model->insertFailedActivity(1, 'mail_error', $data);
            }
        }
        $lang_name = $this->getLangName($current_lang_code, 'lang_code');
        $this->lang->load('common', $lang_name);
        return $res;
    }

    /**
     * For mail sending
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $to_mail
     * @param type $subject
     * @param type $mail_body
     * @return boolean
     */
    function mailSend($to_mail, $subject, $mail_body) {
        list($userName, $mailDomain) = explode("@", $to_mail);
        if (!checkdnsrr($mailDomain, "MX"))
            return FALSE;
        $this->load->model('site_management_model');
        $mail_settings = $this->site_management_model->mailSettingsInformation();

        $mail = new PHPMailer\PHPMailer();
        $res = FALSE;
        try {
            //Server settings
            if ($mail_settings['mail_engine'] == 'smtp') {
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = $mail_settings['host_name'];  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $mail_settings['smtp_username'];                 // SMTP username
                $mail->Password = $mail_settings['smtp_password'];                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = $mail_settings['smtp_port'];                                    // TCP port to connect to
            } else {
                $res = $mail->isSendmail();
            }
            //Recipients
            $mail->setFrom($mail_settings['from_mail'], $this->main->get_usersession('mlm_site_info', 'company_name'));
            $name = $this->helper_model->userNameToID($to_mail);
            $mail->addAddress($to_mail, $name);     // Add a recipient
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $mail_body;

            $res = $mail->send();
        } catch (Exception $e) {
            $data['subject'] = $subject;
            $data['reason'] = $mail->ErrorInfo;

            $data = array('to_mail' => $to_mail, 'subject' => $subject, 'mail_body' => $mail_body);
            $this->helper_model->insertFailedActivity(1, $name, 'mail_failed', $data);
        }
        return $res;
    }

    /**
     * For checkMailStatus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $type
     * @return type
     */
    function checkMailStatus($type) {
        $status = FALSE;
        $query = $this->db->select('status')
                ->where("type", $type)
                ->limit(1)
                ->get("system_mails");
        if ($query->num_rows() > 0) {
            $status = $query->row()->status;
        }
        return $status;
    }

    /**
     * For getting new order details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $order_id
     * @param type $username
     * @param type $amount
     * @return string
     */
    function getNewOrderInfo($order_id, $username, $amount) {
        $order_products = $this->getOrderProducts($order_id);
        $order_amounts = $this->getOrderAmounts($order_id);
        $bill_info = '<table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
    <tbody>
        <tr>
            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px">
                    <strong>' . lang('order_details') . '</strong><br>';
        $bill_info .= lang('username') . ' : ' . $username . '<br>';
        $bill_info .= lang('amount') . ' : ' . $this->helper_model->currency_conversion($amount) . '<br>';

        $bill_info .= '</p>
            </td>
        </tr>
    </tbody>
</table>';
        return $bill_info;
    }

    /**
     * For getting user language ID
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $user_id
     * @return type]
     */
    public function getUserLangId($user_id) {
        $language = 1;
        $query = $this->db->select('language ')
                ->where('mlm_user_id', $user_id)
                ->limit(1)
                ->get('user');
        if ($query->num_rows() > 0) {
            $language = $query->row()->language;
        }
        return $language;
    }

    /**
     * For getting language name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $language_ref
     * @param type $lang_code
     * @return type
     */
    public function getLangName($language_ref, $lang_code = 'id') {
        $language = 'english';
        $query = $this->db->select('language_folder')
                ->where($lang_code, $language_ref)
                ->limit(1)
                ->get('languages');
        if ($query->num_rows() > 0) {
            $language = $query->row()->language_folder;
        }
        return $language;
    }

    /**
     * For getting the mail contents based on the language 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $mail_type
     * @param type $lang_id
     * @return type
     */
    public function getMailContents($mail_type, $lang_id) {
        $data = array();
        $query = $this->db->select('subject,content')
                ->where('lang_id', $lang_id)
                ->where('content_type', $mail_type)
                ->limit(1)
                ->get('mail_content');
        if ($query->num_rows() > 0) {
            $data['subject'] = $query->row()->subject;
            $data['content'] = $query->row()->content;
        }
        return $data;
    }

    /**
     * For getting the user type
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $user_id
     * @return type
     */
    public function getUserType($user_id) {
        $user_type = "";
        $query = $this->db->select('user_type')
                ->where("mlm_user_id", $user_id)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() > 0) {
            $user_type = $query->row()->user_type;
        }
        return $user_type;
    }

    /**
     * For getting order amounts
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $order_id
     * @return type
     */
    function getOrderAmounts($order_id) {
        $data = array();
        $query = $this->db->select('delivery_charge,shipping_charge,tax')
                ->where('id', $order_id)
                ->get('orders');
        foreach ($query->result() as $row) {
            $data['delivery_charge'] = $row->delivery_charge;
            $data['shipping_charge'] = $row->shipping_charge;
            $data['tax'] = $row->tax;
        }
        return $data;
    }

    /**
     * For getting the order products
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $order_id
     * @return type
     */
    function getOrderProducts($order_id) {
        $order = array();
        $query = $this->db->select('product_id,quantity,amount')
                ->where('order_id', $order_id)
                ->get('order_products');
        foreach ($query->result() as $row) {
            $data['product_id'] = $row->product_id;
            $data['product_name'] = $this->getProductName($row->product_id);
            $data['quantity'] = $row->quantity;
            $data['amount'] = $row->amount;
            $order[] = $data;
        }
        return $order;
    }

    /**
     * For getting the product name 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $id
     * @return type
     */
    public function getProductName($id) {
        $product_name = '';
        $query = $this->db->select('product_name')
                ->where('id', $id)
                ->limit(1)
                ->get('products');
        if ($query->num_rows() > 0) {
            $product_name = $query->row()->product_name;
        }
        return $product_name;
    }

    /**
     *
     * For getting the affiliates information 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $data
     * @return string
     */
    function getAffiliateInfo($data) {
        $info = '<table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
    <tbody>
        <tr>
            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px">
                    <strong>' . lang('user_details') . '</strong><br>
                    ' . lang('username') . ' : ' . $data['affiliate_name'] . '
                    <br>
                    ' . lang('email_address') . ' : ' . $data['email'] . '
                    <br>
                    ' . lang('full_name') . ' : ' . $data['first_name'] . $data['last_name'] . '
                    <br>
                </p>
            </td>
        </tr>
    </tbody>
</table>';

        return $info;
    }

    /**
     * For getting the DEBIT information details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $amount
     * @param type $description
     * @return string
     */
    function getDebitInfo($amount, $description) {
        $info = '<table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
    <tbody>
        <tr>
            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px">   
                <strong>' . lang('details') . '</strong><br>
                    ' . lang('debitt_amount') . ' : ' . $amount . '
                    <br>
                    ' . lang('description') . ' : ' . $description . '
                    <br>
                </p>
            </td>
        </tr>
    </tbody>
</table>';

        return $info;
    }

    /**
     * For getting the CREDIT information
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type 
     * @param type 
     * @return
     */
    function getCreditInfo($from_user, $amount, $description) {
        $info = '<table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
    <tbody>
        <tr>
            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px">
                    <strong>' . lang('details') . '</strong><br>
                    ' . lang('from_user') . ' : ' . $from_user . '
                    <br>
                    ' . lang('credit_amount') . ' : ' . $amount . '
                    <br>
                    ' . lang('description') . ' : ' . $description . '
                    <br>
                </p>
            </td>
        </tr>
    </tbody>
</table>';

        return $info;
    }

    /**
     * For getting the user information or details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return string
     */
    function getUserInfo($data) {
        $info = '<table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
    <tbody>
        <tr>
            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px">
                    <strong>' . lang('user_details') . '</strong><br>
                    ' . lang('username') . ' : ' . $data['username'] . '
                    <br>
                    ' . lang('email_address') . ' : ' . $data['email'] . '
                    <br>
                    ' . lang('transaction_password') . ' : ' . $this->helper_model->getTransactionPassword($data['new_user_id']) . '
                    <br>
                </p>
            </td>
        </tr>
    </tbody>
</table>';

        return $info;
    }

    /**
     * For getting the order information
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $order_id
     * @return string
     */
    function getOrderInfo($order_id) {
        $order_products = $this->getOrderProducts($order_id);
        $order_amounts = $this->getOrderAmounts($order_id);
        $bill_info = '<table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
    <tbody>
        <tr>
            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px">
                    <strong>' . lang('order_details') . '</strong><br>';
        $total_amount = 0;
        foreach ($order_products as $op) {
            $total_amount += $op['amount'] * $op['quantity'];
            $bill_info .= $op['product_name'] . '<b> x </b>' . $op['quantity'] . ' : ' . $op['amount'] * $op['quantity'] . '<br>';
        }

        foreach ($order_amounts as $key => $oa) {
            $total_amount += $oa;
            $bill_info .= lang($key) . ' : ' . $oa . '<br>';
        }
        $bill_info .= '</p>
            </td>
        </tr>
    </tbody>
</table>';
        return $bill_info;
    }

    /**
     * For generating the mail body
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $data
     * @return string
     */
    function generateMailBody($data) {
        $font = 'Helvetica Neue';

        $mail_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: ' . $font . ', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>' . $data['subject'] . '</title>
    </head>
    <body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: ' . $font . ',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
        <center style="width:100%;table-layout:fixed">    
            <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5">
                <tbody>
                    <tr>
                        <td>                     
                            <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td>    
                                            <div style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0px;padding-right:0px">
                                                <table align="center" style="border-spacing:0;font-family:sans-serif;color:#f5f5f5;Margin:0 auto;width:100%" bgcolor="#F5F5F5">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0" bgcolor="#F5F5F5">
                                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#f5f5f5" bgcolor="#f5f5f5">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="padding-bottom:0px;padding-top:0px;padding-left:0px;padding-right:0px;background-color:#f5f5f5;width:100%;font-size:4px;text-align:left;display:none!important">
                                                                                <p class="m_-1070903499635067169prehdr" style="text-align:left;line-height:6px;Margin-top:0px;Margin-bottom:0px">' . lang("remainder_do_not_reply_this_email") . '</p>
                                                                            </td>
                                                                        </tr>           
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td style="padding-bottom:20px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table align="center" style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px" bgcolor="#F5F5F5">
                                                    <tbody><tr>
                                                            <td bgcolor="#F5F5F5" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                                                                <table width="73%" style="border-spacing:0;font-family:sans-serif;color:#333333" bgcolor="#F5F5F5">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0px" align="left">
                                                                                <a href="' . BASE_PATH . '"><img src="' . BASE_PATH . '/assets/images/logos/' . $data['logo'] . '" width="120" height="45" border="0" alt="leadMLM" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px" class="CToWUd"></a>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            <td width="100%" bgcolor="#F5F5F5" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333" bgcolor="#F5F5F5">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="padding-top:10px;padding-bottom:0px;padding-left:10px;padding-right:0px;background-color:#f5f5f5;width:100%;text-align:right">
                                                                                <p class="m_-1070903499635067169customerinfo" style="Margin-top:0px;margin-bottom:0px"><strong><a href="' . BASE_PATH . '" style="text-decoration:none;color:#333333" target="_blank">' . $data['company_name'] . ': <u></u>' . $data['company_phone'] . '<u></u></a></strong></p>                  
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-top:0px;padding-bottom:0px;padding-left:10px;padding-right:0px;background-color:#f5f5f5;width:100%;text-align:right">
                                                                                <p class="m_-1070903499635067169customerinfo" style="Margin-top:5px;margin-bottom:0px"> ' . lang('email_address') . ': <u></u>' . $data['company_email'] . '<u></u></p>                 
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#ffffff">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-top:10px;padding-bottom:10px;padding-left:40px;padding-right:40px;background-color:#FF9F00;width:100%;text-align:center;font-size:16px;line-height:22px;font-weight:bold;font-family:Arial,sans-serif,' . "Arial Black" . ',' . "Boing-Bold" . '">
                                                                <a href="' . BASE_PATH . '" style="text-decoration:none;color:#ffffff" target="_blank">' . $data['subject'] . '</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;line-height:27px;font-family:Arial,sans-serif,' . "Arial Black" . ',' . "Boing-Bold" . '">

                                                                ' . $data['content'] . '
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> ';


        if ($data['mail_info']) {
            $mail_body .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                ' . $data['mail_info'] . '
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>';
        }



        if ($data['link']) {
            $mail_body .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table align="center" style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px">     
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center">
                                                                                <div align="center">
                                                                                    <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="center" style="font-size:18px;line-height:22px;font-weight:bold;font-family:Arial,sans-serif,' . "Arial Black" . ',' . "Boing-Bold" . '"><span><a href="' . $data['link'] . '" style="border-radius:3px;color:#00a63f;text-decoration:none;background-color:#00a63f;border-top:14px solid #00a63f;border-bottom:14px solid #00a63f;border-left:14px solid #00a63f;border-right:14px solid #00a63f;display:inline-block;border-radius:3px;color:#ffffff" target="_blank">' . $data['button_name'] . '</a></span></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table align="center" style="border-spacing:0;font-family:sans-serif;color:#999999;Margin:0 auto;width:100%;max-width:600px">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#999999">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="padding-top:0px;padding-bottom:10px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:center"> 
                                                                                <p class="m_-1070903499635067169bodycopy" style="Margin-top:10px;line-height:20px;Margin-bottom:0px">
                                                                                ' . $data['button_message'] . '
</p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>';
        }

        $mail_body .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table align="center" style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px">
                                                    <tbody><tr>
                                                            <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">
                                <tbody><tr><td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:40px">
                                            <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

                                                <table align="center" style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px">
                                                    <tbody><tr>
                                                            <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                                                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#333333">
                                                                    <tbody><tr>
                                                                            <td style="padding-top:0px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-color:#d0d0d0;width:100%;text-align:center"> 
                                                                                <p class="m_-1070903499635067169bodycopy" style="Margin-top:20px;line-height:20px;Margin-bottom:0px"><strong>' . lang('do_not_reply_this_email') . '</strong></p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </body>
</html>
';

        return $mail_body;
    }

    function insertForgPassHistrory($to_user, $random_code) {
        $this->db->set('user_id', $to_user)
                ->set('random_code', $random_code)
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('random_codes');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function inForgPassHistrory($to_user) {
        $this->db->set('user_id', $to_user)
                ->set('date', date('Y-m-d H:i:s'))
                ->insert('reset_password');

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

}
