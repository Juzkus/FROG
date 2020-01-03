<?php
include_once "include.php";

function user_password_matches($userNameOrEmail, $pass)
{
	# TODO - check if input is email format.
	$user = get_user($userNameOrEmail, USER_NAME_LOOKUP);	
	$dbHashedPass = $user['passHash'];
	
	return password_verify($pass, $dbHashedPass);
}

function get_user($user, $lookupType)
{
	if ($lookupType == USER_NAME_LOOKUP)
	{
		return db_get_user_by_username($user);
	}
	
	# TODO - other lookups.
	return null;
}

?>