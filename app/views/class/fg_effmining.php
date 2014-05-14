<?php
///debug note、warning///
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
///連SQL///
require_once('dbnew.php');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://sports.yahoo.com/nba/scoreboard?d=2013-05-01"); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ''); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$tuData = curl_exec($ch); 
curl_close($ch); 

require_once("simple_html_dom/simple_html_dom.php");
$dom = str_get_html($tuData);

$gamestr = $dom->find('#ysp-leaguescoreboard .ysptblclbg3 tbody');

foreach($gamestr as $key => $gm){
	$gameid = $gm->find('table',1)->find('tr[valign=bottom]',0)->find('a',0)->href;
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://sports.yahoo.com'.$gameid);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, ''); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$tuData = curl_exec($ch);
	curl_close($ch);

	$dom = str_get_html($tuData);	

	$boxscore4 = $dom->find('#ysp-reg-box-game_details-game_stats div.bd TBODY'); //四個區塊，2個starters，2個bench
	
	//echo $boxscore4[0]->innertext;
	//exit;
	
	foreach($boxscore4 as $key => $ptm){
	
		$rowpr = $ptm->find('tr'); //區塊內一個row
		
		//echo $rowpr[0]->innertext;
		//exit;

		foreach($rowpr as $key => $cell){
	 		$stat = $cell->find('td');
			if(count($stat)>=15){ //扣除DNP
				$name = $cell->find('span.ysp-player a',0)->innertext;
				$id = $cell->find('span.ysp-player a',0)->href;
				$id = basename($id);
				$stat = array_slice($stat,-14,14);
				$data[$id]['name'] = $name;
				$data[$id]['id'  ] = $id;
				$data[$id]['time'] = $stat[0]->innertext;
				$data[$id]['fgm' ] = substr($stat[1]->innertext,0,strpos($stat[1]->innertext,'-'));
				$data[$id]['fga' ] = substr($stat[1]->innertext,strpos($stat[1]->innertext,'-')+1,strlen($stat[1]->innertext)-strpos($stat[1]->innertext,'-')-1);
				$data[$id]['3ptm'] = substr($stat[2]->innertext,0,strpos($stat[2]->innertext,'-'));
				$data[$id]['3pta'] = substr($stat[2]->innertext,strpos($stat[2]->innertext,'-')+1,strlen($stat[2]->innertext)-strpos($stat[2]->innertext,'-')-1);
				$data[$id]['ftm' ] = substr($stat[3]->innertext,0,strpos($stat[3]->innertext,'-'));
				$data[$id]['fta' ] = substr($stat[3]->innertext,strpos($stat[3]->innertext,'-')+1,strlen($stat[3]->innertext)-strpos($stat[3]->innertext,'-')-1);
				$data[$id]['tnp' ] = $stat[4 ]->innertext;
				$data[$id]['oreb'] = $stat[5 ]->innertext;
				$data[$id]['treb'] = $stat[6 ]->innertext;
				$data[$id]['ast' ] = $stat[7 ]->innertext;
				$data[$id]['to'  ] = $stat[8 ]->innertext;
				$data[$id]['st'  ] = $stat[9 ]->innertext;
				$data[$id]['blk' ] = $stat[10]->innertext;
				$data[$id]['ba'  ] = $stat[11]->innertext;
				$data[$id]['pf'  ] = $stat[12]->innertext;
				$data[$id]['pts' ] = $stat[13]->innertext;
				$data[$id]['eff' ] =($data[$id]['pts']+$data[$id]['treb']+$data[$id]['ast']+$data[$id]['st']+$data[$id]['blk'])-(($data[$id]['fga']-$data[$id]['fgm'])+($data[$id]['fta']-$data[$id]['ftm'])+($data[$id]['to']));
                ///// EFF={ (得分+籃板+助攻+抄截+火鍋) - [(出手次數-命中數)+(罰球次數-罰球命中數)+失誤] } /////
				//echo $data[$id]['name'];   echo '<br />';
				//echo $data[$id]['time'];   echo '<br />';
				//echo $data[$id]['fgm'];    echo '<br />';
				//exit;
				//print_r($data);
				//exit;
				print_r($data[$id]); echo '<br />';
				
				echo "('".implode("','",$data[$id])."')";
				exit;
			}			
		}
	}
}


$db=new DBnew();
$sql="UPDATE realtimeeff SET $data";
$db->Query($sql);


?> 