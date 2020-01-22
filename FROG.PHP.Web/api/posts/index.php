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
	
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
	get_recent_posts();
}
?>