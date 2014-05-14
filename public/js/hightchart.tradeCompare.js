$(function () {
	

	  
	var anglename = {0:'WFT%',45:'3PTM',90:'AST',135:'ST',180:'WFG%',225:'BLK',270:'REB',315:'PTS'};
	var playerA = [];
	var playerB = [];
	var changing_index = 0;
	
	
	$('#player_season').change(function(){
		if( player.length>0 )
			change();
	});

	var reflash = function(){		
		playerA = pageobj.find('.mutselecttable td.active').getPlayer();
		playerB = pageobj.find('.mutselecttableB td.active').getPlayer();		
		if( playerA.length>0 && playerB.length>0 )	
			change();
	};
	pageobj.on('click','.playerList td,.playerListB td',reflash);	
	funcArray[pageIndex].reflash = reflash;	
	
	function change(){
		
		console.log(changing_index);

		
		changing_index++;
		var changing_index_in = changing_index;
		
		var series_size = chart1.series.length;			
		if( series_size>0 )
		for( i=0;i<series_size;i++ ){
			if( chart1.series[0] )
			chart1.series[0].remove(false);
		}
		chart1.counters.color = 0;
		
				
		$('#tabledata').children('tbody').find('tr').remove();
		
		$.getJSON('data/getTradecompare',{'playerA':playerA,'playerB':playerB,'datarange':$('#player_season').val()},function(data){
			console.log(data);

			if( changing_index_in===changing_index ){
				
				chart1.addSeries({ 	
					type: 'area',
					name: 1,
					data: data.tradecompareA,
					fillOpacity: 0.4,
					marker: {
						enabled:false,
						radius:0,
						symbol: 'circle'
					}  	
				},false);
				chart1.addSeries({ 	
					type: 'area',
					name: 2,
					data: data.tradecompareB,
					fillOpacity: 0.4,
					marker: {
						enabled:false,
						radius:0,
						symbol: 'circle'
					}  	
				},false);
				console.log(1000);
				
				/*
				$('#table').children('tbody').children('tr').children('th').html(player[0].name);	
				var scoreTable = $('#table').children('tbody').children('tr').children('td');			
				for( var j=0;j<data.table.length;j++ ){
					scoreTable.eq(j).html(data.tableA[i][j]);
				}
							
				var scoreTable = $('<tr />').appendTo('#tabledata tbody');
				scoreTable.append('<th>'+player[0].name+'</th>');	
							
				for( var j=0;j<data.tableA.length;j++ ){
					scoreTable.append('<td  style="text-align: right;padding-right:5px">'+data.tableA[i][j]+'</td>');
				}
				*/
				
			}

			chart1.redraw();		
			
		}).error(function(e){
			console.log(e);
		});
		
		
	}
	

	chart1 = new Highcharts.Chart({
		
	    chart: {
			renderTo: $('#container1').get(0),
	        polar: true,
			animation: {
                duration: 500
            },
            borderColor: '#000000',
			height:600,
            borderRadius: 0,
            borderWidth: 0
	    },
		
		legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'bottom',
                x: 0,
                y: 0,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#000000',
                shadow: false
        },
		
		credits: {
            enabled: false
        },
	    
	    title: {
	        text: ''
	    },
	    
	    pane: {
	        startAngle: 0,
	        endAngle: 360
	    },
	
	    xAxis: {
	        tickInterval: 45,
			gridLineDashStyle: 'Dot',
	        min: 0,
	        max: 360,
	        labels: {
				formatter: function () {					
	        		return anglename[this.value];
	        	},
				style: {
					color: '#ffffff'
				}
	        }
			
	    },
	        
	    yAxis: {
			
	        tickInterval: 5,
            showFirstLabel: false,
	        min: 0,
			max: 5
	    },
	    
	    plotOptions: {
	        series:{
	            pointStart: 0,
	            pointInterval: 45,
                lineWidth: 1,
                shadow: false,
				animation:{
					duration: 100
				}
			},
	        column:{
	            pointPadding: 0,
	            groupPadding: 0
			},
			area:{
				fillOpacity:0.3
			}			
		},
		
		tooltip: {
	        snap: 5,
			animation: false,
	        backgroundColor: '#000000',
	        borderColor: '#ffffff',
            borderWidth: 1,
			positioner: function () {				
            	return { x: 10, y: 10 };
            },
            shadow: false,
			hideDelay: 0,			
			shared: true,
			formatter: function () {				
				var s = '<b>'+ anglename[this.x] +'</b>';
				$.each(this.points, function(i, point) {
				s += '<br/><span style="color:'+point.series.color+'">'+ point.series.name +'</span>: '+
				point.y;
                });
				return s;
			}
		},
		
		series: [0]
		
	});	
	
	function getRank(get_array){
		
		get_array = $.map( $('input[name=cate]:checked'),function(a){ 
			return $(a).val(); 
		});	
		
		$.getJSON('data/getRank',{'get_array':get_array,'player':player,'datarange':$('#player_season').val()},function(data){
			console.log('rank');
			console.log(data);
			
			$('#rank1').html(data[0]);
			if(data.length>1)
			$('#rank2').html(data[1]);
			
		}).error(function(e){
			console.log(e);
		});
	}
	
	function changePlayerImg(){		
		$('img.face').attr('src','player/none.jpg');
		if( player.length>0 ){
			$('#playerteamA').attr('src','figure/'+player[0].team+'.jpg');
			$('#playerface0').attr('src','player/'+player[0].fbid+'.png');
			if( player.length>1 ){
				$('#playerface1').attr('src','player/'+player[1].fbid+'.png');
				$('#playerteamB').attr('src','figure/'+player[1].team+'.jpg');
				$('#player2').show();
			}else{
				$('#player2').hide();
			}
		}
	};
	
	function reFlashNews(){
		$('table.news td').empty();
		$.get('data/getNews',{'player':player},function(data){
			console.log('news');
			console.log(data);
			$('#newsA1').html(data[0][0]);
			$('#newsA2').html(data[0][1]);
			$('#newsA3').html(data[0][2]);
			
			if( player.length>1 ){
			$('#newsB1').html(data[1][0]);
			$('#newsB2').html(data[1][1]);
			$('#newsB3').html(data[1][2]);
			}
			
		},'json').error(function(e){
			console.log(e);
		});		
	}
	
});