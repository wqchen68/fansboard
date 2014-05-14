<?php

///debug note、warning///
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
///連SQL///
require_once('dbnew.php');



$news = array();
foreach($_GET['id'] as $playerid){
	if( !preg_match("/^[0-9]+$/",$playerid) ) exit;
	
	$db = new DBnew();
	$sql = " SELECT rwid FROM rwtable WHERE fbid='$playerid'";
	$rwid = $db->getData($sql,'assoc');
	
	$op=fg_rotoworld($rwid[0]['rwid']);
	array_push($news,$op);
}











echo json_encode($news);

function fg_rotoworld($inputid){
//功能  : load rotoworld最新消息
//input : ID
//output: 消息

	//計算(現在時間-上次更新時間)(單位:分鐘)
	$db=new DBnew();
	$sql="SELECT TIMESTAMPDIFF(MINUTE,updatetime,NOW()) AS timekey FROM rwtable WHERE rwid='$inputid'";
	$timediff=$db->getData($sql,'assoc');
	$tt=$timediff[0]['timekey'];

	if($tt>5){//大於間隔時間:load網頁，並且儲存至SQL，再秀news
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.rotoworld.com/player/nba/$inputid"); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ''); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$tuData = curl_exec($ch); 
		curl_close($ch); 

		require_once("simple_html_dom/simple_html_dom.php");
		$dom = str_get_html($tuData);

		$report = $dom->find('#RW_main div.playernews div.report',0);
		$impact = $dom->find('#RW_main div.playernews div.impact',0);
		$date = $dom->find('#RW_main div.playernews div.impact span.date',0);
		$info = $dom->find('#RW_main div.playernews div.source',0);

		$report1=$report->innertext; //抓html裡的文字
		$impact1=$impact->innertext;
		$date1=$date->innertext;
		$info1=$info->innertext;
		$report2=str_replace("'","\'",$report1); //取代跳脫字元
		$impact2=str_replace("'","\'",$impact1);
		$date2=str_replace("'","\'",$date1);
		$info2=str_replace("'","\'",$info1);

		$db=new DBnew();
		$sql_update = "UPDATE rwtable SET report='$report2',impact='$impact2',date='$date2',info='$info2',updatetime=now() WHERE rwid='$inputid'";
		$db->Query($sql_update);

		//$news=array($report2,$date2,$info2);
		//echo 2;
	}
	
	$sql="SELECT report,date,info FROM rwtable WHERE rwid='$inputid'";
	$res=$db->getData($sql,'assoc');
	$news=array($res[0]['report'],$res[0]['date'],$res[0]['info']);
	return $news;
}

?> 