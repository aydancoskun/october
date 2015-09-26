<?php
//domain
if (isset($_SERVER['HTTPS'])) {
$protocol = $_SERVER['HTTPS'] ? "https://" : "http://";
} else {
$protocol = "http://";
}
define("TM_DOMAIN",$protocol.'ipi.oktick.com');
//absoluter pfad , docroot
define("TM_DOCROOT",'/home/oktick/public_development');
//script verzeichnis
define("TM_DIR",'mail');
//table prefix
$tm_tablePrefix='';
//database
$tm["DB"]["Name"]='mail';
$tm["DB"]["Host"]='127.0.0.1';
$tm["DB"]["Port"]='3306';
$tm["DB"]["Socket"]='1';
$tm["DB"]["User"]='oktick';
$tm["DB"]["Pass"]='1c4f21c534b36c73e3d93be09122ebdc';
/////////////////////////////////
include (TM_DOCROOT."/".TM_DIR."/include/tm_lib.inc.php");
/////////////////////////////////
?>