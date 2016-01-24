<div class="{{ $tablename }}" style="border-radius:10px;padding:7px;margin:5px">
	<div>

		<div style="padding:5px">
				<?
					if ( $tablename  == 'todaybo') { 
				?>
					<span>{{ $tabletitle }}</span>
					<span class="colorlabel-{{ $tablename }}" style="color:#fff;padding:0 3px 2px 3px;border-radius:3px;font-weight:bold;font-size:10px">{{$livemark}}</span>
				<?
					}
					elseif ($tablename == 'todaysg' ){
				?>
					<span>{{ $tabletitle }}</span>
					<span class="colorlabel-{{ $tablename }}" style="color:#fff;padding:0 3px 2px 3px;border-radius:3px;font-weight:bold;font-size:10px">{{$livemark}}</span>
				<?
					}
					elseif ($tablename == 'recenthot' ){
				?>
					<span>{{ $tabletitle }}</span>
					<img style="width:20px" src="images/hcp_hot.png" />
					<img style="width:20px" src="images/hcp_hot.png" />
					<img style="width:20px" src="images/hcp_hot.png" />	
				<?
					}
					elseif ($tablename == 'recentcold' ){
				?>
					<span>{{ $tabletitle }}</span>
					<img style="width:20px" src="images/hcp_cold.png" />
					<img style="width:20px" src="images/hcp_cold.png" />
					<img style="width:20px" src="images/hcp_cold.png" />				
				<?
					}
				?>
				
		</div>

		<div class="todaydata">

			@foreach($subviewdata as $index => $r)
				<?// $r = $subviewdata[$index] ?>
				<? if ( $index > 5) break ?>
				<div class="prcard-resize" style="float:left">
                    <? if ( $tablename  == 'todaybo' || $tablename  == 'todaysg'){ ?>
                        <a href="gameLog?player={{ $r->fbid }}" target="_blank" style="text-decoration:none;color:#fff">
                    <? }else{ ?>
                        <a href="careerStats?player={{ $r->fbid }}" target="_blank" style="text-decoration:none;color:#fff">
                    <? } ?>
                    <div class="prcard" style="position:relative">
						<div style="float:left;padding:5px">
                            
                            <div style="background:url(/images/nophoto.png) no-repeat center;background-size: 48px 60px">
                                <div class="{{ $tablename }}-face{{ $index }}" style="width:48px;height:60px;background-image:url(player/{{ $r->fbid }}.png);background-size: 48px 60px">
                                    <div class="colorlabel-{{ $tablename }}" style="height:14px;width:14px;line-height:12px;color:#fff;text-align:center">{{ $index+1 }}</div>
                                </div>
                            </div>
                            
						</div>
						<div style="float:left;padding:5px;height:60px;width:75%">
							<div class="{{ $tablename }}-name{{ $index }}">{{ $r->player }} ({{ $r->team }} - {{ $r->position }})</div>
							<div class="{{ $tablename }}-today{{ $index }} {{ $tablename }}-stat">{{ $r->pts2 }} PTS, {{ $r->treb2 }} REB, {{ $r->ast2 }} AST</div>
							<div style="float:right">
								<span class="{{ $tablename }}-min{{ $index }} {{ $tablename }}-stat" >Min {{ $r->min2 }}, </span>
								<span class="{{ $tablename }}-eff{{ $index }}" style="color:gold">EFF {{ $tablesign }}{{ number_format($r->trend,1) }}</span>
							</div>
							<div class="mask{{ $tablename }} {{ $tablename }}-mask{{ $index }}" style="position:absolute;width:100%;height:100%;top:0px;left:0px">
								<div style="padding:5px">Season: {{ $r->pts1 }} PTS, {{ $r->treb1 }} REB, {{ $r->ast1 }} AST</div>
							</div>
						</div>
						<div style="height:0;clear:both"></div>
					</div>
					</a>
				</div>
			@endforeach		

			<div style="height:0;clear:both"></div>

		</div>
		<div style="height:0;clear:both"></div>

	</div>


	<div style="min-height:300px">

		<div style="padding:5px">{{ $tabletitle }} 7-15</div>

		<div class="" style="padding:2px">
			<table class="" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
			<thead>

				<tr>
				<th class="report-detail-midd" width="1%">#</th>
				<th class="report-detail-midd">PLAYER</th>
				<th class="report-detail-midd" width="3%">Min</th>
				<th class="report-detail-midd" width="3%">PTS</th>
				<th class="report-detail-midd" width="3%">REB</th>
				<th class="report-detail-midd" width="3%">AST</th>												
				<th class="report-detail-yell" width="4%">EFF</th>
				</tr>

			</thead>

			<tbody class="{{ $tablename }}table">				
				@foreach($subviewdata as $index => $r)
					<? if ( $index > 5){ ?>
					<tr class="report-detail">
					<td>{{ $index +1}}</td>
                    <? if ($tablename  == 'todaybo' || $tablename  == 'todaysg'){ ?>
                        <td style="text-align:left"><a href="gameLog?player={{ $r->fbid }}" target="_blank" style="text-decoration:none;color:#fff">{{ $r->player }} ({{ $r->team }} - {{ $r->position }})</a></td>					
                    <? }else{ ?>
                        <td style="text-align:left"><a href="careerStats?player={{ $r->fbid }}" target="_blank" style="text-decoration:none;color:#fff">{{ $r->player }} ({{ $r->team }} - {{ $r->position }})</a></td>					
                    <? } ?>					
					<td>{{ $r->min2 }}</td>
					<td>{{ $r->pts2 }}</td>
					<td>{{ $r->treb2 }}</td>
					<td>{{ $r->ast2 }}</td>
					<td>{{ $tablesign }}{{ number_format($r->trend,1) }}</td>
					</tr>
					<? } ?>					
				@endforeach
			</tbody>

			</table>
		</div>
		<div style="height:0;clear:both"></div>
	</div>						
</div>

