<?php

Class Misc
{
	/**
	 *
	 * @param void
	 *
	 */
	static private $my_hostname = false;

	public static function short_hostname($hostname=false)
	{
		if (!$hostname) $hostname = gethostname();
		if (strpos($hostname,'.')) $hostname = substr($hostname,0,strpos($hostname,'.'));
		return $hostname;
	}
	public static function gethost() {
		// This gets the host name and sets the loggedby parameters
		$host = self::short_hostname();
		define ( 'HOST', $host );
		$hostnumber = false;
		for($i = 0; $i < strlen ( $host ); $i ++) {
			if (is_numeric ( $host [$i] )) $hostnumber = $hostnumber . $host [$i];
		} // This parses the digits out
		if ($hostnumber) define ( 'LOGGEDBY', "TLineTRX" . str_pad ( $hostnumber, 2, "0", STR_PAD_LEFT ) );
		else define ( 'LOGGEDBY', "TLineTRX" . $host );
	}
	public static function get_uptime($pid_file)
	{
		$last_start = CLI::command("ls --full-time $pid_file","exec",false);
		if (!$last_start) return false;
		$last_start = explode(" ",$last_start);
		$date = $last_start[5];
		$time = $last_start[6];
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
		$timestamp = gmmktime($hour, $minute, $second, $month, $day, $year);
		return time() - $timestamp;
	}
	public static function RemoveNonAscii($string) {
		if (is_null($string)) return false;
	    return preg_replace('/[^\x20-\x7d]/', '', $string);
	}
	
	public static function NameTrim($name) {
		if(strtolower(substr($name,-4))==".php") $name=basename($name,".php");
		$name=trim($name);
		$name=basename($name,".php");
		$name=str_replace("_report_","",$name);
		$name=str_replace("_tma_","",$name);
		$name=str_replace("__"," ",$name);
		$name=str_replace("_"," ",$name);
		$name=strtolower($name);
		$name=ucwords($name);
		$name=trim($name);
		return $name;
	}	
	public static function cond_mkdir($pathname,$owner="asterisk",$group="asterisk") {
		if(!is_dir($pathname)) {
			mkdir($pathname);
			self::cond_chown($pathname,$owner,$group);
		}
	}
	public static function cond_chown($pathname,$owner="asterisk",$group="asterisk") {
		if (exec("whoami") == "root") exec("chown $owner:$group '$pathname'");
	}
	public static function write_binary_file($pathname,$filename,$bin,$owner="asterisk",$group="asterisk") {
		if(substr($pathname, -1)<>"/") $pathname.="/";
		self::cond_mkdir($pathname);
		$fp = fopen ( $pathname.$filename, 'wb' );
		fwrite ( $fp, $bin );
		fclose ( $fp );
		self::cond_chown($pathname.$filename,$owner,$group);
	}
	
}