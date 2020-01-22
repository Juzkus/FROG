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
	
	
	$strPostType = $json->type;
	$postType = 0;
	
	switch ($strPostType)
	{
		case "blog":
			$postType = BLOG_POST;
			break;
		case "macro":
			$postType = MACRO_POST;
			break;
		case "micro":
		default:
			$postType = MICRO_POST;
			break;
	}	
	
	$userId = get_session_user_id();
	
	$response = [];
	$response["id"] = create_primary_guid();
	$response["title"] = $json->title;
	$response["type"] = $postType;
	$response["user"] = $userId;
	write_json_response($response);
}

?>