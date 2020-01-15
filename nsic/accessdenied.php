<?php
// Author: Andrew Afonso
session_start();

include_once("config/session_validate.php");

?>
<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Access Denied</title>
		<meta name="description" content="Invalid credentials, please try again." />
		<meta http-equiv="Refresh" content="5; url=/nsic/competition">
		<?php include("config/head.php"); ?>
	</head>
	<body>
		<?php include("config/header.php"); ?>
		
		<section class="wrap">
			<p>Access Denied, please login as an admin.</p>
		</section>
		
		<?php include("config/footer.php"); ?>
	</body>
</html>
