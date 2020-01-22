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
<?php 
$logoutJS = file_get_contents('js/logout.js');
echo $logoutJS;
?>
</script>

<h3>Dashboard</h3>
<p>Hello, <?php echo $userName; ?></p>
<p>SessionID: <?php echo $sessionId; ?></p>
<button onclick="logout()">Logout</button>
<?php include "shells/inventory_feed.php"; ?>