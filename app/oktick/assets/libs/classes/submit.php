<?php
class Submit {

	protected $str_suppliers			= "";
	protected $str_prime_definition   	= "";
	protected $str_prime_examples     	= "";
	protected $str_linked_items       	= "";
	protected $str_collective_items   	= "";
	protected $str_related_items      	= "";
	protected $WHERE					= "";
  	protected $str_suppliers_title       = "";


	function __construct() {
		$f3 = \Base::instance();
		$this->WHERE										= $f3->get('WHERE');
	}

	function beforeRoute(){	}

	function afterroute(){ }
/*

    <check if="{{ @str_related_items != false }}">
        <true>
            <show select="#str_related_items_tab" />
            <replaceContent select="#str_related_items">
                <p>{{ @str_related_items }}</p>
            </replaceContent>
        </true>
        <false>
            <hide select="#str_related_items_tab" />
        </false>
    </check>

    <check if="{{ @str_linked_items != false }}">
        <true>
            <show select="#str_linked_items_tab" />
            <replaceContent select="#str_linked_items">
                <p>{{ @str_linked_items }}</p>
            </replaceContent>
        </true>
        <false>
            <hide select="#str_linked_items_tab" />
        </false>
    </check>

    <check if="{{ @str_collective_items != false }}">
        <true>
            <show select="#str_collective_items_tab" />
            <replaceContent select="#str_collective_items">
                <p>{{ @str_collective_items }}</p>
            </replaceContent>
        </true>
        <false>
            <hide select="#str_collective_items_tab" />
        </false>
    </check>

    <check if="{{ @str_nicknames != false }}">
        <true>
            <show select="#str_nicknames_tab" />
            <replaceContent select="#str_nicknames">
                <p>{{ @str_nicknames }}</p>
            </replaceContent>
        </true>
        <false>
            <hide select="#str_nicknames_tab" />
        </false>
    </check>


*/




	function sync($f3, $params){
		echo $f3->get("BASE");
		exit;
		Misc::debug_function_start(__CLASS__,__FUNCTION__,"(This is called when someone hits 'search')");
		Database::connect();
		$this->url_query = Misc::get_result_query($params,1);
		if (! $this->url_query) return false;
				// SUBMISSION A PRIME
		if ( $this->get_prime_data() ){
			$submit=array(
//				'str_suppliers_title'				=> Misc::debrace($this->url_query),
				'str_suppliers_title'				=> htmlspecialchars($this->str_suppliers_title),
				'searchvalue'						=> $this->url_query,
				'str_status_msg' 					=> htmlspecialchars('Click "Clear" to start new search'),
//				'str_suppliers_head'				=> htmlspecialchars($this->str_suppliers_head),
				'str_suppliers'						=> $this->str_suppliers,
				'str_suppliers_tab'					=> 'display:block;',
				'str_prime_definition'			    => '',
				'str_prime_definition_tab'			=> 'display:none;',
				'str_linked_items'					=> $this->str_linked_items,
				'str_collective_items'			    => $this->str_collective_items,
				'str_related_items'					=> $this->str_related_items,
				'str_related_items_tab'				=> 'display:none;',
				'tabbed_content'					=> 'display:block;',
				);
			if($this->str_prime_definition){
				$submit['str_prime_definition']		.= "<p><strong>Definition: </strong>".$this->str_prime_definition."</p>";
				if($this->str_prime_examples){
					$submit['str_prime_definition']	.= "<p><strong>Example Usage: </strong>".$this->str_prime_examples."</p>";
				}
				$submit['str_prime_definition_tab']	= 'display:block;';
			}
			if($this->str_related_items){
				$submit['str_prime_definition']		.= "<p><strong>Definition: </strong>".$this->str_prime_definition."</p>";
				if($this->str_prime_examples){
					$submit['str_prime_definition']	.= "<p><strong>Example Usage: </strong>".$this->str_prime_examples."</p>";
				}
				$submit['str_prime_definition_tab']	= 'display:block;';
			}
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." SUBMISSION A PRIME, CACHE=" . $f3->get('CACHE') );
			header('Access-Control-Allow-Origin: *');
//			$page = file_get_contents()
			$this->render_page("result.htm","text/html",$submit);
			return;
		}


		// SUBMISSION A BP
		if ( $this->get_bp_data() ){
			$submit=array(
				'str_suppliers_title'				=> htmlspecialchars($this->str_suppliers_title),
				'searchvalue'						=> $this->url_query,
				'str_status_msg' 					=> htmlspecialchars('Click "Clear" to start new search'),
//				'str_suppliers_head'				=> htmlspecialchars($this->str_suppliers_head),
				'str_suppliers'						=> $this->str_suppliers,
				'str_suppliers_tab'					=> 'display:block;',
				'str_prime_definition'			    => '',
				'str_prime_definition_tab'			=> 'display:none;',
				'str_linked_items'					=> '',
				'str_collective_items'			    => '',
				'str_related_items'					=> '',
				'tabbed_content'					=> 'display:block;',
				);
			if($this->str_prime_definition){
				$submit['str_prime_definition']		.= "<p><strong>Definition: </strong>".$this->str_prime_definition."</p>";
				if($this->str_prime_examples){
					$submit['str_prime_definition']	.= "<p><strong>Example Usage: </strong>".$this->str_prime_examples."</p>";
				}
				$submit['str_prime_definition_tab']	= 'display:block;';
			}
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."SUBMISSION A BP, CACHE=" . $f3->get('CACHE') );
			header('Access-Control-Allow-Origin: *');
			$this->render_page("result.htm","text/html",$submit);
			return;
		}


		// SUBMISSION NOT A PRIME NOR BP
		$submit=array(
			'str_suppliers_title'				    => '',
			'searchvalue'							=> $this->url_query,
			'str_status_msg' 						=> htmlspecialchars('Sorry, input not recognized. Spelling? To solve enter Keyword only.'),
//			'str_suppliers_head'				    => '',
			'str_suppliers'							=> '',
			'str_suppliers_tab'						=> 'display:none;',
			'str_prime_definition'			        => '',
			'str_prime_definition_tab'				=> 'display:none;',
			'str_linked_items'					    => '',
			'str_collective_items'			        => '',
			'str_related_items'					    => '',
			'tabbed_content'						=> 'display:none;',
			);
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."SUBMISSION NOT A PRIME NOR BP, CACHE=" . $f3->get('CACHE') );
		header('Access-Control-Allow-Origin: *');
		$this->render_page("result.htm","text/html",$submit);
		return;


	}

	function ajax($f3, $params){
		Misc::debug_function_start(__CLASS__,__FUNCTION__,"(This is called when someone hits 'search')");
		Database::connect();
		$this->url_query = Misc::get_url_query($params,3);
		if (! $this->url_query) return false;

		// SUBMISSION A PRIME
		if ( $this->get_prime_data() ){
			$submit=array(
				'str_suppliers_title'				=> htmlspecialchars($this->str_suppliers_title),
				'searchvalue'						=> $this->url_query,
				'str_status_msg' 					=> htmlspecialchars('Click "Clear" to start new search'),
//				'str_suppliers_head'				=> htmlspecialchars($this->str_suppliers_head),
				'str_suppliers'						=> $this->str_suppliers,
				'str_suppliers_tab'					=> 'display:block;',
				'str_prime_definition'			    => $this->str_prime_definition,
				'str_prime_examples'				=> $this->str_prime_examples,
				'str_linked_items'					=> $this->str_linked_items,
				'str_collective_items'			    => $this->str_collective_items,
				'str_related_items'					=> $this->str_related_items,
				'tabbed_content'					=> 'display:block;',
				);
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." SUBMISSION A PRIME, CACHE=" . $f3->get('CACHE') );
			header('Access-Control-Allow-Origin: *');
			$this->render_page("submit.htm","text/xml",$submit);
			return;
		}


		// SUBMISSION A BP
		if ( $this->get_bp_data() ){
			$submit=array(
				'str_suppliers_title'				=> htmlspecialchars($this->str_suppliers_title),
				'searchvalue'						=> $this->url_query,
				'str_status_msg' 					=> htmlspecialchars('Click "Clear" to start new search'),
//				'str_suppliers_head'				=> htmlspecialchars($this->str_suppliers_head),
				'str_suppliers'						=> $this->str_suppliers,
				'str_suppliers_tab'					=> 'display:block;',
				'str_prime_definition'			    => '',
				'str_prime_examples'				=> '',
				'str_linked_items'					=> '',
				'str_collective_items'			    => '',
				'str_related_items'					=> '',
				'tabbed_content'					=> 'display:block;',
				);
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."SUBMISSION A BP, CACHE=" . $f3->get('CACHE') );
			header('Access-Control-Allow-Origin: *');
			$this->render_page("submit.htm","text/xml",$submit);
			return;
		}


		// SUBMISSION NOT A PRIME NOR BP
		$submit=array(
			'str_suppliers_title'				    => '',
			'searchvalue'							=> $this->url_query,
			'str_status_msg' 						=> htmlspecialchars('Sorry, input not recognized. Spelling? To solve enter Keyword only.'),
//			'str_suppliers_head'				    => '',
			'str_suppliers'							=> '',
			'str_suppliers_tab'						=> 'display:none;',
			'str_prime_definition'			        => '',
			'str_prime_examples'				    => '',
			'str_linked_items'					    => '',
			'str_collective_items'			        => '',
			'str_related_items'					    => '',
			'tabbed_content'					=> 'display:none;',
			);
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."SUBMISSION NOT A PRIME NOR BP, CACHE=" . $f3->get('CACHE') );
		header('Access-Control-Allow-Origin: *');
		$this->render_page("submit.htm","text/xml",$submit);
		return;
	}


	function get_prime_data(){
		$prime = $this->url_query;
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."(prime=$prime) initialized");
		$sql = array("SELECT definition as def, examples as exa, symbol FROM p $this->WHERE prime = :prime LIMIT 1 ",array(':prime' => $prime));
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log()." mysql_num_rows=".count($result));

		if(count($result) == 0) return false;
		$this->str_prime_definition = $result[0]['def'];
		$this->str_prime_definition = htmlentities($this->str_prime_definition);
		$this->str_prime_examples = htmlentities($result[0]['exa']);
		$symbol = $result[0]['symbol'];
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
			$hrefurl = "/" . $f3->get('str_page_type_search') . "/" . $f3->get('str_page_type_submit') ."/$related_url_item";
			$onclick = Misc::get_onclick_functions($hrefurl);
			$this->str_related_items .= "<a href='$hrefurl' onclick='$onclick' >$related_item</a>, ";
		}
		if($this->str_related_items) {
			$this->str_related_items = substr($this->str_related_items, 0 , -2);
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." related items");
		}

		// collectives items
		$sql = array("SELECT collective FROM pc , p $this->WHERE p	prime = :prime AND p.prime = collective ",array(':prime' => $prime));
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
		foreach($result as $data){
			$collective = $data['collective'];
			$collective_url_item = urlencode($collective);
			$hrefurl = "/" . $f3->get('str_page_type_search') . "/" . $f3->get('str_page_type_submit') ."/$collective_url_item";
			$onclick = Misc::get_onclick_functions($hrefurl);
			$this->str_collective_items .= "<a href='$hrefurl' onclick='$onclick' >$collective</a>, ";
		}
		if($this->str_collective_items) {
			$this->str_collective_items = substr($this->str_collective_items, 0 , -2);
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." collectives");
		}

		// linked items
		$sql = array("SELECT linked FROM pl , p $this->WHERE pl.prime = :prime AND p.prime = linked ",array(':prime' => $prime));
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
		foreach($result as $data){
			$linked = $data['linked'];
			$linked_url_item = urlencode($linked);
			$hrefurl = "/" . $f3->get('str_page_type_search') . "/" . $f3->get('str_page_type_submit') ."/$linked_url_item";
			$onclick = Misc::get_onclick_functions($hrefurl);
			$this->str_linked_items .= "<a href='$hrefurl' onclick='$onclick' >$linked</a>, ";
		}
		if($this->str_linked_items) {
			$this->str_linked_items = substr($this->str_linked_items, 0 , -2);
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." linked items");
		}

		// suppliers
		$sql = array(
					"SELECT ".
					"companies.company_name AS cname, ".
					"companies.company_website_proto as proto, ".
					"companies.company_website_www as www, ".
					"companies.company_website_url AS url, ".
					"bs.bp as BP, ".
					"credit, ".
					"companies.uid as cuid, ".
					"count(*) as ccounter, ".
					"vendor_data ".
					"FROM bs, companies WHERE ".
					"bs.prime = :prime AND ".
					"bs.company_uid = companies.uid AND ".
					"companies.company_website_url <> '' ".
					"GROUP BY cname ".
					"ORDER BY credit DESC, vendor_data_edited DESC, vendor_data DESC, RAND() LIMIT 25"
					,array(':prime' => $prime)
					);
		$result = $f3->get('DB')->exec($sql[0],$sql[1]);
		if (DEBUG) $f3->get('FP')->log($f3->get('DB')->log());
		$this->str_suppliers = "";
		$this->str_suppliers_title = Misc::debrace($prime).$symbol;

		foreach($result as $data){
			$cuid = $data['cuid'];
			$cname = htmlentities($data['cname'],ENT_QUOTES,"UTF-8",FALSE);
			if ($data['www']) $data['www'] .=".";
			$url = Misc::get_root_url($data['proto']."://".$data['www'].$data['url']);
			$bp = htmlentities($data['BP'],ENT_QUOTES,"UTF-8",FALSE);
			$credit = $data['credit'];

			$ccounter = $data['ccounter']."X";
			$cvendor_data = utf8_encode(htmlentities($data['vendor_data'],ENT_QUOTES,"UTF-8",FALSE));
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() $cvendor_data");
			$url_enc = urlencode($url);
			$onclick = Misc::get_onclick_functions($url_enc);
			if(!$credit) $credit = "0";
			$credit = "£".$credit;
			if(DEBUG) $debug_extra = "=> $url => $credit.00 => $ccounter";
			else $debug_extra="";
			$this->str_suppliers .=<<<HTML
<tr>
    <td>
            <a href='$url' onclick='$onclick' target='_blank'>
                $cname$debug_extra
            </a>
    </td>
</tr>
HTML;
		}
		if ($this->str_suppliers){
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." suppliers");
			//$this->str_suppliers = utf8_encode("<p><h5><strong>" . Misc::debrace($prime) ) . $symbol . utf8_encode("</strong></h5></p>" . $this->str_suppliers );
			return true;
		}
	return false;
	}

	function get_bp_data(){
		$bp = $this->url_query;
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."(bp=$bp) initialized");

		$sql ="SELECT ".
					"companies.company_name AS cname, ".
					"companies.company_website_proto as proto, ".
					"companies.company_website_www as www, ".
					"companies.company_website_url AS url, ".
					"bs.bp as BP, ".
					"credit, ".
					"companies.uid as cuid, ".
					"count(*) AS ccounter, ".
					"vendor_data ".
					"FROM bs, companies WHERE ".
					"bs.bp = :bp AND ".
					"bs.company_uid = companies.uid AND ".
					"companies.company_website_url <> '' ".
					"GROUP BY cname ".
					"ORDER BY redit DESC, vendor_data_edited DESC, vendor_data DESC, RAND() LIMIT 25";
		$result = $f3->get('DB')->exec($sql,array(':bp' => $bp),0);

		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." bp suppliers for $bp");
		$this->str_suppliers_title = $bp;

		foreach($result as $data){
			$cuid = $data['cuid'];
			$cname = htmlentities($data['cname'],ENT_QUOTES,"UTF-8",FALSE);
			$credit = $data['credit'];
			$ccounter = $data['ccounter']."X";
			if ($data['www']) $data['www'] .=".";
			$url = Misc::get_root_url($data['proto']."://".$data['www'].$data['url']);
			$cvendor_data = utf8_encode(htmlentities($data['vendor_data'],ENT_QUOTES,"UTF-8",FALSE));
			$url_enc = urlencode($url);
			$onclick = Misc::get_onclick_functions($url_enc);
			if(!$credit) $credit = "0";
			$credit ="£".$credit;
    		if(DEBUG) $debug_extra = "=> $url => $credit.00 => $ccounter";
			else $debug_extra="";
			$this->str_suppliers .=<<<HTML
<tr>
    <td>
            <a href='$url' onclick='$onclick' target='_blank'>
                $cname$debug_extra
            </a>
    </td>
</tr>
HTML;
/*        <p>
            <span class="wrapper">
                $cvendor_data
            </span>
        </p>
*/
        }
		if ($this->str_suppliers){
			if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() found ".count($result)." suppliers");
			//$this->str_suppliers = utf8_encode("<p><h5><strong>" . Misc::debrace($prime) ) . $symbol . utf8_encode("</strong></h5></p>" . $this->str_suppliers );
			return true;
		}
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__." bp invalid");
		return false;
	}

	function render_page($template,$mime_type="text/html",$submit=array()){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."('$template') initialized");
		// PRIME SET AND VALID PRIME
		$submit['str_title']							= $f3->get('str_title');
		$submit['str_message']							= $f3->get('str_message');
		$debug="";
		foreach($submit as $key => $value){
			$debug .= "$key=>'$value', ";
			$f3->set($key,$value);
		}
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() $debug");
		echo Template::instance()->render($template,$mime_type);
	}

}
// TEST CASES
// AIR COMPRESSOR
// JOBS IN
// Pumps (Equipment)
// moving (how to)
// men's hat
// 1/2" Fittings
// SELECT display_bp as result FROM b WHERE industrial = 'Yes' AND suppliers > 0 AND number_words < 3 AND bp LIKE 'Pumps %' #212 - 0.9ms mysql_num_rows=1
// SELECT display_bp as result FROM b WHERE industrial = 'Yes' AND suppliers > 0 AND number_words < 3 AND bp LIKE 'Pumps %' #209 - 1.0ms mysql_num_rows=0
