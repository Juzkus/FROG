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
<script src="/js/requests.js"></script>
<script>
	// Using list of feed items,
	// build DOM.
	function buildFeed(feedJson)
	{
		console.log("building feed");
		console.log(feedJson);
		let feed = document.getElementById("feed");
		
		for (let i = 0; i < feedJson.length; i++)
		{
			console.log(feedJson[i]);
			let data = feedJson[i];
			
			let feedItem = document.createElement('div');
			feedItem.className = "feed_item";
			feedItem.id = "feed_item_" + data['id'];
			
			let feedItemTitle = document.createElement('h2');
			feedItemTitle.innerText = data['title'];
			
			let feedItemDesc = document.createElement('p');
			feedItemDesc.innerText = data['desc'];
			
			feedItem.appendChild(feedItemTitle);
			feedItem.appendChild(feedItemDesc);
			
			feed.appendChild(feedItem);
		}
	}
	
	get("/api/posts", buildFeed);
</script>
<?php
	// feed container	
	echo '<div class="feed" id="feed"></div>';
?>