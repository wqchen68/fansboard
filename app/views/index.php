<!DOCTYPE html>

<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" xmlns:ng="http://angularjs.org" lang="en" xml:lang="en" ng-app="app">

<head>

<title><?=Lang::get('title.'.$pagename).' - Fansboard'?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />

<meta name="keywords" content="Basketball,Fantasy,NBA">
<meta name="description" content="<?=Lang::get('description.'.$pagename)?>">

<meta property="og:title" content="<?=Lang::get('title.'.$pagename).' - Fansboard'?>" />
<meta property="og:description" content="<?=Lang::get('description.'.$pagename)?>" />
<meta property="og:type" content="website" />
<?=$og_image?>
<meta property="og:image" content="http://www.fansboard.com/images/fb-logo.png" />
<meta property="og:url" content="http://www.fansboard.com/<?=$full_url?>" />
<meta property="og:site_name" content="Fansboard"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/Highcharts-4.0.3/js/highcharts.js"></script>
<script src="/js/Highcharts-4.0.3/js/highcharts-more.js"></script>
<script src="/js/Highcharts-4.0.3/js/modules/exporting.src.js"></script>
<script src="/js/highcharts.theme.js"></script>
<script src="/js/angular/1.5.8/angular.min.js"></script>
<script src="/js/angular/1.5.8/angular-route.min.js"></script>
<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->

<link rel="stylesheet" href="/css/onepcssgrid.css" />
<link rel="stylesheet" href="/css/onepcssgrid-1p.css" />
<link rel="stylesheet" href="/css/index.css" />
<link rel="stylesheet" href="/css/share.css" />
<link rel="stylesheet" href="/js/smoothness/jquery-ui-1.10.3/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" href="/css/font-awesome.css" />

<script src="/js/hightchart.creatRadarChart.js"></script>
<script src="/js/ng-player.js"></script>
<script src="/js/app.js"></script>
<script src="/js/controllers/playerAbility.js"></script>
<script src="/js/controllers/gameLog.js"></script>
<script src="/js/controllers/splitStats.js"></script>
<script src="/js/controllers/careerStats.js"></script>
<script src="/js/controllers/dataScatter.js"></script>
<script src="/js/controllers/playerRankings.js"></script>
<script src="/js/controllers/realtimeBox.js"></script>
<script src="/js/controllers/matchPlayer.js"></script>
</head>

<body>
<div style="position: relative;min-height: 100%;">

    <?=$mainmenu?>

    <div id="testi" style="position:absolute;bottom:50px;top:52px;overflow:auto">
        <div class="move active" index="0" style="height:100%">

            <div ng-view></div>

            <div style="position: absolute ; top:20px; left:1565px">
                <div class="fb-like" data-href="" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
    </div>
    <div style="background-color:#fff;width:100%;height:50px;position:absolute;bottom:0px">

        <div class="onepcssgrid-full">
            <div class="onerow">
                <?=$child_footer?>
            </div>
        </div>

    </div>

</div>
</body>
</html>