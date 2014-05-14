<?php
require_once('dbnew.php');

$inputid = '3704';
$inputseason = '2012';
//$op=fg_updategamelog($playerid);

//function fg_updategamelog($inputid){
//功能  : load yahoo sport 基本資料
//input : ID
//output: 基本資料

	$db = new DBnew();
	$sql="SELECT geff FROM gamelog WHERE fbid='$inputid' AND season='$inputseason'";
	//$sql="SELECT gast,gst FROM gamelog WHERE fbid='$inputid' AND season='$inputseason'";
	$gamelog=$db->getData($sql,'assoc');
	print_r($gamelog);          echo '<br />';
	echo $gamelog[0][gast];     echo '<br />';
	echo $gamelog[0][gst];     echo '<br />';

	/*foreach($gamelog as $key => $gd){
		$data[$key]=array_sum($gd);
	}
    print_r($data);          echo '<br />';
	exit;*/
	
	
	/*foreach($gamelog as $key => $gd){
		$data[$key]=$gd['geff'];
	}
	print_r($data);          echo '<br />';
	exit;*/
	
	foreach($gamelog as $key => $gd){
		if ($key<=1){
			$ma3[$key]=NULL;
			$ma6[$key]=NULL;
			$ma9[$key]=NULL;
		}elseif($key>=2 && $key<=4){
			$ma3[$key]=($gd[$key]['geff']+$gd[$key-1]['geff']+$gd[$key-2]['geff'])/3;
			$ma6[$key]=NULL;
			$ma9[$key]=NULL;
		}elseif($key>=5 && $key<=7){
			$ma3[$key]=($gd[$key]['geff']+$gd[$key-1]['geff']+$gd[$key-2]['geff'])/3;
			$ma6[$key]=($gd[$key]['geff']+$gd[$key-1]['geff']+$gd[$key-2]['geff']+$gd[$key-3]['geff']+$gd[$key-4]['geff']+$gd[$key-5]['geff'])/3;
			$ma9[$key]=NULL;
		}else{
			$ma3[$key]=($gd[$key]['geff']+$gd[$key-1]['geff']+$gd[$key-2]['geff'])/3;
			$ma6[$key]=($gd[$key]['geff']+$gd[$key-1]['geff']+$gd[$key-2]['geff']+$gd[$key-3]['geff']+$gd[$key-4]['geff']+$gd[$key-5]['geff'])/3;
			$ma9[$key]=($gd[$key]['geff']+$gd[$key-1]['geff']+$gd[$key-2]['geff']+$gd[$key-3]['geff']+$gd[$key-4]['geff']+$gd[$key-5]['geff']+$gd[$key-6]['geff']+$gd[$key-7]['geff']+$gd[$key-8]['geff'])/3;
		}
	}
	print_r($ma3);      echo '<br />';
	print_r($ma6);      echo '<br />';
	print_r($ma9);      echo '<br />';


  
//  }

?> 