<!DOCTYPE html>
<html>
<head>
<meta name="viewport"></meta>
<title>32 Teams | 2014 FIFA World Cup | fansboard</title>
<link href="../statpage.css" rel="stylesheet"/>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;v=3"></script>

<script type="text/javascript">
  function initialize() {
    google.maps.visualRefresh = true;
    var isMobile = (navigator.userAgent.toLowerCase().indexOf('android') > -1) ||
      (navigator.userAgent.match(/(iPod|iPhone|iPad|BlackBerry|Windows Phone|iemobile)/));
    if (isMobile) {
      var viewport = document.querySelector("meta[name=viewport]");
      viewport.setAttribute('content', 'initial-scale=1.0, user-scalable=no');
    }
    var mapDiv = document.getElementById('googft-mapCanvas');
    mapDiv.style.width = isMobile ? '100%' : '1200px';
    mapDiv.style.height = isMobile ? '100%' : '700px';
    var map = new google.maps.Map(mapDiv, {
      center: new google.maps.LatLng(20.292382596493237, 13.141824062500064),
      zoom: 3,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend-open'));
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend'));

    layer = new google.maps.FusionTablesLayer({
      map: map,
      heatmap: { enabled: false },
      query: {
        select: "col0",
        from: "1mb0BrzUsVc-qz2reMwwpncT3cvMeFSOqVsqgQBh4",
        where: ""
      },
      options: {
        styleId: 2,
        templateId: 2
      }
    });

    if (isMobile) {
      var legend = document.getElementById('googft-legend');
      var legendOpenButton = document.getElementById('googft-legend-open');
      var legendCloseButton = document.getElementById('googft-legend-close');
      legend.style.display = 'none';
      legendOpenButton.style.display = 'block';
      legendCloseButton.style.display = 'block';
      legendOpenButton.onclick = function() {
        legend.style.display = 'block';
        legendOpenButton.style.display = 'none';
      }
      legendCloseButton.onclick = function() {
        legend.style.display = 'none';
        legendOpenButton.style.display = 'block';
      }
    }
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
    <? include("../headblock.html"); ?>
    
    <div class="pagewidth">
        <div style="padding:10px 0 10px 0; float: left; font-family: 'Open Sans', sans-serif; font-size: 24px; color: #003377; font-weight: bold  ">
            In Each National Team, Where are the 23 Players From? (Football League)
        </div>
        
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
         <div class="fb-like" data-href="http://www.fansboard.com/worldcup/team/index.html" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" style=""></div>
        
        <div id="googft-mapCanvas"></div>
    </div>
</body>
</html>


