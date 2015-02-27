<?php
$cwd = "/var/www/html/";
$cmd="cd $cwd; git reset --hard; git pull origin clives_rollback";
//$cmd="cd $cwd; git reset --hard; git pull origin " . exec("git rev-parse --abbrev-ref HEAD");
//$output = shell_exec( $cmd );
echo "$cmd: $output<br />";
echo "<br />";
