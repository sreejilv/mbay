<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Dbvars Library
* Simplifies storing variables in database, for example configuration variables.
* 
* You must create table first.
**/
/*

CREATE TABLE IF NOT EXISTS `mlm_track` (
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
class CI_Track {
    const TABLE = 'track';
    //Table where variables will be stored.
    
    private $data;
    private $ci;
    
    function __construct()
    {
        $this->ci =& get_instance();
    
        $q = $this->ci->db->get(self::TABLE);
        foreach ($q->result() as $row)
           {
               $this->data[$row->key] = $row->value;
           }
           $q->free_result();

    }

    function __get($key){
        return $this->data[$key];
    }
    
    function __set($key, $value){
        if (isset($this->data[$key])){
            $this->ci->db->where('key', $key);
            $this->ci->db->update(self::TABLE, array('value' => $value));
        } else {
            $this->ci->db->insert(self::TABLE, array('key' => $key, 'value' => $value));
        }
        $this->data[$key] = $value;
    }
        
    /**  As of PHP 5.1.0  */
    function __isset($key) {
        return isset($this->data[$key]);
    }

    /**  As of PHP 5.1.0  */
    function __unset($key) {
        $this->ci->db->delete(self::TABLE, array('key' => $key));    
        unset($this->data[$key]);
    }    

}

?>