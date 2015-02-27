<?php
class Database
{
	protected static $type = "mysql";
	protected static $host = "localhost";
	protected static $port = "3306";
	protected static $name = "operations";
	protected static $user = "ipiresearch";
	protected static $pass = "2e76656dcba6562ffeb68d524de1053e90a229a0";
	protected static $database_connection_id = false;
	protected static $options = array( \PDO::ATTR_PERSISTENT => FALSE,);
	protected static $my = false;

	static function connect() {
		return self::mysql_connect();
	}

	static function mysql_connect() {
		$f3 = \Base::instance();
 		if ( self::$my ) return self::$my;
		self::$my = new DB\SQL(self::$type . ':host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$name , self::$user , self::$pass, self::$options);
		$f3->set('DB', self::$my);
		return self::$my;
  }

	static function connection_ok_or_unload($id) {
		if ( self::connection_ok($id) ) return $id;
		$f3 = \Base::instance();
	 	if (DEBUG) $f3->get('LOG')->write( "connection_ok_or_unload called on database ID $id => unloading"." ".self::sid());
		$f3->unload("./");
		exit;
	}

	static function connection_ok($id) {
		$f3 = \Base::instance();
//	 	if (DEBUG) $f3->get('LOG')->write( "connection_ok called on database ID $id"." ".self::sid());
		$sql  = " SELECT COUNT(id) as result FROM information_schema.processlist WHERE id=$id";
		$result = $f3->get('DB')->exec($sql);
		if ( $result[0]['result'] ) return $id;
		return false;
	}

	static function get_connection_id(){
		$f3 = \Base::instance();
		$sql  = " SELECT CONNECTION_ID() as result";
		$result = $f3->get('DB')->exec($sql);
		$id = $result[0]['result'];
//	 	if (DEBUG) $f3->get('LOG')->write( "get_connection_id called. Database ID $id found."." ".self::sid());
		return $id;
	}

	static function sid(){
		return "session=".session_name()."=".session_ID();
	}
/*
	static function is_connected() {
		$f3 = \Base::instance();
 		if (is_object( $f3->get('DB') ) ) return true;
		return false;
  }
*/
	static function kill($old_database_connection_id) {
		$f3 = \Base::instance();
	 	if (self::connection_ok($old_database_connection_id)) {
		 	if(DEBUG) $f3->get('LOG')->write( "Kill called on alive database ID ".$old_database_connection_id." ".self::sid());
		 	$sql  = "KILL QUERY $old_database_connection_id";
		 	$result = $f3->get('DB')->query($sql);
		 	$sql  = "KILL CONNECTION $old_database_connection_id";
		 	$result = $f3->get('DB')->query($sql);
		 	if(DEBUG){
		 		if (self::connection_ok($old_database_connection_id)) {
				 	if(DEBUG) $f3->get('FP')->log( "Database connection ($old_database_connection_id) kill successfull!"." ".self::sid());
				} else {
			 		if(DEBUG) $f3->get('FP')->log( "ERROR Database connection ($old_database_connection_id) kill UNSUCCESSFULL!"." ".self::sid());
			 	}
			}
		} else {
			if(DEBUG) $f3->get('LOG')->write( "Kill called on dead database ID ".$old_database_connection_id." ".self::sid());
		}
  }


  /*function __construct(){
    $f3 = \Base::instance();
    $log_file = realpath($f3->get('FILE')) . ".log";
    $f3->set('LOG', new Log($f3->get('FILE').'log'));
  }
  */
  public static function mysql_query($sql,$line=false){
    self::mysql_connect();
    if($line) $sql = trim($sql). " " . "#----$line";
    $result = self::$my->exec($sql);
    My::log(str_replace("#----","#",self::$my->log())." rows=".count($result));
    if ($result===FALSE) trigger_error("$sql falied");
    return $result;
  }

  public static function mysql_count($sql,$line=false){
    $result = self::mysql_query($sql,$line);
    return array_pop($result[0]);
  }

  public static function getAvailableDrivers(){
    return  PDO::getAvailableDrivers();
  }

}

