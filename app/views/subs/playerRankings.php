<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">
		
		<div class="onerow" ng-controller="MyCtrl">

			<div class="col-1p12 last">

<!--                <div style="float:left;padding:0 0 0 0">                   
                    <?=Form::select('position', array(
                    'ALL' => 'ALL',
                    'PG' => 'PG',
                    'SG' => 'SG',
                    'SF' => 'SF',
                    'PF' => 'PF',
                    'C' => 'C',
                    ), Input::get('position', 'ALL'), array('class' => 'selectForm player_season', 'style' => 'color:#000;box-shadow:0 0 0px rgba(255,0,0,0.9)', 'ng-model' => 'position'))?>                    
                </div>
                <div style="float:left;padding:0 0 0 0">                   
                    <?=Form::select('position', array(
                    'ALL' => 'ALL',
                    'PG' => 'PG',
                    'SG' => 'SG',
                    'SF' => 'SF',
                    'PF' => 'PF',
                    'C' => 'C',
                    ), Input::get('position', 'ALL'), array('class' => 'selectForm player_season', 'style' => 'color:#000;box-shadow:0 0 0px rgba(255,0,0,0.9)', 'ng-model' => 'position'))?>                    
                </div>-->

            </div>                        
            
            <?
                $rankplayers = DB::table('syncplayerlist')
                    ->select(DB::raw('biodata.player AS player, syncplayerlist.fbid AS fbid,syncplayerlist.team AS team,  syncplayerlist.position AS position, syncplayerlist.injna AS injna, syncplayerlist.owned AS owned,'
                            . 'syncdataframe.wfgp, syncdataframe.wftp, syncdataframe.pwpts,syncdataframe.pw3ptm, syncdataframe.pwtreb, syncdataframe.pwast, syncdataframe.pwst, syncdataframe.pwblk, syncdataframe.pwto,'
                            . 'syncdataframe.zwfgp, syncdataframe.zwftp, syncdataframe.zwpts,syncdataframe.zw3ptm, syncdataframe.zwtreb, syncdataframe.zwast, syncdataframe.zwst, syncdataframe.zwblk, syncdataframe.zwto,'
                            . ' rwtable.report AS report, syncplayerlist.orank AS orank, syncplayerlist.arank AS arank'))
                    ->leftJoin('biodata','biodata.fbido','=','syncplayerlist.fbido')
                    ->leftJoin('rwtable','rwtable.fbido','=','syncplayerlist.fbido')
                    ->leftJoin('syncdataframe','syncdataframe.fbido','=','syncplayerlist.fbido')
                    ->where('syncplayerlist.datarange','=','Y-1')
                    ->where('syncdataframe.datarange','=','Y-1')
                    ->orderBy('orank','ASC')->get();
//                var_dump($rankplayers[1]);
//                echo '<div>'.$rankplayers[1]->page.'</div>';
            ?>
            
            <div class="col-1p12 last" style="background-color: rgba(0,0,0,0.4)">
                <div class="col-1p3" style="padding: 20px 0 0px 0px">
                    <div class="orderbutton" style="width:22px"><a class="sorter" herf="" ng-click="predicate = 'orank'; reverse=false">#</a></div>
                    <input ng-click="start()" type="button" value="Page 1" />
                    <input ng-click="prev()" type="button" value="Rrev <" />
                    <input ng-model="page" size="1" /> / {{ pages }}
                    <input ng-click="next()" type="button" value="> Next" />
                </div>
                <div class="col-1p5" style="padding: 20px 0 0px 0px">
                    <div style="margin: 0 0 0 0">
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'zwfgp'; reverse=true">FG%</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'zwftp'; reverse=true">FT%</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pw3ptm'; reverse=true">3PTM</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwpts'; reverse=true">PTS</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwtreb'; reverse=true">REB</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwast'; reverse=true">AST</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwst'; reverse=true">ST</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwblk'; reverse=true">BLK</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwto'; reverse=true">TO</a></div>
                        <div style="height:0;clear:both"></div>
                    </div>                
                </div>
                <div class="col-1p4 last" style="padding: 10px 0 10px 0px">
                    <div style="float:left;width:60px;height:24px;line-height:24px;font-size:12px;text-align:right;font-weight:bold">Color : </div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(0,255,0,0.5)">Best</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(0,255,0,0.3)">Better</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(0,255,0,0.1)">Good</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(255,0,0,0.1)">Bad</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(255,0,0,0.3)">Worse</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(255,0,0,0.5)">worst</div>
                </div>
            </div>
            
        
            
            <div ng-repeat="rankplayer in rankplayers | orderBy:predicate:reverse | filter:searchText | startFrom:(page-1)*limit | limitTo:limit" class="col-1p12 last rankbox" style="margin:1px; background-color: rgba(0,0,0,0.4)" ng-hide="">

                <a href="playerAbility?player={{rankplayer.fbid}}" target="_blank" style="outline:none;color:white">
                <div class="col-1p3">
                    <div style="margin:5px;text-align:center">
                        <div style="float:left;width:10px;text-align: center;padding:30px 20px 0px 0px">
                            {{(page-1)*limit+$index+1}}
                        </div>
                        <div style="float:left;width:30px">
                            <div><img style="width:20px" src="/images/medal_gold_1.png" /></div>
                            <div class="" style="line-height:20px">{{rankplayer.owned}}</div>
                        </div>
                        <div style="float:left;width:60px">
                            <div style="background-color:rgba(0,0,0,0.8)">
                                <div class="" style="width:60px;height:72px;background:url(/player/{{rankplayer.fbid}}.png) no-repeat center; background-size: 60px 72px"></div>
                            </div>
                        </div>
                        <div style="float:left">
                            <div class="" style="padding:0 0 0 5px;text-align:left;color:gold;overflow : hidden; text-overflow : ellipsis; white-space : nowrap; width : 145px">{{rankplayer.player}}</div>
                            <div class="" style="padding:0 0 0 5px;text-align:left">({{rankplayer.team}} - {{rankplayer.position}})</div>
                            <div class="" style="padding:0 0 0 5px;text-align:left;color:red">{{rankplayer.injna}}</div>
                        </div>
                        <div style="height:0;clear:both"></div>
                    </div>
                </div>
                </a>               

<!--                <div class="col-1p1">
                    <div style="float:left; background-color:#; margin:5px; width:70px; height:70px">
                    </div>
                </div>-->

                <div class="col-1p5">
                    <div style="padding: 10px 0 10px 0">
                        <div style="">
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwfgp) };">{{((rankplayer.wfgp)*100).toFixed(1)}}%</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwftp) };">{{((rankplayer.wftp)*100).toFixed(1)}}%</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zw3ptm)};">{{rankplayer.pw3ptm.toFixed(2)}}</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwpts) };">{{rankplayer.pwpts.toFixed(2)}}</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwtreb)};">{{rankplayer.pwtreb.toFixed(2)}}</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwast) };">{{rankplayer.pwast.toFixed(2)}}</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwst)  };">{{rankplayer.pwst.toFixed(2)}}</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwblk) };">{{rankplayer.pwblk.toFixed(2)}}</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwto)  };">{{rankplayer.pwto.toFixed(2)}}</div>
                            <div style="height:0;clear:both"></div>
                        </div>
                        <div style="">
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwfgp) };">({{rankplayer.zwfgp.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwftp) };">({{rankplayer.zwftp.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zw3ptm)};">({{rankplayer.zw3ptm.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwpts) };">({{rankplayer.zwpts.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwtreb)};">({{rankplayer.zwtreb.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwast) };">({{rankplayer.zwast.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwst)  };">({{rankplayer.zwst.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwblk) };">({{rankplayer.zwblk.toFixed(2)}})</div>
                            <div class="ranktable" ng-style="{'background-color': style(rankplayer.zwto)  };">({{rankplayer.zwto.toFixed(2)}})</div>
                            <div style="height:0;clear:both"></div>
                        </div>
                        <div style="height:0;clear:both"></div>
                    </div>
                </div>                

                <div class="col-1p4 last">
                    <div style="margin:10px">{{rankplayer.report}}</div>
                </div>

<!--                <div class="col-1p3 last">                    
                    <div style="float:left; background-color:#; margin:5px; width:200px; height:70px"></div>                    

                </div>-->

                <div style="height:0;clear:both"></div>                    

            </div>
            <div class="col-1p12 last">
                <div class="col-1p3">
                    <input ng-click="start()" type="button" value="Page 1" />
                    <input ng-click="prev()" type="button" value="Rrev <" />
                    <input ng-model="page" size="1" /> / {{ pages }}
                    <input ng-click="next()" type="button" value="> Next" />
                </div>
                <div class="col-1p5">
                </div>

            </div>
        </div>
        

        <div style="height:0;clear:both"></div>
        
	</div>
</div>

<style>
.rankbox{
    font-size: 12px;
}
.ranktable{
    float: left;
    width: 11%;
    padding: 8px 0 8px 0;
    text-align: center;
}
.orderbutton{
    font-size: 12px;
    float: left;
    width: 52.2px;
    color: black;
    text-align: center;
    font-weight: bold;
    border-radius: 5px;
    background-color: gold;
    line-height: 20px;
    margin: 1px;
    cursor: pointer;
}
.orderbutton:hover{
    text-decoration:underline;
    color: #5599FF;
}
/*a.tooltip {outline:none;color:white}
a.tooltip strong {line-height:30px;}
a.tooltip:hover {text-decoration:none;color:white} 
a.tooltip .report {
    z-index:10;
    display:none;
    padding:14px 20px;
    margin:-30px 0 0 28px;
    width:300px;
    line-height:16px;
}
a.tooltip:hover .report{
    display:inline;
    position:absolute;
    color:#111;
    border:1px solid #DCA;
    background:#fffAF0;
    background:rgba(255,255,255,1);
}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}

CSS3 extras
a.tooltip .report
{
        border-radius:4px;
    box-shadow: 5px 5px 8px #CCC;
}*/
</style>


<span class="javascript" src="/js/hightchart.orankList.js"></span>
<script src="/js/hightchart.creatRadarChart.js"></script>








<script>    
angular.module('app', []).filter('startFrom',function(){
    return function(input, start){
        return input.slice(start);
    };
}).controller('MyCtrl', function($scope){
    $scope.rankplayers = angular.fromJson(<?=json_encode($rankplayers)?>);
    $scope.page = 1;
    $scope.limit = 25;
    $scope.max = $scope.rankplayers.length;
    $scope.pages = Math.ceil($scope.max/$scope.limit);

    $scope.style = function(value) {
        if (value<-2){
            return 'rgba(255,0,0,0.5)';
        }else if(value>=-2 & value<-1 ){
            return 'rgba(255,0,0,0.3)';
        }else if(value>=-1 & value<0 ){
            return 'rgba(255,0,0,0.1)';                
        }else if(value>=0 & value<1 ){
            return 'rgba(0,255,0,0.1)';
        }else if(value>=1 & value<2 ){
            return 'rgba(0,255,0,0.3)';
        }else if(value>=2 ){
            return 'rgba(0,255,0,0.5)';
        }else{
            return '';
        }
    };

    $scope.next = function() {
        if( $scope.page < $scope.pages )
            $scope.page++;
    };

    $scope.prev = function() {
        if( $scope.page > 1 )
            $scope.page--;
    };
    $scope.start = function() {
        $scope.page = 1;
    };
    
//    console.log($scope.rankplayers);
});
</script>




