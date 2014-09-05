<div class="onepcssgrid-full" id="topbar" style="position:relative;z-index:10">
	<div class="onerow" style="border-bottom: 1px solid #444; background-color: #000">
		<div class="onepcssgrid-1p-1200">

				<div class="onerow">
					<div class="col-1p3">
						<a class="" href="/" style="width:241px;height:48px;display:inline-block;float:left;color:#fff;background:url('/images/home-logo.png');background-repeat:no-repeat;background-size: 241px 48px;background-position:center"></a>
					</div>
					<div class="col-1p9 last" style="height:48px;line-height:48px;background-color:#000;margin-bottom:0;padding:0">
						
						<div style="line-height:48px;border-bottom:0;padding:0 0 0 50px">
							
							<ul class="tabindex" style="margin:0 auto;padding:0">
								<li class="tab">
									<div class="tab-title">
										<h4>Player Board</h4>
										<h4 class="empty" style="left:100%"></h4>
									</div>
									<ul style="width:100%">
										<?=Form::tabi('playerAbility',Lang::get('pagination.playerAbility'))?>
										<?=Form::tabi('gameLog','Game Logs')?>
										<?=Form::tabi('splitStats','Split Stats')?>
										<?=Form::tabi('careerStats','Career Stats')?>
										<!--<li class="tabi"><div class="button" acsrc="yahooapi">test yahoo api</div></li>-->
									</ul>										
								</li>
								<li class="tab">										
									<div class="tab-title">
										<h4>Data Board</h4>
										<h4 style="left:100%"></h4>
									</div>
									<ul style="width:100%">
										<?=Form::tabi('dataScatter','Data Scatter')?>
										<?=Form::tabi('','Stable Analysis','lock')?>
										<?=Form::tabi('','Motion Chart','lock')?>
									</ul>	
								</li>
								<li class="tab">
									<div class="tab-title">
										<h4>Smart Board</h4>
										<h4 style="left:100%"></h4>
									</div>
									<ul style="width:100%">
										<?=Form::tabi('realtimeBox','Real-Time Box')?>
										<?=Form::tabi('hotcoldplayer','Hot & Cold Player')?>	
										<?=Form::tabi('matchPlayer','Similar Player')?>
                                        <?=Form::tabi('playerSalary','Player Salary')?>
										<?=Form::tabi('tradeCompare','Trade Compare','lock')?>
										<?=Form::tabi('','Player Status','lock')?>
									</ul>	
								</li>
								<li class="tab">
									<div class="tab-title">
										<h4>Team Board</h4>
										<h4 style="left:100%"></h4>
									</div>
									<ul style="width:100%">
										<?=Form::tabi('','Motion Chart','lock')?>
										<?=Form::tabi('','Split Stats','lock')?>
									</ul>	
								</li>
								<li class="tab">
									<div class="tab-title">
										<h4>Draft Board</h4>
										<h4 style="left:100%"></h4>
									</div>
									<ul style="width:100%">
										<?=Form::tabi('','Draft Pool','lock')?>
										<?=Form::tabi('draftplayerAbility','Draft Player Ability','lock')?>
										<?=Form::tabi('','Draft Data Scatter','lock')?>
									</ul>	


								</li>
							</ul>
							<div class="clear"></div>
						</div>



					</div>
					<div class="clear"></div>
				</div>

		</div>
	</div>
	<div style="background-color:#888;content: '';display: table;width:100%;height:0;border-top:3px solid #b8860b;border-bottom:0px solid #000"></div>
</div>