angular.module('app').controller('matchPlayerCtrl', function($scope, $filter, $http, $sce, $routeParams) {

    $scope.ranges = [
        {key: 'ALL', name: '2016-17 Season'},
        {key: 'D30', name: 'Last 4 Weeks'},
        {key: 'D14', name: 'Last 2 Weeks'},
        {key: 'D07', name: 'Last 1 Week'},
        {key: 'Y-1', name: '2015-16 Season'},
        {key: 'Y-2', name: '2014-15 Season'}
    ];

    $scope.rangeNow = $routeParams.range ? $routeParams.range : 'ALL';

    if (typeof(radarChart)==='undefined') {
        var radarChart = creatRadarChart();
    }

    $scope.reflash = function(selectedPlayers) {
        $scope.selectedPlayers = selectedPlayers;

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

    $scope.matchMethod = 'method1';

    $scope.change = function() {

		var input = {
			player: $scope.selectedPlayers,
			datarange: $scope.rangeNow,
			matchMethod: $scope.matchMethod
		};

        $http({method: 'POST', url: '/data/getMatch', data: input})
        .success(function(data, status, headers, config) {

            console.log(data);

            $scope.similarPlayers = data.card;

			ability = data.ability;

			var ability_draw = {
				name: [ability.name[0],ability.name[1]],
				value: [ability.value[0],ability.value[1]]
			};

			$scope.drawRadar(ability_draw);

            $scope.scores = [];

			for( i=0;i<data.ability.table.length;i++ ){
                var score = {player: data.ability.name[i], abilities: []};
				for( var j=0;j<data.ability.table[i].length;j++ ){
                    score.abilities.push({value: data.ability.table[i][j]});
				}
                $scope.scores.push(score);
			}

			// pageobj.find('.majorboxN .playercardsmall').removeClass('active');
			// $('.majorboxN').eq(0).find('.playercardsmall').addClass('active');

		}).error(function(e) {
            console.log(e);
		});

	};

	$scope.drawRadar = function(ability) {
		var series_size = radarChart.series.length;
		if( series_size>0 )
		for( i=0;i<series_size;i++ ){
			if( radarChart.series[0] )
			radarChart.series[0].remove(false);
		}
		radarChart.colorCounter = 0;
		for( var i in ability.value ){
			radarChart.addSeries({
				type: 'area',
				name: ability.name[i],
				data: ability.value[i],
				fillOpacity: 0.4,
				marker: {
					enabled:false,
					radius:0,
					symbol: 'circle'
				}
			},false);
		}
		radarChart.redraw();

	};

});