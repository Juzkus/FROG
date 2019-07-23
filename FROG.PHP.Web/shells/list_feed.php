<?php
	/*
	Lists are everywhere in code. 
	This one just takes a list of objects
	that contain an id, title, description and perhaps author (which needs its own shell)
	*/
?>
<style>
.feed_item
{
	background: forestgreen;
	border: green;
	color: white;
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
	$dummyList = array(1, 2, 3);
	
	foreach ($dummyList as $item)
	{
		$html = '<div class="feed_item">' . $item . '</div>';
		echo $html;
		#echo "<h1>" + $item + "</h1>";
	}
?>