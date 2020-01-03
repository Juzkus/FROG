<?php
include_once "include.php";

session_start();

function has_session()
{
	return isset($_SESSION['id']);
}

function get_session_id()
{
	return $_SESSION['id'];
}

function get_session_user_name()
{
	return $_SESSION['user_name'];
}

function create_session($authToken)
{
	if (!has_session())
	{
		$_SESSION['id'] = create_session_guid();
		
		# Look up which user signed in via authToken table.
		$userId = db_get_user_id_for_session_auth_token($authToken);
		
		$user = get_user($userId, USER_ID_LOOKUP);
		
		# TODO - User Role from DB
		$userRole = REG_USER;
		$startTime = date(DateTime::ISO8601);
		
		# TODO
		# Fetch settings for user.
		
		# Set Session Values
		$_SESSION['user_id'] = $userId;
		$_SESSION['user_name'] = $user['userName'];		
		$_SESSION['user_role'] = $userRole;
		$_SESSION['start_time'] = $startTime;
	}
}

function end_session()
{
	session_unset();
	session_destroy();
}
?>