<!DOCTYPE html>
<html>
<head>
<meta name="viewport"></meta>
<title>UEFA | 2014 FIFA World Cup | fansboard</title>

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
    mapDiv.style.width = isMobile ? '100%' : '1000px';
    mapDiv.style.height = isMobile ? '100%' : '700px';
    var map = new google.maps.Map(mapDiv, {
      center: new google.maps.LatLng(47.15029676114441, 12.079742648510432),
      zoom: 5,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend-open'));
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend'));

    layer = new google.maps.FusionTablesLayer({
      map: map,
      heatmap: { enabled: false },
      query: {
        select: "col2",
        from: "1aZ-CavdfACBaHJQoar4pCtm1OEunHL13a7kK4Zbi",
        where: ""
      },
      options: {
        styleId: 2,
        templateId: 3
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
    <? include("../include_head.html"); ?>
    
    <div class="pagewidth">
        <div class="font1">
            Players of the UEFA Football Clubs who participate in 2014 World Cup...FC Bayern, FCB...
        </div>
        
        <? include("../include_fb.php"); ?>
        
        <div id="googft-mapCanvas" style="float:left"></div>
        <div style="float:left"><img style="width: 200px" src="http://www.fansboard.com/worldcup/uefa/clublogo.png" /></div>
        <div style="height:0;clear:both"></div>
    </div>
</body>
</html>
