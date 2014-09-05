<!DOCTYPE html>

<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" lang="en" xml:lang="en">

<head>
	
<title>Fansboard - Easy, fast, smart to analyze your players.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />

<meta name="keywords" content="Basketball,Fantasy,NBA">
<meta name="description" content="Easy, Fast and Smart to analyze your NBA Fantasy basketball players.">

<meta property="og:title" content="Fansboard" />
<meta property="og:description" content="Easy, Fast and Smart to analyze your NBA Fantasy basketball players." />
<meta property="og:type" content="website" /> 
<meta property="og:image" content="http://www.fansboard.com/images/fb-logo.png" />
<meta property="og:url" content="http://www.fansboard.com" />
<meta property="og:site_name" content="Fansboard"/>

<link rel="shortcut icon" href="favicon.ico" />

<meta name="viewport" content="width=device-width"/>

<!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->

<link rel="stylesheet" href="css/share.css" />
<link rel="stylesheet" href="css/onepcssgrid.css" />
<link rel="stylesheet" href="css/onepcssgrid-1p.css" />
<link rel="stylesheet" href="css/management.share.index.css" />



<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

	

<style>
body {
	margin: 0;
	background-color: #fff;
	height: 100%;
	font-family: 'verdana','Arial','sans-serif','微軟正黑體';
}

.col1, .col2, .col3, .col4, .col5, .col6, .col7, .col8, .col9, .col10, .col11, .col12 {
	color: #000;
	padding: 0;
}				


.register {
	background: #63bd2b;
	border: 1px solid #63bd2b;
	outline: 0;
}
.register:hover {
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#77d13f), color-stop(50%,#63bd2b), color-stop(100%,#63bd2b)); 
	cursor: pointer;
}


.home-button {
	background-repeat: no-repeat;
	background-size: 128px 174px;	
	width: 128px;
	height: 100px;
	float: left;
	padding-top: 0px;
	border-top-left-radius: 15px;
	border-top-right-radius: 15px;
	font-size: 12px;
}
.home-button:hover {
	background-color: #000;
	cursor: pointer;
	box-shadow:0 0 150px 10px rgba(255,255,255,1);
	color: #fff;
}
.home-button:hover .home-button-bottom {
	background-color: #ffc000;
}
.home-button-bottom {
	border-radius: 15px;
	line-height: 20px;
}
.home-button.num1 {
	background-image: url(images/fig_1_playerAbility0.png);
}
.home-button.num1:hover {
	background-image: url(images/fig_1_playerAbility1.png);
}
.home-button.num2 {
	background-image: url(images/fig_2_dataScatter0.png);
}
.home-button.num2:hover {
	background-image: url(images/fig_2_dataScatter1.png);
}
.home-button.num3 {
	background-image: url(images/fig_3_realtimeBox0.png);
}
.home-button.num3:hover {
	background-image: url(images/fig_3_realtimeBox1.png);
}
.home-button.num4 {
	background-image: url(images/fig_6_gameLog0.png);
}
.home-button.num4:hover {
	background-image: url(images/fig_6_gameLog1.png);
}
.home-button.num5 {
	background-image: url(images/fig_5_similarPlayer0.png);
}
.home-button.num5:hover {
	background-image: url(images/fig_5_similarPlayer1.png);
}

.home-main-col {
	position: relative;
	height: 540px;
}

.home-main-logo {
	background-image: url(images/logo.png);
	background-repeat: no-repeat;
	background-size: 500px 100px;
	background-position: 10px 10px;
	width: 100%;
	height: 180px;
	margin: 0;
	padding: 0;
}

.home-main-image {
	background-image: url(images/backgroundFig.png);
	background-repeat: no-repeat;
	background-size: 500px;
	background-position: center center;
	width: 100%;
	height: 300px;
	margin: 0;
	padding: 0;
}

.home-main-point {
	width: 530px;
	height: 60px;
	color: #aaa;
	float: right;
	line-height: 20px;
	font-size: 14px;
}

a.button {
	display: block;
	box-sizing: border-box;
	text-decoration: none;
	text-align: center;
}
a.link {
	text-decoration: none;
	color: #333;
}
a.link:hover {
	text-decoration: underline;
}

@media all and (max-width: 768px) {
	.onerow {
		margin: 0 0 0 0;
	}
	.onerow.menu {
		display: none;
	}
	.onerow.banner,.separator {
		display:none !important;
	}
}


@media all and (max-width: 768px) {
	.onepcssgrid-full {

	}
	.home-main-col {
		height: 400px;
	}
	.home-main-logo {
		background-size: 300px auto;
		width: 300px;
		left: 0;
	}
	.home-main-image {
		background-size: 326px 195px;
		width: 326px;
		height: 195px;
		margin: 110px auto;
	}
}	

a.menu-item {
	height: 100%;
	padding-top: 110px;
	color: #000;
	font-weight: bold;
}
iframe {
	vertical-align:bottom;
}
</style>
<script>
var pageobj;
$(document).ready(function(){
	pageobj = $('body');
	$.getScript('js/hightchart.hotcoldplayer.js',function(){
		pageobj.trigger('startjs');
	});
});
</script>
</head>

	<body>
	

		<div style="background-color:#fff">
			<div class="onepcssgrid-1200" style="margin-top:0">
				<div class="onerow menu" style="border-top: 0px solid #bebebe;border-bottom: 0px solid #fff; background-color:#fff">
					<div class="colfull">
						<? echo $child_tab; ?>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>	
		</div>
		
		<div class="onepcssgrid-full">


			<div class="onerow">

				<div class="colfull" style="background-color:#000;height:700px;border-top: 0px solid #962213;border-bottom: 5px solid #962213">

					<div class="onepcssgrid-1200">

						<div class="onerow">
							<div class="colfull home-main-col">

								<div class="home-main-logo"></div>
								<div class="home-main-image"></div>
						
								<?
								//$realtime = Player::gethotcoldPlayer()->getData()->todaybo;
								?>
                                
                                <?
                                $realtime = DB::table('log_data')
                                ->select(DB::raw('parameter AS fbid,COUNT(parameter) AS trend,syncdataframe.pwmin AS min2,syncdataframe.pweff,syncdataframe.pwpts AS pts2,syncdataframe.pwtreb AS treb2,syncdataframe.pwast AS ast2,syncplayerlist.player,syncplayerlist.team,syncplayerlist.position'))
                                ->leftJoin('syncdataframe','log_data.parameter','=','syncdataframe.fbid')
                                ->leftJoin('syncplayerlist','log_data.parameter','=','syncplayerlist.fbid')
                                ->where(DB::raw('TIMESTAMPDIFF( MINUTE , datetime , NOW( ))'),'<',1440)
                                ->whereRaw('parameter NOT LIKE "%+%"')
                                ->where('syncdataframe.datarange','=','ALL')
                                ->where('syncplayerlist.datarange','=','ALL')
                                ->orderBy(DB::raw('COUNT(parameter)'),'DESC')
                                ->groupBy('parameter')->get();                              

                                
                                //$realtime
                                foreach ($realtime as $key => $value) {
                                    $value->pts2 = round($value->pts2,1);
                                    $value->treb2 = round($value->treb2,1);
                                    $value->ast2 = round($value->ast2,1);
                                    $value->min2 = round($value->min2,1);
                                    $value->trend = round($value->trend,1);
                                    $realtime[$key] = $value;
                                }
                                
                                        
                                ?>                                

								
								<div class="majorbox" style="position:relative;top:30px;left:50px;width:200px">									
										
									<div class="todaydata" style="width:290px;background-image:url(images/basketball-floor.jpg);border-radius:10px;padding:5px">

										<a href="hotcoldplayer" style="text-decoration:none">
											<span style="padding:0 0 0 10px;text-align:left;font-weight:bold;font-size:20px;color:red;margin:0 0 8px 0">Today Breakout</span>
											<span style="padding:0 20px 0 20px;color:#000">More...</span>
										</a>
										
										<div style="font-size:14px;line-hight:20px;color:#fff">

											<a href="gameLog?player=<?=$realtime[0]->fbid ?>" style="text-decoration:none;color:#fff">
											<div class="prcard" style="background-color:rgba(0,0,0,0.6)">
												<div style="float:left;padding:5px">
													<div class="todayboface0" style="width:48px;height:60px;background-image:url(player/<?=$realtime[0]->fbid ?>.png);background-size:48px 60px">
													</div>
												</div>
												<div style="float:left;padding:5px;height:60px;width:75%">
													<div class="todaybo-name0"><?=$realtime[0]->player.' ('.$realtime[0]->team.' - '.$realtime[0]->position.')'?></div>
													<div class="todaybo-today0" style="color:red"><?=$realtime[0]->pts2.' PTS, '.$realtime[0]->treb2.' REB, '.$realtime[0]->ast2.' AST'?></div>
													<div style="float:right">
														<span class="todaybo-min0" style="color:red"><?='Min '.$realtime[0]->min2.', '?></span>
														<span class="todaybo-eff0" style="color:gold"><?='EFF +'.$realtime[0]->trend?></span>
													</div>
												</div>
												<div style="height:0;clear:both"></div>
											</div>
											</a>

											<a href="gameLog?player=<?=$realtime[1]->fbid ?>" style="text-decoration:none;color:#fff">
											<div class="prcard" style="background-color:rgba(0,0,0,0.6)">
												<div style="float:left;padding:5px">
													<div class="todayboface1" style="width:48px;height:60px;background-image:url(player/<?=$realtime[1]->fbid ?>.png);background-size:48px 60px">
													</div>
												</div>
												<div style="float:left;padding:5px;height:60px;width:75%">
													<div class="todaybo-name1"><?=$realtime[1]->player.' ('.$realtime[1]->team.' - '.$realtime[1]->position.')'?></div>
													<div class="todaybo-today1" style="color:red"><?=$realtime[1]->pts2.' PTS, '.$realtime[1]->treb2.' REB, '.$realtime[1]->ast2.' AST'?></div>
													<div style="float:right">
														<span class="todaybo-min1" style="color:red"><?='Min '.$realtime[1]->min2.', '?></span>
														<span class="todaybo-eff1" style="color:gold"><?='EFF +'.$realtime[1]->trend?></span>
													</div>
												</div>
												<div style="height:0;clear:both"></div>
											</div>
											</a>

										</div>
									</div>
									
								</div>
							</div>
						</div>

						<div class="onerow">
							
								<div class="home-main-point"><div id="fb-root"></div>
									Follow NBA Stats in Awesome Ways, Manage Fantasy Teams in Moneyball Style, Please Don't Hesitate to Try Fansboard!!
									<div style="display:inline-block;margin-left:15px;width:55px;height:20px;overflow:hidden;position:relative;top:5px"><div class="fb-follow" data-href="http://www.facebook.com/fansboard" data-width="100px" data-colorscheme="light" data-layout="button" data-show-faces="true"></div></div>
									<div style="display:inline-block;margin-left:0px;width:80px;height:20px;overflow:hidden;position:relative;top:5px"><a href="https://twitter.com/fansboard" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @fansboard</a></div>
								</div>


								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=251984733230";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>			
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


							
						</div>

						
						

						
						<div class="onerow">
							<div class="colfull">
								<div style="float:right">
									<div class="home-button num1 link" acsrc="playerAbility">
										<a href="playerAbility" title="<?=Lang::get('description.playerAbility')?>" class="menu-item button"><div class="home-button-bottom">Player Ability</div></a>
									</div>
									<div class="home-button num2 link" acsrc="dataScatter">
										<a href="dataScatter" title="<?=Lang::get('description.dataScatter')?>" class="menu-item button"><div class="home-button-bottom">Data Scatter</div></a>
									</div>
									<div class="home-button num3 link" acsrc="realtimeBox">
										<a href="realtimeBox" title="<?=Lang::get('description.realtimeBox')?>" class="menu-item button"><div class="home-button-bottom">Real-Time Box</div></a>
									</div>
									<div class="home-button num4 link" acsrc="gameLog">
										<a href="gameLog" title="<?=Lang::get('description.gameLog')?>" class="menu-item button"><div class="home-button-bottom">Game Logs</div></a>
									</div>
									<div class="home-button num5 link" acsrc="matchPlayer">
										<a href="matchPlayer" title="<?=Lang::get('description.matchPlayer')?>" class="menu-item button"><div class="home-button-bottom">Similar Player</div></a>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
				<div style="height:0;clear:both"></div>

			</div>

		</div>
			
		
		
		<div class="onepcssgrid-1200" style="margin-top:40px">
			<div class="onerow">
				<?=$child_main?>
			</div>
		</div>
		
		<div class="onepcssgrid-full" style="background-color:#000">
			<div class="onepcssgrid-1200" style="margin-top:80px">
				<div class="onerow" style="background-color:#000;background-image:url(images/background_allstar.png);background-repeat:no-repeat;background-size:1500px;background-position:center;height:0">
	
				</div>
			</div>		
		</div>
		
		<div class="onepcssgrid-full" style="margin-top:80px">
			<div class="onerow">
				<?=$child_footer?>
			</div>
		</div>
		




	</body>

</html>