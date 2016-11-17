angular.module('app')

.filter('startFrom',function(){
    return function(input, start){
        return input.slice(start);
    };
})

.controller('realtimeBoxCtrl', function($scope, $filter, $http, $timeout){
    $scope.Math = Math;
    $scope.searchText = {};
    $scope.style = function(value){
        if (value.livemark === 'Final' && value.bxmin >25 && value.bxeff <10){
            return {color:'#FF3333','font-weight':'bold'};
        };
    };
    
    $scope.styleeff = function(value){

        if (value.livemark=='Final'){
            if (value.bxeff-value.pweff>=10){
                return {'background-color':'rgb(255,215,0,0.8)'};
            }else if (value.bxeff-value.pweff<=-10){
                return {'background-color':'rgb(255,0,0,0.8)'};                
            }else{
                return {'background-color':'rgba(0,187,255,0.8)'};
            }
        }else if (value.livemark=='LIVE!'){
            if (value.bxeff/value.bxmin>=0.8){
                return {'background-color':'rgb(255,215,0,0.3)'};
            }else if(value.bxeff/value.bxmin<=0.3){
                return {'background-color':'rgba(255,0,0,0.3)'};
            }else{
                return {'background-color':'rgba(0,187,255,0.3)'};
            }
        };
    };
    
    $scope.select = function(game){
        var selected = game.selected;
        angular.forEach($filter('filter')($scope.realtimeBox.gamedata, {selected: true}), function(value, key) {
            value.selected = false;
        });
        game.selected = !selected;
        if ($filter('filter')($scope.realtimeBox.gamedata, {selected: true}).length === 0) {
            $scope.searchText.gameid = '';
        }
    };    
    
    
    $scope.update = function() {
        $http.get('/sort/getRealtime').success(function(data){
            console.log(data);
            $scope.realtimeBox = data;
            $scope.flashtime();
        });
    };
    
    $scope.update();

    $scope.reflashtime = 0;
    $scope.flashtime = function() {
        if ($scope.reflashtime == 24) {
            $scope.reflashtime = 0;
        } else {
            $scope.reflashtime++;
        }
        $timeout($scope.flashtime, 1000);
    };

});