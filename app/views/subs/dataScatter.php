<div style="background-color:rgba(0,0,0,0.5);margin: 0">
    <div class="onepcssgrid-1200">

        <div class="onerow">

            <div style="padding:10px 0 10px 55px">

                <div style="float:left">
                    <select class="selectForm" name="datarange" style="color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9);margin:0 5px 0 0">
                        <option value="ALL" selected="selected">2016-17 Season</option>
                        <option value="D30">Last 4 Weeks</option>
                        <option value="D14">Last 2 Weeks</option>
                        <option value="D07">Last 1 Week</option>
                        <option value="Y-1">2015-16 Season</option>
                        <option value="Y-2">2014-15 Season</option>
                    </select>
                </div>

                <div style="float:left">
                    <select class="selectForm" id="player_mins">
                        <option value="min30">30+ mins</option>
                        <option value="min25">25+ mins</option>
                        <option value="min20" selected="selected">20+ mins</option>
                        <option value="min15">15+ mins</option>
                        <option value="min10">10+ mins</option>
                        <option value="ALL">ALL</option>
                    </select>
                </div>

                <div id="b-position" style="float:left;padding:4px">
                    <div style="float:left;line-height: 25px;color:#fff;font-size:12px">Position:</div>
                    <div class="checkbox horizontal position"><input type="checkbox" name="position" checked="checked" value="PG" id="PG"/><label for="PG" style="height:25px;line-height:25px">PG</label></div>
                    <div class="checkbox horizontal position"><input type="checkbox" name="position" checked="checked" value="SG" id="SG"/><label for="SG" style="height:25px;line-height:25px">SG</label></div>
                    <div class="checkbox horizontal position"><input type="checkbox" name="position" checked="checked" value="SF" id="SF"/><label for="SF" style="height:25px;line-height:25px">SF</label></div>
                    <div class="checkbox horizontal position"><input type="checkbox" name="position" checked="checked" value="PF" id="PF"/><label for="PF" style="height:25px;line-height:25px">PF</label></div>
                    <div class="checkbox horizontal position"><input type="checkbox" name="position" checked="checked" value="C" id="C"/><label for="C" style="height:25px;line-height:25px">C</label></div>
                </div>

                <div id="b-shortcuts" style="float:left;padding:4px">
                    <div style="float:left;line-height: 25px;color:#fff;font-size:12px">Shortcut:</div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="ovStat" id="ovStat" checked="checked"/>
                    <label for="ovStat" style="height:25px;line-height:25px;width:65px">Overall</label></div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="scStat" id="scStat"/>
                    <label for="scStat" style="height:25px;line-height:25px;width:65px">Scoring</label></div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="spStat" id="spStat"/>
                    <label for="spStat" style="height:25px;line-height:25px;width:65px">Splash</label></div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="rbStat" id="rbStat"/>
                    <label for="rbStat" style="height:25px;line-height:25px;width:65px">Rank REB</label></div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="asStat" id="asStat"/>
                    <label for="asStat" style="height:25px;line-height:25px;width:65px">Rank AST</label></div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="ignrFG" id="ignrFG"/>
                    <label for="ignrFG" style="height:25px;line-height:25px;width:65px">Ignore FG</label></div>
                    <div class="checkbox horizontal shortcut"><input type="checkbox" name="shortcuts" value="ignrFT" id="ignrFT"/>
                    <label for="ignrFT" style="height:25px;line-height:25px;width:65px">Ignore FT</label></div>
                </div>

                <div style="height:0;clear:both"></div>

            </div>


            <div style="padding: 0 0 10px 0">
                <div style="float: left;width: 55px;text-align: left">
                    <button class="plot" id="plotbtn" style="width: 45px;height: 35px;padding: 4px" title="Plot" ng-click="plot()">
                        <img src="/images/search.png" style="width: 24px" />
                    </button>
                </div>

                <div id="x-category" style="float: left;padding: 10px 0 0 0">
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xMIN" id="xMIN" checked="checked" /><label for="xMIN">MIN</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xFGM" id="xFGM" /><label for="xFGM">FGM</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xFGA" id="xFGA" /><label for="xFGA">FGA</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xFG%" id="xFG" /><label for="xFG">FG%*</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="x3PTM" id="x3PTM" /><label for="x3PTM">3PTM</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="x3PTA" id="x3PTA" /><label for="x3PTA">3PTA</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="x3PT%" id="x3PT" /><label for="x3PT">3PT%*</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xFTM" id="xFTM" /><label for="xFTM">FTM</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xFTA" id="xFTA" /><label for="xFTA">FTA</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xFT%" id="xFT" /><label for="xFT">FT%*</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xOREB" id="xOREB" /><label for="xOREB">OREB</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xDREB" id="xDREB" /><label for="xDREB">DREB</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xTREB" id="xTREB" /><label for="xTREB">TREB</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xAST" id="xAST" /><label for="xAST">AST</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xTO" id="xTO" /><label for="xTO">-TO</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xATR" id="xATR" /><label for="xATR">A/T*</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xST" id="xST" /><label for="xST">ST</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xBLK" id="xBLK" /><label for="xBLK">BLK</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xPF" id="xPF" checked="checked" /><label for="xPF">-PF</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xPTS" id="xPTS" /><label for="xPTS">PTS</label></div>
                    <div class="checkbox horizontal xcate"><input type="checkbox" name="x" value="xTECH" id="xTECH" /><label for="xTECH">-TECH</label></div>
                </div>
                <div style="height:0;clear:both"></div>

            </div>



            <div style="padding:0 0 0 0px">

                <div id="y-category" style="float: left;width: 55px">
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yMIN" id="yMIN" /><label for="yMIN">MIN</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yFGM" id="yFGM" /><label for="yFGM">FGM</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yFGA" id="yFGA" /><label for="yFGA">FGA</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yFG%" id="yFG" checked="checked"/><label for="yFG">FG%*</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="y3PTM" id="y3PTM" checked="checked"/><label for="y3PTM">3PTM</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="y3PTA" id="y3PTA" /><label for="y3PTA">3PTA</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="y3PT%" id="y3PT" /><label for="y3PT">3PT%*</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yFTM" id="yFTM" /><label for="yFTM">FTM</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yFTA" id="yFTA" /><label for="yFTA">FTA</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yFT%" id="yFT" checked="checked"/><label for="yFT">FT%*</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yOREB" id="yOREB" /><label for="yOREB">OREB</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yDREB" id="yDREB" /><label for="yDREB">DREB</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yTREB" id="yTREB" checked="checked"/><label for="yTREB">TREB</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yAST" id="yAST" checked="checked"/><label for="yAST">AST</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yTO" id="yTO" checked="checked"/><label for="yTO">-TO</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yATR" id="yATR" /><label for="yATR">A/T*</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yST" id="yST" checked="checked"/><label for="yST">ST</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yBLK" id="yBLK" checked="checked"/><label for="yBLK">BLK</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yPF" id="yPF" /><label for="yPF">-PF</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yPTS" id="yPTS" checked="checked"/><label for="yPTS">PTS</label></div>
                    <div class="checkbox ycate"><input type="checkbox" name="y" value="yTECH" id="yTECH" /><label for="yTECH">-TECH</label></div>
                </div>

                <div id="container3" class="highlight" style="float:left;border:1px solid #fff;margin: 0;height:680px;background:-webkit-gradient(linear, left bottom, right top, color-stop(0%,rgba(59,103,153,0.8)),color-stop(10%,rgba(255,255,255,0.0)),color-stop(90%,rgba(255,255,255,0.0)), color-stop(100%,rgba(211,84,84,0.8)))"></div>

                <div style="float:left;width:230px;height:680px;display:none" id="testlist">
                        <div class="transparent" style="border:1px solid #fff;background-color:rgba(0,0,0,0.0);padding:0;margin:0 0 0 2px;height:100%; text-align:left;overflow-y:scroll">
                            <div style="margin:3px">
                                <table cellspacing="0" style="width:100%" class="rankList">
                                    <tr class="ranklist" ng-repeat="player in players" ng-click="highlight(player)" ng-class="{active: player.active}">
                                        <td class="index">{{player.index}}</td>
                                        <td>{{player.bv_name}}</td>
                                        <td>{{player.position}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
                <div style="height:0;clear:both"></div>

            </div>


        </div>
    </div>

    <div class="onepcssgrid-1200">
        <div class="onerow">
            <div style="margin:5px 0 20px 60px;color:#fff;font-size: 12px">
                <?php include('include_updatetime.php'); ?>
            </div>
            <div class="col12" style="color:#fff; text-align:left;font-size: 14px;padding-left: 100px;line-height: 25px">
                Note:<br />
                1. All categories have been standardized, so PTS and AST can be compared on the same base, and can even be summed up.<br />
                <!--// for a comprehensive comparison-->
                2. FG%, FT%, 3PT% and A/T were adjusted. (weighted NUMBER of Shots.)<br />
                3. Colors of Player Name means: <br />
                <span style="color:rgba(255,0,0,1);padding-left: 18px">More Red  - Shoote'R' style</span> <br />
                <span style="color:rgba(0,255,0,1);padding-left: 18px">More Green- Pure Point 'G'uard style</span> <br />
                <span style="color:rgba(0,0,255,1);padding-left: 18px">More Blue - 'B'ig man style</span> <br /><br />
            </div>
        </div>
        <div style="height:0;clear:both"></div>
    </div>

    <div class="onepcssgrid-1200">
        <div class="onerow">
            <div class="col12">
                <div style="color:gold; text-align:left;font-size: 25px;padding-left: 200px;line-height: 80px;font-weight: bold">How to use the scatter chart? We suggest 4 basic ways: </div>
                <img src="/images/scatter1.png" style="margin:0 auto;display:block;width:60%" /><br /><br /><br />
                <img src="/images/scatter2.png" style="margin:0 auto;display:block;width:60%" /><br /><br /><br />
                <img src="/images/scatter3.png" style="margin:0 auto;display:block;width:60%" /><br /><br /><br />
                <img src="/images/scatter4.png" style="margin:0 auto;display:block;width:60%" /><br /><br /><br />
            </div>
        </div>
        <div style="height:0;clear:both"></div>
    </div>

</div>

<style>
.checkbox.horizontal.position{
    width: 30px;
    margin-left: 3px;
}
.checkbox.horizontal.shortcut{
    width: 65px;
    margin-left: 3px;
}
.checkbox.horizontal.xcate{
    width: 44px;
    margin-right: 3px;
    vertical-align: bottom;
}
.checkbox.ycate{
    width: 44px;
    margin: 0 0 3px 0;
}
.plot {
    background-color: #d14836;
    background-image: -webkit-linear-gradient(top,#dd4b39,#d14836);
    border: 1px solid transparent;
    border-top: 1px solid #aaa;
    border-left: 1px solid #aaa;
    border-radius: 5px;
    outline: 0;
}
.plot:hover {
    background-image: -webkit-linear-gradient(top,#dd4b39,#c53727);
    cursor: pointer;
    border-top: 1px solid #ddd;
    border-left: 1px solid #ddd;
    box-shadow: 2px 2px 10px #fff;
}
.plot:active {
    box-shadow: none;
    border-top: 1px solid #aaa;
    border-left: 1px solid #aaa;
}
tr.ranklist {
    font-family: 'Cabin';
    font-size:12px;
    cursor: pointer;
}
tr.ranklist td {
    padding: 3px;
    border-bottom: 2px solid rgba(0,0,0,0.0);
    background-color: rgba(0,0,0,0.5);
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    color: #888;
}
tr.ranklist.active td {
    background-color: rgba(255,255,255,1);
    color: #000
}
.optionMenuItem {
    position:absolute;
    background-color:rgba(255,255,255,0.4);
    border-radius: 25px;
    width:25%;
    height:25%;
    left:40%;
    top:40%;
    z-index:2
}
.optionMenuItem:hover {
    background-color:rgba(255,0,255,0.5);
    box-shadow: 0px 0px 15px #fff;
    cursor: pointer;
}
</style>

