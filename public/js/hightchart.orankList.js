$(function () {
	
    var player = []
    var changing_index = 0;
	
    pageobj.bind('startjs',function(){
            pageobj.trigger('init');
    });
	
    pageobj.bind('init',function(){

    });
	
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