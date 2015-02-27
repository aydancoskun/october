<?php
include('simple_html_dom.php');
function trueGS($q="sample query",$num_requested=10,$local="com",$start=0,$proxy="",$cache_dir="cache",$cache_time=600,$strip_tags=true)
{
	$results=array('error'=>false,'size'=>0,'cache_file'=>false,'available'=>0,'scraped'=>0,'alternate'=>false,'results'=>array());
	$base_url='http://www.google.'.$local.'/search?hl=en&q='.urlencode($q).'&start=';
	$results['search_url']=$base_url;
	$n_results_per_page=10;
	$n_pages=ceil($num_requested/$n_results_per_page);
	$i=1;//this is serp ranking
	for($p=0;$p<$n_pages;$p++)
	{
		$n_scraped=0;
		$src='';
		$url=$base_url.($start+$p*$n_results_per_page);
		if($cache_dir!==false)
		{
			$results['cache_file']=rtrim($cache_dir,'/\\').'/'.md5($url).'.html';
			if(file_exists($results['cache_file'])&&time()-filemtime($results['cache_file'])<$cache_time)
				$src=file_get_contents($results['cache_file']);
		}
		if(!$src)
		{
			$ch = curl_init($url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_HEADER,false);
			curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
			curl_setopt($ch,CURLOPT_ENCODING, "");
			curl_setopt($ch,CURLOPT_AUTOREFERER, true);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 10);	
			if($proxy){
			curl_setopt($ch,CURLOPT_HTTPPROXYTUNNEL,true);
			curl_setopt($ch,CURLOPT_PROXY,$proxy);
			}
			curl_setopt($ch,CURLOPT_TIMEOUT,10);
			curl_setopt($ch,CURLOPT_MAXREDIRS,10);
			curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1309.0 Safari/537.17");
			curl_setopt($ch,CURLOPT_REFERER,'http://www.google.'.$local.'/');
			$src=curl_exec($ch);
			$last_url=curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
			$results['size']+=curl_getinfo($ch,CURLINFO_SIZE_DOWNLOAD);
			if(strpos($last_url,'http://www.google.com/sorry/')===0){
				//google is blocking us. back off
				$results['error']='BANNED BY GOOGLE. TRY LATER, OR CHANGE PROXY/IP';
				return $results;
			}
			$curl_error = curl_error($ch);
		    curl_close( $ch );
			if($curl_error||!$src){
				$results['error']='CURL FAILED (most probably because of faulty proxy): '.$curl_error;
				return $results;
			}elseif($results['cache_file']!==false)
				file_put_contents($results['cache_file'],$src);
		}	
		$html=str_get_html($src);
		$src=null;//free memory
		if(!$html)
		{//not valid HTML or some other error
			$results['error']='Invalid HTML received from google';
			return $results;	
		}
		$available=$html->find('#resultStats');
		if(isset($available[0]->innertext))
		{
			$available=$available[0]->innertext;$nres=array('0','0');
			if(preg_match('# ([0-9,\.]+?) results#',$available,$nres))
				$results['available']=(int)str_replace(array(',','.'),'',$nres[1]);
			$available=$nres=null;
		}
// Added this for adds scraping
		foreach($html->find('li.ads-ad') as $li)
		{
			$rs=$li->find('cite');
			if(!is_array($rs))$rs=array();
			foreach($rs as &$r)
			{
				$href = strip_tags($r->innertext);

				$results['results'][]=array('serp'=>$i,'page'=>ceil($i/$n_results_per_page),'url'=>$href,'title'=>$href,'desc'=>"");
					$i++;
					$n_scraped++;
			}
		}


		foreach($html->find('li.g') as $li)
		{
			$rs=$li->find('h3.r');
			if(!is_array($rs))$rs=array();
			foreach($rs as &$r)
			{
				$s=$r->next_sibling();
				if(isset($s->class)&&$s->class=='s')//correct result
				{
					$a=$r->find('a');$a=$a[0];
					$href=$a->href;
					$url_info=parse_url($href);
					if(!isset($url_info['scheme'])){//relative url
						$method=trim(substr($href,0,strpos($href,'?')),'/');
						if($method=='url'){	
						$qs=substr($href,strpos($href,'?')+1);
						$params=0;
						parse_str($qs,$params);
						if(isset($params['q']))
							$href=$params['q'];
						}else{
							if($href[0]!=='/')$href='/'.$href;
							$href='http://www.google.'.$local.$href;
						}
					}
					$desc=$s->find('span.st');
					$desc=$desc[0];
					$cache_url='http://webcache.googleusercontent.com/search?q=cache:'.$href;
					if($strip_tags)
					{
						$a->innertext=strip_tags($a->innertext);
						$desc->innertext=strip_tags($desc->innertext);
					}
					$results['results'][]=array('serp'=>$i,'page'=>ceil($i/$n_results_per_page),'url'=>$href,'title'=>$a->innertext,'desc'=>$desc->innertext);
					$i++;
					$n_scraped++;
				}
			}
		}
		if($n_scraped==0||$results['available']==0)//don't keep on hammering google if it doesn't have what you want
			break;
		$results['scraped']+=$n_scraped;
	}
	if($results['scraped']>0&&$results['available']==0)
		$results['alternate']=true;
	return $results;
}?>
