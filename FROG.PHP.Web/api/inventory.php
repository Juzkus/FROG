<?php
include_once "../include.php";

###########
# GET
###########
function get_inventory()
{
	$inventory = db_get_inventory();
	
	write_json_response($inventory);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
	get_inventory();
}
?>