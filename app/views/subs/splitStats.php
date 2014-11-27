<div class="insidemove" style="color:#fff">
	<div class="onepcssgrid-1p-1200">		
		
		<div class="onerow">

			<div class="col-1p3 modelCol">				
				<div class="playerlistblock">
				
					<div style="float:left;padding:0 0 10px 0">
                        <?=Form::select('range', array(
                            '2014' => '2014-15 Season',
                            '2013' => '2013-14 Season',
                            '2012' => '2012-13 Season',
                            '2011' => '2011-12 Season'
                            ), Input::get('season', '2014'), array('class' => 'selectForm', 'style' => 'color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9)'))?>
					</div>

                    <? include('include_link2realtimeBox.php'); ?>
					
					<div style="height:0;clear:both"></div>
					
					<div class="modelBox" mid="5" style="height:420px;padding:0 0 10px 0;margin:0 0 24px 0"></div>

					<? include('include_link2playerAbility.php'); ?>
					
				</div>
			</div>

			<div class="col-1p9 last highlight">
				
				<div class="chartblock" style="background-color: rgba(0,0,0,0.6)">
					<div class="">
						<div class="col-1p3">
							<div id="chart_splitstats1"></div>
						</div>
						<div class="col-1p3">
							<div id="chart_splitstats3"></div>
						</div>
						<div class="col-1p3">
							<div id="chart_splitstats5"></div>
						</div>                        
						<div class="col-1p3 last">
							<div id="chart_splitstats2"></div>
						</div>	                        
					</div>
					<div class="">
						<div class="col-1p12 last">
							<div id="chart_splitstats4"></div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		
		
		
		<div class="onerow" style="padding:10px 0 0 0">
			<div class="col-1p12">

				<div class="tablebackground">
					<table id="tablesplitdata" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
					<thead>
						<tr>
						<th colspan="4" class="report-detail-midd">Split Data Average</th>
						<th colspan="3" class="report-detail-dark">Field Goals</th>
						<th colspan="3" class="report-detail-midd">3-Point Throws</th>
						<th colspan="3" class="report-detail-dark">Free Throws</th>
						<th colspan="3" class="report-detail-midd">Rebounds</th>
						<th colspan="3" class="report-detail-dark">Assist/Turnover</th>
						<th colspan="4" class="report-detail-midd">Miscellaneous</th>
						<th colspan="2" class="report-detail-dark">Efficiency</th>
						</tr>

						<tr>
						<th class="report-detail-midd" width="4%">Season</th>
						<th class="report-detail-midd" width="10%">Condition</th>							
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
						<th class="report-detail-midd" width="3%">OREB</th>
						<th class="report-detail-midd" width="3%">DREB</th>
						<th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">REB</th>
						<th class="report-detail-dark" width="3%" style="color:gold;font-weight:bold">AST</th>
						<th class="report-detail-dark" width="3%">TO</th>
						<th class="report-detail-dark" width="4%">A/T</th>
						<th class="report-detail-midd" width="3%">ST</th>
						<th class="report-detail-midd" width="3%">BLK</th>
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
							$lastupdate = DB::table('splitdata')
							->select(DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime'))
                            ->first();
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
</style>


<span class="javascript" src="/js/hightchart.splitStats.js"></span>











