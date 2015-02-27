<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
//	header('HTTP/1.0 403 Forbidden');
//	die('You are not allowed to access this file.');
}

date_default_timezone_set('UTC');
//register_shutdown_function ( "my_shutdown");
define ('LIB_DIR',realpath(dirname(__FILE__).'/../assets/libs').'/');
$f3 = require(LIB_DIR .'f3/lib/base.php');
if (strpos($f3->get('AGENT'),"Dom/Dev")!==false ) define('DEBUG',3);
else define('DEBUG',0);

if(!defined('DEBUG'))define('DEBUG',FALSE);
//ignore_user_abort ( false );
//set_time_limit(10);

//$f3->set('UNLOAD', "my_shutdown");
if(!DEBUG) $f3->set('CACHE', TRUE);
else  $f3->set('CACHE', FALSE);
$f3->set('DEBUG', DEBUG);
$f3->set('AUTOLOAD',LIB_DIR .'classes/');
$f3->set('UI',LIB_DIR .'views/');
$f3->set('ESCAPE',false);

//$f3->set('WHERE' , " WHERE industrial = 'Yes' AND suppliers > 0 AND ");
$f3->set('WHERE' , " WHERE suppliers > 0 AND ");
$f3->set('SQL_PRIME_LIMIT' , ''); // "LIMIT 7";
$f3->set('SQL_BP_LIMIT' ,	''); // "LIMIT 7";
$f3->set('ESIGN' ,	'+'); // EXPANSION SIGN

$f3->set('str_title', 											''); // 'Product Search (&alpha;)'
$f3->set('str_message', 										''); // Message displayed underneath title
$f3->set('str_instruction_in_field',				'');

$f3->set('str_DEBUG',												DEBUG);
$f3->set('str_page_type',										'search');
$f3->set('str_page_type_sup',								'supplier');
$f3->set('str_page_type_menu',							'menu');
$f3->set('str_page_type_search',						'search');
$f3->set('str_page_type_submit',						'submit');
$f3->set('str_page_type_suggest',						'suggest');

$f3->set('str_status_msg_default',					'Put in your Keyword (e.g. Pump or Valve)');
$f3->set('str_status_msg_expand',						'Press "Space" for more options');
$f3->set('str_status_msg_select_keyword',		'Select your Keyword');
$f3->set('str_status_msg_select_item',			'Select your search term');

$f3->set('str_status_msg_prime',						'What kind of %s? (? for list)');
$f3->set('str_status_msg_sup',						  'Found suppliers for ');

$f3->set('str_status_msg_no_bp',					  'No match found for ');
$f3->set('str_status_msg_no_prime',					'No match found for ');
$f3->set('str_status_msg_no_match',					'No match found for %s');
$f3->set('str_status_msg_no_sup',					  'No suppliers found for ');

$f3->set('str_status_msg_right',						'Click "Search" for suppliers &#8600;');

$f3->set('str_status_msg_onSearchStart',		'Searching...');
$f3->set('str_status_msg_onSearchComplete',	$f3->get('str_status_msg_default'));
$f3->set('str_status_msg_onSelect',					'Click "Search" for suppliers ');
$f3->set('str_status_msg_searchSubmit',			'Finding suppliers... ');

$f3->set('str_status_msg_onSearchStart_R',	'');
$f3->set('str_status_msg_onSearchComplete_R','');
$f3->set('str_status_msg_onSelect_R',				'');
$f3->set('str_status_msg_searchSubmit_R',		'');

if (version_compare(phpversion(), "5.3.0", ">=")  == 1){
  if(DEBUG) error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  else error_reporting(0);
} else {
	if(DEBUG) error_reporting(E_ALL & ~E_NOTICE);
  else error_reporting(0);
}

if(DEBUG) {
	$f3->set('FP', FirePHP::getInstance(true));
	$options = array('maxObjectDepth' => 5,
                 'maxArrayDepth' => 5,
                 'maxDepth' => 10,
                 'useNativeJsonEncode' => true,
                 'includeLineNumbers' => true);

	//$f3->get('FP')->getOptions();
	$f3->get('FP')->setOptions($options);
//	$f3->get('FP')->setObjectFilter('ClassName', array('MemberName'));


	$f3->get('FP')->registerErrorHandler($throwErrorExceptions=false); // Convert E_WARNING, E_NOTICE, E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE and E_RECOVERABLE_ERROR errors to ErrorExceptions and send all Exceptions to Firebug automatically if desired.
	$f3->get('FP')->registerExceptionHandler();
	$f3->get('FP')->registerAssertionHandler($convertAssertionErrorsToExceptions=false,$throwAssertionExceptions=false); // if assertions should be converted to errors

	//try { throw new Exception('Test Exception'); } catch(Exception $e) { $f3->get('FP')->error($e);	} // manualy create assertion
	$f3->get('FP')->log("FirePHP initialized ".basename(__FILE__));
}

$f3->route('GET /* [ajax]' , 'Suggest->ajax'); // working

$f3->run();

$f3->set('get_trailing_space', function ($url_query){
		if ( substr($url_query, -1) == " ") {
			return " ";
		} else {
			return "";
		}
	}
);
/*
function my_shutdown(){
	$conn = "conn". Database::kill();
	$conn();
	exit;
}
*/
