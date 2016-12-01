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

    $scope.columns = [
        {name: 'wgp'},
        {name: 'pwmin'},
        {name: 'pwfgm'},
        {name: 'pwfga'},
        {name: 'wfgp'},
        {name: 'pw3ptm'},
        {name: 'pw3pta'},
        {name: 'w3ptp'},
        {name: 'pwftm'},
        {name: 'pwfta'},
        {name: 'wftp'},
        {name: 'pworeb'},
        {name: 'pwdreb'},
        {name: 'pwtreb'},
        {name: 'pwast'},
        {name: 'pwto'},
        {name: 'watr'},
        {name: 'pwst'},
        {name: 'pwblk'},
        {name: 'pwpf'},
        {name: 'pwpts'},
        {name: 'pweff'},
        {name: 'pweff36'}
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
            $scope.selectedPlayers.forEach(function(selectedPlayer, i) {
                selectedPlayer.rank = data[i];
            });
        }).error(function(e){
            console.log(e);
        });
    };

    $scope.reflash = function(selectedPlayers) {
        $scope.selectedPlayers = selectedPlayers;

        var amount = radarChart.series.length;
        for (var i=0; i < amount; i++) {
            if (radarChart.series[0]) {
                radarChart.series[0].remove(false);
            }
        }
        radarChart.colorCounter = 0;

        if ($scope.selectedPlayers.length > 0) {
            $scope.change();
            $scope.getRank();
            $scope.reFlashNews();
        }
    };

    $scope.change = function() {

        $http({method: 'POST', url: '/data/getAbility', data: {player: $scope.selectedPlayers, datarange: $scope.rangeNow}})
        .success(function(data, status, headers, config) {

            console.log(data);

            $scope.reFlashNews();

            $scope.frames = data.frames;

            for (var i in data.frames) {
                radarChart.addSeries({
                    type: 'area',
                    name: data.frames[i].player.player,
                    data: data.frames[i].ability8,
                    fillOpacity: 0.3,
                    marker: {
                        enabled: false,
                        radius: 0,
                        symbol: 'circle'
                    }
                }, false);
            }

            radarChart.redraw();

            radarChart.options.exporting.filename = 'RadarChart#' + $scope.selectedPlayers.map(function(selectedPlayer) {return selectedPlayer.fbid;}).join(',');

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