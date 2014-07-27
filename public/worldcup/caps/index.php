<!DOCTYPE html>
<meta charset="utf-8">
<style>
    text {
      font: 10px sans-serif;
    }
</style>
<link href="../statpage.css" rel="stylesheet"/>

<title>Caps | 2014 FIFA World Cup | fansboard</title>
<script src="d3.v3.min.js"></script>

<body>
    <? include("../include_head.html"); ?>

    <div class="pagewidth">
        
        <div class="font1">
            Which football player joined 2014 FIFA world cup has more caps?
        </div>

        <? include("../include_fb.php"); ?>
        
        <div id="chart" style="float:left"></div>

        <div style="float:left;padding:60px 0 0 0px"><img style="width: 413px; height: 628px" src="figure.png" /></div>

        <div style="height:0;clear:both"></div>        
    </div>
    
    <script type="text/javascript">
        var diameter = 787,
            format = d3.format(",d"),
            color = d3.scale.category20c();

        var bubble = d3.layout.pack()
            .sort(null)
            .size([diameter, diameter])
            .padding(1.5);

        var svg = d3.select("#chart").append("svg")
            .attr("width", diameter)
            .attr("height", diameter)
            .attr("class", "bubble")
            .style("float", "left");

        d3.json("flare.json", function(error, root) {
          var node = svg.selectAll(".node")
              .data(bubble.nodes(classes(root))
              .filter(function(d) { return !d.children; }))
              .enter().append("g")
              .attr("class", "node")
              .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

          node.append("title")
              .text(function(d) { return d.classCountry + " - " + d.className + " (age " + d.classAge + ")" + ": " + format(d.value) + " caps"; });

          node.append("circle")
              .attr("r", function(d) { return d.r; })
              .style("fill", function(d) { return color(d.packageName); });

          node.append("text")
              .attr("dy", ".3em")
              .style("text-anchor", "middle")
              .text(function(d) { return d.className.substring(0, d.r / 3); });
        });

        // Returns a flattened hierarchy containing all leaf nodes under the root.
        function classes(root) {
          var classes = [];

          function recurse(name, node) {
            if (node.children) node.children.forEach(function(child) { recurse(node.name, child); });
            else classes.push({packageName: name, className: node.name, classCountry: node.country, classAge: node.age, value: node.size});
          }

          recurse(null, root);
          return {children: classes};
        }

        d3.select(self.frameElement).style("height", diameter + "px");
     </script>    
</body>
