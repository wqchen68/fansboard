angular.module('app').controller('splitStatsCtrl', function($scope ,$filter, $http, $sce, $routeParams) {

    $scope.ranges = [
        {key: '2014',  name: '2014-15 Season'},
        {key: '2013',  name: '2013-14 Season'},
        {key: '2012',  name: '2012-13 Season'},
        {key: '2011',  name: '2011-12 Season'}
    ];

    $scope.rangeNow = $routeParams.range ? $routeParams.range : '2014';

    $scope.reflash = function(selectedPlayers){
        $scope.selectedPlayers = selectedPlayers;

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