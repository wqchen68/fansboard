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
}])

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
        .otherwise({
            templateUrl: 'welcome.html'
        });
    $locationProvider.html5Mode({enabled: true, requireBase: false});
}]);