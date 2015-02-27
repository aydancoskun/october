<?php
echo_me("In 30 seconds the permissions will be reset",TRUE);
echo_me("If you don't want that then close this page or stop loading the page NOW.",TRUE);
echo_me("30");
sleep(1);
for($i=29;$i>0;$i--){
	echo_me("-".$i);
	sleep(1);
}
echo_me("",TRUE);
error_reporting(-1);
ignore_user_abort(true);
set_time_limit(0);
echo_me("Please wait. Resetting permissions....");
echo_me( shell_exec( "sudo chown -R nginx. /srv/www/oktick/html" ). " DONE!",TRUE);
echo_me("OK first stage done. Just a little longer....");
echo_me( shell_exec( "sudo chown -R nginx. /var/lib/php" ) . " DONE!",TRUE);
echo_me("",TRUE);
echo_me("OK, all done.",TRUE);
echo_me("",TRUE);
echo_me("NOW CLOSE THIS PAGE SO YOU DONE ACCIDENTLY TRIGGER IT ON BROWSER RESTART ETC!",TRUE);

function echo_me($data, $BR = false) {
	echo $data;
	if ($BR)
		echo "<br />";
	ob_flush ();
	flush ();
}
