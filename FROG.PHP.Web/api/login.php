<?php
	session_start();
	
	$UNAUTHORIZED 	= 401;
	$OK				= 200;
	
	# Get JSON as a string
	$json_str = file_get_contents('php://input');

	# Get as an object
	$json_obj = json_decode($json_str);
	
	$usr = $json_obj->user;
	$pass = $json_obj->pass;
	
	if (isset($user) && isset($pass))
	{
		# http_response_code($OK);
		# header('Status Code', $OK);
	}
	
	#http_response_code($UNAUTHORIZED);
	# header('Status Code', $UNAUTHORIZED);
	
	$data = ['user' => $usr, 'pass' => $pass];
	header('Content-Type: application/json');
	echo json_encode($data);
?>