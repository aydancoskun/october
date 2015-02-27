#!/usr/bin/php -q
<?php
date_default_timezone_set('UTC');
$host = "localhost";
$user = "web";
$password = "2e76656dcba6562ffeb68d524de1053e90a229a0";
$name = "data";
// we connect to localhost at port 3307
$link = mysql_connect($host, $user, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully\n';
mysql_select_db($name);
// Make a list of all the compounds
$plural_split_compounds = array();
$sql =  "select plural_split_compound from primes where plural_split_compound <> ''";
$result = mysql_query($sql);
while ($plural_split_compound = mysql_fetch_row($result)){
    $plural_split_compounds[] = $plural_split_compound[0];
    echo ".";
}
foreach($plural_split_compounds as $plural_split_compound){
    $sql =  "select bp,prime from bps where bp LIKE '%$plural_split_compound%'";
    $first_result = mysql_query($sql);
    if(is_resource($first_result)){
        while ($exception = mysql_fetch_row($first_result)){
            $sql = " prime='$exception[1]', bp ='$exception[0]', plural_split_compound='$plural_split_compound' ";
            echo "\n$sql";
            $sql = "insert into exceptions set $sql ON DUPLICATE KEY UPDATE $sql";
            mysql_query($sql);
        }
    } else {
        echo ".";
    }
}
foreach($plural_split_compounds as $plural_split_compound){
  $plural_split_compound = str_replace(" ", "-", $plural_split_compound);
    $sql =  "select bp,prime from bps where bp LIKE '%$plural_split_compound%'";
    $first_result = mysql_query($sql);
    if(is_resource($first_result)){
        while ($exception = mysql_fetch_row($first_result)){
            $sql = " prime='$exception[1]', bp ='$exception[0]', plural_split_compound='$plural_split_compound' ";
            echo "\n$sql";
            $sql = "insert into exceptions set $sql ON DUPLICATE KEY UPDATE $sql";
            mysql_query($sql);
        }
    } else {
        echo ".";
    }
}
