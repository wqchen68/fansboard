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