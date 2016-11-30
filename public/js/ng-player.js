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
            <div class="modelBox active" mid="51" style="height:420px;padding:0 0 10px 0;margin:0 0 24px 0">
                <div class="transparent" style="height:20px;overflow:hidden;border:0px solid #fff;border-bottom:0">
                    <div>
                        <input type="text" ng-model="searchPlayer.player" class="filter gray" style="width:98%;margin:0;padding:1%;border:0;outline: none;color:#999"  placeholder="Type Player Name..." />
                    </div>
                </div>
                <div class="transparent" style="height:100%; overflow-y:scroll;border:1px solid #fff;font-size: 14px">
                    <table class="plist playerList-combo muti" ng-class="{active: muti}" cellspacing="0">
                        <tr ng-repeat="player in players | filter:searchPlayer">
                            <td class="sign-btn" ng-class="{active:isSelected(player)}" value ="{{player.fbid}}" team="{{player.team}}" ng-click="selectSignPlayer(player)">
                                {{player.player}}
                                <div class="muti-btn" ng-class="{active:isSelected(player)}" ng-click="$event.stopPropagation();selectMutiPlayer(player)" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        `,
        controller: function($scope, $http, $filter, $routeParams, $location) {

            $scope.players = [];
            $scope.searchPlayer = {};

            var players = $scope.muti ? $routeParams.players.split(',') : [$routeParams.players.split(',')[0]];

            $scope.getPlayers = function() {
                $scope.players = [];
                $http({method: 'GET', url: '/getPlayer2', data:{range: $scope.rangeNow}})
                .success(function(data, status, headers, config) {
                    $scope.players = data.players;

                    $scope.selectedPlayers = $filter('filter')($scope.players, function(player) {
                        return players.indexOf(player.fbid) > -1;
                    });

                    if ($scope.selectedPlayers.length > 0)
                        $scope.setPlayers();
                }).error(function(e){
                    console.log(e);
                });
            };

            $scope.isSelected = function(player) {
                return $scope.selectedPlayers.indexOf(player) > -1;
            };

            $scope.$watch('rangeNow', function(range) {
                $scope.getPlayers();
                $location.search('range', range);
            });

            $scope.setPlayers = function() {

                players = $scope.selectedPlayers.map(function(player) { return player.fbid }).join(',');

                $location.search('players', players);

                $scope.reflash($scope.selectedPlayers);
            };

            $scope.selectSignPlayer = function(player) {

                $scope.selectedPlayers = [];
                $scope.selectedPlayers.push(player);

                $scope.setPlayers();
            };

            $scope.selectMutiPlayer = function(player) {

                var index = $scope.selectedPlayers.indexOf(player);

                if (index > -1) {
                    $scope.selectedPlayers.splice(index, 1);
                } else {
                    $scope.selectedPlayers.push(player);
                }

                $scope.setPlayers();
            }

        }
    };
})

.directive('card', function() {
    return {
        restrict: 'E',
        replace: true,
        transclude: false,
        scope: {
            selectedPlayers: '='
        },
        template:  `
            <a ng-repeat="selectedPlayer in selectedPlayers" class="link-playerAbility faceCardMajor" href="/playerAbility/{{selectedPlayer.fbid}}">
                <div class="majorbox playercardsmall highlight">
                    <div style="float:left">

                        <div style="background:url(/images/nophoto.png) no-repeat center;background-size:60px 72px">
                            <div class="face" ng-style="{'background-image': 'url(/player/'+selectedPlayer.fbid+'.png)'}" style="width:60px;height:72px;background-size: 60px 72px"></div>
                        </div>

                    </div>
                    <div class="playercardsmall-news">
                        <div class="cardplayer">{{ selectedPlayer.cardplayer }}</div>
                        <div>
                            <div class="cardteamposi" style="float:left;padding:0 5px 0 0">{{ selectedPlayer.cardteamposi }}</div>
                            <div class="cardinjna">{{ selectedPlayer.cardinjna }}</div>
                            <div style="height:0;clear:both"></div>
                        </div>
                        <div class="cardstat">{{ selectedPlayer.cardstat }}</div>
                    </div>
                    <div style="height:0;clear:both"></div>
                </div>
            </a>
        `,
        controller: function($scope, $http, $filter) {

        }
    };
});