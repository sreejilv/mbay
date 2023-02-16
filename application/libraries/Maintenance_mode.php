<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/12/17
 * Time: 10:05 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Maintenance_mode
{
    
    public $ip_db;


    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('dbvars');
        $this->ci->load->library('main');
        $this->ci->load->library('aauth');
        
        $this->ip_db = $this->ci->load->database('default', TRUE);
    }

    function set()
    {
        $query = null;
        $query = $this->ip_db->get('ip_whitelist');
        $ip_address = $query->result_array();
        $ip_address = array_column($ip_address, 'whitelist_ip');

        //$ip_address = array();
        if(isset($this->ci->dbvars->MAINTANANCE_STATUS)):

            // let it the switch be readable by the check() function
            if ($this->ci->dbvars->MAINTANANCE_STATUS == 1):

                $this->ci->maintenance_mode->set = $this->ci->dbvars->MAINTANANCE_STATUS;

                // if ip is of the string type convert that beast to an array
                if (is_string($ip_address) && !empty($ip_address)):
                    $ip_address = array($ip_address);
                endif;

                // if it's an array and the array isn't empty
                if (is_array($ip_address) && count($ip_address) > 0):


                    if (isset($this->ci->maintenance_mode->ip_address) && is_array($this->ci->maintenance_mode->ip_address) && count($this->ci->maintenance_mode->ip_address) > 0):

                        // loop through array of ips
                        foreach ($ip_address as $ip) {
                            if(!in_array($ip, $this->ci->maintenance_mode->ip_address))
                                $this->ci->maintenance_mode->ip_address[] = $ip;
                        }

                    else:

                        $this->ci->maintenance_mode->ip_address = $ip_address;

                    endif;
                endif;

            // if $switch isn't TRUE, do nothing
            else:
                // nothing to do.... da di da di da
            endif;


        // $switch is either not been set or is not boolean
        else:
            show_error('You must set the first parameter of the Maintenance_mode::set() function. The value must also be boolean.');
        endif;
    }

    function check()
    {
        /**
         * --------------------------------
         * IF MAINTENANCE MODE HASN'T
         * BEEN TURNED ON, QUIETLY EXIT
         * --------------------------------
         */
        if (!isset($this->ci->maintenance_mode->set))
        {
            return;
        }


        /**
         * --------------------------------
         * SET VARS FOR EASIER READABILITY
         * --------------------------------
         */
        $set = $this->ci->maintenance_mode->set;
        $ip_address = isset($this->ci->maintenance_mode->ip_address) ? $this->ci->maintenance_mode->ip_address : array();



        /**
         * ----------------------------
         * IF MAINTENANCE MODE IS ON
         * ----------------------------
         */
        if ($set == TRUE)
        {
            // Administrators and people that have been granted access via a "maintenance ip" can be shown the page
            if (($this->ci->main->get_usersession('admin_override', 'is_administrator') && $this->ci->main->get_controller() == 'login') || $this->ci->aauth->getUserType() == 'admin' || in_array($this->ci->input->ip_address(), $ip_address))
//            if (in_array($this->ci->input->ip_address(), $ip_address))
            {
                return;
            }

            include(APPPATH . 'views/login/maintence.twig');
            die();

//            $message = "We're sorry for the inconvenience, this section of " . $this->ci->main->get_usersession('mlm_site_info','company_name') . " is undergoing necessary scheduled maintenance.";
//
//            show_error($message, 500, "Scheduled Maintenance");
        }
    }


}