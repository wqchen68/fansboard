$(function(){
	
	var time_count;
	pageobj.bind('startjs',function(){	
            time_count = new counter({
                msg1:' [curmin] : [cursec] ',
                msg2:' [cursec] ',
                timeout_zero: function(){
                    angular.element('[ng-controller=realtimeBoxController]').scope().update();
                }
            });
	});
	
	function counter(options, callback) {

            var limit = "00:24";
            var timeout_fc = options.timeout_zero;
            var msg1 = options.msg1;
            var msg2 = options.msg2;
            var speed = 1000;
            var parselimit;
            var cursec;

            var init = function() {			
                    var parselimit_split = limit.split(":");
                    parselimit = parselimit_split[0]*60+parselimit_split[1]*1;
                    begintimer();
            };

            var end = function() {
                    timeout_fc();
                    init();
            };

            var begintimer = function() {
                    var curmin = Math.floor(parselimit/60);
                    cursec = parselimit%60;
                    var cursec_fix,curtime,newmsg1,newmsg2;

                    if( curmin!==0 ){
                            cursec_fix = new Array(2-cursec.toString().length+1).join("0")+cursec;
                            newmsg1 = msg1.replace(/\[curmin\]/i, curmin);
                            newmsg1 = newmsg1.replace(/\[cursec\]/i, cursec_fix);
                            curtime = newmsg1;
                    }else{
                            cursec_fix = new Array(2-cursec.toString().length+1).join("0")+cursec;
                            newmsg2 = msg2.replace(/\[cursec\]/i, cursec_fix);
                            curtime = newmsg2;
                    }
                    window.status = curtime;
                    $('.reflashtime').html(curtime);

                    if( parselimit === -1 ){
                            end();
                    }else{ 
                            parselimit -= 1;

                            setTimeout(begintimer,speed);
                    }

            };

            init();

            this.getsec = function() {
                    return cursec;
            };	

	}
        	
});