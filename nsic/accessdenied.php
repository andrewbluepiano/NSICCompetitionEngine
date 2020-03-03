<?php
// Author: Andrew Afonso
// Description: Page that a competitor sees if trying to access an admin only page.

// Overall Status: Complete.
// Security: Nothing to worry about
// Styling: Done

// Session setup & validation
session_start();
include_once('config/session_validate.php');
?>
<!doctype html>
<html>
<head>
	<title>Access Denied</title>
	<meta name="description" content="User not Authorized." />
	<meta name="author" content="Andrew Afonso" />
	
	<?php include("config/head.php"); ?>
</head>
<body>
	<?php include("config/header.php"); ?>
	
	<div class="vcenter">
		<div class="vcenterholder center">
			<h1>Access Denied</h1>
		</div>
	</div>
	
	<?php include("config/footer.php"); ?>
</body>
</html>
