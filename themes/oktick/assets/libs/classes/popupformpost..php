<?php
class PopupFormPost {

	protected $url_query				= "";

	function __construct() {
	}

	function beforeRoute(){	}

	function afterroute(){ }

//
	function EmailSave($f3, $params){
		Misc::debug_function_start(__CLASS__,__FUNCTION__,"(This is called when something is entered in the search box and returns suggestions)");
		Database::connect();
		var_dump($params);
		exit;

		header("Content-type: application/json"); //makes sure entities are not interpreted
		echo 'dojo_request_script_callbacks.dojo_request_script2({"result":"success","msg":"Thank you, we will keep you updated."})';
		return false;
	}
