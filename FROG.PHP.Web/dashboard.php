<?php
include_once "include.php";

if (!has_session())
{
	header("Location: /demo");
}

$sessionId = get_session_id();
$userName = get_session_user_name();

?>
<script>
function logout()
{
	window.location.href = window.location.origin + '/api/logout';
}
</script>

<h3>Dashboard</h3>
<p>Hello, <?php echo $userName; ?></p>
<p>SessionID: <?php echo $sessionId; ?></p>
<button onclick="logout()">Logout</button>