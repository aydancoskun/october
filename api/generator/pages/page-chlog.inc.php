<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$GUAZD26754150agZkg=670190979;$OYuUc24304199DjSJZ=610802185;$uPjSe39256592zmGwh=198251281;$eUaWy96923829ITUXT=462757019;$AJojm87618409DEGYW=936038147;$vFGwI36652832WXoVj=650313416;$ptXzb14339599BPolz=136301574;$eaIad45991211KcLir=424221374;$xVPni21920166qiorq=46791564;$oToHa57438965bxnJs=34230896;$KRGGS42860107jlwbL=917258118;$qLUQq93496094MtJMg=729091980;$cjcWH99659424XtqUL=999451233;$ANgAW86662598YJJii=760554627;$KoZqp34818115jraDh=543120911;$VUswo59438477QYJvp=378368835;$XUzva50836182WzdgY=797017151;$QVygo34323730BVNuO=831284607;$pAptQ80213623Ngihq=12889953;$SiGZG33818359kNKnD=371051941;$AyEpX55450439AqtwJ=438489319;$iQIeh80422364EBpLC=246420837;$uUKqF89046631vScFq=325565246;$LhVrZ16635742ooOyp=707141297;$hPVGc23502197CMsAt=922867737;$JOXpS44958496sSzXZ=4963317;$WmnGe61317139TJibl=482146790;$WNFYv97890625dkRdj=387636902;$osEkC44991455LdrFI=252152405;$dcZUX17932128aEQOE=106912048;$xnvzg87025147nNspI=482634583;$shxmn97583008Lybie=411538757;$QyzQz29918213pNjDv=424343323;$AHRvc89343262TuUwB=552267029;$JWUSn76170655tRqqg=327028625;$yoLKN15712890fSfEE=778846863;$sNvUF68282471xMXBv=440440491;$aLMTx79191895eWKNr=342028259;$EPwuU28753662xmiCi=15328918;$AIKfV32280273ycuEG=490561218;$ICLYl70084229sswoI=300443908;$SjutS77478028KGHWC=475195740;$SCOgH34774170bHHVk=546535461;$EJnla57285156iSCiK=545681824;$xBpcR35323486MwYnt=4353576;$gzMCH84201660UZFPn=951769471;$ThQhA94232178lzSwW=921648255;$jcVng90727539xyOsx=944208680;$UtXrX54000244arPZH=551169495;$PtEyi99362793KFGcJ=772749451;?><?php include uNFFhEr_Ldjz6gLuOb.'page-top.inc.php'; $CjkPFJQ1MJyQxogX = eufpjMrwNSVr(); if($grab_parameters['xs_chlogorder'] == 'desc') rsort($CjkPFJQ1MJyQxogX); $KJwBTVXJeYjG=$_GET['log']; if($KJwBTVXJeYjG){ ?>
																										<div id="sidenote">
																										<div class="block1head">
																										Crawler logs
																										</div>
																										<div class="block1">
																										<?php for($i=0;$i<count($CjkPFJQ1MJyQxogX);$i++){ $Q5G8QmbQwJT3v = NYySB95cXj2bdre($CjkPFJQ1MJyQxogX[$i]); if($i+1==$KJwBTVXJeYjG)echo '<u>'; ?>
																										<a href="index.<?php echo $szdudf1EIIL?>?op=chlog&log=<?php echo $i+1?>" title="View details"><?php echo date('Y-m-d H:i',$Q5G8QmbQwJT3v['time'])?></a>
																										( +<?php echo count($Q5G8QmbQwJT3v['newurls'])?> -<?php echo count($Q5G8QmbQwJT3v['losturls'])?>)
																										</u>
																										<br>
																										<?php	} ?>
																										</div>
																										</div>
																										<?php } ?>
																										<div<?php if($KJwBTVXJeYjG) echo ' id="shifted"';?> >
																										<h2>ChangeLog</h2>
																										<?php if($KJwBTVXJeYjG){ $Q5G8QmbQwJT3v = NYySB95cXj2bdre($CjkPFJQ1MJyQxogX[$KJwBTVXJeYjG-1]); ?><h4><?php echo date('j F Y, H:i',$Q5G8QmbQwJT3v['time'])?></h4>
																										<div class="inptitle">New URLs (<?php echo count($Q5G8QmbQwJT3v['newurls'])?>)</div>
																										<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$Q5G8QmbQwJT3v['newurls']))?></textarea>
																										<div class="inptitle">Removed URLs (<?php echo count($Q5G8QmbQwJT3v['losturls'])?>)</div>
																										<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$Q5G8QmbQwJT3v['losturls']))?></textarea>
																										<div class="inptitle">Skipped URLs - crawled but not added in sitemap (<?php echo count($Q5G8QmbQwJT3v['urls_list_skipped'])?>)</div>
																										<textarea style="width:100%;height:300px"><?php foreach($Q5G8QmbQwJT3v['urls_list_skipped'] as $k=>$v)echo @htmlspecialchars($k.' - '.$v)."\n";?></textarea>
																										<?php	 }else{ ?>
																										<table>
																										<tr class=block1head>
																										<th>No</th>
																										<th>Date/Time</th>
																										<th>Indexed pages</th>
																										<th>Processed pages</th>
																										<th>Skipped pages</th>
																										<th>Proc.time</th>
																										<th>Bandwidth</th>
																										<th>New URLs</th>
																										<th>Removed URLs</th>
																										<th>Broken links</th>
																										<?php if($grab_parameters['xs_imginfo'])echo '<th>Images</th>';?>
																										<?php if($grab_parameters['xs_videoinfo'])echo '<th>Videos</th>';?>
																										<?php if($grab_parameters['xs_newsinfo'])echo '<th>News</th>';?>
																										<?php if($grab_parameters['xs_rssinfo'])echo '<th>RSS</th>';?>
																										</tr>
																										<?php  $XhI5oWumotgSTXQVVqo=array(); for($i=0;$i<count($CjkPFJQ1MJyQxogX);$i++){ $Q5G8QmbQwJT3v = NYySB95cXj2bdre($CjkPFJQ1MJyQxogX[$i]); if(!$Q5G8QmbQwJT3v)continue; foreach($Q5G8QmbQwJT3v as $k=>$v)if(!is_array($v))$XhI5oWumotgSTXQVVqo[$k]+=$v;else $XhI5oWumotgSTXQVVqo[$k]+=count($v); ?>
																										<tr class=block1>
																										<td><?php echo $i+1?></td>
																										<td><a href="index.php?op=chlog&log=<?php echo $i+1?>" title="View details"><?php echo date('Y-m-d H:i',$Q5G8QmbQwJT3v['time'])?></a></td>
																										<td><?php echo number_format($Q5G8QmbQwJT3v['ucount'])?></td>
																										<td><?php echo number_format($Q5G8QmbQwJT3v['crcount'])?></td>
																										<td><?php echo count($Q5G8QmbQwJT3v['urls_list_skipped'])?></td>
																										<td><?php echo number_format($Q5G8QmbQwJT3v['ctime'],2)?>s</td>
																										<td><?php echo number_format($Q5G8QmbQwJT3v['tsize']/1024/1024,2)?></td>
																										<td><?php echo count($Q5G8QmbQwJT3v['newurls'])?></td>
																										<td><?php echo count($Q5G8QmbQwJT3v['losturls'])?></td>
																										<td><?php echo count($Q5G8QmbQwJT3v['u404'])?></td>
																										<?php if($grab_parameters['xs_imginfo'])echo '<td>'.$Q5G8QmbQwJT3v['images_no'].'</td>';?>
																										<?php if($grab_parameters['xs_videoinfo'])echo '<td>'.$Q5G8QmbQwJT3v['videos_no'].'</td>';?>
																										<?php if($grab_parameters['xs_newsinfo'])echo '<td>'.$Q5G8QmbQwJT3v['news_no'].'</td>';?>
																										<?php if($grab_parameters['xs_rssinfo'])echo '<td>'.$Q5G8QmbQwJT3v['rss_no'].'</td>';?>
																										</tr>
																										<?php }?>
																										<tr class=block1>
																										<th colspan=2>Total</th>
																										<th><?php echo number_format($XhI5oWumotgSTXQVVqo['ucount'])?></th>
																										<th><?php echo number_format($XhI5oWumotgSTXQVVqo['crcount'])?></th>
																										<th><?php echo number_format($XhI5oWumotgSTXQVVqo['ctime'],2)?>s</th>
																										<th><?php echo number_format($XhI5oWumotgSTXQVVqo['tsize']/1024/1024,2)?> Mb</th>
																										<th><?php echo ($XhI5oWumotgSTXQVVqo['newurls'])?></th>
																										<th><?php echo ($XhI5oWumotgSTXQVVqo['losturls'])?></th>
																										<th>-</th>
																										</tr>
																										</table>
																										<?php } ?>
																										</div>
																										<?php include uNFFhEr_Ldjz6gLuOb.'page-bottom.inc.php'; 



































































































