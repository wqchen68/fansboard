<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function showNopage($name){
		//$contents = View::make('subs.'.$name);
		//$response = Response::make($contents, 200);
		//$response->header('Last-Modified', gmdate( 'D, d M Y H:i:s' ));
		return View::make('subs.'.$name);
	}
	
	public function showSort($name){
		if (empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
			$myip = $_SERVER['REMOTE_ADDR'];  
		} else {  
			$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
			$myip = $ip[0];  
		}
		if( !in_array($_SERVER['REMOTE_ADDR'],array('140.122.118.208','140.122.118.147')) ){
			$handle=fopen('log/login_sort.txt','a+');
			fwrite($handle,'['.date('d/m/y H:i:s').'] '.$myip.' run:'.$name."\n");
			fclose($handle);
		}
		
		return Player::$name();
	}
	
	public function showData($name){
		$handle=fopen('log/login.txt','a+');
		fwrite($handle,'['.date('d/m/y H:i:s').'] '.Session::get('ip').' run:'.$name."\n");
		fclose($handle);
		

		$query = '';
		if( is_array(Input::get('player')) ){
			$fbids = array_fetch(Input::get('player'),'fbid');
			$query = implode('+', $fbids);
		}
		if( !in_array($_SERVER['REMOTE_ADDR'],array('140.122.118.208','140.122.118.147')) ){
			DB::table('log_data')->insert(array(
				'datetime' => date('Y-m-d H:i:s'),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'query' => $name,
				'parameter' => $query
			));
		}else{
			DB::table('log_data_test')->insert(array(
				'datetime' => date('Y-m-d H:i:s'),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'query' => $name,
				'parameter' => $query
			));
		}


				
		return Player::$name();
	}
	
	public function test(){
		return 'bb';
	}
	

	

}