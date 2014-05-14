<?php
require_once('dbnew.php');

$D=array(a=>array(x=>5,y=>0),b=>array(x=>4,y=>3),c=>array(x=>8,y=>1));
//print_r($D);
//exit;

/*$stack = array(1, 2);
print_r($stack);
array_push($stack, 3);
print_r($stack);
exit;
*/
/*
$inputid = '3704';
$catearray=array('cast','cst');
$inputcate=implode('+',$catearray);
*/
$playerid = '2625';
$catearray=array('cast','cst');
$catesum=implode('+',$catearray);

$op=fg_careerstats($playerid,$catesum);
print_r($op);   echo '<br />';echo '<br />';echo '<br />';
print_r($op[0]);   echo '<br />';echo '<br />';echo '<br />';
print_r($op[1]);   echo '<br />';echo '<br />';echo '<br />';


//////////////////////////////////////////////
//////建構資料(單純資料，下面有建構標籤)//////
function fg_careerstats($inputid,$inputcate){
//功能  : 建構careerstats資料
//input : ID,cate
//output: careerdata

	///撈SQL並計算sum///
	$db = new DBnew();
	$sql="SELECT $inputcate AS colsum,season,team FROM careerstats WHERE fbid='$inputid'";
	$careerstats=$db->getData($sql,'assoc');
		
	///轉換array，key:0123變成team///
	foreach($careerstats as $cd){
		$data[$cd['team']][$cd['season']]=$cd['colsum'];
	}
		
	///建構careerdata///
	$sql="SELECT team FROM careerstats WHERE fbid='$inputid' GROUP BY team ORDER BY season";
	$uniteam=$db->getData($sql,'assoc');
	$sql="SELECT season FROM careerstats WHERE fbid='$inputid' GROUP BY season";
	$uniseason=$db->getData($sql,'assoc');

	foreach($uniseason as $unis){
	    $label[$unis['season']]=array();
		foreach($uniteam as $key=>$unit){
					
			///資料///
			$pickteam = $unit['team'];
			$datain = isset($data[$pickteam][$unis['season']])?round($data[$pickteam][$unis['season']],4):NULL;
			$careerdata[$pickteam][$unis['season']] = $datain;
			///處理標籤///
			/*
			if(isset($data[$pickteam][$unis['season']])){
				if(is_null($label[$unis['season']])){
					$label[$unis['season']].=$pickteam;
				}else{
					$label[$unis['season']].="&".$pickteam;
				}
			}
			*/
			if( isset($data[$pickteam][$unis['season']]) )
				array_push($label[$unis['season']],$pickteam);
			
		}
		//$label[$unis['season']] = implode('&',$label[$unis['season']]);
	}
	$output=array($careerdata,$label);
	return $output;
}

?> 









