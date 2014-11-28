<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">
		
        <div class="onerow" ng-controller="MyCtrl">                        
            
            <?
                $playerstatusO = DB::table('rwtable')
                    ->select('rwtable.fbido','rwtable.fbid','rwtable.player','rwtable.report','rwtable.date','rwtable.updatetime','syncplayerlist.injna','syncplayerlist.team','syncplayerlist.position',DB::raw('round(100-careerstats.cgame/82*100,1) AS abrate,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p") AS date2'),DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW()) AS news'))
                        ->leftJoin('syncplayerlist','rwtable.fbido','=','syncplayerlist.fbido')
                        ->leftJoin('careerStats','rwtable.fbido','=','careerStats.fbido')
                        ->where(DB::raw('TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT("2014",DATE),"%Y%b %e - %l:%i %p"),NOW())'),'<=',1440+1440)                        
                        ->where('syncplayerlist.datarange','=','Full')
                        ->where('careerStats.cseason','=','2013-14')
                        ->orderBy('date2','DESC')
                        ->get();
                
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
                        
//                        var_dump($value);
//                        echo '<br><br>';
//                        var_dump(strpos($value->report, "will not play"));
//                        echo '<br><br>';
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

            <div style="padding:10px;background-color: rgba(0,0,0,0.2);height:20px;font-weight:bold;color:gold">
                Player Status - Beta Version
            </div>
            <div class="" ng-repeat="item in playerstatus" style="">
                <div style="padding:10px;background-color: rgba(0,0,0,0.2)">
                    <span style="border-radius:px;padding:px;font-weight:bold;color:">{{item.status}}</span>
                </div>
                <div style="padding:10px;background-color: rgba(0,0,0,0.2)">
                    <div class="status" ng-repeat="pstatus in item.value">
                        <a href="playerAbility?player={{pstatus.fbid}}" target="_blank" style="outline:none;color:white">
                        
                        <div style="float:left;width:60px;height:72px;background:url(/images/help1.png) no-repeat center; background-size: 60px 72px">
                            <div style="width:60px;height:72px;background:url(/player/{{pstatus.fbid}}.png) no-repeat center; background-size: 60px 72px"></div>
                        </div>
                        
                        <div style="float:left;padding:2px;width:88%">
                            <div>
                                <span style="color:gold">{{pstatus.player}} <span>
                                <span style="color:white">({{pstatus.team}} </span>
                                <span style="color:white"> - {{pstatus.position}})</span>
                                <span style="color:red">{{pstatus.injna}}</span>
                                <span style="color:white"> --- Risk </span>
                                <span style="color:red;font-weight:bold">{{pstatus.abrate}} %</span>
                                <span style="color:rgba(46,204,113,0.7);float:right">{{pstatus.date}}</span>
                            </div>
                            <div>{{pstatus.report}}</div>
                        </div>
                        <div style="height:0;clear:both"></div>
                        </a>
                    </div>
                    <div style="height:0;clear:both"></div>
                </div>               
            </div>
            
            <div style="padding:10px;background-color: rgba(0,0,0,0.2);height:200px">
                Note: Some of the players' news might be not the latest, so you can click player card to update news.<br>
                Risk: 2013-14 Absence Rate
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
</style>

<script>    
angular.module('app', []).filter('startFrom',function(){
}).controller('MyCtrl', function($scope){
    $scope.playerstatus = angular.fromJson(<?=json_encode($playerstatus)?>);
});
</script>





