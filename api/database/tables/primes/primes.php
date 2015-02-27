<?php
/**
 * A delegate class for the entire application to handle custom handling of 
 * some functions such as permissions and preferences.
 */
class tables_primes {
	/**
	 * @brief Initialization method that is called once just after the delegate class is loaded
	 * per request.  We use this to set a security filter to only show rows pertaining
	 * to the currently logged-in user.
	 *
	 *
	 * @param Dataface_Table Reference to the my_surveys Dataface_Table object.
	 *
	 * @returns void
	 *
	 * @see <a href="http://xataface.com/dox/core/latest/class_dataface___table.html">Dataface_Table</a>
	 */
	function init($table){
	
//		$auth = Dataface_AuthenticationTool::getInstance();
//		$username = $auth->getLoggedInUserName();
//		$table->setSecurityFilter(array('username'=>'='.$username, 'access_level' => '>=2'));
	}

	
	/**
	 * @brief Gets the roles that the current user is granted on this table.
	 *
	 * If the current user in an admin, or a null value is passed, then this method will
	 * simply return null, indicating that it defers the decision about the role to the 
	 * Application Delegate Class.
	 *
	 * @param Dataface_Record $record Record of the my_surveys view.
	 * @returns string The role assigned to the user.
	 *
	 * @see conf_ApplicationDelegate::getPermissions()
	 *
	 */
	function getRoles($record){
		return null;
	
		if ( isAdmin() ) return null;
		if ( !$record ) return null;
		return 'P_ACCESS_LEVEL_'.$record->val('access_level');
	}
	
	function beforeSave(&$record){
		return;
		$app =& Dataface_Application::getInstance();  // reference to Dataface_Application object
		$auth =& Dataface_AuthenticationTool::getInstance(); // reference to Dataface_Authentication object
		$request =& $app->getQuery();  // Request vars:  e.g. [-table]=>'Students', [-action]=>'hello'
		$userobj =& $auth->getLoggedInUser();  // Dataface_Record object of currently logged in user.

		$user       = mysql_real_escape_string($userobj->val('UserName'));
		$action     = mysql_real_escape_string($request['-action']);
		$tablename  = mysql_real_escape_string($request['-table']);
	        $role       = mysql_real_escape_string($userobj->val('Role'));
        	$recordid   = mysql_real_escape_string($request['-recordid']);
        	// Perform a custom SQL Query:
        	$sql =  "user = '$user',".
                	"action = '$action',".
                	"tablename = '$tablename',".
                	"role = '$role',".
                	"recordid = '$recordid'";
		$res = mysql_query("INSERT INTO l SET $sql", $app->db());

      }
      function beforeDelete(&$record){
        self::beforeSave($record);
      }
      function beforeAddRelatedRecord($record){
		return;
        return Dataface_Error::permissionDenied('Sorry you don\'t have permission to do this.');
      }
}
