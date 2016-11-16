angular.module('ngFb', [])

.directive('players', function() {
    return {
        restrict: 'A',
        replace: true,
        transclude: false,
        scope: {
            rangeNow: '=',
            reflash: '=',
            muti: '='
        },
        template:  `
            <div class="modelBox active" mid="51" style="height:413px">
                <div class="transparent" style="height:20px;overflow:hidden;border:0px solid #fff;border-bottom:0">
                    <div>
                        <input type="text" class="filter gray" style="width:98%;margin:0;padding:1%;border:0;outline: none;color:#999"  placeholder="Type Player Name..." />
                    </div>
                </div>
                <div class="transparent" style="height:100%; overflow-y:scroll;border:1px solid #fff;font-size: 14px">
                    <table class="plist playerList-combo muti" ng-class="{active: muti}" cellspacing="0">
                        <tr ng-repeat="player in players">
                            <td class="sign-btn" ng-class="{active:player.active}" value ="{{player.fbid}}" team="{{player.team}}" ng-click="selectSignPlayer(player)">
                                {{player.player}}
                                <div class="muti-btn" ng-class="{active:player.active}" ng-click="$event.stopPropagation();player.active=!player.active;reflash()" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        `,
        controller: function($scope, $http, $filter, $routeParams, $location) {

            $scope.players = [];

            $scope.getPlayers = function() {
                $scope.players = [];
                $http({method: 'GET', url: '/getPlayer2', data:{range: $scope.rangeNow}})
                .success(function(data, status, headers, config) {
                    $scope.players = data.players;
                    for (var i in $scope.players) {
                        $scope.players[i].active = $routeParams.player == $scope.players[i].fbid;
                    }
                    if ($routeParams.player)
                        $scope.reflash($filter('filter')($scope.players, {active: true}));
                }).error(function(e){
                    console.log(e);
                });
            };

            $scope.$watch('rangeNow', function(range) {
                $scope.getPlayers();
                $location.search('range', range);
            });

            $scope.selectSignPlayer = function(player) {
                angular.forEach($scope.players, function(player) {
                    player.active = false;
                });

                player.active = true;

                var selectedPlayers = $filter('filter')($scope.players, {active: true});

                page = location.pathname.split('/')[1];
                paras = selectedPlayers.map(function(player) { return player.fbid }).join(',');

                $location.path(page + '/' + paras, false);
                
                $scope.reflash(selectedPlayers);
            };
        }
    };
});