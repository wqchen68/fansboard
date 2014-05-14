$(function () {	
	
	
	$('.filter').keydown(function(e){		
		var filter = $(this);
		setTimeout(function(){
			pageobj.find('.plist td').each(function(){
				if( $(this).text().toLowerCase().search(filter.val().toLowerCase())!==-1 ){
					$(this).show();
				}else{
					$(this).hide();
				}
			});
		},0);
	});	

	
	$(document).keydown(function(e){
		e.stopPropagation();
		var height = $('.playerList-combo').find('td.active').outerHeight();
		var scroll = $('.playerList-combo').parent().scrollTop();		
		switch(e.which){
		case 38:
			if( $('.sign-btn.active').length>0 ){
				$('.playerList-combo').parent().scrollTop(scroll-height);
				$('.sign-btn.active').parent('tr').prev('tr').children('td').click();
				return false;
			}
		break;
		case 40:
			if( $('.sign-btn.active').length>0 ){
				$('.playerList-combo').parent().scrollTop(scroll+height);
				$('.sign-btn.active').parent('tr').next('tr').children('td').click();
				return false;
			}
		break;
		}		
	}); 
	

	$('.modelBox .playerList-combo').on('click','.sign-btn',function(e){
		if( $(e.delegateTarget).is('.muti') )
			$(e.delegateTarget).addClass('active');
		$('.sign-btn').removeClass('active');
		$('.muti-btn').removeClass('active');
		$(this).addClass('active');
		$(this).children('.muti-btn').addClass('active');
		if( funcArray[pageIndex].hasOwnProperty('reflash') )
			funcArray[pageIndex].reflash();
	});
	$('.modelBox .playerList-combo').on('click','.muti-btn',function(e){
		e.stopPropagation();
		$(this).toggleClass('active');
		if( $(this).is('.active') ){
			$(this).parent().addClass('active');
		}else{
			$(this).parent().removeClass('active');
		}
		if( $(e.delegateTarget).find('.muti-btn.active').length===0 )
			$(e.delegateTarget).removeClass('active');
		if( funcArray[pageIndex].hasOwnProperty('reflash') )
			funcArray[pageIndex].reflash();
	});

	
	$.fn.extend({
		getPlayer: function(){
			player = $.map( $(this),function(a){ 
				var player = {
					fbid: $(a).attr('value'),
					team: $(a).attr('team'),
					name: $(a).text()
				};
				return player; 
			});
			return player;
		}
	});


	$.fn.extend({
		getPlayerList2: function(player,callback){
			callback = callback || function(){};
			var input = {
				player_season: pageobj.find('.player_season').val()
			};
			var target = $(this);
			$.getJSON('data/getPlayer2',input,function(data){
				target.find('tr').remove();
				var list = $(data.playlist);
				if( playerInit.length>0 )
				for( var i in playerInit ){
					pageobj.find('.playerList-combo').addClass('active');
					list.find('td[value='+playerInit[i]+']').addClass('active');
					list.find('td[value='+playerInit[i]+']').children('.muti-btn').addClass('active');
				}
				target.append(list);
				callback(target);
			}).error(function(e){
			});
			return target;
		}
	});
	
	$.fn.extend({
		changePlayerImg: function(card){
			$(this).find('.face').attr({src:'player/'+card['fbid']+'.png',fbid:card['fbid']});
			$(this).find('.cardplayer').html(card['cardplayer']);
			$(this).find('.cardteamposi').html(card['cardteamposi']);
			$(this).find('.cardinjna').html(card['cardinjna']);
			$(this).find('.cardstat').html(card['cardstat']);
		}
	});

	
});