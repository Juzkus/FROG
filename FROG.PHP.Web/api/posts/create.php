<?php

include_once "../../include.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (!has_session())
	{
		# 403;
		echo 403;
		return;
	}
	
	# Request Body
	$json = get_request_json_object();
	
	$post = [];
	$post["userId"] = get_session_user_id();	
	
	if (isset($json->title))
	{
		$post["title"] = $json->title;
	}
	
	$response = [];
	
	switch ($json->type)
	{
		case "blog":
			break;
		case "macro":
			break;
		case "micro":
		default:
			$post['text'] = $json->text;
			$response['id'] = db_create_micro_post($post);
			break;
	}	
	
	write_json_response($response);
}

?>