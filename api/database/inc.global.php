<?php

define ( 'FATAL', true );
define ( 'NONFATAL', false );

date_default_timezone_set('UTC');

/**
 *
 * @param string $className Class or Interface name automatically
 *              passed to this function by the PHP Interpreter
 */
function __autoload($className){

if (!defined('PHPEXCEL_ROOT')) define('PHPEXCEL_ROOT','/srv/www/oktick/html/ipiresearch/classes/');
if (strpos($className,"PHPExcel_")!==false){
	$path = PHPEXCEL_ROOT . str_ireplace('_', '/', $className).".php";
	require_once($path);
	return;
}	
    //Directories added here must be
	//relative to the script going to use this file.
	//New entries can be added to this list
	$directories = array(
						dirname(__FILE__).'/classes/',
						'',
						);

	//Add your file naming formats here
	$fileNameFormats = array(
		'class.%s.php',
		'%s.class.php',
		'%s.php',
		'%s.inc.php',
	);

	// this is to take care of the PEAR style of naming classes
	/*
	$path = str_ireplace('_', '/', $className);
//	echo $path;
//	if (preg_match('|^\w+$|', $class_name)) {
	    if(@include_once $path.'.php'){
	        return;
	    }
//	}
*/
   
    foreach($directories as $directory){
        foreach($fileNameFormats as $fileNameFormat){
            $path = $directory.sprintf($fileNameFormat, $className);
            if(file_exists($path)){
                include_once $path;
                return;
            }
        }
    }
}

