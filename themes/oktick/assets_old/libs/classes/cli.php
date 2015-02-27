<?php

require_once('cli.git/CommandLine.php');
class Cli extends CommandLine {

	private static $pid;

  public static function run_once_only() {
    $f3 = \Base::instance();
    $pid = self::lock();
    if( is_numeric($pid)) {
			My::function_debug(__CLASS__,__FUNCTION__, "OK!");
	    return;
    }
    $message="FAILURE - already running";
		My::function_debug(__CLASS__,__FUNCTION__, "$message.","warn");
    $to="leancode@gmail.com, hs@telelog.eu";
    $subject="FAILURE - already running " .$f3->get("FILE");
    $message="FAILURE - already running " .$f3->get("FILE");
    //mail($to,$subject,$message);
    exit;
	}

	public static function isrunning($pid,$log=TRUE) {
    if($log) My::function_debug(__CLASS__,__FUNCTION__);
    if (!$pid) return FALSE;
    $pids = explode(PHP_EOL, `ps -e | awk '{print $1}'`);
    if(in_array($pid, $pids)) return TRUE;
    return FALSE;
  }

	private static function get_lock_file() {
    $f3 = \Base::instance();
    $lock_file = realpath($f3->get('FILE')) . ".lock"; 
    if( ! file_exists($lock_file)) return FALSE;
    return file_get_contents($lock_file);
  }

  private static function lock() {
    $f3 = \Base::instance();
    $pid = self::get_lock_file();
		if ( self::isrunning($pid,FALSE) ) {
		    return false;
    }
		elseif ( $pid ) {
		    $f3->get('FP')->warn( "Previous dead lock file found (Previous job died abruptly).");
    }

    $lock_file = realpath($f3->get('FILE')) . ".lock"; 
    $pid = getmypid();
    if( file_put_contents($lock_file, $pid ) ){
    	return $pid;
  	}
    $f3->get('FP')->error( __CLASS__."->".__FUNCTION__."() Lock could NOT be acquired, check permissions etc. Coninuing nevertheless.");
    return $pid;
  }

  public static function release_lockfile() {
    $f3 = \Base::instance();
    $lock_file = realpath($f3->get('FILE')) . ".lock"; 

    $pid = self::get_lock_file();
    if ( $pid == getmypid() OR ! self::isrunning($pid,FALSE) ) {
 	  	if (is_file($lock_file) && unlink($lock_file) ){
		    My::function_debug(__CLASS__,__FUNCTION__,"OK!");
   			return TRUE;
 	  	} else {
		    My::function_debug(__CLASS__,__FUNCTION__,"$lock_file could NOT be released, check permissions etc....","error");
   			return FALSE;
 	  	}
    }
    if ($pid){
		    My::function_debug(__CLASS__,__FUNCTION__, "$lock_file not mine and still running. My pid=".getmypid().".","warn");
   			return TRUE;
    }
    My::function_debug(__CLASS__,__FUNCTION__,"$lock_file does not exist. Nothing to release...");
		return TRUE;    	
  }

}
