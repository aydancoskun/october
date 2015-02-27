<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$NxxKR43052368uIkBl=28194458;$cKAkt35416870DeJkg=371722656;$dINwd66277466uaPgb=721104370;$ZpobX93446656Nzluy=358308349;$JAfjM29736938JaVfp=63803344;$eKDLh12960815zytAr=118558105;$bgYTA45930786jZhfO=304041382;$uTtkv86459351hnIPz=901221924;$Kooai47359009SoZQu=692568482;$xejgO66442261XJiSd=958049805;$FHlHu56521606DmrpS=480134644;$tamtp65409546QoDTy=538791748;$VdMrq95918580xreRw=915489869;$nJuVh15861206zMCow=892197754;$atGQy98049927AptXM=250384155;$Gbzeo30297241JbLDd=270017822;$adFaY85415650vrcbC=732567505;$hHmLy41217651SDcDk=920001954;$ihdAF80515747zNdny=613789917;$pXKua71122437VsfcM=94900146;$MoRhC15850219VoqpG=143801391;$GudEi52511597gjUSZ=42462402;$igDFl93919068aAGZp=571351929;$fPWgH97885132yFUsu=13438720;$AAdJV67222290XsSHT=148191528;$MSYQc49743042OhEpM=257579101;$zifsa48259888FSbuj=123070190;$uDFQz20585327kZOYK=25633544;$VxwDP59531860sUApz=745737915;$BXzEX32911987wZlZT=566352051;$DAJnl33538208KCskh=267944702;$PfEAk19223022sWckF=131484619;$jHLQi82778931jMubu=937440552;$YgYPY92018433ztRCI=968781250;$nxopG49754028utbij=6975463;$NuHff93798218xGXpa=330991943;$HMaGs46963501YbTRA=723299439;$MwfCW47062378OZOfp=465866699;$aGWQr96907349NaGVl=339162475;$BgbDT64310913vUyma=624155518;$meNIk42085571bqgQE=103314575;$yunjP78043823Vgnwo=56608398;$bwXcr84998169fLsRi=265505737;$PFYvt20761108vrqiA=11975341;$bBEtA68145142HOpdk=76485961;$VEyOe94962769phMyI=740006348;$HylCF14026489yoyww=785005249;$yIjoF53148804cyIiF=492451416;$ULyip35142212EcdBS=642813599;$ndkpU97819214xAjQR=518060547;?><?php include uNFFhEr_Ldjz6gLuOb.'page-top.inc.php'; $yMBs2OPLVVuAK = $_REQUEST['crawl']; if($_GET['act']=='interrupt'){ XNUfCNwhY4T(AdSeH3KPw4,''); echo '<h2>The "stop" signal has been sent to a crawler.</h2><a href="index.'.$szdudf1EIIL.'?op=crawl">Return to crawler page</a>'; }else if(file_exists($fn=JAvBiMmjzH.aHYbmExGS2Xg9WZI)&&(time()-filemtime($fn)<10*60)){ $TS2WAQ4zWkdnI_=true; $yMBs2OPLVVuAK = 1; } if($yMBs2OPLVVuAK){ if($TS2WAQ4zWkdnI_) echo '<h4>Crawling already in progress.<br/>Last log access time: '.date('Y-m-d H:i:s',@filemtime($fn)).'<br><small><a href="index.'.$szdudf1EIIL.'?op=crawl&act=interrupt">Click here</a> to interrupt it.</small></h4>'; else { echo '<h4>Please wait. Sitemap generation in progress...</h4>'; if($_POST['bg']) echo '<div class="block2head">Please note! The script will run in the background until completion, even if browser window is closed.</div>'; } ?>
																													<script type="text/javascript">
																													var lastupdate = 0;
																													var framegotsome = false;
																													function b6AdG6bCyaYg()
																													{
																													var cd = new Date();
																													if(!lastupdate)return false;
																													var df = (cd - lastupdate)/1000;
																													<?php if($grab_parameters['xs_autoresume']){?>
																													var re = document.getElementById('rlog');
																													re.innerHTML = 'Auto-restart monitoring: '+ cd + ' (' + Math.round(df) + ' second(s) since last update)';
																													var ifr = document.getElementById('cproc');
																													var frfr = window.frames['clog'];
																													
																													var doresume = (df >= <?php echo intval($grab_parameters['xs_autoresume']);?>);
																													if(typeof frfr != 'undefined') {
																													if( (typeof frfr.pageLoadCompleted != 'undefined') &&
																													!frfr.pageLoadCompleted) 
																													{
																													
																													framegotsome = true;
																													doresume = false;
																													}
																													
																													if(!frfr.document.getElementById('glog')) {	
																													
																													}
																													}
																													if(doresume)
																													{
																													var rle = document.getElementById('runlog');
																													lastupdate = cd;
																													if(rle)
																													{
																													rle.style.display  = '';
																													rle.innerHTML = cd + ': resuming generator ('+Math.round(df)+' seconds with no response)<br />' + rle.innerHTML;
																													}
																													var lc = ifr.src;
																													if(lc.indexOf('resume=1')<0)
																													lc = lc + '&resume=1';
																													ifr.src = lc;
																													}
																													<?php } ?>
																													}
																													window.setInterval('b6AdG6bCyaYg()', 1000);
																													</script>
																													<iframe id="cproc" name="clog" style="width:100%;height:300px;border:0px" frameborder=0 src="index.<?php echo $szdudf1EIIL?>?op=crawlproc&bg=<?php echo $_REQUEST['bg']?>&resume=<?php echo $_REQUEST['resume']?>"></iframe>
																													<!--
																													<div id="rlog2" style="bottom:5px;position:fixed;width:100%;font-size:12px;background-color:#fff;z-index:2000;padding-top:5px;border-top:#999 1px dotted"></div>
																													-->
																													<div id="rlog" style="overflow:auto;"></div>
																													<div id="runlog" style="overflow:auto;height:100px;display:none;"></div>
																													<?php }else if(!$REpEqrxI7DpN9) { ?>
																													<div id="sidenote">
																													<?php include uNFFhEr_Ldjz6gLuOb.'page-sitemap-detail.inc.php'; ?>
																													</div>
																													<div id="shifted">
																													<h2>Crawling</h2>
																													<form action="index.<?php echo $szdudf1EIIL?>?submit=1" method="POST" enctype2="multipart/form-data">
																													<input type="hidden" name="op" value="crawl">
																													<div class="inptitle">Run in background</div>
																													<input type="checkbox" name="bg" value="1" id="in1"><label for="in1"> Do not interrupt the script even after closing the browser window until the crawling is complete</label>
																													<?php if(@file_exists(JAvBiMmjzH.Ufz4hdNjXhLx60oBsLt)){ if(@file_exists(JAvBiMmjzH.nNMzp2IgH7HiM) &&(filemtime(JAvBiMmjzH.nNMzp2IgH7HiM)>filemtime(JAvBiMmjzH.Ufz4hdNjXhLx60oBsLt)) ){ $IY0gqoD0WQtmD7 = @hRkxxxwtG(kEM8KMpb9E(JAvBiMmjzH.nNMzp2IgH7HiM, true)); } if(!$IY0gqoD0WQtmD7){ $qhPWndLyX4Mr = @hRkxxxwtG(kEM8KMpb9E(JAvBiMmjzH.Ufz4hdNjXhLx60oBsLt, true)); $IY0gqoD0WQtmD7 = $qhPWndLyX4Mr['progpar']; } ?>
																													<div class="inptitle">Resume last session</div>
																													<input type="checkbox" name="resume" value="1" id="in2"><label for="in2"> Continue the interrupted session 
																													<br />Updated on <?php  $zYhxmsR75YsTO5F = filemtime(JAvBiMmjzH.Ufz4hdNjXhLx60oBsLt); echo date('Y-m-d H:i:s',$zYhxmsR75YsTO5F); if(time()-$zYhxmsR75YsTO5F<600)echo ' ('.(time()-$zYhxmsR75YsTO5F).' seconds ago) '; ?>, 
																													<?php echo	'Time elapsed: '.fslY6ssCNGE($IY0gqoD0WQtmD7[0]).',<br />Pages crawled: '.intval($IY0gqoD0WQtmD7[3]). ' ('.intval($IY0gqoD0WQtmD7[7]).' added in sitemap), '. 'Queued: '.$IY0gqoD0WQtmD7[2].', Depth level: '.$IY0gqoD0WQtmD7[5]. '<br />Current page: '.$IY0gqoD0WQtmD7[1].' ('.number_format($IY0gqoD0WQtmD7[10],1).')'; } ?>
																													</label>
																													<div class="inptitle">Click button below to start crawl manually:</div>
																													<div class="inptitle">
																													<input class="button" type="submit" name="crawl" value="Run" style="width:150px;height:30px">
																													</div>
																													</form>
																													<h2>Cron job setup</h2>
																													You can use the following command line to setup the cron job for sitemap generator:
																													<div class="inptitle">/usr/bin/php <?php echo dirname(dirname(__FILE__)).'/runcrawl.php'?></div>
																													<h2>Web Cron setup</h2>
																													If you cannot setup a regular cron task on your server, you can try a web cron instead:
																													<div class="inptitle"><?php 	echo $JfRC0egNhxmTca.'/index.php?op=crawlproc&resume=1'?></div>
																													</div>
																													<?php } include uNFFhEr_Ldjz6gLuOb.'page-bottom.inc.php'; 



































































































