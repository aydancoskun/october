<?php
/*
* Author:		Yash Gupta (technofreak777@gmail.com)
* Website:		http://TheTechnofreak.com
* Description:	>>This script is an example of an application built with the trueGoogleSearch API by TheTechnofreak.
*				It will search google for any given search query by using a giver proxy server
* 				and returns the domain names of the webpages along with several data items about it to the user.
*				Also allows the search to be conducted from the local website of a country (like google.us, google.co.in, etc.)
*				>>Returns the number of results available with google, the number of results it could scrape/parse
*				and the results in a neat array with url, title and description.
* License:		>>You shall sell/modify/distribute this script only if you have 
*				bought it directly from TheTechnofreak.com (or technofreak777@gmail.com) or if you have received this 
*				script as a value added product while buying something else from TheTechnofreak.com (or technofreak777@gmail.com)
*				>>If this script was distributed to you in some application or by someone other than it's author,
*				you shall not edit/distribute/sell it without the permission of the author.	
* Notes:		To buy this script, send a mail to technofreak777@gmail.com or visit http://thetechnofreak.com			
*/
if(get_magic_quotes_gpc())
foreach($_GET as $key=>&$val)
	$val=stripslashes($val);
?>
<h1>true Google Search</h1><h2>by thetechnofreak.com</h2>
<h3>Example - Domain Only Searcher</h3>
(Shows only one result from each domain, useful in link:domain queries)<br>
<form action="" method="get">
<table>
<tr><td>Query</td><td><input name="q" type="text" value='<?php echo isset($_GET['q'])?htmlspecialchars($_GET['q']):"sample query"; ?>'></td></tr>
<tr><td>Proxy (IP:port)</td><td><input name="proxy" type="text" value="<?php echo isset($_GET['proxy'])?$_GET['proxy']:"218.203.107.167:80"; ?>"/></td></tr>
<tr><td>Number of results (eg. 30)</td><td><input name="nres" type="text" value="<?php echo isset($_GET['nres'])?$_GET['nres']:"20"; ?>"/></td></tr>
<tr><td>Starting page (eg. 0)</td><td><input name="start" type="text"  value="<?php echo isset($_GET['start'])?$_GET['start']:"0"; ?>"/></td></tr>
<tr><td>Local search (eg: co.uk)</td><td><input name="local" type="text" value="<?php echo isset($_GET['local'])?$_GET['local']:"com"; ?>"/></td></tr>
<tr><td>Go</td><td><input name="submit" type="submit"/></td></tr>
</table>
</form>
<hr />
<?php
require("../trueGS.php");
$nres=20;
if(isset($_GET['nres'])&&$_GET['nres']!="")
	$nres=$_GET['nres'];
$start=0;
if(isset($_GET['start'])&&$_GET['start']!="")
	$start=$_GET['start'];	
$query="sample query";
if(isset($_GET['q']))
	$query=$_GET['q'];
$local="com";
if(isset($_GET['local'])&&$_GET['local']!="")
	$local=$_GET['local'];
$proxy="";
if(isset($_GET['proxy'])&&$_GET['proxy']!="")
	$proxy=$_GET['proxy'];
$results=trueGS($query,$nres,$local,$start,$proxy,dirname(__FILE__).'/cache',600);
echo "<p>Search URL: <a href='$results[search_url]'>$results[search_url]</a></p>";
if($results["error"])echo "<p>ERROR: $results[error]</p>";
if($results["alternate"])echo "<p>No results for the requested query. Showing alternate results</p>";
echo "<p>Total results with google:".$results['available']."<br>Total scraped:".$results['scraped']."</p>";
$domains=array();
for ($i=0;$i<$results["scraped"];$i++) 
{
	if(!isset($domains[getDomain($results['results'][$i]["url"])]))
		$domains[getDomain($results['results'][$i]["url"])]=$i;
}
foreach($domains as $domain=>$index)
{
	echo "<p>(".($index+1).") <a href='".$domain."' target='_blank'>".$domain."</a> - <b>".$results['results'][$index]["title"]."</b><br>".$results['results'][$index]["desc"]."</p>";	
}
echo "<p>".($results['size']/1024)." KB downloaded</p>";
function getDomain($url){
	return parse_url($url,PHP_URL_HOST);
}
?>