<?php
/**
* DateTime Class that holds telelog DateTime functions
*/
class MyDateTime
{
	const UMIN = 60;
	const UHOUR = 3600;		  // 60 * 60
	const UDAY = 86400;		  // 60 * 60 * 24
	const UWEEK = 604800;	  // 60 * 60 * 24 * 7
	const MIN_PER_DAY = 1440; // 60 * 24
	const EARLIEST_UNIX_DATE = 1199145600; // Unix_Date ( 39448 ) i.e. 1-1-2008
	const LATEST_UNIX_DATE = 2145916800; // Unix_Date ( 50406 ) ) i.e. 1-1-2038
	const UNIX_DELPHI_EPOCH_DIFF = 25569;
	
	public static $time_report_started_UTC = false;
	public static $time_report_started_Del = false;
	public static $date_report_started_Del = false;
	public static $startdate_Del = false;
	public static $startdate_Nix = false;
	public static $enddate_Del = false;
	public static $enddate_Nix = false;
	public static $RequestedStartdate = false;
	public static $RequestedEnddate = false;
	public static $startweekno = false;
	public static $Week = array();
	
	static public function init($accountsettings,$number_of_days)
	{
		// Initializing time paras & setting the timezone
		date_default_timezone_set($accountsettings['TZdefault']);
		self::$time_report_started_UTC=time(); // in UTC
		self::$time_report_started_Del=self::GetDelphiTime(self::$time_report_started_UTC);
		self::$date_report_started_Del=round(self::$time_report_started_Del);
		self::$date_report_started_Nix=self::GetUnixDate(self::$date_report_started_Del);
		
		$auto_startdate_Nix=(strtotime_adodb(gmdate("Y-M-d",self::$date_report_started_Nix))-self::UDAY*($number_of_days-7));
		$tmp_startdate_Nix=round(self::$startdate_Nix / self::UDAY)*self::UDAY;

		// Verify the start date
		if(!$tmp_startdate_Nix || 
			$tmp_startdate_Nix < self::EARLIEST_UNIX_DATE || 
			$tmp_startdate_Nix > self::LATEST_UNIX_DATE
			) {
			$tmp_startdate_Nix=$auto_startdate_Nix;
		}
		self::$RequestedStartdate=round(self::GetDelphiTime($tmp_startdate_Nix));
		self::$startdate_Nix=round(self::GetUnixDate(self::$RequestedStartdate)/self::UDAY)*self::UDAY;

		// Adjust the start date for the weekday of the report
		$startday=$accountsettings['WeekStartsOn']; //Monday=1/Sunday=7
		$adjuster=((7-$startday-gmdate("N",self::$startdate_Nix))-(2*(7-$startday)));
		while($adjuster<-6) $adjuster=$adjuster+7;
		if ($adjuster==-7) $adjuster=0;

		self::$startdate_Del=self::$RequestedStartdate+$adjuster;

		while (self::$startdate_Del > self::$date_report_started_Del) self::$startdate_Del=self::$startdate_Del-7;
		if (self::$startdate_Del > self::$RequestedStartdate) self::$RequestedStartdate = self::$startdate_Del;

		self::$startdate_Nix=round(self::GetUnixDate(self::$startdate_Del)/self::UDAY)*self::UDAY;

		self::$startweekno=gmdate("W",self::$startdate_Nix+(self::UDAY));// we have to add one day as telelog weeks starts on Monday and not Sunday (ISO 8601)
		self::$startweekno=self::$startweekno+$accountsettings['YearlyStartWeekOffset'];;
		if (self::$startweekno<1) self::$startweekno=self::$startweekno + 52;

		// fill a weeks array with the weeknumbers
		for($i=0;$i<$number_of_weeks;$i++){
			if (self::$startweekno+$i > 52) $Week[$i]=self::$startweekno+$i-52;
			else $Week[$i]=self::$startweekno+$i;
		}

		$tmp_enddate_Nix=round($enddate_Nix/self::UDAY)*self::UDAY;
		// Verify the end date
		if (!$tmp_enddate_Nix || 
			$tmp_enddate_Nix > self::$startdate_Nix+($number_of_days-1)*self::UDAY || 
			$tmp_enddate_Nix < self::$startdate_Nix || 
			$tmp_enddate_Nix > self::$date_report_started_Nix || 
			$tmp_enddate_Nix < self::EARLIEST_UNIX_DATE || 
			$tmp_enddate_Nix > self::LATEST_UNIX_DATE
			) {
			$tmp_enddate_Nix=self::$startdate_Nix+($number_of_days-1)*self::UDAY;
			if ($tmp_enddate_Nix > self::$date_report_started_Nix) $tmp_enddate_Nix=self::$date_report_started_Nix;
		}

		$RequestedEnddate=round(self::GetDelphiTime($tmp_enddate_Nix));
		$enddate_Del=round($RequestedEnddate);
		$enddate_Nix=self::GetUnixDate($enddate_Del);
		$enddate_Nix=round($enddate_Nix/self::UDAY)*self::UDAY;
		
	}

	static public function GetUnixTime($DelphiTime,$line=0)
	{
		if (! is_numeric ( $DelphiTime ) || $DelphiTime < 0) die("DelphiTime($DelphiTime) not numeric or <0 on line $line");
		// unix time is defined as seconds since the unix epoch 1970_01_01
		
		$DelphiTime = $DelphiTime - (date ( "Z" ) / self::UDAY); // Correct the timezone
		if ($DelphiTime < 1) return  $DelphiTime * self::UDAY; // If its only a fraction return the fraction and not the date
		elseif ($DelphiTime < self::UNIX_DELPHI_EPOCH_DIFF) die("DelphiTime $DelphiTime) < self::UNIX_DELPHI_EPOCH_DIFF");
		return round ( ( $DelphiTime - self::UNIX_DELPHI_EPOCH_DIFF) * self::UDAY);
	}

	static public function GetDelphiTime($UnixTime,$line=0)
	{
		if (! is_numeric ( $UnixTime ) || $UnixTime < 0) die("UnixTime($UnixTime) not numeric or <0 on line $line");
		// Delphi time is defined as days since 1900_01_01 in whole numbers and the decimal part being fractions of the day
		$UnixTime = $UnixTime + date ( "Z" ); // Correct the timezone
		if ($UnixTime < self::UDAY) return $UnixTime / self::UDAY;  // If its only a fraction return the fraction and not the date
		return ($UnixTime / self::UDAY) + self::UNIX_DELPHI_EPOCH_DIFF;
	}
	
	static public function GetUnixDate($DelphiDate)
	{
		if (! is_numeric ( $DelphiDate ) || $DelphiDate < self::UNIX_DELPHI_EPOCH_DIFF) die("DelphiDate $DelphiDate wrong");
		return round( ( round($DelphiDate) - self::UNIX_DELPHI_EPOCH_DIFF ) * self::UDAY );
	}
	
	static public function strtotime($timestr)
	{
		// This is for non-US 
		// This has eventually to be checked against account settings I guess, or maybe not
	    if(is_null($timestr) or ($timestr == "")) return False;
	    // break out components with '/', maximum of 3 elements
	    $components = explode("/", $timestr, 3);
	    $count = count($components);
	    if($count > 1) // There is a slash
	    {
	        $tmp = $components[0]; // Swap first and second components
	        $components[0] = $components[1];
	        $components[1] = $tmp;
	    }
	    return strtotime(implode("/",$components)); // Put back together
	}
	
	static public function tesco_week($wk,$offset=-8)
	{
		$wk=$wk + $offset;
		$z=date("W"); // Current Week
		$max_last_year_weekno = date("W",strtotime("- $z weeks")); 
		if($wk < 1) $wk = $wk + $max_last_year_weekno;
		return $wk;
	}

	static public function from_tesco_week($wk,$offset=8)
	{
		$wk=$wk + $offset;
		$z=date("W", strtotime("+ 1 Year"));
		$max_this_year_weekno = date("W",strtotime("+ 1 year - $z weeks")); // Highest week number in current year
		if ($wk > $max_this_year_weekno) $wk = $wk - $max_this_year_weekno;
		return $wk;
	}

	static public function last_year_weeks()
	{
		$z=date("z"); // Day of year
		$max_year_weeks = date("W",strtotime("- $z days"));
		return $max_year_weeks;
	}	
	static public function add_weeks($wk,$offset=0)
	{
				if($offset > 0) return self::from_tesco_week($wk,$offset);
		elseif($offset < 0) return self::tesco_week($wk,$offset);
		else return $wk;
	}
}
