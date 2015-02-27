<?php
class Bp {
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

	function err404() {
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
	}

	function submit_prime_page_sync($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
	}

	function submit_prime_page_ajax($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($params[0]) initialized");

		$url_parts = explode("/", $params[0]);
		$url_parts[1]; // prime
		$url_parts[2]; // submit
		$url_prime_raw	= $url_parts[3];
		$url_query_raw	= $url_parts[4];


		$url_prime = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_prime_raw));
		$url_query = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_query_raw));

		Database::connect();
		if ( ! $this->get_supplier_data($url_query,$url_prime) ){

			// bp invalid
			$f3->set('str_search_field',							$url_query );
			$f3->set('str_page_type',									$f3->get('str_page_type_prime'));
			$f3->set('str_status_msg',								$f3->get('str_status_msg_no_bp'));
			$f3->set('searchvalue',										'');
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."SUBMISSION NOT A VALID BP");
			$this->render_page("home_ajax.htm","text/xml",$submit);
			return;
		}
		$f3->set('str_prime_definition',					"" );
		$f3->set('str_prime_examples',						"" );
		$f3->set('str_linked_items',							"" );
		$f3->set('str_collective_items',					"" );
		$f3->set('str_related_items',							"" );
		$f3->set('str_search_field',							"" );

		if ($this->str_suppliers){

			// we found suppliers
			$f3->set('str_page_type',								$f3->get('str_page_type_sup') );
			$f3->set('str_status_msg',							$f3->get('str_status_msg_sup') . $url_query_raw );
			$f3->set('searchvalue',									$url_query );
			$f3->set('str_suppliers',								$this->str_suppliers );
		} else {

			// we found NO suppliers
			$f3->set('str_page_type',								$f3->get('str_page_type_bp') );
			$f3->set('str_status_msg',							$f3->get('str_status_msg_no_sup') . $url_query_raw);
			$f3->set('searchvalue',									$url_query );
			$f3->set('str_suppliers',								$this->str_suppliers );
		}
		$this->render_page("home_ajax.htm","text/xml",$submit);
		return;
	}

	function submit_bp_page_sync($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
	}

	function submit_ajax($f3, $params){
		// This function is called when the "GO" butten is clicked from the "bp" page
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($params[0]) initialized");
		return;
		$url_parts = explode("/", $params[0]);
		$url_ptype_raw	= $url_parts[1];
		$url_prime_raw	= $url_parts[2];
		$url_query_raw	= $url_parts[3];


		$url_query = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_query_raw));
		$url_prime = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_prime_raw));
		$url_ptype = Misc::strip_incorrect_chars(Misc::oktick_clean_url($url_ptype_raw));

		Database::connect();
		if ( ! $url_query = $this->get_prime_data($url_query) ){

			// PRIME SET BUT SUBMISSION NOT A PRIME
			$submit=array(
				'str_search_field'					=> $url_query_raw,
				'str_page_type'							=> $f3->get('str_page_type_search'),
				'str_status_msg' 						=> $f3->get('str_status_msg_no_prime'),
				'str_instruction_in_field'	=> $f3->get('str_instruction_in_field'),
				'searchvalue'								=> '',
				);
			$this->render_page("prime_ajax.htm","text/xml",$submit);
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
		$this->render_page("prime_ajax.htm","text/xml",$submit);
		return;
	}

	function render_page($template,$mime_type="text/html",$submit=array()){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$template') initialized");
		// PRIME SET AND VALID PRIME
		$submit['str_title']								= $f3->get('str_title');
		$submit['str_message']							= $f3->get('str_message');
		$debug="";
		foreach($submit as $key => $value){
			// $debug .= "$key=>'$value', ";
			$f3->set($key,$value);
		}
		// if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() $debug");
		echo Template::instance()->render($template,$mime_type);
	}

	function get_prime_data($prime){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");

		$str_display_form_prime = $prime;
		$prime = Misc::oktick_clean_url($prime);
		$prime = Misc::strip_incorrect_chars($prime);
		$sql = array("SELECT definition as def, examples as exa, prime as pri FROM p $this->WHERE LOWER(prime) = :prime ",array(':prime' => $prime));
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
		if(count($result) == 1){
			$this->str_prime_definition = $result[0]['def'];
			$this->str_prime_definition = htmlentities($this->str_prime_definition);
			$this->str_prime_examples = htmlentities($result[0]['exa']);
			$url_query = $result[0]['pri'];
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." Prime valid");

			// related items
			$sql = "SELECT ri FROM ( ";
			$sql.= "SELECT pr.related_item as ri FROM pr,p $this->WHERE pr.prime= :prime        AND pr.related_item=p.prime UNION ";
			$sql.= "SELECT pr.prime as ri        FROM pr,p $this->WHERE pr.related_item= :prime AND pr.prime=p.prime ";
			$sql.=  ') as mytable ORDER BY ri';
			$sql = array($sql,array(':prime' => $prime));
			$result = $f3->get('DB')->exec($sql[0],$sql[1]);
			if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
			foreach($result as $data){
				$related_item = $data['ri'];
				$related_url_item = urlencode($related_item);
				$hrefurl = "/$f3->get('str_page_type_prime')/$related_url_item";
				$onclick = Misc::get_onclick_functions($hrefurl);
				$this->str_related_items .= "<a href='$hrefurl' onclick='$onclick' >$related_item</a>, ";
			}
			if($this->str_related_items) {
				$this->str_related_items = substr($this->str_related_items, 0 , -2);
				if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." related items");
			}

			// collectives items
			$sql = array("SELECT collective FROM pc,p $this->WHERE pc.prime = :prime AND p.prime = collective ",array(':prime' => $prime));
			$result = $f3->get('DB')->exec($sql[0],$sql[1]);
			if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
			foreach($result as $data){
				$collective = $data['collective'];
				$collective_url_item = urlencode($collective);
				$hrefurl = "/" . $f3->get('str_page_type_prime') . "/$collective_url_item";
				$onclick = Misc::get_onclick_functions($hrefurl);
				$this->str_collective_items .= "<a href='$hrefurl' onclick='$onclick' >$collective</a>, ";
			}
			if($this->str_collective_items) {
				$this->str_collective_items = substr($this->str_collective_items, 0 , -2);
				if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." collectives");
			}

			// linked items
			$sql = array("SELECT linked FROM pl,p $this->WHERE pl.prime = :prime AND p.prime = linked ",array(':prime' => $prime));
			$result = $f3->get('DB')->exec($sql[0],$sql[1]);
			if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
			foreach($result as $data){
				$linked = $data['linked'];
				$linked_url_item = urlencode($linked);
				$hrefurl = "/" . $f3->get('str_page_type_prime') . "/$linked_url_item";
				$onclick = Misc::get_onclick_functions($hrefurl);
				$this->str_linked_items .= "<a href='$hrefurl' onclick='$onclick' >$linked</a>, ";
			}
			if($this->str_linked_items) {
				$this->str_linked_items = substr($this->str_linked_items, 0 , -2);
				if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." linked items");
			}
			return $url_query;
		}
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." Prime invalid");
		return false;
	}

	function get_supplier_data($bp, $prime){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."($bp, $prime) initialized");

		$str_display_form_prime = $prime;
		$prime = Misc::oktick_clean_url($prime);
		$prime = Misc::strip_incorrect_chars($prime);
		$bp = Misc::oktick_clean_url($bp);
		$bp = Misc::strip_incorrect_chars($bp);
		$sql = array(
					"SELECT c.company_name AS cname, c.company_website_url AS url, credit, c.uid, count(*) AS ccounter ".
					"FROM bs, c WHERE ".
					"bs.bp = :bp AND ".
					"bs.company_uid = c.uid AND ".
					"c.company_website_url <> '' ".
					"GROUP BY cname ".
					"ORDER BY	credit DESC, ccounter DESC LIMIT 10"
					,array(':bp' => $bp)
					);
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);

		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." bp suppliers");
		$this->str_suppliers = "";

		foreach($result as $data){
			$cuid = $data['cuid'];
			$cname = htmlspecialchars($data['cname']);
			$credit = $data['credit'];
			$ccounter = $data['ccounter'];
			$url = Misc::get_root_url($data['url']);
			$url_enc = urlencode($url);
			$onclick = Misc::get_onclick_functions($url_enc);
			if(!$credit) $credit = "0";
			$credit ="£".$credit;

			$this->str_suppliers .= "<p><a class='supplier-list' href='$url' onclick='$onclick' target='_blank'><span style='color:888'>$cname => $url => $credit.00 => $ccounter"."X</span></a></p>";
		}
		if ($this->str_suppliers){
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." suppliers");
			$this->str_suppliers = "<p><strong>Suppliers of $bp </strong></p>" . $this->str_suppliers ;
			return true;
		}
		$sql = array(
			"SELECT bp FROM b $this->WHERE LOWER(bp)= :bp AND LOWER(prime) = :prime AND ",
			array(':prime' => $prime, ':bp' => $bp),
			);
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if(count($result) == 1){
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." bp valid but no suppliers");
			return true;
		}
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." bp invalid");
		return false;
	}

	function prime_page_sync($f3, $params){
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

	function prime_page_ajax($f3, $params){ // /prime/beds/
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
			$this->render_page("prime_ajax.htm","text/xml",$submit);
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
		$this->render_page("prime_ajax.htm","text/xml",$submit);
		return;
	}

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

	function suggest_prime_page_ajax($f3, $params){
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

	function suggest_prime_page_sync($f3, $params){
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
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
