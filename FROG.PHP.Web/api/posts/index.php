<?php
include_once "../../include.php";

###########
# GET
###########
function get_recent_posts()
{
	$firstPost = [];
	$firstPost['id'] = 'abc123';
	$firstPost['title'] = 'A post title';
	$firstPost['desc'] = 'Some words that better articulate what I am trying to say.';
	
	$secondPost = ['id' => 'xyz789', 'title' => 'Another post', 'desc' => 'Just because a list should have at least two things in most cases. Otherwise it would be a note, wouldn\'t it?'];
	
	$data = array($firstPost, $secondPost);
	
	write_json_response($data);
}

function get_specific_post($postId)
{
	$result = db_get_post_by_id($postId);
	
	write_json_response($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
	if (isset($_GET['id']))
	{
		get_specific_post($_GET['id']);
	}
	else
	{
		get_recent_posts();
	}
}
?>