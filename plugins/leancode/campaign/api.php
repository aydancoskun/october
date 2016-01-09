<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('UTC');
require('vendor/autoload.php');
//use Swift_Signers_DKIMSigner;

$err = false;
if( ! isset($_REQUEST['__PAYLOAD__']) ) sent404();
if( isset($_POST['__PAYLOAD__']) ) define('DEBUG',false);
else define('DEBUG',true);

define("ENCRYPTION_KEY", "kljahfjkdsahfjka43q5trgfdsfgzhgjfgnbvdsh!@#$%^&*");
$n = $_REQUEST['__PAYLOAD__'];
$n = decrypt($n,ENCRYPTION_KEY);
// -------- remove the utf-8 BOM ----
$n = str_replace("\xEF\xBB\xBF",'',$n);
$n = trim(utf8_encode($n));
$n = json_decode($n,true);
if(!$n) sent404();

$setTo = $n['setTo'];
$setReturnPath = $n['setReturnPath'];// "bounce@oktick-beta.com"
$setSubject = $n['setSubject'];
$setFrom = $n['setFrom'];// array('info@oktick-beta.com' => 'OKTicK Search Ltd')
foreach ( $setFrom as $fromAddress => $fromName);
$html = $n['setBody'];
$text = $n['addPart'];
$setReplyTo = $n['setReplyTo'];// array('info@oktick-beta.com' => 'OKTicK Search Ltd')
$setSender = $n['setSender'];// array('info@oktick-beta.com' => 'OKTicK Search Ltd')
$setPriority = $n['setPriority'];// 3 - normal
$setId = $n['setId'];// $subscriber->id . ".8938145113." . time() ."@aruba1.generated"
if(DEBUG){
	$setSubject = $setSubject."-".date("c");
	$setTo = "leancode+".time()."@gmail.com";
	echo $setSubject."<br>";
//	$setReturnPath = "bounce@oktick-beta.co.uk";
//	$setFrom = $setReplyTo = $setSender = array('info@oktick-beta.co.uk' => 'OKTicK Search Ltd');
//	foreach ( $setFrom as $fromAddress => $fromName);
}

// initialise the dkim
$privateKey = get_private_key(); // Generated one as the paired public key is set in DNS
$domainName = get_email_hostname($fromAddress);
$selector = 'default';
//$signer = Swift_Signers_DKIMSigner::newInstance($privateKey, $domain, $selector)
$signer = new Swift_Signers_DKIMSigner($privateKey, $domainName, $selector);
$signer		->setBodyCanon('relaxed')
		->ignoreHeader('Return-Path')
		->setHeaderCanon('relaxed')
		->setHashAlgorithm('rsa-sha1');

// make sure we are on the right domain for the links in the message
$html = str_replace("www.oktick.com", "www.".$domainName, $html);
$html = str_replace("https", "http", $html);
$text = str_replace("www.oktick.com", "www.".$domainName, $text);
$text = str_replace("https", "http", $text);

$log = new Logging();
$log->lfile('/home/oktick-beta/email.log');
// set path and name of log file (optional)
/*
$log->lwrite("setReturnPath($setReturnPath)");
$log->lwrite("setSubject($setSubject)");
$log->lwrite("setFrom($fromAddress, $fromName)");
$log->lwrite("setTo($setTo)");
//$log->lwrite("setBody($html)");
//$log->lwrite("addPart($text)");
$log->lwrite("setId($setId)");
$log->lwrite("setReplyTo($setReplyTo)");
$log->lwrite("setSender($setSender)");
*/

//	Create the message
$message = Swift_Message::newInstance()
			->setDate(time())
			->setReturnPath($setReturnPath)
            ->setSubject($setSubject)   // Give the message a subject
            ->setFrom($setFrom)   // Set the From address with an associative array
            ->setTo($setTo)   // Set the To addresses with an associative array
            ->setBody($html, 'text/html')
            ->addPart($text, 'text/plain')
            ->setId($setId) // ipaddresss of oktick-beta.com in middle
            ->setReplyTo($setReplyTo)   //Specifies the address where replies are sent to
            ->setSender($setSender)   //Specifies the address of the person who physically sent the message (higher precedence than From:)
            ->setPriority(3) //normal
			->attachSigner($signer);

//if(DEBUG) {var_dump($signer);echo "<br><br>";}
//if(DEBUG) {var_dump($message);echo "<br><br>";}

$mxs = get_mx_records_sorted($setTo);
$result=false;
while ( !$result && $mxs && list ($mx_host, $mx_weight) = each ($mxs) ) {
	if(DEBUG) echo "Connecting to $mx_host.... ";
   	$transport = Swift_SmtpTransport::newInstance($mx_host, 25); // 'ssl', 'tls'
//  $transport->setUsername('bounce.oktick-beta');
//  $transport->setPassword('30c6f2fb4d2f9fdc1650cbfe8d38');
    $massmailer = new Swift_Mailer($transport);
	try {
		$err = false;
	    $result = $massmailer->send($message);
	}
	catch(Exception $e) {
		$log->lwrite("FAIL $setTo ($setId) ".$e->getMessage() );
	}
	if($result && DEBUG) echo " $result sent<br>";
	elseif( ! $result && DEBUG) echo "$setTo failed<br>";
}
if ($result) {
	$log->lwrite("OK $setTo ($setId) sent");
    echo "OK";
}
else {
	$log->lwrite("FAIL $setTo ($setId)");
    echo "FAIL";
}
// close log file
$log->lclose();
exit;

function sent404() {
	header('HTTP/1.0 404 not found');
	header("Status: 404 Not Found");
	echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">';
	echo '<html><head>';
	echo '<title>404 Not Found</title>';
	echo '</head><body>';
	echo '<h1>Not Found</h1>';
	echo '<p>The requested URL /api.php was not found on this server.</p>';
	if(DEBUG) {
		$url = "https://www.oktick-beta.com/api.php?__PAYLOAD__=e8eBC9fMwnLNhnk8SPr5HREqf28jSmW6iUQ1PzcMX%2F6xHjla1osxeW3oaArEwsXL%2BW9CVU5X%2B10hRxQS0m1xhxyB7m3hX5M9AcEgcB%2FHvqP7FkHWDXDrIFKAtAYDmSqFoHJHQHpsdHuuRqhpS7jerzsWRRcpsoUvbrVDi8%2FYl6IRObSNj66KpDfsejB5HqYigpy2fRho5%2Bx1sAmr9oi74CjN0dX4XEsj1SIhdNCInahxy%2Bu2%2BtBD%2BWz%2FNKGWpGf8zc2l4y0MRdmpU6KhJpakd19Tjf9BABSRDQQzbgt6VStcsXZd8s%2FPd4q29vJbb9Crzuv4Oo6P%2FFWHFJTIsbvz6Q11TzozOdcxZoyF%2BzI397UZ8nqLvLEGLomw%2BfDY8fqnLePc5l%2FZfggdRSjw%2F2wbg%2BXshMvb8gZdOVgmTrn%2FB7OiWR9KozSvXTKBKQSDny9zM8qguwAht5v3C3wmmcnreb4GWm9atb4%2BXrn%2BDCw3e9h7U7KGxjAlYmripgoXJsCcKs462gBloO%2Fvwsau%2BTq6aMg6ykpQieq2SlYlkgctG4QtahQ3%2FL8wuQ%3D%3D";
		echo "<p><a href='$url'>Try this url</a></p>";
	}
	echo '</body></html>';
	exit;
}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key) {
	$encrypted_string = base64_decode($encrypted_string);
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}

function get_email_hostname($email){
	$mailparts=explode("@",$email);
	$hostname = $mailparts[1];
	return $hostname;
}

// from http://php.net/manual/en/function.getmxrr.php
function get_mx_records_sorted($email){
	$b_mx_avail=getmxrr( get_email_hostname($email), $mx_records, $mx_weight );
	$b_server_found=0;

	if($b_mx_avail){
		// copy mx records and weight into array $mxs
		$mxs=array();
		for($i=0;$i<count($mx_records);$i++){
			$mxs[$mx_records[$i]] = $mx_weight[$i];
		}
		asort ($mxs );
		reset ($mxs);
		return $mxs;
	}
	return false;
}
function get_private_key(){
return '-----BEGIN RSA PRIVATE KEY-----
MIIEpgIBAAKCAQEA3sRd9XVp7tZLmrQVyAWjTBb1ZRHl+PJ3WCPiCSxBtYyIseMA
wYXBbzIFwJM5vdppOk3tYhY478HzDuWNsoYpQwwOC/ynp4WjiLQrH4hI+5+QSoib
jGEGY5+6XgaSg55TQirpLK/DMjxLZqv4URSSQndyzRc3GI57aHBTlrwwN9kkl02U
9UlADoQV94se+HsUZ59Ntm79O51WXy7R765e+VemiraKIx6ZzNerLH3V/IMvwVkU
Sx2zCLC3m141Li7lNiZdzMHSPeJSsa18mrBHUffshZSfld/rQCaTPg5cZO/Gm7xy
K8roJyvSMhwdI+EzH9SjtmYHVNgJMxETZqSJgQIDAQABAoIBAQDBeTy9jX82nsnF
D/kG4tajpCD26eeZIkTCuU98dgKPwgGKtcQXT6rjf0d9rKBuon3X1IyCLxi+Ku2F
l5tMXLcDcznT8VhO54NTnF8DoOL6Hug7w4+NCUt6ROSg+wZO57gZ9JjVZcWbIMC/
6EXfbYVl0sZTF4GTg1PtLfl7JfCe3wo0QsYJfkrjCIU72pVw8KRnqX54KPQ7MVeo
Tk0xJ826p7GIda1RlFlqpyrSm5YUYFyOwykGoOgvN+6m4e5X7upeiKWq4AL315GA
JVHuTWQPFwzY0b1H9hp2PkSvurTjZgMVYQyXYUobCQOqWyIJ5SbYT4fE2+FEVWUl
21tZYFEBAoGBAPxp8oqPowgg+cT41vcUiwEQ0fQjPifGgHinUrDKjOBMwblnQE3l
IaR7XLf3kf22T+7vewrCIZVJKxajmYZ3hzr9fy6d0SMFLGrRZhXcmcWhQe6Ls8kF
Ve6RqEFLmIyeIudGT+Rn4GRCoqV+KjTysAIT88Cj8281EGSCYPG3biyRAoGBAOHu
l2krcbGNEavJZO71CGpEh13JSmxrXksrWrw3ZnLGoSR9cwQaCR/Vkp5td87B5pdx
gdGqp4DaRNBtdHLL/GmGiKUCeBqe7z6PW8noYdAod/F23CfZ9yWYS13snbPmXEt5
AjQEkwsW9m152HnGhXExoToyvNTVAQNGJEJaEcXxAoGBAONUSCyi0KIxkMHlmzVM
OyTqkSzf0Mrh7DK9/6tZwScB+jeQ1klRY8tPj2HghouJ9tOqu5Yk4Toie7wX+90v
KYvnYvQJDqILtsU9ckOeOp/TbB37lCAnvgzvAipMe0ep5KWGnc2IAIBLw1BpIHov
WHWGorGM92Hg2LKs+cK5AXEBAoGBALs/ryVu6C+rJzYlGA4j7vGEElzcc14gLmpG
aFEN6U6+6NcBUc3Ydi94Jqg/OciWU7K4VEudEG5ueBH2ZUivX2dmJOH9heUqTEah
MgXJHygSIjZxuE0fDQKPkgcqEBoFlgDHLdhG4keSpHJfRdbHfdkutN0zJ+WNE+XO
wEZtt8VBAoGBANwQ/KlOdTQzeH+DnS+G8DRkO6bd650ipbcFJNnjZ70aIvSTARgr
waWz0VBWO/VhPG3RIdk5lXHP7lxxmuYJ2xux26656t/tqUAaGSrQTNEMKCp4+tej
dqChuic23HhVgfaSd6AEEho+GFwYQf1/3r/WVHfXi2OzBYFMQSTERlRf
-----END RSA PRIVATE KEY-----';
}

/**
 * Logging class:
 * - contains lfile, lwrite and lclose public methods
 * - lfile sets path and name of log file
 * - lwrite writes message to the log file (and implicitly opens log file)
 * - lclose closes log file
 * - first call of lwrite method will open log file implicitly
 * - message is written with the following format: [d/M/Y:H:i:s] (script name) message
 */
class Logging {
    // declare log file and file pointer as private properties
    private $log_file, $fp;
    // set log file (path and name)
    public function lfile($path) {
        $this->log_file = $path;
    }
    // write message to the log file
    public function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        // define script name
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[d/M/Y:H:i:s]');
        // write current time, script name and message to the log file
        fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}
