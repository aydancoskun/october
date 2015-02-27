<?php
class Menu {

	function sync($f3, $params){
		// This renders the menu items using the GS CMS
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
		$url_parts = explode("/", $params[0]);		// $url_parts[1]; // menu		// $url_parts[2]; // menuitem
		$_GET['id'] = $url_parts[2];
		global
$base,
$components, 
$content,
$cookie_login,
$cookie_name,
$cookie_time,
$date,
$debugApi,
$EDHEIGHT,
$editor_id,
$EDLANG, 
$EDOPTIONS, 
$EDTOOL, 
$EMAIL, 
$file_ext_blacklist,
$file_ext_whitelist,
$filters,
$GS_asset_objects,
$GS_debug,
$GS_script_assets,
$GS_scripts,
$GS_styles,
$GSADMIN, 
$i18n, 
$innovation_data, 
$innovation_file, 
$LANG, 
$live_plugins,
$metad,
$metak,
$microtime_start,
$mime_type_blacklist,
$mime_type_whitelist,
$nocache,
$nocurl,
$pagesArray,
$pagesSorted,
$parent,
$perm,
$PERMALINK, 
$permission_actions,
$plugin_info,
$plugins,
$PRETTYURLS,
$SALT, 
$services,
$SITENAME, 
$SITEURL, 
$TEMPLATE, 
$thisfile_innov,
$TIMEZONE, 
$title,
$TOOLBAR, 
$url,
$USR, 
$xml;

		include($f3->get('GSINDEX'));
	}

	function ajax(){
		$f3 = \Base::instance();
		if (DEBUG) $f3->get('FP')->log( __CLASS__."->".__FUNCTION__."() initialized");
	}
}
