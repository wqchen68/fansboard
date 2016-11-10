<div class="insidemove" style="color:#fff" ng-controller="gamelogCtl">

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

                    <?php include('include_link2playerAbility.php'); ?>

                </div>
            </div>

            <div class="col-1p9 last">
                <div id="chart_gamelog" class="chartblock highlight"></div>
            </div>

        </div>


        <div class="onerow" style="padding:10px 0 0 0">
            <div class="col-1p12">

                <div class="tablebackground">
                    <table id="tableGamelog" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
                    <thead>

                        <tr>
                        <th colspan="5" class="report-detail-midd">Game Logs</th>
                        <th colspan="3" class="report-detail-dark">Field Goals</th>
                        <th colspan="3" class="report-detail-midd">3-Point Throws</th>
                        <th colspan="3" class="report-detail-dark">Free Throws</th>
                        <th colspan="3" class="report-detail-midd">Rebounds</th>
                        <th colspan="2" class="report-detail-dark">Assist/TO</th>
                        <th colspan="4" class="report-detail-midd">Miscellaneous</th>
                        <th colspan="2" class="report-detail-dark">Efficiency</th>
                        </tr>

                        <tr>
                        <th class="report-detail-midd" width="8%">Date</th>
                        <th class="report-detail-midd" width="5%">Oppo.</th>
                        <th class="report-detail-midd" width="7%">Score</th>
                        <th class="report-detail-midd" width="2%">Start</th>
                        <th class="report-detail-midd" width="4%">MIN</th>
                        <th class="report-detail-dark" width="2%">FGM</th>
                        <th class="report-detail-dark" width="2%">FGA</th>
                        <th class="report-detail-dark" width="3%">FG%</th>
                        <th class="report-detail-midd" width="2%">3PTM</th>
                        <th class="report-detail-midd" width="2%">3PTA</th>
                        <th class="report-detail-midd" width="3%">3PT%</th>
                        <th class="report-detail-dark" width="2%">FTM</th>
                        <th class="report-detail-dark" width="2%">FTA</th>
                        <th class="report-detail-dark" width="3%">FT%</th>
                        <th class="report-detail-midd" width="2%">OREB</th>
                        <th class="report-detail-midd" width="2%">DREB</th>
                        <th class="report-detail-midd" width="2%" style="color:gold;font-weight:bold">REB</th>
                        <th class="report-detail-dark" width="2%" style="color:gold;font-weight:bold">AST</th>
                        <th class="report-detail-dark" width="2%">TO</th>
                        <th class="report-detail-midd" width="2%">ST</th>
                        <th class="report-detail-midd" width="2%">BLK</th>
                        <th class="report-detail-midd" width="2%">PF</th>
                        <th class="report-detail-midd" width="3%" style="color:gold;font-weight:bold">PTS</th>
                        <th class="report-detail-yell" width="4%">EFF</th>
                        <th class="report-detail-yell" width="4%">EFF36</th>
                        </tr>

                    </thead>

                    <tbody>
                        <tr class="report-detail" ng-repeat="score in scores">
                            <td ng-style="{'text-align':column.align}" ng-repeat="column in score.columns">{{column.value}}</td>
                        </tr>
                    </tbody>

                    </table>
                    <div class="tableupdate">
                        <?php include('include_updatetime.php'); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="onerow" style="padding:10px 0 10px 0">
            <div style="background-color:rgba(0,0,0,0.2);padding:10px 0 10px 0">
                <div class="col-1p3 note" style="float:left;padding:0 0 20px 0">

                    <div style="padding:0px 0 0px 10px">Legend</div>

                    <div style="text-align:left;margin:10px 0 0 0">
                        <table cellpadding="6" cellspacing="0" style="font-size:12px;clear: both;color:#fff">
                        <thead>
                            <tr>
                            <td width="5%">Game EFF</td>
                            <td width="20%">: Efficency per game</td>
                            </tr>

                            <tr>
                            <td width="5%">Short-Term</td>
                            <td width="20%">: Last 3 Games EFF Average</td>
                            </tr>

                            <tr>
                            <td width="5%">Mid-Term</td>
                            <td width="20%">: Last 6 Games EFF Average</td>
                            </tr>

                            <tr>
                            <td width="5%">Long-Term</td>
                            <td width="20%">: Last 9 Games EFF Average</td>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>

                <div class="col-1p9 note last" style="float:left">
                    <div >Example</div>
                    <div class="exfig" style="background-image:url(<?=asset('images/gamelogex1.png')?>)">
                        <div style="padding: 210px 0 0 65px;color:#000;font-size:14px">
                        <p style="line-height: 25px">Kevin Durant (OKC - SF,PF)</br>
                        High and Stable Efficiency</p>
                        </div>
                    </div>
                    <div class="exfig" style="background-image:url(<?=asset('images/gamelogex2.png')?>)">
                        <div style="padding: 210px 0 0 65px;color:#000;font-size:14px">
                        <p style="line-height: 25px">Kyrie Irving (Cle – PG,SG)</br>
                        Buy Low Sell High Trade</p>
                        </div>
                    </div>
                    <div class="exfig" style="background-image:url(<?=asset('images/gamelogex3.png')?>)">
                        <div style="padding: 210px 0 0 65px;color:#000;font-size:14px">
                        <p style="line-height: 25px">Dwyane Wade (Mia – PG,SG)</br>
                        Low Frequency of Games</p>
                        </div>
                    </div>
                    <div style="height:0;clear:both"></div>
                </div>

                <div style="height:0;clear:both"></div>
            </div>
        </div>



    </div>
</div>

<style>

div.exfig{
    background-repeat: no-repeat;
    width:288px;
    height:288px;
    background-size:288px 288px;
    float:left;
    margin:10px 5px 5px 5px;
}

/*.table-gamelog{
    text-align:right;
    font-weight: normal;
}*/


</style>

<script>
app.controller('gamelogCtl', function($scope ,$filter, $http, $sce) {
    $scope.ranges = [
        {key:'2016' , name: '2016-17 Season'},
        {key:'2015' , name: '2015-16 Season'},
        {key:'2014' , name: '2014-15 Season'},
        {key:'2013' , name: '2013-14 Season'},
        {key:'2012' , name: '2012-13 Season'},
        {key:'2011' , name: '2011-12 Season'}
    ];
    $scope.rangeNow = '<?=Input::get('season', '2016')?>';

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

    var chart = new Highcharts.Chart({

        chart: {
            renderTo: $('#chart_gamelog').get(0),
            alignTicks: false,
            width: 896,
            height: 600,
            zoomType: 'xy',
            borderColor: 'rgba(0,0,0,0.0)',
            borderRadius: 0,
            borderWidth: 0,
            type: 'line',
            plotBorderColor: '#888',
            plotBorderWidth: 0,
            backgroundColor: 'rgba(0,0,0,0.6)',
            marginTop: 50
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Game Performance',
            y: 20
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
            },
        },
        navigation: {
            buttonOptions: {
                enabled: true,
                align: 'center',
                x:100,
                y:3
//                height: 20,
//                width: 24,
//                symbolSize: 14,
//                symbolX: 12.5,
//                symbolY: 10.5,
//                symbolStroke: '#666',
//                symbolStrokeWidth: 1,
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            borderWidth: 1,
            borderColor: '#FFF',
            backgroundColor: 'rgba(255,255,255,0.1)',
            x: 0,
            y: 0
        },
        labels: {
            items: [{
                html: 'Hot',
                style: {
                    left: '65px',
                    top: '5px',
                    color: 'rgba(255,0,0,1)',
                    fontWeight: 'bold',
                    fontSize: 12}
                },{
                html: 'Cold',
                style: {
                    left: '65px',
                    top: '335px',
                    color: 'rgba(0,187,255,1)',
                    fontWeight: 'bold',
                    fontSize: 12}
            }]
        },
        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                lineWidth: 1.5,
                marker: {
                    radius: 2
                },
                borderWidth: 0,
                pointPadding: 0,
                allowPointSelect: true,
                states: {
                    hover: {
                        enabled: true,
                        lineWidth: 1.5,
                        marker:{
                            enabled: true,
                            radius: 5
                        }
                    }
                }
            }
        },
        tooltip: {
            snap: 5,
            animation: false,
            backgroundColor: '#000',
            borderColor: '#fff',
            borderWidth: 1,
            borderRadius: 7,
            shadow: false,
            hideDelay: 0,
            shared: true,
            positioner: function () {
                return { x: 68, y: 8 };
            },
            formatter: function() {
                return this.x + ',   EFF:' + this.y+' '+oppo[this.x];
            }
        },
        xAxis: [{
            labels: {
                rotation: 30,
                //x: -5,
                //y: 18,
                step: 1,
                style: {
                    fontSize: 5
                }
            },
            startOnTick: true,
            tickInterval: 5,
            tickWidth: 0.3,
            tickmarkPlacement: 'on',            
            max: 81,
            min: 0
        }],
        yAxis: [{ // performance line
            id: 0,
            title: {
                text: 'EFF Value',
                style: {},
                y: -100					
            },
            labels: {
            },
            tickPositions: [0,10,20,30,40],
            min: -13.333333333333,
            startOnTick: false,
            endOnTick: true,
            plotBands: [{
                from: 20,
                to: 40,
                color: 'rgba(255, 0, 0, 0.1)'
            },{
                from: 0,
                to: 20,
                color: 'rgba(0, 128, 128, 0.1)'
            }],
        },{ // time bar
            id: 1,
            title: {
                text: 'Time',
                style: {},
                y: 180
            },
            labels: {
            },
            tickPositions: [0,12,24,36,48],
            max: 192,
            startOnTick: true,
            endOnTick: false,
            plotLines: [{
                color: '#fff',
                width: 1,
                value: 48
            }],
            opposite: true
        }]
    });

    $scope.change = function() {
        $http({method: 'POST', url: '/data/getLog', data: {player: $scope.selectedPlayers, datarange: $scope.rangeNow}})
        .success(function(data, status, headers, config) {

            console.log(data);

            $scope.scores = [];

            for( var i in data[0]['table'] ){
                var tablerow = data[0]['table'][i];	

                var score = {columns: []};

                for (var j in tablerow) {
                    score.columns.push({value: tablerow[j], align: j=='score' || j=='goppo' ? 'left' : 'right'});
                }
                $scope.scores.push(score);
            }

            var series_size = chart.series.length;

            if( series_size>0 )
            for( i=0;i<series_size;i++ ){
                if( chart.series[0] )
                chart.series[0].remove(false);
            }
			
            chart.addSeries({
                type: 'spline',
                name: 'Game EFF',
                data: data[0].current,
                color: 'rgba(200,200,200,0.4)',
                yAxis: 0,
                dashStyle: 'Dash',
                marker: {
                    symbol: 'circle'
                }
            },false);


            chart.addSeries({ 	
                type: 'spline',
                name: 'Sohrt-Term',
                data: data[0].ma3,
                color: '#00CCFF',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);

            chart.addSeries({ 	
                type: 'spline',
                name: 'Mid-Term',
                data: data[0].ma6,
                color: 'rgba(0,255,0,1)',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);

            chart.addSeries({ 	
                type: 'spline',
                name: 'Long-Term',
                data: data[0].ma9,
                color: '#ff0066',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);

            chart.addSeries({ 	
                name: 'Start',
                color: '#4572A7',
                type: 'column',
                data: data[0].min1,
                yAxis: 1,
                states: {
                    hover: {
                        brightness: 0.5
                    }
                }
            },false);

            chart.addSeries({ 	
                name: 'Bench',
                showInLegend: false,
                color: '#c0504d',//'#008866'
                type: 'column',
                data: data[0].min2,
                yAxis: 1,
                states: {
                    hover: {
                        brightness: 0.5
                    }
                }
            },false);
            
            chart.xAxis[0].setCategories(data[0].date);
            oppo = data[0].oppo;
            chart.options.exporting.filename='Gamelog#'+$scope.selectedPlayers[0].fbid;

            chart.redraw();
			
        }).error(function(e) {
            console.log(e);
        });
    };
});
</script>

