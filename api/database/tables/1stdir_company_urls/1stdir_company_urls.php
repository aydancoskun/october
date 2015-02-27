<?php
/**
 * A delegate class for the entire application to handle custom handling of 
 * some functions such as permissions and preferences.
 */
class tables_1stdir_company_urls {
  function beforeSave(&$record){
    return;
    $app =& Dataface_Application::getInstance();  // reference to Dataface_Application object
    $auth =& $app->getAuthenticationTool();
    //$auth =& Dataface_AuthenticationTool::getInstance(); // reference to Dataface_Authentication object
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

  function get_options(){     
  }

  function getTitle(&$record){
    return $record->val('bp');
  }
  
  function titleColumn(){
    return 'bp';
  }

  /*
  function prime_uid__renderCell(&$record){
    $sql =  "user = '$user',".
            "action = '$action',".
            "tablename = '$tablename',".
            "role = '$role',".
            "recordid = '$recordid'";

    $res = mysql_query("INSERT INTO l SET $sql", $app->db());

    return '<div style="white-space:nowrap">'.$record->display('bp').'</div>';
  }
  */

   function __import__csv(&$data, $defaultValues=array())
   {
        $app =& Dataface_Application::getInstance();  // reference to Dataface_Application object
      //var_dump($defaultValues);
      // build an array of Dataface_Record objects that are to be inserted based
      // on the CSV file data.
      $records = array();
      $columns = array();

      // first split the CSV file into an array of rows.
      $rows = explode("\n", $data);

      foreach ( $rows as $company_urls ){
        $company_urls = str_replace("\n", "", $company_urls);
        $company_urls = str_replace("\r", "", $company_urls);

        $record = new Dataface_Record('1stdir_company_urls', array());
        // We insert the default values for the record.
        // $record->setValues($defaultValues);

        $record->setValues(
               array(
                  'url' => $company_urls,
                   )
               );

        $records[] = $record;
       }
       // Now we return the array of records to be imported.
       return $records;
   }
}