<?php

Class GlobalVars
{
	static public $DigitsInAccountNo 	= 3;
	static public $dbuser			= "ipiresearch";
	static public $dbpass			= "2e76656dcba6562ffeb68d524de1053e90a229a0";
	static public $dbport			= "3306";
	static public $db_default_name		= "ipiresearch";
	static public $site_name		= "OKTICK";
	static public $db_host_names		= array( "oktick" ); // Make sure you use what Misc::short_hostname() would return
#	static public $db_ip_addresses		= array( "192.168.0.86"	,	"192.168.0.81" ); // Under every hostname write its IP address.
#	static public $db_hosts			= array("sip2.telelog.eu" => "192.168.0.81", 
#												  "web2.telelog.eu" => "192.168.0.86");// Make sure you use what gethostname() would return
	static public $db_ip_addresses		= array( "127.0.0.1" ); // Under every hostname write its IP address.
	static public $db_hosts			= array("oktick" => "ipiresearch.ct22kjfyky62.us-west-2.rds.amazonaws.com");
	static public $croncue_max_mins_behind	= 27;
	
	// On the following block add a number to the end corresponding to the server number 
	// so that every server has slightly different times handling duplicate reporting
	static public $db_max_secs_behind		= 600; // How many seconds the dbs are allowed to be out of sync before reporting it
	static public $tml_alert_minutes		= 12 ; // The max interval of sms's. There should only be one sms every # minutes if the data is in duplicate
	static public $tml_reset_minutes		= 22 ; // How long until a service is reset if it does not update its alive time
	static public $liloc_alert_lenghts	= 22 ; // The lenghts of the cue before an alert will be sent


	static public $alive_check				  = array('asterisk','mysqld','httpd','named');
	static public $alive_check_asterisk = false;
	static public $alive_check_mysqld		= false;
	static public $alive_check_httpd		= false;
	static public $alive_check_named		= false;
	static public $sys_alert_email			= array ("leancode@gmail.com");
// static public $sys_alert_recipients = array ("41792711210");
// static public $sys_alert_recipients = array ("41792711210", "447795227777");
// static public $sys_alert_recipients = array ("41767665929", "447795227777");
// static public $sys_alert_recipients = array ("41767665929");
// static public $sys_alert_recipients = array ("447795227777");
	static public $sys_alert_recipients = array ();
	static public $reports_folder = '/var/www/reports/';


	static public function local_db_ip()
	{
		$short_hostname=Misc::short_hostname();
		$tmp_name = self::$db_host_names[0];
		$tmp_addr = self::$db_ip_addresses[0];
		
		foreach (self::$db_host_names as $idx => $name) {
			if ($short_hostname == $name) {
				self::$db_host_names[0] = self::$db_host_names[$idx];
				self::$db_ip_addresses[0] = 'localhost';//self::$db_ip_addresses[$idx];
				self::$db_host_names[$idx] = $tmp_name;
				self::$db_ip_addresses[$idx] = $tmp_addr;
				return;
			}
		}
		die ("It should never get here.".__FILE__.__LINE__);
	}
}
