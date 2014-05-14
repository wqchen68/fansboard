<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">

		<div class="onerow">		

			<div class="col12">
				<div style="padding:5px;padding-left:300px;text-align: left">
					<span>Method:</span>
					<select name="matchMethod" class="matchMethod" style="padding:5px;background-color:rgba(255,255,255,1);color:#000;border:1px;border-radius: 3px">
						<option value="method1" selected="selected">Shape & Size</option>
						<option value="method2">Only Shape</option>
						<option value="method3">Overall: Similar</option>
						<option value="method4">Overall: Poor</option>												
					</select>					
				</div>
			</div>

			<div class="col-1p3 modelCol">
				<div class="playerlistblock">
					
					<div style="float:left;padding:0 0 10px 0">
						<select class="selectForm player_season">
							<option value="ALL" selected="selected">2013-14 Season</option>
							<option value="D30">Last 4 weeks</option>
							<option value="D14">Last 2 weeks</option>
							<option value="D07">Lest 1 week</option>
							<option value="Y-1">2012-13 Season</option>
							<option value="Y-2">2011-12 Season</option>
						</select>
					</div>
					<div style="float:left;padding:0 0 10px 10px;height:35px">
						<a  href="realtimeBox" class="link-realtimeBox" title='Real-Time Efficiency Rank Box'>
							<?
								$hotcold_data = Player::gethotcoldPlayer()->getData();
								$livevalue = $hotcold_data->livemark;
								if (count($livevalue)==1 & $livevalue[0]->livemark=='Final'){
									echo '<div class="newsbox-icon" style="background-image:url(images/fig_3_realtimeBox2.png)"></div>';
								}else{
									echo '<div class="newsbox-icon" style="background-image:url(images/fig_3_realtimeBox3.png);box-shadow:0 0 50px rgba(255,0,0,0.9);padding:0"></div>';
								}
							?>
						</a>
					</div>
					
					<div style="height:0;clear:both"></div>
					
					
					<div class="modelBox" mid="5" style="height:420px;padding:0 0 10px 0;margin:0 0 24px 0"></div>
					
					<a class="link-playerAbility faceCardMajor">
					<div class="majorbox playercardsmall highlight">
						<div style="float:left">
							<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
						</div>
						<div class="playercardsmall-news">
							<div class="cardplayer"></div>
							<div>								
								<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
								<div class="cardinjna"></div>
								<div style="height:0;clear:both"></div>
							</div>
							<div class="cardstat"></div>
						</div>
						<div style="height:0;clear:both"></div>
					</div>
					</a>
					
				</div>				
			</div>



			<div class="col-1p9 last chartblock" style="background-color:rgba(0,0,0,0.2)">

				<div class="col-1p8">
					<div class="modelBox" mid="3"></div>			
				</div>
	
				<div class="col-1p4 last facebox">
					
					<div  style="padding:10px">
						
						<div style="color:red;font-weight:bold;padding:0px 5px 5px 5px">Best Similar Player</div>

						<div class="majorboxN">
							<div class="majorbox playercardsmall highlight" style="box-shadow:0 0 20px rgba(255,255,255,0.9)">
								<div style="float:left">
									<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
								</div>
								<div class="playercardsmall-news">
									<div style="float:left;width:83%">
										<div class="cardplayer"></div>
										<div>										
											<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
											<div class="cardinjna"></div>									
											<div style="height:0;clear:both"></div>
										</div>
									</div>
									<a class="link-playerAbility1" title='Player Ability (Radar Chart)'>
										<div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(images/fig_1_playerAbility2.png)"></div>
									</a>
									<div style="height:0;clear:both"></div>
									<div class="cardstat"></div>
								</div>
								<div style="height:0;clear:both"></div>
							</div>
						</div>
						
						<div style="padding:5px">Relative Players</div>
						
						<div class="majorboxN">
							<div class="majorbox playercardsmall highlight">
								<div style="float:left">
									<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
								</div>
								<div class="playercardsmall-news">
									<div style="float:left;width:83%">
										<div class="cardplayer"></div>
										<div>										
											<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
											<div class="cardinjna"></div>									
											<div style="height:0;clear:both"></div>
										</div>
									</div>
									<a class="link-playerAbility2" title='Player Ability (Radar Chart)'>
										<div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(images/fig_1_playerAbility2.png)"></div>
									</a>
									<div style="height:0;clear:both"></div>
									<div class="cardstat"></div>
								</div>
								<div style="height:0;clear:both"></div>
							</div>
						</div>
						
						<div class="majorboxN">
							<div class="majorbox playercardsmall highlight">
								<div style="float:left">
									<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
								</div>
								<div class="playercardsmall-news">
									<div style="float:left;width:83%">
										<div class="cardplayer"></div>
										<div>										
											<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
											<div class="cardinjna"></div>									
											<div style="height:0;clear:both"></div>
										</div>
									</div>
									<a class="link-playerAbility3" title='Player Ability (Radar Chart)'>
										<div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(images/fig_1_playerAbility2.png)"></div>
									</a>
									<div style="height:0;clear:both"></div>
									<div class="cardstat"></div>
								</div>
								<div style="height:0;clear:both"></div>
							</div>
						</div>						

						<div class="majorboxN">
							<div class="majorbox playercardsmall highlight">
								<div style="float:left">
									<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
								</div>
								<div class="playercardsmall-news">
									<div style="float:left;width:83%">
										<div class="cardplayer"></div>
										<div>										
											<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
											<div class="cardinjna"></div>									
											<div style="height:0;clear:both"></div>
										</div>
									</div>
									<a class="link-playerAbility4" title='Player Ability (Radar Chart)'>
										<div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(images/fig_1_playerAbility2.png)"></div>
									</a>
									<div style="height:0;clear:both"></div>
									<div class="cardstat"></div>
								</div>
								<div style="height:0;clear:both"></div>
							</div>
						</div>

						<div class="majorboxN">
							<div class="majorbox playercardsmall highlight">
								<div style="float:left">
									<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
								</div>
								<div class="playercardsmall-news">
									<div style="float:left;width:83%">
										<div class="cardplayer"></div>
										<div>										
											<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
											<div class="cardinjna"></div>									
											<div style="height:0;clear:both"></div>
										</div>
									</div>
									<a class="link-playerAbility5" title='Player Ability (Radar Chart)'>
										<div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(images/fig_1_playerAbility2.png)"></div>
									</a>
									<div style="height:0;clear:both"></div>
									<div class="cardstat"></div>
								</div>
								<div style="height:0;clear:both"></div>
							</div>
						</div>						
						
						<div class="majorboxN">
							<div class="majorbox playercardsmall highlight">
								<div style="float:left">
									<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
								</div>
								<div class="playercardsmall-news">
									<div style="float:left;width:83%">
										<div class="cardplayer"></div>
										<div>										
											<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div>
											<div class="cardinjna"></div>									
											<div style="height:0;clear:both"></div>
										</div>
									</div>
									<a class="link-playerAbility6" title='Player Ability (Radar Chart)'>
										<div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(images/fig_1_playerAbility2.png)"></div>
									</a>
									<div style="height:0;clear:both"></div>
									<div class="cardstat"></div>
								</div>
								<div style="height:0;clear:both"></div>
							</div>
						</div>
						
					</div>						
				</div>
			</div>
		</div>
		
		<div class="onerow" style="padding:10px 0 0 0">
			<div class="col-1p12">

				<div class="tablebackground">
					<table class="ability-detail" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
					<thead>

						<tr>
						<th colspan="3" class="report-detail-midd">STATS per game</th>
						<th colspan="3" class="report-detail-dark">Field Goals</th>
						<th colspan="3" class="report-detail-midd">3-Point Throws</th>
						<th colspan="3" class="report-detail-dark">Free Throws</th>
						<th colspan="3" class="report-detail-midd">Rebounds</th>
						<th colspan="3" class="report-detail-dark">Assist/Turnover</th>
						<th colspan="4" class="report-detail-midd">Miscellaneous</th>
						<th colspan="2" class="report-detail-dark">Efficiency</th>						
						</tr>

						<tr>
						<th class="report-detail-midd" width="15%">PLAYER</th>
						<th class="report-detail-midd" width="2%">GP</th>
						<th class="report-detail-midd" width="4%">MIN</th>
						<th class="report-detail-dark" width="3%">FGM</th>
						<th class="report-detail-dark" width="3%">FGA</th>
						<th class="report-detail-dark" width="4%">FG%</th>
						<th class="report-detail-midd" width="3%">3PTM</th>
						<th class="report-detail-midd" width="3%">3PTA</th>
						<th class="report-detail-midd" width="4%">3PT%</th>
						<th class="report-detail-dark" width="3%">FTM</th>
						<th class="report-detail-dark" width="3%">FTA</th>
						<th class="report-detail-dark" width="4%">FT%</th>
						<th class="report-detail-midd" width="4%">OREB</th>
						<th class="report-detail-midd" width="4%">DREB</th>
						<th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">REB</th>
						<th class="report-detail-dark" width="4%" style="color:gold;font-weight:bold">AST</th>
						<th class="report-detail-dark" width="4%">TO</th>
						<th class="report-detail-dark" width="4%">A/T</th>
						<th class="report-detail-midd" width="4%">ST</th>
						<th class="report-detail-midd" width="4%">BLK</th>
						<th class="report-detail-midd" width="3%">PF</th>
						<th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">PTS</th>
						<th class="report-detail-yell" width="4%">EFF</th>
						<th class="report-detail-yell" width="4%">EFF36</th>
						</tr>

					</thead>
					
					<tbody>
					</tbody>
					
					</table>
					<div class="tableupdate">
						<?
							$lastupdate = DB::table('syncdataframe')
							->select(DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime'))
							->where('datarange','ALL')
							->where('fbid','LeBron-James')->first();
							echo '<div> Last updated: ' .$lastupdate->updatetime. '</div>';
						?>
					</div>
				</div>				
			</div>
			<div style="height:0;clear:both"></div>
		</div>
		



	</div>
</div>



<style>
div.majorboxN{
	padding: 0 0 5px 0;
}

</style>

<span class="javascript" src="js/hightchart.matchPlayer.js"></span>