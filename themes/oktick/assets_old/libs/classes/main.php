<?php
class Main {

	function sync(){
		// This renders the whole home page with default values without any submissions
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		$f3->set('str_current_year',							date("Y"));
		$f3->set('str_search_field',							"");
		$f3->set('str_status_msg',								$f3->get('str_status_msg_default'));
		$cashepath = $f3->get('GSDATAOTHERPATH').'/index.cache';
		if (is_file($cashepath)) {
			$nav = file_get_contents($cashepath);
			$nav = str_replace("https://".$f3->get('HOST'), "", $nav);
			$nav = str_replace("http://".$f3->get('HOST'), "", $nav);
			$f3->set('str_navigation',$nav);
		} else {
			$f3->set('str_navigation','<li><a href="/menu/">OK TicK Menu</a></li>');
		}
		if (DEBUG) $f3->set('git_message',										shell_exec("git log -1 --pretty=format:'%h - %s (%ci)' --abbrev-commit --no-merges"));
		echo Template::instance()->render("main.htm","text/html");
	}
}
