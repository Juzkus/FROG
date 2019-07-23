<?php
	// https://stackoverflow.com/questions/6396101/pure-javascript-send-post-data-without-a-form
?>
<style>
.user_login
{
	background: #027379;
	border: 1px solid #142952;
	color: #f8f8f8;
	padding: 12px;
	width: 200px;
	height: 200px;
}
.user_login > input
{
	padding: 5px;
	margin-top: 3px;
	margin-bottom: 2px;	
}

</style>
<script>

window.post = function(url, data) {
  return fetch(url, {method: "POST", body: JSON.stringify(data)});
}

function tryLogin() {
	let user = document.getElementById('user');
	let pass = document.getElementById('guacamole');
	
	// call try endpoint - returns status + callback id.
	// the callback id will be for a temporary route that will establish our session.
	console.log(user.value);
	console.log(pass.value);
	
	post("/api/login", {user: user.value, pass: pass.value}).then(res => {
	  // console.log("Request complete! response:", res);
	  console.log(res.json());
	});
}

</script>
<div class="user_login">
	<h3>Log in</h3>
	<input type="text" name="user" placeholder="Username/Email" id="user" />
	<input type="password" name="guacamole" id="guacamole" />
	<input type="button" name="login" id="login" value="Login" onclick="tryLogin()"/>
</div>