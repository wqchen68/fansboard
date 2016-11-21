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
        .when('/playerAbility', {
            templateUrl: '/view/playerAbility',
            controller: 'abilityCtrl',
            reloadOnSearch: false
        })
        .when('/gameLog', {
            templateUrl: '/view/gameLog',
            controller: 'gameLogCtrl',
            reloadOnSearch: false
        })
        .when('/splitStats', {
            templateUrl: '/view/splitStats',
            controller: 'splitStatsCtrl',
            reloadOnSearch: false
        })
        .when('/careerStats', {
            templateUrl: '/view/careerStats',
            controller: 'careerStatsCtrl',
            reloadOnSearch: false
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
        .when('/matchPlayer', {
            templateUrl: '/view/matchPlayer',
            controller: 'matchPlayerCtrl',
            reloadOnSearch: false
        })
        .when('/playerSalary', {
            templateUrl: '/view/playerSalary'
        })
        .when('/', {
            template: '<div></div>',
            controller: function($location) {
                window.location = '/';
            }
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
            title: 'Player Ability'
        }, {
            page: 'gameLog',
            title: 'Game Logs'
        }, {
            page: 'splitStats',
            title: 'Split Stats'
        }, {
            page: 'careerStats',
            title: 'Career Stats'
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
            title: 'Similar Player'
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

        $location.search('range', null);
        $location.path('/' + item.page, true);
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