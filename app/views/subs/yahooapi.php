

<div style="background-color:#FFF">

<span style="font-size:18px;font-weight:bold;color:#000">fantasy/v2/</span>
<input size="120" value="users;use_login=1/games/leagues/teams/players" style="font-size:18px;font-weight:bold; border:0;width:800px" />
<button class="sent">sent</button>
<a target="_self" href="ylogin.php">login yahoo</a>
<textarea rows="50" cols="150"></textarea>
</div>



<script>
$(function(){
	
	$('button.sent').click(function(){
		
		$.get('yahoo/sent',{input:$('input').val()},function(data){
			console.log(data);
			
			$('textarea').text(data);
			
		}).error(function(e){
			
			console.log(e);
			
		});

	});

});
</script>
