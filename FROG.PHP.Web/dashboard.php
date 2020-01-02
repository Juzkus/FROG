<?php
include_once "include.php";

if (!has_session())
{
	header("Location: /demo");
}

$sessionId = get_session_id();
?>
<script>
function logout()
{
	window.location.href = window.location.origin + '/api/logout';
}
</script>

<h3>Dashboard</h3>
<p>Hello, <?php echo $sessionId; ?></p>
<button onclick="logout()">Logout</button>