<?php

Class SQL
{
	static private $link_handle=false;
	static private $active_db=false;
	static public  $active_db_host=false;
	static public  $active_msdb_host=false;

	static public function Query($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false,$host_restriction=false)
	{
		return self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals,$host_restriction);
	}
	static public function my_mysql_query($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false,$host_restriction=false)
		/**
		* USAGE: my_mysql_query( string $query [, array $values ][, string $dbname][, boolean $quotes ] )
		* $query - SQL query WITHOUT any user-entered parameters. Replace parameters with "?"
		*     e.g. $query = "SELECT date from history WHERE login = ?"
		* $values - array of parameters
		*
		* Example:
		*    my_mysql_query( "SELECT secret FROM db WHERE login = ?", array($login) );    # one parameter
		*    my_mysql_query( "SELECT secret FROM db WHERE login = ? AND password = ?", array($login, $password) );    # multiple parameters
		*
		* That will result in a safe query to MySQL with escaped $login and $password.
		**/
	{
/*
		if($dbname<>'telelog'){
			return true;
			// Enter here the stuff for other dbs
			if(defined('ACCOUNT')) $dbname = 'acc'.ACCOUNT; else $dbname = 'accdev';
		}
*/
		//$type=strtoupper(substr($query,0,strpos($query," "))); // This gets the query type, might be needed later
		self::my_mysql_connect($dbname,$fatal,$host_restriction);
		if($values) {
			foreach($values as &$v) { 
				if($v === null) $v = 'NULL';
				else if(is_bool($v)) $v = $v ? 1 : 0;
				else if(!is_numeric($v)  OR $quote_numerals){
					if(!is_numeric($v)) $v = mysql_real_escape_string($v);
					$v = "'$v'";
				}
			}
			# str_replace - replacing ? -> %s. %s is ugly in raw sql query
			# vsprintf - replacing all %s to values
			$sql_query = vsprintf( str_replace("?","%s",$sql_query), $values );
		}
		if($sql_query) {
			$db_result=mysql_query($sql_query,self::$link_handle);
			if(!$db_result) {
				self::my_sql_error(false,__LINE__,$sql_query,$fatal);
				return false;
			}
			return $db_result;
		}
		return false;
	}

	static private function my_mysql_connect($dbname,$fatal,$host_restriction=false)
	{
		//$host_restriction="oktick.com";
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		
		// Check if we already have a resource for the db we want
		if( !$host_restriction || $host_restriction == self::$active_db_host )	self::my_mysql_select($dbname);
				
		if ( !$host_restriction || $host_restriction == gethostname()){
			// Attempting to connect to localhost first
			  if (self::$link_handle = @mysql_connect("127.0.0.1:".GlobalVars::$dbport, GlobalVars::$dbuser, GlobalVars::$dbpass)){
				if(self::my_mysql_select($dbname)) {
					self::$active_db_host=gethostname();
					return self::$link_handle;
				}
			} else {
				Echo("Could not connect to 127.0.0.1".mysql_error());
			}
		}
		
		// The try the other hosts
		foreach (GlobalVars::$db_hosts as $db_host_name => $db_ip){
			// Making sure to skip localhost
			if ($db_host_name == gethostname()) continue;
			// Making sure we skip any hosts in case of restriction
			//if ($host_restriction && ($host_restriction <> $db_host_name OR $host_restriction <> $db_ip)) continue;
			if (self::$link_handle = @mysql_connect($db_ip.":".GlobalVars::$dbport, GlobalVars::$dbuser, GlobalVars::$dbpass)){
				if(self::my_mysql_select($dbname)) {
					self::$active_db_host=$db_host_name;
					return self::$link_handle;
				}
			} else {
				Echo("Could not connect to $db_host_name($db_ip). ".mysql_error());
			}
		}
		self::my_sql_error($message="Could not connect to any db, out of options!",__LINE__,false,$fatal);
	} 

	static private function my_mysql_select($dbname)
	{
		if(!is_resource(self::$link_handle) ) return false;
		if (self::$active_db == $dbname) return self::$link_handle;
		if (!@mysql_select_db($dbname, self::$link_handle)) {
			self::my_sql_error($message="Could not select '$dbname' from ".self::$active_db_host." ".mysql_error(),__LINE__);
			return false;
		}
		self::$active_db=$dbname;
		return self::$link_handle;
	} 

	static public function Esc($string,$dbname=false,$fatal=true,$host_restriction=false)
	{
		return self::escape($string,$dbname,$fatal,$host_restriction);
	}
	static public function escape($string,$dbname=false,$fatal=true,$host_restriction=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		self::my_mysql_connect($dbname,$fatal,$host_restriction);
    return mysql_real_escape_string($string);
	} 

	static private function my_sql_error($message=false, $line=false, $query=false, $fatal=false, $dbtype='MySQL')
	{
		$msg="";
		if ($message) $msg.=$message;
		elseif (strtolower($dbtype)=='mysql') $msg.=mysql_error();
		elseif (strtolower($dbtype)=='mssql') $msg.=mssql_get_last_message();
		if($query) $msg.=", query: $query";
		if($line) $msg.=" on line: $line";
		if($fatal) {
			Die("Fatal $dbtype Err: \n".$msg."\n"."QUERY=\n$query \n");
		}
		else {
			Echo("Recoverable $dbtype Err: ".$msg."\n");
		}
	}

	static public function one($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		return self::my_mysql_fetch_one($sql_query,$values,$line,$dbname,$fatal,$quote_numerals);
	}

	static public function my_mysql_fetch_one($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		//if (strpos(strtoupper($sql_query), "LIMIT")=== false ) $sql_query .= " LIMIT 1 ";
		$dbr=self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
    if (!is_resource($dbr)) return false;
		$result=mysql_fetch_row($dbr);
		if (!$result) return false;
		return $result[0];
	}

static public function fetch_set($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		$dbr=self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
    if (!$dbr) return false;
    $record=0;
		while ($result=mysql_fetch_assoc($dbr)){
			foreach($result as $key => $data){
				$ret_array[$record][$key]=$data;
			}
			$record++;
		}
		if (!$ret_array) return false;
		return $ret_array;
	}

	static public function assoc($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		return self::my_mysql_fetch_row($sql_query,$values,$line,$dbname,$fatal,$quote_numerals);
	}

	static public function my_mysql_fetch_row($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		$dbr=self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
		$result=mysql_fetch_assoc($dbr);
		if (!$result) return false;
		return $result;
	}

	static public function row($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		$dbr=self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
		$result=mysql_fetch_row($dbr);
		if (!$result) return false;
		return $result;
	}
	static public function num($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		return self::my_mysql_num_rows($sql_query,$values,$line,$dbname,$fatal,$quote_numerals);
	}
	static public function my_mysql_num_rows($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		$dbr=self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
		if ($dbr) return mysql_num_rows($dbr);
		return false;
	}
	static public function my_mysql_delete($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		return self::my_mysql_update($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false);
	}

	static public function my_mysql_update($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
		$dbr = mysql_affected_rows();
		if ( $dbr == -1) return false;
		return $dbr;
	}
	
	static public function my_mysql_query_all($sql_query,$values=false,$line=false,$dbname=false,$fatal=false,$quote_numerals=false) 
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		GlobalVars::local_db_ip();
		GlobalVars::$db_ip_addresses = array_reverse(GlobalVars::$db_ip_addresses, true);
		foreach (GlobalVars::$db_ip_addresses as $idx => $dbip){
			if (self::$link_handle = @mysql_connect($dbip.":".GlobalVars::$dbport, GlobalVars::$dbuser, GlobalVars::$dbpass)){
				self::$active_db_host = GlobalVars::$db_host_names[$idx];
				if(self::my_mysql_select($dbname)){
					self::my_mysql_query($sql_query,$values,$line,$dbname,false,$quote_numerals);
				}
			}
		}
		GlobalVars::$db_ip_addresses = array_reverse(GlobalVars::$db_ip_addresses, true);
	} 

	static public function fetch_array($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		$dbr=self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
		$result = array();
		while ($dbd = mysql_fetch_assoc($dbr)){
			$result[] = $dbd;
		}
		return $result;
	}

	static public function my_mysql_query_localhost($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		$dbr = self::my_mysql_query($sql_query,$values,$line,$dbname,$fatal,$quote_numerals,gethostname());
		if(!$dbr) return false;
		return $dbr;
	} 

	static public function my_mysql_fetch_row_localhost($sql_query,$values=false,$line=false,$dbname=false,$fatal=true,$quote_numerals=false)
	{
		if (empty($dbname)) $dbname = GlobalVars::$db_default_name;
		$dbr=self::my_mysql_query_localhost($sql_query,$values,$line,$dbname,$fatal,$quote_numerals); 
		$result=mysql_fetch_assoc($dbr);
		if (!$result) return false;
		return $result;
	}

	static public function WriteToASTconsole($data,$level=0,$line="",$Do_even_if_not_TEST=false)
	{
		//if(!TEST && !$Do_even_if_not_TEST) return;
		global $term_signal;
		if($term_signal) return;
		fputs(STDOUT, 'VERBOSE "'.self::RemoveNonAscii($GLOBALS['caller_id']).':'.self::RemoveNonAscii($data).'(line '.self::RemoveNonAscii($line).')" '.self::RemoveNonAscii($level)."\n" );
		fflush( STDOUT );
		$tmp=fgets( STDIN, 4096 );
		$tmp=$tmp;
		return ;
	}

	static public function RemoveNonAscii($string) 
	{
		return MISC::RemoveNonAscii($string);
	}

	static public function EscapeAllBadCharacters() 
	{
		// Do not use this function
		return;
		if(get_magic_quotes_gpc()) $value = stripslashes($value);
		$newValue = @mysql_real_escape_string($value);
		if(FALSE === $newValue) $newValue = @mysql_escape_string($value);
		return $newValue;
	}
	
	static public function mysql_to_unix_time($mysql_datetime="") {
		if(!strtotime($mysql_datetime)) return time();
		// UNIX_TIMESTAMP($mysql_datetime)
		list($date, $time) = explode(' ', $mysql_datetime);
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
		$timestamp = gmmktime($hour, $minute, $second, $month, $day, $year);
		return $timestamp;
	}

	static public function unix_to_mysql_time($unix_time=0) {
		$unix_time = (int) $unix_time;
		if($unix_time==0) $unix_time=time();
		// FROM_UNIXTIME($unix_time)
		return date( 'Y-m-d H:i:s', $unix_time );
	}
	
	static public function dt($unix_time=0) {
		return self::unix_to_mysql_time($unix_time);
	}
}

