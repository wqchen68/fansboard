<div class="insidemove" style="color:#fff" ng-controller="abilityCtl">

    <div class="onepcssgrid-1p-1200">

        <div class="onerow">

            <div class="col-1p3">
                <div class="playerlistblock">

                    <div style="float:left;padding:0 0 10px 0">
                        <select ng-model="rangeNow" ng-change="getPlayers()" style="color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9)">
                            <option value="{{range.key}}" ng-repeat="range in ranges">{{range.name}}</option>
                        </select>
                    </div>

                    <? include('include_link2realtimeBox.php'); ?>

                    <div style="height:0;clear:both"></div>

                    <div class="modelBox active" mid="51" style="height:513px">
                        <div class="transparent" style="height:20px;overflow:hidden;border:0px solid #fff;border-bottom:0">
                            <div>
                                <input type="text" class="filter gray" style="width:98%;margin:0;padding:1%;border:0;outline: none;color:#999"  placeholder="Type Player Name..." />
                            </div>
                        </div>
                        <div class="transparent" style="height:100%; overflow-y:scroll;border:1px solid #fff;font-size: 14px">
                            <table class="plist playerList-combo muti active" cellspacing="0">
                                <tr ng-repeat="player in players">
                                    <td class="sign-btn" ng-class="{active:player.active}" value ="{{player.fbid}}" team="{{player.team}}" ng-click="selectSignPlayer(player)">
                                        {{player.player}}
                                        <div class="muti-btn" ng-class="{active:player.active}" ng-click="$event.stopPropagation();player.active=!player.active;reflash()" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-1p9 last chartblock" style="background-color:rgba(0,0,0,0.2)">

                <div class="col-1p8 last">
                    <div class="modelBox" mid="31">
                        <div id="container1" class="" style="border:0px solid #fff;margin:0 0 0 0;padding:0px"></div>
                    </div>
                </div>

                <div class="col-1p4">

                    <div style="padding:10px 5px 10px 5px">

                        <div style="text-align:left;padding:0 0 10px 0">
                            <div style="float:left;font-size: 12px"><img style="width:16px;line-height:16px;float:left" src="/images/medal_gold_1.png" />Custom Rank (Default public 9 cates)</div>

                            <div style="float:left">
                                <div class="checkbox horizontal rank-option" ng-repeat="rankOption in rankOptions">
                                    <input type="checkbox" name="cate" value="{{rankOption.value}}" ng-model="rankOption.checked" ng-change="getRank()" id="{{rankOption.value}}" />
                                    <label for="{{rankOption.value}}">{{rankOption.title}}</label>
                                </div>
                                <div style="text-align:right;float:right;width:120px;padding:10px 0 0 0">
                                    <img style="width:16px;line-height:16px;float:right" src="/images/medal_gold_1.png" />
                                    <div style="font-size: 12px;line-height:16px;float:right"><a href="/dataScatter" target="_blank" style="color:#fff;text-decoration: none">Who is Rank 1 ?</a></div>
                                </div>
                                <div style="height:0;clear:both"></div>
                            </div>
                            <div style="height:0;clear:both"></div>
                        </div>

                        <div ng-repeat="selectedPlayer in selectedPlayers" class="playercardbig highlight" style="box-shadow:0 0 20px rgba(255,255,255,0.9)">

                            <div style="width:25%;float:left">
                                <div style="background-color:rgba(0,0,0,0.8);width:60px">
                                    <div style="height:20px">
                                        <img style="width:16px;line-height:16px;float:left" src="/images/medal_gold_1.png" />
                                        <div class="rank1" style="font-size:12px;margin:0 0 0 5px;line-height:20px;float:left;text-align:center">{{selectedPlayer.rank}}</div>
                                    </div>
                                    <div style="background:url(/images/nophoto.png) no-repeat center;background-size:60px 72px">
                                        <div class="face" ng-style="{'background-image': 'url(/player/'+selectedPlayer.fbid+'.png)'}" style="width:60px;height:72px;background-size: 60px 72px"></div>
                                    </div>
                                    <div style="height:0;clear:both"></div>
                                </div>
                                <div class="basic00" style="font-size:12px;text-align:left;margin:10px 0 0 0">{{selectedPlayer.basics[0]}}</div>
                                <div class="basic01" style="font-size:12px;text-align:left;margin:6px 0 0 0">{{selectedPlayer.basics[1]}}</div>
                                <div class="basic02" style="font-size:12px;text-align:left;margin:6px 0 0 0;font-weight:bold;color:red">{{selectedPlayer.basics[2]}}</div>
                            </div>

                            <div style="width:75%;float:left">
                                <div class="basicname1" style="font-size:12px;color:gold;font-family: 'Verdana'">{{selectedPlayer.player}}</div>
                                <div class="newsbox player1" ng-bind-html="selectedPlayer.news"></div>
                                <div style="width:100%;height:35px">
                                    <a class="link-gameLog1" href="/gameLog/{{selectedPlayer.fbid}}" title='Game Logs'>
                                        <div class="newsbox-icon" style="background-image:url(/images/fig_6_gameLog2.png)"></div>
                                    </a>
                                    <a class="link-splitStats1" href="/splitStats/{{selectedPlayer.fbid}}" title='Spilit Data'>
                                        <div class="newsbox-icon" style="background-image:url(/images/fig_8_splitStat2.png)"></div>
                                    </a>
                                    <a class="link-careerStats1" href="/careerStats/{{selectedPlayer.fbid}}" title='Career Stats'>
                                        <div class="newsbox-icon" style="background-image:url(/images/fig_7_careerStat2.png)"></div>
                                    </a>
                                    <a class="link-matchPlayer1" href="/matchPlayer/{{selectedPlayer.fbid}}" title='Similar Player'>
                                        <div class="newsbox-icon" style="padding:0;background-image:url(/images/fig_5_similarPlayer2.png)"></div>
                                    </a>
                                </div>
                            </div>
                            <div style="height:0;clear:both"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="onerow" style="padding:10px 0 0 0">
            <div class="col-1p12">

                <div class="tablebackground">
                    <table class="ability-detail" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
                        <thead>

                            <tr>
                            <th colspan="3" class="report-detail-midd">STATS per game</th>
                            <th colspan="3" class="report-detail-dark">Field Goals</th>
                            <th colspan="3" class="report-detail-midd">3-Point Throws</th>
                            <th colspan="3" class="report-detail-dark">Free Throws</th>
                            <th colspan="3" class="report-detail-midd">Rebounds</th>
                            <th colspan="3" class="report-detail-dark">Assist/Turnover</th>
                            <th colspan="4" class="report-detail-midd">Miscellaneous</th>
                            <th colspan="2" class="report-detail-dark">Efficiency</th>
                            </tr>

                            <tr>
                            <th class="report-detail-midd" width="15%">PLAYER</th>
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
                            <th class="report-detail-midd" width="4%">OREB</th>
                            <th class="report-detail-midd" width="4%">DREB</th>
                            <th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">REB</th>
                            <th class="report-detail-dark" width="4%" style="color:gold;font-weight:bold">AST</th>
                            <th class="report-detail-dark" width="4%">TO</th>
                            <th class="report-detail-dark" width="4%">A/T</th>
                            <th class="report-detail-midd" width="4%">ST</th>
                            <th class="report-detail-midd" width="4%">BLK</th>
                            <th class="report-detail-midd" width="3%">PF</th>
                            <th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">PTS</th>
                            <th class="report-detail-yell" width="4%">EFF</th>
                            <th class="report-detail-yell" width="4%">EFF36</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="report-detail" ng-repeat="score in scores">
                                <td style="text-align: left">{{score.player}}</td>
                                <td style="text-align: right;padding-right:5px" ng-repeat="column in score.columns">
                                    {{column.value}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="tableupdate">
                        <? include('include_updatetime.php'); ?>
                    </div>
                    <div class="tableupdate">Players with only one game are excluded.</div>
                </div>
            </div>
        </div>

        <div class="onerow mobileview" style="height: 750px">
            <div class="col-1p12" style="background-color:rgba(0,0,0,0.2);margin-top:10px">

<!--                <img src="/images/radar1.png" style="margin:0 auto;display:block;width:70%" />
                <img src="/images/radar2.png" style="margin:0 auto;display:block;width:70%" />-->

                <div style="font-size:12px;margin:30px 0 0 200px;color:#fff">What it Means?</div>

                <div style="font-size:12px;margin:10px 0 0 210px;text-align:left;color:#fff;clear: both">
                    <table cellpadding="6" cellspacing="0">
                    <thead>
                        <tr>
                        <td width="1%">EFF</td>
                        <td width="70%">: Efficency per game</td>
                        </tr>
                        <tr>
                        <td width="">EFF</td>
                        <td width="">= PTS + REB + AST + ST + BLK - [ ( FGA - FGM ) + ( FTA - FTM ) + TO ]</td>
                        </tr>
                        <tr>
                        <td width="">EFF36</td>
                        <td width="">: Adjust EFF to 36 mins per game</td>
                        </tr>
                        <tr>
                        <td width="">EFF36</td>
                        <td width="">= EFF X (36 / MIN)</td>
                        </tr>
                    </thead>
                    </table>

                    <table cellpadding="6" cellspacing="0">
                    <thead>
                        <tr>
                        <td width="3%">GP</td>
                        <td width="15%">: Games Played</td>
                        <td width="3%">MIN</td>
                        <td width="15%">: Minutes Played</td>
                        <td width="3%">PTS</td>
                        <td width="35%">: Points Scored</td>
                        </tr>
                        <tr>
                        <td width="">FGA</td>
                        <td width="">: Field Goals Attempted</td>
                        <td width="">FGM</td>
                        <td width="">: Field Goals Made</td>
                        <td width="">FG%</td>
                        <td width="">: Field Goal Percentage (original)</td>
                        </tr>
                        <tr>
                        <td width="">FTA</td>
                        <td width="">: Free Throws Attempted</td>
                        <td width="">FTM</td>
                        <td width="">: Free Throws Made</td>
                        <td width="">FT%</td>
                        <td width="">: Free Throw Percentage (original)</td>
                        </tr>
                        <tr>
                        <td width="">3PTA</td>
                        <td width="">: 3-point Shots Attempted</td>
                        <td width="">3PTM</td>
                        <td width="">: 3-point Shots Made</td>
                        <td width="">3PT%</td>
                        <td width="">: 3-point Percentage (original)</td>
                        </tr>
                        <tr>
                        <td width="">OREB</td>
                        <td width="">: Offensive Rebounds</td>
                        <td width="">DREB</td>
                        <td width="">: Defensive Rebounds</td>
                        <td width="">REB</td>
                        <td width="">: Total Rebounds</td>
                        </tr>
                        <tr>
                        <td width="">AST</td>
                        <td width="">: Assists</td>
                        <td width="">TO</td>
                        <td width="">: Turnover</td>
                        <td width="">A/T</td>
                        <td width="">: Assist/Turnover Ratio (original)</td>
                        </tr>
                        <tr>
                        <td width="">ST</td>
                        <td width="">: Steals</td>
                        <td width="">BLK</td>
                        <td width="">: Blocked Shots</td>
                        <td width="">PF</td>
                        <td width="">: Personal Fouls</td>
                        </tr>
                    </thead>
                    </table>

                    <p style="line-height: 25px;width:800px; margin:30px 0 30px 0">
                    In addition, based on Fantasy Game considerations, we adjusted the proportional categories, such as FG%, FT%, 3PT%,A/T.
                    Way of adjustment is based on the weighted NUMBER of Shots. A player FG% is high but the shot rarely, there is no impact on your team.
                    Conversely, a player FG% is high and much more shots, there is more impact on your team. So we adjusted as follows:
                    </p>

                    <table cellpadding="6" cellspacing="0" style="padding:0 0 0 70px">
                    <thead>
                        <tr>
                        <td width="1%">FG% *</td>
                        <td width="40%">: Adjusted Field Goal Percentage by Field Goal Attempted</td>
                        </tr>
                        <tr>
                        <td width="">FT% *</td>
                        <td width="">: Adjusted  Free Throw Percentage by Free Throw Attempted</td>
                        </tr>
                        <tr>
                        <td width="">3PT% *</td>
                        <td width="">: Adjusted 3-point Percentage by 3-point Shots Attempted</td>
                        </tr>
                        <tr>
                        <td width="">A/T *</td>
                        <td width="">: Adjusted Assist/Turnover Ratio by Assist and Turnover</td>
                        </tr>
                    </thead>
                    </table>

                    <p style="line-height: 25px;width:800px; margin:30px 0 30px 0">
                    Therefore, under the adjustment, Kevin Durant (OKC-SF,PF) free throws will give the team more help.
                    Conversely, Dwight  Howard (Hou-PF,C) free throws will give the team more impact.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>


<style>
.checkbox.horizontal.rank-option {
    width: 44px;
    margin: 1px;
}
</style>

<script src="/js/hightchart.creatRadarChart.js"></script>

<script>
app.controller('abilityCtl', function($scope ,$filter, $http, $sce) {
    $scope.rankOptions = [
        {value:"zwfgm", title:"FGM", checked:false},
        {value:"zwfga", title:"FGA", checked:false},
        {value:"zwfgp", title:"FG%*", checked:true},
        {value:"zwftm", title:"FTM", checked:false},
        {value:"zwfta", title:"FTA", checked:false},
        {value:"zwftp", title:"FT%*", checked:true},
        {value:"zw3ptm", title:"3PTM", checked:true},
        {value:"zw3pta", title:"3PTA", checked:false},
        {value:"zw3ptp", title:"3PT%*", checked:false},
        {value:"zworeb", title:"OREB", checked:false},
        {value:"zwdreb", title:"DREB", checked:false},
        {value:"zwtreb", title:"TREB", checked:true},
        {value:"zwast", title:"AST", checked:true},
        {value:"zwto", title:"-TO", checked:true},
        {value:"zwatr", title:"A/T*", checked:false},
        {value:"zwst", title:"ST", checked:true},
        {value:"zwblk", title:"BLK", checked:true},
        {value:"zwpf", title:"-PF", checked:false},
        {value:"zwpts", title:"PTS", checked:true},
        {value:"zwtech", title:"-TECH", checked:false}
    ];
    $scope.ranges = [
        {key: 'ALL', name: '2016-17 Season'},
        {key: 'D30', name: 'Last 4 Weeks'},
        {key: 'D14', name: 'Last 2 Weeks'},
        {key: 'D07', name: 'Last 1 Week'},
        {key: 'Y-1', name: '2015-16 Season'},
        {key: 'Y-2', name: '2014-15 Season'}
    ];
    $scope.rangeNow = '<?=Input::get('data', 'ALL')?>';

    if (typeof(radarChart)==='undefined') {
        var radarChart = creatRadarChart();
    }

    $scope.getPlayers = function() {
        $scope.players = [];
        $http({method: 'GET', url: '/getPlayer2', data:{range: $scope.rangeNow}})
        .success(function(data, status, headers, config) {
            $scope.players = data.players;
            for (var i in $scope.players) {
                $scope.players[i].active = playerInit.indexOf($scope.players[i].fbid) > -1;
            }
            if (playerInit.length > 0)
                $scope.reflash();
        }).error(function(e){
            console.log(e);
        });
    };

    $scope.getPlayers();

    $scope.getRank = function () {
        var options = $filter('filter')($scope.rankOptions, {checked: true}).map(function(rankOption) { return rankOption.value; });
        console.log(options);

        $http({method: 'POST', url: '/data/getRank', data:{get_array: options, player: $scope.selectedPlayers, datarange: $scope.rangeNow}})
        .success(function(data, status, headers, config) {
            console.log(data);
            $scope.selectedPlayers.forEach(function(selectedPlayer, i) {
                selectedPlayer.rank = data[i];
            });
        }).error(function(e){
            console.log(e);
        });
    };

    $scope.selectSignPlayer = function(player) {
        var players = $filter('filter')($scope.players, {active: true});

        angular.forEach(players, function(player) {
            player.active = false;
        });

        player.active = true;
        $scope.reflash();
    };

    $scope.selectedPlayers = [];
    $scope.reflash = function(){
        $scope.selectedPlayers = $filter('filter')($scope.players, {active: true});
        playerInit = $.map($scope.selectedPlayers,function(value, index){
            return value.fbid;
        });

        var location = window.location;
        url = playerInit.length>0
            ? ('/'+location.pathname.split('/')[1])+'/'+playerInit.join(',')+'?data='+$scope.rangeNow
            : location.toString();
        window.history.pushState('', '', url);


        if ($scope.selectedPlayers.length>0) {
            $scope.change();
        } else {
            for (var i=0; i < radarChart.series.length; i++) {
                console.log(1);
                if (radarChart.series[0])
                    radarChart.series[0].remove(false);
            }
            radarChart.colorCounter = 0;
        }
    };

    $scope.change = function() {

        $scope.getRank();

        for (var i=0; i < radarChart.series.length; i++) {
            if (radarChart.series[0])
                radarChart.series[0].remove(false);
        }
        radarChart.colorCounter = 0;

        $http({method: 'POST', url: '/data/getAbility', data: {player: $scope.selectedPlayers, datarange: $scope.rangeNow}})
        .success(function(data, status, headers, config) {
            $scope.reFlashNews();

            $scope.scores = [];

            for( i=0;i<data.value.length;i++ ){

                radarChart.addSeries({
                    type: 'area',
                    name: $scope.selectedPlayers[i].player,
                    data: data.value[i],
                    fillOpacity: 0.3,
                    marker: {
                        enabled:false,
                        radius:0,
                        symbol: 'circle'
                    }
                },false);
                //radarChart.hideLoading();

                var score = {player: $scope.selectedPlayers[i].player, columns: []};

                for( var j=0;j<data.table[i].length;j++ ){
                    score.columns.push({value: data.table[i][j]});
                }

                $scope.scores.push(score);
            }
            radarChart.redraw();

            for (var i in data.basic) {
                radarChart.options.exporting.filename='RadarChart#'+$scope.selectedPlayers[i].fbid;
                $scope.selectedPlayers[i].basics = data.basic[i];
            }

        }).error(function(e) {
            console.log(e);
        });
    };

    $scope.reFlashNews = function() {
        $http({method: 'POST', url: '/data/getNews', data: {player: $scope.selectedPlayers}})
        .success(function(data, status, headers, config) {
            for (var i in data) {
                $scope.selectedPlayers[i].news = $sce.trustAsHtml(data[i][0]+'<br />'+data[i][1]+'<br />'+data[i][2]);
            }
        }).error(function(e) {
             console.log(e);
        });
    }

});
</script>
