var app = angular.module('app', ['ngRoute', 'ngFb']);

app.run(['$route', '$rootScope', '$location', function ($route, $rootScope, $location) {
    var original = $location.path;
    $location.path = function (path, reload) {
        if (reload === false) {
            var lastRoute = $route.current;
            var un = $rootScope.$on('$locationChangeSuccess', function () {
                $route.current = lastRoute;
                un();
            });
        }
        return original.apply($location, [path]);
    };
}]);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
    $routeProvider
        .when('/playerAbility/:player?', {
            templateUrl: '/view/playerAbility',
            controller: 'abilityCtrl',
            reloadOnSearch: false
        })
        .when('/gameLog/:player?', {
            templateUrl: '/view/gameLog',
            controller: 'gameLogCtrl'
        })
        .when('/splitStats/:player?', {
            templateUrl: '/view/splitStats',
            controller: 'splitStatsCtrl'
        })
        .when('/careerStats/:player?', {
            templateUrl: '/view/careerStats',
            controller: 'careerStatsCtrl'
        })
        .when('/dataScatter', {
            templateUrl: '/view/dataScatter',
            controller: 'dataScatterCtrl'
        })
        .when('/playerRankings', {
            templateUrl: '/view/playerRankings',
            controller: 'playerRankingsCtrl'
        })
        .when('/realtimeBox', {
            templateUrl: '/view/realtimeBox',
            controller: 'realtimeBoxCtrl'
        })
        .when('/hotcoldPlayer', {
            templateUrl: '/view/hotcoldPlayer'
        })
        .when('/matchPlayer/:player?', {
            templateUrl: '/view/matchPlayer',
            controller: 'matchPlayerCtrl'
        })
        .when('/playerSalary', {
            templateUrl: '/view/playerSalary'
        })
        .otherwise({
            templateUrl: 'welcome.html'
        });
    $locationProvider.html5Mode({enabled: true, requireBase: false});
}]);

app.controller('menuController', function($scope, $filter, $location, $routeParams) {

    $scope.menus = [{
        title: 'Player Board',
        items: [{
            page: 'playerAbility',
            title: 'Player Ability',
            paraments: ['players', 'range']
        }, {
            page: 'gameLog',
            title: 'Game Logs',
            paraments: ['players', 'range']
        }, {
            page: 'splitStats',
            title: 'Split Stats',
            paraments: ['players', 'range']
        }, {
            page: 'careerStats',
            title: 'Career Stats',
            paraments: ['players']
        }]
    }, {
        title: 'Data Board',
        items: [{
            page: 'dataScatter',
            title: 'Data Scatter'
        }, {
            page: 'playerRankings',
            title: 'Player Rankings'
        }]
    }, {
        title: 'Smart Board',
        items: [{
            page: 'realtimeBox',
            title: 'Real-Time Box'
        }, {
            page: 'hotcoldPlayer',
            title: 'Hot & Cold Player'
        }, {
            page: 'matchPlayer',
            title: 'Similar Player',
            paraments: ['players', 'range']
        }, {
            page: 'playerSalary',
            title: 'Player Salary'
        }, {
            page: 'playerStatus',
            title: 'Player Status - BETA'
        }, {
            page: 'tradeCompare',
            title: 'Trade Compare',
            lock: true
        }]
    }, {
        title: 'Team Board',
        items: []
    }, {
        title: 'Draft Board',
        items: []
    }];

    $scope.activeItem = function(item, menu) {
        $scope.menus.forEach(function(menu) {
            menu.active = false;
        });
        menu.active = true;
        menu.items.forEach(function(item) {
            item.active = false;
        });
        item.active = true;

        var paraments = '';
        if (item.paraments)
        item.paraments.forEach(function(parament) {
            switch (parament) {
                case 'players':
                    players = $routeParams.player ? '/' + $routeParams.player : '';
                    paraments += players;
                    break;

                case 'range':
                    $location.search('range', null);
                default:
                    break;
            }
        });
        $location.path('/' + item.page + paraments);
    };

    $scope.menus.forEach(function(menu) {
        menu.items.forEach(function(item) {
            if (item.page == location.pathname.split('/')[1]) {
                item.active = true;
                menu.active = true;
            }
        });
    });

});