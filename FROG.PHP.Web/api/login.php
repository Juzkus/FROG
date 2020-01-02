<?php
include_once "../include.php";

# On success, return callback id session establishment.
function authenticate_user($user, $pass)
{
	$response = [];
	$response['session_route'] = create_session_setup_guid();
	
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