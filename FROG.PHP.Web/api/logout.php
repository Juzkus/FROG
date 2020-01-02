<?php
include_once "../include.php";

end_session();

$hasSession = has_session();

if (has_session())
{
	echo "still logged in.";
}
else
{
	echo "logged out.";
}
?>
<script>
setTimeout(function(){
	window.location.href = window.location.origin + '/demo';
}, 1700);
</script>