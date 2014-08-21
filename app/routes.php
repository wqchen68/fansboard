<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//dtesttim
Route::any('test', function(){	
    //test
	$player = Player::getRealtime()->getData()->value;
	$root1 = rand(0,2);
	
	if( $root1==0 ){
		$player0 = $player[0];
		$player1 = $player[1];
		$player[0] = $player1;
		$player[1] = $player0;
	}elseif( $root1==1 ){
		$player0 = $player[2];
		$player1 = $player[3];
		$player[2] = $player1;
		$player[3] = $player0;
	}else{
		$player0 = $player[4];
		$player1 = $player[5];
		$player[4] = $player1;
		$player[5] = $player0;	
	}

	$output = array();
	for($i=0;$i<20;$i++){
		array_push($output,$player[$i]);
	}
	
	return Response::json($output);	
});

Route::get('/', function(){
	
	if( !in_array($_SERVER['REMOTE_ADDR'],array('140.122.118.208','140.122.118.147')) )
	DB::table('log_view')->insert(array(
		'datetime' => date('Y-m-d H:i:s'),
		'ip' => $_SERVER['REMOTE_ADDR'],
		'query' => 'home'
	));
	

	$contents = View::make('home')			
			->nest('child_tab','index_tab')
			->nest('child_main','main')
			->nest('child_footer','footer');
	$response = Response::make($contents, 200);
	$response->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	$response->header('Pragma', 'no-cache');
	$response->header('Last-Modified', gmdate( 'D, d M Y H:i:s' ).' GMT');
	return $response;
	
});
Route::get('subs/{name}', 'HomeController@showNopage');
Route::any('data/{name}', array('before'=>'player','uses'=>'HomeController@showData'));
Route::any('sort/{name}', 'HomeController@showSort');

Route::get('user/{name}', array('before'=>'id','uses'=>'HomeController@test'))->where('name', '[A-Za-z]+');

Route::get('/{pagename}', function($pagename = null){
	if (empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
		$myip = $_SERVER['REMOTE_ADDR'];  
	} else {  
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
		$myip = $ip[0];  
	}
	Session::put('ip', $myip);
	$handle=fopen('log/login.txt','a+');
	fwrite($handle,'['.date('d/m/y H:i:s').'] '.$myip.' index'.$_SERVER['QUERY_STRING']."\n");
	fclose($handle);
	
	if( !preg_match("/^[a-zA-Z0-9=,]+$/",$_SERVER['QUERY_STRING']) ){
		$query = '';
	}else{
		$query = $_SERVER['QUERY_STRING'];
	}	
	
	if( !in_array($_SERVER['REMOTE_ADDR'],array('140.122.118.208','140.122.118.147')) )
	DB::table('log_view')->insert(array(
		'datetime' => date('Y-m-d H:i:s'),
		'ip' => $_SERVER['REMOTE_ADDR'],
		'query' => $pagename,
		'parameter' => $query
	));
	
	
	//mobile-----------
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_browser = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
	//mobile-----------
	$mobile_browser = false;
	

	

	//App::setLocale('zh-tw');	
	
	Session::put('verifier', Input::get('oauth_verifier',''));
	Session::put('request_token', Input::get('oauth_token',''));
	
	Form::macro('tabi', function($pagename_input,$pagenametext,$state='') use($pagename) { 
		return '<li class="tabi"><a href="'.$pagename_input.'" '.($pagename==$pagename_input?'index="0"':'').' class="menu-tab-link button '.$state.($pagename==$pagename_input?' init':'').'" acsrc="'.$pagename_input.'"  title="'.Lang::get('description.'.$pagename_input).'">'.$pagenametext.'</a></li>';
	}); 
	$url_add = Input::get('player','')!=''?'?player='.Input::get('player',''):'';
	
	$player = Input::get('player','')!='' ? explode(' ',Input::get('player','')) : ['Kevin-Durant'];
	
	$player = array_diff($player, array(''));
	$player = array_slice( $player, 0 );
	
	$og_image = '';
	foreach( $player as $p ){
		if( is_file('player/'.$p.'.png') ){
			$og_image .= '<meta property="og:image" content="http://www.fansboard.com/player/'.$p.'.png" />'."\n";
		}		
	}

	View::share('pagename', $pagename);
	$contents = View::make('index',array('og_image'=>$og_image,'url_add'=>$url_add,'full_url'=>$pagename.$url_add,'player'=>json_encode($player)))
			->nest('addin','addin')
			->nest('mainmenu', $mobile_browser ? 'mainmenu_mobile' : 'mainmenu',array('pagename'=>$pagename))
			->nest('testi','subs.'.$pagename)
			->nest('child_footer','footer');
	$response = Response::make($contents, 200);
	$response->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	$response->header('Pragma', 'no-cache');
	$response->header('Last-Modified', gmdate( 'D, d M Y H:i:s' ).' GMT');
	return $response;
});


Route::filter('player', function() {
	$player_array = Input::get('player');	
	if( is_array($player_array) )
	foreach( $player_array as $player ){
		$fbid = $player['fbid'];
		if( !preg_match("/^[a-zA-Z0-9-]+$/",$fbid) )
			return '';
	}
});

App::error(function(InvalidArgumentException $exception){	
	return Response::view('error', array(), 404);
});
 
Route::get('get/pointer', 'AnalysisController@pointer');

Route::get('yahoo/sent', function(){
	return View::make('getyahoo');
});



Route::any('future', function(){	
	return View::make('future.future');
});
Route::any('future_get', function(){
	return View::make('future.index');
});
Route::any('future_get_stocks', function(){	
	return View::make('future.getStocks');
});
Route::any('future_get_price', function(){	
	return View::make('future.getPrice');
});
Route::post('exporting/get', function(){
	return View::make('exporting.index');
});
