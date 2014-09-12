$(function(){
	
    var player = [];
    var oppo;

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
	
    pageobj.on('change','select[name=player_season]',function(){
        if( player.length>0 )
            reflash();
        //$('.modelBox .playerList-combo').getPlayerList2(playerInit,function(){
            
        //});
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
                ? ('/'+location.pathname.split('/')[1])+'/'+playerInit.join(',')+'?season='+pageobj.find('select[name=player_season]').val()
                : location.toString();
            window.history.pushState('', '', url);

            changePlayerImg();		
            change();
        }
    };
    funcArray[pageIndex].reflash = reflash;	
	
	
    function changePlayerImg(){		
        pageobj.find('.majorbox img.face').attr('src','/player/none.jpg');
        if( player.length>0 ){
            pageobj.find('.majorbox .face').attr('src','/player/'+player[0].fbid+'.png');
            pageobj.find('.link-playerAbility').attr('href','/playerAbility/'+player[0].fbid);
        }
    };
	
    pageobj.find('.basic1,.basic2,.basic3,.stat').empty();
	
    function change(){
        $.getJSON('/data/getLog',{player:player,datarange:pageobj.find('select[name=player_season]').val()},function(data){
			
            pageobj.find('.link-playerAbility').changePlayerImg(data[0]['card'][0]);
			
            /*pageobj.find('.basic1').html(data[0].card[0]);
            pageobj.find('.basic2').html(data[0].basic[1]+'&nbsp-&nbsp'+data[0].basic[2]);
            pageobj.find('.basic3').html(data[0].basic[3]);
            pageobj.find('.stat').html(data[0].stat[0]+' pts,  '+data[0].stat[1]+' reb,  '+data[0].stat[2]+' ast');*/
				
            $('#tableGamelog').children('tbody').find('tr').remove();

            for( var i in data[0]['table'] ){
                
                var tablerow = data[0]['table'][i];				
                var scoreTable = $('<tr class="report-detail"/>').appendTo('#tableGamelog tbody');

                for( var j in tablerow ){
                    //scoreTable.append('<td>'+tablerow[j]+'</td>');
                    if (j=='score'| j=='goppo'){
                            scoreTable.append('<td style="text-align:left">'+tablerow[j]+'</td>');
                    }else{
                            scoreTable.append('<td>'+tablerow[j]+'</td>');
                    }
                }
            }
            /*
            for( var j=0;j<data.table[i].length;j++ ){
                    //scoreTable.eq(j).html(data.table[i][j]);
            }

            var scoreTable = $('<tr />').appendTo('#tableGamelog tbody');
            scoreTable.append('<th class="report-detail">'+player[i].name+'</th>');
            */

            var series_size = chart.series.length;

            if( series_size>0 )
            for( i=0;i<series_size;i++ ){
                if( chart.series[0] )
                chart.series[0].remove(false);
            }
			
            chart.addSeries({
                type: 'line',
                name: 'Game EFF',
                data: data[0].current,
                color: '#999999',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);


            chart.addSeries({ 	
                type: 'line',
                name: 'Sohrt-Term',
                data: data[0].ma3,
                color: '#00CCFF',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);

            chart.addSeries({ 	
                type: 'line',
                name: 'Mid-Term',
                data: data[0].ma6,
                color: 'rgba(0,255,0,1)',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);

            chart.addSeries({ 	
                type: 'line',
                name: 'Long-Term',
                data: data[0].ma9,
                color: '#ff0066',
                yAxis: 0,
                marker: {
                    symbol: 'circle'
                }
            },false);

            chart.addSeries({ 	
                name: 'Start',
                color: '#4572A7',
                type: 'column',
                data: data[0].min1,
                yAxis: 1,
                states: {
                    hover: {
                        brightness: 0.5
                    }
                }
            },false);

            chart.addSeries({ 	
                name: 'Bench',
                showInLegend: false,
                color: '#c0504d',//'#008866'
                type: 'column',
                data: data[0].min2,
                yAxis: 1,
                states: {
                    hover: {
                        brightness: 0.5
                    }
                }
            },false);
            
            chart.xAxis[0].setCategories(data[0].date);
            oppo = data[0].oppo;
            chart.options.exporting.filename='Gamelog#'+player[0].fbid;

            chart.redraw();
			
        }).error(function(e){
        });
    }
	

    var chart = new Highcharts.Chart({

        chart: {
            renderTo: $('#chart_gamelog').get(0),
            alignTicks: false,
            width: 895,
            height: 600,
            zoomType: 'xy',
            borderColor: 'rgba(0,0,0,0.0)',
            borderRadius: 0,
            borderWidth: 0,
            type: 'line',
            plotBorderColor: '#888',
            plotBorderWidth: 0,
            backgroundColor: 'rgba(0,0,0,0.6)',
            marginTop: 50
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Game Performance',
            y: 20
        },        
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Download the Graph (PNG)',
                        onclick: function () {
                            this.exportChart({
                                width: 896,
                                type: 'image/png'
                            });
                        }
                    },{
                        text: 'Download the Graph (JPG)',
                        onclick: function () {
                            this.exportChart({
                                width: 896,
                                type: 'image/jpeg'
                            });
                        }
                    }]
                }
            },
        },
        navigation: {
            buttonOptions: {
                enabled: true,
                align: 'center',
                x:100,
                y:3
//                height: 20,
//                width: 24,
//                symbolSize: 14,
//                symbolX: 12.5,
//                symbolY: 10.5,
//                symbolStroke: '#666',
//                symbolStrokeWidth: 1,
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            borderWidth: 1,
            borderColor: '#FFF',
            backgroundColor: 'rgba(255,255,255,0.1)',
            x: 0,
            y: 0
        },
        labels: {
            items: [{
                html: 'Hot',
                style: {
                    left: '65px',
                    top: '5px',
                    color: 'rgba(255,0,0,1)',
                    fontWeight: 'bold',
                    fontSize: 12}
                },{
                html: 'Cold',
                style: {
                    left: '65px',
                    top: '335px',
                    color: 'rgba(0,187,255,1)',
                    fontWeight: 'bold',
                    fontSize: 12}
            }]
        },
        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                lineWidth: 1.5,
                marker: {
                    radius: 2
                },
                borderWidth: 0,
                pointPadding: 0,
                allowPointSelect: true,
                states: {
                    hover: {
                        enabled: true,
                        lineWidth: 1.5,
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
            shared: true,
            positioner: function () {
                return { x: 68, y: 8 };
            },
            formatter: function() {
                return this.x + ',   EFF:' + this.y+' '+oppo[this.x];
            }
        },
        xAxis: [{
            labels: {
                rotation: 30,
                //x: -5,
                //y: 18,
                step: 1,
                style: {
                    fontSize: 5
                }
            },
            startOnTick: true,
            tickInterval: 5,
            tickWidth: 0.3,
            tickmarkPlacement: 'on',            
            max: 81,
            min: 0
        }],
        yAxis: [{ // performance line
            id: 0,
            title: {
                text: 'EFF Value',
                style: {},
                y: -100					
            },
            labels: {
            },
            tickPositions: [0,10,20,30,40],
            min: -13.333333333333,
            startOnTick: false,
            endOnTick: true,
            plotBands: [{
                from: 20,
                to: 40,
                color: 'rgba(255, 0, 0, 0.1)'
            },{
                from: 0,
                to: 20,
                color: 'rgba(0, 128, 128, 0.1)'
            }],
        },{ // time bar
            id: 1,
            title: {
                text: 'Time',
                style: {},
                y: 180
            },
            labels: {
            },
            tickPositions: [0,12,24,36,48],
            max: 192,
            startOnTick: true,
            endOnTick: false,
            plotLines: [{
                color: '#fff',
                width: 1,
                value: 48
            }],
            opposite: true
        }]
    });

    //$('<div class="team" style="position:absolute;top:10px;left:20px;width:150px;padding:5px 10px 5px 10px;z-index:1;border:1px solid #fff"><img class="face" style="height:43px;widht:33px;display: block" src="player/none.jpg" /></div>').appendTo(chart.container);

});

