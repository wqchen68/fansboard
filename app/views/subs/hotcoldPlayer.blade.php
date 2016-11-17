<?php
    $hotcold_data = Player::gethotcoldPlayer()->getData();
?>


<div class="insidemove" style="color:#fff">

    <div class="onepcssgrid-1p-1200" style="min-height:1200px">

        <div class="onerow">

            <div class="col-1p12 last">
                <span>
                    <a href="realtimeBox" target="" title="Real-Time Box - Get real-time NBA players' performance at any time, from anywhere.">
                        <img class="link-hover" style="float:left;width:48px" src="images/icon_realtimebox.png" />
                    </a>
                </span>
<!--                <span>
                    <a href="hotcoldPlayer" target="_blank" title="Hot & Cold Player - Calculate hot and cold players by recent stats.">
                        <img class="link-hover" style="float:left;width:48px" src="images/icon_hotcold.png" />
                    </a>
                </span>-->
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

            <div class="col-1p6">
                <?php
                $tabletitle='Today Breakout';
                $subviewdata = $hotcold_data->todaybo;
                $tablename = 'todaybo';
                $tablesign = '+';
                $livevalue = $hotcold_data->livemark;
                if (empty($livevalue)){
                    $livemark = 'updadting...';
                }else{
                    (count($livevalue)==1 & $livevalue[0]->livemark=='Final') ? $livemark = 'Final' : $livemark = 'LIVE!';
                }
                ?>
                @include('subs.hotcoldhead')

            </div>

            <div class="col-1p6 last">

                <?php
                $tabletitle='Today Struggle';
                $subviewdata = $hotcold_data->todaysg;
                $tablename = 'todaysg';
                $tablesign = '';
                ?>
                @include('subs.hotcoldhead')

            </div>

            <div style="margin:10px 0 0 10px;font-size: 12px">
                <?php
                    echo '<div> Last updated: Real-Time Update</div>';
                ?>
            </div>

        </div>

        <div class="onerow">

            <div class="col-1p6 ">
                <?php
//				$tabletitle='Season Most Improved';
                $tabletitle='Season HOT!!';
                $subviewdata = $hotcold_data->recenthot;
                $tablename = 'recenthot';
                $tablesign = '+';
                ?>
                @include('subs.hotcoldhead')

            </div>

            <div class="col-1p6 last">

                <?php
//				$tabletitle='Season Most Unimproved';
                $tabletitle='season cold...';
                $subviewdata = $hotcold_data->recentcold;
                $tablename = 'recentcold';
                $tablesign = '';
                ?>
                @include('subs.hotcoldhead')

            </div>

            <div style="margin:10px 0 0 10px;font-size: 12px">
                @include('subs.include_updatetime')
            </div>


        </div>

    </div>
</div>








<style>
/*四大區塊*/
.todaybo {background-color:rgba(0,0,0,0.5)}
.todaysg {background-color:rgba(0,0,0,0.5)}
.recenthot {background-color:rgba(0,0,0,0.5)}
.recentcold {background-color:rgba(0,0,0,0.5)}

/*名片中排名顏色、LIVE顏色*/
.colorlabel-todaybo {background-color:red}
.colorlabel-todaysg {background-color:dodgerblue}
.colorlabel-recenthot {background-color:red}
.colorlabel-recentcold {background-color:dodgerblue}
/*名片中數據顏色*/
.todaybo-stat {	color:red}
.todaysg-stat {	color:dodgerblue}
.recenthot-stat { color:red}
.recentcold-stat { color:dodgerblue}

/*名片中hover顏色*/
.masktodaybo {
    background-color: rgba(255,255,255,0.0);
    color: rgba(255,255,255,0.0);
}
.masktodaysg {
    background-color: rgba(255,255,255,0.0);
    color: rgba(255,255,255,0.0);
}
.maskrecenthot {
    background-color: rgba(255,255,255,0.0);
    color: rgba(255,255,255,0.0);
}
.maskrecentcold {
    background-color: rgba(255,255,255,0.0);
    color: rgba(255,255,255,0.0);
}
.masktodaybo:hover {
    background-color: rgba(0,0,0,0.9);
    color: #fff;
}
.masktodaysg:hover {
    background-color: rgba(0,0,0,0.9);
    color: dodgerblue;
}
.maskrecenthot:hover {
    background-color: rgba(0,0,0,0.9);
    color: #fff;
}
.maskrecentcold:hover {
    background-color: rgba(0,0,0,0.9);
    color: dodgerblue;
}






.prcard-resize {
    width: 50%;
}
@media all and (max-width: 768px) {
.prcard-resize {
    width: 100%;
}
}
</style>


<span class="javascript" src="js/hightchart.hotcoldPlayer.js"></span>
