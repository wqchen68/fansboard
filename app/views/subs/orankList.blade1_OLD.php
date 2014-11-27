<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">
		
		<div class="onerow">

			<div class="col-1p12 last">                
                <div style="float:left;padding:0 0 10px 0">
                   
                    <?=Form::select('rankpage', array(
                    'page1' => 'Rank 1 - 25',
                    'page2' => 'Rank 26 - 50',
                    'page3' => 'Rank 51 - 75',
                    'page4' => 'Rank 76 - 100',
                    'page5' => 'Rank 101 - 125',
                    'page6' => 'Rank 126 - 150',
                    ), Input::get('page', 'page1'), array('class' => 'selectForm player_season', 'style' => 'color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9)'))?>                    
                    
                </div>
            </div>                        
            
            <?
                $rankplayer = DB::table('syncplayerlist')
                    ->select(DB::raw('biodata.player AS player, syncplayerlist.fbid AS fbid,syncplayerlist.team AS team,  syncplayerlist.position AS position, syncplayerlist.injna AS injna, syncplayerlist.owned AS owned,'
                            . 'syncdataframe.wfgp, syncdataframe.wftp, syncdataframe.pwpts,syncdataframe.pw3ptm, syncdataframe.pwtreb, syncdataframe.pwast, syncdataframe.pwst, syncdataframe.pwblk, syncdataframe.pwto,'
                            . 'syncdataframe.zwfgp, syncdataframe.zwftp, syncdataframe.zwpts,syncdataframe.zw3ptm, syncdataframe.zwtreb, syncdataframe.zwast, syncdataframe.zwst, syncdataframe.zwblk, syncdataframe.zwto,'
                            . ' rwtable.report AS report'))
                    ->leftJoin('biodata','biodata.fbido','=','syncplayerlist.fbido')
                    ->leftJoin('rwtable','rwtable.fbido','=','syncplayerlist.fbido')
                    ->leftJoin('syncdataframe','syncdataframe.fbido','=','syncplayerlist.fbido')
                    ->where('syncplayerlist.datarange','=','Y-1')
                    ->where('syncdataframe.datarange','=','Y-1')
                    ->where('orank','<','26')
                    ->orderBy('orank','ASC')->get();
                var_dump($rankplayer[1]->player);
                echo '<div>'.$rankplayer[1]->pwpts.'</div>';
            ?>

            @for ($i = 0; $i < 25; $i++)
            
            <div class="col-1p12 last rankbox" style="margin:1px; background-color: rgba(0,0,0,0.4)">
                <a href="#" class="tooltip">
                    <div class="col-1p3">
                        <div style="margin:10px;text-align:center">
                            <div style="float:left;width:10px;text-align: center;padding:30px 20px 0px 0px">
                                {{ $i+1 }}
                            </div>
                            <div style="float:left;width:30px">
                                <div><img style="width:20px" src="/images/medal_gold_1.png" /></div>
                                <div class="" style="line-height:20px">{{$rankplayer[$i]->owned}}</div>
                            </div>
                            <div style="float:left;width:60px">
                                <div style="background-color:rgba(0,0,0,0.8)">
                                    <div class="" style="width:60px;height:72px;background:url(/player/{{$rankplayer[$i]->fbid}}.png) no-repeat center; background-size: 60px 72px"></div>
                                </div>
                            </div>
                            <div style="float:left">
                                <div class="" style="padding:0 0 0 5px;text-align:left;color:gold">{{$rankplayer[$i]->player}}</div>
                                <div class="" style="padding:0 0 0 5px;text-align:left">({{$rankplayer[$i]->team}} - {{$rankplayer[$i]->position}})</div>
                                <div class="" style="padding:0 0 0 5px;color:red">{{$rankplayer[$i]->injna}}</div>
                            </div>
                            <div style="height:0;clear:both"></div>
                        </div>
                    </div>
                
                    <span style="margin:10px">{{$rankplayer[$i]->report}}</span>
                </a>
                
                <div class="col-1p1">
                    <div style="float:left; background-color:#fff; margin:5px; width:80px; height:80px">
                    </div>
                </div>

                <div class="col-1p5">
                    
                    <table class="" cellpadding="6" cellspacing="0" style="width:100%;clear: both;margin:17px;text-align: center">
                        <tr style="font-weight:normal">
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->wfgp,3)*100}}%</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->wftp,3)*100}}%</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pw3ptm,1)}}</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pwpts,1)}}</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pwtreb,1)}}</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pwast,1)}}</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pwst,1)}}</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pwblk,1)}}</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">{{number_format($rankplayer[$i]->pwto,1)}}</td>
                        </tr>
                        <tr>                                
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwfgp,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwftp,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zw3ptm,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwpts,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwtreb,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwast,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwst,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwblk,2)}})</td>
                            <td class="report-detail" width="4%" style="color:;font-weight:">({{number_format($rankplayer[$i]->zwto,2)}})</td>
                        </tr>
					</table>
                    
                    
                </div>                
                
                <div class="col-1p3 last">                    
                    <div style="float:left; background-color:#fff; margin:5px; width:200px; height:80px"></div>                    
                    
                </div>
                
                <div style="height:0;clear:both"></div>

            </div>
            
            @endfor
                        
                        
                        


          
                   
                    

            <div style="height:0;clear:both"></div>
		</div>		
	</div>
</div>

<style>
    .rankbox{
        font-size:12px;
    }
    a.tooltip {outline:none;color:white}
    /*a.tooltip strong {line-height:30px;}*/
    /*a.tooltip:hover {text-decoration:none;color:white}*/ 
    a.tooltip span {
        z-index:10;display:none; padding:14px 20px;
        margin-top:-30px; margin-left:28px;
        width:300px; line-height:16px;
    }
    a.tooltip:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}

    /*CSS3 extras*/
    a.tooltip span
    {
        border-radius:4px;
        box-shadow: 5px 5px 8px #CCC;
    }    
</style>


<span class="javascript" src="/js/hightchart.orankList.js"></span>
<script src="/js/hightchart.creatRadarChart.js"></script>




