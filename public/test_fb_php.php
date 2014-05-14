<?php
//session_start();
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
//header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
//parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );

require 'facebook.php';


$facebook = new Facebook(array(
	'appId'  => '251984733230',
	'secret' => '0f989f06bccc7029b7a95adc4d8a24f0',
	'allowSignedRequest' => false,
));

$user = $facebook->getUser();


?>

<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy</title>


<style>
body {
	margin: 0;
}
</style>
<script>


      window.fbAsyncInit = function() {
		FB.init({
		  appId      : '251984733230',
		  status     : true, // check login status
		  cookie     : true, // enable cookies to allow the server to access the session
		  xfbml      : true  // parse XFBML
		});
		FB.Event.subscribe('auth.authResponseChange', function(response) {
		// Here we specify what we do with the response anytime this event occurs. 
		if (response.status === 'connected') {
		// The response object is returned with a status field that lets the app know the current
		// login status of the person. In this case, we're handling the situation where they 
		// have logged in to the app.
			testAPI();
		} else if (response.status === 'not_authorized') {
		// In this case, the person is logged into Facebook, but not into the app, so we call
		// FB.login() to prompt them to do so. 
		// In real-life usage, you wouldn't want to immediately prompt someone to login 
		// like this, for two reasons:
		// (1) JavaScript created popup windows are blocked by most browsers unless they 
		// result from direct interaction from people using the app (such as a mouse click)
		// (2) it is a bad experience to be continually prompted to login upon page load.
			FB.login();
		} else {
		// In this case, the person is not logged into Facebook, so we call the login() 
		// function to prompt them to do so. Note that at this stage there is no indication
		// of whether they are logged into the app. If they aren't then they'll see the Login
		// dialog right after they log in to Facebook. 
		// The same caveats as above apply to the FB.login() call here.
			FB.login();
		}
		});
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

</script>
</head>
<body>

<div id="fb-root"></div>
<div style="width:50px">
<div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="true" data-auto-logout-link="false"></div>
</div>
<?
if( $user ) {
	echo 'user'.$user;
	try {		
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me','GET');
		$likes = $facebook->api("/me/likes/403541253109779");    
		var_dump($likes);
	} catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	}
}

if ($user) {
	$logoutUrl = $facebook->getLogoutUrl();
} else {
	$loginUrl = $facebook->getLoginUrl(array('scope' => 'user_status'));
}
?>


<?php if ($user): ?>
	<a href="<?php echo $logoutUrl; ?>">Logout</a>
<?php else: ?>
	<div>
	Login using OAuth 2.0 handled by the PHP SDK:
	<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
	</div>
<?php endif ?>

</body>



</html>

