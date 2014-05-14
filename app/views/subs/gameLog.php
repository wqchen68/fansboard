<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">		

		<div class="onerow">

			<div class="col-1p3 modelCol">
				
				<div class="playerlistblock">
						
					<div style="float:left;padding:0 0 10px 0">
						<select class="selectForm player_season">
							<option value="ALL" selected="selected">2013-14 Season</option>
							<option value="2012">2012-13 Season</option>
							<option value="2011">2011-12 Season</option>
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

					<a class="link-playerAbility">
					<div class="majorbox playercardsmall highlight">
						<div style="float:left">
							<img class="face" style="width:60px;height:72px;display:block" src="images/help1.png" />
						</div>
						<div class="playercardsmall-news">
							<div>
								<div class="cardplayer"></div>
								<div class="cardteamposi" style="float:left;padding:0 5px 0 0"></div><div class="cardinjna"></div>
								<div style="height:0;clear:both"></div>
							</div>
							<div class="cardstat"></div>
						</div>
						<div style="height:0;clear:both"></div>
					</div>
					</a>
					
				</div>
			</div>
			
			<div class="col-1p9 last">
				<div id="chart_gamelog" class="chartblock highlight"></div>
			</div>

		</div>	


		<div class="onerow" style="padding:10px 0 0 0">
			<div class="col-1p12">

				<div class="tablebackground">
					<table id="tableGamelog" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
					<thead>

						<tr>
						<th colspan="5" class="report-detail-midd">Game Logs</th>
						<th colspan="3" class="report-detail-dark">Field Goals</th>
						<th colspan="3" class="report-detail-midd">3-Point Throws</th>
						<th colspan="3" class="report-detail-dark">Free Throws</th>
						<th colspan="3" class="report-detail-midd">Rebounds</th>
						<th colspan="2" class="report-detail-dark">Assist/TO</th>
						<th colspan="4" class="report-detail-midd">Miscellaneous</th>
						<th colspan="2" class="report-detail-dark">Efficiency</th>						
						</tr>

						<tr>
						<th class="report-detail-midd" width="8%">Date</th>
						<th class="report-detail-midd" width="5%">Oppo.</th>							
						<th class="report-detail-midd" width="7%">Score</th>														
						<th class="report-detail-midd" width="2%">Start</th>
						<th class="report-detail-midd" width="4%">MIN</th>
						<th class="report-detail-dark" width="2%">FGM</th>
						<th class="report-detail-dark" width="2%">FGA</th>
						<th class="report-detail-dark" width="3%">FG%</th>
						<th class="report-detail-midd" width="2%">3PTM</th>
						<th class="report-detail-midd" width="2%">3PTA</th>
						<th class="report-detail-midd" width="3%">3PT%</th>
						<th class="report-detail-dark" width="2%">FTM</th>
						<th class="report-detail-dark" width="2%">FTA</th>
						<th class="report-detail-dark" width="3%">FT%</th>
						<th class="report-detail-midd" width="2%">OREB</th>
						<th class="report-detail-midd" width="2%">DREB</th>
						<th class="report-detail-midd" width="2%" style="color:gold;font-weight:bold">REB</th>
						<th class="report-detail-dark" width="2%" style="color:gold;font-weight:bold">AST</th>
						<th class="report-detail-dark" width="2%">TO</th>
						<th class="report-detail-midd" width="2%">ST</th>
						<th class="report-detail-midd" width="2%">BLK</th>
						<th class="report-detail-midd" width="2%">PF</th>
						<th class="report-detail-midd" width="3%" style="color:gold;font-weight:bold">PTS</th>
						<th class="report-detail-yell" width="4%">EFF</th>
						<th class="report-detail-yell" width="4%">EFF36</th>
						</tr>

					</thead>
					
					<tbody>
					</tbody>
					
					</table>
					<div class="tableupdate">
						<?
							$lastupdate = DB::table('allgamelog')
							->select(DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime2'))
							->orderBy('updatetime','desc')
							->first();
							echo '<div> Last updated: ' .$lastupdate->updatetime2. '</div>';						
						?>
					</div>
				</div>
			</div>
		</div>


		<div class="onerow" style="padding:10px 0 10px 0">
			<div class="col-1p3 note" style="float:left;padding:0 0 20px 0">
			
				<div>Legend</div>

				<div style="text-align:left;margin:10px 0 0 0">
					<table cellpadding="6" cellspacing="0" style="font-size:12px;clear: both;color:#fff">
					<thead>
						<tr>
						<td width="5%">Game EFF</td>
						<td width="20%">: Efficency per game</td>
						</tr>
						
						<tr>
						<td width="5%">Short-Term</td>
						<td width="20%">: Last 3 Games EFF Average</td>
						</tr>
						
						<tr>
						<td width="5%">Mid-Term</td>
						<td width="20%">: Last 6 Games EFF Average</td>
						</tr>
						
						<tr>
						<td width="5%">Long-Term</td>
						<td width="20%">: Last 9 Games EFF Average</td>
						</tr>
					</thead>
					</table>
				</div>
			</div>
			
			<div class="col-1p9 note last" style="float:left">
				<div >Example</div>
				<div class="exfig" style="background-image:url(images/gamelogex1.png)">
					<div style="padding: 210px 0 0 65px;color:#000;font-size:14px">
					<p style="line-height: 25px">Kevin Durant (OKC - SF,PF)</br>
					High and Stable Efficiency</p>
					</div>
				</div>
				<div class="exfig" style="background-image:url(images/gamelogex2.png)">
					<div style="padding: 210px 0 0 65px;color:#000;font-size:14px">
					<p style="line-height: 25px">Kyrie Irving (Cle – PG,SG)</br>
					Buy Low Sell High Trade</p>
					</div>
				</div>
				<div class="exfig" style="background-image:url(images/gamelogex3.png)">
					<div style="padding: 210px 0 0 65px;color:#000;font-size:14px">
					<p style="line-height: 25px">Dwyane Wade (Mia – PG,SG)</br>
					Low Frequency of Games</p>
					</div>
				</div>
				<div style="height:0;clear:both"></div>
			</div>
			
			<div style="height:0;clear:both"></div>
		</div>
		


	</div>
</div>

<style>

div.exfig{
	background-repeat: no-repeat;
	width:288px;
	height:288px;
	background-size:288px 288px;
	float:left;
	margin:10px 5px 5px 5px;
}

/*.table-gamelog{
	text-align:right;
	font-weight: normal;
}*/


</style>




<span class="javascript" src="js/hightchart.gamelog.js"></span>
