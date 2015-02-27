<?php
class Suggest {

	protected $str_suppliers			= "";
	protected $str_prime_definition   	= "";
	protected $str_prime_examples     	= "";
	protected $str_linked_items       	= "";
	protected $str_collective_items   	= "";
	protected $str_related_items      	= "";
	protected $WHERE					= " WHERE no_products_found > 0 AND ";
	protected $algo						= false;
	protected $SQL_PRIME_LIMIT			= "";
	protected $SQL_BP_LIMIT				= "";
	protected $full_prime				= "";
	protected $prime		 			= "";
	protected $debraced_prime 			= "";
	protected $multi_prime 				= "";
	protected $rest_prime 				= "";
	protected $singular_prime			= "";
	protected $url_query				= "";
	protected $min_query_letters		= 2;
	protected $num_results				= 0;
	protected $esign_R					= "";
	protected $esign_L					= "";
	protected $e_bp						= "";
	protected $e_prime					= "";

	function __construct() {
		$f3 = \Base::instance();
		$this->SQL_PRIME_LIMIT			= $f3->get('SQL_PRIME_LIMIT');
		$this->SQL_BP_LIMIT				= $f3->get('SQL_BP_LIMIT');
		define("ENTER_KEYWORD_ONLY","Enter Keyword only");
		define("SELECT_ITEM","Please select...");
		define("SELECT_ITEM_OR_TYPE_ON","Please select or type on...");
		define("SEARCHING","Searching...");
		define("CLICK_SEARCH_EXPAND",'Click "Search" for suppliers');
		define("CLICK_SEARCH","Click \'Search\' for suppliers");
		define("FINDING_SUPPLIERS",'Finding suppliers...');
		define("INPUT_NOT_RECOGNISED",'Not found, try Keyword only');//, Sorry, input not recognized on system. Spelling or other name?');
		define("STR_STATUS_MSG_DEFAULT",'Enter Keyword (e.g. Pumps, Boots, etc)');//, Sorry, input not recognized on system. Spelling or other name?');
		define("FUNCTION_MISSING","Method does not exist");
		define("NO_RESULTS","No results for any Method we tried");
		define("QUERY_TOO_SHORT","Query has not reached minimum length");
	}

	function beforeRoute(){	}

	function afterroute(){ }

	function ajax($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized (This is called when something is entered in the search box and returns suggestions)");
		Database::connect();
		$this->url_query = Misc::set_url_variables($params);
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() \$this->url_query = $this->url_query");
		if (strlen(trim($this->url_query,"+ ")) < 2) {
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() \url_query too short");
			Misc::$no_suggestions=QUERY_TOO_SHORT;
			$this->setResponse(__LINE__);
			return Misc::quit_suggest(__LINE__);
		}
		if( ! Misc::$url_contains_space && ! Misc::$has_expansion_sign){
			if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() no space in url_query, looking up from_primes_table()");
			$this->from_primes_table();
//			if (! Misc::$no_suggestions ) if (DEBUG) $f3->get('FP')->trace('check 1');
		}
		elseif (Misc::$has_expansion_sign) {
			$sql  = " SELECT prime FROM primes $this->WHERE prime =:url_query LIMIT 1 #".__LINE__;
			$result = $f3->get('DB')->exec($sql,array(":url_query" => $this->url_query));
			if(count($result)) {
				$prime = $result[0]['prime'];
				if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Click on prime detected, looking up from_bp_table('$prime')");
				$this->from_bp_table($prime);
			} else {
				$sql  = " SELECT prime FROM bps $this->WHERE bp_is_a_prime = 'No' AND bp = :url_query LIMIT 1 #".__LINE__;
				$result = $f3->get('DB')->exec($sql,array(":url_query" => $this->url_query));
				if(count($result)) {
					$prime = $result[0]['prime'];
					if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Click on bp detected, looking up from_bp_table('$prime')");
					$this->from_bp_table($prime);
				}
			}
		}
		if (! Misc::$no_suggestions ){
			if(! $this->get_prime_vars($this->url_query)) return false;
			$this->prime_bp_matches();
			$function = $this->get_function_name();
			if( ! method_exists( $this, $function ) ){
				Misc::$no_suggestions=FUNCTION_MISSING;
				$this->setResponse(__LINE__);
				if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Method \$this->$function() does not exist");
				return Misc::quit_suggest(__LINE__);
			}
			$this->$function();
		}
		if (! Misc::$suggestions ){
			Misc::$no_suggestions=NO_RESULTS;
			$this->setResponse(__LINE__);
			if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() \$this->$function() no results");
			return Misc::quit_suggest(__LINE__);
		}
		Misc::render_ajax_suggestions();
	}

	function from_primes_table(){
		$f3 = \Base::instance();
		$this->algo=__FUNCTION__;
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$sql  = " SELECT prime as result FROM primes $this->WHERE prime LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => $this->url_query."%"));
		return $this->setResponse(__LINE__);
	}

	function from_bp_table($prime){
		$f3 = \Base::instance();
		$this->algo=__FUNCTION__;
		$str_word_count_allowed = str_word_count($this->url_query)+1;
		if($str_word_count_allowed < 3) $str_word_count_allowed = 3;
		$sql  = "SELECT bp as result FROM bps" . $this->WHERE .
				"bp_is_a_prime = 'No' AND ".
				"prime = $prime AND ".
				"number_words <= $str_word_count_allowed #".__LINE__;
		$this->do_suggest($sql,array());
		return $this->setResponse(__LINE__);
	}

	function setResponse($line){
//		Misc::set_onSearchStart($onSearchStart, "Start".$line);
		Misc::set_onSearchStart('', "Start".$line);
		if(Misc::$no_suggestions == FUNCTION_MISSING){
			Misc::set_onSearchComplete(STR_STATUS_MSG_DEFAULT, "Complete".$line);
			Misc::set_onSelect('', "Select".$line);
		}
		elseif(Misc::$no_suggestions == NO_RESULTS){
			Misc::set_onSearchComplete(INPUT_NOT_RECOGNISED, "Complete".$line);
			Misc::set_onSelect('', "Select".$line);
		}
		elseif(Misc::$no_suggestions == QUERY_TOO_SHORT){
			Misc::set_onSearchComplete(STR_STATUS_MSG_DEFAULT, "Complete".$line);
			Misc::set_onSelect('', "Select".$line);
		}
		elseif($this->algo == "from_primes_table"){
			Misc::set_onSearchComplete(CLICK_SEARCH, "Complete".$line);
			Misc::set_onSelect(CLICK_SEARCH, "Select".$line);
		}
		elseif(Misc::$no_suggestions==1 AND $this->algo == "from_bp_table"){
			if(isset(Misc::$suggestions[strtolower($this->url_query)])){
				Misc::$suggestions=array();
				Misc::$no_suggestions=0;
				Misc::set_onSearchComplete(CLICK_SEARCH, "Complete".$line);
			} else {
				Misc::set_onSearchComplete(SELECT_ITEM, "Complete".$line);
			}
			Misc::set_onSelect(CLICK_SEARCH, "Select".$line);
		}
		elseif(! Misc::$no_suggestions){
			Misc::set_onSearchComplete(INPUT_NOT_RECOGNISED, "Complete".$line);
			Misc::set_onSelect('', "Select".$line);
		}
		elseif(Misc::$no_suggestions==1){
			if(isset(Misc::$suggestions[strtolower($this->url_query)])){
				Misc::$suggestions=array();
				Misc::$no_suggestions=0;
				Misc::set_onSearchComplete(CLICK_SEARCH, "Complete".$line);
			} else {
				Misc::set_onSearchComplete(SELECT_ITEM, "Complete".$line);
			}
			Misc::set_onSelect(CLICK_SEARCH, "Select".$line);
		}
		elseif(Misc::$no_suggestions<10){
			Misc::set_onSearchComplete(SELECT_ITEM, "Complete".$line);
			Misc::set_onSelect(CLICK_SEARCH, "Select".$line);
		}
		else{
			Misc::set_onSearchComplete(SELECT_ITEM, "Complete".$line);
			Misc::set_onSelect(CLICK_SEARCH, "Select".$line);
		}
		Misc::set_searchSubmit(SEARCHING, "Submit".$line);
		return false;
	}
	function bp_esign(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$right = Misc::right_word( Misc::$esign_L );
		$left = Misc::left_word( Misc::$esign_L );

		$middle_words = Misc::middle_words( Misc::$esign_L );
		$middle_sql_AND = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();
		$sql_parameters[":left"] = "% " . $left . " %";
		$sql_parameters[":right"] = "% " . $right . " %";
		$sql_parameters[":esign_R"] = Misc::$esign_R . "%";
		$sql_parameters[":prime"] = $this->e_prime;

		$sql  = " SELECT bp as result FROM bps $this->WHERE prime = :prime AND concat(' ',bp,' ') LIKE :left AND $middle_sql_AND concat(' ',bp,' ') LIKE :right AND bp LIKE :esign_R #".__LINE__;
		$this->do_suggest( $sql, $sql_parameters );

		$sql_parameters[":esign_R"] = "% " . Misc::$esign_R . "%";
		$sql  = " SELECT bp as result FROM bps $this->WHERE prime = :prime AND concat(' ',bp,' ') LIKE :left AND $middle_sql_AND concat(' ',bp,' ') LIKE :right AND concat(' ',bp) LIKE :esign_R #".__LINE__;
		$this->do_suggest( $sql, $sql_parameters );

		if ( !$this->num_results ) {
			$sql  = " SELECT prime as result, symbol FROM primes $this->WHERE (concat(' ',prime) LIKE :right1 OR concat(' ',singular_plural) LIKE :right2) #".__LINE__;
			$this->do_suggest( $sql, array( ":right1" => "% " . $right . "%", ":right2" => "% " . $right . "%" ) );

			$sql_parameters = Misc::get_middle_parameters();
			$sql_parameters[":right"] = "% " . $right . "%";
			$sql  = " SELECT bp as result FROM bps $this->WHERE $middle_sql_AND concat(' ',prime) LIKE :right #".__LINE__;
			$this->do_suggest( $sql, $sql_parameters );

			$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND concat(' ',prime) LIKE :right #".__LINE__;
			$this->do_suggest( $sql, array( ":left" => "% " . $left . " %", ":right" => "% " . $right . "%" ) );
		}
		return $this->setResponse(__LINE__);
	}

	function prime_esign(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');
		$tmp = trim($this->url_query,"+");
		$sql  = " SELECT bp as result FROM bps $this->WHERE prime = :esign_L AND bp LIKE :esign_R AND bp <> '$tmp' #".__LINE__;
		$this->do_suggest($sql,array(":esign_L" => Misc::$esign_L, ":esign_R" => Misc::$esign_R."%"));
//		$sql = str_replace(":esign_L", "'".Misc::$esign_L."'", $sql);
//		$sql = str_replace(":esign_R", "'".Misc::$esign_R."%'", $sql);
//		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() \$sql = $sql");

		$sql  = " SELECT bp as result FROM bps $this->WHERE prime = :esign_L AND concat(' ',bp) LIKE :esign_R AND bp <> '$tmp' #".__LINE__;
		$this->do_suggest($sql,array(":esign_L" => Misc::$esign_L, ":esign_R" => "% ".Misc::$esign_R."%"));
//		$sql = str_replace(":esign_L", "'".Misc::$esign_L."'", $sql);
//		$sql = str_replace(":esign_R", "'% ".Misc::$esign_R."%'", $sql);
//		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() \$sql = $sql");

		return $this->setResponse(__LINE__);
	}


// ONE *********************************************************************

	function one_word_no_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => $this->url_query."%"));
		$sql = str_replace(":url_query", "'".$this->url_query."%'", $sql);
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() \$sql = $sql");

		$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => "% ".$this->url_query));

		return $this->setResponse(__LINE__);
	}

	function one_word_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

 		$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => $this->url_query." %"));

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(bp,' ') LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => "% ".$this->url_query." "));

		return $this->setResponse(__LINE__);
	}

	function one_word_expand(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

 		$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => $this->url_query." %"));

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(bp,' ') LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => "% ".$this->url_query." "));

		return $this->setResponse(__LINE__);
	}


	function one_word_prime_no_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		if ( ! $this->num_results ) {
			$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',prime) LIKE :url_query #".__LINE__;
			$this->do_suggest($sql,array(":url_query" => ' '.$this->url_query));

			$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
			$this->do_suggest($sql,array(":url_query" => $this->url_query."%"));

			$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
			$this->do_suggest($sql,array(":url_query" => "% ".$this->url_query));
		}

		return $this->setResponse(__LINE__);
	}

	function one_word_prime_expand(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(prime,' ') LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => $this->url_query." %"));

		return $this->setResponse(__LINE__);
	}

	function one_word_prime_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

 		$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => Misc::debrace($this->url_query)." %"));

		return $this->setResponse(__LINE__);
	}

// TWO *********************************************************************

	function two_word_no_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE bp LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => $this->url_query . "%"));
		if ( ! $this->num_results ) {
			$sql  = " SELECT prime as result, symbol FROM primes $this->WHERE (concat(' ',prime) LIKE :right1 OR concat(' ',singular_plural) LIKE :right2) #".__LINE__;
			$this->do_suggest( $sql, array( ":right1" => "% " . $right . "%", ":right2" => "% " . $right . "%" ) );

			$sql  = " SELECT bp as result FROM bps $this->WHERE (concat(' ',prime) LIKE :right1 OR concat(' ',singular_plural) LIKE :right2) #".__LINE__;
			$this->do_suggest( $sql, array( ":right1" => "% " . $right . "%", ":right2" => "% " . $right . "%" ) );
		}
		return $this->setResponse(__LINE__);
	}

	function two_word_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :url_query1 AND concat(' ',bp,' ') LIKE :url_query2 #".__LINE__;
		$this->do_suggest($sql,array(":url_query1" => "% " . $left . " %", ":url_query2" => "% " . $right . " %"));
		return $this->setResponse(__LINE__);
	}

	function two_word_expand(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :url_query1 AND concat(' ',bp,' ') LIKE :url_query2 #".__LINE__;
		$this->do_suggest($sql,array(":url_query1" => "% " . $left . " %", ":url_query2" => "% " . $right . " %"));
		return $this->setResponse(__LINE__);
	}

	function two_word_prime_no_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(bp,' ') LIKE :url_query #".__LINE__;
		$this->do_suggest($sql,array(":url_query" => Misc::debrace($this->url_query)."%"));
		return $this->setResponse(__LINE__);
	}

	function two_word_prime_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(prime,' ') LIKE :prime AND concat(' ',bp,' ') LIKE :rest_prime #".__LINE__;
		if($this->multi_prime) $this->do_suggest($sql,array(":prime" => $this->prime." %", ":rest_prime" => $this->rest_prime.' %'));
		else $this->do_suggest($sql,array(":prime" => $this->full_prime." %", ":rest_prime" => $this->rest_prime.' %'));

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :url_query1 AND concat(' ',bp,' ') LIKE :url_query2 #".__LINE__;
		$this->do_suggest($sql,array(":url_query1" => "% " . $left . " %", ":url_query2" => "% " . $right . " %"));
		return $this->setResponse(__LINE__);
	}

	function two_word_prime_expand(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(prime,' ') LIKE :prime AND concat(' ',bp,' ') LIKE :rest_prime #".__LINE__;
		if($this->multi_prime) $this->do_suggest($sql,array(":prime" => $this->prime." %", ":rest_prime" => $this->rest_prime.' %'));
		else $this->do_suggest($sql,array(":prime" => $this->full_prime." %", ":rest_prime" => $this->rest_prime.' %'));

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :url_query1 AND concat(' ',bp,' ') LIKE :url_query2 #".__LINE__;
		$this->do_suggest($sql,array(":url_query1" => "% " . $left . " %", ":url_query2" => "% " . $right . " %"));
		return $this->setResponse(__LINE__);
	}



// THREE *********************************************************************

	function three_or_more_word_no_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );
		$middle_words = Misc::middle_words( $this->url_query );
		$middle_sql_AND = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();
		$sql_parameters[":left"] = $left . " %";
		$sql_parameters[":right"] = "% " . $right . "%";

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND $middle_sql_AND concat(' ',bp) LIKE :right #".__LINE__;
		$this->do_suggest( $sql, $sql_parameters );

		if ( !$this->num_results ) {
			$sql  = " SELECT prime as result, symbol FROM primes $this->WHERE (concat(' ',prime) LIKE :right1 OR concat(' ',singular_plural) LIKE :right2) #".__LINE__;
			$this->do_suggest( $sql, array( ":right1" => "% " . $right . "%", ":right2" => "% " . $right . "%" ) );

			$sql_parameters = Misc::get_middle_parameters();
			$sql_parameters[":right"] = "% " . $right . "%";
			$sql  = " SELECT bp as result FROM bps $this->WHERE $middle_sql_AND concat(' ',prime) LIKE :right #".__LINE__;
			$this->do_suggest( $sql, $sql_parameters );

			$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND concat(' ',prime) LIKE :right #".__LINE__;
			$this->do_suggest( $sql, array( ":left" => "% " . $left . " %", ":right" => "% " . $right . "%" ) );
		}
		return $this->setResponse(__LINE__);
	}

//
	function three_or_more_word_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );
		$middle_words = Misc::middle_words( $this->url_query );
		$middle_sql = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND $middle_sql concat(' ',bp,' ') LIKE :right #".__LINE__;
		$sql_parameters[":left"] = "% " . $left . " %";
		$sql_parameters[":right"] = "% " . $right . " %";
		$this->do_suggest($sql,$sql_parameters);
		return $this->setResponse(__LINE__);
	}

	function three_or_more_word_expand(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );
		$middle_words = Misc::middle_words( $this->url_query );
		$middle_sql = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND $middle_sql concat(' ',bp,' ') LIKE :right #".__LINE__;
		$sql_parameters[":left"] = "% " . $left . " %";
		$sql_parameters[":right"] = "% " . $right . " %";
		$this->do_suggest($sql,$sql_parameters);
		return $this->setResponse(__LINE__);
	}

	function three_or_more_word_prime_no_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");
		$es = $f3->get('ESIGN');

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(prime,' ') LIKE :prime AND concat(' ',bp) LIKE :rest_prime #".__LINE__;
		if($this->multi_prime) $this->do_suggest($sql,array(":prime" => $this->prime." %", ":rest_prime" => $this->rest_prime."%"));
		else $this->do_suggest($sql,array(":prime" => $this->full_prime." %", ":rest_prime" => $this->rest_prime."%"));

		$middle_words = Misc::middle_words( $this->url_query );
		$middle_sql = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND $middle_sql concat(' ',bp) LIKE :right #".__LINE__;
		$sql_parameters[":left"] = "% " . $left . " %";
		$sql_parameters[":right"] = "% " . $right . "%";
		$this->do_suggest($sql,$sql_parameters);
		return $this->setResponse(__LINE__);
	}

//
	function three_or_more_word_prime_space(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(prime,' ') LIKE :prime AND concat(' ',bp,' ') LIKE :rest_prime #".__LINE__;
		if($this->multi_prime) $this->do_suggest($sql,array(":prime" => $this->prime." %", ":rest_prime" => $this->rest_prime.' %'));
		else $this->do_suggest($sql,array(":prime" => $this->full_prime." %", ":rest_prime" => $this->rest_prime.' %'));

		$middle_words = Misc::middle_words( $this->url_query );
		$middle_sql = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND $middle_sql concat(' ',bp,' ') LIKE :right #".__LINE__;
		$sql_parameters[":left"] = "% " . $left . " %";
		$sql_parameters[":right"] = "% " . $right . " %";
		$this->do_suggest($sql,$sql_parameters);
		return $this->setResponse(__LINE__);
	}

	function three_or_more_word_prime_expand(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		$right = Misc::right_word( $this->url_query );
		$left = Misc::left_word( $this->url_query );

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(prime,' ') LIKE :prime AND concat(' ',bp,' ') LIKE :rest_prime #".__LINE__;
		if($this->multi_prime) $this->do_suggest($sql,array(":prime" => $this->prime." %", ":rest_prime" => $this->rest_prime.' %'));
		else $this->do_suggest($sql,array(":prime" => $this->full_prime." %", ":rest_prime" => $this->rest_prime.' %'));

		$middle_words = Misc::middle_words( $this->url_query );
		$middle_sql = Misc::get_middle_sql($middle_words);
		$sql_parameters = Misc::get_middle_parameters();

		$sql  = " SELECT bp as result FROM bps $this->WHERE concat(' ',bp,' ') LIKE :left AND $middle_sql concat(' ',bp,' ') LIKE :right #".__LINE__;
		$sql_parameters[":left"] = "% " . $left . " %";
		$sql_parameters[":right"] = "% " . $right . " %";
		$this->do_suggest($sql,$sql_parameters);
		return $this->setResponse(__LINE__);
	}


	function get_prime_vars(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ".__CLASS__."->".__FUNCTION__."() initialized");

		// First check if there is a + sign
		if(Misc::$esign_L){
		// Then check if the left is a prime
			$sql  = " SELECT prime FROM primes $this->WHERE prime = :url_query #".__LINE__;
			$result = $f3->get('DB')->exec($sql,array(":url_query" => Misc::$esign_L));
			if (DEBUG) $f3->get('FP')->log(__LINE__.': '.$f3->get('DB')->log()." mysql_num_rows=".count($result));
			if(count($result)){
				$this->e_prime = $result[0]['prime'];
				return true;
			}
			$sql  = " SELECT bp, prime, bp_is_a_prime FROM bps $this->WHERE bp = :url_query #".__LINE__;
			$result = $f3->get('DB')->exec($sql,array(":url_query" => Misc::$esign_L));
			if (DEBUG) $f3->get('FP')->log(__LINE__.': '.$f3->get('DB')->log()." mysql_num_rows=".count($result));
			if(count($result)){
				$this->e_bp = $result[0]['bp'];
				$this->e_prime = $result[0]['prime'];
				return true;
			}
		}
		$sql_addition="";
		if( strpos($this->url_query,"(") !== false AND strpos($this->url_query,")") !== false AND strpos($this->url_query,"(") < strpos($this->url_query,")") ) {
			$potential_prime = substr($this->url_query, 0, strpos($this->url_query, ")")+1);
			$prime_field = "prime";
		}
		else {
			$potential_prime = trim(substr($this->url_query, 0, strpos($this->url_query." ", " ")+1));
			$prime_field = "aux_list";
		}
		$sql  = " SELECT aux_list, prime, singular_plural FROM primes $this->WHERE $prime_field = :url_query #".__LINE__;
		$result = $f3->get('DB')->exec($sql,array(":url_query" => $this->url_query));
		if (DEBUG) $f3->get('FP')->log(__LINE__.': '.$f3->get('DB')->log()." mysql_num_rows=".count($result));

		if(count($result) == 0 AND $this->url_query <> $potential_prime ) {
			$sql    = " SELECT aux_list, prime, singular_plural FROM primes $this->WHERE $prime_field = :potential_prime $sql_addition #".__LINE__;
			$result = $f3->get('DB')->exec($sql,array(":potential_prime" => $potential_prime));
			if (DEBUG) $f3->get('FP')->log(__LINE__.': '.$f3->get('DB')->log()." mysql_num_rows=".count($result));
		}

		if(count($result) == 0) {
			if( strlen($this->url_query) < $this->min_query_letters ){
				Misc::$no_suggestions=QUERY_TOO_SHORT;
				$this->setResponse(__LINE__);
				if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() url_query_no_letters < $this->min_query_letters");
				return Misc::quit_suggest(__LINE__);
			}
			$this->prime = false;
			$this->full_prime = false;
			$this->debraced_prime = false;
			$this->multi_prime = false;
			$this->rest_prime = false;
			$this->singular_prime = false;
		}
		elseif(count($result) == 1) {
			$this->prime = $result[0]['prime'];
			$this->full_prime = $result[0]['prime'];
			if (Misc::has_brackets($this->full_prime))
				$this->debraced_prime = $this->prime = trim($result[0]['aux_list']);
			$this->multi_prime = false;
			$this->rest_prime = trim(substr($this->url_query, strlen($this->full_prime)));
			if( strpos($this->rest_prime,"(") !== false AND strpos($this->rest_prime,")") !== false AND strpos($this->rest_prime,"(") < strpos($this->rest_prime,")") ) {
				$this->rest_prime = false;
			}
			$this->singular_prime = $result[0]['singular_plural'];
		}
		elseif(count($result) > 1) {
			$this->prime = $result[0]['aux_list'];
			$this->debraced_prime = trim($result[0]['aux_list']);
			$this->full_prime = $result[0]['prime'];
			$this->multi_prime = count($result);
			$this->rest_prime = trim(substr($this->url_query, strlen($this->full_prime)));
			if( strpos($this->rest_prime,"(") !== false AND strpos($this->rest_prime,")") !== false AND strpos($this->rest_prime,"(") < strpos($this->rest_prime,")") ) {
				$this->rest_prime = false;
			}
			$this->singular_prime = false;
		}

		if($this->rest_prime) $this->rest_prime = "% ".$this->rest_prime;
		if (DEBUG) $f3->get('FP')->log("prime = $this->prime");
		if (DEBUG) $f3->get('FP')->log("full_prime = $this->full_prime");
		if (DEBUG) $f3->get('FP')->log("singular_prime = $this->singular_prime");
		if (DEBUG) $f3->get('FP')->log("debraced_prime = $this->debraced_prime");
		if (DEBUG) $f3->get('FP')->log("multi_prime = $this->multi_prime");
		if (DEBUG) $f3->get('FP')->log("rest_prime = $this->rest_prime");
		return true;
	}

	function do_suggest($sql,$sql_paras,$result=false){
		if(!$result){
			$f3 = \Base::instance();
			$result = $f3->get('DB')->exec($sql,$sql_paras);
			$log = explode("#", $f3->get('DB')->log());
			$line = __LINE__;
			if(isset($log[1])) $line = $log[1];
			$log = $log[0];
			if (DEBUG) $f3->get('FP')->log("$line: $log num_rows=".count($result));
		}
		$this->num_results += count($result);
		Misc::set_ajax_suggestions( $result , $this->url_query );
	}

	function get_function_name(){
		if($this->e_bp) return "bp_esign";
		if($this->e_prime) return "prime_esign";

		$number = Misc::get_number_of_words($this->url_query);
		$w=array(1=>"one",2=>"two",3=>"three_or_more");
    if( ! isset($w[$number]) ) $w[$number] = $w[3];
    $function = $w[$number]. "_word";
    if ($this->prime) $function .= "_prime";
		if(Misc::$has_expansion_sign){
			$function .= "_expand";
		} else {
	    if( Misc::$url_trailing_space ) $function .= "_space"; else $function .= "_no_space";
    }
		return $function;
	}

	function prime_bp_matches(){
		$f3 = \Base::instance();
		if($this->e_bp) {
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized with e_bp set");
			if( ! Misc::$esign_R){
				$result[0]['result'] = $this->e_bp;
				$this->do_suggest("","",$result);
				if (DEBUG) $f3->get('FP')->log( "\$this->e_bp = $this->e_bp added to list");
			}
			return;
		}

		if($this->e_prime) {
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized with e_prime set");
			if( ! Misc::$esign_R){
				$result[0]['result'] = $this->e_prime;
				$this->do_suggest("","",$result);
				if (DEBUG) $f3->get('FP')->log( "\$this->e_prime = $this->e_prime added to list");
			}
			return;
		}
		$url_query = $this->url_query;
		if(Misc::$url_trailing_space OR Misc::$has_expansion_sign) {
			$sql  = " SELECT prime as result, symbol FROM primes $this->WHERE (concat(prime,' ') LIKE :query1 OR concat(singular_plural,' ') LIKE :query2) #".__LINE__;
			$this->do_suggest($sql,array(":query1" => $url_query.' %',":query2" => $url_query.' %'));
		} else {
			$sql  = " SELECT prime as result, symbol FROM primes $this->WHERE (prime LIKE :query1 OR singular_plural LIKE :query2) #".__LINE__;
			$this->do_suggest($sql,array(":query1" => $url_query.'%',":query2" => $url_query.'%'));
		}
	}

}
/*

TEST CASES


one_word_no_space

one_word_space

one_word_prime_no_space

one_word_prime_space


two_word_no_space

two_word_space

two_word_prime_no_space

two_word_prime_space


three_or_more_word_no_space

three_or_more_word_space

three_or_more_word_prime_no_space

three_or_more_word_prime_space


keep in mind inverted primes and bracketed primes as well as slashes 1/2 and qutes " (double) and ' (single)


these are some that I used already but they are just notes
AIR COMPRESSOR
JOBS IN
Pumps (Equipment)
moving (how to)
men's hat
1/2" Fittings
Bearing bush lubricants


*/
