<?php
/**
 * A delegate class for the entire application to handle custom handling of
 * some functions such as permissions and preferences.
 */
class tables_bps {
  function beforeSave(&$record){
    return;
/*
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
*/
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


    /*
      //$path = dirname(__FILE__)."/../../conf/parsecsv.lib.php";
      //require_once($path);
      //$csv = new parseCSV();

      # Parse '_books.csv' using automatic delimiter detection...
      $csv->auto($data);
ECHO <<<END
<style type="text/css" media="screen">
  table { background-color: #BBB; }
  th { background-color: #EEE; }
  td { background-color: #FFF; }
</style>
<table border="0" cellspacing="1" cellpadding="3">
  <tr>
END;
foreach ($csv->titles as $value):
    echo"<th>$value</th>";
endforeach;
echo "</tr>";
foreach ($csv->data as $key => $row):
echo "<tr>";
foreach ($row as $value):
  echo "<td>$value</td>";
endforeach;
echo "</tr>";
endforeach;
echo "</table><br><pre>";
*/
      //var_dump($defaultValues);
      // build an array of Dataface_Record objects that are to be inserted based
      // on the CSV file data.
      $records = array();
      $columns = array();

      // first split the CSV file into an array of rows.
      $rows = explode("\n", $data);
      $total_processed_counter = 0;
      $bps_exist_counter = 0;
      $prime_errors = 0;

      foreach ( $rows as $bp ){
      	$bp =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $bp);
        $bp_description = "";
        $prime = "";
        $jump_flag_s_flag = "No";
        $bp_format_x_flag = "No";
        $same_name_exclam_flag = 'No';

        $total_processed_counter++;
        if($bp=="DEBUG"){
          if(!defined("DEBUG")) {
            define("DEBUG",TRUE);
            echo "DEBUG MODE ENABLED<br>";
          }
          continue;
        } else {
          if(!defined("DEBUG")) define("DEBUG",FALSE);
        }

        if(DEBUG) echo "<strong>PROCESSING BP='$bp'</strong><br>";
        // Check for prime override with comma
        if (strpos($bp, ",") !== FALSE){
           $bp_array = explode(",", $bp);
           if(isset($bp_array[2])){
            echo "BP: '$bp' has too many commas. Please fix and resubmit<br>";
            $prime_errors++;
            continue;
           }
           $bp = trim($bp_array[0]);
           $prime = trim($bp_array[1]);
           if (DEBUG) echo "BP='$bp', PRIME='$prime'<br>";
        }

        $bp = mysql_real_escape_string(trim($bp));

        If (!$bp) continue;

        if( ! $prime){
          // Check for a bp with parentesis
          $prime_addition = "";
          $left = strpos($bp, "(");
          $right = strpos($bp, ")");
          if ($left !== FALSE AND $right !== FALSE && $left < $right){
            // We have an prime addition
            $prime_addition = trim(substr($bp, $left, $right-$left+1));
            $bp = trim(substr($bp, 0, $left));
          }

          // Load prime prepositions
          $sql =  "SELECT preposition from prime_prepositions";
          $result = mysql_query($sql, $app->db());
          while ($preposition = mysql_fetch_row($result)){
            $prepositions[] = $preposition[0];
          }

          // Check if the bp contains the preposition
          $my_preposition = "";
          foreach($prepositions as $preposition){
            $position_preposition = strpos($bp, " ".$preposition." ");
            if ($position_preposition){
              $position_preposition = $position_preposition +1;
              $my_preposition = $preposition;
              $prime = trim(substr($bp,0,$position_preposition + strlen($preposition)));
              if($prime_addition) $prime = $prime." ".$prime_addition;
              if (DEBUG) echo "DEBUG".__LINE__.": preposition '$preposition' found. Inverted Prime '$prime' suspected.<br>";
              // Make sure the prime exists
              $sql =  "SELECT prime from primes WHERE prime = '$prime'";
              $mysql_num_rows = mysql_num_rows(mysql_query($sql, $app->db()));
              if($mysql_num_rows == 0) {
                $prime_errors++;
                echo "Prime '$prime' was detected as an inverted prime but ";
                continue;
              }
            }
          }
        }
        // parse the prime if its not already found
        if(!$prime){
          $tmp=preg_split('/\s+/',$bp);
          $prime = $tmp[count($tmp)-1];
          if($prime_addition) $prime = $prime." ".$prime_addition;
        }

        // Make sure the prime exists
        $sql =  "SELECT prime_uid,industrial,inverted from primes WHERE prime = '$prime' LIMIT 1";
        $result = mysql_query($sql, $app->db());
        if( ! mysql_num_rows($result) ) {
          $prime_errors++;
          $sql =  "SELECT prime from primes WHERE prime LIKE '$prime%'";
          $result = mysql_query($sql, $app->db());
          echo "Bp '$bp' has error => prime '$prime' does not exist<br>";
          while ($possible_prime = mysql_fetch_row($result)){
            echo " Possible prime = '$possible_prime[0]'<br>";
          }
          continue;
        }

        $row = mysql_fetch_assoc($result);
        $prime_uid = $row['prime_uid'];
        $industrial = $row['industrial'];
        if ( ! $industrial ) $industrial = 'No';
        $inverted = $row['inverted'];
        if ( ! $inverted ) $inverted = 'No';

        // Check if the bp exists already
        $sql = "SELECT bp from bps WHERE ( bp = '$bp' OR bp = REPLACE('$bp','-',' ') ) AND prime_uid = '$prime_uid'";
        $mysql_num_rows = mysql_num_rows(mysql_query($sql, $app->db()));
//        if (DEBUG) echo "Bp '$bp' has $mysql_num_rows instances $sql<br>";
        if($mysql_num_rows > 0) {
          $bps_exist_counter++;
          if (DEBUG) echo "Bp '$bp' has error => bp already exists<br>";
          continue;
        }

        $record = new Dataface_Record('bps', array());
        // We insert the default values for the record.
        // $record->setValues($defaultValues);

		$display_bp = $bp;
		if(strpos($bp, "-")){
			// $bp contains dash
			$bp = str_replace("-", " ", $bp);
			if (DEBUG) echo "Bp = '$bp' <br>";
		}
		if(strpos($prime,"(") AND strpos($prime,")") AND strpos($prime,"(") < strpos($prime,")") ) $prime_has_parentesis = "Yes";
		else $prime_has_parentesis = "No";

		$record->setValues(
        	array(
            	'bp' => $bp,
            	'bp_description' => $bp_description,
            	'prime' => $prime,
            	'prime_uid' => $prime_uid,
            	'prime_has_parentesis' => $prime_has_parentesis,
            	'jump_flag_s_flag' => $jump_flag_s_flag,
            	'same_name_exclam_flag' => $same_name_exclam_flag,
            	'number_words' => str_word_count($bp),
                'industrial' => $industrial,
                'prime_inverted' => $inverted,
                'bp_uid'=> "",
			)
        );

        if (DEBUG) echo "DEBUG".__LINE__.": $total_processed_counter bp => '$bp', bp_description  => '$bp_description', prime => '$prime', s_flag => '$jump_flag_s_flag', x_flag => '$bp_format_x_flag', name_flag' => '$same_name_exclam_flag', prime_addition => '$prime_addition', preposition => '$my_preposition'<br>";

        $records[] = $record;
       }
       if ($prime_errors) {
          echo "There are errors so no actions were taken. Fix the errors and resubmit your data to complete the import<br>";
          echo '<a href="javascript:history.go(-1)"  onMouseOver="self.status=document.referrer;return true">Go Back</a>';
          exit;
       } elseif (DEBUG){
          echo '<a href="javascript:history.go(-1)"  onMouseOver="self.status=document.referrer;return true">Go Back</a>';
          echo "<br>";
          exit;
       }
       // Now we return the array of records to be imported.
       return $records;
   }
}
