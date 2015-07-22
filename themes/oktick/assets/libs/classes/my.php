<?php

class My extends Prefab {

    private static $classes    = "libs/classes/"; // trailing slash
    private static $views      = "libs/views/";   // trailing slash
//    private static $locks      = "f3locks/";   // trailing slash
    private static $admin_subject_error_prefix  = "IPI Error ";
    private static $admin_subject_info_prefix   = "IPI Info ";
    private static $exit_code                   = 0;
    public static $time_program_started_delphi  = false;
    public static $time_program_started_unix    = false;
    public static $as                           = array();

    public static function init($FILE=false){
//      echo "DEBUG:".__FILE__.":".__LINE__."\n";
        $f3 = \Base::instance();
        date_default_timezone_set('UTC');
        self::$time_program_started_unix = time();
        $f3->set('UNLOAD', "My->shutdown");
        $f3->set('ONERROR', "My->onerror");
        $f3->set('AUTOLOAD', realpath(dirname(__FILE__)).'/');
        echo realpath(dirname(__FILE__)).'/';
        if($FILE) $f3->set('FILE',$FILE);
        if(!defined('DEBUG'))define('DEBUG',FALSE);
        if (DEBUG) self::logger_init();
        self::function_debug(__CLASS__,__FUNCTION__);
        $f3->set('DEBUG', DEBUG);
        $f3->set('UI', realpath(dirname(__FILE__).'/../views').'/');
        
//        $f3->set('LOCKS_DIR',self::$locks);
        $f3->set('ESCAPE',false);
        if (version_compare(phpversion(), "5.3.0", ">=")  == 1){
            if(DEBUG) error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            else error_reporting(0);
        } else {
            if(DEBUG) error_reporting(E_ALL & ~E_NOTICE);
            else error_reporting(0);
        }
        Cli::run_once_only();
        self::$time_program_started_delphi = Mydatetime::GetDelphiTime(self::$time_program_started_unix,"UTC");
    }

    public function shutdown(){
        $f3 = \Base::instance();
        // @todo handle different shutdown for cli / web
        self::function_debug(__CLASS__,__FUNCTION__);
        self::dump_errors();
        cli::release_lockfile();
        My::info(self::$exit_code == 0 ? "Script exited successfully":"Script exited with errors");
        exit(self::$exit_code);
    }

    public function onerror($f3) {
        $text = print_r($f3->get('ERROR'), true);
        \Base::instance()->get("FP")->error($text);
        self::$exit_code = 64;
        /* Don't execute PHP internal error handler */
        exit;
    }

    private static function logger_init(){
        $f3 = \Base::instance();
        if( php_sapi_name() == "cli" ) {
            $f3->set('FP', Cli_logger::instance());
            $c = new Colors\Color();
            $f3->set('Color', $c );
            return;
        }
        $f3->set('FP', FirePHP::getInstance(true));
        $options = array('maxObjectDepth' => 5,
                 'maxArrayDepth' => 5,
                 'maxDepth' => 10,
                 'useNativeJsonEncode' => true,
                 'includeLineNumbers' => true);

        //$f3->get('FP')->getOptions();
        $f3->get('FP')->setOptions($options);
        //$f3->get('FP')->setObjectFilter('ClassName', array('MemberName'));
        $f3->get('FP')->registerErrorHandler($throwErrorExceptions=false); // Convert E_WARNING, E_NOTICE, E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE and E_RECOVERABLE_ERROR errors to ErrorExceptions and send all Exceptions to Firebug automatically if desired.
        $f3->get('FP')->registerExceptionHandler();
        $f3->get('FP')->registerAssertionHandler($convertAssertionErrorsToExceptions=false,$throwAssertionExceptions=false); // if assertions should be converted to errors
        //try { throw new Exception('Test Exception'); } catch(Exception $e) { $f3->get('FP')->error($e);   } // manualy create assertion
        $f3->get('FP')->log("FirePHP initialized ".basename(__FILE__));
    }

    public static function function_debug($class,$function,$text="", $type="log"){
        if ( ! DEBUG) return;
        $f3 = \Base::instance();
        if($text) $text = " => $text";
        $f3->get('FP')->$type( $class."->".$function."() called$text");
    }

    public static function dump_errors(){
        if(self::$exit_code) return;
        if (is_array(error_get_last())){
            \Base::instance()->get("FP")->error(error_get_last());
            self::$exit_code = 64;
        }
    }

    public static function error($text=""){
        return \Base::instance()->get("FP")->error( $text );
    }
    public static function warn($text=""){
        return \Base::instance()->get("FP")->warn( $text );
    }
    public static function info($text=""){
        return \Base::instance()->get("FP")->info( $text );
    }
    public static function log($text=""){
        return \Base::instance()->get("FP")->log( $text );
    }
    public static function get_accountsettings($acno){
        $f3 = \Base::instance();
        $sql = "SELECT * FROM accountsettings WHERE account = $acno";
        $result = Database::mysql_query($sql,__LINE__);
        if(count($result) > 1) trigger_error("Account '$acno' exist more than once in accountsettings");
        if(count($result) == 1) {
            foreach($result[0] as $col => $val){
                self::$as[$col] = $val;
            }
        }

        $sql = "SELECT * FROM accountsettings_2 WHERE account = $acno";
        $result = Database::mysql_query($sql,__LINE__);
        if(count($result) > 1) trigger_error("Account '$acno' exist more than once in accountsettings_2");
        if(count($result) == 1) {
            foreach($result[0] as $col => $val){
                self::$as[$col] = $val;
            }
        }
        if (! self::$as ) trigger_error("Account '$acno' does not exist in accountsettings & accountsettings_2");
    }
    public static function checkclass($class) {
        $f3 = \Base::instance();
		$class=$f3->fixslashes(ltrim($class,'\\'));
		foreach ($f3->split($f3->get('PLUGINS').';'.$f3->get('AUTOLOAD') ) as $auto){
			$file=$auto.$class.'.php';
			if (is_file($file)) echo "$file OK\n";
            else echo "$file missing\n";

            $file=$auto.strtolower($class).'.php';
			if (is_file($file)) echo "$file OK\n";
            else echo "$file missing\n";

            $file=strtolower($auto.$class).'.php';
			if (is_file($file)) echo "$file OK\n";
            else echo "$file missing\n";
		}
	}
}
