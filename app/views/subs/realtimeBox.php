<div style="background-color:rgba(0,0,0,0.5);margin: 0;min-height:900px">

	<div class="onepcssgrid-1p-1200" style="background-color:rgba(0,0,0,0.0);border-radius: 0px">		
   
            
		<div class="onerow">
            <div style="height: 42px; padding: 10px 0 10px 0">
                <div style="position:absolute;left:23%;margin:10px 0 0 -75px;font-size: 14px;color:gold;font-weight:bold">2014-15 Pre-Season</div>
                <div style="position:absolute;left:50%;margin-left:-25px"><div class="reflashtime"></div></div>
                <div style="position:absolute;left:70%;margin:10px 0 0 0;font-size: 14px;color:#fff">
                    <?
                        $lastupdate = DB::table('realtimeeff')
                        ->select(DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime2'))
                        ->orderBy('updatetime','desc')
                        ->first();
                        if (is_null($lastupdate)==1){
                            echo '<div style="color:#ff3333;font-weight:bold">Waiting for Sync</div>';
                        }else{
                            echo '<div>'.$lastupdate->updatetime2.'</div>';
                        }                        
                    ?>
                </div>
            </div>
		</div>
            
		
		<div class="onerow" ng-controller="realtimeBoxController">

			<div class="col-1p1 realtime">
                <a href="hotcoldplayer" target="_blank" style="text-decoration:none;color:#fff">
                    <div style="padding:8px;margin:0 0 10px 0;background-color:rgba(255,255,255,0.4);border-radius:3px;color:gold;font-weight:bold;font-size:12px;box-shadow: 0 0 10px gold;">
                        Today</br> Hot & cold
                        <img style="width:35px" src="images/hcp_hot.png" />
                        <img style="width:35px" src="images/hcp_cold.png" />
                    </div>
                </a>
                <div class="order-btn" style="font-size:12px;background-color:rgba(255,255,255,0.4);border-radius:3px;margin:0 0 3px 0;text-align:center" ng-repeat="game in realtimeBox.gamedata" ng-click="searchText.gameid=game.gameid;select(game)" ng-class="{selected:game.selected}">
                    <div style="padding:5px 0 0 0">
                        <span style="background-color:{{game.cbo}};color:{{game.cfo}};font-weight:bold;border-radius:2px;padding:2px">{{game.oppo}}</span>@
                        <span style="background-color:{{game.cbt}};color:{{game.cft}};font-weight:bold;border-radius:2px;padding:2px">{{game.team}}</span>
                    </div>
                    <div style="padding:5px 0 5px 0">
                        <span style="padding:0px">{{game.score}}</span>
                        <span style="margin:0 0 0 2px" ng-class="{gamestatus:game.livemark=='LIVE!'}">{{game.livemark}}</span>
                    </div>
                </div>
			</div>

			<div class="col-1p11 realtime last">
	
				<div style="background-color:rgba(0,0,0,0.5);color:#fff;width:100%;height:20px;padding:7px">
					<div class="rtbvarL smallwidth">#</div>
					<div class="rtbvarL playerwidth">Player</div>
                    <div class="order-btn rtbvarL gamewidth" ng-click="predicate = ['gameid','team','bxgs','startfive','bxmin']; reverse=true">Game</div> <!--team+oppo-->
					<div class="rtbvarL smallwidth" ng-click="predicate = ['bxgs','gameid','team','startfive','bxmin']; reverse=true">Start</div>
					<div class="order-btn rtbvarC real-bar-eff" ng-click="predicate = ['bxeff','bxpts']; reverse=true" style="color:gold;font-weight:bold">EFF</div>
					<div class="rtbvarL" style="width:5.5%">　</div> <!--LIVE!orFinal-->
					<div class="order-btn rtbvarR midwidth" ng-click="predicate = 'bxmin'; reverse=true">MIN</div>
					<div class="order-btn rtbvarC midwidth" ng-click="predicate = ['bxfgm','-bxfga']; reverse=true">FG</div>
                    <div class="order-btn rtbvarC midwidth" ng-click="predicate = ['bx3ptm','-bx3pta']; reverse=true">3P</div>
                    <div class="order-btn rtbvarC midwidth" ng-click="predicate = ['bxftm','-bxfta']; reverse=true">FT</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxtreb','bxblk']; reverse=true">Reb</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxast','bxto','bxst']; reverse=true">Ast</div>
                    <div class="order-btn rtbvarR smallwidth" ng-click="predicate = 'bxto'; reverse=true">To</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxst','bxast','bxto']; reverse=true">St</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxblk','bxtreb']; reverse=true">Blk</div>
                    <div class="order-btn rtbvarR smallwidth" ng-click="predicate = 'bxpf'; reverse=true">Pf</div>
                    <div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxpts','bxeff','bxfgm','-bxfga']; reverse=true">Pts</div>
				</div>
					
                    
                <div class="effrank new wait" fbid="{{ player.fbid*3.5 }}" rank="{{ index }}" style="width:100%;height:20px;padding:4px 7px 4px 7px;color:#fff" ng-repeat="player in realtimeBox.rtstats | orderBy:predicate:reverse | filter:searchText">

                    <div class="rtbvarL smallwidth">{{ $index+1 }}</div>
                    <a href="playerAbility?player={{ player.fbid }}" target="_blank" style="text-decoration:none;color:#fff">
                        <div class="rtbvarL playerwidth">{{ player.player }}</div>
                    </a>
                    <div class="rtbvarL gamewidth">
                        <div class="rtbvarC" style="width:40%;border-radius:3px;line-height:20px;font-size:12px;font-weight:bold;background-color:{{player.colorback}};color:{{player.colorfont}}">{{ player.team }}</div>
                        <div class="rtbvarL" style="margin-left:5%">{{ player.oppo }}</div>
                    </div>
                    <!--start跟EFF-->
                    <div class="rtbvarL smallwidth" ng-class="{grayfont:player.startfive=='BN'}">{{ player.startfive }}</div>
                    <div class="real-bar-eff">
                        <div ng-style="style(player)" style="float:left;text-align:left;background-color:rgba(0,187,255,1);height:100%;font-weight:bold;width:{{ player.bxeff*3.5 }}%">{{ player.bxeff }}</div>
                    </div>
                    <!--LIVE!跟時間-->
                    <div class="rtbvarL" style="width:5.5%" ng-class="{hot:player.effper>realtimeBox.efflv && player.livemark==='LIVE!'}">{{ player.livemark }}</div>
                    <div class="rtbvarR midwidth" ng-style="style(player)">{{ Math.floor(player.bxmin) }}:{{ ((player.bxmin*60)%60|number:0)<10 ? 0+((player.bxmin*60)%60|number:0) : ((player.bxmin*60)%60|number:0) }}</div>
                    <!--數據-->
                    <div class="rtbvarR midwidth" ng-style="style(player)" ng-class="{goldbold:player.bxfga>9 && player.bxfgm/player.bxfga>0.7,redbold:player.bxfga>9 && player.bxfgm/player.bxfga<0.4}">{{ player.bxfgm }}-{{ player.bxfga }}</div>
                    <div class="rtbvarR midwidth" ng-style="style(player)" ng-class="{goldbold:player.bx3pta>2 && player.bx3ptm/player.bx3pta>0.5,redbold:player.bx3pta>5 && player.bx3ptm/player.bx3pta<0.3}">{{ player.bx3ptm }}-{{ player.bx3pta }}</div>
                    <div class="rtbvarR midwidth" ng-style="style(player)" ng-class="{goldbold:player.bxfta>9 && player.bxftm/player.bxfta>0.8,redbold:player.bxfta>9 && player.bxftm/player.bxfta<0.6}">{{ player.bxftm }}-{{ player.bxfta }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{goldbold:player.bxtreb>9}">{{ player.bxtreb }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{goldbold:player.bxast>5}">{{ player.bxast }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{redbold:player.bxto>4}">{{ player.bxto }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{goldbold:player.bxst>2}">{{ player.bxst }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{goldbold:player.bxblk>2}">{{ player.bxblk }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{redbold:player.bxpf>4}">{{ player.bxpf }}</div>
                    <div class="rtbvarR smallwidth" ng-style="style(player)" ng-class="{goldbold:player.bxpts>15}">{{ player.bxpts }}</div>

                    <div style="height:0;clear:both"></div>

                </div>
            </div>	
			
			<div style="height:0;clear:both"></div>
	
		</div>	
	</div>
</div>



<style>
.realtime {
	font-family: 'Verdana';
	font-size: 14px;
}
.effrank{
	color: #fff;	
}
.effrank:hover{
	background-color: rgba(0,0,0,0.5);
}
.hovercard{
    float: left;
}

.effrank {outline:none;color:white}
/*a.tooltip strong {line-height:30px;}*/
/*a.tooltip:hover {text-decoration:none;color:white}*/ 
.effrank span {
    z-index:10;
    display:none;
    padding:14px 20px;
    margin:20px 0 0 150px;
    width:400px;
    line-height:16px;
}
.effrank:hover span{
    display:inline;
    position:absolute;
    color:#fff;
    border:0px solid #DCA;
    background:rgba(0,0,0,0.8);
}


.reflashtime{
	border: 3px solid #000;
	padding: 0 3px 0 3px;
	color: rgba(221,75,57,1);
	background-color: rgba(0,0,0,0.8);
	font-family: 'jd_led3';
	font-size: 36px;
}
.fast {
	background: url('/images/fast.png') transparent no-repeat;
	background-position: right;
}
.hot {
	background: url('/images/flag_hot.png') transparent no-repeat;
	background-position: right;
	background-size: 24px 24px;
}



/*@media all and (max-width: 1400px) {
	.real-bar-eff {
		width: 21%;
	}
}*/
/*@media all and (max-width: 1160px) {
	.real-bar-eff {
		width: 15%;
	}
}*/
@media all and (max-width: 768px) {
	.real-bar-eff {
		width: 33%;
	}
    .realtime{
        font-size: 6px;
    }
}

.playerwidth{width:18%}
.real-bar-eff{width:33%}


@media all and  (orientation: portrait) and (max-width: 375px) {
	.switchview{display: none;width:0%}
    .playerwidth{width:30%}
    .smallwidth{width:10%}
    .real-bar-eff{width:39%}
    .realtime{font-size: 6px}    
    .effrank.new.wait{margin:2px}
    .startwidth{width:12%}
}




.rtbvarL{
    float:left;
    text-align:left;
}
.rtbvarC{
    float:left;
    text-align:center;
}
.rtbvarR{
    float:left;
    text-align:right;
}
.order-btn{
    cursor: pointer;
}
.smallwidth{
    width:2.5%;
}
.midwidth{
    width:4.5%;
}
.playerwidth{
    width:18%;
    overflow : hidden; 
    text-overflow : ellipsis; 
    white-space : nowrap;
}
.gamewidth{
    width:8%;
}
.real-bar-eff {
    float:left;
	width: 26%;
	height: 100%;
}
.goldbold{
    color:gold;
    font-weight: bold;
}
.redbold{
    color:#FF3333;
    font-weight: bold;
}
.grayfont{
    color:graytext;
}
.gamestatus{
    padding:0 0 0 1px;
    color:#fff;
    background-color:red;    
}
.selected{
    box-shadow: 0 0 30px rgba(255,255,255,1);
}

</style>

<script>
angular.module('app', []).filter('startFrom',function(){
    return function(input, start){
        return input.slice(start);
    };
}).controller('realtimeBoxController', function($scope, $filter, $http){  
    alert();
    $scope.Math = Math;
    $scope.searchText = {};
    $scope.style = function(value){
        if (value.livemark === 'Final' && value.bxmin >25 && value.bxeff <10){
            return {color:'#FF3333','font-weight':'bold'};
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
        });
    };
    
    $scope.update();
});
</script>
