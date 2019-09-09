<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	session_start();
	$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/PATH/config.ini"); 	
	mysql_connect($config['rdserver'], $config['rdusername'], $config['rdpassword']) or DIE('Unable to connect to NAS, check if SQL server is enabled');
	mysql_select_db($config['rddbname']) or DIE('Database is not available!');
	// query DB for username and password entery given by input. Note output from MD5 function passed as password:
	$login = mysql_query("SELECT * FROM users WHERE (compuser = '" . mysql_real_escape_string($_POST['username']) . "') and (comppass = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");
	// Check username and password match
	if (mysql_num_rows($login) == 1) {
		// Set username session variable
		$_SESSION['username'] = $_POST['username'];
		//Go to secured page
		header('Location: scoreboard.php');
	}
 
?>
<html>
	<head>
		<title>Authorization Error</title>
	</head>
	<body>
		<p>
		Your username or password was incorrect
		</b>
		<br>
		Retry: <a href="login.php">login</a> </p>
	</body>
</html>
