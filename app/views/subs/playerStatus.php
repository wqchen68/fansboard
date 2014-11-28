<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">
		
        <div class="onerow" ng-controller="MyCtrl">                        
            
            <?
                $playerstatusO = DB::table('rwtable')
                    ->select('rwtable.fbido','rwtable.fbid','rwtable.player','rwtable.report','rwtable.date','rwtable.updatetime','syncplayerlist.injna','syncplayerlist.team','syncplayerlist.position'
                            ,DB::raw('round(1-syncdataframe.wgp/82,2)*100 AS abrate'),'newgamelog.prate'
                            ,DB::raw('STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p") AS date2')
                            ,DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW()) AS news'))
                        ->leftJoin('syncplayerlist','rwtable.fbido','=','syncplayerlist.fbido')
                        ->leftJoin('syncdataframe','rwtable.fbido','=','syncdataframe.fbido')
                        ->leftJoin(DB::raw('(select fbido,round((1-count(bxgs)/count(fbid))*100,0) as prate from allgamelog where season="2014" group by fbid) newgamelog'),'rwtable.fbido','=','newgamelog.fbido')
                        ->where(DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW())'),'<=',1440+1440)                        
                        ->where('syncplayerlist.datarange','=','Full')
                        ->where('syncdataframe.datarange','=','Y-1')
                        ->orderBy('date2','DESC')
                        ->get();
                
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
                    ['status'=>'Out Indefinitely (-10%)' ,'value'=>[]],
                    ['status'=>'Other Injury'            ,'value'=>[]]);
                foreach($playerstatusO as $key => $value){
                    if (strpos($value->report, "will play") | strpos($value->report, "will return") | strpos($value->report, "will start") | strpos($value->report, "is ready to play")){
                        array_push($playerstatus[0]['value'],$value);
                    }
                    if (strpos($value->report, "probable")){
                        array_push($playerstatus[1]['value'],$value);
                        
//                        var_dump($value);
//                        echo '<br><br>';
//                        var_dump(strpos($value->report, "questionable"));
//                        echo '<br><br>';
                        
                    }
                    if (strpos($value->report, "game-time")){
                        array_push($playerstatus[2]['value'],$value);
                    }
                    if (strpos($value->report, "questionable")){
                        array_push($playerstatus[3]['value'],$value);
                    }
                    if (strpos($value->report, "day-to-day")){
                        array_push($playerstatus[4]['value'],$value);
                    }
                    if (strpos($value->report, "doubtful")){
                        array_push($playerstatus[5]['value'],$value);
                    }
//                    if ((strpos($value->report, "will not")|strpos($value->report, "won't")|strpos($value->report, "not ready")) & (strpos($value->report, "play")|strpos($value->report, "return")|strpos($value->report, "start")) ){
                    if (strpos($value->report, "will not")|strpos($value->report, "won't")|strpos($value->report, "not ready")|strpos($value->report, "doesn't expect")){
                        array_push($playerstatus[6]['value'],$value);
                    }
                    if (strpos($value->report, "out indefinitely")){
                        array_push($playerstatus[7]['value'],$value);
                    }                    
                    if (($value->injna=="INJ")
                            & ((strpos($value->report, "will play") | strpos($value->report, "will return") | strpos($value->report, "will start") | strpos($value->report, "is ready to play"))==0)
                            & (is_numeric(strpos($value->report, "probable"))==0)
                            & (is_numeric(strpos($value->report, "game-time"))==0)
                            & (is_numeric(strpos($value->report, "questionable"))==0)
                            & (is_numeric(strpos($value->report, "day-to-day"))==0)
                            & (is_numeric(strpos($value->report, "doubtful"))==0)
//                            & (((strpos($value->report, "will not")|strpos($value->report, "won't")|strpos($value->report, "not ready")) & (strpos($value->report, "play")|strpos($value->report, "return")|strpos($value->report, "start")))==0)
                            & ((strpos($value->report, "will not")|strpos($value->report, "won't")|strpos($value->report, "not ready")|strpos($value->report, "doesn't expect"))==0)
                            & (is_numeric(strpos($value->report, "out indefinitely"))==0)
                            ){
                        array_push($playerstatus[8]['value'],$value);
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
                <img style="width:48px" src="images/adsense.png" />
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
                        <div style="float:left;width:60px;height:72px;background:url(/images/help1.png) no-repeat center; background-size: 60px 72px">
                            <div style="width:60px;height:72px;background:url(/player/{{pstatus.fbid}}.png) no-repeat center; background-size: 60px 72px"></div>
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
                            <div style="height:35px;z-index:10">{{pstatus.report}}</div>
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





