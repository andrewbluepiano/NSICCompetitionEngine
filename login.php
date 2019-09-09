<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	// Inialize session
	session_start();
	if (isset($_SESSION['username'])){
		header('Location: scoreboard.php');
	}
?>
<html>
<head>
	<title>NSIC Login</title>
	<?php include("config/head.php"); ?>
</head>
<body>
	<?php include("config/header.php"); ?>
	<div class="vcenter text">
		<div class="vcenterholder center">
			<h1>Competitor Login</h1>
			<form method="POST" action="loginhandler.php">
				<p>Username: <input id="softfield" type="text" name="username" size="20"><br>
				Password: <input id="softfield" type="password" name="password" size="20"><br>
				(We use cookies) <br>
				<input id="loginbtn" type="submit" value="Login">
				</p>
			</form>
		</div>
	</div>
	<?php include("config/footer.php"); ?>
</body>
</html>
 