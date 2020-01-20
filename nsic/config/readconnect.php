<?php
	function read_connect() {
		static $readconn;

		if(!isset($readconn)) {
			$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../private/config.ini"); 
			$readconn = mysqli_connect($config['rdserver'], $config['rdusername'], $config['rdpassword'], $config['rddbname']);
		}

		if ($readconn === false){
			die('Connect Error ('. mysqli_connect_errno() .') '
			. mysqli_connect_error());
		}
		return $readconn;
	}

	$readconn = read_connect();

	if ($readconn->connect_error) {
		die("NSIC read connection failure: ". $readconn->connect_error);
	}
?> 