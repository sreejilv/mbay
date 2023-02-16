<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Main Library
* Simplifies storing variables in database, for example configuration variables.
* 
* You must create table first.
**/
/*

CREATE TABLE IF NOT EXISTS `config` (
`key` varchar(255) NOT NULL,
`value` text NOT NULL,
PRIMARY KEY  (`key`)
)

*/
/**
* Use:
*     $this->load->database();
*     $this->load->library('dbvars');
*     
* To set value: $this->dbvars->key = 'value';
* To get value:    $this->dbvars->key
* To check if the variable isset: $this->dbvars->__isset($key);
* To unset variable use: $this->dbvars->__unset($key);
* As of PHP 5.1.0 You can use isset($this->dbvars->key), unset($this->dbvars->key);
*
* @version: 0.1 (c) _kp 01-07-2016
**/
class CI_Main {

	private $mlm_session;

	function __construct()
	{
		$this->ci =& get_instance();
		$this->load_model();

	}

	function get_controller(){
		return $this->ci->router->class;
	}

	function get_method(){
		return $this->ci->router->method;
	}

	function get_urlfull(){
		return $this->ci->router->class . "/" . $this->ci->router->method;
	}

	function get_redirecturl(){
		return $this->ci->router->class . "/" . $this->ci->router->method;
	}

	function get_currenturl(){
		return $this->ci->router->class . "/" . $this->ci->router->method;
	}

	function get_currentheadurl(){

		return str_replace('user/', '', str_replace('admin/', '', str_replace(base_url(), '', current_url())));
		
	}

	function csrf_value(){
		return $this->ci->security->get_csrf_hash();
	}

	function csrf_name(){
		return $this->ci->security->get_csrf_token_name();

	}

	function get_usersession($array_name, $key){
		$this->mlm_session =  $this->ci->session->userdata($array_name);
		return (isset($this->mlm_session[$key]) ? $this->mlm_session[$key] : null);
	}

	function is_session($session_name){
		return $this->ci->session->userdata($session_name) ? TRUE : FALSE;
	}

	function set_usersession($key, $value){
		$this->ci->session->set_userdata($key, $value);
	}
	// auto load methods -- DHC

	function load_model(){
		if (!in_array($this->ci->router->class , NO_MODEL_CLASS_PAGES)) {
			$load_model = $this->ci->router->class . "_model";
			$this->ci->load->model($load_model, '', TRUE);
		}
	}


	

}

?>
