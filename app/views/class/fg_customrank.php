<?php
///debug note、warning///
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
///連SQL///
require_once('dbnew.php');


$get_array = $_GET['get_array'];
$player = $_GET['player'];




$inputid = '2625';
$inputdatarange = 'ALL';
$catearray=$get_array;
$inputcate=implode('+',$catearray);


$output = array();
foreach( $player as $p ){
	$op=fg_customrank($p,$inputdatarange,$inputcate);
	array_push($output,$op);
}


echo json_encode($output);



function fg_customrank($inputid,$inputdatarange,$inputcate){
//功能  : 計算客製化rank
//input : ID,datarange,比項
//output: rank

	///撈SQL並sum而且排序///
	$db = new DBnew();
	$sql="SELECT id,$inputcate AS catesum FROM syncdataframe WHERE datarange='$inputdatarange' ORDER BY catesum DESC";
	$catedata=$db->getData($sql,'assoc');

	///轉換array///
	foreach($catedata as $key => $cd){
		$newdata[$cd['id']]['catesum']=$cd['catesum'];
		$newdata[$cd['id']]['rank']=$key;
	}
	$prrank=$newdata[$inputid]['rank']+1;
	return $prrank;
}

?> 








