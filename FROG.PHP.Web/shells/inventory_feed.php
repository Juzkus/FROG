<?php
	# TODO - too much commonality between this and list_feed.php
	# But this kind of better as a table?
?>
<style>
.inventory
{
	background: #f0f0f0;
	border: 1 px solid #d4d4d4;
	padding: 8px;
	width: 400px;
}

.inventory > table > tr > td
{
	width: 120px;
}

.hidden
{
	visibility: hidden;
}
</style>
<script src="/js/requests.js"></script>
<script>
	// Using list of feed items,
	// build DOM.
	function buildInventory(inventory)
	{
		console.log("building inventory");
		console.log(inventory);
		
		let inventoryEl = document.getElementById("inventory");
		let table = document.createElement('table');
		
		for (let i = 0; i < inventory.length; i++)
		{
			// ITEM_NAME, ITEM_PRICE, ITEM_QUANTITY
			console.log(inventory[i]);
			let data = inventory[i];
			let row = document.createElement('tr');
			let nameCol = document.createElement('td');
			let priceCol = document.createElement('td');
			let quantityCol = document.createElement('td');
			
			nameCol.innerText = data['itemName'];
			priceCol.innerText = data['itemPrice'];
			quantityCol.innerText = data['itemQuantity'];
			
			row.appendChild(nameCol);
			row.appendChild(priceCol);
			row.appendChild(quantityCol);
			
			table.appendChild(row);
		}
		
		inventoryEl.appendChild(table);
		inventoryEl.className = 'inventory';
	}
	
	get("/api/inventory", buildInventory);
</script>
<?php
	// feed container	
	echo '<div class="inventory hidden" id="inventory"><h3>Inventory</h3></div>';
?>