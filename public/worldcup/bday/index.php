<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
    <style>
        rect.bordered {
          stroke: #E6E6E6;
          stroke-width:2px;   
        }

        text.mono {
          font-size: 11pt;
          font-family: Consolas, courier;
          fill: #aaa;
        }

        text.axis-workweek {
          fill: #000;
        }

        text.axis-worktime {
          fill: #000;
        }
    </style>
    <link href="../statpage.css" rel="stylesheet"/>
    <script src="d3.v3.js"></script>
</head>

<title>Bday | 2014 FIFA World Cup | fansboard</title>

<body>
    <? include("../include_head.html"); ?>
    
    <div class="pagewidth">
        <div style="float: left;padding:0px 0 0 0">
           
            <div class="font1">
                Which player has the same birthday as you...?
            </div>
            <div class="font2">
                Do you know Neymar Jr. and Cristiano Ronaldo share the same birthday? (Feb 5th)
            </div>
            
            <? include("../include_fb.php"); ?>
            
            <div id="chart"></div>
            <div style="font-size: 14px;padding: 0 0 0 50px; color:#003377 ;font-family: 'Open Sans', sans-serif">
                <span style="padding: 0 40px 0 0">0</span>
                <span style="padding: 0 40px 0 0">1</span>
                <span style="padding: 0 40px 0 0">2</span>
                <span style="padding: 0 40px 0 0">3</span>
                <span style="padding: 0 40px 0 0">4</span>
                <span style="padding: 0 40px 0 0">5</span>
                <span style="padding: 0 40px 0 0">6</span>
                <span style="padding: 0 40px 0 0">7</span>
            </div>
        </div>
    
        <div style="float: left;padding:50px 0 0 0">
            <img style="width: 359px; height: 427px;" src="figure.png" />
        </div>
        <div style="height:0;clear:both"></div>
    </div>
    
    <script type="text/javascript">
        var margin = { top: 50, right: 0, bottom: 100, left: 30 },
            width = 841 - margin.left - margin.right, //1920
            height = 380 - margin.top - margin.bottom, //860
            gridSize = Math.floor(width / 32),
            legendElementWidth = gridSize*2,
            buckets = 8,
            colors = ["#ffffd9","#edf8b1","#c7e9b4","#41b6c4","#1d91c0","#225ea8","#253494","#081d58"], // alternatively colorbrewer.YlGnBu[9],"#7fcdbb"
            days = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            times = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];


        d3.tsv("data3.tsv",
          function(d) {
            return {
              qqq: d.qqq,
              day: +d.day,
              hour: +d.hour,            
              value: +d.value
            };
          },
          function(error, data) {
            var colorScale = d3.scale.quantile()
                .domain([0, buckets - 1, d3.max(data, function (d) { return d.value; })])
                .range(colors);

            var svg = d3.select("#chart").append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            var dayLabels = svg.selectAll(".dayLabel")
                .data(days)
                .enter().append("text")
                  .text(function (d) { return d; })
                  .attr("x", 0)
                  .attr("y", function (d, i) { return i * gridSize; })
                  .style("text-anchor", "end")
                  .attr("transform", "translate(-6," + gridSize / 1.5 + ")")
                  .attr("class", function (d, i) { return ((i >= 0 && i <= 11) ? "dayLabel mono axis axis-workweek" : "dayLabel mono axis"); });

            var timeLabels = svg.selectAll(".timeLabel")
                .data(times)
                .enter().append("text")
                  .text(function(d) { return d; })
                  .attr("x", function(d, i) { return i * gridSize; })
                  .attr("y", 0)
                  .style("text-anchor", "middle")
                  .attr("transform", "translate(" + gridSize / 2 + ", -6)")
                  .attr("class", function(d, i) { return ((i >= 0 && i <= 30) ? "timeLabel mono axis axis-worktime" : "timeLabel mono axis"); });

            var heatMap = svg.selectAll(".hour")
                .data(data)
                .enter().append("rect")
                .attr("x", function(d) { return (d.hour - 1) * gridSize; })
                .attr("y", function(d) { return (d.day - 1) * gridSize; })
                .attr("rx", 4)
                .attr("ry", 4)
                .attr("class", "hour bordered")
                .attr("width", gridSize)
                .attr("height", gridSize)
                .style("fill", colors[0]);

            heatMap.transition().duration(1000)
                .style("fill", function(d) { return colorScale(d.value); });

            heatMap.append("title").text(function(d) { return d.qqq; });

            var legend = svg.selectAll(".legend")
                .data([0].concat(colorScale.quantiles()), function(d) { return d; })
                .enter().append("g")
                .attr("class", "legend");

            legend.append("rect")
              .attr("x", function(d, i) { return legendElementWidth * i; })
              .attr("y", height+80)
              .attr("width", legendElementWidth)
              .attr("height", gridSize / 2)
              .style("fill", function(d, i) { return colors[i]; });

            legend.append("text2")
              .attr("class", "mono")
              .text(function(d) { return "≥ " + Math.round(Math.sqrt(d)); })
              .attr("x", function(d, i) { return legendElementWidth * i; })
              .attr("y", height + gridSize);
        });
    </script>
</body>
</html>

