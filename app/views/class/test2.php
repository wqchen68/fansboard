<?php



require_once('dbnew.php');	
	
	$inputid = '2625';
	///撈SQL///
	$db = new DBnew();
	$sql="SELECT season,team FROM careerstats WHERE fbid='$inputid'";
	$seatea=$db->getData($sql,'assoc');
	print_r($seatea);  echo '<br />';echo '<br />';echo '<br />';
	//exit;

	///建構careerdata///
	//$sql="SELECT team FROM careerstats WHERE fbid='$inputid' GROUP BY team ORDER BY season";
	//$uniteam=$db->getData($sql,'assoc');
	$sql="SELECT season FROM careerstats WHERE fbid='$inputid' GROUP BY season";
	$uniseason=$db->getData($sql,'assoc');

	
	foreach($uniseason as $key => $unis){
	
		print_r($unis);           echo '<br />';echo '<br />';
		
		print_r($unis['season']); echo '<br />';echo '<br />';
		
		print_r($seatea[$key]['team']);       echo '<br />';echo '<br />';
		
		
		
		$label[$unis['season']]=$seatea[$key]['team'];
		
		
		
		print_r($label);
		
		//break;
		
		
	
		//$datacheck = isset($data[$pickteam][$unis['season']])?round($data[$pickteam][$unis['season']],4):NULL;
		//$careerdata[$pickteam][$unis['season']] = $datacheck;
	}
	
	exit;
	
	
	
	?>