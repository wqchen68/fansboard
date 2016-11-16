<div style="background-color:rgba(0,0,0,0.5);margin: 0;height:100%">

	<div class="onepcssgrid-1p-1200" style="position:relative;height:100%">		
              
		<div class="onerow">
            <div style="height: 42px; padding: 10px 0 10px 0">
                
                
                <div style="position:absolute;left:8.5%">
<!--                    <span>
                        <a href="realtimeBox" target="_blank" title="Real-Time Box - Get real-time NBA players' performance at any time, from anywhere.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_realtimebox.png" />
                        </a>
                    </span>-->
                    <span>
                        <a href="hotcoldPlayer" target="" title="Hot & Cold Player - Calculate hot and cold players by recent stats.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_hotcold.png" />
                        </a>
                    </span>
                    <span>
                        <a href="playerStatus" target="" title="Player Status - Players' Latest News and Injury Report.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_adsence.png" />
                        </a>
                    </span>   
                    <span>
                        <a href="playerRankings" target="" title="Player Rankings - Players' Overall and Catagories Power Rankings.">
                            <img class="link-hover" style="float:left;width:48px" src="images/icon_rankings.png" />
                        </a>
                    </span>               
                </div>
                
                <div style="position:absolute;left:30%;margin:5px 0 0 0;font-size: 14px;color:gold;font-weight:bold">2016-17 Season</div>
                <div style="position:absolute;left:30%;margin:25px 0 0 0;font-size: 14px;color:#fff">
                    <?php
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
                <div style="position:absolute;left:50%;margin-left:-25px"><div class="reflashtime"></div></div>
                <div style="position:absolute;left:62%;margin:25px 0 0 0;font-size: 14px;color:#fff">
                    Fantasy: Sum of the Stadarlized Public 9 Cates Values (Z-scroe)
                </div>
                
            </div>
		</div>
            
		
        <div class="onerow" ng-controller="realtimeBoxController" style="position:absolute;top:60px;bottom:0;right:0;left:0">

            <div class="col-1p1 realtime" style="position:absolute">
<!--                <a href="hotcoldPlayer" target="_blank" style="text-decoration:none;color:#fff">
                    <div class="link-hover" style="padding:3px;margin:0 0 10px 0;background-color:rgba(255,255,255,0.4);border-radius:5px;color:gold;font-weight:bold;font-size:14px">
                        Today</br> Hot & cold
                        <img style="width:39px" src="images/hcp_hot.png" />
                        <img style="width:39px" src="images/hcp_cold.png" />
                    </div>
                </a>-->
                <div class="link-hover order-btn" style="font-size:12px;background-color:rgba(255,255,255,0.4);border-radius:3px;margin:0 0 3px 0;text-align:center" ng-repeat="game in realtimeBox.gamedata" ng-click="searchText.gameid=game.gameid;select(game)" ng-class="{selected:game.selected}">
                    <div style="width:100%;padding:5px 0 0 0">
                        <span style="background-color:{{game.cbo}};color:{{game.cfo}};font-weight:bold;border-radius:2px;padding:2px">{{game.oppo}}</span>@
                        <span style="background-color:{{game.cbt}};color:{{game.cft}};font-weight:bold;border-radius:2px;padding:2px">{{game.team}}</span>
                    </div>
                    <div style="padding:5px 0 5px 0">
                        <span style="padding:0px">{{game.score}}</span>
                        <span style="margin:0 0 0 2px" ng-class="{gamestatus:game.livemark=='LIVE!'}">{{game.livemark}}</span>
                    </div>
                </div>
			</div>

            <div class="col-1p11 realtime last" style="position:absolute;right:0;top:0;bottom:0" ng-cloak>
	
				<div class="tablehead" style="background-color:rgba(0,0,0,0.5);color:#fff;width:100%;height:20px;padding:7px 0px 7px 0px ">
					<div class="rtbvarC smallwidth">#</div>
					<div class="rtbvarL playerwidth">Player</div>
                    <div class="order-btn rtbvarL gamewidth" ng-click="predicate = ['gameid','-oppo','bxgs','startfive','bxmin']; reverse=true">Game</div>                    
					<div class="order-btn rtbvarL smallwidth" ng-click="predicate = ['bxgs','startfive','bxeff']; reverse=true">Start</div>
					<div class="order-btn rtbvarC real-bar-eff" ng-click="predicate = ['bxgs','bxeff']; reverse=true" style="color:gold;font-weight:bold">EFF</div>
					<div class="order-btn rtbvarL" style="width:4.0%;color:gold;font-weight:bold" ng-click="predicate = ['bxgs','szv']; reverse=true">Fantasy</div>
                    <div class="rtbvarL" style="width:4.0%">　</div> <!--LIVE!orFinal-->
					<div class="order-btn rtbvarR midwidth" ng-click="predicate = ['bxgs','bxmin']; reverse=true">MIN</div>
					<div class="order-btn rtbvarC midwidth" ng-click="predicate = ['bxgs','bxfgm','-bxfga']; reverse=true">FG</div>
                    <div class="order-btn rtbvarC midwidth" ng-click="predicate = ['bxgs','bx3ptm','-bx3pta']; reverse=true">3P</div>
                    <div class="order-btn rtbvarC midwidth" ng-click="predicate = ['bxgs','bxftm','-bxfta']; reverse=true">FT</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxtreb','bxblk']; reverse=true">Reb</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxast','bxto','bxst']; reverse=true">Ast</div>
                    <div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxto']; reverse=true">To</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxst','bxast','bxto']; reverse=true">St</div>
					<div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxblk','bxtreb']; reverse=true">Blk</div>
                    <div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxpf']; reverse=true">Pf</div>
                    <div class="order-btn rtbvarR smallwidth" ng-click="predicate = ['bxgs','bxpts','bxeff','bxfgm','-bxfga']; reverse=true">Pts</div>
				</div>
					
                <div class="transparent" style="overflow-x:hidden;overflow-y:scroll;position:absolute;bottom:10px;top:34px;left:0;right:0">
                    <div class="effrank new wait" fbid="{{ player.fbid*3.5 }}" rank="{{ index }}" style="width:100%;height:20px;padding:4px 7px 4px 7px;color:#fff;position:relative" ng-repeat="player in (realtimeBox.rtstats | orderBy:predicate:reverse | filter:searchText)">

                        <span>
                            <div style="float:left">
                                <div style="color:gold;margin-bottom: 2px">EFF {{ Math.round(player.pweff*10)/10}}</div>
                                <div style="width:60px;height:72px;background:url(/player/{{player.fbid}}.png) no-repeat center; background-size: 60px 72px"></div>
                            </div>

                            <div style="float:left;padding:0 4px 0 4px">
                                <div style="padding-left:20px;margin-bottom: 2px">2016-17 Season Average</div>
                                <div>
                                    <div class="hovercard1">Min</div>
                                    <div class="hovercard1">FGM</div>
                                    <div class="hovercard1">FGA</div>
                                    <div class="hovercard1">FG%</div>
                                    <div class="hovercard1">3PM</div>
                                    <div class="hovercard1">3PA</div>
                                    <div class="hovercard1">3P%</div>
                                    <div class="hovercard1">FTM</div>
                                    <div class="hovercard1">FTA</div>
                                    <div class="hovercard1">FT%</div>
                                    <div style="height:0;clear:both"></div>
                                </div>
                                <div>
                                    <div class="hovercard">{{ Math.round(player.pwmin*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwfgm*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwfga*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.wfgp*1000)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pw3ptm*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pw3pta*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.w3ptp*1000)/10}}</div>                                
                                    <div class="hovercard">{{ Math.round(player.pwftm*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwfta*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.wftp*1000)/10}}</div>
                                    <div style="height:0;clear:both"></div>
                                </div>                            
                                <div>
                                    <div class="hovercard1">Off</div>
                                    <div class="hovercard1">Def</div>
                                    <div class="hovercard1">REB</div>
                                    <div class="hovercard1">AST</div>
                                    <div class="hovercard1">TO</div>
                                    <div class="hovercard1">A/T</div>
                                    <div class="hovercard1">ST</div>
                                    <div class="hovercard1">BLK</div>
                                    <div class="hovercard1">PF</div>
                                    <div class="hovercard1">PTS</div>
                                    <div style="height:0;clear:both"></div>
                                </div>
                                <div>
                                    <div class="hovercard">{{ Math.round(player.pworeb*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwdreb*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwtreb*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwast*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwto*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.watr*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwst*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwblk*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwpf*10)/10}}</div>
                                    <div class="hovercard">{{ Math.round(player.pwpts*10)/10}}</div>                                
                                    <div style="height:0;clear:both"></div>
                                </div>  
                            </div>
                            <div style="height:0;clear:both"></div>
                        </span>

                        <div class="rtbvarL smallwidth">{{ $index+1 }}</div>
                        <a href="gameLog?player={{ player.fbid }}" target="_blank" style="text-decoration:none;color:#fff">
                            <div class="rtbvarL playerwidth"  ng-class="{oncourt:player.oncourt=='on-court',offcourt:player.oncourt!='on-court',goldback:player.bxeff-player.pweff>=10 && player.livemark=='Final',redback:player.bxeff-player.pweff<=-10 && player.livemark=='Final'}">{{ player.player }}</div>
                        </a>
                        <div class="rtbvarL gamewidth">
                            <div class="rtbvarC" style="width:40%;border-radius:3px;line-height:20px;font-size:12px;font-weight:bold;background-color:{{player.colorback}};color:{{player.colorfont}}">{{ player.team }}</div>
                            <div class="rtbvarL" style="margin-left:5%">{{ player.oppo }}</div>
                        </div>
                        <!--start跟EFF-->
                        <div class="rtbvarL smallwidth" ng-class="{grayfont:player.startfive=='BN'||player.startfive=='DNP'}">{{ player.startfive }}</div>
                        <div class="real-bar-eff">
                            <div ng-style="styleeff(player)" ng-class="" style="float:left;font-weight:bold;text-align:left;height:100%;width:{{ player.bxeff*3.5 }}%">{{ player.bxeff }}</div>
                        </div>
                        <!--LIVE!跟時間-->
                        <div class="rtbvarL" style="width:4.0%" title="Sum of Z-score Value">{{ player.szv.toFixed(1) }}</div>
                        <div class="rtbvarL" style="width:4.0%" ng-class="{livefont:player.livemark=='LIVE!'}">{{ player.livemark }}</div>
                        <div class="rtbvarR midwidth" ng-style="style(player)">{{ Math.floor(player.bxmin) }}:{{ ((player.bxmin*60)%60|number:0)<10 ? 0+((player.bxmin*60)%60|number:0) : ((player.bxmin*60)%60|number:0) }}</div>
                        <!--數據-->
                        <div class="rtbvarR midwidth" ng-style="" ng-class="{goldbold:player.bxfga>=10 && player.bxfgm/player.bxfga>0.6,redbold:player.bxfga>=10 && player.bxfgm/player.bxfga<0.4}" title="Field Goal">{{ player.bxfgm }}-{{ player.bxfga }}</div>
                        <div class="rtbvarR midwidth" ng-style="" ng-class="{goldbold:player.bx3ptm>=3 && player.bx3ptm/player.bx3pta>0.6,redbold:player.bx3pta>=6 && player.bx3ptm/player.bx3pta<0.3}" title="3-Point ">{{ player.bx3ptm }}-{{ player.bx3pta }}</div>
                        <div class="rtbvarR midwidth" ng-style="" ng-class="{goldbold:player.bxfta>=7 && player.bxftm/player.bxfta>0.8,redbold:player.bxfta>=7 && player.bxftm/player.bxfta<0.6}" title="Free Throw">{{ player.bxftm }}-{{ player.bxfta }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{goldbold:player.bxtreb>9}" title="Rebounds">{{ player.bxtreb }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{goldbold:player.bxast>5}" title="Assists">{{ player.bxast }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{redbold:player.bxto>4}" title="Turnovers">{{ player.bxto }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{goldbold:player.bxst>2}" title="Steals">{{ player.bxst }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{goldbold:player.bxblk>2}" title="Block Shots">{{ player.bxblk }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{redbold:player.bxpf>4}" title="Personal Fouls">{{ player.bxpf }}</div>
                        <div class="rtbvarR smallwidth" ng-style="" ng-class="{goldbold:player.bxpts>19}" title="Points">{{ player.bxpts }}</div>

                        <div style="height:0;clear:both"></div>

                    </div>
                    
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
.effrank:hover{
	background-color: rgba(0,0,0,0.5);
}
.hovercard{
    float: left;
    width:40px;
    text-align: right;
    margin:1px;
}
.hovercard1{
    float: left;
    width:40px;
    text-align: center;
    margin:1px;
    background-color: rgba(255,255,255,0.3)
}

.effrank {outline:none;color:white}
/*a.tooltip strong {line-height:30px;}*/
/*a.tooltip:hover {text-decoration:none;color:white}*/ 
.effrank span {
    z-index:10;
    display:none;
    padding:10px;
    margin:24px 0 0 200px;
    width:490px;
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
/*.hot {
	color:gold;
    background: url('/images/flag_hot2.png') transparent no-repeat;
	background-position: right;
	background-size: 24px 24px;
}*/
.oncourt{
    /*font-weight:bold;*/
    color:rgba(46,204,113,1);    
    background-image: url('/images/light_green.png');
    background-repeat: no-repeat;
    background-position:right;
}
.offcourt{
    /*color:rgba(46,204,113,1);*/
    background-image: url('/images/light_black.png');
    background-repeat: no-repeat;
    background-position:right;
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
.livefont{
    /*color:rgba(46,204,113,1);*/
    text-align:center;
    color:#fff;
    background-color: rgba(46,204,113,0.7);
    border-radius: 5px;
}
.order-btn{
    cursor: pointer;
}
.order-btn:hover{
    text-decoration:underline;
    color: #5599FF;
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
    width:9%;
}
.real-bar-eff {
    float:left;
	width: 23%;
	height: 100%;
}
.goldback{
    /*font-weight: bold;*/
    background-color: rgba(255,215,0,0.2);
    background-image: url('/images/light_yellow.png');
    background-repeat: no-repeat;
    background-position:right;    
}
.redback{
    /*font-weight: bold;*/
    background-color: rgba(255,0,0,0.2);
    background-image: url('/images/light_red.png');
    background-repeat: no-repeat;
    background-position:right;       
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
    $scope.Math = Math;
    $scope.searchText = {};
    $scope.style = function(value){
        if (value.livemark === 'Final' && value.bxmin >25 && value.bxeff <10){
            return {color:'#FF3333','font-weight':'bold'};
        };
    };
    
    $scope.styleeff = function(value){
//        if (value.bxeff-value.pweff>=15){
//            if (value.livemark=='Final'){
//                return {'background-color':'rgb(255,215,0,1)'};
//            }else{
//                return {'background-color':'rgb(255,215,0,0.6)'};
//            }            
//        }else if (value.bxeff-value.pweff<=-15){
//            if (value.livemark=='Final'){
//                return {'background-color':'rgba(255,0,0,1)'};
//            }else{
//                return {'background-color':'rgba(255,0,0,0.6)'};
//            }
//        }else{
//            if (value.livemark=='Final'){
//                return {'background-color':'rgba(0,187,255,1)'};
//            }else{
//                return {'background-color':'rgba(0,187,255,0.4)'};
//            }            
//        };
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
        });
    };
    
    $scope.update();
});
//.filter("emptyToEnd", function () {
//    return function (array, key) {
//        if (!angular.isArray(array)) return;
//        if (!angular.isArray(key)) return array;
//        var present = array.filter(function (item) {
//            return (item[key[0]] && item[key[0]]>0);
//        });
//        var negetive = array.filter(function (item) {
//            return (item[key[0]] && item[key[0]]<0);
//        });
//        var empty = array.filter(function (item) {
//            return (!item[key[0]] && item[key[0]]!=0);
//        });
//        var zero = array.filter(function (item) {
//            return (!item[key[0]] && item[key[0]]==0);
//        });
//        var step0 = present.concat(zero);
//        var step1 = step0.concat(negetive);
//        return step1.concat(empty);
//    };
//});
</script>
