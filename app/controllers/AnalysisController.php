<?php

class AnalysisController extends BaseController {

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
	
	public function pointer(){
		
		Config::set('database.default','fbasket_question');
		$scid = Input::get('scid');
		$CID = Input::get('cid');
		$QID = Input::get('qid');

		$QID_array = explode(',',$QID); 

		$census_tablename = DB::table('census_info')->where('CID',$CID)->pluck('census_tablename');
		$spss_name = DB::table('question')->whereIn('QID',$QID_array)->lists('spss_name');


		$select = DB::table('question_data.'.$census_tablename)->where('w_final','!=','')->where(function($query) use($spss_name){
			foreach($spss_name as $sn){
				$query->whereNotIn($sn,array('',-8,-9));
			}		
		})->groupBy('shid')->select('shid');
		foreach($spss_name as $key => $name){
			$select->addSelect(DB::raw('(SUM('.$name.'*w_final)/SUM(w_final)) AS wvar'.$key));
		}
		$pointer = $select->get();


		$spss_name_length = count($spss_name);
		$pickdata = array();
		foreach($pointer as $key => $p){
			$pickdata['shid'][$key] = $p->shid;
			for($i=0;$i<$spss_name_length;$i++){
				$wvar = 'wvar'.$i;			
				$pickdata['wvar'.$i][$key] = $p->$wvar;
			}
		}

		//print_r($pickdata);

		//////標準差函數//////
		function standard_deviation($aValues, $bSample = false){
			$fMean = array_sum($aValues) / count($aValues);
			$fVariance = 0.0;
			foreach ($aValues as $i)
			{
				$fVariance += pow($i - $fMean, 2);
			}
			$fVariance /= ( $bSample ? count($aValues) - 1 : count($aValues) );
			return (float) sqrt($fVariance);
		}

		//計算Zscore//
		$shid=$pickdata['shid'];
		for($i=1;$i<sizeof($pickdata);$i++){
			$wvarstr='wvar'.($i-1);
			//print_r("wvar".$i);
			$pickmean=array_sum($pickdata[$wvarstr])/count($pickdata[$wvarstr]);
			$pickstd=standard_deviation($pickdata[$wvarstr],0);	

			//print_r(array_sum($pickdata[$wvarstr])); echo "\n";
			//print_r(count($pickdata[$wvarstr])); echo "\n";
			//print_r($pickmean); echo "\n";
			//print_r($pickstd); echo "\n";

			$wvar=$pickdata[$wvarstr];
			foreach($wvar as $key => $pd){
				$Zwvar[$shid[$key]][$wvarstr]=($pd-$pickmean)/$pickstd;
			}	
		}
		echo "\n";echo "\n";

		//Zscore相加//
		$sumZwvar = array();
		foreach($Zwvar as $key => $zd){
			$sumZwvar[$key]['sumZwvar']=array_sum($zd);
		}	

		//Rank//	
		arsort($sumZwvar);
		$i=0;
		foreach($sumZwvar as $key => $rd){
			$i+=1;
			//$PRdata[$key]['sumZwvar']=$rd['sumZwvar'];
			//$PRdata[$key]['PRank']=100-ceil($i/count($sumZwvar)*100);
			$PRdata[$key]=100-ceil($i/count($sumZwvar)*100);
		}

		//print_r($Zwvar);

		$output = Input::has('scid') ? $PRdata[$scid] : $PRdata;
		return Response::json($output);	
	
	}
	

	

}