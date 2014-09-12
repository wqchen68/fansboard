function creatRadarChart(){
	var anglename = {0:'FT% *',45:'3PTM',90:'AST',135:'ST',180:'FG% *',225:'BLK',270:'REB',315:'PTS'};
	return new Highcharts.Chart({
		
	    chart: {
			renderTo: $('#container1').get(0),
	        polar: true,
			animation: {
                duration: 500
            },
            borderColor: '#fff',
			height:600,
            width:600,
            borderRadius: 0,
            borderWidth: 0
	    },

		legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'bottom',
            x: -10,
            y: -20
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
        
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Download the Graph (PNG)',
                        onclick: function () {
                            this.exportChart({
                                width: 600,
                                type: 'image/png'
                            });
                        }
                    },{
                        text: 'Download the Graph (JPG)',
                        onclick: function () {
                            this.exportChart({
                                width: 600,
                                type: 'image/jpeg'
                            });
                        }
                    }]
                }
            }
        },
        navigation: {
            buttonOptions: {
                enabled: true
//                align: 'center',
//                x:100,
//                height: 20,
//                width: 24,
//                symbolSize: 14,
//                symbolX: 12.5,
//                symbolY: 10.5,
//                symbolStroke: '#666',
//                symbolStrokeWidth: 1,
            }
        },       
	
	    xAxis: {
	        tickInterval: 45,
            gridLineColor: 'rgba(255,255,255,0.6)',
	        min: 0,
	        max: 360,
            lineColor: '#CCC',
            lineWidth: 1,
	        labels: {
				formatter: function () {					
	        		return anglename[this.value];
	        	},
				style: {
                    color:'#CCC',
                }
	        }			
	    },
	        
	    yAxis: {
	        tickInterval: 5,
            showFirstLabel: false,
	        min: 0,
			max: 5,
			plotBands: [{
                from: 0,
                to: 360,
                color: 'rgba(0, 0, 0, 0.6)'
            }]
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
				//fillOpacity:0.0
			}			
		},
		
		tooltip: {
	        snap: 5,
			animation: false,
	        backgroundColor: '#000',
	        borderColor: '#fff',
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
}