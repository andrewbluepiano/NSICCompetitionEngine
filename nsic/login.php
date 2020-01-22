<?php
// Author: Andrew Afonso

// Inialize session
session_start();

if (isset($_SESSION['username'])){
    
    include_once("config/session_validate.php");
    
    header('Location: competition.php');
}

?>
<!doctype html>
<head>
	<title>NSIC Login</title>
	<?php include("config/head.php"); ?>
</head>
<body>
	<?php include("config/header.php"); ?>
	<div class="vcenter text">
		<div class="vcenterholder center">
			<h1>Competitor Login</h1>
			<form method="POST" action="config/loginhandler.php">
				<p>Username: <input class="softfield" type="text" name="username" size="20"><br>
				Password: <input class="softfield" type="password" name="password" size="20"><br>
				(We use cookies) <br>
				<input class="loginbtn" type="submit" value="Login">
				</p>
			</form>
		</div>
	</div>
	<?php include("config/footer.php"); ?>
</body>
</html>
