<?php
class Player {
	
	public static function getSplitStats() {
		
		$player = Input::get('player')[0];
		$datarange = Input::get('datarange');
		$datarange=='ALL' && $datarange='2013';
		
		$splitdata = DB::table('splitdata')->where(function($query){
			$query->where('pickshow','=','1');
			//$query->whereIn('spcate',array('Home','Away','Day','Night','0 Days Rest','1 Days Rest'))->orWhere('spcate', 'LIKE', 'vs%');
			})->where('season',$datarange)->where('fbid',$player['fbid'])->orderBy('spcate')->select(DB::raw('season,spcate,spgame,
													FORMAT(spmin,1) AS spmin,
													FORMAT(spfgm,1) AS spfgm,
													FORMAT(spfga,1) AS spfga,
													FORMAT(spfgp,1) AS spfgp,
													FORMAT(sp3ptm,1) AS sp3ptm,
													FORMAT(sp3pta,1) AS sp3pta,
													FORMAT(sp3ptp,1) AS sp3ptp,
													FORMAT(spftm,1) AS spftm,
													FORMAT(spfta,1) AS spfta,
													FORMAT(spftp,1) AS spftp,
													FORMAT(sporeb,1) AS sporeb,
													FORMAT(spdreb,1) AS spdreb,
													FORMAT(sptreb,1) AS sptreb,
													FORMAT(spast,1) AS spast,
													FORMAT(spto,1) AS spto,
													FORMAT(spatr,1) AS spatr,
													FORMAT(spst,1) AS spst,
													FORMAT(spblk,1) AS spblk,
													FORMAT(sppf,1) AS sppf,
													FORMAT(sppts,1) AS sppts,
													FORMAT(speff,1) AS speff,
													FORMAT(speff36,1) AS speff36'))->get();		
		
		/*$basic_array = array();
		$player_basic = DB::table('syncplayerlist')
						->leftJoin('syncdataframe','syncplayerlist.fbido','=','syncdataframe.fbido')
						->select('player','team','position','injna','pwpts','pwtreb','pwast')
						->where('syncplayerlist.fbid','=',$player['fbid'])
						->where('syncplayerlist.datarange','=','Full')
						->orderBy('syncdataframe.updatetime')->get();
		
		array_push($basic_array,$player_basic[0]->player);
		array_push($basic_array,$player_basic[0]->team);	
		array_push($basic_array,$player_basic[0]->position);
		array_push($basic_array,$player_basic[0]->injna);	

		$stat_array = array();
		$norank = DB::table('syncplayerlist')->where('datarange', '=', 'ALL')->where('fbid', $player['fbid']);
		if( $norank->exists() ){
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwpts,1)));
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwtreb,1)));
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwast,1)));				
		}else{
			array_push($stat_array,"---");
			array_push($stat_array,"---");
			array_push($stat_array,"---");
		}*/
		
		$spstat = array(
			'dayNight'=>array(0,0),
			'HomeAway'=>array(0,0),
            'Starter'=>array(0,0),
			'Rest'=>array(0,0,0,0),
			'VSTeam'=>array(),
			'VS'=>array()
		);
		foreach($splitdata as $d) {
			switch($d->spcate){
				case '@Home':
					$spstat['HomeAway'][0] = $d->speff*1;
				break;
				case '@Away':
					$spstat['HomeAway'][1] = $d->speff*1;
				break;
				case 'Day':
					$spstat['dayNight'][0] = $d->speff*1;
				break;
				case 'Night':
					$spstat['dayNight'][1] = $d->speff*1;
				break;
				case 'As Starter':
					$spstat['Starter'][0] = $d->speff*1;
				break;
				case 'As Sub':
					$spstat['Starter'][1] = $d->speff*1;
				break;            
				case '0 Days Rest':
					$spstat['Rest'][0] = $d->speff*1;
				break;
				case '1 Days Rest':
					$spstat['Rest'][1] = $d->speff*1;
				break;
				case '2 Days Rest':
					$spstat['Rest'][2] = $d->speff*1;
				break;
				case '3+ Days Rest':
					$spstat['Rest'][3] = $d->speff*1;
				break;
				default:
					array_push($spstat['VSTeam'],$d->spcate);
					array_push($spstat['VS'],$d->speff*1);
				break;
			}
		}

		$card = self::getCard(array($player['fbid']));
		
		$data_new['spstat']=$spstat;
		$data_new['table']=$splitdata;
		/*$data_new['basic']=$basic_array;
		$data_new['stat']=$stat_array;*/
		$data_new['card']=$card;
		
		return Response::json($data_new);
	}
	
	public static function getRealtime() {

		$rtstats = DB::table('realtimeeff')
				->leftJoin('biodata','biodata.fbido','=','realtimeeff.fbido')
                ->leftJoin(DB::raw('(SELECT * FROM syncdataframe WHERE datarange="ALL") syncdataframe'),'syncdataframe.fbido','=','realtimeeff.fbido')
				->leftJoin('teamlist','teamlist.team','=','realtimeeff.team')
				->orderBy('realtimeeff.bxeff','desc')->orderBy('realtimeeff.bxpts','desc')
				->select(
                    'realtimeeff.gameid',
					'realtimeeff.fbid',
					'realtimeeff.bxeff',
//					DB::raw('\'LIVE!\' AS livemark'),
                    'realtimeeff.livemark',
					'realtimeeff.startfive',
                    'realtimeeff.bxgs',
					DB::raw('UPPER(realtimeeff.oppo) AS oppo'),
					'realtimeeff.bxmin',
					'realtimeeff.bxpts',
					'realtimeeff.bxfgm',
					'realtimeeff.bxfga',
					'realtimeeff.bxftm',
					'realtimeeff.bxfta',
					'realtimeeff.bx3ptm',
					'realtimeeff.bx3pta',
                    'realtimeeff.bxoreb',
                    'realtimeeff.bxdreb',
					'realtimeeff.bxtreb',
					'realtimeeff.bxast',
					'realtimeeff.bxst',
					'realtimeeff.bxblk',
                    'realtimeeff.bxto',
                    'realtimeeff.bxpf',
                    'realtimeeff.oncourt',
					'biodata.player',
                    'syncdataframe.pwmin',
                    'syncdataframe.pwfgm',
                    'syncdataframe.pwfga',
                    'syncdataframe.wfgp',
                    'syncdataframe.pwftm',
                    'syncdataframe.pwfta',
                    'syncdataframe.wftp',
                    'syncdataframe.pw3ptm',
                    'syncdataframe.pw3pta',
                    'syncdataframe.w3ptp',                        
                    'syncdataframe.pworeb',
                    'syncdataframe.pwdreb',
                    'syncdataframe.pwtreb',
                    'syncdataframe.pwast',
                    'syncdataframe.pwto',
                    'syncdataframe.watr',
                    'syncdataframe.pwst',
                    'syncdataframe.pwblk',
                    'syncdataframe.pwpf',
                    'syncdataframe.pwpts',
                    'syncdataframe.pweff',
                    DB::raw('UPPER(teamlist.team) AS team'),
					'teamlist.colorback',
					'teamlist.colorfont',
					DB::raw('realtimeeff.bxeff/realtimeeff.bxmin AS effper'),
                    DB::raw('syncdataframe.pweff/syncdataframe.pwmin AS effper2'))
                ->whereRaw('realtimeeff.startfive!="DNP"')->get();

		$efflv = DB::table('realtimeeff')
            ->select(DB::raw('SUM(realtimeeff.bxeff)/SUM(realtimeeff.bxmin) AS efflv'))->first();
		
		$gamedata = DB::table('realtimeeff')
            ->leftJoin('teamlist AS A1','A1.team','=','realtimeeff.team')
			->leftJoin('teamlist AS A2','A2.team','=','realtimeeff.oppo')
			->select(DB::raw('UPPER(realtimeeff.team) AS team,UPPER(realtimeeff.oppo) AS oppo,realtimeeff.gameid,realtimeeff.score,realtimeeff.livemark,A1.colorfont AS cft,A1.colorback AS cbt,A2.colorfont AS cfo,A2.colorback AS cbo'))
			->whereRaw('SUBSTRING(oppo,1,1)!="@"')->groupBy('team')->orderBy('updatetime')->get();

		return Response::json(array('rtstats'=>$rtstats,'efflv'=>$efflv->efflv,'gamedata'=>$gamedata));
	}
	
	
/***************************************************************************************/
	public static function gethotcoldPlayer() {
		
		$todaybo = DB::table('realtimeeff')
					->leftJoin('syncdataframe','realtimeeff.fbido','=','syncdataframe.fbido')
					->leftJoin('biodata','realtimeeff.fbido','=','biodata.fbido')
					->leftJoin('syncplayerlist','realtimeeff.fbido','=','syncplayerlist.fbido')
					->select(DB::raw('biodata.player AS playername,realtimeeff.bxeff-syncdataframe.pweff AS trend,
									FORMAT(syncdataframe.pwmin,1) AS min1,
									FORMAT(syncdataframe.pwpts,1) AS pts1,
									FORMAT(syncdataframe.pwtreb,1) AS treb1,
									FORMAT(syncdataframe.pwast,1) AS ast1,
									FORMAT(realtimeeff.bxmin,1) AS min2,
									realtimeeff.bxfgm AS fgm2,
									realtimeeff.bxfga AS fga2,
									FORMAT(realtimeeff.bxfgp,1) AS fgp2,									
									realtimeeff.bxpts AS pts2,
									realtimeeff.bxtreb AS treb2,
									realtimeeff.bxast AS ast2,
									realtimeeff.bxst AS st2,
									realtimeeff.bxblk AS blk2,
									syncplayerlist.fbid,REPLACE(syncplayerlist.player," ","") AS player,syncplayerlist.team,syncplayerlist.position'))
					->where('syncdataframe.datarange','=','ALL')
					->where('syncplayerlist.datarange','=','ALL')
					->orderBy('trend','DESC')->take(15)->get();
        
		
		if ( empty($todaybo) ){
					$todaybo[0] = (object)array();
					$todaybo[0]->fbid='help1';
					$todaybo[0]->player='Updating...';
					$todaybo[0]->team='';
					$todaybo[0]->position='';
					$todaybo[0]->min1='';
					$todaybo[0]->pts1='';
					$todaybo[0]->treb1='';
					$todaybo[0]->ast1='';
					$todaybo[0]->min2='';
					$todaybo[0]->pts2='';
					$todaybo[0]->treb2='';
					$todaybo[0]->ast2='';
					$todaybo[0]->trend='';
					$todaybo[1] = (object)array();
					$todaybo[1]->fbid='help1';
					$todaybo[1]->player='Updating...';
					$todaybo[1]->team='';
					$todaybo[1]->position='';
					$todaybo[1]->min1='';
					$todaybo[1]->pts1='';
					$todaybo[1]->treb1='';
					$todaybo[1]->ast1='';					
					$todaybo[1]->min2='';
					$todaybo[1]->pts2='';
					$todaybo[1]->treb2='';
					$todaybo[1]->ast2='';
					$todaybo[1]->trend='';
		}
					
		$todaysg = DB::table('realtimeeff')
					->leftJoin('syncdataframe','realtimeeff.fbido','=','syncdataframe.fbido')
					->leftJoin('biodata','realtimeeff.fbido','=','biodata.fbido')
					->leftJoin('syncplayerlist','realtimeeff.fbido','=','syncplayerlist.fbido')
					->select(DB::raw('biodata.player AS playername,realtimeeff.bxeff-syncdataframe.pweff AS trend,
									FORMAT(syncdataframe.pwmin,1) AS min1,
									FORMAT(syncdataframe.pwpts,1) AS pts1,
									FORMAT(syncdataframe.pwtreb,1) AS treb1,
									FORMAT(syncdataframe.pwast,1) AS ast1,
									FORMAT(realtimeeff.bxmin,1) AS min2,
									realtimeeff.bxfgm AS fgm2,
									realtimeeff.bxfga AS fga2,
									FORMAT(realtimeeff.bxfgp,1) AS fgp2,									
									realtimeeff.bxpts AS pts2,
									realtimeeff.bxtreb AS treb2,
									realtimeeff.bxast AS ast2,
									realtimeeff.bxst AS st2,
									realtimeeff.bxblk AS blk2,									
									syncplayerlist.fbid,REPLACE(syncplayerlist.player," ","") AS player,syncplayerlist.team,syncplayerlist.position'))
					->where('syncdataframe.datarange','=','ALL')
					->where('syncplayerlist.datarange','=','ALL')
					->whereNotNull('realtimeeff.bxeff')
					->orderBy('trend','ASC')->take(15)->get();

		if ( empty($todaysg) ){
					$todaysg[0] = (object)array();
					$todaysg[0]->fbid='help1';
					$todaysg[0]->player='Updating...';
					$todaysg[0]->team='';
					$todaysg[0]->position='';
					$todaysg[0]->min1='';
					$todaysg[0]->pts1='';
					$todaysg[0]->treb1='';
					$todaysg[0]->ast1='';
					$todaysg[0]->min2='';
					$todaysg[0]->pts2='';
					$todaysg[0]->treb2='';
					$todaysg[0]->ast2='';
					$todaysg[0]->trend='';
					$todaysg[1] = (object)array();
					$todaysg[1]->fbid='help1';
					$todaysg[1]->player='Updating...';
					$todaysg[1]->team='';
					$todaysg[1]->position='';
					$todaysg[1]->min1='';
					$todaysg[1]->pts1='';
					$todaysg[1]->treb1='';
					$todaysg[1]->ast1='';
					$todaysg[1]->min2='';
					$todaysg[1]->pts2='';
					$todaysg[1]->treb2='';
					$todaysg[1]->ast2='';					
					$todaysg[1]->trend='';
		}
		
		
		
		$recenthot = DB::table('syncdataframe AS A1')
					->leftJoin('syncdataframe AS A2','A1.fbido','=','A2.fbido')
					->leftJoin('biodata','A1.fbido','=','biodata.fbido')
					->leftJoin('syncplayerlist','A1.fbido','=','syncplayerlist.fbido')
					->select(DB::raw('biodata.player AS playername,A2.pweff-A1.pweff AS trend,
									FORMAT(A1.pwmin,1) AS min1,
									FORMAT(A1.pwpts,1) AS pts1,
									FORMAT(A1.pwtreb,1) AS treb1,
									FORMAT(A1.pwast,1) AS ast1,
									FORMAT(A2.pwmin,1) AS min2,
									FORMAT(A2.pwfgm,1) AS fgm2,
									FORMAT(A2.pwfga,1) AS fga2,
									FORMAT(A2.wfgp*100,1) AS fgp2,																											
									FORMAT(A2.pwpts,1) AS pts2,
									FORMAT(A2.pwtreb,1) AS treb2,
									FORMAT(A2.pwast,1) AS ast2,
									syncplayerlist.fbid,REPLACE(syncplayerlist.player," ","") AS player,syncplayerlist.team,syncplayerlist.position'))
					->where('syncplayerlist.datarange','=','D30')
					->where('A1.datarange','=','D30')
					->where('A2.datarange','=','D07')
					->orderBy('trend','DESC')->take(15)->get();

		$recentcold = DB::table('syncdataframe AS A1')
					->leftJoin('syncdataframe AS A2','A1.fbido','=','A2.fbido')
					->leftJoin('biodata','A1.fbido','=','biodata.fbido')
					->leftJoin('syncplayerlist','A1.fbido','=','syncplayerlist.fbido')
					->select(DB::raw('biodata.player AS playername,A2.pweff-A1.pweff AS trend,
									FORMAT(A1.pwmin,1) AS min1,
									FORMAT(A1.pwpts,1) AS pts1,
									FORMAT(A1.pwtreb,1) AS treb1,
									FORMAT(A1.pwast,1) AS ast1,
									FORMAT(A2.pwmin,1) AS min2,
									FORMAT(A2.pwfgm,1) AS fgm2,
									FORMAT(A2.pwfga,1) AS fga2,
									FORMAT(A2.wfgp*100,1) AS fgp2,																											
									FORMAT(A2.pwpts,1) AS pts2,
									FORMAT(A2.pwtreb,1) AS treb2,
									FORMAT(A2.pwast,1) AS ast2,
									syncplayerlist.fbid,REPLACE(syncplayerlist.player," ","") AS player,syncplayerlist.team,syncplayerlist.position'))
					->where('syncplayerlist.datarange','=','D30')
					->where('A1.datarange','=','D30')
					->where('A2.datarange','=','D07')
					->orderBy('trend','ASC')->take(15)->get();
		
		$livemark = DB::table('realtimeeff')
					->select('livemark')
					->groupBy('livemark')->get();		
		
		return Response::json(array('todaybo'=>$todaybo,'todaysg'=>$todaysg,'recenthot'=>$recenthot,'recentcold'=>$recentcold,'livemark'=>$livemark));
		
	}
/***************************************************************************************/	
	
	
	
	
	public static function getTradecompare() {
		

		$playerA = array();
		foreach(Input::get('playerA') as $p){
			array_push($playerA,$p['fbid']);
		}
		$playerB = array();
		foreach(Input::get('playerB') as $p){
			array_push($playerB,$p['fbid']);
		}
				
		$valueA = DB::table('syncdataframe')->whereIn('fbid',$playerA)->where('datarange','YM1')
				->select(DB::raw('SUM(pwmin) AS Spwmin,SUM(pwfgm) AS Spwfgm,SUM(pwfga) AS Spwfga,SUM(pwfgm)/SUM(pwfga) AS Spwfgp,SUM(pw3ptm) AS Spw3ptm,SUM(pw3pta) AS Spw3pta,SUM(pw3ptm)/SUM(pw3pta) AS Spw3ptp,SUM(pwftm) AS  Spwftm,SUM(pwfta) AS  Spwfta,SUM(pwftm)/SUM(pwfta) AS Spwftp,SUM(pworeb) AS Spworeb,SUM(pwdreb) AS Spwdreb,SUM(pwtreb) AS Spwtreb,SUM(pwast) AS Spwast,SUM(pwto) AS Spwto,SUM(pwast)/SUM(pwto) AS Spwatr ,SUM(pwst) AS Spwst ,SUM(pwblk) AS Spwblk,SUM(pwpts) AS Spwpts,AVG(swfgp) AS ASwfgp,AVG(sw3ptm) AS ASw3ptm,AVG(swftp) AS ASwftp,AVG(swtreb) AS ASwtreb,AVG(swast) AS ASwast,AVG(swst) AS ASwst ,AVG(swblk) AS ASwblk,AVG(swpts) AS ASwpts'))->first();
		$valueB = DB::table('syncdataframe')->whereIn('fbid',$playerB)->where('datarange','YM1')
				->select(DB::raw('SUM(pwmin) AS Spwmin,SUM(pwfgm) AS Spwfgm,SUM(pwfga) AS Spwfga,SUM(pwfgm)/SUM(pwfga) AS Spwfgp,SUM(pw3ptm) AS Spw3ptm,SUM(pw3pta) AS Spw3pta,SUM(pw3ptm)/SUM(pw3pta) AS Spw3ptp,SUM(pwftm) AS  Spwftm,SUM(pwfta) AS  Spwfta,SUM(pwftm)/SUM(pwfta) AS Spwftp,SUM(pworeb) AS Spworeb,SUM(pwdreb) AS Spwdreb,SUM(pwtreb) AS Spwtreb,SUM(pwast) AS Spwast,SUM(pwto) AS Spwto,SUM(pwast)/SUM(pwto) AS Spwatr ,SUM(pwst) AS Spwst ,SUM(pwblk) AS Spwblk,SUM(pwpts) AS Spwpts,AVG(swfgp) AS ASwfgp,AVG(sw3ptm) AS ASw3ptm,AVG(swftp) AS ASwftp,AVG(swtreb) AS ASwtreb,AVG(swast) AS ASwast,AVG(swst) AS ASwst ,AVG(swblk) AS ASwblk,AVG(swpts) AS ASwpts'))->first();
		
		$tradecompareA = array(
			round($valueA->ASwftp, 2),
			round($valueA->ASw3ptm, 2),
			round($valueA->ASwast, 2),
			round($valueA->ASwst, 2),
			round($valueA->ASwfgp, 2),
			round($valueA->ASwblk, 2),
			round($valueA->ASwtreb, 2),
			round($valueA->ASwpts, 2)
		);
		$tradecompareB = array(
			round($valueB->ASwftp, 2),
			round($valueB->ASw3ptm, 2),
			round($valueB->ASwast, 2),
			round($valueB->ASwst, 2),
			round($valueB->ASwfgp, 2),
			round($valueB->ASwblk, 2),
			round($valueB->ASwtreb, 2),
			round($valueB->ASwpts, 2)
		);
		
		$tableA = array(
			round($valueA->Spwmin, 2),
			round($valueA->Spwfgm, 2),
			round($valueA->Spwfga, 2),
			round($valueA->Spwfgp*100, 2),						
			round($valueA->Spw3ptm, 2),
			round($valueA->Spw3pta, 2),
			round($valueA->Spw3ptp*100, 2),
			round($valueA->Spwftm, 2),
			round($valueA->Spwfta, 2),
			round($valueA->Spwftp*100, 2),
			round($valueA->Spworeb, 2),
			round($valueA->Spwdreb, 2),
			round($valueA->Spwtreb, 2),																		
			round($valueA->Spwast, 2),
			round($valueA->Spwto, 2),
			round($valueA->Spwatr, 2),						
			round($valueA->Spwst, 2),
			round($valueA->Spwblk, 2),
			round($valueA->Spwpts, 2)
		);
		
		$tableB = array(
			round($valueB->Spwmin, 2),
			round($valueB->Spwfgm, 2),
			round($valueB->Spwfga, 2),
			round($valueB->Spwfgp*100, 2),						
			round($valueB->Spw3ptm, 2),
			round($valueB->Spw3pta, 2),
			round($valueB->Spw3ptp*100, 2),
			round($valueB->Spwftm, 2),
			round($valueB->Spwfta, 2),
			round($valueB->Spwftp*100, 2),
			round($valueB->Spworeb, 2),
			round($valueB->Spwdreb, 2),
			round($valueB->Spwtreb, 2),																		
			round($valueB->Spwast, 2),
			round($valueB->Spwto, 2),
			round($valueB->Spwatr, 2),						
			round($valueB->Spwst, 2),
			round($valueB->Spwblk, 2),
			round($valueB->Spwpts, 2)
		);
		
		return Response::json(array('tradecompareA'=>$tradecompareA,'tradecompareB'=>$tradecompareB,'tableA'=>$tableA,'tableB'=>$tableB));
	}
	
	public static function getCareerStats() {
		foreach(Input::get('player') as $player){
			$op = self::fg_careerstats($player['fbid']);
			return Response::json($op);
		}		
	}
	private static function fg_careerstats($inputid){
	//功能  : 建構careerstats資料
	//input : ID,cate
	//output: careerdata

		///建構careerdata///
		$uniteam = DB::table('careerstats')->where('fbid',$inputid)->orderBy('dataorder')->groupBy('cteam')->select('cteam')->get();
		$uniseason = DB::table('careerstats')->where('fbid',$inputid)->orderBy('dataorder')->groupBy('cseason')->lists('cseason');
        
		$careerdata = array();
		$careerdata36 = array();
		$careertime = array();
		$uniseason_key = array_flip($uniseason);
		
		/*$basic_array = array();
		$player_basic = DB::table('syncplayerlist')
						->leftJoin('syncdataframe','syncplayerlist.fbido','=','syncdataframe.fbido')
						->select('player','team','position','injna','pwpts','pwtreb','pwast')
						->where('syncplayerlist.fbid','=',$inputid)
						->where('syncplayerlist.datarange','=','Full')
						->orderBy('syncdataframe.updatetime')->get();
		
		array_push($basic_array,$player_basic[0]->player);
		array_push($basic_array,$player_basic[0]->team);	
		array_push($basic_array,$player_basic[0]->position);
		array_push($basic_array,$player_basic[0]->injna);
		
		$stat_array = array();
		$norank = DB::table('syncplayerlist')->where('datarange', '=', 'ALL')->where('fbid', $inputid);
		if( $norank->exists() ){
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwpts,1)));
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwtreb,1)));
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwast,1)));				
		}else{
			array_push($stat_array,"---");
			array_push($stat_array,"---");
			array_push($stat_array,"---");
		}*/
		
		$table_array1 = DB::table('careerstats')->where('fbid','=',$inputid)->select('cseason','cteam',DB::raw('cgame,FORMAT(cmin,1),
								FORMAT(cfgm,1),
								FORMAT(cfga,1),
								FORMAT(cfgp*100,1),
								FORMAT(c3ptm,1),
								FORMAT(c3pta,1),
								FORMAT(c3ptp*100,1),
								FORMAT(cftm,1),
								FORMAT(cfta,1),
								FORMAT(cftp*100,1),
								FORMAT(coreb,1),
								FORMAT(cdreb,1),
								FORMAT(ctreb,1),
								FORMAT(cast,1),
								FORMAT(cto,1),
								FORMAT(catr,2),
								FORMAT(cst,2),
								FORMAT(cblk,2),
								FORMAT(cpf,1),
								FORMAT(cpts,1),
								FORMAT(ceff,1),
								FORMAT(ceff36,1)'))->orderBy('dataorder')->get();
								
		$table_array2 = DB::table('syncdataframe')->leftJoin('syncplayerlist','syncdataframe.fbido','=','syncplayerlist.fbido')
												->where('syncdataframe.fbid','=',$inputid)
												->where('syncdataframe.datarange','=','ALL') //開季後把2拿掉
												->where('syncplayerlist.datarange','=','ALL')
												->select(DB::raw('"2014-15",syncplayerlist.team,wgp,FORMAT(pwmin,1),
								FORMAT(pwfgm,1),
								FORMAT(pwfga,1),
								FORMAT(wfgp*100,1),
								FORMAT(pw3ptm,1),
								FORMAT(pw3pta,1),
								FORMAT(w3ptp*100,1),
								FORMAT(pwftm,1),
								FORMAT(pwfta,1),
								FORMAT(wftp*100,1),
								FORMAT(pworeb,1),
								FORMAT(pwdreb,1),
								FORMAT(pwtreb,1),
								FORMAT(pwast,1),
								FORMAT(pwto,1),
								FORMAT(watr,2),
								FORMAT(pwst,2),
								FORMAT(pwblk,2),
								FORMAT(pwpf,1),
								FORMAT(pwpts,1),
								FORMAT(pweff,1),
								FORMAT(pweff36,1)'))->get();								

		$table_array = array_merge($table_array1,$table_array2);
		$table_array=array_reverse($table_array,false);
		
		array_push($uniseason,'2014-15');
		foreach($uniteam as $unit){
			$pickteam = $unit->cteam;
			
			$careerdata[$pickteam] = array();
			$careerdata36[$pickteam] = array();
			$careertime[$pickteam] = array();		
			
			foreach($uniseason as $key => $unis){
				//$pickseason = $unis;				
				$careerdata[$pickteam][$key] = NULL;
				$careerdata36[$pickteam][$key] = NULL;
				$careertime[$pickteam][$key] = NULL;
			}
		}
		
		$items = Input::get('items');
		$itemsMap = array(
			'ceff'=>'pweff',
            'cmin'=>'pwmin',
			'cfgm'=>'pwfgm',
			'cfga'=>'pwfga',
			'cfgp'=>'wfgp',
			'cftm'=>'pwftm',
			'cfta'=>'pwfta',
			'cftp'=>'wftp',
			'c3ptm'=>'pw3ptm',
			'c3pta'=>'pw3pta',
			'c3ptp'=>'w3ptp',
			'coreb'=>'pworeb',
			'cdreb'=>'pwdreb',
			'ctreb'=>'pwtreb',
			'cast'=>'pwast',
			'cto'=>'pwto',
			'catr'=>'watr',
			'cst'=>'pwst',
			'cblk'=>'pwblk',
            'cpf'=>'pwpf',
			'cpts'=>'pwpts'
		);
		if ( !in_array($items,array('ceff','cmin','cfgm','cfga','cfgp','cftm','cfta','cftp','c3ptm','c3pta','c3ptp','coreb','cdreb','ctreb','cast','cto','catr','cst','cblk','cpf','cpts')) )
				$items = 'ceff';
		$itemsNow = isset($itemsMap[$items])
				? $itemsMap[$items]
				: 'pweff';
		///撈SQL並計算sum///	
		$careerstats = DB::table('careerstats')->where('fbid',$inputid)->orderBy('dataorder')->select($items.' AS colsum','ceff36','cseason','cteam','cgame')->get();
		$valueMax = DB::table('careerstats')->where('cseason','2014-15')->max($items);
		if (empty($table_array2)){
			$valueMaxNow = DB::table('syncdataframe')->where('datarange','Full')->max($itemsNow);
			$thisyearstats = DB::table('syncdataframe')->where('fbid',$inputid)->where('datarange','Full')->select($itemsNow.' AS pweff','pweff36','wgp')->first();	
			$thisyearteam = DB::table('syncplayerlist')->where('fbid',$inputid)->where('datarange','Full')->select('team')->first();			
		}else{
			$valueMaxNow = DB::table('syncdataframe')->where('datarange','ALL')->max($itemsNow);
			$thisyearstats = DB::table('syncdataframe')->where('fbid',$inputid)->where('datarange','ALL')->select($itemsNow.' AS pweff','pweff36','wgp')->first();	
			$thisyearteam = DB::table('syncplayerlist')->where('fbid',$inputid)->where('datarange','ALL')->select('team')->first();						
		}
			
		
		///併進新一年度資料(即時)///
		
		///轉換array，key:0123變成team///
		$sameteam = false;
		foreach($careerstats as $key => $cd){
					
			$careerdata[$cd->cteam][$uniseason_key[$cd->cseason]] = round($cd->colsum,2);
			$careerdata36[$cd->cteam][$uniseason_key[$cd->cseason]] = round($cd->ceff36,2);
			$careertime[$cd->cteam][$uniseason_key[$cd->cseason]] = round($cd->cgame,2);
					
			if ( $cd->cteam == $thisyearteam->team.'\'' )
				$thisyearteam->team = $thisyearteam->team.'\'';
			($cd->cteam == $thisyearteam->team) && $sameteam = true;
		}

		
		if ( count($uniteam)>0 )
		if ( isset($thisyearteam) && isset($thisyearstats) ){

			if ( $uniteam[count($uniteam)-1]->cteam != $thisyearteam->team ){
				if ( $sameteam ){
					$thisyearteam->team = $thisyearteam->team.'\'';
                }
                $careerdata[$thisyearteam->team] = array();
                $careerdata36[$thisyearteam->team] = array();
                $careertime[$thisyearteam->team] = array();
                foreach($uniseason as $key => $unis){
                    $careerdata[$thisyearteam->team][$key] = NULL;
                    $careerdata36[$thisyearteam->team][$key] = NULL;
                    $careertime[$thisyearteam->team][$key] = 0;//NULL;
                }                
			}
			$careerdata[$thisyearteam->team][count($uniseason)-1] = round($thisyearstats->pweff,2);
			$careerdata36[$thisyearteam->team][count($uniseason)-1] = round($thisyearstats->pweff36,2);
			$careertime[$thisyearteam->team][count($uniseason)-1] = round($thisyearstats->wgp,2);
			
		}
		
		$card = self::getCard(array($inputid));
		
		$output = array(
			'career'=>$careerdata,
			'career36'=>$careerdata36,
			'ctime'=>$careertime,
			'label'=>$uniseason,
			'valueMax'=>($valueMaxNow>$valueMax)?ceil($valueMaxNow):ceil($valueMax),
			/*'basic'=>$basic_array,
			'stat'=>$stat_array,*/
			'card'=>$card,
			'table'=>$table_array,
			
		);
		return $output;
	}

	public static function getNews() {
		//if( isset(Input::get('id')) )
		$news = array();
		foreach(Input::get('player') as $player){

			$op = self::fg_rotoworld($player['fbid']);
			array_push($news,$op);
		}
		return Response::json($news);
	}
	
	private static function fg_rotoworld($fbid){
	//功能  : load rotoworld最新消息
	//input : ID
	//output: 消息
	
		//計算(現在時間-上次更新時間)(單位:分鐘)
		$rwtable = DB::table('rwtable')->where('fbid',$fbid)->select(DB::raw('TIMESTAMPDIFF(MINUTE,updatetime,NOW()) AS timekey,rwid'))->first();
		if( !isset($rwtable) ) 
			return array('','','','');
		
		if( $rwtable->timekey>2 ){//大於間隔時間:load網頁，並且儲存至SQL，再秀news
			$rwid = $rwtable->rwid;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://www.rotoworld.com/player/nba/$rwid"); 
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, ''); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$tuData = curl_exec($ch); 
			curl_close($ch);
			
			require_once(app_path().'/views/class/simple_html_dom/simple_html_dom.php');
			$dom = str_get_html($tuData);			
	
			$report_dom = $dom->find('#RW_main div.playernews div.report',0);
			$impact_dom = $dom->find('#RW_main div.playernews div.impact',0);
			$date_dom = $dom->find('#RW_main div.playernews div.impact span.date',0);
			$info_dom = $dom->find('#RW_main div.playernews div.source',0);
	
			$report=$report_dom->innertext; //抓html裡的文字
			$impact=$impact_dom->innertext;
			$date=$date_dom->innertext;
			$info=$info_dom->innertext;	
						
			//$sql_update = "UPDATE rwtable SET report='$report2',impact='$impact2',date='$date2',info='$info2',updatetime=now() WHERE rwid='$inputid'";
			DB::table('rwtable')->where('fbid',$fbid)->update(array(
				'report'=>$report,
				'impact'=>$impact,
				'date'=>$date,
				'info'=>$info,
				'updatetime'=>DB::raw('NOW()')
			));
	
		}		
		$news = DB::table('rwtable')->where('fbid',$fbid)->select('report','date','info','updatetime')->first();		
		$out = array($news->report,$news->date,$news->info,$news->updatetime);
		
		return $out;
	}
	
	
	public static function getScatter() {
		
		$db_map_datarange = array(
			'ALL'=>'ALL',
			'D30'=>'D30',
			'D14'=>'D14',
			'D07'=>'D07',									
			'Y-1'=>'Y-1',
			'Y-2'=>'Y-2'
		);
		
		$db_map_position = array(
			'PG'=>'PG',
			'SG'=>'SG',
			'SF'=>'SF',		
			'PF'=>'PF',
			'C'=>'C'
		);
		
		$db_map = array(
			'xMIN'=>'zwmin',
			'xFGM'=>'zwfgm',
			'xFGA'=>'zwfga',
			'xFG%'=>'zwfgp',
			'x3PTM'=>'zw3ptm',
			'x3PTA'=>'zw3pta',
			'x3PT%'=>'zw3ptp',
			'xFTM'=>'zwftm',
			'xFTA'=>'zwfta',
			'xFT%'=>'zwftp',
			'xOREB'=>'zworeb',
			'xDREB'=>'zwdreb',
			'xTREB'=>'zwtreb',
			'xAST'=>'zwast',
			'xTO'=>'zwto',
			'xATR'=>'zwatr',
			'xST'=>'zwst',
			'xBLK'=>'zwblk',
			'xPF'=>'zwpf',
			'xPTS'=>'zwpts',
			'xTECH'=>'zwtech',
			'yMIN'=>'zwmin',
			'yFGM'=>'zwfgm',
			'yFGA'=>'zwfga',
			'yFG%'=>'zwFGP',
			'y3PTM'=>'zw3ptm',
			'y3PTA'=>'zw3pta',
			'y3PT%'=>'zw3ptp',
			'yFTM'=>'zwftm',
			'yFTA'=>'zwfta',
			'yFT%'=>'zwftp',
			'yOREB'=>'zworeb',
			'yDREB'=>'zwdreb',
			'yTREB'=>'zwtreb',
			'yAST'=>'zwast',
			'yTO'=>'zwto',
			'yATR'=>'zwatr',
			'yST'=>'zwst',
			'yBLK'=>'zwblk',
			'yPF'=>'zwpf',
			'yPTS'=>'zwpts',
			'yTECH'=>'zwtech'			
		);
		
		$datarange = array_key_exists(Input::get('datarange'), $db_map_datarange)
			? $db_map_datarange[Input::get('datarange')]
			: 'ALL';
			
			
			
		$category_x_array = array();
		if( is_array(Input::get('category_x')) )
		foreach(Input::get('category_x') as $key => $category_x){
			if( array_key_exists($category_x,$db_map) )
				array_push($category_x_array,'syncdataframe.'.$db_map[$category_x]);
		}
		
		$category_y_array = array();
		if( is_array(Input::get('category_y')) )
		foreach(Input::get('category_y') as $key => $category_y){
			if( array_key_exists($category_y,$db_map) )
				array_push($category_y_array,'syncdataframe.'.$db_map[$category_y]);
		}
		
		

		$category_x_sql = ( count($category_x_array)>0 )
			? '('.implode('+',$category_x_array).') AS sumX'
			: '';
		$category_y_sql = ( count($category_y_array)>0 )
			? '('.implode('+',$category_y_array).') AS sumY'
			: '';
		
		$category_y_order_sql = ( count($category_y_array)>0 )
			? '('.implode('+',$category_y_array).')'
			: '';
			
		$position_filter_a = array();
		if( is_array(Input::get('position')) ){
			foreach(Input::get('position') as $key => $position){
				if( array_key_exists($position,$db_map_position) )
					array_push($position_filter_a,'syncplayerlist.position LIKE "%'.$db_map_position[$position].'%"');
			}
		}
		
		$position_sql = ( count($position_filter_a)>0 )
			? '('.implode(' OR ',$position_filter_a).')'
			: '';
			
		$mins_array = array(
			'ALL'=>'0',
			'min10'=>'10',
			'min15'=>'15',
			'min20'=>'20',
			'min25'=>'25',
			'min30'=>'30'
		);
		$mins = array_key_exists(Input::get('mins','SF'),$mins_array)
			? $mins_array[Input::get('mins','SF')]
			: 'min30';
		
		//$sql = " SELECT $culumn_sql_s,l.player,d.rr,d.gg,d.bb FROM syncdataframe d INNER JOIN syncplayerlist l ON d.datarange=l.datarange AND d.id=l.id WHERE $mins AND $where_sql_s";
		$resultAry = DB::table('syncdataframe')
				->leftJoin('syncplayerlist',function($join){
					$join->on('syncplayerlist.fbido','=','syncdataframe.fbido');
				})
				->leftJoin('biodata','biodata.fbido','=','syncdataframe.fbido')
				->where('syncdataframe.datarange','=',$datarange)
				->where('syncplayerlist.datarange','=','Full')
				//->whereIn('syncplayerlist.fbid',array('Damian-Lillard','DeMar-DeRozan','Giannis-Antetokounmpo','Goran-Dragic','Michael-Carter-Williams','Reggie-Jackson','Trey-Burke','Victor-Oladipo'))
				->where('syncdataframe.pwmin','>',$mins)
				->whereRaw($position_sql)
				->orderBy(DB::raw($category_y_order_sql),'desc')
				->select(
					DB::raw($category_x_sql.','.$category_y_sql),
					'biodata.player',
					'syncdataframe.fbid',
					'syncdataframe.rr',
					'syncdataframe.gg',
					'syncdataframe.bb',
					'syncplayerlist.position'
				)->get();
		//return $resultAry->tosql();
		//$queries = DB::getQueryLog();
		//var_dump($queries);
		//$last_query = end($queries);
		//return $last_query;
		
		$bv_a = array();
		$bv_name = array();
		$bv_fbid = array();
		$bv_rgb = array();
		$player_info = array();
		if( is_array($resultAry ) ){
			foreach($resultAry as $rank => $player){
				$bv = array(round($player->sumX,2),round($player->sumY,2));
				array_push($bv_a,$bv);
				array_push($bv_name,$player->player);
				array_push($bv_fbid,$player->fbid);
				array_push($player_info,array(
					'rank'=>$rank,
					'position'=>$player->position
				));
				
				$rr = (intval($player->rr*255));
				$gg = (intval($player->gg*255));
				$bb = (intval($player->bb*255));
				array_push($bv_rgb,array($rr,$gg,$bb));
			}
		}
		
		$output = array(
			'bv_a' => $bv_a,
			'bv_name' => $bv_name,
			'bv_fbid' => $bv_fbid,
			'bv_rgb' => $bv_rgb,
			'player_info' => $player_info
		);

		return Response::json($output);
	}
	
	public static function getCard($player) {
		/*
		 * Input player array; 
		 */
		$player_basic_query = DB::table('syncplayerlist AS sl1')
							->leftJoin('syncdataframe AS sd',function($join){
								$join->on('sl1.fbido','=','sd.fbido')->on('sd.datarange','=',DB::raw('\'ALL\''));
							})							
							->where('sl1.datarange','=','Full')	
							->whereIn('sl1.fbid',$player);
	
		if( $player_basic_query->exists() ){
			$player_basic = $player_basic_query->select('sl1.player','sl1.fbid','sl1.team','sl1.position','sl1.injna','sd.pwpts','sd.pwtreb','sd.pwast')->get();
			$output_bykey = array();
			foreach($player_basic as $basic){
				!isset($basic->pwpts) && $basic->pwpts='---';
				!isset($basic->pwtreb) && $basic->pwtreb='---';
				!isset($basic->pwast) && $basic->pwast='---';
				$output_bykey[$basic->fbid] = array(
					'fbid' => $basic->fbid,
					'cardplayer' => $basic->player,
					/*'cardbasic' => $basic->team.$basic->position.$basic->injna,
					'cardstat' => $basic->pwpts.$basic->pwtreb.$basic->pwast,*/
					'cardteamposi' => $basic->team.'&nbsp-&nbsp'.$basic->position,
					'cardinjna' => $basic->injna,
					'cardstat' => sprintf("%.1f",round($basic->pwpts, 1)).' pts, '.sprintf("%.1f",round($basic->pwtreb, 1)).' reb, '.sprintf("%.1f",round($basic->pwast, 1)).' ast',					
				);
			}
		}
		$output = array();
		foreach($player as $p){
			array_push($output,$output_bykey[$p]);
		}
		return $output;
	}	
	
	
	public static function getRank() {
			
		$get_array = Input::get('get_array');
		$player = Input::get('player');
		$datarange = Input::get('datarange');
		//$datarange = 'Y-1';		
	
		$sum_item = array_filter($get_array,function($n){
			$inputcate_filter = array('zwfgm','zwfgp','zwftm','zwftp','zw3ptm','zw3ptp','zworeb','zwdreb','zwtreb','zwast','zwto','zwatr','zwst','zwblk','zwpf','zwpts','zwtech');
			return in_array($n,$inputcate_filter);
		});	
		
		$inputcate = implode('+',$sum_item);		
		
		$output = array();
		foreach( $player as $p ){
			$op = self::fg_customrank($p['fbid'],$datarange,$inputcate);
			array_push($output,$op);
		}
		return Response::json($output);
	}
	
	private static function fg_customrank($inputid,$inputdatarange,$inputcate) {
		//功能  : 計算客製化rank
		//input : ID,datarange,比項
		//output: rank
	
		///撈SQL並sum而且排序///

		/*$injna = DB::table('syncplayerlist')->where('datarange', '=', 'Full')->where('fbid', $inputid)->whereNotNull('injna');
		if( $injna->exists() )
			return $injna->pluck('injna');*/
		
		$norank = DB::table('syncplayerlist')->where('datarange', '=', 'ALL')->where('fbid', $inputid);
		if( !$norank->exists() )
			return $ranktext='---';
			
		$rank = DB::table('syncdataframe')
			->where('datarange', '=', $inputdatarange)
			->where(DB::raw('('.$inputcate.')'), '>', function($query) use ($inputcate,$inputid,$inputdatarange){
				$query->select(DB::raw('('.$inputcate.')'))->from('syncdataframe')->where('datarange', $inputdatarange)->where('fbid', $inputid);				
			})->count();
	
		///轉換array///
		$ranktext = $rank+1;
		return $ranktext;
	}
	
	
	public static function getLog() {
		
		$player = Input::get('player');
		$datarange = Input::get('datarange');
				
		$plays_value_array = array();
				
		foreach( $player as $p ){
			
			$op = self::fg_gamelogma($p['fbid'],$datarange);
			array_push($plays_value_array,$op);
		
		}
		return Response::json($plays_value_array);
	}
	
	private static function fg_gamelogma($inputid,$inputseason) {
		//功能  : 計算gamelog的MA
		//input : ID,season
		//output: madata=data,ma3,ma6,ma9

		///撈SQL並sum///
		//$sql="SELECT $inputcate AS colsum,ggp,gmin,gdate,goppo,gresult FROM gamelog WHERE fbid='$inputid' AND season='$inputseason'";
		$info = array();
		$table = array();
			
		/*$basic_array = array();
		$player_basic = DB::table('syncplayerlist')
						->leftJoin('syncdataframe','syncplayerlist.fbido','=','syncdataframe.fbido')
						->select('player','team','position','injna','pwpts','pwtreb','pwast')
						->where('syncplayerlist.fbid','=',$inputid)
						->where('syncplayerlist.datarange','=','Full')
						->orderBy('syncdataframe.updatetime')->get();
		
		array_push($basic_array,$player_basic[0]->player);
		array_push($basic_array,$player_basic[0]->team);	
		array_push($basic_array,$player_basic[0]->position);
		array_push($basic_array,$player_basic[0]->injna);		

		$stat_array = array();
		$norank = DB::table('syncplayerlist')->where('datarange', '=', 'ALL')->where('fbid', $inputid);
		if( $norank->exists() ){
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwpts,1)));
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwtreb,1)));
			array_push($stat_array,sprintf("%.1f",round($player_basic[0]->pwast,1)));				
		}else{
			array_push($stat_array,"---");
			array_push($stat_array,"---");
			array_push($stat_array,"---");
		}*/
				
		if ($inputseason=='2013'||$inputseason=='2014'){
			$resultAry = DB::table('allgamelog')->where('fbid','=',$inputid)->where('season','=',$inputseason)->orderby('gdate')->select('*',DB::raw('UPPER(goppo) AS goppo'),'bxeff AS colsum')->get();
			$game_length = count($resultAry);
			foreach($resultAry as $key => $gd){

				$data[$key]=$gd->colsum;
				$info['min1'][$key]=$gd->bxgs==1?round($gd->bxmin,2):0;
				$info['min2'][$key]=$gd->bxgs==0?round($gd->bxmin,2):0;
				$info['date'][$key]=$gd->gdate;
				$info['oppo'][$gd->gdate]=$gd->goppo;
				if( $game_length-$key<82 ){
					array_push($table,array(				
					'gdate'=>$gd->gdate,
					'goppo'=>$gd->goppo,
					'score'=>$gd->score,
					'startfive'=>$gd->startfive,
					'bxmin'=>isset($gd->bxmin)?sprintf("%.1f",round($gd->bxmin, 1)):'-',
					'bxfgm'=>isset($gd->bxfgm)?$gd->bxfgm:'-',
					'bxfga'=>isset($gd->bxfga)?$gd->bxfga:'-',
					'bxfgp'=>isset($gd->bxfgp)?sprintf("%.1f",round($gd->bxfgp, 1)):'-',
					'bx3ptm'=>isset($gd->bx3ptm)?$gd->bx3ptm:'-',
					'bx3pta'=>isset($gd->bx3pta)?$gd->bx3pta:'-',
					'bx3ptp'=>isset($gd->bx3ptp)?sprintf("%.1f",round($gd->bx3ptp, 1)):'-',
					'bxftm'=>isset($gd->bxftm)?$gd->bxftm:'-',
					'bxfta'=>isset($gd->bxfta)?$gd->bxfta:'-',
					'bxftp'=>isset($gd->bxftp)?sprintf("%.1f",round($gd->bxftp, 1)):'-',
					'bxoreb'=>isset($gd->bxoreb)?$gd->bxoreb:'-',
					'bxdreb'=>isset($gd->bxdreb)?$gd->bxdreb:'-',
					'bxtreb'=>isset($gd->bxtreb)?$gd->bxtreb:'-',
					'bxast'=>isset($gd->bxast)?$gd->bxast:'-',
					'bxto'=>isset($gd->bxto)?$gd->bxto:'-',
					'bxst'=>isset($gd->bxst)?$gd->bxst:'-',
					'bxblk'=>isset($gd->bxblk)?$gd->bxblk:'-',
					'bxpf'=>isset($gd->bxpf)?$gd->bxpf:'-',
					'bxpts'=>isset($gd->bxpts)?$gd->bxpts:'-',
					'bxeff'=>isset($gd->bxeff)?$gd->bxeff:'-',
					'bxeff36'=>isset($gd->bxeff36)?sprintf("%.1f",round($gd->bxeff36, 1)):'-'));
				}
			}
		}else{
			$resultAry = DB::table('gamelog')->where('fbid','=',$inputid)->where('season','=',$inputseason)->select('*','geff AS colsum')->get();
			$game_length = count($resultAry);			
			foreach($resultAry as $key => $gd){
				$data[$key]=$gd->colsum;
				$info['min1'][$key]=round($gd->bxmin,2);
				$info['min2'][$key]=0;
				$info['date'][$key]=$gd->gdate;
				$info['oppo'][$gd->gdate]=$gd->goppo;
				if( $game_length-$key<82 ){
					array_push($table,array(				
					'gdate'=>$gd->gdate,
					'goppo'=>$gd->goppo,
					'score'=>$gd->gresult,
					'startfive'=>$gd->ggp,
					'bxmin'=>isset($gd->bxmin)?sprintf("%.1f",round($gd->bxmin, 1)):'-',
					'bxfgm'=>isset($gd->gfgm)?$gd->gfgm:'-',
					'bxfga'=>isset($gd->gfga)?$gd->gfga:'-',
					'bxfgp'=>isset($gd->gfg)?sprintf("%.1f",round($gd->gfg, 1)):'-',
					'bx3ptm'=>isset($gd->g3ptm)?$gd->g3ptm:'-',
					'bx3pta'=>isset($gd->g3pta)?$gd->g3pta:'-',
					'bx3ptp'=>isset($gd->g3pt)?sprintf("%.1f",round($gd->g3pt, 1)):'-',
					'bxftm'=>isset($gd->gftm)?$gd->gftm:'-',
					'bxfta'=>isset($gd->gfta)?$gd->gfta:'-',
					'bxftp'=>isset($gd->gft)?sprintf("%.1f",round($gd->gft, 1)):'-',
					'bxoreb'=>isset($gd->goreb)?$gd->goreb:'-',
					'bxdreb'=>isset($gd->gdreb)?$gd->gdreb:'-',
					'bxtreb'=>isset($gd->gtreb)?$gd->gtreb:'-',
					'bxast'=>isset($gd->gast)?$gd->gast:'-',
					'bxto'=>isset($gd->gto)?$gd->gto:'-',
					'bxst'=>isset($gd->gst)?$gd->gst:'-',
					'bxblk'=>isset($gd->gblk)?$gd->gblk:'-',
					'bxpf'=>isset($gd->gpf)?$gd->gpf:'-',
					'bxpts'=>isset($gd->gpts)?$gd->gpts:'-',
					'bxeff'=>isset($gd->geff)?$gd->geff:'-',
					'bxeff36'=>isset($gd->geff36)?sprintf("%.1f",round($gd->geff36, 1)):'-'));
				}
			}
		}		
	
		///轉換array///

			
		///計算MA///
		$ma3 = 1;
		$ma6 = 1;
		$ma9 = 1;
        $madata = array();
		for($i=0;$i<count($data);$i++){
			$madata['current'][$i] = $data[$i];
			
			if( $madata['current'][$i]===NULL ){
				$ma3 = 0;
				$ma6 = 0;
				$ma9 = 0;
			}
			
			$madata['ma3'][$i]=$ma3<3?NULL:round(($data[$i]+$data[$i-1]+$data[$i-2])/3,2);
			$madata['ma6'][$i]=$ma6<6?NULL:round(($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5])/6,2);
			$madata['ma9'][$i]=$ma9<9?NULL:round(($data[$i]+$data[$i-1]+$data[$i-2]+$data[$i-3]+$data[$i-4]+$data[$i-5]+$data[$i-6]+$data[$i-7]+$data[$i-8])/9,2);
			
			$ma3++;
			$ma6++;
			$ma9++;
			
		}
		
		$table_new = array_reverse($table,false);
		
		$card = self::getCard(array($inputid));
		
		$madata['current'] = $madata['current'];
		$madata['ma3'] = $madata['ma3'];
		$madata['ma6'] = $madata['ma6'];
		$madata['ma9'] = $madata['ma9'];
		$madata['min1'] = $info['min1'];
		$madata['min2'] = $info['min2'];
		$madata['date'] = $info['date'];
		$madata['oppo'] = $info['oppo'];
		$madata['table'] = $table_new;
		$madata['card'] = $card;
		
		return $madata;
	}
	
	public static function getPlayer() {
		
		$position = Input::get('player_position');
		$season = Input::get('player_season','ALL');
		
		$season=='ALL' && $season = 'Full';
		
		$resultAry = DB::table('syncplayerlist')
				->leftJoin('biodata','syncplayerlist.fbido','=','biodata.fbido')
				->where('syncplayerlist.datarange','=',$season)
				->where(function($query) use($position){
					if( is_array($position) ){
						foreach($position as $p){
							//$query = $query->orWhere('syncplayerlist.position','LIKE','%'.$p.'%');
						}
					}else
					if( $position!='ALL' ){
						//$query->where('syncplayerlist.position','LIKE','%'.$position.'%');
					}
				})->orderBy('biodata.player')->select('syncplayerlist.fbid','syncplayerlist.team','biodata.player')->get();				
		
		
		$player_option = '';
		if( is_array($resultAry) ){
			foreach($resultAry as $player)
			$player_option .= '<tr><td value ="'.$player->fbid.'" team="'.$player->team.'">'.$player->player.'</td></tr>';
		}
		$queryLog = DB::getQueryLog();
		
		return Response::json(array('playlist'=>$player_option,'query'=>json_encode($queryLog)));

	}
	
	public static function getPlayer2() {
		$season = Input::get('range','Full');
        if ($season=='2014'){
            $season='ALL';
        }
//        var_dump($season);
        //$season=='ALL' && $season = 'Full';
		
		$resultAry = DB::table('syncplayerlist')
				->leftJoin('biodata','syncplayerlist.fbido','=','biodata.fbido')
				->where('syncplayerlist.datarange','=',$season)
				->orderBy('biodata.player')->select('syncplayerlist.fbid','syncplayerlist.team','biodata.player')->get();
		$player_option = '';
		if( is_array($resultAry) ){
			foreach($resultAry as $player)
			$player_option .= '<tr><td class="sign-btn" value ="'.$player->fbid.'" team="'.$player->team.'">'.$player->player.'<div class="muti-btn" /></td></tr>';
		}
		$queryLog = DB::getQueryLog();	
		return Response::json(array('playlist'=>$player_option,'query'=>json_encode($queryLog)));
	}

	public static function getPlayer3() {
			
		$resultAry = DB::table('ncaadataframe')				
				->orderBy('player')->select('fbid','player')->get();
		$player_option = '';
		if( is_array($resultAry) ){
			foreach($resultAry as $player)
			$player_option .= '<tr><td class="sign-btn" value ="'.$player->fbid.'>'.$player->player.'<div class="muti-btn" /></td></tr>';
		}
		$queryLog = DB::getQueryLog();		
		return Response::json(array('playlist'=>$player_option,'query'=>json_encode($queryLog)));
	}        
        
        
	public static function getMatch()	{
		//$datarange = 'D07';
		$datarange = Input::get('datarange');
		$player_array = Input::get('player');
		$matchMethod = Input::get('matchMethod');
		
		foreach( $player_array as $player ){
			$fbid = $player['fbid'];
			
			if( $matchMethod=='method1' ){ //shape
				$pickprdata = DB::table('syncdataframe')->where('fbid','=',$fbid)->where('datarange','=',$datarange)->select('swfgp','sw3ptm','swftp','swtreb','swast','swst','swblk','swpts')->first();
				$allprdata = DB::table('syncdataframe')->where('datarange','=',$datarange)->select('fbid','swfgp','sw3ptm','swftp','swtreb','swast','swst','swblk','swpts')->get();
				$dist= array();
				foreach($allprdata as $player){
					$dist[$player->fbid] = pow($player->swfgp-$pickprdata->swfgp,2) + 
						pow($player->sw3ptm-$pickprdata->sw3ptm,2) + 
						pow($player->swftp-$pickprdata->swftp,2) + 
						pow($player->swtreb-$pickprdata->swtreb,2) + 
						pow($player->swast-$pickprdata->swast,2) + 
						pow($player->swst-$pickprdata->swst,2) + 
						pow($player->swblk-$pickprdata->swblk,2) + 
						pow($player->swpts-$pickprdata->swpts,2);
				}
				
			}elseif( $matchMethod=='method2' ){ //better case
				$pickprdata = DB::table('syncdataframe')->where('fbid','=',$fbid)->where('datarange','=',$datarange)
                        ->select(DB::raw('swfgm*42/pwmin as swfgm,'
                                . 'swfga*42/pwmin as swfga,'
                                . 'swftm*42/pwmin as swftm,'
                                . 'swfta*42/pwmin as swfta,'
                                . 'sw3ptm*42/pwmin as sw3ptm,'
                                . 'swtreb*42/pwmin as swtreb,'
                                . 'swast*42/pwmin as swast,'
                                . 'swst*42/pwmin as swst,'
                                . 'swblk*42/pwmin as swblk,'
                                . 'swto*42/pwmin as swto,'
                                . 'swpts*42/pwmin as swpts'))->first();
				$allprdata = DB::table('syncdataframe')->where('datarange','=',$datarange)->where('fbid','!=',$fbid)->select('fbid','swfgm','swfga','swftm','swfta','sw3ptm','swtreb','swast','swst','swblk','swpts','swto','swpf')->get();				
				$dist= array();
                foreach($allprdata as $player){
					$dist[$player->fbid] = pow($player->swfgm-$pickprdata->swfgm,2) +
                            pow($player->swfga-$pickprdata->swfga,2) +
                            pow($player->swftm-$pickprdata->swftm,2) +
                            pow($player->swfta-$pickprdata->swfta,2) +
                            pow($player->sw3ptm-$pickprdata->sw3ptm,2) +
                            pow($player->swtreb-$pickprdata->swtreb,2) + 
                            pow($player->swast-$pickprdata->swast,2) + 
                            pow($player->swst-$pickprdata->swst,2) + 
                            pow($player->swblk-$pickprdata->swblk,2) + 
                            pow($player->swto-$pickprdata->swto,2) + 
                            pow($player->swpts-$pickprdata->swpts,2);
				}
//				foreach($allprdata as $player){
//                    if ($pickprdata->sw3ptm-$player->sw3ptm<0.5
//                            && $pickprdata->swtreb-$player->swtreb<0.5
//                            && $pickprdata->swast-$player->swast<0.5
//                            && $pickprdata->swst-$player->swst<0.5
//                            && $pickprdata->swblk-$player->swblk<0.5
//                            && $pickprdata->swpts-$player->swpts<0.5){
//                        $dist[$player->fbid] = standard_deviation(array(($player->sw3ptm-$pickprdata->sw3ptm),
//                            ($player->swtreb-$pickprdata->swtreb),
//                            ($player->swast-$pickprdata->swast),
//                            ($player->swst-$pickprdata->swst),
//                            ($player->swblk-$pickprdata->swblk),
//                            ($player->swpts-$pickprdata->swpts)),0);
//                    }					
//				}

			}elseif( $matchMethod=='method3' ){ //worse case
				$pickprdata = DB::table('syncdataframe')->where('fbid','=',$fbid)->where('datarange','=',$datarange)
                        ->select(DB::raw('swfgm*20/pwmin as swfgm,'
                                . 'swfga*20/pwmin as swfga,'
                                . 'swftm*20/pwmin as swftm,'
                                . 'swfta*20/pwmin as swfta,'
                                . 'sw3ptm*20/pwmin as sw3ptm,'
                                . 'swtreb*20/pwmin as swtreb,'
                                . 'swast*20/pwmin as swast,'
                                . 'swst*20/pwmin as swst,'
                                . 'swblk*20/pwmin as swblk,'
                                . 'swto*20/pwmin as swto,'
                                . 'swpts*20/pwmin as swpts'))->first();
				$allprdata = DB::table('syncdataframe')->where('datarange','=',$datarange)->where('fbid','!=',$fbid)->select('fbid','swfgm','swfga','swftm','swfta','sw3ptm','swtreb','swast','swst','swblk','swpts','swto','swpf')->get();				
				$dist= array();
                foreach($allprdata as $player){
					$dist[$player->fbid] = pow($player->swfgm-$pickprdata->swfgm,2) +
                            pow($player->swfga-$pickprdata->swfga,2) +
                            pow($player->swftm-$pickprdata->swftm,2) +
                            pow($player->swfta-$pickprdata->swfta,2) +
                            pow($player->sw3ptm-$pickprdata->sw3ptm,2) +
                            pow($player->swtreb-$pickprdata->swtreb,2) + 
                            pow($player->swast-$pickprdata->swast,2) + 
                            pow($player->swst-$pickprdata->swst,2) + 
                            pow($player->swblk-$pickprdata->swblk,2) + 
                            pow($player->swto-$pickprdata->swto,2) + 
                            pow($player->swpts-$pickprdata->swpts,2);
				}               
                
			}elseif( $matchMethod=='method4' ){
				$pickprdata = DB::table('syncdataframe')->where('fbid','=',$fbid)->where('datarange','=',$datarange)->select('swmin','swfgm','swfga','swfgp','sw3ptm','sw3pta','sw3ptp','swftm','swfta','swftp','sworeb','swdreb','swtreb','swast','swto','swatr','swst','swblk','swpf','swpts','swtech')->first();
				$allprdata = DB::table('syncdataframe')->where('datarange','=',$datarange)->select('fbid','swmin','swfgm','swfga','swfgp','sw3ptm','sw3pta','sw3ptp','swftm','swfta','swftp','sworeb','swdreb','swtreb','swast','swto','swatr','swst','swblk','swpf','swpts','swtech')->get();
				$dist= array();
				foreach($allprdata as $player){
					$dist[$player->fbid] = pow($player->swmin-$pickprdata->swmin,2) + 
						pow($player->swfgm-$pickprdata->swfgm,2) + 
						pow($player->swfga-$pickprdata->swfga,2) + 
						pow($player->swfgp-$pickprdata->swfgp,2) + 
						pow($player->sw3ptm-$pickprdata->sw3ptm,2) + 
						pow($player->sw3pta-$pickprdata->sw3pta,2) + 
						pow($player->sw3ptp-$pickprdata->sw3ptp,2) + 
						pow($player->swftm-$pickprdata->swftm,2) + 
						pow($player->swfta-$pickprdata->swfta,2) + 
						pow($player->swftp-$pickprdata->swftp,2) + 
						pow($player->sworeb-$pickprdata->sworeb,2) + 
						pow($player->swdreb-$pickprdata->swdreb,2) + 
						pow($player->swast-$pickprdata->swast,2) + 
						pow($player->swto-$pickprdata->swto,2) +
                        pow($player->swatr-$pickprdata->swatr,2) + 
						pow($player->swst-$pickprdata->swst,2) + 
						pow($player->swblk-$pickprdata->swblk,2) + 
						pow($player->swpf-$pickprdata->swpf,2) + 
						pow($player->swpts-$pickprdata->swpts,2) + 
						pow($player->swtech-$pickprdata->swtech,2);
				}
								
//			}else{
//				$pickprdata = DB::table('syncdataframe')->where('fbid','=',$fbid)->where('datarange','=',$datarange)->select('swmin','swfgm','swfga','swfgp','sw3ptm','sw3pta','sw3ptp','swftm','swfta','swftp','sworeb','swdreb','swtreb','swast','swto','swatr','swst','swblk','swpf','swpts','swtech')->first();
//				$allprdata = DB::table('syncdataframe')->where('datarange','=',$datarange)->select('fbid','swmin','swfgm','swfga','swfgp','sw3ptm','sw3pta','sw3ptp','swftm','swfta','swftp','sworeb','swdreb','swtreb','swast','swto','swatr','swst','swblk','swpf','swpts','swtech')->get();
//				$dist= array();
//				foreach($allprdata as $player){
//					$dist[$player->fbid] = standard_deviation(array(($player->swfgm-$pickprdata->swfgm),
//						($player->swfga-$pickprdata->swfga),
//						($player->sw3ptm-$pickprdata->sw3ptm),
//						($player->sw3pta-$pickprdata->sw3pta),
//						($player->swftm-$pickprdata->swftm),
//						($player->swfta-$pickprdata->swfta),
//						($player->sworeb-$pickprdata->sworeb),
//						($player->swdreb-$pickprdata->swdreb),
//						($player->swast-$pickprdata->swast),
//						($player->swto-$pickprdata->swto),
//						($player->swst-$pickprdata->swst),
//						($player->swblk-$pickprdata->swblk),
//						($player->swpf-$pickprdata->swpf),
//						($player->swpts-$pickprdata->swpts)),0);
//				}
			}
			
			asort($dist);
			$distkey=array_keys($dist);
			$matchop=array($distkey[1],$distkey[2],$distkey[3],$distkey[4],$distkey[5],$distkey[6]);					
			
			$player_array = array($fbid,$matchop[0],$matchop[1],$matchop[2],$matchop[3],$matchop[4],$matchop[5]);
			$ability = self::ability($datarange,$player_array);
			array_push($matchop,$fbid);			
			$card = self::getCard($matchop);
			$ability['name'] = array();
			$ability['name'][0] = $card[count($card)-1]['cardplayer'];
			$ability['name'][1] = $card[0]['cardplayer'];
			$ability['name'][2] = $card[1]['cardplayer'];
			$ability['name'][3] = $card[2]['cardplayer'];
			$ability['name'][4] = $card[3]['cardplayer'];
			$ability['name'][5] = $card[4]['cardplayer'];
			$ability['name'][6] = $card[5]['cardplayer'];
			return Response::json(array('ability'=>$ability,'card'=>$card));
		}
	}
	
	


	
	
	public static function getAbility()	{
		$datarange = Input::get('datarange');
		$player_array = array_pluck(Input::get('player'), 'fbid');
		return Response::json(self::ability($datarange,$player_array));
	}
	
	public static function ability($datarange,$player_array) {
		
		$plays_value_array = array();
		$plays_table_array = array();
		$plays_basic_array = array();

		foreach( $player_array as $player ){
            $fbid = $player;
			
			$resultAry = DB::table('syncdataframe')->leftJoin('syncplayerlist','syncdataframe.fbido','=','syncplayerlist.fbido')
					->where('syncdataframe.fbid','=',$fbid)
					->where('syncdataframe.datarange','=',$datarange)
					->where('syncplayerlist.datarange','=',$datarange)->get();
			
			$basic_array = array();
			$player_basic = DB::table('syncplayerlist')
							->select('team','position','injna')
							->where('fbid','=',$fbid)
							->where('datarange','=','Full')->get();
			array_push($basic_array,$player_basic[0]->team);	
			array_push($basic_array,$player_basic[0]->position);
			array_push($basic_array,$player_basic[0]->injna);			

			$value_array = array();
			$table_array = array();
			if( is_array($resultAry ) ){
				foreach($resultAry as $res){
					array_push($value_array,round($res->swftp, 2));
					array_push($value_array,round($res->sw3ptm, 2));
					array_push($value_array,round($res->swast, 2));
					array_push($value_array,round($res->swst, 2));
					array_push($value_array,round($res->swfgp, 2));
					array_push($value_array,round($res->swblk, 2));
					array_push($value_array,round($res->swtreb, 2));
					array_push($value_array,round($res->swpts, 2));
					
					array_push($table_array,round($res->wgp, 0));
					array_push($table_array,sprintf("%.2f",round($res->pwmin, 2)));
					array_push($table_array,sprintf("%.1f",round($res->pwfgm, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwfga, 1)));
					array_push($table_array,sprintf("%.1f",round($res->wfgp*100, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pw3ptm, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pw3pta, 1)));
					array_push($table_array,sprintf("%.1f",round($res->w3ptp*100, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwftm, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwfta, 1)));			
					array_push($table_array,sprintf("%.1f",round($res->wftp*100, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pworeb, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwdreb, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwtreb, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwast, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwto, 1)));
					array_push($table_array,sprintf("%.2f",round($res->watr, 2)));
					array_push($table_array,sprintf("%.2f",round($res->pwst, 2)));
					array_push($table_array,sprintf("%.2f",round($res->pwblk, 2)));
					array_push($table_array,sprintf("%.1f",round($res->pwpf, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pwpts, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pweff, 1)));
					array_push($table_array,sprintf("%.1f",round($res->pweff36, 1)));
					
					/*array_push($basic_array,$res->team);
					array_push($basic_array,$res->position);
					array_push($basic_array,$res->injna);					*/
																								
				}
			}
		
			array_push($plays_value_array,$value_array);
			array_push($plays_table_array,$table_array);
			array_push($plays_basic_array,$basic_array);			
		
		}		
		
		return array('value'=>$plays_value_array,'table'=>$plays_table_array,'basic'=>$plays_basic_array);		
	}
	
	
}


	function standard_deviation($aValues, $bSample = false)
	{
		$fMean = array_sum($aValues) / count($aValues);
		$fVariance = 0.0;
		foreach ($aValues as $i)
		{
			$fVariance += pow($i - $fMean, 2);
		}
		$fVariance /= ( $bSample ? count($aValues) - 1 : count($aValues) );
		return (float) sqrt($fVariance);
	}