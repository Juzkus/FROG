<?php
	include_once "../include.php";
	
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
	
	$data = ['user' => $user, 'pass' => $pass];
	
	write_json_response($data);
?>