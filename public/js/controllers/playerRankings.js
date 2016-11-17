angular.module('app')

.filter('startFrom', function() {
    return function(input, start){
        if (Array.isArray(input))
        return input.slice(start);
    };
})

.controller('playerRankingsCtrl', function($scope, $http){

    $scope.page = 1;
    $scope.limit = 25;

    $http({method: 'GET', url: '/getRankplayers', data:{}})
    .success(function(data, status, headers, config) {
        console.log(data);
        $scope.rankplayers = data.rankplayers;
        $scope.max = $scope.rankplayers.length;
        $scope.pages = Math.ceil($scope.max/$scope.limit);
    }).error(function(e) {
        console.log(e);
    });

    $scope.style = function(value) {
        if (value<-2){
            return 'rgba(255,0,0,0.5)';
        }else if(value>=-2 & value<-1 ){
            return 'rgba(255,0,0,0.3)';
        }else if(value>=-1 & value<0 ){
            return 'rgba(255,0,0,0.1)';
        }else if(value>=0 & value<1 ){
            return 'rgba(0,255,0,0.1)';
        }else if(value>=1 & value<2 ){
            return 'rgba(0,255,0,0.3)';
        }else if(value>=2 ){
            return 'rgba(0,255,0,0.5)';
        }else{
            return '';
        }
    };

    $scope.next = function() {
        if( $scope.page < $scope.pages )
            $scope.page++;
    };

    $scope.prev = function() {
        if( $scope.page > 1 )
            $scope.page--;
    };

    $scope.start = function() {
        $scope.page = 1;
    };

    $scope.teams = [
      {name:'Bos',division:'Atlantic' },
      {name:'Bkn',division:'Atlantic' },
      {name:'NY' ,division:'Atlantic' },
      {name:'Phi',division:'Atlantic' },
      {name:'Tor',division:'Atlantic' },
      {name:'Chi',division:'Central'  },
      {name:'Cle',division:'Central'  },
      {name:'Det',division:'Central'  },
      {name:'Ind',division:'Central'  },
      {name:'Mil',division:'Central'  },
      {name:'Atl',division:'SouthEast'},
      {name:'Mia',division:'SouthEast'},
      {name:'Orl',division:'SouthEast'},
      {name:'Was',division:'SouthEast'},
      {name:'Cha',division:'SouthEast'},
      {name:'Dal',division:'SouthWest'},
      {name:'Hou',division:'SouthWest'},
      {name:'Mem',division:'SouthWest'},
      {name:'NO' ,division:'SouthWest'},
      {name:'SA' ,division:'SouthWest'},
      {name:'Den',division:'NorthWest'},
      {name:'Min',division:'NorthWest'},
      {name:'OKC',division:'NorthWest'},
      {name:'Por',division:'NorthWest'},
      {name:'Uta',division:'NorthWest'},
      {name:'GS' ,division:'Pacific'  },
      {name:'LAC',division:'Pacific'  },
      {name:'LAL',division:'Pacific'  },
      {name:'Pho',division:'Pacific'  },
      {name:'Sac',division:'Pacific'  }
    ];

    $scope.myTeam = null;

    $scope.positions = [
        {name:'PG'},
        {name:'SG'},
        {name:'SF' },
        {name:'PF'},
        {name:'C'},
    ];

});