<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">
		
		<div class="onerow" ng-controller="MyCtrl">                        
            
            <?
                $rankplayers = DB::table('syncplayerlist')
                    ->select(DB::raw('biodata.player AS player, syncplayerlist.fbid AS fbid,syncplayerlist.team AS team,  syncplayerlist.position AS position, syncplayerlist.injna AS injna, syncplayerlist.owned AS owned,'
                            . 'syncdataframe.wfgp, syncdataframe.wftp, syncdataframe.pwpts,syncdataframe.pw3ptm, syncdataframe.pwtreb, syncdataframe.pwast, syncdataframe.pwst, syncdataframe.pwblk, syncdataframe.pwto,'
                            . 'syncdataframe.zwfgp, syncdataframe.zwftp, syncdataframe.zwpts,syncdataframe.zw3ptm, syncdataframe.zwtreb, syncdataframe.zwast, syncdataframe.zwst, syncdataframe.zwblk, syncdataframe.zwto,'
                            . 'syncdataframe.zwtotal,syncdataframe.rownum,'
                            . 'SUBSTRING(REPLACE(rwtable.report,"&quot;","\""),1,150) as report, syncplayerlist.orank AS orank, syncplayerlist.arank AS arank'))
                    ->leftJoin('biodata','biodata.fbido','=','syncplayerlist.fbido')
                    ->leftJoin('rwtable','rwtable.fbido','=','syncplayerlist.fbido')
                    ->leftJoin(DB::raw('(SELECT @rownum := @rownum +1 AS rownum,syncdataframe.*,'
                            . ' syncdataframe.zwfgp+syncdataframe.zwftp+syncdataframe.zwpts+syncdataframe.zw3ptm+syncdataframe.zwtreb+syncdataframe.zwast+syncdataframe.zwst+syncdataframe.zwblk+syncdataframe.zwto as zwtotal'
                            . ' FROM syncdataframe, (SELECT @rownum :=0)b WHERE datarange="D30" order by zwtotal DESC) syncdataframe'),'syncdataframe.fbido','=','syncplayerlist.fbido')
                    ->where('syncplayerlist.datarange','=','D30')
                    ->orderBy('zwtotal','DESC')->get();
                
//                queryLog
////                var_dump($rankplayers[1]);
////                echo '<div>'.$rankplayers[1]->page.'</div>';
            ?>
            
            
            <div class="col-1p12 last">
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
                <span>
                    <a href="playerStatus" target="" title="Player Status - Players' Latest News and Injury Report.">
                        <img class="link-hover" style="float:left;width:48px" src="images/icon_adsence.png" />
                    </a>
                </span>   
<!--                <span>
                    <a href="playerRankings" target="_blank" title="Player Rankings - Players' Overall and Catagories Power Rankings.">
                        <img class="link-hover" style="float:left;width:48px" src="images/icon_rankings.png" />
                    </a>
                </span>-->
                <span style="font-size:14px;margin:15px;float:right">
                        <? include('include_updatetime.php'); ?>
                </span>
            </div>

            <div class="col-1p12 last" style="background-color: rgba(0,0,0,0.4)">
                <div class="col-1p3" style="float:left;padding: 5px 0 5px 5px">
                    <input ng-click="start()" type="button" value="Page 1" />
                    <input ng-click="prev()" type="button" value="Rrev <" />
                    <input ng-model="page" size="1" /> / {{ pages }}
                    <input ng-click="next()" type="button" value="> Next" />
                </div>

                <div class="col-1p5" style="padding: 5px 0 5px 0px">
                    <select style="float:left;padding:2px 0 2px 0" ng-model="myTeam" ng-options="position.name for position in positions">
                        <option value="">-- All Positions --</option>
                    </select>                    
                    <select style="float:left;padding:2px 0 2px 0" ng-model="myTeam" ng-options="team.name group by team.division for team in teams">
                        <option value="">-- All Teams --</option>
                    </select>                    
                </div>
                
                <div class="col-1p4 last" style="margin: 5px -25px 5px 20px">
                    <div style="float:left;width:60px;height:24px;line-height:24px;font-size:12px;text-align:right;font-weight:bold">Color : </div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(0,255,0,0.5)">Best</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(0,255,0,0.3)">Better</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(0,255,0,0.1)">Good</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(255,0,0,0.1)">Bad</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(255,0,0,0.3)">Worse</div>
                    <div style="float:left;width:50px;height:24px;line-height:24px;font-size:12px;text-align:center;font-weight:bold;background-color:rgba(255,0,0,0.5)">worst</div>
                </div>                
            </div>
            
            <div class="col-1p12 last" style="background-color: rgba(0,0,0,0.4)">
                <div class="col-1p3" style="padding: 5px 0 5px 0px">
                    <img style="width:20px;margin:2px -5px 0 5px;line-height:16px;float:right" src="/images/medal_gold_1.png" />
                    <div class="orderbutton" style="width:54px;float:right"><a class="sorter" herf="" ng-click="predicate = 'orank'; reverse=false">O-rank</a></div>
                    <div style="width:20px;text-align:right">#</div>
                </div>
                
                <div class="col-1p6" style="padding: 5px 0 5px 0px">
                    <div style="margin: 0 0 0 0">
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'zwtotal'; reverse=!reverse">Total</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'zwfgp'; reverse=!reverse">FG%</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'zwftp'; reverse=!reverse">FT%</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pw3ptm'; reverse=!reverse">3PTM</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwpts'; reverse=!reverse">PTS</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwtreb'; reverse=!reverse">REB</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwast'; reverse=!reverse">AST</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwst'; reverse=!reverse">ST</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwblk'; reverse=!reverse">BLK</a></div>
                        <div class="orderbutton"><a class="sorter" herf="" ng-click="predicate = 'pwto'; reverse=!reverse">TO</a></div>
                        <div style="height:0;clear:both"></div>
                    </div>                
                </div>
                <div class="col-1p3 last" style="padding: 5px 0 5px 0px">
                </div>
            </div>
            
        
            
            <div ng-repeat="rankplayer in rankplayers | orderBy:predicate:reverse | filter:searchText | startFrom:(page-1)*limit | limitTo:limit" class="col-1p12 last rankbox" style="margin:1px 0 0 0; background-color: rgba(0,0,0,0.4)" ng-hide="">

                <a href="playerAbility?player={{rankplayer.fbid}}" target="_blank" style="outline:none;color:white">
                <div class="col-1p3">
                    <div style="margin:0px;text-align:center">
                        <div style="float:left;width:30px;text-align: center;padding:18px 10px 0px 0px">
                            {{(page-1)*limit+$index+1}}
                        </div>
                        
                        <div style="float:left;width:40px">
                            <div style="background:url(/images/nophoto.png) no-repeat center;background-size: 40px 48px">
                                <div class="" style="width:40px;height:48px;background:url(/player/{{rankplayer.fbid}}.png) no-repeat center; background-size: 40px 48px"></div>
                            </div>                            
                        </div>
                        
                        <div style="float:left">
                            <div class="" style="padding:0 0 0 5px;text-align:left;color:gold;overflow : hidden; text-overflow : ellipsis; white-space : nowrap; width : 145px">{{rankplayer.player}}</div>
                            <div class="" style="padding:0 0 0 5px;text-align:left">({{rankplayer.team}} - {{rankplayer.position}})</div>
                            <div class="" style="padding:0 0 0 5px;text-align:left;color:red">{{rankplayer.injna}}</div>
                        </div>
                        
                        <div style="float:right;width:30px">
                            <div style="color:gold;font-weight: bold;line-height:42px;margin-right:-20px">{{rankplayer.rownum}}</div>
                        </div>
                        <div style="float:right;width:30px">
                            <div style="line-height:42px;margin-right:-10px">{{rankplayer.orank}}</div>
                        </div>
                        
                        <div style="height:0;clear:both"></div>
                    </div>
                </div>
                </a>

                <div class="col-1p6">
                    <div style="float:left;width:54px;text-align:center;font-weight: bold;line-height:42px">{{rankplayer.zwtotal.toFixed(2)}}</div>
                    <div style="float:left;padding: 0px 0 0px 0">
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
                    <div style="height:0;clear:both"></div>
                </div>                

                <div class="col-1p3 last">
                    <div style="margin:1px 1px 1px -50px">{{rankplayer.report}}</div>
                </div>

                <div style="height:0;clear:both"></div>

            </div>
            <div class="col-1p12 last" style="margin-top:1px;background-color:rgba(0,0,0,0.4) ">
                <div class="col-1p3" style="margin:5px 0 0 5px">
                    <input ng-click="start()" type="button" value="Page 1" />
                    <input ng-click="prev()" type="button" value="Rrev <" />
                    <input ng-model="page" size="1" /> / {{ pages }}
                    <input ng-click="next()" type="button" value="> Next" />
                </div>
                <div class="col-1p5">
                </div>

            </div>
            
            <div class="col-1p12 last" style="height: 100px;background-color: rgba(0,0,0,0.4) ">
                <div style="padding-top:20px;font-size:14px;padding:10px">Note: </br>
                    The above number means players' stats per game,</br>
                    and The number inside the brackets means "The Standard Score (Z-score)".</br>
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
    width: 54px;
    padding: 5px 0 4px 0;
    text-align: center;
}
.orderbutton{
    font-size: 12px;
    float: left;
    width: 52px;
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

//    $scope.$watch('getNews', function(val){
//        alert();
//    });

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

//    $scope.$watch('test', function(val) {
//        alert();
//    });

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
    
    $scope.teams = [
      {name:'Bos',division:'Atlantic' },
      {name:'Bkn',division:'Atlantic' },
      {name:'NY' ,division:'Atlantic' },
      {name:'Phi',division:'Atlantic' },
      {name:'Tor',division:'Atlantic' },
      {name:'Chi',division:'Central'  },
      {name:'Cle',division:'Central'  },
      {name:'Det',division:'Central'  },
      {name:'Ind',division:'Central'  },
      {name:'Mil',division:'Central'  },
      {name:'Atl',division:'SouthEast'},
      {name:'Mia',division:'SouthEast'},
      {name:'Orl',division:'SouthEast'},
      {name:'Was',division:'SouthEast'},
      {name:'Cha',division:'SouthEast'},
      {name:'Dal',division:'SouthWest'},
      {name:'Hou',division:'SouthWest'},
      {name:'Mem',division:'SouthWest'},
      {name:'NO' ,division:'SouthWest'},
      {name:'SA' ,division:'SouthWest'},
      {name:'Den',division:'NorthWest'},
      {name:'Min',division:'NorthWest'},
      {name:'OKC',division:'NorthWest'},
      {name:'Por',division:'NorthWest'},
      {name:'Uta',division:'NorthWest'},
      {name:'GS' ,division:'Pacific'  },
      {name:'LAC',division:'Pacific'  },
      {name:'LAL',division:'Pacific'  },
      {name:'Pho',division:'Pacific'  },
      {name:'Sac',division:'Pacific'  }
    ];
    $scope.myTeam = null;

    $scope.positions = [
      {name:'PG'},
      {name:'SG'},
      {name:'SF' },
      {name:'PF'},
      {name:'C'},
    ];
    
    
    console.log($scope.rankplayers);
});
</script>




