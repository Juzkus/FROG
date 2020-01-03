<?php
include_once "../include.php";

# On success, return callback id session establishment.
function authenticate_user($user, $pass)
{
	$response = [];
	
	if (user_password_matches($user, $pass))
	{
		$authToken = create_session_setup_guid();
	
		# Persist auth token in DB.
		db_create_session_auth($authToken, $user);
		
		$response['session_route'] = $authToken;
	}
	else
	{
		# FAIL
		$response['error_message'] = "Login Failure.";
	}
	
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
	authenticate_user($user, $pass);
}


?>