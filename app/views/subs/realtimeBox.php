<div style="background-color:rgba(0,0,0,0.5);margin: 0;min-height:900px">

	<div class="onepcssgrid-1p-1200" style="background-color:rgba(0,0,0,0.0);border-radius: 0px">		
   
            
		<div class="onerow">
            <div style="height: 42px; padding: 10px 0 10px 0">
                <div style="position:absolute;left:20%;margin:10px 0 0 -75px;font-size: 14px;color:gold;font-weight:bold;font-style:italic">2014-15 Pre-Season</div>
                <div style="position:absolute;left:50%;margin-left:-25px"><div class="reflashtime"></div></div>
                <div style="position:absolute;left:70%;margin:10px 0 0 0;font-size: 14px;color:#fff">
                    <?
                        $lastupdate = DB::table('realtimeeff')
                        ->select(DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime2'))
                        ->orderBy('updatetime','desc')
                        ->first();
                        echo '<div>' .$lastupdate->updatetime2. '</div>';
                    ?>
                </div>
            </div>
		</div>
            
		
		<div class="onerow">

			<div class="col-1p1 realtime">
				<div style="">
                    <div class="teambox">
                        <?=Player::getRealtime()->getData()->teambox?>
                        <div style="height:0;clear:both"></div>
                    </div>
				</div>
			</div>

			<div class="col-1p11 realtime last">
	
				<div style="background-color:rgba(0,0,0,0.5);color:#fff;width:100%;height:20px;padding:3px">
					<div class="rbxlist0 smallwidth" style="text-align:left">#</div>
					<div class="playerwidth" style="float:left;width:26.7%;text-align: left">Player</div>
					<div class="rbxlist0 smallwidth"></div>
					<div class="rbxlist0 midwidth"></div>					
					<div class="rbxlist0 smallwidth">Start</div>					
					<div class="real-bar-eff" style="float:left;text-align:center;color:gold;font-weight:bold">EFF</div>
					<div class="rbxlist0 midwidth" style="text-align: center">Game</div>
					<div class="rbxlist0 midwidth">MIN</div>
					<div class="rbxlist0 midwidth">FG%</div>
					<div class="rbxlist0 smallwidth">PTS</div>
					<div class="rbxlist0 smallwidth">REB</div>
					<div class="rbxlist0 smallwidth">AST</div>
					<div class="rbxlist0 smallwidth">ST</div>
					<div class="rbxlist0 smallwidth">BLK</div>
					<div class="rbxlist0 smallwidth">3PM</div>					
				</div>
					
				<div class="ranklist" ng-controller="realtimeBoxController">
                    <div ng-repeat="player in realtimeBox">{{ player.fbid }}</div>
					<?
					//$realtime = Player::getRealtime()->getData()->value;
                    
					if( false && is_array($realtime) )
					foreach( $realtime as $index => $r ){
						$secAll = round($r->bxmin*60);
						$sec = (round($r->bxmin*60)) % 60;
						$min = ($secAll-$sec)/60;
						echo '<span class="effrank_t"></span>';
                        echo '<div class="effrank new wait" fbid="'.$r->fbid.'" rank="'.$index.'" style="width:100%;height:20px;margin: 7px">';
//						echo '<a href="playerAbility?player='.$r->fbid.'" target="_blank" style="text-decoration:none;color:#fff"><div class="effrank new wait" fbid="'.$r->fbid.'" rank="'.$index.'" style="width:100%;height:20px;margin: 7px">'
//                                .'<span>'
//                                    .'<div style="float:left;width:60px;height:72px;background:url(/player/'.$r->fbid.'.png) no-repeat center; background-size: 60px 72px"></div>'
//                                    .'<div style="float:left">'
//                                        .'<div>'
//                                            .'<div class="hovercard">FGM</div>'
//                                            .'<div class="hovercard">FGA</div>'
//                                            .'<div class="hovercard">FG%</div>'
//                                            .'<div class="hovercard">FTM</div>'
//                                            .'<div class="hovercard">FTA</div>'
//                                            .'<div class="hovercard">FT%</div>'
//                                            .'<div class="hovercard">3PTM</div>'
//                                            .'<div class="hovercard">3PTA</div>'
//                                            .'<div class="hovercard">3PT%</div>'                                
//                                            .'<div style="height:0;clear:both"></div>'
//                                        .'</div>'
//                                        .'<div>'
//                                            .'<div class="hovercard">'.$r->bxfgm.'-'.$r->bxfga.'</div>'
//                                            .'<div class="hovercard">'.$r->bxftm.'-'.$r->bxfta.'</div>'
//                                            .'<div class="hovercard">'.$r->bx3ptm.'-'.$r->bx3pta.'</div>'
//                                            .'<div class="hovercard">'.$r->bxfgm.'-'.$r->bxfga.'</div>'
//                                            .'<div class="hovercard">'.$r->bxftm.'-'.$r->bxfta.'</div>'
//                                            .'<div class="hovercard">'.$r->bx3ptm.'-'.$r->bx3pta.'</div>'
//                                            .'<div class="hovercard">'.$r->bxfgm.'-'.$r->bxfga.'</div>'
//                                            .'<div class="hovercard">'.$r->bxftm.'-'.$r->bxfta.'</div>'
//                                            .'<div class="hovercard">'.$r->bx3ptm.'-'.$r->bx3pta.'</div>'
//                                            .'<div style="height:0;clear:both"></div>'
//                                        .'</div>'
//                                        .'<div style="height:0;clear:both"></div>'
//                                    .'</div>'
//                                .'</span>'
//                            .'</a>';
						echo '<div class="rbxlist0 smallwidth" style="text-align:left">'.($index+1).'</div>';
						echo '<div class="playerwidth" style="float:left;width:18%;text-align:left;overflow : hidden; text-overflow : ellipsis; white-space : nowrap"><a href="playerAbility?player='.$r->fbid.'" target="_blank" style="text-decoration:none;color:#fff">'.$r->player.'</a></div>';
						echo '<div class="rbxlist0 smallwidth" style="border-radius:3px;line-height:20px;font-size:12px;font-weight:bold;text-align:center;background-color:'.$r->colorback.';color:'.$r->colorfont.'">'.$r->team.'</div>';
						echo '<div class="rbxlist0 midwidth" style="text-align:left;margin-left:5px">'.$r->oppo.'</div>';
						echo '<div class="rbxlist0 smallwidth" style="text-align:left">'.$r->startfive.'</div>';
						echo '<div class="real-bar-eff"><div style="float:left;text-align:left;background-color:rgba(0,187,255,1);height:100%;font-weight:bold;width:'.($r->bxeff*500/50).'px">'.$r->bxeff.'</div></div>';
						echo '<div class="rbxlist0 midwidth" style="text-align:center" class="">'.$r->livemark.'</div>';

                        if ($r->livemark = 'Final' && $min>25 && $r->bxeff<10){                            
                            echo '<div class="rbxlist1 midwidth" style="color:#FF3333;">'.$min.':'.str_pad($sec,2,'0',STR_PAD_LEFT).'</div>';
                            echo '<div class="rbxlist1 midwidth" style="color:#FF3333;">'.$r->bxfgm.'-'.$r->bxfga.'</div>';                            
                            echo '<div class="rbxlist1 smallwidth" style="color:#FF3333;">'.$r->bxpts.'</div>';
                            echo '<div class="rbxlist1 smallwidth" style="color:#FF3333;">'.$r->bxtreb.'</div>';
                            echo '<div class="rbxlist1 smallwidth" style="color:#FF3333;">'.$r->bxast.'</div>';
                            echo '<div class="rbxlist1 smallwidth" style="color:#FF3333;">'.$r->bxst.'</div>';
                            echo '<div class="rbxlist1 smallwidth" style="color:#FF3333;">'.$r->bxblk.'</div>';
                            echo '<div class="rbxlist1 smallwidth" style="color:#FF3333;">'.$r->bx3ptm.'</div>';
                        }else{
                            echo '<div class="rbxlist0 midwidth">'.$min.':'.str_pad($sec,2,'0',STR_PAD_LEFT).'</div>';
                            echo '<div class="rbxlist0 midwidth">'.$r->bxfgm.'-'.$r->bxfga.'</div>';                            
                            if ($r->bxpts > 14){
                                echo '<div class="rbxlist1 smallwidth" style="color:gold;">'.$r->bxpts.'</div>';
                            }else{
                                echo '<div class="rbxlist0 smallwidth">'.$r->bxpts.'</div>';
                            }  						

                            if ($r->bxtreb > 9){
                                echo '<div class="rbxlist1 smallwidth" style="color:gold;">'.$r->bxtreb.'</div>';
                            }else{
                                echo '<div class="rbxlist0 smallwidth">'.$r->bxtreb.'</div>';
                            }                        

                            if ($r->bxast > 5){
                                echo '<div class="rbxlist1 smallwidth" style="color:gold;">'.$r->bxast.'</div>';
                            }else{
                                echo '<div class="rbxlist0 smallwidth">'.$r->bxast.'</div>';
                            }

                            if ($r->bxst > 2){
                                echo '<div class="rbxlist1 smallwidth" style="color:gold;">'.$r->bxst.'</div>';
                            }else{
                                echo '<div class="rbxlist0 smallwidth">'.$r->bxst.'</div>';
                            }

                            if ($r->bxblk > 2){
                                echo '<div class="rbxlist1 smallwidth" style="color:gold;">'.$r->bxblk.'</div>';
                            }else{
                                echo '<div class="rbxlist0 smallwidth">'.$r->bxblk.'</div>';
                            }

                            if ($r->bx3ptm > 2){
                                echo '<div class="rbxlist1 smallwidth" style="color:gold;">'.$r->bx3ptm.'</div>';
                            }else{
                                echo '<div class="rbxlist0 smallwidth">'.$r->bx3ptm.'</div>';
                            }
                        }                         
                        
                        
						
						echo '</div>';
					}					
					?>
				</div>
				<?
				/*$question = DB::table('teamlist')->select(DB::raw('UPPER(team) AS team'),'colorback','colorfont')->get();
				foreach($question as $q){
					echo '<div style="width:70px;height:30px;line-height:30px;text-align:center;float:left;font-weight:bold;background-color:'.$q->colorback.';color:'.$q->colorfont.'">'.$q->team.'</div>';
				}*/
				?>
			</div>	
			
			<div style="height:0;clear:both"></div>
	
		</div>	
	</div>
</div>



<style>
.rbxlist1{
    float:left;
    text-align:right;
    font-weight:bold;
}
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
	background: url('images/fast.png') transparent no-repeat;
	background-position: right;
}
.hot {
	background: url('images/flag_hot.png') transparent no-repeat;
	background-position: right;
	background-size: 24px 24px;
}
.rbxlist0{
    float:left;
    text-align:right;
}
.smallwidth{
    width:3%;
}
.midwidth{
    width:5%;
}
.real-bar-eff {
	float: left;
	width: 33%;
	height: 100%;
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
@media all and (max-width: 375px) {

}
</style>

<script>
angular.module('app', []).filter('startFrom',function(){
    return function(input, start){
        return input.slice(start);
    };
}).controller('realtimeBoxController', function($scope){
    $scope.realtimeBox = angular.fromJson(<?=json_encode(Player::getRealtime()->getData()->value)?>);

    console.log($scope.realtimeBox);;
});
</script>