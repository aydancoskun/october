<?php
/**
* DateTime Class that holds telelog DateTime functions
*/
class Mydatetime
{
	const UMIN = 60;
	const UHOUR = 3600;		  // 60 * 60
	const UDAY = 86400;		  // 60 * 60 * 24
	const UWEEK = 604800;	  // 60 * 60 * 24 * 7
	const MIN_PER_DAY = 1440; // 60 * 24
	const EARLIEST_UNIX_DATE = -2147483648; // Unix_Date ( 39448 ) i.e. 1-1-2008
	const LATEST_UNIX_DATE = 2147483648; // 2038-01-19 03:14:07 UTC
	const UNIX_DELPHI_EPOCH_DIFF = 25569;

	static public function GetUnixTime($DelphiTime, $timezone="UTC") {
		// (39448-25569)*86400
		// Unix time passed 1,000,000,000 seconds in 2001-09-09  01:46:40 UTC
		// In Copenhagen, Denmark it was  03:46:40 local time
		if (! is_numeric ( $DelphiTime ) )
			trigger_error("DelphiTime $DelphiTime  not numeric");
		if ( $DelphiTime < self::UNIX_DELPHI_EPOCH_DIFF) 
			trigger_error("DelphiTime $DelphiTime  UNIX_DELPHI_EPOCH_DIFF 25569");
		$timezone_current = date_default_timezone_get();
		date_default_timezone_set($timezone);
		// unix time is defined as seconds since the unix epoch 1970_01_01		
		$UnixTime = round ( ( $DelphiTime - self::UNIX_DELPHI_EPOCH_DIFF) * self::UDAY);
		// But delphy time uses timezones ...
		$UnixTime = $UnixTime + date ( "Z", $UnixTime ); // use server timezone if none given so we end up with UTC even if server not on UTC
		date_default_timezone_set($timezone_current);
		return $UnixTime;
	}
	
	static public function GetDelphiTime($UnixTime,$timezone="UTC") {
		if (! is_numeric ( $UnixTime ) )
			trigger_error("UnixTime $UnixTime  not numeric");
		if ( $UnixTime < self::EARLIEST_UNIX_DATE )
			trigger_error("UnixTime $UnixTime < EARLIEST_UNIX_DATE ".self::EARLIEST_UNIX_DATE);
		if ( $UnixTime > self::LATEST_UNIX_DATE )
			trigger_error("UnixTime $UnixTime > LATEST_UNIX_DATE ".self::LATEST_UNIX_DATE);

		$timezone_current = date_default_timezone_get();
		date_default_timezone_set($timezone);
		// Delphi time is defined as days since 1900_01_01 in whole numbers and the decimal part being fractions of the day
		
		// But delphy time uses timezones ...
		$UnixTime = $UnixTime - date ( "Z", $UnixTime ); // use server timezone if none given so we end up with UTC even if server not on UTC
		$DelphiTime = ($UnixTime / self::UDAY) + self::UNIX_DELPHI_EPOCH_DIFF;
		date_default_timezone_set($timezone_current);
		return $DelphiTime;
	}

}

