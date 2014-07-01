// Dimensions of sunburst.
var width = 750;
var height = 600;
var radius = Math.min(width, height) / 2;

// Breadcrumb dimensions: width, height, spacing, width of tip/tail.
var b = {
  w: 200, h: 30, s: 3, t: 10
};

// Mapping of step names to colors.
var colors = {
"Asia":"red",
"Africa":"green",
"Europe":"navy",
"NorthAmerica":"orange",
"SouthAmerica":"gold",
"Premier League(England)":"red",
"Serie A(Italy)":"green",
"Bundesliga(Germany)":"gold",
"Liga BBVA(Spain)":"orange",
"Ligue 1(France)":"blue",
"Russia":"#A20055",
"Turkey":"#AA0000",
"Mexico":"#C63300",
"Portugal":"#CC6600",
"Netherlands":"#AA7700",
"UnitedStates":"#BBBB00",
"Japan":"#88AA00",
"Iran":"#55AA00",
"Greece":"#00AA00",
"Belgium":"#00AA55",
"Switzerland":"#00AA88",
"Brazil":"#00AAAA",
"Honduras":"#0088A8",
"CostaRica":"#003C9D",
"Ukraine":"#0000AA",
"Ecuador":"#2200AA",
"Argentina":"#4400B3",
"Australia":"#66009D",
"SouthKorea":"#7A0099",
"China":"#990099",
"Norway":"#A20055",
"Chile":"#AA0000",
"Croatia":"#C63300",
"Wales":"#CC6600",
"Colombia":"#AA7700",
"Nigeria":"#BBBB00",
"Scotland":"#88AA00",
"Canada":"#55AA00",
"Qatar":"#00AA00",
"Algeria":"#00AA55",
"Austria":"#00AA88",
"Cameroon":"#00AAAA",
"Israel":"#0088A8",
"SouthAfrica":"#003C9D",
"Sweden":"#0000AA",
"Tunisia":"#2200AA",
"UnitedArabEmirates":"#4400B3",
"BosniaandHerzegovina":"#66009D",
"Bulgaria":"#7A0099",
"Denmark":"#990099",
"Ghana":"#A20055",
"Hungary":"#AA0000",
"IvoryCoast":"#C63300",
"Kuwait":"#CC6600",
"Paraguay":"#AA7700",
"SaudiArabia":"#BBBB00",
"Uruguay":"#88AA00",
"1.FCNurnberg":"#444444",
"1860Munchen":"#A20055",
"1899Hoffenheim":"#AA0000",
"Aalesund":"#C63300",
"Academica":"#CC6600",
"AdelaideUnited":"#AA7700",
"AduanaStars":"#BBBB00",
"AIK":"#88AA00",
"Ajaccio":"#55AA00",
"Ajax":"#00AA00",
"AlAin":"#00AA55",
"AlGharafa":"#00AA88",
"AlHilal":"#00AAAA",
"AlJazira":"#0088A8",
"AlKuwait":"#003C9D",
"Alajuelense":"#0000AA",
"Almeria":"#2200AA",
"America":"#4400B3",
"Anderlecht":"#66009D",
"Antalyaspor":"#7A0099",
"AnzhiMakhachkala":"#990099",
"Arsenal":"#666666",
"ASMonaco":"#C10066",
"Ashdod":"#CC0000",
"AstonVilla":"#E63F00",
"Atalanta":"#EE7700",
"Atlante":"#DDAA00",
"AtleticoMadrid":"#EEEE00",
"AtleticoMineiro":"#99DD00",
"AtleticoNacional":"#66DD00",
"Augsburg":"#00DD00",
"AustriaWien":"#00DD77",
"AZ":"#00DDAA",
"Barcelona":"#00DDDD",
"Basel":"#009FCC",
"Bastia":"#0044BB",
"BayerLeverkusen":"#0000CC",
"BayernMunich":"#4400CC",
"BeijingGuoan":"#5500DD",
"Benfica":"#7700BB",
"Be?ikta?":"#A500CC",
"BocaJuniors":"#CC00CC",
"Bologna":"#444444",
"BoltonWanderers":"#A20055",
"BoracBanjaLuka":"#AA0000",
"Bordeaux":"#C63300",
"BorussiaDortmund":"#CC6600",
"BorussiaMonchengladbac":"#AA7700",
"Botafogo":"#BBBB00",
"Braga":"#88AA00",
"BrisbaneRoar":"#55AA00",
"BusanIPark":"#00AA00",
"Cagliari":"#00AA55",
"CardiffCity":"#00AA88",
"Cartagines":"#00AAAA",
"Catania":"#0088A8",
"CaykurRizespor":"#003C9D",
"CeltaVigo":"#0000AA",
"Celtic":"#2200AA",
"CercleBrugge":"#4400B3",
"CerezoOsaka":"#66009D",
"CharltonAthletic":"#7A0099",
"Chelsea":"#990099",
"ChivasUSA":"#666666",
"ClubAfricain":"#C10066",
"ClubBrugge":"#CC0000",
"ColoColo":"#E63F00",
"ColumbusCrew":"#EE7700",
"Copenhagen":"#DDAA00",
"Corinthians":"#EEEE00",
"CotonSport":"#99DD00",
"CruzAzul":"#66DD00",
"CrystalPalace":"#00DD00",
"CSConstantine":"#00DD77",
"CSKAMoscow":"#00DDAA",
"CSKASofia":"#00DDDD",
"DeportivoCali":"#009FCC",
"DinamoZagreb":"#0044BB",
"DynamoKyiv":"#0000CC",
"DynamoMoscow":"#4400CC",
"EintrachtBraunschweig":"#5500DD",
"EintrachtFrankfurt":"#7700BB",
"ElNacional":"#A500CC",
"Elaz??spor":"#CC00CC",
"Elche":"#444444",
"Emelec":"#A20055",
"EnuguRangers":"#AA0000",
"Espanyol":"#C63300",
"Esperance":"#CC6600",
"Esteghlal":"#AA7700",
"Everton":"#BBBB00",
"Evian":"#88AA00",
"F.C.Tokyo":"#55AA00",
"FCAugsburg":"#00AA00",
"Fenerbahce":"#00AA55",
"Ferencvaros":"#00AA88",
"Fethiyespor":"#00AAAA",
"Feyenoord":"#0088A8",
"Fiorentina":"#003C9D",
"Flamengo":"#0000AA",
"Fluminense":"#2200AA",
"Foolad":"#4400B3",
"FortunaDusseldorf":"#66009D",
"FSVFrankfurt":"#7A0099",
"Fulham":"#990099",
"Galatasaray":"#666666",
"GambaOsaka":"#C10066",
"Gaziantepspor":"#CC0000",
"Genoa":"#E63F00",
"Getafe":"#EE7700",
"GombeUnited":"#DDAA00",
"Granada":"#EEEE00",
"Grasshopper":"#99DD00",
"GuangzhouEvergrande":"#66DD00",
"GuangzhouR&F":"#00DD00",
"GuizhouRenhe":"#00DD77",
"HajdukSplit":"#00DDAA",
"HamburgerSV":"#00DDDD",
"Hannover96":"#009FCC",
"HapoelBe'erSheva":"#0044BB",
"Heerenveen":"#0000CC",
"HeraclesAlmelo":"#4400CC",
"Herediano":"#5500DD",
"HerthaBerlin":"#7700BB",
"HerthaBSC":"#A500CC",
"HoustonDynamo":"#CC00CC",
"HullCity":"#444444",
"Internacional":"#A20055",
"Internazionale":"#AA0000",
"?stanbulBa?ak?ehir":"#C63300",
"JeonbukHyundaiMotors":"#CC6600",
"JubiloIwata":"#AA7700",
"Juventus":"#BBBB00",
"KashiwaReysol":"#88AA00",
"KawasakiFrontale":"#55AA00",
"KayseriErciyesspor":"#00AA00",
"Kayserispor":"#00AA55",
"Konyaspor":"#00AA88",
"KubanKrasnodar":"#00AAAA",
"LasPalmas":"#0088A8",
"Lazio":"#003C9D",
"LDUQuito":"#0000AA",
"LeicesterCity":"#2200AA",
"Lekhwiya":"#4400B3",
"Lens":"#66009D",
"Leon":"#7A0099",
"Levante":"#990099",
"Libertad":"#666666",
"Lille":"#C10066",
"Liverpool":"#CC0000",
"Livorno":"#E63F00",
"Lokeren":"#EE7700",
"LokomotivMoscow":"#DDAA00",
"Lokomotiva":"#EEEE00",
"Lorient":"#99DD00",
"LosAngelesGalaxy":"#66DD00",
"Luzern":"#00DD00",
"Lyon":"#00DD77",
"Mainz05":"#00DDAA",
"Mallorca":"#00DDDD",
"MalmoFF":"#009FCC",
"MamelodiSundowns":"#0044BB",
"ManchesterCity":"#0000CC",
"ManchesterUnited":"#4400CC",
"Marseille":"#5500DD",
"MelbourneVictory":"#7700BB",
"Middlesbrough":"#A500CC",
"Milan":"#CC00CC",
"Monterrey":"#444444",
"Montpellier":"#A20055",
"Morelia":"#AA0000",
"Motagua":"#C63300",
"Nacional":"#CC6600",
"NaftTehran":"#AA7700",
"Nancy":"#BBBB00",
"Nantes":"#88AA00",
"Napoli":"#55AA00",
"NEC":"#00AA00",
"NewEnglandRevolution":"#00AA55",
"NewYorkRedBulls":"#00AA88",
"NewcastleJets":"#00AAAA",
"NewcastleUnited":"#0088A8",
"Newell'sOldBoys":"#003C9D",
"Nice":"#0000AA",
"NorwichCity":"#2200AA",
"NottinghamForest":"#4400B3",
"Olimpia":"#66009D",
"Olympiacos":"#7A0099",
"OrlandoPirates":"#990099",
"Osasuna":"#666666",
"Pachuca":"#C10066",
"Palermo":"#CC0000",
"Palmeiras":"#E63F00",
"Panathinaikos":"#EE7700",
"PAOK":"#DDAA00",
"ParisSaintGermain":"#EEEE00",
"Parma":"#99DD00",
"Persepolis":"#66DD00",
"Platanias":"#00DD00",
"Porto":"#00DD77",
"PrestonNorthEnd":"#00DDAA",
"PSV":"#00DDDD",
"Puebla":"#009FCC",
"QingdaoJonoon":"#0044BB",
"QueensParkRangers":"#0000CC",
"RealEspana":"#4400CC",
"RealMadrid":"#5500DD",
"RealSaltLake":"#7700BB",
"RealSociedad":"#A500CC",
"Reims":"#CC00CC",
"Rennes":"#444444",
"RiverPlate":"#A20055",
"Roma":"#AA0000",
"Rosenborg":"#C63300",
"Rostov":"#CC6600",
"RubinKazan":"#AA7700",
"SaintEtienne":"#BBBB00",
"Sampdoria":"#88AA00",
"SanJoseEarthquakes":"#55AA00",
"SanLorenzo":"#00AA00",
"SanfrecceHiroshima":"#00AA55",
"SangjuSangmu":"#00AA88",
"SantaFe":"#00AAAA",
"Santos":"#0088A8",
"SantosLaguna":"#003C9D",
"SaoPaulo":"#0000AA",
"Saprissa":"#2200AA",
"Sassuolo":"#4400B3",
"SCFreiburg":"#66009D",
"Schalke04":"#7A0099",
"SeattleSoundersFC":"#990099",
"Sepahan":"#666666",
"Sevilla":"#C10066",
"SeweSport":"#CC0000",
"ShakhtarDonetsk":"#E63F00",
"ShandongLunengTaishan":"#EE7700",
"Sion":"#DDAA00",
"Sochaux":"#EEEE00",
"Southampton":"#99DD00",
"SpartakMoscow":"#66DD00",
"SportingCovilha":"#00DD00",
"SportingCP":"#00DD77",
"SportingKansasCity":"#00DDAA",
"Stabak":"#00DDDD",
"StandardLiege":"#009FCC",
"StokeCity":"#0044BB",
"Stromsgodset":"#0000CC",
"SturmGraz":"#4400CC",
"Sunderland":"#5500DD",
"SunshineStars":"#7700BB",
"SuwonBluewings":"#A500CC",
"SwanseaCity":"#CC00CC",
"SwindonTown":"#444444",
"TerekGrozny":"#A20055",
"Tijuana":"#AA0000",
"Toluca":"#C63300",
"Torino":"#CC6600",
"TorontoFC":"#AA7700",
"TottenhamHotspur":"#BBBB00",
"Toulouse":"#88AA00",
"Trabzonspor":"#55AA00",
"TractorSazi":"#00AA00",
"Twente":"#00AA55",
"UANL":"#00AA88",
"Udinese":"#00AAAA",
"UlsanHyundai":"#0088A8",
"UmmSalal":"#003C9D",
"UniversidadCatolica":"#0000AA",
"UniversidaddeChile":"#2200AA",
"UrawaRedDiamonds":"#4400B3",
"USMAlger":"#66009D",
"Utrecht":"#7A0099",
"Valencia":"#990099",
"Valenciennes":"#666666",
"Valerenga":"#C10066",
"VancouverWhitecapsFC":"#CC0000",
"VascodaGama":"#E63F00",
"Verona":"#EE7700",
"VfBStuttgart":"#DDAA00",
"VfLWolfsburg":"#EEEE00",
"VfRAalen":"#99DD00",
"Villarreal":"#66DD00",
"Vitesse":"#00DD00",
"VolynLutsk":"#00DD77",
"WaaslandBeveren":"#00DDAA",
"WarriWolves":"#00DDDD",
"Watford":"#009FCC",
"WestBromwichAlbion":"#0044BB",
"WestHamUnited":"#0000CC",
"WesternSydneyWanderers":"#4400CC",
"WiganAthletic":"#5500DD",
"YokohamaF.Marinos":"#7700BB",
"YoungBoys":"#A500CC",
"ZenitSaintPetersburg":"#CC00CC",
"ZobAhan":"#444444",
"ZoryaLuhansk":"#A20055",
"ZulteWaregem":"#AA0000",
"Zurich":"#C63300"
};

// Total size of all segments; we set this later, after loading the data.
var totalSize = 0; 

var vis = d3.select("#chart").append("svg:svg")
    .attr("width", width)
    .attr("height", height)
    .append("svg:g")
    .attr("id", "container")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var partition = d3.layout.partition()
    .size([2 * Math.PI, radius * radius])
    .value(function(d) { return d.size; });

var arc = d3.svg.arc()
    .startAngle(function(d) { return d.x; })
    .endAngle(function(d) { return d.x + d.dx; })
    .innerRadius(function(d) { return Math.sqrt(d.y); })
    .outerRadius(function(d) { return Math.sqrt(d.y + d.dy); });

// Use d3.text and d3.csv.parseRows so that we do not need to have a header
// row, and can receive the csv as an array of arrays.
d3.text("visit-sequences.csv", function(text) {
  var csv = d3.csv.parseRows(text);
  var json = buildHierarchy(csv);
  createVisualization(json);
});

// Main function to draw and set up the visualization, once we have the data.
function createVisualization(json) {

  // Basic setup of page elements.
  initializeBreadcrumbTrail();
  drawLegend();
  d3.select("#togglelegend").on("click", toggleLegend);

  // Bounding circle underneath the sunburst, to make it easier to detect
  // when the mouse leaves the parent g.
  vis.append("svg:circle")
      .attr("r", radius)
      .style("opacity", 0);

  // For efficiency, filter nodes to keep only those large enough to see.
  var nodes = partition.nodes(json)
      .filter(function(d) {
      return (d.dx > 0.005); // 0.005 radians = 0.29 degrees
      });

  var path = vis.data([json]).selectAll("path")
      .data(nodes)
      .enter().append("svg:path")
      .attr("display", function(d) { return d.depth ? null : "none"; })
      .attr("d", arc)
      .attr("fill-rule", "evenodd")
      .style("fill", function(d) { return colors[d.name]; })
      .style("opacity", 1)
      .on("mouseover", mouseover);

  // Add the mouseleave handler to the bounding circle.
  d3.select("#container").on("mouseleave", mouseleave);

  // Get total size of the tree = value of root node from partition.
  totalSize = path.node().__data__.value;
 };

// Fade all but the current sequence, and show it in the breadcrumb trail.
function mouseover(d) {

  var percentage = (100 * d.value / totalSize).toPrecision(3);
  var percentageString = percentage + "%";
  
  var percentage2 = d.value;
  var percentageString2 = percentage2 ;
  
  if (percentage < 0.1) {
    percentageString = "< 0.1%";
  }

  d3.select("#percentage")
      .text(percentageString);
  d3.select("#percentage2")
      .text(percentageString2);

  d3.select("#explanation")
      .style("visibility", "");

  var sequenceArray = getAncestors(d);
  updateBreadcrumbs(sequenceArray, percentageString2);

  // Fade all the segments.
  d3.selectAll("path")
      .style("opacity", 0.3);

  // Then highlight only those that are an ancestor of the current segment.
  vis.selectAll("path")
      .filter(function(node) {
                return (sequenceArray.indexOf(node) >= 0);
              })
      .style("opacity", 1);
}

// Restore everything to full opacity when moving off the visualization.
function mouseleave(d) {

  // Hide the breadcrumb trail
  d3.select("#trail")
      .style("visibility", "hidden");

  // Deactivate all segments during transition.
  d3.selectAll("path").on("mouseover", null);

  // Transition each segment to full opacity and then reactivate it.
  d3.selectAll("path")
      .transition()
      .duration(1000)
      .style("opacity", 1)
      .each("end", function() {
              d3.select(this).on("mouseover", mouseover);
            });

  d3.select("#explanation")
      .transition()
      .duration(1000)
      .style("visibility", "hidden");
}

// Given a node in a partition layout, return an array of all of its ancestor
// nodes, highest first, but excluding the root.
function getAncestors(node) {
  var path = [];
  var current = node;
  while (current.parent) {
    path.unshift(current);
    current = current.parent;
  }
  return path;
}

function initializeBreadcrumbTrail() {
  // Add the svg area.
  var trail = d3.select("#sequence").append("svg:svg")
      .attr("width", width)
      .attr("height", 50)
      .attr("id", "trail");
  // Add the label at the end, for the percentage.
  trail.append("svg:text")
    .attr("id", "endlabel")
    .style("fill", "#000");
}

// Generate a string that describes the points of a breadcrumb polygon.
function breadcrumbPoints(d, i) {
  var points = [];
  points.push("0,0");
  points.push(b.w + ",0");
  points.push(b.w + b.t + "," + (b.h / 2));
  points.push(b.w + "," + b.h);
  points.push("0," + b.h);
  if (i > 0) { // Leftmost breadcrumb; don't include 6th vertex.
    points.push(b.t + "," + (b.h / 2));
  }
  return points.join(" ");
}

// Update the breadcrumb trail to show the current sequence and percentage.
function updateBreadcrumbs(nodeArray, percentageString) {

  // Data join; key function combines name and depth (= position in sequence).
  var g = d3.select("#trail")
      .selectAll("g")
      .data(nodeArray, function(d) { return d.name + d.depth; });

  // Add breadcrumb and label for entering nodes.
  var entering = g.enter().append("svg:g");

  entering.append("svg:polygon")
      .attr("points", breadcrumbPoints)
      .style("fill", function(d) { return colors[d.name]; });

  entering.append("svg:text")
      .attr("x", (b.w + b.t) / 2)
      .attr("y", b.h / 2)
      .attr("dy", "0.35em")
      .attr("text-anchor", "middle")
      .text(function(d) { return d.name; });

  // Set position for entering and updating nodes.
  g.attr("transform", function(d, i) {
    return "translate(" + i * (b.w + b.s) + ", 0)";
  });

  // Remove exiting nodes.
  g.exit().remove();

  // Now move and update the percentage at the end.
  d3.select("#trail").select("#endlabel")
      .attr("x", (nodeArray.length + 0.5) * (b.w + b.s))
      .attr("y", b.h / 2)
      .attr("dy", "0.35em")
      .attr("text-anchor", "middle")
      .text(percentageString);

  // Make the breadcrumb trail visible, if it's hidden.
  d3.select("#trail")
      .style("visibility", "");

}

function drawLegend() {

  // Dimensions of legend item: width, height, spacing, radius of rounded rect.
  var li = {
    w: 75, h: 30, s: 3, r: 3
  };

  var legend = d3.select("#legend").append("svg:svg")
      .attr("width", li.w)
      .attr("height", d3.keys(colors).length * (li.h + li.s));

  var g = legend.selectAll("g")
      .data(d3.entries(colors))
      .enter().append("svg:g")
      .attr("transform", function(d, i) {
              return "translate(0," + i * (li.h + li.s) + ")";
           });

  g.append("svg:rect")
      .attr("rx", li.r)
      .attr("ry", li.r)
      .attr("width", li.w)
      .attr("height", li.h)
      .style("fill", function(d) { return d.value; });

  g.append("svg:text")
      .attr("x", li.w / 2)
      .attr("y", li.h / 2)
      .attr("dy", "0.35em")
      .attr("text-anchor", "middle")
      .text(function(d) { return d.key; });
}

function toggleLegend() {
  var legend = d3.select("#legend");
  if (legend.style("visibility") == "hidden") {
    legend.style("visibility", "");
  } else {
    legend.style("visibility", "hidden");
  }
}

// Take a 2-column CSV and transform it into a hierarchical structure suitable
// for a partition layout. The first column is a sequence of step names, from
// root to leaf, separated by hyphens. The second column is a count of how 
// often that sequence occurred.
function buildHierarchy(csv) {
  var root = {"name": "root", "children": []};
  for (var i = 0; i < csv.length; i++) {
    var sequence = csv[i][0];
    var size = +csv[i][1];
    if (isNaN(size)) { // e.g. if this is a header row
      continue;
    }
    var parts = sequence.split("-");
    var currentNode = root;
    for (var j = 0; j < parts.length; j++) {
      var children = currentNode["children"];
      var nodeName = parts[j];
      var childNode;
      if (j + 1 < parts.length) {
   // Not yet at the end of the sequence; move down the tree.
 	var foundChild = false;
 	for (var k = 0; k < children.length; k++) {
 	  if (children[k]["name"] == nodeName) {
 	    childNode = children[k];
 	    foundChild = true;
 	    break;
 	  }
 	}
  // If we don't already have a child node for this branch, create it.
 	if (!foundChild) {
 	  childNode = {"name": nodeName, "children": []};
 	  children.push(childNode);
 	}
 	currentNode = childNode;
      } else {
 	// Reached the end of the sequence; create a leaf node.
 	childNode = {"name": nodeName, "size": size};
 	children.push(childNode);
      }
    }
  }
  return root;
};