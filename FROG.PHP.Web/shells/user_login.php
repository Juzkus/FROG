<?php
	
?>
<style>
.user_login
{
	background: forestgreen;
	border: 1px solid green;
	padding: 12px;
	width: 200px;
	height: 200px;
}
</style>
<script>

function tryLogin() {
	let user = document.getElementById('user');
	let pass = document.getElementById('guacamole');
	
	// call try endpoint - returns status + callback id.
	// the callback id will be for a temporary route that will establish our session.
	console.log(user.value);
	console.log(pass.value);
}

</script>
<div class="user_login">
	<input type="text" name="user" placeholder="Username/Email" id="user" />
	<input type="password" name="guacamole" id="guacamole" />
	<input type="button" name="login" id="login" onclick="tryLogin()"/>
</div>