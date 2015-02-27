<?php
class Prime {
	protected $str_suppliers 					  = "";
	protected $str_prime_definition   	= "";
	protected $str_prime_examples     	= "";
	protected $str_linked_items       	= "";
	protected $str_collective_items   	= "";
	protected $str_related_items      	= "";
	protected $SQL_PRIME_LIMIT					= "";
	protected	$SQL_BP_LIMIT							= "";
	protected $WHERE										= "";

	function __construct() {
		$f3 = \Base::instance();
		$this->SQL_PRIME_LIMIT					= $f3->get('SQL_PRIME_LIMIT');
		$this->SQL_BP_LIMIT							= $f3->get('SQL_BP_LIMIT');
		$this->WHERE										= $f3->get('WHERE');
	}

	function beforeRoute(){	}

	function afterroute(){ }

//
	function sync($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($params[0]) initialized");

		$url_parts = explode("/", $params[0]);
		// $url_parts[1]; // prime
		// $url_parts[2]; // beds
		$url_query_raw	= $url_parts[2];
		$url_query = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_query_raw));
		Database::connect();
		if ( ! $url_query = $this->get_prime_data($url_query) ){
			// PRIME SET BUT SUBMISSION NOT A PRIME
			$submit=array(
				'str_search_field'					=> $url_query_raw,
				'str_page_type'							=> $f3->get('str_page_type_prime'),
				'str_status_msg' 						=> $f3->get('str_status_msg_no_prime'),
				'str_instruction_in_field'	=> $f3->get('str_instruction_in_field'),
				'searchvalue'								=> '',
				);
			$this->render_page("body.htm","text/html",$submit);
			return;
		}
		$submit=array(
			'str_search_field'					=> '',
			'str_page_type'							=> $f3->get('str_page_type_prime'),
			'str_status_msg' 						=> sprintf($f3->get('str_status_msg_prime'), Misc::debracket($url_query)),
			'str_instruction_in_field'	=> $f3->get('str_instruction_in_field'),
			'str_prime_definition'			=> $this->str_prime_definition,
			'str_prime_examples'				=> $this->str_prime_examples,
			'str_linked_items'					=> $this->str_linked_items,
			'str_collective_items'			=> $this->str_collective_items,
			'str_related_items'					=> $this->str_related_items,
			'searchvalue'								=> $url_query,
			);
		$this->render_page("body.htm","text/html",$submit);
		return;
	}

//
	function submit_sync($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
	}

//
	function submit_ajax($f3, $params){
		// This function is called when the "GO" butten is clicked from the "prime" page
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($params[0]) initialized");
		$url_parts = explode("/", $params[0]);
		$url_parts[1]; // prime
		$url_parts[2]; // submit
		$url_prime_raw	= $url_parts[3];
		$url_query_raw	= $url_parts[4];


		$url_prime = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_prime_raw));
		$url_query = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_query_raw));

		if ($url_query <> $url_prime) return submit_ajax_bp($url_query,$url_prime);
		submit_ajax_prime($f3, $params);
	}

//


//


	function bp_page_sync(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		$this->home();
	}

	function bp_page_ajax(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		$this->home();
	}

//
	function suggest_ajax($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($params[0]) initialized");

		$url_parts = explode("/", $params[0]);
		$url_parts[1]; // "prime"
		$url_parts[2]; // "suggest"
		$url_prime_raw	= $url_parts[3];
		$url_query_raw	= $url_parts[4];


		$url_prime = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_prime_raw));
		$url_query = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_query_raw));

		$url_query_no_letters = strlen($url_query);

		if( $url_query_no_letters < 1 ) return Misc::quit_suggest(__LINE__,"url_query_no_letters < 1");
		// if( Misc::get_number_of_words($url_query) < 2 ) return Misc::quit_suggest(__LINE__,"get_number_of_words($url_query) < 2");

		$count = $this->suggest_get_number_of_bp_matches_from_prime($url_prime);

		// IF THERE ARE NO RESULTS IN THE BP TABLE
		if ( ! $count ){
			// THIS IS REALLY AN EXCEPTION AS WE SHOULD NOT HAVE PRIMES WITHOUT BPS IN THE SYSTEM
			return Misc::quit_suggest(__LINE__,"THERE ARE NO RESULTS IN THE BP TABLE FOR THIS PRIME");
		}

		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." \$url_query_raw ='$url_query_raw'");

		if(strpos($url_query_raw,'?') !== false) {
			$suggestions = $this->suggest_bp_for_wildcard($url_prime);
			if (! $suggestions) return Misc::quit_suggest(__LINE__,"suggest_bp_for_wildcard '?' no results");
			if (DEBUG) $f3->get('FP')->log( $suggestions );
			Misc::render_ajax_suggestions( $suggestions );
			return;
		}

		// IF THERE ARE RESULTS BUT NOT TOO MANY WE USE THIS
		elseif ($count < 30 && $count > 0){
			$suggestions = $this->suggest_bp_for_prime_page($url_prime);
			if (! $suggestions) return Misc::quit_suggest(__LINE__,"suggest_bp_for_prime_page no results");
		}

		// IF TOO MANY RESULTS AND 2 WORD BP
		elseif ($count >= 30 and Misc::get_number_of_words($url_query) < 2) {
			$suggestions = $this->suggest_bp_for_prime_page_from_1_word_query($url_prime, $url_query);
			if (! $suggestions) return Misc::quit_suggest(__LINE__,"suggest_bp_for_prime_page_from_1_word_query no results");
		}

		// IF TOO MANY RESULTS AND 3 OR MORE WORDS
		elseif ($count >= 30 and Misc::get_number_of_words($url_query) >= 2) {
			$suggestions = $this->suggest_bp_for_prime_page_from_2_or_more_word_query($url_prime, $url_query);
			if (! $suggestions) return Misc::quit_suggest(__LINE__,"suggest_bp_for_prime_page_from_2_or_more_word_query no results");
		}

		if (! $suggestions ) return Misc::quit_suggest(__LINE__,"NO RESULT");
		Misc::render_ajax_suggestions( $suggestions );
	}


	function suggest_bp_page_ajax($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($params[0]) initialized");
		if (DEBUG) $f3->get('FP')->log( $params );

		$url_parts = explode("/", $params[0]);
		$url_ptype_raw	= $url_parts[1];
		$url_prime_raw	= $url_parts[2];
		$url_query_raw	= $url_parts[3];


		$url_query = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_query_raw));
		$url_prime = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_prime_raw));
		$url_ptype = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_ptype_raw));

		$url_query_no_letters = strlen($url_query);

		// WE ARE SUGGESTING FOR THE BP SUPPLIER PAGE

		// NOT YET IMPLEMETED

		return Misc::quit_suggest(__LINE__,"SUGGESTING FOR THE BP SUPPLIER PAGE - NOT YET IMPLEMETED");

		if (! $suggestions ) return Misc::quit_suggest(__LINE__,"NO RESULT");
		Misc::render_ajax_suggestions( $suggestions );
	}

	function suggest_bp_page_sync($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
	}

	function suggest_bp_for_wildcard($url_prime){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		Database::connect();
//		$sql  = " SELECT display_bp as result FROM b $this->WHERE number_words = 2 AND prime = :url_prime ";
		$sql  = " SELECT display_bp as result FROM b $this->WHERE prime = :url_prime ";
		$sql .= " $this->SQL_BP_LIMIT";
		$sql_paras[':url_prime']=$url_prime;
		$sql = array($sql,$sql_paras);
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log()." mysql_num_rows=".count($result));
		if (count($result) ) {
			Misc::set_onSearchStart('Searching... '.__LINE__);
			Misc::set_onSearchComplete('Select your item ' .__LINE__);
			Misc::set_onSelect('Press "Space" to expand ' . __LINE__);
			Misc::set_searchSubmit('Finding suppliers... '.__LINE__);
		} else {
			Misc::set_onSearchStart('Searching... '.__LINE__);
			Misc::set_onSearchComplete('No results. Use ? for list ' .__LINE__);
			Misc::set_onSelect('No further options to display' . __LINE__);
			Misc::set_searchSubmit('Finding suppliers... '.__LINE__);
		}
		$f3->set('str_return_type','BP');
		Misc::set_taconite_message();
		return $result;
	}

	function suggest_bp_for_prime_page_from_1_word_query($url_prime, $url_query){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		// if ( strpos($url_query, " ") == false ) return Misc::quit_suggest(__LINE__,"No space in $url_query");
		Database::connect();
		$Tspace = Misc::get_trailing_space($url_query);
		$number_words=0;
		$AND_like="";
		$debracketed_prime = Misc::debracket($url_prime);
		$tmp_array = explode(" ", $url_query);
		$sql_paras=array();
		foreach($tmp_array as $like_param){
			$like_param = trim($like_param);
			if (! $like_param) continue;
			$number_words++;
			$AND_likeIn .= " AND RIGHT (bp, LENGTH(bp)-LENGTH('$debracketed_prime'))  LIKE :likeIn$number_words ";
			$AND_like   .= " AND bp LIKE :like$number_words ";
			//	$AND_like   .= " AND concat(' ',bp) LIKE :like$number_words ";
			$sql_paras[":likeIn$number_words"]="% $like_param$Tspace%";
			$sql_paras[":like$number_words"]  ="$like_param$Tspace%";
		}
		$sql  = " SELECT display_bp as result FROM b $this->WHERE prime = :url_prime AND (";
//		$sql  = " SELECT display_bp as result FROM b $this->WHERE number_words = 2 AND prime = :url_prime AND (";
		$sql .= "   ( inverted = 'no' $AND_like ) ";
		$sql .= "   OR ";
		$sql .= "   ( inverted = 'yes' $AND_likeIn ) ";
		$sql .= " )	$this->SQL_BP_LIMIT";
		$sql_paras[':url_prime']=$url_prime;
		$sql = array($sql,$sql_paras);
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log()." mysql_num_rows=".count($result));
		if (count($result) ) {
			Misc::set_onSearchStart('Searching... '.__LINE__);
			Misc::set_onSearchComplete('Select your item ' .__LINE__);
			Misc::set_onSelect('Press "Space" to expand ' . __LINE__);
			Misc::set_searchSubmit('Finding suppliers... '.__LINE__);
		} else {
			Misc::set_onSearchStart('Searching... '.__LINE__);
			Misc::set_onSearchComplete('No results. Use ? for list ' .__LINE__);
			Misc::set_onSelect('No further options to display' . __LINE__);
			Misc::set_searchSubmit('Finding suppliers... '.__LINE__);
		}
		$f3->set('str_return_type','BP');
		Misc::set_taconite_message();
		return $result;
	}

	function suggest_bp_for_prime_page_from_2_or_more_word_query($url_prime, $url_query){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		// if ( strpos($url_query, " ") == false ) return Misc::quit_suggest(__LINE__,"No space in $url_query");
		Database::connect();
		$Tspace = Misc::get_trailing_space($url_query);
		$number_words=0;
		$AND_like="";
		$debracketed_prime = Misc::debracket($url_prime);
		$tmp_array = explode(" ", $url_query);
		$sql_paras=array();
		foreach($tmp_array as $like_param){
			$like_param = trim($like_param);
			if (! $like_param) continue;
			$number_words++;
			$AND_likeIn .= " AND RIGHT (bp, LENGTH(bp)-LENGTH('$debracketed_prime'))  LIKE :likeIn$number_words ";
			$AND_like   .= " AND bp LIKE :like$number_words ";
			//	$AND_like   .= " AND concat(' ',bp) LIKE :like$number_words ";
			$sql_paras[":likeIn$number_words"]="%$like_param%";
			$sql_paras[":like$number_words"]  ="%$like_param%";
		}
		$sql  = " SELECT display_bp as result FROM b $this->WHERE prime = :url_prime AND (";
		$sql .= "   ( inverted = 'no' $AND_like ) ";
		$sql .= "   OR ";
		$sql .= "   ( inverted = 'yes' $AND_likeIn ) ";
		$sql .= " )	$this->SQL_BP_LIMIT";
		$sql_paras[':url_prime']=$url_prime;
		$sql = array($sql,$sql_paras);
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log()." mysql_num_rows=".count($result));
		if (count($result) > 2) {
			Misc::set_onSearchStart('Searching... '.__LINE__);
			Misc::set_onSearchComplete('Select your item ' .__LINE__);
			Misc::set_onSelect('Press "Space" to expand ' . __LINE__);
			Misc::set_searchSubmit('Finding suppliers... '.__LINE__);
		}	else {
			Misc::set_onSearchStart('Searching... '.__LINE__);
			Misc::set_onSearchComplete('No further options to display ' .__LINE__);
			Misc::set_onSelect('' . __LINE__);
			Misc::set_searchSubmit('Finding suppliers... '.__LINE__);
			Misc::set_str_status_msg_right();
		}
		$f3->set('str_return_type','BP');
		Misc::set_taconite_message();
		return $result;
	}

	function suggest_get_number_of_bp_matches_from_prime($url_prime,$counted = false){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		Database::connect();
		if ($counted) $number_words_in_prime_plus_1 = Misc::get_number_of_words( Misc::debracket($url_prime) ) + 1;
		$sql =	"SELECT count(*) as count FROM b ".
						"$this->WHERE prime = :url_prime ";
		if ($counted) $sql .=
						"AND number_words <= $number_words_in_prime_plus_1";
		$sql = array( $sql, array(':url_prime' => $url_prime));
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log()." count=".$result[0]["count"]);
		return $result[0]["count"];
	}

	function suggest_bp_for_prime_page($url_prime, $counted = false){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		Database::connect();
		if ($counted) $number_words_in_prime_plus_1 = Misc::get_number_of_words( Misc::debracket($url_prime) ) + 1;
		$sql = 	"SELECT display_bp as result FROM b ".
						"$this->WHERE prime = :url_prime ";
		if ($counted) $sql .=
						"AND number_words <= $number_words_in_prime_plus_1 ";
		$sql = array( $sql, array(':url_prime' => $url_prime));
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log()." mysql_num_rows=".count($result));
		return $result;
	}
}
