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

		var limit = "00:24";
		var timeout_fc = options.timeout_zero;
		var msg1 = options.msg1;
		var msg2 = options.msg2;
		var speed = 1000;
		var parselimit;
		var cursec;
		
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
			cursec = parselimit%60;
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
			window.status = curtime;
			$('.reflashtime').html(curtime);

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
	

	

	
	
	
	reflashShadow = function() {
		if( $('.shadow:not(.fd)').length===0 )
			return false;
		
		arr = $.map( $('.effrank'), function( n, i ) {
			fbid = $(n).attr('fbid');
			if( $('.shadow:not(.fd)').is('[fbid='+fbid+']') )			
				return $('.shadow[fbid='+fbid+']').attr('fbid');
		});

		fbid = arr[0];
		
		rank_prev = $('.shadow[fbid='+fbid+']').attr('rank');
		rank_next = $('.effrank[fbid='+fbid+']').attr('rank');
		
		
		shoadow = $('.shadow[fbid='+fbid+']');
		
		shoadow.css('background-color','rgba(50,50,50,0.5)').addClass('fd').fadeOut(2350,function(){
			fbid = $(this).attr('fbid');
			$('.shadow[fbid='+fbid+']').remove();
			$('.effrank[fbid='+fbid+']').fadeIn(2500);			
		});
		
		if( $('.shadow').length>0 )
			setTimeout("reflashShadow()",5400);

	};
	
	reflashShadow2 = function() {
		changelength = $('.effrank.wait:hidden').length;
		
		fbid = $('.effrank.wait:hidden').eq(0).removeClass('wait').attr('fbid');
		
		
		$('.shadow[fbid='+fbid+']').fadeOut(2000,function(){
			fbid = $(this).attr('fbid');
			rank_prev = $('.shadow[fbid='+fbid+']').attr('rank');
			rank_next = $('.effrank[fbid='+fbid+']').attr('rank');
			
			$('.shadow[fbid='+fbid+']').remove();
			
			if( rank_prev>rank_next ){
				//$('.effrank[fbid='+fbid+']').slideDown(1000);
				$('.effrank[fbid='+fbid+']').fadeIn(2000);
			}else{
				$('.effrank[fbid='+fbid+']').fadeIn(2000);
			}
		});
		
		if( changelength>0 )
			setTimeout("reflashShadow2()",time_count.getsec()>10?1500:1000);
		

	};
	
	function reflasheff(){
		$.getJSON('sort/getRealtime',function(data_bag){
			console.log(data_bag);
            angular.element('[ng-controller=realtimeBoxController]').scope().realtimeBox = data_bag;
//			$('.teambox').html(data_bag['teambox']);
//			
//			var data = data_bag['value'];
//			$('.effrank:hidden').show();
//			$('.shadow').remove();			
//			for( var i in data ){
//					
//					var fbid = data[i].fbid;
//					var player = data[i].player;
//					var bxeff = data[i].bxeff;
//					var bxeffrate = bxeff*800/40;
//					var state1 = (data[i].effper>data_bag.efflv && data[i].livemark==='LIVE!')?'fast':'slow';
//					var state2 = (data[i].effper>data_bag.efflv && data[i].livemark==='LIVE!')?'hot':'slow';
//					var secAll = Math.round(data[i].bxmin*60);
//					var sec = (Math.round(data[i].bxmin*60)) % 60;
//					var min = (secAll-sec)/60;
//					var secText = new Array(2-sec.toString().length+1).join("0")+sec;
//
//					var rankline = $('<div class="effrank new wait" fbid="'+fbid+'" rank="'+i+'" style="display:none;width:100%;height:20px;margin: 7px"></div>');
//					rankline.append('<div class="rbxlist0 smallwidth" style="text-align:left">'+(i*1+1)+'</div>');
//					rankline.append('<div class="playerwidth" style="float:left;width:18%;text-align:left;overflow : hidden; text-overflow : ellipsis; white-space : nowrap"><a href="playerAbility?player='+fbid+'" target="_blank" style="text-decoration:none;color:#fff">'+data[i].player+'</a></div>');
//					rankline.append('<div class="rbxlist0 smallwidth" style="border-radius: 3px;line-height:20px;font-size:12px;font-weight:bold;text-align:center;background-color:'+data[i].colorback+';color:'+data[i].colorfont+'">'+data[i].team+'</div>');
//					rankline.append('<div class="rbxlist0 midwidth" style="text-align:left;margin-left:5px">'+data[i].oppo+'</div>');
//					rankline.append('<div class="rbxlist0 smallwidth" style="text-align:left">'+data[i].startfive+'</div>');
//					rankline.append('<div class="real-bar-eff"><div style="float:left;text-align:left;background-color:rgba(0,187,255,1);height:100%;font-weight:bold;width:'+(data[i].bxeff*500/50)+'px">'+data[i].bxeff+'</div></div>');
//					rankline.append('<div class="rbxlist0 midwidth '+state2+'" style="text-align:center">'+data[i].livemark+'</div>');					
//
//                    if (data[i].livemark='Fianl' && min>25 && data[i].bxeff<10){
//                        rankline.append('<div class="rbxlist1 midwidth" style="color:#FF3333;">'+min+':'+secText+'</div>');
//                        rankline.append('<div class="rbxlist1 midwidth" style="color:#FF3333;">'+data[i].bxfgm+'-'+data[i].bxfga+'</div>');
//                        rankline.append('<div class="rbxlist1 smallwidth" style="color:#FF3333;">'+data[i].bxpts+'</div>');
//                        rankline.append('<div class="rbxlist1 smallwidth" style="color:#FF3333;">'+data[i].bxtreb+'</div>');
//                        rankline.append('<div class="rbxlist1 smallwidth" style="color:#FF3333;">'+data[i].bxast+'</div>');
//                        rankline.append('<div class="rbxlist1 smallwidth" style="color:#FF3333;">'+data[i].bxst+'</div>');
//                        rankline.append('<div class="rbxlist1 smallwidth" style="color:#FF3333;">'+data[i].bxblk+'</div>');
//                        rankline.append('<div class="rbxlist1 smallwidth" style="color:#FF3333;">'+data[i].bx3ptm+'</div>');
//                    }else{
//                        rankline.append('<div class="rbxlist0 midwidth">'+min+':'+secText+'</div>');
//                        rankline.append('<div class="rbxlist0 midwidth">'+data[i].bxfgm+'-'+data[i].bxfga+'</div>');
//                        if (data[i].bxpts>14){
//                            rankline.append('<div class="rbxlist1 smallwidth" style="color:gold;">'+data[i].bxpts+'</div>');
//                        }else{
//                            rankline.append('<div class="rbxlist0 smallwidth">'+data[i].bxpts+'</div>');	
//                        }
//
//                        if (data[i].bxtreb>9){
//                            rankline.append('<div class="rbxlist1 smallwidth" style="color:gold;">'+data[i].bxtreb+'</div>');
//                        }else{
//                            rankline.append('<div class="rbxlist0 smallwidth">'+data[i].bxtreb+'</div>');
//                        }
//
//                        if (data[i].bxast>5){
//                            rankline.append('<div class="rbxlist1 smallwidth" style="color:gold;">'+data[i].bxast+'</div>');
//                        }else{
//                            rankline.append('<div class="rbxlist0 smallwidth">'+data[i].bxast+'</div>');
//                        }
//
//                        if (data[i].bxst>2){
//                            rankline.append('<div class="rbxlist1 smallwidth" style="color:gold;">'+data[i].bxst+'</div>');
//                        }else{
//                            rankline.append('<div class="rbxlist0 smallwidth">'+data[i].bxst+'</div>');
//                        }
//
//                        if(data[i].bxblk>2){
//                            rankline.append('<div class="rbxlist1 smallwidth" style="color:gold;">'+data[i].bxblk+'</div>');
//                        }else{
//                            rankline.append('<div class="rbxlist0 smallwidth">'+data[i].bxblk+'</div>');
//                        }                    
//
//                        if (data[i].bx3ptm>2){
//                            rankline.append('<div class="rbxlist1 smallwidth" style="color:gold;">'+data[i].bx3ptm+'</div>');
//                        }else{
//                            rankline.append('<div class="rbxlist0 smallwidth">'+data[i].bx3ptm+'</div>');
//                        }
//                    }
//                
//                
//                    
//					
//
//					if( $('.effrank').is('[fbid='+fbid+']') ){
//						
//						hasRank = true;
//						
//						if( $('.effrank[fbid='+fbid+']').attr('rank')===i ){
//							$('.effrank[fbid='+fbid+']').remove();							
//						}else{
//							$('.effrank[fbid='+fbid+']').removeClass('effrank').addClass('shadow');//.css('background-color','#ff0000');
//						}					
//						
//					}else{
//						
//						hasRank = false;
//
//					}
//					
//					rankline.insertAfter($('.effrank_t').eq(i));
//					
//					if( !$('.shadow').is('[fbid='+fbid+']') && hasRank ){
//						$('.effrank[fbid='+fbid+']').show();
//					}else 
//					if( !hasRank ){
//						$('.effrank[fbid='+fbid+']').fadeIn(2000);
//					}
//				
//			}
//			$('.effrank:not(.new)').remove();
//			$('.effrank').removeClass('new');			
			setTimeout("reflashShadow2()",500);
			
		}).error(function(e){

		});
	}
	
	
	
});