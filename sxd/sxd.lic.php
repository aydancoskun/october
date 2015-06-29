<?php
$domain=$_SERVER['HTTP_HOST'];
$bin = "";
$bin.= pack("C*", strlen($domain));
$bin.= pack("N", 1431505480);
$bin.= pack("N", 0);
$bin.= pack("A*", $domain);
$bin = str_pad($bin, 54, " ");
$crc = c($bin);
$bin.= pack("N", $crc[0]);
$bin = base64_encode($bin);
$key ='AAAAAAAAAA'.$bin.'AAAAAAAAAA';
