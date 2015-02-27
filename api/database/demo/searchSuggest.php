<?php
//define('DEBUG',TRUE);
if(!defined('DEBUG'))define('DEBUG',FALSE);
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE); 
    
if(!mysql_connect("127.0.0.1","web","2e76656dcba6562ffeb68d524de1053e90a229a0")) die("ERROR");
if(!mysql_select_db("data")) die("ERROR");
$sParam = $_GET['q'];
if (! $sParam) exit;

switch ($_GET['mode']) {
    case 'xml': // using XML file as source of data
        $aValues = $aIndexes = array();
        $sFileData = file_get_contents('data.xml'); // reading file content
        $oXmlParser = xml_parser_create('UTF-8');
        xml_parse_into_struct($oXmlParser, $sFileData, $aValues, $aIndexes);
        xml_parser_free( $oXmlParser );

        $aTagIndexes = $aIndexes['ITEM'];
        if (count($aTagIndexes) <= 0) exit;
        foreach($aTagIndexes as $iTagIndex) {
            $sValue = $aValues[$iTagIndex]['value'];
            if (strpos($sValue, $sParam) !== false) {
                echo $sValue . "\n";
            }
        }
        break;
    case 'sql': // using database as source of data
//        echo $sParam."\n";
//        echo "leading space\n";
        
//        if ($sParam[0]==" ") echo "leading space\n";
//				$sParam = str_replace(" ", "x", $sParam);
//        echo htmlentities ( $sParam , ENT_COMPAT , "UTF-8" , FALSE ) . "\n";
				$sParam = str_replace("%", "", $sParam);
				$sParam = str_replace("-", " ", $sParam);

//        if ($sParam[0]==" ") $sParam = substr($sParam,1);
//				syslog(1, "php:".__LINE__."'$sParam'");
				$sParam = ltrim($sParam);
				$sParam = mysql_real_escape_string($sParam); // escaping external data
				$no_letters = strlen($sParam);
				if($no_letters > 1 ){
					$sql = "SELECT display_form FROM p WHERE industrial = 'Yes' AND prime LIKE '$sParam%' ".
								 "UNION ".
								 "SELECT display_bp FROM b WHERE industrial_flag = 'Yes' AND bp LIKE '$sParam%' ".
								 "LIMIT 7";
					$dbr = mysql_query($sql);
/*
					$dbr = mysql_query(get_primes($sParam,$no_letters));
					if(mysql_num_rows($dbr) < 1){
						$dbr = mysql_query(get_bps($sParam));
					}
*/					if(DEBUG) echo mysql_num_rows($dbr).":";
					if(DEBUG) echo $sParam."\n";
					//				if(DEBUG) echo "sql:".$sql."\n";
					if(!$dbr) echo mysql_error();
					while ($data = mysql_fetch_row($dbr)) {
						//            echo htmlentities ( $data[0] , ENT_COMPAT , "UTF-8" , FALSE ) . "\n";
						//					$sParam = str_replace(" ", "x", $sParam);
						syslog(1, "php:".__LINE__."'$data[0]'");
						echo  $data[0]  . "\n";
					}
				}
				break;









				if (strpos($sParam, " ") == false){
					$sql = get_primes($sParam,$no_letters);
				} else {
					if(substr($sParam, -1)==" ") {
						if (strpos(trim($sParam), " ") == false) break;
					}
					$sql = get_bps($sParam);
				}
				$dbr = mysql_query($sql);
				if(DEBUG) echo mysql_num_rows($dbr).":";
				if(DEBUG) echo $sParam."\n";
//				if(DEBUG) echo "sql:".$sql."\n";
        if(!$dbr) echo mysql_error();
        while ($data = mysql_fetch_row($dbr)) {
//            echo htmlentities ( $data[0] , ENT_COMPAT , "UTF-8" , FALSE ) . "\n";
//					$sParam = str_replace(" ", "x", $sParam);
					syslog(1, "php:".__LINE__."'$data[0]'");
          echo  $data[0]  . "\n";
        }
        break;
}

function get_primes($sParam,$no_letters){
	if(DEBUG) echo "pr:";
	return "SELECT display_form FROM p WHERE industrial = 'Yes' AND prime LIKE '$sParam%' ORDER BY prime LIMIT 7";
//	return "SELECT display_form FROM p WHERE industrial = 'Yes' AND prime LIKE '$sParam%' and letters_reqd_to_display <= $no_letters ORDER BY prime LIMIT 7";
}
function get_bps($sParam){
	if(DEBUG) echo "bp:";
	return "SELECT display_bp FROM b WHERE industrial_flag = 'Yes' AND bp LIKE '$sParam%' ORDER BY bp LIMIT 7";
}
