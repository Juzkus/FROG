<?php
	/*
	Lists are everywhere in code. 
	This one just takes a list of objects
	that contain an id, title, description and perhaps author (which needs its own shell)
	*/
?>
<style>
.feed
{
	background: orange;
	border: red;
	padding: 10px;
	width: 300px;
}
.feed_item
{
	background: blue;
	border: 1px solid #f4f4f4;
	color: white;
	margin: auto;
	width: 220px;
	height: 175px;
	margin-top: 15px;
	margin-bottom: 20px;
}
</style>
<script>
	// TODO: Update list from server.
</script>
<?php
	$firstPost = [];
	$firstPost['id'] = 'abc123';
	$firstPost['title'] = 'A post title';
	$firstPost['desc'] = 'Some words that better articulate what I am trying to say.';
	$secondPost = ['id' => 'xyz789', 'title' => 'Another post', 'desc' => 'Just because a list should have at least two things in most cases. Otherwise it would be a note, wouldn\'t it?'];
	$dummyList = array($firstPost, $secondPost);
	
	// outer container	
	echo '<div class="feed">';
	
	foreach ($dummyList as $item)
	{
		echo '<div class="feed_item" id="' . $item['id'] .'">' 
			. '<h4>' . $item['title'] . '</h4>'
			. '<p>' . $item['desc'] . '</p>'
			. '</div>';
	}

	// close container
	echo '</div>';
?>