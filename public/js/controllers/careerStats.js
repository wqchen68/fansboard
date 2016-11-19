angular.module('app').controller('careerStatsCtrl', function($scope, $filter, $http, $sce, $routeParams) {

    $scope.items = 'ceff';//'<?=Input::get('cate', 'ceff')?>';

    $scope.reflash = function(selectedPlayers) {
        $scope.selectedPlayers = selectedPlayers;

        if ($scope.selectedPlayers.length>0) {
            $scope.change();
        }
    };

	var chartCareerStats = new Highcharts.Chart({
        chart: {
            renderTo: $('.chart_box').get(0),
            alignTicks: false,
            width: 896,
            height: 600,
            zoomType: 'xy',
            borderColor: 'rgba(0,0,0,0.0)',
            borderRadius: 0,
            borderWidth: 0,
            type: 'column',
            plotBorderColor: '#888',
            plotBorderWidth: 1,
            backgroundColor: 'rgba(0,0,0,0.6)',
            marginTop: 50
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Season Performance',
            y: 20,
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            x: -60,
            y: 40
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                pointWidth: 30,
                borderColor: '#888',
                borderWidth: 2
            },
            series: {
                lineWidth: 3,
                allowPointSelect: false,
                marker: {
                    symbol: 'circle',
                    radius: 10,
                    lineWidth: 3,
                    lineColor: null
                },
                states: {
                    hover: {
                        enabled: true,
                        lineWidth: 5,
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
            shared: false,
            positioner: function () {
                return { x: 70, y: 60 };
            }
            //enabled: false
        },
        xAxis: {
            labels: {
                rotation: 0,
                style: {},
                staggerLines: 1
            },
            tickmarkPlacement: 'on',
        },
        yAxis: [{
            id: 0,
            title: {
                text: 'Value',
                style: {},
                align: 'high',
                y: 120
            },
            tickPositions: [0,5,10,15,20,25,30,35],
            startOnTick: false,
            min: -13.3
        },{
            id: 1,
            title: {
                text: 'Games',
                style: {},
                align: 'low',
                y: -100
            },
            tickPositions: [0,20,40,60,82],
            endOnTick: false,
            max: 300,
            plotLines: [{
                color: '#fff',
                width: 2,
                value: 82
            }],
            opposite: true
        }],
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
        }
	});

	var color = ['rgba(0,187,255,1)','rgba(255,0,136,1)','rgba(0,255,0,1)','rgba(255,255,255,1)'];
	var color36 = ['rgba(0,187,255,0.4)','rgba(255,0,136,0.4)','rgba(0,255,0,0.4)','rgba(255,255,255,0.4)'];

    $scope.isShow36 = $scope.items != 'ceff';

    $scope.switchShow36 = function() {
        $scope.isShow36 = $scope.items != 'ceff';
		if ($scope.selectedPlayers.length > 0)
			$scope.reflash();
    };

    $scope.show36 = function() {
		for (var key in chartCareerStats.series) {
			if (chartCareerStats.series[key].name.search('(36)') != -1) {
				if ($scope.isShow36) {
                    alert();
					chartCareerStats.series[key].show();
				}else{
					chartCareerStats.series[key].hide();
				}
			}
		}
    };

    $scope.change = function() {
        $http({method: 'POST', url: '/data/getCareerStats', data: {player: $scope.selectedPlayers, items: $scope.items}})
        .success(function(data, status, headers, config) {
            console.log(data)

            angular.extend($scope.selectedPlayers[0], data.card[0]);
            $scope.scores = [];

			for( var i in data['table'] ){
				var tablerow = data['table'][i];

                var score = {columns: []};

				for( var j in tablerow ){
                    score.columns.push({value: tablerow[j]});
				}
                $scope.scores.push(score);
			}


			var series_size = chartCareerStats.series.length;

			if( series_size>0 )
			for( i=0;i<series_size;i++ ){
				if( chartCareerStats.series[0] )
				chartCareerStats.series[0].remove(false);
			}

			chartCareerStats.xAxis[0].setCategories(data['label']);
			chartCareerStats.redraw();

			var k = 0;
			for(var key in data['career']){
				chartCareerStats.addSeries({
					name: key,
					color: color[k%4],
					type: 'line',
					yAxis: 0,
					marker: {
                        fillColor: 'rgba(255,255,255,0.5)'
					},
					data: data['career'][key]
				},false);
				k++;
			}

			var k = 0;
			for(var key in data['ctime']){
				chartCareerStats.addSeries({
					name: key,
					showInLegend: false,
					color: color[k%4],
					type: 'column',
					yAxis: 1,
					marker: {
                        fillColor: 'rgba(255,255,255,0.5)'
					},
					data: data['ctime'][key],
					index: 1000-k
				},false);
				k++;
			}

			var k = 0;
			for (var key in data['career36']) {
				chartCareerStats.addSeries({
					name: key+'(36)',
					showInLegend: false,
					color: color36[k%4],
					type: 'line',
					yAxis: 0,
					marker: {
                        fillColor: 'rgba(255,255,255,0.1)'
					},
					visible: $scope.isShow36,
					data: data['career36'][key]
				},false);
				k++;
			}

			if ($scope.items == 'ceff') {
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,5,10,15,20,25,30,35],
                    min: -13.3,
                    title:{
                        text: 'Efficiency'
                    }
				});
            } else if ($scope.items == 'cmin') {
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,12,24,36,48],
                    min: -18,
                    title:{
                        text: 'Minutes'
                    }
				});
            }else if( $scope.items==='cpts' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,10,20,30,36],
                    min: -13.5,
                    title:{
                        text: 'Points'
                    }
				});
            }else if( $scope.items==='cfgp' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0.3,0.4,0.5,0.6],
                    min: 0.186,
                    title:{
                        text: 'Field Goal (%)'
                    }
				});
            }else if( $scope.items==='cftp' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0.5,0.6,0.7,0.8,0.9,1],
                    min: 0.313,
                    title:{
                        text: 'Feww Throw (%)'
                    }
				});
            }else if( $scope.items==='c3ptp' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,0.05,0.1,0.15,0.2,0.25,0.3,0.35,0.4,0.45,0.5],
                    min: -0.187,
                    title:{
                        text: '3-Point Shot (%)'
                    }
				});
            }else if( $scope.items==='cfgm' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,3,5,7,9,11,13],
                    min: -4.95,
                    title:{
                        text: 'Field Goals Made'
                    }
				});
            }else if( $scope.items==='cftm' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,2,4,6,8,10],
                    min: -3.8,
                    title:{
                        text: 'Free Throws Made'
                    }
				});
            }else if( $scope.items==='c3ptm' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,0.5,1,1.5,2,2.5,3,3.5],
                    min: -1.33,
                    title:{
                        text: '3-point Shots Made'
                    }
				});
            }else if( $scope.items==='cfga' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,7,14,21,28],
                    min: -10.5,
                    title:{
                        text: 'Field Goals Attempted'
                    }
				});
            }else if( $scope.items==='cfta' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12],
                    min: -4.6,
                    title:{
                        text: 'Free Throws Attempted '
                    }
				});
            }else if( $scope.items==='c3pta' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9],
                    min: -3.4,
                    title:{
                        text: '3-point Shots Attempted'
                    }
				});
            }else if( $scope.items==='coreb' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3,4,5,6],
                    min: -2.25,
                    title:{
                        text: 'Offensive Rebounds'
                    }
				});
            }else if( $scope.items==='cdreb' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12],
                    min: -4.6,
                    title:{
                        text: 'Defense Rebounds'
                    }
				});
            }else if( $scope.items==='ctreb' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12,15],
                    min: -5.7,
                    title:{
                        text: 'Rebounds'
                    }
				});
            }else if( $scope.items==='cast' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12],
                    min: -4.57,
                    title:{
                        text: 'Assists'
                    }
				});
            }else if( $scope.items==='cst' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3],
                    min: -1.14,
                    title:{
                        text: 'Steals'
                    }
				});
            }else if( $scope.items==='cblk' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3,4],
                    min: -1.5,
                    title:{
                        text: 'Blocks'
                    }
				});
            }else if( $scope.items==='catr' || $scope.items==='cpf'  || $scope.items==='cto' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3,4,5],
                    min: -1.87,
                    title:{
                        text: 'Value'
                    }
				});
			}else{
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,data['valueMax']/4,data['valueMax']/2,3*data['valueMax']/4,data['valueMax']],
                    min: -0.38*data['valueMax'], //0.38是比例
                    title:{
                        text: 'Value'
                    }
				});
			}

            chartCareerStats.xAxis[0].update({
                labels:{
                    step: (data.label.length>12 ? 2 : 1)
                }
            });

			chartCareerStats.redraw();

			chartCareerStats.options.exporting.filename='CareerStats#'+$scope.selectedPlayers[0].fbid;

		}).error(function(e) {
            console.log(e);
		});
    }
});