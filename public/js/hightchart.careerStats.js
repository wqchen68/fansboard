$(function(){
	
	var player = [];
	
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
	
	pageobj.on('change','.items',function(){
			if( player.length>0 )
				change();
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
				
            var location = window.location;            
            url = playerInit.length>0
                ? ('/'+location.pathname.split('/')[1])+'/'+playerInit.join(',')+'?cate='+pageobj.find('.items').val()
                : location.toString();
            window.history.pushState('', '', url);
            
			changePlayerImg();
			change();
		}
	};
	funcArray[pageIndex].reflash = reflash;	
	
	
	pageobj.on('change','.items',function(e){
		if( pageobj.find('.items').val()!=='ceff' ){
			$('input.show36').prop('checked',false);
			$('input.show36').prop('disabled',true);
		}else{
			$('input.show36').prop('checked',true);
			$('input.show36').prop('disabled',false);
		}
		if( playerInit.length > 0 )
			reflash();
	});
	
	//var colors = ['#00BBFF','#FF0088','#00FF00','#FFFFFF'];
	var color = ['rgba(0,187,255,1)','rgba(255,0,136,1)','rgba(0,255,0,1)','rgba(255,255,255,1)'];
	//var color36 = ['#00BBFF','#FF0088','#00FF00','#FFFFFF'];
	var color36 = ['rgba(0,187,255,0.4)','rgba(255,0,136,0.4)','rgba(0,255,0,0.4)','rgba(255,255,255,0.4)'];

	var chart_box = pageobj.find('.chart_box');
	var show36 = $('<div style="position:absolute; top:20px; right:70px; font-size:12px"><input class="show36" id="show36" type="checkbox" checked="checked" /><label for="show36">Show 36 Mins (Transparent Line)</label></div>');
	var isShow36 = show36.children('input').is(':checked');
	
	show36.on('click','input',function(e){
		isShow36 = $(this).is(':checked');		
		for(var key in chartCareerStats.series){
			if( chartCareerStats.series[key].name.search('(36)')!==-1 ){
				if( isShow36 ){
					chartCareerStats.series[key].show();					
				}else{
					chartCareerStats.series[key].hide();
				}
			}
		}
	});	
    
	function changePlayerImg(){		
		pageobj.find('.majorbox img.face').attr('src','/player/none.jpg');
		if( player.length>0 ){
			pageobj.find('.majorbox .face').attr('src','/player/'+player[0].fbid+'.png');
			pageobj.find('.link-playerAbility').attr('href','/playerAbility/'+player[0].fbid);
		}
	};

	pageobj.find('.basic1,.basic2,.basic3,.stat').empty();
    
    function change(){

        $.getJSON('/data/getCareerStats',{player: player,items: pageobj.find('.items').val()},function(data){

            console.log(data);
            pageobj.find('.link-playerAbility').changePlayerImg(data['card'][0]);

			/*pageobj.find('.basic1').html(data.basic[0]);
			pageobj.find('.basic2').html(data.basic[1]+'&nbsp-&nbsp'+data.basic[2]);
			pageobj.find('.basic3').html(data.basic[3]);
			pageobj.find('.stat').html(data.stat[0]+' pts,  '+data.stat[1]+' reb,  '+data.stat[2]+' ast');*/
			
			$('#tablecareerstat').children('tbody').find('tr').remove();
			
			for( var i in data['table'] ){
				
				var tablerow = data['table'][i];
				
				var scoreTable = $('<tr class="report-detail" />').appendTo('#tablecareerstat tbody');
				
				for( var j in tablerow ){
					scoreTable.append('<td>'+tablerow[j]+'</td>');
				}
			}
			
			
			var series_size = chartCareerStats.series.length;

			if( series_size>0 )
			for( i=0;i<series_size;i++ ){
				if( chartCareerStats.series[0] )
				chartCareerStats.series[0].remove(false);
			}		
			
			chartCareerStats.xAxis[0].setCategories(data['label']);	
			chartCareerStats.redraw();
			
			var k = 0;
			for(var key in data['career']){
				chartCareerStats.addSeries({ 	
					name: key,
					color: color[k%4],
					type: 'line',
					yAxis: 0,
					marker: {
                        fillColor: 'rgba(255,255,255,0.5)'
					},
					data: data['career'][key]
				},false);
				k++;
			}
			
			var k = 0;
			for(var key in data['ctime']){
				chartCareerStats.addSeries({ 	
					name: key,
					showInLegend: false,
					color: color[k%4],
					type: 'column',
					yAxis: 1,
					marker: {
                        fillColor: 'rgba(255,255,255,0.5)'
					},
					data: data['ctime'][key],
					index: 1000-k
				},false);
				k++;
			}
			
			var k = 0;
			if( pageobj.find('.items').val()==='ceff' )
			for(var key in data['career36']){
				chartCareerStats.addSeries({ 	
					name: key+'(36)',
					showInLegend: false,
					color: color36[k%4],
					type: 'line',
					yAxis: 0,
					marker: {
                        fillColor: 'rgba(255,255,255,0.1)'
					},
					visible: $('#show36').is(':checked'),
					data: data['career36'][key]
				},false);
				k++;
			}
			
			if( pageobj.find('.items').val()==='ceff' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,5,10,15,20,25,30,35],
                    min: -13.3,
                    title:{
                        text: 'Efficiency'
                    }                    
				});
            }else if( pageobj.find('.items').val()==='cmin' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,12,24,36,48],
                    min: -18,
                    title:{
                        text: 'Minutes'
                    }                    
				}); 
            }else if( pageobj.find('.items').val()==='cpts' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,10,20,30,36],
                    min: -13.5,
                    title:{
                        text: 'Points'
                    }                    
				});                 
            }else if( pageobj.find('.items').val()==='cfgp' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0.3,0.4,0.5,0.6],
                    min: 0.186,
                    title:{
                        text: 'Field Goal (%)'
                    }                    
				});
            }else if( pageobj.find('.items').val()==='cftp' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0.5,0.6,0.7,0.8,0.9,1],
                    min: 0.313,
                    title:{
                        text: 'Feww Throw (%)'
                    }
				});
            }else if( pageobj.find('.items').val()==='c3ptp' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,0.05,0.1,0.15,0.2,0.25,0.3,0.35,0.4,0.45,0.5],
                    min: -0.187,
                    title:{
                        text: '3-Point Shot (%)'
                    }
				});
            }else if( pageobj.find('.items').val()==='cfgm' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,3,5,7,9,11,13],
                    min: -4.95,
                    title:{
                        text: 'Field Goals Made'
                    }
				});
            }else if( pageobj.find('.items').val()==='cftm' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,2,4,6,8,10],
                    min: -3.8,
                    title:{
                        text: 'Free Throws Made'
                    }
				});
            }else if( pageobj.find('.items').val()==='c3ptm' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,0.5,1,1.5,2,2.5,3,3.5],
                    min: -1.33,
                    title:{
                        text: '3-point Shots Made'
                    }
				});                
            }else if( pageobj.find('.items').val()==='cfga' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,7,14,21,28],
                    min: -10.5,
                    title:{
                        text: 'Field Goals Attempted'
                    }
				});
            }else if( pageobj.find('.items').val()==='cfta' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12],
                    min: -4.6,
                    title:{
                        text: 'Free Throws Attempted '
                    }
				});
            }else if( pageobj.find('.items').val()==='c3pta' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9],
                    min: -3.4,
                    title:{
                        text: '3-point Shots Attempted'
                    }
				});
            }else if( pageobj.find('.items').val()==='coreb' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3,4,5,6],
                    min: -2.25,
                    title:{
                        text: 'Offensive Rebounds'
                    }
				});
            }else if( pageobj.find('.items').val()==='cdreb' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12],
                    min: -4.6,
                    title:{
                        text: 'Defense Rebounds'
                    }
				});                
            }else if( pageobj.find('.items').val()==='ctreb' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12,15],
                    min: -5.7,
                    title:{
                        text: 'Rebounds'
                    }
				});                
            }else if( pageobj.find('.items').val()==='cast' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,3,6,9,12],
                    min: -4.57,
                    title:{
                        text: 'Assists'
                    }
				});
            }else if( pageobj.find('.items').val()==='cst' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3],
                    min: -1.14,
                    title:{
                        text: 'Steals'
                    }
				});                
            }else if( pageobj.find('.items').val()==='cblk' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3,4],
                    min: -1.5,
                    title:{
                        text: 'Blocks'
                    }
				});               
            }else if( pageobj.find('.items').val()==='catr' || pageobj.find('.items').val()==='cpf'  || pageobj.find('.items').val()==='cto' ){
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,1,2,3,4,5],
                    min: -1.87,
                    title:{
                        text: 'Value'
                    }                    
				});
			}else{
				chartCareerStats.yAxis[0].update({
					tickPositions: [0,data['valueMax']/4,data['valueMax']/2,3*data['valueMax']/4,data['valueMax']],
                    min: -0.38*data['valueMax'], //0.38是比例
                    title:{
                        text: 'Value'
                    }
				});            
			}
            
            chartCareerStats.xAxis[0].update({
                labels:{
                    step: (data.label.length>12 ? 2 : 1)
                }                    
            });            
            
			chartCareerStats.redraw();
            
			chartCareerStats.options.exporting.filename='CareerStats#'+player[0].fbid;
			
		}).error(function(e){
            console.log(e);
		});
    }
	
	
	var chartCareerStats = new Highcharts.Chart({

           chart: {
			   renderTo: chart_box.get(0),
				alignTicks: false,				
                width: 896,        
                height: 600,                
                zoomType: 'xy',
                borderColor: 'rgba(0,0,0,0.0)',
    	        borderRadius: 0,
	            borderWidth: 0,
                type: 'column',
                plotBorderColor: '#888',
                plotBorderWidth: 1,
				backgroundColor: 'rgba(0,0,0,0.6)',
                marginTop: 50
            },
			credits: {
                enabled: false
            },
            title: {
                text: 'Season Performance',
                y: 20,
            },
//			subtitle: {
//                text: '(Transparent Line: 36 Mins EFF)'
//            },
            legend: {
                //layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -60,
                y: 40
            },
			plotOptions: {
				column: {
					stacking: 'normal',
					pointWidth: 30,
					borderColor: '#888',
					borderWidth: 2
				},
            	series: {
					lineWidth: 3,
					allowPointSelect: false,
					marker: {
						symbol: 'circle',
						radius: 10,
                        lineWidth: 3,
                        lineColor: null
					},
					states: {
                    	hover: {
                        	enabled: true,
							lineWidth: 5,
							marker:{
								enabled: true,
			                    radius: 5
							}
	                    }
					}
	            }
    	    },
			tooltip: {
	        	snap: 5,
				animation: false,
	        	backgroundColor: '#000',
	        	borderColor: '#fff',
            	borderWidth: 1,
	        	borderRadius: 7,
            	shadow: false,
				hideDelay: 0,
				shared: false,
				positioner: function () {
            		return { x: 70, y: 60 };
                }
            	//enabled: false
	    	},
            xAxis: {
                labels: {
                    rotation: 0,
					style: {},
                    staggerLines: 1
                },
                tickmarkPlacement: 'on',
            },
            yAxis: [{
				id: 0,
				title: {
					text: 'Value',
					style: {},
					align: 'high',
	                y: 120
                },
				tickPositions: [0,5,10,15,20,25,30,35],
		        startOnTick: false,
                min: -13.3
            },{
				id: 1,
				title: {
					text: 'Games',
					style: {},
					align: 'low',
	                y: -100		
                },
				tickPositions: [0,20,40,60,82],
                endOnTick: false,
				max: 300,
				plotLines: [{
                    color: '#fff',
                    width: 2,
                    value: 82
                }],
				opposite: true
			}],
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: [{
                            text: 'Download Graph (PNG)',
                            onclick: function () {
                                this.exportChart({
                                    width: 896,
                                    type: 'image/png'
                                });
                            }
                        },{
                            text: 'Download Graph (PDF)',
                            onclick: function () {
                                this.exportChart({
                                    width: 896,
                                    type: 'application/pdf'
                                });
                            }
                        }]
                    }
                },
            },
            navigation: {
                buttonOptions: {
                    enabled: true,
//                    align: 'center',
//                    x:100,
    //                height: 20,
    //                width: 24,
    //                symbolSize: 14,
    //                symbolX: 12.5,
    //                symbolY: 10.5,
    //                symbolStroke: '#666',
    //                symbolStrokeWidth: 1,
                }
            },
		});
		
		show36.appendTo(chartCareerStats.container);


});
