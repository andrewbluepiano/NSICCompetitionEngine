<?php
// Author: Andrew Afonso
// Description: Page that a competitor sees if trying to access an admin only page.
//				Alerts, then redirects.

// Overall Status: Essentially complete. Could have more intelligent redirect.
// Security: Nothing to worry about
// Styling: Done

// Session setup & validation
session_start();
include_once("config/session_validate.php");
?>
<!doctype html>
<html>
<head>
	<title>User not Authorized</title>
	<meta name="description" content="User not Authorized." />
	<meta name="author" content="Andrew Afonso" />
	<meta http-equiv="Refresh" content="0; url=/nsic/competition">
	
	<?php include("config/head.php"); ?>
	
	<script>
		alert("Access Denied, you are not an Admin.");
	</script>
</head>
<body>
	<?php include("config/header.php"); ?>
	
	<div class="vcenter">
		<div class="vcenterholder center">
			<h3>Access Denied, you are not an Admin.</h3>
		</div>
	</div>
	
	<?php include("config/footer.php"); ?>
</body>
</html>
