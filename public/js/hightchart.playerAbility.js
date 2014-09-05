$(function () {
	
    var player = []
    var changing_index = 0;
	
    pageobj.bind('startjs',function(){
            pageobj.trigger('init');
    });
	
    pageobj.bind('init',function(){
        $('.modelBox .playerList-combo').addClass('muti');
        if( playerInit.length > 0 ){
            for( var i in playerInit ){
                var target = $('.modelBox .playerList-combo').find('td[value='+playerInit[i]+']');
                target.addClass('active');
                target.children('.muti-btn').addClass('active');
            }
            $('.modelBox .playerList-combo').addClass('active');
            reflash();
        }
    });
    
    $('input[name=cate]').click(function(){
        if( player.length>0 )
            getRank();
    });

    pageobj.on('change','.player_season',function(){
        pageobj.find('.playerList-combo tr').remove();
        $('.modelBox .playerList-combo').getPlayerList2(playerInit,function(){
            if( player.length>0 )
//                change();
                reflash();
        });
    });

    var reflash = function(){
        player = pageobj.find('.playerList-combo td.active').getPlayer();
        playerInit = $.map(player,function(value, index){
            return value.fbid;
        });

        var location = window.location;
        
        url = playerInit.length>0
            ? ('/'+location.pathname.split('/')[1])+'/'+playerInit.join(',')+'?data='+pageobj.find('.player_season').val()
            : location.toString();
        window.history.pushState('', '', url);
        
//        alert(pageobj.find('.player_season').val());
        
        if( player.length>0 ){
            change();
            changePlayerImg();
        }else{
            pageobj.find('.ability-detail').children('tbody').empty();
            pageobj.find('.face').css('background-image','url(/images/help1.png)');
            pageobj.find('.rank1,.rank2,.basic11,.newsbox').empty();
            var series_size = radarChart.series.length;
            if( series_size>0 )
            for( i=0;i<series_size;i++ ){
                if( radarChart.series[0] )
                radarChart.series[0].remove(false);
            }
            radarChart.colorCounter = 0;
        }
    };
    funcArray[pageIndex].reflash = reflash;   
    
    
    function change(){
			
        getRank();

        changing_index++;
        var changing_index_in = changing_index;

        var series_size = radarChart.series.length;			
        if( series_size>0 )
        for( i=0;i<series_size;i++ ){
            if( radarChart.series[0] )
            radarChart.series[0].remove(false);
        }
        radarChart.colorCounter = 0;

        pageobj.find('.ability-detail').children('tbody').empty();
        pageobj.find('.basic00,.basic01,.basic02,.basic10,.basic11,.basic12').empty();

        $.getJSON('/data/getAbility',{player:player,datarange:pageobj.find('.player_season').val()},function(data){

            reFlashNews();

            if( changing_index_in===changing_index )
            for( i=0;i<data.value.length;i++ ){

                radarChart.addSeries({ 	
                    type: 'area',
                    name: player[i].name,
                    data: data.value[i],
                    fillOpacity: 0.3,
                    marker: {
                        enabled:false,
                        radius:0,
                        symbol: 'circle'
                    }
                },false);
                //radarChart.hideLoading();

                var scoreTable = $('<tr class="report-detail" />').appendTo(pageobj.find('.ability-detail').children('tbody'));
                scoreTable.append('<td style="text-align: left">'+player[i].name+'</td>');

                for( var j=0;j<data.table[i].length;j++ ){
                    scoreTable.append('<td  style="text-align: right;padding-right:5px">'+data.table[i][j]+'</td>');
                }
            }
            radarChart.redraw();

            pageobj.find('.basicname1').html(player[0].name);
            pageobj.find('.basic00').html(data.basic[0][0]);
            pageobj.find('.basic01').html(data.basic[0][1]);
            pageobj.find('.basic02').html(data.basic[0][2]);
            
            radarChart.options.exporting.filename='RadarChart#'+player[0].fbid;
            
            if(data.basic.length>1){
                pageobj.find('.basicname2').html(player[1].name);
                pageobj.find('.basic10').html(data.basic[1][0]);
                pageobj.find('.basic11').html(data.basic[1][1]);
                pageobj.find('.basic12').html(data.basic[1][2]);
                
                radarChart.options.exporting.filename='RadarChart#'+player[0].fbid+'&'+player[1].fbid;
            }            
        
        }).error(function(e){
        });
    }

    if( typeof(radarChart)==='undefined' ) {
        var radarChart = creatRadarChart();  
    }
	
    function getRank(get_array){

        get_array = $.map( $('input[name=cate]:checked'),function(a){ 
            return $(a).val(); 
        });	

        $.getJSON('/data/getRank',{get_array:get_array,player:player,datarange:$('.player_season').val()},function(data){
            pageobj.find('.rank1').html(data[0]);
            if(data.length>1)
                pageobj.find('.rank2').html(data[1]);
        }).error(function(e){
        });
    }
	
    function changePlayerImg(){		
        pageobj.find('img.face').css('background-image','url(/images/help1.png)');
        if( player.length>0 ){
            pageobj.find('.face.player0').css({'background-image':'url(/player/'+player[0].fbid+'.png)','background-size': '60px 72px'});
            pageobj.find('.link-gameLog1').attr('href','/gameLog/'+player[0].fbid);
            pageobj.find('.link-splitStats1').attr('href','/splitStats/'+player[0].fbid);
            pageobj.find('.link-careerStats1').attr('href','/careerStats/'+player[0].fbid);
            pageobj.find('.link-matchPlayer1').attr('href','/matchPlayer/'+player[0].fbid);
            if( player.length>1 ){
                pageobj.find('.face.player1').css({'background-image':'url(/player/'+player[1].fbid+'.png)','background-size': '60px 72px'});
                pageobj.find('.link-gameLog1').attr('href','/gameLog/'+player[0].fbid);
                pageobj.find('.link-gameLog2').attr('href','/gameLog/'+player[1].fbid);
                pageobj.find('.link-splitStats1').attr('href','/splitStats/'+player[0].fbid);
                pageobj.find('.link-splitStats2').attr('href','/splitStats/'+player[1].fbid);
                pageobj.find('.link-careerStats1').attr('href','/careerStats/'+player[0].fbid);
                pageobj.find('.link-careerStats2').attr('href','/careerStats/'+player[1].fbid);
                pageobj.find('.link-matchPlayer1').attr('href','/matchPlayer/'+player[0].fbid);
                pageobj.find('.link-matchPlayer2').attr('href','/matchPlayer/'+player[1].fbid);
                pageobj.find('#player2').css("visibility", "visible");
            }else{
                pageobj.find('#player2').css("visibility", "hidden");
                pageobj.find('.link-gameLog1').attr('href','/gameLog/'+player[0].fbid);
                pageobj.find('.link-splitStats1').attr('href','/splitStats/'+player[0].fbid);
                pageobj.find('.link-careerStats1').attr('href','/careerStats/'+player[0].fbid);
                pageobj.find('.link-matchPlayer1').attr('href','/matchPlayer/'+player[0].fbid);
            }
        }
    };
	
    function reFlashNews(){
        pageobj.find('.newsbox').empty();
        $.get('/data/getNews',{player:player},function(data){
            pageobj.find('.newsbox.player1').append(data[0][0]+'<br />'+data[0][1]+'<br />'+data[0][2]);
            if( player.length>1 )
                pageobj.find('.newsbox.player2').append(data[1][0]+'<br />'+data[1][1]+'<br />'+data[1][2]);
        },'json').error(function(e){
        });
    }
	
});