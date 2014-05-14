<?php
session_start();

$arg1='3956';
$arg2='ALL';
$arg3=1;


//function func1($arg1,$arg2,$arg3){
//}

require_once('dbnew.php');
$db = new DBnew();

$sql = " SELECT id,Zwfgp,Zw3ptm,Zwftp,Zwtreb,Zwast,Zwto,Zwst,Zwblk,Zwpts FROM syncdataframe WHERE datarange='ALL' AND id='$arg1' ORDER BY id";
$pickprdata = $db->getData($sql,'assoc');

$sql = " SELECT id,Zwfgp,Zw3ptm,Zwftp,Zwtreb,Zwast,Zwto,Zwst,Zwblk,Zwpts FROM syncdataframe WHERE datarange='ALL' ORDER BY id";
$allprdata = $db->getData($sql,'assoc');


echo $pickprdata[0][Zwfgp];        echo '<br />';
echo $allprdata[0][Zwfgp];     echo '<br />';


$tt1 = count($allprdata);
$tt2 = sizeof($allprdata);
echo $tt1;	   echo '<br />';
echo $tt2;	   echo '<br />';



foreach($allprdata as $key => $player){
	$dist[$player['id']] = pow($player['Zwfgp']-$pickprdata[0]['Zwfgp'],2) + 
	              pow($player['Zw3ptm']-$pickprdata[0]['Zw3ptm'],2) + 
	              pow($player['Zwftp']-$pickprdata[0]['Zwftp'],2) + 
                  pow($player['Zwtreb']-$pickprdata[0]['Zwtreb'],2) + 
	              pow($player['Zwast']-$pickprdata[0]['Zwast'],2) + 
	              pow($player['Zwto']-$pickprdata[0]['Zwto'],2) + 
	              pow($player['Zwst']-$pickprdata[0]['Zwst'],2) + 
	              pow($player['Zwblk']-$pickprdata[0]['Zwblk'],2) + 
	              pow($player['Zwpts']-$pickprdata[0]['Zwpts'],2);
}
//echo $dist;	   echo '<br />';
asort($dist);

$key_array = array_keys($dist);
$key_array[2];

echo 't'.$dist[$key_array[2]];
var_dump($dist);
exit;
for($i=0;$i<count($allprdata);$i++){
	$player = $allprdata[$i];
	$key = $i;
	
}

$max = count($allprdata);
for($i=0;$i<$max;$i++){
	$dist[$i] = $allprdata[$i];
	
}


asort($dist);
echo 't'.$dist[0];	   echo '<br />';

exit;



$dist=array();
foreach($cate1 as $player){ 
	array_push($dist,$player['Zwfgp']+$player['Zw3ptm']);
}																		

$dist=array();
for($i=0;$i<$tt;$i++){
	$dist[$i]=array_sum($cate9[$i]);
}

echo $cate9[2][1];																			echo '<br />';
echo $dist[2];																			echo '<br />';



?>