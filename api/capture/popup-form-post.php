<?php
if( empty($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) <> 'xmlhttprequest'){
//	return404();
}
date_default_timezone_set('UTC');
//register_shutdown_function ( "my_shutdown");
define ('LIB_DIR',realpath(dirname(__FILE__).'/../assets/libs').'/');
$f3 = require(LIB_DIR .'f3/lib/base.php');
if (strpos($f3->get('AGENT'),"ipiresearch/Development")!==false ) define('DEBUG',3);
else define('DEBUG',0);

if(!defined('DEBUG'))define('DEBUG',FALSE);
//ignore_user_abort ( false );
//set_time_limit(10);

//$f3->set('UNLOAD', "my_shutdown");
if(!DEBUG) $f3->set('CACHE', FALSE);
else  $f3->set('CACHE', FALSE);
$f3->set('DEBUG', DEBUG);
$f3->set('AUTOLOAD',LIB_DIR .'classes/');
$f3->set('UI',LIB_DIR .'views/');
$f3->set('ESCAPE',false);

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

Misc::debug_function_start(__CLASS__,__FUNCTION__,"(This is called when something is entered in the search box and returns suggestions)");
if(!isset($_GET['c'])) return404();
if(!isset($_GET['EMAIL'])) return404();
$db = Database::connect();
$db->exec("INSERT INTO emails.emails SET email = ?",$f3->get('GET.EMAIL') );
header("Content-type: application/json"); //makes sure entities are not interpreted
echo $f3->get('GET.c').'({"result":"success","msg":"Thank you, we will keep you updated."})';
exit;
function return404(){
	header('HTTP/1.0 404 Forbidden');
	die('Page not found');
}
