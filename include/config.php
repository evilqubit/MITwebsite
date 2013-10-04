<?php 
error_reporting(E_ALL);
session_start(); 
// database setting
 $_SESSION['user_authorized'] = 1; // ja 2delete

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_DATEBASE", "competition");
define("DB_PASSWORD", "");


define("HASH_KEY", "=0111%3+!+!011s"); 
define('SALT1', '24859f@#$#@$');
define('SALT2', '^&@#_-=+Afda$#%');


// default system language
$lang = "en"; 
include_once "../include/$lang.inc";
// i guess this is some output buffering
$sOutput="";

// list of all used emails
define("DEFAULT_EMAIL", "info@mitarabcompetition.com"); 

// Project main setting
define("PROJECT_TITLE", "Competetion");
define("PROJECT_WEBSITE", "http://localhost/competition");
 

// facebook related - ya3ni iza ma khasak fihon ma te3mal fiha Rambo ok..  
 define("FB_APPID" ,"") ;
 define("FB_SECRET" ,"") ;
  
 // Custom messages defs
 define("ERROR" ,"1") ;
 define("INFO" ,"2") ;
 define("SUCCESS" ,"3");
 define("WARNING" ,"4");
  
$classArr = array(
	ERROR => "error-msg"
	,INFO => "info-msg"
	,WARNING => "warning-msg"
	,SUCCESS => "success-msg"
);
 
// other custome errors
 define("INVALIDHASH" ,"401") ;
 
 define("SUPRESSERROR" ,isset($supressErrors)?true:false) ;
 define("SupressFireBug" ,isset($supressFireBug)?true:false) ;
  
 /****
  * number of rows to show by default in a table
  */
 
 define("DisplayLength" ,"25") ;

  
/**
 * Do not change the settings below
 */ 
// the target of the administration panel
define("ADMIN_PANEL", "../admin/"); 
define("BACKUP_FOLDER", "../backup/"); 
 
  
// array of allowed file types to upload in case of uploading an image
$config_allowed_images = array("image/jpg", "image/jpeg","image/pjpeg", "image/png", "image/gif");


// override overloader

function my_autoloader($class) {
    include '../classes/' . $class . '.class.php';
} 
spl_autoload_register('my_autoloader');

/*
// instance of auth variable
$auth  = new Auth(); 
$user = $auth->loadUser();
 */

// Including supported files
if (isset($support["Editor"])) 
{
	include '../fckeditor/fckeditor.php';
	define("EDITOR_PATH", '../fckeditor/');

} 
?>

