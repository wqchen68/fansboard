<div class="insidemove" style="color:#fff">

    <div class="onepcssgrid-1p-1200">

        <div class="onerow">

            <div class="col-1p3">
                <div class="playerlistblock">

                    <div style="float:left;padding:0 0 10px 0">
                        <select ng-model="rangeNow" style="color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9)">
                            <option value="@{{range.key}}" ng-repeat="range in ranges">@{{range.name}}</option>
                        </select>
                    </div>

                    @include('subs.include_link2realtimeBox')

                    <div style="height:0;clear:both"></div>

                    <div players range-now="rangeNow" reflash="reflash" muti="true"></div>

                    @include('subs.include_link2playerAbility')

                </div>
            </div>

            <div class="col-1p9 last chartblock" style="background-color:rgba(0,0,0,0.2)">

                <div class="col-1p8">
                    <select ng-model="matchMethod" ng-change="reflash(selectedPlayers)" style="position:absolute;z-index:1;padding:5px;margin:7px 0 0 440px;background-color:rgba(255,255,255,1);color:#000;border:1px;border-radius: 3px">
                        <option value="method1">Most Similar (Shape)</option>
                        <option value="method2">Better Case</option>
                        <option value="method3">Worse Case</option>
                        <option value="method4">Most Similar (Overall)</option>
                    </select>
                    <div class="modelBox" mid="31">
                        <div id="container1" class="" style="border:0px solid #fff;margin:0 0 0 0;padding:0px"></div>
                    </div>
                </div>

                <div class="col-1p4 last facebox">

                    <div  style="padding:10px">

                        <div class="majorboxN" ng-repeat="similarPlayer in similarPlayers">
                            <div ng-if="$first" style="color:red;font-weight:bold;padding:0px 5px 5px 5px">Most Similar Player</div>
                            <div ng-if="$index==1" style="padding:5px">Relative Players</div>

                            <div class="majorbox playercardsmall highlight" ng-if="!$last">
                                <div style="float:left">
                                    <img class="face" src="/player/@{{ similarPlayer.fbid }}.png" style="width:60px;height:72px;display:block" />
                                </div>
                                <div class="playercardsmall-news">
                                    <div style="float:left;width:83%">
                                        <div class="cardplayer">@{{ similarPlayer.cardplayer }}</div>
                                        <div>
                                            <div class="cardteamposi" style="float:left;padding:0 5px 0 0">@{{ similarPlayer.cardteamposi }}</div>
                                            <div class="cardinjna">@{{ similarPlayer.cardinjna }}</div>
                                            <div style="height:0;clear:both"></div>
                                        </div>
                                    </div>
                                    <a class="link-playerAbility@{{ $i }}" title='Player Ability (Radar Chart)' href="/playerAbility/@{{ similarPlayer.fbid }}">
                                        <div class="newsbox-icon" style="float:left;width:33px;height:35px;padding:0;background-size:33px 35px;background-image:url(/images/fig_1_playerAbility2.png)"></div>
                                    </a>
                                    <div style="height:0;clear:both"></div>
                                    <div class="cardstat">@{{ similarPlayer.cardstat }}</div>
                                </div>
                                <div style="height:0;clear:both"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="onerow" style="padding:10px 0 0 0">
            <div class="col-1p12">

                <div class="tablebackground">
                    <table class="ability-detail" cellpadding="6" cellspacing="0" style="width:100%;margin-left:0;font-size:12px;clear: both">
                    <thead>

                        <tr>
                        <th colspan="3" class="report-detail-midd">STATS per game</th>
                        <th colspan="3" class="report-detail-dark">Field Goals</th>
                        <th colspan="3" class="report-detail-midd">3-Point Throws</th>
                        <th colspan="3" class="report-detail-dark">Free Throws</th>
                        <th colspan="3" class="report-detail-midd">Rebounds</th>
                        <th colspan="3" class="report-detail-dark">Assist/Turnover</th>
                        <th colspan="4" class="report-detail-midd">Miscellaneous</th>
                        <th colspan="2" class="report-detail-dark">Efficiency</th>
                        </tr>

                        <tr>
                        <th class="report-detail-midd" width="15%">PLAYER</th>
                        <th class="report-detail-midd" width="2%">GP</th>
                        <th class="report-detail-midd" width="4%">MIN</th>
                        <th class="report-detail-dark" width="3%">FGM</th>
                        <th class="report-detail-dark" width="3%">FGA</th>
                        <th class="report-detail-dark" width="4%">FG%</th>
                        <th class="report-detail-midd" width="3%">3PTM</th>
                        <th class="report-detail-midd" width="3%">3PTA</th>
                        <th class="report-detail-midd" width="4%">3PT%</th>
                        <th class="report-detail-dark" width="3%">FTM</th>
                        <th class="report-detail-dark" width="3%">FTA</th>
                        <th class="report-detail-dark" width="4%">FT%</th>
                        <th class="report-detail-midd" width="4%">OREB</th>
                        <th class="report-detail-midd" width="4%">DREB</th>
                        <th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">REB</th>
                        <th class="report-detail-dark" width="4%" style="color:gold;font-weight:bold">AST</th>
                        <th class="report-detail-dark" width="4%">TO</th>
                        <th class="report-detail-dark" width="4%">A/T</th>
                        <th class="report-detail-midd" width="4%">ST</th>
                        <th class="report-detail-midd" width="4%">BLK</th>
                        <th class="report-detail-midd" width="3%">PF</th>
                        <th class="report-detail-midd" width="4%" style="color:gold;font-weight:bold">PTS</th>
                        <th class="report-detail-yell" width="4%">EFF</th>
                        <th class="report-detail-yell" width="4%">EFF36</th>
                        </tr>

                    </thead>

                    <tbody>
                        <tr class="report-detail" ng-repeat="score in scores">
                            <td style="text-align: left">@{{ score.player }}</td>
                            <td style="text-align: right;padding-right:5px" ng-repeat="abilitiy in score.abilities">@{{ abilitiy.value }}</td>
                        </tr>
                    </tbody>

                    </table>
                    <div class="tableupdate">
                        @include('subs.include_updatetime')
                    </div>
                </div>
            </div>
            <div style="height:0;clear:both"></div>
        </div>




    </div>
</div>



<style>
div.majorboxN{
    padding: 0 0 5px 0;
}

</style>
