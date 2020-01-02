<?php

function get_request_json_object()
{
	# Get JSON as a string
	$json_str = file_get_contents('php://input');

	return json_decode($json_str);
}

function write_json_response($jsonObject)
{
	header('Content-Type: application/json');
	echo json_encode($jsonObject);
}

?>