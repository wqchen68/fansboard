<?php
///debug note、warning///
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
///連SQL///
require_once('dbnew.php');

$db = new DBnew();
$sql = " SELECT fbid,player,report FROM rwtable ";
$allreport = $db->getData($sql,'assoc');


//print_r($rwid[0]['report']);


foreach($allreport as $key => $pr){

	if (strpos($pr['report'], "sign")|strpos($pr['report'], "contract")){
		$signcontract[$pr['fbid']]=$pr['report'];		
	}
	if (strpos($pr['report'], "not expected to play")|strpos($pr['report'],"will not play")){
		$injure[$pr['fbid']]=$pr['report'];
	}
}

print_r($signcontract);
echo "<br />";
echo "<br />";
echo "<br />";
print_r($injure);


?> 