<?php
/**
 * CommandLine class
 *
 * @package             Framework
 */
/**
 * Command Line Interface (CLI) utility class.
 *
 * @author              Patrick Fisher <patrick@pwfisher.com>
 * @since               August 21, 2009
 * @package             Framework
 * @subpackage          Env
 */
class CLI {

    public static $args;

    /**
     * PARSE ARGUMENTS
     *
     * This command line option parser supports any combination of three types
     * of options (switches, flags and arguments) and returns a simple array.
     *
     * [pfisher ~]$ php test.php --foo --bar=baz
     *   ["foo"]   => true
     *   ["bar"]   => "baz"
     *
     * [pfisher ~]$ php test.php -abc
     *   ["a"]     => true
     *   ["b"]     => true
     *   ["c"]     => true
     *
     * [pfisher ~]$ php test.php arg1 arg2 arg3
     *   [0]       => "arg1"
     *   [1]       => "arg2"
     *   [2]       => "arg3"
     *
     * [pfisher ~]$ php test.php plain-arg --foo --bar=baz --funny="spam=eggs" --also-funny=spam=eggs \
     * > 'plain arg 2' -abc -k=value "plain arg 3" --s="original" --s='overwrite' --s
     *   [0]       => "plain-arg"
     *   ["foo"]   => true
     *   ["bar"]   => "baz"
     *   ["funny"] => "spam=eggs"
     *   ["also-funny"]=> "spam=eggs"
     *   [1]       => "plain arg 2"
     *   ["a"]     => true
     *   ["b"]     => true
     *   ["c"]     => true
     *   ["k"]     => "value"
     *   [2]       => "plain arg 3"
     *   ["s"]     => "overwrite"
     *
     * @author              Patrick Fisher <patrick@pwfisher.com>
     * @since               August 21, 2009
     * @see                 http://www.php.net/manual/en/features.commandline.php
     *                      #81042 function arguments($argv) by technorati at gmail dot com, 12-Feb-2008
     *                      #78651 function getArgs($args) by B Crawford, 22-Oct-2007
     * @usage               $args = CommandLine::parseArgs($_SERVER['argv']);
     */


    public static function run_once_only($argv=false)
	{
		$script = basename($_SERVER ['PHP_SELF']);
//		foreach($argv as $value) $script .= " $value";
		$shortscript=substr($script,0,15);
//		$numberofinstances=exec( "ps -aux |grep $script" );
//		echo $numberofinstances."\n\n";
		$numberofinstances=exec( "ps -C $script -o comm= |grep $shortscript --count" );
		if ($numberofinstances > 1){
			$pid=trim(exec( "ps -eo pid,comm |grep $shortscript | grep -v ".getmypid() ));
			$pid=substr($pid,0,strpos($pid," "));
			$to="leancode@gmail.com";
			date_default_timezone_set('UTC');
			$message="FAILURE - $script already running ".($numberofinstances-1)." time(s) on ".date("d M H:i").", PID = ".$pid;
			mail($to,$message,$message);
			die ( "$message\n" );
		}
	}

	public static function run_on_host_or_die()
	{
		$arguments=self::parse_args($argv);
		if(empty($arguments['host']) OR $arguments['host']<>Misc::short_hostname() ) die('No "--host='.Misc::short_hostname().'" passed as parameter for me to run on this host.'."\n\n");
		
	}
	public static function command($command,$exectype="exec",$echo=true) {
		if ($exectype == "passthru") {
			passthru ( $command );
			if ($echo) echo "\n";
			return;
		}
		if ($exectype == "exec") {
			$result = exec ( $command , $response);
			if ($echo) echo "$command: $result \n";
			return $result;
		}
		if ($exectype == "system") {
			$result = system ( $command, $return );
			if ($echo) echo "$command: $result \n";
			return $result;
		}
	}

    public static function parse_args($argv){

        array_shift($argv);
        $out                            = array();

        foreach ($argv as $arg){

            // --foo --bar=baz
            if (substr($arg,0,2) == '--'){
                $eqPos                  = strpos($arg,'=');

                // --foo
                if ($eqPos === false){
                    $key                = substr($arg,2);
                    $value              = isset($out[$key]) ? $out[$key] : true;
                    $out[$key]          = $value;
                }
                // --bar=baz
                else {
                    $key                = substr($arg,2,$eqPos-2);
                    $value              = substr($arg,$eqPos+1);
                    $out[$key]          = $value;
                }
            }
            // -k=value -abc
            else if (substr($arg,0,1) == '-'){

                // -k=value
                if (substr($arg,2,1) == '='){
                    $key                = substr($arg,1,1);
                    $value              = substr($arg,3);
                    $out[$key]          = $value;
                }
                // -abc
                else {
                    $chars              = str_split(substr($arg,1));
                    foreach ($chars as $char){
                        $key            = $char;
                        $value          = isset($out[$key]) ? $out[$key] : true;
                        $out[$key]      = $value;
                    }
                }
            }
            // plain-arg
            else {
                $value                  = $arg;
                $out[]                  = $value;
            }
        }
        self::$args                     = $out;
        return $out;
    }

    /**
     * GET BOOLEAN
     */
    public static function get_boolean($key, $default = false){
        if (!isset(self::$args[$key])){
            return $default;
        }
        $value                          = self::$args[$key];
        if (is_bool($value)){
            return $value;
        }
        if (is_int($value)){
            return (bool)$value;
        }
        if (is_string($value)){
            $value                      = strtolower($value);
            $map = array(
                'y'                     => true,
                'n'                     => false,
                'yes'                   => true,
                'no'                    => false,
                'true'                  => true,
                'false'                 => false,
                '1'                     => true,
                '0'                     => false,
                'on'                    => true,
                'off'                   => false,
            );
            if (isset($map[$value])){
                return $map[$value];
            }
        }
        return $default;
    }
}
?>
