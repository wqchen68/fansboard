$(function () {

    pageobj.bind('startjs',function(){
           $('#plotbtn').click();
    });

    var chart2 = new Highcharts.Chart({

        chart: {
            renderTo: $('#container3').get(0),
            type: 'scatter',
            zoomType: 'xy',
            height: 580,
            width: 1000,
            backgroundColor: 'rgba(0,0,0,1)',
            borderColor: '#000000',
            borderRadius: 0,
            borderWidth: 0,
            plotBorderColor: '#222222',
            plotBorderWidth: 1,
            margin: [30, 10, 10, 30]
        },

        title: {
            text: ''
        },

        legend: {
            enabled: false
        },

        tooltip: {
            snap: 50,
            animation: false,
            backgroundColor: '#000',
            borderColor: '#fff',
            borderWidth: 1,
            borderRadius: 7,
            shadow: false,
            hideDelay: 0
            //formatter: function() {
            //    return 'The value for <b>'+ this.x +'</b> is <b>'+ this.y +'</b>';
            //}
            //enabled: false
        },
        labels: {
            items: [{
                html: 'Better',
                style: {
                    left: '805px',
                    top: '-25px',
                    color: 'rgba(255,0,0,1)',
                    fontWeight: 'bold',
                    fontSize: 12
                }
            },{
                html: 'Worse',
                style: {
                    left: '-25px',
                    top: '630px',
                    color: 'rgba(0,187,255,1)',
                    fontWeight: 'bold',
                    fontSize: 12
                }
            }]
        },
        xAxis: {
            lineColor: '#222222',
            lineWidth: 1,
            gridLineDashStyle: 'Dot',
            gridLineColor: '#666666',
            gridLineWidth: 1,
            labels: {
                enabled: false
            },
            startOnTick: false, //強制座標軸開始在grid
            endOnTick: false, //強制座標軸結束在grid
            maxPadding: 0.05, //0.1
            minPadding: 0.05,
            opposite: true,
            plotLines: [{
                color: '#FFFFFF',
                width: 2,//2
                value: 0,
                dashStyle: 'ShortDash'
            }],
            title: {
                text: 'Summation of Above items',
                margin: 10
            }
        },
        yAxis: {
            lineColor: '#222222',
            lineWidth: 1,
            gridLineDashStyle: 'Dot',
            gridLineColor: '#666666',
            gridLineWidth: 1,
            labels: {
                enabled: false
            },
            startOnTick: false, //強制座標軸開始在grid
            endOnTick: false, //強制座標軸結束在grid
            maxPadding: 0.02, //0.05
            minPadding: 0.02,
            plotLines: [{
                color: '#FFFFFF',
                width: 2,//2
                value: 0,
                dashStyle: 'ShortDash'
            }],
            title: {
                text: 'Summation of Left items'
            }
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    formatter: function(){
                        return '<span style="z-index:-1000;color:'+this.series.color+'">'+this.series.name+'</span>';
                    },
                    y:10,
                    zIndex:-1000
                },
                events: {
                    click: function(event) {
                        $('.optionMenu').css({
                            left: event.offsetX-100,
                            top: event.offsetY-100
                        }).show();

                        var amount = $('.optionMenu').find('div').length;
                        var angle = 2/amount;
                        var initAngle = 2/Math.pow(2,amount-1);
                        var fbid = fbid_to_index[event.currentTarget.index];

                        $('.optionMenu').find('div').each(function(i, val){
                            var x = 25*Math.cos(Math.PI*(initAngle+angle*i));
                            var y = 25*Math.sin(Math.PI*(initAngle+angle*i));
                            $('.optionMenu').find('div').eq(i).animate({
                                left: (40+x)+'%',
                                top: (40-y)+'%'
                            });
                        });
                        $('.optionMenu').find('div').eq(0).children('a').attr('href','playerAbility?player='+fbid).attr('target','_blank');
                        $('.optionMenu').find('div').eq(1).children('a').attr('href','gameLog?player='+fbid).attr('target','_blank');
                        $('.optionMenu').find('div').eq(2).children('a').attr('href','matchPlayer?player='+fbid).attr('target','_blank');
                    }
                },
                animation: false
            }
        },

        exporting: {
            buttons: {
                    contextButton: {
                        menuItems: [{
                            text: 'Download Graph (PNG)',
                            onclick: function () {
                                this.exportChart({
                                    scale: 2,
                                    type: 'image/png',
                                    filename: 'Data_Scatter'
                                });
                            }
                        },{
                            text: 'Download Graph (PDF)',
                            onclick: function () {
                                this.exportChart({
                                    scale: 2,
                                    type: 'application/pdf',
                                    filename: 'Data_Scatter'
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
                x:110,
                y:-5
            }
        },

        credits: {
            enabled: false
        },

        series: [0]

    });

    var fbid_to_index = [];
    var optionMenu = $('<div class="optionMenu" style="position:absolute;top:0;left:0;width:200px;height:200px;display:none;z-index:1"></div>').appendTo(chart2.container);
    optionMenu.append('<div class="optionMenuItem"><a href=""><img src="images/fig_1_playerAbility3.png" style="width:48px;margin:1px" /></a></div>');
    optionMenu.append('<div class="optionMenuItem"><a href=""><img src="images/fig_6_gameLog2.png" style="width:55px;margin:5px 0 0 -2px" /></a></div>');
    optionMenu.append('<div class="optionMenuItem"><a href=""><img src="images/fig_5_similarPlayer2.png" style="width:55px;margin:5px 0 0 -2px" /></a></div>');
    optionMenu.mouseleave(function(){
        $(this).hide();
        $(this).find('div').css({
            left: '40%',
            top: '40%'
        });
    });
    optionMenu.on('click','div.optionMenuItem',function(){
        $(this).mouseleave();
    });


    var chertHeight = 680;
    function resizeChart(){
        if( $('body').width()>1000 ){
            width_o = 1000*0.99;
            width_io = width_o-112;
            width_if = width_io;
            chart2.setSize(width_if,chertHeight,false);
        }
        if( $('body').width()<=1004 && $('body').width()>748 ){
            width_o = $('body').width()*0.905;
            width_io = width_o*0.99;
            width_if = width_io*0.82-10;
            chart2.setSize(width_if,chertHeight,false);
        }
        if( $('body').width()<=748 ){
            width_o = $('body').width()*0.905;
            width_io = width_o*0.99;
            width_if = width_io*0.99-10;
            chart2.setSize(width_if,chertHeight,false);
        }
    }
    resizeChart();

    $(window).resize(function(){
        if( $('.move.tab5').is(':visible') )
            resizeChart();
    });

    pageobj.on('click','.rankList tr.ranklist',function(){
        $(this).toggleClass('active');
        var index = $(this).find('td.index').text();
        //chart2.series[index].data[0].select($(this).hasClass('active'));

        if( $(this).hasClass('active') ){
            chart2.get('series'+index).update({
                marker: {
                    fillColor:'rgba(255,255,255,0.5)',
                    radius: 10
                }
            });
        }else{
            chart2.get('series'+index).update({
                marker: {
                    fillColor:'rgba(255,255,255,0.0)',
                    radius: 20
                }
            });
        }
    });

    var insertData = function() {
        var input = {
            category_x: $.map($('#x-category :checkbox[name=x]:checked'),function(a){
                return $(a).val();
            }),
            category_y: $.map($('#y-category :checkbox[name=y]:checked'),function(a){
                return $(a).val();
            }),
            datarange: $('select[name=datarange]').val(),
            position: $.map($('#b-position :checkbox[name=position]:checked'),function(a){
                return $(a).val();
            }),
            mins:$('#player_mins').val()

        };
        if( input.category_x.length>0 && input.category_y.length>0 )
            $.post('/data/getScatter',input,function(data){

                console.log(data);

                $('.rankList').find('tr').remove();
                fbid_to_index = data.bv_fbid;
                for( var i in data.bv_a ){

                    chart2.addSeries({
                        id: 'series'+(i*1+1),
                        name: data.bv_name[i],
                        color: 'rgba('+data.bv_rgb[i][0]+', '+data.bv_rgb[i][1]+', '+data.bv_rgb[i][2]+', 1)',
                        data: [data.bv_a[i]],
                        marker: {
                            enabled: true,
                            radius: 20,
                            symbol: 'circle',
                            fillColor:'rgba(255,255,255,0)',
                            states: {
                                select: {
                                    //fillColor: 'white',
                                    lineWidth: 3,
                                    radius: 5
                                }
                            }
                        }
                    },false);

                    $('.rankList').append('<tr class="ranklist"><td class="index">'+(i*1+1)+'</td><td>'+data.bv_name[i]+'</td><td>'+data.player_info[i].position+'</td></tr>');
                }

                chart2.redraw();

                selectedPoints = chart2.getSelectedPoints();

                $('#testlist').show('slide', {direction: 'left'}, 1000);

            },'json').error(function(e){

            });
    };

    $('#plotbtn').click(function(){
        while( chart2.series.length>0 ){
            chart2.series[0].remove(false);
        }
        chart2.redraw();
        $('#testlist').hide('slide', {direction: 'left'}, 300, insertData);

    });


    $('#scStat').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#scStat').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#xFG').prop('checked',true);
        $('#xFT').prop('checked',true);
        $('#yPTS').prop('checked',true);
        $('#plotbtn').click();
    });

    $('#spStat').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#spStat').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#xPTS').prop('checked',true);
        $('#y3PTM').prop('checked',true);
        $('#plotbtn').click();
    });

    $('#rbStat').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#rbStat').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#xBLK').prop('checked',true);
        $('#xPF').prop('checked',true);
        $('#yTREB').prop('checked',true);
        $('#plotbtn').click();
    });

    $('#asStat').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#asStat').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#xST').prop('checked',true);
        $('#xTO').prop('checked',true);
        $('#yAST').prop('checked',true);
        $('#plotbtn').click();
    });

    $('#ignrFG').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#ignrFG').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#x3PTM').prop('checked',true);
        $('#xFT').prop('checked',true);
        $('#xTREB').prop('checked',true);
        $('#xAST').prop('checked',true);
        $('#xTO').prop('checked',true);
        $('#xST').prop('checked',true);
        $('#xBLK').prop('checked',true);
        $('#xPTS').prop('checked',true);
        $('#yFG').prop('checked',true);
        $('#plotbtn').click();
    });

    $('#ignrFT').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#ignrFT').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#xFG').prop('checked',true);
        $('#x3PTM').prop('checked',true);
        $('#xTREB').prop('checked',true);
        $('#xAST').prop('checked',true);
        $('#xTO').prop('checked',true);
        $('#xST').prop('checked',true);
        $('#xBLK').prop('checked',true);
        $('#xPTS').prop('checked',true);
        $('#yFT').prop('checked',true);
        $('#plotbtn').click();
    });

    $('#ovStat').click(function(){
        $('#b-shortcuts').find(':checkbox').prop('checked',false);
        $('#ovStat').prop('checked',true);
        $('#x-category').find(':checkbox').prop('checked',false);
        $('#y-category').find(':checkbox').prop('checked',false);
        $('#xMIN').prop('checked',true);
        $('#xPF').prop('checked',true);
        $('#yFG').prop('checked',true);
        $('#yFT').prop('checked',true);
        $('#y3PTM').prop('checked',true);
        $('#yTREB').prop('checked',true);
        $('#yBLK').prop('checked',true);
        $('#yAST').prop('checked',true);
        $('#yST').prop('checked',true);
        $('#yPTS').prop('checked',true);
        $('#yTO').prop('checked',true);
        $('#plotbtn').click();
    });

});