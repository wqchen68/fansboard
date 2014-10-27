<!DOCTYPE html>

<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" xmlns:ng="http://angularjs.org" lang="en" xml:lang="en" ng-app="app">
	
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

<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/Highcharts-4.0.3/js/highcharts.js"></script>
<script src="/js/Highcharts-4.0.3/js/highcharts-more.js"></script>
<script src="/js/Highcharts-4.0.3/js/modules/exporting.src.js"></script>
<script src="/js/highcharts.theme.js"></script>
<script src="/js/player.js"></script>
<script src="/js/module.js"></script>
<script src="/js/angular.min.js"></script>
<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->

<link rel="stylesheet" href="/css/onepcssgrid.css" />
<link rel="stylesheet" href="/css/onepcssgrid-1p.css" />
<link rel="stylesheet" href="/css/index.css" />
<link rel="stylesheet" href="/css/share.css" />
<link rel="stylesheet" href="/js/smoothness/jquery-ui-1.10.3/jquery-ui-1.10.3.custom.min.css" />
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">-->
<link rel="stylesheet" href="/css/font-awesome.css" />

<script type="text/javascript">
var pageobj;
var radarChart;
var playerInit = <?=$player?>;
var funcArray = [];
var pageIndex = 0;
var jsfiles = ['playerAbility'];
var app = angular.module('app', []);

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

				newmove.load('/subs/'+acsrc, function(){	
					pageIndex = index_current;
					funcArray[pageIndex] = new Object();
					move(true,index_current);
					insertList();
				});
			}
	
			window.history.pushState('', '', '/'+acsrc);	
			
			$('title').html(c.text()+' - Fansboard');
            
			
		}else{
			c.addClass('active');
			c.removeClass('init');
		}        
                      
		$('a.menu-tab-link.active').removeClass('active');
		c.addClass('active');
		d.addClass('active').siblings().removeClass('active');
		
		d.siblings().find('h4').eq(0).css('left', '');
		d.siblings().find('h4').eq(1).css('left', '100%');
        
        d.find('h4').html(c.text());
        
        changeFb();
		
	});
	
	funcArray[pageIndex] = new Object();
	pageobj = $('#testi div.move.active');	
	insertList();	

    getScript(function(){
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
		var width = $('#testi .move').width();
		
		var pre = $('#testi .move.active');
		var now = $('#testi .move[index='+index+']');
		
		pre.stop().hide();
        
        now.css('left', width).show().stop().animate({
            left: '0%'
        },200,function(){		
            getScript(function(){
                if( init ){
                    pageobj.trigger('startjs');
                }else{
                    pageobj.trigger('init');
                }
            });
        });
        
		pre.removeClass('active');
		now.addClass('active');	
	};
    
    function getScript(handle) {
        jQuery.ajaxSetup({
          cache: true
        });
        var script = '/js/hightchart.' + location.pathname.split('/')[1] + '.js';
        $.getScript(script, function(){                    
            handle();
        });
    }

});
</script>
</head>

<body>
	
<div style="position: relative;min-height: 100%;">
	
	<?=$mainmenu?>
	
    <div id="testi" style="position:absolute;bottom:50px;top:52px;overflow:auto">
        <div class="move active" index="0" style="height:100%"><?=$testi?>
            <div style="position: absolute ; top:10px; left:1550px">
                
                <div class="fb-like" data-href="" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                <div class="fb-comments" data-href="" data-width="300" data-numposts="5" data-colorscheme="light"></div>
                <div id="fb-root"></div>

            </div>            
        </div>
    </div>
	
	<div style="background-color:#fff;width:100%;height:50px;position:absolute;bottom:0px">

		<div class="onepcssgrid-full">
			<div class="onerow">
				<?=$child_footer?>
			</div>
		</div>

	</div>
	
</div>
	
<?=$addin?>
	
</body>
</html>
