<?php
// Author: Andrew Afonso
// Description: Login page.

// Overall Status: Functional, but could use more. Needs captcha, and cookies.
// Security: No inline vulns seen
// Styling: Basic styling


// Inialize session
session_start();

// Check if there is already a session for this client
if(isset($_SESSION['username'])){
    // Checks the session validity
    include_once("config/session_validate.php");
    
    // If a valid logged in user, redirect to the competition page
    header('Location: competition.php');
}
?>
<!doctype html>
<head>
	<title>NSIC Login</title>
	<meta name="description" content="NSIC 2020 Login" />
	<meta name="keywords" content="NSIC, Login, NextHop, Competition, RIT" />
	<?php include("config/head.php"); ?>
</head>
<body>
	
	<?php include("config/header.php"); ?>
	
	<div class="vcenter text">
		<div class="vcenterholder center">
			<form method="POST" action="config/loginhandler.php">
				<fieldset>
					<h1>NSIC 2020 Login</h1>
					<label>Username: <input class="softfield" type="text" name="username" size="20"></label>
					<br>
					<label>Password: <input class="softfield" type="password" name="password" size="20"></label>
					<br>
					(We use cookies)
					<br>
					<input class="loginbtn" type="submit" value="Login">
				</fieldset>
			</form>
		</div>
	</div>
	
	<?php include("config/footer.php"); ?>
	
</body>
</html>
