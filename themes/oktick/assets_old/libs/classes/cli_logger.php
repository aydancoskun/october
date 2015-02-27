<?php

class Cli_logger extends Prefab {

	private function write($txt,$type){
		if(is_array($txt)) $txt = print_r($txt);
        $txt = trim($txt);
        $f3 = \Base::instance();
        $c = $f3->get('Color');
        if ( $type == "log" )   echo $c($txt)->reset . PHP_EOL;
        if ( $type == "info" )  echo $c($txt)->light_blue . PHP_EOL;
        if ( $type == "warn" )  echo $c($txt)->light_yellow . PHP_EOL;
        if ( $type == "error" ) echo $c($txt)->light_red . PHP_EOL;
	}

    public function log($txt){
        if( DEBUG AND DEBUG >= 3)
            $this->write($txt,__FUNCTION__);
        return $txt;
    }

	public function info($txt){
        if( DEBUG AND DEBUG >= 2)
            $this->write($txt,__FUNCTION__);
        return $txt;
	}

	public function warn($txt){
        if( DEBUG AND DEBUG >= 1)
            $this->write($txt,__FUNCTION__);
        return $txt;
	}

	public function error($txt){
		$this->write($txt,__FUNCTION__);
        return $txt;
	}

}
/*

    reset
    bold
    dark
    italic
    underline
    blink
    reverse
    concealed
    default
    white
    black
    red
    green
    yellow
    blue
    magenta
    cyan
    light_gray
    dark_gray
    light_red
    light_green
    light_yellow
    light_blue
    light_magenta
    light_cyan
    bg_default
    bg_white
    bg_black
    bg_red
    bg_green
    bg_yellow
    bg_blue
    bg_magenta
    bg_cyan
    bg_light_gray
    bg_dark_gray
    bg_light_red
    bg_light_green
    bg_light_yellow
    bg_light_blue
    bg_light_magenta
    bg_light_cyan

*/
