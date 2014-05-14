$(function(){
    
    var player = [];
	var team;
	
	pageobj.bind('startjs',function(){
		pageobj.trigger('init');
	});
	
	pageobj.bind('init',function(){
		$('.modelBox .playerList-combo').removeClass('muti');
		if( playerInit.length > 0 ){
			$('.sign-btn').removeClass('active');
			$('.muti-btn').removeClass('active');
			var target = $('.sign-btn[value='+playerInit[0]+']');
			target.addClass('active');
			target.children('.muti-btn').addClass('active');
			reflash();
		}
	});
	
	pageobj.on('change','.player_season',function(){
		$('.modelBox .playerList-combo').getPlayerList2(playerInit,function(){
			if( player.length>0 )
				change();
		});
	});
	
	var reflash = function(){	
		player = pageobj.find('.playerList-combo td.active').getPlayer();
		if( player.length>0 ){
			indexof = $.inArray( player[0].fbid, playerInit );
			if( indexof!==-1 ){
				var from = playerInit.slice(0,indexof);
				var to = playerInit.slice(indexof+1);
				from.push.apply(from,to);
				from.splice(0, 0, player[0].fbid);
				playerInit = from;
			}else{
				playerInit[0] = player[0].fbid;
			}
				
			url = playerInit.length>0
				? window.location.toString().split('?')[0]+'?player='+playerInit.join('+')
				: window.location.toString().split('?')[0];
			window.history.pushState('', '', url);
			
			changePlayerImg();		
			change();
		}
	};
	funcArray[pageIndex].reflash = reflash;	
	
	function changePlayerImg(){		
		pageobj.find('.majorbox img.face').attr('src','player/none.jpg');
		if( player.length>0 ){
			pageobj.find('.majorbox .face').attr('src','player/'+player[0].fbid+'.png');
			pageobj.find('.link-playerAbility').attr('href','playerAbility?player='+player[0].fbid);
		}
	};
	
	pageobj.find('.basic1,.basic2,.basic3,.stat').empty();
	
	function change() {
		$.getJSON('data/getSplitStats',{player:player,datarange:pageobj.find('.player_season').val()},function(data){
			
			
			pageobj.find('.link-playerAbility').changePlayerImg(data['card'][0]);
			
			/*pageobj.find('.basic1').html(data.basic[0]);
			pageobj.find('.basic2').html(data.basic[1]+'&nbsp-&nbsp'+data.basic[2]);
			pageobj.find('.basic3').html(data.basic[3]);
			pageobj.find('.stat').html(data.stat[0]+' pts,  '+data.stat[1]+' reb,  '+data.stat[2]+' ast');*/
			
			$('#tablesplitdata').children('tbody').find('tr').remove();
			
			for( var i in data['table'] ){
				var tablerow = data['table'][i];
				
				var scoreTable = $('<tr class="report-detail" />').appendTo('#tablesplitdata tbody');
				
				for( var j in tablerow ){
					scoreTable.append('<td>'+tablerow[j]+'</td>');
				}
			}
			
			var series_size = chartHomeAway.series.length;
			if( series_size>0 )
				for( i=0;i<series_size;i++ ){
					if( chartHomeAway.series[0] )
						chartHomeAway.series[0].remove(false);
				}
			chartHomeAway.counters.color = 0;
			chartHomeAway.addSeries({
                name: '',
                data: data.spstat.HomeAway
			},true);			
			
			var series_size = chartDayNight.series.length;
			if( series_size>0 )
				for( i=0;i<series_size;i++ ){
					if( chartDayNight.series[0] )
						chartDayNight.series[0].remove(false);
				}
			chartDayNight.counters.color = 0;
			chartDayNight.addSeries({
                name: '',
                data: data.spstat.dayNight
			},true);
			
			var series_size = chartRestDays.series.length;
			if( series_size>0 )
				for( i=0;i<series_size;i++ ){
					if( chartRestDays.series[0] )
						chartRestDays.series[0].remove(false);
				}
			chartRestDays.counters.color = 0;
			chartRestDays.addSeries({
                name: '',
                data: data.spstat.Rest
			},true);
			
			var series_size = chartOppo.series.length;
			if( series_size>0 )
				for( i=0;i<series_size;i++ ){
					if( chartOppo.series[0] )
						chartOppo.series[0].remove(false);
				}
			chartOppo.counters.color = 0;
			chartOppo.addSeries({
                name: player[0]['name'],
                data: data.spstat.VS
			},true);
			
			chartOppo.xAxis[0].setCategories(data.spstat.VSTeam);
			
		});
	}
	
	var columnOption = {
		chart: {
			type: 'column',
			height: 270,
			width: 293,
			borderColor: 'rgba(0,0,0,0.0)',
			borderRadius: 0,
			borderWidth: 0,
			plotBorderColor: '#888',
			plotBorderWidth: 1,
			backgroundColor: 'rgba(0,0,0,0.0)'
		},
		title: {
			align: 'center'
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				pointPadding: 0,
				allowPointSelect: false
			}
    	},
		xAxis: {
			tickWidth: 0,
			tickmarkPlacement: 'on',
			gridLineWidth: 0,
			startOnTick: true,
			staggerLines: 1, //labe行數
			lineWidth: 0                
		},
		yAxis: {
			title: {
				text: 'EFF Value',
				style: {
						color: '#fff'
				},
			},
			tickPositions: [0,5,10,15,20,25,30,35],
			max: 35,
			min: 0,
			startOnTick: false,
			gridLineColor: '#888',
			gridLineDashStyle: 'Dot',
			gridLineWidth: 1
		},
		credits: {
			enabled: false
		}
	};
	
	
	var chartHomeAway = new Highcharts.Chart( 
		$.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats1').get(0)
            },
            title: {
                text: 'Home/Away',
				enabled: false
            },
			legend: {
				enabled: false
			},
            xAxis: {
                categories: ['@Home', '@Away']              
            },
            series: []
		})
	);		
		
	var chartDayNight = new Highcharts.Chart( 
		$.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats3').get(0)
            },
            title: {
                text: 'Day/Night'
            },
			legend: {
				enabled: false
			},			
            xAxis: {
                categories: ['Day', 'Night']            
            },
            series: []
		})
	);
		
	var chartRestDays = new Highcharts.Chart( 
		$.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats2').get(0)
            },
            title: {
                text: 'Rest Days'
            },
			legend: {
				enabled: false
			},			
            xAxis: {
                categories: ['0', '1', '2', '3+']           
            },
            series: []
		})
	);

	var chartOppo = new Highcharts.Chart( 
		$.extend(true,{}, columnOption, {
            chart: {
                renderTo: $('#chart_splitstats4').get(0),
				height: 330,
				width: 895
            },
            title: {
                text: 'vs 29 Teams'
            },
            xAxis: {
				labels: {
                    rotation: 0,
					style:{
						fontWeight: 'normal'
					}
				},
                categories: []
            },
            yAxis: {
                tickPositions: [0,5,10,15,20,25,30,35,40,45,50],
                max: 50,
                min: 0
            },
            series: []
		})
	);


});