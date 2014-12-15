<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">
		
        <div class="onerow" ng-controller="MyCtrl">                        
            
            <?
                $playerstatusO = DB::table('rwtable')
                    ->select('rwtable.fbido','rwtable.fbid','rwtable.player','rwtable.date','rwtable.updatetime','syncplayerlist.injna','syncplayerlist.team','syncplayerlist.position'
                            ,DB::raw('REPLACE(rwtable.report,"&quot;","\"") as report,round(1-newsyncdataframe.wgp/82,2)*100 AS abrate'),'newgamelog.prate'
                            ,DB::raw('STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p") AS date2')
                            ,DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW()) AS news'))
                        ->leftJoin('syncplayerlist','rwtable.fbido','=','syncplayerlist.fbido')
                        ->leftJoin(DB::raw('(select fbido,round((1-count(bxgs)/count(fbid))*100,0) as prate from allgamelog where season="2014" group by fbid) newgamelog'),'rwtable.fbido','=','newgamelog.fbido')
                        ->leftJoin(DB::raw('(select fbido,wgp from syncdataframe where datarange="Y-1") newsyncdataframe'),'rwtable.fbido','=','newsyncdataframe.fbido')                        
//                        ->where(DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW())'),'<=',1440+1440)
                        ->where('syncplayerlist.datarange','=','Full')
                        ->orderBy('date2','DESC')
                        ->get();            

//                $playerstatusO2 = DB::table('rwtable')
//                    ->select('rwtable.fbido','rwtable.fbid','rwtable.player','rwtable.report','rwtable.date','rwtable.updatetime','syncplayerlist.injna','syncplayerlist.team','syncplayerlist.position'
//                            ,DB::raw('round(1-newsyncdataframe.wgp/82,2)*100 AS abrate'),'newgamelog.prate'
//                            ,DB::raw('STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p") AS date2')
//                            ,DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW()) AS news'))
//                        ->leftJoin('syncplayerlist','rwtable.fbido','=','syncplayerlist.fbido')
//                        ->leftJoin(DB::raw('(select fbido,round((1-count(bxgs)/count(fbid))*100,0) as prate from allgamelog where season="2014" group by fbid) newgamelog'),'rwtable.fbido','=','newgamelog.fbido')
//                        ->leftJoin(DB::raw('(select fbido,wgp from syncdataframe where datarange="Y-1") newsyncdataframe'),'rwtable.fbido','=','newsyncdataframe.fbido')                        
//                        ->where(DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW())'),'>',1440+1440)
//                        ->where('syncplayerlist.datarange','=','Full')
//                        ->orderBy('date2','DESC')
//                        ->get();                     
//
//                $playerstatus=array(['status'=>'Other Injury(Long Term)'     ,'value'=>[]]);                
                
//                $queries = DB::getQueryLog();
//                var_dump($queries);
                
                
                $playerstatus=array(
                    ['status'=>'Will Play (100%)'        ,'value'=>[]],
                    ['status'=>'Probable (75%)'          ,'value'=>[]],
                    ['status'=>'Game-Time Decision (51%)','value'=>[]],
                    ['status'=>'Questionable (50%)'      ,'value'=>[]],
                    ['status'=>'Day-to-Day (49%)'        ,'value'=>[]],
                    ['status'=>'Doubtful (25%)'          ,'value'=>[]],
                    ['status'=>'Will NOT Play (0%)'      ,'value'=>[]],
                    ['status'=>'Other Injury'            ,'value'=>[]],
                    ['status'=>'Couple of Weeks (0%)'    ,'value'=>[]],
                    ['status'=>'Out Indefinitely / No Timetable (-10%)' ,'value'=>[]],
                    ['status'=>'Long-Term Injury'        ,'value'=>[]]
                );                
                $stateyes=array("will play",
                    "will start",
                    "will return",
                    "'ll play",
                    "'ll start",
                    "'ll return",
                    "could play",
                    "could start",
                    "could return",
                    "is expected to play",
                    "is expected to start",
                    "is expected to return",
                    "is ready to play",
                    "is ready to start",
                    "is ready to return",
                    "expects to play",
                    "expects to start",
                    "expects to return",
                    "will be active",
                    "be able to suit up",
                    "in the starting"                    
                );
                $stateno=array("will not",
                    "won't",
                    "is not expected",
                    "not ready",
                    "doesn't expect",
                    "is inactive for",
                    "is out for",
                    "listed as out",
                    "will sit out",
                    "ruled out",
                    "is officially out"
                );
                ///////////////////////////////////////////
                function func1($arg1,$arg2){
                    $ans=0;
                    foreach($arg1 as $value){
                        if (strpos($arg2->report, $value)){
                            $ans=1;
                        }
                    }
                    return $ans;
                }
                ///////////////////////////////////////////                
                foreach($playerstatusO as $key => $value){
                    if ($value->news<=2880){ //------------------------------------------------------------------------------------------------------------------------------------------
//                         if (strpos($value->report, "will play"       )| 
//                            strpos($value->report, "will return"     )|  //OLD VERSION1
//                            strpos($value->report, "is ready to play")
                                                
//                        if (strpos($value->report, $stateyes[0])| 
//                            strpos($value->report, $stateyes[1])|  //OLD VERSION2
//                            strpos($value->report, $stateyes[9])
//                                ){
//                            array_push($playerstatus[0]['value'],$value);
//                            
//                            var_dump($value);
//                            echo '<br><br>';
//                            var_dump(strpos($value->report, "questionable"));
//                            echo '<br><br>';
//                        }
                        
                        if (func1($stateyes,$value)){ //判斷要不要打的function
                            array_push($playerstatus[0]['value'],$value);                            
                        }
                        
                        if (strpos($value->report, "probable"    )){array_push($playerstatus[1]['value'],$value);}
                        if (strpos($value->report, "game-time"   )){array_push($playerstatus[2]['value'],$value);}
                        if (strpos($value->report, "questionable")){array_push($playerstatus[3]['value'],$value);}
                        if (strpos($value->report, "day-to-day"  )){array_push($playerstatus[4]['value'],$value);}
                        if (strpos($value->report, "doubtful"    )){array_push($playerstatus[5]['value'],$value);}
                        
//                        if (strpos($value->report, "will not"      )|
//                            strpos($value->report, "won't"         )|
//                            strpos($value->report, "not ready"     )|
//                            strpos($value->report, "will sit out"  )|
//                            strpos($value->report, "ruled out"     )| //OLD VERSION1
//                            strpos($value->report, "is inactive for")|
//                            strpos($value->report, "is out for"    )|
//                            strpos($value->report, "listed as out" )|
//                            strpos($value->report, "doesn't expect")
//                                ){
//                            array_push($playerstatus[6]['value'],$value);
//                        }                        
                        if (func1($stateno,$value)){ //判斷要不要打的function
                            array_push($playerstatus[6]['value'],$value);                            
                        }
                        

                        if (strpos($value->report, "out indefinitely")|
                            strpos($value->report, "timetable"       )
                                ){
                            array_push($playerstatus[9]['value'],$value);
                        }

                        if (($value->injna=="INJ") //------------------------------------------------------------------------------------------------------------------------------------------
                                & (func1($stateyes,$value)==0)
                                
                                & (is_numeric(strpos($value->report, "probable"    ))==0)
                                & (is_numeric(strpos($value->report, "game-time"   ))==0)
                                & (is_numeric(strpos($value->report, "questionable"))==0)
                                & (is_numeric(strpos($value->report, "day-to-day"  ))==0)
                                & (is_numeric(strpos($value->report, "doubtful"    ))==0)
                                
                                & (func1($stateno,$value)==0)
                                
                                & ((strpos($value->report, "out indefinitely")|
                                    strpos($value->report, "timetable"       ))==0)
                                ){
                            array_push($playerstatus[7]['value'],$value);
                        }                        
                        
                    }elseif ($value->injna=="INJ") { //------------------------------------------------------------------------------------------------------------------------------------------
                         if (strpos($value->report, "weeks")){
                             array_push($playerstatus[8]['value'],$value);
                         }else{
                             array_push($playerstatus[10]['value'],$value);
                         }
                         
                    }
                    


                }

//                echo json_encode($playerstatus);

//                foreach ($playerstatus[8]['value'] as $key => $value) {
//                    var_dump($value);
//                    echo '<br><br>';
//                }
                
            ?>
<!--            <div class="fb-like" data-href="" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            <div class="fb-comments" data-herf="" data-width="300" data-numposts="5" data-colorscheme="light"></div>-->
            
<!--            <div class="fb-like" data-href="/playerStatus" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            <div class="fb-comments" data-herf="/playerStatus" data-width="300" data-numposts="5" data-colorscheme="light"></div>-->


            <div style="padding:10px;background-color: rgba(0,0,0,0.2);height:48px;font-weight:bold;color:gold">

                <div>
                    <span>
                        <a href="realtimeBox" target="" title="Real-Time Box - Get real-time NBA players' performance at any time, from anywhere.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_realtimebox.png" />
                        </a>
                    </span>
                    <span>
                        <a href="hotcoldPlayer" target="" title="Hot & Cold Player - Calculate hot and cold players by recent stats.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_hotcold.png" />
                        </a>
                    </span>
<!--                    <span>
                        <a href="playerStatus" target="_blank" title="Player Status - Players' Latest News and Injury Report.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_adsence.png" />
                        </a>
                    </span>   -->
                    <span>
                        <a href="playerRankings" target="" title="Player Rankings - Players' Overall and Catagories Power Rankings.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_rankings.png" />
                        </a>
                    </span>   
                </div>
                
                <img style="margin-left:10px;width:48px" src="images/adsense.png" />
                <span style="font-size:22px">Player Status - Beta Version</span>
                
                <span style="font-size:14px;color:#FFF;font-weight:normal;padding-top:35px;float:right">
                    <div>Risk is Absence Rate - 
                        <span style="color:red;font-weight:bold;margin:1px;padding:0 2px 0 2px;text-align:center;background-color:rgba(255,255,255,0.6);border-radius:2px"> 2013-14 % </span>
                        <span style="color:red;font-weight:bold;margin:1px;padding:0 2px 0 2px;text-align:center;background-color:rgba(255,255,255,0.6);border-radius:2px"> Season % </span>
                    </div>                    
                    <div style="position:relative;right:0;font-weight:bold;bottom:0;color:rgba(46,204,113,0.7);float:right">Sorted by Update Time.</div>
                </span>
                
            </div>
            <div class="" ng-repeat="item in playerstatus" style="">
                <div style="padding:10px;background-color:rgba(0,0,0,0.2);border-bottom: 1pt solid rgba(255,255,255,0.5)">
                    <span style="border-radius:px;padding:px;font-weight:bold;color:">{{item.status}}</span><tr>
                </div>
                <div style="padding:10px;background-color: rgba(0,0,0,0.2)">
                    <div class="status" ng-repeat="pstatus in item.value">
                        <a href="playerAbility?player={{pstatus.fbid}}" target="_blank">
                            
                            <div style="float:left;width:60px;height:72px; background-color:#C3C3C3">
                                <div style="background:url(/images/nophoto.png) no-repeat center;background-size: 60px 72px">
                                    <div style="width:60px;height:72px;background:url(/player/{{pstatus.fbid}}.png) no-repeat center; background-size: 60px 72px"></div>
                                </div>
                            </div>
                            
                        </a>
                        
                        <div style="float:left;padding:2px;width:88%">
                            <div>
                                <span style="color:gold">{{pstatus.player}} <span>
                                <span style="color:white">({{pstatus.team}} </span>
                                <span style="color:white"> - {{pstatus.position}})</span>
                                <span style="color:red">{{pstatus.injna}}</span>
                                
                                <a href="gameLog?player={{pstatus.fbid}}"     target="_blank"><span class="rateblock"> {{pstatus.prate}} % </span></a>
                                <a href="careerStats?player={{pstatus.fbid}}" target="_blank"><span class="rateblock"> {{pstatus.abrate}} % </span></a>                                
                                <span style="color:white;padding-right:3px;float:right">Risk </span>
                            </div>
                            <div style="height:35px">{{pstatus.report}}</div>
                            <div style="position:relative;right:0;bottom:0;color:rgba(46,204,113,0.7);float:right">{{pstatus.date}}</div>
                        </div>
                        <div style="height:0;clear:both"></div>
                        </a>
                    </div>
                    <div style="height:0;clear:both"></div>
                </div>               
            </div>
            
            <div style="padding:10px;background-color: rgba(0,0,0,0.2);height:200px;font-size: 14px">
                Note: Some of the players' news might be not the latest, so you can click player card to update news.<br>
            </div>
                
            
        </div>        
	</div>
</div>

<style>
.status{
    width:49.6%;
    float:left;
    background-color:rgba(0,0,0,0.2);
    margin:2px;
    padding:0px;
    font-size:10px;
}
.rateblock{
    color:red;
    font-weight:bold;
    padding:0px;
    margin:1px;
    width:50px;
    text-align:center;
    background-color:rgba(255,255,255,0.6);
    border-radius:2px;
    float:right;
}
.rateblock:hover{
    box-shadow:0 0 20px rgba(255,255,255,0.9);
}
.status:hover{
    box-shadow:0 0 20px rgba(255,255,255,0.9);
}
</style>

<script>    
angular.module('app', []).filter('startFrom',function(){
}).controller('MyCtrl', function($scope){
    $scope.playerstatus = angular.fromJson(<?=json_encode($playerstatus)?>);
});
</script>





