<?php
/*
* Author:		Yash Gupta (technofreak777@gmail.com)
* Website:		http://TheTechnofreak.com
* Description:	This script acquires the visitors actual IP address and outputs it in cleartext. Note that this script may not work for highly anonymous proxies. 
* License:		>>You shall sell/modify/distribute this script only if you have 
*				bought it directly from TheTechnofreak.com (or technofreak777@gmail.com) or if you have received this 
*				script as a value added product while buying something else from TheTechnofreak.com (or technofreak777@gmail.com)
*				>> If this script was distributed to you in some application or by someone other than it's author,
*				you shall not edit/distribute/sell it without the permission of the author.	
* Notes:		To buy this script, send a mail to technofreak777@gmail.com or visit http://thetechnofreak.com			
*/
if (!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
	 //check for ip from share internet
	 $ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
	 // Check for the Proxy User
	 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else
	{
	 $ip = $_SERVER["REMOTE_ADDR"];
	}	
	echo $ip;
?>