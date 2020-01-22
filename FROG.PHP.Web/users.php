<?php
include_once "include.php";

function user_password_matches($user, $pass)
{
	# TODO - check if input is email format.
	# $user = get_user($userNameOrEmail, USER_NAME_LOOKUP);	
	$dbHashedPass = $user['passHash'];
	
	return password_verify($pass, $dbHashedPass);
}

function get_user($user, $lookupType)
{
	$fieldName = 'USER_NAME';
	
	switch ($lookupType) 
	{
		case USER_NAME_LOOKUP:
			$fieldName = 'USER_NAME';
			break;
		case USER_ID_LOOKUP:
			$fieldName = 'ID';
			break;
		case USER_EMAIL_LOOKUP:
			$fieldName = 'EMAIL';
			break;
	}
	
	return db_get_user_by_field($user, $fieldName);
}

?>