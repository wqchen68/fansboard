<!DOCTYPE html>

<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" lang="en" xml:lang="en">
	
<head>
	
<title><?=Lang::get('title.'.$pagename).' - Fansboard'?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />

<meta name="keywords" content="Basketball,Fantasy,NBA">
<meta name="description" content="<?=Lang::get('description.'.$pagename)?>">

<meta property="og:title" content="<?=Lang::get('title.'.$pagename).' - Fansboard'?>" />
<meta property="og:description" content="<?=Lang::get('description.'.$pagename)?>" />
<meta property="og:type" content="website" /> 
<?=$og_image?>
<meta property="og:image" content="http://www.fansboard.com/images/fb-logo.png" />
<meta property="og:url" content="http://www.fansboard.com/<?=$full_url?>" />
<meta property="og:site_name" content="Fansboard"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<script type="text/javascript" src="<?=asset('js/jquery-1.11.1.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/jquery-ui.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/Highcharts-4.0.3/js/highcharts.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/Highcharts-4.0.3/js/highcharts-more.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/Highcharts-4.0.3/js/modules/exporting.src.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/highcharts.theme.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/player.js')?>"></script>
<script type="text/javascript" src="<?=asset('js/module.js')?>"></script>
<!--[if lt IE 9]><script src="<?=asset('js/html5shiv.js')?>"></script><![endif]-->

<link rel="stylesheet" href="<?=asset('css/onepcssgrid.css')?>" />
<link rel="stylesheet" href="<?=asset('css/onepcssgrid-1p.css')?>" />
<link rel="stylesheet" href="<?=asset('css/index.css')?>" />
<link rel="stylesheet" href="<?=asset('css/share.css')?>" />
<link rel="stylesheet" href="<?=asset('js/smoothness/jquery-ui-1.10.3/jquery-ui-1.10.3.custom.min.css')?>" />
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">-->
<link rel="stylesheet" href="<?=asset('css/font-awesome.css')?>" />

<script type="text/javascript">
var pageobj;
var radarChart;
var playerInit = <?=$player?>;
var funcArray = [];
var pageIndex = 0;
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
                x: 0,
                y: 0,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#000',
                shadow: false
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
            },
        },
        navigation: {
            buttonOptions: {
                enabled: true,
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
			gridLineDashStyle: 'Dot',
	        min: 0,
	        max: 360,
	        labels: {
				formatter: function () {					
	        		return anglename[this.value];
	        	},
				style: {
					color: '#CCC',
					fontWeight: 'normal',
                    fontSize: 12,
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

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=251984733230&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);    
}(document, 'script', 'facebook-jssdk'));

function changeFb(){
    $('.fb-like').empty();
    $('.fb-like').attr('data-href', window.location.toString());
    $('.fb-comments').empty();
    $('.fb-comments').attr('data-href', window.location.toString());
    
    
    if( typeof(FB)==='object' ){
        FB.XFBML.parse();
    }
}

$(document).ready(function(){
	
	var index = 1;
	var index_current;
	
	
	$('.tab').on('click','a.menu-tab-link',function(e){		
		e.preventDefault();
		var c = $(e.currentTarget);
		var d = $(e.delegateTarget);	
				
		if( c.is('.active') || c.is('.lock') )
			return false;

		if( !c.is('.init') ){
			
			if( c.is('[index]') ){
				acsrc = c.attr('acsrc');
				index_current = c.attr('index');			
				pageobj = $('div.move[index='+index_current+']');			
				insertList();
				pageIndex = index_current;
				move(false,index_current);			
			}else{
				if( $(this).is('[acsrc]') ){
					acsrc = c.attr('acsrc');
				}else{
					acsrc = 'nopage';
				}
				var newmove = $('<div class="move" index="'+index+'" />').appendTo('#testi');
				c.attr('index',index);
				index_current = index;				
				index++;
				pageobj = newmove;

				newmove.load('subs/'+acsrc,function(){	
					pageIndex = index_current;
					funcArray[pageIndex] = new Object();
					move(true,index_current);
					insertList();
				});
			}

			url = window.location.toString().split('?').length>1
				? acsrc+'?'+window.location.toString().split('?')[1]
				: acsrc;		
			window.history.pushState('', '', '<?=asset('')?>'+url);	
			
			$('title').html(c.text()+' - Fansboard');
            
			
		}else{
			c.addClass('active');
			c.removeClass('init');
		}
	
        changeFb();
                      
		$('a.menu-tab-link.active').removeClass('active');
		c.addClass('active');
		d.addClass('active').siblings().removeClass('active');
		
		d.siblings().find('h4').eq(0).css('left', '');
		d.siblings().find('h4').eq(1).css('left', '100%');


		d.children('ul').hide(function(){
			
			d.find('h4').eq(0).stop().animate({
				left: '100%'//_width
			}).end().eq(1).css('left', '-100%').html(c.text()).stop().animate({
				left: '0%'
			},function(){
				d.children('ul').css('display','');				
			});
			
		});	
		
	});
	
	funcArray[pageIndex] = new Object();
	pageobj = $('#testi div.move.active');	
	insertList();	
	if( typeof pageobj.find('.javascript').attr('src') !== 'undefined' )
	$.getScript(pageobj.find('.javascript').attr('src'),function(){
		pageobj.trigger('startjs');
	});
	$('a.menu-tab-link.init').trigger('click');
    

    
	function insertList(){
		pageobj.find('.modelBox').each(function(){
			var mid= $(this).attr('mid');		
			$('.modelBox[mid='+mid+'].active').removeClass('active').children().appendTo(this);
			$(this).addClass('active');
			//fbModule.init(mid);
		});
		
		pageobj.find('.modelCol').css({
			left: '-200%'
		}).stop().animate({
			left: '0%'
		},200);
	}
		
	var move = function(init,index){
		_width = $('#testi .move').width();
		
		var pre = $('#testi .move.active');
		var now = $('#testi .move[index='+index+']');
		
		pre.stop().hide();

		if( init ){
			//now.css('left', '0%').show();
			//pageobj.trigger('init');
			now.css('left', _width).show().stop().animate({
				left: '0%'
			},200,function(){			
				$.getScript(pageobj.find('.javascript').attr('src'),function(){
					pageobj.trigger('startjs');
				});	
			});
		}else{		
			now.css('left', _width).show().stop().animate({
				left: '0%'
			},200,function(){
				pageobj.trigger('init');				
			});
		}
		
		pre.removeClass('active');
		now.addClass('active');	
	};
	

	
	//$('a.menu-tab-link.init').click();
	
	
	
	/*
	$(document).scroll(function(){
		var top = $(this).scrollTop();
		var topIs = $(this).data('top');		
		
		if( top<300 && !topIs){
			$(this).data('top',true);	
			$('#topbar').css({
				'position':'static',
				'box-shadow': 'none'
			});	
		}
		if( top>300 && topIs ){
			$(this).data('top',false);
			$('#topbar').css({
				'position':'fixed',
				'width':'100%',
				'box-shadow': '40px 40px 30px rgba(20%,20%,40%,0.5)'
			});
		}
	});
    */    
	
	/*
	 * 
	$('.msg').mouseover(function(){
		if( $(this).hasClass('small') ){
			$(this).animate({
				left: '80%',
				width: '19%'
			});
			console.log(1);
			$(this).removeClass('small');
		}
	}).mouseleave(function(){
		if( !$(this).hasClass('small') ){
			$(this).animate({
				left: '93%',
				width: '6%'
			});
			console.log(2);
			$(this).addClass('small');
		}
	});
	 *
	 */



});
</script>
<style>

</style>
</head>

<body>
	
<div style="position: relative;min-height: 100%;">
	
	<?=$mainmenu?>
	
	<div id="testi">
        <div class="move active" index="0"><?=$testi?>
            <div style="position: absolute ; top:10px; left:1550px">
                
                <?
                    $url2 = Request::url().'?'.Input::get('player');
                ?>
                
                <div class="fb-like" data-href="" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                <div class="fb-comments" data-href="" data-width="300" data-numposts="5" data-colorscheme="light"></div>
                <div id="fb-root"></div>

            </div>            
        </div>
    </div>
	
	<div style="background-color:#fff;width:100%;height:70px">

		<div class="onepcssgrid-full">
			<div class="onerow">
				<?=$child_footer?>
			</div>
		</div>

	</div>
	
</div>
	
<?=$addin?>

		<!--
		<div class="msg small" style="position:absolute;border:1px solid #fff;z-index:20;left:93%;width:6%">
			<div style="border-bottom:1px solid #fff;margin:5px;height:50px"></div>
			<div style="border-bottom:1px solid #fff;margin:5px;height:50px"></div>
			<div style="border-bottom:1px solid #fff;margin:5px;height:50px"></div>
			<div style="margin:5px;height:50px"></div>
		</div>
		-->
	
</body>
</html>
