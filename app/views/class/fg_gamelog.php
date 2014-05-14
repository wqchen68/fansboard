<?php
require_once('dbnew.php');


$db = new DBnew();



exit;
$playerid = '3704';
$loadseason = '2012';
$op=fg_updategamelog($playerid,$loadseason);
print_r($op);


function fg_updategamelog($inputid,$inputseason){
//功能  : 計算gamelog的MA
//input : ID,season
//output: data,ma3,ma6,ma9

	///撈SQL///
	$db = new DBnew();
	$colum = implode(',',$inputarray);
	$sql="SELECT $colum FROM gamelog WHERE fbid='$inputid' AND season='$inputseason'";
	$gamelog=$db->getData($sql,'assoc');

	///合併比項///
	foreach($gamelog as $key => $gd){
		$data[$key]=array_sum($gd);
	}
  	
	///計算MA///
	for($i=0;$i<count($data);$i++){
		if ($i<=1){
			$ma3[$i]=NULL;
			$ma6[$i]=NULL;
			$ma9[$i]=NULL;
		}elseif($i>=2 && $i<=4){
			$ma3[$i]=($data[$i]+$data[$i-1]+$data[$i-2])/3;
			$ma6[$i]=NULL;
			$ma9[$i]=NULL;
		}elseif($i>=5 && $i<=7){
			$ma3[$i]=($data[$i]+$data[$i-1]+$data[$i-2])/3;
			$ma6[$i]=($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5])/6;
			$ma9[$i]=NULL;
		}else{
			$ma3[$i]=($data[$i]+$data[$i-1]+$data[$i-2])/3;
			$ma6[$i]=($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5])/6;
			$ma9[$i]=($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5]+$data[$i-6]+$data[$i-7]+$data[$i-8])/9;
		}
	}
	
	return $data;
	//return $data,$ma3,$ma6,$ma9;
}

?> 









