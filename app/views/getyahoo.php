<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

include('yahoo.inc.php');




function _make_signed_request( $consumer_key, $consumer_secret, $token, $token_secret, $signature_method, $url, $params = array() ) {

  // Only support GET in this function
  $method = 'GET';

  $signature_method = strtoupper( $signature_method );
  if( $signature_method != 'PLAINTEXT' && $signature_method != 'HMAC-SHA1' ) {
    print "Invalid signature method: ${signature_method}\n";
    return false;
  }

  $oauth_nonce = rand( 0, 999999 );
  $oauth_timestamp = time();
  $oauth_version = '1.0';

  $params['oauth_consumer_key'] = $consumer_key;
  $params['oauth_nonce'] = $oauth_nonce;
  $params['oauth_signature_method'] = $signature_method;
  $params['oauth_timestamp'] = $oauth_timestamp;
  $params['oauth_version'] = $oauth_version;

  if( $token ) {
    $params['oauth_token'] = $token;
  }
  if( ! $token_secret ) {
    $token_secret = '';
  }
  
  // Params need to be sorted by key
  ksort( $params, SORT_STRING );

  // Urlencode params and generate param string
  $param_list = array();
  foreach( $params as $key => $value ) {
    $param_list[] = urlencode( $key ) . '=' . urlencode( $value );
  }
  $param_string = join( '&', $param_list );
  
  // Generate base string (needed for SHA1)
  $base_string = urlencode( $method ) . '&' . urlencode( $url ) . '&' . 
    urlencode( $param_string );

  // Generate secret
  $secret = urlencode( $consumer_secret ) . '&' . urlencode( $token_secret );
  if( $signature_method == 'PLAINTEXT' ) {
    $signature = $secret;
  } else if( $signature_method == 'HMAC-SHA1' ) {
    $signature = base64_encode( hash_hmac( 'sha1', $base_string, $secret, true ) );
  }
  
  // Append signature
  $param_string .= '&oauth_signature=' . urlencode( $signature );
  $final_url = $url . '?' . $param_string;

  // Make curl call
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $final_url );
  curl_setopt( $ch, CURLOPT_AUTOREFERER, 1 );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0 );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );

  $timeout = 10; // seconds
  curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
  
  $contents = curl_exec($ch);
  $ret_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
  $errno = curl_errno($ch);
  $error_str = curl_error($ch);

  if( $errno || $error_str ) {
    //print "Error: ${error_str} (${errno})\n";
  }

  //print "Response code: ${ret_code}\n";
  //print "Contents:\n${contents}\n\n";
 
  curl_close($ch);
 
  $data = array(
    'return_code' => $ret_code,
    'contents'    => $contents,
    'error_str'   => $error_str,
    'errno'       => $errno 
  );

  return $data;
}



///////////////////////////////////////////////////////////////////////////////
//  FUNCTION oauth_response_to_array
/// @brief Break up the oauth response data into an associate array
///////////////////////////////////////////////////////////////////////////////
function oauth_response_to_array( $response ) {
  $data = array();
  foreach( explode( '&', $response ) as $param ) {
    $parts = explode( '=', $param );
    if( count( $parts ) == 2 ) {
      $data[urldecode($parts[0])] = urldecode($parts[1]);
    }
  }
  return $data;
}


///////////////////////////////////////////////////////////////////////////////
//  FUNCTION get_access_token
/// @brief Get an access token for a certain user and a certain application,
///        based on the request token and verifier
///////////////////////////////////////////////////////////////////////////////
function get_access_token( $consumer_key, $consumer_secret, $request_token, $request_token_secret, $verifier ) {

  $url = 'https://api.login.yahoo.com/oauth/v2/get_token';
  $signature_method = 'plaintext';

  // Add in the oauth verifier
  $params = array( 'oauth_verifier' => $verifier );

  // Make the signed request using the request_token data
  $response_data = _make_signed_request( $consumer_key, $consumer_secret, $request_token, $request_token_secret, $signature_method, $url, $params );
  
  if( $response_data && $response_data['return_code'] == 200 ) {

    $contents = $response_data['contents'];
    $data = oauth_response_to_array( $contents );

    //print_r( $data );

    return $data;
  }

  return false;
}



function make_request( $consumer_key, $consumer_secret, $access_token, $access_token_secret, $url ) {

  $signature_method = 'hmac-sha1';
  
  // Make the signed request to fantasy API
  $response_data = _make_signed_request( $consumer_key, $consumer_secret, $access_token, $access_token_secret, $signature_method, $url );

  return $response_data;
}


///////////////////////////////////////////////////////////////////////////////  
//  FUNCTION get_request_token  
/// @brief Get a request token for a given application.  
///////////////////////////////////////////////////////////////////////////////  
function get_request_token( $consumer_key, $consumer_secret ) {  
  
  $url = 'https://api.login.yahoo.com/oauth/v2/get_request_token';  
  $signature_method = 'plaintext';  
  
  $token = NULL;  
  $token_secret = NULL;  
  
  // Add in the lang pref and callback  
  $xoauth_lang_pref = 'en-us';  
  $oauth_callback = 'oob';  // Set OOB for ease of use -- could be a URL  
    
  $params = array( 'xoauth_lang_pref' => $xoauth_lang_pref,  
                   'oauth_callback'   => $oauth_callback );  
  
  // Make the signed request without any token  
  $response_data = _make_signed_request( $consumer_key, $consumer_secret, $token, $token_secret, $signature_method, $url, $params );  
  
  if( $response_data && $response_data['return_code'] == 200 ) {  
  
    $contents = $response_data['contents'];  
    $data = oauth_response_to_array( $contents );  
  
    //print_r( $data );  
  
    return $data;  
  }  
  
  return false;  
}  






//$request_token_data = get_request_token( $consumer_key, $consumer_secret );
$verifier = Session::get('verifier','');
$request_token = Session::get('request_token','');
$request_token_secret = $_COOKIE['youth_ts'];


$access_token_data = get_access_token( $consumer_key, $consumer_secret, $request_token, $request_token_secret, $verifier );

$access_token = $access_token_data['oauth_token'];
$access_token_secret = $access_token_data['oauth_token_secret'];

$request_url = 'http://fantasysports.yahooapis.com/fantasy/v2/'.Input::get('input','');
//$request_url = "http://fantasysports.yahooapis.com/fantasy/v2/users;use_login=1/games/leagues/teams/players";

$request_data = make_request( $consumer_key, $consumer_secret, $access_token, $access_token_secret, $request_url );

//oauth_token	//Access Token，Step 5 或呼叫其他Yahoo! API可用
//oauth_token_secret	//對應Access Token的秘鑰，用於auth_signature，Step 5 也需要用到
//oauth_session_handle	//用於更新Access Token(Step 5)時的認證碼
//oauth_expires_in	//Access Token有效時間，通常是寫3600(秒)
//oauth_authorization_expires_in	//Access Token將於何時失效，以timestamp型式顯示
//$access_token_data['xoauth_yahoo_guid'];	//Yahoo使用者的唯一識別值，也是本次OAuth的目的

$return_code = $request_data['return_code'];
echo $contents = $request_data['contents'];



$xml = simplexml_load_string($contents);


/*
foreach ($xml->users as $users){ 
	echo var_dump($users);
}
*/

?>