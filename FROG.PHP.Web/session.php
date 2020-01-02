<?php
include_once "include.php";

session_start();

function has_session()
{
	return isset($_SESSION['id']);
}

function create_session($authToken)
{
	if (!has_session())
	{
		$_SESSION['id'] = create_session_guid();
		
		# TODO
		# Look up which user signed in via authToken table.
		$userId = 'some_user_id';
		$userRole = REG_USER;
		$startTime = date(DateTime::ISO8601);
		
		# TODO
		# Fetch settings for user.
		
		# Set Session Values
		$_SESSION['user_id'] = $userId;
		$_SESSION['user_role'] = $userRole;
		$_SESSION['start_time'] = $startTime;
	}
}
?>