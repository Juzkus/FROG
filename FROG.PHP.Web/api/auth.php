<?php
include_once "../include.php";

# On success, return callback id session establishment.
function setup_session($authToken)
{
	# TODO - validate auth token
	$isValid = true;
	
	if ($isValid)
	{
		create_session($authToken);
		
		# TODO - invalidate auth token - this token is to be used only once.		
		
		# TODO - of course we don't want to use the $_SESSION object here
		# Or write the actual session object. This is testing code.
		write_json_response($_SESSION);
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