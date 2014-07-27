<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Club | 2014 FIFA World Cup | fansboard</title>
    <script src="d3.js"></script>
     <!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600"/> -->
    <link rel="stylesheet" type="text/css" href="sequences.css"/>
    <link rel="stylesheet" type="text/css" href="../statpage.css"/>
</head>

<body>

    <? include("../include_head.html"); ?>

    <div class="pagewidth">

        <div class="font1">
            How many players of different clubs have joined 2014 FIFA World Cup?
        </div>

         <? include("../include_fb.php"); ?>

        <div>
            <span style="font-size: 20px">Zone</span>
            <span style="font-size: 20px;padding:0 0 0 150px">League</span>
            <span style="font-size: 20px;padding:0 0 0 150px">Club</span>
        </div>
        <div id="sequence"></div>

        <div id="chart" style="float: left">
            <div id="explanation" style="visibility: hidden">
                <span id="percentage2">                      </span> players<br/>
                joined 2014 FIFA World Cup<br/>
                (<span id="percentage"></span>)<br/>
            </div>
        </div>

        <div style="float: left;padding:60px 0 0 0">
            <img style="width: 636px; height: 341px" src="map.png" />
        </div>

        <div style="height:0;clear:both"></div>
    </div>            

    
    <div id="sidebar">
      <!--<input type="checkbox" id="togglelegend"> Legend<br/>-->
      <!--<div id="legend" style="visibility: hidden;"></div>-->
    </div>
    
    <script type="text/javascript" src="sequences.js"></script>
    <script type="text/javascript">
      // Hack to make this example display correctly in an iframe on bl.ocks.org
      d3.select(self.frameElement).style("height", "700px");
    </script>
    
</body>
</html>