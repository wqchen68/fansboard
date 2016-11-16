angular.module('app').controller('abilityCtrl', function($scope, $filter, $http, $sce, $routeParams) {

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
    
    $scope.rangeNow = $routeParams.range ? $routeParams.range : 'ALL';

    if (typeof(radarChart)==='undefined') {
        var radarChart = creatRadarChart();
    }

    $scope.getRank = function () {
        var options = $filter('filter')($scope.rankOptions, {checked: true}).map(function(rankOption) { return rankOption.value; });

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