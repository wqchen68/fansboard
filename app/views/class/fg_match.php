<?php
///debug note、warning///
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
///連SQL///
require_once('dbnew.php');

$inputID='3956';
$inputdatrange='ALL';
$inputmethod=1;

/*$op=fg_match($inputID,$inputdatrange,$inputmethod);
echo $op[0];         echo '<br />';
echo $op[1];         echo '<br />';
echo $op[2];         echo '<br />';
echo $op[3];         echo '<br />';
echo $op[4];         echo '<br />';
*/


//function fg_match($inputID,$inputdatrange,$inputmethod){
//功能  : match 相似球員
//input : ID,datarange,數學方法
//output: 前5個相似球員ID
	$db = new DBnew();
	$sql = " SELECT id,Zwfgp,Zw3ptm,Zwftp,Zwtreb,Zwast,Zwto,Zwst,Zwblk,Zwpts FROM syncdataframe WHERE datarange='$inputdatrange' AND id='$inputID' ORDER BY id";
	$pickprdata = $db->getData($sql,'assoc');
	$sql = " SELECT id,Zwfgp,Zw3ptm,Zwftp,Zwtreb,Zwast,Zwto,Zwst,Zwblk,Zwpts FROM syncdataframe WHERE datarange='$inputdatrange' ORDER BY id";
	$allprdata = $db->getData($sql,'assoc');

	//演算法
	if($inputmethod==1){
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
	}elseif($inputmethod==2){
		foreach($allprdata as $key => $player){
			$dist[$player['id']] = stats_standard_deviation(array(
		    	                 ($player['Zwfgp']-$pickprdata[0]['Zwfgp']), 
		        	             ($player['Zw3ptm']-$pickprdata[0]['Zw3ptm']), 
		            	         ($player['Zwftp']-$pickprdata[0]['Zwftp']),
		                	     ($player['Zwtreb']-$pickprdata[0]['Zwtreb']), 
		                    	 ($player['Zwast']-$pickprdata[0]['Zwast']), 
		    	                 ($player['Zwto']-$pickprdata[0]['Zwto']), 
		        	             ($player['Zwst']-$pickprdata[0]['Zwst']), 
		            	         ($player['Zwblk']-$pickprdata[0]['Zwblk']), 
		                	     ($player['Zwpts']-$pickprdata[0]['Zwpts'])),1);
		}
	}

	print_r($dist);
	exit;

	asort($dist);
	print_r($dist);
	exit;

	$distkey=array_keys($dist);

	print_r($distkey);
	exit;

	$matchop=array($distkey[1],$distkey[2],$distkey[3],$distkey[4],$distkey[5]);
	return $matchop;
//}

?>



