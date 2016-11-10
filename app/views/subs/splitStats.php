<div class="insidemove" style="color:#fff" ng-controller="splitStatsCtl">
    <div class="onepcssgrid-1p-1200">

        <div class="onerow">

            <div class="col-1p3">
                <div class="playerlistblock">

                    <div style="float:left;padding:0 0 10px 0">
                        <select ng-model="rangeNow" ng-change="getPlayers()" style="color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9)">
                            <option value="{{range.key}}" ng-repeat="range in ranges">{{range.name}}</option>
                        </select>
                    </div>

                    <?php include('include_link2realtimeBox.php'); ?>

                    <div style="height:0;clear:both"></div>

                    <div class="modelBox active" mid="51" style="height:413px">
                        <div class="transparent" style="height:20px;overflow:hidden;border:0px solid #fff;border-bottom:0">
                            <div>
                                <input type="text" class="filter gray" style="width:98%;margin:0;padding:1%;border:0;outline: none;color:#999"  placeholder="Type Player Name..." />
                            </div>
                        </div>
                        <div class="transparent" style="height:100%; overflow-y:scroll;border:1px solid #fff;font-size: 14px">
                            <table class="plist playerList-combo muti" cellspacing="0">
                                <tr ng-repeat="player in players">
                                    <td class="sign-btn" ng-class="{active:player.active}" value ="{{player.fbid}}" team="{{player.team}}" ng-click="selectSignPlayer(player)">
                                        {{player.player}}
                                        <div class="muti-btn" ng-class="{active:player.active}" ng-click="$event.stopPropagation();player.active=!player.active;reflash()" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div ng-repeat="selectedPlayer in selectedPlayers">
                    <?php include('include_link2playerAbility.php'); ?>
                    </div>
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
                        <tr class="report-detail" ng-repeat="score in scores">
                            <td ng-repeat="column in score.columns">{{column.value}}</td>
                        </tr>
                    </tbody>

                    </table>
                    <div class="tableupdate">
                        <?php
                            $lastupdate = DB::table('splitdata')
                            ->select('updatetime',DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime2'))
                            ->orderBy('updatetime','DESC')
                            ->first();
                            echo '<div> Last updated: ' .$lastupdate->updatetime2. '</div>';
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

<script>
app.controller('splitStatsCtl', function($scope ,$filter, $http, $sce) {
    $scope.ranges = [
        {key: '2014',  name: '2014-15 Season'},
        {key: '2013',  name: '2013-14 Season'},
        {key: '2012',  name: '2012-13 Season'},
        {key: '2011',  name: '2011-12 Season'}
    ];
    $scope.rangeNow = '<?=Input::get('season', '2014')?>';

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

    $scope.selectSignPlayer = function(player) {
        var players = $filter('filter')($scope.players, {active: true});

        angular.forEach(players, function(player) {
            player.active = false;
        });

        player.active = true;
        $scope.reflash();
    };

    $scope.reflash = function(){
        $scope.selectedPlayers = $filter('filter')($scope.players, {active: true});
        playerInit = $scope.selectedPlayers.map(function(selectedPlayer){ return selectedPlayer.fbid; });

        var location = window.location;
        url = playerInit.length>0
            ? ('/'+location.pathname.split('/')[1])+'/'+playerInit.join(',')+'?season='+$scope.rangeNow
            : location.toString();
        window.history.pushState('', '', url);

        if ($scope.selectedPlayers.length>0) {
            $scope.change();
        }
    };

    var columnOption = {
        chart: {
            type: 'column',
            height: 270,
            width: 220,
            borderColor: 'rgba(0,0,0,0.0)',
            borderRadius: 0,
            borderWidth: 0,
            plotBorderColor: '#888',
            plotBorderWidth: 1,
            backgroundColor: 'rgba(0,0,0,0.0)'
        },
        title: {
            align: 'center'
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                pointPadding: 0,
                allowPointSelect: false
            }
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Download Graph (PNG)',
                        onclick: function () {
                            this.exportChart({
                                width: 896,
                                type: 'image/png'
                            });
                        }
                    },{
                        text: 'Download Graph (PDF)',
                        onclick: function () {
                            this.exportChart({
                                width: 896,
                                type: 'application/pdf'
                            });
                        }
                    }]
                }
            }
        },
        navigation: {
            buttonOptions: {
                enabled: true
            }
        },
        xAxis: {
            tickWidth: 0,
            tickmarkPlacement: 'on',
            gridLineWidth: 0,
            startOnTick: true,
            staggerLines: 1, //labe行數
            lineWidth: 0
        },
        yAxis: {
            tickPositions: [0,5,10,15,20,25,30,35],
            max: 35,
            min: 0,
            startOnTick: false,
            gridLineColor: '#888',
            gridLineDashStyle: 'Dot',
            gridLineWidth: 1
        },
        credits: {
            enabled: false
        }
    };

    var chartHomeAway = new Highcharts.Chart(
        $.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats1').get(0)
            },
            title: {
                text: 'Home/Away',
                enabled: false
            },
            legend: {
                enabled: false
            },
            xAxis: {
                categories: ['@Home', '@Away']
            },
            yAxis: {
                title: {
                    text: 'EFF Value'
                }
            },
            series: []
        })
    );

    var chartDayNight = new Highcharts.Chart(
        $.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats3').get(0)
            },
            title: {
                text: 'Day/Night'
            },
            legend: {
                enabled: false
            },
            xAxis: {
                categories: ['Day', 'Night']
            },
            yAxis: {
                title: {
                    text: '　'
                }
            },
            series: []
        })
    );

    var chartStarter = new Highcharts.Chart(
        $.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats5').get(0)
            },
            title: {
                text: 'Starter'
            },
            legend: {
                enabled: false
            },
            xAxis: {
                categories: ['Starter', 'Sub']
            },
            yAxis: {
                title: {
                    text: '　'
                }
            },
            series: []
        })
    );

    var chartRestDays = new Highcharts.Chart(
        $.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats2').get(0)
            },
            title: {
                text: 'Rest Days'
            },
            legend: {
                enabled: false
            },
            xAxis: {
                categories: ['0', '1', '2', '3+']
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            series: []
        })
    );

    var chartOppo = new Highcharts.Chart(
        $.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats4').get(0),
                height: 330,
                width: 895
            },
            title: {
                text: 'vs 29 Teams'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 0
            },
            xAxis: {
                labels: {
                    rotation: 0,
                    style:{}
                },
                categories: []
            },
            yAxis: {
                tickPositions: [0,5,10,15,20,25,30,35,40,45,50],
                max: 50,
                min: 0,
                title: {
                    text: 'EFF Value'
                }
            },
            series: []
        })
    );

    $scope.change = function() {
        $http({method: 'POST', url: '/data/getSplitStats', data: {player: $scope.selectedPlayers, datarange: $scope.rangeNow}})
        .success(function(data, status, headers, config) {

            console.log(data);

            $scope.scores = [];

            for( var i in data['table'] ){
                var tablerow = data['table'][i];

                var score = {columns: []};

                for (var j in tablerow) {
                    score.columns.push({value: tablerow[j]});
                }
                $scope.scores.push(score);
            }

            var series_size = chartHomeAway.series.length;
            if( series_size>0 )
                for( i=0;i<series_size;i++ ){
                    if( chartHomeAway.series[0] )
                        chartHomeAway.series[0].remove(false);
                }
            chartHomeAway.colorCounter = 0;
            chartHomeAway.addSeries({
                name: '',
                data: data.spstat.HomeAway
            },true);

            var series_size = chartDayNight.series.length;
            if( series_size>0 )
                for( i=0;i<series_size;i++ ){
                    if( chartDayNight.series[0] )
                        chartDayNight.series[0].remove(false);
                }
            chartDayNight.colorCounter = 0;
            chartDayNight.addSeries({
                name: '',
                data: data.spstat.dayNight
            },true);

            var series_size = chartStarter.series.length;
            if( series_size>0 )
                for( i=0;i<series_size;i++ ){
                    if( chartStarter.series[0] )
                        chartStarter.series[0].remove(false);
                }
            chartStarter.colorCounter = 0;
            chartStarter.addSeries({
                name: '',
                data: data.spstat.Starter
            },true);

            var series_size = chartRestDays.series.length;
            if( series_size>0 )
                for( i=0;i<series_size;i++ ){
                    if( chartRestDays.series[0] )
                        chartRestDays.series[0].remove(false);
                }
            chartRestDays.colorCounter = 0;
            chartRestDays.addSeries({
                name: '',
                data: data.spstat.Rest
            },true);

            var series_size = chartOppo.series.length;
            if( series_size>0 )
                for( i=0;i<series_size;i++ ){
                    if( chartOppo.series[0] )
                        chartOppo.series[0].remove(false);
                }
            chartOppo.colorCounter = 0;
            chartOppo.addSeries({
                name: $scope.selectedPlayers[0]['name'],
                data: data.spstat.VS
            },true);

            chartOppo.xAxis[0].setCategories(data.spstat.VSTeam);

            chartHomeAway.options.exporting.filename='SplitStat#'+$scope.selectedPlayers[0].fbid;
            chartDayNight.options.exporting.filename='SplitStat#'+$scope.selectedPlayers[0].fbid;
            chartRestDays.options.exporting.filename='SplitStat#'+$scope.selectedPlayers[0].fbid;
            chartStarter.options.exporting.filename='SplitStat#'+$scope.selectedPlayers[0].fbid;
            chartOppo.options.exporting.filename='SplitStat#'+$scope.selectedPlayers[0].fbid;

        }).error(function(e) {
            console.log(e);
        });
    }
});
</script>
