<?php
include_once "../include.php";

# On success, return callback id session establishment.
function authenticate_user($user, $pass)
{
	$authToken = create_session_setup_guid();
	$response = [];
	$response['session_route'] = $authToken;
	
	# Persist auth token in DB.
	db_create_session_auth($authToken, $user);
	
	# Send user callback auth token.
	write_json_response($response);
}

$UNAUTHORIZED 	= 401;
$OK				= 200;

# Get as an object
$json = get_request_json_object();

$user = $json->user;
$pass = $json->pass;

if (isset($user) && isset($pass))
{
	# http_response_code($OK);
	# header('Status Code', $OK);
}

#http_response_code($UNAUTHORIZED);
# header('Status Code', $UNAUTHORIZED);

authenticate_user($user, $pass);
?>