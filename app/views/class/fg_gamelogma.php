<?php
///debug note、warning///
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
///連SQL///
require_once('dbnew.php');

/*
$inputid = '3704';
$inputseason = '2012';
$catearray=array('gast','gst');
$inputcate=implode('+',$catearray);
*/
$playerid = '3704';
$loadseason = '2012';
$catearray=array('gast','gst');
$catesum=implode('+',$catearray);

$op=fg_gamelogma($playerid,$loadseason,$catesum);
print_r($op);

function fg_gamelogma($inputid,$inputseason,$inputcate){
//功能  : 計算gamelog的MA
//input : ID,season
//output: madata=data,ma3,ma6,ma9

	///撈SQL並sum///
	$db = new DBnew();
	$sql="SELECT $inputcate AS colsum,ggp,gmin,gdate,goppo,gresult FROM gamelog WHERE fbid='$inputid' AND season='$inputseason'";
	$gamelog=$db->getData($sql,'assoc');

	///轉換array///
	foreach($gamelog as $key => $gd){
		$data[$key]=$gd['colsum'];
		$info['gp'][$key]=$gd['ggp'];
		$info['min'][$key]=$gd['gmin'];
		$info['date'][$key]=$gd['gdate'];
		$info['oppo'][$key]=$gd['goppo'];
	}
		
	///計算MA///
	for($i=0;$i<count($data);$i++){
		$madata['current'][$i]=$data[$i];
		if ($i<=1){
			$madata['ma3'][$i]=NULL;
			$madata['ma6'][$i]=NULL;
			$madata['ma9'][$i]=NULL;
		}elseif($i>=2 && $i<=4){
			$madata['ma3'][$i]=round(($data[$i]+$data[$i-1]+$data[$i-2])/3,2);
			$madata['ma6'][$i]=NULL;
			$madata['ma9'][$i]=NULL;
		}elseif($i>=5 && $i<=7){
			$madata['ma3'][$i]=round(($data[$i]+$data[$i-1]+$data[$i-2])/3,2);
			$madata['ma6'][$i]=round(($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5])/6,2);
			$madata['ma9'][$i]=NULL;
		}else{
			$madata['ma3'][$i]=round(($data[$i]+$data[$i-1]+$data[$i-2])/3,2);
			$madata['ma6'][$i]=round(($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5])/6,2);
			$madata['ma9'][$i]=round(($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5]+$data[$i-6]+$data[$i-7]+$data[$i-8])/9,2);
		}
	}
	$madata['current']=implode(',',$madata['current']);	
	$madata['ma3']=implode(',',$madata['ma3']);
	$madata['ma6']=implode(',',$madata['ma6']);
	$madata['ma9']=implode(',',$madata['ma9']);
	$madata['gp']=implode(',',$info['gp']);	
	$madata['min']=implode(',',$info['min']);
	$madata['date']=implode(',',$info['date']);	
	$madata['oppo']=implode(',',$info['oppo']);	
	
	return $madata;
}

?> 








