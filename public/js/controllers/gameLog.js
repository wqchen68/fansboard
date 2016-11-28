angular.module('app').controller('gameLogCtrl', function($scope ,$filter, $http, $sce, $routeParams) {

    $scope.ranges = [
        {key:'2016' , name: '2016-17 Season'},
        {key:'2015' , name: '2015-16 Season'},
        {key:'2014' , name: '2014-15 Season'},
        {key:'2013' , name: '2013-14 Season'},
        {key:'2012' , name: '2012-13 Season'},
        {key:'2011' , name: '2011-12 Season'}
    ];

    $scope.rangeNow = $routeParams.range ? $routeParams.range : '2016';

    $scope.reflash = function(selectedPlayers) {
        $scope.selectedPlayers = selectedPlayers;

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
                color: '#c0504d',
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
            chart.options.exporting.filename='Gamelog#' + $scope.selectedPlayers[0].fbid;

            chart.redraw();

        }).error(function(e) {
            console.log(e);
        });
    };
});