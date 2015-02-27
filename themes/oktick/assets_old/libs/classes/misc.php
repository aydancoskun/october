<?php
class Misc {

	static protected $taconite_eval = "";
	static protected $taconite_messasge ="";
	static $suggestions = array();
	static $sql_parameters = array();
	static $url_trailing_space = false;
	static $has_expansion_sign = false;
	static $url_contains_space = false;
	static $no_suggestions = 0;
	static $esign_R = "";
	static $esign_L = "";

	function remove_prime_from_definition($str_display_form_prime){
		if(strtolower(substr($this->str_prime_definition,0,strlen($str_display_form_prime)) ) == strtolower($str_display_form_prime))
			$this->str_prime_definition = substr($this->str_prime_definition,strlen($str_display_form_prime));
		if(substr($this->str_prime_definition,0,1) == ":")
			$this->str_prime_definition = substr($this->str_prime_definition,1);
	}

	function err404() {
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$params[0]') not implemented");
		$f3->error(404);
	}

	static function get_onclick_functions($hrefurl){
		$onlick  = 'history.pushState({},"","' . $hrefurl . '");';
		$onlick .= '$.get("' . $hrefurl . '");';
		$onlick .= "return false;";
		return "";
		return $onlick;
	}

	static function set_ajax_suggestions( $suggestions , $url_query = '', $field_to_extract = 'result' ){
		$f3 = \Base::instance();
		if( ! count($suggestions)) return;
		//if(DEBUG) \Base::instance()->get('FP')->log(__LINE__.": \$suggestions=");
		//if(DEBUG) \Base::instance()->get('FP')->log($suggestions);
		$suggestions = self::format_sql_result_array($suggestions, $field_to_extract);
		//if(DEBUG) \Base::instance()->get('FP')->log(__LINE__.": \$suggestions=");
		//if(DEBUG) \Base::instance()->get('FP')->log($suggestions);
		$suggestions = self::sort_array_with_sort_match_on_top($suggestions, $url_query);
		//if(DEBUG) \Base::instance()->get('FP')->log(__LINE__.": \$suggestions=");
		//if(DEBUG) \Base::instance()->get('FP')->log($suggestions);
		self::$suggestions = array_merge(self::$suggestions,$suggestions);
		self::$no_suggestions = count(self::$suggestions);
		if(DEBUG) $f3->get('FP')->log(__LINE__.": no_suggestions =".self::$no_suggestions);
		if(DEBUG) \Base::instance()->get('FP')->log(__LINE__.": \$suggestions=");
		if(DEBUG) \Base::instance()->get('FP')->log($suggestions);
	}

	static function render_ajax_suggestions( ){
		if(DEBUG) \Base::instance()->get('FP')->log(__LINE__.": num_results_returned=".self::$no_suggestions);
		self::$suggestions[] = self::suggest_get_taconite();
		header("Content-type: application/json"); //makes sure entities are not interpreted
		echo self::suggest_json_encode(self::$suggestions);
		return false;
	}

	static function format_sql_result_array($f3_sql_response_array, $field_to_extract){
		foreach ($f3_sql_response_array as $result_array) {
			if(isset($result_array['symbol'])){
				$tmp = utf8_encode(htmlspecialchars($result_array[$field_to_extract]));
				$sym = $result_array['symbol'];
				$results[strtolower($tmp.$sym)]=$tmp.$sym;
			} else {
				$tmp = utf8_encode(htmlspecialchars($result_array[$field_to_extract]));
				$results[strtolower($tmp)]=$tmp;
			}
		}
		return $results;
	}

	static function sort_array_with_sort_match_on_top($array,$sort_match){
	return $array;
		if( ! is_array($array)) return $array;
		if( ! ksort($array)) return $array;
		$sort_match = strtolower($sort_match);
		if(DEBUG) \Base::instance()->get('FP')->log(__LINE__.": \$sort_match=$sort_match");

		if (isset($array[$sort_match])){
			$val = $array[$sort_match];

//			$space_pos = strpos(trim($val)," ");
//			if( $space_pos === false )
//				unset($array[$sort_match]);

			if( ! self::$url_trailing_space AND ! self::$has_expansion_sign){
				$array = array_reverse($array, true);
				$array[strtolower($val)] = $val;
				$array = array_reverse($array, true);
			}
		}
		return $array;
	}

	static function set_taconite_message($javascript = false){
//		$f3 = \Base::instance();
		self::$taconite_eval = "<eval><![CDATA[";
/*
  	if (DEBUG) {
			self::$taconite_eval .=	"$('#str_debug_msg').html(''";
			foreach ($f3->hive() as $key => $val ){
				if (substr($key, 0, 4) <> "str_") continue;
//				if (DEBUG) $f3->get('FP')->log(__CLASS__."->".__FUNCTION__."() '$key = $val<br />'");
				self::$taconite_eval .=	"+ '$key = ".htmlentities ( $val, ENT_COMPAT, "UTF-8" )."<br />'";
			}
			self::$taconite_eval .=	");";
		}
*/
		self::$taconite_eval .= self::$taconite_messasge;
		self::$taconite_eval .= $javascript;
		self::$taconite_eval .= "]]></eval>";
	}

	static function set_onSearchStart($leftmsg = false, $ritemsg = false){
		//if( ! DEBUG) $ritemsg = false;
		$leftmsg = str_replace( " ", "&nbsp;", htmlspecialchars($leftmsg));
		$ritemsg = str_replace( " ", "&nbsp;", $ritemsg);
		self::$taconite_messasge .= "$('#str_status_msg_onSearchStart').html('$leftmsg');";
		self::$taconite_messasge .= "$('#str_status_msg_onSearchStart_R').html('$ritemsg');";
	}

	static function set_onSearchComplete($leftmsg = false, $ritemsg = false){
		//if( ! DEBUG) $ritemsg = false;
		$leftmsg = str_replace( " ", "&nbsp;", htmlspecialchars($leftmsg));
		$ritemsg = str_replace( " ", "&nbsp;", $ritemsg);
		self::$taconite_messasge .= "$('#str_status_msg_onSearchComplete').html('$leftmsg');";
		self::$taconite_messasge .= "$('#str_status_msg_onSearchComplete_R').html('$ritemsg');";
	}

	static function set_onSelect($leftmsg = false, $ritemsg = false){
		//if( ! DEBUG) $ritemsg = false;
		$leftmsg = str_replace( " ", "&nbsp;", htmlspecialchars($leftmsg));
		$ritemsg = str_replace( " ", "&nbsp;", $ritemsg);
		self::$taconite_messasge .= "$('#str_status_msg_onSelect').html('$leftmsg');";
		self::$taconite_messasge .= "$('#str_status_msg_onSelect_R').html('$ritemsg');";
	}

	static function set_searchSubmit($leftmsg = false, $ritemsg = false){
		//if( ! DEBUG) $ritemsg = false;
		$leftmsg = str_replace( " ", "&nbsp;", htmlspecialchars($leftmsg));
		$ritemsg = str_replace( " ", "&nbsp;", $ritemsg);
		self::$taconite_messasge .= "$('#str_status_msg_searchSubmit').html('$leftmsg');";
		self::$taconite_messasge .= "$('#str_status_msg_searchSubmit_R').html('$ritemsg');";
	}

	static function get_trailing_space($url_query){
		if ( substr($url_query, -1) == " ") {
			return " ";
		} else {
			return "";
		}
	}

	static function get_number_of_words($string){
		static $number_words=0, $string_checked="";
		if( $string == $string_checked ) return $number_words;
		$string_checked = $string;
		$string = self::debrace($string);
		$tmp_array = explode(" ", trim($string));
		$number_words = 0;
		foreach($tmp_array as $param){
			if (! $param) continue;
			$number_words++;
		}
		return $number_words;
	}

	static function oktick_clean_url($query){
		$query = rawurldecode($query);
		$query = str_replace("%", "", $query);
		$query = str_replace("-", " ", $query);
		//$query = strtolower($query);
		$query = ltrim($query);
		// remove all double spaces
		while (strpos($query, "  ")) $query = str_replace("  ", " ", $query);
		return $query;
	}

	static function strip_incorrect_chars($str_to_strip){
		$str_to_strip = str_replace("-", " ", $str_to_strip);
		$str_to_strip = str_replace("?", " ", $str_to_strip);
		$str_to_strip = str_replace("!", " ", $str_to_strip);
		$str_to_strip = str_replace(";", " ", $str_to_strip);
		$str_to_strip = str_replace(",", " ", $str_to_strip);
		$str_to_strip = str_replace(".", " ", $str_to_strip);
		$str_to_strip = str_replace("&", " ", $str_to_strip);
		$str_to_strip = str_replace(":", " ", $str_to_strip);
		$str_to_strip = str_replace("™", "",  $str_to_strip);// TRADEMARK
		$str_to_strip = str_replace("℠", "",  $str_to_strip);// SERVICEMARK
		$str_to_strip = str_replace("®", "",  $str_to_strip);// REGISTERED TRADEMARK
		$str_to_strip = str_replace("©", "",  $str_to_strip);// COPYRIGHT
		return $str_to_strip;
	}

	static function debrace($str){
		if( strpos($str,"(") !== false AND strpos($str,")") !== false AND strpos($str,"(") < strpos($str,")") ) {
			$str = preg_replace("|\([^)]+\)|","",$str);
		}
//		$left_bracket_pos = strpos($string,'(');
//		$rite_bracket_pos = strpos($string,')');
//		if($left_bracket_pos and $rite_bracket_pos and $left_bracket_pos < $rite_bracket_pos) return trim(substr($string, 0, $left_bracket_pos));
		return $str;
	}

	static function has_brackets($prime){
		if( strpos($prime,"(") === false OR strpos($prime,")") === false OR strpos($prime,"(") > strpos($prime,")") ) return false;
		else return true;
	}
	static function quit_suggest($line,$errmsg=""){
		if (DEBUG) \Base::instance()->get('FP')->log( __CLASS__."->".__FUNCTION__."('$errmsg'):$line");
		self::$suggestions[]=self::suggest_get_taconite();
		echo self::suggest_json_encode(self::$suggestions);
		//self::render_ajax_suggestions();
		return false;
	}

	static function suggest_get_taconite(){
		if (! self::$taconite_eval) self::set_taconite_message();
		$result = "<taconite>" . self::$taconite_eval . "</taconite>";
		$result = chunk_split($result, 5, ' ');
		$result = rawurlencode(utf8_encode($result));
		return $result;
	}

	static function suggest_json_encode($suggestions){
		// returns { "suggestions": ["United Arab Emirates", "United Kingdom", "United States"] }
		$return = '{"suggestions": [ ';
		foreach($suggestions as $item) {
			$return .='"'.$item.'",';
		}
		$return = substr($return,0,-1) . ']}';
		return $return;
	}

	static function get_root_url($url){
		$parsed_url = parse_url($url);
		if ( ! $parsed_url) return false;
		if( ! isset($parsed_url['scheme'])) $parsed_url['scheme'] = "http";
		if( ! isset($parsed_url['host'])) return false;
		$result_url = $parsed_url['host'];
		if($result_url) $result_url = $parsed_url['scheme']."://" . $result_url;
		return $result_url;
	}

	static function is_inverted($prime){
		$prepositions = array("about", "for", "from", "in", "of", "on", "to");
		if (in_array($prime, $prepositions)) return true;
		return false;
	}

	static function left_word($str){
		$str = trim(self::debrace($str));
		$str = trim(substr($str,0,strpos($str." ", " ")));
		return $str;
	}

	static function right_word($str){
		$str = trim(self::debrace($str));
		$str = trim(strtolower(substr($str,strrpos($str, " "))));
		return $str;
	}

	static function middle_words($str){
		$str = trim(self::debrace($str));
		while (strpos($str, "  ") !== false) $str = str_replace("  ", " ", $str);
		$words=array();
		$parts = explode(" ", $str);
		$c = 0;
		$total = count($parts);
//		if (DEBUG) \Base::instance()->get('FP')->log(__LINE__. ": total words = $total" );

		foreach ($parts as $part){
			$c++;
			if ($c == 1 or $c == $total) continue;
			$words[] = $part;
		}
		return $words;
	}

	static function get_middle_sql($middle_words){
		$qc=0;
		foreach ($middle_words as $word){
			$qc++;
			$sql .= " concat(' ',bp,' ') LIKE :url_query$qc AND "	;
			self::$sql_parameters[":url_query$qc"] = "% $word %";
		}
		return $sql;
	}

	static function get_middle_parameters(){
		return self::$sql_parameters;
	}

	static function set_url_variables($params){
		$f3 = \Base::instance();
		$url_query = trim($params[0],'/');
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Raw \$url_query = $url_query");
		$url_query = self::strip_incorrect_chars(self::oktick_clean_url($url_query));
		if(! $url_query) return "";
		$es = $f3->get('ESIGN');
		if ( substr( $url_query , -1 ) == " " ) self::$url_trailing_space = true;
		else self::$url_trailing_space = false;
		if ( strpos( $url_query , " " ) !== false ) self::$url_contains_space = true;
		else self::$url_contains_space = false;
		if ( strpos( $url_query , $es ) !== false){
			self::$has_expansion_sign = true;
			if (DEBUG) $f3->get('FP')->log( __LINE__.': "'.$es.'" detected');
			self::$esign_L = trim(substr($url_query, 0, strpos($url_query, $es)));
			self::$esign_R = trim(substr(str_replace("+", " ", $url_query), strpos($url_query, $es)+1));
			if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Misc::\$esign_L = ".self::$esign_L);
			if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Misc::\$esign_R = ".self::$esign_R);
			$url_query = trim(str_replace($es, " ", $url_query));
		}
		else self::$has_expansion_sign = false;
		$url_query = trim($url_query);
		if (DEBUG) $f3->get('FP')->log( __LINE__.": ". __CLASS__."->".__FUNCTION__."() Fix \$url_query = $url_query");
		return $url_query;
	}

	static function get_result_query($params){
		$f3 = \Base::instance();
		$url_query = trim($params[0],'/ ');
		$url_query = trim(self::strip_incorrect_chars(self::oktick_clean_url($url_query)));
		$url_query = substr($url_query, strpos($url_query, "/"));
		$url_query = trim($url_query,'/ ');
		if (DEBUG) $f3->get('FP')->log(__LINE__.': $url_query = "'.$url_query.'"');
		return $url_query;
	}

}
