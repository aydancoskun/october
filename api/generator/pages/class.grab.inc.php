<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$dbpAP57279663CvBoY=171483642;$ynBVT57554321prxvw=899392701;$NFLFg26012573VRSlC=103436523;$EBzkV55466919WhVNu=562083862;$wBsmp13729858VZZDt=558303467;$rzWxl83613892QKfjL=872564087;$GkalI42931518oRahz=786834473;$ZwPKO74495239sLLbq=82583374;$nDNlC46117554XCQDw=39779541;$jutbE50610962gbcZs=439891724;$dMbKk45787964ziYPd=564888672;$xBNDy34461059TjLHZ=196239135;$UqrqA64442749SWAib=613911865;$UKYtY48545532WfHaV=600375610;$Tywdw34581909EdRvK=436599121;$oLjQg25364380sZXCK=903051148;$mEUCq68705444HHVDs=282700439;$joydz77417603jjsPm=355015747;$RRtwe99313355LtjET=401965820;$udbFo47205200WYdCW=205019409;$rvICx58905640IRKAL=45145263;$rvRoZ47227173vhuAw=702812134;$hzTDg59982300DbIMV=460988769;$dGIOH99983521lvNHf=100143920;$zOiqM35043335mMjkW=900246338;$uRMTt47974243txuZE=644764771;$PWRLJ96588746XcHGJ=613667969;$KrDit93699341saSbw=588424683;$ckupF87118531fMnVD=850003662;$xWxYw79658814lYsJq=180873657;$DqwPc29132690BNYCw=860003418;$alBku28352661BzCMJ=670861695;$iiEnS35131225tTcMT=893417237;$ZaHkO52280884FCGvb=310138794;$OABHf37614136NyoxG=200995117;$lleZX83943482wnlac=347454956;$UxbSt59081421AGtzD=31487060;$Tqtve55840454AdvMZ=33560180;$jwsVc32033081NAvlM=634643067;$hwuuz80471802RPKTr=617204468;$FqSfE68969116RRnuW=262213135;$QQxku90337525xDdzh=350137817;$WRllJ12389526VpvzP=162947265;$ELiNR17937622TNnIP=481110229;$LBPAj64794312gBRlL=586595459;$IAOUV65772095xxcYY=260871704;$EvWEf68683472AyiZS=783907715;$ekocm76340943racEh=938172242;$djMQo46557007VCxIs=5634033;$qwXYn72144165AtKLV=764761841;?><?php class SiteCrawler { var $VlDIpY74Sn = array(); var $k2mbaYG7Adhhp0nn = false; var $nU8Mj5ZUWIEjvw = false; var $K2dHWcwY5bEP = array(); var $PTs_k_pSWM2EJfY = ''; var $ZxN8MjZW3uwPfqCTY = ''; var $rc3b9mqz2jbp = ''; var $euVHgD2C1lt = ''; var $FFJa4O0MHZ = ''; function PYyS9SPDWu0Pb3bvG8($fqxdyrTNEz){ return preg_replace('#^(www|\w)\.#', '', $fqxdyrTNEz); } function W5mf7Y9Huk0KaQU6(&$a, $dr1lN9apl, $e5V6M6TL5, $CmZLfMuLMSEZIiTevcX, $Qv8G6NWw9S0ZcPxVV, $IFy8IvAAwMb4K = '') { global $grab_parameters; if(strstr($dr1lN9apl,'://')) { 
																													 $e5V6M6TL5 = preg_replace('#(:\/\/.*?\/).*$#', '$01', $CmZLfMuLMSEZIiTevcX); } $DOgZUqwUCl = parse_url($Qv8G6NWw9S0ZcPxVV); if($DOgZUqwUCl['scheme'] && substr($a, 0, 2) == '//') 
																													 $a = $DOgZUqwUCl['scheme'].':'.$a; $fDfweZzwnbqVpWJD9 = @parse_url($a); if($fDfweZzwnbqVpWJD9['scheme'] && ($fDfweZzwnbqVpWJD9['scheme']!='http')&& ($fDfweZzwnbqVpWJD9['scheme']!='https')) { $PfbhgdTernTpzDj = 1; }else { $a = str_replace(':80/', '/', $a); if($a[0]=='?')$a = preg_replace('#^([^\?]*?)([^/\?]*?)(\?.*)?$#','$2',$dr1lN9apl).$a; if($grab_parameters['xs_inc_ajax'] && strstr($a,'#!')){ $CmZLfMuLMSEZIiTevcX = preg_replace('#\#.*$#', '', $CmZLfMuLMSEZIiTevcX); if($a[0] != '/' && !strstr($a,':/')) $a = $CmZLfMuLMSEZIiTevcX . preg_replace('#^([^\#]*?/)?([^/\#]*)?(\#.*)?$#', '$2', $dr1lN9apl).$a; } if(preg_match('#^https?(:|&\#58;)#is',$a)){ if(preg_match('#://[^/]*$#is',$a)) 
																													 $a .= '/'; } else if($a&&$a[0]=='/')$a = $e5V6M6TL5.$a; else $a = $CmZLfMuLMSEZIiTevcX.$a; if($a[0]=='/')$a = $e5V6M6TL5.$a; $a=str_replace('/./','/',$a); $a=preg_replace('#/\.$#','/',$a); if(substr($a,-2) == '..')$a.='/'; if(strstr($a,'../')){ preg_match('#(.*?:.*?//.*?)(/.*)$#',$a,$aa); 
																													 do{ $ap = $aa[2]; $aa[2] = preg_replace('#/?[^/]*/\.\.#','',$ap,1); }while($aa[2]!=$ap); $a = $aa[1].$aa[2]; } $a = preg_replace('#/\./#','/',$a); $a = str_replace('&#38;','&',$a); $a = str_replace('&#038;','&',$a); $a = str_replace('&amp;','&',$a); $a = preg_replace('#([^&])\#'.($grab_parameters['xs_inc_ajax']?'([^\!]|$)':'').'.*$#','$01',$a); $a = preg_replace('#^([^\?]*[^/\:]/)/+#','\\1',$a); $a = preg_replace('#[\r\n]+#s','',$a); $PfbhgdTernTpzDj = (strtolower(substr($a,0,strlen($Qv8G6NWw9S0ZcPxVV)) ) != strtolower($Qv8G6NWw9S0ZcPxVV)) ? 1 : 0; if($grab_parameters['xs_cleanurls']) $a = @preg_replace($grab_parameters['xs_cleanurls'],'',$a); if($grab_parameters['xs_cleanpar']) { do { $yCwTqe5GDcta = $a; $a = @preg_replace('#[\\?\\&]('.$grab_parameters['xs_cleanpar'].')=[a-z0-9\-\.\_\=\/]+$#i','',$a); $a = @preg_replace('#([\\?\\&])('.$grab_parameters['xs_cleanpar'].')=[a-z0-9\-\.\_\=\/]+&#i','$1',$a); }while($a != $yCwTqe5GDcta); $a = @preg_replace('#\?\&?$#','',$a); } if($PfbhgdTernTpzDj && $grab_parameters['xs_allow_subdomains']){ $fDfweZzwnbqVpWJD9 = @parse_url($a); if($fDfweZzwnbqVpWJD9['host'] && preg_match('#^(.*?\.)?'.preg_quote($this->PYyS9SPDWu0Pb3bvG8($DOgZUqwUCl['host']),'#').'$#', $fDfweZzwnbqVpWJD9['host']) ){ $PfbhgdTernTpzDj = 2; } } if($PfbhgdTernTpzDj && $IFy8IvAAwMb4K) { $a0mMmHqPDZ = $this->FyqopbSBljsknT1TH($IFy8IvAAwMb4K); if($a0mMmHqPDZ && preg_match('#('.$a0mMmHqPDZ.')#', $a)) $PfbhgdTernTpzDj = 2; } } iRDSo8Ka5xIhzQ("<br/>($a -- $PfbhgdTernTpzDj - $dr1lN9apl - $e5V6M6TL5 - $CmZLfMuLMSEZIiTevcX - [".$this->PYyS9SPDWu0Pb3bvG8($DOgZUqwUCl['host']).", ".$fDfweZzwnbqVpWJD9['host']."])<br>\n",3); return $PfbhgdTernTpzDj; } function FyqopbSBljsknT1TH($QYzbdvM1h){ if(!isset($this->VlDIpY74Sn[$QYzbdvM1h])){ $this->VlDIpY74Sn[$QYzbdvM1h] = trim($QYzbdvM1h) ? preg_replace("#\s*[\r\n]+\s*#",'|', (strstr($s=trim($QYzbdvM1h),'*')?$s:preg_quote($s,'#'))) : ''; } return $this->VlDIpY74Sn[$QYzbdvM1h]; } function D1tXUjHdde7g1(&$dr1lN9apl) { global $grab_parameters; if(isset($this->K2dHWcwY5bEP[$dr1lN9apl])) $dr1lN9apl =$this->K2dHWcwY5bEP[$dr1lN9apl]; $f = $this->k2mbaYG7Adhhp0nn && preg_match('#'.$grab_parameters['xs_exc_skip'].'#i',$dr1lN9apl); if($this->PTs_k_pSWM2EJfY&&!$f)$f=$f||@preg_match('#('.$this->PTs_k_pSWM2EJfY.')#',$dr1lN9apl); if($this->ZxN8MjZW3uwPfqCTY && $f && $grab_parameters['xs_incl_force']) $f = !preg_match('#('.$this->ZxN8MjZW3uwPfqCTY.')#',$dr1lN9apl); if($this->rc3b9mqz2jbp&&!$f) foreach($this->rc3b9mqz2jbp as $bm) { $f = $f || preg_match('#^('.$bm.')#', $this->euVHgD2C1lt . $dr1lN9apl); } $f2 = false; $HF6NqOcvPqnbh7 = false; if(!$f) { $f2 = $this->nU8Mj5ZUWIEjvw && preg_match('#'.$grab_parameters['xs_inc_skip'].'#i',$dr1lN9apl); if($this->ZxN8MjZW3uwPfqCTY && !$f2) $f2 = $f2||(preg_match('#('.$this->ZxN8MjZW3uwPfqCTY.')#',$dr1lN9apl)); if($grab_parameters['xs_parse_only'] && !$f2 && $dr1lN9apl!='/') { $f2 = $f2 || !preg_match('#'.str_replace(' ', '|', preg_quote($grab_parameters['xs_parse_only'],'#')).'#',$dr1lN9apl); } } $f3 = false; if($this->noincmask)$f3=@preg_match('#('.$this->noincmask.')#',$dr1lN9apl); return array('f' => $f, 'f2' => $f2, 'f3' => $f3);	 } function pUvA4zhAkYZK2Nd8A($XIlk3ZqbSYG,&$urls_completed) { global $grab_parameters,$kgQxFsRGfcjLoo9_; error_reporting(E_ALL&~E_NOTICE); @set_time_limit($grab_parameters['xs_exec_time']); if($XIlk3ZqbSYG['bgexec']) { ignore_user_abort(true); } register_shutdown_function('LBgEBgVZ4z'); if(function_exists('ini_set')) { @ini_set("zlib.output_compression", 0); @ini_set("output_buffering", 0); } $JlJYKIIrEYn6 = explode(" ",microtime()); $g9O9SeHS367Ji = $JlJYKIIrEYn6[0]+$JlJYKIIrEYn6[1]; $starttime = $nipU07LHK6q = time(); $PRKe3jTsdEw9doYFe = $nettime = 0; $KCZQduSVvXZZGY28 = $XIlk3ZqbSYG['initurl']; $xvFrf391xp7S2I = $XIlk3ZqbSYG['maxpg']>0 ? $XIlk3ZqbSYG['maxpg'] : 1E10; $V40Se565bCU_ZP7DVb = $XIlk3ZqbSYG['maxdepth'] ? $XIlk3ZqbSYG['maxdepth'] : -1; $QmKaHsN_mnHEfYSpTEg = $XIlk3ZqbSYG['progress_callback']; $this->PTs_k_pSWM2EJfY = $this->FyqopbSBljsknT1TH($grab_parameters['xs_excl_urls']); $this->ZxN8MjZW3uwPfqCTY = $this->FyqopbSBljsknT1TH($grab_parameters['xs_incl_urls']); $this->noincmask = $this->FyqopbSBljsknT1TH($grab_parameters['xs_noincl_urls']); $Am1CLOE5I = $this->FyqopbSBljsknT1TH($grab_parameters['xs_prev_sm_incl']); $fjEvozDHHFDc3M3CP6e = $YWmYVMCd_Z1Jkw = array(); $UDWzqkbDps6LuIKb = ''; $bEoirRlORmPAWbBHF = preg_split('#[\r\n]+#', $grab_parameters['xs_ind_attr']); $sc_VvX5jelp2 = '#200'.($grab_parameters['xs_allow_httpcode']?'|'.$grab_parameters['xs_allow_httpcode']:'').'#'; $O35084VCZZWtq831QK = '#400|429'.($grab_parameters['xs_badreq_httpcode']?'|'.$grab_parameters['xs_badreq_httpcode']:'').'#'; if($grab_parameters['xs_memsave']) { if(!file_exists(F8eE_Rqcrb)) mkdir(F8eE_Rqcrb, 0777); else if($XIlk3ZqbSYG['resume']=='') Nm21UoK4Q2QYWx7O(F8eE_Rqcrb, '.txt'); } foreach($bEoirRlORmPAWbBHF as $ia) if($ia) { $is = explode(',', $ia); if($is[0][0]=='$') $PSyERNx_fX3yH75 = substr($is[0], 1); else $PSyERNx_fX3yH75 = str_replace(array('\\^', '\\$'), array('^','$'), preg_quote($is[0],'#')); $YWmYVMCd_Z1Jkw[] = $PSyERNx_fX3yH75; $fjEvozDHHFDc3M3CP6e[] =  array('lm' => $is[1], 'f' => $is[2], 'p' => $is[3]); } if($YWmYVMCd_Z1Jkw) $UDWzqkbDps6LuIKb = '('.implode(')|(',$YWmYVMCd_Z1Jkw).')'; $QeahkPg4bVaAigh = parse_url($KCZQduSVvXZZGY28); if(!$QeahkPg4bVaAigh['path']){$KCZQduSVvXZZGY28.='/';$QeahkPg4bVaAigh = parse_url($KCZQduSVvXZZGY28);} if($grab_parameters['xs_moreurls']){ $mu = preg_split('#[\r\n]+#', $grab_parameters['xs_moreurls']); foreach($mu as $mi=>$s9tRSktHona){ $s9tRSktHona = str_replace($Qv8G6NWw9S0ZcPxVV, '', $s9tRSktHona); $Zul57HOZFkqdgOyF8 = $kgQxFsRGfcjLoo9_->fetch($s9tRSktHona,0,true); if($mi>3)break; } } $Zul57HOZFkqdgOyF8 = $kgQxFsRGfcjLoo9_->fetch($KCZQduSVvXZZGY28,0,true);// the first request is to skip session id 
																													 $yeAH4YM6vHfvHevRd = !preg_match($sc_VvX5jelp2,$Zul57HOZFkqdgOyF8['code']); if($yeAH4YM6vHfvHevRd) { $yeAH4YM6vHfvHevRd = ''; foreach($Zul57HOZFkqdgOyF8['headers'] as $k=>$v) $yeAH4YM6vHfvHevRd .= $k.': '.$v.'<br />'; return array( 'errmsg'=>'<b>There was an error while retrieving the URL specified:</b> '.$KCZQduSVvXZZGY28.''. ($Zul57HOZFkqdgOyF8['errormsg']?'<br><b>Error message:</b> '.$Zul57HOZFkqdgOyF8['errormsg']:''). '<br><b>HTTP Code:</b><br>'.$Zul57HOZFkqdgOyF8['protoline']. '<br><b>HTTP headers:</b><br>'.$yeAH4YM6vHfvHevRd. '<br><b>HTTP output:</b><br>'.$Zul57HOZFkqdgOyF8['content'] , ); } $KCZQduSVvXZZGY28 = $Zul57HOZFkqdgOyF8['last_url']; $urls_completed = array(); $urls_ext = array(); $urls_404 = array(); $e5V6M6TL5 = $QeahkPg4bVaAigh['scheme'].'://'.$QeahkPg4bVaAigh['host'].((!$QeahkPg4bVaAigh['port'] || ($QeahkPg4bVaAigh['port']=='80'))?'':(':'.$QeahkPg4bVaAigh['port'])); 
																													 $pn = $tsize = $retrno = $iwe5WfZrZZ6OjkL1yFV = $U05VXyMC9XS_b = $fetch_no = 0; $Qv8G6NWw9S0ZcPxVV = HuD2wJN0EuqGM6r($e5V6M6TL5.'/', ywtXHpXF3PCoH53sZ($QeahkPg4bVaAigh['path'])); $sqj4yHCj873BP = parse_url($Qv8G6NWw9S0ZcPxVV); $this->euVHgD2C1lt = preg_replace('#^.+://[^/]+#', '', $Qv8G6NWw9S0ZcPxVV); 
																													 $QxoEWBD1O1qswq3ii = $kgQxFsRGfcjLoo9_->fetch($KCZQduSVvXZZGY28,0,true,true); $Zwf4bxMTE8xK8E = str_replace($Qv8G6NWw9S0ZcPxVV,'',$KCZQduSVvXZZGY28); $urls_list_full = array($Zwf4bxMTE8xK8E=>1); if(!$Zwf4bxMTE8xK8E)$Zwf4bxMTE8xK8E=''; $urls_list = array($Zwf4bxMTE8xK8E=>1); $urls_list2 = $urls_list_skipped = array(); $this->K2dHWcwY5bEP = array(); $links_level = 0; $ByzJ33WTH1 = $ref_links = $ref_links2 = $ref_links_list = array(); $ZbmgwPpRiaBbjR9P = 0; $UfCbPMkJL7hFdCsb = $xvFrf391xp7S2I; if(!$grab_parameters['xs_progupdate'])$grab_parameters['xs_progupdate'] = 20; if(isset($grab_parameters['xs_robotstxt']) && $grab_parameters['xs_robotstxt']) { $wUBAvDKke4zaEU = $kgQxFsRGfcjLoo9_->fetch($e5V6M6TL5.'/robots.txt'); if($e5V6M6TL5.'/' != $Qv8G6NWw9S0ZcPxVV) { $O8RE2k9RCjD3PxF_MJ = $kgQxFsRGfcjLoo9_->fetch($Qv8G6NWw9S0ZcPxVV.'robots.txt'); $wUBAvDKke4zaEU['content']  .= "\n".$O8RE2k9RCjD3PxF_MJ['content']; } $ra=preg_split('#user-agent:\s*#im',$wUBAvDKke4zaEU['content']); $AbOnA9dFxAZFArqSEam=array(); for($i=1;$i<count($ra);$i++){ preg_match('#^(\S+)(.*)$#s',$ra[$i],$aWQSGn6KWTk7x4HBX3); if($aWQSGn6KWTk7x4HBX3[1]=='*'||strstr($aWQSGn6KWTk7x4HBX3[1],'google')){ preg_match_all('#^disallow:\s*(\S*)#im',$aWQSGn6KWTk7x4HBX3[2],$rm); for($pi=0;$pi<count($rm[1]);$pi++) if($rm[1][$pi]) $AbOnA9dFxAZFArqSEam[] =  str_replace('\\$','$', str_replace('\\*','.*', preg_quote($rm[1][$pi],'#') )); } } for($i=0;$i<count($AbOnA9dFxAZFArqSEam);$i+=200) $this->rc3b9mqz2jbp[]=implode('|', array_slice($AbOnA9dFxAZFArqSEam, $i,200)); }else $this->rc3b9mqz2jbp = array(); if($grab_parameters['xs_inc_ajax']) $grab_parameters['xs_proto_skip'] = str_replace( '\#', '\#[^\!]', $grab_parameters['xs_proto_skip']); $this->k2mbaYG7Adhhp0nn = $grab_parameters['xs_exc_skip']!='\\.()'; $this->nU8Mj5ZUWIEjvw = $grab_parameters['xs_inc_skip']!='\\.()'; $grab_parameters['xs_inc_skip'] .= '$'; $grab_parameters['xs_exc_skip'] .= '$'; if($grab_parameters['xs_debug']) { $_GET['ddbg']=1; Zq0MnQmsD6T2lLLfU(); } $Gj_L98sRGD = 0; $runstate = array(); $url_ind = 0; $cnu = 1; $pf = RkxOeH9i8(JAvBiMmjzH.AdSeH3KPw4,'w');fclose($pf); $EqTqRHeveBfe7FPkbf = false; if($XIlk3ZqbSYG['resume']!=''){ $qhPWndLyX4Mr = @hRkxxxwtG(kEM8KMpb9E(JAvBiMmjzH.Ufz4hdNjXhLx60oBsLt, true)); if($qhPWndLyX4Mr) { $EqTqRHeveBfe7FPkbf = true; echo 'Resuming the last session (last updated: '.date('Y-m-d H:i:s',$qhPWndLyX4Mr['time']).')'."\n"; extract($qhPWndLyX4Mr); $g9O9SeHS367Ji-=$ctime; $Gj_L98sRGD = $ctime; unset($qhPWndLyX4Mr); } } $FAzOemScryy = 0; if(!$EqTqRHeveBfe7FPkbf){ if($grab_parameters['xs_moreurls']){ $mu = preg_split('#[\r\n]+#', $grab_parameters['xs_moreurls']); foreach($mu as $s9tRSktHona){ $PfbhgdTernTpzDj = $this->W5mf7Y9Huk0KaQU6($s9tRSktHona, $dr1lN9apl, $e5V6M6TL5, $CmZLfMuLMSEZIiTevcX, $Qv8G6NWw9S0ZcPxVV); if($PfbhgdTernTpzDj != 1) $urls_list[$s9tRSktHona]++; } } if($grab_parameters['xs_prev_sm_base']){ if($sm_base = @kEM8KMpb9E(JAvBiMmjzH.'sm_base.db',true)){ $sm_base = @unserialize($sm_base); } if(is_array($sm_base) && ($grab_parameters['xs_prev_sm_base_min']<count($sm_base)) ){ foreach($sm_base as $_u=>$_e) $urls_list[$_u]++; } else $sm_base = array(); } $FAzOemScryy = count($urls_list); $urls_list_full = $urls_list; $cnu = count($urls_list); } $YPbrrsyP5iHhPWM9NQQ = explode('|', $grab_parameters['xs_force_inc']); $k8p4OiRFLZXiE = $SVwVpmjm9y = array(); $AbGonU3oVS = count($urls_completed); $tYiNjhlwUEh9E5qV2BL = count($urls_list2); sleep(1); @Tqxf4L13C0B33yiyrv(JAvBiMmjzH.AdSeH3KPw4); $progpar = array($ctime, str_replace($KCZQduSVvXZZGY28, '', $dr1lN9apl), $pl,$pn,$tsize,$links_level,$mu,$AbGonU3oVS,$tYiNjhlwUEh9E5qV2BL,$nettime,$RJhfKMpNS,$fetch_no); if($QmKaHsN_mnHEfYSpTEg) $QmKaHsN_mnHEfYSpTEg($progpar); if($urls_list) do { l_kNDRia9T1o('pre',true); l_kNDRia9T1o('pre1'); if($k8p4OiRFLZXiE) { $_ul = array_shift($k8p4OiRFLZXiE); }else $_ul = each($urls_list); list($dr1lN9apl, $dREpFQ5xuzJSkbpu7AS) = $_ul; $PCXq2qAOCLzx1N = ($dREpFQ5xuzJSkbpu7AS>0 && $dREpFQ5xuzJSkbpu7AS<1) ? $dREpFQ5xuzJSkbpu7AS : 0; $url_ind++; iRDSo8Ka5xIhzQ("\n[ $url_ind - $dr1lN9apl, $dREpFQ5xuzJSkbpu7AS] \n"); unset($urls_list[$dr1lN9apl]); $PftdNZ9fEP0Z1yoaR = SCWLfn0FOY($dr1lN9apl); $elNljYZlpLLDN = false; $AAKKoivMoSg5s_ = ''; l_kNDRia9T1o('pre1',true); l_kNDRia9T1o('pre2a'); $Zul57HOZFkqdgOyF8 = array(); $cn = ''; $_fex = $this->D1tXUjHdde7g1($dr1lN9apl); extract($_fex); l_kNDRia9T1o('pre2a',true); l_kNDRia9T1o('pre2b'); if(!$f && ($AbGonU3oVS>0) && ($HF6NqOcvPqnbh7 = $sm_base[$dr1lN9apl])){ $f2 = true; } l_kNDRia9T1o('pre2b',true); do{ $m6VqF6rKg39eWbe8cYQ = count($urls_list) + $tYiNjhlwUEh9E5qV2BL + $AbGonU3oVS;       $f3 = $YPbrrsyP5iHhPWM9NQQ[2] && ( ($UfCbPMkJL7hFdCsb*$YPbrrsyP5iHhPWM9NQQ[2]+1000)< ($IYxAjJo0uTeBRoqu-$url_ind-$FAzOemScryy)); if(!$f && !$f2) { $fMwzFU9kjTU = ($YPbrrsyP5iHhPWM9NQQ[1] &&  ( (($ctime>$YPbrrsyP5iHhPWM9NQQ[0]) && ($pn>$xvFrf391xp7S2I*$YPbrrsyP5iHhPWM9NQQ[1])) || $f3));	 $FE4j24hlEn8 = ($YPbrrsyP5iHhPWM9NQQ[3] && $xvFrf391xp7S2I && (($m6VqF6rKg39eWbe8cYQ>$xvFrf391xp7S2I*$YPbrrsyP5iHhPWM9NQQ[3]))); if($YPbrrsyP5iHhPWM9NQQ[3] && $xvFrf391xp7S2I && (($pn>$xvFrf391xp7S2I*$YPbrrsyP5iHhPWM9NQQ[3]))){ $urls_list = $urls_list2 = array(); $tYiNjhlwUEh9E5qV2BL = 0; $cnu = 0; } if($V40Se565bCU_ZP7DVb<=0 || $links_level<$V40Se565bCU_ZP7DVb) { l_kNDRia9T1o('extract'); $AjohmfCMR6XNcb = microtime(true); $OCFdVAYmxKRN = HuD2wJN0EuqGM6r($Qv8G6NWw9S0ZcPxVV, $dr1lN9apl); if(LDd7bqg5_C('xs_http_parallel')){ if(!$k8p4OiRFLZXiE && !isset($kgQxFsRGfcjLoo9_->yQTjPXCGcUnHW[$OCFdVAYmxKRN])){ $k8p4OiRFLZXiE = array(); $SVwVpmjm9y = array($OCFdVAYmxKRN); $_par = LDd7bqg5_C('xs_http_parallel_num', 10); for($i=0;($i<$_par*5)&&(count($SVwVpmjm9y)<$_par);$i++) if($_ul = each($urls_list)) { $k8p4OiRFLZXiE[] = $_ul; $_fex2 = $this->D1tXUjHdde7g1($_ul[0]); if(!$_fex2['f'] && !$_fex2['f2']){ $_u1 = HuD2wJN0EuqGM6r($Qv8G6NWw9S0ZcPxVV, $_ul[0]); if(!isset($sm_base[$_u1])){ $SVwVpmjm9y[] = $_u1; } } } $kgQxFsRGfcjLoo9_->V0U1xekryqgXAM($SVwVpmjm9y); } } iRDSo8Ka5xIhzQ("<h4> { $OCFdVAYmxKRN } </h4>\n"); $iM0z82gnwPfmE0lYG=0; $iwe5WfZrZZ6OjkL1yFV++; do { $Zul57HOZFkqdgOyF8 = $kgQxFsRGfcjLoo9_->fetch($OCFdVAYmxKRN, 0, 0); $_to = $Zul57HOZFkqdgOyF8['flags']['socket_timeout']; if($_to && ($sqj4yHCj873BP['host']!=$Zul57HOZFkqdgOyF8['purl']['host'])){ $Zul57HOZFkqdgOyF8['flags']['error'] = 'Host doesn\'t match'; } $_ic = intval($Zul57HOZFkqdgOyF8['code']); $CaVSdh0LSmJ5J = preg_match($O35084VCZZWtq831QK,$_ic); $x0KsMnatxIC9 = ($_ic == 403); $aSzeQB2V8mI9JsaPdj = (($_ic == 301)||($_ic==302)) && ($OCFdVAYmxKRN == $Zul57HOZFkqdgOyF8['last_url']); if( !$Zul57HOZFkqdgOyF8['flags']['error'] &&  (($CaVSdh0LSmJ5J || $x0KsMnatxIC9 || $aSzeQB2V8mI9JsaPdj) || !$Zul57HOZFkqdgOyF8['code'] || $_to) ) { $iM0z82gnwPfmE0lYG++; $_sl = $grab_parameters['xs_delay_ms']?$grab_parameters['xs_delay_ms']:1; if($Zul57HOZFkqdgOyF8['headers'] && ($_csl = $Zul57HOZFkqdgOyF8['headers']['retry-after'])) $_sl = max($_sl, $_csl + ($iM0z82gnwPfmE0lYG+1)*$_sl); if(($_to) && $grab_parameters['xs_timeout_break']){ iRDSo8Ka5xIhzQ("<p> # TIMEOUT - $_to #</p>\n"); if($iM0z82gnwPfmE0lYG==3){ if(strstr($_to,'read') ){ iRDSo8Ka5xIhzQ("<p> read200 break?</p>\n"); break ; } if($U05VXyMC9XS_b++>5) { $m6fVuAl9ToHa4iiKa = "Too many timeouts detected"; break 2; } iRDSo8Ka5xIhzQ("<p> # MULTI TIMEOUT - BREAK #</p>\n"); $_sl = 60;	    			 $iM0z82gnwPfmE0lYG = 0; } } iRDSo8Ka5xIhzQ("<p> # RETRY - ".$Zul57HOZFkqdgOyF8['code']." - ".(intval($Zul57HOZFkqdgOyF8['code']))." - ".$Zul57HOZFkqdgOyF8['flags']['error']."# zZz $_sl</p>\n"); sleep($_sl); } else  break; }while($iM0z82gnwPfmE0lYG<3); $fetch_no++; l_kNDRia9T1o('extract', true); l_kNDRia9T1o('analyze'); $RJhfKMpNS = microtime(true)-$AjohmfCMR6XNcb; $nettime += $RJhfKMpNS; iRDSo8Ka5xIhzQ("<hr>\n[[[ ".$Zul57HOZFkqdgOyF8['code']." ]]] - ".number_format($RJhfKMpNS,2)."s (".number_format($kgQxFsRGfcjLoo9_->VBS8vJ12i7,2).' + '.number_format($kgQxFsRGfcjLoo9_->sfFw7CUsV,2).")\n".var_export($Zul57HOZFkqdgOyF8['headers'],1)); $aBb5M7SvBOsEIqI7t = is_array($Zul57HOZFkqdgOyF8['headers']) ? strtolower($Zul57HOZFkqdgOyF8['headers']['content-type']) : ''; $QcR_wuGxkDyfpHas7TL = strstr($aBb5M7SvBOsEIqI7t,'text/html') || strstr($aBb5M7SvBOsEIqI7t,'/xhtml') || !$aBb5M7SvBOsEIqI7t; if((strstr($aBb5M7SvBOsEIqI7t,'application/') && strstr($aBb5M7SvBOsEIqI7t,'pdf')) ||strstr($aBb5M7SvBOsEIqI7t,'/xml'))  { $Zul57HOZFkqdgOyF8['content'] = ''; $QcR_wuGxkDyfpHas7TL = true; } if($aBb5M7SvBOsEIqI7t && !$QcR_wuGxkDyfpHas7TL && (!$grab_parameters['xs_parse_swf'] || !strstr($aBb5M7SvBOsEIqI7t, 'shockwave-flash')) ){ if(!$fMwzFU9kjTU){ $AAKKoivMoSg5s_ = $aBb5M7SvBOsEIqI7t; continue; } } $hhpOPvD3FyvIjyMCBEE = array(); if($Zul57HOZFkqdgOyF8['code']==404 || ($grab_parameters['xs_force_404'] && preg_match('#'.implode('|',preg_split('#\s+#',$grab_parameters['xs_force_404'])).'#', $dr1lN9apl) ) ){ if($links_level>0) if(!$grab_parameters['xs_chlog_list_max'] || count($urls_404) < $grab_parameters['xs_chlog_list_max']) { $bEP0apSEQLDaV9Xds = $ref_links2[$dr1lN9apl]; if($bEP0apSEQLDaV9Xds && isset($this->K2dHWcwY5bEP[$bEP0apSEQLDaV9Xds[0]]) && isset($ref_links_list[$bEP0apSEQLDaV9Xds[0]]) ){ $bEP0apSEQLDaV9Xds = array_merge($bEP0apSEQLDaV9Xds,$ref_links_list[$bEP0apSEQLDaV9Xds[0]]); } $urls_404[]=array($dr1lN9apl,$bEP0apSEQLDaV9Xds); } } $cn = $Zul57HOZFkqdgOyF8['content']; $tsize+=strlen($cn); if($chfKQ2jb8QOC = preg_replace('#<!--(\[if IE\]>|.*?-->)#is', '',$cn)) $cn = $chfKQ2jb8QOC; preg_match('#<base[^>]*?href=[\'"](.*?)[\'"]#is',$cn,$bm); if(isset($bm[1])&&$bm[1]) $CmZLfMuLMSEZIiTevcX = ywtXHpXF3PCoH53sZ($bm[1].(preg_match('#//.*/#',$bm[1])?'-':'/-')); 
																													 else $CmZLfMuLMSEZIiTevcX = ywtXHpXF3PCoH53sZ(strstr($dr1lN9apl,'://') ? $dr1lN9apl : $Qv8G6NWw9S0ZcPxVV . $dr1lN9apl); 
																													 if($grab_parameters['xs_canonical']) if(($OCFdVAYmxKRN == $Zul57HOZFkqdgOyF8['last_url']) &&  ( preg_match('#<link[^>]*rel=[\'"]canonical[\'"][^>]*href=[\'"]([^>]*?)[\'"]#is', $cn, $vk7woDGzb9IB_Gal9) || preg_match('#<link[^>]*href=[\'"]([^>]*?)[\'"][^>]*rel=[\'"]canonical[\'"]#is', $cn, $vk7woDGzb9IB_Gal9)) ){ $Zul57HOZFkqdgOyF8['last_url'] = trim($vk7woDGzb9IB_Gal9[1]); } if($Zul57HOZFkqdgOyF8['last_url']){ $PfbhgdTernTpzDj = $this->W5mf7Y9Huk0KaQU6($Zul57HOZFkqdgOyF8['last_url'], $dr1lN9apl, $e5V6M6TL5, $CmZLfMuLMSEZIiTevcX, $Qv8G6NWw9S0ZcPxVV); if($PfbhgdTernTpzDj == 1){ $AAKKoivMoSg5s_ = 'lu (ext) - '.$Zul57HOZFkqdgOyF8['last_url']; continue; } } $kxesmZvVXn = preg_replace('#^.*?'.preg_quote($Qv8G6NWw9S0ZcPxVV,'#').'#','',$Zul57HOZFkqdgOyF8['last_url']); if(($OCFdVAYmxKRN != $Zul57HOZFkqdgOyF8['last_url']))// && ($OCFdVAYmxKRN != $Zul57HOZFkqdgOyF8['last_url'].'/'))  
																													 { $this->K2dHWcwY5bEP[$dr1lN9apl]=$Zul57HOZFkqdgOyF8['last_url']; $io=$dr1lN9apl; if(strlen($kxesmZvVXn) <= 2048) if(!isset($urls_list_full[$kxesmZvVXn])) { $urls_list2[$kxesmZvVXn]++; if(count($ref_links[$kxesmZvVXn])<max(1,intval($grab_parameters['xs_maxref']))) $ref_links[$kxesmZvVXn][] = $dr1lN9apl; if( $grab_parameters['xs_ref_list_store'] &&  ($_rlmax = $grab_parameters['xs_ref_list_max']) ){ if( (isset($ref_links_list[$kxesmZvVXn]) || count($ref_links_list)<$_rlmax) &&    					 (count($ref_links_list[$kxesmZvVXn])<max(1,intval($grab_parameters['xs_maxref']))) ) { if(!$ref_links_list[$kxesmZvVXn]) $ref_links_list[$kxesmZvVXn] = array(); if(!in_array($dr1lN9apl, $ref_links_list[$kxesmZvVXn])) $ref_links_list[$kxesmZvVXn][] = $dr1lN9apl; } } } $AAKKoivMoSg5s_ = 'lu - '.$Zul57HOZFkqdgOyF8['last_url']; if(!$fMwzFU9kjTU)continue; } if($sc_VvX5jelp2 && !preg_match($sc_VvX5jelp2,$Zul57HOZFkqdgOyF8['code'])){ $AAKKoivMoSg5s_ = $Zul57HOZFkqdgOyF8['code']; continue; } $retrno++; if($fMwzFU9kjTU||$FE4j24hlEn8) { $QcR_wuGxkDyfpHas7TL = false; } l_kNDRia9T1o('analyze',true); if(strstr($aBb5M7SvBOsEIqI7t, 'shockwave-flash') && $grab_parameters['xs_parse_swf']) { include_once uNFFhEr_Ldjz6gLuOb.'class.pfile.inc.php'; $am = new SWFParser(); $am->PvFTCmFE6($cn); $yyq7fDoK_cBPACC6n1 = $am->wBZSjAu6USLv869OfXK(); }else if($QcR_wuGxkDyfpHas7TL) { l_kNDRia9T1o('parse'); $JtLwsGHOAgAKL7G = $grab_parameters['xs_utf8_enc'] ? 'isu':'is'; $_t = 'a|area|go'; if(!$grab_parameters['xs_disable_feed']) $_t .= '|link'; preg_match_all('#<(?:'.$_t.')(?:[^>]*?\s)href\s*=\s*(?:"([^"]*)|\'([^\']*)|([^\s\"\\\\>]+))[^>]*>#is'.$JtLwsGHOAgAKL7G, $cn, $am); preg_match_all('#<option(?:[^>]*?)?value\s*=\s*"(http[^"]*)#is'.$JtLwsGHOAgAKL7G, $cn, $Kl6oIfEwKD_U); preg_match_all('#<i?frame\s[^>]*?src\s*=\s*["\']?(.*?)("|>|\')#is', $cn, $RXZaXpOvdbjwY); preg_match_all('#<meta\s[^>]*http-equiv\s*=\s*"?refresh[^>]*URL\s*=\s*["\']?(.*?)("|>|\'[>\s])#'.$JtLwsGHOAgAKL7G, $cn, $VTQP1ue8oY1PvdK); if($grab_parameters['xs_parse_swf']) preg_match_all('#<object[^>]*application/x-shockwave-flash[^>]*data\s*=\s*["\']([^"\'>]+).*?>#'.$JtLwsGHOAgAKL7G, $cn, $yyq7fDoK_cBPACC6n1);
																													
																													else $yyq7fDoK_cBPACC6n1 = array(array(),array());
																													
																													
																													preg_match_all('#<a[^>]*?onclick\s*=\s*"[^"]*\.load\(\'([^\']*)#'.$JtLwsGHOAgAKL7G, $cn, $JcUJ6noUPUWESUgG);
																													
																													
																													$hhpOPvD3FyvIjyMCBEE = array();
																													
																													for($i=0;$i<count($am[1]);$i++)
																													
																													{
																													
																													if( !preg_match('#rel\s*=\s*["\']?\s*(nofollow|stylesheet|publisher)#i', $am[0][$i]) ) 
																													
																													$hhpOPvD3FyvIjyMCBEE[] = $am[1][$i];
																													
																													}
																													
																													$hhpOPvD3FyvIjyMCBEE = @array_merge(
																													
																													$hhpOPvD3FyvIjyMCBEE,
																													
																													
																													$am[2],$am[3],  
																													
																													$RXZaXpOvdbjwY[1],$VTQP1ue8oY1PvdK[1],
																													
																													$Kl6oIfEwKD_U[1],$JcUJ6noUPUWESUgG[1],
																													
																													$yyq7fDoK_cBPACC6n1[1]);
																													
																													}
																													
																													$hhpOPvD3FyvIjyMCBEE = array_unique($hhpOPvD3FyvIjyMCBEE);
																													
																													
																													
																													$nn = $nt = 0;
																													
																													reset($hhpOPvD3FyvIjyMCBEE);
																													
																													if(isset($grab_parameters['xs_robotstxt']) && $grab_parameters['xs_robotstxt'])
																													
																													if(preg_match('#<meta\s*name=[\'"]robots[\'"]\s*content=[\'"][^\'"]*?nofollow#is',$cn))
																													
																													$hhpOPvD3FyvIjyMCBEE = array();
																													
																													if(!$runstate['charset']){
																													
																													if(preg_match('#<meta\s+http-equiv\s*=\s*"?content-type"?[^>]*?charset=([^">]*)"#is',$cn, $DGsLKvCm27eV))
																													
																													$runstate['charset'] = $DGsLKvCm27eV[1];
																													
																													}
																													
																													l_kNDRia9T1o('parse', true);
																													
																													l_kNDRia9T1o('llist');
																													
																													foreach($hhpOPvD3FyvIjyMCBEE as $i=>$ll)
																													
																													if($ll)
																													
																													{                    
																													
																													$a = $sa = trim($ll);
																													
																													
																													if($grab_parameters['xs_proto_skip'] && 
																													
																													(preg_match('#^'.$grab_parameters['xs_proto_skip'].'#i',$a)||
																													
																													($this->k2mbaYG7Adhhp0nn && preg_match('#'.$grab_parameters['xs_exc_skip'].'#i',$a))||
																													
																													preg_match('#^'.$grab_parameters['xs_proto_skip'].'#i',function_exists('html_entity_decode')?html_entity_decode($a):$a)
																													
																													))
																													
																													continue;
																													
																													
																													if(strlen($a) > 4096) continue;
																													
																													$PfbhgdTernTpzDj = $this->W5mf7Y9Huk0KaQU6($a, $dr1lN9apl, $e5V6M6TL5, $CmZLfMuLMSEZIiTevcX, $Qv8G6NWw9S0ZcPxVV);
																													
																													if($PfbhgdTernTpzDj == 1)
																													
																													{
																													
																													if($grab_parameters['xs_extlinks'] &&
																													
																													(!$grab_parameters['xs_extlinks_excl'] || !preg_match('#'.$this->FyqopbSBljsknT1TH($grab_parameters['xs_extlinks_excl']).'#',$a)) &&
																													
																													(!$grab_parameters['xs_ext_max'] || (count($urls_ext)<$grab_parameters['xs_ext_max']))
																													
																													)
																													
																													{
																													
																													if(!$urls_ext[$a] && 
																													
																													(!$grab_parameters['xs_ext_skip'] || 
																													
																													!preg_match('#'.$grab_parameters['xs_ext_skip'].'#',$a)
																													
																													)
																													
																													)
																													
																													$urls_ext[$a] = $OCFdVAYmxKRN;
																													
																													}
																													
																													continue;
																													
																													}
																													
																													$kxesmZvVXn = $PfbhgdTernTpzDj ? $a : substr($a,strlen($Qv8G6NWw9S0ZcPxVV));
																													
																													$kxesmZvVXn = str_replace(' ', '%20', $kxesmZvVXn);
																													
																													if($urls_list_full[$kxesmZvVXn] || ($kxesmZvVXn == $dr1lN9apl))
																													
																													continue;
																													
																													if($grab_parameters['xs_exclude_check'])
																													
																													{
																													
																													$_f=$_f2=false;
																													
																													$_f=$this->PTs_k_pSWM2EJfY&&preg_match('#('.$this->PTs_k_pSWM2EJfY.')#',$kxesmZvVXn);
																													
																													if($this->rc3b9mqz2jbp&&!$_f)
																													
																													foreach($this->rc3b9mqz2jbp as $bm)
																													
																													$_f = $_f||preg_match('#^('.$bm.')#',$this->euVHgD2C1lt.$kxesmZvVXn);
																													
																													
																													
																													if($_f)continue;
																													
																													}
																													
																													iRDSo8Ka5xIhzQ("<u>[$kxesmZvVXn]</u><br>\n",2);//exit;
																													
																													$urls_list2[$kxesmZvVXn]++;
																													
																													if(
																													
																													$grab_parameters['xs_ref_list_store'] &&
																													
																													($_rlmax = $grab_parameters['xs_ref_list_max'])
																													
																													){
																													
																													if(
																													
																													(isset($ref_links_list[$kxesmZvVXn])
																													
																													|| count($ref_links_list)<$_rlmax)
																													
																													&&    					
																													
																													(count($ref_links_list[$kxesmZvVXn])<max(1,intval($grab_parameters['xs_maxref'])))
																													
																													)
																													
																													{
																													
																													if(!$ref_links_list[$kxesmZvVXn])
																													
																													$ref_links_list[$kxesmZvVXn] = array();
																													
																													if(!in_array($dr1lN9apl, $ref_links_list[$kxesmZvVXn]))
																													
																													$ref_links_list[$kxesmZvVXn][] = $dr1lN9apl;
																													
																													}
																													
																													}
																													
																													if($grab_parameters['xs_maxref'] && count($ref_links[$kxesmZvVXn])<$grab_parameters['xs_maxref'])
																													
																													$ref_links[$kxesmZvVXn][] = $dr1lN9apl;
																													
																													$nt++;
																													
																													}
																													
																													unset($hhpOPvD3FyvIjyMCBEE);
																													
																													l_kNDRia9T1o('llist', true);
																													
																													}
																													
																													}
																													
																													
																													$tYiNjhlwUEh9E5qV2BL = count($urls_list2);
																													
																													l_kNDRia9T1o('analyze', true);
																													
																													l_kNDRia9T1o('post');
																													
																													if($grab_parameters['xs_incl_only'] && !$f){
																													
																													global $RnoNyRLhNgCUZ;
																													
																													if(!isset($RnoNyRLhNgCUZ)){
																													
																													$RnoNyRLhNgCUZ = $grab_parameters['xs_incl_only'];
																													
																													if(!preg_match('#[\*\$]#',$RnoNyRLhNgCUZ))
																													
																													$RnoNyRLhNgCUZ = preg_quote($RnoNyRLhNgCUZ,'#');
																													
																													$RnoNyRLhNgCUZ = '#'.str_replace(' ', '|', $RnoNyRLhNgCUZ).'#';
																													
																													}
																													
																													$f = $f || !preg_match($RnoNyRLhNgCUZ,$Qv8G6NWw9S0ZcPxVV.$dr1lN9apl);
																													
																													}
																													
																													if($_fex['f3']) {
																													
																													$f = true;
																													
																													}
																													
																													if(!$f)
																													
																													if(isset($grab_parameters['xs_robotstxt']) && $grab_parameters['xs_robotstxt'])
																													
																													{
																													
																													$f = $f||preg_match('#<meta\s*name=[\'"]robots[\'"]\s*content=[\'"][^\'"]*?noindex#is',$cn,$_cm);
																													
																													if($f)$AAKKoivMoSg5s_ = 'mrob';
																													
																													}
																													
																													if(!$f)
																													
																													{
																													
																													if(!$HF6NqOcvPqnbh7) {
																													
																													$HF6NqOcvPqnbh7 = array(
																													
																													
																													'link' => preg_replace('#//+$#','/', 
																													
																													preg_replace('#^([^/\:\?]/)/+#','\\1', 
																													
																													(preg_match('#^\w+://#',$dr1lN9apl) ? $dr1lN9apl : $Qv8G6NWw9S0ZcPxVV . $dr1lN9apl)
																													
																													))
																													
																													);
																													
																													if($grab_parameters['xs_makehtml']||$grab_parameters['xs_makeror']||$grab_parameters['xs_rssinfo'])
																													
																													{
																													
																													preg_match('#<title>([^<]*?)</title>#is', $Zul57HOZFkqdgOyF8['content'], $LlGyBWOGj6);
																													
																													$HF6NqOcvPqnbh7['t'] = strip_tags($LlGyBWOGj6[1]);
																													
																													}
																													
																													if($grab_parameters['xs_metadesc'])
																													
																													{
																													
																													preg_match('#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?description[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $fWgJGdfFV);
																													
																													if($fWgJGdfFV[1])
																													
																													$HF6NqOcvPqnbh7['d'] = $fWgJGdfFV[1];
																													
																													}
																													
																													if($grab_parameters['xs_makeror']||$grab_parameters['xs_autopriority'])
																													
																													$HF6NqOcvPqnbh7['o'] = max(0,$links_level);
																													
																													if($PCXq2qAOCLzx1N)
																													
																													$HF6NqOcvPqnbh7['p'] = $PCXq2qAOCLzx1N;
																													
																													if(preg_match('#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?last-modified[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $fWgJGdfFV)){
																													
																													$HF6NqOcvPqnbh7['clm'] = str_replace('@',' ',$fWgJGdfFV[1]);
																													
																													}
																													
																													if(preg_match('#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?changefreq[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $fWgJGdfFV)){
																													
																													$HF6NqOcvPqnbh7['f'] = $fWgJGdfFV[1];
																													
																													}else
																													
																													if(preg_match('#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?revisit-after[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $fWgJGdfFV)){
																													
																													if(preg_match('#(\d+)\s*hour#',$fWgJGdfFV[1])){
																													
																													$HF6NqOcvPqnbh7['f'] = 'hourly';
																													
																													}
																													
																													if(preg_match('#(\d+)\s*month#',$fWgJGdfFV[1])){
																													
																													$HF6NqOcvPqnbh7['f'] = 'monthly';
																													
																													}
																													
																													if(preg_match('#(\d+)\s*day#',$fWgJGdfFV[1], $fWgJGdfFV)){
																													
																													$d = $fWgJGdfFV[1]+0;
																													
																													if($d<4)$HF6NqOcvPqnbh7['f'] = 'daily';
																													
																													else
																													
																													if($d<22)$HF6NqOcvPqnbh7['f'] = 'weekly';
																													
																													else
																													
																													$HF6NqOcvPqnbh7['f'] = 'monthly';
																													
																													}
																													
																													}
																													
																													if(preg_match('#'.$UDWzqkbDps6LuIKb.'#',$Qv8G6NWw9S0ZcPxVV.$dr1lN9apl,$BGKIqn_HME))
																													
																													{
																													
																													for($_i=0;$_i<count($BGKIqn_HME);$_i++)
																													
																													{
																													
																													if($BGKIqn_HME[$_i+1])
																													
																													break;
																													
																													}
																													
																													if($fjEvozDHHFDc3M3CP6e[$_i]) {
																													
																													if(!$HF6NqOcvPqnbh7['clm'])
																													
																													$HF6NqOcvPqnbh7['clm'] = $fjEvozDHHFDc3M3CP6e[$_i]['lm'];
																													
																													if(!$HF6NqOcvPqnbh7['f'])
																													
																													$HF6NqOcvPqnbh7['f'] = $fjEvozDHHFDc3M3CP6e[$_i]['f'];
																													
																													$HF6NqOcvPqnbh7['p'] = $fjEvozDHHFDc3M3CP6e[$_i]['p'];
																													
																													}
																													
																													}
																													
																													
																													
																													
																													
																													if($grab_parameters['xs_hreflang']){
																													
																													if(preg_match_all('#<link[^>]*hreflang\s*=\s*"([^">]*?)"[^>]*href\s*=\s*[\'"]([^>]*?)[\'"]#is', $cn, $F7FR0DideE_fz_9txX, PREG_SET_ORDER)) {
																													
																													
																													$_la = array();
																													
																													foreach($F7FR0DideE_fz_9txX as $_alt){
																													
																													$_la[] = array('l' => $_alt[1], 'u' => $_alt[2]);
																													
																													}
																													
																													$HF6NqOcvPqnbh7['hl'] = $_la;
																													
																													}
																													
																													}
																													
																													if($grab_parameters['xs_lastmod_notparsed'] && $f2)
																													
																													{
																													
																													$Zul57HOZFkqdgOyF8 = $kgQxFsRGfcjLoo9_->fetch($OCFdVAYmxKRN, 0, 1, false, "", array('req'=>'HEAD'));
																													
																													
																													}
																													
																													if(!$HF6NqOcvPqnbh7['lm'] && isset($Zul57HOZFkqdgOyF8['headers']['last-modified']))
																													
																													$HF6NqOcvPqnbh7['lm'] = $Zul57HOZFkqdgOyF8['headers']['last-modified'];
																													
																													}
																													
																													l_kNDRia9T1o('post', true);
																													
																													l_kNDRia9T1o('post-save1');
																													
																													iRDSo8Ka5xIhzQ("\n((include ".$HF6NqOcvPqnbh7['link']."))<br />\n");
																													
																													$elNljYZlpLLDN = true;
																													
																													if($grab_parameters['xs_memsave'])
																													
																													{
																													
																													Jzvvi5906fScvwvc6H($PftdNZ9fEP0Z1yoaR, $HF6NqOcvPqnbh7);
																													
																													$urls_completed[] = $PftdNZ9fEP0Z1yoaR;
																													
																													}else
																													
																													$urls_completed[] = serialize($HF6NqOcvPqnbh7);
																													
																													$AbGonU3oVS++;
																													
																													
																													l_kNDRia9T1o('post-save1',true);
																													
																													l_kNDRia9T1o('post-save2');
																													
																													if($grab_parameters['xs_prev_sm_base']
																													
																													&& $Am1CLOE5I &&
																													
																													preg_match('#('.$Am1CLOE5I.')#',$dr1lN9apl)){
																													
																													$sm_base[$dr1lN9apl] = $HF6NqOcvPqnbh7;
																													
																													}
																													
																													$UfCbPMkJL7hFdCsb = $xvFrf391xp7S2I - $AbGonU3oVS;
																													
																													l_kNDRia9T1o('post-save2',true);
																													
																													}
																													
																													}while(false);// zerowhile
																													
																													l_kNDRia9T1o('post-progress1');
																													
																													if($url_ind>=$cnu)
																													
																													{
																													
																													unset($urls_list);
																													
																													$url_ind = 0;
																													
																													$urls_list = $urls_list2;
																													
																													
																													$urls_list_full += $urls_list;
																													
																													$cnu = count($urls_list);
																													
																													unset($ref_links2);
																													
																													$ref_links2 = $ref_links;
																													
																													unset($ref_links); unset($urls_list2);
																													
																													$ref_links = array();
																													
																													$urls_list2 = array();
																													
																													$links_level++;
																													
																													iRDSo8Ka5xIhzQ("\n<br>NEXT LEVEL:$links_level<br />\n");
																													
																													}
																													
																													if(!$elNljYZlpLLDN){
																													
																													
																													iRDSo8Ka5xIhzQ("\n({skipped ".$dr1lN9apl." - $AAKKoivMoSg5s_})<br />\n");
																													
																													if(!$grab_parameters['xs_chlog_list_max'] ||
																													
																													count($urls_list_skipped) < $grab_parameters['xs_chlog_list_max']) {
																													
																													$urls_list_skipped[$dr1lN9apl] = $AAKKoivMoSg5s_;
																													
																													}
																													
																													}
																													
																													l_kNDRia9T1o('post-progress1',true);
																													
																													l_kNDRia9T1o('post-progress2');
																													
																													$pn++;
																													
																													$JlJYKIIrEYn6=explode(" ",microtime());
																													
																													$ctime = $JlJYKIIrEYn6[0]+$JlJYKIIrEYn6[1] - $g9O9SeHS367Ji;
																													
																													dULsz8pA0Aoo();
																													
																													$pl=min($cnu-$url_ind,$UfCbPMkJL7hFdCsb);
																													
																													l_kNDRia9T1o('post-progress2',true);
																													
																													l_kNDRia9T1o('post-progress3');
$_ut = ($ctime - $d_ZPoolAGnzklRH > 5);
																													
																													if( ($cnu==$url_ind || $pl==0||$pn==1 || ($pn%$grab_parameters['xs_progupdate'])==0)
																													
																													|| $_ut
																													
																													|| $AbGonU3oVS>=$xvFrf391xp7S2I)
																													
																													{
																													
																													
																													$d_ZPoolAGnzklRH = $Fpei00GZKLxgY3rk;
																													
																													if($QxoEWBD1O1qswq3ii && strstr($QxoEWBD1O1qswq3ii['content'],'header'))break;
																													
																													global $m8;
																													
																													$mu = function_exists('memory_get_usage') ? memory_get_usage() : '-';
																													
																													$PRKe3jTsdEw9doYFe = max($PRKe3jTsdEw9doYFe, $mu);
																													
																													if($mu>$m8+1000000){
																													
																													$m8 = $mu;
																													
																													$cc = ' style="color:red"';
																													
																													}else 
																													
																													$cc='';
																													
																													if(intval($mu))
																													
																													$mu = number_format($mu/1024,1).' Kb';
																													
																													iRDSo8Ka5xIhzQ("\n(<span".$cc.">memory".($cc?' up':'').": $mu</span>)<br>\n");
																													
																													$bn0GubjxW3nLmpyxamZ = ($AbGonU3oVS>=$xvFrf391xp7S2I) || ($url_ind>=$cnu);
																													
																													$progpar = array(
																													
																													$ctime, // 0. running time
																													
																													str_replace($KCZQduSVvXZZGY28, '', $dr1lN9apl),  // 1. current URL
																													
																													$pl,                    // 2. urls left
																													
																													$pn,                    // 3. processed urls
																													
																													$tsize,                 // 4. bandwidth usage
																													
																													$links_level,           // 5. depth level
																													
																													$mu,                    // 6. memory usage
																													
																													$AbGonU3oVS, // 7. added in sitemap
																													
																													$tYiNjhlwUEh9E5qV2BL,     // 8. in the queue
																													
																													$nettime,	// 9. network time
																													
																													$RJhfKMpNS, // 10. last net time
																													
																													$fetch_no // 11. fetched urls
																													
																													);
																													
																													if($XIlk3ZqbSYG['bgexec']){
																													
																													if((time()-$LG9QHtb6yK6qR5InZ)>LDd7bqg5_C('xs_state_interval',5)){
																													
																													$LG9QHtb6yK6qR5InZ = time();
																													
																													$progpar[] = WOhaMyP5Ou1gzA6c();
																													
																													XNUfCNwhY4T(aHYbmExGS2Xg9WZI,mVTd3cRsYoUPyznbMc($progpar));
																													
																													}
																													
																													}
																													
																													if($QmKaHsN_mnHEfYSpTEg && (!$f || $_ut))
																													
																													$QmKaHsN_mnHEfYSpTEg($progpar);
																													
																													
																													}
																													
																													else
																													
																													{
																													
																													$QmKaHsN_mnHEfYSpTEg(array('cmd'=>'ping', 'bg' => $XIlk3ZqbSYG['bgexec']));
																													
																													}
																													
																													l_kNDRia9T1o('post-progress3',true);
																													
																													l_kNDRia9T1o('post-progress4');
																													
																													if(!$m6fVuAl9ToHa4iiKa) {
																													
																													
																													if($m6fVuAl9ToHa4iiKa = UhW8Rxuh0rGTpQQ()){
																													
																													if(!@Tqxf4L13C0B33yiyrv($m6fVuAl9ToHa4iiKa))
																													
																													$m6fVuAl9ToHa4iiKa=0;
																													
																													}
																													
																													}
																													
																													if($grab_parameters['xs_exec_time'] && 
																													
																													((time()-$nipU07LHK6q) > $grab_parameters['xs_exec_time']) ){
																													
																													$m6fVuAl9ToHa4iiKa = 'Time limit exceeded - '.($grab_parameters['xs_exec_time']).' - '.(time()-$nipU07LHK6q);
																													
																													}
																													
																													if($grab_parameters['xs_savestate_time']>0 &&
																													
																													( 
																													
																													($ctime-$Gj_L98sRGD>$grab_parameters['xs_savestate_time'])
																													
																													|| $bn0GubjxW3nLmpyxamZ
																													
																													|| $m6fVuAl9ToHa4iiKa
																													
																													)
																													
																													)
																													
																													{
																													
																													$Gj_L98sRGD = $ctime;
																													
																													iRDSo8Ka5xIhzQ("(saving dump)<br />\n");
																													
																													$qhPWndLyX4Mr = compact('url_ind',
																													
																													'urls_list','urls_list2','cnu',
																													
																													'ref_links','ref_links2','ref_links_list',
																													
																													'urls_list_full','urls_completed',
																													
																													'urls_404',
																													
																													'nt','tsize','pn','links_level','ctime', 'urls_ext','fetch_no',
																													
																													'starttime', 'retrno', 'nettime', 'urls_list_skipped',
																													
																													'imlist', 'progpar', 'runstate', 'sm_base'
																													
																													);
																													
																													$qhPWndLyX4Mr['time']=time();
																													
																													$NEd4p7VjgbWpEWv8=mVTd3cRsYoUPyznbMc($qhPWndLyX4Mr);
																													
																													XNUfCNwhY4T(Ufz4hdNjXhLx60oBsLt,$NEd4p7VjgbWpEWv8,JAvBiMmjzH,true);
																													
																													unset($qhPWndLyX4Mr);
																													
																													unset($NEd4p7VjgbWpEWv8);
																													
																													}
																													
																													if($grab_parameters['xs_delay_req'] && $grab_parameters['xs_delay_ms'] &&
																													
																													(($iwe5WfZrZZ6OjkL1yFV%$grab_parameters['xs_delay_req'])==0))
																													
																													{
																													
																													sleep(intval($grab_parameters['xs_delay_ms']));
																													
																													}
																													
																													l_kNDRia9T1o('post-progress4', true);
																													
																													}while(!$bn0GubjxW3nLmpyxamZ && !$m6fVuAl9ToHa4iiKa);
																													
																													iRDSo8Ka5xIhzQ("\n\n<br><br>Crawling completed<br>\n");
																													
																													if($_GET['ddbgexit']){
																													
																													echo '<hr><hr><h2>Dbg exit</h2>';
																													
																													echo $kgQxFsRGfcjLoo9_->QIOl3WsIB_0Qmtft.' / '.$kgQxFsRGfcjLoo9_->nettime.'<hr>';
																													
																													echo WOhaMyP5Ou1gzA6c().'<hr>';
																													
																													exit;
																													
																													}
																													
																													return array(
																													
																													'u404'=>$urls_404,
																													
																													'ref_links_list'=>$ref_links_list,
																													
																													'starttime'=>$starttime,
																													
																													'topmu' => $PRKe3jTsdEw9doYFe,
																													
																													'ctime'=>$ctime,
																													
																													'tsize'=>$tsize,
																													
																													'retrno' => $retrno,
																													
																													'nettime' => $nettime,
																													
																													'errmsg'=>'',
																													
																													'initurl'=>$KCZQduSVvXZZGY28,
																													
																													'initdir'=>$Qv8G6NWw9S0ZcPxVV,
																													
																													'ucount'=>$AbGonU3oVS,
																													
																													'crcount'=>$pn,
																													
																													'fetch_no'=>$fetch_no,
																													
																													'time'=>time(),
																													
																													'params'=>$XIlk3ZqbSYG,
																													
																													'interrupt'=>$m6fVuAl9ToHa4iiKa,
																													
																													'runstate' => $runstate,
																													
																													'sm_base' => $sm_base,
																													
																													'urls_ext'=>$urls_ext,
																													
																													'urls_list_skipped' => $urls_list_skipped,
																													
																													'max_reached' => $AbGonU3oVS>=$xvFrf391xp7S2I
																													
																													);
																													
																													}
																													
																													}
																													
																													$wW0lsiDPK2A6wLPce_ = new SiteCrawler();
																													
																													function LBgEBgVZ4z(){
																													
																													@Tqxf4L13C0B33yiyrv(JAvBiMmjzH.nNMzp2IgH7HiM);
																													
																													if(@file_exists(JAvBiMmjzH.aHYbmExGS2Xg9WZI))
																													
																													@rename(JAvBiMmjzH.aHYbmExGS2Xg9WZI,JAvBiMmjzH.nNMzp2IgH7HiM);
																													
																													}
																													
																													



































































































