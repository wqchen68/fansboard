<div class="addin onepcssgrid-1200">	

	<div class="modelBox active" mid="5">
		<div class="transparent" style="height:20px;overflow:hidden;border:0px solid #fff;border-bottom:0">
			<div>
				<input type="text" class="filter gray" style="width:98%;margin:0;padding:1%;border:0;outline: none;color:#999"  placeholder="Type Player Name..." />
			</div>
		</div>
		<div class="transparent" style="height:100%; overflow-y:scroll;border:1px solid #fff;font-size: 14px">	
			<table class="plist playerList-combo" cellspacing="0"><?=Player::getPlayer2()->getData()->playlist;?></table>
		</div>
	</div>


	<div class="modelBox active col6" mid="3">
		<div id="container1" class="" style="border:0px solid #fff;margin:0 0 0 0;padding:0px"></div>
	</div>

	<div class="modelBox active" mid="6">
		<div class="transparent" style="height:20px;overflow:hidden;border:1px solid #fff;border-bottom:0">
			<div>
				<input type="text" class="filter gray" style="width:98%;margin:0;padding:1%;border:0;outline: none;color:#999"  placeholder="Type Player Name..." />
			</div>
		</div>
		<div class="transparent" style="height:100%; overflow-y:scroll;border:1px solid #fff;font-size: 14px">	
			<table class="plist playerList-combo" cellspacing="0"><?//=Player::getPlayer2()->getData()->playlist?></table>
		</div>
	</div>
    
</div>