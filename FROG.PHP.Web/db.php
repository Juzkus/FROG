<?php
include_once "include.php";

/*    
	Using "mysqli" instead of "mysql" that is obsolete.
	Change the value of parameter 3 if you have set a password on the root userid
	Add port number 3307 in parameter number 5 to use MariaDB instead of MySQL
*/

function db_connect()
{
	return new mysqli(DB_HOST, DB_RW_USER, DB_RW_PASS, DB_NAME);
}

function db_test()
{
	$db = db_connect();
	
	if ($db->connect_error) {
		die('Connect Error (' . $db->connect_errno . ') '
				. $mysqli->connect_error);
	}
	echo '<p>Connection OK '. $db->host_info.'</p>';
	echo '<p>Server '.$db->server_info.'</p>';
	// $db->close();
}

function db_create_session_auth($authToken, $userId)
{
	$id = create_primary_guid();
	
	/* Prepared statement, stage 1: prepare */
	# if (!($stmt = $mysqli->prepare("INSERT INTO SESSION_AUTH(ID, AUTH_TOKEN, USER_ID, IS_VALID) VALUES (?, ?, ?, ?)"))) {
	# 	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	# }
	$db = db_connect();
	$stmt = $db->prepare("INSERT INTO SESSION_AUTH(ID, AUTH_TOKEN, USER_ID, IS_VALID) VALUES (?, ?, ?, ?)");

	/* Prepared statement, stage 2: bind and execute */
	# if (!$stmt->bind_param("ID", $id)) {
	# 	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	# }
	$isValid = 1;
	
	$stmt->bind_param("sssi", $id, $authToken, $userId, $isValid);

	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function db_get_user_id_for_session_auth_token($authToken)
{
	$db = db_connect();
	$stmt = $db->prepare("SELECT USER_ID FROM SESSION_AUTH WHERE AUTH_TOKEN = ?");
	$stmt->bind_param("s", $authToken);
	$stmt->execute();

	$userId = "";
	$result = $stmt->get_result();
	
	# if($result->num_rows === 0) exit('No rows');
	
	while($row = $result->fetch_assoc()) 
	{
		$userId = $row['USER_ID'];
	}
	
	return $userId;
}

function db_is_valid_auth($authToken)
{
	$db = db_connect();
	$stmt = $db->prepare("SELECT IS_VALID FROM SESSION_AUTH WHERE AUTH_TOKEN = ?");
	$stmt->bind_param("s", $authToken);
	$stmt->execute();

	$isValid = 0;
	$result = $stmt->get_result();
	
	if($result->num_rows === 1)
	{
		$row = $result->fetch_assoc();
		$isValid = $row['IS_VALID'];
	}
	
	return $isValid == 1;
}

function db_invalidate_session_auth($authToken)
{
	$db = db_connect();
	$isValid = 0;
	
	$stmt = $db->prepare("UPDATE SESSION_AUTH SET IS_VALID=? WHERE AUTH_TOKEN=?");
	$stmt->bind_param("is", $isValid, $authToken);
	$stmt->execute();
}


######################################
# USER TABLE
######################################

function db_get_user_by_field($fieldName, $fieldValue)
{
	$db = db_connect();
	$stmt = $db->prepare("SELECT ID, USER_NAME, PASS_HASH, EMAIL, CREATED, IS_VALID FROM USERS WHERE ? = ?");
	$stmt->bind_param("ss", $fieldName, $fieldName);
	$stmt->execute();
	$result = $stmt->get_result();
	
	$user = [];
	
	if($result->num_rows === 1)
	{
		$row = $result->fetch_assoc();
		
		$user['id'] 		= $row['ID'];
		$user['userName'] 	= $row['USER_NAME'];
		$user['passHash'] 	= $row['PASS_HASH'];
		$user['email'] 		= $row['EMAIL'];
		$user['created'] 	= $row['CREATED'];
		$user['isValid'] 	= $row['IS_VALID'];
	}
	
	return $user;
}


######################################
# Connecting - most endpoints need DB.
######################################
# db_connect();
?>