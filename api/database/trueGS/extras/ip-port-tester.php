<?php
/*
* Author:		Yash Gupta (technofreak777@gmail.com)
* Website:		http://TheTechnofreak.com
* Description:	This script checks whether a given proxy server of the form IP:port is working or not. Incules a encapsulated 
*				function to extend this functionality to your own apps easily, offering easy integration.
* License:		>>You shall sell/modify/distribute this script only if you have 
*				bought it directly from TheTechnofreak.com (or technofreak777@gmail.com) or if you have received this 
*				script as a value added product while buying something else from TheTechnofreak.com (or technofreak777@gmail.com)
*				>> If this script was distributed to you in some application or by someone other than it's author,
*				you shall not edit/distribute/sell it without the permission of the author.	
* Notes:		To buy this script, send a mail to technofreak777@gmail.com or visit http://thetechnofreak.com			
*/
function testPROXY($proxy,$type)//of form ip:port
{
	if($proxy=="")
		return 0;
	$splited = explode(':',$proxy); // Separate IP and port
	if($type=="port")
	{
		if($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 3)) 
		{
			//It works!!
			fclose($con); // Close the socket handle
			return 1;
		}else return 0;
	}elseif($type=="proxy")
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://google.com/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, "5");
		curl_setopt($ch, CURLOPT_REFERER,"http://google.com/");
		curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8");
		curl_exec($ch);
		if(curl_getinfo($ch,CURLINFO_HTTP_CODE)=="200")
		{
			curl_close($ch);
			return 1;
		}
		curl_close($ch);	 
		return 0;
	}
	return 0;
}
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
?>
<form method="POST">
[IP]:[Port] to check &nbsp;&nbsp;<input type="text" name="q" value="<?php echo $ip.":80"; ?>" /> &nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" /><br />
Check: <input type="radio" name="type" value="proxy" />Proxy <input type="radio" name="type" value="port" checked="checked" />Port visibility
</form>
</table>
<ul><li>Your masked IP address is: <?php echo $_SERVER['REMOTE_ADDR']; ?> <br />
(Different from actual IP address only if you are using a proxy)</li>
<li>Your actual IP address is: <?php echo $ip; ?> <br />
(May not be your actual IP address if using highly anonymous or high quality proxy)</li></ul>
<hr />
<?php
if(isset($_POST['submit'])){
$proxy=addslashes(strip_tags($_POST['q']));
if(testPROXY($proxy,$_POST['type']))
	echo "<h3>$proxy is working. (i.e. the requested port is open)</h3>";
else echo "<h3>$proxy is dead, or requested port is not open on this IP address</h3>";
}
?>
<p>IP:Port testing tool created by <a href="http://thetechnofreak.com">technofreak</a></p>