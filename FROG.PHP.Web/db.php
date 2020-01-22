<?php
include_once "include.php";

function db_connect()
{
	# Add port number 3307 in parameter number 5 to use MariaDB instead of MySQL
	return new mysqli(DB_HOST, DB_RW_USER, DB_RW_PASS, DB_NAME);
}

function db_test()
{
	$db = $GLOBALS['db'];
	
	if ($db->connect_error) 
	{
		die('Connect Error (' . $db->connect_errno . ') '
				. $mysqli->connect_error);
	}
	
	echo '<p>Connection OK '. $db->host_info.'</p>';
	echo '<p>Server '.$db->server_info.'</p>';
}

######################################
# SESSION AUTH TABLE
######################################

function db_create_session_auth($authToken, $userId)
{
	$id = create_primary_guid();
	
	$db = $GLOBALS['db'];
	$stmt = $db->prepare("INSERT INTO SESSION_AUTH(ID, AUTH_TOKEN, USER_ID, IS_VALID) VALUES (?, ?, ?, ?)");

	$isValid = 1;
	$stmt->bind_param("sssi", $id, $authToken, $userId, $isValid);

	if (!$stmt->execute()) 
	{
		# echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function db_get_user_id_for_session_auth_token($authToken)
{
	$db = $GLOBALS['db'];
	$stmt = $db->prepare("SELECT USER_ID FROM SESSION_AUTH WHERE AUTH_TOKEN = ?");
	$stmt->bind_param("s", $authToken);
	$stmt->execute();

	$userId = "";
	$result = $stmt->get_result();
	
	if($result->num_rows === 1)
	{
		$row = $result->fetch_assoc();
		$userId = $row['USER_ID'];
	}
	
	return $userId;
}

function db_is_valid_auth($authToken)
{
	$db = $GLOBALS['db'];
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
	$db = $GLOBALS['db'];
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
	$db = $GLOBALS['db'];
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
# INVENTORY TABLE
######################################

function db_get_inventory()
{
	$db = $GLOBALS['db'];
	$stmt = $db->prepare("SELECT ID, ITEM_NAME, ITEM_PRICE, ITEM_QUANTITY, IS_ACTIVE FROM INVENTORY WHERE IS_ACTIVE = 1");
	$stmt->execute();
	$result = $stmt->get_result();
	
	$inventory = [];
	
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc())
		{
			$item = [];
			$item['id'] 			= $row['ID'];
			$item['itemName'] 		= $row['ITEM_NAME'];
			$item['itemPrice'] 		= $row['ITEM_PRICE'];
			$item['itemQuantity'] 	= $row['ITEM_QUANTITY'];
			$item['isActive'] 		= $row['IS_ACTIVE'];
			
			array_push($inventory, $item);
		}
	}
	
	return $inventory;
}

######################################
# POSTS TABLES
######################################
function db_create_micro_post($post)
{
	$id = create_primary_guid();
	
	$userId = $post['userId'];	
	$postType = MICRO_POST;	
	
	# Micro posts don't have titles. They are like status updates.
	$title = "";
	$text = $post['text'];
	
	$created = date(DB_DATE_FMT);
	$isValid = 1;
	
	$db = $GLOBALS['db'];
	$stmt = $db->prepare("INSERT INTO POST_METADATA(ID, USER_ID, TITLE, CREATED, TYPE, IS_VALID) VALUES (?, ?, ?, ?, ?, ?)");

	$isValid = 1;
	$stmt->bind_param("ssssii", $id, $userId, $title, $created, $postType, $isValid);

	if ($stmt->execute()) 
	{
		$postDataId = create_primary_guid();
		$postDataStatement = $db->prepare("INSERT INTO POST_DATA_MICRO(ID, META_ID, TEXT) VALUES (?, ?, ?)");
		$postDataStatement->bind_param("sss", $postDataId, $id, $text);
		
		if ($postDataStatement->execute()) 
		{
			return $id;
		}
		else
		{
			# TODO
			# Rollback Metadata insert.
		}
	}
	else
	{
		# echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

######################################
# Connecting - most endpoints need DB.
######################################
$GLOBALS['db'] = db_connect();

?>