<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Network | 2014 FIFA World Cup | fansboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="../statpage.css" rel="stylesheet"/>
    </head>
    <body>
        <? include("../headblock.html"); ?>
        
        <div class="pagewidth">
            <div style="font-size: 30px;padding: 10px 0 10px 0px; color:#003377 ;font-family: 'Open Sans', sans-serif">Football Team Network</div>
            <div style="font-size: 20px;padding: 0 0 10px 0; color:#888888 ;font-family: 'Open Sans', sans-serif; font-style: italic">Which countries have more players from Premier League, Liga BBVA, Serie A, Ligue 1 or Bundesliga?</div>
            
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class="fb-like" data-href="http://www.fansboard.com/worldcup/network/index.html" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" style=""></div>
            
            <div style="padding:0 0 0 200px"><img style="width: 890px; height: 627px" src="final.png" /></div>
        </div>
        
    </body>
</html>



