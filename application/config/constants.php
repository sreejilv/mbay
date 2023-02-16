<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
  | Custom Public Variables */
defined('REMOTE_IP_ADDR') OR define('REMOTE_IP_ADDR', $_SERVER['REMOTE_ADDR']); //IP ADDRESS
defined('SERVER_TIME') OR define('SERVER_TIME', date('l jS \of F Y h:i:s A')); //SERVER TIME
defined('DB_PREFIX_SYSTEM') OR define('DB_PREFIX_SYSTEM', 'mlm_'); //TABLE PREFIX
//defined('BASE_PATH')        OR define('BASE_PATH','http://localhost/LeadMlm/'); //BASE URL

defined('BASE_PATH') OR define('BASE_PATH', ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://" . $_SERVER['SERVER_NAME'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME'])); //BASE URL

defined('NO_LOGIN_PAGES') OR define('NO_LOGIN_PAGES', array("login", "employee-login","affiliate-login", "register", "translator", "cart", "auto_register", "lcp", "replication", "verify","client","cron_job","lang-translator","shop","webpage_reload")); //PAGES THAT DOESN'T NEED LOGGED IN SESSION
defined('NO_MODEL_CLASS_PAGES') OR define('NO_MODEL_CLASS_PAGES', array("base_controller", "CIModelTester", "verify")); //PAGES THAT DOESN'T NEED MODEL CLASS
defined('DEFAULT_MODEL_CLASS_PAGES') OR define('DEFAULT_MODEL_CLASS_PAGES', array("helper_model")); //FOR LOADING DEFAULT MODELS
defined('PUBLIC_PATH') OR define('PUBLIC_PATH', BASE_PATH . 'view_loader'); //PUBLIC_PATH
defined('COMMON_PAGES') OR define('COMMON_PAGES', array("login", "register", "translator", "cart", "auto_register", "lcp", "webpage_reload", 'replication', "shopping-cart", "shopping-view", "shopping-checkout", "capture-page", "login-site", "login-forgot", "login-reset", "email-verify", "login-lock", "logout-site", "packages", "enroll-multi", "enroll", "enroll-advanced", "user-lead", "replicate-site", "verify","client","enroll-affiliates","shedule-time","paypal-register","paypal-checkout","blocktrail-register","blocktrail-checkout","register-preview","pending-preview","lang-translator","shop")); //PUBLIC_PATH
defined('NO_LANGUAGE_PAGES') OR define('NO_LANGUAGE_PAGES', array('cron_job', "base_controller", "auto_register", "verify","general","profiler","form_validation")); //PUBLIC_PATH
defined('DEFAULT_TIMEZONE') OR define('DEFAULT_TIMEZONE', date_default_timezone_set('Asia/calcutta')); //PUBLIC_PATH
/*
| Custom Public Variables
*/
