$(function(){
	
	var time_count;
	pageobj.bind('startjs',function(){	
		time_count = new counter({
			msg1:' [curmin] : [cursec] ',
			msg2:' [cursec] ',
			timeout_zero: function(){
				reflasheff();
			}
		});
	});
	
	function counter(options, callback) {

		var limit = "00:03";
		var timeout_fc = options.timeout_zero;
		var msg1 = options.msg1;
		var msg2 = options.msg2;
		var speed = 1000;
		var parselimit;
		
		var init = function() {			
			var parselimit_split = limit.split(":");
			parselimit = parselimit_split[0]*60+parselimit_split[1]*1;
			begintimer();
		};
		
		var end = function() {
			timeout_fc();
			init();
		};

		var begintimer = function() {
			var curmin = Math.floor(parselimit/60);
			var cursec = parselimit%60;
			var cursec_fix,curtime,newmsg1,newmsg2;
			
			if( curmin!==0 ){
				cursec_fix = new Array(2-cursec.toString().length+1).join("0")+cursec;
				newmsg1 = msg1.replace(/\[curmin\]/i, curmin);
				newmsg1 = newmsg1.replace(/\[cursec\]/i, cursec_fix);
				curtime = newmsg1;
			}else{
				cursec_fix = new Array(2-cursec.toString().length+1).join("0")+cursec;
				newmsg2 = msg2.replace(/\[cursec\]/i, cursec_fix);
				curtime = newmsg2;
			}
			//window.status = curtime;
			//$('.reflashtime').html(curtime);

			if( parselimit === -1 ){
				end();
			}else{ 
				parselimit -= 1;
				
				setTimeout(begintimer,speed);
			}

		};
	
		init();
		
		this.getsec = function() {
			return cursec;
		};	

	}

	function reflasheff(){
		$.getJSON('sort/gethotcoldPlayer',function(data){	

/***************Breakout***************/
			pageobj.find('.todaybo-face0').css({'background-image':'url(player/'+data.todaybo[0]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaybo-face1').css({'background-image':'url(player/'+data.todaybo[1]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaybo-face2').css({'background-image':'url(player/'+data.todaybo[2]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaybo-face3').css({'background-image':'url(player/'+data.todaybo[3]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaybo-face4').css({'background-image':'url(player/'+data.todaybo[4]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaybo-face5').css({'background-image':'url(player/'+data.todaybo[5]['fbid']+'.png)','background-size': '48px 60px'});							
			
			pageobj.find('.todaybo-name0').html(data.todaybo[0]['player']+' ('+data.todaybo[0]['team']+' - '+data.todaybo[0]['position']+')');
			pageobj.find('.todaybo-name1').html(data.todaybo[1]['player']+' ('+data.todaybo[1]['team']+' - '+data.todaybo[1]['position']+')');
			pageobj.find('.todaybo-name2').html(data.todaybo[2]['player']+' ('+data.todaybo[2]['team']+' - '+data.todaybo[2]['position']+')');
			pageobj.find('.todaybo-name3').html(data.todaybo[3]['player']+' ('+data.todaybo[3]['team']+' - '+data.todaybo[3]['position']+')');
			pageobj.find('.todaybo-name4').html(data.todaybo[4]['player']+' ('+data.todaybo[4]['team']+' - '+data.todaybo[4]['position']+')');
			pageobj.find('.todaybo-name5').html(data.todaybo[5]['player']+' ('+data.todaybo[5]['team']+' - '+data.todaybo[5]['position']+')');
			
			pageobj.find('.todaybo-today0').html(data.todaybo[0]['pts2']+' PTS, '+data.todaybo[0]['treb2']+' REB, '+data.todaybo[0]['ast2']+' AST');
			pageobj.find('.todaybo-today1').html(data.todaybo[1]['pts2']+' PTS, '+data.todaybo[1]['treb2']+' REB, '+data.todaybo[1]['ast2']+' AST');
			pageobj.find('.todaybo-today2').html(data.todaybo[2]['pts2']+' PTS, '+data.todaybo[2]['treb2']+' REB, '+data.todaybo[2]['ast2']+' AST');
			pageobj.find('.todaybo-today3').html(data.todaybo[3]['pts2']+' PTS, '+data.todaybo[3]['treb2']+' REB, '+data.todaybo[3]['ast2']+' AST');
			pageobj.find('.todaybo-today4').html(data.todaybo[4]['pts2']+' PTS, '+data.todaybo[4]['treb2']+' REB, '+data.todaybo[4]['ast2']+' AST');
			pageobj.find('.todaybo-today5').html(data.todaybo[5]['pts2']+' PTS, '+data.todaybo[5]['treb2']+' REB, '+data.todaybo[5]['ast2']+' AST');
						
			pageobj.find('.todaybo-eff0').html('EFF +'+data.todaybo[0]['trend'].toFixed(1));
			pageobj.find('.todaybo-eff1').html('EFF +'+data.todaybo[1]['trend'].toFixed(1));
			pageobj.find('.todaybo-eff2').html('EFF +'+data.todaybo[2]['trend'].toFixed(1));
			pageobj.find('.todaybo-eff3').html('EFF +'+data.todaybo[3]['trend'].toFixed(1));
			pageobj.find('.todaybo-eff4').html('EFF +'+data.todaybo[4]['trend'].toFixed(1));
			pageobj.find('.todaybo-eff5').html('EFF +'+data.todaybo[5]['trend'].toFixed(1));
			
			pageobj.find('.todaybo-min0').html('Min '+data.todaybo[0]['min2']+', ');
			pageobj.find('.todaybo-min1').html('Min '+data.todaybo[1]['min2']+', ');
			pageobj.find('.todaybo-min2').html('Min '+data.todaybo[2]['min2']+', ');
			pageobj.find('.todaybo-min3').html('Min '+data.todaybo[3]['min2']+', ');
			pageobj.find('.todaybo-min4').html('Min '+data.todaybo[4]['min2']+', ');
			pageobj.find('.todaybo-min5').html('Min '+data.todaybo[5]['min2']+', ');
			
			/*****hover*****/
			pageobj.find('.todaybo-mask0 div').html('Season: '+data.todaybo[0]['pts1']+' PTS, '+data.todaybo[0]['treb1']+' REB, '+data.todaybo[0]['ast1']+' AST');
			pageobj.find('.todaybo-mask1 div').html('Season: '+data.todaybo[1]['pts1']+' PTS, '+data.todaybo[1]['treb1']+' REB, '+data.todaybo[1]['ast1']+' AST');
			pageobj.find('.todaybo-mask2 div').html('Season: '+data.todaybo[2]['pts1']+' PTS, '+data.todaybo[2]['treb1']+' REB, '+data.todaybo[2]['ast1']+' AST');
			pageobj.find('.todaybo-mask3 div').html('Season: '+data.todaybo[3]['pts1']+' PTS, '+data.todaybo[3]['treb1']+' REB, '+data.todaybo[3]['ast1']+' AST');
			pageobj.find('.todaybo-mask4 div').html('Season: '+data.todaybo[4]['pts1']+' PTS, '+data.todaybo[4]['treb1']+' REB, '+data.todaybo[4]['ast1']+' AST');
			pageobj.find('.todaybo-mask5 div').html('Season: '+data.todaybo[5]['pts1']+' PTS, '+data.todaybo[5]['treb1']+' REB, '+data.todaybo[5]['ast1']+' AST');												
			
			
			$('.todaybotable').empty();
			for( var i=6;i<15;i++){

				var tablerow = data['todaybo'][i];
				
				var scoreTable = $('<tr class="report-detail" />').appendTo('.todaybotable');
				
				scoreTable.append('<td>'+(i*1+1)+'</td>');
				scoreTable.append('<td style="text-align:left"><a href="gameLog?player='+tablerow['fbid']+'" target="_blank" style="text-decoration:none;color:#fff">'+tablerow['player']+' ('+tablerow['team']+' - '+tablerow['position']+')</a></td>');
				scoreTable.append('<td>'+tablerow['min2']+'</td>');
				scoreTable.append('<td>'+tablerow['pts2']+'</td>');
				scoreTable.append('<td>'+tablerow['treb2']+'</td>');
				scoreTable.append('<td>'+tablerow['ast2']+'</td>');
				scoreTable.append('<td>+'+tablerow['trend'].toFixed(1)+'</td>');
			}
			
			
/***************Struggle***************/
			pageobj.find('.todaysg-face0').css({'background-image':'url(player/'+data.todaysg[0]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaysg-face1').css({'background-image':'url(player/'+data.todaysg[1]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaysg-face2').css({'background-image':'url(player/'+data.todaysg[2]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaysg-face3').css({'background-image':'url(player/'+data.todaysg[3]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaysg-face4').css({'background-image':'url(player/'+data.todaysg[4]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.todaysg-face5').css({'background-image':'url(player/'+data.todaysg[5]['fbid']+'.png)','background-size': '48px 60px'});							
			
			pageobj.find('.todaysg-name0').html(data.todaysg[0]['player']+' ('+data.todaysg[0]['team']+' - '+data.todaysg[0]['position']+')');
			pageobj.find('.todaysg-name1').html(data.todaysg[1]['player']+' ('+data.todaysg[1]['team']+' - '+data.todaysg[1]['position']+')');
			pageobj.find('.todaysg-name2').html(data.todaysg[2]['player']+' ('+data.todaysg[2]['team']+' - '+data.todaysg[2]['position']+')');
			pageobj.find('.todaysg-name3').html(data.todaysg[3]['player']+' ('+data.todaysg[3]['team']+' - '+data.todaysg[3]['position']+')');
			pageobj.find('.todaysg-name4').html(data.todaysg[4]['player']+' ('+data.todaysg[4]['team']+' - '+data.todaysg[4]['position']+')');
			pageobj.find('.todaysg-name5').html(data.todaysg[5]['player']+' ('+data.todaysg[5]['team']+' - '+data.todaysg[5]['position']+')');
			
			pageobj.find('.todaysg-today0').html(data.todaysg[0]['pts2']+' PTS, '+data.todaysg[0]['treb2']+' REB, '+data.todaysg[0]['ast2']+' AST');
			pageobj.find('.todaysg-today1').html(data.todaysg[1]['pts2']+' PTS, '+data.todaysg[1]['treb2']+' REB, '+data.todaysg[1]['ast2']+' AST');
			pageobj.find('.todaysg-today2').html(data.todaysg[2]['pts2']+' PTS, '+data.todaysg[2]['treb2']+' REB, '+data.todaysg[2]['ast2']+' AST');
			pageobj.find('.todaysg-today3').html(data.todaysg[3]['pts2']+' PTS, '+data.todaysg[3]['treb2']+' REB, '+data.todaysg[3]['ast2']+' AST');
			pageobj.find('.todaysg-today4').html(data.todaysg[4]['pts2']+' PTS, '+data.todaysg[4]['treb2']+' REB, '+data.todaysg[4]['ast2']+' AST');
			pageobj.find('.todaysg-today5').html(data.todaysg[5]['pts2']+' PTS, '+data.todaysg[5]['treb2']+' REB, '+data.todaysg[5]['ast2']+' AST');
						
			pageobj.find('.todaysg-eff0').html('EFF '+data.todaysg[0]['trend'].toFixed(1));
			pageobj.find('.todaysg-eff1').html('EFF '+data.todaysg[1]['trend'].toFixed(1));
			pageobj.find('.todaysg-eff2').html('EFF '+data.todaysg[2]['trend'].toFixed(1));
			pageobj.find('.todaysg-eff3').html('EFF '+data.todaysg[3]['trend'].toFixed(1));
			pageobj.find('.todaysg-eff4').html('EFF '+data.todaysg[4]['trend'].toFixed(1));
			pageobj.find('.todaysg-eff5').html('EFF '+data.todaysg[5]['trend'].toFixed(1));
			
			pageobj.find('.todaysg-min0').html('Min '+data.todaysg[0]['min2']+', ');
			pageobj.find('.todaysg-min1').html('Min '+data.todaysg[1]['min2']+', ');
			pageobj.find('.todaysg-min2').html('Min '+data.todaysg[2]['min2']+', ');
			pageobj.find('.todaysg-min3').html('Min '+data.todaysg[3]['min2']+', ');
			pageobj.find('.todaysg-min4').html('Min '+data.todaysg[4]['min2']+', ');
			pageobj.find('.todaysg-min5').html('Min '+data.todaysg[5]['min2']+', ');

			/*****hover*****/
			pageobj.find('.todaysg-mask0 div').html('Min: '+data.todaysg[0]['min2']+',</br> FG: '+data.todaysg[0]['fgm2']+'-'+data.todaysg[0]['fga2']+', '+data.todaysg[0]['fgp2']+'%');
			pageobj.find('.todaysg-mask1 div').html('Min: '+data.todaysg[1]['min2']+',</br> FG: '+data.todaysg[1]['fgm2']+'-'+data.todaysg[1]['fga2']+', '+data.todaysg[1]['fgp2']+'%');
			pageobj.find('.todaysg-mask2 div').html('Min: '+data.todaysg[2]['min2']+',</br> FG: '+data.todaysg[2]['fgm2']+'-'+data.todaysg[2]['fga2']+', '+data.todaysg[2]['fgp2']+'%');
			pageobj.find('.todaysg-mask3 div').html('Min: '+data.todaysg[3]['min2']+',</br> FG: '+data.todaysg[3]['fgm2']+'-'+data.todaysg[3]['fga2']+', '+data.todaysg[3]['fgp2']+'%');
			pageobj.find('.todaysg-mask4 div').html('Min: '+data.todaysg[4]['min2']+',</br> FG: '+data.todaysg[4]['fgm2']+'-'+data.todaysg[4]['fga2']+', '+data.todaysg[4]['fgp2']+'%');
			pageobj.find('.todaysg-mask5 div').html('Min: '+data.todaysg[5]['min2']+',</br> FG: '+data.todaysg[5]['fgm2']+'-'+data.todaysg[5]['fga2']+', '+data.todaysg[5]['fgp2']+'%');			
		
			$('.todaysgtable').empty();
			for( var i=6;i<15;i++){
				var tablerow = data['todaysg'][i];
				
				var scoreTable = $('<tr class="report-detail" />').appendTo('.todaysgtable');
				
				scoreTable.append('<td>'+(i*1+1)+'</td>');
				scoreTable.append('<td style="text-align:left"><a href="gameLog?player='+tablerow['fbid']+'" target="_blank" style="text-decoration:none;color:#fff">'+tablerow['player']+' ('+tablerow['team']+' - '+tablerow['position']+')</a></td>');			
				scoreTable.append('<td>'+tablerow['min2']+'</td>');
				scoreTable.append('<td>'+tablerow['pts2']+'</td>');
				scoreTable.append('<td>'+tablerow['treb2']+'</td>');
				scoreTable.append('<td>'+tablerow['ast2']+'</td>');
				scoreTable.append('<td>'+tablerow['trend'].toFixed(1)+'</td>');
			}





/***************************************/
/**************recenthot****************/
/***************************************/
			pageobj.find('.recenthot-face0').css({'background-image':'url(player/'+data.recenthot[0]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recenthot-face1').css({'background-image':'url(player/'+data.recenthot[1]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recenthot-face2').css({'background-image':'url(player/'+data.recenthot[2]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recenthot-face3').css({'background-image':'url(player/'+data.recenthot[3]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recenthot-face4').css({'background-image':'url(player/'+data.recenthot[4]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recenthot-face5').css({'background-image':'url(player/'+data.recenthot[5]['fbid']+'.png)','background-size': '48px 60px'});							
			
			pageobj.find('.recenthot-name0').html(data.recenthot[0]['player']+' ('+data.recenthot[0]['team']+' - '+data.recenthot[0]['position']+')');
			pageobj.find('.recenthot-name1').html(data.recenthot[1]['player']+' ('+data.recenthot[1]['team']+' - '+data.recenthot[1]['position']+')');
			pageobj.find('.recenthot-name2').html(data.recenthot[2]['player']+' ('+data.recenthot[2]['team']+' - '+data.recenthot[2]['position']+')');
			pageobj.find('.recenthot-name3').html(data.recenthot[3]['player']+' ('+data.recenthot[3]['team']+' - '+data.recenthot[3]['position']+')');
			pageobj.find('.recenthot-name4').html(data.recenthot[4]['player']+' ('+data.recenthot[4]['team']+' - '+data.recenthot[4]['position']+')');
			pageobj.find('.recenthot-name5').html(data.recenthot[5]['player']+' ('+data.recenthot[5]['team']+' - '+data.recenthot[5]['position']+')');
			
			pageobj.find('.recenthot-today0').html(data.recenthot[0]['pts2']+' PTS, '+data.recenthot[0]['treb2']+' REB, '+data.recenthot[0]['ast2']+' AST');
			pageobj.find('.recenthot-today1').html(data.recenthot[1]['pts2']+' PTS, '+data.recenthot[1]['treb2']+' REB, '+data.recenthot[1]['ast2']+' AST');
			pageobj.find('.recenthot-today2').html(data.recenthot[2]['pts2']+' PTS, '+data.recenthot[2]['treb2']+' REB, '+data.recenthot[2]['ast2']+' AST');
			pageobj.find('.recenthot-today3').html(data.recenthot[3]['pts2']+' PTS, '+data.recenthot[3]['treb2']+' REB, '+data.recenthot[3]['ast2']+' AST');
			pageobj.find('.recenthot-today4').html(data.recenthot[4]['pts2']+' PTS, '+data.recenthot[4]['treb2']+' REB, '+data.recenthot[4]['ast2']+' AST');
			pageobj.find('.recenthot-today5').html(data.recenthot[5]['pts2']+' PTS, '+data.recenthot[5]['treb2']+' REB, '+data.recenthot[5]['ast2']+' AST');
						
			pageobj.find('.recenthot-eff0').html('EFF +'+data.recenthot[0]['trend'].toFixed(1));
			pageobj.find('.recenthot-eff1').html('EFF +'+data.recenthot[1]['trend'].toFixed(1));
			pageobj.find('.recenthot-eff2').html('EFF +'+data.recenthot[2]['trend'].toFixed(1));
			pageobj.find('.recenthot-eff3').html('EFF +'+data.recenthot[3]['trend'].toFixed(1));
			pageobj.find('.recenthot-eff4').html('EFF +'+data.recenthot[4]['trend'].toFixed(1));
			pageobj.find('.recenthot-eff5').html('EFF +'+data.recenthot[5]['trend'].toFixed(1));
			
			/*****hover*****/
			pageobj.find('.recenthot-mask0 div').html('Season: '+data.recenthot[0]['pts1']+' PTS, '+data.recenthot[0]['treb1']+' REB, '+data.recenthot[0]['ast1']+' AST');
			pageobj.find('.recenthot-mask1 div').html('Season: '+data.recenthot[1]['pts1']+' PTS, '+data.recenthot[1]['treb1']+' REB, '+data.recenthot[1]['ast1']+' AST');
			pageobj.find('.recenthot-mask2 div').html('Season: '+data.recenthot[2]['pts1']+' PTS, '+data.recenthot[2]['treb1']+' REB, '+data.recenthot[2]['ast1']+' AST');
			pageobj.find('.recenthot-mask3 div').html('Season: '+data.recenthot[3]['pts1']+' PTS, '+data.recenthot[3]['treb1']+' REB, '+data.recenthot[3]['ast1']+' AST');
			pageobj.find('.recenthot-mask4 div').html('Season: '+data.recenthot[4]['pts1']+' PTS, '+data.recenthot[4]['treb1']+' REB, '+data.recenthot[4]['ast1']+' AST');
			pageobj.find('.recenthot-mask5 div').html('Season: '+data.recenthot[5]['pts1']+' PTS, '+data.recenthot[5]['treb1']+' REB, '+data.recenthot[5]['ast1']+' AST');												
			
			
			$('.recenthottable').empty();
			for( var i=6;i<15;i++){
				var tablerow = data['recenthot'][i];
				
				var scoreTable = $('<tr class="report-detail" />').appendTo('.recenthottable');
				
				scoreTable.append('<td>'+(i*1+1)+'</td>');
				scoreTable.append('<td style="text-align:left"><a href="careerStats?player='+tablerow['fbid']+'" target="_blank" style="text-decoration:none;color:#fff">'+tablerow['player']+' ('+tablerow['team']+' - '+tablerow['position']+')</a></td>');			
				scoreTable.append('<td>'+tablerow['min2']+'</td>');
				scoreTable.append('<td>'+tablerow['pts2']+'</td>');
				scoreTable.append('<td>'+tablerow['treb2']+'</td>');
				scoreTable.append('<td>'+tablerow['ast2']+'</td>');
				scoreTable.append('<td>+'+tablerow['trend'].toFixed(1)+'</td>');
			}
			
			
/***************************************/
/**************recentcold***************/
/***************************************/
			pageobj.find('.recentcold-face0').css({'background-image':'url(player/'+data.recentcold[0]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recentcold-face1').css({'background-image':'url(player/'+data.recentcold[1]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recentcold-face2').css({'background-image':'url(player/'+data.recentcold[2]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recentcold-face3').css({'background-image':'url(player/'+data.recentcold[3]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recentcold-face4').css({'background-image':'url(player/'+data.recentcold[4]['fbid']+'.png)','background-size': '48px 60px'});
			pageobj.find('.recentcold-face5').css({'background-image':'url(player/'+data.recentcold[5]['fbid']+'.png)','background-size': '48px 60px'});							
			
			pageobj.find('.recentcold-name0').html(data.recentcold[0]['player']+' ('+data.recentcold[0]['team']+' - '+data.recentcold[0]['position']+')');
			pageobj.find('.recentcold-name1').html(data.recentcold[1]['player']+' ('+data.recentcold[1]['team']+' - '+data.recentcold[1]['position']+')');
			pageobj.find('.recentcold-name2').html(data.recentcold[2]['player']+' ('+data.recentcold[2]['team']+' - '+data.recentcold[2]['position']+')');
			pageobj.find('.recentcold-name3').html(data.recentcold[3]['player']+' ('+data.recentcold[3]['team']+' - '+data.recentcold[3]['position']+')');
			pageobj.find('.recentcold-name4').html(data.recentcold[4]['player']+' ('+data.recentcold[4]['team']+' - '+data.recentcold[4]['position']+')');
			pageobj.find('.recentcold-name5').html(data.recentcold[5]['player']+' ('+data.recentcold[5]['team']+' - '+data.recentcold[5]['position']+')');
			
			pageobj.find('.recentcold-today0').html(' '+data.recentcold[0]['pts2']+' PTS, '+data.recentcold[0]['treb2']+' REB, '+data.recentcold[0]['ast2']+' AST');
			pageobj.find('.recentcold-today1').html(' '+data.recentcold[1]['pts2']+' PTS, '+data.recentcold[1]['treb2']+' REB, '+data.recentcold[1]['ast2']+' AST');
			pageobj.find('.recentcold-today2').html(' '+data.recentcold[2]['pts2']+' PTS, '+data.recentcold[2]['treb2']+' REB, '+data.recentcold[2]['ast2']+' AST');
			pageobj.find('.recentcold-today3').html(' '+data.recentcold[3]['pts2']+' PTS, '+data.recentcold[3]['treb2']+' REB, '+data.recentcold[3]['ast2']+' AST');
			pageobj.find('.recentcold-today4').html(' '+data.recentcold[4]['pts2']+' PTS, '+data.recentcold[4]['treb2']+' REB, '+data.recentcold[4]['ast2']+' AST');
			pageobj.find('.recentcold-today5').html(' '+data.recentcold[5]['pts2']+' PTS, '+data.recentcold[5]['treb2']+' REB, '+data.recentcold[5]['ast2']+' AST');
						
			pageobj.find('.recentcold-eff0').html('EFF '+data.recentcold[0]['trend'].toFixed(1));
			pageobj.find('.recentcold-eff1').html('EFF '+data.recentcold[1]['trend'].toFixed(1));
			pageobj.find('.recentcold-eff2').html('EFF '+data.recentcold[2]['trend'].toFixed(1));
			pageobj.find('.recentcold-eff3').html('EFF '+data.recentcold[3]['trend'].toFixed(1));
			pageobj.find('.recentcold-eff4').html('EFF '+data.recentcold[4]['trend'].toFixed(1));
			pageobj.find('.recentcold-eff5').html('EFF '+data.recentcold[5]['trend'].toFixed(1));

			/*****hover*****/
			pageobj.find('.recentcold-mask0 div').html('Mins: '+data.recentcold[0]['min2']+',</br> FG: '+data.recentcold[0]['fgm2']+'-'+data.recentcold[0]['fga2']+', '+data.recentcold[0]['fgp2']+'%');
			pageobj.find('.recentcold-mask1 div').html('Mins: '+data.recentcold[1]['min2']+',</br> FG: '+data.recentcold[1]['fgm2']+'-'+data.recentcold[1]['fga2']+', '+data.recentcold[1]['fgp2']+'%');
			pageobj.find('.recentcold-mask2 div').html('Mins: '+data.recentcold[2]['min2']+',</br> FG: '+data.recentcold[2]['fgm2']+'-'+data.recentcold[2]['fga2']+', '+data.recentcold[2]['fgp2']+'%');
			pageobj.find('.recentcold-mask3 div').html('Mins: '+data.recentcold[3]['min2']+',</br> FG: '+data.recentcold[3]['fgm2']+'-'+data.recentcold[3]['fga2']+', '+data.recentcold[3]['fgp2']+'%');
			pageobj.find('.recentcold-mask4 div').html('Mins: '+data.recentcold[4]['min2']+',</br> FG: '+data.recentcold[4]['fgm2']+'-'+data.recentcold[4]['fga2']+', '+data.recentcold[4]['fgp2']+'%');
			pageobj.find('.recentcold-mask5 div').html('Mins: '+data.recentcold[5]['min2']+',</br> FG: '+data.recentcold[5]['fgm2']+'-'+data.recentcold[5]['fga2']+', '+data.recentcold[5]['fgp2']+'%');			
		
			$('.recentcoldtable').empty();
			for( var i=6;i<15;i++){
				var tablerow = data['recentcold'][i];
				
				var scoreTable = $('<tr class="report-detail" />').appendTo('.recentcoldtable');
				
				scoreTable.append('<td>'+(i*1+1)+'</td>');
				scoreTable.append('<td style="text-align:left"><a href="careerStats?player='+tablerow['fbid']+'" target="_blank" style="text-decoration:none;color:#fff">'+tablerow['player']+' ('+tablerow['team']+' - '+tablerow['position']+')</a></td>');			
				scoreTable.append('<td>'+tablerow['min2']+'</td>');
				scoreTable.append('<td>'+tablerow['pts2']+'</td>');
				scoreTable.append('<td>'+tablerow['treb2']+'</td>');
				scoreTable.append('<td>'+tablerow['ast2']+'</td>');
				scoreTable.append('<td>'+tablerow['trend'].toFixed(1)+'</td>');
			}			
			
			
			
		}).error(function(e){

		});
	
		
		
	}
	
	
	
});
