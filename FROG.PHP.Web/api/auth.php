<?php
include_once "../include.php";

# On success, return callback id session establishment.
function setup_session($authToken)
{	
	if (db_is_valid_auth($authToken))
	{
		create_session($authToken);
		
		# Invalidate auth token - this token is to be used only once.		
		db_invalidate_session_auth($authToken);
		
		header("Location: /dashboard");
	}
	else
	{
		#TODO 403
		echo 403;
	}
}

# Endpoint Starts Here
if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
	$endpoint = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$parts = explode("/", $endpoint);
	
	if (count($parts) == 4)
	{
		$authToken = $parts[3];
	
		setup_session($authToken);
	}
	else
	{
		var_dump($parts);
		# TODO - 403
	}
}
else
{
	# TODO
	# 403
}
?>