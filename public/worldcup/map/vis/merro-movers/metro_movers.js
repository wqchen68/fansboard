(function() {

	'use strict';

	// load data
	d3.csv('../lib/data/metros.csv', function(metrosLookup) {
		d3.csv('metro_movers_data_v2.csv', function(metrosData) {
			var packer = sm.packer();
			
			var currDir = 'in',
				currMetro = 41884;
			
			// put circles on map (standard radius)
			var svg = d3.select('#content').append('svg')
					.attr('width', 1920)
					.attr('height', 965);
                                        
			
			var states = svg.append('g')
					.attr('width', 1920)
					.attr('height', 965)
                                        .attr('id', 'states');
						
			svg.append('g')
                                .attr('width', 1920)
                                .attr('height', 965)
				.attr('id', 'metros');
			
			svg.append('g')
                                .attr('width', 1920)
                                .attr('height', 965)
				.attr('id', 'temp');
			
			// draw state outlines
			var path = d3.geo.path();
			d3.json("../lib/data/us_states_shapes.json", function(json) {
				states.selectAll("path")
					.data(json.features)
					.enter().append("path")
					.attr("d", path);
			});
						
			// generate list of all metros (both primary and related)	
			var metrosPrimary = [],
				metrosRelated = [];
				
			for (var i = 0; i < metrosData.length; i++) {
				metrosPrimary.push(parseInt(metrosData[i].metro_id));
				metrosRelated.push(parseInt(metrosData[i].rel_metro_id));
			}

			// remove duplicates
			metrosPrimary = sortedAndDeDuped(metrosPrimary);
			metrosRelated = sortedAndDeDuped(metrosRelated);
			
			var metrosCombined = sortedAndDeDuped(metrosPrimary.concat(metrosRelated));
			
			// add metro circles to the map
			addCirclesToMap(metrosCombined, 3);
			
			// mark primary metros and make them bigger
			for (var i = 0; i < metrosPrimary.length; i++) {
				d3.select('#metro_' + metrosPrimary[i])
					.classed('related', false)
					.classed('primary', true)
					.on('click', function(e) {
						d3.selectAll('#temp text').remove();
						currMetro = parseInt(d3.select(this).attr('id').split('metro_').join(''));
						sizeMetros(currMetro, currDir);
					})
					.select('circle').attr('r', 5);
			}
			
			d3.selectAll('#metros .metro')
				.on('mouseover', function(e) {
					if (!packer.animating) {
						var g = d3.select(this),
							transform = g.attr('transform'),
							c = g.attr('class'),
							l = g.select('text'),
							t = l.text();
						
						var newEle = d3.select('#temp').append('g')
							.attr('class', c)
							.attr('transform', transform);
						
						newEle.append('text')
								.attr('y', 3)
								.text(t);
					}
				})
				.on('mouseout', function(e) {
					d3.selectAll('#temp g').remove();
				
				
				});
			
			
			sizeMetros(currMetro, currDir);
	
			// **********************************************
			
			$('input[name="dir"]').change(function() {
				currDir = $(this).val();
				sizeMetros(currMetro, currDir);
			});

			$("#controls .radio label").click(function() {
				$("#controls .radio label").removeClass("sel");
				$(this).addClass("sel");
			});
			
			var dirDescriptions = {
				in: 'Based on the number of inbound home searches <br/>to a metro area by out-of-towners',
				out: 'Based on the number of outbound home <br/>searches from a metro by locals'
			}
			
			$('#controls .radio label').hover(function() {
				var dir = $(this).attr('for').split('dir_').join(''),
					msg = dirDescriptions[dir],
					pos = $(this).position();
				
				pos.top += 32;
				
				updateToolTip(msg, pos);
			}, function() {
				$('#dir_tooltip').hide();
			});
			
			function updateToolTip(msg, pos) {
				$('#dir_tooltip .text').html(msg);
				$('#dir_tooltip').css('left', pos.left).css('top', pos.top);
				$('#dir_tooltip').show();
				
			}
			
			
	
			// **********************************************
			
			function sortNumber(a, b) {
				return a - b;
			}
			
			// **********************************************
			
			function sortedAndDeDuped(a) {
			
				a = a.sort(sortNumber);
			
				var trimmed = [];
				for (var i = 0; i < a.length; i++) {
					if (a[i] !== a[i - 1]) {
						trimmed.push(a[i]);
					}
				}
				return trimmed;
			}
		
			// **********************************************
			
			function getMetro(id) {
							
				var result = null;
				
				for (var i = 0; i < metrosLookup.length; i++) {
					var metro = metrosLookup[i];
					if (parseInt(metro.id) === parseInt(id)) {
						result = metro;
					}
				}
				return result;
			}
		
			
			// **********************************************
			
			function addCirclesToMap(a, r) {
			
				var pixelLoc = d3.geo.albersUsa();
		
				for (var i = 0; i < a.length; i++) {
					var metro = getMetro(a[i]);
					
					if (metro) {
						var xy = pixelLoc([metro.lon, metro.lat]);
						
						var element = d3.select('#metros').append('g')
							.attr('transform', 'translate(' + Math.round(xy[0]) + ',' + Math.round(xy[1]) + ')')
							.attr('r', r)
							.attr('id', 'metro_' + metro.id)
							.attr('class', 'metro related');
						
						element.append('circle')
							.attr('r', r);
						
						var useName = metro.familiar_name;
						
						if (metro.state === 'DC') {
							useName = metro.familiar_name + ', ' + metro.state;	
						}
						
						var t = element.append('text')
							.attr('y', 3)
							.text(useName);
							//.text(metro.familiar_name); // + ', ' + metro.state);
							
						//element.attr('r', t.node().getBBox().width);

					}
				}
			}
			
			// **********************************************
			
			function sizeMetros(metroId, dir) {
				
				var minSize = 5,
					maxSize = 70,
					scale = d3.scale.linear()
						.domain([0.3, 5.2])
						.range([minSize, maxSize]);
				
				// return circles to starting size
				d3.selectAll('#metros .metro')
					.classed('sel_primary', false)
					.classed('sel_related', false)
					.classed('in', false)
					.classed('out', false);
				
				d3.selectAll('#metros .metro.primary')
					.attr('r', 5)
					.select('circle')
						.attr('r', 5);
				
				d3.selectAll('#metros .metro.related')
					.attr('r', 3)
					.select('circle')
						.attr('r', 3);
				
				// size primary metro
				d3.select('#metro_' + metroId)
					.attr('r', 40)
					.classed('sel_primary', true)
					.select('circle')
						.attr('r', 40);
				
				// loop through data and size metros related to primary
				for (var i = 0; i < metrosData.length; i++) {
					var d = metrosData[i],
						r = scale(Math.sqrt(d.val / Math.PI));
					
					if (parseInt(d.metro_id) === metroId && d.dir === dir) {						
						var elem = d3.select('#metro_' + d.rel_metro_id);
							
						elem.classed('sel_related', true)
							.attr('r', r)
							.classed(dir, true)
							.select('circle')
								.attr('r', r);
						
						//var textWidth =  elem.select('text').node().getBBox().width;
						
						//if (r < textWidth / 2) {
						//	elem.attr('r', textWidth / 2);
						//}
					
						
						
					}
				}
				packMetros();
			}
			
			// **********************************************
			
			function packMetros() {
			
				var elements = d3.selectAll('#metros .metro')[0];
				
				packer.elements(elements).start();
			
			}
						
			
			// **********************************************
			
		});
	});
	
	// **********************************************
			
	
	
	
/*	}*/
	
})();