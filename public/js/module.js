var fbModule = {}

window.fbModule = fbModule;

fbModule.init = function(mid){
	switch(mid){
		case '1':
			alert(mid);
			$('.modelBox .player_position').triggerHandler('change');
		break;
	}
};
	
	
	
