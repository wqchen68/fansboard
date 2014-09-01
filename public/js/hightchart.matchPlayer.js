$(function () {

	var player = [];
	var cards = [];
	var ability = [];
	
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
		}});		
	
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
			
			change();
		}
	};
	funcArray[pageIndex].reflash = reflash;	
	

	
	pageobj.find('select.matchMethod').change(function(){
		if( player.length>0 )
			change();
	});

	pageobj.find('.majorboxN').click(function(){
		var player2 = $(this);
		var index_similar = pageobj.find('.majorboxN').index(player2);
		
		var ability_draw = {
			name: [ability.name[0],ability.name[index_similar+1]],
			value: [ability.value[0],ability.value[index_similar+1]]
		};	
		
		drawRadar(ability_draw);
		
		pageobj.find('.majorboxN .playercardsmall').removeClass('active');
		player2.find('.playercardsmall').addClass('active');
	});


	function change(){
		
		var input = {
			player: player,
			datarange: pageobj.find('.player_season').val(),
			matchMethod: pageobj.find('select.matchMethod').val()
		};
		$.getJSON('data/getMatch', input, function(data){			
			cards = data.card;
			
			pageobj.find('.ability-detail').children('tbody').empty();
			for( i=0;i<data.ability.table.length;i++ ){
				var scoreTable = $('<tr class="report-detail" />').appendTo(pageobj.find('.ability-detail').children('tbody'));
				scoreTable.append('<td style="text-align: left">'+data.ability.name[i]+'</td>');
				for( var j=0;j<data.ability.table[i].length;j++ ){
					scoreTable.append('<td  style="text-align: right;padding-right:5px">'+data.ability.table[i][j]+'</td>');
				}
			}
				
			for( var i in cards){				
				if( i==cards.length-1 ){					
					pageobj.find('.faceCardMajor').changePlayerImg(cards[i]);
					pageobj.find('.link-playerAbility').attr('href','playerAbility?player='+player[0].fbid);
				}else{
					$('.majorboxN').eq(i).changePlayerImg(cards[i]);
				}
			}
			pageobj.find('.link-playerAbility1').attr('href','playerAbility?player='+cards[0].fbid);
			pageobj.find('.link-playerAbility2').attr('href','playerAbility?player='+cards[1].fbid);
			pageobj.find('.link-playerAbility3').attr('href','playerAbility?player='+cards[2].fbid);
			pageobj.find('.link-playerAbility4').attr('href','playerAbility?player='+cards[3].fbid);
			pageobj.find('.link-playerAbility5').attr('href','playerAbility?player='+cards[4].fbid);
			pageobj.find('.link-playerAbility6').attr('href','playerAbility?player='+cards[5].fbid);
			
			ability = data.ability;
			
			var ability_draw = {
				name: [ability.name[0],ability.name[1]],
				value: [ability.value[0],ability.value[1]]
			};		
			drawRadar(ability_draw);
			
			pageobj.find('.majorboxN .playercardsmall').removeClass('active');
			$('.majorboxN').eq(0).find('.playercardsmall').addClass('active');
		}).error(function(e){
		});

		
	}
	if( typeof(radarChart)==='undefined' )
		radarChart = creatRadarChart();
	
	function drawRadar(ability){
		var series_size = radarChart.series.length;			
		if( series_size>0 )
		for( i=0;i<series_size;i++ ){
			if( radarChart.series[0] )
			radarChart.series[0].remove(false);
		}
		radarChart.colorCounter = 0;
		for( var i in ability.value ){
			radarChart.addSeries({ 	
				type: 'area',
				name: ability.name[i],
				data: ability.value[i],
				fillOpacity: 0.4,
				marker: {
					enabled:false,
					radius:0,
					symbol: 'circle'
				}  	
			},false);
		}		
		radarChart.redraw();
		
	}

	
});