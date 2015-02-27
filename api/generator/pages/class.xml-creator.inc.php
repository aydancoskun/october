<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$DcdoS81743470hldlz=830583405;$tyghW97530823rpvgd=353156036;$pMinU16111145iHrmz=435714996;$xKnKC31546936WsmQt=984604035;$nnfxP22900695JFnnm=407666901;$LXivL94234925DTdwt=609247345;$Zielh34612121fTGaV=996189118;$fZWUu38094787lkoyW=475835968;$LhUuY73745423rzkvB=453031647;$xCZRn65626526CngqL=834119904;$owgcM72800598fxtBF=26944488;$ghcQB19330139kRCBD=934849152;$WJffI54277649jCTiH=966677643;$lovPS11705627aFspi=28773712;$eIZrD40676575ioNhw=524981110;$zAiaa65252991TxGMV=363643585;$BNfBH54497375hcWEX=949604889;$tYSGF22472229oUmYb=191208770;$WNFkJ28240051DCngY=492298981;$RPJpz85863343fLKhC=760219269;$NXItN74404602yXePx=401813385;$rgtSs97926331gXJkT=322425079;$TqtDJ35491028aUEwQ=927898102;$SLoNN81161194anHJK=126576202;$TEsPg23999328DspEk=322303131;$ippAm58067932HIrrR=422422638;$jHLXA62429504JfkmG=832778473;$lBcKo51146545HLCbz=460714386;$FCzJP83281555aJCuc=711074127;$ffuSk82897034TAQix=491201447;$QjObe19055481BBmOz=206940094;$PvWbV85819397mxizZ=763633820;$YqHhp72251282HukcV=569126373;$RUXFE82413636JEwcr=528761505;$abNbs85368958qRaRd=49382965;$jumid95179749TRbWk=36334503;$MDmhG80908509MnicF=895459870;$VoWKm56617737hLOVT=535102814;$FaYVK81369934CiDlY=360107086;$XwgFf79227600qlZZc=276816437;$MsRJb19253234rFIiq=691074616;$zVMUq95509339yszIB=510225372;$SMYXl97058411PLAWj=140112457;$UoCvA37962951Fdxnb=486079620;$RTNOj67285462MtJTR=954970612;$CVdmu19088440fcpTi=454129181;$baVdG42434387hkQTk=388399078;$nQcew61385803CXMhd=664124054;$JEJry45005188HsvHn=688147858;$EunsD97355042SNtJl=366814239;?><?php if(!class_exists('XMLCreator')) { class XMLCreator { var $it9ClCc0l  = array(); var $r6DB_IVvhDlkKfN53 = array('xml','','','','mobile'); var $XIlk3ZqbSYG = array(); var $runstate = array(); var $wvQenBIS1HM = array(),  $ZgCakt5_FIpA = array(),  $r_lth23q9lblI = array(); var $sr6xk3MKAMAoDi = 1000; var $nTPUGhxIWWT = array(); var $YIrFdD7SrWLpwW3 = array(); function VQAXwSjJPIxpPDQ5i5S(&$m51TO___YwFjZX) { $g192oehb7n = false; $mx = 200; if(is_array($m51TO___YwFjZX)) foreach($m51TO___YwFjZX as $k=>$v){ if(!is_array($v)&&(strlen($v)>$mx)){ $m51TO___YwFjZX[$k] = substr($v, 0, $mx); } if(strlen($k)>$mx){ unset($m51TO___YwFjZX[$k]); $m51TO___YwFjZX[substr($k, 0, $mx)] = $v; } } } function RT9GXtyabs__A($XIlk3ZqbSYG, $urls_completed, $Q5G8QmbQwJT3v) { global $JfRC0egNhxmTca, $I7oacdy2vLiEw; $I7oacdy2vLiEw = array(); if($Ebcaq_YCAyxUIB324G = @kEM8KMpb9E(JAvBiMmjzH.'apicache.db',true)){ $this->nTPUGhxIWWT = @unserialize($Ebcaq_YCAyxUIB324G); }    $this->eQaiLJTAYGEFbJ0D = new jD4RNwgsKAMs("pages/"); $this->XIlk3ZqbSYG = $XIlk3ZqbSYG; $this->runstate = $Q5G8QmbQwJT3v['runstate']; if($this->XIlk3ZqbSYG['xs_chlog_list_max']) $this->sr6xk3MKAMAoDi = $this->XIlk3ZqbSYG['xs_chlog_list_max'];  $pcBcJ2TINs = basename($this->XIlk3ZqbSYG['xs_smname']); $this->uurl_p = dirname($this->XIlk3ZqbSYG['xs_smurl']).'/'; $this->furl_p = dirname($this->XIlk3ZqbSYG['xs_smname']).'/'; $this->imgno = 0; $this->uneVFDEGBQ7F = ($this->XIlk3ZqbSYG['xs_compress']==1) ? '.gz' : ''; $this->wvQenBIS1HM = $this->ZgCakt5_FIpA = $this->urls_prevrss = array(); if($this->XIlk3ZqbSYG['xs_chlog']) $this->wvQenBIS1HM = $this->HNUV_wZE_($pcBcJ2TINs); if($this->XIlk3ZqbSYG['xs_rssinfo']) $this->urls_prevrss = $this->HNUV_wZE_(AUsclCf2r5Z , $this->XIlk3ZqbSYG['xs_rssage'], false, 1); if($this->XIlk3ZqbSYG['xs_newsinfo']) $this->ZgCakt5_FIpA = $this->HNUV_wZE_($this->XIlk3ZqbSYG['xs_newsfilename'], $this->XIlk3ZqbSYG['xs_newsage']); $EA_T0CYlIF6tb7UtP = $DMBYKH29LAIo3CeDMja = array(); $this->eOThR9i3EU = ($this->XIlk3ZqbSYG['xs_compress']==1) ? array('fopen' => 'gzopen', 'fwrite' => 'gzwrite', 'fclose' => 'gzclose' ) : array('fopen' => 'RkxOeH9i8', 'fwrite' => 'zSyg85rKFKJ8zd', 'fclose' => 'fclose' ) ; $HqI1O8vynO4EtneR4A5 = strstr($this->XIlk3ZqbSYG['xs_initurl'],'://www.');
																										 $qZBDe0ba3gtSA0a = $JfRC0egNhxmTca.'/'; if(strstr($this->XIlk3ZqbSYG['xs_initurl'],'https:')) $qZBDe0ba3gtSA0a = str_replace('http:', 'https:', $qZBDe0ba3gtSA0a); $HtFBZd5BGx4HvWf = strstr($qZBDe0ba3gtSA0a,'://www.');
																										 $p1 = parse_url($this->XIlk3ZqbSYG['xs_initurl']); $p2 = parse_url($qZBDe0ba3gtSA0a); if(str_replace('www.', '', $p1['host'])==str_replace('www.', '', $p2['host']))  { if($HqI1O8vynO4EtneR4A5 && !$HtFBZd5BGx4HvWf)$qZBDe0ba3gtSA0a = str_replace('://', '://www.', $qZBDe0ba3gtSA0a);
																										 if(!$HqI1O8vynO4EtneR4A5 && $HtFBZd5BGx4HvWf)$qZBDe0ba3gtSA0a = str_replace('://www.', '://', $qZBDe0ba3gtSA0a);
																										 } $this->XIlk3ZqbSYG['gendom'] = $qZBDe0ba3gtSA0a; $this->Mq7SpvssgXyM($urls_completed, $EA_T0CYlIF6tb7UtP); $this->Jqivy4YQhay18(); if($this->XIlk3ZqbSYG['xs_chlog']) { $MbFeeAu1C  = array_keys($this->r_lth23q9lblI); $hoWmvn1cTy_GjGL = array_slice(array_keys($this->wvQenBIS1HM), 0, $this->sr6xk3MKAMAoDi); } if($this->imgno)$this->it9ClCc0l[1]['xn'] = $this->imgno; if($this->videos_no)$this->it9ClCc0l[2]['xn'] = $this->videos_no; if($this->news_no)$this->it9ClCc0l[3]['xn'] = $this->news_no; $this->VQAXwSjJPIxpPDQ5i5S($MbFeeAu1C); $this->VQAXwSjJPIxpPDQ5i5S($hoWmvn1cTy_GjGL); $KJwBTVXJeYjG = array_merge($Q5G8QmbQwJT3v, array( 'files'   => array(), 'rinfo'   => $this->it9ClCc0l, 'newurls' => $MbFeeAu1C, 'losturls'=> $hoWmvn1cTy_GjGL, 'urls_ext'=> $Q5G8QmbQwJT3v['urls_ext'], 'images_no'  => $this->imgno, 'videos_no' => $this->videos_no, 'news_no'  => $this->newsno, 'rss_no'  => $this->rssno, 'rss_sm'  => $this->XIlk3ZqbSYG['xs_rssfilename'], 'fail_files' => $I7oacdy2vLiEw, 'create_time' => time() )); unset($KJwBTVXJeYjG['sm_base']); $tUOd0ODXTNxNVUNnX9o = array('u404', 'urls_ext', 'urls_list_skipped', 'newurls', 'losturls'); foreach($tUOd0ODXTNxNVUNnX9o as $ca) $this->VQAXwSjJPIxpPDQ5i5S($KJwBTVXJeYjG[$ca]); $JQWUXY4SUxk8P = date('Y-m-d H-i-s').'.log'; XNUfCNwhY4T($JQWUXY4SUxk8P,serialize($KJwBTVXJeYjG),JAvBiMmjzH,true); $this->wvQenBIS1HM = $this->r_lth23q9lblI = $this->ZgCakt5_FIpA = $this->urls_prevrss = array(); $EA_T0CYlIF6tb7UtP = array(); return $KJwBTVXJeYjG; } function hZahAndvJ($QYzbdvM1h){ if(!function_exists('iconv')) return $QYzbdvM1h; return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", $QYzbdvM1h); } function xn22ZOg5Ng($pf) { global $dhX55M168WqsiLMd; if(!$pf)return; $this->eOThR9i3EU['fwrite']($pf, $dhX55M168WqsiLMd[3]); $this->eOThR9i3EU['fclose']($pf); } function fGokyqo8tR33zzFafi3($pf, $o8Jjo6v5ay1) { global $dhX55M168WqsiLMd; if(!$pf)return; $xs = $this->eQaiLJTAYGEFbJ0D->pTRcWpFjH8WqYG74($dhX55M168WqsiLMd[1], array('TYPE'.$o8Jjo6v5ay1=>true)); $this->eOThR9i3EU['fwrite']($pf, $xs); } function FRy4YMXr_PT($DMBYKH29LAIo3CeDMja) { $BOEZH33ntc020 = ""; $uXuHhVh19bb7ylhJo = fweJBhwTM1h(nue1JSywc,  'sitemap_index_tpl.xml'); $QvDl4ihiu9arHlhk1A = file_get_contents(nue1JSywc.$uXuHhVh19bb7ylhJo); preg_match('#^(.*)%SITEMAPS_LIST_FROM%(.*)%SITEMAPS_LIST_TO%(.*)$#is', $QvDl4ihiu9arHlhk1A, $nZ2n3dJmP_TiQ); $nZ2n3dJmP_TiQ[1] = str_replace('%GEN_URL%', $this->XIlk3ZqbSYG['gendom'], $nZ2n3dJmP_TiQ[1]); $J8NZ8Rx5Xj8oKk = preg_replace('#[^\\/]+?\.xml$#', '', $this->XIlk3ZqbSYG['xs_smurl']); $nZ2n3dJmP_TiQ[1] = str_replace('%SM_BASE%', $J8NZ8Rx5Xj8oKk, $nZ2n3dJmP_TiQ[1]); for($i=0;$i<count($DMBYKH29LAIo3CeDMja);$i++) $BOEZH33ntc020.= $this->eQaiLJTAYGEFbJ0D->pTRcWpFjH8WqYG74($nZ2n3dJmP_TiQ[2], array( 'URL'=>$DMBYKH29LAIo3CeDMja[$i], 'LASTMOD'=>date('Y-m-d\TH:i:s+00:00') )); return $nZ2n3dJmP_TiQ[1] . $BOEZH33ntc020 . $nZ2n3dJmP_TiQ[3]; } function wJu5NxAjkFkQBpMse($jnlmADM5fBz3W9, $cDlklVLqKAn_Xc = false, $zAWJdA8vkogW = false) { if($cDlklVLqKAn_Xc){ $t = $jnlmADM5fBz3W9; if(function_exists('utf8_encode') && !$this->XIlk3ZqbSYG['xs_utf8']){ $t2=''; for($i=0;$i<strlen($t);$i++) $t2 .= ((ord($t[$i])>128) ? '&#'.ord($t[$i]).';' : $t[$i]); $t = $t2; $t = utf8_encode($t); $t = htmlentities($t,ENT_COMPAT,'UTF-8'); }else  if($zAWJdA8vkogW){ $t = htmlentities($t, ENT_COMPAT, 'UTF-8'); } $t = preg_replace("#&amp;(\#[\w\d]+;)#", '&$1', $t); $t = str_replace("&", "&amp;", $t); $t = preg_replace("#&amp;((gt|lt|quot|amp|apos);)#", '&$1', $t); $t = preg_replace('#[\x00-\x1F\x7F]#', ' ', $t); }else $t = str_replace("&", "&amp;", $jnlmADM5fBz3W9); if(function_exists('utf8_encode') && !$this->XIlk3ZqbSYG['xs_utf8']) { $t = utf8_encode($t); } return $t; } function m0HngeVPuiULaXDb($Uj5zMY11qaEzIE) { $Uj5zMY11qaEzIE = $this->wJu5NxAjkFkQBpMse(str_replace(array('&nbsp;'),array(''),$Uj5zMY11qaEzIE), true); return $Uj5zMY11qaEzIE; } function ZW04gbhF9A8P($Frzj_1qMUec7w) { global $cDlklVLqKAn_Xc; $l = str_replace("&amp;", "&", $Frzj_1qMUec7w); $l = str_replace("&", "&amp;", $l); $l = strtr($l, $cDlklVLqKAn_Xc); if($this->XIlk3ZqbSYG['xs_utf8']) { }else { if( $this->XIlk3ZqbSYG['xs_url_charset_convert'] && $this->runstate['charset']  && function_exists('iconv') && (strpos($l,'%') === false) )  { if($l2 = iconv($this->runstate['charset'], 'UTF-8', $l)) { if($l != $l2){ $lp = urlencode($l2); $l = str_replace( array('%3A','%2F', '%3F', '%26', '%23', '%3B', '%3D'),  array(':', '/', '?', '&', '#', ';', '='), $lp); } } } if(function_exists('utf8_encode')) $l = utf8_encode($l); } return $l; } function lPT6M7drPhQPL($CZVPHKOWUGz) { $kD52SIPb2Kr_e = array( basename($this->XIlk3ZqbSYG['xs_smname']),  $this->XIlk3ZqbSYG['xs_imgfilename'], $this->XIlk3ZqbSYG['xs_videofilename'], $this->XIlk3ZqbSYG['xs_newsfilename'], $this->XIlk3ZqbSYG['xs_mobilefilename'], ); if($CZVPHKOWUGz['rinfo']) $this->it9ClCc0l = $CZVPHKOWUGz['rinfo']; foreach($this->r6DB_IVvhDlkKfN53 as $o8Jjo6v5ay1=>$PJcxuhwvrlD58h6ut3d) if($PJcxuhwvrlD58h6ut3d) { $this->it9ClCc0l[$o8Jjo6v5ay1]['sitemap_file'] = $kD52SIPb2Kr_e[$o8Jjo6v5ay1]; $this->it9ClCc0l[$o8Jjo6v5ay1]['filenum'] = intval($CZVPHKOWUGz['istart']/$this->dtVinIseWb)+1; if(!$CZVPHKOWUGz['istart']) $this->xnDpYg7WwA0($kD52SIPb2Kr_e[$o8Jjo6v5ay1]); } } function QoPlLvVWe() { global $I7oacdy2vLiEw; $yxmAVLqblWyQgnOJN = 0; $l = false; foreach($this->r6DB_IVvhDlkKfN53 as $o8Jjo6v5ay1=>$PJcxuhwvrlD58h6ut3d) { $ri = &$this->it9ClCc0l[$o8Jjo6v5ay1]; $VJrkoghoW = (($ri['xnp'] % $this->dtVinIseWb) == 0) && ($ri['xnp'] || !$ri['pf']); $l|=$VJrkoghoW; if($this->sm_filesplit && $ri['xchs'] && $ri['xnp']) $VJrkoghoW |= ($ri['xchs']/$ri['xnp']*($ri['xnp']+1)>$this->sm_filesplit); if( $VJrkoghoW ) { $yxmAVLqblWyQgnOJN++; $ri['xchs'] = $ri['xnp'] = 0; $this->xn22ZOg5Ng($ri['pf']); if($ri['filenum'] == 2) { if(!copy(JAvBiMmjzH . $ri['sitemap_file'].$this->uneVFDEGBQ7F,  JAvBiMmjzH.($_xu = SKg9CDNyrraUeOE5uUB(1,$ri['sitemap_file']).$this->uneVFDEGBQ7F))) { $I7oacdy2vLiEw[] = JAvBiMmjzH.$_xu; } $ri['urls'][0] = $this->uurl_p . $_xu; } $Xm5TKOzcDly01EH2 = (($ri['filenum']>1) ? SKg9CDNyrraUeOE5uUB($ri['filenum'],$ri['sitemap_file']) :$ri['sitemap_file']) . $this->uneVFDEGBQ7F; $ri['urls'][] = $this->uurl_p . $Xm5TKOzcDly01EH2; $ri['filenum']++; $ri['pf'] = $this->eOThR9i3EU['fopen'](JAvBiMmjzH.$Xm5TKOzcDly01EH2,'w'); if(!$ri['pf']) $I7oacdy2vLiEw[] = JAvBiMmjzH.$Xm5TKOzcDly01EH2; $this->fGokyqo8tR33zzFafi3($ri['pf'], $o8Jjo6v5ay1); } } return $l; } function NxXizlvv02GJW($aVVIJaQygc, $dhX55M168WqsiLMd, $o8Jjo6v5ay1) { $aVVIJaQygc['TYPE'.$o8Jjo6v5ay1] = true; $ri = &$this->it9ClCc0l[$o8Jjo6v5ay1]; if($ri['pf']) { $_xu = $this->eQaiLJTAYGEFbJ0D->pTRcWpFjH8WqYG74($dhX55M168WqsiLMd, $aVVIJaQygc); $ri['xchs'] += strlen($_xu); $ri['xn']++; $ri['xnp']++; $this->eOThR9i3EU['fwrite']($ri['pf'], $_xu); } }  function lqQshuQq_Yx_SG() { foreach($this->it9ClCc0l as $o8Jjo6v5ay1=>$ri) { $this->xn22ZOg5Ng($ri['pf']); } } function Jqivy4YQhay18() { foreach($this->r6DB_IVvhDlkKfN53 as $o8Jjo6v5ay1=>$PJcxuhwvrlD58h6ut3d) { $ri = &$this->it9ClCc0l[$o8Jjo6v5ay1]; if(count($ri['urls'])>1) { $xf = $this->FRy4YMXr_PT($ri['urls']); array_unshift($ri['urls'],  $this->uurl_p.XNUfCNwhY4T($ri['sitemap_file'], $xf, JAvBiMmjzH, ($this->XIlk3ZqbSYG['xs_compress']==1)) ); } $this->cVhR96lmkjBRF($ri['sitemap_file']); } } function QYWCGBQX7GggVu4($PGvQRa41twTzn3) { global $kgQxFsRGfcjLoo9_; if(!isset($this->nTPUGhxIWWT[$PGvQRa41twTzn3]) || !$this->nTPUGhxIWWT[$PGvQRa41twTzn3] || strstr($this->nTPUGhxIWWT[$PGvQRa41twTzn3]['code'],'403') ){ $_tr=4; while($_tr>0){ $fd = $kgQxFsRGfcjLoo9_->fetch($PGvQRa41twTzn3, 0,true, false, '', array('skipip' => true,'anytype'=>true)); $_tr--; if(strstr($fd['code'],'200'))$_tr=0; else sleep(3); } $this->nTPUGhxIWWT[$PGvQRa41twTzn3] = $fd; XNUfCNwhY4T('apicache.db',serialize($this->nTPUGhxIWWT),JAvBiMmjzH,true); } return $this->nTPUGhxIWWT[$PGvQRa41twTzn3]; } function auVkxxOODzL2($stxW9L9LSuFf0cBeF) { 
																										return $stxW9L9LSuFf0cBeF;
																										}
																										function Mq7SpvssgXyM($urls_completed, &$EA_T0CYlIF6tb7UtP)
																										{
																										global $dhX55M168WqsiLMd, $qyrBCAYqEMp, $eA1uPQAzcVCQ8, $sm_proc_list, $CZVPHKOWUGz, $icjv1vts4FNnWEAa7ef, $I7oacdy2vLiEw;
																										$oDpbA930JAaWHLhY = $this->XIlk3ZqbSYG['xs_chlog'];
																										$uXuHhVh19bb7ylhJo = fweJBhwTM1h(nue1JSywc,  'sitemap_xml_tpl.xml');
																										$QvDl4ihiu9arHlhk1A = file_get_contents(nue1JSywc.$uXuHhVh19bb7ylhJo);
																										preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $QvDl4ihiu9arHlhk1A, $dhX55M168WqsiLMd);
																										$dhX55M168WqsiLMd[1] = str_replace('www.xml-sitemaps.com', 'www.xml-sitemaps.com ('. vZKpEamsDiBU.')', $dhX55M168WqsiLMd[1]);
																										$dhX55M168WqsiLMd[1] = str_replace('%GEN_URL%', $this->XIlk3ZqbSYG['gendom'], $dhX55M168WqsiLMd[1]);
																										$J8NZ8Rx5Xj8oKk = preg_replace('#[^\\/]+?\.xml$#', '', $this->XIlk3ZqbSYG['xs_smurl']);
																										$dhX55M168WqsiLMd[1] = str_replace('%SM_BASE%', $J8NZ8Rx5Xj8oKk, $dhX55M168WqsiLMd[1]);
																										if($this->XIlk3ZqbSYG['xs_disable_xsl'])
																										$dhX55M168WqsiLMd[1] = preg_replace('#<\?xml-stylesheet.*\?>#', '', $dhX55M168WqsiLMd[1]);
																										if($this->XIlk3ZqbSYG['xs_nobrand']){
																										$dhX55M168WqsiLMd[1] = str_replace('sitemap.xsl','sitemap_nb.xsl',$dhX55M168WqsiLMd[1]);
																										$dhX55M168WqsiLMd[1] = preg_replace('#<!-- created.*?>#','',$dhX55M168WqsiLMd[1]);
																										}
																										$dFOsOrGrftDYFF = implode('', file(nue1JSywc.'sitemap_ror_tpl.xml'));
																										preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $dFOsOrGrftDYFF, $qyrBCAYqEMp);
																										$baLr5ayef = implode('', file(nue1JSywc.'sitemap_rss_tpl.xml'));
																										preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $baLr5ayef, $qNmmXd_uegk0tE9Fi);
																										$fRRNOswmJ = implode('', file(nue1JSywc.'sitemap_base_tpl.xml'));
																										preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $fRRNOswmJ, $eA1uPQAzcVCQ8);
																										$this->dtVinIseWb = $this->XIlk3ZqbSYG['xs_sm_size']?$this->XIlk3ZqbSYG['xs_sm_size']:50000;
																										$this->sm_filesplit = $this->XIlk3ZqbSYG['xs_sm_filesize']?$this->XIlk3ZqbSYG['xs_sm_filesize']:10;
																										$this->sm_filesplit = max(intval($this->sm_filesplit*1024*1024),2000)-1000;
																										if(isset($this->XIlk3ZqbSYG['xs_webinfo']) && !$this->XIlk3ZqbSYG['xs_webinfo'])
																										unset($this->r6DB_IVvhDlkKfN53[0]);
																										if(!$this->XIlk3ZqbSYG['xs_imginfo'])
																										unset($this->r6DB_IVvhDlkKfN53[1]);
																										if(!$this->XIlk3ZqbSYG['xs_videoinfo'])
																										unset($this->r6DB_IVvhDlkKfN53[2]);
																										if(!$this->XIlk3ZqbSYG['xs_newsinfo'])
																										unset($this->r6DB_IVvhDlkKfN53[3]);
																										if(!$this->XIlk3ZqbSYG['xs_makemob'])
																										unset($this->r6DB_IVvhDlkKfN53[4]);
																										if(!$this->XIlk3ZqbSYG['xs_rssinfo'])
																										unset($this->r6DB_IVvhDlkKfN53[5]);
																										$_alang = preg_split('#[\r\n]+#', $this->XIlk3ZqbSYG['xs_alt_lang']);
																										$_aurl = '';
																										foreach($_alang as $v){
																										$me = explode(' ', $v);
																										if($me[1]) {
																										$this->YIrFdD7SrWLpwW3[$_aurl][] = array('l' => $me[0], 'u' => $me[1]);
																										}else {
																										$_aurl = $v;
																										$this->YIrFdD7SrWLpwW3[$_aurl] = array();
																										}
																										}
																										$ctime = date('Y-m-d H:i:s');
																										$SQEm27RfvIaD6r = 0;
																										global $cDlklVLqKAn_Xc;
																										$tt = array('<','>');
																										foreach ($tt as $JxsQWbvuZdjq9Bnq )
																										$cDlklVLqKAn_Xc[$JxsQWbvuZdjq9Bnq] = '&#'.ord($JxsQWbvuZdjq9Bnq).';';
																										for($i=0;$i<31;$i++)
																										$cDlklVLqKAn_Xc[chr($i)] = '';
																										
																										$cDlklVLqKAn_Xc[chr(0)] = $cDlklVLqKAn_Xc[chr(10)] = $cDlklVLqKAn_Xc[chr(13)] = '';
																										$cDlklVLqKAn_Xc[' '] = '%20';
																										$pf = 0;
																										
																										$zBrcoOLlPpcleQ = intval($CZVPHKOWUGz['istart']);
																										$this->lPT6M7drPhQPL($CZVPHKOWUGz);
																										if($this->XIlk3ZqbSYG['xs_maketxt'])
																										{
																										$S6zsGHiQqbyS93wtuJ = $this->eOThR9i3EU['fopen'](zDZfnOkYHwV.$this->uneVFDEGBQ7F, $zBrcoOLlPpcleQ?'a':'w');
																										if(!$S6zsGHiQqbyS93wtuJ)$I7oacdy2vLiEw[] = zDZfnOkYHwV.$this->uneVFDEGBQ7F;
																										}
																										if($this->XIlk3ZqbSYG['xs_makeror'])
																										{
																										$kKd42AXcG3p = RkxOeH9i8(A9WzwJYtTB0O3GkI69, $zBrcoOLlPpcleQ?'a':'w');
																										$rc = str_replace('%INIT_URL%', $this->XIlk3ZqbSYG['xs_initurl'], $qyrBCAYqEMp[1]);
																										if($kKd42AXcG3p)
																										zSyg85rKFKJ8zd($kKd42AXcG3p, $rc);
																										else
																										$I7oacdy2vLiEw[] = A9WzwJYtTB0O3GkI69;
																										}
																										if($this->XIlk3ZqbSYG['xs_rssinfo'])
																										{
																										$G9ScpFWiExG = $this->uurl_p . basename(AUsclCf2r5Z);
																										$UaofOtwTIyf = AUsclCf2r5Z;
																										$cLGNu3fjIGa = RkxOeH9i8($UaofOtwTIyf, $zBrcoOLlPpcleQ?'a':'w');
																										$rc = str_replace('%INIT_URL%', $this->XIlk3ZqbSYG['xs_initurl'], $qNmmXd_uegk0tE9Fi[1]);
																										$rc = str_replace('%FEED_TITLE%', $this->XIlk3ZqbSYG['xs_rsstitle'], $rc);
																										$rc = str_replace('%BUILD_DATE%', gmdate('D, d M Y H:i:s +0000'), $rc);
																										$rc = str_replace('%SELF_URL%', $G9ScpFWiExG, $rc);
																										if($cLGNu3fjIGa)
																										zSyg85rKFKJ8zd($cLGNu3fjIGa, $rc);
																										else
																										$I7oacdy2vLiEw[] = $UaofOtwTIyf;
																										}
																										if($sm_proc_list)
																										foreach($sm_proc_list as $k=>$lrwvB0xvcXXumi3V)
																										$sm_proc_list[$k]->tuhOqyefnq6RVW($this->XIlk3ZqbSYG, $this->eOThR9i3EU, $this->eQaiLJTAYGEFbJ0D);
																										if($this->XIlk3ZqbSYG['xs_write_delay'])
																										list($sQy6U3e_rh2YW, $aeUWWdnqzr5WR) = explode('|',$this->XIlk3ZqbSYG['xs_write_delay']);
																										for($i=$xn=$zBrcoOLlPpcleQ;$i<count($urls_completed);$i++,$xn++)
																										{   
																										
																										
																										
																										if($i%100 == 0) {
																										dULsz8pA0Aoo();
																										iRDSo8Ka5xIhzQ(" / $i / ".(time()-$_tm));
																										$_tm=time();
																										}
																										PvEr4n2DQ(array(
																										'cmd'=> 'info',
																										'id' => 'percprog',
																										'text'=> number_format($i*100/count($urls_completed),0).'%'
																										));
																										$yxmAVLqblWyQgnOJN = $this->QoPlLvVWe();
																										if($yxmAVLqblWyQgnOJN && ($i != $zBrcoOLlPpcleQ))
																										{
																										XNUfCNwhY4T($icjv1vts4FNnWEAa7ef,mVTd3cRsYoUPyznbMc(array('istart'=>$i,'rinfo'=>$this->it9ClCc0l)));
																										}
																										if($this->XIlk3ZqbSYG['xs_memsave'])
																										{
																										$cu = CIob_g5skJ($urls_completed[$i]);
																										}else
																										$cu = $urls_completed[$i];
																										if(!is_array($cu)) $cu = @unserialize($cu);
																										$l = $this->ZW04gbhF9A8P($cu['link']);
																										$cu['link'] = $l;
																										$t = $this->wJu5NxAjkFkQBpMse($cu['t'], true, true);
																										$d = $this->wJu5NxAjkFkQBpMse($cu['d'] ? $cu['d'] : $cu['t'], true, true);
																										$rPpV2duBzldWXxW3Mr = '';
																										if($cu['clm'] && ($gnFe1_ACf3THo5fSVT = preg_replace('#\s+[a-z]+$#is', '', $cu['clm'])) && strtotime($gnFe1_ACf3THo5fSVT))
																										$rPpV2duBzldWXxW3Mr = $gnFe1_ACf3THo5fSVT;
																										else
																										switch($this->XIlk3ZqbSYG['xs_lastmod']){
																										case 1:$rPpV2duBzldWXxW3Mr = $cu['lm']?$cu['lm']:$ctime;break;
																										case 2:$rPpV2duBzldWXxW3Mr = $ctime;break;
																										case 3:$rPpV2duBzldWXxW3Mr = $this->XIlk3ZqbSYG['xs_lastmodtime'];break;
																										}
																										
																										$C8YeeJvXHpz7ff = $SXuHGf1Vd = false;
																										if($cu['p'])
																										$p = $cu['p'];
																										else
																										{
																										$p = $this->XIlk3ZqbSYG['xs_priority'];
																										if($this->XIlk3ZqbSYG['xs_autopriority'])
																										{
																										$p = $p*pow($this->XIlk3ZqbSYG['xs_descpriority']?$this->XIlk3ZqbSYG['xs_descpriority']:0.8,$cu['o']);
																										if($this->wvQenBIS1HM)
																										{
																										$C8YeeJvXHpz7ff = true;
																										$SXuHGf1Vd = ($this->wvQenBIS1HM&&!isset($this->wvQenBIS1HM[$cu['link']]))||$this->ZgCakt5_FIpA[$cu['link']];
																										if($SXuHGf1Vd)
																										$p=0.95;
																										}
																										$p = max(0.0001,min($p,1.0));
																										$p = @number_format($p, 4);
																										}
																										}
																										if($rPpV2duBzldWXxW3Mr){
																										$rPpV2duBzldWXxW3Mr = strtotime($rPpV2duBzldWXxW3Mr);
																										$rPpV2duBzldWXxW3Mr = gmdate('Y-m-d\TH:i:s+00:00',$rPpV2duBzldWXxW3Mr);
																										}
																										$f = $cu['f']?$cu['f']:$this->XIlk3ZqbSYG['xs_freq'];
																										$aVVIJaQygc = array(
																										'URL'=>$l,
																										'TITLE'=>$t,
																										'DESC'=>($d),
																										'PERIOD'=>$f,
																										'LASTMOD'=>$rPpV2duBzldWXxW3Mr,
																										'ORDER'=>$cu['o'],
																										'PRIORITY'=>$p,
																										'ALTLANG' => $this->YIrFdD7SrWLpwW3[$l] ? $this->YIrFdD7SrWLpwW3[$l] : $cu['hl']
																										);
																										if($this->XIlk3ZqbSYG['xs_makemob'])
																										{
																										if(!$this->XIlk3ZqbSYG['xs_mobileincmask'] ||
																										preg_match('#'.str_replace(' ', '|', preg_quote($this->XIlk3ZqbSYG['xs_mobileincmask'],'#')).'#',$aVVIJaQygc['URL']))
																										$this->NxXizlvv02GJW(array_merge($aVVIJaQygc, array('ismob'=>true)), $dhX55M168WqsiLMd[2], 4);
																										}
																										
																										$xz = 'rss';
																										if($this->XIlk3ZqbSYG['xs_rssinfo'])
																										if(!$this->XIlk3ZqbSYG['xs_rssinfo_max'] ||
																										($this->rssno < $this->XIlk3ZqbSYG['xs_rssinfo_max']))
																										{
																										$hAj_8ByddeCCh1lT = ($this->wvQenBIS1HM&&!isset($this->wvQenBIS1HM[$cu['link']]))
																										|| $this->urls_prevrss[$cu['link']]
																										|| !$this->XIlk3ZqbSYG['xs_rssage'];
																										if($this->XIlk3ZqbSYG['xs_rssincmask'])
																										if(!preg_match('#'.str_replace(' ', '|', preg_quote($this->XIlk3ZqbSYG['xs_rssincmask'],'#')).'#',$cu['link']))
																										$hAj_8ByddeCCh1lT = false;
																										if($hAj_8ByddeCCh1lT)
																										{
																										$ZReTakA51rGrDby = $this->urls_prevrss[$cu['link']] ? strtotime($this->urls_prevrss[$cu['link']]) : time();
																										$ZReTakA51rGrDby = gmdate('D, d M Y H:i:s +0000', $ZReTakA51rGrDby);
																										$this->rssno++;
																										zSyg85rKFKJ8zd($cLGNu3fjIGa, 
																										$this->eQaiLJTAYGEFbJ0D->pTRcWpFjH8WqYG74($qNmmXd_uegk0tE9Fi[2],
																										array(
																										'URL'=>$l,
																										'GUID' => md5($l),
																										'TITLE'=>$t,
																										'DESC'=>$d,
																										'LASTMOD'=>$ZReTakA51rGrDby,
																										)));
																										}
																										}
																										$xz = '/rss';
																										$this->NxXizlvv02GJW($aVVIJaQygc, $dhX55M168WqsiLMd[2], 0);
																										
																										
																										if($this->XIlk3ZqbSYG['xs_maketxt'] && $S6zsGHiQqbyS93wtuJ)
																										$this->eOThR9i3EU['fwrite']($S6zsGHiQqbyS93wtuJ, $cu['link']."\n");
																										if($sm_proc_list)
																										foreach($sm_proc_list as $lrwvB0xvcXXumi3V)
																										$lrwvB0xvcXXumi3V->KjGb5UkXhbELCFSf($aVVIJaQygc);
																										if($this->XIlk3ZqbSYG['xs_makeror'] && $kKd42AXcG3p)
																										if(!$this->XIlk3ZqbSYG['xs_ror_max'] ||
																										($i < $this->XIlk3ZqbSYG['xs_ror_max']))
																										{
																										if($this->XIlk3ZqbSYG['xs_ror_unique']){
																										$t=$aVVIJaQygc['TITLE'];
																										$d=$aVVIJaQygc['DESC'];
																										while($HF6NqOcvPqnbh7=$ai[md5('t'.$t)]++){
																										$t=$aVVIJaQygc['TITLE'].' '.$HF6NqOcvPqnbh7;
																										}
																										while($HF6NqOcvPqnbh7=$ai[md5('d'.$d)]++){
																										$d=$aVVIJaQygc['DESC'].' '.$HF6NqOcvPqnbh7;
																										}
																										$aVVIJaQygc['TITLE']=$t;
																										$aVVIJaQygc['DESC']=$d;
																										}
																										zSyg85rKFKJ8zd($kKd42AXcG3p, $this->eQaiLJTAYGEFbJ0D->pTRcWpFjH8WqYG74($qyrBCAYqEMp[2],$aVVIJaQygc));
																										}
																										if($oDpbA930JAaWHLhY) {
																										if(!isset($this->wvQenBIS1HM[$cu['link']]) && 
																										count($this->r_lth23q9lblI)<$this->sr6xk3MKAMAoDi)
																										$this->r_lth23q9lblI[$cu['link']]++;
																										}
																										unset($this->wvQenBIS1HM[$cu['link']]);
																										}
																										$this->lqQshuQq_Yx_SG();
																										if($this->XIlk3ZqbSYG['xs_maketxt'])
																										{
																										$this->eOThR9i3EU['fclose']($S6zsGHiQqbyS93wtuJ);
																										@chmod(zDZfnOkYHwV.$this->uneVFDEGBQ7F, 0666);
																										}
																										if($this->XIlk3ZqbSYG['xs_makeror'])
																										{
																										if($kKd42AXcG3p)
																										zSyg85rKFKJ8zd($kKd42AXcG3p, $qyrBCAYqEMp[3]);
																										fclose($kKd42AXcG3p);
																										}
																										if($this->XIlk3ZqbSYG['xs_rssinfo'])
																										{
																										if($cLGNu3fjIGa)
																										zSyg85rKFKJ8zd($cLGNu3fjIGa, $qNmmXd_uegk0tE9Fi[3]);
																										fclose($cLGNu3fjIGa);
																										$this->cVhR96lmkjBRF($this->XIlk3ZqbSYG['xs_rssfilename']);
																										}
																										if($sm_proc_list)
																										foreach($sm_proc_list as $lrwvB0xvcXXumi3V)
																										$lrwvB0xvcXXumi3V->xGdDP35EpCBxUGx();
																										XNUfCNwhY4T($icjv1vts4FNnWEAa7ef,mVTd3cRsYoUPyznbMc(array('done'=>true)));
																										PvEr4n2DQ(array('cmd'=> 'info','id' => 'percprog',''));
																										}
																										function xnDpYg7WwA0($pcBcJ2TINs)
																										{
																										for($i=0;file_exists($sf=JAvBiMmjzH.SKg9CDNyrraUeOE5uUB($i,$pcBcJ2TINs).$this->uneVFDEGBQ7F);$i++){
																										Tqxf4L13C0B33yiyrv($sf);
																										}
																										}
																										function Hl4O6cWdjqldW6($tgZb22uxY5bw2uw, $H2Ce2a0HmFxl)
																										{
																										global $I7oacdy2vLiEw;
																										if(!@copy($tgZb22uxY5bw2uw,$H2Ce2a0HmFxl))
																										{
																										if($this->XIlk3ZqbSYG['xs_filewmove'] && file_exists($H2Ce2a0HmFxl) ){
																										Tqxf4L13C0B33yiyrv($H2Ce2a0HmFxl);
																										}
																										if($cn = @RkxOeH9i8($H2Ce2a0HmFxl, 'w')){
																										@zSyg85rKFKJ8zd($cn, file_get_contents($tgZb22uxY5bw2uw));
																										@fclose($cn);
																										}else
																										if(file_exists($tgZb22uxY5bw2uw))
																										{
																										$I7oacdy2vLiEw[] = $H2Ce2a0HmFxl;
																										}
																										}
																										
																										@chmod($tgZb22uxY5bw2uw, 0666);
																										}
																										function cVhR96lmkjBRF($pcBcJ2TINs)
																										{
																										$gp = ($this->XIlk3ZqbSYG['xs_compress']==2) ? '.gz' : '';
																										for($i=0;file_exists(JAvBiMmjzH.($sf=SKg9CDNyrraUeOE5uUB($i,$pcBcJ2TINs).$this->uneVFDEGBQ7F));$i++){
																										$this->Hl4O6cWdjqldW6(JAvBiMmjzH.$sf,$this->furl_p.$sf);
																										if($gp) {
																										$cn = file_get_contents(JAvBiMmjzH.$sf);
																										if(strstr($cn, '<sitemapindex'))
																										$cn = str_replace('.xml</loc>', '.xml.gz</loc>', $cn);
																										XNUfCNwhY4T(JAvBiMmjzH.$sf, $cn, '', true);
																										$this->Hl4O6cWdjqldW6(JAvBiMmjzH.$sf.$gp,$this->furl_p.$sf.$gp);
																										}
																										}
																										}
																										function HNUV_wZE_($pcBcJ2TINs, $Jh02oPSmnHw = -1, $EAYwgabkhK76_CD = '', $o8Jjo6v5ay1 = 0)
																										{
																										$cn = '';
																										$_fold = (strstr($pcBcJ2TINs,'/')||strstr($pcBcJ2TINs,'\\')) ? '' : JAvBiMmjzH ;
																										$_fapp = ($o8Jjo6v5ay1 ?  '' : $this->uneVFDEGBQ7F);
																										for($i=0;file_exists($sf=$_fold.SKg9CDNyrraUeOE5uUB($i,$pcBcJ2TINs).$_fapp);$i++)
																										{
																										
																										if(@filesize($sf)<100000000)// 100MB max
																										$cn .= $_fapp?implode('',gzfile($sf)):kEM8KMpb9E($sf);
																										if($i>200)break;
																										}
																										$qvIQHK0dOYO_Ns = array(
																										array('loc', 'news:publication_date', 'priority'),
																										array('link', 'pubDate', ''),
																										);
																										$mt = $qvIQHK0dOYO_Ns[$o8Jjo6v5ay1];
																										preg_match_all('#<'.$mt[0].'>(.*?)</'.$mt[0].'>'.
																										(($Jh02oPSmnHw>=0) ? '.*?<'.$mt[1].'>(.*?)</'.$mt[1].'>' : '').
																										(($EAYwgabkhK76_CD && $mt[2])? '.*?<'.$mt[2].'>(.*?)</'.$mt[2].'>' : '').
																										'#is',$cn,$um);
																										$al = array();
																										foreach($um[1] as $i=>$l)
																										{             
																										if($EAYwgabkhK76_CD){
																										if(!strstr($l, $EAYwgabkhK76_CD))
																										continue;
																										$l = substr($l, strlen($EAYwgabkhK76_CD));
																										}
																										if(!$l)continue;
																										if($Jh02oPSmnHw<=0) {
																										if($um[2][$i])
																										$al[$l] = $um[2][$i];
																										else
																										$al[$l]++;
																										}
																										else
																										if(time()-strtotime($um[2][$i])<=$Jh02oPSmnHw*24*3600)
																										$al[$l] = $um[2][$i];
																										}
																										return $al;
																										}
																										}
																										global $Tj0LyMg6kgYlIghFS;
																										$Tj0LyMg6kgYlIghFS = new XMLCreator();
																										}
																										



































































































