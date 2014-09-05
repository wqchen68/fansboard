<div class="insidemove" style="color:#fff">
	
	<div class="onepcssgrid-1p-1200">	
		
		<div class="onerow">

			<div class="col-1p3 modelCol">				
				<div class="playerlistblock">

					<div style="margin:0px 0 0 0"></div>
					
                    <? include('include_link2realtimeBox.php'); ?>
					
					<div style="height:0;clear:both"></div>
									
					<div class="modelBox" mid="5" style="height:420px;padding:0 0 10px 0;margin:0 0 24px 0"></div>						
								
					<? include('include_link2playerAbility.php'); ?>
					
				</div>				
			</div>

			<div class="col-1p9 last">
				
				<select class="items" style="width:100px;position:absolute;margin: 5px 0 0 5px;z-index:1;padding:5px;background-color:rgba(255,255,255,1);color:#000;border:1px;border-radius: 3px">
                    <optgroup label="General">
                        <option value="ceff" <?=(Input::get('cate')=='ceff'?'selected="selected"':'')?>>EFF</option>
                        <option value="cmin" <?=(Input::get('cate')=='cmin'?'selected="selected"':'')?>>MIN</option>
                        <option value="cpts" <?=(Input::get('cate')=='cpts'?'selected="selected"':'')?>>PTS</option>
                    <optgroup label="Field Goal">
                        <option value="cfgm" <?=(Input::get('cate')=='cfgm'?'selected="selected"':'')?>>FGM</option>
                        <option value="cfga" <?=(Input::get('cate')=='cfga'?'selected="selected"':'')?>>FGA</option>
                        <option value="cfgp" <?=(Input::get('cate')=='cfgp'?'selected="selected"':'')?>>FG%</option>
                    <optgroup label="Free Throw">                        
                        <option value="cftm" <?=(Input::get('cate')=='cftm'?'selected="selected"':'')?>>FTM</option>
                        <option value="cfta" <?=(Input::get('cate')=='cfta'?'selected="selected"':'')?>>FTA</option>
                        <option value="cftp" <?=(Input::get('cate')=='cftp'?'selected="selected"':'')?>>FT%</option>
                    <optgroup label="3 points">
                        <option value="c3ptm" <?=(Input::get('cate')=='c3ptm'?'selected="selected"':'')?>>3PTM</option>
                        <option value="c3pta" <?=(Input::get('cate')=='c3pta'?'selected="selected"':'')?>>3PTA</option>
                        <option value="c3ptp" <?=(Input::get('cate')=='c3ptp'?'selected="selected"':'')?>>3PT%</option>
                    <optgroup label="Rebounds">
                        <option value="coreb" <?=(Input::get('cate')=='coreb'?'selected="selected"':'')?>>OREB</option>
                        <option value="cdreb" <?=(Input::get('cate')=='cdreb'?'selected="selected"':'')?>>DREB</option>
                        <option value="ctreb" <?=(Input::get('cate')=='ctreb'?'selected="selected"':'')?>>REB</option>
                    <optgroup label="Assists">                    
                        <option value="cast" <?=(Input::get('cate')=='cast'?'selected="selected"':'')?>>AST</option>
                        <option value="cto" <?=(Input::get('cate')=='cto'?'selected="selected"':'')?>>TO</option>
                        <option value="catr" <?=(Input::get('cate')=='catr'?'selected="selected"':'')?>>A/T</option>
                    <optgroup label="Misc">                    
                        <option value="cst" <?=(Input::get('cate')=='cst'?'selected="selected"':'')?>>ST</option>
                        <option value="cblk" <?=(Input::get('cate')=='cblk'?'selected="selected"':'')?>>BLK</option>
                        <option value="cpf" <?=(Input::get('cate')=='cpf'?'selected="selected"':'')?>>PF</option>
				</select>
				
				<div class="chart_box highlight chartblock"></div>
				
				<div style="margin:5px 0 0 15px;font-size: 12px">2011-12 Season : The regular season was shortened from the normal 82 games per team to 66.</div>

			</div>


			<div style="height:0;clear:both"></div>



		</div>
		
		<div class="onerow">
			<div class="col-1p12">

				<div class="tablebackground" style="margin:10px 0 0 0">
					<table id="tablecareerstat" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
					<thead>

						<tr>
						<th colspan="4" class="report-detail-midd">Season Stats</th>
						<th colspan="3" class="report-detail-dark">Field Goals</th>
						<th colspan="3" class="report-detail-midd">3-Point Throws</th>
						<th colspan="3" class="report-detail-dark">Free Throws</th>
						<th colspan="3" class="report-detail-midd">Rebounds</th>
						<th colspan="3" class="report-detail-dark">Assist/Turnover</th>
						<th colspan="4" class="report-detail-midd">Miscellaneous</th>
						<th colspan="2" class="report-detail-dark">Efficiency</th>
						</tr>

						<tr>
						<th class="report-detail-midd" width="5%">Season</th>
						<th class="report-detail-midd" width="5%">Team</th>							
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
							$lastupdate = DB::table('syncdataframe')
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
.table-careerstat{
	text-align:right;
	font-weight: normal;
}
</style>




<span class="javascript" src="<?=asset('js/hightchart.careerStats.js')?>"></span>

<!--<script src="http://code.highcharts.com/modules/exporting.js"></script>-->